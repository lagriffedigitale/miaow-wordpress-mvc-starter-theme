<?php
namespace Miaow\Controllers;

use Miaow\Controllers\Starter;
use \Timber;

/**
 * Starter Theme Basic Controller
 *
 * This controller starts project and manage WordPress Override
 *
 */

class BasicController
{
    public function __construct()
    {
    }

    /**
     * Start theme
     *
     * Check Timber librairy exists and fire Starter Controller to install theme
     */
    public function initTheme()
    {
        $timber = new \Timber\Timber();
        if (!class_exists('Timber')) {
            add_action('admin_notices', function() {
                print '<div class="error">';
                print '<p>' . __('Timber library is not activated. Be sure to install composer or install Timber Plugin', LANG_DOMAIN) . '</p>';
                print '</div>';
            });
        } else {
            // Start Website with TimberSite Configuration
            $starter = new Starter();
            // Override Templating hierarchy to use MVC pattern
            $currentController = $this->overrideTemplateHierarchy();
            if (is_object($currentController)) {
                // Render loaded controller
                $currentController->render();
            }
        }
    }

    /**
     * Override WordPress Template hierarchy to use Starter LGD Hierarchy
     *
     * @return string Controller to use
     */
    public function overrideTemplateHierarchy()
    {
        return $this->loadController();
    }

    /**
     * Check page type (Front / Single / Archive / ...) to load the good Controller
     *
     * @return object $ctrlToLoad : loaded controller
     */
    private function loadController()
    {
        global $wp_query;
        $ctrlToLoad = '';
        // Single Template
        if (is_single()) {
            global $post;
            $postType = get_post_type($post);
            if (!empty($postType) && file_exists(CTRL_PATH . '/' . ucfirst($postType) . 'Controller.php')) {
                $className = 'Miaow\Controllers\\' . ucfirst($postType) . 'Controller';
                $ctrlToLoad = new $className();
            } elseif (file_exists(CTRL_PATH . '/SingleController.php')) {
                $ctrlToLoad = new SingleController();
            }
        }
        // Page Template
        if (is_page()) {
            if (file_exists(CTRL_PATH . '/PageController.php')) {
                $ctrlToLoad = new PageController();
            }
        }
        // Front page
        if (is_front_page()) {
            if (file_exists(CTRL_PATH . '/FrontController.php')) {
                $ctrlToLoad = new FrontController();
            }
        }
        // Archive
        if (is_archive() || is_category()) {
            if (file_exists(CTRL_PATH . '/ArchiveController.php')) {
                $ctrlToLoad = new ArchiveController();
            }
            // Check if is linked to a CPT to centralize render functon
            $currentCategory = get_queried_object();
            if (!empty($currentCategory)) {
                // Archive case
                if (!empty($currentCategory->name)) {
                    if (file_exists(CTRL_PATH . '/' . ucfirst($currentCategory->name) . 'Controller.php')) {
                        $className = 'Miaow\Controllers\\' . ucfirst($currentCategory->name) . 'Controller';
                        $ctrlToLoad = new $className();
                    }
                }
                // Category case
                if (!empty($currentCategory->taxonomy) && !empty($currentCategory->term_id) && term_exists($currentCategory->term_id, $currentCategory->taxonomy)) {
                    $taxonomy = get_taxonomy($currentCategory->taxonomy);
                    $linkedObjects = $taxonomy->object_type;
                    if (!empty($linkedObjects)) {
                        foreach ($linkedObjects as $linkedObject) {
                            if (file_exists(CTRL_PATH . '/' . ucfirst($linkedObject) . 'Controller.php')) {
                                $className = 'Miaow\Controllers\\' . ucfirst($linkedObject) . 'Controller';
                                $ctrlToLoad = new $className();
                            }
                        }
                    }
                }
            }
        }
        // Search
        if (is_search()) {
            if (file_exists(CTRL_PATH.'/SearchController.php')) {
                $ctrlToLoad = new SearchController();
            }
        }
        // 404
        if (is_404() || empty($ctrlToLoad)) {
            if (file_exists(CTRL_PATH.'/Error404Controller.php')) {
                $ctrlToLoad = new Error404Controller();
            }
        }
        return apply_filters('lgd_controller_loaded', $ctrlToLoad);
    }

    /**
     * Render Template
     *
     **/
    public function render() {
        $context = Timber::get_context();
        $context = apply_filters('miaow_render_context', $context);

        if (is_single()) {
            $post = new Timber\Post();
            $context['post'] = $post;
            $customTemplate = get_post_meta($post->ID, '_wp_page_template', TRUE);
            Timber::render(
                'pages/' . ((!empty($customTemplate) && 'default' != $customTemplate) ? $customTemplate : 'single.twig'),
                $context
            );
        } elseif (is_page()) {
            $post = new Timber\Post();
            $context['post'] = $post;
            $customTemplate = get_post_meta($post->ID, '_wp_page_template', TRUE);
            Timber::render(
                'pages/' . ((!empty($customTemplate) && 'default' != $customTemplate) ? $customTemplate : 'page.twig'),
                $context
            );
        } elseif (is_archive() || is_category()) {
            $context['posts'] = new Timber\PostQuery();
            Timber::render('pages/archive.twig', $context);
        } elseif (is_search()) {
            $context['posts'] = new Timber\PostQuery();
            Timber::render('pages/search-results.twig', $context);
        } elseif (is_404()) {
            Timber::render('pages/404.twig', $context);
        }
    }
}
