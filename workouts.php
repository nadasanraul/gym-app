<?php 
    require_once('config/db.php');
    require_once('resources/exercises.php'); 
    session_start();

    $date = $_GET['page'];

    $date = date('Y-m-d', strtotime($date));

    $nextDay = date('Y-m-d', strtotime($date."+1 day"));
 
    $prevDay = date('Y-m-d', strtotime($date."-1 day"));   
    
    $exercises = new Exercises;
    $workouts = $exercises->getWorkouts($date);
    $names = $exercises->getNames($date);
    // var_dump($names);

?>

<?php include('inc/header.php'); ?>
    <div class="container">
        <ul class="pagination justify-content-center">
            <li class="page-item pr-5">
                <a class="page-link" href="workouts.php?page=<?php echo date('Ymd', strtotime($prevDay)); ?>" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                    <span class="sr-only">Previous</span>
                </a>
            </li>
            <li class="page-item pl-5">
                <a class="page-link" href="workouts.php?page=<?php echo date('Ymd', strtotime($nextDay)); ?>" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                    <span class="sr-only">Next</span>
                </a>
            </li>
        </ul>
        <?php foreach($names as $name) : ?>
            <div class="card card-body bg-light mb-3">
                <h4 class="card-title"><?php echo $name['name']; ?></h4>
                <ol>
                    <?php foreach($workouts as $workout) : ?>
                        <?php if($workout['name'] == $name['name']) : ?>
                            <li>
                                <p><?php echo $workout['weight']; ?> kgs - <span><?php echo $workout['reps']; ?> reps</span></p>
                            </li>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </ol>
            </div>
        <?php endforeach; ?>
    </div>
<?php include('inc/footer.php'); ?>