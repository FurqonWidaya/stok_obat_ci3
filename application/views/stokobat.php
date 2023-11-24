<div id="welcome-message"></div>
<div class="container mt-4">
    <?php
    if ($this->session->flashdata('success')) {
    echo '<div id="alert" class="alert alert-success">' . $this->session->flashdata('success') . '</div>';
    }
    if ($this->session->flashdata('error')) {
    echo '<div id="alert" class="alert alert-danger">' . $this->session->flashdata('error') . '</div>';
    }
    ?>
    <h2>Data Stok Obat</h2>
    <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#CreateModal">
        Tambah Stok Obat
    </button>

    <!-- DataTables Table -->
    <table id="stokObatTable" class="table">
        <thead>
            <tr>
                <th>NO</th>
                <th>Nama Obat</th>
                <th>Kategori Obat</th>
                <th>Harga Obat</th>
                <th>Stok</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>
<!-- memanggil view modal -->
<?= $modal ?>


<!-- Include DataTables initialization script -->
<script>
$(document).ready(function get_stok_obat() {
    // DataTables inisialisasi
    var stokObatTable = $('#stokObatTable').DataTable({
        ajax: {
            url: '<?= base_url('stokobat/get_stok_obat'); ?>', //mendapatkan api get stok obat
            type: 'GET',
            dataType: 'json',
            dataSrc: ''
        },
        //untuk menampilkan data pada datatable
        columns: [{
                data: null,
                render: function(data, type, row, meta) {
                    // Menggunakan meta.row untuk mendapatkan indeks urutan
                    return meta.row + 1;
                }
            },
            {
                data: 'nama_obat'
            },
            {
                data: 'kategori_obat'
            },
            {
                data: 'harga_obat'
            },
            {
                data: 'stok_obat'
            },

            {
                data: 'id',
                render: function(data) {
                    return '<button type="button" class="btn btn-warning btn-sm mr-2" onclick="editStokObat(' +
                        data + ')">Edit</button>' +
                        '<button type="button" class="btn btn-danger btn-sm" onclick="deleteStokObat(' +
                        data + ')" data-id="' + data + '">Hapus</button>';
                }
            }
        ],
    });

    $('#submitCreate').click(function() {
        $.ajax({
            url: '<?= base_url('stokobat/create_stok_obat'); ?>', //mendapatkan api create stok obat
            type: 'POST',
            data: $('#CreateForm').serialize(),
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    $('#CreateModal').modal('hide');
                    alert(response.message);
                    $('#stokObatTable').DataTable().ajax.reload();
                    $('#CreateForm')[0].reset();
                } else {
                    alert(response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
            }
        });
    });
});

// fungsi untuk menemukan data per id dan membuka modal form edit
function editStokObat(id) {
    $.ajax({
        url: '<?= base_url('stokobat/get_stok_obat_by_id'); ?>', //mendapatkan api get stok obat per id
        type: 'GET',
        data: {
            id: id
        },
        dataType: 'json',
        success: function(response) {
            console.log(response); //cek console kondisi data
            if (response) {
                //set value data dari kolom form view agar bisa dikenali oleh fungsi
                $('#edit_id_obat').val(response.id);
                $('#editnama_obat').val(response.nama_obat);
                $('#editkategori_obat').val(response.kategori_obat);
                $('#editharga_obat').val(response.harga_obat);
                $('#editstok_obat').val(response.stok_obat);
                // menampilkan modal form edit
                $('#editModal').modal('show');
            } else {
                alert('Data not found.');
            }
        },
        error: function(xhr, status, error) {
            console.error('Error:', error);
        }
    });
}
//untuk ketika menekan submit edit data
$('#submitedit').click(function() {
    var data = $('#editForm').serializeArray();
    $.ajax({
        type: 'POST',
        url: "<?= base_url('stokobat/update_stok_obat'); ?>", //mendapatkan api update stok obat per id
        data: data,
        dataType: 'json',
        success: function(response) {
            if (response.status === 'success') {
                $('#editModal').modal('hide'); // Close the modal
                alert(response.message);
                $('#stokObatTable').DataTable().ajax.reload();
            } else {
                alert(response.message);
            }
        },
        error: function(xhr, status, error) {
            console.error('Error:', error);
        }
    });
});

// fungsi menghapus data
function deleteStokObat(id) {
    if (confirm('Are you sure you want to delete this record?')) {
        $.ajax({
            url: '<?= base_url('stokobat/delete_stok_obat'); ?>', //mendapatkan api delete stok obat per id
            type: 'POST',
            data: {
                id: id
            },
            success: function(response) {
                $('#stokObatTable').DataTable().ajax.reload();
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
            }
        });
    }
}
</script>