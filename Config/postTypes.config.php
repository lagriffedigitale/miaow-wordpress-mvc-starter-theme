<?php
/**
 * Custom post types to load
 *
 * Check WordPress Codex to know all options
 * https://developer.wordpress.org/reference/functions/register_post_type/#parameters
 *
 */

/**
 * Here an example of "Book" Custom post type definition
 * with taxonomy "Genre"
 *
 */

$postTypes = [];

/*
$postTypes['book'] = [
    'singular_name' => 'book',
    'plural_name'   => 'books',
    'args'          => [
        'menu_icon' => 'dashicons-book-alt',
    ], // CPT args
    'taxonomies'    => [
        'genre' => [
            'singular_name' => 'genre',
            'plural_name'   => 'genres',
            'args'          => [] // Taxonomy args
        ]
    ]
];
*/
return $postTypes;
