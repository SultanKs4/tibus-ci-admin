<?php
defined('BASEPATH') or exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Terminal extends RestController
{

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('terminal_model', 'terminal');
    }

    public function index_get()
    {
        $id = $this->get('id');
        if ($id === NULL) {
            $terminal = $this->terminal->getTerminal();
        } else {
            $terminal = $this->terminal->getTerminal($id);
        }

        if ($terminal) {
            $this->response([
                'status' => true,
                'data' => $terminal
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => FALSE,
                'message' => 'Tidak Ditemukan terminal'
            ], RestController::HTTP_NOT_FOUND);
        }
    }
    public function index_post()
    {
        $data = [
            'nama' => $this->post('nama'),
            'kota' => $this->post('kota'),
            'alamat' => $this->post('alamat')
        ];

        if ($this->terminal->createTerminal($data) > 0) {
            $this->response([
                'status' => true,
                'message' => 'Data terminal Dibuat'
            ], RestController::HTTP_CREATED);
        } else {
            //id not found
            $this->response([
                'status' => false,
                'message' => 'Gagal membuat data terminal baru'
            ], RestController::HTTP_BAD_REQUEST);
        }
    }
    public function index_put()
    {
        $id = $this->put('id');
        $data = [
            'nama' => $this->put('nama'),
            'kota' => $this->put('kota'),
            'alamat' => $this->put('alamat')
        ];

        if ($this->terminal->updateTerminal($data, $id) > 0) {
            $this->response([
                'status' => true,
                'message' => 'Data terminal has been updated'
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
            if ($this->terminal->deleteTerminal($id) > 0) {
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
