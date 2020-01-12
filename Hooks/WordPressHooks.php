<?php
namespace Miaow\Hooks;

use Miaow\Helpers\PostTypeHelper;

// Include Constants
require_once(get_template_directory() . '/Config/constants.config.php');

/**
 * Contains WordPress Hooks
 *
 */
class WordPressHooks
{
    public function __construct()
    {
        // On WP Init
        add_action('init', [$this, 'onWPInit']);
        // Allowed upload mimes
        add_action('upload_mimes', [$this, 'allowedUploadMimes']);
        // Disable Block editor for posts
        add_filter('use_block_editor_for_post', '__return_false', 10);
        // Disable Block editor for post types
        add_filter('use_block_editor_for_post_type', '__return_false', 10);
        // Disable "Try Guntenberg" Panel
        remove_filter('try_gutenberg_panel', 'wp_try_gutenberg_panel');
        // After theme Set-up
        add_action('after_setup_theme', [$this, 'onThemeSetUp']);
        // On WP loaded
        add_action('wp_loaded', [$this, 'onWPLoaded']);
        // Enqueue Scripts
        add_action('wp_enqueue_scripts', [$this, 'enqueueJavascriptFiles']);
        add_action('wp_enqueue_scripts', [$this, 'enqueueStylesheets']);
        // Theme templates
        add_filter('theme_templates', [$this, 'loadCustomTemplates'], 100, 4);
    }

    /**
     * Called on WordPress Init
     *
     * @return void
     */
    public function onWPInit()
    {
        // Load Custom Post Types
        PostTypeHelper::registerPostTypes();
    }

    /**
     * Update Mime types allowed by WordPress
     *
     * @param array $fileTypes : File types
     *
     * @return array
     */
    public function allowedUploadMimes($fileTypes)
    {
        $newFileTypes = [];
        $newFileTypes['svg'] = 'image/svg+xml';
        $fileTypes = array_merge($fileTypes, $newFileTypes);
        return $fileTypes;
    }

    /**
     * Called on Theme set up
     *
     * @return void
     */
    public function onThemeSetUp()
    {
        // Include i18n support
        load_theme_textdomain(LANG_DOMAIN, THEME_PATH . '/Languages');
        // Include menus configuration
        $menus = require(THEME_PATH . '/Config/menus.config.php');
        // Register menus to WordPress
        register_nav_menus($menus);
        // Register Images custom sizes
        $this->registerImagesConfiguration();
        // Theme support
        add_theme_support('title-tag');
        add_theme_support('post-formats');
        add_theme_support('post-thumbnails');
        add_theme_support('menus');
        add_theme_support('html5', ['comment-list', 'comment-form', 'search-form', 'gallery', 'caption']);
    }

    /**
     * Called when WordPress loaded
     *
     * @return void
     */
    public function onWPLoaded()
    {
    }

    /**
     * Enqueue Javascript files
     *
     * @return void
     */
    public function enqueueJavascriptFiles()
    {
        $jsFiles = require THEME_PATH . '/Config/javascriptFiles.config.php';
        if (!empty($jsFiles)) {
            foreach ($jsFiles as $jsFile) {
                if (!empty($jsFile['path'])) {
                    // Enqueue script to WordPress
                    wp_enqueue_script(
                        (!empty($jsFile['handle'])) ? $jsFile['handle'] : 'jsfile-' . microtime(),
                        $jsFile['path'],
                        (!empty($jsFile['dependencies']) && is_array($jsFile['dependencies'])) ? $jsFile['dependencies'] : [],
                        (!empty($jsFile['version'])) ? $jsFile['version'] : '',
                        (!empty($jsFile['in_footer'])) ? $jsFile['in_footer'] : false
                    );
                }
            }
        }
        // Add JS Vars
        if (!empty($jsFiles[0])) {
            ob_start();
            require THEME_PATH . '/Config/javascriptVars.config.php';
            $jsVars = ob_get_clean();
            wp_add_inline_script($jsFiles[0]['handle'], $jsVars, 'before');
        }
    }

    /**
     * Enqueue Stylesheets files
     *
     * @return void
     */
    public function enqueueStylesheets()
    {
        $cssFiles = require THEME_PATH . '/Config/cssFiles.config.php';
        if (!empty($cssFiles)) {
            foreach ($cssFiles as $cssFile) {
                if (!empty($cssFile['path'])) {
                    $fileId = (!empty($cssFile['handle'])) ? $cssFile['handle'] : 'cssfile-' . microtime();
                    wp_register_style(
                        $fileId,
                        $cssFile['path'],
                        (!empty($cssFile['dependencies'])) ? $cssFile['dependencies'] : [],
                        (!empty($cssFile['version'])) ? $cssFile['version'] : '',
                        (!empty($cssFile['media'])) ? $cssFile['media'] : 'all'
                    );
                    wp_enqueue_style($fileId);
                }
            }
        }
    }

    /**
     * Register images configuration
     *
     * @return void
     */
    public function registerImagesConfiguration()
    {
        $imagesConfiguration = require THEME_PATH . '/Config/images.config.php';
        if (!empty($imagesConfiguration)) {
            foreach ($imagesConfiguration as $imageConfiguration) {
                if (!empty($imageConfiguration['image_id'])) {
                    add_image_size(
                        $imageConfiguration['image_id'],
                        $imageConfiguration['width'],
                        $imageConfiguration['height'],
                        (!empty($imageConfiguration['crop'])) ? $imageConfiguration['crop'] : false
                    );
                }
            }
        }
    }

    /**
     * Load Custom templates
     *
     * @param array $post_templates : WP Custom templates loaded
     * @param object $theme : WP Theme Object
     * @param object $post : WP Post Object
     * @param string $post_type : WP Post type
     *
     * @return array
     */
    public function loadCustomTemplates($post_templates, $theme, $post, $post_type)
    {
        $customTemplates = require THEME_PATH . '/Config/customTemplates.config.php';
        if (!empty($customTemplates)) {
            foreach ($customTemplates as $postType => $postTypeCustomTemplates) {
                if ($post_type == $postType) {
                    $post_templates = array_merge($post_templates, $postTypeCustomTemplates);
                }
            }
        }
        return $post_templates;
    }
}
