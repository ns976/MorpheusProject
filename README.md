Test technique Morpheus
==============



## Rappel du sujet 

L’équipe Morpheus a signé des contrats avec deux clients.

Le premier nous donne un fichier JSON d’annonces immo que nous devons importer sur leboncoin. Les libellés des champs sont plutôt explicites dans le fichier. Cependant, certains champs ne sont pas nécessaires pour Leboncoin.

Le second est un fichier XML d’annonces emploi d’une agence d’Intérim. On nous demande de concaténer les champs description_poste et description_entreprise pour pouvoir afficher toutes ces informations dans le corps de l’annonce. 
Ces champs comportent des balises HTML mais Leboncoin n’accepte pas le HTML. Il faut donc nettoyer ces champs tout en gardant un rendu compréhensible (garder les sauts de ligne et les listes).


## Bonus

Le code postal n’est pas présent dans les données XML mais on aimerait tout de même l’avoir. Il vous est demandé de proposer une solution technique pour récupérer le code postal mais l’implémentation est optionnelle.

## Rappel pour utilisation de l'api :

   - Récupéré le projet sur votre local
   - N'oubliez pas de lancer composer
   - Lancer l'api via la console : 
        php bin/console job-executor (pour les données en xml)
        php bin/console real-estate-executor (pour les données en JSON)


## Rapport sur le projet:

J'ai apporté certains correction sur les fichiers reçus: 

- **Problème namespace class API :**

Initialement la class API était dans le namespace App\Validator, ce qui pour moi était incohérent. La class étant dans le dossier API et est généralement représenté par le chemin ou est situé la class j'ai modifié le namespace par App\Api\Api dans l'ensemble des class appelant la class API.

- **Instance de la class Jobhook et RealEstateHook dans la fonction configure :**  

L'instance des class Jobhook et RealEstateHook dans la fonction configure était pour moi pas necessaire.
J'ai déplacé l'instance dans la fonction execute en supprimant bien sur le $this et reutilisé pour l'appel la fonction formatAd()

- **Problème rencontré sur l'ajout de la description pour les donnée "Job.xml":**  
 Dans l'API et la documentation la valeur body pouvait contenir une longeur max de 500 caractères.
 En concaténant les champs description_poste et description_entreprise cela fesait beaucoup trop de caractères malgrès la suppression des balises HTML.
 Etant donnée que la donnée body était obligatoire et pour ne pas rendre un project non fonctionnel , j'ai limite le nombre de caractère à 500  lors de la récupération  des champs voulu dans la documentation.
 
Enfin , On n'avait pas la valeur du type de contrat dans les fichiers XML.Permettant de remplir le champs contract.
 
 ## Bonus:
 Pour palier au problème du code postal dans les données du XML, plusieurs piste peuvent être exploité:
 
  **Piste n° 1 : 
  - Dans le cas ou on a une base de donnée "communes" : 
  
      Récupéré le code postal exact en recherchant dans une base de données ou une API  (via fonction curl par exemple )le code postal avec les données de la ville et du département  via une requête SQL. Mais problématique dans le cas où la ville est mal orthographié et que plusieurs code postal ressorte pour une ville ( exemple : Paris  : 75010 , 75017 , 75011, etc...)
      
  **Piste n° 2 :
  
  - Avec le département dans le fichier complété le code postal par des 0 afin d'obtenir le nombre de caractère min demandé pour zip_code. Cela est facile à implémenté ( via une fonction dans les class hook ) mais cela ne donne pas le code postal exact.
  
  **Piste n° 3:
  
  - Avec le département dans le fichier complété le code postal par des 0 afin d'obtenir le nombre de caractère min demandé pour zip_code. Cela est facile à implémenté ( via une fonction dans les class hook ) mais cela ne donne pas le code postal exact.
  
  ## Améloration possible:
  
Au niveau des class Hook , on aurait pu implement une interface Description contenant la fonction buildDescription.
La fonction est utilisé par les deux class hook mais chacune d'une manière différente. Je pense que cela aurait mieux surtout si demain on améliore le project avec une nouvelle class Hook qui utilise également la fonction buildDescription.

