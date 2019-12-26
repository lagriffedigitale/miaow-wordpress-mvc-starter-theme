![alt text](https://raw.githubusercontent.com/lagriffedigitale/miaow-wordpress-mvc-starter-theme/master/screenshot.png "Miaow - Model-View-Controller WordPress starter theme")  

# Miaow : WordPress starter theme based on MVC pattern
Miaow is a WordPress starter theme based on MVC pattern (Model View Controller) and Timber library. There is no render stuff but just a skeleton to work on MVC pattern with a WordPress theme.

## Configuration
All configuration is in "Config" folder. Here you can find and add Custom Post Type definition, Menus endpoints, Javascript or CSS files to enqueue, images sizes and constants variables to use.

### Constant variables
You can edit this file (constants.config.php) to add your PHP Constant variables like Google Maps API key for example.

### CSS files to enqueue
cssFiles.config.php is the file where to must add your CSS Files to enqueue to theme. You need to respect a datas structure based on PHP array.   
In this file, you can find an example and you can use "miaow_css_files" hook-filter to add CSS files to enqueue from a custom plugin or an other file.

### Custom templates
One of the very handy features of WordPress are the  Custom templates. From your backend, you can select if you want to use an other template file for your content. You need to declare custom templates by post types. In customTemplates.config.php, you can add your custom template reference.  
You'll find an example for a "Contact page" to understand the datas structure. Then, you can use "miaow_custom_templates" hook-filter to add custom template from an other file.

### Custom image sizes
You can add your custom image sizes in "images.config.php". You'll find the datas structure in an example in this file. Then, you can use "miaow_images_configuration" hook-filter to add custom image sizes from an other file.

### Javascript files to enqueue
javascriptFiles.config.php is the file where to must add your JS Files to enqueue to theme.   
You need to respect a datas structure based on PHP array.   
In this file, you can find an example and you can use "miaow_js_files" hook-filter to add JS files to enqueue from an other file.

### Javascript variables to print in DOM
javascriptVars.config.php is the file where to must add your JS variables to print in the theme.   

### Menus
javascriptVars.config.php is the file where to must add your JS variables to print in the theme.   

### Custom Post Types
You can add new custom post types with new custom taxonomies. You need to edit "postTypes.config.php" to add it. You'll fin an example for a "Book" custom post type with "Genre" taxonomy. All post type parameters can be overrided.

## Controllers
BasicController is the controller which manage and override the WordPress Template hierarchy to use Controllers instead PHP template files like "single.php" or "archive.php".
BasicController do :
* init the theme (load Timber library)
* check the good controller to load
* call "render" function from the loaded controller.

Basically, the new template hierarchy works like WorPress Template Hierarchy :
* Current page is a "Page" post type => Load **PageController.php**
* Current page is a single page (post or Custom Post Type single page) => Load **SingleController.php**
* Current page is an archive or category page => Load **ArchiveController.php**
* Current page is tour website's front page => Load **FrontController.php**
* Current page is search results page => Load **SearchController.php**
* Current page is an archive or category page => Load **ArchiveController.php**

You can add controllers to manage your Custom Post Type or your Custom taxonomies.  
For example, if you want to add a Controller for your "Book" Custom Post Type, add a **BookController.php** file.
