<style>
body {
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100vh;
    margin: 0;
}
</style>
<div class="row text-center justify-content-center">
    <div class="card col-4">
        <div class="card-body">
            <h5 class="card-title text-center">Login</h5>
            <?php
        // Check if flash data exists
        if ($this->session->flashdata('success')) {
            echo '<div id="alert" class="alert alert-success">' . $this->session->flashdata('success') . '</div>';
        }
        if ($this->session->flashdata('error')) {
            echo '<div id="alert" class="alert alert-danger">' . $this->session->flashdata('error') . '</div>';
        }
        ?>
            <form method="post" action="<?= base_url('auth/login'); ?>">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" name="username"
                        class="form-control <?= (form_error('username') != '') ? 'is-invalid' : ''; ?>" id="username"
                        placeholder="Enter your username" value="<?= set_value('username');?>">
                    <div class="invalid-feedback">
                        <?= form_error('username'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input name='password' type="password"
                        class="form-control <?= (form_error('password') != '') ? 'is-invalid' : ''; ?>" id="password"
                        placeholder="Enter your password">
                    <div class="invalid-feedback">
                        <?= form_error('password'); ?>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Login</button>
                <p class="small fw-bold mt-2 pt-1 mb-0">tidak punya akun? <a href="<?= base_url('auth/register'); ?>"
                        class="link-danger">Register</a>
                </p>
            </form>
        </div>
    </div>
</div>