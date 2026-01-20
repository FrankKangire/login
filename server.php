<?php
session_start();
if(!isset($_SESSION["user_id"])){ header("Location: login.php"); exit(); }
require "connection.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Jungle Professor</title>
    <link rel="stylesheet" href="bootstrap-5.3.3-dist/bootstrap-5.3.3-dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        :root { --board-size: 85vh; }
        html, body { margin: 0; padding: 0; width: 100%; height: 100%; overflow: hidden; overscroll-behavior: none; touch-action: none; background: #121212; color: white; font-family: sans-serif; }
        .view-section { display: none; flex-direction: column; align-items: center; justify-content: center; min-height: 85vh; padding: 20px; }
        .active-view { display: flex !important; }
        .game-card { background: #fff; color: #333; padding: 15px; border-radius: 15px; width: 280px; text-align: center; cursor: pointer; transition: 0.3s; margin: 15px; border: 4px solid transparent; }
        .game-card:hover { transform: translateY(-10px); border-color: #27ae60; }
        .game-card img { height: 160px; width: 100%; object-fit: cover; border-radius: 10px; }
        .game-wrapper { position: relative; width: var(--board-size); max-width: 95vw; aspect-ratio: 1 / 1; background-size: 100% 100%; border: 5px solid #444; box-shadow: 0 0 30px rgba(0,0,0,0.5); }
        .player { display: none; position: absolute; width: 10%; height: 10%; border-radius: 50%; border: 2px solid black; transition: all 0.6s cubic-bezier(0.18, 0.89, 0.32, 1.28); z-index: 10; transform: translate(-50%, -50%); }
        #p1 { background: #ff4757; } #p2 { background: #ffa502; } #p3 { background: #2ed573; } #p4 { background: #1e90ff; }
        #ui-bar { background: rgba(0,0,0,0.85); padding: 15px; border-radius: 10px; width: var(--board-size); max-width: 95vw; margin-bottom: 10px; }
        #diceBtn:disabled, #quitBtn:disabled { opacity: 0.5; cursor: not-allowed; }
        .active-turn { background-color: #f1c40f !important; color: black !important; box-shadow: 0 0 15px #f1c40f; border: 2px solid white !important; }
        .pulse { animation: pulse-green 2s infinite; font-size: 3rem; font-weight: bold; }
        @keyframes pulse-green { 0% { color: #333; } 50% { color: #27ae60; } 100% { color: #333; } }
    </style>
</head>
<body>

<?php include "navbar.php"; ?>

<div id="view-start" class="view-section active-view">
    <div class="text-center">
        <h1 class="display-3 fw-bold mb-4">Board Game Hub</h1>
        <button id="mainStartBtn" class="btn btn-lg btn-success px-5 shadow" onclick="showView('view-select')" disabled>CONNECTING...</button>
    </div>
</div>

<div id="view-select" class="view-section">
    <h2 class="mb-4">Select Map</h2>
    <div class="d-flex flex-wrap justify-content-center">
        <div class="game-card shadow" onclick="enterMatchmaking('jungle')"><img src="images/IMG-20240301-WA0006.jpg"><h4 class="mt-3">Jungle Professor</h4></div>
        <div class="game-card shadow" onclick="enterMatchmaking('city')"><img src="images/IMG-20240305-WA0002.jpg"><h4 class="mt-3">City Tour</h4></div>
    </div>
</div>

<div id="view-waiting" class="view-section">
    <div class="text-center">
        <h2 id="waiting-title">Joining Room...</h2>
        <div class="pulse my-4" id="wait-count">1/4</div>
        <div class="spinner-border text-success" role="status"></div>
    </div>
</div>

<div id="view-board" class="view-section">
    <div id="ui-bar" class="d-flex justify-content-between align-items-center">
        <span id="turn-txt" class="fw-bold text-uppercase small">...</span>
        <div>
            Dice: <b id="dice-val" class="text-warning fs-4 me-2">0</b>
            <button class="btn btn-warning btn-sm me-2" id="diceBtn">ROLL</button>
            <!-- NEW QUIT BUTTON -->
            <button class="btn btn-outline-danger btn-sm" id="quitBtn" onclick="quitGame()">QUIT</button>
        </div>
    </div>
    <div class="game-wrapper" id="board-container">
        <div id="p1" class="player"></div><div id="p2" class="player"></div><div id="p3" class="player"></div><div id="p4" class="player"></div>
    </div>
</div>

<script>
    let clientId, gameId, myPlayerId = null;
    let selectedMap = 'jungle';
    let currentSum = 0;
    let sessionResults = [];
    const nodeURL = "jungle-professor-game-server.onrender.com"; // Your Node service URL
    const ws = new WebSocket("wss://" + nodeURL);

    let questionResolver = null;
    let answerResolver = null;

    const tileCoords = {
        0: { left: '11.36%', top: '89.43%' }, 1: { left: '27.65%', top: '89.57%' }, 2: { left: '38.35%', top: '89.57%' }, 3: { left: '49.87%', top: '89.29%' }, 4: { left: '61.23%', top: '89.57%' }, 5: { left: '72.91%', top: '89.57%' }, 6: { left: '89.70%', top: '89.43%' }, 7: { left: '88.22%', top: '73.28%' }, 8: { left: '88.22%', top: '61.77%' }, 9: { left: '89.20%', top: '50.54%' }, 10: { left: '88.38%', top: '39.03%' }, 11: { left: '88.22%', top: '27.66%' }, 12: { left: '88.88%', top: '10.39%' }, 13: { left: '72.25%', top: '10.39%' }, 14: { left: '61.55%', top: '10.95%' }, 15: { left: '49.54%', top: '10.81%' }, 16: { left: '38.18%', top: '10.95%' }, 17: { left: '26.99%', top: '11.51%' }, 18: { left: '9.55%', top: '10.67%' }, 19: { left: '9.88%', top: '27.80%' }, 20: { left: '10.04%', top: '40.01%' }, 21: { left: '9.71%', top: '49.84%' }, 22: { left: '10.53%', top: '62.05%' }, 23: { left: '9.88%', top: '73.56%' }, 24: { left: '25.68%', top: '73.28%' }, 25: { left: '38.68%', top: '74.13%' }, 26: { left: '50.20%', top: '74.55%' }, 27: { left: '60.24%', top: '74.41%' }, 28: { left: '72.91%', top: '40.15%' }, 29: { left: '72.25%', top: '26.96%' }, 30: { left: '59.09%', top: '25.83%' }, 31: { left: '49.38%', top: '26.11%' }, 32: { left: '37.85%', top: '26.67%' }, 33: { left: '25.18%', top: '61.21%' }
    };

    function showView(id) {
        document.querySelectorAll('.view-section').forEach(v => v.classList.remove('active-view'));
        document.getElementById(id).classList.add('active-view');
    }

    function enterMatchmaking(type) {
        selectedMap = type;
        const config = { 'jungle': 'images/IMG-20240301-WA0006.jpg', 'city': 'images/IMG-20240305-WA0002.jpg' }[type];
        document.getElementById('board-container').style.backgroundImage = `url("${config}")`;
        showView('view-waiting');
        ws.send(JSON.stringify({ "method": "find_game", "clientId": clientId, "gameType": type }));
    }

    ws.onmessage = message => {
        const response = JSON.parse(message.data);
        if (response.method === "connect") {
            clientId = response.clientId;
            document.getElementById("mainStartBtn").disabled = false;
            document.getElementById("mainStartBtn").innerText = "FIND A MATCH";
        }
        if (response.method === "waiting") document.getElementById('wait-count').innerText = response.count + "/" + response.max;
        if (response.method === "join") {
            gameId = response.game.id;
            response.game.clients.forEach(c => { 
                if(c.clientId === clientId) myPlayerId = c.player; 
                document.getElementById(c.player).style.display = "block";
            });
            showView('view-board');
            updatePositions(null);
        }
        if (response.method === "update" && response.game.state) {
            updatePositions(response.game.state);
            const game = response.game;
            const currentPId = game.clients[game.turnIndex].player;
            const diceBtn = document.getElementById("diceBtn");
            if (currentPId === myPlayerId) {
                document.getElementById("turn-txt").innerHTML = `<span class="text-success small">★ YOUR TURN ★</span>`;
                diceBtn.disabled = false; diceBtn.classList.add("active-turn");
            } else {
                document.getElementById("turn-txt").innerText = `Waiting for ${currentPId.toUpperCase()}...`;
                diceBtn.disabled = true; diceBtn.classList.remove("active-turn");
            }
        }
        if (response.method === "provide_questions" && questionResolver) questionResolver(response.questions);
        if (response.method === "verification_result" && answerResolver) answerResolver(response.isCorrect, response.correctAnswer);
    };

    function updatePositions(state) {
        if (!state) {
            const active = Array.from(document.querySelectorAll('.player')).filter(el => el.style.display === "block");
            active.forEach(p => movePlayer(p.id, tileCoords[0].left, tileCoords[0].top, active.length > 1, 0));
            return;
        }
        const occupancy = {};
        for (const pId in state) {
            const key = state[pId].positionleft + "|" + state[pId].positiontop;
            if (!occupancy[key]) occupancy[key] = [];
            occupancy[key].push(pId);
        }
        for (const key in occupancy) {
            const players = occupancy[key];
            const [L, T] = key.split("|");
            players.forEach((pId, idx) => movePlayer(pId, L, T, players.length > 1, idx));
        }
    }

    function movePlayer(pId, L, T, crowded, index) {
        const el = document.getElementById(pId);
        if (!el) return;
        let lNum = parseFloat(L), tNum = parseFloat(T), offset = 2.5;
        if (crowded) {
            if (index === 0) { lNum -= offset; tNum -= offset; }
            if (index === 1) { lNum += offset; tNum -= offset; }
            if (index === 2) { lNum -= offset; tNum += offset; }
            if (index === 3) { lNum += offset; tNum += offset; }
        }
        el.style.left = lNum + "%"; el.style.top = tNum + "%";
    }

    function quitGame() {
        Swal.fire({
            title: 'Quit Game?',
            text: "Do you want to save your progress and exit?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, Save & Quit'
        }).then((result) => {
            if (result.isConfirmed) {
                goToResults();
            }
        });
    }

    function goToResults() {
        sessionStorage.setItem('lastGameResults', JSON.stringify(sessionResults));
        window.location.href = 'results.php';
    }

    document.getElementById("diceBtn").onclick = () => {
        document.getElementById("diceBtn").disabled = true;
        let roll = Math.floor(Math.random() * 6) + 1;
        document.getElementById("dice-val").innerText = roll;
        currentSum += roll;
        // Your questionPositions go up to 34, so we allow 34 here
        if (currentSum > 34) currentSum = 34; 
        
        let c = tileCoords[currentSum] || tileCoords[33]; // Fallback to 33 if 34 has no coord
        ws.send(JSON.stringify({ "method": "play", "clientId": clientId, "gameId": gameId, "player": myPlayerId, "positionleft": c.left, "positiontop": c.top }));
        handleTripleQuestion(currentSum);
    };

    async function handleTripleQuestion(tileIndex) {
        if (tileIndex === 0) { endTurn(); return; }
        
        ws.send(JSON.stringify({ "method": "request_questions", "clientId": clientId, "tile": tileIndex, "mapType": selectedMap }));
        const questions = await new Promise(res => { questionResolver = res; });

        for (let i = 0; i < questions.length; i++) {
            const q = questions[i];
            let answeredCorrectly = false;
            let correctText = "";
            while(!answeredCorrectly) {
                const { value: userInput } = await Swal.fire({ title: `Question ${i + 1} of 3`, text: q.text, input: 'text', allowOutsideClick: false });
                ws.send(JSON.stringify({ "method": "verify_answer", "clientId": clientId, "questionId": q.id, "answer": userInput || "" }));
                const result = await new Promise(res => { answerResolver = (isCor, corTxt) => res({isCor, corTxt}); });
                answeredCorrectly = result.isCor; correctText = result.corTxt;
                sessionResults.push({ question: q.text, user_answer: userInput || "No answer", correct_answer: correctText, is_correct: answeredCorrectly });
                if(!answeredCorrectly) await Swal.fire('Incorrect!', 'Try again.', 'error');
            }
        }
        
        // REDIRECT LOGIC: Triggers on tile 33 or 34
        if (currentSum >= 33) {
            goToResults();
        } else {
            endTurn();
        }
    }
    function endTurn() { ws.send(JSON.stringify({ "method": "finish_turn", "gameId": gameId })); }
</script>
<script src="bootstrap-5.3.3-dist/bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>