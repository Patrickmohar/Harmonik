<?php
session_start();

require 'header.inc.php';
require 'model.php';

if (isset(
    $_POST['modeles'],
    $_POST['categorie_id'],
    $_POST['marques_id'],
    $_POST['stock'],
    $_POST['prix'],
)) {

    if (
        !empty($_POST['modeles']) && !empty($_POST['categorie_id']) && !empty($_POST['marques_id']) && !empty($_POST['stock'])
        && !empty($_POST['prix'])
    ) {
        $ajout = ajoutInstrument($bdd, $_POST['modeles'], $_POST['prix'], $_POST['stock'], $_POST['marques_id'], $_POST['categorie_id']);

        echo $_SESSION['message'] = 'Instrument ajouté';
        header('Location:index.php');
    }
}
?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Ajouter</title>
</head>

<body>


        <div class="main">
            <h2>Ajouter un instrument</h2>
        </div>

        <form action="ajouter_instru.php" method="post">
            <?php $marques = lister_marque($bdd); ?>
            <div class="field">
                <label for="marques">Marque : </label>
                <select name="marques_id" id="marques_id">
                    <?php foreach ($marques as $marque) : ?>
                        <option value="<?php echo $marque['id'] ?>"><?php echo $marque['marque']; ?></option>
                    <?php endforeach; ?>

                </select>

            </div>
            <div class="field">
                <label for="modeles"> Modèles :</label>
                <input type="text" name="modeles">

            </div>
            <?php $categories = lister_catégorie($bdd); ?>
            <div class="field">
                <label for="categorie">Catégorie :</label>
                <select name="categorie_id" id="categorie_id">
                    <?php foreach ($categories as $categorie) : ?>
                        <option value="<?php echo $categorie['id'] ?>"><?php echo $categorie['categorie']; ?></option>
                    <?php endforeach; ?>


                </select>


            </div>
            <div class="field">
                <label for="prix">Prix en € :</label>
                <input type="number" name="prix" id="prix">


            </div>
            <div class="field">
                <label for="stock">Quantité :</label>
                <input type="number" name="stock" id="stock">
            </div>


            <div class="field">
                <input type="submit" class="bouton" value="Soumettre" onclick="ajoutMessage()">
            </div>
        </form>

       <script src="js/confirm.js"></script>
        <?php require 'footer.php'; ?>