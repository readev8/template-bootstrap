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
$pageCss = 'list';              // Load list-specific CSS
$additionalCss = ['datatables', 'datatables-buttons', 'slimselect'];   // Load DataTables CSS
$additionalJs = ['datatables', 'datatables-buttons', 'slimselect'];    // Load DataTables JS
$bodyClass = 'page-list';

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
            <button class="btn-add-record" id="btnAddRecord">
                <i class="fas fa-plus"></i>
                <span>Tambah Pegawai</span>
            </button>
        </div>
    </div>

    <!-- Data Pegawai Card -->
    <div class="content-card header-bg-amber">
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
                <button class="btn-action-primary" id="btnExport" type="button">
                    <i class="fas fa-file-export"></i>
                    Export Excel
                </button>
            </div>
        </div>
        <div class="table-responsive">
            <table id="dataTable" class="data-table table table-hover">
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
                        <th><select class="column-multiselect" data-column="1" multiple><option></option></select></th>
                        <th><select class="column-multiselect" data-column="2" multiple><option></option></select></th>
                        <th><select class="column-multiselect" data-column="3" multiple><option></option></select></th>
                        <th><select class="column-multiselect" data-column="4" multiple><option></option></select></th>
                        <th><select class="column-multiselect" data-column="5" multiple><option></option></select></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="dataTableBody">
                    <!-- Data will be loaded via JavaScript -->
                </tbody>
            </table>
        </div>
    </div>
</main>

