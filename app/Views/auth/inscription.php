<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Créer un compte - Révizio</title>
</head>
<body>
    <h1>Créer un compte créateur</h1>

    <?php if (session()->getFlashdata('succes')): ?>
        <p style="color: green;"><?= esc(session()->getFlashdata('succes')) ?></p>
    <?php endif; ?>

    <?= validation_list_errors() ?>

    <?= form_open('inscription') ?>
        <p>
            <label>Nom complet<br>
            <input type="text" name="nom" value="<?= esc(old('nom')) ?>"></label>
        </p>
        <p>
            <label>Email<br>
            <input type="email" name="email" value="<?= esc(old('email')) ?>"></label>
        </p>

        <p>
           <label>Matière enseignée<br>
           <select name="matiere">
          <option value="">Choisir une matière</option>
          <?php foreach ($matieres as $m): ?>
          <option value="<?= esc($m['id']) ?>" <?= old('matiere') === $m['id'] ? 'selected' : '' ?>><?= esc($m['nom']) ?></option>
         <?php endforeach; ?>
         </select></label>
         </p>
         
        <p>
            <label>Mot de passe (8 caractères minimum)<br>
            <input type="password" name="mot_de_passe"></label>
        </p>
        <p>
            <label>Confirmer le mot de passe<br>
            <input type="password" name="confirmation"></label>
        </p>
        <button type="submit">Créer</button>
    <?= form_close() ?>

    <p>Déjà un compte ? <a href="<?= site_url('connexion') ?>">Se connecter</a></p>
</body>
</html>