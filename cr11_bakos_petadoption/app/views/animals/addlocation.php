<?php require APPROOT . '/views/inc/header.php'; ?>

<a href="<?= URLROOT; ?>/animals/admin" class="btn btn-light"><i class="fa fa-backward"></i> Back</a>

<div class="card card-body bg-light mt-5">
    <h2>Add Publisher</h2>
    <p>Add a new publisher with this form</p>
    <form action="<?php echo URLROOT;?>/animals/addlocation/<?= $data['id'] ?>" method="POST">
        <div class="form-group">
            <label for="name">Name: <sup>*</sup></label>
            <input type="text" 
            name="name" 
            class="form-control form-control-lg 
            <?php echo (!empty($data['name_err'])) ? 'is-invalid' : ''; ?>"
            value="<?php echo $data['name']; ?>"
            >
            <span class="invalid-feedback"><?php echo $data['name_err']; ?></span>
        </div>
        <div class="form-group">
            <label for="address">Address: <sup>*</sup></label>
            <input
            type="text" 
            name="address" 
            class="form-control form-control-lg <?php echo (!empty($data['address_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['address']; ?>">
            <span class="invalid-feedback"><?php echo $data['address_err']; ?></span>
        </div>
        <div class="form-group">
            <label for="city">City: <sup>*</sup></label>
            <input
            type="text" 
            name="city" 
            class="form-control form-control-lg <?php echo (!empty($data['city_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['city']; ?>">
            <span class="invalid-feedback"><?php echo $data['city_err']; ?></span>
        </div>
        <div class="form-group">
            <label for="zip">Zip Code: <sup>*</sup></label>
            <input
            type="number" 
            name="zip" 
            class="form-control form-control-lg <?php echo (!empty($data['zip_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['zip']; ?>">
            <span class="invalid-feedback"><?php echo $data['zip_err']; ?></span>
        </div>
        <div class="form-group">
            <label for="img">Picture: <sup>*</sup></label>
            <input
            type="text" 
            name="img" 
            class="form-control form-control-lg <?php echo (!empty($data['img_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['img']; ?>">
            <span class="invalid-feedback"><?php echo $data['img_err']; ?></span>
        </div>
      
        <input type="submit" value="Submit" class="btn btn-success">
    </form>
</div>


<?php require APPROOT . '/views/inc/footer.php'; ?>