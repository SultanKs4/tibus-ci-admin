<?php
defined('BASEPATH') or exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Payment extends RestController
{

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('payment_model', 'payment');
    }

    public function index_get()
    {
        $id = $this->get('id');
        if ($id === NULL) {
            $payment = $this->payment->getPayment();
        } else {
            $payment = $this->payment->getPayment($id);
        }

        if ($payment) {
            $this->response([
                'status' => true,
                'data' => $payment
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => FALSE,
                'message' => 'Tidak Ditemukan payment'
            ], RestController::HTTP_NOT_FOUND);
        }
    }
    public function index_post()
    {
        $data = [
            'id_akun' => $this->post('id_akun'),
            'total' => $this->post('total'),
            'metode_bayar' => $this->post('metode_bayar'),
            // 'bukti_bayar' => $this->post('bukti_bayar'),
            'status' => $this->post('status')
        ];

        if ($this->payment->createPayment($data) > 0) {
            $this->response([
                'status' => true,
                'message' => 'Data payment Dibuat'
            ], RestController::HTTP_CREATED);
        } else {
            //id not found
            $this->response([
                'status' => false,
                'message' => 'Gagal membuat data payment baru'
            ], RestController::HTTP_BAD_REQUEST);
        }
    }
    public function index_put()
    {
        $id = $this->put('id');
        $data = [
            'id_akun' => $this->put('id_akun'),
            'total' => $this->put('total'),
            'metode_bayar' => $this->put('metode_bayar'),
            'bukti_bayar' => $this->put('bukti_bayar'),
            'status' => $this->put('status')
        ];

        if ($this->payment->updatePayment($data, $id) > 0) {
            $this->response([
                'status' => true,
                'message' => 'Data payment has been updated'
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
            if ($this->payment->deletePayment($id) > 0) {
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