<?php

defined('BASEPATH') or exit('No direct script access allowed');

class po_trayek_model extends CI_Model
{

    public function getPo_trayek($id = null)
    {
        if ($id === null) {
            return $this->db->get('po_trayek')->result_array();
        } else {
            return $this->db->get_where('po_trayek', ['id' => $id])->result_array();
        }
    }

    public function createPo_trayek($data)
    {
        $this->db->insert('po_trayek', $data);
        return $this->db->affected_rows();
    }

    public function updatePo_trayek($data, $id)
    {
        $this->db->update('po_trayek', $data, ['id' => $id]);
        return $this->db->affected_rows();
    }

    public function deletePo_trayek($id)
    {
        $this->db->delete('po_trayek', ['id' => $id]);
        return $this->db->affected_rows();
    }
}
    
    /* End of file tibus_model.php */
