<?php
// src/Hook/RealEstateHook.php
namespace App\Hook;

class RealEstateHook
{

    /**
     * Creer le bon format accepte par API
     * @param array $ad : table data
     * @return array
     */
    public function formatAd(array $ad): array{

            $formatted_ad = array();

            $vertical_immo_ad = self::Vertical_immo_ad($ad[ 'categorie' ]);

            $formatted_ad[ 'id' ]       = $ad[ 'id' ];
            $formatted_ad[ 'title' ]    = $ad[ 'titre' ];
            $formatted_ad[ 'body' ]     = RealEstateHook::buildDescription($ad['description']);
            $formatted_ad[ 'vertical' ] = 'real_estate';
            $formatted_ad[ 'price' ]    = (int)$ad[ 'prix' ];
            $formatted_ad[ 'city' ]     = $ad[ 'ville' ];
            $formatted_ad[ 'zip_code' ] = $ad[ 'code_postal' ];
            $formatted_ad[ 'pro_ad' ]   = true;
            $formatted_ad[ 'category' ] =  $vertical_immo_ad['IdCategory'];

            //--On remplie le type uniquement si id = 4 sinon non obligatoire
                if( !empty( $vertical_immo_ad['IdCategory']) && $vertical_immo_ad['IdCategory'] === 4 ) {
                     $formatted_ad[ 'type' ]     =   $vertical_immo_ad['IdVente'] ;
                }

        return $formatted_ad;
    }

    /**
     * Retourne la description avec une longueur max 500 ( longueur max du body de API )
     * @param  string $description : la description de l'annonce
     * @return string
     */
    public function buildDescription($description){
        return substr($description,0,500);
    }

    /**
     * Conrespondance Categorie => IdCategory et  type
     * @param string $category : la categorie
     * @return array
     */
    public function Vertical_immo_ad( string $category) : array {


        $tab['IdCategory'] ="";
        $tab['IdVente'] ="";
        $category = strtolower($category); // passe en minuscule pour ne pas avoir d'erreur majuscule
        switch ($category){
            case "vente":
                $tab['IdCategory'] = 1;
                $tab['IdVente'] = "Vente";
            break;
            case "location":
                $tab['IdCategory'] =2;
                $tab['IdVente'] = "Location";
             break;

            case "colocation":
                $tab['IdCategory'] = 3;
                $tab['IdVente'] = "Location";
            break;

            case "bureaux et commerces":
                $tab['IdCategory'] = 4;
                $tab['IdVente']    = "Vente";
            break;
            default :
                $tab['IdCategory'] ="";
                $tab['IdVente'] ="";
            break;
        }
        return $tab;
    }
}
