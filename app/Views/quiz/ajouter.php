<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Révizio - Créer un Quiz</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
    <div class="container mt-5 mb-5" style="max-width: 700px;">
        <h2 class="mb-4">Créer un quiz complet (plusieurs questions)</h2>

        <?= form_open('quiz/ajouter') ?>
            <div class="mb-3">
                <label class="form-label font-weight-bold">Titre global du Quiz</label>
                <input type="text" name="titre_quiz" class="form-control" required>
            </div>

            <div class="mb-4">
                <label class="form-label font-weight-bold">Associer au cours</label>
                <select name="cours_id" class="form-select" required>
                    <option value="">Choisir un cours</option>
                    <?php foreach ($cours as $c): ?>
                        <option value="<?= $c['id'] ?>"><?= esc($c['titre']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <hr>
            <h4>Questions du Quiz</h4>

            <!-- QUESTION 1 -->
            <div class="card p-3 mb-3 shadow-sm">
                <div class="mb-2">
                    <label class="form-label"><b>Question 1 : Énoncé</b></label>
                    <input type="text" name="questions[]" class="form-control" required>
                </div>
                <label class="form-label small text-muted">Réponses (coche la bonne réponse)</label>
                
                <div class="input-group input-group-sm mb-2">
                    <div class="input-group-text"><input type="radio" name="correct[0]" value="0" required></div>
                    <input type="text" name="reponses[0][]" class="form-control" placeholder="Réponse 1" required>
                </div>
                <div class="input-group input-group-sm mb-2">
                    <div class="input-group-text"><input type="radio" name="correct[0]" value="1"></div>
                    <input type="text" name="reponses[0][]" class="form-control" placeholder="Réponse 2" required>
                </div>
                <div class="input-group input-group-sm">
                    <div class="input-group-text"><input type="radio" name="correct[0]" value="2"></div>
                    <input type="text" name="reponses[0][]" class="form-control" placeholder="Réponse 3">
                </div>
            </div>

            <!-- QUESTION 2 -->
            <div class="card p-3 mb-4 shadow-sm">
                <div class="mb-2">
                    <label class="form-label"><b>Question 2 : Énoncé</b></label>
                    <input type="text" name="questions[]" class="form-control" required>
                </div>
                <label class="form-label small text-muted">Réponses (coche la bonne réponse)</label>
                
                <div class="input-group input-group-sm mb-2">
                    <div class="input-group-text"><input type="radio" name="correct[1]" value="0" required></div>
                    <input type="text" name="reponses[1][]" class="form-control" placeholder="Réponse 1" required>
                </div>
                <div class="input-group input-group-sm mb-2">
                    <div class="input-group-text"><input type="radio" name="correct[1]" value="1"></div>
                    <input type="text" name="reponses[1][]" class="form-control" placeholder="Réponse 2" required>
                </div>
                <div class="input-group input-group-sm">
                    <div class="input-group-text"><input type="radio" name="correct[1]" value="2"></div>
                    <input type="text" name="reponses[1][]" class="form-control" placeholder="Réponse 3">
                </div>
            </div>

            <button type="submit" class="btn btn-primary w-100 py-2">Enregistrer le Quiz et ses questions</button>
        <?= form_close() ?>
    </div>
</body>
</html>