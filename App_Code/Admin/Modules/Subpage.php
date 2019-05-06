<?php


namespace CTousignant\Admin\Modules;

if ( ! defined( 'WPINC' ) ) die;

/**
 * Class Subpage
 *
 * Theme class to build an admin subpage.
 *
 * @package CTousignant\Admin\Pages
 */
abstract class Subpage
{
    /**
     * The slug name for the parent menu
     *
     * @var string
     */
    var $parent_slug;

    /**
     * The text to be displayed in the title tags of the page when the menu is selected.
     *
     * @var string
     */
    var $page_title;

    /**
     * The text to be used for the menu
     *
     * @var string
     */
    var $menu_title;

    /**
     * The capability required for this menu to be displayed to the user.
     *
     * @var $string
     */
    var $capability;

    /**
     * The slug name to refer to this menu by.
     *
     * @link https://developer.wordpress.org/reference/functions/sanitize_key/
     *
     * @var string
     */
    var $menu_slug;

    public function __construct( String $parent_slug, String $page_title, String $menu_title, String $capability, String $menu_slug )
    {
        $this->parent_slug = $parent_slug;
        $this->page_title = $page_title;
        $this->menu_title = $menu_title;
        $this->capability = $capability;
        $this->menu_slug = $menu_slug;

        add_action( "admin_menu", $this->admin_subpage() );
        add_action( "admin_enqueue_scripts", $this->enqueue() );
    }

    /**
     * Create Subpage
     *
     * @return \Closure
     */
    protected function admin_subpage()
    {
        return function ()
        {
            add_submenu_page(
                $this->parent_slug,
                $this->page_title,
                $this->menu_title,
                $this->capability,
                $this->menu_slug,
                $this->view()
            );
        };
    }

    /**
     * Extend to enqueue assets
     *
     * @return \Closure
     */
    abstract protected function enqueue():\Closure;

    /**
     * Extend to add content to subpage
     *
     * @return \Closure
     */
    abstract protected function view():\Closure;

}