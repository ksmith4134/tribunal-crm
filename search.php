<?php
include 'inc/autoloader.inc.php';

$object2 = new Search2;
$results = $object2->searchy2($_REQUEST['q']);

if(!empty($results)){ ?>
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">Company Name</th>
                <th scope="col">Co. ID</th>
                <th scope="col">Link</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($results as $result) : ?>
                <tr>
                    <th scope="row"><?php echo $result['co_name']; ?></th>
                    <td><?php echo $result['companyID']; ?></td>
                    <td><button class="btn btn-sm btn-warning" value="<?php echo $result['companyID']; ?>" onclick="linkToCompany(this.value)">Link</button></td>
                </tr>
            <?php endforeach; ?>  
        </tbody>
    </table>
<?php 
} else {
    echo "No suggestions. Create a new <a href=\"companies.php\">company</a> to link this lead.";
}
?>