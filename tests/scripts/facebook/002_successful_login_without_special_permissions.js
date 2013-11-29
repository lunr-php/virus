// Test the Lunr Virus Homepage
casper.test.begin("Lunr Spark Facebook - Successful login without requesting special permissions", function suite(test){

    casper.start("http://infest.lunr.nl/facebook", function(){
        this.click('div[id="get_login_url"]');
    });

    casper.then(function(){
        this.fill('form[id="api_request"]', {
            app_id: apikeys["facebook"]["app_id"],
            redirect_url: "http://infest.lunr.nl/facebook/get_request_token/"
        }, true);
        this.waitForResource("/facebook/get_login_url");
    });

    casper.then(function(){
        url = this.evaluate(function(){
            return __utils__.findOne('#json_display_url').innerText;
        });

        url_parts = url.split("?");
        query_parts = url_parts[1].split("&");

        values = {};

        for (var i = 0; i < query_parts.length; i++){
            var tmp = query_parts[i].split("=");
            values[tmp[0]] = decodeURIComponent(tmp[1]);
        }

        test.assertTrue(values.hasOwnProperty("client_id"), "Constructed URL has client_id parameter");
        test.assertTrue(values.hasOwnProperty("redirect_uri"), "Constructed URL has redirect_uri parameter");
        test.assertTrue(values.hasOwnProperty("state"), "Constructed URL has state parameter");

        test.assertEquals(values["client_id"], apikeys["facebook"]["app_id"], "Constructed URL uses correct App ID");
        test.assertEquals(values["redirect_uri"], "http://infest.lunr.nl/facebook/get_request_token/", "Constructed URL uses correct redurect_uri");
        test.assertNotEquals(values["state"], "", "Constructed URL has non-empty state");

        apikeys["facebook"]["state"] = values["state"];

        this.open(url);
        this.waitForUrl(/^https:\/\/www.facebook.com\/login.php/);
    });

    casper.then(function(){
        test.assertTitle("Facebook", "Facebook login page loaded");
        test.assertExists('input[id="email"]', "Username/Email input field is present");
        test.assertExists('input[id="pass"]', "Password input field is present");

        this.fill('form[id="login_form"]', {
            email: apikeys["facebook"]["testusers"][0]["username"],
            pass: apikeys["facebook"]["testusers"][0]["password"]
        }, true);

        this.waitForUrl(/^http:\/\/infest.lunr.nl\/facebook\/get_request_token/);
    });

    casper.then(function(){
        test.assertTitle("Facebook | Lunr Spark", "Redirected back to Virus successfully");

        state = this.evaluate(function(){
            return __utils__.findOne('#json_display_state').innerText;
        });

        code = this.evaluate(function(){
            return __utils__.findOne('#json_display_code').innerText;
        });

        test.assertEquals(state, apikeys["facebook"]["state"], "CSRF protection value matches");
        test.assertNotEquals(code, '', "Request token is not empty");

        apikeys["facebook"]["code"] = code;

        this.click('div[id="get_access_token"]');
    });

    casper.then(function(){
        this.fill('form[id="api_request"]', {
            app_id: apikeys["facebook"]["app_id"],
            app_secret: apikeys["facebook"]["app_secret"],
            redirect_url: "http://infest.lunr.nl/facebook/get_request_token/",
            code: apikeys["facebook"]["code"]
        }, true);
        this.waitForResource("facebook/get_access_token");
    });

    casper.then(function(){
        token = this.evaluate(function(){
            return __utils__.findOne('#json_display_token').innerText;
        });

        expires = this.evaluate(function(){
            return __utils__.findOne('#json_display_expires').innerText;
        });

        test.assertNotEquals(token, '', "Access token is not empty");
        test.assert(expires > Math.round(+new Date()/1000), "Access token is still valid");

        apikeys["facebook"]["access_token"] = token;
    });

    casper.run(function(){
        test.done();
    });

});
