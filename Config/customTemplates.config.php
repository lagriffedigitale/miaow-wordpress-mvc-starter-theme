<?php
/**
 * Current post custom templates
 *
 *
 * Datas Structure
 *
 * [post_type_identifier] => [
 *    // List of templates
 *    template twig file => Name of template
 * ];
 *
 * You can use "miaow_custom_templates" filter to change custom Post types Templates
 *
 */
return apply_filters('miaow_custom_templates',[

    /**
     * Here an example to add a custom template linked with post type
     *
     */

    /*
    'page'  => [
        'contact-page.twig' => 'Contact page',
    ]
    */
]);
