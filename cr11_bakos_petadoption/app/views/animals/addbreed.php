<?php require APPROOT . '/views/inc/header.php'; ?>

<a href="<?= URLROOT; ?>/animals/admin" class="btn btn-light"><i class="fa fa-backward"></i> Back</a>

<div class="card card-body bg-light mt-5">
    <h2>Add Breed</h2>
    <p>Add a new breed with this form</p>
    <form action="<?php echo URLROOT;?>/animals/addbreed/<?= $data['id'] ?>" method="POST">
        <div class="form-group">
            <label for="breed">Breed Name: <sup>*</sup></label>
            <input type="text" 
            name="breed" 
            class="form-control form-control-lg 
            <?php echo (!empty($data['breed_err'])) ? 'is-invalid' : ''; ?>"
            value="<?php echo $data['breed']; ?>"
            >
            <span class="invalid-feedback"><?php echo $data['breed_err']; ?></span>
        </div>
        <input type="submit" value="Submit" class="btn btn-success">
    </form>
</div>


<?php require APPROOT . '/views/inc/footer.php'; ?>