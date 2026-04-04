<?php
/**
 * Pegawai Page (pegawai.php)
 * Employee data management with DataTables, CRUD functionality
 * 
 * Layout: Uses partial files from includes/
 */

// Page Configuration
$pageTitle = 'SISPEG - Data Pegawai';
$activeMenu = 'pegawai';
$searchPlaceholder = 'Cari pegawai...';
$additionalCss = ['datatables'];  // Load DataTables CSS
$additionalJs = ['datatables'];   // Load DataTables JS

// User Configuration
$userName = 'Ahmad Rizki';
$userInitials = 'AR';
$userRole = 'Administrator';

// Include Head
include 'includes/head.php';

// Include Sidebar
include 'includes/sidebar.php';

// Include Navbar
include 'includes/navbar.php';
?>

<!-- Main Content -->
<main class="main-content" id="mainContent">
    <!-- Page Header -->
    <div class="page-header">
        <div class="page-header-left">
            <h1>Data Pegawai</h1>
            <p>Kelola data pegawai perusahaan</p>
        </div>
        <div class="page-header-right">
            <button class="btn-add-pegawai" id="btnTambahPegawai">
                <i class="fas fa-plus"></i>
                <span>Tambah Pegawai</span>
            </button>
        </div>
    </div>

    <!-- Data Pegawai Card -->
    <div class="content-card header-primary">
        <div class="content-card-header">
            <h5><i class="fas fa-users"></i> Daftar Pegawai</h5>
        </div>
        <div class="table-responsive">
            <table id="pegawaiTable" class="table table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Pegawai</th>
                        <th>NIP</th>
                        <th>Jabatan</th>
                        <th>Departemen</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="pegawaiTableBody">
                    <!-- Data will be loaded via JavaScript -->
                </tbody>
            </table>
        </div>
    </div>
</main>

<!-- Modal Tambah/Edit Pegawai -->
<div class="modal fade" id="pegawaiModal" tabindex="-1" aria-labelledby="pegawaiModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="pegawaiModalLabel">Tambah Pegawai</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="pegawaiForm">
                    <input type="hidden" id="pegawaiId">
                    <div class="mb-3">
                        <label for="pegawaiNama" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" id="pegawaiNama" placeholder="Masukkan nama lengkap" required>
                    </div>
                    <div class="mb-3">
                        <label for="pegawaiNIP" class="form-label">NIP</label>
                        <input type="text" class="form-control" id="pegawaiNIP" placeholder="Masukkan NIP" required>
                    </div>
                    <div class="mb-3">
                        <label for="pegawaiEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="pegawaiEmail" placeholder="Masukkan email" required>
                    </div>
                    <div class="mb-3">
                        <label for="pegawaiJabatan" class="form-label">Jabatan</label>
                        <select class="form-select" id="pegawaiJabatan" required>
                            <option value="">Pilih Jabatan</option>
                            <option value="Staff">Staff</option>
                            <option value="Senior Staff">Senior Staff</option>
                            <option value="Supervisor">Supervisor</option>
                            <option value="Manager">Manager</option>
                            <option value="Senior Manager">Senior Manager</option>
                            <option value="Director">Director</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="pegawaiDepartemen" class="form-label">Departemen</label>
                        <select class="form-select" id="pegawaiDepartemen" required>
                            <option value="">Pilih Departemen</option>
                            <option value="IT">IT</option>
                            <option value="HR">HR</option>
                            <option value="Finance">Finance</option>
                            <option value="Marketing">Marketing</option>
                            <option value="Operations">Operations</option>
                            <option value="Sales">Sales</option>
                            <option value="Legal">Legal</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="pegawaiStatus" class="form-label">Status</label>
                        <select class="form-select" id="pegawaiStatus" required>
                            <option value="">Pilih Status</option>
                            <option value="aktif">Aktif</option>
                            <option value="cuti">Cuti</option>
                            <option value="remote">Remote</option>
                            <option value="nonaktif">Nonaktif</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-modal-cancel" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn-modal-save" id="btnSavePegawai">Simpan</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Delete Konfirmasi -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <i class="fas fa-exclamation-triangle text-warning mb-3" style="font-size: 48px;"></i>
                <p class="mb-0">Apakah Anda yakin ingin menghapus data pegawai ini?</p>
                <input type="hidden" id="deletePegawaiId">
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn-modal-cancel" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn-modal-delete" id="btnConfirmDelete">Hapus</button>
            </div>
        </div>
    </div>
