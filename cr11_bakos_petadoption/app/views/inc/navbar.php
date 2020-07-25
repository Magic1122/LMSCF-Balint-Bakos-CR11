<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-3">
  <div class="container">

    <a class="navbar-brand" href="<?php echo URLROOT; ?>"><?php echo SITENAME; ?></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a class="nav-link" href="<?php echo URLROOT; ?>">Home</a>
        </li>
        <?php if (isLoggedIn()) : ?>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo URLROOT; ?>/animals/general">Small and Large Pets</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo URLROOT; ?>/animals/senior">Senior Pets</a>
          </li>
        <?php endif; ?>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo URLROOT; ?>/pages/about">About</a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        <?php if (isLoggedIn()) : ?>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo URLROOT; ?>/animals">Welcome <?= $_SESSION['user_name']; ?></a>
          </li>
          <?php if (isAdmin()) : ?>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo URLROOT; ?>/animals/admin">Admin</a>
            </li>
          <?php endif; ?>
          <?php if (isRoot()) : ?>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo URLROOT; ?>/users/root">Root</a>
            </li>
          <?php endif; ?>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo URLROOT; ?>/users/logout">Logout</a>
          </li>
        <?php else : ?>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo URLROOT; ?>/users/register">Register</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo URLROOT; ?>/users/login">Login</a>
          </li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>