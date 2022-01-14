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
        <form method="post" action="<?= base_url(); ?>/home/add">
            <h1>Create Account</h1>
            <div>
                <input name="uname" type="text" class="form-control" placeholder="Username" required />
            </div>
            <div class="row">
                <div class="col">
                    <input name="fname" type="text" class="form-control" placeholder="First Name" required />
                </div>
                <div class="col">
                    <input name="lname" type="text" class="form-control" placeholder="Last Name" required />
                </div>
            </div>
            <div>
                <input name="email" type="email" class="form-control" placeholder="Email" required />
            </div>
            <div>
                <input name="pass" type="password" class="form-control" placeholder="Password" required />
            </div>
            <div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>

        <div class="separator">
            <p>Already a member ?
                <a href="<?= base_url(); ?>/" class="to_register"> Log in </a>
            </p>

            <div>
                <p>&#169; <?= date('Y'); ?> All Rights Reserved.</p>
            </div>
        </div>
    </section>
</div>
<?= $this->include('akun/footer'); ?>