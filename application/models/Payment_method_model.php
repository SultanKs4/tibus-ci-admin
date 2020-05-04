<?php

defined('BASEPATH') or exit('No direct script access allowed');

class payment_method_model extends CI_Model
{

    public function getPayment_method($id = null)
    {
        if ($id === null) {
            return $this->db->get('payment_method')->result_array();
        } else {
            return $this->db->get_where('payment_method', ['id' => $id])->result_array();
        }
    }

    public function createPayment_method($data)
    {
        $this->db->insert('payment_method', $data);
        return $this->db->affected_rows();
    }

    public function updatePayment_method($data, $id)
    {
        $this->db->update('payment_method', $data, ['id' => $id]);
        return $this->db->affected_rows();
    }

    public function deletePayment_method($id)
    {
        $this->db->delete('payment_method', ['id' => $id]);
        return $this->db->affected_rows();
    }
}
    
    /* End of file tibus_model.php */
