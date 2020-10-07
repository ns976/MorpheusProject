<?php

namespace App\Converter;


use DOMDocument;

class XMLConverter
{

    /**
     * Convertie le xml en Array
     * @param string $filepath  : Le chemin du fichier
     * @return array : liste des jobs contenue dans le fichier
     */
    public static function xmlToArray(string $filepath): array{

        //-- On charge le fichier XML
        $xml = file_get_contents ( $filepath );

        //-- Utilisation de la classe DOM pour parcour du xml
        $dom = new DOMDocument();

        if ( !$dom -> loadXML ( $xml )) {
            die( "Impossible de charger le fichier XML : " . $filepath );
        }

        //-- On récupère la balise  description_poste afin de retirer les balises HTML.
        $itemList           = $dom -> getElementsByTagName ( "description_poste" );
        $nbrItemDescription = $itemList -> length;
        for ( $i = 0 ; $i < $nbrItemDescription ; $i++ ) {
            $itemList -> item ( $i ) -> nodeValue = strip_tags ( $itemList -> item ( $i ) -> nodeValue );
        }

        //--Construit un objet SimpleXMLElement à partir d'un objet DOM
        $xml_retour = simplexml_import_dom ( $dom );


        //--On encode le tableau en json puis en tableau
        $tab = json_decode(json_encode($xml_retour), TRUE);


        return $tab['job'];

    }
}

