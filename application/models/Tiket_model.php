<?php

defined('BASEPATH') or exit('No direct script access allowed');

class tiket_model extends CI_Model
{

    public function getTiket($id = null)
    {
        $this->db->select('tiket.id, tiket.nama_penumpang, tiket.no_ktp_penumpang, tiket.no_duduk, akun.email, tiket.id_trayek, tiket.id_duduk, tiket.id_payment');
        $this->db->from('tiket');
        $this->db->join('akun', 'tiket.id_akun = akun.id');

        if ($id === null) {
            return $this->db->get()->result_array();
        } else {
            $this->db->where('tiket.id', $id);
            return $this->db->get()->result_array();
        }
    }

    public function transactionTiket($dataPayment, $dataTicket, $dataTrayek, $idTrayek)
    {
        $this->db->trans_begin();
        $this->db->insert('payment', $dataPayment);
        $dataTicket['id_payment'] = $this->db->insert_id();
        $this->db->insert('tiket', $dataTicket);
        $this->db->update('po_trayek', $dataTrayek, ['id' => $idTrayek]);
        $this->db->trans_complete();
        if ($this->db->trans_status() == FALSE) {
            $this->db->trans_rollback();
            return 0;
        } else {
            $this->db->trans_commit();
            return 1;
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

    public function getidduduk($id_trayek)
    {
        $this->db->select('id_duduk');
        $this->db->from('tiket');
        $this->db->where('id_trayek', $id_trayek);
        return $this->db->get()->result_array();
    }
}
    
    /* End of file tibus_model.php */
