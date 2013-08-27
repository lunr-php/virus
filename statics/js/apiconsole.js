$(".method").on("click", function()
{
    $(".params").transition({ left: '254px', width: '350px' });
});

$("#submit_request").on("click", function(){
    $(".output").html('Webservice Output!');
});
