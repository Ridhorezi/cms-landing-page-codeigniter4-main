<?php

namespace App\Models;

use CodeIgniter\Model;

class VisitorModel extends Model
{
    function totalVisitors()
    {
        return $this->db->table('visitor_stats')->countAll();
    }

}