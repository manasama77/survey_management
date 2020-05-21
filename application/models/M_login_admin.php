<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_login_admin extends CI_Model
{
	public function get_admin_info($where)
	{
		$this->db->select('
			admin.id,
			admin.username,
			admin.password,
			param_admin.nama,
			param_admin.aktif,
			role.nama as role_nama
		');
		$this->db->join('param_admin', 'param_admin.id_admin = admin.id', 'left');
		$this->db->join('role', 'role.id = param_admin.id_role', 'left');
		$this->db->where($where);
		return $this->db->get('admin');
	}
}
