<?php

class AccueilController {

    private $_articleManager;

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

        require_once('Views/AccueilView.php');
    }

}