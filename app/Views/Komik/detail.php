<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <h2 class="mt-2">Detail Film</h2>
            <div class="card mb-3" style="max-width: 540px;">
                <div class="row no-gutters">
                    <div class="col-md-4">
                        <img src="/img/<?= $komik['sampul']; ?>" class="card-img" alt="">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title"><?= $komik['Judul']; ?></h5>
                            <p class="card-text"><b> Sutradara : </b><?= $komik['penulis']; ?></p>
                            <p class="card-text"><b> produksi  : </b><?= $komik['penerbit']; ?></p>
                            <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>


                            <a href="/Komik/edit/<?= $komik['slug']; ?>" class="btn btn-warning">edit</a>

                            <form action="/komik/<?= $komik['id']; ?>" method="post" class="d-inline">
                                <?= csrf_field(); ?>
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-danger" onclick="return confirm('apakah anda yakin?');">Delete</button>
                            </form>

                            <br><br>
                            <a href="/komik">Kembali ke daftar kontak</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>