<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run()
    {
        // À MODIFIER : choisis ton propre email et ton propre mot de passe
        $this->db->table('createur')->insert([
            'nom'           => 'Administrateur',
            'email'         => 'adminrevizio@gmail.com',
            'mot_de_passe'  => password_hash('admin.123', PASSWORD_DEFAULT),
            'role'          => 'admin',
            'date_creation' => date('Y-m-d H:i:s'),
            'id_matiere'    => null,
        ]);
    }
}