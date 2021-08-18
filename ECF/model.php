<?php

try {
    $options = [
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
        PDO::ATTR_ERRMODE =>  PDO::ERRMODE_EXCEPTION
    ];
    $bdd = new PDO('mysql:host=localhost;dbname=ecf', 'root', '', $options);
} catch (Exception $e) {

    die('Erreur : ' . $e->getMessage());
}


/**
 * totalInstrument: permet d'afficher le total des instruments en base de données
 * @param PDO $bdd objet PDO
 *  @return $q 
 * */
function totalInstrument($bdd)
{
    $sql = 'SELECT SUM(modeles.stock) FROM modeles';
    $q = $bdd->query($sql);
    return $q->fetchColumn();
}
/**
 * ajoutInstrument: permet d'ajouter des instruments en base de données
 * 
 * @param PDO $bdd objet PDO
 * @param string $bdd
 * @param string $modeles
 * @param string $prix
 * @param string $stock
 * @param string $marque_id
 * @param string $categorie_id
 * 
 *  @return array $q 
 * */

function ajoutInstrument($bdd, $modeles, $prix, $stock, $marques_id, $categorie_id)
{
$sql = 'INSERT INTO modeles(modele,prix,stock,date_ajout, Marques_id,Categories_id) VALUES(:modele, :prix, :stock, CURRENT_DATE, :Marques_id, :Categories_id)';
$q = $bdd->prepare($sql);


return $q->execute(array(
    'modele' => htmlspecialchars($modeles),
    'prix' => $prix,
    'stock' => $stock,
    'Marques_id' => $marques_id,
    'Categories_id' => $categorie_id
));
} 

/**
 * modifier_instu : permet de modifier les instruments en base de données
 * 
 * @param PDO $bdd objet PDO 
 * @param string $marque_id
 * @param string $modeles
 * @param string $categorie_id
 * @param string $prix
 * @param string $stock
 * @param string $id 
 * @return array $q 
 * */
function modifier_instru($bdd)
{

    $sql = 'UPDATE modeles SET modeles.modele = :modele, modeles.Marques_id = :marques_id, 
    modeles.Categories_id = :categories_id, modeles.prix = :prix, modeles.stock = :stock 
    WHERE modeles.id = :id ';

    $q = $bdd->prepare($sql);
    return $q->execute(array(
        'id' => $_GET['id'],
        'modele' => $_POST['modele'],
        'marques_id' => $_POST['marques'],
        'categories_id' => $_POST['categories'],
        'prix' => $_POST['prix'],
        'stock' => $_POST['stock'],

    ));
}
/**
 * lister_marque : permet d'afficher par marque les instruments en base de données
 * 
 * @param PDO $bdd objet PDO
 *  @return array $q 
 * */
function lister_marque($bdd)
{
    $sql = 'SELECT * FROM marques';
    $q = $bdd->query($sql);
    return $q->fetchAll(PDO::FETCH_ASSOC);
}
/**
 * lister_catégorie : permet d'afficher par catégorie les instruments en base de données
 * 
 * @param PDO $bdd objet PDO
 *  @return array $q 
 * 
 * */
function lister_catégorie($bdd)
{
    $sql = 'SELECT * FROM categories';
    $q = $bdd->query($sql);
    return $q->fetchAll(PDO::FETCH_ASSOC);
}

/**
 * retourne_modele: permet d'afficher par modeles les instruments en base de données
 * 
 * @param PDO $bdd objet PDO
 * 
 * @return array $q 
 * */

function retourne_modeles($bdd, $id)
{

    $sql = 'SELECT modeles.id, modeles.modele,modeles.prix,modeles.stock,modeles.date_ajout ,marques.marque, categories.categorie FROM modeles INNER JOIN marques ON modeles.Marques_id = marques.id INNER JOIN categories ON modeles.Categories_id = categories.id WHERE modeles.id = ?';
    $q = $bdd->prepare($sql);
    $q->execute([$id]);
    $retour = $q->fetch(PDO::FETCH_ASSOC);
    return $retour;
}

/**
 * lister_marque : permet d'afficher par marque les instruments en base de données
 * 
 * @param PDO $bdd objet PDO
 * 
 *  @return array $q 
 * */

function supprimer_instru($bdd, $id)
{
    $sql = 'DELETE FROM modeles WHERE modeles.id = ?';
    $q = $bdd->prepare($sql);
    return $q->execute([$id]);
}
/**
 * lister_modeles : permet d'afficher tous les intruments présents en base de données
 * 
 * @param PDO $bdd objet PDO
 * 
 *  @return array $q 
 * */
function lister_modeles($bdd)
{


    $sql = 'SELECT modeles.id, modeles.modele, modeles.prix, modeles.stock, modeles.date_ajout ,marques.marque, categories.categorie FROM modeles INNER JOIN marques ON modeles.Marques_id = marques.id INNER JOIN categories ON modeles.Categories_id = categories.id';
    
    $q = $bdd->query($sql);
    
    return $q->fetchALL(PDO::FETCH_ASSOC);
   
}


