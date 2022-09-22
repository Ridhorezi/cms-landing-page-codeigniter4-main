<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AdminModel;
use CodeIgniter\Config\Config;

class Admin extends BaseController
{
    function __construct()
    {
        $this->validation = \Config\Services::validation();
        $this->AdminModel = new AdminModel();
        helper('cookie');
        helper('global_fungsi_helper');
    }
    public function login()
    {
        if (get_cookie('cookie_username') && get_cookie('cookie_password')) {
            $username = get_cookie('cookie_username');
            $password = get_cookie('cookie_password');

            $dataAkun = $this->AdminModel->getData($username);
            if ($password != $dataAkun['password']) {
                $err[] = 'Account not Mached';
                session()->setFlashData('username', $username);
                session()->setFlashData('warning', $err);

                delete_cookie('cookie_username');
                delete_cookie('cookie_password');

                return redirect()->to('admin/login');
            }

            $akun = [
                'akun_username' => $username,
                'akun_nama_lengkap' => $dataAkun['nama_lengkap'],
                'akun_email' => $dataAkun['email'],
            ];

            session()->set($akun);
            return redirect()->to('admin/sukses');
        }
        $data = [];
        if ($this->request->getMethod() == 'post') {
            $rulles = [
                'username' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => "Username can't be null",
                    ],
                ],
                'password' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => "Password can't be null",
                    ],
                ],
            ];
            if (!$this->validate($rulles)) {
                session()->setFlashData(
                    'warning',
                    $this->validation->getErrors()
                );
                return redirect()->to('admin/login');
            }

            $username = $this->request->getVar('username');
            $password = $this->request->getVar('password');
            $remember_me = $this->request->getVar('remember_me');
            $dataAkun = $this->AdminModel->getData($username);

            if (!password_verify($password, $dataAkun['password'])) {
                $err[] = 'Password not found';
                session()->setFlashData('username', $username);
                session()->setFlashData('warning', $err);
                return redirect()->to('admin/login');
            }

            if ($remember_me == '1') {
                set_cookie('cookie_username', $username, 3600 * 24 * 30);
                set_cookie(
                    'cookie_password',
                    $dataAkun['password'],
                    3600 * 24 * 30
                );
            }

            $akun = [
                'akun_username' => $dataAkun['username'],
                'akun_nama_lengkap' => $dataAkun['nama_lengkap'],
                'akun_email' => $dataAkun['email'],
            ];
            session()->set($akun);
            return redirect()
                ->to('admin/sukses')
                ->withCookies();
        }
        echo view('admin/login', $data);
    }

    function sukses()
    {
        print_r(session()->get());
        echo 'test cookie user name' .
            get_cookie('cookie_username') .
            'test cookie password' .
            get_cookie('cookie_password');
    }

    function logout()
    {
        delete_cookie('cookie_username');
        delete_cookie('cookie_password');
        session()->destroy();

        if (session()->get('akun_username') != '') {
            session()->setFlashData('success', 'Successfully Logout');
        }
        echo view('admin/login');
    }

    function forgotpassword()
    {
        $err = [];
        if ($this->request->getMethod() == 'post') {
            $username = $this->request->getVar('username');
            if ($username == '') {
                $err[] = 'Please enter your email or username';
            }
            if (empty($err)) {
                $data = $this->AdminModel->getData($username);
                if (empty($data)) {
                    $err[] = 'Account not registered';
                }
            }
            if (empty($err)) {
                $email = $data['email'];
                $token = md5(date('ymdhis'));
                $dataUpdate = [
                    'email' => $email,
                    'token' => $token
                ];
                $this->AdminModel->updateData($dataUpdate);
                session()->setFlashData('success', 'Email successfully send to your email');
            }
            if ($err) {
                session()->setFlashData('username', $username);
                session()->setFlashData('warning', $err);
            }
            return redirect()->to('admin/forgot-password');
        }
        echo view('admin/forgot-password');
    }
}
