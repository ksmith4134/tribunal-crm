<?php
include 'inc/autoloader.inc.php';
include 'inc/config.inc.php';
include 'inc/header.inc.php';
include 'inc/nav.inc.php';

$object = new ViewProjects();
$project = $object->showProjectEdit();
$object->executeDeleteProject();
$next = $object->nextHigherProject();
$prev = $object->nextLowerProject();
$leads = $object->showLinkedLeadsProj();
$tribunals = $object->showTribunalToDo();
$todos = $object->showProjectToDos();

$object2 = new ViewSettings();
$thresh = $object2->showProjectThresh();

?>

<script>//Search for Company Link
    function showSuggestion(str){
    if(str.length == 0){
        document.getElementById('output').innerHTML = '';
    } else {
        //AJAX Request
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function(){
            if(this.readyState == 4 && this.status ==200){
                document.getElementById('output').innerHTML = this.responseText;
            }
        }
        xmlhttp.open("GET", "search.php?q="+str, true);
        xmlhttp.send();
    }
}
</script>

<script>//Create Link to Company
    function linkToCompany(int){
    if(int.length == 0){
        document.getElementById('companylink').innerHTML = '';
    } else {
        //AJAX Request
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function(){
            if(this.readyState == 4 && this.status ==200){
                document.getElementById('companylink').innerHTML = this.responseText;
            }
        }
        xmlhttp.open("GET", "link.project.php?id=<?php echo $project['id']; ?>&q="+int, true);
        xmlhttp.send();
    }
}
</script>

