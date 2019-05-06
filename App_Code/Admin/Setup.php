<?php


namespace CTousignant\Admin;

if ( ! defined( 'WPINC' ) ) die;


class Setup {

    var $modules_dir;

    public function __construct()
    {
        $this->modules_dir = __DIR__ . "/Modules";
        $this->load_modules();
    }

    private function load_modules()
    {
        $modules_dir = array_diff( scandir( $this->modules_dir ), array( ".", ".." ) );

        foreach( $modules_dir as $maybe_module ) :
            $module_dir = $this->modules_dir . DIRECTORY_SEPARATOR . $maybe_module;
            $module_index = $module_dir . DIRECTORY_SEPARATOR . "Index.php";

            if( is_dir( $module_dir ) && is_file( $module_index ) ) :
                include_once $module_index;
            endif;

        endforeach;
    }
}