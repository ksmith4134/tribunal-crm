<?php 

include 'inc/autoloader.inc.php';
include 'inc/config.inc.php';
include 'inc/header.inc.php';
include 'inc/nav.inc.php';

$object = new ViewSettings();
$reps = $object->showReps();
$object->executeDeleteRep();
$proj_thresh = $object->showProjectThresh();
$prefups = $object->showPreFUP();

$object->executeDeletePreFUP();

?>

<div class="col-11 mx-auto">
    <br>
    <form method="POST" action="" class="mb-4">
        <div class="d-flex flex-row mt-3 mb-2">
            <div class="" style="margin:0px 20px 0px 0px;">
                <h4>Settings</h4>
            </div>
            <div class="px-2">
                <a href="<?php echo ROOT_URL; ?>salesreps.edit.php" class="btn btn-sm btn-warning">Edit</a>
            </div>
        </div>
        <div class="row py-2 mb-3 bg-light rounded" style="box-shadow: 2px 4px 4px #ddd;">            
            <div class="form-group">
                <label for="" class="col-form-label"><strong>Sales Reps</strong></label>
                <a href="<?php echo ROOT_URL; ?>salesreps.new.php" class="ms-1 btn btn-sm btn-success">+</a>
                <div class="row">
                    <div class="col-2">
                        <label for="" class="col-form-label">Full Name</label>
                        <?php foreach($reps as $rep) : ?>
                            <div class="mb-2">
                                <input type="text" name="full_name" class="form-control form-control-sm" value="<?php echo $rep['full_name']; ?>" readonly>
                            </div> 
                        <?php endforeach; ?>
                    </div>
                    <div class="col-1">
                        <label for="" class="col-form-label">Experience</label>
                        <?php foreach($reps as $rep) : ?>
                            <div class="mb-2">
                                <input type="text" name="experience_level" class="form-control form-control-sm" value="<?php echo $rep['experience_level']; ?>" readonly>
                            </div> 
                        <?php endforeach; ?>
                    </div>
                    <div class="col-2">
                        <label for="" class="col-form-label">Phone</label>
                        <?php foreach($reps as $rep) : ?>
                            <div class="mb-2">
                                <input type="text" name="phone" class="form-control form-control-sm" value="<?php echo $rep['phone']; ?>" readonly>
                            </div> 
                        <?php endforeach; ?>
                    </div>
                    <div class="col-2">
                        <label for="" class="col-form-label">Email</label>
                        <?php foreach($reps as $rep) : ?>
                            <div class="mb-2">
                                <input type="text" name="email" class="form-control form-control-sm" value="<?php echo $rep['email']; ?>" readonly>
                            </div> 
                        <?php endforeach; ?>
                    </div>
                    <div class="col-1">
                        <label for="" class="col-form-label">ID</label>
                        <?php foreach($reps as $rep) : ?>
                            <div class="mb-2">
                                <input type="text" name="id" class="form-control form-control-sm" value="<?php echo $rep['id']; ?>" readonly>
                            </div> 
                        <?php endforeach; ?>
                    </div>
                    <div class="col-1">
                        <label for="" class="col-form-label">Delete</label>
                        <?php foreach($reps as $rep) : ?>
                            <div class="mb-2">
                                <input type="hidden" name="delete_id" value="<?php echo $rep['id']; ?>">
                                <input type="submit" name="delete" class="btn btn-sm btn-danger" value="-">
                            </div> 
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row py-2 mb-3 bg-light rounded" style="box-shadow: 2px 4px 4px #ddd;">
            <div class="form-group">
                <label for="" class="col-form-label"><strong>Tribunal</strong></label>
                <div class="row">
                    <div class="col-2">
                        <label for="" class="col-form-label">APR Threshold 1</label>
                        <div class="mb-2">
                            <input type="text" name="thresh_value" class="form-control form-control-sm" value="<?php echo $proj_thresh['thresh_value']; ?>" readonly>
                        </div>
                    </div>
                    <div class="col-2">
                        <label for="" class="col-form-label">APR Threshold 2</label>
                        <div class="mb-2">
                            <input type="text" name="thresh_value_2" class="form-control form-control-sm" value="<?php echo $proj_thresh['thresh_value_2']; ?>" readonly>
                        </div>
                    </div>
                    <div class="col-2">
                        <label for="" class="col-form-label">Calc Adjust Factor</label>
                        <div class="mb-2">
                            <input type="text" name="thresh_value" class="form-control form-control-sm" value="<?php echo $proj_thresh['calc_adjust']; ?>" readonly>
                        </div>
                    </div>
                </div>
            </div> 
        </div>
        <div class="row py-2 mb-3 bg-light rounded" style="box-shadow: 2px 4px 4px #ddd;">
            <div class="form-group">
                <label for="" class="col-form-label"><strong>Pre-Contact FUP</strong></label>
                <a href="<?php echo ROOT_URL; ?>settings.prefup.new.php" class="ms-1 btn btn-sm btn-success">+</a>
                <div class="row">
                    <div class="col-1">
                        <label for="process" class="col-form-label">Process #</label>
                        <?php foreach($prefups as $prefup) : ?>
                            <div class="mb-2">
                                <input type="text" name="process" class="form-control form-control-sm" value="<?php echo $prefup['process']; ?>" readonly>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="col-1">
                        <label for="step_num" class="col-form-label">Step #</label>
                        <?php foreach($prefups as $prefup) : ?>
                            <div class="mb-2">
                                <input type="text" name="step_num" class="form-control form-control-sm" value="<?php echo $prefup['step_num']; ?>" readonly>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="col-1">
                        <label for="days" class="col-form-label">Days</label>
                        <?php foreach($prefups as $prefup) : ?>
                            <div class="mb-2">
                                <input type="text" name="days" class="form-control form-control-sm" value="<?php echo $prefup['days']; ?>" readonly>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="col-1">
                        <label for="step_name" class="col-form-label">Step Title</label>
                        <?php foreach($prefups as $prefup) : ?>
                            <div class="mb-2">
                                <input type="text" name="step_name" class="form-control form-control-sm" value="<?php echo $prefup['step_name']; ?>" readonly>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="col-3">
                        <label for="email_subject" class="col-form-label">Email Subject</label>
                        <?php foreach($prefups as $prefup) : ?>
                            <div class="mb-2">
                                <input type="text" name="email_subject" class="form-control form-control-sm" value="<?php echo $prefup['email_subject']; ?>" readonly>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="col-4">
                        <label for="email_body" class="col-form-label">Script</label>
                        <?php foreach($prefups as $prefup) : ?>
                            <div class="mb-2">
                                <input type="text" name="email_body" class="form-control form-control-sm" value="<?php echo $prefup['email_body']; ?>" readonly>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="col-1">
                        <label for="" class="col-form-label">Delete</label>
                        <?php foreach($prefups as $prefup) : ?>
                            <div class="mb-2">
                                <input type="hidden" name="delete_id_prefup" value="<?php echo $prefup['id']; ?>">
                                <input type="submit" name="delete2" class="btn btn-sm btn-danger" value="-">
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div> 
        </div>
    </form>
</div>

<?php include 'inc/footer.inc.php'; ?>