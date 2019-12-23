<?php
namespace Miaow\Helpers;

/**
 * Post Type Helper Class
 *
 **/
class PostTypeHelper
{
    public function __construct()
    {

    }

    /**
     * Register images configuration
     **/
    public static function registerPostTypes()
    {
        $postTypes = require THEME_PATH . '/Config/postTypes.config.php';
        if (!empty($postTypes) && is_array($postTypes)) {
            foreach ($postTypes as $postTypeId => $postType) {
                // if not args in definition, get default CPT args
                if (empty($postType['args'])) {
                    $postType['args'] = PostTypeHelper::getDefaultPostTypeConfiguration($postType['singular_name'], $postType['plural_name'], $postType['menu_icon']);
                }
                else {
                    $postType['args'] = array_merge(
                        PostTypeHelper::getDefaultPostTypeConfiguration($postType['singular_name'], $postType['plural_name']),
                        $postType['args']
                    );
                }
                // register taxonomies if exists
                register_post_type($postTypeId, $postType['args']);
                if (!empty($postType['taxonomies']) && is_array($postType['taxonomies'])) {
                    foreach ($postType['taxonomies'] as $taxonomyId => $taxonomy) {
                        // if not args in definition, get default Taxonomy args
                        if (empty($taxonomy['args'])) {
                            $taxonomy['args'] = PostTypeHelper::getDefaultTaxonomyConfiguration($taxonomy['singular_name'], $taxonomy['plural_name']);
                        }
                        else {
                            $taxonomy['args'] = array_merge(
                                PostTypeHelper::getDefaultTaxonomyConfiguration($taxonomy['singular_name'], $taxonomy['plural_name']),
                                $taxonomy['args']
                            );
                        }
                        register_taxonomy($taxonomyId, $postTypeId, $taxonomy['args']);
                    }
                }
            }
        }
        //exit;
    }

    /**
     * Get default Custom post type configuration arguments
     * @param string $postTypeSingularLabel : Singular label
     * @param string $postTypePluralLabel : Plural label
     * @param string $menuIcon : Menu icon
     * @return array
     **/
    public static function getDefaultPostTypeConfiguration($postTypeSingularLabel, $postTypePluralLabel, $menuIcon = '')
    {
        return [
            'labels'    => [
                'name'                  => __(ucfirst($postTypeSingularLabel), 'post type general name', LANG_DOMAIN),
                'singular_name'         => __(ucfirst($postTypeSingularLabel), 'post type singular name', LANG_DOMAIN),
                'menu_name'             => __(ucfirst($postTypePluralLabel), 'admin menu', LANG_DOMAIN),
                'name_admin_bar'        => __(ucfirst($postTypeSingularLabel), 'admin menu', LANG_DOMAIN),
                'add_new'               => __('Add new', LANG_DOMAIN),
                'add_new_item'          => sprintf(__('Add new %s', LANG_DOMAIN), $postTypeSingularLabel),
                'new_item'              => sprintf(__('New %s', LANG_DOMAIN), $postTypeSingularLabel),
                'edit_item'             => sprintf(__('Edit %s', LANG_DOMAIN), $postTypeSingularLabel),
                'view_item'             => sprintf(__('View %s', LANG_DOMAIN), $postTypeSingularLabel),
                'view_items'            => sprintf(__('View %s', LANG_DOMAIN), $postTypePluralLabel),
                'all_items'             => sprintf(__('All %s', LANG_DOMAIN), $postTypePluralLabel),
                'search_items'          => sprintf(__('Search %s', LANG_DOMAIN), $postTypeSingularLabel),
                'parent_item_colon'     => sprintf(__('Parent %s', LANG_DOMAIN), $postTypeSingularLabel),
                'not_found'             => sprintf(__('No %s found', LANG_DOMAIN), $postTypeSingularLabel),
                'not_found_in_trash'    => sprintf(__('No %s found in trash', LANG_DOMAIN), $postTypeSingularLabel)
            ],
            'description'           =>  sprintf(__('%s post type', LANG_DOMAIN), ucfirst($postTypeSingularLabel)),
            'public'                => TRUE,
            'publicly_queryable'    => TRUE,
            'show_ui'               => TRUE,
            'show_in_menu'          => TRUE,
            'query_var'             => TRUE,
            'rewrite'               => ['rewrite' => $postTypeSingularLabel],
            'capability_type'       => 'post',
            'has_archive'           => TRUE,
            'hierarchical'          => TRUE,
            'menu_position'         => NULL,
            'menu_icon'             => $menuIcon,
            'supports'              => ['title', 'editor', 'thumbnail', 'excerpt'],
        ];
    }

    /**
     * Get default Custom taxonomy configuration arguments
     * @param string $taxonomySingularLabel : Singular label
     * @param string $taxonomyPluralLabel : Plural label
     * @return array
     **/
    public static function getDefaultTaxonomyConfiguration($taxonomySingularLabel, $taxonomyPluralLabel)
    {
        return [
            'labels'        => [
                'name'                  => __(ucfirst($taxonomyPluralLabel), 'taxonomy general name', LANG_DOMAIN),
                'singular_name'         => __(ucfirst($taxonomySingularLabel), 'taxonomy singular name', LANG_DOMAIN),
                'search_items'          => sprintf(__( 'Search %s', LANG_DOMAIN ), $taxonomyPluralLabel),
                'all_items'             => sprintf(__( 'All %s', LANG_DOMAIN ), $taxonomyPluralLabel),
                'parent_item'           => sprintf(__( 'Parent %s', LANG_DOMAIN ), $taxonomySingularLabel),
                'parent_item_colon'     => sprintf(__( 'Parent %s', LANG_DOMAIN ), $taxonomySingularLabel),
                'edit_item'             => sprintf(__( 'Edit %s', LANG_DOMAIN ), $taxonomySingularLabel),
                'update_item'           => sprintf(__( 'Update %s', LANG_DOMAIN ), $taxonomySingularLabel),
                'add_new_item'          => sprintf(__( 'Add new %s', LANG_DOMAIN ), $taxonomySingularLabel),
                'new_item_name'         => sprintf(__( 'New %s', LANG_DOMAIN ), $taxonomySingularLabel),
                'menu_name'             => __( ucfirst($taxonomyPluralLabel), LANG_DOMAIN )
            ],
            'hierarchical'      => TRUE,
            'show_ui'           => TRUE,
            'show_admin_column' => TRUE,
            'query_var'         => TRUE,
            'rewrite'           => ['slug' => $taxonomyPluralLabel]
        ];
    }
}
