<?php
include 'inc/autoloader.inc.php';
include 'inc/config.inc.php';
include 'inc/header.inc.php';
include 'inc/nav.inc.php';

$object = new ViewCompanies();
$company = $object->showCompanyEdit();
$update = $object->enterCompanyEdit(); 
$object->executeDeleteCompany();

$object2 = new ViewSettings();
$reps = $object2->showReps();

?>

<div class="col-11 mx-auto">
    <br>
    <!-- <h4 class="mb-4">Lead</h4> -->
    <form method="POST" action="" class="mb-4">
        <div class="d-flex flex-row mt-3 mb-2">
            <div class="" style="margin:0px 20px 0px 0px;">
                <h4>Edit Company</h4>
            </div>
            <div class="px-2">
                <input type="hidden" name="update_id" value="<?php echo $company['companyID']; ?>">
                <button type="submit" name="submit" class="btn btn-sm btn-success">Submit</button>
            </div>
        </div>
        <div class="row py-2 mb-3 bg-light rounded" style="box-shadow: 2px 4px 4px #ddd;">
            <div class="col-3">
                <div class="form-group">
                    <label for="co_name" class="col-8 col-form-label"><strong>Company</strong></label>
                    <div class="">
                        <input type="text" name="co_name" class="form-control form-control-sm" value="<?php echo $company['co_name']; ?>" >
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <label for="co_type" class="col-8 col-form-label"><strong>Company Type</strong></label>
                    <div class="">
                        <select id="co_type" name="co_type" size="1" class="form-select form-select-sm" >
                            <option value="<?php echo $company['co_type']; ?>">Current: <?php echo $company['co_type']; ?></option>
                            <option value="">------------</option>
                            <option value="OEM">OEM</option>
                            <option value="End-User">End-User</option>
                            <option value="Vendor">Vendor</option>
                            <option value="Contrator">Contrator</option>
                            <option value="Competitor">Competitor</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <label for="co_status" class="col-8 col-form-label"><strong>Status</strong></label>
                    <div class="">
                        <select id="co_status" name="co_status" size="1" class="form-select form-select-sm" >
                            <option value="<?php echo $company['co_status']; ?>">Current: <?php echo $company['co_status']; ?></option>
                            <option value="">------------</option>
                            <option value="In business">In business</option>
                            <option value="Out of business">Out of business</option>
                        </select>
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
                        <input type="text" name="website1" class="form-control form-control-sm" value="<?php echo $company['website1']; ?>" >
                    </div>
                    <div class="">
                        <input type="text" name="website2" class="form-control form-control-sm" value="<?php echo $company['website2']; ?>" >
                    </div>
                </div>
            </div>
            <div class="col-2">
                <div class="form-group">
                    <label for="rep1" class="col-8 col-form-label"><strong>Sales Reps</strong></label>
                    <div class="mb-2">
                    <select id="rep1" name="rep1" size="1" class="form-select form-select-sm" >
                            <option value="<?php echo $company['rep1']; ?>"><strong>Current: <?php echo $company['rep1']; ?></strong></option>
                            <option value="">----------------</option>
                            <?php foreach($reps as $rep) : ?>
                                <option value="<?php echo $rep['full_name']; ?>"><?php echo $rep['full_name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="">
                        <select id="rep2" name="rep2" size="1" class="form-select form-select-sm" >
                            <option value="<?php echo $company['rep2']; ?>"><strong>Current: <?php echo $company['rep2']; ?></strong></option>
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
                    <label for="" class="col-form-label"><strong>Last Contact</strong></label>
                    <div class="row">
                        <label for="lastcontact_date" class="col-2 col-form-label-sm">Date</label>
                        <div class="col-10 mb-2">
                            <input type="date" name="lastcontact_date" class="form-control form-control-sm" value="<?php echo $company['lastcontact_date']; ?>" >
                        </div>
                    </div>
                    <div class="row">
                        <label for="lastcontact_type" class="col-2 col-form-label-sm">Type</label>
                        <div class="col-10">
                            <select id="lastcontact_type" name="lastcontact_type" size="1" class="form-select form-select-sm" >
                                <option value="<?php echo $company['lastcontact_type']; ?>">Current: <?php echo $company['lastcontact_type']; ?></option>
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
            <div class="col-4 mb-2">
                <div class="form-group">
                    <label for="" class="col-form-label"><strong>Links</strong></label>
                    <div class="row">
                        <label for="" class="col-2 col-form-label-sm">Projects</label>
                        <div class="col-10 mb-2">
                            <input type="text" name="" class="form-control form-control-sm" value="" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <label for="linkedleads" class="col-2 col-form-label-sm">Leads</label>
                        <div class="col-10">
                            <input type="text" name="linkedleads" class="form-control form-control-sm" readonly>
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
                        <input type="text" name="address_st" class="form-control form-control-sm" value="<?php echo $company['address_st']; ?>" >
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label for="address_city" class="col-3 col-form-label-sm">City</label>
                    <div class="col-9">
                        <input type="text" name="address_city" class="form-control form-control-sm" value="<?php echo $company['address_city']; ?>" >
                    </div>
                </div>               
                <div class="form-group row mb-2">
                    <label for="address_state" class="col-3 col-form-label-sm">State</label>
                    <div class="col-9">
                        <input type="text" name="address_state" class="form-control form-control-sm" value="<?php echo $company['address_state']; ?>" >
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label for="address_country" class="col-3 col-form-label-sm">Country</label>
                    <div class="col-9">
                        <input type="text" name="address_country" class="form-control form-control-sm" value="<?php echo $company['address_country']; ?>" >
                    </div>
                </div>
                <div class="form-group row">
                    <label for="address_zip" class="col-3 col-form-label-sm">Zip</label>
                    <div class="col-9">
                        <input type="text" name="address_zip" class="form-control form-control-sm" value="<?php echo $company['address_zip']; ?>" >
                    </div>
                </div>
            </div>
            <div class="col-5">
                <div class="form-group">
                    <label for="notes" class="col-form-label"><strong>Company Notes</strong></label>
                    <div class="mb-2">
                        <textarea  name="notes" class="form-control form-control-sm" rows="8" ><?php echo $company['notes']; ?></textarea>
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