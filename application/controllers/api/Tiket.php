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
            'nama_penumpang' => $this->post('nama_penumpang'),
            'no_ktp_penumpang' => $this->post('no_ktp_penumpang'),
            'no_duduk' => $this->post('no_duduk'),
            'id_akun' => $this->post('id_akun'),
            'id_trayek' => $this->post('id_trayek'),
            'id_payment' => $this->post('id_payment'),
            'id_duduk' => $this->post('id_duduk')
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
            'nama_penumpang' => $this->put('nama_penumpang'),
            'no_ktp_penumpang' => $this->put('no_ktp_penumpang'),
            'no_duduk' => $this->put('no_duduk'),
            'id_akun' => $this->put('id_akun'),
            'id_trayek' => $this->put('id_trayek'),
            'id_payment' => $this->put('id_payment'),
            'id_duduk' => $this->put('id_duduk')
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

    public function trans_post()
    {
        $this->load->model('payment_model');

        $dataPayment = [
            'id_akun' => $this->post('id_akun'),
            'total' => $this->post('total'),
            'metode_bayar' => $this->post('metode_bayar'),
            'status' => $this->post('status'),
        ];

        $dataTiket = [
            'nama_penumpang' => $this->post('nama_penumpang'),
            'no_ktp_penumpang' => $this->post('no_ktp_penumpang'),
            'no_duduk' => $this->post('no_duduk'),
            'id_akun' => $this->post('id_akun'),
            'id_trayek' => $this->post('id_trayek'),
            'id_duduk' => $this->post('id_duduk')
        ];

        $idTrayek = $this->post('id_trayek');
        $dataTrayek = [
            'id_po' => $this->post('id_po'),
            'dari' => $this->post('dari'),
            'tujuan' => $this->post('tujuan'),
            'jam_berangkat' => $this->post('jam_berangkat'),
            'jam_tiba' => $this->post('jam_tiba'),
            'tanggal_berangkat' => $this->post('tanggal_berangkat'),
            'tanggal_tiba' => $this->post('tanggal_tiba'),
            'harga' => $this->post('harga'),
            'sisa_kursi' => $this->post('sisa_kursi')
        ];

        if ($this->tiket->transactionTiket($dataPayment, $dataTiket, $dataTrayek, $idTrayek) > 0) {
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
    public function booked_get()
    {
        $id_trayek = $this->get('id_trayek');
        $tiket = $this->tiket->getidduduk($id_trayek);

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
}
