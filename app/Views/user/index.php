<?= $this->include('user/header'); ?>
<div class="menu-div">
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
    <center>
        <a href=" <?= base_url(); ?>/akun/info" class="btn btn-outline-success menu" role="button">Info Saldo</a>
        <a href=" <?= base_url(); ?>/akun/mutasi" class="btn btn-outline-success menu" role="button">Mutasi</a>
        <a href=" <?= base_url(); ?>/akun/setor" class="btn btn-outline-success menu" role="button">Setor Tunai</a>
        <a href=" <?= base_url(); ?>/akun/tarik" class="btn btn-outline-success menu" role="button">Tarik Tunai</a>
        <a href=" <?= base_url(); ?>/akun/transfer" class="btn btn-outline-success menu" role="button">Transfer</a>
    </center>
</div>
<?= $this->include('user/footer'); ?>