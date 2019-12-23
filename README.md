# Miaow : WordPress starter theme based on MVC pattern
Miaow is a WordPress starter theme based on MVC pattern and Timber library. There is no render stuff but just a skeleton to work on MVC pattern with a WordPress theme.

![alt text](https://raw.githubusercontent.com/lagriffedigitale/miaow-wordpress-mvc-starter-theme/master/screenshot.png "Miaow WordPress Theme")

## Configuration
All configuration is in "Config" folder. Here you can find and add Custom Post Type definition, Menus endpoints, Javascript or CSS files to enqueue, images sizes and constants variables to use.

### Constant variable
You can edit this file (constants.config.php) to add your PHP Constant variables like Google Maps API key for example.

### CSS Files to enqueue
cssFiles.config.php is the file where to must add your CSS Files to enqueue to theme. You need to respect a datas structure based on PHP array.  
An example :  
`
[  
    'handle'        => 'miaow-main-stylesheet',
    'path'          => CSS_PATH . '/app.css',
    'dependencies'  => [],
    'version'       => '2.0.0',  
    'media'         => 'all'  
]  
`
