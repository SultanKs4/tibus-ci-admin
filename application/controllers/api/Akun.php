<?php
defined('BASEPATH') or exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Akun extends RestController
{

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('akun_model', 'akun');
    }

    public function index_get()
    {
        $id = $this->get('id');
        if ($id === NULL) {
            $akun = $this->akun->getAkun();
        } else {
            $akun = $this->akun->getAkun($id);
        }

        if ($akun) {
            $this->response([
                'status' => true,
                'data' => $akun
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => FALSE,
                'message' => 'Tidak Ditemukan Akun'
            ], RestController::HTTP_NOT_FOUND);
        }
    }

    public function check_post()
    {
        $email = $this->post('email');
        $password = hash('sha512', $this->post('password'));

        $data = $this->akun->checkLogin($email, $password);
        if ($data != false) {
            $this->response([
                'status' => true,
                'message' => 'Username dan password benar',
                'data' => $data
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Username dan Password salah',
            ], RestController::HTTP_FORBIDDEN);
        }
    }

    public function index_post()
    {
        $data = [
            'email' => $this->post('email'),
            'nama_depan' => $this->post('nama_depan'),
            'nama_belakang' => $this->post('nama_belakang'),
            'telpon' => $this->post('telpon'),
            'password' => hash('sha512', $this->post('password')),
            'id_level' => $this->post('id_level')
        ];

        if ($this->akun->createAkun($data) > 0) {
            $this->response([
                'status' => true,
                'message' => 'Data Akun Dibuat'
            ], RestController::HTTP_CREATED);
        } else {
            //id not found
            $this->response([
                'status' => false,
                'message' => 'Gagal membuat data akun baru'
            ], RestController::HTTP_BAD_REQUEST);
        }
    }

    public function index_put()
    {
        $id = $this->put('id');
        $data = [
            'email' => $this->put('email'),
            'nama_depan' => $this->put('nama_depan'),
            'nama_belakang' => $this->put('nama_belakang'),
            'telpon' => $this->put('telpon'),
            'password' => hash('sha512', $this->put('password')),
            'id_level' => $this->put('id_level')
        ];

        if ($this->akun->updateAkun($data, $id) > 0) {
            $this->response([
                'status' => true,
                'message' => 'Data Akun has been updated'
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
            if ($this->akun->deleteAkun($id) > 0) {
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
