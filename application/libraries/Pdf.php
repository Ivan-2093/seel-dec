<?php 

/**
 * 
 */
class Pdf extends AnotherClass
{
    
   public function __construct(){

    }

    function pdf(){
        $CI = & get_instance();
        log_message('Debug', 'mPDF class is loaded.');
    }

    function load($param=NULL){
        require_once APPPATH.'/third_party/vendor/autoload.php';
        return new \Mpdf\Mpdf([
            'margin_left'       =>  '5',
            'margin_right'      =>  '5',
            'mode'              =>  'utf-8',     //Codepage Values OR Codepage Values
            'format'            =>  'Letter',        //A4, Letter, Legal, Executive, Folio, Demy, Royal, etc
            'orientation'       =>  'P'          //"L" for Landscape orientation, "P" for Portrait orientation
        ]);
    }
}

 ?>