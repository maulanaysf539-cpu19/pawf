<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,
initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/b
ootstrap.min.css" rel="stylesheet" integrity="sha384-
1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6j
IW3" crossorigin="anonymous">
    <title>Error 404 CI4</title>
    <style>
        .card {
            position: relative;
            display: flex;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 1px solid rgba(0, 0, 0, 0.04);
            border-radius: .25rem;
        }

        . card .card-header {
            background-color: #fff;
            border-bottom: none;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 col-sm-12">
                <div class="card shadow-lg border-0 rounded-
lg mt-5 mx-auto" style="width: 30rem;">
                    <h3 class="card-header display-1 text-
muted text-center">
                        404
                    </h3>
                    <div class="card-body text-center">
                        <h4 class="card-title">Page Not Found</h4>
                        <p class="card-text">The page you are looking for might have been removed had its name changed
                            or is temporarily unavailable.</p>
                        <a href="<?= base_url('/') ?>" class="btn btn-primary">Back to Home</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>