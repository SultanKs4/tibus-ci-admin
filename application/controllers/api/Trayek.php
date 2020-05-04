<?php
defined('BASEPATH') or exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Trayek extends RestController
{

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('po_trayek_model', 'po_trayek');
    }

    public function index_get()
    {
        $id = $this->get('id');
        if ($id === NULL) {
            $po_trayek = $this->po_trayek->getPo_trayek();
        } else {
            $po_trayek = $this->po_trayek->getPo_trayek($id);
        }

        if ($po_trayek) {
            $this->response([
                'status' => true,
                'data' => $po_trayek
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => FALSE,
                'message' => 'Tidak Ditemukan po_trayek'
            ], RestController::HTTP_NOT_FOUND);
        }
    }
    public function index_post()
    {
        $data = [
            'id_po' => $this->post('id_po'),
            'dari' => $this->post('dari'),
            'tujuan' => $this->post('tujuan'),
            'jam_berangkat' => $this->post('jam_berangkat'),
            'jam_tiba' => $this->post('jam_tiba'),
            'tanggal_berangkat' => $this->post('tanggal_berangkat'),
            'tanggal_tiba' => $this->post('tanggal_tiba'),
            'harga' => $this->post('harga')
        ];

        if ($this->po_trayek->createPo_trayek($data) > 0) {
            $this->response([
                'status' => true,
                'message' => 'Data po_trayek Dibuat'
            ], RestController::HTTP_CREATED);
        } else {
            //id not found
            $this->response([
                'status' => false,
                'message' => 'Gagal membuat data po_trayek baru'
            ], RestController::HTTP_BAD_REQUEST);
        }
    }
    public function index_put()
    {
        $id = $this->put('id');
        $data = [
            'id_po' => $this->put('id_po'),
            'dari' => $this->put('dari'),
            'tujuan' => $this->put('tujuan'),
            'jam_berangkat' => $this->put('jam_berangkat'),
            'jam_tiba' => $this->put('jam_tiba'),
            'tanggal_berangkat' => $this->put('tanggal_berangkat'),
            'tanggal_tiba' => $this->put('tanggal_tiba'),
            'harga' => $this->put('harga')
        ];

        if ($this->po_trayek->updatePo_trayek($data, $id) > 0) {
            $this->response([
                'status' => true,
                'message' => 'Data po_trayek has been updated'
            ], RestController::HTTP_OK);
        } else {
            //id not found
            $this->response([
                'status' => false,
                'message' => 'Failed to update data!'
            ], RestController::HTTP_BAD_REQUEST);
        }
    }

    public function index_delete()
    {
        $id = $this->delete('id');

        if ($id === null) {
            $this->response([
                'status' => false,
                'message' => 'Provide an id!'
            ], RestController::HTTP_BAD_REQUEST);
        } else {
            if ($this->po_trayek->deletePo_trayek($id) > 0) {
                $this->response([
                    'status' => true,
                    'id' => $id,
                    'message' => 'deleted'
                ], RestController::HTTP_OK);
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'ID not found!'
                ], RestController::HTTP_BAD_REQUEST);
            }
        }
    }
}