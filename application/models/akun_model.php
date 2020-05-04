<?php

defined('BASEPATH') or exit('No direct script access allowed');

class akun_model extends CI_Model
{

    public function getAkun($id = null)
    {
        if ($id === null) {
            return $this->db->get('akun')->result_array();
        } else {
            return $this->db->get_where('akun', ['id' => $id])->result_array();
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
}
    
    /* End of file tibus_model.php */
