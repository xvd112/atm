<?= $this->include('user/header'); ?>
<div class="menu-div">
    <center>
        <div>
            <h1><b>Mutasi Rekening</b></h1>
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
        <div class="f1">
            <div class="mb-3">
                <a href="<?= base_url(); ?>/trans/mutasi/n" type="button" class="btn btn-outline-secondary mutasi">Hari Ini</a>
                <a href="<?= base_url(); ?>/trans/mutasi/m" type="button" class="btn btn-outline-secondary mutasi">1 Minggu</a>
                <a href="<?= base_url(); ?>/trans/mutasi/b" type="button" class="btn btn-outline-secondary mutasi">1 Bulan</a>
            </div>
            <form action="<?= base_url(); ?>/trans/mutasi" method="post">
                <div class="mb-3">
                    <div class="row g-2">
                        <div class="col-md">
                            <div class="form-floating">
                                <input required name="awal" type="date" class="form-control" id="floatingInputGrid">
                                <label for="floatingInputGrid">Tanggal Awal</label>
                            </div>
                        </div>
                        <div class="col-md">
                            <div class="form-floating">
                                <input required name="akhir" type="date" class="form-control" id="floatingInputGrid">
                                <label for="floatingInputGrid">Tanggal Akhir</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a href="<?= base_url(); ?>/akun" type="button" class="btn btn-outline-danger">Kembali</a>
                </div>
            </form>
        </div>
    </center>
</div>

<?= $this->include('user/footer'); ?>