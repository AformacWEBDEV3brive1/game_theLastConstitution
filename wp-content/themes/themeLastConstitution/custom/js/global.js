function move(id) {
    //alert('x='+ id.className.split(' ')[1] + ' y=' + id.className.split(' ')[3]);
    var x = id.className.split(' ')[1];
    var y = id.className.split(' ')[3];
    $.ajax({url: 'wp-content/plugins/game_plugin/plugin_controller/process_general.php',
        type: 'post',
        data: {info: 'move', joueur: '2', new_position: x+";"+y},
        success: function (output) {
            window.location.reload();
            alert(output);
        }
    });
}




