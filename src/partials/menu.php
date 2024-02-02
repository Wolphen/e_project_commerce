<ul>
    <li>
        <a href="/">Home</a>
    </li>
    <?php
    if ($user === false) { ?>
    <li>
        <a href="/register.php">Register</a>
    </li>
    <li>
        <a href="/login.php">Login</a>
    </li>
    <?php } else { ?>
        <li>
        <?php if ($user != false) {
            echo $user->prenom;
        }
        else {
            echo 'pas co';
        }?>
        </li>
        
        <?php
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
    <?php } ?>
</ul>
