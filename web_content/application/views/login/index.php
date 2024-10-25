<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login Page</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URL;?>application/public/login/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body>
<div class="container">
    <div class="form-container sign-up">
        <form action="<?php echo URL; ?>Home/register" method="post">
            <h1>Create Account</h1>
            <div class="social-icons"></div>
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="text" name="first_name" placeholder="First name" required>
            <input type="text" name="last_name" placeholder="Last name" required>
            <input type="text" name="city" placeholder="City" required>
            <button type="submit">Request</button>
        </form>
    </div>

    <div class="form-container sign-in">
        <form action="<?php echo URL; ?>Login/logIn" method="post">
            <h1>Sign In</h1>
            <div class="social-icons"></div>
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="hidden" name="token" value="<?php echo $_SESSION['token']?>">
            <button type="submit">Login</button>
        </form>
    </div>
    <div class="toggle-container">
        <div class="toggle">
            <div class="toggle-panel toggle-left">
                <h1>Welcome Back!</h1>
                <p>Register with your personal details to send a request to our admins</p>
                <button class="hidden" id="login">Sign In</button>
            </div>
            <div class="toggle-panel toggle-right">
                <h1>Hello, User!</h1>
                <p>Register with your personal details to send a request to our admins</p>
                <button class="hidden" id="register">Request</button>
            </div>
        </div>
    </div>
</div>

<?php if(isset($_SESSION['errorLogin'])): ?>
    <div class="error-login">
        <?php echo $_SESSION['errorLogin'] ?>
    </div>
<?php endif; ?>
<?php if(isset($_SESSION['errorRegister'])): ?>
    <div class="error-register">
        <?php echo $_SESSION['errorRegister'] ?>
    </div>
<?php endif; ?>
<script src="<?php echo URL;?>application/public/login/login.js"></script>
</body>
</html>