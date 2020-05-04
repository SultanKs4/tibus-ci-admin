<?php
defined('BASEPATH') or exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Po extends RestController
{

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('po_model', 'po');
    }

    public function index_get()
    {
        $id = $this->get('id');
        if ($id === NULL) {
            $po = $this->po->getPo();
        } else {
            $po = $this->po->getPo($id);
        }

        if ($po) {
            $this->response([
                'status' => true,
                'data' => $po
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => FALSE,
                'message' => 'Tidak Ditemukan po'
            ], RestController::HTTP_NOT_FOUND);
        }
    }
    public function index_post()
    {
        $data = [
            'nama' => $this->post('nama')
        ];

        if ($this->po->createPo($data) > 0) {
            $this->response([
                'status' => true,
                'message' => 'Data po Dibuat'
            ], RestController::HTTP_CREATED);
        } else {
            //id not found
            $this->response([
                'status' => false,
                'message' => 'Gagal membuat data po baru'
            ], RestController::HTTP_BAD_REQUEST);
        }
    }
    public function index_put()
    {
        $id = $this->put('id');
        $data = [
            'nama' => $this->put('nama')
        ];

        if ($this->po->updatePo($data, $id) > 0) {
            $this->response([
                'status' => true,
                'message' => 'Data po has been updated'
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
            if ($this->po->deletePo($id) > 0) {
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