<?php
namespace App\Controllers\Admin;
use App\Controllers\BaseController;
use App\Models\WorkModel;

class Works extends BaseController
{
    function __construct()
    {
        $this->validation = \Config\Services::validation();
        $this->WorkModel = new WorkModel();
    }

    function index()
    {
        $data = [];

        $data['templateJudul'] = 'Works | Page';

        $model = new WorkModel();

        $data['categories'] = $model->getCategory()->getResult();
        $data['readWorks'] = $model->readWorks()->getResult();

        /** Layout Header */
        echo view('admin/layout_header', $data);

        /** Layout Sidebar */
        echo view('admin/layout_sidebar', $data);

        /** Dashboard */
        echo view('admin/works/index', $data);

        /** Layout Footer */
        echo view('admin/layout_footer', $data);

        /** For Delete Data */

        if ($this->request->getVar('id')) {
            $dataWorks = $this->WorkModel->readWorks(
                $this->request->getVar('id')
            );
            if ($dataWorks) {
                $action = $this->WorkModel->deleteWork(
                    $this->request->getVar('id')
                );
                if ($action == true) {
                    return redirect()->to(base_url('admin/works/index'));
                } else {
                    session()->setFlashdata('warning', [
                        'Failed to delete data',
                    ]);
                }
            }
        }
    }

    function create()
    {
        $data = [];

        $model = new WorkModel();

        $data['category'] = $model->getCategory()->getResult();
        $data['readWorks'] = $model->readWorks()->getResult();

        if ($this->request->getMethod() == 'post') {
            $data = $this->request->getVar();

            $rulles = [
                'title' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Title cannot be empty',
                    ],
                ],
                'quote' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Quote cannot be empty',
                    ],
                ],
                'works_category_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Category cannot be empty',
                    ],
                ],
                'image' => [
                    'rules' => 'is_image[image]',
                    'errors' => [
                        'required' => 'only image file are allowed',
                    ],
                ],
                'filter' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'filter cannot be empty',
                    ],
                ],
            ];

            $file = $this->request->getFile('image');

            if (!$this->validate($rulles)) {
                session()->setFlashdata(
                    'warning',
                    $this->validation->getErrors()
                );
            } else {
                $image = null;
                if ($file->getName()) {
                    $image = $file->getRandomName();
                }
                $record = [
                    'title' => $this->request->getVar('title'),
                    'quote' => $this->request->getVar('quote'),
                    'works_category_id' => $this->request->getVar(
                        'works_category_id'
                    ),
                    'filter' => $this->request->getVar('filter'),
                    'image' => $image,
                ];
                $action = $this->WorkModel->insertWork($record);
                if ($action != false) {
                    $id = $action;
                    if ($file->getName()) {
                        $directory = 'assets/image';
                        $file->move($directory, $image);
                    }
                    session()->setFlashdata(
                        'success',
                        'Data Successfully Saved'
                    );
                    return redirect()->to(base_url('admin/works/index'));
                } else {
                    session()->setFlashdata(
                        'warning',
                        'Data Unsuccessfully Saved'
                    );
                    return redirect()->to(base_url('admin/works/create'));
                }
            }
        }

        $create_page['templateJudul'] = 'Create | Page';

        /** Layout Header */
        echo view('admin/layout_header', $create_page);

        /** Layout Sidebar */
        echo view('admin/layout_sidebar', $create_page);

        /** Home Create */
        echo view('admin/works/create', $data);

        /** Layout Footer */
        echo view('admin/layout_footer', $create_page);
    }

    function edit($id)
    {
        $model = new WorkModel();

        $edit_page = [];

        $edit_page['templateJudul'] = 'Edit | Page';

        $dataWorks = $this->WorkModel->editWork($id);

        if (empty($dataWorks)) {
            return redirect()->to(base_url('admin/works/edit'));
        }

        $data = $dataWorks;

        $data['category'] = $model->getCategory()->getResult();

        if ($this->request->getMethod() == 'post') {

            $data = $this->request->getVar();

            $rulles = [
                'title' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Title cannot be empty',
                    ],
                ],
                'quote' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Quote cannot be empty',
                    ],
                ],
                'works_category_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Category cannot be empty',
                    ],
                ],
                'image' => [
                    'rules' => 'is_image[image]',
                    'errors' => [
                        'required' => 'only image file are allowed',
                    ],
                ],
                'filter' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Filter cannot be empty',
                    ],
                ],
            ];

            $file = $this->request->getFile('image');

            if (!$this->validate($rulles)) {
                session()->setFlashdata(
                    'warning',
                    $this->validation->getErrors()
                );
            } else {
                $image = $dataWorks['image'];
                if ($file->getName()) {
                    $image = $file->getRandomName();
                }
                $record = [
                    'title' => $this->request->getVar('title'),
                    'quote' => $this->request->getVar('quote'),
                    'works_category_id' => $this->request->getVar(
                        'works_category_id'
                    ),
                    'filter' => $this->request->getVar('filter'),
                    'image' => $image,
                    'id'    => $id
                ];
                $action = $this->WorkModel->insertWork($record);
                if ($action != false) {
                    $id = $action;
                    if ($file->getName()) {
                        if ($dataWorks['image']) {
                            @unlink('assets/image' . '/' . $dataWorks['image']);
                        }
                        $directory = 'assets/image';
                        $file->move($directory, $image);
                    }
                    session()->setFlashdata(
                        'success',
                        'Data Successfully Updated'
                    );
                    return redirect()->to(base_url('admin/works/index'));
                } else {
                    session()->setFlashdata(
                        'warning',
                        'Data Unsuccessfully Updated'
                    );
                    return redirect()->to(base_url('admin/works/edit'));
                }
            }
        }

        /** Layout Header */
        echo view('admin/layout_header', $edit_page);

        /** Layout Sidebar */
        echo view('admin/layout_sidebar', $edit_page);

        /** Home Create */
        echo view('admin/works/edit', $data);

        /** Layout Footer */
        echo view('admin/layout_footer', $edit_page);
    }
}
