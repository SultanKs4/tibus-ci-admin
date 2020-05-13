<?php

defined('BASEPATH') or exit('No direct script access allowed');

class tiket_model extends CI_Model
{

    public function getTiket($id = null)
    {
        $this->db->select('tiket.id, tiket_booking.name, tiket.nama_penumpang, tiket.no_ktp_penumpang, tiket.no_duduk, akun.email, tiket.id_trayek');
        $this->db->from('tiket');
        $this->db->join('tiket_booking', 'tiket.kode_booking = tiket_booking.id');
        $this->db->join('akun', 'tiket.id_akun = akun.id');

        if ($id === null) {
            return $this->db->get()->result_array();
        } else {
            $this->db->where('tiket.id', $id);
            return $this->db->get()->result_array();
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
