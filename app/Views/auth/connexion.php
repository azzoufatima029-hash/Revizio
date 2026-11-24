<?php
$profil = $profil ?? 'createur';          // 'createur' ou 'admin' (fixé par l'adresse)
$actionForm = $actionForm ?? 'connexion';
$emailSaisi = service('request')->getPost('email') ?? '';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Révizio - Connexion</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/auth.css') ?>">
</head>
<body>
<div class="page">
    <div class="gauche">
        <a class="retour" href="<?= site_url('cours') ?>" title="Retour aux cours">&#8592;</a>
        <a class="logo" href="<?= site_url('cours') ?>">Révizio</a>
        <span class="symbole s1">x²</span>
        <span class="symbole s2">π</span> 
        <span class="symbole s3">&#8747;</span>

        <svg class="mascotte" viewBox="0 0 200 190" aria-hidden="true">
            <ellipse cx="100" cy="110" rx="78" ry="70" fill="#FAC775"/>
            <path d="M40 70 Q55 20 85 55 Z" fill="#EF9F27"/>
            <path d="M160 70 Q145 20 115 55 Z" fill="#EF9F27"/>
            <circle cx="68" cy="100" r="30" fill="#fff"/>
            <circle cx="132" cy="100" r="30" fill="#fff"/>
            <circle cx="72" cy="104" r="13" fill="#26215C"/>
            <circle cx="128" cy="104" r="13" fill="#26215C"/>
            <circle cx="76" cy="99" r="4" fill="#fff"/>
            <circle cx="132" cy="99" r="4" fill="#fff"/>
            <path d="M94 118 L106 118 L100 130 Z" fill="#854F0B"/>
            <path d="M80 148 Q100 160 120 148" fill="none" stroke="#633806" stroke-width="3" stroke-linecap="round"/>
        </svg>

        <div class="bulle">
            <b>Révizio</b>
            <span>Content de te revoir. Ta prochaine séance t'attend.</span>
        </div>
    </div>

    <div class="droite">
        <div class="form">
            <h1>Connexion</h1>
            <p class="sous"><?= $profil === 'admin' ? 'Espace administration' : 'Content de te revoir !' ?></p>

            <?php if (session()->getFlashdata('succes')): ?>
                <div class="alerte verte"><?= esc(session()->getFlashdata('succes')) ?></div>
            <?php endif; ?>
            <?php if (isset($validation)): ?>
                <div class="alerte rouge"><?= $validation->listErrors() ?></div>
            <?php endif; ?>
            <?php if (isset($error)): ?>
                <div class="alerte rouge"><?= esc($error) ?></div>
            <?php endif; ?>

            <?= form_open($actionForm) ?>
                <?php if ($profil !== 'admin'): ?>
                    <div class="onglets">
                        <button type="button" class="onglet" disabled title="Bientôt disponible">Élève</button>
                        <button type="button" class="onglet actif">Prof</button>
                    </div>

                    <div class="sociaux">
                        <button type="button" class="social" disabled>Google</button>
                        <button type="button" class="social" disabled>Facebook</button>
                        <button type="button" class="social" disabled>Apple</button>
                    </div>
                    <div class="ou">ou</div>
                <?php endif; ?>

                <label for="email">Email</label>
                <input type="email" name="email" id="email" placeholder="Ex. vous@exemple.com" value="<?= esc($emailSaisi) ?>" required>

                <div class="ligne-mdp">
                    <label for="mot_de_passe">Mot de passe</label>
                    <a href="#">Mot de passe oublié ?</a>
                </div>
                <input type="password" name="mot_de_passe" id="mot_de_passe" placeholder="Votre mot de passe" required>

                <button type="submit" class="valider">Se connecter</button>
            <?= form_close() ?>
        </div>
    </div>
</div>

</body>
</html>