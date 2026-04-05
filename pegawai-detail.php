<?php
/**
 * Detail Pegawai Page (pegawai-detail.php)
 * Employee detail page with modern layout
 * 
 * Layout: Uses partial files from includes/
 */

// Page Configuration
$pageTitle = 'SISPEG - Detail Pegawai';
$activeMenu = 'pegawai';
$searchPlaceholder = 'Cari pegawai...';
$pageCss = 'detail';  // Load detail-specific CSS
$additionalCss = [];          // No additional external CSS
$additionalJs = [];
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
            <h1>Detail Pegawai</h1>
            <p>Lihat informasi lengkap pegawai</p>
        </div>
    </div>

    <div id="detailContent">
        <!-- Profile Header Card -->
        <div class="content-card detail-card profile-header-card">
            <div class="detail-card-header">
                <div class="detail-identity">
                    <div class="detail-avatar" id="detailAvatar">AR</div>
                    <div class="detail-info">
                        <h1 id="detailNamaHeader">-</h1>
                        <p id="detailJabatanHeader">-</p>
                        <div class="detail-meta">
                            <span class="meta-item"><i class="fas fa-building"></i> <span id="detailDepartemen">-</span></span>
                            <span class="meta-item"><i class="fas fa-map-marker-alt"></i> <span id="detailLocation">-</span></span>
                            <span class="meta-item" id="detailStatusBadge"></span>
                        </div>
                    </div>
                </div>
                <div class="detail-actions">
                    <a class="btn btn-outline-secondary btn-sm" href="pegawai.php">
                        <i class="fas fa-arrow-left me-1"></i>Kembali
                    </a>
                    <button class="btn btn-primary btn-sm">
                        <i class="fas fa-edit me-1"></i>Edit
                    </button>
                </div>
            </div>
        </div>

        <!-- Tabbed Content Cards -->
        <div class="detail-tabs-container">
            <!-- Tab Navigation -->
            <ul class="detail-tab-nav" role="tablist">
                <li class="detail-tab-item active" role="tab" data-tab="info">
                    <i class="fas fa-id-card"></i>
                    <span>Informasi</span>
                </li>
                <li class="detail-tab-item" role="tab" data-tab="mutasi">
                    <i class="fas fa-exchange-alt"></i>
                    <span>Mutasi</span>
                </li>
                <li class="detail-tab-item" role="tab" data-tab="pelatihan">
                    <i class="fas fa-graduation-cap"></i>
                    <span>Pelatihan</span>
                </li>
                <li class="detail-tab-item" role="tab" data-tab="keluarga">
                    <i class="fas fa-users"></i>
                    <span>Keluarga</span>
                </li>
                <li class="detail-tab-item" role="tab" data-tab="pendidikan">
                    <i class="fas fa-book"></i>
                    <span>Pendidikan</span>
                </li>
            </ul>

            <!-- Tab: Informasi -->
            <div class="detail-tab-pane active" id="tab-info">
                <div class="content-card detail-card">
                    <div class="detail-card-body">
                        <div class="detail-section">
                            <h6><i class="fas fa-user me-2"></i>Profil</h6>
                            <div class="detail-list">
                                <div class="detail-item" data-field="nama">
                                    <span class="detail-item-label">Nama Lengkap</span>
                                    <span class="detail-item-value" id="detailNama">-</span>
                                </div>
                                <div class="detail-item" data-field="nip">
                                    <span class="detail-item-label">NIP</span>
                                    <span class="detail-item-value" id="detailNip">-</span>
                                </div>
                                <div class="detail-item" data-field="birthDate">
                                    <span class="detail-item-label">Tanggal Lahir</span>
                                    <span class="detail-item-value" id="detailBirthDate">-</span>
                                </div>
                                <div class="detail-item" data-field="gender">
                                    <span class="detail-item-label">Jenis Kelamin</span>
                                    <span class="detail-item-value" id="detailGender">-</span>
                                </div>
                            </div>
                        </div>
                        <div class="detail-section">
                            <h6><i class="fas fa-envelope me-2"></i>Kontak</h6>
                            <div class="detail-list">
                                <div class="detail-item" data-field="email">
                                    <span class="detail-item-label">Email</span>
                                    <span class="detail-item-value" id="detailEmail">-</span>
                                </div>
                                <div class="detail-item" data-field="phone">
                                    <span class="detail-item-label">Telepon</span>
                                    <span class="detail-item-value" id="detailPhone">-</span>
                                </div>
                                <div class="detail-item" data-field="address">
                                    <span class="detail-item-label">Alamat</span>
                                    <span class="detail-item-value" id="detailAddress">-</span>
                                </div>
                                <div class="detail-item" data-field="emergencyContact">
                                    <span class="detail-item-label">Kontak Darurat</span>
                                    <span class="detail-item-value" id="detailEmergency">-</span>
                                </div>
                            </div>
                        </div>
                        <div class="detail-section">
                            <h6><i class="fas fa-briefcase me-2"></i>Kepegawaian</h6>
                            <div class="detail-list">
                                <div class="detail-item" data-field="jabatan">
                                    <span class="detail-item-label">Jabatan</span>
                                    <span class="detail-item-value" id="detailJabatan">-</span>
                                </div>
                                <div class="detail-item" data-field="departemen">
                                    <span class="detail-item-label">Departemen</span>
                                    <span class="detail-item-value" id="detailDepartemen">-</span>
                                </div>
                                <div class="detail-item" data-field="hireDate">
                                    <span class="detail-item-label">Tanggal Masuk</span>
                                    <span class="detail-item-value" id="detailHireDate">-</span>
                                </div>
                                <div class="detail-item" data-field="location">
                                    <span class="detail-item-label">Lokasi Kerja</span>
                                    <span class="detail-item-value" id="detailLocation">-</span>
                                </div>
                                <div class="detail-item" data-field="manager">
                                    <span class="detail-item-label">Manager</span>
                                    <span class="detail-item-value" id="detailManager">-</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tab: Mutasi -->
            <div class="detail-tab-pane" id="tab-mutasi">
                <div class="content-card detail-card">
                    <div class="detail-card-body">
                        <div class="detail-section">
                            <h6><i class="fas fa-exchange-alt me-2"></i>Riwayat Mutasi</h6>
                            <div class="table-responsive">
                                <table class="table-custom">
                                    <thead>
                                        <tr>
                                            <th>Tanggal</th>
                                            <th>Dari</th>
                                            <th>Ke</th>
                                            <th>Jenis</th>
                                            <th>SK</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>15 Jan 2024</td>
                                            <td>Staff IT</td>
                                            <td>Manager IT</td>
                                            <td><span class="status-badge active">Promosi</span></td>
                                            <td>SK/001/2024</td>
                                        </tr>
                                        <tr>
                                            <td>01 Mar 2022</td>
                                            <td>Hub Bandung</td>
                                            <td>HQ Jakarta</td>
                                            <td><span class="status-badge remote">Mutasi</span></td>
                                            <td>SK/045/2022</td>
                                        </tr>
                                        <tr>
                                            <td>10 Jun 2020</td>
                                            <td>Junior Staff</td>
                                            <td>Staff IT</td>
                                            <td><span class="status-badge active">Promosi</span></td>
                                            <td>SK/012/2020</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tab: Pelatihan -->
            <div class="detail-tab-pane" id="tab-pelatihan">
                <div class="content-card detail-card">
                    <div class="detail-card-body">
                        <div class="detail-section">
                            <h6><i class="fas fa-graduation-cap me-2"></i>Pelatihan & Sertifikasi</h6>
                            <div class="training-list">
                                <div class="training-item">
                                    <div class="training-icon"><i class="fas fa-certificate"></i></div>
                                    <div class="training-content">
                                        <span class="training-name">AWS Certified Solutions Architect</span>
                                        <span class="training-meta">AWS • 2024 • Berlaku s/d 2027</span>
                                    </div>
                                    <span class="status-badge active">Aktif</span>
                                </div>
                                <div class="training-item">
                                    <div class="training-icon"><i class="fas fa-chalkboard-teacher"></i></div>
                                    <div class="training-content">
                                        <span class="training-name">Leadership & Management Training</span>
                                        <span class="training-meta">Internal • 2023 • 40 Jam</span>
                                    </div>
                                    <span class="status-badge on-leave">Selesai</span>
                                </div>
                                <div class="training-item">
                                    <div class="training-icon"><i class="fas fa-laptop-code"></i></div>
                                    <div class="training-content">
                                        <span class="training-name">Advanced Python Programming</span>
                                        <span class="training-meta">Dicoding • 2023 • 30 Jam</span>
                                    </div>
                                    <span class="status-badge on-leave">Selesai</span>
                                </div>
                                <div class="training-item">
                                    <div class="training-icon"><i class="fas fa-shield-alt"></i></div>
                                    <div class="training-content">
                                        <span class="training-name">Cybersecurity Awareness</span>
                                        <span class="training-meta">Internal • 2022 • 16 Jam</span>
                                    </div>
                                    <span class="status-badge on-leave">Selesai</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tab: Keluarga -->
            <div class="detail-tab-pane" id="tab-keluarga">
                <div class="content-card detail-card">
                    <div class="detail-card-body">
                        <div class="detail-section">
                            <h6><i class="fas fa-users me-2"></i>Data Keluarga</h6>
                            <div class="family-list">
                                <div class="family-item">
                                    <div class="family-avatar">SR</div>
                                    <div class="family-content">
                                        <span class="family-name">Siti Rizki</span>
                                        <span class="family-meta">Istri • 1992 • Karyawan Swasta</span>
                                    </div>
                                </div>
                                <div class="family-item">
                                    <div class="family-avatar">FA</div>
                                    <div class="family-content">
                                        <span class="family-name">Farhan Arya</span>
                                        <span class="family-meta">Anak • 2015 • Pelajar</span>
                                    </div>
                                </div>
                                <div class="family-item">
                                    <div class="family-avatar">NA</div>
                                    <div class="family-content">
                                        <span class="family-name">Nabila Aisyah</span>
                                        <span class="family-meta">Anak • 2018 • Pelajar</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tab: Pendidikan -->
            <div class="detail-tab-pane" id="tab-pendidikan">
                <div class="content-card detail-card">
                    <div class="detail-card-body">
                        <div class="detail-section">
                            <h6><i class="fas fa-book me-2"></i>Riwayat Pendidikan</h6>
                            <div class="education-timeline">
                                <div class="timeline-item">
                                    <div class="timeline-dot success"></div>
                                    <div class="timeline-content">
                                        <p class="timeline-title">S2 — Teknik Informatika</p>
                                        <p class="timeline-desc">Institut Teknologi Bandung • 2014 - 2016</p>
                                        <span class="timeline-time">IPK: 3.85</span>
                                    </div>
                                </div>
                                <div class="timeline-item">
                                    <div class="timeline-dot primary"></div>
                                    <div class="timeline-content">
                                        <p class="timeline-title">S1 — Sistem Informasi</p>
                                        <p class="timeline-desc">Universitas Indonesia • 2008 - 2012</p>
                                        <span class="timeline-time">IPK: 3.72</span>
                                    </div>
                                </div>
                                <div class="timeline-item">
                                    <div class="timeline-dot info"></div>
                                    <div class="timeline-content">
                                        <p class="timeline-title">SMA — IPA</p>
                                        <p class="timeline-desc">SMAN 3 Jakarta • 2005 - 2008</p>
                                        <span class="timeline-time">Lulus: 2008</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="emptyState" class="content-card" style="display: none;">
        <div class="empty-state">
            <i class="fas fa-exclamation-circle"></i>
            <h3>Data pegawai tidak ditemukan</h3>
            <p>Periksa kembali ID pegawai atau kembali ke daftar.</p>
            <a class="btn btn-outline-primary mt-3" href="pegawai.php">
                <i class="fas fa-arrow-left me-2"></i>Kembali ke daftar
            </a>
        </div>
    </div>
