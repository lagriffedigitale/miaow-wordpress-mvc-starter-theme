<?php
/**
 * Custom menus endpoint
 *
 *
 * Datas Structure
 *
 * [
 *     'menu_id' => Menu name
 * ];
 *
 * You can use "miaow_menus_list" filter to change load custom menus endpoint
 *
 */
return apply_filters('miaow_menus_list', [
    'main-menu'     => __('Main menu', 'miaow'),
    'footer-menu'   => __('Footer menu', 'miaow')
]);
