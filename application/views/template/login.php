<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loan Management System</title>
    <link rel="shortcut icon" href="<?php echo base_url('assets/images/GeonLoan.png'); ?>" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">




</head>
<style>
* {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
    font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
}

body {
    background-color: #007aff;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    padding: 20px;
}

.login-wrapper {
    background-color: #ffffff;
    width: 100%;
    max-width: 1020px;
    height: 600px;
    border-radius: 28px;
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
    display: flex;
    overflow: hidden;
    position: relative;
}

.welcome-panel {
    flex: 1.1;
    background: linear-gradient(135deg, #0053c6 0%, #006be3 100%);
    position: relative;
    display: flex;
    align-items: center;
    padding: 60px;
    overflow: hidden;
}

.circle {
    position: absolute;
    border-radius: 50%;
    background: radial-gradient(circle, #0066dc 20%, #004fb9 100%);
    box-shadow: inset -10px -10px 30px rgba(0, 0, 0, 0.15), 10px 10px 30px rgba(0, 0, 0, 0.1);
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
}

.welcome-content {
    position: relative;
    z-index: 5;
    color: #ffffff;
    max-width: 440px;
}

.welcome-content h1 {
    font-size: 38px;
    font-weight: 800;
    letter-spacing: 2px;
    margin-bottom: 5px;
}

.welcome-content h2 {
    font-size: 16px;
    font-weight: 700;
    letter-spacing: 1px;
    margin-bottom: 25px;
    opacity: 0.9;
}

.welcome-content p {
    font-size: 11px;
    line-height: 1.8;
    opacity: 0.75;
}


.form-panel {
    flex: 1;
    background-color: #ffffff;
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 50px;
}

.corner-circle {
    position: absolute;
    width: 140px;
    height: 140px;
    bottom: -40px;
    right: -40px;
    background: radial-gradient(circle, #0076f1 0%, #0056c0 100%);
    border-radius: 50%;
}

.form-content {
    width: 100%;
    max-width: 360px;
    z-index: 5;
}

.form-content h2 {
    color: #1a1a1a;
    font-size: 36px;
    font-weight: 700;
    margin-bottom: 6px;
}

.form-content .subtitle {
    color: #8c8c8c;
    font-size: 11px;
    margin-bottom: 30px;
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
    color: #1a1a1a;
    font-size: 16px;
}

.input-container input {
    width: 100%;
    padding: 15px 16px 15px 48px;
    background-color: #f2f2f5;
    border: none;
    border-radius: 10px;
    font-size: 13px;
    color: #1a1a1a;
    outline: none;
}

.input-container input::placeholder {
    color: #a0a0a5;
}

.toggle-password {
    position: absolute;
    right: 16px;
    top: 50%;
    transform: translateY(-50%);
    background: none;
    border: none;
    font-size: 11px;
    font-weight: 700;
    color: #1a1a1a;
    cursor: pointer;
    letter-spacing: 0.5px;
}


.form-options {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 18px;
    margin-bottom: 26px;
    font-size: 11px;
}

.remember-me {
    display: flex;
    align-items: center;
    color: #666666;
    cursor: pointer;
}

.remember-me input {
    margin-right: 6px;
}

.forgot-link {
    color: #4c4c4c;
    text-decoration: none;
}

.forgot-link:hover {
    text-decoration: underline;
}


.submit-btn {
    width: 100%;
    padding: 14px;
    font-size: 15px;
    font-weight: 600;
    border-radius: 10px;
    cursor: pointer;
    transition: all 0.2s ease;
}

.primary-btn {
    background-color: #0b4382;
    border: none;
    color: #ffffff;
}

.primary-btn:hover {
    background-color: #072e5c;
}

.form-divider {
    text-align: center;
    color: #a6a6a6;
    font-size: 10px;
    margin: 14px 0;
    position: relative;
}

.secondary-btn {
    background-color: #ffffff;
    border: 1.5px solid #1a1a1a;
    color: #1a1a1a;
}

.secondary-btn:hover {
    background-color: #f5f5f7;
}


.signup-prompt {
    text-align: center;
    margin-top: 35px;
    font-size: 11px;
    color: #666666;
}

.signup-prompt a {
    color: #007aff;
    text-decoration: none;
    font-weight: 700;
    margin-left: 4px;
}

.signup-prompt a:hover {
    text-decoration: underline;
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
        align-items: flex-start;
    }

    .circle-top {
        width: 300px;
        height: 300px;
        top: -120px;
        right: -60px;
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

<body>

    <div class="login-wrapper">

        <div class="welcome-panel">
            <div class="circle circle-top"></div>
            <div class="circle circle-bottom-left"></div>
            <div class="circle circle-bottom-right"></div>

            <div class="welcome-content">
                <h1>WELCOME</h1>
                <h2>YOUR HEADLINE NAME</h2>

            </div>
        </div>

        <div class="form-panel">
            <div class="corner-circle"></div>

            <div class="form-content">
                <h2>Sign in</h2>
                <p class="subtitle"> </p>

                <form action="<?= base_url('sign_in') ?>" method="POST">
                    <div class="input-container">
                        <i class="fa-regular fa-user input-icon"></i>
                        <input type="text" name="username" placeholder="Username" required>
                    </div>

                    <div class="input-container">
                        <i class="fa-solid fa-lock input-icon"></i>
                        <input type="password" name="password" id="passwordInput" placeholder="Password" required>

                        <i class="fa-solid fa-eye toggle-password" id="toggleIcon"
                            onclick="togglePasswordVisibility()"></i>
                    </div>

                    <div class="form-options">
                        <label class="remember-me">
                            <input type="checkbox">
                            <span class="custom-checkbox"></span>
                            Remember me
                        </label>
                        <a href="#" class="forgot-link">Forgot Password?</a>
                    </div>

                    <button type="submit" class="submit-btn primary-btn">Login</button>


                </form>

                <div class="signup-prompt">
                    Don't have an account? <a href="#">Sign Up</a>
                </div>
            </div>
        </div>

    </div>

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





</body>

</html>