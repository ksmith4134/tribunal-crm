<?php 
include 'inc/autoloader.inc.php';
include 'inc/config.inc.php';
include 'inc/header.inc.php';
include 'inc/nav.inc.php'; 

$object = new ViewProjects();
$projects = $object->showProjectsDash();

$object2 = new ViewToDos();
$todos = $object2->sortToDos();

$object3 = new ViewSettings();
$proj_thresh = $object3->showProjectThresh();

?>

<div class="col-11 mx-auto">
    <br>
    <div class="d-flex flex-row">
        <div class="p-2 mb-3">
            <h4>My Dashboard</h4>
        </div>
    </div>
    <!-- <div class="p-3">
        <p>Welcome ____</p>
    </div> -->
    <div class="row p-2">
        <div class="mb-3 col-6">
            <h5 style="color:#4169E1; font-weight:bold; padding-bottom:10px;">To-Dos</h5>
            <table class="table table-hover">
                <thead>
                    <tr>
                    <th scope="col">Priority</th>
                    <th scope="col">Due Date</th>
                    <th scope="col">Category</th>
                    <th scope="col">Time (h)</th>
                    <th scope="col">Progress</th>
                    <th scope="col"></th>
                    </tr>
                </thead>
                <tbody class="align-middle" style="font-size:.85em;">
                    <?php foreach($todos as $todo) : ?>
                        <tr>
                            <td>
                                <div class="text-center" style="background:<?php 
                                    if (preg_match('[5]', $todo['priority'])){echo '#41e169;';} 
                                    elseif (preg_match('[4]', $todo['priority'])){echo '#62e082;';}
                                    elseif (preg_match('[3]', $todo['priority'])){echo '#84e09b;';}
                                    elseif (preg_match('[2]', $todo['priority'])){echo '#a6e0b4;';}
                                    elseif (preg_match('[1]', $todo['priority'])){echo '#c7e0cd;';}
                                    else {echo ";";}
                                    ?>; padding:5px; border-radius:20px;">
                                    <?php echo substr($todo['priority'], 3); ?>
                                </div>
                            </td>
                            <td><?php echo $todo['due_at']; ?></td>
                            <td><?php echo $todo['category']; ?></td>
                            <td><?php echo $todo['est_time'] - $todo['time_complete']; ?></td>
                            <td>
                                <div class="progress mt-2">
                                    <div class="progress-bar bg-warning" role="progressbar" style="width: <?php echo 100*($todo['time_complete'] / $todo['est_time']); ?>%">
                                    </div>
                                </div>
                            </td>
                            <td><div class="ms-5"><a href="<?php echo ROOT_URL; ?>todos.single.php?id=<?php echo $todo['id']; ?>" class="btn btn-sm btn-primary">View</a></div></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="col-1"></div>
        <div class="col-5">
            <h5 style="color:#4169E1; font-weight:bold; padding-bottom:10px;">High Priority Projects</h5>
            <table class="table table-hover">
                <thead>
                    <tr>
                    <th scope="col">Project</th>
                    <th scope="col">Company</th>
                    <th scope="col">APR</th>
                    <th scope="col"></th>
                    </tr>
                </thead>
                <tbody class="align-middle" style="font-size:.85em;">
                    <?php foreach($projects as $project) : ?>
                        <?php if($project['attn_priority'] > $proj_thresh['thresh_value']) : ?>
                            <tr>
                                <td><?php echo $project['proj_name']; ?></td>
                                <td><?php echo $project['co_name']; ?></td>
                                <td><?php echo $project['attn_priority']; ?></td>
                                <td><a href="<?php echo ROOT_URL; ?>projects.single.php?id=<?php echo $project['id']; ?>" class="btn btn-sm btn-primary">View</a></td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include 'inc/footer.inc.php'; ?>