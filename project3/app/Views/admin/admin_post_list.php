<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyBlog - Admin</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?= base_url('css/bootstrap.min.css') ?>" />
    <style>
        .stats-card { transition: transform 0.2s; }
        .stats-card:hover { transform: translateY(-5px); }
        .thumbnail-preview { width: 60px; height: 60px; object-fit: cover; border-radius: 8px; }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <div class="container">
            <a class="navbar-brand" href="<?= base_url() ?>">MyBlog</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNav" aria-controls="navbarNav"
                aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" href="<?= base_url('admin/post') ?>">Blog</a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="<?= base_url('admin/post/new') ?>"
                           class="btn btn-primary mr-3">New Post</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('admin/setting') ?>">Setting</a>
                    </li>
                    <li class="nav-item">
                        <?php if (logged_in()) : ?>
                            <a class="nav-link" href="<?= base_url('logout') ?>">Logout</a>
                        <?php else: ?>
                            <a class="nav-link" href="<?= base_url('login') ?>">Login</a>
                        <?php endif; ?>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="p-5 mb-4 bg-light rounded-3 shadow-sm">
        <div class="container py-2">
            <h1 class="display-5 fw-bold">Blog > Admin</h1>
            <p class="col-md-8 fs-4">Kelola konten dan pantau performa artikel kamu.</p>
        </div>
    </div>

    <div class="container mb-5">
        <!-- SEKSI 4: STATISTIK RINGKAS -->
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card bg-primary text-white border-0 shadow-sm stats-card">
                    <div class="card-body">
                        <h5>Total Posts</h5>
                        <h2 class="fw-bold"><?= count($posts); ?></h2>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-success text-white border-0 shadow-sm stats-card">
                    <div class="card-body">
                        <h5>Total Views</h5>
                        <h2 class="fw-bold"><?= array_sum(array_column($posts, 'post_views')); ?></h2>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-warning text-dark border-0 shadow-sm stats-card">
                    <div class="card-body">
                        <h5>Drafts</h5>
                        <h2 class="fw-bold">
                            <?php 
                                $drafts = array_filter($posts, function($p) { return $p['status'] !== 'published'; });
                                echo count($drafts);
                            ?>
                        </h2>
                    </div>
                </div>
            </div>
        </div>

        <!-- TABEL ADMIN DENGAN FITUR 3 (THUMBNAIL) -->
        <div class="card shadow-sm">
            <div class="card-body p-0">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="px-4">#</th>
                            <th>Thumbnail</th>
                            <th>Title & Date</th>
                            <th>Views</th>
                            <th>Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 0; foreach($posts as $post): $no++; ?>
                        <tr class="align-middle">
                            <td class="px-4"><?= $no; ?></td>
                            <td>
                                <?php if(!empty($post['post_image'])): ?>
                                    <img src="<?= base_url('uploads/'.$post['post_image']) ?>" class="thumbnail-preview shadow-sm" alt="img">
                                <?php else: ?>
                                    <div class="bg-secondary text-white thumbnail-preview d-flex align-items-center justify-content-center" style="font-size: 10px;">No Image</div>
                                <?php endif; ?>
                            </td>
                            <td>
                                <strong><?= $post['title'] ?></strong><br>
                                <small class="text-muted"><?= date('d M Y', strtotime($post['created_at'])) ?></small>
                            </td>
                            <td>
                                <span class="badge bg-info text-dark"><?= number_format($post['post_views'] ?? 0); ?> views</span>
                            </td>
                            <td>
                                <?php if($post['status'] === 'published'): ?>
                                    <span class="badge bg-success">Published</span>
                                <?php else: ?>
                                    <span class="badge bg-secondary">Draft</span>
                                <?php endif ?>
                            </td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <a href="<?= base_url('admin/post/'.$post['id'].'/preview') ?>"
                                       class="btn btn-sm btn-outline-secondary" target="_blank">Preview</a>
                                    <a href="<?= base_url('admin/post/'.$post['id'].'/edit') ?>"
                                       class="btn btn-sm btn-outline-primary">Edit</a>
                                    <a href="#"
                                       data-href="<?= base_url('admin/post/'.$post['id'].'/delete') ?>"
                                       onclick="confirmToDelete(this)"
                                       class="btn btn-sm btn-outline-danger">Delete</a>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Modal Konfirmasi Delete -->
        <div id="confirm-dialog" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content border-0 shadow">
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title">Konfirmasi Hapus</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center py-4">
                        <h4 class="fw-bold">Yakin ingin menghapus?</h4>
                        <p class="text-muted">Data yang dihapus tidak dapat dikembalikan lagi.</p>
                    </div>
                    <div class="modal-footer bg-light justify-content-center">
                        <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">Batal</button>
                        <a href="#" role="button" id="delete-button" class="btn btn-danger px-4">Hapus Permanen</a>
                    </div>
                </div>
            </div>
        </div>

        <script>
            function confirmToDelete(el) {
                document.getElementById("delete-button").setAttribute("href", el.dataset.href);
                var myModal = new bootstrap.Modal(document.getElementById('confirm-dialog'), {
                    keyboard: false
                });
                myModal.show();
            }
        </script>
    </div>

    <div class="container py-4">
        <footer class="pt-3 mt-4 text-muted border-top text-center">
            &copy; <?= Date('Y') ?> MyBlog Dashboard System
        </footer>
    </div>

    <!-- jQuery dan Bootstrap JS -->
    <script src="<?= base_url('js/jquery.min.js') ?>"></script>
    <script src="<?= base_url('js/bootstrap.bundle.min.js') ?>"></script>
</body>
</html>