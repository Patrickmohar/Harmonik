<?php
session_start();

require_once 'model.php';
if (isset($_GET['id'])) {
    $modele = retourne_modeles($bdd, $_GET['id']);
    $marques = lister_marque($bdd);
    $categories = lister_catégorie($bdd);
    
} else {
    header('Location: index.php');
}
if (isset($_POST['modele'], $_POST['marques'], $_POST['categories'], $_POST['prix'], $_POST['stock'])) {
    modifier_instru($bdd, $_GET['id'], $_POST['modele'], $_POST['marques'], $_POST['categories'], $_POST['prix'], $_POST['stock']);
   
   
        header('Location:index.php');
    }
    
   

require_once 'header.inc.php';
?>

<h2 class="mod">Modifier un instrument </h2>

<form action="modifier_instru.php?id=<?= $_GET['id'] ?>" method="post">
    <div class="field">
        <label for="modele">Modèle</label>
        <input type="text" id="modele" name="modele" value="<?= $modele['modele']  ?>">
    </div>
    <div class="field">
        <label for="marques">Marque</label>
        <select name="marques" id="marques">
            <?php foreach ($marques as $marque) : ?>
                <option value="<?= $marque['id'] ?>" selected><?= $marque['marque']  ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="field">
        <label for="categories">Catégorie</label>

        <select name="categories" id="categories">
            <?php foreach ($categories as $categorie) { ?>
                <option value="<?= $categorie['id'] ?>"> <?= $categorie['categorie'] ?></option>
            <?php } ?>

        </select>
    </div>
    <div class="field">
        <label for="prix">Prix</label>
        <input type="number" name="prix" id="prix" value="<?= $modele['prix'] ?>">
    </div>
    <div class="field">
        <label for="stock">Stock</label>
        <input type="number" id="stock" name="stock" step="1" min="0" value="<?= $modele['stock'] ?>" height="50">
    </div>

    <div class="field">
        <button type="submit" class="bouton" onclick="Message()" >Modifier</button>

    </div>
</form>
<script src="js/confirm.js"></script>
<?php require 'footer.php'; ?>