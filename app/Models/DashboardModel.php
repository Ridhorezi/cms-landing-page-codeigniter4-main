<?php 

namespace App\Models;

use CodeIgniter\Model;

class DashboardModel extends Model {

    protected $table = 'admin';
    protected $primaryKey = 'id';
    protected $allowedFields = ['username', 'fullname', 'email', 'password','created_at'];

    public function updateData($record) {
        $builder = $this->table($this->table);
        if ($builder->save($record)) {
            return true;
        } else {
            return false;
        }
    }

}


