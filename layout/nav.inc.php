<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <?php echo '<img src="'.$MainUrl.'img/logo.svg" width="30" height="30" class="d-inline-block align-top" alt="">';?>   
            </a>
            <?php echo '<a class="navbar-brand" href="'.$MainUrl.'index.php">'.$MainTitle.'</a>';?>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <?php echo '<a class="nav-link" aria-current="page" href="'.$MainUrl.'vues/products.php">Products</a>';?>
                    </li>
                    <?php if (isset($_SESSION['username'])): ?>     
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown1" role="button1" data-bs-toggle="dropdown" aria-expanded="false">
                                Administration
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown1">
                                <li>
                                    <?php echo '<a class="dropdown-item" href="'.$MainUrl.'vues/admin/products.php">Products management</a>';?>
                                </li>
                                <li>
                                    <?php echo '<a class="dropdown-item" href="'.$MainUrl.'vues/admin/users.php">Users management</a>';?>
                                </li>
                                <li>
                                    <?php echo '<a class="dropdown-item" href="#">Lien3</a>';?>
                                </li>
                            </ul>
                        </li>  
                    <?php endif; ?> 
                    <?php if (isset($_SESSION['username'])): ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown2" role="button2" data-bs-toggle="dropdown" aria-expanded="false">
                                Api documentation
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown2">
                                <li>
                                    <?php echo '<a class="dropdown-item" href="'.$MainUrl.'vues/apidoc/products.php">Products</a>';?>
                                </li>
                                <li>
                                    <?php echo '<a class="dropdown-item" href="#">Lien2</a>';?>
                                </li>
                            </ul>
                        </li>
                    <?php endif; ?>                   
                </ul>                  
                <?php if (isset($_SESSION['username'])): ?>
                    <span class="navbar-text px-2">
                        <?php echo '<a class="nav-link" href="'.$MainUrl.'vues/logout.php">Deconnexion</a>';?>
                    </span> 
                    <span class="navbar-text px-2">
                        <?php echo '<a class="nav-link" href="'.$MainUrl.'vues/user.php">'.$_SESSION['username'].'</a>';?>
                    </span>  
                <?php else: ?>
                    <span class="navbar-text px-2">
                        <?php echo '<a class="nav-link" href="'.$MainUrl.'vues/login.php">Connexion</a>';?>
                    </span>  
                    <span class="navbar-text px-2">
                        <?php echo '<a class="nav-link" href="'.$MainUrl.'vues/register.php">S\'enregistrer</a>';?>
                    </span>                   
                    <!--<a class="nav-link" href="register.php">Register</a>-->
                <?php endif; ?>   
                   
            </div>
        </div>
    </nav>
</header>
    
<main class="container">