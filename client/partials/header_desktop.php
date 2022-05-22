<header class="header-desktop2">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap2">
                            <div class="logo d-block d-lg-none">
                                <a href="#">
                                    <img src="images/icon/logo-simple.png" alt="CoolAdmin" />
                                </a>
                            </div>
                            <?php
if(isset($_SESSION['sessionOn']) && !empty($_SESSION['sessionOn'])){

    echo '<div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
    <span class="badge badge-pill badge-danger">Erreur</span>'.$_SESSION['sessionOn'].'
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>';

unset($_SESSION['sessionOn']);
 }else{

 }
?>
                        
                            <div class="header-button2">
                                <div class="header-button-item js-item-menu">
                                    <i class="zmdi zmdi-search"></i>
                                    <div class="search-dropdown js-dropdown">
                                        <form action="">
                                            <input class="au-input au-input--full au-input--h65" type="text" placeholder="recherche de données &amp; de raports..." />
                                            <span class="search-dropdown__icon">
                                                <i class="zmdi zmdi-search"></i>
                                            </span>
                                        </form>
                                    </div>
                                </div>
                                <?php
                                         $mes=$bdd->prepare('SELECT * FROM messages WHERE destinataire = :des AND lu=0');
                                         $mes->execute([
                                         'des'=>$_SESSION['Ccode']
                                         ]);
                                         $nb=$mes->fetchAll(PDO::FETCH_OBJ);
                                         $li=$mes->rowCount();
                                    ?>
                                <div class="header-button-item has-noti js-item-menu">
                                    <i class="zmdi zmdi-notifications"><?= $li ?></i>
                                    <div class="notifi-dropdown js-dropdown">

                                   
                                        <div class="notifi__title">
                                            <p>Vous avez <?= $li ?> Messages</p>
                                        </div>
                                        <?php foreach($nb as $key):  ?>
                                        <div class="notifi__item">
                                            <div class="bg-c1 img-cir img-40">
                                                <i class="zmdi zmdi-email-open"></i>
                                            </div>
                                            <div class="content">
                                                <p><?= $key->auteur ?> vous a écris </p>
                                                <span class="date"><?= $key->date ?></span>
                                            </div>
                                        </div>
                                        <?php endforeach ?>
                                        <div class="notifi__footer">
                                            <a href="message.php">Voir tous</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="header-button-item mr-0 js-sidebar-btn">
                                    <i class="zmdi zmdi-menu"></i>
                                </div>
                                <div class="setting-menu js-right-sidebar d-none d-lg-block">
                                    <div class="account-dropdown__body">
                                        <div class="account-dropdown__item">
                                            <a href="profil.php">
                                                <i class="zmdi zmdi-account"></i>Profil</a>
                                        </div>
                                        <div class="account-dropdown__item">
                                            <a href="#">
                                                <i class="zmdi zmdi-settings"></i>Paramètre</a>
                                        </div>
                                        <div class="account-dropdown__item">
                                            <a href="#">
                                                <i class="zmdi zmdi-money-box"></i>Facturations</a>
                                        </div>
                                    </div>
                                    <div class="account-dropdown__body">
                                    <div class="container">
                                    <div class="row">
                        <div class="col-md-12">
                        <?php
     if(isset($_POST)){ 
    extract($_POST);
    if(!empty($to) && !empty($message)){
    $ins=$bdd->prepare('INSERT INTO messages(contenu, auteur, destinataire) VALUE(:contenu, :auteur, :destinataire)');
    $ins->execute([
        'contenu'=>$message,
        'auteur'=>$_SESSION['Ccode'],
        'destinataire'=>'admin'
    ]);
    if($ins){
        echo 'Message envoyé <a href="table.php">Tous les membres ici...</a>';
    }
}
}
?>
                        <center><b>Envoyer un message a l'admin</b></center><br>
                       <form action="" method="post" class="form-horizontal">
                                            <div class="row form-group">
                                                <div class="col col-md-12">
                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-user"></i>
                                                        </div>
                                                        <input readonly type="text" id="to" value="admin" name="to" placeholder="message a..." class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-12">
                                                    <div class="input-group">
                                                        
                                                        <textarea id="message" name="message" class="form-control">taper le message ici...</textarea>
                                                        <div class="input-group-addon">.abc</div>
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
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>