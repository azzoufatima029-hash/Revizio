<?php

namespace App\Models;

use CodeIgniter\Model;

class CoursModel extends Model
{
    protected $table         = 'cours';
    protected $primaryKey    = 'id';
    protected $returnType    = 'array';
    // id_1 = identifiant du créateur, id_2 = identifiant du contenu
    protected $allowedFields = ['titre', 'description', 'fichier_video', 'date_ajout', 'id_1', 'id_2'];
}