<?php

namespace App\Models;

use CodeIgniter\Model;

class ContactModel extends Model
{
    protected $table = 'contacts';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['name','email','subject','message'];

    function insertContact($data)
    {
        $builder = $this->table($this->table);

        if (isset($data['id'])) {
            $action = $builder->save($data);
            $id = $data['id'];
        } else {
            $action = $builder->save($data);
            $id = $builder->getInsertID();
        }

        if ($action) {
            return $id;
        } else {
            return false;
        }
    }

    function readContacts($id = false)
    {
        if($id === false){
            return $this->findAll();
        }else{
            return $this->getWhere(['id' => $id]);
        }   
    }

    function editContact($id)
    {
        $builder = $this->table($this->table);
        $builder->where('id', $id);
        $query = $builder->get();
        return $query->getRowArray();
    }

    function getContacts($id)
    {
        $builder = $this->table($this->table);
        $builder->where('id', $id);
        $query = $builder->get();
        return $query->getRowArray();
    }

    function deleteContact($id)
    {
        $builder = $this->table($this->table);
        $builder->where('id', $id);
        if ($builder->delete()) {
            return true;
        } else {
            return false;
        }
    }

    function totalMessages()
    {
        return $this->db->table('contacts')->countAll();
    }

}