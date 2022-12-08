<?php

namespace App\Models;

use CodeIgniter\Model;

class AboutModel extends Model
{
    protected $table = 'abouts';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['title', 'quote', 'url_video'];

    /**
     * Model
     * Backend
     **/

    function insertAbout($data)
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

    function readAbout($id = false)
    {
        if ($id === false) {
            return $this->findAll();
        } else {
            return $this->getWhere(['id' => $id]);
        }
    }

    function editAbout($id)
    {
        $builder = $this->table($this->table);
        $builder->where('id', $id);
        $query = $builder->get();
        return $query->getRowArray();
    }

    function getAbout($id)
    {
        $builder = $this->table($this->table);
        $builder->where('id', $id);
        $query = $builder->get();
        return $query->getRowArray();
    }

    function deleteAbout($id)
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

    public function getAboutsTitle()
    {
        $query = $this->db->query(
            'SELECT title, quote FROM abouts GROUP by title desc limit 1'
        );
        $result = $query;
        return $result;
    }

    public function getListAbouts($title = null)
    {
        $builder = $this->db->table('abouts');
        $builder->select('*');
        $builder->where(['title' => $title]);
        return $builder->get();
    }
}
