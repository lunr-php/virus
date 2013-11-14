// Test the Lunr Virus Homepage
casper.test.begin("Lunr Spark Facebook Module Tests", function suite(test){

    casper.start("http://infest.lunr.nl/", function(){
        test.assertExists('div[id="facebook"]', "Facebook tile is present on Homepage");
        this.click('div[id="facebook"]');
    });

    casper.then(function(){
        test.assertTitle("Facebook | Lunr Spark", "Virus Facebook title is the one expected");
        test.assertExists('div[class="methods"]', "Method list is present");
        test.assertElementCount('div[class="methods"] div[class="method"]', 6, "Facebook has 6 api methods available");
    });

    casper.run(function(){
        test.done();
    });

});
