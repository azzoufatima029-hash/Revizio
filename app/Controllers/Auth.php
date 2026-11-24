<?php

namespace App\Controllers;

use App\Models\CreateurModel;
use App\Models\MatiereModel;

class Auth extends BaseController
{
   public function inscription()
    {
        helper(['form']);

        // Les matières servent à remplir la liste déroulante du formulaire
        $data['matieres'] = (new MatiereModel())->findAll();

        if ($this->request->is('post')) {
            $regles = [
                'nom'          => 'required|min_length[2]|max_length[100]',
                'email'        => 'required|valid_email|is_unique[createur.email]',
                'matiere'      => 'required|is_not_unique[matiere.id]',
                'mot_de_passe' => 'required|min_length[8]',
                'confirmation' => 'required|matches[mot_de_passe]',
            ];

            if ($this->validate($regles)) {
                $model = new CreateurModel();
                $model->insert([
                    'nom'           => $this->request->getPost('nom'),
                    'email'         => $this->request->getPost('email'),
                    'mot_de_passe'  => password_hash($this->request->getPost('mot_de_passe'), PASSWORD_DEFAULT),
                    'role'          => 'createur',
                    'date_creation' => date('Y-m-d H:i:s'),
                    'id_matiere'    => $this->request->getPost('matiere'),
                ]);

                return redirect()->to('/connexion')->with('succes', 'Compte créé, vous pouvez vous connecter.');
            }
        }

        return view('auth/inscription', $data);
    }
    #la méthode connexion()
    // Page de connexion publique (créateurs, bientôt élèves)
    public function connexion()
    {
        return $this->traiterConnexion('createur');
    }

    // Page de connexion de l'administrateur (adresse non affichée sur le site)
    public function connexionAdmin()
    {
        return $this->traiterConnexion('admin');
    }

    // Logique commune : $profil est le rôle attendu pour cette page
    private function traiterConnexion(string $profil)
    {
        helper(['form']);
        $data = [
            'profil'     => $profil,
            'actionForm' => $profil === 'admin' ? 'admin/connexion' : 'connexion',
        ];

        if ($this->request->is('post')) {
            $regles = [
                'email'        => 'required|valid_email',
                'mot_de_passe' => 'required',
            ];

            if ($this->validate($regles)) {
                $user = (new CreateurModel())->where('email', $this->request->getPost('email'))->first();

                // Il faut : un compte, le bon mot de passe ET le bon rôle pour cette page
                if ($user
                    && password_verify($this->request->getPost('mot_de_passe'), $user['mot_de_passe'])
                    && $user['role'] === $profil) {

                    session()->regenerate();
                    session()->set([
                        'id'         => $user['id'],
                        'nom'        => $user['nom'],
                        'email'      => $user['email'],
                        'role'       => $user['role'],
                        'id_matiere' => $user['id_matiere'],
                        'isLoggedIn' => true,
                    ]);

                    return redirect()->to($profil === 'admin' ? '/admin/comptes' : '/tableau-de-bord');
                }

                // Même message dans tous les cas d'échec
                $data['error'] = 'Email ou mot de passe incorrect.';
            } else {
                $data['validation'] = $this->validator;
            }
        }

        return view('auth/connexion', $data);
    }
        public function deconnexion()
    {
        session()->destroy();
        return redirect()->to('/connexion');
    }
   
}

