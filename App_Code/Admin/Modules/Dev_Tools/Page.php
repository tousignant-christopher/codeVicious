<?php

namespace CTousignant\Admin\Modules\Dev_Tools;

if ( ! defined( 'WPINC' ) ) die;


class Page extends \CTousignant\Admin\Modules\Page {

    /**
     * Page constructor.
     *
     * @param String $page_title
     * @param String $menu_title
     * @param String $capability
     * @param String $menu_slug
     * @param String $icon
     * @param Int    $position
     */
    public function __construct(String $page_title, String $menu_title, String $capability, String $menu_slug, String $icon, Int $position)
    {
        parent::__construct($page_title, $menu_title, $capability, $menu_slug, $icon, $position);
    }

    /**
     * Enqueues
     *
     * @return \Closure|mixed
     */
    protected function enqueue():\Closure
    {
        return function () {
            return null;
        };
    }

    /**
     * View
     *
     * @return \Closure|mixed
     */
    protected function view()
    {
        $path = dirname( __FILE__ ) . DIRECTORY_SEPARATOR . "views" . DIRECTORY_SEPARATOR . "main.php";

        if( is_file( $path ) ) include $path;
    }

}