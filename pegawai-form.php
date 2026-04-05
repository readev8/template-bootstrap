<?php
/**
 * Pegawai Form Page (pegawai-form.php)
 * Add/Edit employee data with tabbed form layout
 * 
 * Layout: Uses partial files from includes/
 */

// Page Configuration
$pageTitle = 'SISPEG - Input Pegawai';
$activeMenu = 'pegawai';
$searchPlaceholder = 'Cari pegawai...';
$pageCss = 'detail';
$additionalCss = ['datepicker'];
$additionalJs = ['datepicker'];
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
            <h1 id="formTitle">Input Pegawai</h1>
            <p id="formSubtitle">Tambah data pegawai baru</p>
        </div>
        <div class="page-header-right">
            <a class="btn btn-outline-secondary" href="pegawai.php">
                <i class="fas fa-arrow-left me-2"></i>Kembali
            </a>
        </div>
    </div>

    <form id="pegawaiForm" class="pegawai-form" novalidate>
        <input type="hidden" id="pegawaiId" name="id">

        <!-- Tab Navigation -->
        <ul class="detail-tab-nav" role="tablist">
            <li class="detail-tab-item active" role="tab" data-tab="info">
                <i class="fas fa-user"></i>
                <span>Informasi</span>
            </li>
            <li class="detail-tab-item" role="tab" data-tab="employment">
                <i class="fas fa-briefcase"></i>
                <span>Kepegawaian</span>
            </li>
        </ul>

        <!-- Tab: Informasi -->
        <div class="detail-tab-pane active" id="tab-info">
            <div class="content-card detail-card header-bg-primary">
                <div class="content-card-header">
                    <h5><i class="fas fa-user me-2"></i>Informasi Pegawai</h5>
                </div>
                <div class="detail-card-body">
                    <div class="form-section">
                        <h6><i class="fas fa-user me-2"></i>Profil</h6>
                        <div class="form-grid">
                            <div class="form-group">
                                <label for="inputNama">Nama Lengkap <span class="required">*</span></label>
                                <input type="text" id="inputNama" name="nama" placeholder="Masukkan nama lengkap" required>
                            </div>
                            <div class="form-group">
                                <label for="inputNIP">NIP <span class="required">*</span></label>
                                <input type="text" id="inputNIP" name="nip" placeholder="Masukkan NIP" required>
                            </div>
                            <div class="form-group">
                                <label for="inputBirthDate">Tanggal Lahir</label>
                                <input type="text" id="inputBirthDate" name="birthDate" class="datepicker-input" placeholder="Pilih tanggal">
                            </div>
                            <div class="form-group">
                                <label for="inputGender">Jenis Kelamin</label>
                                <select id="inputGender" name="gender">
                                    <option value="">Pilih</option>
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-section">
                        <h6><i class="fas fa-envelope me-2"></i>Kontak</h6>
                        <div class="form-grid">
                            <div class="form-group">
                                <label for="inputEmail">Email <span class="required">*</span></label>
                                <input type="email" id="inputEmail" name="email" placeholder="Masukkan email" required>
                            </div>
                            <div class="form-group">
                                <label for="inputPhone">Telepon</label>
                                <input type="tel" id="inputPhone" name="phone" placeholder="Masukkan nomor telepon">
                            </div>
                            <div class="form-group full-width">
                                <label for="inputAddress">Alamat</label>
                                <textarea id="inputAddress" name="address" rows="2" placeholder="Masukkan alamat lengkap"></textarea>
                            </div>
                            <div class="form-group full-width">
                                <label for="inputEmergency">Kontak Darurat</label>
                                <input type="text" id="inputEmergency" name="emergencyContact" placeholder="Nama - No. Telepon">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tab: Kepegawaian -->
        <div class="detail-tab-pane" id="tab-employment">
            <div class="content-card detail-card header-bg-amber">
                <div class="content-card-header">
                    <h5><i class="fas fa-briefcase me-2"></i>Data Kepegawaian</h5>
                </div>
                <div class="detail-card-body">
                    <div class="form-section">
                        <h6><i class="fas fa-briefcase me-2"></i>Data Kepegawaian</h6>
                        <div class="form-grid">
                            <div class="form-group">
                                <label for="inputJabatan">Jabatan <span class="required">*</span></label>
                                <select id="inputJabatan" name="jabatan" required>
                                    <option value="">Pilih Jabatan</option>
                                    <option value="Staff">Staff</option>
                                    <option value="Senior Staff">Senior Staff</option>
                                    <option value="Supervisor">Supervisor</option>
                                    <option value="Manager">Manager</option>
                                    <option value="Senior Manager">Senior Manager</option>
                                    <option value="Director">Director</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="inputDepartemen">Departemen <span class="required">*</span></label>
                                <select id="inputDepartemen" name="departemen" required>
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
                            <div class="form-group">
                                <label for="inputHireDate">Tanggal Masuk</label>
                                <input type="text" id="inputHireDate" name="hireDate" class="datepicker-input" placeholder="Pilih tanggal">
                            </div>
                            <div class="form-group">
                                <label for="inputLocation">Lokasi Kerja</label>
                                <input type="text" id="inputLocation" name="location" placeholder="Masukkan lokasi kerja">
                            </div>
                            <div class="form-group">
                                <label for="inputManager">Manager</label>
                                <input type="text" id="inputManager" name="manager" placeholder="Nama manager">
                            </div>
                            <div class="form-group">
                                <label for="inputStatus">Status <span class="required">*</span></label>
                                <select id="inputStatus" name="status" required>
                                    <option value="">Pilih Status</option>
                                    <option value="aktif">Aktif</option>
                                    <option value="cuti">Cuti</option>
                                    <option value="remote">Remote</option>
                                    <option value="nonaktif">Nonaktif</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Actions -->
        <div class="form-actions">
            <a href="pegawai.php" class="btn btn-outline-secondary">
                <i class="fas fa-times me-1"></i>Batal
            </a>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save me-1"></i>Simpan
            </button>
        </div>
    </form>
