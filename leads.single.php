<?php
include 'inc/autoloader.inc.php';
include 'inc/config.inc.php';
include 'inc/header.inc.php';
include 'inc/nav.inc.php';

$object = new ViewLeads();
$lead = $object->showLeadEdit();
$object->executeDeleteLead();
$next = $object->nextHigherLead();
$prev = $object->nextLowerLead();
$todos = $object->leadPostToDos();

$object2 = new Search2;
$projects = $object2->searchy3($lead['companyID']);

$obj = new Leads();
$prefups = $obj->showPreFUPToDos();

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
        xmlhttp.open("GET", "link.lead.php?id=<?php echo $lead['id']; ?>&q="+int, true);
        xmlhttp.send();
    } window.location.reload(true);
}
</script>

<script>//Create Link to Project
    function linkToProject(int){
    if(int.length == 0){
        document.getElementById('projectlink').innerHTML = '';
    } else {
        //AJAX Request
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function(){
            if(this.readyState == 4 && this.status ==200){
                document.getElementById('projectlink').innerHTML = this.responseText;
            }
        }
        xmlhttp.open("GET", "link.leadtoproj.php?id=<?php echo $lead['id']; ?>&u="+int, true);
        xmlhttp.send();
    } window.location.reload(true);
}
</script>

<script>//Contact Made Checkbox
    function checkboxContact(bool){
        if(bool.length == 0){
            document.getElementById('doneContact').innerHTML = '';
        } else {
            //AJAX Request
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function(){
                if(this.readyState == 4 && this.status ==200){
                    document.getElementById('doneContact').innerHTML = this.responseText;
                }
            }
            xmlhttp.open("GET", "checkbox.contact.php?id=<?php echo $lead['id']; ?>&checkbox="+bool, true);
            xmlhttp.send();
        } window.location.reload(true);
    }
</script>

<script>//Opt Out Checkbox
    function checkboxOptOut(bool){
        if(bool.length == 0){
            document.getElementById('doneOptOut').innerHTML = '';
        } else {
            //AJAX Request
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function(){
                if(this.readyState == 4 && this.status ==200){
                    document.getElementById('doneOptOut').innerHTML = this.responseText;
                }
            }
            xmlhttp.open("GET", "checkbox.optout.php?id=<?php echo $lead['id']; ?>&checkbox="+bool, true);
            xmlhttp.send();
        } window.location.reload(true);window.location.reload(true);
    }
</script>

