<?php
session_start();
require 'model.php';
require 'header.inc.php';





if (isset(

    $_POST['modele'],
    $_POST['Categorie_id'],
    $_POST['Marques_id'],
    $_POST['stock'],
    $_POST['prix'],
))


?>



<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="shortcut icon" type="image/ico" href="img/favicon.ico"/>
    <title>Accueil</title>
</head>

<body>
    <form action="index.php" method="post">
        <div class="main">

            <h2>Listing des instruments</h2>


            <div class="wrapper">
                <a href="ajouter_instru.php"><img class="ajout" src="img/Vector.png" alt="ajouter"></a>
                <p class="totalstock">Nombre d'instruments en stock : <?= totalInstrument($bdd) ?></p>
            </div>
        </div>

        <table>

            <tr>
                <th>Marque:</th>
                <th>Modèle:</th>
                <th>Catégorie:</th>
                <th>Prix:</th>
                <th>Stock:</th>
                <th>Date d'ajout:</th>
                <th></th>
                <th></th>
            </tr>


            <?php $instruments = lister_modeles($bdd); ?>
            <?php foreach ($instruments as $instrument) {

            ?>


                <tr>
                    <td><?= $instrument['marque'] ?></td>
                    <td><?= $instrument['modele'] ?></td>
                    <td><?= $instrument['categorie'] ?></td>
                    <td><?= $instrument['prix'] ?></td>
                    <td><?= $instrument['stock'] ?></td>
                    <td><?php echo date('d/m/Y'); ?></td>
                    <td><a href="modifier_instru.php?id=<?= $instrument['id']; ?>"><img src="img/modifier.png" alt="modifier"></a></td>
                    <td><a href="supprimer_instru.php?id=<?= $instrument['id']; ?>"><img src="img/supprimer.png" alt="supprimer" onClick="ConfirmMessagesupp()"></a></td>


                </tr>


            <?php }  ?>
        </table>

    </form>
    <script src="js/confirm.js"></script>
    <?php require 'footer.php'; ?>