</main>

<?php include 'includes/footer-content.php'; ?>

<?php
// Page-specific JavaScript
$pageJs = <<<'JS'
(function($) {
    'use strict';

    var pegawaiData = [
        { id: 1, nama: 'Ahmad Rizki', nip: 'NIP001', email: 'ahmad.rizki@company.com', jabatan: 'Manager', departemen: 'IT', status: 'aktif', phone: '+62 812 1111 2222', address: 'Jakarta Selatan', hireDate: '2018-02-15', birthDate: '1990-05-20', gender: 'Laki-laki', manager: 'Dewi Anggraini', location: 'HQ Jakarta', emergencyContact: 'Siti Rizki - +62 812 9999 8888' },
        { id: 2, nama: 'Siti Nurhaliza', nip: 'NIP002', email: 'siti.nur@company.com', jabatan: 'Senior Staff', departemen: 'HR', status: 'aktif', phone: '+62 811 2233 4455', address: 'Bandung', hireDate: '2019-08-01', birthDate: '1992-11-10', gender: 'Perempuan', manager: 'Indah Permata', location: 'Hub Bandung', emergencyContact: 'Nur Aisyah - +62 813 3333 4444' },
        { id: 3, nama: 'Budi Santoso', nip: 'NIP003', email: 'budi.santoso@company.com', jabatan: 'Supervisor', departemen: 'Finance', status: 'cuti', phone: '+62 813 4444 5566', address: 'Surabaya', hireDate: '2017-04-20', manager: 'Joko Widodo', location: 'Finance Center', emergencyContact: 'Rina Santoso - +62 812 7000 1111' },
        { id: 4, nama: 'Dewi Anggraini', nip: 'NIP004', email: 'dewi.anggraini@company.com', jabatan: 'Staff', departemen: 'Marketing', status: 'aktif', phone: '+62 815 5555 6666', address: 'Yogyakarta', hireDate: '2020-10-05', birthDate: '1995-03-02', gender: 'Perempuan', manager: 'Gunawan Setiawan', location: 'Marketing Hub' },
        { id: 5, nama: 'Eko Prasetyo', nip: 'NIP005', email: 'eko.prasetyo@company.com', jabatan: 'Senior Manager', departemen: 'Operations', status: 'remote', phone: '+62 811 7777 8888', address: 'Bali', hireDate: '2016-01-12', gender: 'Laki-laki', manager: 'Gunawan Setiawan', location: 'Remote' },
        { id: 6, nama: 'Fitri Wulandari', nip: 'NIP006', email: 'fitri.wulan@company.com', jabatan: 'Staff', departemen: 'IT', status: 'aktif', phone: '+62 812 2233 7788', hireDate: '2021-06-17', gender: 'Perempuan', manager: 'Ahmad Rizki', location: 'HQ Jakarta' },
        { id: 7, nama: 'Gunawan Setiawan', nip: 'NIP007', email: 'gunawan.setia@company.com', jabatan: 'Director', departemen: 'Sales', status: 'aktif', phone: '+62 811 9090 1122', address: 'Jakarta Pusat', hireDate: '2013-09-03', birthDate: '1984-01-15', gender: 'Laki-laki', location: 'HQ Jakarta' },
        { id: 8, nama: 'Hendra Wijaya', nip: 'NIP008', email: 'hendra.wijaya@company.com', jabatan: 'Supervisor', departemen: 'Legal', status: 'nonaktif', phone: '+62 813 2222 9999', address: 'Semarang', hireDate: '2015-07-23', manager: 'Gunawan Setiawan', location: 'Legal Office' },
        { id: 9, nama: 'Indah Permata', nip: 'NIP009', email: 'indah.permata@company.com', jabatan: 'Manager', departemen: 'HR', status: 'aktif', phone: '+62 812 1000 5566', address: 'Jakarta Barat', hireDate: '2014-05-11', birthDate: '1989-12-02', gender: 'Perempuan', manager: 'Gunawan Setiawan', location: 'HQ Jakarta' },
        { id: 10, nama: 'Joko Widodo', nip: 'NIP010', email: 'joko.widodo@company.com', jabatan: 'Senior Staff', departemen: 'Finance', status: 'cuti', phone: '+62 813 1010 2233', hireDate: '2022-03-21', manager: 'Budi Santoso', location: 'Finance Center' },
        { id: 11, nama: 'Kartika Sari', nip: 'NIP011', email: 'kartika.sari@company.com', jabatan: 'Staff', departemen: 'Marketing', status: 'aktif', phone: '+62 815 3000 1111', hireDate: '2021-09-14', location: 'Marketing Hub' },
        { id: 12, nama: 'Lukman Hakim', nip: 'NIP012', email: 'lukman.hakim@company.com', jabatan: 'Manager', departemen: 'Operations', status: 'remote', phone: '+62 811 6060 7070', hireDate: '2016-11-30', manager: 'Eko Prasetyo', location: 'Remote' },
        { id: 13, nama: 'Maya Putri', nip: 'NIP013', email: 'maya.putri@company.com', jabatan: 'Senior Staff', departemen: 'IT', status: 'aktif', phone: '+62 812 4000 9000', hireDate: '2019-02-08', gender: 'Perempuan', manager: 'Ahmad Rizki', location: 'HQ Jakarta' },
        { id: 14, nama: 'Nugroho Adi', nip: 'NIP014', email: 'nugroho.adi@company.com', jabatan: 'Supervisor', departemen: 'Sales', status: 'aktif', phone: '+62 812 8888 0000', hireDate: '2018-12-19', manager: 'Gunawan Setiawan', location: 'Sales Office' },
        { id: 15, nama: 'Oktaviani Rina', nip: 'NIP015', email: 'oktaviani.rina@company.com', jabatan: 'Staff', departemen: 'Legal', status: 'cuti', phone: '+62 811 4321 8765', hireDate: '2020-04-27', manager: 'Hendra Wijaya', location: 'Legal Office' }
    ];

    /**
     * Sets form values from employee data
     */
    function populateForm(pegawai) {
        $('#pegawaiId').val(pegawai.id);
        $('#inputNama').val(pegawai.nama);
        $('#inputNIP').val(pegawai.nip);
        $('#inputBirthDate').val(pegawai.birthDate || '');
        $('#inputGender').val(pegawai.gender || '');
        $('#inputEmail').val(pegawai.email);
        $('#inputPhone').val(pegawai.phone || '');
        $('#inputAddress').val(pegawai.address || '');
        $('#inputEmergency').val(pegawai.emergencyContact || '');
        $('#inputJabatan').val(pegawai.jabatan);
        $('#inputDepartemen').val(pegawai.departemen);
        $('#inputHireDate').val(pegawai.hireDate || '');
        $('#inputLocation').val(pegawai.location || '');
        $('#inputManager').val(pegawai.manager || '');
        $('#inputStatus').val(pegawai.status);
    }

    /**
     * Initializes form mode (add or edit)
     */
    function initFormMode() {
        var params = new URLSearchParams(window.location.search);
        var id = parseInt(params.get('id'), 10);

        if (id) {
            var pegawai = pegawaiData.find(function(p) { return p.id === id; });
            if (pegawai) {
                $('#formTitle').text('Edit Pegawai');
                $('#formSubtitle').text('Ubah data pegawai: ' + pegawai.nama);
                populateForm(pegawai);
                return;
            }
        }

        $('#formTitle').text('Input Pegawai');
        $('#formSubtitle').text('Tambah data pegawai baru');
    }

    // Tab switching
    $('.detail-tab-item').on('click', function() {
        var tabId = $(this).data('tab');
        $('.detail-tab-item').removeClass('active');
        $(this).addClass('active');
        $('.detail-tab-pane').removeClass('active');
        $('#tab-' + tabId).addClass('active');
    });

    // Form submit
    $('#pegawaiForm').on('submit', function(e) {
        e.preventDefault();

        if (!this.checkValidity()) {
            this.reportValidity();
            return;
        }

        var formData = new FormData(this);
        var data = {};
        formData.forEach(function(value, key) { data[key] = value; });

        console.log('Form data:', data);
        alert('Data berhasil disimpan!');
        window.location.href = 'pegawai.php';
    });

    $(document).ready(function() {
        // Initialize Flatpickr
        if (typeof flatpickr === 'function') {
            flatpickr('.datepicker-input', {
                dateFormat: 'Y-m-d',
                allowInput: true,
                locale: {
                    firstDayOfWeek: 1
                }
            });
        }

        initFormMode();
    });
})(jQuery);
JS;

// Include Footer
include 'includes/footer.php';
?>
