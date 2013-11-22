// Test the Lunr Virus Homepage
casper.test.begin("Lunr Spark Twitter - Get bearer access token of Twitter app", function suite(test){

    casper.start("http://infest.lunr.nl/~dinos/virus/twitter", function(){
        this.click('div[id="get_bearer_token"]');
    });

    casper.then(function(){
        this.fill('form[id="api_request"]', {
            user_agent: apikeys["twitter"]["user_agent"],
            consumer_key: apikeys["twitter"]["consumer_key"],
            consumer_secret: apikeys["twitter"]["consumer_secret"]
        }, true);
        this.waitForResource("twitter/get_bearer_token");
    });

    casper.then(function(){
        test.assertEvalEquals(function(){
            return __utils__.findOne('#json_display_result').innerText;
        }, '200', "get_bearer_token request successful");

        test.assertEvalEquals(function(){
            return __utils__.findOne('#json_display_access_token').innerText;
        }, apikeys["twitter"]["bearer_token"], "Bearer Access Token is correct");
    });

    casper.run(function(){
        test.done();
    });

});