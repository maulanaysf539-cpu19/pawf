<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PostModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class PostAdmin extends BaseController
{
    public function index()
    {
        $post = new PostModel();
        // Mengambil semua data untuk ditampilkan di tabel dan dihitung statistiknya
        $data['posts'] = $post->findAll();
        
        // Sesuaikan nama file view jika berbeda (misal: admin_post_list atau post)
        echo view('admin/admin_post_list', $data);
    }

    public function preview($id)
    {
        $post = new PostModel();
        $data['post'] = $post->where('id', $id)->first();

        if (!$data['post']) {
            throw PageNotFoundException::forPageNotFound();
        }
        echo view('post_detail', $data);
    }

    public function create()
    {
        // Validasi input termasuk file gambar
        $validation =  \Config\Services::validation();
        $validation->setRules([
            'title' => 'required',
            'post_image' => 'uploaded[post_image]|max_size[post_image,2048]|is_image[post_image]|mime_in[post_image,image/jpg,image/jpeg,image/png]'
        ]);
        
        $isDataValid = $validation->withRequest($this->request)->run();

        if ($isDataValid) {
            $post = new PostModel();
            
            // Proses upload file
            $file = $this->request->getFile('post_image');
            $fileName = null;

            if ($file && $file->isValid() && !$file->hasMoved()) {
                $fileName = $file->getRandomName();
                $file->move(ROOTPATH . 'public/uploads', $fileName);
            }

            $post->insert([
                "title"      => $this->request->getPost('title'),
                "content"    => $this->request->getPost('content'),
                "status"     => $this->request->getPost('status'),
                "post_image" => $fileName,
                "post_views" => 0, // Inisialisasi view baru
                "slug"       => url_title($this->request->getPost('title'), '-', TRUE)
            ]);
            
            return redirect('admin/post');
        }

        echo view('admin/admin_post_create');
    }

    public function edit($id)
    {
        $post = new PostModel();
        $data['post'] = $post->where('id', $id)->first();

        $validation =  \Config\Services::validation();
        $validation->setRules([
            'id'    => 'required',
            'title' => 'required'
        ]);
        
        $isDataValid = $validation->withRequest($this->request)->run();

        if ($isDataValid) {
            $file = $this->request->getFile('post_image');
            $updateData = [
                "title"   => $this->request->getPost('title'),
                "content" => $this->request->getPost('content'),
                "status"  => $this->request->getPost('status')
            ];

            // Jika admin mengunggah gambar baru saat edit
            if ($file && $file->isValid() && !$file->hasMoved()) {
                $fileName = $file->getRandomName();
                $file->move(ROOTPATH . 'public/uploads', $fileName);
                $updateData["post_image"] = $fileName;
                
                // Opsional: Hapus file lama jika ingin menghemat storage
                if (!empty($data['post']['post_image'])) {
                    @unlink(ROOTPATH . 'public/uploads/' . $data['post']['post_image']);
                }
            }

            $post->update($id, $updateData);
            return redirect('admin/post');
        }

        echo view('admin/admin_post_update', $data);
    }

    public function delete($id)
    {
        $post = new PostModel();
        
        // Hapus file fisik gambar sebelum menghapus data di DB
        $data = $post->find($id);
        if ($data && !empty($data['post_image'])) {
            @unlink(ROOTPATH . 'public/uploads/' . $data['post_image']);
        }

        $post->delete($id);
        return redirect('admin/post');
    }
}