<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>myHR - Login</title>

    <!-- Bootstrap 4 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <!-- FontAwesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- SweetAlert2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        /* ============================================
           ROOT VARIABLES
           ============================================ */
        :root {
            --myhr-bg: #f7fbf4;
            --myhr-on-bg: #181d19;
            --myhr-secondary-container: #E3A925;
            --myhr-on-secondary-container: #271900;
            --myhr-primary: #004a29;
            --hris-primary: #064e3b;
            --hris-primary-hover: #022c22;
            --hris-border-color: #EAE8E1;
        }

        /* ============================================
           BASE BODY
           Matches: bg-background text-on-background font-body min-h-screen relative overflow-hidden
           ============================================ */
        body {
            font-family: 'Lexend', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            background-color: var(--myhr-bg);
            color: var(--myhr-on-bg);
            min-height: 100vh;
            position: relative;
            overflow: hidden;
        }

        /* ============================================
           HERO BACKGROUND IMAGE & OVERLAY
           Matches: fixed inset-0 z-0 > img w-full h-full object-cover + absolute inset-0 bg-black/60
           ============================================ */
        .hero-bg {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            z-index: 0;
        }

        .hero-bg img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .hero-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.6);
        }

        /* ============================================
           TOP NAVBAR
           Matches: fixed top-0 z-50 flex justify-end items-center w-full px-12 md:px-20 py-8 md:py-10
           ============================================ */
        .top-navbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 50;
            display: flex;
            justify-content: flex-end;
            align-items: center;
            width: 100%;
            padding: 2rem 3rem;
        }

        @media (min-width: 768px) {
            .top-navbar {
                padding: 2.5rem 5rem;
            }
        }

        /* Matches: flex items-center gap-8 font-label text-sm uppercase tracking-widest text-white/80 */
        .top-navbar nav {
            display: flex;
            align-items: center;
            gap: 2rem;
            font-size: 0.875rem;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: rgba(255, 255, 255, 0.8);
        }

        /* Matches: text-white font-bold (Login link active) */
        .top-navbar nav a.nav-link-active {
            color: #ffffff;
            font-weight: 700;
        }

        /* Matches: hover:text-white transition-colors (Help, Contact links) */
        .top-navbar nav a {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: color 0.15s ease;
        }

        .top-navbar nav a:hover {
            color: #ffffff;
        }

        /* ============================================
           MAIN CONTENT STAGE
           Matches: relative z-10 grid grid-cols-1 lg:grid-cols-12 min-h-screen items-center px-8 md:px-20 pt-20
           ============================================ */
        .main-content {
            position: relative;
            z-index: 10;
            min-height: 100vh;
            padding: 0 2rem;
        }

        @media (min-width: 768px) {
            .main-content {
                padding: 0 5rem;
            }
        }

        /* ============================================
           LEFT SECTION: FOCAL LOGO
           Matches: lg:col-span-5 flex items-center
           ============================================ */
        .logo-section {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Matches: max-w-xl */
        .logo-section .logo-wrapper {
            max-width: 36rem;
        }

        @media (min-width: 992px) {
            .logo-section .logo-wrapper {
                padding-left: 2.5rem;
            }

            .logo-section {
                justify-content: flex-start;
            }
        }

        /* Matches: w-[300px] h-auto object-contain */
        .logo-section .logo-wrapper img {
            width: 300px;
            height: auto;
            object-fit: contain;
        }

        /* ============================================
           RIGHT SECTION: LOGIN FORM
           Matches: lg:col-span-7 flex flex-col items-end justify-center lg:pl-12
           ============================================ */
        .form-section {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            justify-content: center;
        }

        @media (min-width: 992px) {
            .form-section {
                padding-left: 3rem;
            }
        }

        /* Matches: w-full max-w-3xl */
        .form-section .form-outer {
            width: 100%;
            max-width: 48rem;
        }

        /* ============================================
           GLASSMORPHISM FORM CARD
           ============================================ */
        .form-card {
            background: rgba(255, 255, 255, 0.03);
            -webkit-backdrop-filter: blur(16px);
            backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.12);
            border-radius: 1rem;
            padding: 2.5rem;
        }

        /* ============================================
           GREETING / TAGLINE
           ============================================ */
        .form-greeting {
            font-size: 1.75rem;
            font-weight: 700;
            color: #ffffff;
            margin: 0 0 0.5rem 0;
        }

        .form-subtitle {
            font-size: 0.875rem;
            color: rgba(255, 255, 255, 0.7);
            margin: 0 0 2rem 0;
            letter-spacing: 0.02em;
        }

        /* Matches: flex flex-col space-y-6 (inner form group container) */
        .form-inner {
            display: flex;
            flex-direction: column;
        }

        /* space-y-6: apply margin-top: 1.5rem to all children except first */
        .form-inner>.form-group-row+.form-group-row {
            margin-top: 1.5rem;
        }

        /* ============================================
           INPUTS ROW
           Matches: flex flex-col md:flex-row gap-6 items-end
           ============================================ */
        .inputs-row {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
            align-items: stretch;
        }

        @media (min-width: 768px) {
            .inputs-row {
                flex-direction: row;
                align-items: flex-end;
            }
        }

        /* Matches: flex-1 w-full */
        .input-field-group {
            flex: 1;
            width: 100%;
        }

        /* Matches: block font-label text-xs uppercase tracking-widest text-white */
        .input-field-group label {
            display: block;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: #ffffff;
            margin-bottom: 0.5rem;
        }

        /* ============================================
           ROUNDED FILLED INPUT FIELDS
           ============================================ */
        .input-field-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-field-wrapper .input-icon {
            position: absolute;
            left: 1rem;
            color: rgba(255, 255, 255, 0.5);
            font-size: 1rem;
            transition: color 0.2s ease;
            pointer-events: none;
            z-index: 1;
        }

        .input-field-wrapper:focus-within .input-icon {
            color: #ffffff;
        }

        .input-field {
            width: 100%;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 0.75rem;
            padding: 1rem 1rem 1rem 2.75rem;
            color: #ffffff;
            font-size: 1rem;
            font-family: inherit;
            outline: none;
            transition: all 0.2s ease;
            -webkit-box-shadow: none;
            box-shadow: none;
        }

        .input-field:focus {
            background: rgba(255, 255, 255, 0.15);
            border-color: rgba(255, 255, 255, 0.4);
            box-shadow: 0 0 0 3px rgba(255, 255, 255, 0.08);
        }

        .input-field::placeholder {
            color: rgba(255, 255, 255, 0.45);
        }

        /* Password toggle inside rounded field */
        .password-toggle {
            position: absolute;
            right: 0.75rem;
            background: none;
            border: none;
            color: rgba(255, 255, 255, 0.5);
            cursor: pointer;
            padding: 0.5rem;
            font-size: 1rem;
            transition: color 0.2s ease;
            z-index: 1;
        }

        .password-toggle:hover {
            color: rgba(255, 255, 255, 0.8);
        }

        /* ============================================
           ACTION BUTTONS ROW
           Single column: Login button + Manager link below
           ============================================ */
        .buttons-row {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
            align-items: stretch;
            padding-top: 0.5rem;
        }

        /* ============================================
           REMEMBER ME & FORGOT ROW
           ============================================ */
        .remember-forgot-row {
            display: flex;
            justify-content: flex-start;
            align-items: center;
        }

        .remember-me {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.8rem;
            color: rgba(255, 255, 255, 0.6);
            cursor: pointer;
            user-select: none;
            transition: color 0.15s ease;
        }

        .remember-me:hover {
            color: rgba(255, 255, 255, 0.85);
        }

        .remember-me input[type="checkbox"] {
            appearance: none;
            -webkit-appearance: none;
            width: 1rem;
            height: 1rem;
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 0.25rem;
            background: transparent;
            cursor: pointer;
            position: relative;
            transition: all 0.2s ease;
            flex-shrink: 0;
        }

        .remember-me input[type="checkbox"]:checked {
            background-color: rgba(255, 255, 255, 0.2);
            border-color: rgba(255, 255, 255, 0.5);
        }

        .remember-me input[type="checkbox"]:checked::after {
            content: '';
            position: absolute;
            top: 2px;
            left: 5px;
            width: 4px;
            height: 7px;
            border: solid #ffffff;
            border-width: 0 2px 2px 0;
            transform: rotate(45deg);
        }

        /* ============================================
           LOGIN BUTTON (GOLD) - with glow hover
           ============================================ */
        .btn-myhr-login {
            background-color: var(--myhr-secondary-container);
            color: var(--myhr-on-secondary-container);
            border: none;
            border-radius: 0.75rem;
            padding: 1rem 2rem;
            font-weight: 700;
            font-size: 1rem;
            font-family: inherit;
            text-align: center;
            transition: all 0.2s ease;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1),
                0 4px 6px -4px rgba(0, 0, 0, 0.1);
            width: 100%;
            display: block;
            cursor: pointer;
        }

        .btn-myhr-login:hover {
            box-shadow: 0 0 20px rgba(227, 169, 37, 0.4),
                0 10px 15px -3px rgba(0, 0, 0, 0.1),
                0 4px 6px -4px rgba(0, 0, 0, 0.1);
            transform: translateY(-1px);
            color: var(--myhr-on-secondary-container);
            text-decoration: none;
            opacity: 1;
        }

        .btn-myhr-login:active {
            transform: translateY(0) scale(0.98);
        }

        .btn-myhr-login:disabled {
            opacity: 0.7;
            cursor: not-allowed;
            transform: none;
        }

        /* ============================================
           MANAGER LINK (TEXT LINK - replaces outline button)
           ============================================ */
        .manager-link {
            display: inline-block;
            background: transparent;
            color: rgba(255, 255, 255, 0.7);
            border: none;
            padding: 0.5rem 0;
            font-size: 0.875rem;
            font-weight: 600;
            font-family: inherit;
            text-decoration: underline;
            text-underline-offset: 4px;
            text-decoration-color: rgba(255, 255, 255, 0.3);
            transition: all 0.2s ease;
            cursor: pointer;
        }

        .manager-link:hover {
            color: #ffffff;
            text-decoration-color: rgba(255, 255, 255, 0.7);
        }

        /* ============================================
           SECONDARY ACTIONS (FOOTER LINKS)
           Matches: flex justify-between w-full font-label text-[10px] uppercase tracking-[0.2em] text-white/60
           ============================================ */
        .form-footer-links {
            display: flex;
            justify-content: space-between;
            width: 100%;
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 0.2em;
        }

        /* Matches: hover:text-white transition-colors */
        .form-footer-links a {
            color: rgba(255, 255, 255, 0.6);
            text-decoration: none;
            transition: color 0.15s ease;
        }

        .form-footer-links a:hover {
            color: #ffffff;
        }

        /* ============================================
           FIXED BOTTOM FOOTER
           Matches: fixed bottom-0 w-full flex justify-between items-center px-12 md:px-20 py-8 z-50 pointer-events-none
           ============================================ */
        .bottom-footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 2rem 3rem;
            z-index: 50;
            pointer-events: none;
        }

        @media (min-width: 768px) {
            .bottom-footer {
                padding: 2rem 5rem;
            }
        }

        .bottom-footer>* {
            pointer-events: auto;
        }

        /* Matches: font-label text-[10px] tracking-widest uppercase text-white/60 */
        .bottom-footer .footer-copyright {
            font-size: 10px;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: rgba(255, 255, 255, 0.6);
            margin: 0;
        }

        .bottom-footer .footer-dev-link {
            font-size: 10px;
            letter-spacing: 0.1em;
            text-transform: uppercase;
        }

        /* Matches: text-white/60 hover:text-white underline underline-offset-4 transition-all */
        .bottom-footer .footer-dev-link a {
            color: rgba(255, 255, 255, 0.6);
            text-decoration: underline;
            text-underline-offset: 4px;
            transition: color 0.15s ease;
        }

        .bottom-footer .footer-dev-link a:hover {
            color: #ffffff;
        }

        /* ============================================
           RESPONSIVE MOBILE FIXES
           ============================================ */
        @media (max-width: 991px) {
            .logo-section {
                padding-top: 5rem;
                margin-bottom: 1rem;
            }

            .logo-section .logo-wrapper img {
                width: 180px;
            }

            .form-card {
                padding: 1.5rem;
            }

            .form-greeting {
                font-size: 1.375rem;
            }

            .form-section {
                padding-left: 0;
            }

            .inputs-row {
                flex-direction: column;
                align-items: stretch;
            }

            .bottom-footer {
                padding: 1.5rem 1.5rem;
            }
        }

        @media (max-width: 575px) {
            .main-content {
                padding: 0 1rem;
            }

            .form-card {
                padding: 1.25rem;
            }

            .top-navbar {
                padding: 1.5rem 1rem;
            }
        }
    </style>

