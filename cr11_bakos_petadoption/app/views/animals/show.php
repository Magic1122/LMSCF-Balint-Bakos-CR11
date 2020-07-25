<?php require APPROOT . '/views/inc/header.php'; ?>
<?= flash('animal_message'); ?>
<a href="<?= URLROOT; ?>/animals" class="btn btn-light mb-3"><i class="fa fa-backward"></i> Back</a>
<br>


<div class="card text-center mt-5 mb-2">
    <div class="card-header">
        <strong>Hello I am <?= $data['animal']->animal_name ?></strong>
    </div>
    <div class="card-body">
        <img style="max-width: 500px;" src="<?= $data['animal']->animal_img ;?>" class="card-title"><img>
        <p class="card-text">Age: <?= $data['animal']->animal_age; ?></p>
        <p class="card-text">I am a/an <?= strtoupper($data['animal']->breed) ;?></p>
        <p class="card-text">Description: <?= $data['animal']->animal_desc ;?></p>
        <p class="card-text">I like: <?=$data['animal']->animal_hobbies;?></p>
        <p class="card-text">I am available for adoption since <?=$data['animal']->animal_date;?></p>
        <p>You can reach me at  
            <?= $data['animal']->location_name . ' in ' .   $data['animal']->location_city . ',  ' . $data['animal']->location_address . ', ' . $data['animal']->location_zip; ?>
        </p>



    </div>
    <div class="card-footer text-muted">
        <span>Call us if U are Intersted</span>
        <br>
        <span>Uploaded by <?= $data['animal']->name; ?></span>
    </div>
</div>

<?php if ($_SESSION['admin']) : ?>
<a href="<?= URLROOT ?>/animals/edit/<?= $data['animal']->animal_id ?>" class="btn btn-dark">Edit</a>
<form class="pull-right" action="<?= URLROOT; ?>/animals/delete/<?= $data['animal']->animal_id ?>" method="POST">
    <input type="submit" value="Delete" class="btn btn-danger">
</form>
<?php endif ?>


<?php require APPROOT . '/views/inc/footer.php'; ?>
