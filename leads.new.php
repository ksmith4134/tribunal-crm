<?php
include 'inc/autoloader.inc.php';
include 'inc/config.inc.php';
include 'inc/header.inc.php';
include 'inc/nav.inc.php';

$create = new ViewLeads();
$create->createNewLead();

$object2 = new ViewSettings();
$reps = $object2->showReps();
$prefups = $object2->showPreFUPProcess();



?>

<div class="col-11 mx-auto">
    <br>
    <form method="POST" action="" class="mb-4">
        <div class="d-flex flex-row mt-3 mb-2">
            <h4 style="margin-right:20px;">Create a New Lead</h4>
            <div class="px-2">
                <button type="submit" name="submit" class="btn btn-sm btn-primary">Submit</button>
            </div>
        </div>
        <div class="row py-2 mb-3 bg-light rounded" style="box-shadow: 2px 4px 4px #ddd;">
            <div class="col-2">
                <div class="form-group">
                    <label for="co_name" class="col-form-label"><strong><i class="fas fa-building"></i>&nbsp;&nbsp;Company</strong></label>
                    <div class="">
                        <input type="text" name="co_name" class="form-control form-control-sm" placeholder="">
                    </div>
                </div>
            </div>
            <div class="col-2">
                <div class="form-group">
                    <label for="firstname" class="col-form-label"><strong>First Name</strong></label>
                    <div class="">
                        <input type="text" name="firstname" class="form-control form-control-sm" placeholder="">
                    </div>
                </div>
            </div>
            <div class="col-2">
                <div class="form-group">
                    <label for="lastname" class="col-form-label"><strong>Last Name</strong></label>
                    <div class="">
                        <input type="text" name="lastname" class="form-control form-control-sm" placeholder="">
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <label for="email" class="col-form-label"><strong><i class="fas fa-at"></i>&nbsp;&nbsp;Email</strong></label>
                    <div class="">
                        <input type="email" name="email" class="form-control form-control-sm" placeholder="">
                    </div>
                </div>
            </div>
            <div class="col-2 mb-2">
                <div class="form-group">
                    <label for="source" class="col-form-label"><strong>Source</strong></label>
                    <select id="source" name="source" size="1" class="form-select form-select-sm" >
                        <option value=""></option>
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
        </div>
        <div class="row py-2 mb-3 bg-light rounded" style="height:17em; box-shadow: 2px 4px 4px #ddd;">
            <div class="col-8 bg-light">
                <div class="row">
                    <div class="col-4">
                        <div class="form-group">
                            <label for="phone1" class="col-form-label"><strong><i class="fas fa-mobile-alt"></i>&nbsp;&nbsp;Phone</strong></label>
                            <div class="row">
                                <label for="phone1" class="col-3 col-form-label-sm">Mobile</label>
                                <div class="col-9 mb-2">
                                    <input type="tel" name="phone1" class="form-control form-control-sm" placeholder="555-555-5555">
                                </div>
                            </div>
                            <div class="row">
                                <label for="phone2" class="col-3 col-form-label-sm">Office</label>
                                <div class="col-9 mb-2">
                                    <input type="tel" name="phone2" class="form-control form-control-sm" placeholder="555-555-5555 x123">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-5">
                        <div class="form-group">
                            <label for="website1" class="col-form-label"><strong><i class="fas fa-globe-americas"></i>&nbsp;&nbsp;Websites</strong></label>
                            <div class="mb-2">
                                <input type="text" name="website1" class="form-control form-control-sm" placeholder="">
                            </div>
                            <div class="mb-2">
                                <input type="text" name="website2" class="form-control form-control-sm" placeholder="">
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="rep1" class="col-form-label"><strong><i class="fas fa-user-friends"></i>&nbsp;&nbsp;Sales Reps</strong></label>
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
                </div>
                <div class="row my-2">
                    <div class="col-4">
                        <div class="form-group">
                            <label for="" class="col-form-label"><strong><i class="far fa-address-book"></i>&nbsp;Last Contact</strong></label>
                            <div class="row">
                                <label for="lastcontact_date" class="col-3 col-form-label-sm">Date</label>
                                <div class="col-9 mb-2">
                                    <input type="date" name="lastcontact_date" class="form-control form-control-sm" placeholder="">
                                </div>
                            </div>
                            <div class="row">
                                <label for="lastcontact_type" class="col-3 col-form-label-sm">Type</label>
                                <div class="col-9">
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
                        
                            <label for="process" class="pt-2"><strong>Pre-Contact FUP To-Dos</strong></label>
                            
                        
                    </div>
                </div>
                <div class="h-75 w-100 d-inline-block bg-light border rounded" style="overflow-y:scroll; overflow-x: hidden; max-height:15em;">
                    <div class="p-2">
                        <p style="color:grey; font-size:12px;">Submit new lead entry and click "Edit" to select Pre-Contact FUP process.</p>
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
                        <input type="text" name="address_st" class="form-control form-control-sm">
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label for="address_city" class="col-3 col-form-label-sm">City</label>
                    <div class="col-9">
                        <input type="text" name="address_city" class="form-control form-control-sm">
                    </div>
                </div>               
                <div class="form-group row mb-2">
                    <label for="address_state" class="col-3 col-form-label-sm">State</label>
                    <div class="col-9">
                        <input type="text" name="address_state" class="form-control form-control-sm">
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label for="address_country" class="col-3 col-form-label-sm">Country</label>
                    <div class="col-9">
                        <input type="text" name="address_country" class="form-control form-control-sm">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="address_zip" class="col-3 col-form-label-sm">Zip</label>
                    <div class="col-9">
                        <input type="text" name="address_zip" class="form-control form-control-sm">
                    </div>
                </div>
            </div>
            <div class="col-5">
                <div class="form-group">
                    <label for="notes" class="col-form-label"><strong><i class="fas fa-pencil-alt"></i>&nbsp;&nbsp;Lead Notes</strong></label>
                    <div class="">
                        <textarea name="notes" class="form-control form-control-sm" rows="8" ></textarea>
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