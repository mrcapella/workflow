<?php
class TrataStrings {

	public static function exibeSpecialChars( $string ) {
        
        $replaces = array(

            'á' => '&aacute;',  
            'à' => '&agrave;',
            'í' => '&iacute;',
            'ô' => '&ocirc;',
            'Á' => '&Aacute;',
            'À' => '&Agrave;',
            'Í' => '&Iacute;',
            'Ô' => '&Ocirc;',
            'ã' => '&atilde;',
            'é' => '&eacute;',
            'ó' => '&oacute;',
            'ú' => '&uacute;',
            'Ã' => '&Atilde;',
            'É' => '&Eacute;',
            'Ó' => '&Oacute;',
            'Ú' => '&Uacute;',
            'â' => '&acirc;',
            'ê' => '&ecirc;',
            'õ' => '&otilde;',
            'ç' => '&ccedil;',
            'Â' => '&Acirc;',
            'Ê' => '&Ecirc;',
            'Õ' => '&Otilde;',
            'Ç' => '&Ccedil;',
			'(' => '',  
            ')' => ''
        );

        $output = strtr( $string, $replaces );

        return $output;

    } // fim do método removeSpecialChars

}
?>