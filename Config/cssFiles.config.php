<?php
/**
 * Custom CSS Files to enqueue
 *
 *
 * Datas Structure
 *
 * [
 *     'handle'         => CSS file Identifier
 *     'path'           => CSS file path
 *     'dependencies'   => CSS Files dependencies
 *     'version'        => CSS File version
 *     'media'          => CSS file active on media
 * ];
 *
 * You can use "miaow_css_files" filter to add CSS Files on enqueue process
 *
 */
return apply_filters('miaow_css_files', [
    /**
     * Here an example to enqueue a CSS file
     *
     */

    /*
    [
        'handle'        => 'miaow-main-stylesheet',
        'path'          => CSS_PATH . '/app.css',
        'dependencies'  => [],
        'version'       => '2.0.0',
        'media'         => 'all'
    ],
    */
]);
