<?php
namespace App\Controllers\Admin;
use App\Controllers\BaseController;

class Services extends BaseController
{
    function index()
    {
        $data = [];
        
        $data ['templateJudul'] = 'Services Page';

        /** Layout Header */
        echo view('admin/layout_header', $data);

        /** Layout Sidebar */
        echo view('admin/layout_sidebar', $data);

        /** Dashboard */
        echo view('admin/services/index', $data);

        /** Layout Footer */
        echo view('admin/layout_footer', $data);
    }
}