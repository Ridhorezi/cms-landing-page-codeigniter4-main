<?php
namespace App\Controllers\Admin;
use App\Controllers\BaseController;
use App\Models\ServiceModel;

class Services extends BaseController
{

    function __construct() {
        $this->validation = \Config\Services::validation();
        $this->ServiceModel = new ServiceModel();
    }

    function index()
    {

        /** For Read View Index */

        $service_page = [];

        $service_page ['templateJudul'] = 'Services | Page';

        $model = new ServiceModel;

        $data['categories'] = $model->getCategory()->getResult();
        $data['readServices'] = $model->readServices()->getResult();

        /** Layout Header */
        echo view('admin/layout_header', $service_page);

        /** Layout Sidebar */
        echo view('admin/layout_sidebar', $service_page);

        /** Home Index */
        echo view('admin/services/index',$data);

        /** Layout Footer */
        echo view('admin/layout_footer', $service_page);

         /** For Delete Data */

         if ($this->request->getVar('id')) {
            $dataServices = $this->ServiceModel->readServices($this->request->getVar('id'));
            if ($dataServices) {
                $action = $this->ServiceModel->deleteService($this->request->getVar('id'));
                if ($action == true) {
                    return redirect()->to("admin/services/index");
                } else {
                    session()->setFlashdata('warning', ['Failed to delete data']);
                }
            }
        }
    }

    function create() {

        $data = [];

        $model = new ServiceModel;

        $data['category'] = $model->getCategory()->getResult();
        $data['readServices'] = $model->readServices()->getResult();

        if ($this->request->getMethod() == 'post') {

            $data = $this->request->getVar();
            
            $rulles = [
                'title' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Title cannot be empty'
                    ],
                ],
                'quotes' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Quote cannot be empty'
                    ],
                ],
                'services_category_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Category cannot be empty'
                    ],
                ],
                'description' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'description cannot be empty'
                    ],
                ],
            ];

            if (!$this->validate($rulles)) {
                session()->setFlashdata('warning', $this->validation->getErrors());
            } else {
                $record = [
                    'title' => $this->request->getVar('title'),
                    'quotes' => $this->request->getVar('quotes'),
                    'services_category_id' => $this->request->getVar('services_category_id'),
                    'description' => $this->request->getVar('description'),
                ];
                $action = $this->ServiceModel->insertService($record);
                if ($action != false) {
                    $id = $action;
                    session()->setFlashdata('success', 'Data Successfully Saved');
                    return redirect()->to('admin/services/index');
                } else {
                    session()->setFlashdata('warning', 'Data Unsuccessfully Saved');
                    return redirect()->to('admin/services/create');
                }
            }
        } 
        
        $create_page ['templateJudul'] = 'Create | Page';

        /** Layout Header */
        echo view('admin/layout_header', $create_page);

        /** Layout Sidebar */
        echo view('admin/layout_sidebar', $create_page);

        /** Home Create */
        echo view('admin/services/create', $data);

        /** Layout Footer */
        echo view('admin/layout_footer', $create_page);

    }

    function edit($id)
    {
        $edit_page = [];
    
        $model = new ServiceModel;

        $edit_page ['templateJudul'] = 'Edit | Page';

        $dataServices = $this->ServiceModel->editService($id);

        if (empty($dataServices)) {
            return redirect()->to('admin/services/edit');
        }

        $data = $dataServices;

        // dd($data);

        $data['category'] = $model->getCategory()->getResult();

        // dd($dataServices);

        if ($this->request->getMethod() == 'post') {

            // var_dump($data);

            $data = $this->request->getVar();

            $rulles = [
                'title' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Title cannot be empty'
                    ],
                ],
                'quotes' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Quote cannot be empty'
                    ],
                ],
                'services_category_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Category cannot be empty'
                    ],
                ],
                'description' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'description cannot be empty'
                    ],
                ],
            ];

            if (!$this->validate($rulles)) {
                session()->setFlashdata('warning', $this->validation->getErrors());
            } else {
                $record = [
                    'title' => $this->request->getVar('title'),
                    'quotes' => $this->request->getVar('quotes'),
                    'services_category_id' => $this->request->getVar('services_category_id'),
                    'description' => $this->request->getVar('description'),
                    'id'    => $id
                ];
                $action = $this->ServiceModel->insertService($record);
                if ($action != false) {
                    $id = $action;
                    session()->setFlashdata('success', 'Data Successfully Updated');
                    return redirect()->to('admin/services/index');
                } else {
                    session()->setFlashdata('warning', 'Data Unsuccessfully Updated');
                    return redirect()->to('admin/services/edit');
                }
            }
        }

         /** Layout Header */
         echo view('admin/layout_header', $edit_page);

         /** Layout Sidebar */
         echo view('admin/layout_sidebar', $edit_page);
 
         /** Home Create */
         echo view('admin/services/edit', $data);
 
         /** Layout Footer */
         echo view('admin/layout_footer', $edit_page);
    }
}