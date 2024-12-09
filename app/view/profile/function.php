<?php
if (isset($_GET['dialog'])):
    if ($_GET['dialog'] == "change_data") {
?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <h4 class="alert-heading">Successfully added</h4>
            <p>Data Profile has been change</p>
            <hr>
            <div class="text-end">
                <button type="button" class="btn btn-default"
                    onclick="document.location.href = '../ui/header.php?page=profile&id_user=<?= $_GET['id_user'] ?>'"
                    data-bs-dismiss="alert" aria-label="Close">Close</button>
            </div>
        </div>
    <?php
    } else if ($_GET['dialog'] == "change_password") {
    ?>
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <h4 class="alert-heading">Successfully changed</h4>
            <p>Data Password has been changed</p>
            <hr>
            <div class="text-end">
                <button type="button" class="btn btn-default"
                    onclick="document.location.href = '../ui/header.php?page=profile&id_user=<?= $_GET['id_user'] ?>'"
                    data-bs-dismiss="alert" aria-label="Close">Close</button>
            </div>
        </div>
<?php
    }
endif;
