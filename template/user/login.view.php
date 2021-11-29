<h2>Authentification</h2>
<form action="" method="post">
    <label for="name">Identifiant</label><br>
    <input type="email" name="login" id="login" value="<?= $posted['login'] ?? ''; ?>" required>
    <br><br>
    <label for="name">Mot de passe</label><br>
    <input type="password" name="password" id="password" value="<?= $posted['password'] ?? ''; ?>" required>
    <br><br>
    <div class="d-flex">
        <input type="submit" name="validate" id="validate" value="Valider">
        <input type="submit" name="cancel" id="cancel" value="Annuler" class="ml-2">
    </div><br>
    <label class="text-danger"><?= count($errors) > 0 ? 'Identifiant ou mot de passe incorrect.' : ''; ?></label>
</form>