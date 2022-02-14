<?php
include 'inc/autoloader.inc.php';
include 'inc/config.inc.php';
include 'inc/header.inc.php';
include 'inc/nav.inc.php';

$create = new ViewToDos();
$create->createNewToDo();

$object2 = new ViewSettings();
$reps = $object2->showReps();

?>

<div class="col-11 mx-auto">
    <br>
    <form method="POST" action="" class="mb-4">
        <div class="d-flex flex-row mt-3 mb-2">
            <div class="" style="margin:0px 20px 0px 0px;">
                <h4>Create a New To-Do</h4>
            </div>
            <div class="px-2">
                <button type="submit" name="submit" class="btn btn-sm btn-primary">Submit</button>
            </div>
        </div>
        <div class="col-8">
            <div class="row py-2 mb-3 bg-light rounded" style="box-shadow: 2px 4px 4px #ddd;">
                <div class="col-3">
                    <div class="form-group">
                        <label for="rep1" class="col-form-label"><strong>Sales Rep 1</strong></label>
                        <div class="mb-2">
                            <select id="rep1" name="rep1" size="1" class="form-select form-select-sm" >
                                <option value="<?php if(empty($_GET['rep1'])){ echo "";} else {echo $_GET['rep1']; }?>">
                                    <?php if(empty($_GET['rep1'])){ echo "Select Main";} else {echo $_GET['rep1']; } ?>
                                </option>
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
                                <option value="<?php if(empty($_GET['rep1'])){ echo "";} else {echo $_GET['rep1']; } ?>">
                                    <?php if(empty($_GET['rep2'])){ echo "Select 2nd";} elseif($_GET['rep2'] != ""){echo $_GET['rep2']; } else {echo "Select 2nd";}?>
                                </option>
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
                            <select id="category" name="category" size="1" class="form-select form-select-sm">
                                <option value="<?php if(empty($_GET['todo'])){echo "";} else {echo $_GET['todo']; } ?>">
                                    <?php if(empty($_GET['todo'])){echo "Select Category";} else {echo $_GET['todo']; } ?>
                                </option>
                                <option value="">------------</option>
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
                            <select id="priority" name="priority" size="1" class="form-select form-select-sm" >
                                <option value=""></option>
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
                        <input type="checkbox" name="done" class="form-check-input" value="" aria-label="...">
                    </div>
                </div>
                
            </div>
            <div class="row py-2 mb-3 bg-light rounded" style="box-shadow: 2px 4px 4px #ddd;">
                <div class="col-3">
                    <div class="form-group">
                        <label for="due_at" class="col-form-label"><strong>Due Date</strong></label>
                        <div class="">
                            <input type="date" name="due_at" class="form-control form-control-sm" placeholder="" required>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        <label for="done_at" class="col-form-label"><strong>Done Date</strong></label>
                        <div class="">
                            <input type="date" name="done_at" class="form-control form-control-sm" readonly>
                        </div>
                    </div>
                </div>   
                <div class="col-2">
                    <div class="form-group">
                        <label for="est_time" class="col-form-label"><strong>Est.Time (h)</strong></label>
                        <div class="">
                            <input type="text" name="est_time" class="form-control form-control-sm">
                        </div>
                    </div>
                </div>
                <div class="col-2">
                    <div class="form-group">
                        <label for="time_complete" class="col-form-label"><strong>Time Done (h)</strong></label>
                        <div class="">
                            <input type="text" name="time_complete" class="form-control form-control-sm">
                        </div>
                    </div>
                </div>
                <div class="col-2">
                    <div class="form-group">
                        <label for="progress" class="col-form-label"><strong>Progress</strong></label>
                        <div class="progress" style="height:30px;">
                            <div class="progress-bar bg-warning" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row py-2 mb-3 bg-light rounded" style="box-shadow: 2px 4px 4px #ddd;">
                <div class="col-10">
                    <div class="form-group">
                        <label for="details" class="col-form-label"><strong>Description</strong></label>
                        <div class="">
                            <textarea name="details" class="form-control form-control-sm" rows="6" placeholder=""></textarea>
                        </div>
                    </div>
                </div>
                <div class="col-2">
                    <label for="" class="col-form-label"><strong>IDs</strong></label>
                    <div class="form-group row">
                        <label for="id" class="col-7 col-form-label">To-Do</label>
                        <div class="col-5">
                            <input type="text" name="id" class="form-control form-control-sm" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="companyID" class="col-7 col-form-label">Company</label>
                        <div class="col-5">
                            <input type="text" name="companyID" class="form-control form-control-sm" value="<?php if(isset($_GET['companyID'])){echo $_GET['companyID']; } else {echo "";}?>" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="projectID" class="col-7 col-form-label">Project</label>
                        <div class="col-5">
                            <input type="text" name="projectID" class="form-control form-control-sm" value="<?php if(isset($_GET['projectID'])){echo $_GET['projectID']; } else {echo "";}?>" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="leadID" class="col-7 col-form-label">Lead</label>
                        <div class="col-5">
                            <input type="text" name="leadID" class="form-control form-control-sm" value="<?php if(isset($_GET['leadID'])){echo $_GET['leadID']; } else {echo "";}?>" readonly>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row pb-3 mb-2">
                <div class="col-3">
                    <div class="form-group">
                        <label for="created_at" class="col-form-label"><strong>Record Creation</strong></label>
                        <div class="mb-2">
                            <input type="text" name="created_at" class="form-control form-control-sm" readonly>
                        </div>
                    </div>
                </div>
                <div class="col-2">
                    <div class="form-group">
                        <label for="created_by" class="col-form-label"><strong>Creator</strong></label>
                        <div class="mb-2">
                            <input type="text" name="created_by" class="form-control form-control-sm" readonly>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        <label for="modified_at" class="col-form-label"><strong>Record Modified</strong></label>
                        <div class="mb-2">
                            <input type="text" name="modified_at" class="form-control form-control-sm" readonly>
                        </div>
                    </div>
                </div>
                <div class="col-2">
                    <div class="form-group">
                        <label for="modified_by" class="col-form-label"><strong>Modifier</strong></label>
                        <div class="mb-2">
                            <input type="text" name="modified_by" class="form-control form-control-sm" readonly>
                        </div>
                    </div>
                </div>
                <div class="col-2"></div>
            </div>
        </div>
    </form>
</div>

<?php include 'inc/footer.inc.php'; ?>