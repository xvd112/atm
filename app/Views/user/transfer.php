<?= $this->include('user/header'); ?>
<div class="menu-div">
    <center>
        <div>
            <h1><b>Transfer</b></h1>
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
        <form action="<?= base_url(); ?>/trans/transfer" method="post">
            <div class="f1">
                <div class="mb-3">
                    <div class="form-floating">
                        <select onchange="direct()" class="form-select" id="floatingSelectGrid" aria-label="Floating label select example" name="akun">
                            <option selected>Pilih Akun</option>
                            <?php
                            foreach ($fav as $fav) {
                            ?>
                                <option value="<?php echo $fav['akun_fav'] ?>"><?php echo $fav['nama'] ?> - <?php echo $fav['akun_fav'] ?></option>
                            <?php } ?>
                            <option value="add">Tambah Favorit</option>
                        </select>
                        <label for="floatingSelectGrid">Tujuan Transfer</label>
                    </div>
                </div>
                <div class="form-floating mb-3">
                    <input required autocomplete="off" name="transfer" type="text" class="form-control" id="floatingInput" placeholder="Jumlah Transfer">
                    <label for="floatingInput">Jumlah Transfer</label>
                </div>
                <div class="form-floating mb-3">
                    <textarea name="ket" class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"></textarea>
                    <label for="floatingInput">Keterangan Transfer</label>
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a href="<?= base_url(); ?>/akun" type="button" class="btn btn-outline-danger">Kembali</a>
                </div>
            </div>
        </form>
    </center>
</div>

<?= $this->include('user/footer'); ?>