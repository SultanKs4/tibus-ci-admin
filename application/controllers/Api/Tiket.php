<?php
defined('BASEPATH') or exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Tiket extends RestController
{

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('tiket_model', 'tiket');
    }

    public function index_get()
    {
        $id = $this->get('id');
        if ($id === NULL) {
            $tiket = $this->tiket->getTiket();
        } else {
            $tiket = $this->tiket->getTiket($id);
        }

        if ($tiket) {
            $this->response([
                'status' => true,
                'data' => $tiket
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => FALSE,
                'message' => 'Tidak Ditemukan tiket'
            ], RestController::HTTP_NOT_FOUND);
        }
    }
    public function index_post()
    {
        $data = [
            'kode_booking' => $this->post('kode_booking'),
            'nama_penumpang' => $this->post('nama_penumpang'),
            'no_ktp_penumpang' => $this->post('no_ktp_penumpang'),
            'no_duduk' => $this->post('no_duduk'),
            'id_akun' => $this->post('id_akun'),
            'id_trayek' => $this->post('id_trayek')
        ];

        if ($this->tiket->createTiket($data) > 0) {
            $this->response([
                'status' => true,
                'message' => 'Data tiket Dibuat'
            ], RestController::HTTP_CREATED);
        } else {
            //id not found
            $this->response([
                'status' => false,
                'message' => 'Gagal membuat data tiket baru'
            ], RestController::HTTP_BAD_REQUEST);
        }
    }
    public function index_put()
    {
        $id = $this->put('id');
        $data = [
            'kode_booking' => $this->put('kode_booking'),
            'nama_penumpang' => $this->put('nama_penumpang'),
            'no_ktp_penumpang' => $this->put('no_ktp_penumpang'),
            'no_duduk' => $this->put('no_duduk'),
            'id_akun' => $this->put('id_akun'),
            'id_trayek' => $this->put('id_trayek')
        ];

        if ($this->tiket->updateTiket($data, $id) > 0) {
            $this->response([
                'status' => true,
                'message' => 'Data tiket has been updated'
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
            if ($this->tiket->deleteTiket($id) > 0) {
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
