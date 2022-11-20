<?php
namespace App\Controllers\Admin;
use App\Models\DashboardModel;
use App\Models\AdminModel;
use App\Models\ContactModel;
use App\Models\FeedbackModel;
use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    function __construct()
    {
        $this->DashboardModel = new DashboardModel();
        $this->AdminModel = new AdminModel();
        $this->ContactModel = new ContactModel();
        $this->FeedbackModel = new FeedbackModel();
    }
    function index()
    {
        $data = [];

        $data['totalMessages'] = $this->ContactModel->totalMessages();
        $data['totalFeedbacks'] = $this->FeedbackModel->totalFeedbacks();

        $data ['templateJudul'] = 'Admin | Dashboard';

        /** Layout Header */
        echo view('admin/layout_header', $data);

        /** Layout Sidebar */
        echo view('admin/layout_sidebar', $data);

        /** Dashboard */
        echo view('admin/dashboard', $data);

        /** Layout Footer */
        echo view('admin/layout_footer', $data);
    }

    function edit()
    {
        if ($this->request->getMethod() == 'post') {

            $data = $this->request->getVar();

            $rulles = [
                'username' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Username cannot be empty',
                    ],
                ],
                'fullname' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Fullname cannot be empty',
                    ],
                ],
                'email' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Email cannot be empty',
                    ],
                ],
                'password' => [
                    'rules' => 'required|min_length[5]',
                    'errors' => [
                        'required' => 'Password must be filled',
                        'min_length' =>
                            'The minimum character length for the password is 5 characters',
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
                    'username' => $this->request->getVar('username'),
                    'fullname' => $this->request->getVar('fullname'),
                    'email' => $this->request->getVar('email'),
                    'password' => password_hash(
                        $this->request->getVar('password'),
                        PASSWORD_DEFAULT
                    ),
                    'id' => $this->request->getVar('id'),
                ];
                $action = $this->AdminModel->updateAdmin($record);
                session()->setFlashdata(
                    'success',
                    'Data successfully updated'
                );
                return redirect()
                    ->to('admin/dashboard');
            }
        }
    }
}