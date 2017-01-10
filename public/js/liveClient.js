/**
 * Created by BW.KOFFI on 02/01/2017.
 */

var socket = io.connect('localhost:5390');

//>>>>>>>>>>>>>>>>>>>>>>>>>>        OUTBOUND        >>>>>>>>>>>>>>>>>>>>>>>>>>>>>
socket.emit('login',MY);

//<<<<<<<<<<<<<<<<<<<<<<<<<         INBOUND        <<<<<<<<<<<<<<<<<<<<<<<<<<<<
socket.on('welcome',function (data) {
    //console.log(data.fullname);
    ShowNotification(data.fullname);
});

socket.on('userConnect',function (data) {
    ShowNotification('welcome guest user '+ data);

    $target = "#user"+data.id+" a.profile_thumb";

    $($target).addClass('connected')
    $($target).removeClass('disconnected')
})

function ShowNotification(message, type, title){
    new PNotify({
        title: title ? title : 'Notification',
        type: type ? type : 'info',
        text: message,
        nonblock: {
            nonblock: true
        },
        styling: 'bootstrap3',
        addclass: 'dark'
    });
}
