<?php

namespace App\Models;

use CodeIgniter\Model;

class ReponseModel extends Model
{
    protected $table         = 'reponse';
    protected $primaryKey    = 'id';
    protected $returnType    = 'array';
    // id_1 = id de la question associée, est_correct = 1 (vrai) ou 0 (faux)
    protected $allowedFields = ['texte', 'est_correct', 'id_1'];
}