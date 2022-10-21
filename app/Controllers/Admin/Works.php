<?php
namespace App\Controllers\Admin;
use App\Controllers\BaseController;

class Works extends BaseController
{
    function index()
    {
        $data = [];
        
        $data ['templateJudul'] = 'Works Page';

        /** Layout Header */
        echo view('admin/layout_header', $data);

        /** Layout Sidebar */
        echo view('admin/layout_sidebar', $data);

        /** Dashboard */
        echo view('admin/works/index', $data);

        /** Layout Footer */
        echo view('admin/layout_footer', $data);
    }
}