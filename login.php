<?php 
    require_once('resources/users.php');
    session_start();
    if(isset($_SESSION['id'])){
        header('Location: index.php');
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $user = new Users;
        $user->login();
        exit();
    }

?>


<?php include('inc/header.php'); ?>
    <div class="container">
        <h1 class="mb-3">Login</h1>
        <hr>
        <?php if(isset($_SESSION['message']) && strlen($_SESSION['message']) > 0) : ?>
            <div class="alert alert-danger">
                <p><?php echo $_SESSION['message'] ; ?></p>
                <?php unset($_SESSION['message']); ?>
            </div>
        <?php elseif(isset($_SESSION['success']) && strlen($_SESSION['success']) > 0) : ?>
            <div class="alert alert-success">
                <p><?php echo $_SESSION['success'] ; ?></p>
                <?php unset($_SESSION['success']); ?>
            </div>
        <?php endif; ?>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method='POST'>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <input type="submit" name="submit" value="Login" class="btn btn-primary">
        </form>
    </div>
<?php include('inc/footer.php'); ?>