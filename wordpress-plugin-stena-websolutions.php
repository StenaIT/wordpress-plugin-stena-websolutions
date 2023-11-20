<?php
/*
Plugin Name: Wordpress Utilities | Web Solutions
Description: Generic helper functions to adhere to our Wordpress sites.
Version: 1.1.0
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
            Does: removes the concat of scripts
            Why: vulnerable for DOS-attacks. This also requires denying with htaccess
            Read more: https://nvd.nist.gov/vuln/detail/CVE-2018-6389
        */
        define('CONCATENATE_SCRIPTS', false);

        /*
            Does: ManageWP needs this for php8> to be able to take backups etc
            Why: Backup did not work, and ticket make with ManageWP gave us this solution
        */
        define('FS_METHOD', 'direct');

        /*
            Does: ManageWP needs this for php8> to be able to take backups etc
            Why: Backup did not work, and ticket make with ManageWP gave us this solution
        */
        define('WP_MEMORY_LIMIT', getenv('PHP_MEMORY_LIMIT') ?: '512M');

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
