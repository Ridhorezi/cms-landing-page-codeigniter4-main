<?php
namespace App\Controllers\Admin;
use App\Controllers\BaseController;
use App\Models\AboutModel;

class Abouts extends BaseController
{

    function __construct() {
        $this->validation = \Config\Services::validation();
        $this->AboutModel = new AboutModel();
    }

    function index()
    {

        /** For Delete Data */

        if ($this->request->getVar('id')) {
            $dataAbout = $this->AboutModel->getAbout($this->request->getVar('id'));
            if ($dataAbout['id']) {
                $action = $this->AboutModel->deleteAbout($this->request->getVar('id'));
                if ($action == true) {
                    return redirect()->to(base_url('admin/abouts/index'));
                } else {
                    session()->setFlashdata('warning', ['Failed to delete data']);
                }
            }
        }

        $data = [];
        
        $data ['templateJudul'] = 'Abouts | Page';

        $model = new AboutModel;

        $data['readAbout'] = $model->readAbout();

        /** Layout Header */
        echo view('admin/layout_header', $data);

        /** Layout Sidebar */
        echo view('admin/layout_sidebar', $data);

        /** Dashboard */
        echo view('admin/abouts/index', $data);

        /** Layout Footer */
        echo view('admin/layout_footer', $data);
    }

    function create() {

        $data = [];

        if ($this->request->getMethod() == 'post') {

            $data = $this->request->getVar();

            $rulles = [
                'title' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Title cannot be empty'
                    ],
                ],
                'quote' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Quote cannot be empty'
                    ],
                ],
                'url_video' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Url Video cannot be empty'
                    ],
                ],
            ];

            if (!$this->validate($rulles)) {
                session()->setFlashdata('warning', $this->validation->getErrors());
            } else {
                $record = [
                    'title'     => $this->request->getVar('title'),
                    'quote'     => $this->request->getVar('quote'),
                    'url_video' => $this->request->getVar('url_video')
                ];
                $action = $this->AboutModel->insertAbout($record);
                if ($action != false) {
                    $id = $action;
                    session()->setFlashdata('success', 'Data Successfully Saved');
                    return redirect()->to(base_url('admin/abouts/index'));
                } else {
                    session()->setFlashdata('warning', 'Data Unsuccessfully Saved');
                    return redirect()->to(base_url('admin/abouts/create'));
                }
            }
        }
        
        $create_page ['templateJudul'] = 'Create | Page';

         /** Layout Header */
         echo view('admin/layout_header', $create_page);

         /** Layout Sidebar */
         echo view('admin/layout_sidebar', $create_page);
 
         /** Home Create */
         echo view('admin/abouts/create', $create_page);
 
         /** Layout Footer */
         echo view('admin/layout_footer', $create_page);
    }

    function edit($id)
    {
        $edit_page = [];

        $edit_page ['templateJudul'] = 'Edit | Page';

        $dataAbout = $this->AboutModel->editAbout($id);

        if (empty($dataAbout)) {
            return redirect()->to(base_url('admin/abouts/edit'));
        }

        $data = $dataAbout;

        if ($this->request->getMethod() == 'post') {

            $data = $this->request->getVar();

            $rulles = [
                'title' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Title cannot be empty'
                    ],
                ],
                'quote' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Quote cannot be empty'
                    ],
                ],
                'url_video' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Url Video cannot be empty'
                    ],
                ],
            ];

            if (!$this->validate($rulles)) {
                session()->setFlashdata('warning', $this->validation->getErrors());
            } else {
                $record = [
                    'title'     => $this->request->getVar('title'),
                    'quote'     => $this->request->getVar('quote'),
                    'url_video' => $this->request->getVar('url_video'),
                    'id'        => $id
                ];
                $action = $this->AboutModel->insertAbout($record);
                if ($action != false) {
                    $id = $action;
                    session()->setFlashdata('success', 'Data Successfully Updated');
                    return redirect()->to(base_url('admin/abouts/index'));
                } else {
                    session()->setFlashdata('warning', 'Data Unsuccessfully Updated');
                    return redirect()->to(base_url('admin/abouts/edit'));
                }
            }
        }

         /** Layout Header */
         echo view('admin/layout_header', $edit_page);

         /** Layout Sidebar */
         echo view('admin/layout_sidebar', $edit_page);
 
         /** Home Create */
         echo view('admin/abouts/edit', $data);
 
         /** Layout Footer */
         echo view('admin/layout_footer', $edit_page);
    }
}