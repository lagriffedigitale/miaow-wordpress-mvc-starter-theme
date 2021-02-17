<?php
/**
 * Custom Javascript Files to enqueue
 *
 *
 * Datas Structure
 *
 * [
 *     'handle'         => JS file Identifier
 *     'path'           => JS file path
 *     'dependencies'   => JS Files dependencies
 *     'version'        => JS File version
 *     'in_footer'      => JS file loaded in footer
 * ];
 *
 * You can use "miaow_js_files" filter to change Javascript files loaded
 *
 */
return apply_filters('miaow_js_files', [
    [
        'handle'        => 'miaow-main-js',
        'path'          => JS_PATH . '/app.js',
        'dependencies'  => ['jquery', 'masonry'],
        'version'       => '2.0.0',
        'in_footer'     => true
    ]
]);
