<?php

namespace App\Models;

use CodeIgniter\Model;

class QuizModel extends Model
{
    protected $table         = 'quiz';
    protected $primaryKey    = 'id';
    protected $returnType    = 'array';
    // id_1 = créateur, id_2 = contenu ou cours lié
    protected $allowedFields = ['titre', 'id_1', 'id_2'];
}