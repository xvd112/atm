<?= $this->include('user/header'); ?>
<div class="menu-div">
    <center>
        <div>
            <h1><b>Info Saldo</b></h1>
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
                <table class="table">
                    <tr>
                        <th>Akun</th>
                        <td> : <?= session()->akun; ?></td>
                    </tr>
                    <tr>
                        <th>Saldo</th>
                        <td> : <?= $saldo; ?></td>
                    </tr>
                </table>
            </div>
            <div class="mb-3">
                <a href="<?= base_url(); ?>/akun" type="button" class="btn btn-outline-danger">Kembali</a>
            </div>
        </div>
    </center>
</div>

<?= $this->include('user/footer'); ?>