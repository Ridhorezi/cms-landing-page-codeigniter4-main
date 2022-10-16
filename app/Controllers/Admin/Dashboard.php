<?php
namespace App\Controllers\Admin;
use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    function index()
    {
        $data = [];
        $data ['templateJudul'] = 'Admin Dashboard';
        echo view('admin/dashboard', $data);
    }
}