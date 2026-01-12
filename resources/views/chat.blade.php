<!DOCTYPE html>
<html>
<head>
    <title>Group Chat</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="user-id" content="{{ auth()->id() }}">

    @vite('resources/js/app.js')

    <style>
        body{ margin:0; font-family: Arial; background:#f0f2f5; }
        .chat-app{ display:flex; height:100vh; }

        /* LEFT SIDEBAR */
        .sidebar{
            width:300px;
            background:#fff;
            border-right:1px solid #ddd;
            overflow-y:auto;
        }
        .group{
            padding:15px;
            cursor:pointer;
            border-bottom:1px solid #eee;
        }
        .group:hover{ background:#f5f5f5; }

        /* RIGHT CHAT AREA */
        .chat-area{ flex:1; display:flex; flex-direction:column; }

        .chat-header{
            padding:15px;
            background:#fff;
            border-bottom:1px solid #ddd;
            font-weight:bold;
        }

        .messages{
            flex:1;
            padding:15px;
            overflow-y:auto;
            background:#e5ddd5;
        }

        .msg{
            margin-bottom:10px;
            max-width:60%;
            padding:8px 12px;
            border-radius:10px;
            clear:both;
        }
        .me{
            background:#dcf8c6;
            float:right;
        }
        .other{
            background:#fff;
            float:left;
        }

        .typing{ padding:5px 15px; color:#666; font-size:14px; }

        .chat-input{
            display:flex;
            padding:10px;
            background:#fff;
            border-top:1px solid #ddd;
        }
        .chat-input input{
            flex:1;
            padding:10px;
            border:1px solid #ccc;
            border-radius:20px;
            outline:none;
        }
        .chat-input button{
            margin-left:10px;
            padding:10px 20px;
            border:none;
            background:#0b93f6;
            color:#fff;
            border-radius:20px;
            cursor:pointer;
        }
    </style>
</head>
<body>

<div class="chat-app">

    <!-- LEFT: GROUP LIST -->
    <div class="sidebar">
        <h3 style="padding:15px;">Groups</h3>

        @foreach($groups as $group)
            <div class="group" onclick="openGroup({{ $group->id }})">
                {{ $group->name }}
            </div>
        @endforeach
    </div>

    <!-- RIGHT: CHAT -->
    <div class="chat-area">
        <div class="chat-header" id="group-title">
            Select a group
        </div>

        <div class="messages" id="chat-box"></div>

        <div class="typing" id="typing"></div>

        <div class="chat-input">
            <input type="text" id="message" placeholder="Type message..." onkeyup="typing()">
            <button onclick="sendMessage()">Send</button>
        </div>
    </div>

</div>

</body>
</html>

