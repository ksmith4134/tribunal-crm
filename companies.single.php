<?php
include 'inc/autoloader.inc.php';
include 'inc/config.inc.php';
include 'inc/header.inc.php';
include 'inc/nav.inc.php';

$object = new ViewCompanies();
$company = $object->showCompanyEdit();
$object->executeDeleteCompany();
$next = $object->nextHigherCompany();
$prev = $object->nextLowerCompany();
$projects = $object->showLinkedProjects();
$leads = $object->showLinkedLeads();
$todos = $object->showCompanyToDos();

?>

<div class="col-11 mx-auto">
    <br>
    <!-- <h4 class="mb-4">Lead</h4> -->
    <form method="POST" action="" class="mb-4" id="form">
        <div class="d-flex flex-row mt-3 mb-2">
            <div class="" style="margin:0px 20px 0px 0px;">
                <h4><span style="color:#4169E1; font-weight:bold;">Company </span><?php echo $company['co_name']; ?></h4>
            </div>
            <div class="px-2 ms-auto">
                <a href="<?php echo ROOT_URL; ?>companies.edit.php?companyID=<?php echo $company['companyID']; ?>" class="btn btn-sm btn-warning">Edit</a>
            </div>
            <div class="px-2">
                <a href="projects.new.php?companyID=<?php echo $company['companyID']; ?>" class="btn btn-sm btn-success">Create Project</a>
            </div>
            <div class="px-2">
                <a href="<?php echo ROOT_URL.'companies.php'; ?>" class="btn btn-sm btn-primary">List View</a>
            </div>
            <div class="px-2">
                <a href="<?php echo ROOT_URL; ?>companies.single.php?companyID=<?php echo $prev['companyID']; ?>" class="btn btn-sm btn-outline-dark"><</a>
                <a href="<?php echo ROOT_URL; ?>companies.single.php?companyID=<?php echo $next['companyID']; ?>" class="btn btn-sm btn-outline-dark">></a>
            </div>
        </div>
        <div class="row py-2 mb-3 bg-light rounded" style="box-shadow: 2px 4px 4px #ddd;">
            <div class="col-3">
                <div class="form-group">
                    <label for="co_name" class="col-8 col-form-label"><strong>Company</strong></label>
                    <div class="">
                        <input type="text" name="co_name" class="form-control form-control-sm" value="<?php echo $company['co_name']; ?>" readonly>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <label for="co_type" class="col-8 col-form-label"><strong>Company Type</strong></label>
                    <div class="">
                        <input type="text" name="co_type" class="form-control form-control-sm" value="<?php echo $company['co_type']; ?>" readonly>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <label for="co_status" class="col-8 col-form-label"><strong>Status</strong></label>
                    <div class="">
                        <input type="text" name="co_status" class="form-control form-control-sm" value="<?php echo $company['co_status']; ?>" readonly>
                    </div>
                </div>
            </div> 
            <div class="col-2">

            </div>
            <div class="col-1">
                <div class="form-group" >   
                    <label for="companyID" class="col-form-label"><strong>Co. ID</strong></label>
                    <div class="mb-2">
                        <input type="text" name="companyID" class="form-control form-control-sm" value="<?php echo $company['companyID']; ?>" readonly>
                    </div>
                </div>
            </div>
        </div>
        <div class="row py-2 mb-3 bg-light rounded" style="box-shadow: 2px 4px 4px #ddd;">
            <div class="col-3">
                <div class="form-group">
                    <label for="website1" class="col-8 col-form-label"><strong>Websites</strong></label>
                    <div class="mb-2">
                        <input type="text" name="website1" class="form-control form-control-sm" value="<?php echo $company['website1']; ?>" readonly>
                    </div>
                    <div class="">
                        <input type="text" name="website2" class="form-control form-control-sm" value="<?php echo $company['website2']; ?>" readonly>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <label for="rep1" class="col-8 col-form-label"><strong>Sales Reps</strong></label>
                    <div class="mb-2">
                        <input type="text" name="rep1" class="form-control form-control-sm" value="<?php echo $company['rep1']; ?>" readonly>
                    </div>
                    <div class="">
                        <input type="text" name="rep2" class="form-control form-control-sm" value="<?php echo $company['rep2']; ?>" readonly>
                    </div>
                </div>
            </div>
            <div class="col-2">
                <div class="form-group">
                    <label for="" class="col-form-label"><strong>Last Contact</strong></label>
                    <div class="row">
                        <label for="lastcontact_date" class="col-3 col-form-label-sm">Date</label>
                        <div class="col-9 mb-2">
                            <input type="date" name="lastcontact_date" class="form-control form-control-sm" value="<?php echo $company['lastcontact_date']; ?>" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <label for="lastcontact_type" class="col-3 col-form-label-sm">Type</label>
                        <div class="col-9">
                            <input type="text" name="lastcontact_type" class="form-control form-control-sm" value="<?php echo $company['lastcontact_type']; ?>" readonly>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                    <label for="" class="col-form-label"><strong>Links</strong></label>
                    <div class="row">
                        <label for="" class="col-2 col-form-label-sm">Projects</label>
                        <div class="col-10 mb-2 dropdown">
                            <div class="form-control form-control-sm">
                                <div class="row">
                                    <div class="col-10">See linked projects</div>
                                    <div class="col-2 ms-auto pe-2"><i class="fa fa-caret-down"></i></div>
                                </div>
                            </div>
                            <div class="dropdown-content col-10">
                                <?php foreach ($projects as $project) : ?>
                                    <a href="projects.single.php?id=<?php echo $project['id']; ?>"><?php echo $project['proj_name']; ?></a><br>
                                <?php endforeach; ?>
                            </div>   
                        </div>
                    </div>
                    <div class="row">
                        <label for="" class="col-2 col-form-label-sm">Leads</label>
                        <div class="col-10 mb-2 dropdown">
                            <div class="form-control form-control-sm">
                                <div class="row">
                                    <div class="col-10">See linked leads</div>
                                    <div class="col-2 ms-auto pe-2"><i class="fa fa-caret-down"></i></div>
                                </div>
                            </div>
                            <div class="dropdown-content col-10">
                                <?php foreach ($leads as $lead) : ?>
                                    <a href="leads.single.php?id=<?php echo $lead['id']; ?>"><?php echo $lead['firstname'].' '.$lead['lastname']; ?></a><br>
                                <?php endforeach; ?>
                            </div>   
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row py-2 mb-3 bg-light rounded" style="box-shadow: 2px 4px 4px #ddd;">
            <div class="col-3">
                <label for="" class="col-form-label"><strong>Address</strong></label>
                <div class="form-group row mb-2">
                    <label for="address_st" class="col-3 col-form-label-sm">Street</label>
                    <div class="col-9">
                        <input type="text" name="address_st" class="form-control form-control-sm" value="<?php echo $company['address_st']; ?>" readonly>
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label for="address_city" class="col-3 col-form-label-sm">City</label>
                    <div class="col-9">
                        <input type="text" name="address_city" class="form-control form-control-sm" value="<?php echo $company['address_city']; ?>" readonly>
                    </div>
                </div>               
                <div class="form-group row mb-2">
                    <label for="address_state" class="col-3 col-form-label-sm">State</label>
                    <div class="col-9">
                        <input type="text" name="address_state" class="form-control form-control-sm" value="<?php echo $company['address_state']; ?>" readonly>
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label for="address_country" class="col-3 col-form-label-sm">Country</label>
                    <div class="col-9">
                        <input type="text" name="address_country" class="form-control form-control-sm" value="<?php echo $company['address_country']; ?>" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="address_zip" class="col-3 col-form-label-sm">Zip</label>
                    <div class="col-9 mb-2">
                        <input type="text" name="address_zip" class="form-control form-control-sm" value="<?php echo $company['address_zip']; ?>" readonly>
                    </div>
                </div>
            </div>
            <div class="col-5">
                <div class="form-group">
                    <label for="notes" class="col-form-label"><strong>Company Notes</strong></label>
                    <div class="">
                        <textarea readonly name="notes" class="form-control form-control-sm" rows="8" ><?php echo $company['notes']; ?></textarea>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="row mb-1">
                    <div class="col-10">
                        <label class="pt-2"><strong>Company To-Dos</strong></label>
                    </div>
                    <div class="col-2 text-end">
                        <a href="todos.new.php?<?php echo "companyID=".$company['companyID']."&rep1=".$company['rep1']."&rep2=".$company['rep2']."&todo=Company"; ?>" class="btn btn-sm btn-secondary">+</a>
                    </div>
                </div>
                <div class="h-100 w-100 d-inline-block bg-white border rounded" style="overflow-y:scroll; overflow-x: hidden; max-height:11.5em;">
                    <div class="px-2 py-1">
                        <table class="table table-hover table-sm table-borderless" style="font-size:.85em;">
                            <?php foreach($todos as $todo) : ?>
                                <thead class="border-bottom">
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Priority</th>
                                        <th scope="col" style="padding-left:20px;">Due Date</th>
                                        <th scope="col">Time</th>
                                        <th scope="col">Progress</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr style="transform: rotate(0);">
                                        <th scope="row"><a href="todos.single.php?id=<?php echo $todo['id']; ?>" class="stretched-link"><?php echo $todo['id']; ?></a></th>
                                        <td>
                                            <div class="text-center" style="background:
                                                <?php 
                                                    if (preg_match('[5]', $todo['priority'])){echo '#41e169;';} 
                                                    elseif (preg_match('[4]', $todo['priority'])){echo '#62e082;';}
                                                    elseif (preg_match('[3]', $todo['priority'])){echo '#84e09b;';}
                                                    elseif (preg_match('[2]', $todo['priority'])){echo '#a6e0b4;';}
                                                    elseif (preg_match('[1]', $todo['priority'])){echo '#c7e0cd;';}
                                                    else {echo ";";}
                                                ?>; padding:3px; border-radius:20px;">
                                                <?php echo substr($todo['priority'], 3); ?>
                                            </div>
                                        </td>
                                        <td style="padding-left:20px;">
                                            <span style="font-weight:bold; <?php if($todo['due_at']>=date('Y-m-d') && $todo['done'] == 0){echo "color:green;";} elseif($todo['due_at']<date('Y-m-d') && $todo['done'] == 0) {echo "color:red;";} else {echo "";} ?>">
                                                <?php echo $todo['due_at']; ?>
                                            </span>
                                        </td>
                                        <td><?php echo $todo['est_time']-$todo['time_complete']; ?></td>
                                        <td>
                                            <div class="progress mt-1"  style="height: 10px;">
                                                <div class="progress-bar bg-warning" role="progressbar" style="width: <?php echo 100*($todo['time_complete'] / $todo['est_time']); ?>%">
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="border-bottom">
                                        <td colspan="5">
                                            <div class="mb-4" style="max-height:4em; overflow-y:hidden;">
                                                <?php echo $todo['details'];?>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            <?php endforeach; ?>  
                        </table>
                    </div>      
                </div>
            </div>
        </div>
        <div class="row mb-4">
            <div class="col-3">
                <div class="form-group">
                    <label for="created_at" class="col-form-label"><small>Record Creation</small></label>
                    <div>
                        <input type="text" name="created_at" class="form-control form-control-sm" value="<?php echo $company['created_at']; ?>" readonly>
                    </div>
                </div>
            </div>
            <div class="col-2">
                <div class="form-group">
                    <label for="created_by" class="col-form-label"><small>Creator</small></label>
                    <div>
                        <input type="text" name="created_by" class="form-control form-control-sm" value="<?php echo $company['created_by']; ?>" readonly>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <label for="modified_at" class="col-form-label"><small>Record Modified</small></label>
                    <div>
                        <input type="text" name="modified_at" class="form-control form-control-sm" value="<?php echo $company['modified_at']; ?>" readonly>
                    </div>
                </div>
            </div>
            <div class="col-2">
                <div class="form-group">
                    <label for="modified_by" class="col-form-label"><small>Modifier</small></label>
                    <div>
                        <input type="text" name="modified_by" class="form-control form-control-sm" value="<?php echo $company['modified_by']; ?>" readonly>
                    </div>
                </div>
            </div>
            <div class="col-2">
                <!-- MODAL:DELETE RECORD -->
                <div class="form-group text-end">
                    <label for="delete" class="col-form-label"><small>&nbsp;</small></label> 
                    <!-- Button trigger modal -->
                    <div>
                        <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">-</button>
                    </div>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteModalLabel">Are you sure you want to delete this record?</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="d-flex px-2">
                                    <input type="hidden" name="delete_id" value="<?php echo $company['companyID']; ?>">
                                    <input type="submit" name="delete" class="btn btn-sm btn-danger" value="Delete Record">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <!-- END DELETE MODAL -->
            </div>
        </div>
        
    </form>
</div>

<?php include 'inc/footer.inc.php'; ?>