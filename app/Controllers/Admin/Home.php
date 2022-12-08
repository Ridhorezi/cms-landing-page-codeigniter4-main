<?php
namespace App\Controllers\Admin;
use App\Controllers\BaseController;
use App\Models\HomeModel;

class Home extends BaseController
{
    
    function __construct() {
        $this->validation = \Config\Services::validation();
        $this->HomeModel = new HomeModel();
    }

    function index()
    {

        /** For Delete Data */

        if ($this->request->getVar('id')) {
            $dataHome = $this->HomeModel->getHome($this->request->getVar('id'));
            if ($dataHome['id']) {
                @unlink("assets/video"."/".$dataHome['video']);
                $action = $this->HomeModel->deleteHome($this->request->getVar('id'));
                if ($action == true) {
                    return redirect()->to(base_url('admin/home/index'));
                } else {
                    session()->setFlashdata('warning', ['Failed to delete data']);
                }
            }
        }

        /** For Read View Index */

        $home_page = [];

        $home_page ['templateJudul'] = 'Home Page';

        $model = new HomeModel;

        $data['readHome'] = $model->readHome();

        /** Layout Header */
        echo view('admin/layout_header', $home_page);

        /** Layout Sidebar */
        echo view('admin/layout_sidebar', $home_page);

        /** Home Index */
        echo view('admin/home/index',$data);

        /** Layout Footer */
        echo view('admin/layout_footer', $home_page);
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
            ];

            $file = $this->request->getFile('video');

            if (!$this->validate($rulles)) {
                session()->setFlashdata('warning', $this->validation->getErrors());
            }elseif ($file->getExtension() != 'mp4') {
                session()->setFlashdata('warning', ["only mp4 file are allowed"]);
            } else {
                $video = null;
                if ($file->getName()) {
                    $video = $file->getRandomName();
                }
                $record = [
                    'title' => $this->request->getVar('title'),
                    'quote' => $this->request->getVar('quote'),
                    'video' => $video
                ];
                $action = $this->HomeModel->insertHome($record);
                if ($action != false) {
                    $id = $action;
                    if ($file->getName()) {
                        $directory = "assets/video";
                        $file->move($directory, $video);
                    }
                    session()->setFlashdata('success', 'Data Successfully Saved');
                    return redirect()->to(base_url('admin/home/index'));
                } else {
                    session()->setFlashdata('warning', 'Data Unsuccessfully Saved');
                    return redirect()->to(base_url('admin/home/create'));
                }
            }
        }
        
        $create_page ['templateJudul'] = 'Create Page';

         /** Layout Header */
         echo view('admin/layout_header', $create_page);

         /** Layout Sidebar */
         echo view('admin/layout_sidebar', $create_page);
 
         /** Home Create */
         echo view('admin/home/create', $create_page);
 
         /** Layout Footer */
         echo view('admin/layout_footer', $create_page);
    }

    function edit($id)
    {
        $edit_page = [];

        $edit_page ['templateJudul'] = 'Edit Page';

        $dataHome = $this->HomeModel->editHome($id);

        if (empty($dataHome)) {
            return redirect()->to(base_url('admin/home/edit'));
        }

        $data = $dataHome;

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
            ];

            $file = $this->request->getFile('video');

            if (!$this->validate($rulles)) {
                session()->setFlashdata('warning', $this->validation->getErrors());
            } else {
                $video = $dataHome['video'];
                if ($file->getName()) {
                    $video = $file->getRandomName();
                }
                $record = [
                    'title' => $this->request->getVar('title'),
                    'quote' => $this->request->getVar('quote'),
                    'video' => $video,
                    'id'    => $id
                ];
                $action = $this->HomeModel->insertHome($record);
                if ($action != false) {
                    $id = $action;
                    if ($file->getName()) {
                        if ($dataHome['video']) {
                            @unlink("assets/video"."/".$dataHome['video']);
                        }
                        $directory = "assets/video";
                        $file->move($directory, $video);
                    }
                    session()->setFlashdata('success', 'Data Successfully Updated');
                    return redirect()->to(base_url('admin/home/index'));
                } else {
                    session()->setFlashdata('warning', 'Data Unsuccessfully Updated');
                    return redirect()->to(base_url('admin/home/edit'));
                }
            }
        }

         /** Layout Header */
         echo view('admin/layout_header', $edit_page);

         /** Layout Sidebar */
         echo view('admin/layout_sidebar', $edit_page);
 
         /** Home Create */
         echo view('admin/home/edit', $data);
 
         /** Layout Footer */
         echo view('admin/layout_footer', $edit_page);
    }
}