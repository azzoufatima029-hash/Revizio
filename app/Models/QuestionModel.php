<?php

namespace App\Models;

use CodeIgniter\Model;

class QuestionModel extends Model
{
    protected $table         = 'question';
    protected $primaryKey    = 'id';
    protected $returnType    = 'array';
    // id_1 = id du quiz associé
    protected $allowedFields = ['enonce', 'id_1'];
}