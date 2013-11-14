// Test the Lunr Virus Homepage
casper.test.begin("Lunr Spark Facebook - Get profile of authenticated user without special permissions requested", function suite(test){

    casper.start("http://infest.lunr.nl/facebook", function(){
        test.assertNotEquals(apikeys["facebook"]["access_token"], '', "Access token not empty");

        this.click('div[id="get_user_profile"]');
    });

    casper.then(function(){
        this.fill('form[id="api_request"]', {
            app_id: apikeys["facebook"]["app_id"],
            app_secret: apikeys["facebook"]["app_secret"],
            token: apikeys["facebook"]["access_token"]
        }, true);
        this.waitForResource("facebook/get_user_profile");
    });

    casper.then(function(){
        test.assertEvalEquals(function(){
            return __utils__.findOne('#json_display_result').innerText;
        }, '200', "get_user_profile request successful");

        test.assertEvalEquals(function(){
            return __utils__.findOne('#json_display_id').innerText;
        }, '100006580243910', "Fetched ID is correct");

        test.assertEvalEquals(function(){
            return __utils__.findOne('#json_display_name').innerText;
        }, 'Dick Amfehjbdciaj Liangsky', "Fetched full name is correct");

        test.assertEvalEquals(function(){
            return __utils__.findOne('#json_display_first_name').innerText;
        }, 'Dick', "Fetched first name is correct");

        test.assertEvalEquals(function(){
            return __utils__.findOne('#json_display_middle_name').innerText;
        }, 'Amfehjbdciaj', "Fetched middle name is correct");

        test.assertEvalEquals(function(){
            return __utils__.findOne('#json_display_last_name').innerText;
        }, 'Liangsky', "Fetched last name is correct");

        test.assertEvalEquals(function(){
            return __utils__.findOne('#json_display_gender').innerText;
        }, 'male', "Fetched gender is correct");

        test.assertEvalEquals(function(){
            return __utils__.findOne('#json_display_locale').innerText;
        }, 'en_US', "Fetched locale is correct");

        test.assertEvalEquals(function(){
            return __utils__.findOne('#json_display_link').innerText;
        }, 'https://www.facebook.com/profile.php?id=100006580243910', "Fetched link to profile on facebook is correct");

        test.assertEvalEquals(function(){
            return __utils__.findOne('#json_display_updated_time').innerText;
        }, '2013-09-21T14:55:33+0000', "Fetched time for last update of profile is correct");

        test.assertEvalEquals(function(){
            return __utils__.findOne('#json_display_timezone').innerText;
        }, '1', "Fetched timezone is correct");

        unavailable = [
            "username", "age_range", "third_party_id", "installed", "verified", "currency", "cover",
            "devices", "payment_pricepoints", "payment_mobile_pricepoints", "video_upload_limits"
        ];

        for (var i = 0; i < unavailable.length; i++){
            test_val = this.evaluate(function(value){
                return __utils__.findOne("#json_display_" + value).innerText;
            }, unavailable[i]);

            test.assertEquals(test_val, "E1", unavailable[i] + " is not available");
        }

        not_requested = [ "security_settings", "picture" ];

        for (var i = 0; i < not_requested.length; i++){
            test_val = this.evaluate(function(value){
                return __utils__.findOne("#json_display_" + value).innerText;
            }, not_requested[i]);

            test.assertEquals(test_val, "E2", not_requested[i] + " was not requested");
        }

        denied = [
            "languages", "bio", "quotes", "birthday", "education", "email", "hometown", "interested_in",
            "location", "political", "religion", "favorite_athletes", "favorite_teams", "relationship_status",
            "significant_other", "website", "work"
        ];

        for (var i = 0; i < denied.length; i++){
            test_val = this.evaluate(function(value){
                return __utils__.findOne("#json_display_" + value).innerText;
            }, denied[i]);

            test.assertEquals(test_val, "E3", "Access to " + denied[i] + " was denied");
        }

    });

    casper.run(function(){
        test.done();
    });

});
