![alt text](https://raw.githubusercontent.com/lagriffedigitale/miaow-wordpress-mvc-starter-theme/master/screenshot.png "Miaow - Model-View-Controller WordPress starter theme")  

# Miaow : WordPress starter theme based on MVC pattern
Miaow is a WordPress starter theme based on MVC pattern (Model View Controller) and Timber library. There is no render stuff but just a skeleton to work on MVC pattern with a WordPress theme.

## Configuration
All configuration is in "Config" folder. Here you can find and add Custom Post Type definition, Menus endpoints, Javascript or CSS files to enqueue, images sizes and constants variables to use.

### Constant variables
You can edit this file (constants.config.php) to add your PHP Constant variables like Google Maps API key for example.

### CSS files to enqueue
cssFiles.config.php is the file where to must add your CSS Files to enqueue to theme. You need to respect a datas structure based on PHP array. In this file, you can find an example and you can use "miaow_css_files" hook-filter to add CSS files to enqueue from a custom plugin or an other file.

### Custom templates
One of the very handy features of WordPress are the  Custom templates. From your backend, you can select if you want to use an other template file for your content. You need to declare custom templates by post types. In customTemplates.config.php, you can add your custom template reference.  
You'll find an example for a "Contact page" to understand the datas structure. Then, you can use "miaow_custom_templates" hook-filter to add custom template from an other file.

### Javascript files to enqueue
cssFiles.config.php is the file where to must add your CSS Files to enqueue to theme. You need to respect a datas structure based on PHP array. In this file, you can find an example and you can use "miaow_css_files" filter to add CSS files to enqueue from a custom plugin or an other file.
