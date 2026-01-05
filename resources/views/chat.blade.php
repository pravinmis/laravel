<!-- <meta name="user-id" content="{{ auth()->id() }}">
<meta name="csrf-token" content="{{ csrf_token() }}">

<h3>Chat</h3>

<div id="chat-box" style="height:300px;overflow:auto;border:1px solid #ccc"></div>

<div id="typing" style="color:gray"></div>

<input id="message" onkeyup="typing()" placeholder="Type..." />
<button onclick="sendMessage()">Send</button>

@vite('resources/js/app.js') -->
<meta name="user-id" content="{{ auth()->id() }}">
<meta name="csrf-token" content="{{ csrf_token() }}">

<div id="group-list">
  <button onclick="openGroup(1)">Family</button>
  <button onclick="openGroup(2)">Office</button>
</div>

<hr>

<div id="chat-box"></div>
<div id="typing"></div>

<input id="message" onkeyup="typing()" />
<button onclick="sendMessage()">Send</button>

@vite('resources/js/app.js')
