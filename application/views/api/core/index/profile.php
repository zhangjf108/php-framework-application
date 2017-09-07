<?php $this->layout('layout/layout', ['title' => $this->e($title)]) ?>

<h1>User Profile</h1>
<p>Hello, <?= $this->e($name) ?></p>
<button onclick="websocket()">WebSocket</button>
<div id="content"></div>
<script>
    var ws;

    function websocket() {
        ws = new WebSocket("ws://api-framework-websocket.ptdev.cn");

        ws.onopen = function(evt) {
            ws.send('{"path":"core\/test\/index","params":{"time":"2017-07-28"}}');

            setInterval(function () {
                ws.send('{"path":"core\/test\/index","params":{"time":"2017-07-28"}}');
                //console.log(new Date());
            }, 5000);
        };

        ws.onmessage = function(evt) {
            //console.log( "Received Message: " + evt.data);
            document.getElementById('content').innerHTML += evt.data + "<br>";
        };

        ws.onclose = function(evt) {
            console.log("Connection closed.");
        };

        ws.onerror = function (evt) {
            console.log("Connection Error.")
        };
    }
</script>