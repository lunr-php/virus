// Test the Lunr Virus Homepage
casper.test.begin("Lunr Spark Twitter Module Tests", function suite(test){

    casper.start("http://infest.lunr.nl/~dinos/virus", function(){
        test.assertExists('div[id="twitter"]', "Twitter tile is present on Homepage");
        this.click('div[id="twitter"]');
    });

    casper.then(function(){
        test.assertTitle("Twitter | Lunr Spark", "Virus Twitter title is the one expected");
        test.assertExists('div[class="methods"]', "Method list is present");
        test.assertElementCount('div[class="methods"] div[class="method"]', 2, "Twitter has 2 api methods available");
    });

    casper.run(function(){
        test.done();
    });

});
