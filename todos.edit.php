<?php
include 'inc/autoloader.inc.php'; include 'inc/config.inc.php';
include 'inc/header.inc.php'; include 'inc/nav.inc.php';

$object = new ViewToDos();
$todo = $object->showToDoEdit();
$project = $object->getProjectNote();
$object->enterProjectNoteEdit();

$state = $todo['done'];
$update = $object->enterToDoEdit($state); 
$object->executeDeleteToDo();

$object2 = new ViewSettings();
$reps = $object2->showReps();

?>

<div class="col-11 mx-auto">
    <br>
    <form method="POST" action="<?php ?>" class="mb-4">
        <div class="d-flex flex-row mt-3 mb-2">
            <div class="" style="margin:0px 20px 0px 0px;">
                <h4>Edit To-Do</h4>
            </div>
            <div class="px-2">
                <input type="hidden" name="update_id" value="<?php echo $todo['id']; ?>">
                <button type="submit" name="submit" class="btn btn-sm btn-success">Submit</button>
            </div>   
        </div>
        <div class="row">
            <div class="col-8">
                <div class="row py-2 mb-3 bg-light rounded" style="box-shadow: 2px 4px 4px #ddd;">
                    <div class="col-3">
                        <div class="form-group">
                            <label for="rep1" class="col-form-label"><strong>Sales Rep 1</strong></label>
                            <div class="mb-2">
                                <select id="rep1" name="rep1" size="1" class="form-select form-select-sm" >
                                    <option value="<?php echo $todo['rep1']; ?>"><strong>Current: <?php echo $todo['rep1']; ?></strong></option>
                                    <option value="">----------------</option>
                                    <?php foreach($reps as $rep) : ?>
                                        <option value="<?php echo $rep['full_name']; ?>"><?php echo $rep['full_name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="rep2" class="col-form-label"><strong>Sales Rep 2</strong></label>
                            <div class="mb-2">
                                <select id="rep2" name="rep2" size="1" class="form-select form-select-sm" >
                                    <option value="<?php echo $todo['rep2']; ?>"><strong>Current: <?php echo $todo['rep2']; ?></strong></option>
                                    <option value="">----------------</option>
                                    <?php foreach($reps as $rep) : ?>
                                        <option value="<?php echo $rep['full_name']; ?>"><?php echo $rep['full_name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="category" class="col-form-label"><strong>Category</strong></label>
                            <div class="">
                                <select id="category" name="category" size="1" class="form-select form-select-sm" >
                                    <option value="<?php echo $todo['category']; ?>"><?php echo $todo['category']; ?></option>
                                    <option value=""></option>
                                    <option value="Pre-Contact Lead">Pre-Contact Lead</option>
                                    <option value="Post-Contact Lead">Post-Contact Lead</option>
                                    <option value="Tribunal">Tribunal</option>
                                    <option value="Project">Project</option>
                                    <option value="Company">Company</option>
                                    <option value="Research">Research</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="form-group">
                            <label for="priority" class="col-form-label"><strong>Priority</strong></label>
                            <div class="mb-2">
                                <select id="priority" name="priority" size="1" class="form-select form-select-sm">
                                    <option value="<?php echo $todo['priority']; ?>"><strong>Current: <?php echo substr($todo['priority'],3); ?></strong></option>
                                    <option value="">----------------</option>
                                    <option value="5: High">High</option>
                                    <option value="4: Med-High">Med-High</option>
                                    <option value="3: Med">Med</option>
                                    <option value="2: Med-Low">Med-Low</option>
                                    <option value="1: Low">Low</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-1">
                        <div class="form-group">
                            <label for="done" class="col-form-label"><strong>Done</strong></label>
                        </div>
                        <div class="ms-2">
                            <input type="checkbox" name="done" class="form-check-input" value="<?php echo $todo['done']; ?>" aria-label="..." <?php if ($todo['done'] == 1) echo "checked='checked'"; ?>>
                        </div>
                    </div>
                </div>
                <div class="row py-2 mb-3 bg-light rounded" style="box-shadow: 2px 4px 4px #ddd;">
                    <div class="col-3">
                        <div class="form-group">
                            <label for="due_at" class="col-form-label"><strong>Due Date</strong></label>
                            <div class="">
                                <input type="date" name="due_at" class="form-control form-control-sm" value="<?php echo $todo['due_at']; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="done_at" class="col-form-label"><strong>Done Date</strong></label>
                            <div class="">
                                <input type="date" name="done_at" class="form-control form-control-sm" value="<?php echo $todo['done_at']; ?>" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="form-group">
                            <label for="est_time" class="col-form-label"><strong>Est.Time (h)</strong></label>
                            <div class="">
                                <input type="text" name="est_time" class="form-control form-control-sm" value="<?php echo $todo['est_time']; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="form-group">
                            <label for="time_complete" class="col-form-label"><strong>Time Done (h)</strong></label>
                            <div class="">
                                <input type="text" name="time_complete" class="form-control form-control-sm" value="<?php echo $todo['time_complete']; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="form-group">
                            <label for="time_complete" class="col-form-label"><strong>Progress</strong></label>
                            <div class="progress mb-2" style="height:30px;">
                                <div class="progress-bar bg-warning" role="progressbar" style="width: <?php echo 100*($todo['time_complete'] / $todo['est_time']); ?>%" aria-valuenow="<?php echo 100*($todo['time_complete'] / $todo['est_time']); ?>" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row py-2 mb-3 bg-light rounded" style="box-shadow: 2px 4px 4px #ddd;">
                    <div class="col-10">
                        <div class="form-group">
                            <label for="details" class="col-form-label"><strong>Description</strong></label>
                            <div class="">
                                <textarea name="details" class="form-control form-control-sm" rows="6"><?php echo $todo['details']; ?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-2">
                        <label for="" class="col-form-label"><strong>IDs</strong></label>
                        <div class="form-group row">
                            <label for="id" class="col-7 col-form-label">To-Do</label>
                            <div class="col-5">
                                <input type="text" name="id" class="form-control form-control-sm" value="<?php echo $todo['id']; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="companyID" class="col-7 col-form-label">Company</label>
                            <div class="col-5">
                                <input type="text" name="companyID" class="form-control form-control-sm" value="<?php echo $todo['companyID']; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="projectID" class="col-7 col-form-label">Project</label>
                            <div class="col-5">
                                <input type="text" name="projectID" class="form-control form-control-sm" value="<?php echo $todo['projectID']; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="leadID" class="col-7 col-form-label">Lead</label>
                            <div class="col-5">
                                <input type="text" name="leadID" class="form-control form-control-sm" value="<?php echo $todo['leadID']; ?>">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row pb-2 mb-2">
                    <div class="col-3">
                        <div class="form-group">
                            <label for="created_at" class="col-form-label"><strong>Record Creation</strong></label>
                            <div class="mb-2">
                                <input type="text" name="created_at" class="form-control form-control-sm" value="<?php echo $todo['created_at']; ?>" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="form-group">
                            <label for="created_by" class="col-form-label"><strong>Creator</strong></label>
                            <div class="mb-2">
                                <input type="text" name="created_by" class="form-control form-control-sm" value="<?php echo $todo['created_by']; ?>" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="modified_at" class="col-form-label"><strong>Record Modified</strong></label>
                            <div class="mb-2">
                                <input type="text" name="modified_at" class="form-control form-control-sm" value="<?php echo $todo['modified_at']; ?>" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="form-group">
                            <label for="modified_by" class="col-form-label"><strong>Modifier</strong></label>
                            <div class="mb-2">
                                <input type="text" name="modified_by" class="form-control form-control-sm" value="<?php echo $todo['modified_by']; ?>" readonly>
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
                                                <input type="hidden" name="delete_id" value="<?php echo $todo['id']; ?>">
                                                <input type="submit" name="delete" class="btn btn-sm btn-danger" value="Delete Record">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <!-- END DELETE MODAL -->
                    </div>
                </div>
            </div>
            <div class="col-4">
                <?php if($todo['category'] == 'Pre-Contact Lead') : ?>
                    <div class="ms-2 px-3 pt-2 pb-3 rounded" style="background:#76FFC8; box-shadow: 0px 4px 8px #ddd;">
                        <label class="col-form-label" style="font-size: 1.2em;"><strong>Pre-Contact Lead Follow-Up</strong></label>
                            <div class="form-group row">
                                <div class="col-3">
                                    <label for="process" class="col-form-label-sm"><strong>Process</strong></label>
                                </div>
                                <div class="col-9 mb-2">
                                    <input type="text" name="process" class="form-control form-control-sm bg-white" style="border-color:mediumspringgreen;" value="<?php echo $todo['prefup_process']; ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-3">
                                    <label for="title" class="col-form-label-sm"><strong>Step</strong></label>
                                </div>
                                <div class="col-9 mb-2">
                                    <input type="text" name="title" class="form-control form-control-sm bg-white" style="border-color:mediumspringgreen;" value="<?php echo $todo['title']; ?>" readonly>
                                </div>
                            </div>
                        <div class="row">
                            <div class="form-group">
                                <label for="prefup_email_subject" class="col-form-label-sm"><strong>Email Subject Line</strong></label>
                                <div class="mb-2">
                                    <input type="text" name="prefup_email_subject" class="form-control form-control-sm bg-white" style="border-color:mediumspringgreen;" value="<?php echo $todo['prefup_email_subject']; ?>" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label for="prefup_email_body" class="col-form-label-sm"><strong>Script</strong></label>
                                <div class="">
                                    <textarea class="form-control form-control-sm bg-white" name="prefup_email_body" id="prefup_email_body" cols="50" rows="8" readonly style="border-color:mediumspringgreen;"><?php echo $todo['prefup_email_body']; ?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                <?php if($todo['category'] == 'Tribunal') : ?>
                    <div class="ms-2 px-3 pt-2 pb-4 rounded" style="color:white; background:royalblue; box-shadow: 0px 4px 8px #ddd;"><!-- row pb-4 pt-2 mb-3 rounded -->
                        <label class="col-form-label" style="font-size:1.2em;"><strong>Tribunal</strong></label>
                        <div class="form-group row mb-2">
                            <div class="col-3">
                                <label for="presider_1" class="col-form-label-sm">Presider 1</label>
                            </div>
                            <div class="col-9">
                                <select id="presider_1" name="presider_1" size="1" class="form-select form-select-sm" style="border-color:mediumturquoise;">
                                    <option value="<?php echo $todo['presider_1']; ?>"><strong>Current: <?php echo $todo['presider_1']; ?></strong></option>
                                    <option value="">----------------</option>
                                    <?php foreach($reps as $rep) : ?>
                                        <option value="<?php echo $rep['full_name']; ?>"><?php echo $rep['full_name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <div class="col-3">
                                <label for="presider_2" class="col-form-label-sm">Presider 2</label>
                            </div>
                            <div class="col-9">
                                <select id="presider_2" name="presider_2" size="1" class="form-select form-select-sm" style="border-color:mediumturquoise;">
                                    <option value="<?php echo $todo['presider_2']; ?>"><strong>Current: <?php echo $todo['presider_2']; ?></strong></option>
                                    <option value="">----------------</option>
                                    <?php foreach($reps as $rep) : ?>
                                        <option value="<?php echo $rep['full_name']; ?>"><?php echo $rep['full_name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <div class="col-3">
                                <label for="timer" class="col-form-label-sm">Timer</label>
                            </div>
                            <div class="col-3">
                                <input type="button" id="timer" name="timer" class="btn btn-sm" style="background-color:aquamarine;" value="Start Timer" readonly>
                            </div>
                            <div class="col-3">
                                <small></small>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="notes" class="col-form-label-sm">Project Notes</label>
                            <textarea name="notes" class="form-control form-control-sm bg-white" rows="8" style="border-color:mediumturquoise;"><?php echo $project['notes']; ?></textarea>
                            <!-- Need logic to enter the edit into database -->
                        </div>
                    </div>
                <?php elseif($todo['category'] != 'Tribunal') : ?>
                    <input type="hidden" name="presider_1" value="<?php echo $todo['presider_1']; ?>">
                    <input type="hidden" name="presider_2" value="<?php echo $todo['presider_2']; ?>">
                <?php endif; ?>
            </div>
        </div>
    </form>
</div>

<?php include 'inc/footer.inc.php'; ?>