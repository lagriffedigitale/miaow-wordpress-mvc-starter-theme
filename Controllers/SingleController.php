<?php
namespace Miaow\Controllers;

use \Timber;

/**
 * Single post and generic single controller
 *
 */
class SingleController extends BasicController
{
    public function __construct()
    {
    }

    /**
     * Render post
     *
     */
    public function render()
    {
        // Get Template vars and assign to context
        $post = new \TimberPost();
        $context = Timber::get_context();
        $context['post'] = $post;
        // Custom ACF Fields
        $context['content_blocks'] = get_field('content_blocks', $post->ID);
        // Custom template is used ?
        $customTemplate = get_post_meta($post->ID, '_wp_post_template', true);
        // Render Twig template
        Timber::render(
            'pages/' . ((!empty($customTemplate) && 'default' != $customTemplate) ? $customTemplate : 'single.twig'),
            $context
        );
    }
}
