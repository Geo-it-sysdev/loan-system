<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loan Management System</title>

    <link rel="shortcut icon" href="<?php echo base_url('assets/images/GeonLoan.png'); ?>" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
        font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    }

    body {
        background-color: #07223c;
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        padding: 20px;
    }

    .login-wrapper {
        width: 100%;
        max-width: 1020px;
        height: 600px;
        border-radius: 28px;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
        display: flex;
        overflow: hidden;
        position: relative;
    }

    .login-wrapper::before {
        content: "";
        position: absolute;
        inset: 0;
        background: rgba(0, 0, 0, 0.35);
        z-index: 0;
    }

    .welcome-panel,
    .form-panel {
        position: relative;
        z-index: 1;
    }

    .welcome-panel {
        flex: 1.1;
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0;
        overflow: hidden;
        background: #0053c6;
    }

    .welcome-panel img {
        width: 100%;
        height: 100%;
        object-fit: fill;
        position: absolute;
        top: 0;
        left: 0;
    }

    /* .circle {
        position: absolute;
        border-radius: 50%;
        background: radial-gradient(circle, #0066dc 20%, #004fb9 100%);
        box-shadow: inset -10px -10px 30px rgba(0, 0, 0, 0.15),
            10px 10px 30px rgba(0, 0, 0, 0.1);
    }

    .circle-top {
        width: 480px;
        height: 480px;
        top: -180px;
        right: -100px;
        z-index: 1;
    }

    .circle-bottom-left {
        width: 260px;
        height: 260px;
        bottom: -70px;
        left: -40px;
        z-index: 2;
    }

    .circle-bottom-right {
        width: 240px;
        height: 240px;
        bottom: -60px;
        right: 80px;
        z-index: 3;
    } */

    .welcome-content {
        position: relative;
        z-index: 5;
        color: #ffffff;
        max-width: 440px;
        text-align: left;
        margin-right: 65%;
    }

    .welcome-content h1 {
        font-size: 20px;
        font-weight: 800;
        letter-spacing: 2px;
    }

    .welcome-content h2 {
        font-size: 12px;
        font-weight: 700;
        opacity: 0.9;
    }

    .form-panel {
        flex: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 50px;
    }

    .form-content {
        width: 100%;
        max-width: 360px;
    }

    .input-container {
        position: relative;
        margin-bottom: 16px;
    }

    .input-icon {
        position: absolute;
        left: 16px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 16px;
        color: #1a1a1a;
    }

    .input-container input {
        width: 100%;
        padding: 15px 16px 15px 48px;
        background-color: rgba(255, 255, 255, 0.85);
        border: none;
        border-radius: 10px;
        outline: none;
    }

    .toggle-password {
        position: absolute;
        right: 16px;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
    }

    .submit-btn {
        width: 100%;
        padding: 14px;
        border-radius: 10px;
        font-weight: 600;
        cursor: pointer;
        border: none;
        background-color: #00050a;
        color: #030303;
    }

    .primary-btn {
        background-color: #1147ab;
        color: #fff;
    }

    .primary-btn:hover {
        background-color: #062e6a;
    }

    @media (max-width: 820px) {
        .login-wrapper {
            flex-direction: column;
            height: auto;
            max-width: 440px;
            border-radius: 20px;
        }

        .welcome-panel {
            padding: 40px 30px;
        }

        .circle-bottom-right,
        .circle-bottom-left {
            display: none;
        }

        .form-panel {
            padding: 40px 30px;
        }
    }
    </style>
</head>

<body>

    <div class="login-wrapper">

        <div class="welcome-panel">

            <img src="<?= base_url('assets/images/geonproject.png'); ?>" alt="background">

            <div class="circle circle-top"></div>
            <div class="circle circle-bottom-left"></div>
            <div class="circle circle-bottom-right"></div>

            <div class="welcome-content">
                <h1>WELCOME</h1>
                <h2>EZ GEON - LOAN</h2>
            </div>

        </div>

        <div class="form-panel">

            <div class="form-content">

                <div style="text-align:center; margin-bottom:20px;">
                    <img src="<?= base_url('assets/images/geonDark.png'); ?>" style="max-width:260px;">
                </div>

                <form action="<?= base_url('sign_in') ?>" method="POST">

                    <div class="input-container">
                        <i class="fa-regular fa-user input-icon"></i>
                        <input type="text" name="username" placeholder="Username" required>
                    </div>
                    <br>
                    <div class="input-container">
                        <i class="fa-solid fa-lock input-icon"></i>
                        <input type="password" name="password" id="passwordInput" placeholder="Password" required>
                        <i class="fa-solid fa-eye toggle-password" onclick="togglePasswordVisibility()"></i>
                    </div>
                    <br>
                    <button type="submit" class="submit-btn primary-btn me-1">
                        <i class="fas fa-sign-in-alt"></i> Login
                    </button>

                </form>

            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
    function togglePasswordVisibility() {
        const passInput = document.getElementById('passwordInput');
        const icon = document.getElementById('toggleIcon');

        if (passInput.type === 'password') {
            passInput.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            passInput.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    }
    </script>




    <?php if ($this->session->flashdata('error')) : ?>
    <script>
    Swal.fire({
        icon: 'error',
        title: 'Login Failed',
        text: '<?= $this->session->flashdata('error'); ?>',
        confirmButtonText: 'OK',
        confirmButtonColor: '#dc3545',
        allowOutsideClick: false,
        allowEscapeKey: true
    });
    </script>
    <?php endif; ?>
</body>

</html>