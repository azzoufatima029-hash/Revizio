<?php

namespace App\Controllers;

use App\Models\QuizModel;
use App\Models\QuestionModel;
use App\Models\ReponseModel;
use App\Models\CoursModel;

class Quiz extends BaseController
{
    public function ajouter($coursId = null)
    {
        if (! session()->get('isLoggedIn')) {
            return redirect()->to('/connexion');
        }

        helper(['form', 'url']);

        $quizModel = new QuizModel();
        $questionModel = new QuestionModel();
        $reponseModel = new ReponseModel();
        $coursModel = new CoursModel();

        if ($this->request->is('post')) {
            $coursId = $this->request->getPost('cours_id');
            $cours = $coursModel->find($coursId);

            if (!$cours) {
                return redirect()->back()->withInput()->with('erreur', 'Le cours sélectionné est invalide.');
            }

            $regles = [
                'titre_quiz' => 'required|min_length[3]|max_length[150]',
                'cours_id'   => 'required',
                'questions'  => 'required',
            ];

            if (! $this->validate($regles)) {
                $data['validation'] = $this->validator;
                $data['cours'] = $coursModel->findAll();
                return view('quiz/ajouter', $data);
            }

            // 1. Enregistrement du Quiz
            $quizId = $quizModel->insert([
                'titre' => $this->request->getPost('titre_quiz'),
                'id_1'  => $coursId,
                'id_2'  => $cours['id_2'] ?? null,
            ]);

            if ($quizId) {
                // Récupération du tableau des questions envoyées
                $questions = $this->request->getPost('questions');
                $toutesReponses = $this->request->getPost('reponses'); // Tableau multidimensionnel [q_index][r_index]
                $bonnesReponses = $this->request->getPost('correct');   // Tableau [q_index] = index de la bonne réponse

                if (!empty($questions)) {
                    foreach ($questions as $qIndex => $enonceQuestion) {
                        if (!empty($enonceQuestion)) {
                            
                            // 2. Enregistrement de chaque question
                            $questionId = $questionModel->insert([
                                'enonce' => $enonceQuestion,
                                'id_1'   => $quizId,
                            ]);

                            // 3. Enregistrement des réponses associées à cette question
                            if ($questionId && isset($toutesReponses[$qIndex])) {
                                $reponsesQuestion = $toutesReponses[$qIndex];
                                $bonneReponseIndex = $bonnesReponses[$qIndex] ?? 0;

                                foreach ($reponsesQuestion as $rIndex => $texteReponse) {
                                    if (!empty($texteReponse)) {
                                        $reponseModel->insert([
                                            'texte'       => $texteReponse,
                                            'est_correct' => ($rIndex == $bonneReponseIndex) ? 1 : 0,
                                            'id_1'        => $questionId,
                                        ]);
                                    }
                                }
                            }
                        }
                    }
                }

                return redirect()->to('/cours')->with('succes', 'Le quiz et ses questions ont bien été enregistrés !');
            }
        }

        $data['cours'] = $coursModel->findAll();
        return view('quiz/ajouter', $data);
    }
}