<nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4">
    <div class="container">
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="index.php">Gym App</a>

        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="workouts.php?page=<?php echo date('Ymd'); ?>">Workouts <span class="sr-only">(current)</span></a>
                </li>
            </ul>
            <ul class="navbar-nav pull-right">
            <?php if(!isset($_SESSION['id'])) : ?>
                <li class="nav-item">
                    <a class="nav-link" href="login.php">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="register.php">Register</a>
                </li>
            <?php else : ?>
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Welcome <?php echo $_SESSION['name']; ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
            <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>