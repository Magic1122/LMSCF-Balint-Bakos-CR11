<?php require APPROOT . '/views/inc/header.php'; ?>
<?= flash('animal_message'); ?>



<a href="<?= URLROOT; ?>/animals/admin" class="btn btn-light"><i class="fa fa-backward"></i> Back</a>

<div class="card card-body bg-light mt-5">
    <h2>Add Animal</h2>
    <p>Create a pet with this form</p>
    <form action="<?php echo URLROOT;?>/animals/add" method="POST">
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
            <label for="age">Age: <sup>*</sup></label>
            <input
            id="age"
            type="number" 
            name="age" 
            class="form-control form-control-lg <?php echo (!empty($data['age_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['age']; ?>">
            <span class="invalid-feedback"><?php echo $data['age_err']; ?></span>
        </div>
        <div class="form-group">
            <label for="description">Desciption: <sup>*</sup></label>
            <input
            type="text" 
            name="description" 
            class="form-control form-control-lg <?php echo (!empty($data['description_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['description']; ?>">
            <span class="invalid-feedback"><?php echo $data['description_err']; ?></span>
        </div>
        <div class="form-group">
            <label for="img">Picture: <sup>*</sup></label>
            <input
            type="text" 
            name="img" 
            class="form-control form-control-lg <?php echo (!empty($data['img_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['img']; ?>">
            <span class="invalid-feedback"><?php echo $data['img_err']; ?></span>
        </div>
        <div class="form-group" id="hobbie-div">
            <label for="hobbies">Hobbies: <sup>*</sup></label>
            <input
            id="hobbies"
            type="text" 
            name="hobbies" 
            class="form-control form-control-lg <?php echo (!empty($data['hobbies_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['hobbies']; ?>">
            <span class="invalid-feedback"><?php echo $data['hobbies_err']; ?></span>
        </div>
        <div class="form-group" id="date-div">
            <label for="date">Became Available: <sup>*</sup></label>
            <input
            id="date"
            type="date" 
            name="date" 
            class="form-control form-control-lg <?php echo (!empty($data['date_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['date']; ?>">
            <span class="invalid-feedback"><?php echo $data['date_err']; ?></span>
        </div>
        <div class="form-group">
            <label for="type">Type: <sup>*</sup></label>
            <select
            name="type"
            id="type" 
            class="form-control form-control-lg <?php echo (!empty($data['type_err'])) ? 'is-invalid' : ''; ?>">
                <option value="">Choose a type</option>
                <option id="1" value="1">Small</option>
                <option id="2" value="2">Large</option>
                <option id="3" value="3">Senior</option>
            </select>
            <script type="text/javascript">
                document.getElementById('type').value = "<?php echo $data['type'] ;?>";
            </script>
            
            <span class="invalid-feedback"><?php echo $_POST['type_err']; ?></span>
        </div>
        <div class="form-group">
            <label for="breed">Breed: <sup>*</sup></label>
            <select
            name="breed" 
            id="breed"
            class="form-control form-control-lg <?php echo (!empty($data['breed_err'])) ? 'is-invalid' : ''; ?>">
                <option value="">Choose a breed</option>
                <?php
                    foreach ($data['breeds'] as $breed) {
                        echo "<option value='" . $breed->breed_id . "'>" . ucfirst($breed->breed) . "</option>";
                    }
                ?>
                <script type="text/javascript">
                document.getElementById('breed').value = "<?php echo $_POST['breed'];?>";
                </script>
                </select>
            <span class="invalid-feedback"><?php echo $data['breed_err']; ?></span>
            <a href="<?php echo URLROOT;?>/animals/addbreed/0" class="btn btn-success mt-3">Add Breed</a>
        </div>
        <div class="form-group">
            <label for="location">Location: <sup>*</sup></label>
            <select
            name="location" 
            id="location"
            class="form-control form-control-lg <?php echo (!empty($data['location_err'])) ? 'is-invalid' : ''; ?>">
                <option value="">Choose a location</option>
                <?php
                    foreach ($data['locations'] as $location) {
                        echo "<option value='" . $location->location_id . "'>" . $location->location_name . "</option>";
                    }
                ?>
                </select>
               <script type="text/javascript">
                document.getElementById('location').value = "<?php echo $_POST['location'] ;?>";
            </script>
            <span class="invalid-feedback"><?php echo $data['location_err']; ?></span>
            <a href="<?php echo URLROOT;?>/animals/addlocation/0" class="btn btn-success mt-3">Add Location</a>
        </div>
        <input type="submit" value="Submit" class="btn btn-success">
    </form>
</div>


<?php require APPROOT . '/views/inc/footer.php'; ?>