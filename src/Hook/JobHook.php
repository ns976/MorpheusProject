<?php
// src/Hook/JobHook.php
namespace App\Hook;

class JobHook{


    /**
     * Creer le bon format accepte par API
     * @param array $ad : table data
     * @return array
     */
    public function formatAd(array $ad): array{


            $formatted_ad[ 'id' ]       = (int) str_replace ( "HAG11-" ,"" , $ad[ 'client_reference' ]);
            $formatted_ad[ 'title' ]    = $ad[ 'title' ];
            $formatted_ad[ 'body' ]     = $this->buildDescription($ad[ 'description_poste'],$ad[ 'description_entreprise']);
            $formatted_ad[ 'vertical']  = 'job';
            $formatted_ad[ 'city' ]     = $ad[ 'location_city' ];
            $formatted_ad[ 'pro_ad' ]   = true;
            $formatted_ad[ 'images' ][] = $ad[ 'pictures' ];


        return $formatted_ad;
    }

    /**
     * Retourne la description avec une longueur max 500  en concatenant la description entreprise et poste( longueur max du body de API )
     * @param  string $descriptionPoste       : la description du poste de l'annonce
     * @param  string $descriptionEntreprise : la description de l'entreprise de l'annonce
     * @return string
     */
    public function buildDescription(string $descriptionPoste , string $descriptionEntreprise){
        return substr($descriptionEntreprise.' '.$descriptionPoste,0,500);
    }
}
