<?php


namespace CTousignant;

if ( ! defined( 'WPINC' ) ) die;


class Autoloader
{

    var $search_paths =
        [
            "App_Code"
        ];

    public function __construct()
    {
        try
        {
            \spl_autoload_register( $this->load() );
        }
        catch( \Exception $e )
        {
            echo sprintf( "Exception in: %s line: %d \r\n %s \r\n %s \r\n",
                $e->getFile(),
                $e->getLine(),
                $e->getMessage(),
                $e->getTraceAsString()
            );
        }
    }

    private function load()
    {
        return function ( $classname )
        {
            if( substr( $classname, 0, 11 ) === "CTousignant" ) :

                $path = str_replace( "\\", DIRECTORY_SEPARATOR, substr( $classname, 12 ) );

                foreach( $this->search_paths as $search_path ) :

                    $final_path = get_template_directory() . DIRECTORY_SEPARATOR . $search_path . DIRECTORY_SEPARATOR . strtolower( $path ) . ".php";

                    if( is_file( $final_path ) ) include_once $final_path;

                endforeach;
            endif;
        };
    }
}