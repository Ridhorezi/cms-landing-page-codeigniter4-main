<?php

namespace App\Models;
use CodeIgniter\Model;

class TestimonialModel extends Model
{
    protected $table            = 'testimonials';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['id','image','name','quote','user_profession_id'];

    function insertTestimonial($data)
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

    function getProfessions()
    {
        $builder = $this->db->table('professions');
        return $builder->get();
    }

    public function readTestimonials()
    {
        $builder = $this->db->table('testimonials');
        $builder->select('*');
        $builder->join('professions', 'profession_id = user_profession_id','left');
        return $builder->get();
    }

    function editTestimonial($id)
    {
        $builder = $this->table($this->table);
        $builder->select('*');
        $builder->join('professions', 'profession_id = user_profession_id','left');
        $builder->where('id', $id);
        $query = $builder->get();
        return $query->getRowArray();
    }

    function deleteTestimonial($id)
    {
        $builder = $this->db->table('works');
        $builder->where('id', $id);
        if ($builder->delete()) {
            return true;
        } else {
            return false;
        }
    }

}