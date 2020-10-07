<?php

namespace App\Converter;

class JsonConverter
{
    /**
     * Convertie le JSON en Array
     * @param string $filepath  : Le chemin du fichier
     * @return array : liste des jobs contenue dans le fichier
     */
    public static function jsonToArray(string $filepath): array
    {
        //-- On charge le fichier JSON
            $data = \file_get_contents($filepath);
        //--decode le JSON   pour obtenir le tableau
            $tab  = json_decode($data,true);
        //--En cas erreur du format du JSON
            if ( json_last_error() != JSON_ERROR_NONE) {
                die("Json non conforme : ".json_last_error());
            }

        return $tab;
    }
}
