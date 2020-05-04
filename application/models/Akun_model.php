<?php

defined('BASEPATH') or exit('No direct script access allowed');

class akun_model extends CI_Model
{

    public function getAkun($id = null)
    {
        $this->db->select('akun.id, akun.email, akun.nama_depan, akun.nama_belakang, akun.telpon, level.name');
        $this->db->from('akun');
        $this->db->join('level', 'akun.id_level = level.id');

        if ($id == null) {
            return $this->db->get()->result_array();
        } else {
            $this->db->where('akun.id', $id);
            return $this->db->get()->result_array();
        }
    }

    public function createAkun($data)
    {
        $this->db->insert('akun', $data);
        return $this->db->affected_rows();
    }

    public function updateAkun($data, $id)
    {
        $this->db->update('akun', $data, ['id' => $id]);
        return $this->db->affected_rows();
    }

    public function deleteAkun($id)
    {
        $this->db->delete('akun', ['id' => $id]);
        return $this->db->affected_rows();
    }

    public function checkLogin($email, $password)
    {
        $this->db->select('id, email, id_level');
        $this->db->where('email', $email);
        $this->db->where('password', $password);
        $this->db->limit(1);

        $query = $this->db->get('akun');
        if ($query->num_rows() == 1) {
            return $query->result();
        } else {
            return false;
        }
    }
}
    
    /* End of file tibus_model.php */