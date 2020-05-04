<?php

defined('BASEPATH') or exit('No direct script access allowed');

class terminal_model extends CI_Model
{

    public function getTerminal($id = null)
    {
        if ($id === null) {
            return $this->db->get('terminal')->result_array();
        } else {
            return $this->db->get_where('terminal', ['id' => $id])->result_array();
        }
    }

    public function createTerminal($data)
    {
        $this->db->insert('terminal', $data);
        return $this->db->affected_rows();
    }

    public function updateTerminal($data, $id)
    {
        $this->db->update('terminal', $data, ['id' => $id]);
        return $this->db->affected_rows();
    }

    public function deleteTerminal($id)
    {
        $this->db->delete('terminal', ['id' => $id]);
        return $this->db->affected_rows();
    }
}
    
    /* End of file tibus_model.php */
