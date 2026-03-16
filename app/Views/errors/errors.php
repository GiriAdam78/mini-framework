<!DOCTYPE html>
<html>
<head>
<title>Application Error</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-5">

<div class="card shadow">

<div class="card-body text-center">

<h2 class="text-danger">Application Error</h2>

<?php if($errorType == 'database'): ?>

<p>Database connection failed.</p>

<?php elseif($errorType == 'migration'): ?>

<p>Database migration has not been run.</p>

<pre class="bg-dark text-light p-3">php cli/migrate</pre>

<?php else: ?>

<p><?= $errorMessage ?></p>

<?php endif; ?>

</div>

</div>

</div>

</body>
</html>