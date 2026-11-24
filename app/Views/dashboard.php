<?php
// Initiales de l'avatar (ex. "Fatima Azzou" -> "FA")
$mots = preg_split('/\s+/', trim(session()->get('nom') ?? ''));
$initiales = mb_strtoupper(mb_substr($mots[0] ?? '', 0, 1) . (isset($mots[1]) ? mb_substr($mots[1], 0, 1) : ''));
// Couleurs des pastilles de matières : [couleur, fond clair]
$palette = [['#534AB7', '#E4E2F8'], ['#1E8A6E', '#D5EDE6'], ['#D85A30', '#F8E0D8'], ['#BA7517', '#F1E4CC']];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Révizio - Mes matières</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/dashboard.css') ?>">
</head>
<body>
    <nav>
        <div class="gauche">
            <a class="logo" href="<?= site_url('tableau-de-bord') ?>">Révizio</a>
            <div class="liens">
                <a class="actif" href="<?= site_url('tableau-de-bord') ?>">Mes matières</a>
                <a href="<?= site_url('cours') ?>">Les cours</a>
                <a href="<?= site_url('cours/ajouter') ?>">Ajouter un cours</a>
            </div>
        </div>
        <div class="droite">
            <span class="badge">Enseignant</span>
            <div class="avatar"><?= esc($initiales) ?></div>
            <a class="deco" href="<?= site_url('deconnexion') ?>">Se déconnecter</a>
        </div>
    </nav>

    <main>
        <h1>Mes matières</h1>

        <div class="cartes">
            <?php foreach ($matieres as $i => $m): ?>
                <?php [$couleur, $fond] = $palette[$i % count($palette)]; ?>
                <div class="carte">
                    <div class="pastille"><span></span></div>
                    <h3><?= esc($m['nom']) ?></h3>
                    <p><?= (int) $m['nb'] ?> cours déposé<?= $m['nb'] > 1 ? 's' : '' ?></p>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="panneau">
            <div class="entete">
                <h2>Mes derniers cours</h2>
                <a class="bouton" href="<?= site_url('cours/ajouter') ?>">Ajouter une vidéo de cours</a>
            </div>

            <?php if (empty($cours)): ?>
                <p class="vide">Aucun cours déposé pour le moment.</p>
            <?php endif; ?>

            <?php foreach ($cours as $i => $c): ?>
                <div class="ligne">
                    <div class="play"></div>
                    <div>
                        <div class="titre"><?= esc($c['titre']) ?></div>
                        <div class="meta"><?= esc($c['matiere']) ?> · ajouté le <?= esc(date('d/m/Y', strtotime($c['date_ajout']))) ?></div>
                    </div>
                    <a class="voir" href="<?= site_url('cours') ?>">Voir</a>
                </div>
            <?php endforeach; ?>
        </div>
    </main>
</body>
</html>