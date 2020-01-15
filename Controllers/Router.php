<?php
class Router {

    private $_ctrl;

    public function routeReq() {
        
        try {

            // CHARGEMENT AUTOMATIQUE DES CLASSES
            spl_autoload_register( function( $class ) {
                require_once( 'Models/'.$class.'.php' );
            });

            $url = '';

            if( isset( $_GET['url'] ) ) {
                
                $url = explode( '/', filter_var( $_GET['url'], FILTER_SANITIZE_URL ) );

                $controller = ucfirst( strtolower( $url[0] ) );
                $controllerClass = $controller . "Controller";
                $controllerFile = "Controllers/" . $controllerClass . "php";

                if( file_exists( $controllerFile ) ) {
                    
                    require_once( $controllerFile );
                    $this->_ctrl = new $controllerClass( $url );
                
                } else {
                    throw new Exception( 'Page not found.' );
                }

            } else {

                require_once( "Controllers/AccueilController.php" );
                $this->_ctrl = new AccueilController( $url );

            }

        } catch( Exception $e ) {

            $e->getMessage();
            require_once( "Views/404.html" );

        }

    }

}
