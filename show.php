<?php 
    require_once('config/db.php');
    require_once('resources/exercises.php'); 
    session_start();

    $id = $_GET['id'];
    $count = 1;
    
    $exerc = new Exercises;
    $exercise = $exerc->selectExercise($id);
    $sets = $exerc->getSets($id);

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $exerc->newSet();
        exit();
    }

?>

<?php include('inc/header.php'); ?>
    <div class="container">
        <h1 class="mb-3"><?php echo $exercise['name']; ?></h1>
        <div class="jumbotron">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>?id=<?php echo $id; ?>" method="POST">
                <div class="form-group">
                    <label>Weight</label>
                    <input type="number" name="weight" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Reps</label>
                    <input type="number" name="reps" class="form-control" required>
                </div>
                <input type="hidden" name="exerc_id" value="<?php echo $id; ?>">
                <input type="submit" name="submit" value="Save" class="btn btn-success">
            </form>
        </div>
        <?php if(!empty($sets)) : ?>
            <table class="table">
                <tbody>
                    <?php foreach($sets as $set) : ?>
                        <tr>
                            <td><?php echo $count; ?></td>
                            <td><?php echo $set['weight']; ?> kgs</td>
                            <td><?php echo $set['reps']; ?> reps</td>
                        </tr>
                        <?php $count++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
<?php include('inc/footer.php'); ?>