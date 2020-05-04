<?php

defined('BASEPATH') or exit('No direct script access allowed');

class po_trayek_model extends CI_Model
{

    public function getPo_trayek($id = null)
    {
        $this->db->select('po_trayek.id, po.nama AS po, t1.nama as dari, t2.nama as tujuan, po_trayek.jam_berangkat, po_trayek.jam_tiba, po_trayek.tanggal_berangkat, po_trayek.tanggal_tiba, po_trayek.harga');
        $this->db->from('po_trayek');
        $this->db->join('po', 'po_trayek.id_po = po.id');
        $this->db->join('terminal as t1', 'po_trayek.dari = t1.id');
        $this->db->join('terminal as t2', 'po_trayek.tujuan = t2.id');

        if ($id === null) {
            return $this->db->get()->result_array();
        } else {
            $this->db->where('po_trayek.id', $id);
            return $this->db->get()->result_array();
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