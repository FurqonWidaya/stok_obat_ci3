<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <title>
        <?= $title; ?>
    </title>
</head>
<?php if ($this->session->userdata('username')) : ?>
<?php $user_data = $this->db->get_where('pengguna', ['username' => $this->session->userdata('username')])->row_array(); ?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="<?= base_url('/'); ?>">SI Medicines</a>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <span class="navbar-text">
                    Welcome, <?= $user_data['nama']; ?>!
                </span>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('auth/logout'); ?>">Logout</a>
            </li>
        </ul>
    </div>
</nav>
<?php endif; ?>

<body>
    <!-- Navbar -->
    <!-- End Navbar -->
    <div class=" container-fluid" id="content">
        <?= $content; ?>
    </div>
</body>
<?php if ($this->session->userdata('username')) : ?>
<footer class="footer mt-3 py-3 bg-dark">
    <div class="container text-center">
        <span class="text-muted">Copyright CI 3 AJAX CRUD TEST @2023.</span>
    </div>
</footer>
<?php endif; ?>
<script>
// Automatically dismiss the alert after 5000 milliseconds (5 seconds)
setTimeout(function() {
    $("#alert").alert('close');
}, 5000);
</script>

</html>