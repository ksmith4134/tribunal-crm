<?php 
include 'inc/autoloader.inc.php';
include 'inc/config.inc.php';
include 'inc/header.inc.php';
include 'inc/nav.inc.php'; 

$object = new ViewLeads();
$leads = $object->showLeads();
$object->executeDeleteLead();

?>
<div class="col-11 mx-auto">
    <br>
    <div class="d-flex flex-row mb-4">
        <div class="p-2">
            <h4>All Leads</h4>
        </div>
        <div class="p-2">
            <a href="<?php echo ROOT_URL; ?>leads.new.php" class="btn btn-success">New Record</a>
        </div>
    </div>
    <table class="table table-hover">
    <thead>
        <tr>
        <th scope="col">ID</th>
        <th scope="col">Co. ID</th>
        <th scope="col">Company</th>
        <th scope="col">Name</th>
        <th scope="col">Email</th>
        <th scope="col">Phone</th>
        <th scope="col">Sales Rep</th>
        <th scope="col"></th>
        <th scope="col"></th>
        <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($leads as $lead) : ?>
            <tr>
                <th scope="row"><?php echo $lead['id']; ?></th>
                <td><?php echo $lead['companyID']; ?></td>
                <td><?php echo $lead['co_name']; ?></td>
                <td><?php echo $lead['firstname'].' '.$lead['lastname']; ?></td>
                <td><?php echo $lead['email']; ?></td>
                <td><?php echo $lead['phone1']; ?></td>
                <td><?php echo $lead['rep1']; ?></td>
                <td><a href="<?php echo ROOT_URL; ?>leads.single.php?id=<?php echo $lead['id']; ?>" class="btn btn-sm btn-primary">View</a></td>
                <td><a href="<?php echo ROOT_URL; ?>leads.edit.php?id=<?php echo $lead['id']; ?>" class="btn btn-sm btn-warning">Edit</a></td>
                <td>
                    <!-- MODAL:DELETE RECORD -->
                    <form method="POST">
                        <div class="px-2">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal<?php echo 'l'.$lead['id']; ?>">-</button>
                        </div>
                        <!-- Modal -->
                        <div class="modal fade" id="deleteModal<?php echo 'l'.$lead['id']; ?>" tabindex="-1" aria-labelledby="deleteModalLabel<?php echo 'l'.$lead['id']; ?>" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteModalLabel<?php echo 'l'.$lead['id']; ?>">Are you sure you want to delete this record?</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="d-flex px-1">
                                            <p>Name: <?php echo $lead['firstname'].' '.$lead['lastname']; ?></p>
                                        </div>
                                        <div class="d-flex px-1">
                                            <p>ID: <?php echo $lead['id']; ?></p>
                                        </div>
                                        <div class="d-flex px-1">
                                            <input type="hidden" name="delete_id" value="<?php echo $lead['id']; ?>">
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