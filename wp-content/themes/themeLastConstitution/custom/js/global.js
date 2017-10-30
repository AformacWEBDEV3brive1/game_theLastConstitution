function move(id) {
    //alert('x='+ id.className.split(' ')[1] + ' y=' + id.className.split(' ')[3]);
    var x = id.className.split(' ')[1];
    var y = id.className.split(' ')[3];
            $.ajax({url: 'wp-content/plugins/game_plugin/process_general.php',
            type: 'post',
            data: {info: 'move', new_position: x + ";" + y},
            success: function (output) {
                $('#grille').load('index.php #grille');
                
            }
        });
}


