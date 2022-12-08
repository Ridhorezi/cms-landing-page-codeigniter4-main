<?php

namespace App\Models;
use CodeIgniter\Model;

class WorkModel extends Model
{
    protected $table = 'works';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'id',
        'works_category_id',
        'title',
        'quote',
        'image',
        'filter',
    ];

    /**
     * Model
     * Backend
     **/

    function insertWork($data)
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

    function getCategory()
    {
        $builder = $this->db->table('category');
        return $builder->get();
    }

    public function readWorks()
    {
        $builder = $this->db->table('works');
        $builder->select('*');
        $builder->join('category', 'category_id = works_category_id', 'left');
        return $builder->get();
    }

    function editWork($id)
    {
        $builder = $this->table($this->table);
        $builder->select('*');
        $builder->join('category', 'category_id = works_category_id', 'left');
        $builder->where('id', $id);
        $query = $builder->get();
        return $query->getRowArray();
    }

    function deleteWork($id)
    {
        $builder = $this->db->table('works');
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

    public function getWorksTitle()
    {
        $query = $this->db->query(
            'SELECT title, quote FROM works GROUP by title desc limit 1'
        );
        $result = $query;
        return $result;
    }

    public function getListWorks($title = null)
    {
        $builder = $this->db->table('works');
        $builder->select('*');
        $builder->where(['title' => $title]);
        $builder->join('category', 'category_id = works_category_id', 'left');
        return $builder->get();
    }
}
