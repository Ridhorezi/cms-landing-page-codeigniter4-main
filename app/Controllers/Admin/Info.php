<?php
namespace App\Controllers\Admin;
use App\Controllers\BaseController;
use App\Models\InfoModel;

class Info extends BaseController
{
    function __construct()
    {
        $this->validation = \Config\Services::validation();
        $this->InfoModel = new InfoModel();
    }

    function index()
    {
        /** For Delete Data */

        if ($this->request->getVar('id')) {
            $dataInfo = $this->InfoModel->geInfo($this->request->getVar('id'));
            if ($dataInfo['id']) {
                $action = $this->InfoModel->deleteInfo(
                    $this->request->getVar('id')
                );
                if ($action == true) {
                    return redirect()->to(base_url('admin/info/index'));
                } else {
                    session()->setFlashdata('warning', [
                        'Failed to delete data',
                    ]);
                }
            }
        }

        $data = [];

        $data['templateJudul'] = 'Info | Page';

        $model = new InfoModel();

        $data['readInfo'] = $model->readInfo();

        /** Layout Header */
        echo view('admin/layout_header', $data);

        /** Layout Sidebar */
        echo view('admin/layout_sidebar', $data);

        /** Dashboard */
        echo view('admin/info/index', $data);

        /** Layout Footer */
        echo view('admin/layout_footer', $data);
    }

    function create()
    {
        $data = [];

        if ($this->request->getMethod() == 'post') {
            $data = $this->request->getVar();

            $rulles = [
                'company_name' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Company Name cannot be empty',
                    ],
                ],
                'company_contact' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Company Contact cannot be empty',
                    ],
                ],
                'company_mail' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Company Email cannot be empty',
                    ],
                ],
                'company_location' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Company Location cannot be empty',
                    ],
                ],
                'copyright' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Copyright cannot be empty',
                    ],
                ],
            ];

            if (!$this->validate($rulles)) {
                session()->setFlashdata(
                    'warning',
                    $this->validation->getErrors()
                );
            } else {
                $record = [
                    'company_name' => $this->request->getVar('company_name'),
                    'company_contact' => $this->request->getVar(
                        'company_contact'
                    ),
                    'company_mail' => $this->request->getVar('company_mail'),
                    'company_location' => $this->request->getVar(
                        'company_location'
                    ),
                    'copyright' => $this->request->getVar('copyright'),
                ];
                $action = $this->InfoModel->insertInfo($record);
                if ($action != false) {
                    $id = $action;
                    session()->setFlashdata(
                        'success',
                        'Data Successfully Saved'
                    );
                    return redirect()->to(base_url('admin/info/index'));
                } else {
                    session()->setFlashdata(
                        'warning',
                        'Data Unsuccessfully Saved'
                    );
                    return redirect()->to(base_url('admin/info/create'));
                }
            }
        }

        $create_page['templateJudul'] = 'Create | Page';

        /** Layout Header */
        echo view('admin/layout_header', $create_page);

        /** Layout Sidebar */
        echo view('admin/layout_sidebar', $create_page);

        /** Home Create */
        echo view('admin/info/create', $create_page);

        /** Layout Footer */
        echo view('admin/layout_footer', $create_page);
    }

    function edit($id)
    {
        $edit_page = [];

        $edit_page['templateJudul'] = 'Edit | Page';

        $dataInfo = $this->InfoModel->editInfo($id);

        if (empty($dataInfo)) {
            return redirect()->to(base_url('admin/info/edit'));
        }

        $data = $dataInfo;

        if ($this->request->getMethod() == 'post') {
            $data = $this->request->getVar();

            $rulles = [
                'company_name' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Company Name cannot be empty',
                    ],
                ],
                'company_contact' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Company Contact cannot be empty',
                    ],
                ],
                'company_mail' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Company Email cannot be empty',
                    ],
                ],
                'company_location' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Company Location cannot be empty',
                    ],
                ],
                'copyright' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Copyright cannot be empty',
                    ],
                ],
            ];

            if (!$this->validate($rulles)) {
                session()->setFlashdata(
                    'warning',
                    $this->validation->getErrors()
                );
            } else {
                $record = [
                    'company_name' => $this->request->getVar('company_name'),
                    'company_contact' => $this->request->getVar(
                        'company_contact'
                    ),
                    'company_mail' => $this->request->getVar('company_mail'),
                    'company_location' => $this->request->getVar(
                        'company_location'
                    ),
                    'copyright' => $this->request->getVar('copyright'),
                    'id' => $id,
                ];
                $action = $this->InfoModel->insertInfo($record);
                if ($action != false) {
                    $id = $action;
                    session()->setFlashdata(
                        'success',
                        'Data Successfully Updated'
                    );
                    return redirect()->to(base_url('admin/info/index'));
                } else {
                    session()->setFlashdata(
                        'warning',
                        'Data Unsuccessfully Updated'
                    );
                    return redirect()->to(base_url('admin/info/edit'));
                }
            }
        }

        /** Layout Header */
        echo view('admin/layout_header', $edit_page);

        /** Layout Sidebar */
        echo view('admin/layout_sidebar', $edit_page);

        /** Home Create */
        echo view('admin/info/edit', $data);

        /** Layout Footer */
        echo view('admin/layout_footer', $edit_page);
    }
}
