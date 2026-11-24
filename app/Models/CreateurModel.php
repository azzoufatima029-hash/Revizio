<?php

namespace App\Models;

use CodeIgniter\Model;

class CreateurModel extends Model

{
    #$table indique la table concernée.
    protected $table         = 'createur';
    #$primaryKey indique sa clé primaire.
    protected $primaryKey    = 'id';
    protected $returnType    = 'array';
    #$allowedFields liste les colonnes que le code a le droit de remplir : c’est une protection du framework.
    protected $allowedFields = ['nom', 'email', 'mot_de_passe', 'role', 'date_creation', 'id_matiere'];
}


