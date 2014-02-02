function updatePage(phash, ldhash)
{
    var hashes = {'phash' : phash, 'ldhash' : ldhash};

    $.ajax(
        {
            type: 'GET',
            url: '../together/objects/livedata.php',
            data: hashes,
            success: function(data){
                var json = jQuery.parseJSON(data);
                
                $('#currentGame').html(json.current_game);
                $('#currentGameDescription').html(json.current_game_descripton);
                $('#currentGameIcon').attr("src", (json.current_game_icon));
                
                if ($('#alert').html() != json.alert) {
                	//Audio needs fixing...
                	//document.getElementById('noteSound').currentTime = 0;
                	//document.getElementById('noteSound').play();
                	$('#alert').show('fast');
                }
                
                $('#alert').html(json.alert);
                
                $('#polls').html(json.polls);
                
                updatePage(json.phash, json.ldhash);
            }
        }
    );
}

function hideAlert() {
	$('#alert').hide('slow');
}

$(function() {
    updatePage();
});