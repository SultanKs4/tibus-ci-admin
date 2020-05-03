<?php
defined('BASEPATH') or exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Tiket_booking extends RestController
{

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('tiket_booking_model', 'tiket_booking');
    }

    public function index_get()
    {
        $id = $this->get('id');
        if ($id === NULL) {
            $tiket_booking = $this->tiket_booking->getTiket_booking();
        } else {
            $tiket_booking = $this->tiket_booking->getTiket_booking($id);
        }

        if ($tiket_booking) {
            $this->response([
                'status' => true,
                'data' => $tiket_booking
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => FALSE,
                'message' => 'Tidak Ditemukan tiket_booking'
            ], RestController::HTTP_NOT_FOUND);
        }
    }
    public function index_post()
    {
        $data = [
            'name' => $this->post('name')
        ];

        if ($this->tiket_booking->createTiket_booking($data) > 0) {
            $this->response([
                'status' => true,
                'message' => 'Data tiket_booking Dibuat'
            ], RestController::HTTP_CREATED);
        } else {
            //id not found
            $this->response([
                'status' => false,
                'message' => 'Gagal membuat data tiket_booking baru'
            ], RestController::HTTP_BAD_REQUEST);
        }
    }
    public function index_put()
    {
        $id = $this->put('id');
        $data = [
            'name' => $this->put('name')
        ];

        if ($this->tiket_booking->updateTiket_booking($data, $id) > 0) {
            $this->response([
                'status' => true,
                'message' => 'Data tiket_booking has been updated'
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
            if ($this->tiket_booking->deleteTiket_booking($id) > 0) {
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
