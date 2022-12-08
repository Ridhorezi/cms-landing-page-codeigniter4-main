<?php

namespace App\Models;
use CodeIgniter\Model;

class ServiceModel extends Model
{
    protected $table = 'services';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'id',
        'services_category_id',
        'title',
        'label_icon',
        'description',
        'quotes',
    ];

    /**
     * Model
     * Backend
     **/

    function insertService($data)
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

    public function readServices()
    {
        $builder = $this->db->table('services');
        $builder->select('*');
        $builder->join(
            'category',
            'category_id = services_category_id',
            'left'
        );
        return $builder->get();
    }

    function editService($id)
    {
        $builder = $this->table($this->table);
        $builder->select('*');
        $builder->join(
            'category',
            'category_id = services_category_id',
            'left'
        );
        $builder->where('id', $id);
        $query = $builder->get();
        return $query->getRowArray();
    }

    function deleteService($id)
    {
        $builder = $this->db->table('services');
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

    public function getServicesTitle()
    {
        $query = $this->db->query(
            'SELECT title, quotes FROM services GROUP by title desc limit 1'
        );
        $result = $query;
        return $result;
    }

    public function getListServices($title = null)
    {
        $builder = $this->db->table('services');
        $builder->select('*');
        $builder->where(['title' => $title]);
        $builder->join(
            'category',
            'category_id = services_category_id',
            'left'
        );
        return $builder->get();
    }
}
