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
            <h5 class="card-title text-center">REGISTRASI</h5>
            <form method="post" action="<?= base_url('auth/register'); ?>">
                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" class="form-control <?= (form_error('nama') != '') ? 'is-invalid' : ''; ?>"
                        id="nama" placeholder="Enter your first name" name="nama" value="<?= set_value('nama'); ?>">
                    <div class="invalid-feedback">
                        <?= form_error('nama'); ?>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="username">username</label>
                        <input type="username"
                            class="form-control <?= (form_error('username') != '') ? 'is-invalid' : ''; ?>"
                            id="username" placeholder="Enter your username" name="username"
                            value="<?= set_value('username'); ?>">
                        <div class="invalid-feedback">
                            <?= form_error('username'); ?>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="email">Email</label>
                        <input type="text" class="form-control <?= (form_error('email') != '') ? 'is-invalid' : ''; ?>"
                            id="email" placeholder="Enter your email" name="email" value="<?= set_value('email'); ?>">
                        <div class="invalid-feedback">
                            <?= form_error('email'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password"
                        class="form-control <?= (form_error('password') != '') ? 'is-invalid' : ''; ?>" id="password"
                        name="password" placeholder="Enter your password">
                    <div class="invalid-feedback">
                        <?= form_error('password'); ?>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Register</button>
                <p class="small fw-bold mt-2 pt-1 mb-0">Punya Akun? <a href="<?= base_url('auth/login'); ?>"
                        class="link-danger">Login</a>
                </p>
            </form>
        </div>
    </div>
</div>