<div class="col-11 mx-auto">
    <br>
    <form method="POST" action="" class="mb-4">
        <div class="d-flex flex-row mt-3 mb-2">
            <h4><span style="color:#4169E1; font-weight:bold;">Lead </span><?php echo $lead['firstname'].' '.$lead['lastname']; ?></h4>
            <div class="px-2 ms-auto">
                <a href="<?php echo ROOT_URL; ?>leads.edit.php?id=<?php echo $lead['id']; ?>" class="btn btn-sm btn-warning">Edit</a>
            </div>            
            <div class="px-2">
                <a href="<?php echo ROOT_URL.'leads.php'; ?>" class="btn btn-sm btn-primary">List View</a>
            </div>
            <div class="px-2">
                <a href="<?php echo ROOT_URL; ?>leads.single.php?id=<?php echo $prev['id']; ?>" class="btn btn-sm btn-outline-dark"><</a>
                <a href="<?php echo ROOT_URL; ?>leads.single.php?id=<?php echo $next['id']; ?>" class="btn btn-sm btn-outline-dark">></a>
            </div>
        </div>
        <div class="row py-2 mb-3 bg-light rounded" style="box-shadow: 2px 4px 4px #ddd;">
            <div class="col-2">
                <div class="form-group">
                    <label for="co_name" class="col-form-label"><strong><i class="fas fa-building"></i>&nbsp;&nbsp;Company</strong></label>
                    <div class="">
                        <input type="text" name="co_name" class="form-control form-control-sm" value="<?php echo $lead['co_name']; ?>" readonly>
                    </div>
                </div>
            </div>
            <div class="col-2">
                <div class="form-group">
                    <label for="firstname" class="col-form-label"><strong>First Name</strong></label>
                    <div class="">
                        <input type="text" name="firstname" class="form-control form-control-sm" value="<?php echo $lead['firstname']; ?>" readonly>
                    </div>
                </div>
            </div>
            <div class="col-2">
                <div class="form-group">
                    <label for="lastname" class="col-form-label"><strong>Last Name</strong></label>
                    <div class="">
                        <input type="text" name="lastname" class="form-control form-control-sm" value="<?php echo $lead['lastname']; ?>" readonly>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <label for="email" class="col-form-label"><strong><i class="fas fa-at"></i>&nbsp;&nbsp;Email</strong></label>
                    <div class="">
                        <input type="text" name="email" class="form-control form-control-sm" value="<?php echo $lead['email']; ?>" readonly>
                    </div>
                </div>
            </div>
            <div class="col-2">
                <div class="form-group">
                    <label for="source" class="col-form-label"><strong>Source</strong></label>
                    <div class="">
                        <input type="text" name="source" class="form-control form-control-sm" value="<?php echo $lead['source']; ?>" readonly>
                    </div>
                </div>
            </div>
            <div class="col-1">
                <div class="form-group">   
                    <label for="id" class="col-form-label"><strong>ID</strong></label>
                    <div class="mb-2">
                        <input type="text" name="id" class="form-control form-control-sm" value="<?php echo $lead['id']; ?>" readonly>
                    </div>
                </div>
            </div>
        </div>
        <div class="row py-2 mb-3 bg-light rounded" style="height:16em; box-shadow: 2px 4px 4px #ddd;">
            <div class="col-8">
                <div class="row">
                    <div class="col-4">
                        <div class="form-group">
                            <label for="phone1" class="col-form-label"><strong><i class="fas fa-mobile-alt"></i>&nbsp;&nbsp;Phone</strong></label>
                            <div class="row">
                                <label for="phone1" class="col-3 col-form-label-sm">Mobile</label>
                                <div class="col-9 mb-2">
                                    <input type="tel" name="phone1" class="form-control form-control-sm" value="<?php echo $lead['phone1']; ?>" placeholder="555-555-5555" readonly>
                                </div>
                            </div>
                            <div class="row">
                                <label for="phone2" class="col-3 col-form-label-sm">Office</label>
                                <div class="col-9 mb-2">
                                    <input type="tel" name="phone2" class="form-control form-control-sm" value="<?php echo $lead['phone2']; ?>" placeholder="555-555-5555 x123" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-5">
                        <div class="form-group">
                            <label for="website1" class="col-form-label"><strong><i class="fas fa-globe-americas"></i>&nbsp;&nbsp;Websites</strong></label>
                            <div class="row mb-2">
                                <div class="col-10">
                                    <input type="url" name="website1" class="form-control form-control-sm" value="<?php echo $lead['website1']; ?>" readonly>
                                </div>
                                <div class="col-2">
                                    <?php if(!empty($lead['website1'])) : ?>
                                        <a href="<?php echo $lead['website1']; ?>" target="_blank"><span style="font-size: 1.2em; color:royalblue;"><i class="fas fa-arrow-right"></i></span></i></a>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-10">
                                    <input type="url" name="website2" class="form-control form-control-sm" value="<?php echo $lead['website2']; ?>" readonly>
                                </div>
                                <div class="col-2">
                                    <?php if(!empty($lead['website2'])) : ?>
                                        <a href="<?php echo $lead['website2']; ?>" target="_blank"><span style="font-size: 1.2em; color:royalblue;"><i class="fas fa-arrow-right"></span></i></a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="rep1" class="col-form-label"><strong><i class="fas fa-user-friends"></i>&nbsp;&nbsp;Sales Reps</strong></label>
                            <div class="mb-2">
                                <input type="text" name="rep1" class="form-control form-control-sm" value="<?php echo $lead['rep1']; ?>" readonly>
                            </div>
                            <div class="">
                                <input type="text" name="rep2" class="form-control form-control-sm" value="<?php echo $lead['rep2']; ?>" readonly>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row my-2">
                    <div class="col-4">
                        <div class="form-group">
                            <label for="" class="col-form-label"><strong><i class="far fa-address-book"></i>&nbsp;&nbsp;Last Contact</strong></label>
                            <div class="row">
                                <label for="lastcontact_date" class="col-3 col-form-label-sm">Date</label>
                                <div class="col-9 mb-2">
                                    <input type="date" name="lastcontact_date" class="form-control form-control-sm" value="<?php echo $lead['lastcontact_date']; ?>" readonly>
                                </div>
                            </div>
                            <div class="row">
                                <label for="lastcontact_type" class="col-3 col-form-label-sm">Type</label>
                                <div class="col-9">
                                    <input type="text" name="lastcontact_type" class="form-control form-control-sm" value="<?php echo $lead['lastcontact_type']; ?>" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-5">
                        <div class="form-group">
                            <label for="" class="col-form-label"><strong><i class="fas fa-link"></i>&nbsp;&nbsp;Links</strong></label>
                            <div class="row">
                                <div class="col-7 d-grid mb-2">
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">Link to Company</button>
                                </div>
                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Link this Lead to a Company</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="d-flex px-2">
                                                    <!-- <input type ="submit" class="btn btn-outline-success" name="searching" value="Search"> -->
                                                    <input class="form-control me-2" type="search" placeholder="Enter the company name to begin search..." aria-label="Search" name="search" onkeyup="showSuggestion(this.value)" autocomplete="off">
                                                </div>
                                                <div class="px-2 mt-4">
                                                    <p id="output" style="font-weight:bold;"></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End modal -->
                                <div class="col-3 mb-2">
                                    <div class="form-group" ><!-- LINK TO COMPANY   -->
                                        <input id="companylink" type="text" name="companyid" class="form-control form-control-sm" value="<?php echo $lead['companyID']; ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <?php if($lead['companyID'] > 0) : ?>
                                        <a href="<?php echo 'companies.single.php?companyID='.$lead['companyID']; ?>"><span style="font-size: 1.2em; color:royalblue;"><i class="fas fa-arrow-right"></i></span></i></a>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-7 d-grid">
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#linkProjectModal">Link to Project</button>
                                </div>
                                <!-- Modal -->
                                <div class="modal fade" id="linkProjectModal" tabindex="-1" aria-labelledby="linkProjectModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="linkProjectModalLabel">Link this Lead to a Project</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="px-2 mt-4">
                                                    <?php if($lead['companyID'] != 0){ ?>
                                                        <?php if(!empty($projects)){ ?>
                                                            <table class="table table-hover">
                                                                <thead>
                                                                    <tr>
                                                                        <th scope="col">Project Name</th>
                                                                        <th scope="col">Proj. ID</th>
                                                                        <th scope="col">Link</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php foreach($projects as $project) : ?>
                                                                        <tr>
                                                                            <th scope="row"><?php echo $project['proj_name']; ?></th>
                                                                            <td><?php echo $project['id']; ?></td>
                                                                            <td><button class="btn btn-sm btn-warning" value="<?php echo $project['id']; ?>" onclick="linkToProject(this.value)">Link</button></td>
                                                                        </tr>
                                                                    <?php endforeach; ?>  
                                                                </tbody>
                                                            </table>
                                                        <?php 
                                                        } else {
                                                            echo "No Projects exist for this Company. Please create a new Project from the <a href=\"companies.single.php?companyID=".$lead['companyID']."\">Company</a> record.";
                                                        }
                                                        ?>
                                                    <?php } else { echo "Please link to a Company before linking to a Project."; } ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End of modal -->
                                <div class="col-3">
                                    <div class="form-group" ><!-- LINK TO PROJECT   -->
                                        <input id="projectlink" type="text" name="projectID" class="form-control form-control-sm" value="<?php echo $lead['projectID']; ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <?php if($lead['projectID'] > 0) : ?>
                                        <a href="<?php echo 'projects.single.php?id='.$lead['projectID']; ?>"><span style="font-size: 1.2em; color:royalblue;"><i class="fas fa-arrow-right"></i></span></i></a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="" class="col-form-label"><strong><i class="fas fa-inbox"></i>&nbsp;&nbsp;Emails</strong></label>
                            <div class="row">
                                <label for="unsub" class="col-6 col-form-label-sm">Unsubscribe</label>
                                <div class="col-6 mb-2">
                                    <input type="text" name="unsub" class="form-control form-control-sm" value="<?php //echo $lead['unsub']; ?>" readonly><!-- implementation needed -->
                                </div>
                            </div>
                            <div class="row">
                                <label for="no_email" class="col-6 col-form-label-sm">No Emails</label>
                                <div class="col-6">
                                    <input type="text" name="no_email" class="form-control form-control-sm" value="<?php //echo $lead['no_email']; ?>" readonly><!-- implementation needed -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4 bg-light">
                <div class="row mb-1">
                    <div class="col-9">
                        <label for="" class="pt-2"><strong>Pre-Contact FUP To-Dos</strong></label>
                    </div>
                    <div class="col-3 text-end">
                        <input type="text" name="process" class="form-control form-control-sm" value="<?php if($lead['process'] > 0) {echo $lead['process'];} else {echo "";} ?>" readonly>
                    </div>
                </div>
                <div class="h-75 w-100 d-inline-block bg-white border rounded mb-2" style="overflow-y:scroll; overflow-x: hidden; max-height:7em;">
                    <div class="px-2 py-1">
                        <table class="table table-hover table-sm table-borderless" style="font-size:.75em;">
                            <thead class="border-bottom">
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Due Date</th>
                                    <th scope="col">Done</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($prefups as $prefup) : ?>
                                    <tr style="transform: rotate(0); <?php if($prefup['done'] == 1){echo "text-decoration: line-through;";} ?>">
                                        <th scope="row"><a href="todos.single.php?id=<?php echo $prefup['id']; ?>" class="<?php if($prefup['done'] == 0){echo "stretched-link";} ?>"><?php echo $prefup['id']; ?></a></th>
                                        <td><?php echo $prefup['title']; ?></td>
                                        <td>
                                            <span style="font-weight:bold; <?php if($prefup['due_at']>=date('Y-m-d') && $prefup['done'] == 0){echo "color:green;";} elseif($prefup['due_at']<date('Y-m-d') && $prefup['done'] == 0) {echo "color:red;";} else {echo "";} ?>">
                                                <?php echo $prefup['due_at']; ?>
                                            </span>
                                        </td>
                                        <td><?php echo $prefup['done_at']; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>      
                </div>
                <div class="row">
                    <div class="input-group mb-2">
                        <label for="contact_made" class="col-form-label-sm pe-2">Contact Made</label>
                        <div class="input-group-text rounded-start">
                            <input id="doneContact" onclick="checkboxContact(this.value)" type="checkbox" name="contact_made" class="form-check-input mt-0" value="<?php echo $lead['contact_made']; ?>" <?php if ($lead['contact_made'] == 1) echo "checked"; ?>>
                        </div>
                        <input type="date" name="contact_date" class="form-control form-control-sm" value="<?php echo $lead['contact_date']; ?>" readonly>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label for="opt_out" class="col-form-label-sm pe-2">Opt Out</label>
                        <input id="doneOptOut" onclick="checkboxOptOut(this.value)" type="checkbox" name="opt_out" class="form-check-input" value="<?php echo $lead['opt_out']; ?>" <?php if ($lead['opt_out'] == 1) echo "checked"; ?>>
                    </div>   
                </div>
            </div>
        </div>
        <div class="row py-2 mb-3 bg-light rounded" style="height:16em; box-shadow: 2px 4px 4px #ddd;">
            <div class="col-3">
                <label for="" class="col-form-label"><strong><i class="fas fa-map-marker-alt"></i>&nbsp;&nbsp;Address</strong></label>
                <div class="form-group row mb-2">
                    <label for="address_st" class="col-3 col-form-label-sm">Street</label>
                    <div class="col-9">
                        <input type="text" name="address_st" class="form-control form-control-sm" value="<?php echo $lead['address_st']; ?>" readonly>
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label for="address_city" class="col-3 col-form-label-sm">City</label>
                    <div class="col-9">
                        <input type="text" name="address_city" class="form-control form-control-sm" value="<?php echo $lead['address_city']; ?>" readonly>
                    </div>
                </div>               
                <div class="form-group row mb-2">
                    <label for="address_state" class="col-3 col-form-label-sm">State</label>
                    <div class="col-9">
                        <input type="text" name="address_state" class="form-control form-control-sm" value="<?php echo $lead['address_state']; ?>" readonly>
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label for="address_country" class="col-3 col-form-label-sm">Country</label>
                    <div class="col-9">
                        <input type="text" name="address_country" class="form-control form-control-sm" value="<?php echo $lead['address_country']; ?>" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="address_zip" class="col-3 col-form-label-sm">Zip</label>
                    <div class="col-9">
                        <input type="text" name="address_zip" class="form-control form-control-sm" value="<?php echo $lead['address_zip']; ?>" readonly>
                    </div>
                </div>
            </div>
            <div class="col-5">
                <div class="form-group">
                    <label for="notes" class="col-form-label"><strong><i class="fas fa-pencil-alt"></i>&nbsp;&nbsp;Lead Notes</strong></label>
                    <div class="">
                        <textarea readonly name="notes" class="form-control form-control-sm" rows="8" ><?php echo $lead['notes']; ?></textarea>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="row mb-1">
                    <div class="col-10">
                        <label class="pt-2"><strong>Post-Contact FUP To-Dos</strong></label>
                    </div>
                    <div class="col-2 text-end">
                        <a href="todos.new.php?<?php echo "leadID=".$lead['id']."&rep1=".$lead['rep1']."&rep2=".$lead['rep2']."&todo=Post-Contact Lead"; ?>" class="btn btn-sm btn-secondary">+</a>
                    </div>
                </div>
                <div class="h-75 w-100 d-inline-block bg-white border rounded" style="overflow-y:scroll; overflow-x: hidden; max-height:12.5em;">
                    <div class="px-2 py-1">
                        <table class="table table-hover table-sm table-borderless" style="font-size:.75em;">
                            <?php foreach($todos as $todo) : ?>
                                <thead class="border-bottom">
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Priority</th>
                                        <th scope="col" style="padding-left:10px;">Due Date</th>
                                        <th scope="col">Done</th>
                                        <th scope="col">Progress</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr style="transform: rotate(0); <?php if($todo['done'] == 1){echo "text-decoration: line-through;";} ?>">
                                        <th scope="row">
                                            <a href="todos.single.php?id=<?php echo $todo['id']; ?>" class="stretched-link"><?php echo $todo['id']; ?></a>
                                        </th>
                                        <td>
                                            <div class="text-center" style="background:
                                                <?php if($todo['done'] == 0){
                                                    if (preg_match('[5]', $todo['priority'])){echo '#41e169;';} 
                                                    elseif (preg_match('[4]', $todo['priority'])){echo '#62e082;';}
                                                    elseif (preg_match('[3]', $todo['priority'])){echo '#84e09b;';}
                                                    elseif (preg_match('[2]', $todo['priority'])){echo '#a6e0b4;';}
                                                    elseif (preg_match('[1]', $todo['priority'])){echo '#c7e0cd;';}
                                                    else {echo ";";}}
                                                ?>; padding:5px; border-radius:20px;">
                                                <?php echo substr($todo['priority'],3); ?>
                                            </div>
                                        </td>
                                        <td style="padding-left:10px;">
                                            <span style="font-weight:bold; <?php if($todo['due_at']>=date('Y-m-d') && $todo['done'] == 0){echo "color:green;";} elseif($todo['due_at']<date('Y-m-d') && $todo['done'] == 0) {echo "color:red;";} else {echo "";} ?>">
                                                <?php echo $todo['due_at']; ?>
                                            </span>
                                        </td>
                                        <td><?php echo $todo['done_at']; ?></td>
                                        <td>
                                            <div class="progress mt-1"  style="height: 10px;">
                                                <div class="progress-bar bg-warning" role="progressbar" style="width: <?php echo 100*($todo['time_complete'] / $todo['est_time']); ?>%">
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="border-bottom">
                                        <td colspan="5">
                                            <div class="mb-3" style="max-height:4em; overflow-y:hidden; <?php if($todo['done'] == 1){echo "text-decoration: line-through;";} ?>">
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
                        <input type="text" name="created_at" class="form-control form-control-sm" value="<?php echo $lead['created_at']; ?>" readonly>
                    </div>
                </div>
            </div>
            <div class="col-2">
                <div class="form-group">
                    <label for="created_by" class="col-form-label"><small>Creator</small></label>
                    <div>
                        <input type="text" name="created_by" class="form-control form-control-sm" value="<?php echo $lead['created_by']; ?>" readonly>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <label for="modified_at" class="col-form-label"><small>Record Modified</small></label>
                    <div>
                        <input type="text" name="modified_at" class="form-control form-control-sm" value="<?php echo $lead['modified_at']; ?>" readonly>
                    </div>
                </div>
            </div>
            <div class="col-2">
                <div class="form-group">
                    <label for="modified_by" class="col-form-label"><small>Modifier</small></label>
                    <div>
                        <input type="text" name="modified_by" class="form-control form-control-sm" value="<?php echo $lead['modified_by']; ?>" readonly>
                    </div>
                </div>
            </div>
            <div class="col-2">
                <!-- MODAL:DELETE RECORD -->
                <div class="form-group text-end">
                    <label for="delete" class="col-form-label"><small>&nbsp;</small></label>    
                    <!-- Button trigger modal -->
                    <div>
                        <button name="delete" type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">-</button>
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
                                    <input type="hidden" name="delete_id" value="<?php echo $lead['id']; ?>">
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