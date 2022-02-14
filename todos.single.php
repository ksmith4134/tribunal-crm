<?php
include 'inc/autoloader.inc.php';
include 'inc/config.inc.php';
include 'inc/header.inc.php';
include 'inc/nav.inc.php';

$object = new ViewToDos();
$todo = $object->showToDoEdit();
$object->executeDeleteToDo();
$next = $object->nextHigherToDo();
$prev = $object->nextLowerToDo();

$project = $object->getProjectNote();

?>

<script>//Create Link to Project
    function checkbox(bool){
        if(bool.length == 0){
            document.getElementById('done').innerHTML = '';
        } else {
            //AJAX Request
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function(){
                if(this.readyState == 4 && this.status ==200){
                    document.getElementById('done').innerHTML = this.responseText;
                }
            }
            xmlhttp.open("GET", "checkbox.php?id=<?php echo $todo['id']; ?>&checkbox="+bool, true);
            xmlhttp.send();
        } window.location.reload(true);
    }
</script>

<script>
    function countdownTimer(){
        var countDownDate = new Date().getTime() + 15 * 60 * 1000;
        var x = setInterval(function() {
            var now = new Date().getTime();
            var distance = countDownDate - now;
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);
            document.getElementById("timer").innerHTML = minutes + "m " + seconds + "s ";
            if (distance < 0) {
                clearInterval(x);
                document.getElementById("timer").innerHTML = "Tribunal Done!";
            }
        }, 1000);
    }
</script>

