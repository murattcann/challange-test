<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title><?= $title ?></title>
</head>
<body>
<div class="container">
    <div class="row mt-2">
        <div class="col-sm-12">
            <h2 class="text-center"><?= $title?></h2>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="alert alert-info">
                You can click the question link to show solution
            </div>
        </div>

        <div class="col-sm-8">
            <div class="row">
                <div class="col-sm-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title">Question 1</h5>
                            <h6 class="card-subtitle mb-2 text-muted">Shows the solution</h6>
                            <p class="card-text">The question about hits table</p>
                            <a href="<?= BASE_URL. "?route=import-excel" ?>" class="card-link">Import Excel</a>
                            <a href="<?= BASE_URL. "?route=job-report"?>" class="card-link">Hits Report</a>
                        </div>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title">Question 3</h5>
                            <h6 class="card-subtitle mb-2 text-muted">Shows the solution</h6>
                            <p class="card-text">Text scrambling and unscrambling</p>
                            <a href="<?= BASE_URL. "?route=change-text" ?>" class="card-link">Try It</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title">Question 4</h5>
                            <h6 class="card-subtitle mb-2 text-muted">Shows the solution</h6>
                            <p class="card-text">Creating checkerboard pattern with GD</p>
                            <a href="<?= BASE_URL. "?route=create-image&width=200&height=200&fieldWidth=20" ?>" class="card-link">Try It</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>