<?php
include 'inc/autoloader.inc.php'; include 'inc/config.inc.php';
include 'inc/header.inc.php'; include 'inc/nav.inc.php';

$object = new ViewLeads();
$lead = $object->showLeadEdit();
$contact_state = $lead['contact_made'];
$opt_state = $lead['opt_out'];
$update = $object->enterLeadEdit($contact_state, $opt_state);
$object->executeDeleteLead();

$object2 = new ViewSettings();
$reps = $object2->showReps();
$prefups = $object2->showPreFUPProcess();

$state = $lead['process'];
$obj = new Leads();
$obj->makePreFUPToDos($state);

?>

<div class="col-11 mx-auto">
    <br>
    <form method="POST" action="" class="mb-4">
        <div class="d-flex flex-row mt-3 mb-2">
            <h4 style="margin-right:20px;">Edit Lead</h4>
            <div class="px-2">
                <input type="hidden" name="update_id" value="<?php echo $lead['id']; ?>">
                <button type="submit" name="submit" class="btn btn-sm btn-success">Submit</button>
            </div>
        </div>
        <div class="row py-2 mb-3 bg-light rounded" style="box-shadow: 2px 4px 4px #ddd;">
            <div class="col-2">
                <div class="form-group">
                    <label for="co_name" class="col-8 col-form-label"><strong><i class="fas fa-building"></i>&nbsp;&nbsp;Company</strong></label>
                    <div class="">
                        <input type="text" name="co_name" class="form-control form-control-sm" value="<?php echo $lead['co_name']; ?>" >
                    </div>
                </div>
            </div>
            <div class="col-2">
                <div class="form-group">
                    <label for="firstname" class="col-8 col-form-label"><strong>First Name</strong></label>
                    <div class="">
                        <input type="text" name="firstname" class="form-control form-control-sm" value="<?php echo $lead['firstname']; ?>" >
                    </div>
                </div>
            </div>
            <div class="col-2">
                <div class="form-group">
                    <label for="lastname" class="col-8 col-form-label"><strong>Last Name</strong></label>
                    <div class="">
                        <input type="text" name="lastname" class="form-control form-control-sm" value="<?php echo $lead['lastname']; ?>" >
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <label for="email" class="col-8 col-form-label"><strong><i class="fas fa-at"></i>&nbsp;&nbsp;Email</strong></label>
                    <div class="">
                        <input type="email" name="email" class="form-control form-control-sm" value="<?php echo $lead['email']; ?>" >
                    </div>
                </div>
            </div>
            <div class="col-2">
                <div class="form-group">
                    <label for="source" class="col-form-label"><strong>Source</strong></label>
                    <select id="source" name="source" size="1" class="form-select form-select-sm" >
                        <option value="<?php echo $lead['source']; ?>"><?php echo $lead['source']; ?></option>    
                        <option value="">------------</option>
                        <option value="AdWords">AdWords</option>
                        <option value="Organic Search">Organic Search</option>
                        <option value="Direct Email">Direct Email</option>
                        <option value="Phone">Phone</option>
                        <option value="Website Registration">Website Registration</option>
                        <option value="Tradeshow">Tradeshow</option>
                        <option value="LinkedIn">LinkedIn</option>
                    </select>
                </div>
            </div>
            <div class="col-1 mb-2">
                <div class="form-group" >   
                    <label for="id" class="col-form-label"><strong>ID</strong></label>
                    <div class="">
                        <input type="text" name="id" class="form-control form-control-sm" value="<?php echo $lead['id']; ?>" readonly>
                    </div>
                </div>
            </div>
        </div>
        <div class="row py-2 mb-3 bg-light rounded" style="height:16em; box-shadow: 2px 4px 4px #ddd;">
            <div class="col-8 bg-light">
                <div class="row">
                    <div class="col-4">
                        <div class="form-group">
                            <label for="phone1" class="col-form-label"><strong><i class="fas fa-mobile-alt"></i>&nbsp;&nbsp;Phone</strong></label>
                            <div class="row">
                                <label for="phone1" class="col-3 col-form-label-sm">Mobile</label>
                                <div class="col-9 mb-2">
                                    <input type="tel" name="phone1" class="form-control form-control-sm" value="<?php echo $lead['phone1']; ?>" placeholder="555-555-5555">
                                </div>
                            </div>
                            <div class="row">
                                <label for="phone2" class="col-3 col-form-label-sm">Office</label>
                                <div class="col-9 mb-2">
                                    <input type="tel" name="phone2" class="form-control form-control-sm" value="<?php echo $lead['phone2']; ?>" placeholder="555-555-5555 x123">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-5">
                        <div class="form-group">
                            <label for="website1" class="col-8 col-form-label"><strong><i class="fas fa-globe-americas"></i>&nbsp;&nbsp;Websites</strong></label>
                            <div class="mb-2">
                                <input type="text" name="website1" class="form-control form-control-sm" value="<?php echo $lead['website1']; ?>" >
                            </div>
                            <div class="">
                                <input type="text" name="website2" class="form-control form-control-sm" value="<?php echo $lead['website2']; ?>" >
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="rep1" class="col-8 col-form-label"><strong><i class="fas fa-user-friends"></i>&nbsp;&nbsp;Sales Reps</strong></label>
                            <div class="mb-2">
                                <select id="rep1" name="rep1" size="1" class="form-select form-select-sm" >
                                    <option value="<?php echo $lead['rep1']; ?>"><strong>Current: <?php echo $lead['rep1']; ?></strong></option>
                                    <option value="">----------------</option>
                                    <?php foreach($reps as $rep) : ?>
                                        <option value="<?php echo $rep['full_name']; ?>"><?php echo $rep['full_name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="">
                                <select id="rep2" name="rep2" size="1" class="form-select form-select-sm" >
                                    <option value="<?php echo $lead['rep2']; ?>"><strong>Current: <?php echo $lead['rep2']; ?></strong></option>
                                    <option value="">----------------</option>
                                    <?php foreach($reps as $rep) : ?>
                                        <option value="<?php echo $rep['full_name']; ?>"><?php echo $rep['full_name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row my-2">
                    <div class="col-4">
                        <div class="form-group">
                            <label for="" class="col-form-label"><strong><i class="far fa-address-book"></i>&nbsp;Last Contact</strong></label>
                            <div class="row">
                                <label for="lastcontact_date" class="col-3 col-form-label-sm">Date</label>
                                <div class="col-9 mb-2">
                                    <input type="date" name="lastcontact_date" class="form-control form-control-sm" value="<?php echo $lead['lastcontact_date']; ?>" >
                                </div>
                            </div>
                            <div class="row">
                                <label for="lastcontact_type" class="col-3 col-form-label-sm">Type</label>
                                <div class="col-9">
                                    <select id="lastcontact_type" name="lastcontact_type" size="1" class="form-select form-select-sm" >
                                        <option value="<?php echo $lead['lastcontact_type']; ?>">Current: <?php echo $lead['lastcontact_type']; ?></option>
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
                    <div class="col-5">
                        <div class="form-group">
                            <label for="" class="col-form-label"><strong><i class="fas fa-link"></i>&nbsp;&nbsp;Links</strong></label>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="" class="col-form-label"><strong><i class="fas fa-inbox"></i>&nbsp;&nbsp;Emails</strong></label>
                            <div class="row">
                                <label for="unsub" class="col-6 col-form-label-sm">Unsubscribe</label>
                                <div class="col-6 mb-2">
                                    <input type="text" name="unsub" class="form-control form-control-sm" value="<?php //echo $lead['unsub']; ?>">
                                </div>
                            </div>
                            <div class="row">
                                <label for="no_email" class="col-6 col-form-label-sm">No Emails</label>
                                <div class="col-6">
                                    <input type="text" name="no_email" class="form-control form-control-sm" value="<?php //echo $lead['no_email']; ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4 bg-light">
                <div class="form-group">
                    <div class="row mb-1">
                        <div class="col-9">
                            <label for="process" class="pt-2"><strong>Pre-Contact FUP To-Dos</strong></label>
                        </div>
                        <div class="col-3 text-end">
                            <select id="process" name="process" size="1" class="form-select form-select-sm" >
                                <option value="<?php echo $lead['process']; ?>"><?php echo $lead['process']; ?></option>
                                <option value="0">----</option>
                                <option value="0">None</option>
                                <?php foreach($prefups as $prefup) : ?>
                                    <option value="<?php echo $prefup['process']; ?>"><?php echo $prefup['process']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="h-75 w-100 d-inline-block bg-light border rounded mb-2" style="overflow-y:scroll; overflow-x: hidden; max-height:7em;">
                    <div class="p-2">
                        
                    </div>      
                </div>
                <div class="row">
                    <div class="input-group mb-2">
                        <label for="contact_made" class="col-form-label-sm pe-2">Contact Made</label>
                        <div class="input-group-text rounded-start">
                            <input type="checkbox" name="contact_made" class="form-check-input mt-0" value="<?php echo $lead['contact_made']; ?>" aria-label="..." <?php if ($lead['contact_made'] == 1) echo "checked='checked'"; ?>>
                        </div>
                        <input type="date" name="contact_date" class="form-control form-control-sm" value="<?php echo $lead['contact_date']; ?>" readonly>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label for="opt_out" class="col-form-label-sm pe-2">Opt Out</label>
                        <input type="checkbox" name="opt_out" class="form-check-input" value="<?php echo $lead['opt_out']; ?>" aria-label="..." <?php if ($lead['opt_out'] == 1) echo "checked='checked'"; ?>>
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
                        <input type="text" name="address_st" class="form-control form-control-sm" value="<?php echo $lead['address_st']; ?>">
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label for="address_city" class="col-3 col-form-label-sm">City</label>
                    <div class="col-9">
                        <input type="text" name="address_city" class="form-control form-control-sm" value="<?php echo $lead['address_city']; ?>">
                    </div>
                </div>               
                <div class="form-group row mb-2">
                    <label for="address_state" class="col-3 col-form-label-sm">State</label>
                    <div class="col-9">
                        <input type="text" name="address_state" class="form-control form-control-sm" value="<?php echo $lead['address_state']; ?>">
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label for="address_country" class="col-3 col-form-label-sm">Country</label>
                    <div class="col-9">
                        <input type="text" name="address_country" class="form-control form-control-sm" value="<?php echo $lead['address_country']; ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="address_zip" class="col-3 col-form-label-sm">Zip</label>
                    <div class="col-9">
                        <input type="text" name="address_zip" class="form-control form-control-sm" value="<?php echo $lead['address_zip']; ?>">
                    </div>
                </div>
            </div>
            <div class="col-5">
                <div class="form-group">
                    <label for="notes" class="col-form-label"><strong><i class="fas fa-pencil-alt"></i>&nbsp;&nbsp;Lead Notes</strong></label>
                    <div class="">
                        <textarea name="notes" class="form-control form-control-sm" rows="8" ><?php echo $lead['notes']; ?></textarea>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="row mb-1">
                    <div class="col-10">
                        <label class="pt-2"><strong>Post-Contact FUP To-Dos</strong></label>
                    </div>
                    <div class="col-2 text-end">
                    </div>
                </div>
                <div class="h-75 w-100 d-inline-block bg-light border rounded" style="overflow-y:scroll; overflow-x: hidden; max-height:12.5em;">
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