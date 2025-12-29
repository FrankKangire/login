const express = require("express");
const { createProxyMiddleware } = require('http-proxy-middleware');
const http = require("http");
const app = express();

// Proxy requests to the PHP server running on localhost:80 (Apache or Nginx)
app.use('/', createProxyMiddleware({
    target: 'http://localhost:80', // Replace this with the port your PHP server is running on
    changeOrigin: true
}));

app.listen(9091, () => console.log("Listening on http port 9091"));

const websocketServer = require("websocket").server;
const httpServer = http.createServer();
httpServer.listen(9090, () => console.log("Listening.. on 9090"));

// Hashmaps for clients and games
const clients = {};
const games = {};

const wsServer = new websocketServer({
    "httpServer": httpServer
})
wsServer.on("request", request => {
    //connect
    const connection = request.accept(null, request.origin);
    connection.on("open", () => console.log("opened!"))
    connection.on("close", () => console.log("closed!"))
    connection.on("message", message => {
        const result = JSON.parse(message.utf8Data)
        //I have received a message from the client
        //a user want to create a new game
        if (result.method === "create") {
            const clientId = result.clientId;
			//creating a game
            const gameId = guid();
            games[gameId] = {
                "id": gameId,
                "balls": 20,
                "clients": []
            }

            const payLoad = {
                "method": "create",
                "game" : games[gameId]
            }

            const con = clients[clientId].connection;
            con.send(JSON.stringify(payLoad));
            console.log("Create message from server: " + JSON.stringify(payLoad));
        }

        //a client want to join
        if (result.method === "join") {

            const clientId = result.clientId;
            const gameId = result.gameId;
            const game = games[gameId];
            if (game.clients.length >= 4) 
            {
                //sorry max players reach
                return;
            }
            const player =  {"0": "p1", "1": "p2", "2": "p3", "3":"p4"}[game.clients.length]
			//adding clients to clients:[]
            game.clients.push({
                "clientId": clientId,
                "player": player
            })
            //start the game
            if (game.clients.length === 4) updateGameState();

            const payLoad = {
                "method": "join",
                "game": game
            }
            console.log("Join message from server: " + JSON.stringify(payLoad));
            //loop through all clients and tell them that people has joined
            game.clients.forEach(c => {
                clients[c.clientId].connection.send(JSON.stringify(payLoad))
            })
        }
        //a user plays
        if (result.method === "play") {
            const gameId = result.gameId;
            let positiontop = result.positiontop;
            let positionleft = result.positionleft
            let player = result.player
            let state = games[gameId].state;
            if (!state)
                state = {}
            
            state[player] = {
                "positiontop": positiontop,
                "positionleft": positionleft
            };
            games[gameId].state = state;
        }

    })

    //generate a new clientId
    const clientId = guid();
	//mapping between connection and clientId
	//clients[clientId] = connection;
	//make it an object as it may have more information than just the connection
    clients[clientId] = {
        "connection":  connection
    }

    const payLoad = {
        "method": "connect",
        "clientId": clientId
    }
    //send back the client connect
    connection.send(JSON.stringify(payLoad))

});


function updateGameState(){

    //{"gameid", fasdfsf}
    for (const g of Object.keys(games)) {
        const game = games[g]
        const payLoad = {
            "method": "update",
            "game": game
        }
        console.log("Update message from server: " + JSON.stringify(payLoad));
        game.clients.forEach(c=> {
            clients[c.clientId].connection.send(JSON.stringify(payLoad))
        })
    }

    setTimeout(updateGameState, 500);
}



function S4() {
    return (((1+Math.random())*0x10000)|0).toString(16).substring(1); 
}
 
// then to call it, plus stitch in '4' in the third group
const guid = () => (S4() + S4() + "-" + S4() + "-4" + S4().substr(0,3) + "-" + S4() + "-" + S4() + S4() + S4()).toLowerCase();
 
