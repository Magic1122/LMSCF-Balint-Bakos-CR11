<?php require APPROOT . '/views/inc/header.php'; ?>
<?= flash('users_message'); ?>

<div class="row mb-3">
    <div class="col-md-6">
        <h1>Root Panel</h1>
    </div>
    <div class="col-md-6">
        <?php if (isAdmin()) : ?>
        <a href="<?php echo URLROOT ?>/animals/admin" class="btn btn-primary pull-right">
            <i class="fa fa-pencil"></i> Go to Admin Panel
        </a>
    <?php endif ?>
    </div>
    <div class="col-md-12">
        <form id='search-form' class="form-inline">
            <input type="text" class="form-control d-block w-100" placeholder="Search for Users by their name...">
        </form>
    </div>
</div>
<h1>Users</h1>
<div class="row mt-5 d-flex justify-content-center" id="users">
</div>


<?php require APPROOT . '/views/inc/footer.php'; ?>