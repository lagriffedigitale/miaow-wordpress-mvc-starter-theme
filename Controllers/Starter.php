<?php
namespace Miaow\Controllers;

use \Timber;
use \Timber\Menu;
use \Miaow\Helpers\MediaHelper;

/**
 * Starter Class
 *
 * This class starts theme, add theme supports,  load i18n, load context and apply to Twig, register images types, CSS / JS Files and Custom post types
 *
 */
class Starter extends \TimberSite
{
    public function __construct()
    {
        // Define Timber Views folders
        Timber::$dirname = ['Templates', 'Views'];
        // Twig & Timber filters
        add_filter('timber_context', [$this, 'addToContext']);
        add_filter('get_twig', [$this, 'addToTwig']);
        // Add Menus to context
        add_filter('miaow_add_to_context', [$this, 'addMenusToContext'], 100, 1);
        // Construct parent
        parent::__construct();
    }

    /**
     * Add datas to general Timber context
     *
     * @param array $context : General context
     *
     * @return array $context : General context modified
     */
    public function addToContext($context)
    {
        $context['site'] = $this;
        return apply_filters('miaow_add_to_context', $context);
    }

    /**
     * Add Twig support
     *
     * @param object $twig : Twig object
     *
     * @return object $twig
     */
    public function addToTwig($twig)
    {
        $twig->addExtension( new \Twig_Extension_StringLoader() );
		return $twig;
    }


    /**
     * Add Starter menus to context
     *
     * @param array $context
     *
     * @return array $context
     */
    public function addMenusToContext($context)
    {
        // Get registred menus
        $registredMenus = get_registered_nav_menus();
        if (!empty($registredMenus)) {
            foreach ($registredMenus as $menuId => $registredMenu) {
                // Add it to Timber context
                $menuIdentifier = str_replace('-', '_', $menuId);
                $context[$menuIdentifier] = new Menu($menuId);
            }
        }
        return $context;
    }
}
