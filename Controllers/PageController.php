<?php
namespace Miaow\Controllers;

use \Timber;

/**
 * Page controller
 *
 */
class PageController extends BasicController
{
    public function __construct()
    {
    }

    /**
     * Render page
     *
     */
    public function render()
    {
        // Get context
        $context = Timber::get_context();
        // Get Template vars and assign to context
        $post = new \TimberPost();
        $context['post'] = $post;
        // Custom ACF Fields
        $context['content_blocks'] = get_field('content_blocks', $post->ID);
        // Custom template is used ?
        $customTemplate = get_post_meta($post->ID, '_wp_page_template', true);
        // Render Twig template
        Timber::render(
            'pages/' . ((!empty($customTemplate) && 'default' != $customTemplate) ? $customTemplate : 'page.twig'),
            $context
        );
    }
}
