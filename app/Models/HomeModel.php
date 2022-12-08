<?php

namespace App\Models;

use CodeIgniter\Model;

class HomeModel extends Model
{
    protected $table = 'homes';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['title', 'quote', 'video'];

    /**
     * Model
     * Backend
     **/

    function insertHome($data)
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

    function readHome($id = false)
    {
        if ($id === false) {
            return $this->findAll();
        } else {
            return $this->getWhere(['id' => $id]);
        }
    }

    function editHome($id)
    {
        $builder = $this->table($this->table);
        $builder->where('id', $id);
        $query = $builder->get();
        return $query->getRowArray();
    }

    function getHome($id)
    {
        $builder = $this->table($this->table);
        $builder->where('id', $id);
        $query = $builder->get();
        return $query->getRowArray();
    }

    function deleteHome($id)
    {
        $builder = $this->table($this->table);
        $builder->where('id', $id);
        if ($builder->delete()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Model
     * Frontend
     **/

    public function getHomeTitle()
    {
        $query = $this->db->query(
            'SELECT title, quote FROM homes GROUP by title desc limit 1'
        );
        $result = $query;
        return $result;
    }

    public function getListHome($title = null)
    {
        $builder = $this->db->table('homes');
        $builder->select('*');
        $builder->where(['title' => $title]);
        return $builder->get();
    }
}
