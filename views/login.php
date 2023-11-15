<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('layouts/header.php'); ?>
    <link rel="stylesheet" href="../css/login.css">
</head>
<body>

<div class="container-center">
    <img src="../img/logo-white.png" alt="Moss Free Clinic logo">

<div class="login-form">
    <div class="login-form">
        <h3>Login</h3>
        <p style="text-align: center;">Access to the Moss Free Clinic system requires permission.</p>
        <ul>
            <li>If you accidentally came to this site instead of the Moss Free Clinic website, please <a href="https://centralvahorserescue.org/" target="_blank">click here</a> to visit their site.</li>
            <li>If you are a volunteer logging in for the first time, your Username is your first name followed by your ten digit phone number. After you have logged in, you can change your password.</li>
        </ul>
        <form action="../includes/login.inc.php" method="post">
            <div class="mb-3">
                <label for="username" class="form-label">Username:</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="d-grid">
                <input type="submit" name="submit" class="btn btn-primary">
            </div>
        </form>

        <div class="create-account">
            <p>Don't have an account? <a href="#">Request Access</a></p>
        </div>

        <?php if (!empty($error)): ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>

    </div>
</div>
</body>
</html>
