<?php

namespace App\Controllers;

use App\Models\CoursModel;

class Dashboard extends BaseController
{
    public function index()
    {
        // Page réservée : si personne n'est connecté, retour à la connexion
        if (! session()->get('isLoggedIn')) {
            return redirect()->to('/connexion');
        }

        $idCreateur = session()->get('id');
        $db = \Config\Database::connect();

        // Chaque matière, avec le nombre de cours déposés par ce créateur
        $matieres = $db->table('matiere')
            ->select('matiere.id, matiere.nom, COUNT(cours.id) AS nb')
            ->join('contenu', 'contenu.id_1 = matiere.id', 'left')
            ->join('cours', 'cours.id_2 = contenu.id AND cours.id_1 = ' . $db->escape($idCreateur), 'left')
            ->groupBy('matiere.id, matiere.nom')
            ->get()
            ->getResultArray();

        // Ses 6 derniers cours
        $cours = (new CoursModel())
            ->select('cours.id, cours.titre, cours.date_ajout, matiere.nom AS matiere')
            ->join('contenu', 'contenu.id = cours.id_2')
            ->join('matiere', 'matiere.id = contenu.id_1')
            ->where('cours.id_1', $idCreateur)
            ->orderBy('cours.date_ajout', 'DESC')
            ->limit(6)
            ->findAll();

        return view('dashboard', [
            'matieres' => $matieres,
            'cours'    => $cours,
        ]);
    }
}