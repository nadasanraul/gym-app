<?php 

    require_once('config/db.php');
    require_once('resources/exercises.php');
    session_start();

    // $link = new Db;

    // $query = 'SELECT * FROM exercises';

    // $result = mysqli_query($link->dbConnect(), $query);

    // $exercises = mysqli_fetch_all($result, MYSQLI_ASSOC);

    // mysqli_free_result($result);

    // mysqli_close($link->dbConnect());

    $exerc = new Exercises;
    $exercises = $exerc->selectExercises();
    
?>  

<?php include('inc/header.php'); ?>
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h1 class="mb-3">Select Exercises</h1>
            </div>
            <div class="col-md-4 pt-2">
                <a href="addnew.php" class="btn btn-primary pull-right">Add New Exercise</a>
            </div>
        </div>
        <ul class="list-group">
            <?php foreach($exercises as $exercise) : ?>
                <a href="show.php?id=<?php echo $exercise['id']; ?>"<li class="list-group-item"><?php echo $exercise['name']; ?></li></a>
            <?php endforeach; ?>
        </ul>
    </div>
<?php include('inc/footer.php'); ?>