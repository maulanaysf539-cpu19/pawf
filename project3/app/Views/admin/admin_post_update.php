<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyBlog</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?= base_url('css/bootstrap.min.css') ?>" />
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
                        <a class="nav-link" href="<?= base_url('admin/post') ?>">Blog</a>
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

    <div class="p-5 mb-4 bg-light rounded-3">
        <div class="container py-5">
            <h1 class="display-5 fw-bold">Blog > Admin</h1>
        </div>
    </div>
    
    <!-- update post -->
    <div class="container">
        <!-- 1. Tambahkan enctype="multipart/form-data" agar bisa kirim file gambar -->
        <form action="" method="post" id="text-editor" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $post['id'] ?>" />
            
            <div class="form-group mb-3">
                <label for="title">Title</label>
                <input type="text" name="title" class="form-control"
                    placeholder="Post title" value="<?= $post['title'] ?>" required>
            </div>

            <!-- 2. Tambahkan Input File untuk Gambar -->
            <div class="form-group mb-3">
                <label for="post_image">Change Thumbnail</label>
                <input type="file" name="post_image" class="form-control" accept="image/*">
                
                <!-- Tampilkan gambar lama jika ada -->
                <?php if (!empty($post['post_image'])): ?>
                    <div class="mt-2">
                        <small class="text-muted">Current image:</small><br>
                        <img src="<?= base_url('uploads/' . $post['post_image']) ?>" 
                             alt="Current Thumbnail" 
                             style="max-width: 150px;" class="img-thumbnail mt-1">
                    </div>
                <?php endif; ?>
            </div>

            <div class="form-group mb-3">
                <label for="content">Content</label>
                <textarea name="content" class="form-control" cols="30" rows="10"
                        placeholder="Write a great post!"><?= $post['content'] ?></textarea>
            </div>

            <div class="form-group mb-2">
                <button type="submit" name="status" value="published"
                        class="btn btn-primary">Publish</button>
                <button type="submit" name="status" value="draft"
                        class="btn btn-secondary">Save to Draft</button>
            </div>
        </form>
    </div>

    <div class="container py-4">
        <footer class="pt-3 mt-4 text-muted border-top">
            <div class="container">
                &copy; <?= Date('Y') ?>
            </div>
        </footer>
    </div>

    <!-- jQuery dan Bootstrap JS -->
    <script src="<?= base_url('js/jquery.min.js') ?>"></script>
    <script src="<?= base_url('js/bootstrap.bundle.min.js') ?>"></script>

</body>
</html>