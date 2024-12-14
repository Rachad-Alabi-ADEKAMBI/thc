<nav class="navbar navbar-expand-lg header">
  <a class="navbar-brand" href="index.php?action=homePage">
    <img src="public/images/logo-rond.png" alt="Service de livraisons de salades de fruits au benin" class="logo">
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" style="color: white"
    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
    aria-label="Toggle navigation">
    <span class="navbar-toggler-icon" style="color: white"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mx-auto">
      <li class="nav-item active">
        <a class="nav-link" href="index.php?action=homePage"><i class="fas fa-home"></i> Accueil</a>
      </li>

      <li class="nav-item active">
        <a class="nav-link" href="index.php?action=homePage#process"><i class="fas fa-truck"></i> Logistique</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="index.php?action=homePage#offers"> <i class="fas fa-book-open"></i> Catalogue</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="index.php?action=homePage#pricing"><i class="fas fa-tags"></i> Abonnements</a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="index.php?action=homePage#about">
          <i class="fas fa-info-circle"></i> A-propos
      </li>
    </ul>

    <?php
                    if (isset($_SESSION['user'])) { ?>
    <div class="header__list">

      <?php
     if ($_SESSION['user']['role'] == 'user') {?>
      <a class="" href="index.php?action=dashboardPage"><i class="fas fa-sign-in-alt"></i> Tableau de bord |</a> |
      <?php } else if($_SESSION['user']['role'] == 'admin'){ ?>
      <a class="" href="index.php?action=dashboardPageAdmin"><i class="fas fa-sign-in-alt"></i> Tableau de bord |</a> |
      <?php } ?>
      <a class="btn btn-exit" href="api/script.php?action=logout"><i class="fas fa-user-less"></i> Deconnexion</a>
    </div>
    <?php } else { ?>
    <div class="header__list">
      <a class="" href="index.php?action=loginPage"><i class="fas fa-sign-in-alt"></i> Se connecter | </a>
      <a class="btn btn-discovery" href="index.php?action=registerPage"><i class="fas fa-user-plus"></i> Wow ! Je
        m'inscris</a>
    </div>

    <?php } ?>
  </div>
</nav>