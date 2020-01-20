<?php
class View {

    private $_file;
    private $_title;

    public function __construct( $action ) {
        $this->_file = 'Views/'.$action.'View.php';
    }

    public function generate( $data ) {
        $content = $this->generateFile( $this->_file, $data );

        $view = $this->generateFile( 'Views/Template.php', array( 'title' => $this->_title, 'content' => $content ) );

        echo $view;
    }

    private function generateFile( $file, $data ) {
        if( file_exists( $file ) ) {
            extract( $data );

            ob_start();

            require( $file );

            return ob_get_clean();
        } else {
            throw new Exception( "Fichier " . $file . " introuvable." );
        }
    }

    public function getFile() {
        return $this->_file;
    }

}