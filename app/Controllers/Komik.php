<?php

namespace App\Controllers;

use App\Models\KomikModel;

class Komik extends BaseController
{
    protected $KomikModel;
    public function __construct()
    {
        $this->KomikModel = new KomikModel();
    }
    public function index()
    {
        // $komik = $this->KomikModel->findall();


        $data = [
            'title' => 'Daftar komik',
            'Komik' => $this->KomikModel->getkomik()
        ];

        return view('komik/index', $data);
    }

    public function detail($slug)
    {
        $data = [
            'title' => 'Detail Komik',
            'komik' => $this->KomikModel->getkomik($slug)
        ];


        if (empty($data['komik'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Judul komik '  .  $slug  .  ' tidak ditemukan.');
        }

        return view('komik/detail', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Form Tambah Data Komik',
            'validation' => \config\Services::validation()
        ];
        return view('Komik/create', $data);
    }

    public function save()
    {
        // validasi input
        if (!$this->validate([
            'Judul' => [
                'rules' => 'required|is_unique[komik.Judul]',
                'errors' => [
                    'required' => '{field} komik harus diisi.',
                    'is_unique' => '{field} komik sudah terdaftar'
                ]
            ],
            'sampul' => [
                'rules' => 'max_size[sampul,1024]|is_image[sampul]|mime_in[sampul,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Ukuran gambar terlalu besar',
                    'is_image' => 'yang anda pilih bukan gambar',
                    'mime_in' => 'yang anda pilih bukan gambar'
                ]
            ]
        ])) {
            // $validation = \Config\Services::validation();
            // return redirect()->to('/Komik/create')->withInput()->with('validation', $validation);
            return redirect()->to('/Komik/create')->withInput();
        }

        $filegambar = $this->request->getFile('sampul');

        if($filegambar->getError() == 4){
            $namaSampul = 'default.png';
        } else {

            $filegambar->move('img');
    
            $namaSampul = $filegambar->getName();
        }

        $slug = url_title($this->request->getVar('Judul'), '-', true);
        
        $this->KomikModel->save([
            'Judul' => $this->request->getVar('Judul'),
            'slug' => $slug,
            'penulis' => $this->request->getVar('penulis'),
            'penerbit' => $this->request->getVar('penerbit'),
            'sampul' => $namaSampul
        ]);


        session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');

        return redirect()->to('/komik');
    }

    public function delete($id)
    {
        $this->KomikModel->delete($id);
        session()->setFlashdata('pesan', 'Data berhasil dihapus.');
        return  redirect()->to('/komik');
    }

    public function edit($slug)
    {
        $data = [
            'title' => 'Form Ubah Data Komik',
            'validation' => \config\Services::validation(),
            'komik' => $this->KomikModel->getKomik($slug)
        ];

        return view('Komik/edit', $data);
    }

    public function update($id)
    {
        $komiklama = $this->KomikModel->getKomik($this->request->getVar('slug'));
        if ($komiklama['Judul'] == $this->request->getVar('Judul')) {
            $rule_Judul = 'required';
        } else {
            $rule_Judul = 'required|is_unique[komik.Judul]';
        }


        if (!$this->validate([
            'Judul' => [
                'rules' => $rule_Judul,
                'errors' => [
                    'required' => '{field} komik harus diisi.',
                    'is_unique' => '{field} komik sudah terdaftar'
                ]
            ]
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to('/Komik/edit/' . $this->request->getVar('slug'))->withInput()->with('validation', $validation);
        }

        $slug = url_title($this->request->getVar('Judul'), '-', true);
        $this->KomikModel->save([
            'id' => $id,
            'Judul' => $this->request->getVar('Judul'),
            'slug' => $slug,
            'penulis' => $this->request->getVar('penulis'),
            'penerbit' => $this->request->getVar('penerbit'),
            'sampul' => $this->request->getVar('sampul')
        ]);


        session()->setFlashdata('pesan', 'Data berhasil diubah.');

        return redirect()->to('/komik');
    }
}
