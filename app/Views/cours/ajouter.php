<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Révizio - Ajouter un cours</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
    <nav class="navbar navbar-dark bg-primary px-4">
        <span class="navbar-brand mb-0 h1">Révizio</span>
        <a href="<?= site_url('deconnexion') ?>" class="btn btn-outline-light btn-sm">Se déconnecter</a>
    </nav>

    <div class="container mt-5" style="max-width: 600px;">
        <h2 class="mb-4">Ajouter une vidéo de cours</h2>

        <?php if (session()->getFlashdata('succes')): ?>
            <div class="alert alert-success"><?= esc(session()->getFlashdata('succes')) ?></div>
        <?php endif; ?>

        <?php if (session()->has('errors') || validation_list_errors()): ?>
            <div class="alert alert-danger"><?= validation_list_errors() ?></div>
        <?php endif; ?>

        <?= form_open_multipart('cours/ajouter') ?>
            <div class="mb-3">
                <label class="form-label" for="titre">Titre du cours</label>
                <input type="text" name="titre" id="titre" class="form-control" value="<?= esc(old('titre')) ?>">
            </div>

            <div class="mb-3">
                <label class="form-label" for="matiere">Matière</label>
                <select name="matiere" id="matiere" class="form-select">
                    <option value="">Choisir une matière</option>
                    <?php foreach ($matieres as $matiere): ?>
                        <option value="<?= esc($matiere['id']) ?>" <?= old('matiere') === $matiere['id'] ? 'selected' : '' ?>>
                            <?= esc($matiere['nom']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label" for="description">Description (50 caractères maximum)</label>
                <input type="text" name="description" id="description" class="form-control" maxlength="50" value="<?= esc(old('description')) ?>">
            </div>

            <div class="mb-3">
                <label class="form-label" for="video">Vidéo (mp4 ou webm, 50 Mo maximum)</label>
                <input type="file" name="video" id="video" class="form-control" accept="video/mp4,video/webm"> 
               
            </div>

            <button type="submit" class="btn btn-primary w-100">Ajouter le cours</button>
        <?= form_close() ?>
    </div>
</body>
</html>