</head>

<body>

    <!-- ============================================
         HERO BACKGROUND IMAGE & OVERLAY
         Matches: fixed inset-0 z-0 > img w-full h-full object-cover + bg-black/60 overlay
         ============================================ -->
    <div class="hero-bg">
        <img alt="Deep green textured botanical illustration"
            src="assets/images/auth-bg.jpg">
        <div class="hero-overlay"></div>
    </div>

    <!-- ============================================
         TOP NAVBAR
         Matches: fixed top-0 z-50 with Login/Help/Contact links
         ============================================ -->
    <header class="top-navbar">
        <nav>
            <a class="nav-link-active" href="#">Login</a>
            <a href="#" id="helpBtn">Help</a>
        </nav>
    </header>

    <!-- ============================================
         MAIN CONTENT STAGE
         Matches: grid grid-cols-1 lg:grid-cols-12 min-h-screen items-center
         Using Bootstrap row/col for the col-span-5 + col-span-7 layout
         ============================================ -->
    <main class="main-content">
        <div class="row no-gutters align-items-center" style="min-height: calc(100vh - 5rem);">

            <!-- Left Section: Focal Logo
                 Matches: lg:col-span-5 flex items-center > max-w-xl > img w-[300px] -->
            <div class="col-12 col-lg-5 logo-section">
                <div class="logo-wrapper">
                    <img alt="myHR Logo"
                        src="assets/images/auth-logo.png">
                </div>
            </div>

            <!-- Right Section: Minimalist Login Form
                  Matches: lg:col-span-7 flex flex-col items-end justify-center lg:pl-12 -->
            <div class="col-12 col-lg-7 form-section">
                <div class="form-outer">
                    <div class="form-card">

                        <h2 class="form-greeting">Welcome Back</h2>
                        <p class="form-subtitle">Sign in to access your HR Portal</p>

                        <form id="loginForm" method="post" enctype="multipart/form-data" action="#">
                            <input type="hidden" name="lat">
                            <input type="hidden" name="lng">

                            <div class="form-inner">

                                <div class="form-group-row">
                                    <div class="inputs-row">

                                        <div class="input-field-group">
                                            <label for="username">Username</label>
                                            <div class="input-field-wrapper">
                                                <span class="input-icon"><i class="fas fa-user"></i></span>
                                                <input type="text" class="input-field" id="username" name="username" placeholder="xxxxxxxx" required>
                                            </div>
                                        </div>

                                        <div class="input-field-group">
                                            <label for="password">Password</label>
                                            <div class="input-field-wrapper">
                                                <span class="input-icon"><i class="fas fa-lock"></i></span>
                                                <input type="password" class="input-field" id="password" name="password" placeholder="••••••••" required>
                                                <button type="button" class="password-toggle" id="togglePassword">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="form-group-row">
                                    <div class="remember-forgot-row">
                                        <label class="remember-me">
                                            <input type="checkbox" name="remember"> Remember me
                                        </label>
                                    </div>
                                </div>

                                <div class="form-group-row">
                                    <div class="buttons-row">
                                        <button type="submit" class="btn-myhr-login" id="loginBtn">
                                            Login
                                        </button>
                                        <a href="#" class="manager-link">
                                            Login as Manager →
                                        </a>
                                    </div>
                                </div>

                            </div>
                        </form>

                    </div>
                </div>
            </div>

        </div>
    </main>

    <!-- ============================================
         FOOTER
         Matches: fixed bottom-0 w-full flex justify-between items-center px-12 md:px-20 py-8 z-50 pointer-events-none
         ============================================ -->
    <footer class="bottom-footer">
        <div class="footer-copyright">
            &copy; <span id="year"></span> myHR. All rights reserved.
        </div>
        <div class="footer-dev-link">
            <a href="#">HRIS Specialist</a>
        </div>
    </footer>

    <!-- jQuery and Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        getLocation();

        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition);
            } else {
                x.innerHTML = "Geolocation is not supported by this browser.";
            }
        }

        function showPosition(position) {
            $('input[name="lat"]').val(position.coords.latitude);
            $('input[name="lng"]').val(position.coords.longitude);
        }

        $(document).ready(function() {
            $('#year').text(new Date().getFullYear());

            $('#helpBtn').on('click', function(e) {
                e.preventDefault();
                Swal.fire({
                    type: "info",
                    title: 'Need Help?',
                    html: 'Hubungi HRIS Specialist kami:<br><br>' +
                        '<strong><i class="fas fa-envelope mr-2"></i>Andrian Chandra</strong><br>' +
                        '<span class="copy-email" style="color:#064e3b;text-decoration:underline;cursor:pointer;" data-email="andrian.chandra@wismilak.com">andrian.chandra@wismilak.com</span><br><br>' +
                        '<strong><i class="fas fa-envelope mr-2"></i>Yosy Dzulfiary</strong><br>' +
                        '<span class="copy-email" style="color:#064e3b;text-decoration:underline;cursor:pointer;" data-email="yosy.dzulfiary@wismilak.com">yosy.dzulfiary@wismilak.com</span>',
                    confirmButtonColor: '#064e3b',
                    confirmButtonText: 'Tutup',
                    didOpen: () => {
                        $('.copy-email').on('click', function() {
                            var email = $(this).data('email');
                            navigator.clipboard.writeText(email).then(function() {
                                Swal.fire({
                                    type: "success",
                                    title: 'Copied!',
                                    text: email + ' telah disalin ke clipboard.',
                                    timer: 1500,
                                    showConfirmButton: false
                                });
                            });
                        });
                    }
                });
            });



            $('#togglePassword').on('click', function() {
                const passwordInput = $('#password');
                const icon = $(this).find('i');

                if (passwordInput.attr('type') === 'password') {
                    passwordInput.attr('type', 'text');
                    icon.removeClass('fa-eye').addClass('fa-eye-slash');
                } else {
                    passwordInput.attr('type', 'password');
                    icon.removeClass('fa-eye-slash').addClass('fa-eye');
                }
            });

            $('#loginForm').on('submit', function(e) {
                const username = $('#username').val();
                const password = $('#password').val();
                const btn = $('#loginBtn');

                if (username && password) {
                    btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin mr-2"></i> Authenticating...');
                } else {
                    e.preventDefault();
                }
            });
        });
    </script>
</body>

</html>