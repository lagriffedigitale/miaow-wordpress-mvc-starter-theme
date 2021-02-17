<?php
/**
 * Custom image sizes
 *
 *
 * Datas Structure
 *
 * [
 *    'image_id'    => custom image size's identifer
 *    'width'       => image's width
 *    'height'      => image's height
 *    'crop'        => do you want to crop this image ?
 * ];
 *
 * You can use "miaow_images_configuration" filter to change custom image sizes
 *
 */
return apply_filters('miaow_images_configuration', [
    [
        'image_id'  => 'miaow_thumb_xsmall',
        'width'     => 320,
        'height'    => 190,
        'crop'      => false
    ],
    [
        'image_id'  => 'miaow_thumb_small',
        'width'     => 420,
        'height'    => 250,
        'crop'      => false
    ],
    [
        'image_id'  => 'miaow_thumb_small_large',
        'width'     => 570,
        'height'    => 340,
        'crop'      => false
    ],
    [
        'image_id'  => 'miaow_thumb_medium',
        'width'     => 760,
        'height'    => 450,
        'crop'      => false
    ],
    [
        'image_id'  => 'miaow_thumb_medium_large',
        'width'     => 960,
        'height'    => 570,
        'crop'      => false
    ],
    [
        'image_id'  => 'miaow_thumb_large',
        'width'     => 1280,
        'height'    => 760,
        'crop'      => false
    ],
    [
        'image_id'  => 'miaow_thumb_xlarge',
        'width'     => 1680,
        'height'    => 1000,
        'crop'      => false
    ],
    [
        'image_id'  => 'miaow_thumb_retina',
        'width'     => 1920,
        'height'    => 1140,
        'crop'      => false
    ],
]);
