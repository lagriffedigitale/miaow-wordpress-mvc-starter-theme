<?php
use Miaow\Autoloader;
use Miaow\Helpers\MediaHelper;
use Miaow\Hooks\WordPressHooks;
use Miaow\Hooks\acfHooks;

// Require Constants
require_once(__DIR__ . '/Config/constants.config.php');

// Require Vendor Autoload
require_once(__DIR__ . '/vendor/autoload.php');

// Include Autoloader
require_once(__DIR__ . '/Tools/Autoloader.php');

// Register Autoload
Autoloader::register();

// WordPress Hooks
new WordPressHooks();

// ACF Hooks if ACF Pro is installed
if (is_plugin_active('advanced-custom-fields-pro/acf.php')) {
    new acfHooks();
}

/**
 * Get formatted filesize - Usable from template file
 *
 */
function get_formatted_filesize($bytes)
{
    return MediaHelper::getFormattedFileSize($bytes);
}
