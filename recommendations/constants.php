<?php
/*
    Web Solutions recommended sonstants, use Config::define, or Config::Config::define. Depending on vanilla WP or bedrock etc
    WP constants shall be in wp-config.php, or in application.php if in Bedrock etc.

    Code below uses the bedrock way, with Config::define, as well as env instead of the native php function of getenv()
*/
// <stena-websolutions-additions>
/*
        Does: Revisions helps editor go to a backup
        Why: A good help, but also needed for ACF to be more competent in Previews. Avoid true, since that can make databases large in long term
*/
// Config::define('WP_POST_REVISIONS', env('WP_POST_REVISIONS') ?? 5);
/*
        Does: removes the concat of scripts
        Why: vulnerable for DOS-attacks. This also requires denying with htaccess
        Read more: https://nvd.nist.gov/vuln/detail/CVE-2018-6389
*/
// Config::define('CONCATENATE_SCRIPTS', false);

/*
        Does: ManageWP needs this for php8> to be able to take backups etc
        Why: Backup did not work, and ticket make with ManageWP gave us this solution
    
*/
// Config::define('FS_METHOD', 'direct');

/*
        Does: Sets a limit of memory to be assined
        Why: May be different depending on application
*/
// Config::define('WP_MEMORY_LIMIT', env('PHP_MEMORY_LIMIT') ?? '512M');

/*
        Does: Removes posts in trash
        Why: To be able to keep the database more tidy
*/
// Config::define('EMPTY_TRASH_DAYS', 30);
// </stena-websolutions-additions>