<?php


namespace CTousignant\Admin\Modules;

if ( ! defined( 'WPINC' ) ) die;


/**
 * Class Page
 *
 * Theme class to build an admin page
 *
 * @package CTousignant\Admin\Pages
 */
abstract class Page
{
    /**
     * The text to be displayed in the title tags of the page when the menu is selected.
     *
     * @var string
     */
    var $page_title;

    /**
     * The text to be used for the menu.
     *
     * @var string
     */
    var $menu_title;

    /**
     * The capability required for this menu to be displayed to the user.
     *
     * @var string
     */
    var $capability;

    /**
     * The slug name to refer to this menu by.
     *
     * Should be unique for this menu page and only include lowercase alphanumeric, dashes, and
     * underscores characters to be compatible with sanitize_key()
     *
     * @link https://developer.wordpress.org/reference/functions/sanitize_key/
     *
     * @var string
     */
    var $menu_slug;

    /**
     * The dashicon class to be used for this menu.
     *
     * @link https://developer.wordpress.org/resource/dashicons/
     *
     * @var string
     */
    var $icon;

    /**
     * The position in the menu order this one should appear.
     *
     * @var int
     */
    var $position;

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
    public function __construct( String $page_title, String $menu_title, String $capability, String $menu_slug, String $icon, Int $position )
    {
        $this->page_title = $page_title;
        $this->menu_title = $menu_title;
        $this->capability = $capability;
        $this->menu_slug = $menu_slug;
        $this->icon = $icon;
        $this->position = $position;

        add_action( "admin_menu", $this->admin_page() );
    }

    protected function admin_page()
    {
        return function ()
        {
            add_menu_page(
                $this->page_title,
                $this->menu_title,
                $this->capability,
                $this->menu_slug,
                function () { return $this->view(); },
                $this->icon,
                $this->position
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
     * Extend to add content to page
     *
     * @return \Closure
     */
    abstract protected function view();

}