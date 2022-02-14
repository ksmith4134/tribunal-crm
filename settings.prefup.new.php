<?php
include 'inc/autoloader.inc.php';
include 'inc/config.inc.php';
include 'inc/header.inc.php';
include 'inc/nav.inc.php';

$create = new ViewSettings();
$create->createPreFUP();

?>

<div class="col-11 mx-auto">
    <br>
    <form method="POST" action="" class="mb-4">
        <div class="d-flex flex-row my-3">
            <div class="" style="margin:0px 20px 0px 0px;">
                <h3>New Pre-contact FUP process</h3>
            </div>
            <div class="px-2">
                <button type="submit" name="submit" class="btn btn-sm btn-primary">Submit</button>
            </div>
        </div>
        <div class="row pb-3 mb-2 pt-2 bg-light">            
            <div class="col-8 form-group">
                <label for="" class="col-form-label"><strong>Enter Process Info</strong></label>
                <div class="row">
                    <div class="col-2">
                        <label for="process" class="col-form-label">Process #</label>
                        <div class="mb-2">
                            <input type="text" name="process" class="form-control form-control-sm">
                        </div>
                    </div>
                    <div class="col-2">
                        <label for="step_num" class="col-form-label">Step #</label>
                        <div class="mb-2">
                            <input type="text" name="step_num" class="form-control form-control-sm">
                        </div>
                    </div>
                    <div class="col-2">
                        <label for="days" class="col-form-label">Days</label>
                        <div class="mb-2">
                            <input type="text" name="days" class="form-control form-control-sm">
                        </div>
                    </div>
                    <div class="col-2">
                        <label for="step_name" class="col-form-label">Step Title</label>
                        <div class="mb-2">
                            <input type="text" name="step_name" class="form-control form-control-sm">
                        </div>
                    </div>
                    <div class="col-4">
                        <label for="email_subject" class="col-form-label">Email Subject</label>
                        <div class="mb-2">
                            <input type="text" name="email_subject" class="form-control form-control-sm">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <label for="email_body" class="col-form-label">Email Body</label>
                        <div class="mb-2">
                            <input type="text" name="email_body" class="form-control form-control-sm">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<?php include 'inc/footer.inc.php'; ?>