</main>

<?php include 'includes/footer-content.php'; ?>

<?php
// Page-specific JavaScript (Detail Pegawai)
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

    function getInitials(name) {
        return name.split(' ').map(function(n) { return n[0]; }).join('').toUpperCase().substring(0, 2);
    }

    function setValue(selector, value, fallback) {
        var text = value && value !== '' ? value : (fallback || '-');
        $(selector).text(text);
    }

    function toggleField(field, value) {
        var $row = $('[data-field="' + field + '"]');
        if (!value) {
            $row.hide();
        } else {
            $row.show();
        }
    }

    function renderDetail(pegawai) {
        $('#detailAvatar').text(getInitials(pegawai.nama));
        $('#detailNamaHeader').text(pegawai.nama);
        $('#detailJabatanHeader').text(pegawai.jabatan + ' — ' + pegawai.departemen);
        $('#detailDepartemen').text(pegawai.departemen);
        $('#detailLocation').text(pegawai.location || '-');
        $('#detailStatusBadge').html(getStatusBadge(pegawai.status));

        setValue('#detailNama', pegawai.nama);
        setValue('#detailNip', pegawai.nip);
        setValue('#detailBirthDate', pegawai.birthDate);
        setValue('#detailGender', pegawai.gender);

        setValue('#detailEmail', pegawai.email);
        setValue('#detailPhone', pegawai.phone);
        setValue('#detailAddress', pegawai.address);
        setValue('#detailEmergency', pegawai.emergencyContact);

        setValue('#detailJabatan', pegawai.jabatan);
        setValue('#detailDepartemen', pegawai.departemen);
        setValue('#detailHireDate', pegawai.hireDate);
        setValue('#detailLocation', pegawai.location);
        setValue('#detailManager', pegawai.manager);

        toggleField('birthDate', pegawai.birthDate);
        toggleField('gender', pegawai.gender);
        toggleField('phone', pegawai.phone);
        toggleField('address', pegawai.address);
        toggleField('emergencyContact', pegawai.emergencyContact);
        toggleField('hireDate', pegawai.hireDate);
        toggleField('location', pegawai.location);
        toggleField('manager', pegawai.manager);
    }

    function initDetailPage() {
        var params = new URLSearchParams(window.location.search);
        var id = parseInt(params.get('id'), 10);

        if (!id) {
            $('#detailContent').hide();
            $('#emptyState').show();
            return;
        }

        var pegawai = pegawaiData.find(function(p) { return p.id === id; });

        if (!pegawai) {
            $('#detailContent').hide();
            $('#emptyState').show();
            return;
        }

        renderDetail(pegawai);
    }

    // Tab switching
    $('.detail-tab-item').on('click', function() {
        var tabId = $(this).data('tab');
        $('.detail-tab-item').removeClass('active');
        $(this).addClass('active');
        $('.detail-tab-pane').removeClass('active');
        $('#tab-' + tabId).addClass('active');
    });

    $(document).ready(function() {
        initDetailPage();
    });
})(jQuery);
JS;

// Include Footer
include 'includes/footer.php';
?>
