<?php 

namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model {    
    
    protected $table = 'admin';
    protected $primaryKey = 'email';
    protected $allowedFields = ['username', 'password', 'nama_lengkap', 'token', 'last_login'];

    public function getData($parameter) {
        $builder = $this->table($this->table);
        $builder->where('username', $parameter); 
        $builder->orWhere('email', $parameter);
        $query = $builder->get(); 
        return $query->getRowArray();
    }

    public function updateData($data) {
        $builder = $this->table($this->table);
        if ($builder->save($data)) {
            return true;
        } else {
            return false;
        }
    }

    function getLastLogin()
    {
        $builder = $this->db->table('admin');
        return $builder->get();
    }

    public function updateAdmin($record) {
        $builder = $this->table($this->table);
        if ($builder->save($record)) {
            return true;
        } else {
            return false;
        }
    }
}