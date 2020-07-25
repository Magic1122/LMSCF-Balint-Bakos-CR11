<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="row mb-3">
    <div class="col-md-6">
        <h1>Available Pets</h1>
    </div>
    <div class="col-md-6">
        <?php if ($_SESSION['admin']) : ?>
        <a href="<?php echo URLROOT ?>/animals/add" class="btn btn-primary pull-right">
            <i class="fa fa-pencil"></i> Add Animal
        </a>
    <?php endif ?>
    </div>
    <div class="col-md-12">
        <form id='search-form' class="form-inline">
            <input type="text" class="form-control d-block w-100" placeholder="Search for Pet type like Cat, Dog etc...">
        </form>
    </div>
</div>
<h1>Small</h1>
<div class="row mt-5 d-flex justify-content-center" id="small">

</div>
<h1>Large</h1>
<div class="row mt-5 d-flex justify-content-center" id="large">

</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>