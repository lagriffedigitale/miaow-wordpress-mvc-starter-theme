<?php
namespace Miaow\Controllers;

use \Timber;

/**
 * Front page controller
 *
 */
class FrontController extends BasicController
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Render Template
     **/
    public function render()
    {
        // Get Template vars
        $context = Timber::get_context();
        $post = new \TimberPost();
        $context['post'] = $post;
        // Render Template
        $customTemplate = get_post_meta($post->ID, '_wp_page_template', true);
        Timber::render(
            'pages/' . ((!empty($customTemplate) && 'default' != $customTemplate) ? $customTemplate : 'front.twig'),
            $context
        );
    }
}
