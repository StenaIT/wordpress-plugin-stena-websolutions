<?php
/*
Plugin Name: Wordpress Utilities | Web Solutions
Description: Generic helper functions to adhere to our Wordpress sites.
Version: 1.1.2
Author: Web Solutions
*/

namespace SwsHelperPlugin;

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
        */
        function remove_xmlrpc_methods($methods)
        {
            return [];
        }
        add_filter('xmlrpc_methods', 'remove_xmlrpc_methods');
    }
}


Main::init();
