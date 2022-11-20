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
        helper('global_helper');
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

                return redirect()->to('admin/auth-login');
            }

            $akun = [
                'akun_username' => $username,
                'akun_nama_lengkap' => $dataAkun['nama_lengkap'],
                'akun_email' => $dataAkun['email'],
            ];

            session()->set($akun);
            return redirect()->to('admin/auth-sukses');
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
                return redirect()->to('admin/auth-login');
            }

            $username = $this->request->getVar('username');
            $password = $this->request->getVar('password');
            $remember_me = $this->request->getVar('remember_me');
            $dataAkun = $this->AdminModel->getData($username);

            if (!password_verify($password, $dataAkun['password'])) {
                $err[] = 'Password not found';
                session()->setFlashData('username', $username);
                session()->setFlashData('warning', $err);
                return redirect()->to('admin/auth-login');
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
                'akun_password' => $dataAkun['password'],
                'akun_id' => $dataAkun['id']
            ];
            session()->set($akun);
            return redirect()
                ->to('admin/auth-sukses')
                ->withCookies();
        }
        echo view('admin/auth-login', $data);
    }

    function sukses()
    {
        if (session()->get('akun_username') != '') {
            session()->setFlashData('success', 'Successfully Login');
        }
        return redirect()->to('admin/dashboard');
    }

    function logout()
    {
        delete_cookie('cookie_username');
        delete_cookie('cookie_password');
        session()->destroy();

        if (session()->get('akun_username') != '') {
            session()->setFlashData('success', 'Successfully Logout');
        }
        echo view('admin/auth-login');
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
                $link = site_url(
                    "admin/resset-password/?email=$email&token=$token"
                );

                $attachment = '';
                $to = $email;
                $title = 'Resset Password';
                $message = 'Here is a link to reset your password.';
                $message .= "Please click the following link $link";

                send_email($attachment, $to, $title, $message);

                $dataUpdate = [
                    'email' => $email,
                    'token' => $token,
                ];
                $this->AdminModel->updateData($dataUpdate);
                session()->setFlashData(
                    'success',
                    'Email successfully send to your email'
                );
            }
            if ($err) {
                session()->setFlashData('username', $username);
                session()->setFlashData('warning', $err);
            }
            return redirect()->to('admin/forgot-password');
        }
        echo view('admin/auth-forgot');
    }
    function ressetpassword()
    {
        $err = [];
        $email = $this->request->getVar('email');
        $token = $this->request->getVar('token');
        if ($email != '' and $token != '') {
            $dataAkun = $this->AdminModel->getData($email);
            if ($dataAkun['token'] != $token) {
                $err[] = 'Invalid token';
            }
        } else {
            $err[] = 'Invalid parameter passed';
        }

        if ($err) {
            session()->setFlashdata('warning', $err);
        }

        if ($this->request->getMethod() == 'post') {
            $rulles = [
                'password' => [
                    'rules' => 'required|min_length[5]',
                    'errors' => [
                        'required' => 'Password must be filled',
                        'min_length' =>
                            'The minimum character length for the password is 5 characters',
                    ],
                ],
                'confirm_password' => [
                    'rules' => 'required|min_length[5]|matches[password]',
                    'errors' => [
                        'required' => 'Password must be filled',
                        'min_length' =>
                            'The minimum character length for the password is 5 characters',
                        'matches' =>
                            'Confirm password does not match the password entered',
                    ],
                ],
            ];

            if (!$this->validate($rulles)) {
                session()->setFlashdata(
                    'warning',
                    $this->validation->getErrors()
                );
            } else {
                $dataUpdate = [
                    'email' => $email,
                    'password' => password_hash(
                        $this->request->getVar('password'),
                        PASSWORD_DEFAULT
                    ),
                    'token' => null,
                ];
                $this->AdminModel->updateData($dataUpdate);
                session()->setFlashdata(
                    'success',
                    'Password has been successfully reset, please login again'
                );
                delete_cookie('cookie_username');
                delete_cookie('cookie_password');
                return redirect()
                    ->to('admin/login')
                    ->withCookies();
            }
        }
        echo view('admin/auth-resset');
    }
}
