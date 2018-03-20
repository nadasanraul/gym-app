<?php 
    require_once('resources/users.php');
    session_start();
    if(isset($_SESSION['id'])){
        header('Location: index.php');
    }

    $user = new Users;
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $user->register();
        exit();
    }

?>

<?php include('inc/header.php'); ?>
    <div class="container">
        <h1 class="mb-3">Register</h1>
        <hr>
        <?php if(isset($_SESSION['message']) && strlen($_SESSION['message']) > 0) : ?>
            <div class="alert alert-danger">
                <p><?php echo $_SESSION['message'] ; ?></p>
                <?php unset($_SESSION['message']); ?>
            </div>
        <?php endif; ?>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method='POST'>
            <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control" required>
            </div>
            <input type="submit" name="submit" value="Register" class="btn btn-primary">
        </form>
    </div>
<?php include('inc/footer.php'); ?>