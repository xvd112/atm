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
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr align="center">
                            <th>Uraian</th>
                            <th>Tipe</th>
                            <th>Nominal</th>
                            <th>Saldo Akhir</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($b as $data) { ?>
                            <tr>
                                <td>
                                    <p><?= $data['ket']; ?></p>
                                    <p style="line-height: 0; color: red;"><?= $data['tgl']; ?></p>
                                </td>
                                <td><?= $data['tipe']; ?></td>
                                <td align="right"><?= 'Rp' . number_format($data['jml'], 2, ',', '.'); ?></td>
                                <td align="right"><?= 'Rp' . number_format($data['mutasi'], 2, ',', '.'); ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <?= $pager->links('data', 'bootstrap_pagination') ?>
            </div>
            <div class="mb-3">
                <a href="<?= base_url(); ?>/akun/mutasi" type="button" class="btn btn-outline-danger">Kembali</a>
            </div>
        </div>
    </center>
</div>

<?= $this->include('user/footer'); ?>