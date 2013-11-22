// Test the Lunr Virus Homepage
casper.test.begin("Lunr Spark Twitter - Search for tweets", function suite(test){

    casper.start("http://infest.lunr.nl/~dinos/virus/twitter", function(){
        this.click('div[id="search_tweets"]');
    });

    casper.then(function(){
        this.fill('form[id="api_request"]', {
            bearer_token: apikeys["twitter"]["bearer_token"],
            params: apikeys["twitter"]["params"]
        }, true);
        this.waitForResource("twitter/search_tweets");
    });

    casper.then(function(){
        test.assertEvalEquals(function(){
            return __utils__.findOne('#json_display_result').innerText;
        }, '200', "get_bearer_token request successful");

        test.assertEvalEquals(function(){
            return __utils__.findOne('#json_display_tweets').innerText;
        }, '[object Object],[object Object]', 'Search returns exactly 2 objects as it was set.');
    });

    casper.run(function(){
        test.done();
    });

});