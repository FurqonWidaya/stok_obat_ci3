<!-- Modal for Create/Update -->
<div class="modal" id="CreateModal" tabindex="-1" role="dialog" aria-labelledby="CreateModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="CreateModalLabel">Tambah Stok Obat</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Form for Create/Update -->
                <form id="CreateForm">
                    <input type="hidden" name="id" id="id">
                    <div class="form-group">
                        <label for="nama_obat">Nama Obat:</label>
                        <input type="text"
                            class="form-control <?= (form_error('nama_obat') != '') ? 'is-invalid' : ''; ?>"
                            name="nama_obat" id="nama_obat" required>
                        <div class="invalid-feedback">
                            <?= form_error('nama_obat'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="kategori_obat">kategori Obat:</label>
                        <input type="text" class="form-control" name="kategori_obat" id="kategori_obat" required>
                        <div class="invalid-feedback">
                            <?= form_error('kategori_obat'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="harga_obat">harga Obat:</label>
                        <input type="text" class="form-control" name="harga_obat" id="harga_obat" required>
                        <div class="invalid-feedback">
                            <?= form_error('harga_obat'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="stok">Stok:</label>
                        <input type="number" class="form-control" name="stok_obat" id="stok" required>
                        <div class="invalid-feedback">
                            <?= form_error('stok_obat'); ?>
                        </div>
                    </div>
                    <!-- Add other form fields as needed -->
                    <button type="button" class="btn btn-primary" id="submitCreate">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Modal for Edit -->
<div class="modal" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Stok Obat</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" method="post">
                <!-- Form for Edit -->
                <form id="editForm">
                    <input type="hidden" name="id" id="edit_id_obat">
                    <div class="form-group">
                        <label for="nama_obat">Nama Obat:</label>
                        <input type="text" class="form-control" name="nama_obat" id="editnama_obat" required>
                    </div>
                    <div class="form-group">
                        <label for="kategori_obat">kategori Obat:</label>
                        <input type="text" class="form-control" name="kategori_obat" id="editkategori_obat" required
                            value="">
                    </div>
                    <div class="form-group">
                        <label for="harga_obat">harga Obat:</label>
                        <input type="text" class="form-control" name="harga_obat" id="editharga_obat" required value="">
                    </div>
                    <div class="form-group">
                        <label for="stok">Stok:</label>
                        <input type="number" class="form-control" name="stok_obat" id="editstok_obat" required value="">
                    </div>
                    <!-- Add other form fields as needed -->
                    <button type="button" class="btn btn-primary" id="submitedit">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>