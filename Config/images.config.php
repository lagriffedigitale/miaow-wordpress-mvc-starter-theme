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
    /**
     * Here an example to add a custom image size
     *
     */

    /*
    [
        'image_id'  => 'miaow_thumbnail',
        'width'     => '480',
        'height'    => '280',
        'crop'      => TRUE
    ]
    */
]);
