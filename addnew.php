<?php 

    require_once('resources/exercises.php');
    session_start();

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $exerc = new Exercises;
        $exerc->addNew();
        exit();
    }

?>

<?php include('inc/header.php'); ?>
    <div class="container">
        <h1 class="mb-3">Add new exercise</h1>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method='POST'>
            <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" class="form-control" placeholder="Enter the name of the exercise" required>
            </div>
            <div class="form-group">
                <label>Type</label>
                <select name="type" class="form-control" required>
                    <option>Weight/Reps</option>
                    <option>Distance/Time</option>
                </select>
            </div>
            <div class="form-group">
                <label>Muscles Worked</label>
                <select name="category" class="form-control" required>
                    <option>Chest</option>
                    <option>Back</option>
                    <option>Legs</option>
                    <option>Shoulders</option>
                    <option>Biceps</option>
                    <option>Triceps</option>
                    <option>Forearms</option>
                    <option>Glutes</option>
                    <option>Abs</option>
                </select>
            </div>
            <input type="submit" name="submit" value="Save" class="btn btn-primary">
        </form>
    </div>
<?php include('inc/footer.php'); ?>