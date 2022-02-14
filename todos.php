<?php 
include 'inc/autoloader.inc.php';
include 'inc/config.inc.php';
include 'inc/header.inc.php';
include 'inc/nav.inc.php'; 

$object = new ViewToDos();
$object->executeDeleteToDo();

$columns = array('id','rep1','priority','due_at','done','done_at');
$column = isset($_GET['column']) && in_array($_GET['column'], $columns) ? $_GET['column'] : $columns[0];
$sort_order = isset($_GET['order']) && strtolower($_GET['order']) == 'desc' ? 'DESC' : 'ASC';

$todos = $object->sortToDosAll($column, $sort_order);

$up_or_down = str_replace(array('ASC','DESC'), array('up','down'), $sort_order); 
$asc_or_desc = $sort_order == 'ASC' ? 'desc' : 'asc';

?>

<div class="col-11 mx-auto">
    <br>
    <div class="d-flex flex-row mb-4">
        <div class="p-2">
            <h4>All To-Dos</h4>
        </div>
        <div class="p-2">
            <a href="<?php echo ROOT_URL; ?>todos.new.php" class="btn btn-success">New Record</a>
        </div>
    </div>
    <table class="table table-hover">
    <thead>
        <tr>
        <th scope="col"><a href="todos.php?column=id&order=<?php echo $asc_or_desc; ?>">ID<i class="fas fa-sort<?php echo $column == 'id' ? '-' . $up_or_down : ''; ?>"></i></a></th>
        <th scope="col">Proj. ID</th>
        <th scope="col"><a href="todos.php?column=rep1&order=<?php echo $asc_or_desc; ?>">Sales Rep<i class="fas fa-sort<?php echo $column == 'rep1' ? '-' . $up_or_down : ''; ?>"></i></a></th>
        <th scope="col"><a href="todos.php?column=priority&order=<?php echo $asc_or_desc; ?>">Priority<i class="fas fa-sort<?php echo $column == 'priority' ? '-' . $up_or_down : ''; ?>"></i></a></th>
        <th scope="col">Details</th>
        <th scope="col"><a href="todos.php?column=due_at&order=<?php echo $asc_or_desc; ?>">Due Date<i class="fas fa-sort<?php echo $column == 'due_at' ? '-' . $up_or_down : ''; ?>"></i></a></th>
        <th scope="col"><a href="todos.php?column=done_at&order=<?php echo $asc_or_desc; ?>">Done Date<i class="fas fa-sort<?php echo $column == 'done_at' ? '-' . $up_or_down : ''; ?>"></i></a></th>
        <th scope="col"></th>
        <th scope="col"></th>
        <th scope="col"></th>
        </tr>
    </thead>
    <tbody class="align-middle" style="font-size:.85em;">
        <?php foreach ($todos as $todo) : ?>
            <tr>
                <th scope="row"><?php echo $todo['id']; ?></th>
                <th scope="row"><?php echo $todo['projectID']; ?></th>
                <td><?php echo $todo['rep1']; ?></td>
                <td>
                    <div class="text-center" style="background:<?php 
                        if (preg_match('[5]', $todo['priority'])){echo '#41e169;';} 
                        elseif (preg_match('[4]', $todo['priority'])){echo '#62e082;';}
                        elseif (preg_match('[3]', $todo['priority'])){echo '#84e09b;';}
                        elseif (preg_match('[2]', $todo['priority'])){echo '#a6e0b4;';}
                        elseif (preg_match('[1]', $todo['priority'])){echo '#c7e0cd;';}
                        else {echo ";";}
                        ?>; padding:5px; border-radius:20px;">
                        <?php echo substr($todo['priority'],3); ?>
                    </div>                    
                </td>
                <td>
                    <div style="overflow-y:hidden; overflow-x: hidden; max-height:3em; max-width:30em;">
                        <?php echo $todo['details']; ?></td>
                    </div>
                <td>
                    <span style="<?php if($todo['due_at']>=date('Y-m-d') && $todo['done'] == 0){echo "color:green;";} elseif($todo['due_at']<date('Y-m-d') && $todo['done'] == 0) {echo "color:red;";} else {echo "";} ?>">
                        <?php if($todo['due_at'] == '0000-00-00'){echo "";} else {echo $todo['due_at'];}?>
                    </span>
                </td>
                <td><?php echo $todo['done_at']; ?></td>
                <td><a href="<?php echo ROOT_URL; ?>todos.single.php?id=<?php echo $todo['id']; ?>" class="btn btn-sm btn-primary">View</a></td>
                <td><a href="<?php echo ROOT_URL; ?>todos.edit.php?id=<?php echo $todo['id']; ?>" class="btn btn-sm btn-warning">Edit</a></td>
                <td>
                    <!-- MODAL:DELETE RECORD -->
                    <form method="POST">
                        <div class="px-2">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal<?php echo 'l'.$todo['id']; ?>">-</button>
                        </div>
                        <!-- Modal -->
                        <div class="modal fade" id="deleteModal<?php echo 'l'.$todo['id']; ?>" tabindex="-1" aria-labelledby="deleteModalLabel<?php echo 'l'.$todo['id']; ?>" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteModalLabel<?php echo 'l'.$todo['id']; ?>">Are you sure you want to delete this record?</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="d-flex px-1">
                                            <p>Sales Rep: <?php echo $todo['rep1']; ?></p>
                                        </div>
                                        <div class="d-flex px-1">
                                            <p>ID: <?php echo $todo['id']; ?></p>
                                        </div>
                                        <div class="d-flex px-1">
                                            <input type="hidden" name="delete_id" value="<?php echo $todo['id']; ?>">
                                            <input type="submit" name="delete" class="btn btn-sm btn-danger" value="Delete Record">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- END DELETE MODAL -->
                </td>
            </tr>
        <?php endforeach; ?>  
    </tbody>
    </table>
</div>

<style>
    /* TABLE STYLING */
    th a {
        text-decoration:none;
        color: #000000;
    }
    th a i {
        margin-left: 5px;
        color: royalblue;
    }
</style>

<?php include 'inc/footer.inc.php'; ?>