<?php 
session_start();
require 'model.php';
$supp = supprimer_instru($bdd, $_GET['id']);


if($supp){
       
        header('Location:index.php');
}
       
        

       




?>