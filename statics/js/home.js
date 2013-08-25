$(function(){
    $("#grid").mason({
        itemSelector: ".box",
        sizes: [
            [1,1]
        ],
        columns: [
            [0,600,1],
            [600,900,2],
            [900,1200,3]
        ],
        layout: 'fluid',
    });
});