<div class="col-11 mx-auto">
    <br>
    <!-- <h4 class="mb-4">Lead</h4> -->
    <form method="POST" action="" class="mb-4">
        <div class="d-flex flex-row mt-3 mb-2">
            <div class="" style="margin:0px 20px 0px 0px;">
                <h4><span style="color:#4169E1; font-weight:bold;">Project </span><?php echo $project['proj_name']; ?></h4>
            </div>
            <div class="px-2 ms-auto">
                <a href="<?php echo ROOT_URL; ?>projects.edit.php?id=<?php echo $project['id']; ?>" class="btn btn-sm btn-warning">Edit</a>
            </div>
            <div class="px-2">
                <a href="<?php echo ROOT_URL; ?>projects.php" class="btn btn-sm btn-primary">List View</a>
            </div>
            <div class="px-2">
                <a href="<?php echo ROOT_URL; ?>projects.single.php?id=<?php echo $prev['id']; ?>" class="btn btn-sm btn-outline-dark"><</a>
                <a href="<?php echo ROOT_URL; ?>projects.single.php?id=<?php echo $next['id']; ?>" class="btn btn-sm btn-outline-dark">></a>
            </div>
        </div>
        <div class="row py-2 mb-3 bg-light rounded" style="box-shadow: 2px 4px 4px #ddd;">
            <div class="col-3">
                <div class="form-group">
                    <label for="proj_name" class="col-form-label"><strong>Project</strong></label>
                    <div class="">
                        <input type="text" name="proj_name" class="form-control form-control-sm" value="<?php echo $project['proj_name']; ?>" readonly>
                    </div>
                </div>
            </div>
            <div class="col-2">
                <div class="form-group">
                    <label for="project_status" class="col-form-label"><strong>Status</strong></label>
                    <div class="">
                        <input type="text" name="project_status" class="form-control form-control-sm" value="<?php echo $project['project_status']; ?>" readonly>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <label for="co_name" class="col-form-label"><strong>Company</strong></label>
                    <div class="row">
                        <div class="col-10">
                            <input type="text" name="co_name" class="form-control form-control-sm" value="<?php echo $project['co_name']; ?>" readonly>
                        </div>
                        <div class="col-2">
                            <?php if($project['companyID'] > 0) : ?>
                                <a href="<?php echo 'companies.single.php?companyID='.$project['companyID']; ?>"><span style="font-size: 1.2em; color:royalblue;"><i class="fas fa-arrow-right"></i></span></i></a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-2">
                <div class="form-group">
                    <label for="" class="col-form-label"><strong>Linked Leads</strong></label>
                    <div class="col-12 dropdown">
                        <div class="form-control form-control-sm">
                            <div class="row">
                                <div class="col-10">See linked leads</div>
                                <div class="col-2 ms-auto pe-2"><i class="fa fa-caret-down"></i></div>
                            </div>
                        </div>
                        <div class="dropdown-content col-12">
                            <?php foreach ($leads as $lead) : ?>
                                <a href="leads.single.php?id=<?php echo $lead['id']; ?>"><?php echo $lead['firstname'].' '.$lead['lastname']; ?></a><br>
                            <?php endforeach; ?>
                        </div>   
                    </div>
                </div>
            </div>
            <div class="col-1">
                <div class="form-group" ><!-- LINK TO COMPANY   --> 
                    <label for="companyid" class="col-form-label"><strong>Comp. ID</strong></label>
                    <div class="">
                        <input id="companylink" type="text" name="companyid" class="form-control form-control-sm" value="<?php echo $project['companyID']; ?>" readonly>
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
                    <div class="row mb-2">
                        <div class="col-10">
                            <input type="url" name="website1" class="form-control form-control-sm" value="<?php echo $project['website1']; ?>" readonly>
                        </div>
                        <div class="col-2">
                            <?php if(!empty($project['website1'])) : ?>
                                <a href="<?php echo $project['website1']; ?>" target="_blank"><span style="font-size: 1.2em; color:royalblue;"><i class="fas fa-arrow-right"></i></span></i></a>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-10">
                            <input type="url" name="website2" class="form-control form-control-sm" value="<?php echo $project['website2']; ?>" readonly>
                        </div>
                        <div class="col-2">
                            <?php if(!empty($project['website2'])) : ?>
                                <a href="<?php echo $project['website2']; ?>" target="_blank"><span style="font-size: 1.2em; color:royalblue;"><i class="fas fa-arrow-right"></i></span></i></a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-2">
                <div class="form-group">
                    <label for="rep1" class="col-form-label"><strong>Sales Reps</strong></label>
                    <div class="mb-2">
                        <input type="text" name="rep1" class="form-control form-control-sm" value="<?php echo $project['rep1']; ?>" readonly>
                    </div>
                    <div class="">
                        <input type="text" name="rep2" class="form-control form-control-sm" value="<?php echo $project['rep2']; ?>" readonly>
                    </div>
                </div>
            </div>
            <div class="col-2">
                <div class="form-group">
                    <label for="" class="col-form-label"><strong>Last Contact</strong></label>
                    <div class="row">
                        <label for="lastcontact_date" class="col-2 col-form-label-sm">Date</label>
                        <div class="col-10 mb-2">
                            <input type="date" name="lastcontact_date" class="form-control form-control-sm" value="<?php echo $project['lastcontact_date']; ?>" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <label for="lastcontact_type" class="col-2 col-form-label-sm">Type</label>
                        <div class="col-10">
                            <input type="text" name="lastcontact_type" class="form-control form-control-sm" value="<?php echo $project['lastcontact_type']; ?>" readonly>
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
                <div class="h-75 w-100 d-inline-block bg-white border rounded" style="max-height:4.6em;">
                    <div class="px-2 py-1">
                        <table class="table table-hover table-sm table-borderless" style="font-size:.85em;">
                            <?php foreach($tribunals as $tribunal) : ?>
                                <thead class="border-bottom">
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Priority</th>
                                        <th scope="col" style="padding-left:20px;">Due Date</th>
                                        <th scope="col">Done Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr style="transform: rotate(0); <?php if($tribunal['done'] == 1){echo "text-decoration: line-through;";} ?>">
                                        <th scope="row"><a href="todos.single.php?id=<?php echo $tribunal['id']; ?>" class="stretched-link"><?php echo $tribunal['id']; ?></a></th>
                                        <td>
                                            <div class="text-center" style="background:
                                                <?php if($tribunal['done'] == 0){
                                                    if (preg_match('[5]', $tribunal['priority'])){echo '#41e169;';} 
                                                    elseif (preg_match('[4]', $tribunal['priority'])){echo '#62e082;';}
                                                    elseif (preg_match('[3]', $tribunal['priority'])){echo '#84e09b;';}
                                                    elseif (preg_match('[2]', $tribunal['priority'])){echo '#a6e0b4;';}
                                                    elseif (preg_match('[1]', $tribunal['priority'])){echo '#c7e0cd;';}
                                                    else {echo ";";}}
                                                ?>; padding:3px; border-radius:20px;">
                                                <?php echo substr($tribunal['priority'], 3); ?>
                                            </div>
                                        </td>
                                        <td style="padding-left:20px;">
                                            <span style="font-weight:bold; <?php if($tribunal['due_at']>=date('Y-m-d') && $tribunal['done'] == 0){echo "color:green;";} elseif($tribunal['due_at']<date('Y-m-d') && $tribunal['done'] == 0) {echo "color:red;";} else {echo "";} ?>">
                                                <?php echo $tribunal['due_at']; ?>
                                            </span>
                                        </td>
                                        <td><?php echo $tribunal['done_at']; ?></td>
                                    </tr>
                                </tbody>
                            <?php endforeach; ?>  
                        </table>
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
                        <input type="text" name="units_annual" class="form-control form-control-sm" value="<?php echo $project['units_annual']; ?>" readonly>
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label for="stage" class="col-7 col-form-label-sm">Sales Stage</label>
                    <div class="col-5">
                        <input type="text" name="stage" class="form-control form-control-sm" value="<?php if($project['stage'] == 1){echo $project['stage'].': First call';} elseif($project['stage'] == 2){echo $project['stage'].': Second call';} elseif($project['stage'] == 3){echo $project['stage'].': Obtained demo unit(s)';} elseif($project['stage'] == 4){echo $project['stage'].': Testing/integration';} elseif($project['stage'] == 5){echo $project['stage'].': Production';} else {echo $project['stage'];} ?>" readonly>
                    </div>
                </div>               
                <div class="form-group row mb-2">
                    <label for="odds_win" class="col-7 col-form-label-sm">Odds of Win (%)</label>
                    <div class="col-5">
                        <input type="text" name="odds_win" class="form-control form-control-sm" value="<?php echo $project['odds_win']; ?>" readonly>
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label for="chance_success" class="col-7 col-form-label-sm">Chance of Field Success (%)</label>
                    <div class="col-5">
                        <input type="text" name="chance_success" class="form-control form-control-sm" value="<?php echo $project['chance_success']; ?>" readonly>
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label for="rev_high_annual" class="col-7 col-form-label-sm">High-End Rev/Yr ($)</label>
                    <div class="col-5">
                        <input type="text" name="rev_high_annual" class="form-control form-control-sm" value="<?php echo $project['rev_high_annual']; ?>" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="rev_low_annual" class="col-7 col-form-label-sm">Low-End Rev/Yr ($)</label>
                    <div class="col-5 mb-2">
                        <input type="text" name="rev_low_annual" class="form-control form-control-sm" value="<?php echo $project['rev_low_annual']; ?>" readonly>
                    </div>
                </div>                
            </div>
            <div class="col-4">
                <div class="form-group">
                    <label for="notes" class="col-form-label"><strong>Project Notes</strong></label>
                    <div class="">
                        <textarea readonly name="notes" class="form-control form-control-sm" rows="10" ><?php echo $project['notes']; ?></textarea>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="row mb-1">
                    <div class="col-10">
                        <label class="pt-2"><strong>Project To-Dos</strong></label>
                    </div>
                    <div class="col-2 text-end">
                        <a href="todos.new.php?<?php echo "projectID=".$project['id']."&rep1=".$project['rep1']."&rep2=".$project['rep2']."&todo=Project"; ?>" class="btn btn-sm btn-secondary">+</a>
                    </div>
                </div>
                <div class="h-100 w-100 d-inline-block bg-white border rounded" style="overflow-y:scroll; overflow-x: hidden; max-height:14em;">
                    <div class="px-2 py-1">
                        <table class="table table-hover table-sm table-borderless" style="font-size:.85em;">
                            <?php foreach($todos as $todo) : ?>
                                <thead class="border-bottom">
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Priority</th>
                                        <th scope="col" style="padding-left:10px;">Due Date</th>
                                        <th scope="col">Time</th>
                                        <th scope="col">Progress</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr style="transform: rotate(0); <?php if($todo['done'] == 1){echo "text-decoration: line-through;";} ?>">
                                        <th scope="row"><a href="todos.single.php?id=<?php echo $todo['id']; ?>" class="stretched-link"><?php echo $todo['id']; ?></a></th>
                                        <td> 
                                            <div class="text-center" style="background:
                                                <?php if($todo['done'] == 0){
                                                    if (preg_match('[5]', $todo['priority'])){echo '#41e169;';} 
                                                    elseif (preg_match('[4]', $todo['priority'])){echo '#62e082;';}
                                                    elseif (preg_match('[3]', $todo['priority'])){echo '#84e09b;';}
                                                    elseif (preg_match('[2]', $todo['priority'])){echo '#a6e0b4;';}
                                                    elseif (preg_match('[1]', $todo['priority'])){echo '#c7e0cd;';}
                                                    else {echo ";";}}
                                                ?>; padding:3px; border-radius:20px;">
                                                <?php echo substr($todo['priority'], 3); ?>
                                            </div>
                                        </td>
                                        <td style="padding-left:10px;">
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
                                            <div class="mb-4" style="max-height:4em; overflow-y:hidden; <?php if($todo['done'] == 1){echo "text-decoration: line-through;";} ?>">
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

<!-- Link to Company Button... should not be needed-->
    <!-- <div class="px-2"> -->
                <!-- Button trigger modal -->
                <!-- <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Link to Company >
                </button>
            </div> -->
                <!-- Modal -->
                <!-- <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Link this Project to a Company</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="d-flex px-2"> -->
                                    <!-- <input type ="submit" class="btn btn-outline-success" name="searching" value="Search"> -->
                                    <!-- <input class="form-control me-2" type="search" placeholder="Enter the company name to begin search..." aria-label="Search" name="search" onkeyup="showSuggestion(this.value)" autocomplete="off">
                                </div>
                                <div class="px-2 mt-4">
                                    <p id="output" style="font-weight:bold;"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> 
 -->

<?php include 'inc/footer.inc.php'; ?>