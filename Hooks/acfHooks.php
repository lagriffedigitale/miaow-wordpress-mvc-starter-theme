<?php
namespace Miaow\Hooks;

// Include Constants
require_once(get_template_directory() . '/Config/constants.config.php');

/**
 * Contains Advandced Custom Fields Hooks
 *
 **/
class acfHooks
{
    public function __construct()
    {
        // On ACF Init
        add_action('acf/init', [$this, 'onACFInit']);
        // On ACF Save JSON (Synchronise Fields)
        add_filter('acf/settings/save_json', [$this, 'onACFSaveFields']);
        // On ACF Load JSON (Synchronise Fields)
        add_filter('acf/settings/load_json', [$this, 'onACFLoadFields']);
    }

    /**
     * Called on ACF Init
     *
     * @return void
     */
    public function onACFInit()
    {
        // Google Maps API key
        acf_update_setting('google_api_key', GOOGLE_MAPS_API_KEY);
    }

    /**
     * Change ACF JSON Fields path
     *
     * @param string $path
     *
     * @return string $path
     */
    public function onACFSaveFields($path)
    {
        $path = FIELDS_PATH;
        return $path;
    }

    /**
     * Change ACF JSON Fields path
     *
     * @param string $paths
     *
     * @return string $paths
     */
    public function onACFLoadFields($paths)
    {
        // remove original path (optional)
        unset($paths[0]);
        // append path
        $paths[] = FIELDS_PATH;
        return $paths;
    }
}
