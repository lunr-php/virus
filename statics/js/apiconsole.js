$(".method").on("click", function()
{
    $(".params").transition({ left: '254px', width: '350px' });
    $("#method").val(event.target.id);
    $("#api_request input[type=text]").not("." + event.target.id).hide();
    $("." + event.target.id).show();
});

$("#api_request").submit(function(){
    event.preventDefault();

    var form = $( this );
    var url = form.attr('action').concat($("#method").val());
    var post_data = {};

    $('#api_request *').filter(':input').each(function(key, element){
        if ($(element).attr('type') != 'hidden' && $(element).attr('type') != 'submit')
        {
            post_data[$(element).attr('name')] = $(element).val();
        }
    });

    $.post(url, post_data, function(data){
        var json = $.parseJSON(data);
        var items = [];

        $.each(json, function(key, value) {
            var row = $('<tr></tr>');
            var td1 = $('<td></td>').attr({ class: ["json", "json_key"].join(' ') }).text(key + ':').appendTo(row);
            var td2 = $('<td></td>').attr('class', 'json').attr({ 'id': 'json_display_' + key, 'class': 'json' }).text(value).appendTo(row);

            items.push(row.prop('outerHTML'));
        });

        $("#json_display").html(items.join(''));
    });

});
