// Test the Lunr Virus Homepage
casper.test.begin("Lunr Spark Twitter Module Tests", function suite(test){

    casper.start("http://infest.lunr.nl", function(){
        test.assertExists('div[id="twitter"]', "Twitter tile is present on Homepage");
    });

    casper.run(function(){
        test.done();
    });

});
