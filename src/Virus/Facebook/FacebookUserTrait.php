<?php

/**
 * This file contains a facebook controller trait.
 *
 * PHP Version 5.4
 *
 * @category   Controller
 * @package    Virus
 * @subpackage Facebook
 * @author     Heinz Wiesinger <heinz@m2mobi.com>
 * @copyright  2013-2014, M2Mobi BV, Amsterdam, The Netherlands
 * @license    http://lunr.nl/LICENSE MIT License
 */

namespace Virus\Facebook;

use Lunr\Corona\HttpCode;

/**
 * Facebook trait for user methods.
 *
 * @category   Controller
 * @package    Virus
 * @subpackage Facebook
 * @author     Heinz Wiesinger <heinz@m2mobi.com>
 */
trait FacebookUserTrait
{

    /**
     * Get the facebook user profile.
     *
     * @return void
     */
    public function get_user_profile()
    {
        $app_id     = $this->request->get_post_data('app_id');
        $app_secret = $this->request->get_post_data('app_secret');
        $token      = $this->request->get_post_data('token');
        $userid     = $this->request->get_post_data('userid');
        $fields     = $this->request->get_post_data('fields');

        if ($app_id == '')
        {
            $this->set_result(HttpCode::BAD_REQUEST, 'Missing app_id', 'app_id');
            return;
        }

        if ($app_secret == '')
        {
            $this->set_result(HttpCode::BAD_REQUEST, 'Missing app_secret', 'app_secret');
            return;
        }

        if ($token == '')
        {
            $this->set_result(HttpCode::BAD_REQUEST, 'Missing access token', 'token');
            return;
        }

        $facebook = $this->locator->facebookuserprofile();

        $facebook->app_id       = $app_id;
        $facebook->app_secret   = $app_secret;
        $facebook->access_token = $token;

        if ($userid != '')
        {
            $facebook->set_profile_id($userid);
        }

        if ($fields != '')
        {
            $facebook->set_fields(explode(',', $fields));
        }

        $facebook->get_data();

        $old = error_reporting(0);

        $this->response->add_response_data('id', $facebook->get_id());
        $this->response->add_response_data('name', $facebook->get_name());
        $this->response->add_response_data('first_name', $facebook->get_first_name());
        $this->response->add_response_data('middle_name', $facebook->get_middle_name());
        $this->response->add_response_data('last_name', $facebook->get_last_name());
        $this->response->add_response_data('gender', $facebook->get_gender());
        $this->response->add_response_data('locale', $facebook->get_locale());
        $this->response->add_response_data('link', $facebook->get_link());
        $this->response->add_response_data('username', $facebook->get_username());
        $this->response->add_response_data('age_range', $facebook->get_age_range());
        $this->response->add_response_data('third_party_id', $facebook->get_third_party_id());
        $this->response->add_response_data('updated_time', $facebook->get_updated_time());
        $this->response->add_response_data('timezone', $facebook->get_timezone());
        $this->response->add_response_data('installed', $facebook->get_installed());
        $this->response->add_response_data('verified', $facebook->get_verified());
        $this->response->add_response_data('currency', $facebook->get_currency());
        $this->response->add_response_data('cover', $facebook->get_cover());
        $this->response->add_response_data('devices', $facebook->get_devices());
        $this->response->add_response_data('payment_pricepoints', $facebook->get_payment_pricepoints());
        $this->response->add_response_data('payment_mobile_pricepoints', $facebook->get_payment_mobile_pricepoints());
        $this->response->add_response_data('video_upload_limits', $facebook->get_video_upload_limits());
        $this->response->add_response_data('security_settings', $facebook->get_security_settings());
        $this->response->add_response_data('picture', $facebook->get_picture());
        $this->response->add_response_data('languages', $facebook->get_languages());
        $this->response->add_response_data('bio', $facebook->get_bio());
        $this->response->add_response_data('quotes', $facebook->get_quotes());
        $this->response->add_response_data('birthday', $facebook->get_birthday());
        $this->response->add_response_data('education', $facebook->get_education());
        $this->response->add_response_data('email', $facebook->get_email());
        $this->response->add_response_data('hometown', $facebook->get_hometown());
        $this->response->add_response_data('interested_in', $facebook->get_interested_in());
        $this->response->add_response_data('location', $facebook->get_location());
        $this->response->add_response_data('political', $facebook->get_political());
        $this->response->add_response_data('religion', $facebook->get_religion());
        $this->response->add_response_data('favorite_athletes', $facebook->get_favorite_athletes());
        $this->response->add_response_data('favorite_teams', $facebook->get_favorite_teams());
        $this->response->add_response_data('relationship_status', $facebook->get_relationship_status());
        $this->response->add_response_data('significant_other', $facebook->get_significant_other());
        $this->response->add_response_data('website', $facebook->get_website());
        $this->response->add_response_data('work', $facebook->get_work());

        error_reporting($old);

        $this->set_result(HttpCode::OK);
        $this->response->view = 'jsonview';
    }

}

?>