<!-- Modal Tambah/Edit Record -->
<div class="modal fade" id="recordModal" tabindex="-1" aria-labelledby="recordModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="recordModalLabel">Tambah Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="recordForm">
                    <input type="hidden" id="recordId">
                    <div class="mb-3">
                        <label for="recordNama" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" id="recordNama" placeholder="Masukkan nama lengkap" required>
                    </div>
                    <div class="mb-3">
                        <label for="recordNIP" class="form-label">NIP</label>
                        <input type="text" class="form-control" id="recordNIP" placeholder="Masukkan NIP" required>
                    </div>
                    <div class="mb-3">
                        <label for="recordEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="recordEmail" placeholder="Masukkan email" required>
                    </div>
                    <div class="mb-3">
                        <label for="recordJabatan" class="form-label">Jabatan</label>
                        <select class="form-select" id="recordJabatan" required>
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
                        <label for="recordDepartemen" class="form-label">Departemen</label>
                        <select class="form-select" id="recordDepartemen" required>
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
                        <label for="recordStatus" class="form-label">Status</label>
                        <select class="form-select" id="recordStatus" required>
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
                <button type="button" class="btn-modal-save" id="btnSaveRecord">Simpan</button>
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
                <p class="mb-0">Apakah Anda yakin ingin menghapus data ini?</p>
                <input type="hidden" id="deleteRecordId">
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn-modal-cancel" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn-modal-delete" id="btnConfirmDelete">Hapus</button>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer-content.php'; ?>

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
    var recordData = [
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
            'aktif': { class: 'active', icon: 'fa-check-circle', label: 'Aktif' },
            'cuti': { class: 'on-leave', icon: 'fa-calendar-alt', label: 'Cuti' },
            'remote': { class: 'remote', icon: 'fa-home', label: 'Remote' },
            'nonaktif': { class: 'inactive', icon: 'fa-times-circle', label: 'Nonaktif' }
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
            '<button class="btn-action btn-edit" onclick="editRecord(' + id + ')" title="Edit">' +
                '<i class="fas fa-edit"></i>' +
            '</button>' +
            '<button class="btn-action btn-delete" onclick="deleteRecord(' + id + ')" title="Hapus">' +
                '<i class="fas fa-trash"></i>' +
            '</button>' +
        '</div>';
    }

    // =====================================================
    // FILTER STATE
    // =====================================================
    
    var activeFilters = {};

    /**
     * Custom filter for active-only toggle + multi-select column filters
     */
    $.fn.dataTable.ext.search.push(function(settings, data, dataIndex) {
        if (!$(settings.nTable).hasClass('data-table')) {
            return true;
        }
        if (showOnlyActive) {
            var row = dataTable.row(dataIndex).data();
            if (row && ['aktif', 'cuti', 'remote'].indexOf(row.status) === -1) {
                return false;
            }
        }
        for (var col in activeFilters) {
            if (activeFilters[col].length === 0) continue;
            var cellText = $('<div>').html(data[col]).text().trim();
            if (activeFilters[col].indexOf(cellText) === -1) {
                return false;
            }
        }
        return true;
    });

    /**
     * Initializes DataTable
     */
    function initDataTable() {
        if (dataTable) {
            dataTable.destroy();
        }

        dataTable = $('#dataTable').DataTable({
            data: recordData,
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
                            return '<div class="record-info">' +
                                '<div class="table-avatar">' + getInitials(row.nama) + '</div>' +
                                '<div class="record-details">' +
                                    '<span class="record-name">' + row.nama + '</span>' +
                                    '<span class="record-email">' + row.email + '</span>' +
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
                    var $cell = $('#dataTable thead tr.filter-row th').eq(index);

                    if (index === 0 || index === 6) {
                        $cell.empty();
                        return;
                    }

                    var $select = $cell.find('select.column-multiselect');
                    if (!$select.length) return;

                    column.data().unique().sort().each(function(d) {
                        var text = $('<div>').html(d).text().trim();
                        if (text) {
                            $select.append('<option value="' + text + '">' + text + '</option>');
                        }
                    });

                    activeFilters[index] = [];

                    var colIndex = index;

                    new SlimSelect({
                        select: $select[0],
                        settings: {
                            showSearch: true,
                            searchPlaceholder: 'Cari...',
                            allowDeselect: true,
                            closeOnSelect: false
                        },
                        events: {
                            afterChange: function(newVal) {
                                activeFilters[colIndex] = newVal.map(function(v) { return v.value; });
                                dataTable.draw();
                            }
                        }
                    });
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
    $('#btnAddRecord').on('click', function() {
        editingId = null;
        $('#recordModalLabel').text('Tambah Data');
        $('#recordForm')[0].reset();
        $('#recordId').val('');
        new bootstrap.Modal(document.getElementById('recordModal')).show();
    });

    /**
     * Opens edit employee modal
     * @param {number} id - Employee ID
     */
    window.editRecord = function(id) {
        var record = recordData.find(function(p) { return p.id === id; });
        if (!record) return;

        editingId = id;
        $('#recordModalLabel').text('Edit Data');
        $('#recordId').val(id);
        $('#recordNama').val(record.nama);
        $('#recordNIP').val(record.nip);
        $('#recordEmail').val(record.email);
        $('#recordJabatan').val(record.jabatan);
        $('#recordDepartemen').val(record.departemen);
        $('#recordStatus').val(record.status);

        new bootstrap.Modal(document.getElementById('recordModal')).show();
    };

    /**
     * Opens delete confirmation modal
     * @param {number} id - Employee ID
     */
    window.deleteRecord = function(id) {
        var record = recordData.find(function(p) { return p.id === id; });
        if (!record) return;

        $('#deleteRecordId').val(id);
        new bootstrap.Modal(document.getElementById('deleteModal')).show();
    };

    /**
     * Saves employee data (add or update)
     */
    $('#btnSaveRecord').on('click', function() {
        var nama = $('#recordNama').val().trim();
        var nip = $('#recordNIP').val().trim();
        var email = $('#recordEmail').val().trim();
        var jabatan = $('#recordJabatan').val();
        var departemen = $('#recordDepartemen').val();
        var status = $('#recordStatus').val();

        if (!nama || !nip || !email || !jabatan || !departemen || !status) {
            alert('Mohon lengkapi semua field!');
            return;
        }

        if (editingId) {
            var index = recordData.findIndex(function(p) { return p.id === editingId; });
            if (index !== -1) {
                recordData[index] = {
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
            recordData.push({
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

        bootstrap.Modal.getInstance(document.getElementById('recordModal')).hide();
        refreshDataTable();
    });

    /**
     * Confirms employee deletion
     */
    $('#btnConfirmDelete').on('click', function() {
        var id = parseInt($('#deleteRecordId').val());
        recordData = recordData.filter(function(p) { return p.id !== id; });
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
        $('#btnExport').on('click', function() {
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
