import './bootstrap';

console.log("JS Loaded");

console.log("ROOM:", window.ROOM_ID);
console.log("USER:", window.USER_ID);
console.log("Echo:", window.Echo);

let localStream = null;
let peers = {};
let pendingIce = {}; // ICE queue for each peer

// 🎥 Get Camera + Mic
navigator.mediaDevices.getUserMedia({ video: true, audio: false })
.then(stream => {
    console.log("Camera OK");

    localStream = stream;
    addVideo(stream, "Me");

    // Start listening to signals
    listenSignal();

    // Notify others that this user joined
    sendSignal({ join: true });

})
.catch(err => {
    console.error("Camera Error", err);
});


// 📡 Listen to Reverb / WebSocket
function listenSignal(){
    console.log("listenSignal() called");

    window.Echo.channel('room.' + window.ROOM_ID)
        .listen('SignalEvent', e => {

            console.log("📩 Signal Received", e);

            // Ignore my own messages
            if(e.userId == window.USER_ID) return;

            handleSignal(e.userId, e.data);
        });
}


// 📤 Send signal to server
function sendSignal(data){
    console.log("📤 sendSignal()", data);

    fetch('/admin/conference/signal', {
        method:'POST',
        headers:{
            'Content-Type':'application/json',
            'X-CSRF-TOKEN': window.CSRF
        },
        body: JSON.stringify({
            room: window.ROOM_ID,
            data: data
        })
    });
}


// 🤝 Create Peer
function createPeer(userId){
    console.log("🤝 Create peer for", userId);

    let pc = new RTCPeerConnection({
        iceServers: [
            { urls: "stun:stun.l.google.com:19302" }
        ]
    });

    // Add my local tracks
    localStream.getTracks().forEach(track => {
        pc.addTrack(track, localStream);
    });

    // Remote stream
    pc.ontrack = e => {
        console.log("🎥 Remote track received from", userId);
        addVideo(e.streams[0], "User " + userId);
    };

    // ICE candidates
    pc.onicecandidate = e => {
        if(e.candidate){
            console.log("❄️ Send ICE");
            sendSignal({
                to: userId,
                ice: e.candidate
            });
        }
    };

    peers[userId] = pc;
    pendingIce[userId] = [];
    return pc;
}


// 🔁 Main handle signal logic
async function handleSignal(fromUser, data){

    console.log("🔁 handleSignal()", fromUser, data);

    let pc = peers[fromUser] || createPeer(fromUser);

    // 1️⃣ New user joined → create offer
    if(data.join){
        console.log("👋 User joined, creating offer");

        let offer = await pc.createOffer();
        await pc.setLocalDescription(offer);

        sendSignal({
            to: fromUser,
            sdp: {
                type: pc.localDescription.type,
                sdp: btoa(pc.localDescription.sdp) // 🔥 encode SDP
            }
        });
    }

    // 2️⃣ SDP received
    if(data.sdp){
        console.log("📄 SDP received");

        let desc = {
            type: data.sdp.type,
            sdp: atob(data.sdp.sdp) // 🔥 decode SDP
        };

        await pc.setRemoteDescription(new RTCSessionDescription(desc));

        // Apply queued ICE
        if(pendingIce[fromUser]){
            for(let ice of pendingIce[fromUser]){
                await pc.addIceCandidate(ice);
            }
            pendingIce[fromUser] = [];
        }

        // If received SDP is offer → send answer
        if(data.sdp.type === "offer"){
            console.log("📞 Sending answer");

            let answer = await pc.createAnswer();
            await pc.setLocalDescription(answer);

            sendSignal({
                to: fromUser,
                sdp: {
                    type: pc.localDescription.type,
                    sdp: btoa(pc.localDescription.sdp) // encode
                }
            });
        }
    }

    // 3️⃣ ICE candidate received
    if(data.ice){
        console.log("❄️ ICE received");

        let ice = new RTCIceCandidate(data.ice);

        if(pc.remoteDescription && pc.remoteDescription.type){
            await pc.addIceCandidate(ice);
        } else {
            console.log("🧊 ICE queued");
            pendingIce[fromUser].push(ice);
        }
    }
}


// 📺 Add video to DOM
function addVideo(stream, label){
    let video = document.createElement("video");
    video.srcObject = stream;
    video.autoplay = true;
    video.playsInline = true;

    let box = document.createElement("div");
    box.innerHTML = `<h4>${label}</h4>`;
    box.appendChild(video);

    document.getElementById("videos").appendChild(box);
}


// 🔇 Optional controls (mute / camera toggle / screen share)
window.toggleMute = () => {
    if(!localStream) return;
    localStream.getAudioTracks().forEach(t => t.enabled = !t.enabled);
};

window.toggleCamera = () => {
    if(!localStream) return;
    localStream.getVideoTracks().forEach(t => t.enabled = !t.enabled);
};

window.shareScreen = async () => {
    if(!localStream) return;
    try {
        const screenStream = await navigator.mediaDevices.getDisplayMedia({ video: true });
        const screenTrack = screenStream.getVideoTracks()[0];

        for(let userId in peers){
            const sender = peers[userId].getSenders().find(s => s.track.kind === 'video');
            sender.replaceTrack(screenTrack);
        }

        screenTrack.onended = () => {
            for(let userId in peers){
                const sender = peers[userId].getSenders().find(s => s.track.kind === 'video');
                sender.replaceTrack(localStream.getVideoTracks()[0]);
            }
        };

    } catch(err){
        console.error("Screen Share Error", err);
    }
};

window.leaveRoom = () => {
    for(let userId in peers){
        peers[userId].close();
    }
    peers = {};
    pendingIce = {};
    location.href = '/'; // or redirect somewhere
};
