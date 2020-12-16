<?php
require_once File::build_path(array("model","ModelFleur.php"));
class ControllerPanier {

   /**
    * Ajoute un article dans le panier
    * @param varchar $id
    * @param varchar $variete
    * @param varchar $couleur
    * @param int $qte
    * @param float $prix
    * @return void
    */
   public static function ajouterArticle(){

      //Si le panier existe
      if (!isLock())
      {
         //Si le produit existe déjà on ajoute seulement la quantité
         $positionProduit = array_search($id,  $_SESSION['panier']['id']);

         if ($positionProduit !== false)
         {
            $_SESSION['panier']['qte'][$positionProduit] += $qte ;
         }
         else
         {
            //Sinon on ajoute le produit
            array_push( $_SESSION['panier']['id'],$id);
            array_push( $_SESSION['panier']['variete'],$variete);
            array_push( $_SESSION['panier']['couleur'],$couleur);
            array_push( $_SESSION['panier']['qte'],$qte);
            array_push( $_SESSION['panier']['prix'],$prix);
         }
         $view='detail';
         require File::build_path(array("view","view.php"));   
      }
      else
      echo "Un problème est survenu veuillez contacter l'administrateur du site.";
   }



   /**
    * Modifie la quantité d'un article
    * @param $id
    * @param $variete
    * @param $couleur
    * @param $qte
    * @return void
    */
   public static function modifierQte($id,$qte){
      //Si le panier existe
      if (!isLock())
      {
         //Si la quantité est positive on modifie sinon on supprime l'article
         if ($qte > 0)
         {
            //Recharche du produit dans le panier
            $positionProduit = array_search($id,  $_SESSION['panier']['id']);

            if ($positionProduit !== false)
            {
               $_SESSION['panier']['qte'][$positionProduit] = $qte ;
            }
         }
         else
         supprimerArticle($id);
      }
      else
      echo "Un problème est survenu veuillez contacter l'administrateur du site.";
   }

   /**
    * Supprime un article du panier
    * @param $id
    * @return unknown_type
    */
   public static function supprimerArticle($id){
      //Si le panier existe
      if (!isLock())
      {
         //Nous allons passer par un panier temporaire
         $tmp=array();
         $tmp['id'] = array();
         $tmp['variete'] = array();
         $tmp['couleur'] = array();
         $tmp['qte'] = array();
         $tmp['prix'] = array();
         $tmp['lock'] = $_SESSION['panier']['lock'];

         for($i = 0; $i < count($_SESSION['panier']['id']); $i++)
         {
            if ($_SESSION['panier']['id'][$i] !== $id)
            {
               array_push( $tmp['id'],$_SESSION['panier']['id'][$i]);
               array_push( $tmp['variete'],$_SESSION['panier']['variete'][$i]);
               array_push( $tmp['couleur'],$_SESSION['panier']['couleur'][$i]);
               array_push( $tmp['qte'],$_SESSION['panier']['qte'][$i]);
               array_push( $tmp['prix'],$_SESSION['panier']['prix'][$i]);
            }

         }
         //On remplace le panier en session par notre panier temporaire à jour
         $_SESSION['panier'] =  $tmp;
         //On efface notre panier temporaire
         unset($tmp);
      }
      else
      echo "Un problème est survenu veuillez contacter l'administrateur du site.";
   }


   /**
    * Montant total du panier
    * @return int
    */
   /*public static function MontantGlobal(){
      $total=0;
      for($i = 0; $i < count($_SESSION['panier']['id']); $i++)
      {
         $total += $_SESSION['panier']['qte'][$i] * $_SESSION['panier']['prix'][$i];
      }
      return $total;
   }*/


   /**
    * Fonction de suppression du panier
    * @return void
    */
   /*public static function supprimePanier(){
      unset($_SESSION['panier']);
   }/*



   /**
    * Permet de savoir si le panier est lockillé
    * @return booleen
    */
   public static function isLock(){
      if (isset($_SESSION['panier']) && $_SESSION['panier']['lock'])
      return true;
      else
      return false;
   }


    /*
   public static function compterArticles()
   {
      if (isset($_SESSION['panier']))
      return count($_SESSION['panier']['id']);
      else
      return 0;

   }*/
}
?>