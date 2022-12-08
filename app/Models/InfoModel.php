<?php

namespace App\Models;

use CodeIgniter\Model;

class InfoModel extends Model
{
    protected $table = 'info';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields = [
        'company_name',
        'company_contact',
        'company_mail',
        'company_location',
        'copyright',
    ];

    function insertInfo($data)
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

    function readInfo($id = false)
    {
        if ($id === false) {
            return $this->findAll();
        } else {
            return $this->getWhere(['id' => $id]);
        }
    }

    function editInfo($id)
    {
        $builder = $this->table($this->table);
        $builder->where('id', $id);
        $query = $builder->get();
        return $query->getRowArray();
    }

    function getInfo($id)
    {
        $builder = $this->table($this->table);
        $builder->where('id', $id);
        $query = $builder->get();
        return $query->getRowArray();
    }

    function deleteInfo($id)
    {
        $builder = $this->table($this->table);
        $builder->where('id', $id);
        if ($builder->delete()) {
            return true;
        } else {
            return false;
        }
    }

    function getInfoList()
    {
        $query = $this->db->query(
            'SELECT * FROM info GROUP by created_at desc limit 1'
        );
        $result = $query;
        return $result;
    }
}
