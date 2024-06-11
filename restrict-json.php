<?php
/**
 * Plugin main file.
 * @package   KaliLinuxCode\Restrict Json
 * @copyright 2024 KaliLinuxCode
 * @license   https://www.apache.org/licenses/LICENSE-2.0 Apache License 2.0
 * @link      KaliLinuxCode.Com
 * @wordpress-plugin
 * Plugin Name:       Restrict Json By KaliLinuxCode
 * Plugin URI:        KaliLinuxCode.Com
 * Description:       Restricts access to specific REST API endpoints by unauthenticated users or visitors
 * Version:           1
 * Requires at least: 5.2
 * Requires PHP:      7.4
 * Author:            KaliLinuxCode
 * License:           Apache License 2.0
 * License URI:       https://www.apache.org/licenses/LICENSE-2.0
*/

function restrict_all_rest_api_access($access) {
    // Check if the request is for a REST API endpoint
    if (strpos($_SERVER['REQUEST_URI'], rest_get_url_prefix()) !== false) {
        // Allow access for logged-in users
        if (is_user_logged_in()) {
            return $access;
        } else {
            // Redirect non-logged-in users to custom error page
            wp_safe_redirect(home_url('/Page_Not_Found'));
            exit;
        }
    }

    // Allow access for other requests
    return $access;
}

add_filter('rest_authentication_errors', 'restrict_all_rest_api_access');
