<?php
include 'inc/autoloader.inc.php';
include 'inc/config.inc.php';
include 'inc/header.inc.php';
include 'inc/nav.inc.php';

$object = new ViewSettings();
$reps = $object->showReps();
$rows = $object->repsRows();
$object->showSalesRepEdit($reps, $rows);

$prefups = $object->showPreFUP();
$rows2 = $object->preFUPRows();
$object->editPreFUPs($prefups, $rows2);

$proj_thresh = $object->showProjectThresh();
$object->newProjectThresh();
$object->showReCalcAPR();
?>

<div class="col-11 mx-auto">
    <br>
    <form method="POST" action="" class="mb-4">
        <div class="d-flex flex-row my-3">
            <div class="" style="margin:0px 20px 0px 0px;">
                <h4>Settings</h4>
            </div>
            <div class="px-2">
            <button type="submit" name="submit" class="btn btn-danger">Submit</button>
            </div>
        </div>
        <div class="row pb-3 mb-2 pt-2 bg-light">            
            <div class="form-group">
                <label for="" class="col-form-label"><strong>Sales Reps</strong></label>
                <a href="<?php echo ROOT_URL; ?>salesreps.new.php" class="ms-1 btn btn-sm btn-success">+</a>
                <div class="row">
                    <div class="col-2">
                        <label for="" class="col-form-label">Full Name</label>
                        <?php foreach($reps as $rep) : ?>
                            <div class="mb-2">
                                <input type="text" name="full_name[]" class="form-control form-control-sm" value="<?php echo $rep['full_name']; ?>">
                            </div> 
                        <?php endforeach; ?>
                    </div>
                    <div class="col-1">
                        <label for="" class="col-form-label">EXP</label>
                        <?php foreach($reps as $rep) : ?>
                            <div class="mb-2">
                                <input type="text" name="experience_level[]" class="form-control form-control-sm" value="<?php echo $rep['experience_level']; ?>">
                            </div> 
                        <?php endforeach; ?>
                    </div>
                    <div class="col-2">
                        <label for="" class="col-form-label">Phone</label>
                        <?php foreach($reps as $rep) : ?>
                            <div class="mb-2">
                                <input type="text" name="phone[]" class="form-control form-control-sm" value="<?php echo $rep['phone']; ?>">
                            </div> 
                        <?php endforeach; ?>
                    </div>
                    <div class="col-2">
                        <label for="" class="col-form-label">Email</label>
                        <?php foreach($reps as $rep) : ?>
                            <div class="mb-2">
                                <input type="text" name="email[]" class="form-control form-control-sm" value="<?php echo $rep['email']; ?>">
                            </div> 
                        <?php endforeach; ?>
                    </div>
                    <div class="col-1">
                        <label for="" class="col-form-label">ID</label>
                        <?php foreach($reps as $rep) : ?>
                            <div class="mb-2">
                                <input type="text" name="id[]" class="form-control form-control-sm" value="<?php echo $rep['id']; ?>" readonly>
                            </div> 
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row pb-3 mb-2 pt-2 bg-light">
            <div class="form-group">
                <label for="" class="col-form-label"><strong>Tribunal</strong></label>
                <div class="row">
                    <div class="col-2">
                        <label for="thresh_value" class="col-form-label">APR Threshold</label>
                        <div class="mb-2">
                            <input type="text" name="thresh_value" class="form-control form-control-sm" value="<?php echo $proj_thresh['thresh_value']; ?>">
                        </div>
                    </div>
                    <div class="col-2">
                        <label for="calc_adjust" class="col-form-label">Calc Adjust Factor</label>
                        <div class="mb-2">
                            <input type="text" name="calc_adjust" class="form-control form-control-sm" value="<?php echo $proj_thresh['calc_adjust']; ?>">
                        </div>
                    </div>
                </div>
            </div> 
        </div>
        <div class="row pb-3 mb-2 pt-2 bg-light">
            <div class="form-group">
                <label for="" class="col-form-label"><strong>Pre-Contact FUP</strong></label>
                <a href="<?php echo ROOT_URL; ?>settings.prefup.new.php" class="ms-1 btn btn-sm btn-success">+</a>
                <div class="row">
                    <div class="col-1">
                        <label for="process" class="col-form-label">Process #</label>
                        <?php foreach($prefups as $prefup) : ?>
                            <div class="mb-2">
                                <input type="text" name="process[]" class="form-control form-control-sm" value="<?php echo $prefup['process']; ?>">
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="col-1">
                        <label for="step_num" class="col-form-label">Step #</label>
                        <?php foreach($prefups as $prefup) : ?>
                            <div class="mb-2">
                                <input type="text" name="step_num[]" class="form-control form-control-sm" value="<?php echo $prefup['step_num']; ?>">
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="col-1">
                        <label for="days" class="col-form-label">Days</label>
                        <?php foreach($prefups as $prefup) : ?>
                            <div class="mb-2">
                                <input type="text" name="days[]" class="form-control form-control-sm" value="<?php echo $prefup['days']; ?>">
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="col-2">
                        <label for="step_name" class="col-form-label">Step Title</label>
                        <?php foreach($prefups as $prefup) : ?>
                            <div class="mb-2">
                                <input type="text" name="step_name[]" class="form-control form-control-sm" value="<?php echo $prefup['step_name']; ?>">
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="col-3">
                        <label for="email_subject" class="col-form-label">Email Subject</label>
                        <?php foreach($prefups as $prefup) : ?>
                            <div class="mb-2">
                                <input type="text" name="email_subject[]" class="form-control form-control-sm" value="<?php echo $prefup['email_subject']; ?>">
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="col-4">
                        <label for="email_body" class="col-form-label">Email Body</label>
                        <?php foreach($prefups as $prefup) : ?>
                            <div class="mb-2">
                                <input type="text" name="email_body[]" class="form-control form-control-sm" value="<?php echo $prefup['email_body']; ?>">
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div> 
        </div>
    </form>
</div>

<?php include 'inc/footer.inc.php'; ?>