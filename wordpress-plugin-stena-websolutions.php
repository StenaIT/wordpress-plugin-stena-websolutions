<?php
/*
Plugin Name: Wordpress Utilities | Web Solutions
Description: Generic helper functions to adhere to our Wordpress sites.
Version: 1.1.4
Author: Web Solutions
*/

namespace SwsHelperPlugin;

if (!defined('ABSPATH')) exit;

require_once __DIR__ . '/classes/antispambot.php';

use SwsHelperPlugin\classes\AntiSpamBot;

class Main
{
    public static function init()
    {
        AntiSpamBot::init();

        /*
            Does: disable xmlrpc
            Why: vulnerable to hack attacks, like DDoS and brute force attacks. The PHP file also tends to use up a lot of your server resources, making your website super slow.
            Read more: https://www.scottbrownconsulting.com/2020/03/two-ways-to-fully-disable-wordpress-xml-rpc/
            
            Every site should already use the method of disabling xmlrpc in the .htaccess, but this is another fallback for the same thing.
        */
        add_filter('xmlrpc_methods', function ($methods) {
            return [];
        });
    }
}


Main::init();
