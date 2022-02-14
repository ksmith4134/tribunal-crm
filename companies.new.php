<?php
include 'inc/autoloader.inc.php';
include 'inc/config.inc.php';
include 'inc/header.inc.php';
include 'inc/nav.inc.php';

$create = new ViewCompanies();
$create->createNewCompany();

$object2 = new ViewSettings();
$reps = $object2->showReps();

?>

<div class="col-11 mx-auto">
    <br>
    <form method="POST" action="" class="mb-4">
        <div class="d-flex flex-row mt-3 mb-2">
            <div class="" style="margin:0px 20px 0px 0px;">
                <h4>Create a New Company</h4>
            </div>
            <div class="px-2">
                <button type="submit" name="submit" class="btn btn-sm btn-primary">Submit</button>
            </div>
        </div>
        <div class="row py-2 mb-3 bg-light rounded" style="box-shadow: 2px 4px 4px #ddd;">
            <div class="col-3">
                <div class="form-group">
                    <label for="co_name" class="col-8 col-form-label"><strong>Company</strong></label>
                    <div class="">
                        <input type="text" name="co_name" class="form-control form-control-sm" placeholder="">
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <label for="co_type" class="col-8 col-form-label"><strong>Company Type</strong></label>
                    <div class="">
                        <select id="co_type" name="co_type" size="1" class="form-select form-select-sm" >
                            <option value=""></option>
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
                    <div class="mb-2">
                        <select id="co_status" name="co_status" size="1" class="form-select form-select-sm" >
                            <option value=""></option>
                            <option value="In business">In business</option>
                            <option value="Out of business">Out of business</option>
                        </select>
                    </div>
                </div>
            </div> 
            <div class="col-2">
                
            </div>
            <div class="col-1 mb-2">
                <!-- <div class="form-group" >   
                    <label for="companyID" class="col-form-label"><strong>Co. ID</strong></label>
                    <div class="">
                        <input type="text" name="companyID" class="form-control form-control-sm" placeholder="" readonly>
                    </div>
                </div> -->
            </div>
        </div>
        <div class="row py-2 mb-3 bg-light rounded" style="box-shadow: 2px 4px 4px #ddd;">
            <div class="col-3">
                <div class="form-group">
                    <label for="website1" class="col-8 col-form-label"><strong>Websites</strong></label>
                    <div class="mb-2">
                        <input type="text" name="website1" class="form-control form-control-sm" placeholder="">
                    </div>
                    <div class="mb-2">
                        <input type="text" name="website2" class="form-control form-control-sm" placeholder="">
                    </div>
                </div>
            </div>
            <div class="col-2">
                <div class="form-group">
                    <label for="rep1" class="col-8 col-form-label"><strong>Sales Reps</strong></label>
                    <div class="mb-2">
                        <select id="rep1" name="rep1" size="1" class="form-select form-select-sm" >
                            <option value="">Select Main Sales Rep</option>
                            <option value="">----------------</option>
                            <?php foreach($reps as $rep) : ?>
                                <option value="<?php echo $rep['full_name']; ?>"><?php echo $rep['full_name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="">
                        <select id="rep2" name="rep2" size="1" class="form-select form-select-sm" >
                            <option value="">Select 2nd Sales Rep</option>
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
                            <input type="date" name="lastcontact_date" class="form-control form-control-sm" placeholder="">
                        </div>
                    </div>
                    <div class="row">
                        <label for="lastcontact_type" class="col-2 col-form-label-sm">Type</label>
                        <div class="col-10">
                            <select id="lastcontact_type" name="lastcontact_type" size="1" class="form-select form-select-sm" >
                                <option value=""></option>
                                <option value="Email">Email</option>
                                <option value="Phone">Phone</option>
                                <option value="Voicemail">Voicemail</option>
                                <option value="In-Person">In-Person</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                    <label for="" class="col-form-label"><strong>Links</strong></label>
                    <div class="row">
                        <label for="" class="col-2 col-form-label-sm">Projects</label>
                        <div class="col-10 mb-2">
                            <input type="text" name="" class="form-control form-control-sm" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <label for="linkedleads" class="col-2 col-form-label-sm">Leads</label>
                        <div class="col-10 mb-2">
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
                        <input type="text" name="address_st" class="form-control form-control-sm" placeholder="">
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label for="address_city" class="col-3 col-form-label-sm">City</label>
                    <div class="col-9">
                        <input type="text" name="address_city" class="form-control form-control-sm" placeholder="">
                    </div>
                </div>               
                <div class="form-group row mb-2">
                    <label for="address_state" class="col-3 col-form-label-sm">State</label>
                    <div class="col-9">
                        <input type="text" name="address_state" class="form-control form-control-sm" placeholder="">
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label for="address_country" class="col-3 col-form-label-sm">Country</label>
                    <div class="col-9">
                        <input type="text" name="address_country" class="form-control form-control-sm" placeholder="">
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label for="address_zip" class="col-3 col-form-label-sm">Zip</label>
                    <div class="col-9">
                        <input type="text" name="address_zip" class="form-control form-control-sm" placeholder="">
                    </div>
                </div>
            </div>
            <div class="col-5">
                <div class="form-group">
                    <label for="notes" class="col-form-label"><strong>Company Notes</strong></label>
                    <div class="mb-2">
                        <textarea name="notes" class="form-control form-control-sm" rows="8" placeholder=""></textarea>
                    </div>
                </div>
            </div>
        </div>
        <!-- <div class="row mb-4">
            <div class="col-3">
                <div class="form-group">
                    <label for="created_at" class="col-form-label"><small>Record Creation Time</small></label>
                    <div>
                        <input type="text" name="created_at" class="form-control form-control-sm" readonly>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <label for="created_by" class="col-form-label"><small>Record Creator</small></label>
                    <div>
                        <input type="text" name="created_by" class="form-control form-control-sm" readonly>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <label for="modified_at" class="col-form-label"><small>Record Last Mod Time</small></label>
                    <div>
                        <input type="text" name="modified_at" class="form-control form-control-sm" readonly>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <label for="modified_by" class="col-form-label"><small>Record Modifier</small></label>
                    <div>
                        <input type="text" name="modified_by" class="form-control form-control-sm" readonly>
                    </div>
                </div>
            </div>
        </div> -->
    </form>
</div>

<?php include 'inc/footer.inc.php'; ?>