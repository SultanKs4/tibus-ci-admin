<?php

defined('BASEPATH') or exit('No direct script access allowed');

class tiket_booking_model extends CI_Model
{

    public function getTiket_booking($id = null)
    {
        if ($id === null) {
            return $this->db->get('tiket_booking')->result_array();
        } else {
            return $this->db->get_where('tiket_booking', ['id' => $id])->result_array();
        }
    }

    public function createTiket_booking($data)
    {
        $this->db->insert('tiket_booking', $data);
        return $this->db->affected_rows();
    }

    public function updateTiket_booking($data, $id)
    {
        $this->db->update('tiket_booking', $data, ['id' => $id]);
        return $this->db->affected_rows();
    }

    public function deleteTiket_booking($id)
    {
        $this->db->delete('tiket_booking', ['id' => $id]);
        return $this->db->affected_rows();
    }
}
    
    /* End of file tibus_model.php */
