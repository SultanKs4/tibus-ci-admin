<?php

defined('BASEPATH') or exit('No direct script access allowed');

class payment_model extends CI_Model
{

    public function getPayment($id = null)
    {
        $this->db->select('payment.id, akun.email as akun, tiket_booking.name as kode_booking, payment.total, payment_method.name as method, payment.bukti_bayar, payment_status.name as status');
        $this->db->from('payment');
        $this->db->join('akun', 'payment.id_akun = akun.id');
        $this->db->join('tiket_booking', 'payment.kode_booking = tiket_booking.id');
        $this->db->join('payment_method', 'payment.metode_bayar = payment_method.id');
        $this->db->join('payment_status', 'payment.status = payment_status.id');

        if ($id === null) {
            return $this->db->get()->result_array();
        } else {
            $this->db->where('payment.id', $id);
            return $this->db->get()->result_array();
        }
    }

    public function createPayment($data)
    {
        $this->db->insert('payment', $data);
        return $this->db->affected_rows();
    }

    public function updatePayment($data, $id)
    {
        $this->db->update('payment', $data, ['id' => $id]);
        return $this->db->affected_rows();
    }

    public function deletePayment($id)
    {
        $this->db->delete('payment', ['id' => $id]);
        return $this->db->affected_rows();
    }
}
    
    /* End of file tibus_model.php */