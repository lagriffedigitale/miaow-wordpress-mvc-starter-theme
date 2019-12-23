<?php
namespace Miaow;

/**
 * Class Autoloader
 *
 * This class is a custom autoload and load class when it fires
 */
class Autoloader {

    /**
     * Start starter theme Autoloader
     */
    static function register(){
        spl_autoload_register(
            [__CLASS__, 'autoload']
        );
    }

    /**
    * Include file corresponds to loaded class
    *
    * @param string $class : Class name
    */
    static function autoload($class){
        $class = str_replace( __NAMESPACE__ . '\\', '', $class );
        $class = str_replace( '\\', '/', $class );
        if (!empty($class)) {
            if (file_exists(THEME_PATH . '/' . $class . '.php')) {
                include_once(THEME_PATH . '/' . $class . '.php');
            }
        }
    }

}
