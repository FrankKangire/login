<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ball Game</title>
    <link rel="stylesheet" href="game.css">
	<link rel="stylesheet" href="make_game.css">
	
</head>
<body>
    <div id="make_game">
    <h1>Ball Game</h1>
    <p>Test</p>
    <button id='btnCreate'>New Game</button>
    <button id='btnJoin'>Join Game</button>
    <input type='text' id='txtGameId'>
</div>
    <div id="game">
    <h1>Jungle Professor</h1>
    <div id="diceCont">
        <p id="tog">Red's Turn : </p>
        <p id="dice">0</p>
        <button id="diceBtn">ROLL</button>
    </div>
    <div class="cont">
        <div class="box" id="b42">

        </div>
        <div class="box" id="b43">

        </div>
        <div class="box" id="b44">

        </div>
        <div class="box" id="b45">

        </div>
        <div class="box" id="b46">

        </div>
        <div class="box" id="b47">

        </div>
        <div class="box" id="b48">

        </div>
        <div class="box" id="b49">

        </div>
        <div class="box" id="b50">

        </div>
        <div class="box" id="b40">

        </div>
        <div class="box" id="b39">

        </div>
        <div class="box" id="b38">

        </div>
        <div class="box" id="b37">

        </div>
        <div class="box" id="b36">

        </div>
        <div class="box" id="b35">

        </div>
        <div class="box" id="b34">

        </div>
        <div class="box" id="b33">

        </div>
        <div class="box" id="b32">

        </div>
        <div class="box" id="b31">

        </div>
        <div class="box" id="b21">

        </div>
        <div class="box" id="b22">

        </div>
        <div class="box" id="b23">

        </div>
        <div class="box" id="b24">

        </div>
        <div class="box" id="b25">

        </div>
        <div class="box" id="b26">

        </div>
        <div class="box" id="b27">

        </div>
        <div class="box" id="b28">

        </div>
        <div class="box" id="b29">

        </div>
        <div class="box" id="b30">

        </div>
        <div class="box" id="b20">

        </div>
        <div class="box" id="b19">

        </div>
        <div class="box" id="b18">

        </div>
        <div class="box" id="b17">

        </div>
        <div class="box" id="b16">

        </div>
        <div class="box" id="b15">

        </div>
        <div class="box" id="b14">

        </div>
        <div class="box" id="b13">

        </div>
        <div class="box" id="b12">

        </div>
        <div class="box" id="b11">

        </div>
        <div class="box" id="b01">

            <p id="p1"></p>
			<p id="p2"></p>
			<p id="p3"></p>
			<p id="p4"></p>

        </div>
        <div class="box" id="b02">

        </div>
        <div class="box" id="b03">

        </div>
        <div class="box" id="b04">

        </div>
        <div class="box" id="b05">

        </div>
        <div class="box" id="b06">

        </div>
        <div class="box" id="b07">

        </div>
        <div class="box" id="b08">

        </div>
        <div class="box" id="b09">

        </div>
        <div class="box" id="b10">

        </div>


    </div>

    </div>
    <script>
        let clientId = null;
        let gameId = null;
        let player = null;
        let psum 
		let p1sum = 0
		let p2sum = 0
		let p3sum = 0
		let p4sum = 0
		let num = 0
        let tog = 1
		let positionleft = null
		let positiontop = null

        let ws = new WebSocket("ws://localhost:9090");
        const btnCreate = document.getElementById("btnCreate");
        const btnJoin = document.getElementById("btnJoin");
        const txtGameId = document.getElementById("txtGameId");
        const diceBtn = document.getElementById("diceBtn");

        // Wiring events
        btnJoin.addEventListener("click", e => {
            if (gameId === null) gameId = txtGameId.value;
            
            const payLoad = {
                "method": "join",
                "clientId": clientId,
                "gameId": gameId
            };
            ws.send(JSON.stringify(payLoad));
            console.log("Join message to server: " + JSON.stringify(payLoad));
        });

        btnCreate.addEventListener("click", e => {
            const payLoad = {
                "method": "create",
                "clientId": clientId
            };
            ws.send(JSON.stringify(payLoad));
            console.log("Create message to server:" + JSON.stringify(payLoad));
        });

        
ws.onmessage = message => {
    const response = JSON.parse(message.data);
    // Connect
    if (response.method === "connect") {
        clientId = response.clientId;
        console.log("Client id Set successfully " + clientId);
    }

    // Create game
    if (response.method === "create") {
        gameId = response.game.id;
        console.log("Game successfully created with id " + response.game.id);
    }

    // Update game state
    if (response.method === "update") {
                if (!response.game.state) return;
                for (const playerId of Object.keys(response.game.state)) {
                    const player = response.game.state[playerId];
                    document.getElementById(`${playerId}`).style.left = player.positionleft;
					document.getElementById(`${playerId}`).style.top = player.positiontop;
                }
            }

            // Join game
            if (response.method === "join") {
                const game = response.game;

                game.clients.forEach(c => {
                    if (c.clientId === clientId){ 
                        player = c.player;
                    }
                    console.log("Client's player: " + player);
                });
                document.getElementById("game").style.visibility = "visible";
                document.getElementById("make_game").remove();
                
            }
        };

