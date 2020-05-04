<?php

defined('BASEPATH') or exit('No direct script access allowed');

class po_model extends CI_Model
{

    public function getPo($id = null)
    {
        if ($id === null) {
            return $this->db->get('po')->result_array();
        } else {
            return $this->db->get_where('po', ['id' => $id])->result_array();
        }
    }

    public function createPo($data)
    {
        $this->db->insert('po', $data);
        return $this->db->affected_rows();
    }

    public function updatePo($data, $id)
    {
        $this->db->update('po', $data, ['id' => $id]);
        return $this->db->affected_rows();
    }

    public function deletePo($id)
    {
        $this->db->delete('po', ['id' => $id]);
        return $this->db->affected_rows();
    }
}
    
    /* End of file tibus_model.php */
