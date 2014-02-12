function updatePage(phash, ldhash, shash)
{
    var hashes = {'phash' : phash, 'ldhash' : ldhash, 'shash' : shash};

    $.ajax(
        {
            type: 'GET',
            url: '../together/objects/livedata.php',
            data: hashes,
            success: function(data){
                var json = jQuery.parseJSON(data);
                
                $('#currentGame').html(json.current_game);
                $('#currentGameDescription').html(json.current_game_descripton);
                
                if ($('#alert').html() != json.alert) {
                	if (json.alert != "") {
                		$('#noteSound')[0].play();
                	}
                	
                	$('#alert').html(json.alert);
                	$('#alert').show('fast');
                }
                
                $('#alert').html(json.alert);
                
                $('#pollsBox').html(json.polls);
                $('#serversBox').html(json.servers);
                
                updatePage(json.phash, json.ldhash, json.shash);
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