function play(player, psum, num) {
	if(player == "p1"){
	p1sum = p1sum + num
	let sum = p1sum
	if (sum == 1) {
        positionleft = `-228px`
		
    }
	else if (sum == 2) {
        positionleft = `-158px`
		
    }
	else if (sum == 3) {
        positionleft = `-88px`
		
    }
	else if (sum == 4) {
        positionleft = `-20px`
    }
	else if (sum == 5) {
        positionleft = `49px`
    }
	else if(sum == 6){
		positionleft = `149px`
		
	}
	else if(sum == 7){
		positionleft = `149px`
		positiontop = `-34px`
	}
	else if(sum == 8){
		positionleft = `149px`
		positiontop = `-104px`
	}
	else if(sum == 9){
		positionleft = `149px`
		positiontop = `-171px`
	}
	else if(sum == 10){
		positionleft = `149px`
		positiontop = `-240px`
	}
	else if(sum == 11){
		positionleft = `149px`
		positiontop = `-311px`
	}
	else if(sum == 12){
		positionleft = `149px`
		positiontop = `-415px`
	}
	else if(sum == 13){
		positionleft = `50px`
		positiontop = `-415px`
	}
	else if(sum == 14){
		positionleft = `-20px`
		positiontop = `-415px`
	}
	else if(sum == 15){
		positionleft = `-88px`
		positiontop = `-415px`
	}
	else if(sum == 16){
		positionleft = `-158px`
		positiontop = `-415px`
	}
	else if(sum == 17){
		positionleft = `-228px`
		positiontop = `-415px`
	}
	else if(sum == 18){
		positionleft = `-328px`
		positiontop = `-415px`
	}
	else if(sum == 19){
		positionleft = `-328px`
		positiontop = `-311px`
	}
	else if (sum == 20) {
        positionleft = `-328px`
		positiontop = `-240px`
    }
	else if (sum == 21) {
        positionleft = `-328px`
		positiontop = `-171px`
    }
	else if (sum == 22) {
        positionleft = `-328px`
		positiontop = `-104px`
		
    }
	else if (sum == 23) {
        positionleft = `-328px`
		positiontop = `-34px`
		
    }
	else if (sum == 24) {
        positionleft = `-230px`
		positiontop = `-34px`
		
    }
	else if (sum == 25) {
        positionleft = `-152px`
		positiontop = `-27px`
    }
	else if(sum == 26){
		positionleft = `-88px`
		positiontop = `-27px`
		
	}
	else if(sum == 27){
		positionleft = `-25px`
		positiontop = `-27px`
	}
	else if(sum == 28){
		positionleft = `55px`
		positiontop = `-238px`
	}
	else if(sum == 29){
		positionleft = `52px`
		positiontop = `-320px`
	}
	else if(sum == 30){
		positionleft = `-25px`
		positiontop = `-325px`
	}
	else if(sum == 31){
		positionleft = `-88px`
		positiontop = `-320px`
	}
	else if(sum == 32){
		positionleft = `-156px`
		positiontop = `-320px`
	}
	else if(sum == 33){
		positionleft = `-236px`
		positiontop = `-110px`
	}
	}
	else if(player == "p2"){
	p2sum = p2sum + num
    let sum = p2sum
	if (sum == 1) {
        positionleft = `-228px`
		
    }
	else if (sum == 2) {
        positionleft = `-158px`
		
    }
	else if (sum == 3) {
        positionleft = `-88px`
		
    }
	else if (sum == 4) {
        positionleft = `-20px`
    }
	else if (sum == 5) {
        positionleft = `50px`
    }
	else if(sum == 6){
		positionleft = `148px`
		
	}
	else if(sum == 7){
		positionleft = `148px`
		positiontop = `-90px`
	}
	else if(sum == 8){
		positionleft = `148px`
		positiontop = `-158px`
	}
	else if(sum == 9){
		positionleft = `148px`
		positiontop = `-226px`
	}
	else if(sum == 10){
		positionleft = `148px`
		positiontop = `-298px`
	}
	else if(sum == 11){
		positionleft = `148px`
		positiontop = `-368px`
	}
	else if(sum == 12){
		positionleft = `148px`
		positiontop = `-474px`
	}
	else if(sum == 13){
		positionleft = `50px`
		positiontop = `-474px`
	}
	else if(sum == 14){
		positionleft = `-20px`;
		positiontop = `-474px`;
	}
	else if(sum == 15){
		positionleft = `-88px`
		positiontop = `-474px`
	}
	else if(sum == 16){
		positionleft = `-158px`
		positiontop = `-474px`
	}
	else if(sum == 17){
		positionleft = `-228px`
		positiontop = `-474px`
	}
	else if(sum == 18){
		positionleft = `-328px`
		positiontop = `-474px`
	}
	else if(sum == 19){
		positionleft = `-328px`
		positiontop = `-368px`
	}
	else if (sum == 20) {
        positionleft = `-328px`
		positiontop = `-298px`
    }
	else if (sum == 21) {
        positionleft = `-328px`
		positiontop = `-229px`
    }
	else if (sum == 22) {
        positionleft = `-328px`
		positiontop = `-162px`
		
    }
	else if (sum == 23) {
        positionleft = `-328px`
		positiontop = `-90px`
		
    }
	else if (sum == 24) {
        positionleft = `-230px`
		positiontop = `-90px`
		
    }
	else if (sum == 25) {
        positionleft = `-153px`
		positiontop = `-84px`
    }
	else if(sum == 26){
		positionleft = `-90px`
		positiontop = `-84px`
		
	}
	else if(sum == 27){
		positionleft = `-25px`
		positiontop = `-84px`
	}
	else if(sum == 28){
		positionleft = `55px`
		positiontop = `-294px`
	}
	else if(sum == 29){
		positionleft = `50px`
		positiontop = `-378px`
	}
	else if(sum == 30){
		positionleft = `-25px`
		positiontop = `-381px`
	}
	else if(sum == 31){
		positionleft = `-89px`
		positiontop = `-378px`
	}
	else if(sum == 32){
		positionleft = `-155px`
		positiontop = `-378px`
	}
	else if(sum == 33){
		positionleft = `-235px`
		positiontop = `-166px`
	}
	}
	else if(player == "p3"){
	p3sum = p3sum + num
    let sum = p3sum
	if (sum == 1) {
        positionleft = `-225px`
		
    }
	else if (sum == 2) {
        positionleft = `-155px`
		
    }
	else if (sum == 3) {
        positionleft = `-85px`
		
    }
	else if (sum == 4) {
        positionleft = `-15px`
    }
	else if (sum == 5) {
        positionleft = `55px`
    }
	else if(sum == 6){
		positionleft = `150px`
		
	}
	else if(sum == 7){
		positionleft = `150px`
		positiontop = `-145px`
	}
	else if(sum == 8){
		positionleft = `150px`
		positiontop = `-215px`
	}
	else if(sum == 9){
		positionleft = `150px`
		positiontop = `-285px`
	}
	else if(sum == 10){
		positionleft = `150px`
		positiontop = `-355px`
	}
	else if(sum == 11){
		positionleft = `150px`
		positiontop = `-425px`
	}
	else if(sum == 12){
		positionleft = `150px`
		positiontop = `-525px`
	}
	else if(sum == 13){
		positionleft = `50px`
		positiontop = `-525px`
	}
	else if(sum == 14){
		positionleft = `-20px`
		positiontop = `-525px`
	}
	else if(sum == 15){
		positionleft = `-90px`
		positiontop = `-525px`
	}
	else if(sum == 16){
		positionleft = `-160px`
		positiontop = `-525px`
	}
	else if(sum == 17){
		positionleft = `-230px`
		positiontop = `-525px`
	}
	else if(sum == 18){
		positionleft = `-330px`
		positiontop = `-525px`
	}
	else if(sum == 19){
		positionleft = `-330px`
		positiontop = `-425px`
	}
	else if (sum == 20) {
        positionleft = `-330px`
		positiontop = `-355px`
    }
	else if (sum == 21) {
        positionleft = `-330px`
		positiontop = `-285px`
    }
	else if (sum == 22) {
        positionleft = `-330px`
		positiontop = `-215px`
		
    }
	else if (sum == 23) {
        positionleft = `-330px`
		positiontop = `-148px`
		
    }
	else if (sum == 24) {
        positionleft = `-230px`
		positiontop = `-148px`
		
    }
	else if (sum == 25) {
        positionleft = `-150px`;
		positiontop = `-140px`;
    }
	else if(sum == 26){
		positionleft = `-90px`
		positiontop = `-140px`
		
	}
	else if(sum == 27){
		positionleft = `-25px`
		positiontop = `-140px`
	}
	else if(sum == 28){
		positionleft = `57px`
		positiontop = `-350px`
	}
	else if(sum == 29){
		positionleft = `50px`
		positiontop = `-430px`
	}
	else if(sum == 30){
		positionleft = `-25px`
		positiontop = `-435px`
	}
	else if(sum == 31){
		positionleft = `-90px`
		positiontop = `-430px`
	}
	else if(sum == 32){
		positionleft = `-155px`
		positiontop = `-430px`
	}
	else if(sum == 33){
		positionleft = `-235px`
		positiontop = `-222px`
	}
	}
	else if(player == "p4"){
	p4sum = p4sum + num
    let sum = p4sum
	if (sum == 1) {
        positionleft = `-228px`
		
    }
	else if (sum == 2) {
        positionleft = `-158px`
		
    }
	else if (sum == 3) {
        positionleft = `-88px`
		
    }
	else if (sum == 4) {
        positionleft = `-20px`
    }
	else if (sum == 5) {
        positionleft = `50px`
    }
	else if(sum == 6){
		positionleft = `150px`;
		
	}
	else if(sum == 7){
		positionleft = `150px`;
		positiontop = `-200px`;
	}
	else if(sum == 8){
		positionleft = `150px`;
		positiontop = `-270px`;
	}
	else if(sum == 9){
		positionleft = `150px`;
		positiontop = `-340px`;
	}
	else if(sum == 10){
		positionleft = `150px`;
		positiontop = `-410px`;
	}
	else if(sum == 11){
		positionleft = `150px`;
		positiontop = `-480px`;
	}
	else if(sum == 12){
		positionleft = `150px`;
		positiontop = `-580px`
	}
	else if(sum == 13){
		positionleft = `55px`;
		positiontop = `-580px`;
	}
	else if(sum == 14){
		positionleft = `-20px`
		positiontop = `-580px`
	}
	else if(sum == 15){
		positionleft = `-88px`
		positiontop = `-580px`
	}
	else if(sum == 16){
		positionleft = `-158px`
		positiontop = `-580px`
	}
	else if(sum == 17){
		positionleft = `-228px`;
		positiontop = `-580px`;
	}
	else if(sum == 18){
		positionleft = `-330px`
		positiontop = `-580px`
	}
	else if(sum == 19){
		positionleft = `-330px`
		positiontop = `-480px`
	}
	else if (sum == 20) {
        positionleft = `-330px`
		positiontop = `-410px`
    }
	else if (sum == 21) {
        positionleft = `-330px`
		positiontop = `-340px`
    }
	else if (sum == 22) {
        positionleft = `-330px`
		positiontop = `-270px`
		
    }
	else if (sum == 23) {
        positionleft = `-330px`
		positiontop = `-200px`
		
    }
	else if (sum == 24) {
        positionleft = `-225px`
		positiontop = `-208px`
		
    }
	else if (sum == 25) {
        positionleft = `-150px`;
		positiontop = `-200px`;
    }
	else if(sum == 26){
		positionleft = `-75px`
		positiontop = `-200px`
		
	}
	else if(sum == 27){
		positionleft = `-12px`
		positiontop = `-200px`
	}
	else if(sum == 28){
		positionleft = `65px`;
		positiontop = `-410px`;
	}
	else if(sum == 29){
		positionleft = `50px`
		positiontop = `-490px`
	}
	else if(sum == 30){
		positionleft = `-25px`
		positiontop = `-490px`
	}
	else if(sum == 31){
		positionleft = `-90px`
		positiontop = `-490px`
	}
	else if(sum == 32){
		positionleft = `-155px`
		positiontop = `-490px`
		}
	else if(sum == 33){
		positionleft = `-235px`
		positiontop = `-280px`
	}
	}
	return {positionleft, positiontop};
	positiontransition = `linear all 0.5s`
}

diceBtn.addEventListener("click", e => {
    num = Math.floor(Math.random() * (6 - 1 + 1) + 1)
    document.getElementById("dice").innerText = num
    if (tog) {
		if(player === "p1"){
            document.getElementById('tog').innerText = "Your Turn"
            play("p1", 'p1sum', num)
		}
		else if(player === "p2"){
			document.getElementById('tog').innerText = "Your Turn"
			play("p2", 'p2sum', num)
		}
		else if(player === "p3"){
			document.getElementById('tog').innerText = "Your Turn"
			play("p3", 'p3sum', num)
		}
		else if(player === "p4"){
			document.getElementById('tog').innerText = "Your Turn"
			play("p4", 'p4sum', num)
		}
    }
    tog = tog + 1
	let obj = play();
	console.log("Player: " + player + " Positionleft: " + obj.positionleft + " Positiontop: " + obj.positiontop);
	const payLoad = {
		"method": "play",
		"clientId":clientId,
		"gameId": gameId,
		"player": player,
		"positionleft": positionleft,
		"positiontop": positiontop
	};
	ws.send(JSON.stringify(payLoad));
});

    </script>
    <script src="server.js">
</script>
</body>
</html>
