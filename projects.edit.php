<?php
include 'inc/autoloader.inc.php';
include 'inc/config.inc.php';
include 'inc/header.inc.php';
include 'inc/nav.inc.php';

$object2 = new ViewSettings();
$reps = $object2->showReps();
$apr_adjust = $object2->showProjectThresh();
    $thresh = $apr_adjust['thresh_value'];
    $calc_adjust = $apr_adjust['calc_adjust'];

$object = new ViewProjects();
$project = $object->showProjectEdit();
$query = $object->showTribunalToDo();
if(empty($query)){$state=0;}else{$state=1;}

$update = $object->enterProjectEdit($thresh, $calc_adjust, $state);

$object->executeDeleteProject();

?>

<div class="col-11 mx-auto">
    <br>
    <!-- <h4 class="mb-4">Lead</h4> -->
    <form method="POST" action="" class="mb-4">
        <div class="d-flex flex-row mt-3 mb-2">
            <div class="" style="margin:0px 20px 0px 0px;">
                <h4>Edit Project</h4>
            </div>
            <div class="px-2">
                <input type="hidden" name="update_id" value="<?php echo $project['id']; ?>">
                <button type="submit" name="submit" class="btn btn-sm btn-success">Submit</button>
            </div>
        </div>
        <div class="row py-2 mb-3 bg-light rounded" style="box-shadow: 2px 4px 4px #ddd;">
            <div class="col-3">
                <div class="form-group">
                    <label for="proj_name" class="col-form-label"><strong>Project</strong></label>
                    <div class="">
                        <input type="text" name="proj_name" class="form-control form-control-sm" value="<?php echo $project['proj_name']; ?>">
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <label for="co_name" class="col-form-label"><strong>Company</strong></label>
                    <div class="">
                        <input type="text" name="co_name" class="form-control form-control-sm" value="<?php echo $project['co_name']; ?>">
                    </div>
                </div>
            </div>
            <div class="col-2">
                <div class="form-group">
                    <label for="project_status" class="col-form-label"><strong>Status</strong></label>
                    <div class="">
                        <select id="project_status" name="project_status" size="1" class="form-select form-select-sm" >
                            <option value="<?php echo $project['project_status']; ?>">Current: <?php echo $project['project_status']; ?></option>
                            <option value="">------------</option>
                            <option value="Active">Active</option>
                            <option value="On Hold">On Hold</option>
                            <option value="Dead">Dead</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-2">
                <div class="form-group">
                    <label for="linkedleads" class="col-form-label"><strong>Linked Leads</strong></label>
                    <div class="">
                        <input type="text" name="linkedleads" class="form-control form-control-sm" readonly>
                    </div>
                </div>
            </div> 
            <div class="col-1">
                <div class="form-group" ><!-- LINK TO COMPANY   --> 
                    <label for="companyID" class="col-form-label"><strong>Comp. ID</strong></label>
                    <div class="">
                        <input id="companyID" type="text" name="companyID" class="form-control form-control-sm" value="<?php echo $project['companyID']; ?>" readonly>
                    </div>
                </div>
            </div>
            <div class="col-1">
                <div class="form-group" >   
                    <label for="id" class="col-form-label"><strong>Proj. ID</strong></label>
                    <div class="mb-2">
                        <input type="text" name="id" class="form-control form-control-sm" value="<?php echo $project['id']; ?>" readonly>
                    </div>
                </div>
            </div>
        </div>
        <div class="row py-2 mb-3 bg-light rounded" style="box-shadow: 2px 4px 4px #ddd;">
            <div class="col-2">
                <div class="form-group">
                    <label for="website1" class="col-form-label"><strong>Websites</strong></label>
                    <div class="mb-2">
                        <input type="text" name="website1" class="form-control form-control-sm" value="<?php echo $project['website1']; ?>" placeholder="Enter full URL">
                    </div>
                    <div class="mb-2">
                        <input type="text" name="website2" class="form-control form-control-sm" value="<?php echo $project['website2']; ?>" placeholder="Enter full URL">
                    </div>
                </div>
            </div>
            <div class="col-2">
                <div class="form-group">
                    <label for="rep1" class="col-form-label"><strong>Sales Reps</strong></label>
                    <div class="mb-2">
                        <select id="rep1" name="rep1" size="1" class="form-select form-select-sm" >
                            <option value="<?php echo $project['rep1']; ?>"><strong>Current: <?php echo $project['rep1']; ?></strong></option>
                            <option value="">----------------</option>
                            <?php foreach($reps as $rep) : ?>
                                <option value="<?php echo $rep['full_name']; ?>"><?php echo $rep['full_name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="">
                        <select id="rep2" name="rep2" size="1" class="form-select form-select-sm" >
                            <option value="<?php echo $project['rep2']; ?>"><strong>Current: <?php echo $project['rep2']; ?></strong></option>
                            <option value="">----------------</option>
                            <?php foreach($reps as $rep) : ?>
                                <option value="<?php echo $rep['full_name']; ?>"><?php echo $rep['full_name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-2">
                <div class="form-group">
                    <label for="" class="col-form-label"><strong>Last Contact</strong></label>
                    <div class="row">
                        <label for="lastcontact_date" class="col-3 col-form-label-sm">Date</label>
                        <div class="col-9 mb-2">
                            <input type="date" name="lastcontact_date" class="form-control form-control-sm" value="<?php echo $project['lastcontact_date']; ?>" >
                        </div>
                    </div>
                    <div class="row">
                        <label for="lastcontact_type" class="col-3 col-form-label-sm">Type</label>
                        <div class="col-9">
                            <select id="lastcontact_type" name="lastcontact_type" size="1" class="form-select form-select-sm" >
                                <option value="<?php echo $project['lastcontact_type']; ?>">Current: <?php echo $project['lastcontact_type']; ?></option>
                                <option value="">------------</option>
                                <option value="Email">Email</option>
                                <option value="Phone">Phone</option>
                                <option value="Voicemail">Voicemail</option>
                                <option value="In-Person">In-Person</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-2">
                <div class="form-group">
                    <label for="attn_priority" class="col-form-label"><strong>Attn Priority Rating</strong></label>
                    <input type="text" name="attn_priority" class="form-control form-control-sm" value="<?php echo $project['attn_priority']; ?>" readonly>
                </div>
            </div>
            <div class="col-4">
                <div class="row mb-1">
                    <label class="pt-2"><strong>Tribunal To-Dos</strong></label>
                </div>
                <div class="h-75 w-100 d-inline-block bg-light border rounded" style="max-height:4.5em;">
                    <div class="px-2 py-1">   
                    </div>      
                </div>
            </div>
        </div>
        <div class="row py-2 mb-3 bg-light rounded" style="box-shadow: 2px 4px 4px #ddd;">
            <div class="col-4">
                <label for="" class="col-form-label"><strong>Tribunal Calculation</strong></label>
                <div class="form-group row mb-2">
                    <label for="units_annual" class="col-7 col-form-label-sm">Annual Volume (# Units/Yr)</label>
                    <div class="col-5">
                        <input type="text" name="units_annual" class="form-control form-control-sm" value="<?php echo $project['units_annual']; ?>" >
                    </div>
                </div>             
                <div class="form-group row mb-2">
                    <label for="stage" class="col-7 col-form-label-sm">Sales Stage</label>
                    <div class="col-5">
                        <select id="stage" name="stage" size="1" class="form-select form-select-sm" >
                            <option value="<?php echo $project['stage']; ?>"><strong>Current value: <?php echo $project['stage']; ?></strong></option>
                            <option value="">----------------</option>
                            <option value="1">1: First call</option>
                            <option value="2">2: Second call</option>
                            <option value="3">3: Obtained demo unit(s)</option>
                            <option value="4">4: Testing/integration</option>
                            <option value="5">5: Production</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label for="odds_win" class="col-7 col-form-label-sm">Odds of Win (%)</label>
                    <div class="col-5">
                        <input type="text" name="odds_win" class="form-control form-control-sm" value="<?php echo $project['odds_win']; ?>" >
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label for="chance_success" class="col-7 col-form-label-sm">Chance of Field Success (%)</label>
                    <div class="col-5">
                        <input type="text" name="chance_success" class="form-control form-control-sm" value="<?php echo $project['chance_success']; ?>" >
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label for="rev_high_annual" class="col-7 col-form-label-sm">High-End Rev/Yr ($)</label>
                    <div class="col-5">
                        <input type="text" name="rev_high_annual" class="form-control form-control-sm" value="<?php echo $project['rev_high_annual']; ?>" >
                    </div>
                </div>
                <div class="form-group row">
                    <label for="rev_low_annual" class="col-7 col-form-label-sm">Low-End Rev/Yr ($)</label>
                    <div class="col-5 mb-2">
                        <input type="text" name="rev_low_annual" class="form-control form-control-sm" value="<?php echo $project['rev_low_annual']; ?>" >
                    </div>
                </div>                
            </div>
            <div class="col-4">
                <div class="form-group">
                    <label for="notes" class="col-form-label"><strong>Project Notes</strong></label>
                    <div class="">
                        <textarea name="notes" class="form-control form-control-sm" rows="10" ><?php echo $project['notes']; ?></textarea>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="row mb-1">
                    <div class="col-10">
                        <label class="pt-2"><strong>Project To-Dos</strong></label>
                    </div>
                    <div class="col-2 text-end">
                    </div>
                </div>
                <div class="h-100 w-100 d-inline-block bg-light border rounded" style="overflow-y:scroll; overflow-x: hidden; max-height:14em;">
                    <div class="px-2 py-1">
                    </div>      
                </div>
            </div>
        </div>
        <div class="row mb-4">
            <div class="col-3">
                <div class="form-group">
                    <label for="created_at" class="col-form-label"><small>Record Creation</small></label>
                    <div>
                        <input type="text" name="created_at" class="form-control form-control-sm" value="<?php echo $project['created_at']; ?>" readonly>
                    </div>
                </div>
            </div>
            <div class="col-2">
                <div class="form-group">
                    <label for="created_by" class="col-form-label"><small>Creator</small></label>
                    <div>
                        <input type="text" name="created_by" class="form-control form-control-sm" value="<?php echo $project['created_by']; ?>" readonly>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <label for="modified_at" class="col-form-label"><small>Record Modified</small></label>
                    <div>
                        <input type="text" name="modified_at" class="form-control form-control-sm" value="<?php echo $project['modified_at']; ?>" readonly>
                    </div>
                </div>
            </div>
            <div class="col-2">
                <div class="form-group">
                    <label for="modified_by" class="col-form-label"><small>Modifier</small></label>
                    <div>
                        <input type="text" name="modified_by" class="form-control form-control-sm" value="<?php echo $project['modified_by']; ?>" readonly>
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
                                        <input type="hidden" name="delete_id" value="<?php echo $project['id']; ?>">
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