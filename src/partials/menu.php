<ul>
    <li>
        <a href="/">Home</a>
    </li>
    <?php
    /* si le user pas co il peut log ou sign in */
    if ($user === false) { ?>
    <li>
        <a href="/register.php">Register</a>
    </li>
    <li>
        <a href="/login.php">Login</a>
    </li>
    <?php } else { ?>
        <li><!-- si le user est set son pseudo s'affiche  il peut log ou voir le panier et ses commandes passées-->
        <?php if ($user != false) {
            echo $user->prenom;
        }
        else {
            echo 'pas co';
        }?>
        </li>
        
        <?php /* si le user est admin il peut acceder à ajouter un produit */
        if ($user->isAdmin == 1){ ?>
        <li>
            <a href="/addProduct.php">Ajouter un produit</a>
        </li>
        
        <?php } ?>
    <li>
        <a href="/actions/logout.php">Log OUT</a>
    </li>
    <li>
        <a href="/cart.php"> Voir le panier</a>
    </li>
    <li>
        <a href="/mes_commandes.php"> Voir les commandes passées</a>
    </li>
    <?php } ?>
</ul>
