<?php
namespace Miaow\Controllers;

use \Timber;

/**
 * Custom Post type "Book" Controller (Create for example)
 *
 */
class BookController extends BasicController
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Here an example of Render function override
     *
     */
    public function render()
    {
        if (is_archive()) {
            // Archive stuff
        } else {
            // Get Template vars
            $context = Timber::get_context();
            $post = new \TimberPost();
            $context['post'] = $post;
            // Render Template
            Timber::render('pages/single-book.twig', $context);
        }
    }
}
