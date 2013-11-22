// Test the Lunr Virus Homepage
casper.test.begin("Lunr Spark LinkedIn Module Tests", function suite(test){

    casper.start("http://infest.lunr.nl/", function(){
        test.assertExists('div[id="linkedin"]', "LinkedIn tile is present on Homepage");
    });

    casper.run(function(){
        test.done();
    });

});