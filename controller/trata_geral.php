<?php
class TrataStrings {

	public static function exibeSpecialChars( $string ) {
        
        $replaces = array(

            '�' => '&aacute;',  
            '�' => '&agrave;',
            '�' => '&iacute;',
            '�' => '&ocirc;',
            '�' => '&Aacute;',
            '�' => '&Agrave;',
            '�' => '&Iacute;',
            '�' => '&Ocirc;',
            '�' => '&atilde;',
            '�' => '&eacute;',
            '�' => '&oacute;',
            '�' => '&uacute;',
            '�' => '&Atilde;',
            '�' => '&Eacute;',
            '�' => '&Oacute;',
            '�' => '&Uacute;',
            '�' => '&acirc;',
            '�' => '&ecirc;',
            '�' => '&otilde;',
            '�' => '&ccedil;',
            '�' => '&Acirc;',
            '�' => '&Ecirc;',
            '�' => '&Otilde;',
            '�' => '&Ccedil;',
			'(' => '',  
            ')' => ''
        );

        $output = strtr( $string, $replaces );

        return $output;

    } // fim do m�todo removeSpecialChars

}
?>