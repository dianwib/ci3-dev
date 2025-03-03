<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('UserModel');
        $this->load->library('session');
    }

    public function login() {
        if ($this->input->method() === 'post') {
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            $user = $this->UserModel->get_user($username);

            if ($user && password_verify($password, $user['password'])) {
                $this->session->set_userdata('user_logged', $user);
                redirect('dashboard');
            } else {
                $this->session->set_flashdata('error', 'Username atau password salah');
                redirect('auth/login');
            }
        }

        $this->load->view('auth/login');
    }

	public function login_action() {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $user = $this->UserModel->get_email_login($username, $password);

        if ($user) {
            $this->session->set_userdata('user_logged', $user);
            redirect('dashboard');
        } else {
            $this->session->set_flashdata('error', 'Username atau password salah!');
            redirect('auth/login');

        }
    }

    public function logout() {
        $this->session->unset_userdata('user_logged');
        redirect('auth/login');
    }
}
