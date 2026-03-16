<!DOCTYPE html>
<html>
<head>
    <title>Application Error</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">

    <div class="card shadow">

        <div class="card-header bg-danger text-white">
            <h4>⚠️ WHOOPS MAAF ADA KESALAHAN</h4>
        </div>

        <div class="card-body">

            <h5 class="text-danger"><?= $message ?></h5>

            <p><strong>File:</strong> <?= $file ?></p>
            <p><strong>Line:</strong> <?= $line ?></p>

            <hr>

            <h6>Stack Trace</h6>

            <pre class="bg-dark text-light p-3 rounded"><?= $trace ?></pre>

        </div>

    </div>

</div>

</body>
</html>