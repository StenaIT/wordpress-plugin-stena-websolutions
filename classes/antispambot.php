<?php

namespace SwsHelperPlugin\classes;

/*
    Works for ACF generated sites, with the WYSIWYG-editor.
    Todo: Can test this, to make sure that you can call these funtions from arbitrary code as well
*/

class AntiSpamBot
{

    public static function init()
    {
        add_filter('acf/format_value', 'SwsHelperPlugin\classes\AntiSpamBot::apply_custom_filter_to_acf_wysiwyg', 10, 3);
    }

    public static function custom_antispambot_content($content)
    {
        // Regular expression pattern to match email addresses
        $email_pattern = '/[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}/';

        // Regular expression pattern to match tel: links with the number and label
        $tel_pattern = '/<a[^>]+href=["\']tel:([^"\']+)["\'][^>]*>(.*?)<\/a>/i';

        // Replace email addresses with antispambot() obfuscated versions
        $content = preg_replace_callback($email_pattern, 'SwsHelperPlugin\classes\AntiSpamBot::custom_replace_email_with_antispambot', $content);

        // Replace tel: links with antispambot() obfuscated versions
        $content = preg_replace_callback($tel_pattern, 'SwsHelperPlugin\classes\AntiSpamBot::custom_replace_tel_with_antispambot', $content);

        return $content;
    }

    public static function custom_replace_email_with_antispambot($matches)
    {
        $email = $matches[0];
        return antispambot($email);
    }

    public static function custom_replace_tel_with_antispambot($matches)
    {
        $tel = $matches[1];
        $label = $matches[2];
        return '<a href="tel:' . antispambot($tel) . '">' . antispambot($label) . '</a>';
    }


    public static function apply_custom_filter_to_acf_wysiwyg($value, $post_id, $field)
    {
        if ($field['type'] === 'wysiwyg') {
            $value = self::custom_antispambot_content($value);
        }
        return $value;
    }
}
