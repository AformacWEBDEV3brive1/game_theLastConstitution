function move(id) {
    alert(id.className);
    $.ajax({url: 'plugin_controller/process_general.php',
        type: 'post',
        data: {info: 'move', joueur: '2', new_position: '1;1'},
        success: function (output) {
            alert(output);
        }
    });
}


