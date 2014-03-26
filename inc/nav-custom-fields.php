<?php
/**
 * Created by PhpStorm.
 * User: scrockett
 * Date: 3/26/14
 * Time: 9:51 AM
 */

if ( ! defined( 'DOING_AJAX' ) || ! DOING_AJAX ) :

function myplugin_load_menu_item_custom_fields() {
    require_once get_template_directory() . '/vendor/wp-menu-item-custom-fields/menu-item-custom-fields.php';
}
add_action( 'load-nav-menus.php', 'myplugin_load_menu_item_custom_fields' );

/**
 * Sample menu item metadata
 *
 * This class demonstrate the usage of Menu Item Custom Fields in plugins/themes.
 *
 * @since 0.1.0
 */
class Pipeline_Menu_Item_Custom_Fields {

    /**
     * Initialize plugin
     */
    public static function init() {
        add_action( 'menu_item_custom_fields', 'Pipeline_Menu_Item_Custom_Fields::fields', 10, 3 );
        add_action( 'wp_update_nav_menu_item', array( 'Pipeline_Menu_Item_Custom_Fields', '_save' ), 10, 3 );
        add_filter( 'manage_nav-menus_columns', 'Pipeline_Menu_Item_Custom_Fields::columns', 99 );
    }


    /**
     * Save custom field value
     *
     * @wp_hook action wp_update_nav_menu_item
     *
     * @param int   $menu_id         Nav menu ID
     * @param int   $menu_item_db_id Menu item ID
     * @param array $menu_item_args  Menu item data
     */
    public static function _save( $menu_id, $menu_item_db_id, $menu_item_args ) {
        check_admin_referer( 'update-nav_menu', 'update-nav-menu-nonce' );

        // Sanitize
        if ( ! empty( $_POST['menu-item-glyphicon'][ $menu_item_db_id ] ) ) {
            // Do some checks here...
            $value = $_POST['menu-item-glyphicon'][ $menu_item_db_id ];
        }
        else {
            $value = '';
        }

        // Update
        if ( ! empty( $value ) ) {
            update_post_meta( $menu_item_db_id, 'menu-item-glyphicon', $value );
        }
        else {
            delete_post_meta( $menu_item_db_id, 'menu-item-glyphicon' );
        }
    }


    /**
     * Print field
     *
     * @param object $item  Menu item data object.
     * @param int    $depth  Depth of menu item. Used for padding.
     * @param array  $args  Menu item args.
     * @param int    $id    Nav menu ID.
     *
     * @return string Form fields
     */
    public static function fields( $item, $depth, $args = array(), $id = 0 ) {
        ?>
        <p class="field-glyphicon description description-wide">
            <label for="edit-menu-item-glyphicon-<?php echo esc_attr( $item->ID ) ?>"><?php _e( 'Glyphicon (navbar only, syntax is <code>glyphicon-fire</code> or <code>fa-linux</code>)', 'pipeline' ) ?><br />
                <?php printf(
                    '<input type="text" value="%1$s" name="menu-item-glyphicon[%2$d]" class="widefat code edit-menu-item-glyphicon" id="edit-menu-item-glyphicon-%2$d">',
                    esc_attr( get_post_meta( $item->ID, 'menu-item-glyphicon', true ) ),
                    $item->ID
                ) ?>
            </label>
        </p>
        <?php
    }


    /**
     * Add our field to the screen options toggle
     *
     * To make this work, the field wrapper must have the class 'field-custom'
     *
     * @param array $columns Menu item columns
     * @return array
     */
    public static function columns( $columns ) {
        $columns['glyphicon'] = __( 'Glyphicon', 'pipeline' );

        return $columns;
    }
}
Pipeline_Menu_Item_Custom_Fields::init();

endif; // AJAX check
