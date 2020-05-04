<?php

defined('BASEPATH') or exit('No direct script access allowed');

class level_model extends CI_Model
{

    public function getLevel($id = null)
    {
        if ($id === null) {
            return $this->db->get('level')->result_array();
        } else {
            return $this->db->get_where('level', ['id' => $id])->result_array();
        }
    }

    public function createLevel($data)
    {
        $this->db->insert('level', $data);
        return $this->db->affected_rows();
    }

    public function updateLevel($data, $id)
    {
        $this->db->update('level', $data, ['id' => $id]);
        return $this->db->affected_rows();
    }

    public function deleteLevel($id)
    {
        $this->db->delete('level', ['id' => $id]);
        return $this->db->affected_rows();
    }
}
    
    /* End of file tibus_model.php */
