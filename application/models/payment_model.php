<?php

defined('BASEPATH') or exit('No direct script access allowed');

class payment_model extends CI_Model
{

    public function getPayment($id = null)
    {
        if ($id === null) {
            return $this->db->get('payment')->result_array();
        } else {
            return $this->db->get_where('payment', ['id' => $id])->result_array();
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
