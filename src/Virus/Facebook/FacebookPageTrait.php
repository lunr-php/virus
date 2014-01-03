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
 * Facebook trait for page methods.
 *
 * @category   Controller
 * @package    Virus
 * @subpackage Facebook
 * @author     Heinz Wiesinger <heinz@m2mobi.com>
 */
trait FacebookPageTrait
{

    /**
     * Get the facebook user profile.
     *
     * @return void
     */
    public function get_page()
    {
        $app_id     = $this->request->get_post_data('app_id');
        $app_secret = $this->request->get_post_data('app_secret');
        $token      = $this->request->get_post_data('token');
        $pageid     = $this->request->get_post_data('pageid');
        $fields     = $this->request->get_post_data('fields');

        $facebook = $this->locator->facebookpage();

        if (($app_id != '') && ($app_secret == ''))
        {
            $this->set_result(HttpCode::BAD_REQUEST, 'Missing app_secret', 'app_secret');
            return;
        }

        if ($app_id != '')
        {
            $facebook->app_id = $app_id;
        }

        if ($app_secret != '')
        {
            $facebook->app_secret = $app_secret;
        }

        if ($token != '')
        {
            $facebook->access_token = $token;
        }

        if ($pageid != '')
        {
            $facebook->set_page_id($pageid);
        }

        if ($fields != '')
        {
            $facebook->set_fields(explode(',', $fields));
        }

        $facebook->get_data();

        $old = error_reporting(0);

        $this->response->add_response_data('id', $facebook->get_id());
        $this->response->add_response_data('name', $facebook->get_name());
        $this->response->add_response_data('link', $facebook->get_link());
        $this->response->add_response_data('category', $facebook->get_category());
        $this->response->add_response_data('is_published', $facebook->get_is_published());
        $this->response->add_response_data('can_post', $facebook->get_can_post());
        $this->response->add_response_data('likes', $facebook->get_likes());
        $this->response->add_response_data('location', $facebook->get_location());
        $this->response->add_response_data('phone', $facebook->get_phone());
        $this->response->add_response_data('checkins', $facebook->get_checkins());
        $this->response->add_response_data('picture', $facebook->get_picture());
        $this->response->add_response_data('cover', $facebook->get_cover());
        $this->response->add_response_data('website', $facebook->get_website());
        $this->response->add_response_data('talking_about_count', $facebook->get_talking_about_count());
        $this->response->add_response_data('global_brand_parent_page', $facebook->get_global_brand_parent_page());
        $this->response->add_response_data('access_token', $facebook->get_access_token());
        $this->response->add_response_data('hours', $facebook->get_hours());
        $this->response->add_response_data('were_here_count', $facebook->get_were_here_count());
        $this->response->add_response_data('company_overview', $facebook->get_company_overview());

        error_reporting($old);

        $this->set_result(HttpCode::OK);
        $this->response->view = 'jsonview';
    }

}

?>
