<?php


namespace CTousignant\Admin\Modules\Post_Types;
use CTousignant\Admin\Modules\Subpage;

if ( ! defined( 'WPINC' ) ) die;


class Page extends Subpage
{
    /**
     * Table name
     *
     * @var string
     */
    var $tablename = "devtools_posttype";

    /**
     * MySQL Create table query
     *
     * @var string
     */
    var $createTableDLL = "CREATE TABLE %s ( id INT AUTO_INCREMENT, title VARCHAR(255) NOT NULL, settings LONGTEXT, PRIMARY KEY ( id ) )";

    /**
     * Post_Types constructor.
     *
     * @param String $parent_slug
     * @param String $page_title
     * @param String $menu_title
     * @param String $capability
     * @param String $menu_slug
     *
     * @throws \Exception Table could not be created
     */
    public function __construct(String $parent_slug, String $page_title, String $menu_title, String $capability, String $menu_slug)
    {
        if( $this->createTable() ) :
            parent::__construct($parent_slug, $page_title, $menu_title, $capability, $menu_slug);
        else :
            throw new \Exception( "Could not create Dev Tools Post Type table" );
        endif;
    }

    /**
     * Enqueues
     *
     * @return \Closure|mixed
     */
    protected function enqueue():\Closure
    {
        return function ( $hook ) {
            if( "dev-tools_page_dev_tools__post_types" == $hook ) :
                wp_enqueue_style(
                    "admin-post-type",
                    get_template_directory_uri() . "/App_Code/Admin/Modules/Post_Types/assets/build/css/main.css",
                    false,
                    "1.0",
                    "all"
                );

                wp_enqueue_script(
                    "admin-post-type",
                    get_template_directory_uri() . "/App_Code/Admin/Modules/Post_Types/assets/build/js/main.js",
                    [ "jquery" ],
                    "1.0",
                    true
                );

            endif;
        };
    }

    /**
     * View
     *
     * @return \Closure|mixed
     */
    protected function view():\Closure
    {
        return function () {
            $path = dirname( __FILE__ ) . DIRECTORY_SEPARATOR . "views" . DIRECTORY_SEPARATOR . "app.php";

            if( is_file( $path ) ) include $path;
        };
    }

    /**
     * Create Dev Tools Post Type table
     *
     * @link https://developer.wordpress.org/reference/functions/maybe_create_table/
     *
     * @see wp-admin/includes/upgrade.php
     */
    private function createTable()
    {
        global $wpdb;

        $query = $wpdb->prepare( 'SHOW TABLES LIKE %s', $wpdb->esc_like( $this->tablename ) );

        if ( $wpdb->get_var( $query ) == $this->tablename ) {
            return true;
        }

        // Didn't find it try to create it..
        $wpdb->query( sprintf( $this->createTableDLL, $this->tablename ) );

        // We cannot directly tell that whether this succeeded!
        if ( $wpdb->get_var( $query ) == $this->tablename ) {
            return true;
        }
        return false;
    }
}