<?php
require_once( 'Views/View.php' );

class AccueilController {

    private $_articleManager;
    private $_view;

    public function __construct( $url ) {
        
        if( isset( $url ) && !empty( $url ) && count( $url ) > 1) {
            throw new Exception( "Page not found" );
        } else {            
            $this->articles();
        }

    }

    private function articles() {
        $this->_articleManager = new ArticleManager();
        $articles = $this->_articleManager->getArticles();

        $this->_view = new View( 'Accueil' );
        $this->_view->generate( array( 'articles' => $articles ) );
    }

}