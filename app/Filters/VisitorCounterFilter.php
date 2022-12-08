<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class VisitorCounterFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('visitor_stats');

        $data = [
            'ip_address' => $_SERVER['REMOTE_ADDR'],
            'user_agent' => $_SERVER['HTTP_USER_AGENT']
        ];

        $builder->insert($data);
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        
    }
}