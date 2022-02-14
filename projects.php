<?php 
include 'inc/autoloader.inc.php';
include 'inc/config.inc.php';
include 'inc/header.inc.php';
include 'inc/nav.inc.php'; 

$object = new ViewProjects();
$projects = $object->showProjects();
$object->executeDeleteProject();

?>
<div class="col-11 mx-auto">
    <br>
    <div class="d-flex flex-row mb-4">
        <div class="p-2"><h4>All Projects</h4></div>
        <div class="p-3 ms-auto"><small>Note: New projects are created within Company records.</small></div>
    </div>
    <table class="table table-hover">
    <thead>
        <tr>
        <th scope="col">ID</th>
        <th scope="col">Co. ID</th>
        <th scope="col">Project</th>
        <th scope="col">Company</th>
        <th scope="col">Status</th>
        <th scope="col">Sales Rep</th>
        <th scope="col">APR</th>
        <th scope="col"></th>
        <th scope="col"></th>
        <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($projects as $project) : ?>
            <tr>
                <th scope="row"><?php echo $project['id']; ?></th>
                <td><?php echo $project['companyID']; ?></td>
                <td><?php echo $project['proj_name']; ?></td>
                <td><?php echo $project['co_name']; ?></td>
                <td><?php echo $project['project_status']; ?></td>
                <td><?php echo $project['rep1']; ?></td>
                <td><?php echo $project['attn_priority']; ?></td>
                <td><a href="<?php echo ROOT_URL; ?>projects.single.php?id=<?php echo $project['id']; ?>" class="btn btn-sm btn-primary">View</a></td>
                <td><a href="<?php echo ROOT_URL; ?>projects.edit.php?id=<?php echo $project['id']; ?>" class="btn btn-sm btn-warning">Edit</a></td>
                <td>
                    <!-- MODAL:DELETE RECORD -->
                    <form method="POST">
                        <div class="">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal<?php echo 'p'.$project['id']; ?>">-</button>
                        </div>
                        <!-- Modal -->
                        <div class="modal fade" id="deleteModal<?php echo 'p'.$project['id']; ?>" tabindex="-1" aria-labelledby="deleteModalLabel<?php echo 'p'.$project['id']; ?>" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteModalLabel<?php echo 'p'.$project['id']; ?>">Are you sure you want to delete this record?</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="d-flex px-1">
                                            <p>Project: <?php echo $project['proj_name']; ?></p>
                                        </div>
                                        <div class="d-flex px-1">
                                            <p>ID: <?php echo $project['id']; ?></p>
                                        </div>
                                        <div class="d-flex px-1">
                                            <input type="hidden" name="delete_id" value="<?php echo $project['id']; ?>">
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

<?php include 'inc/footer.inc.php'; ?>