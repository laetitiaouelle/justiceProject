<?php
                       $userb=$bdd->prepare('SELECT * FROM membres WHERE id=:id and code=:code');
                       $userb->execute([
                           'id'=>$_SESSION['Cid'],
                           'code'=>$_SESSION['Ccode']
                       ]);
                       $resltb=$userb->fetch();
            ?>
<aside class="menu-sidebar2">
            <div class="logo">
                <a href="#">
                    <img src="images/icon/logo-simple.png" alt="Cool Admin" />
                </a>
            </div>
            <div class="menu-sidebar2__content js-scrollbar1">
                <div class="account2">
                    <div class="image img-cir img-120">
                    <img src="<?php if(!empty($resltb['avatar'])){echo 'images/'.$_SESSION['Cid'].'_'.$resltb['avatar'];}else{ echo'images/avatar.png'; }  ?>" alt="<?= $_SESSION['Cnom'].' '. $_SESSION['Cprenom'] ?>" />
                    </div>
                    <h4 class="name"><?= $_SESSION['Cnom'].' '. $_SESSION['Cprenom'] ?></h4>
                    <a href="logout.php">Déconnexion</a>
                </div>
                <nav class="navbar-sidebar2">
                    <ul class="list-unstyled navbar__list">
                        <li class="active has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-tachometer-alt"></i>Administration
                                <span class="arrow">
                                    <i class="fas fa-angle-down"></i>
                                </span>
                            </a>
                           
                        </li>
                        <li>
                            <a href="familytree.php">
                                <i class="fas fa-chart-bar"></i>Arbre généalogique</a>
                            
                        </li>
                        
                        <li class="has-sub">
                            <a class="js-arrow" href="childs.php">
                                <i class="fas fa-users"></i>Enfants Directs
                            </a>
                        </li>
                        <li class="has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-shopping-basket"></i>Gains
                                <span class="arrow">
                                    <i class="fas fa-angle-down"></i>
                                </span>
                            </a>
                            <ul class="list-unstyled navbar__sub-list js-sub-list">
                                <li>
                                    <a href="gain1.php">
                                        <i class="fas fa-sign-in-alt"></i>Bonus 1&2</a>
                                </li>
                                <li>
                                    <a href="equipe.php">
                                        <i class="fas fa-user"></i>Bonus d'équipe</a>
                                </li>
                                <li>
                                    <a href="unilevel.php">
                                        <i class="fas fa-unlock-alt"></i>Unilevel</a>
                                </li>
                                <li>
                                    <a href="stairstep.php">
                                        <i class="fas fa-unlock-alt"></i>Stairstep</a>
                                </li>
                                <li>
                                    <a href="profit.php">
                                        <i class="fas fa-unlock-alt"></i>GLOBAL POOL PROFIT</a>
                                </li>
                            </ul>
                        </li>
                        <li class="has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-desktop"></i>Service d'aide
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>