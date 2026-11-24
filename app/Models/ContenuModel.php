<?php

namespace App\Models;

use CodeIgniter\Model;

class ContenuModel extends Model
{
    protected $table         = 'contenu';
    protected $primaryKey    = 'id';
    protected $useAutoIncrement = false;   // l'id est du texte, fourni par le code
    protected $returnType    = 'array';
    // id_1 = identifiant de la matière du contenu
    protected $allowedFields = ['id', 'id_1'];
}