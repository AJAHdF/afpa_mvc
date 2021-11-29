<h2>Nouveau Produit</h2>
<form action="" method="post" enctype="multipart/form-data">
    <label for="name">Nom</label><br>
    <input type="text" name="name" id="name" value="<?= $posted['name'] ?? ''; ?>">
    <br><br>
    <label for="description">Description</label><br>
    <textarea name="description" id="description" cols="30" rows="10"><?= $posted['description'] ?? ''; ?></textarea><br><br>
    <label for="price">Prix</label><br>
    <input type="text" name="price" id="price" value="<?= $posted['price'] ?? ''; ?>">
    <label class="text-danger"><?= isset($errors['price']) ? 'Champ invalide, saisir un prix SVP.' : ''; ?></label><br><br>
    <label for="image_path">Image</label><br>
    <input type="file" name="image_path" id="image_path"><br><br>
    <label for="category_id">Catégorie</label><br>
    <select id="category_id" name="category_id">
        <option value="null">Choisir ...</option>
        <?php foreach($categories as $category){ ?>
        <option value="<?= $category->id?>" <?= ($category->id == ($posted['category_id'] ?? '')) ? 'selected' : '' ?> >
            <?= $category->name?>
        </option>
        <?php } ?>
    </select><br><br><br>
    <div class="d-flex">
        <input type="submit" name="create" id="create" value="Valider">
        <input type="submit" name="cancel" id="cancel" value="Annuler" class="ml-2">
    </div><br>
    <label class="text-danger"><?= count($errors) > 0 ? 'Erreur de saisie dans le formulaire.' : ''; ?></label>
</form>