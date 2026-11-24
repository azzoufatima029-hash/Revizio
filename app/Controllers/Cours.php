<?php

namespace App\Controllers;

use App\Models\ContenuModel;
use App\Models\CoursModel;
use App\Models\MatiereModel;

class Cours extends BaseController
{
    public function ajouter()
    {
        // Page réservée aux créateurs connectés
        if (! session()->get('isLoggedIn')) {
            return redirect()->to('/connexion');
        }

        helper(['form']);

        // Les matières servent à remplir la liste déroulante
        $data['matieres'] = (new MatiereModel())->findAll();

        if ($this->request->is('post')) {
            $regles = [
                'titre'       => 'required|min_length[3]|max_length[150]',
                'description' => 'permit_empty|max_length[50]',
                'matiere'     => 'required|is_not_unique[matiere.id]',
                'video'       => 'uploaded[video]|max_size[video,51200]',
            ];

            if ($this->validate($regles)) {
                // 1. On range la vidéo dans public/uploads/videos avec un nom aléatoire
                $fichier = $this->request->getFile('video');
                $nomFichier = $fichier->getRandomName();
                
                $cibleMove = FCPATH . 'uploads/videos';
                log_message('info', 'On essaie d\'écrire dans le repertoire suivant:' . $cibleMove);
                $fichier->move($cibleMove, $nomFichier);

                // 2. On crée le contenu (son id est du texte, fabriqué ici)
                $idContenu = uniqid('c_');
                (new ContenuModel())->insert([
                    'id'   => $idContenu,
                    'id_1' => $this->request->getPost('matiere'),
                ]);

                // 3. On crée le cours, rattaché au contenu et au créateur connecté
                (new CoursModel())->insert([
                    'titre'         => $this->request->getPost('titre'),
                    'description'   => $this->request->getPost('description'),
                    'fichier_video' => $nomFichier,
                    'date_ajout'    => date('Y-m-d H:i:s'),
                    'id_1'          => session()->get('id'),
                    'id_2'          => $idContenu,
                ]);

                return redirect()->to('/cours/ajouter')->with('succes', 'Le cours a bien été ajouté.');
            }
        }

        return view('cours/ajouter', $data);
    }

    // Permet d'afficher la liste de tous les cours (accessible pour éviter l'erreur 404 lors des redirections)
    public function index()
    {
        $coursModel = new CoursModel();
        $data['cours'] = $coursModel->findAll();

        return view('cours/liste', $data);
    }
}