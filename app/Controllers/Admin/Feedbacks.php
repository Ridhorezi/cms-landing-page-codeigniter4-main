<?php
namespace App\Controllers\Admin;
use App\Controllers\BaseController;
use App\Models\FeedbackModel;

class Feedbacks extends BaseController
{

    function __construct() {
        $this->validation = \Config\Services::validation();
        $this->FeedbackModel = new FeedbackModel();
    }

    function index()
    {

        /** For Delete Data */

        if ($this->request->getVar('id')) {
            $dataFeedbacks = $this->FeedbackModel->getFeedbacks($this->request->getVar('id'));
            if ($dataFeedbacks['id']) {
                $action = $this->FeedbackModel->deleteFeedback($this->request->getVar('id'));
                if ($action == true) {
                    return redirect()->to("admin/feedbacks/index");
                } else {
                    session()->setFlashdata('warning', ['Failed to delete data']);
                }
            }
        }

        $data = [];
        
        $data ['templateJudul'] = 'Feedback | Page';

        $model = new FeedbackModel;

        $data['readFeedbacks'] = $model->readFeedbacks();

        /** Layout Header */
        echo view('admin/layout_header', $data);

        /** Layout Sidebar */
        echo view('admin/layout_sidebar', $data);

        /** Dashboard */
        echo view('admin/feedbacks/index', $data);

        /** Layout Footer */
        echo view('admin/layout_footer', $data);
    }

    function edit($id)
    {
        $edit_page = [];

        $edit_page ['templateJudul'] = 'Edit | Page';

        $dataFeedbacks = $this->FeedbackModel->editFeedback($id);

        if (empty($dataFeedbacks)) {
            return redirect()->to('admin/feedbacks/edit');
        }

        $data = $dataFeedbacks;

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
                    'message' => $this->request->getVar('message'),
                    'id'        => $id
                ];
                $action = $this->FeedbackModel->insertFeedback($record);
                if ($action != false) {
                    $id = $action;
                    session()->setFlashdata('success', 'Data Successfully Updated');
                    return redirect()->to('admin/feedbacks/index');
                } else {
                    session()->setFlashdata('warning', 'Data Unsuccessfully Updated');
                    return redirect()->to('admin/feedbacks/edit');
                }
            }
        }

         /** Layout Header */
         echo view('admin/layout_header', $edit_page);

         /** Layout Sidebar */
         echo view('admin/layout_sidebar', $edit_page);
 
         /** Home Create */
         echo view('admin/feedbacks/edit', $data);
 
         /** Layout Footer */
         echo view('admin/layout_footer', $edit_page);
    }
}