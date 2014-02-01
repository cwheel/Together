function updatePage(hash)
{
    var queryString = {'hash' : hash};

    $.ajax(
        {
            type: 'GET',
            url: '../together/objects/livedata.php',
            data: queryString,
            success: function(data){
                var json = jQuery.parseJSON(data);
                $('#currentGame').html(json.current_game);
                updatePage(json.hash);
            }
        }
    );
}

$(function() {
    updatePage();
});