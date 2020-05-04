<?php
defined('BASEPATH') or exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Method extends RestController
{

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('payment_method_model', 'payment_method');
    }

    public function index_get()
    {
        $id = $this->get('id');
        if ($id === NULL) {
            $payment_method = $this->payment_method->getPayment_method();
        } else {
            $payment_method = $this->payment_method->getPayment_method($id);
        }

        if ($payment_method) {
            $this->response([
                'status' => true,
                'data' => $payment_method
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => FALSE,
                'message' => 'Tidak Ditemukan payment_method'
            ], RestController::HTTP_NOT_FOUND);
        }
    }
    public function index_post()
    {
        $data = [
            'name' => $this->post('name')
        ];

        if ($this->payment_method->createPayment_method($data) > 0) {
            $this->response([
                'status' => true,
                'message' => 'Data payment_method Dibuat'
            ], RestController::HTTP_CREATED);
        } else {
            //id not found
            $this->response([
                'status' => false,
                'message' => 'Gagal membuat data payment_method baru'
            ], RestController::HTTP_BAD_REQUEST);
        }
    }
    public function index_put()
    {
        $id = $this->put('id');
        $data = [
            'name' => $this->put('name')
        ];

        if ($this->payment_method->updatePayment_method($data, $id) > 0) {
            $this->response([
                'status' => true,
                'message' => 'Data payment_method has been updated'
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
            if ($this->payment_method->deletePayment_method($id) > 0) {
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