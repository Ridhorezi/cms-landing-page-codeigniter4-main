<?php
namespace App\Controllers\Admin;
use App\Controllers\BaseController;
use App\Models\ContactModel;

class Contacts extends BaseController
{

    function __construct() {
        $this->validation = \Config\Services::validation();
        $this->ContactModel = new ContactModel();
    }

    function index()
    {

        /** For Delete Data */

        if ($this->request->getVar('id')) {
            $dataContacts = $this->ContactModel->getContacts($this->request->getVar('id'));
            if ($dataContacts['id']) {
                $action = $this->ContactModel->deleteContact($this->request->getVar('id'));
                if ($action == true) {
                    return redirect()->to(base_url('admin/contacts/index'));
                } else {
                    session()->setFlashdata('warning', ['Failed to delete data']);
                }
            }
        }

        $data = [];
        
        $data ['templateJudul'] = 'Contacts Page';

        $model = new ContactModel;

        $data['readContacts'] = $model->readContacts();

        /** Layout Header */
        echo view('admin/layout_header', $data);

        /** Layout Sidebar */
        echo view('admin/layout_sidebar', $data);

        /** Dashboard */
        echo view('admin/contacts/index', $data);

        /** Layout Footer */
        echo view('admin/layout_footer', $data);
    }

    function edit($id)
    {
        $edit_page = [];

        $edit_page ['templateJudul'] = 'Edit Page';

        $dataContacts = $this->ContactModel->editContact($id);

        if (empty($dataContacts)) {
            return redirect()->to(base_url('admin/contacts/edit'));
        }

        $data = $dataContacts;

        if ($this->request->getMethod() == 'post') {

            $data = $this->request->getVar();

            $rulles = [
                'name' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Name cannot be empty'
                    ],
                ],
                'email' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Email cannot be empty'
                    ],
                ],
                'subject' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Subject cannot be empty'
                    ],
                ],
                'message' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Message cannot be empty'
                    ],
                ],
            ];

            if (!$this->validate($rulles)) {
                session()->setFlashdata('warning', $this->validation->getErrors());
            } else {
                $record = [
                    'name'     => $this->request->getVar('name'),
                    'email'     => $this->request->getVar('email'),
                    'subject'     => $this->request->getVar('subject'),
                    'message' => $this->request->getVar('message'),
                    'id'        => $id
                ];
                $action = $this->ContactModel->insertContact($record);
                if ($action != false) {
                    $id = $action;
                    session()->setFlashdata('success', 'Data Successfully Updated');
                    return redirect()->to(base_url('admin/contacts/index'));
                } else {
                    session()->setFlashdata('warning', 'Data Unsuccessfully Updated');
                    return redirect()->to(base_url('admin/contacts/edit'));
                }
            }
        }

         /** Layout Header */
         echo view('admin/layout_header', $edit_page);

         /** Layout Sidebar */
         echo view('admin/layout_sidebar', $edit_page);
 
         /** Home Create */
         echo view('admin/contacts/edit', $data);
 
         /** Layout Footer */
         echo view('admin/layout_footer', $edit_page);
    }
}