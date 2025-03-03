<?php
defined('BASEPATH') or exit('No direct script access allowed');

class UserModel extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function get_user($username)
	{
		return $this->db->get_where('user', ['username' => $username])->row_array();
	}


	public function get_email_login($username, $password) {
        $this->db->where('email', $username);
        $this->db->where('password', md5($password)); // Gunakan MD5
        return $this->db->get('user')->row_array();
	}
}
