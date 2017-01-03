/**
 * Created by BW.KOFFI on 02/01/2017.
 */
const http = require('http');
const server = http.createServer(function($request, $ressource){
        console.log('Serveur démarré sur localhost. Ecoute sur le port 5390');
    });

var io = require('socket.io').listen(server);
var ClientsSocket = [];

/*
 io.sockets.emit('an event sent to all connected clients');
 io.emit('an event sent to all connected clients');
 */

function SocketUser($socket,$user) {
    this._socket = $socket;
    this._user = {
        id : $user.id,
        fullname : $user.fullname,
        isAdmin : $user.isAdmin
    }
}

//<<<<<<<<<<<<<<<<<<<<<<<<<         INBOUND        <<<<<<<<<<<<<<<<<<<<<<<<<<<<
io.sockets.on('connect',function ($socket) {

    //Interaction avec le client connecté
    $socket.on("login",function (utilisateur) {
        console.log(utilisateur);

        var Client = new SocketUser($socket,utilisateur);
        AddUserIfNotIn(Client);

        //On informe tous les admin qu'un utilisateur s'est connecté
        sendToAdmin('userConnect',Client._user);

        //
        $socket.emit('welcome','Bienvenue '+Client._user);


        //
        $socket.on('djerabroadcast',function(data){
            console.log(data);
        })
    })
});

//>>>>>>>>>>>>>>>>>>>>>>>>>>        OUTBOUND        >>>>>>>>>>>>>>>>>>>>>>>>>>>>>
server.listen(5390);

//Ajoute un utilisateur si celui-ci n'a pas déjà son ID dans le tableau des connectés
function AddUserIfNotIn($user) {
    console.log(ClientsSocket);
    if(ClientsSocket.length == 0){
        ClientsSocket.push($user);
    }else {
        var connected = ClientsSocket.findIndex(function(connect){
            console.log(connected);
            return $user._user.id == connect._user.id;
        });

        if(connected == -1){
            ClientsSocket.push($user);
        }
    }
}

function sendToAdmin(event,data) {
    for(var admin in ClientsSocket)
    {
        if(ClientsSocket[admin]._user.isAdmin == true){
            ClientsSocket[admin]._socket.emit(event,data);
        }
    }
}