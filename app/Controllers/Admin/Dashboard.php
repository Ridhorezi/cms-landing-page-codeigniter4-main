<?php
namespace App\Controllers\Admin;
use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    function index()
    {
        $data = [];
        
        $data ['templateJudul'] = 'Admin Dashboard';

        /** Layout Header */
        echo view('admin/layout_header', $data);

        /** Layout Sidebar */
        echo view('admin/layout_sidebar', $data);

        /** Dashboard */
        echo view('admin/dashboard', $data);

        /** Layout Footer */
        echo view('admin/layout_footer', $data);
    }
}