</div>

<?php
// Page-specific JavaScript (Pegawai)
$pageJs = <<<'JS'
/**
 * =====================================================
 * PEGAWAI PAGE JAVASCRIPT
 * =====================================================
 * Page-specific functionality for employee management
 * DataTables initialization and CRUD operations
 */

(function($) {
    'use strict';

    // =====================================================
    // DATA STATE
    // =====================================================
    
    var dataTable = null;
    var editingId = null;

    // Dummy Data Pegawai
    var pegawaiData = [
        { id: 1, nama: 'Ahmad Rizki', nip: 'NIP001', email: 'ahmad.rizki@company.com', jabatan: 'Manager', departemen: 'IT', status: 'aktif' },
        { id: 2, nama: 'Siti Nurhaliza', nip: 'NIP002', email: 'siti.nur@company.com', jabatan: 'Senior Staff', departemen: 'HR', status: 'aktif' },
        { id: 3, nama: 'Budi Santoso', nip: 'NIP003', email: 'budi.santoso@company.com', jabatan: 'Supervisor', departemen: 'Finance', status: 'cuti' },
        { id: 4, nama: 'Dewi Anggraini', nip: 'NIP004', email: 'dewi.anggraini@company.com', jabatan: 'Staff', departemen: 'Marketing', status: 'aktif' },
        { id: 5, nama: 'Eko Prasetyo', nip: 'NIP005', email: 'eko.prasetyo@company.com', jabatan: 'Senior Manager', departemen: 'Operations', status: 'remote' },
        { id: 6, nama: 'Fitri Wulandari', nip: 'NIP006', email: 'fitri.wulan@company.com', jabatan: 'Staff', departemen: 'IT', status: 'aktif' },
        { id: 7, nama: 'Gunawan Setiawan', nip: 'NIP007', email: 'gunawan.setia@company.com', jabatan: 'Director', departemen: 'Sales', status: 'aktif' },
        { id: 8, nama: 'Hendra Wijaya', nip: 'NIP008', email: 'hendra.wijaya@company.com', jabatan: 'Supervisor', departemen: 'Legal', status: 'nonaktif' },
        { id: 9, nama: 'Indah Permata', nip: 'NIP009', email: 'indah.permata@company.com', jabatan: 'Manager', departemen: 'HR', status: 'aktif' },
        { id: 10, nama: 'Joko Widodo', nip: 'NIP010', email: 'joko.widodo@company.com', jabatan: 'Senior Staff', departemen: 'Finance', status: 'cuti' },
        { id: 11, nama: 'Kartika Sari', nip: 'NIP011', email: 'kartika.sari@company.com', jabatan: 'Staff', departemen: 'Marketing', status: 'aktif' },
        { id: 12, nama: 'Lukman Hakim', nip: 'NIP012', email: 'lukman.hakim@company.com', jabatan: 'Manager', departemen: 'Operations', status: 'remote' },
        { id: 13, nama: 'Maya Putri', nip: 'NIP013', email: 'maya.putri@company.com', jabatan: 'Senior Staff', departemen: 'IT', status: 'aktif' },
        { id: 14, nama: 'Nugroho Adi', nip: 'NIP014', email: 'nugroho.adi@company.com', jabatan: 'Supervisor', departemen: 'Sales', status: 'aktif' },
        { id: 15, nama: 'Oktaviani Rina', nip: 'NIP015', email: 'oktaviani.rina@company.com', jabatan: 'Staff', departemen: 'Legal', status: 'cuti' }
    ];

    var nextId = 16;

    // =====================================================
    // DATATABLE FUNCTIONS
    // =====================================================

    /**
     * Generates status badge HTML
     * @param {string} status - Status identifier
     * @returns {string} HTML string for status badge
     */
    function getStatusBadge(status) {
        var statusConfig = {
            'aktif': { class: 'aktif', icon: 'fa-check-circle', label: 'Aktif' },
            'cuti': { class: 'cuti', icon: 'fa-calendar-alt', label: 'Cuti' },
            'remote': { class: 'remote', icon: 'fa-home', label: 'Remote' },
            'nonaktif': { class: 'nonaktif', icon: 'fa-times-circle', label: 'Nonaktif' }
        };
        var config = statusConfig[status] || statusConfig['aktif'];
        return '<span class="status-badge ' + config.class + '"><i class="fas ' + config.icon + '"></i> ' + config.label + '</span>';
    }

    /**
     * Gets initials from name
     * @param {string} name - Full name
     * @returns {string} Initials (max 2 characters)
     */
    function getInitials(name) {
        return name.split(' ').map(function(n) { return n[0]; }).join('').toUpperCase().substring(0, 2);
    }

    /**
     * Renders action buttons for DataTable
     * @param {number} id - Employee ID
     * @returns {string} HTML string for action buttons
     */
    function renderActionButton(id) {
        return '<div class="action-buttons">' +
            '<a class="btn-action btn-view" href="pegawai-detail.php?id=' + id + '" title="Detail">' +
                '<i class="fas fa-eye"></i>' +
            '</a>' +
            '<button class="btn-action btn-edit" onclick="editPegawai(' + id + ')" title="Edit">' +
                '<i class="fas fa-edit"></i>' +
            '</button>' +
            '<button class="btn-action btn-delete" onclick="deletePegawai(' + id + ')" title="Hapus">' +
                '<i class="fas fa-trash"></i>' +
            '</button>' +
        '</div>';
    }

    /**
     * Initializes DataTable
     */
    function initDataTable() {
        if (dataTable) {
            dataTable.destroy();
        }

        var tableData = pegawaiData.map(function(p, index) {
            return [
                index + 1,
                '<div class="pegawai-info">' +
                    '<div class="table-avatar">' + getInitials(p.nama) + '</div>' +
                    '<div class="pegawai-details">' +
                        '<span class="pegawai-name">' + p.nama + '</span>' +
                        '<span class="pegawai-email">' + p.email + '</span>' +
                    '</div>' +
                '</div>',
                p.nip,
                p.jabatan,
                p.departemen,
                getStatusBadge(p.status),
                renderActionButton(p.id)
            ];
        });

        dataTable = $('#pegawaiTable').DataTable({
            data: tableData,
            columns: [
                { title: 'No', className: 'text-center' },
                { title: 'Pegawai' },
                { title: 'NIP' },
                { title: 'Jabatan' },
                { title: 'Departemen' },
                { title: 'Status', className: 'text-center' },
                { title: 'Aksi', className: 'text-center', orderable: false, searchable: false }
            ],
            responsive: true,
            language: {
                search: '<i class="fas fa-search"></i>',
                searchPlaceholder: 'Cari pegawai...',
                lengthMenu: 'Tampilkan _MENU_ data',
                info: 'Menampilkan _START_ - _END_ dari _TOTAL_ pegawai',
                infoEmpty: 'Tidak ada data pegawai',
                infoFiltered: '(difilter dari _MAX_ total data)',
                paginate: {
                    first: '<i class="fas fa-angle-double-left"></i>',
                    previous: '<i class="fas fa-angle-left"></i>',
                    next: '<i class="fas fa-angle-right"></i>',
                    last: '<i class="fas fa-angle-double-right"></i>'
                },
                zeroRecords: 'Tidak ada data yang cocok'
            },
            order: [[0, 'asc']],
            pageLength: 10,
            lengthMenu: [[10, 25, 50, -1], [10, 25, 50, 'Semua']]
        });
    }

    /**
     * Refreshes DataTable with updated data
     */
    function refreshDataTable() {
        initDataTable();
    }

    // =====================================================
    // CRUD FUNCTIONS
    // =====================================================

    /**
     * Opens add employee modal
     */
    $('#btnTambahPegawai').on('click', function() {
        editingId = null;
        $('#pegawaiModalLabel').text('Tambah Pegawai');
        $('#pegawaiForm')[0].reset();
        $('#pegawaiId').val('');
        new bootstrap.Modal(document.getElementById('pegawaiModal')).show();
    });

    /**
     * Opens edit employee modal
     * @param {number} id - Employee ID
     */
    window.editPegawai = function(id) {
        var pegawai = pegawaiData.find(function(p) { return p.id === id; });
        if (!pegawai) return;

        editingId = id;
        $('#pegawaiModalLabel').text('Edit Pegawai');
        $('#pegawaiId').val(id);
        $('#pegawaiNama').val(pegawai.nama);
        $('#pegawaiNIP').val(pegawai.nip);
        $('#pegawaiEmail').val(pegawai.email);
        $('#pegawaiJabatan').val(pegawai.jabatan);
        $('#pegawaiDepartemen').val(pegawai.departemen);
        $('#pegawaiStatus').val(pegawai.status);

        new bootstrap.Modal(document.getElementById('pegawaiModal')).show();
    };

    /**
     * Opens delete confirmation modal
     * @param {number} id - Employee ID
     */
    window.deletePegawai = function(id) {
        var pegawai = pegawaiData.find(function(p) { return p.id === id; });
        if (!pegawai) return;

        $('#deletePegawaiId').val(id);
        new bootstrap.Modal(document.getElementById('deleteModal')).show();
    };

    /**
     * Saves employee data (add or update)
     */
    $('#btnSavePegawai').on('click', function() {
        var nama = $('#pegawaiNama').val().trim();
        var nip = $('#pegawaiNIP').val().trim();
        var email = $('#pegawaiEmail').val().trim();
        var jabatan = $('#pegawaiJabatan').val();
        var departemen = $('#pegawaiDepartemen').val();
        var status = $('#pegawaiStatus').val();

        if (!nama || !nip || !email || !jabatan || !departemen || !status) {
            alert('Mohon lengkapi semua field!');
            return;
        }

        if (editingId) {
            var index = pegawaiData.findIndex(function(p) { return p.id === editingId; });
            if (index !== -1) {
                pegawaiData[index] = {
                    id: editingId,
                    nama: nama,
                    nip: nip,
                    email: email,
                    jabatan: jabatan,
                    departemen: departemen,
                    status: status
                };
            }
        } else {
            pegawaiData.push({
                id: nextId,
                nama: nama,
                nip: nip,
                email: email,
                jabatan: jabatan,
                departemen: departemen,
                status: status
            });
            nextId++;
        }

        bootstrap.Modal.getInstance(document.getElementById('pegawaiModal')).hide();
        refreshDataTable();
    });

    /**
     * Confirms employee deletion
     */
    $('#btnConfirmDelete').on('click', function() {
        var id = parseInt($('#deletePegawaiId').val());
        pegawaiData = pegawaiData.filter(function(p) { return p.id !== id; });
        bootstrap.Modal.getInstance(document.getElementById('deleteModal')).hide();
        refreshDataTable();
    });

    // =====================================================
    // INITIALIZATION
    // =====================================================

    $(document).ready(function() {
        // Initialize DataTable
        initDataTable();
    });

})(jQuery);
JS;

// Include Footer
include 'includes/footer.php';
?>
