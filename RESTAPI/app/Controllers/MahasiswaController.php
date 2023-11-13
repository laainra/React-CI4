<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class MahasiswaController extends ResourceController
{
    protected $format = 'json';

    public function index()
    {
        $mahasiswaModel = new \App\Models\MahasiswaModel();
        $data = $mahasiswaModel->findAll();

        if (!empty($data)) {
            $response = [
                'status' => 'success',
                'message' => 'Data retrieved successfully',
                'data' => $data
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'No data found',
                'data' => []
            ];
        }

        return $this->respond($response);
    }
    public function create()
    {
        $nama = $this->request->getVar('nama');
        $nim = $this->request->getVar('nim');
        $alamat = $this->request->getVar('alamat');

        if (empty($nama) || empty($nim) || empty($alamat)) {
            $response = [
                'status' => 400,
                'message' => 'Bad Request - Missing required data',
            ];
        } else {
            $data = [
                'nama' => $nama,
                'nim' => $nim,
                'alamat' => $alamat,
            ];

            $mahasiswaModel = new \App\Models\MahasiswaModel();
            $mahasiswaModel->save($data);

            $response = [
                'status' => 200,
                'message' => 'Data berhasil ditambahkan',
                'data' => $data,
            ];
        }

        return $this->respond($response);
    }


    public function updateMahasiswa($id)
    {
        $nama = $this->request->getVar('nama');
        $nim = $this->request->getVar('nim');
        $alamat = $this->request->getVar('alamat');

        $mahasiswaModel = new \App\Models\MahasiswaModel();

        $existingData = $mahasiswaModel->find($id);

        if ($existingData) {
            $data = [
                'nama' => $nama,
                'nim' => $nim,
                'alamat' => $alamat,
            ];


            $mahasiswaModel->update($id, $data);

            $response = [
                'status' => 200,
                'message' => 'Data berhasil diupdate',
                'data' => $data,
            ];
        } else {
            $response = [
                'status' => 404,
                'message' => 'Record not found',
            ];
        }

        return $this->respond($response);
    }
}