<div class="col-11 mx-auto">
    <br>
    <!-- <h3 class="mb-4">todo</h3> -->
    <form method="POST" action="" class="mb-4">
        <div class="d-flex flex-row mt-3 mb-2">
            <div class="" style="margin:0px 20px 0px 0px;">
                <h4><span style="color:#4169E1; font-weight:bold;">To-Do Owner </span><?php echo $todo['rep1']; ?></h4>
            </div>
            <div class="px-2 ms-auto">
                <a href="<?php echo ROOT_URL; ?>todos.edit.php?id=<?php echo $todo['id']; ?>" class="btn btn-sm btn-warning">Edit</a>
            </div>
            <div class="px-2">
                <a href="<?php echo ROOT_URL.'todos.php'; ?>" class="btn btn-sm btn-primary">List View</a>
            </div>
            <div class="px-2">
                <a href="<?php echo ROOT_URL; ?>todos.single.php?id=<?php echo $prev['id']; ?>" class="btn btn-sm btn-outline-dark"><</a>
                <a href="<?php echo ROOT_URL; ?>todos.single.php?id=<?php echo $next['id']; ?>" class="btn btn-sm btn-outline-dark">></a>
            </div>
        </div>
        <div class="row">
            <div class="col-8">
                <div class="row py-2 mb-3 bg-light rounded" style="box-shadow: 2px 4px 4px #ddd;">
                    <div class="col-3">
                        <div class="form-group">
                            <label for="rep1" class="col-form-label"><strong>Sales Rep 1</strong></label>
                            <div class="mb-2">
                                <input type="text" name="rep1" class="form-control form-control-sm" value="<?php echo $todo['rep1']; ?>" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="rep2" class="col-form-label"><strong>Sales Rep 2</strong></label>
                            <div class="mb-2">
                                <input type="text" name="rep2" class="form-control form-control-sm" value="<?php echo $todo['rep2']; ?>" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="category" class="col-form-label"><strong>Category</strong></label>
                            <div class="">
                                <input type="text" name="category" class="form-control form-control-sm" value="<?php echo $todo['category']; ?>" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="form-group">
                            <label for="priority" class="col-form-label"><strong>Priority</strong></label>
                            <div>
                                <input type="text" name="priority" class="form-control form-control-sm text-center" value="<?php echo substr($todo['priority'],3); ?>" style="border-radius:20px; background:
                                    <?php 
                                        if (preg_match('[5]', $todo['priority'])){echo '#41e169;';} 
                                        elseif (preg_match('[4]', $todo['priority'])){echo '#62e082;';}
                                        elseif (preg_match('[3]', $todo['priority'])){echo '#84e09b;';}
                                        elseif (preg_match('[2]', $todo['priority'])){echo '#a6e0b4;';}
                                        elseif (preg_match('[1]', $todo['priority'])){echo '#c7e0cd;';}
                                        else {echo ";";}
                                    ?>; font-weight:bold; border:none;" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="col-1">
                        <div class="form-group">
                            <label for="done" class="col-form-label"><strong>Done</strong></label>
                        </div>
                        <div class="ms-2">
                            <input id="done" onclick="checkbox(this.value)" type="checkbox" name="done" class="form-check-input" value="<?php echo $todo['done']; ?>" <?php if ($todo['done'] == 1) echo "checked"; ?>>
                        </div>
                    </div>
                </div>
                <div class="row py-2 mb-3 bg-light rounded" style="box-shadow: 2px 4px 4px #ddd;">
                    <div class="col-3">
                        <div class="form-group mb-2">
                            <label for="due_at" class="col-form-label"><strong>Due Date</strong></label>
                            <input type="date" name="due_at" class="form-control form-control-sm" value="<?php echo $todo['due_at']; ?>" readonly style="<?php if($todo['due_at']>=date('Y-m-d') && $todo['done'] == 0){echo "color:green;";} elseif($todo['due_at']<date('Y-m-d') && $todo['done'] == 0) {echo "color:red;";} else {echo "";} ?>">
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
                                <input type="text" name="est_time" class="form-control form-control-sm" value="<?php echo $todo['est_time']; ?>" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="form-group">
                            <label for="time_complete" class="col-form-label"><strong>Time Done (h)</strong></label>
                            <div class="">
                                <input type="text" name="time_complete" class="form-control form-control-sm" value="<?php echo $todo['time_complete']; ?>" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="form-group">
                            <label for="progress" class="col-form-label"><strong>Progress</strong></label>
                            <div class="progress" style="height:30px;">
                                <div class="progress-bar bg-warning" role="progressbar" style="width: <?php echo 100*($todo['time_complete'] / $todo['est_time']); ?>%" aria-valuenow="<?php echo 100*($todo['time_complete'] / $todo['est_time']); ?>" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row py-2 mb-3 bg-light rounded" style="box-shadow: 2px 4px 4px #ddd;">
                    <div class="col-8">
                        <div class="form-group">
                            <label for="details" class="col-form-label"><strong>Description</strong></label>
                            <div class="">
                                <textarea name="details" class="form-control form-control-sm" rows="6" readonly><?php echo $todo['details']; ?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <label for="" class="col-form-label"><strong>IDs</strong></label>
                        <div class="form-group row">
                            <div class="col-6">
                                <label for="id" class="col-7 col-form-label">To-Do</label>
                            </div>
                            <div class="col-4">
                                <input type="text" name="id" class="form-control form-control-sm" value="<?php echo $todo['id']; ?>" readonly>
                            </div>
                            <div class="col-2"></div>
                        </div>
                        <div class="form-group row">
                            <div class="col-6">
                                <label for="companyID" class="col-7 col-form-label">Company</label>
                            </div>
                            <div class="col-4">
                                <input type="text" name="companyID" class="form-control form-control-sm" value="<?php echo $todo['companyID']; ?>" readonly>
                            </div>
                            <div class="col-2">
                                <?php if($todo['companyID'] > 0) : ?>
                                    <a href="companies.single.php?companyID=<?php echo $todo['companyID']; ?>"><span style="font-size: 1.2em; color:royalblue;"><i class="fas fa-arrow-right"></i></span></i></a>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-6">
                                <label for="projectID" class="col-7 col-form-label">Project</label>
                            </div>
                            <div class="col-4">
                                <input type="text" name="projectID" class="form-control form-control-sm" value="<?php echo $todo['projectID']; ?>" readonly>
                            </div>
                            <div class="col-2">
                                <?php if($todo['projectID'] > 0) : ?>
                                    <a href="projects.single.php?id=<?php echo $todo['projectID']; ?>"><span style="font-size: 1.2em; color:royalblue;"><i class="fas fa-arrow-right"></i></span></i></a>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-6">
                                <label for="leadID" class="col-form-label">Lead</label>
                            </div>
                            <div class="col-4">
                                <input type="text" name="leadID" class="col-4 form-control form-control-sm" value="<?php echo $todo['leadID']; ?>" readonly>
                            </div>
                            <div class="col-2">
                                <?php if($todo['leadID'] > 0) : ?>
                                    <a href="leads.single.php?id=<?php echo $todo['leadID']; ?>"><span style="font-size: 1.2em; color:royalblue;"><i class="fas fa-arrow-right"></i></span></i></a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row pb-3 mb-2 rounded">
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
                    <div class="ms-2 px-3 pt-2 pb-3 rounded" style="background-image:linear-gradient(135deg, #76FFC8, #00FF94); box-shadow: 0px 4px 8px #ddd;">
                        <label class="col-form-label" style="font-size:1.2em;"><strong>Pre-Contact Lead Follow-Up</strong></label>
                            <div class="form-group row">
                                <div class="col-3">
                                    <label for="process" class="col-form-label-sm">Process</label>
                                </div>
                                <div class="col-9 mb-2">
                                    <input type="text" name="process" class="form-control form-control-sm bg-white" style="border-color:mediumspringgreen;" value="<?php echo $todo['prefup_process']; ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-3">
                                    <label for="title" class="col-form-label-sm">Step</label>
                                </div>
                                <div class="col-9 mb-2">
                                    <input type="text" name="title" class="form-control form-control-sm bg-white" style="border-color:mediumspringgreen;" value="<?php echo $todo['title']; ?>" readonly>
                                </div>
                            </div>
                        <div class="row">
                            <div class="form-group">
                                <label for="prefup_email_subject" class="col-form-label-sm">Email Subject Line</label>
                                <div class="mb-2">
                                    <input type="text" name="prefup_email_subject" class="form-control form-control-sm bg-white" style="border-color:mediumspringgreen;" value="<?php echo $todo['prefup_email_subject']; ?>" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label for="prefup_email_body" class="col-form-label-sm">Script</label>
                                <div class="">
                                    <textarea class="form-control form-control-sm bg-white" name="prefup_email_body" id="prefup_email_body" cols="50" rows="8" readonly style="border-color:mediumspringgreen;"><?php echo $todo['prefup_email_body']; ?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                <?php if($todo['category'] == 'Tribunal') : ?>
                    <div class="ms-2 px-3 pt-2 pb-3 rounded" style="color:white; background-image:linear-gradient(135deg, royalblue, #41E1D9); box-shadow: 0px 4px 8px #ddd;"><!-- #41E1D9 -->
                        <label class="col-form-label" style="font-size:1.2em;"><strong>Tribunal</strong></label>
                        <div class="form-group row mb-2">
                            <div class="col-3">
                                <label for="presider_1" class="col-form-label-sm">Presider 1</label>
                            </div>
                            <div class="col-9">
                                <input type="text" name="presider_1" class="form-control form-control-sm bg-white" style="border-color:mediumturquoise;" value="<?php echo $todo['presider_1']; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <div class="col-3">
                                <label for="presider_2" class="col-form-label-sm">Presider 2</label>
                            </div>
                            <div class="col-9">
                                <input type="text" name="presider_2" class="form-control form-control-sm bg-white" style="border-color:mediumturquoise;" value="<?php echo $todo['presider_2']; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <div class="col-3">
                                <label for="timer" class="col-form-label-sm">Timer</label>
                            </div>
                            <div class="col-3">
                                <input type="button" class="btn btn-sm" style="background-color:aquamarine;" value="Start Timer" onclick="countdownTimer()">
                            </div>
                            <div class="col-6">
                                <small id="timer" class="ms-4"></small>
                            </div>
                        </div>
                        <div class="form-group mb-2">
                            <label for="notes" class="col-form-label-sm">Project Notes</label>
                            <textarea name="notes" class="form-control form-control-sm bg-white" rows="8" style="border-color:mediumturquoise;" readonly><?php echo $project['notes']; ?></textarea>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </form>
</div>

<?php include 'inc/footer.inc.php'; ?>