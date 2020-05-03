<?php

defined('BASEPATH') or exit('No direct script access allowed');

class tiket_model extends CI_Model
{

    public function getTiket($id = null)
    {
        if ($id === null) {
            return $this->db->get('tiket')->result_array();
        } else {
            return $this->db->get_where('tiket', ['id' => $id])->result_array();
        }
    }

    public function createTiket($data)
    {
        $this->db->insert('tiket', $data);
        return $this->db->affected_rows();
    }

    public function updateTiket($data, $id)
    {
        $this->db->update('tiket', $data, ['id' => $id]);
        return $this->db->affected_rows();
    }

    public function deleteTiket($id)
    {
        $this->db->delete('tiket', ['id' => $id]);
        return $this->db->affected_rows();
    }
}
    
    /* End of file tibus_model.php */
