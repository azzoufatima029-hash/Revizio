<?php

namespace App\Models;

use CodeIgniter\Model;

class MatiereModel extends Model
{
    protected $table         = 'matiere';
    protected $primaryKey    = 'id';
    protected $useAutoIncrement = false;   // l'id est du texte
    protected $returnType    = 'array';
    protected $allowedFields = ['id', 'nom'];
}