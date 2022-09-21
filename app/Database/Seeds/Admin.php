<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Admin extends Seeder
{
    public function run()
    {
        $data = [
          'username' => 'admin',
          'password' => password_hash('password', PASSWORD_BCRYPT),
          'nama_lengkap' => 'Ridho Suhaebi',
          'email' => 'ridhosuhaebi01@gmail.com',
        ];
        $this->db->table('admin')->insert($data);
    }
}
