<?php

defined('BASEPATH') or exit('No direct script access allowed');

class payment_status_model extends CI_Model
{

    public function getPayment_status($id = null)
    {
        if ($id === null) {
            return $this->db->get('payment_status')->result_array();
        } else {
            return $this->db->get_where('payment_status', ['id' => $id])->result_array();
        }
    }

    public function createPayment_status($data)
    {
        $this->db->insert('payment_status', $data);
        return $this->db->affected_rows();
    }

    public function updatePayment_status($data, $id)
    {
        $this->db->update('payment_status', $data, ['id' => $id]);
        return $this->db->affected_rows();
    }

    public function deletePayment_status($id)
    {
        $this->db->delete('payment_status', ['id' => $id]);
        return $this->db->affected_rows();
    }
}
    
    /* End of file tibus_model.php */
