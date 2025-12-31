
//<button type="button" id="btn" data-id="5">Pay Now</button>

//  document.addEventListener('DOMContentLoaded',function(){
//          document.getElementById('btn').addEventListener('click' ,function(){
           
//                let  id  = this.getAttribute('data_id');
//                console.log(id);
//          });
//     });

// document.addEventListener('click', function(e){
//     if (e.target.id === 'btn') {
//         alert("Clicked");
//     }
// });

//<button class="payBtn" data-id="5">Pay</button>
//<button class="payBtn" data-id="6">Pay</button>
// document.addEventListener('DOMContentLoaded', function () {

//     document.querySelectorAll('.payBtn').forEach(function (btn) {
//         btn.addEventListener('click', function () {

//             let id = this.dataset.id;
//             console.log(id); // 5, 6, 7

//             // yahin se payment call karo
//         });
//     });

// });

// document.addEventListener('click', function (e) {
//     if (e.target.classList.contains('payBtn')) {
//         console.log(e.target.dataset.id);
//     }
// });

// ye passport api ke liye 
document.addEventListener("DOMContentLoaded", function() {

    document.getElementById('btns').addEventListener('click',function(){
    
        console.log("hello");
    
        fetch("/api/login", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify({
                email: "hello@example.com",
                password: "password"
            })
        })
        .then(res => res.json())
        .then(data => {
            console.log(data.access_token);
            // YAHI TOKEN STORE HOTA HAI
           localStorage.setItem("token", data.access_token);  //ye dekho 

            alert(data.access_token);
        });
    
});
});

function hello(){
fetch("/api/user", {
    method: "GET",
    headers: {
        "Authorization": "Bearer " + localStorage.getItem("token"),
        "Content-Type": "application/json"
    }
})
       .then(res => res.json())
        .then(data => {
            console.log(data.name);
            document.getElementById('test').value=data.name;
            // YAHI TOKEN STORE HOTA HAI
          //  localStorage.setItem("token", data.access_token);  //ye dekho 

          //  alert(data.access_token);
        });

    }

    hello();


   document.addEventListener('DOMContentLoaded', function () {

    document.getElementById('register_form').addEventListener('submit', function (e) {
        e.preventDefault();
        console.log("hellos");

        let email = document.getElementById('email').value;
        let password = document.getElementById('password').value;
        let image = document.getElementById('image').files;  // Correct

        console.log(image);

        let formData = new FormData();
       // Multiple image append
for (let i = 0; i < image.length; i++) {
    formData.append('image[]', image[i]);
}  // Correct key
        formData.append('email', email);
        formData.append('password', password);

        $.ajax({
            url: "store",
            type: "POST",
            data: formData,
          headers: {
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
            processData: false,   // IMPORTANT
            contentType: false,   // IMPORTANT
            success: function (res) {
                alert("Successfully Uploaded");
                console.log(res);
            },
            error: function (err) {
                console.log(err);
                alert("Error coming");
            }
        });

    });
});

    


