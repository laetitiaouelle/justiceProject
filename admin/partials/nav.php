<header class="header-desktop">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap">
                            <form class="form-header" action="" method="POST">
                                <input class="au-input au-input--xl" type="text" name="search" placeholder="recherche de données &amp; de raports..." />
                                <button class="au-btn--submit" type="submit">
                                    <i class="zmdi zmdi-search"></i>
                                </button>
                            </form>
                            <div class="header-button">
                                <div class="noti-wrap">

                                <div class="noti__item js-item-menu">
                                        <i title="Enregistrer Un Nouvel Achat" class="fas fa-shopping-basket"></i>
                                        
                                        <div class="mess-dropdown js-dropdown">
                                            <div class="mess__title">
                                                <p>Enregistrer Un Nouvel Achat</p>
                                            </div>
                                             <div class="container">
                                            <form action="addBuy.php" method="post" class="form-horizontal">
                                            <div class="row form-group">
                                                <div class="col col-md-12">
                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-user"></i>
                                                        </div>
                                                        <input type="text" id="userCode" name="userCode" placeholder="code de l'acheteur" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-12">
                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-sort-numeric-asc"></i>
                                                        </div>
                                                        <input type="number" id="quantite" name="quantite" placeholder="quantité" class="form-control">
                                                        <div class="input-group-addon">.00</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-12">
                                                    <div class="input-group">
                                                        <input type="password" id="password" name="password" placeholder="Votre mot de passe" class="form-control">
                                                        <div class="input-group-addon">
                                                            <i class="fa  fa-key"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-12">
                                                    <div class="input-group">
                                                        <input type="submit" value="envoi" class="form-control btn btn-primary">
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </form>
                                        </div>
                                        </div>
                                    </div>
                                    <?php
                                         $mes=$bdd->prepare('SELECT * FROM messages WHERE destinataire ="admin" AND lu=0 ');
                                         $mes->execute();
                                         $nb=$mes->fetchAll(PDO::FETCH_OBJ);
                                         $li=$mes->rowCount();
                                    ?>
                                    <div class="noti__item js-item-menu">
                                        <i class="zmdi zmdi-comment-more"></i>
                                        <span class="quantity"><?= $li ?></span>
                                        <div class="mess-dropdown js-dropdown">
                                            
                                            <div class="notifi__title">
                                            <p>Vous avez <?= $li ?> Messages</p>
                                        </div>
                                        <?php foreach($nb as $key):  ?>
                                              <?php
                                                     $n=$bdd->prepare('SELECT * FROM membres WHERE code=:code');
                                                     $n->execute(['code'=>$key->auteur]);
                                                     $au=$n->fetch();
                                             ?>
                                        <div class="notifi__item">
                                            <div class="bg-c1 img-cir img-40">
                                                <i class="zmdi zmdi-email-open"></i>
                                            </div>
                                            <div class="content">
                                                <p><?= $au['nom'].' '.$au['prenom'] ?> vous a écris </p>
                                                <span class="date"><?= $key->date ?></span>
                                                <p><?= substr($key->contenu,0, 30) ?>...</p>
                                            </div>
                                            
                                        </div>
                                        <?php endforeach ?>
                                            <div class="mess__footer">
                                                <a href="message.php">Tous les messages</a>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="noti__item js-item-menu">
                                        <i class="zmdi zmdi-notifications"></i>
                                        <span class="quantity"></span>
                                        <div class="notifi-dropdown js-dropdown">
                                            <div class="notifi__title">
                                                <p>les dernières modifications</p>
                                            </div>
                                            <?php
                                                  $noti=$bdd->prepare('SELECT * FROM notifications ORDER BY date DESC LIMIT 5');
                                                  $noti->execute();
                                                  $nots=$noti->fetchAll(PDO::FETCH_OBJ);
                                            ?>
                                            <?php   ?>
                                            <?php  foreach($nots as $not): ?>
                                            <div class="notifi__item">
                                                <div class="bg-c1 img-cir img-40">
                                                    <i class="zmdi zmdi-email-open"></i>
                                                </div>
                                                <div class="content">
                                                    <p><?= $not->titre ?></p>
                                                    <span class="date"><?= $not->date ?></span>
                                                </div>
                                            </div>
                                            <?php endforeach ?>
                                            <div class="notifi__footer">
                                                <a href="notification.php">Voir tous</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="account-wrap">
                                    <div class="account-item clearfix js-item-menu">
                                        <div class="image">
                                            <img src="images/avatar.png" alt="John Doe" />
                                        </div>
                                        <div class="content">
                                            <a class="js-acc-btn" href="#"><?= $admin['pseudo'] ?></a>
                                        </div>
                                        <div class="account-dropdown js-dropdown">
                                            <div class="info clearfix">
                                                <div class="image">
                                                    <a href="#">
                                                        <img src="images/avatar.png" alt="John Doe" />
                                                    </a>
                                                </div>
                                                <div class="content">
                                                    <h5 class="name">
                                                        <a href="#"><?= $admin['pseudo'] ?></a>
                                                    </h5>
                                                    <span class="email"><?= $admin['email'] ?></span>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__body">
                                                <div class="account-dropdown__item">
                                                    <a href="setting.php">
                                                        <i class="zmdi zmdi-settings"></i>paramètre</a>
                                                </div>
                                                <div class="account-dropdown__item">
                                                    <a href="facturations.php">
                                                        <i class="zmdi zmdi-money-box"></i>Facturations</a>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__footer">
                                                <a href="logout.php">
                                                    <i class="zmdi zmdi-power"></i>Déconnexion</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header><?php require('partials/sidenav.php'); ?>