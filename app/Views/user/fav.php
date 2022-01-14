<?= $this->include('user/header'); ?>
<div class="menu-div">
    <center>
        <div>
            <h1><b>Tambah Favorit</b></h1>
        </div>
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
        <form action="<?= base_url(); ?>/trans/fav" method="post">
            <div class="f1">
                <div class="form-floating mb-3">
                    <input required autocomplete="off" name="akun" type="text" class="form-control" placeholder="No Akun">
                    <label for="floatingInput">No Akun</label>
                </div>
                <div class="form-floating mb-3">
                    <input required autocomplete="off" name="nama" type="text" class="form-control" placeholder="Nama">
                    <label for="floatingInput">Nama</label>
                </div>
                <div class="form-floating mb-3">
                    <input autocomplete="off" name="email" type="text" class="form-control" placeholder="Email">
                    <label for="floatingInput">Email</label>
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a href="<?= base_url(); ?>/akun/transfer" type="button" class="btn btn-outline-danger">Kembali</a>
                </div>
            </div>
        </form>
    </center>
</div>

<?= $this->include('user/footer'); ?>