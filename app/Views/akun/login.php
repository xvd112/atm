<?= $this->include('akun/header'); ?>
<?php if (session()->getFlashdata('pesan')) : ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= session()->getFlashdata('pesan'); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php elseif (session()->getFlashdata('danger')) : ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= session()->getFlashdata('danger'); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php elseif (session()->getFlashdata('warning')) : ?>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <?= session()->getFlashdata('warning'); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>
<div>
    <section class="login_content">
        <form method="post" action="<?= base_url(); ?>/home/login">
            <h1>Login</h1>
            <div>
                <input name="log" type="text" class="form-control" placeholder="Username / Email / Akun" required />
            </div>
            <div>
                <input name="pass" type="password" class="form-control" placeholder="Password" required />
            </div>
            <div>
                <button type="submit" class="btn btn-primary">Log In</button>
            </div>
        </form>

        <div class="separator">
            <p>New to site?
                <a href="<?= base_url(); ?>/home/signup" class="to_register"> Create Account </a>
            </p>

            <div>
                <p>&#169; <?= date('Y'); ?> All Rights Reserved.</p>
            </div>
        </div>
    </section>
</div>
<?= $this->include('akun/footer'); ?>