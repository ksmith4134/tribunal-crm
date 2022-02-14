<?php
include 'inc/autoloader.inc.php';
include 'inc/config.inc.php';
include 'inc/header.inc.php';
include 'inc/nav.inc.php';

$create = new ViewSettings();
$create->createNewRep();

?>

<div class="col-11 mx-auto">
    <br>
    <form method="POST" action="" class="mb-4">
        <div class="d-flex flex-row my-3">
            <div class="" style="margin:0px 20px 0px 0px;">
                <h4>New Sales Rep</h4>
            </div>
            <div class="px-2">
                <button type="submit" name="submit" class="btn btn-sm btn-primary">Submit</button>
            </div>
        </div>
        <div class="row pb-3 mb-2 pt-2 bg-light">            
            <div class="form-group">
                <label for="" class="col-form-label"><strong>Enter Sales Rep Info</strong></label>
                <div class="row">
                    <div class="col-2">
                        <label for="" class="col-form-label">Full Name</label>
                        <div class="mb-2">
                            <input type="text" name="full_name" class="form-control form-control-sm">
                        </div>
                    </div>
                    <div class="col-1">
                        <label for="" class="col-form-label">EXP</label>
                        <div class="mb-2">
                            <input type="text" name="experience_level" class="form-control form-control-sm">
                        </div>
                    </div>
                    <div class="col-2">
                        <label for="" class="col-form-label">Phone</label>
                        <div class="mb-2">
                            <input type="text" name="phone" class="form-control form-control-sm">
                        </div>
                    </div>
                    <div class="col-2">
                        <label for="" class="col-form-label">Email</label>
                        <div class="mb-2">
                            <input type="text" name="email" class="form-control form-control-sm">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<?php include 'inc/footer.inc.php'; ?>