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
$pageCss = 'pegawai';              // Load pegawai-specific CSS
$additionalCss = ['datatables', 'datatables-buttons'];   // Load DataTables CSS
$additionalJs = ['datatables', 'datatables-buttons'];    // Load DataTables JS
$bodyClass = 'page-pegawai';

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
            <div class="toolbar">
                <div class="toggle-group" role="group" aria-label="Filter status">
                    <button type="button" class="toggle-btn active" data-status-filter="all">
                        Semua (Aktif + Resign)
                    </button>
                    <button type="button" class="toggle-btn" data-status-filter="active">
                        Hanya Aktif
                    </button>
                </div>
                <button class="btn-action-primary" id="btnExportPegawai" type="button">
                    <i class="fas fa-file-export"></i>
                    Export Excel
                </button>
            </div>
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
                    <tr class="filter-row">
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
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
    var showOnlyActive = false;
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
     * Gets status label for filtering/sorting
     * @param {string} status - Status identifier
     * @returns {string} Status label
     */
    function getStatusLabel(status) {
        var statusLabels = {
            'aktif': 'Aktif',
            'cuti': 'Cuti',
            'remote': 'Remote',
            'nonaktif': 'Nonaktif'
        };
        return statusLabels[status] || 'Aktif';
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
     * Escapes regex special characters for column filter
     * @param {string} value
     * @returns {string}
     */
    function escapeRegex(value) {
        return value.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
    }

    /**
     * Custom filter for active-only toggle
     */
    $.fn.dataTable.ext.search.push(function(settings, data, dataIndex) {
        if (settings.nTable.id !== 'pegawaiTable') {
            return true;
        }
        if (!showOnlyActive) {
            return true;
        }
        if (!dataTable) {
            return true;
        }
        var row = dataTable.row(dataIndex).data();
        if (!row) {
            return true;
        }
        return ['aktif', 'cuti', 'remote'].indexOf(row.status) !== -1;
    });

    /**
     * Initializes DataTable
     */
    function initDataTable() {
        if (dataTable) {
            dataTable.destroy();
        }

        dataTable = $('#pegawaiTable').DataTable({
            data: pegawaiData,
            columns: [
                {
                    title: 'No',
                    className: 'text-center',
                    data: null,
                    render: function(data, type, row, meta) {
                        if (type === 'display') {
                            return meta.row + 1;
                        }
                        return row.id;
                    }
                },
                {
                    title: 'Pegawai',
                    data: null,
                    render: function(data, type, row) {
                        if (type === 'display') {
                            return '<div class="pegawai-info">' +
                                '<div class="table-avatar">' + getInitials(row.nama) + '</div>' +
                                '<div class="pegawai-details">' +
                                    '<span class="pegawai-name">' + row.nama + '</span>' +
                                    '<span class="pegawai-email">' + row.email + '</span>' +
                                '</div>' +
                            '</div>';
                        }
                        return row.nama;
                    }
                },
                { title: 'NIP', data: 'nip' },
                { title: 'Jabatan', data: 'jabatan' },
                { title: 'Departemen', data: 'departemen' },
                {
                    title: 'Status',
                    className: 'text-center',
                    data: 'status',
                    render: function(data, type) {
                        if (type === 'display') {
                            return getStatusBadge(data);
                        }
                        return getStatusLabel(data);
                    }
                },
                {
                    title: 'Aksi',
                    className: 'text-center',
                    orderable: false,
                    searchable: false,
                    data: 'id',
                    render: function(data, type) {
                        if (type === 'display') {
                            return renderActionButton(data);
                        }
                        return '';
                    }
                }
            ],
            responsive: true,
            orderCellsTop: true,
            dom: 'Bfrtip',
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
            lengthMenu: [[10, 25, 50, -1], [10, 25, 50, 'Semua']],
            buttons: [
                {
                    extend: 'excelHtml5',
                    title: 'Data Pegawai',
                    filename: 'data-pegawai',
                    exportOptions: {
                        columns: [1, 2, 3, 4, 5],
                        format: {
                            body: function(data) {
                                return $('<div>').html(data).text().trim();
                            }
                        }
                    }
                }
            ],
            initComplete: function() {
                var api = this.api();
                api.columns().every(function(index) {
                    var column = this;
                    var $cell = $('#pegawaiTable thead tr.filter-row th').eq(index);
                    var $select = $('<select class="column-filter"><option value="">Semua</option></select>');

                    if (index === 0 || index === 6) {
                        $select.prop('disabled', true);
                        $cell.empty().append($select);
                        return;
                    }

                    column.data().unique().sort().each(function(d) {
                        var text = $('<div>').html(d).text().trim();
                        if (text) {
                            $select.append('<option value="' + text + '">' + text + '</option>');
                        }
                    });

                    $select.on('change', function() {
                        var val = escapeRegex($(this).val());
                        column.search(val ? '^' + val + '$' : '', true, false).draw();
                    });

                    $cell.empty().append($select);
                });
            }
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

        // Toggle status filter
        $('.toggle-btn').on('click', function() {
            $('.toggle-btn').removeClass('active');
            $(this).addClass('active');
            showOnlyActive = $(this).data('status-filter') === 'active';
            dataTable.draw();
        });

        // Export action
        $('#btnExportPegawai').on('click', function() {
            if (dataTable) {
                dataTable.button(0).trigger();
            }
        });
    });

})(jQuery);
JS;

// Include Footer
include 'includes/footer.php';
?>
