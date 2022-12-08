<?php
namespace App\Controllers\Admin;
use App\Controllers\BaseController;
use App\Models\TestimonialModel;

class Testimonials extends BaseController
{

    function __construct() {
        $this->validation = \Config\Services::validation();
        $this->TestimonialModel = new TestimonialModel();
    }

    function index()
    {

        /** For Read View Index */

        $testimonials_page = [];

        $testimonials_page ['templateJudul'] = 'Testimonial | Page';

        $model = new TestimonialModel;

        $data['professions'] = $model->getProfessions()->getResult();
        $data['readTestimonials'] = $model->readTestimonials()->getResult();

        /** Layout Header */
        echo view('admin/layout_header', $testimonials_page);

        /** Layout Sidebar */
        echo view('admin/layout_sidebar', $testimonials_page);

        /** Home Index */
        echo view('admin/testimonials/index',$data);

        /** Layout Footer */
        echo view('admin/layout_footer', $testimonials_page);

         /** For Delete Data */

         if ($this->request->getVar('id')) {
            $dataTestimonials = $this->TestimonialModel->readTestimonials($this->request->getVar('id'));
            if ($dataTestimonials) {
                $action = $this->TestimonialModel->deleteTestimonial($this->request->getVar('id'));
                if ($action == true) {
                    return redirect()->to(base_url('admin/testimonials/index'));
                } else {
                    session()->setFlashdata('warning', ['Failed to delete data']);
                }
            }
        }
    }

    function create() {

        $data = [];

        $model = new TestimonialModel;

        $data['professions'] = $model->getProfessions()->getResult();
        $data['readTestimonials'] = $model->readTestimonials()->getResult();

        if ($this->request->getMethod() == 'post') {

            $data = $this->request->getVar();
            
            $rulles = [
                'image' => [
                    'rules' => 'is_image[image]',
                    'errors' => [
                        'required' => 'Only image file are allowed'
                    ],
                ],
                'quote' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Quote cannot be empty'
                    ],
                ],
                'name' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'name cannot be empty'
                    ],
                ],
                'user_profession_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Profession cannot be empty'
                    ],
                ],
            ];

            $file = $this->request->getFile('image');

            if (!$this->validate($rulles)) {
                session()->setFlashdata('warning', $this->validation->getErrors());
            } else {
                $image = null;
                if ($file->getName()) {
                    $image = $file->getRandomName();
                }
                $record = [
                    'image' => $image,
                    'quote' => $this->request->getVar('quote'),
                    'user_profession_id' => $this->request->getVar('user_profession_id'),
                    'name' => $this->request->getVar('name'),
                ];
                $action = $this->TestimonialModel->insertTestimonial($record);
                if ($action != false) {
                    $id = $action;
                    if ($file->getName()) {
                        $directory = 'assets/image';
                        $file->move($directory, $image);
                    }
                    session()->setFlashdata('success', 'Data Successfully Saved');
                    return redirect()->to(base_url('admin/testimonials/index'));
                } else {
                    session()->setFlashdata('warning', 'Data Unsuccessfully Saved');
                    return redirect()->to(base_url('admin/testimonials/create'));
                }
            }
        } 
        
        $create_page ['templateJudul'] = 'Create | Page';

        /** Layout Header */
        echo view('admin/layout_header', $create_page);

        /** Layout Sidebar */
        echo view('admin/layout_sidebar', $create_page);

        /** Home Create */
        echo view('admin/testimonials/create', $data);

        /** Layout Footer */
        echo view('admin/layout_footer', $create_page);

    }

    function edit($id)
    {
        $edit_page = [];
    
        $model = new TestimonialModel;

        $edit_page ['templateJudul'] = 'Edit | Page';

        $dataTestimonials = $this->TestimonialModel->editTestimonial($id);

        if (empty($dataTestimonials)) {
            return redirect()->to(base_url('admin/testimonials/edit'));
        }

        $data = $dataTestimonials;

        // dd($data);

        $data['professions'] = $model->getProfessions()->getResult();

        // dd($dataServices);

        if ($this->request->getMethod() == 'post') {

            // var_dump($data);

            $data = $this->request->getVar();

            $rulles = [
                'image' => [
                    'rules' => 'is_image[image]',
                    'errors' => [
                        'required' => 'Only image file are allowed'
                    ],
                ],
                'quote' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Quote cannot be empty'
                    ],
                ],
                'name' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Name cannot be empty'
                    ],
                ],
                'user_profession_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Profession cannot be empty'
                    ],
                ],
            ];

            $file = $this->request->getFile('image');

            if (!$this->validate($rulles)) {
                session()->setFlashdata('warning', $this->validation->getErrors());
            } else {
                $image = $dataTestimonials['image'];
                if ($file->getName()) {
                    $image = $file->getRandomName();
                }
                $record = [
                    'image' => $image,
                    'quote' => $this->request->getVar('quote'),
                    'user_profession_id' => $this->request->getVar('user_profession_id'),
                    'name' => $this->request->getVar('name'),
                    'id'    => $id
                ];
                $action = $this->TestimonialModel->insertTestimonial($record);
                if ($action != false) {
                    $id = $action;
                    if ($file->getName()) {
                        if ($dataTestimonials['image']) {
                            @unlink('assets/image' . '/' . $dataTestimonials['image']);
                        }
                        $directory = 'assets/image';
                        $file->move($directory, $image);
                    }
                    session()->setFlashdata('success', 'Data Successfully Updated');
                    return redirect()->to(base_url('admin/testimonials/index'));
                } else {
                    session()->setFlashdata('warning', 'Data Unsuccessfully Updated');
                    return redirect()->to(base_url('admin/testimonials/edit'));
                }
            }
        }

         /** Layout Header */
         echo view('admin/layout_header', $edit_page);

         /** Layout Sidebar */
         echo view('admin/layout_sidebar', $edit_page);
 
         /** Home Create */
         echo view('admin/testimonials/edit', $data);
 
         /** Layout Footer */
         echo view('admin/layout_footer', $edit_page);
    }
}