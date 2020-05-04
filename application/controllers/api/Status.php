<?php
defined('BASEPATH') or exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Status extends RestController
{

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('payment_status_model', 'payment_status');
    }

    public function index_get()
    {
        $id = $this->get('id');
        if ($id === NULL) {
            $payment_status = $this->payment_status->getPayment_status();
        } else {
            $payment_status = $this->payment_status->getPayment_status($id);
        }

        if ($payment_status) {
            $this->response([
                'status' => true,
                'data' => $payment_status
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => FALSE,
                'message' => 'Tidak Ditemukan payment_status'
            ], RestController::HTTP_NOT_FOUND);
        }
    }
    public function index_post()
    {
        $data = [
            'name' => $this->post('name')
        ];

        if ($this->payment_status->createPayment_status($data) > 0) {
            $this->response([
                'status' => true,
                'message' => 'Data payment_status Dibuat'
            ], RestController::HTTP_CREATED);
        } else {
            //id not found
            $this->response([
                'status' => false,
                'message' => 'Gagal membuat data payment_status baru'
            ], RestController::HTTP_BAD_REQUEST);
        }
    }
    public function index_put()
    {
        $id = $this->put('id');
        $data = [
            'name' => $this->put('name')
        ];

        if ($this->payment_status->updatePayment_status($data, $id) > 0) {
            $this->response([
                'status' => true,
                'message' => 'Data payment_status has been updated'
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
            if ($this->payment_status->deletePayment_status($id) > 0) {
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