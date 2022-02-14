<?php 
include 'inc/autoloader.inc.php';
include 'inc/config.inc.php';
include 'inc/header.inc.php';
include 'inc/nav.inc.php'; 

$object = new ViewCompanies();
$companies = $object->showCompanies();
$object->executeDeleteCompany();

?>
<div class="col-11 mx-auto">
    <br>
    <div class="d-flex flex-row mb-4">
        <div class="p-2">
            <h4>All Companies</h4>
        </div>
        <div class="p-2">
            <a href="<?php echo ROOT_URL; ?>companies.new.php" class="btn btn-success">New Record</a>
        </div>
    </div>
    <table class="table table-hover">
    <thead>
        <tr>
        <th scope="col">Co. ID</th>
        <th scope="col">Company</th>
        <th scope="col">Type</th>
        <th scope="col">Status</th>
        <th scope="col">Website</th>
        <th scope="col">Sales Rep</th>
        <th scope="col"></th>
        <th scope="col"></th>
        <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($companies as $company) : ?>
            <tr>
                <th scope="row"><?php echo $company['companyID']; ?></th>
                <td><?php echo $company['co_name']; ?></td>
                <td><?php echo $company['co_type']; ?></td>
                <td><?php echo $company['co_status']; ?></td>
                <td><?php echo $company['website1']; ?></td>
                <td><?php echo $company['rep1']; ?></td>
                <td><a href="<?php echo ROOT_URL; ?>companies.single.php?companyID=<?php echo $company['companyID']; ?>" class="btn btn-sm btn-primary">View</a></td>
                <td><a href="<?php echo ROOT_URL; ?>companies.edit.php?companyID=<?php echo $company['companyID']; ?>" class="btn btn-sm btn-warning">Edit</a></td>
                <td>
                    <!-- MODAL:DELETE RECORD -->
                    <form method="POST">
                        <div class="">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal<?php echo 'c'.$company['companyID']; ?>">-</button>
                        </div>
                        <!-- Modal -->
                        <div class="modal fade" id="deleteModal<?php echo 'c'.$company['companyID']; ?>" tabindex="-1" aria-labelledby="deleteModalLabel<?php echo 'c'.$company['companyID']; ?>" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteModalLabel<?php echo 'c'.$company['companyID']; ?>">Are you sure you want to delete this record?</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="d-flex px-1">
                                            <p>Company: <?php echo $company['co_name']; ?></p>
                                        </div>
                                        <div class="d-flex px-1">
                                            <p>ID: <?php echo $company['companyID']; ?></p>
                                        </div>
                                        <div class="d-flex px-1">
                                            <input type="hidden" name="delete_id" value="<?php echo $company['companyID']; ?>">
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