<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $post['title'] ?> - MyBlog</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?= base_url('css/bootstrap.min.css') ?>" />
    <style>
        .post-image-container {
            width: 100%;
            max-height: 450px;
            overflow: hidden;
            border-radius: 8px;
        }
        .post-image-container img {
            width: 100%;
            height: auto;
            object-fit: cover;
        }
        .post-content {
            line-height: 1.8;
            font-size: 1.1rem;
        }
    </style>
</head>

<body>

    <?= $this->include('layouts/navbar'); ?>

    <div class="p-5 mb-4 bg-light rounded-3">
      <div class="container py-5">
        <h1 class="display-5 fw-bold">Post Preview</h1>
        <p class="text-muted">Melihat tampilan artikel sebelum diterbitkan.</p>
      </div>
    </div>

    <div class="container mb-5">
        <div class="row">
            <div class="col-md-12 my-2 card shadow-sm">
                <div class="card-body p-4">
                    <!-- Judul Artikel -->
                    <h1 class="h2 mb-3"><?= $post['title'] ?></h1>            
                    
                    <!-- Meta Data -->
                    <div class="mb-4 text-muted">
                        <small>
                            <strong>Penulis:</strong> <?= $post['author'] ?? 'Admin' ?> | 
                            <strong>Tanggal:</strong> <?= date('d M Y', strtotime($post['created_at'])) ?> | 
                            <strong>Dilihat:</strong> <?= $post['post_views'] ?? 0 ?> kali
                        </small>
                    </div>

                    <hr>

                    <!-- BAGIAN GAMBAR UTAMA -->
                    <?php if (!empty($post['post_image'])): ?>
                        <div class="post-image-container mb-4 text-center">
                            <img src="<?= base_url('uploads/' . $post['post_image']) ?>" 
                                 alt="<?= $post['title'] ?>" 
                                 class="img-fluid shadow-sm">
                        </div>
                    <?php else: ?>
                        <!-- Placeholder jika tidak ada gambar -->
                        <div class="bg-secondary text-white text-center p-5 mb-4 rounded">
                            <p>No Header Image Available</p>
                        </div>
                    <?php endif; ?>

                    <!-- Isi Konten Artikel -->
                    <div class="post-content mt-4">
                        <?= $post['content'] ?>
                    </div>
                    
                    <hr class="mt-5">
                    
                    <!-- Tombol Navigasi -->
                    <div class="d-flex justify-content-between">
                        <a href="<?= base_url('admin/post') ?>" class="btn btn-outline-secondary">
                            &larr; Kembali ke Dashboard
                        </a>
                        <a href="<?= base_url('admin/post/edit/'.$post['id']) ?>" class="btn btn-warning">
                            Edit Artikel Ini
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="container py-4">
        <footer class="pt-3 mt-4 text-muted border-top text-center">
            &copy; <?= Date('Y') ?> MyBlog System
        </footer>
    </div>

    <!-- Jquery dan Bootsrap JS -->
    <script src="<?= base_url('js/jquery.min.js') ?>"></script>
    <script src="<?= base_url('js/bootstrap.min.js') ?>"></script>

</body>

</html>