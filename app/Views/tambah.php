<?= $this->extend('layouts/default') ?>

<?= $this->section('content') ?>
<div class="container mt-5 mb-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Tambah Data
                </div>
                <div class="card-body">
                    <form action="<?= base_url('add') ?>" method="post">
                        <div class="form-group">
                            <label for="judul">Judul</label>
                            <input type="text" name="judul" class="form-control" placeholder="Judul" required>
                        </div>
                        <div class="form-group mt-3">
                            <label for="konten">Konten</label>
                            <textarea name="konten" class="form-control" cols="30" rows="10"
                                placeholder="Konten"></textarea>
                        </div>
                        <div class="form-group mt-3">
                            <label for="tanggal_mulai">Tanggal Mulai</label>
                            <input type="datetime-local" name="tanggal_mulai" class="form-control" placeholder="Tanggal Mulai" required>
                        </div>
                        <div class="form-group mt-3">
                            <label for="tanggal_selesai">Tanggal Selesai</label>
                            <input type="datetime-local" name="tanggal_selesai" class="form-control" placeholder="Tanggal Selesai" required>
                        </div>
                        <div class="form-group mt-3">
                            <label for="target">Target</label>
                            <input type="number" name="target" class="form-control" placeholder="Target" required>
                        </div>
                        <div class="form-group mt-3">
                            <button type="submit" class="btn btn-sm btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>