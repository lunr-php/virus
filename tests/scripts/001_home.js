// Test the Lunr Virus Homepage
casper.test.begin("Lunr Virus Homepage has tiles", function suite(test){

    casper.start("http://infest.lunr.nl/", function(){
        test.assertTitle("Ground Zero | Lunr Spark", "Virus Homepage title is the one expected");
        test.assertExists('div[id="grid"]', "Tile grid is present");
        test.assertElementCount('div[id="grid"] div[class="box"]', 3, "Homepage has 3 tiles");
    });

    casper.run(function(){
        test.done();
    });

});
