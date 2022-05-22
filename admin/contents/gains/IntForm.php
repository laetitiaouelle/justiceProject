<div style="position: relative; left:100px;" class="noti__item js-item-menu">
                                        <i title="Payement Intermediaire" class="fa fa-indent"></i>
                                        
                                        <div class="mess-dropdown js-dropdown">
                                            <div class="mess__title">
                                                <p>Payement Intermediaire</p>
                                            </div>
                                             <div class="container">
                                            <form action="addPayement.php" method="post" class="form-horizontal">
                                            <div class="row form-group">
                                                <div class="col col-md-12">
                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-user"></i>
                                                        </div>
                                                    <select name="bonus" id="selectLg" class="form-control-lg form-control">
                                                        <option value="0">Type de Bonus</option>
                                                        <option value="parrainageDirect">Parrainage Direct</option>
                                                        <option value="unilevel">Unilevel</option>
                                                    </select>                                                   </div>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-12">
                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-sort-numeric-asc"></i>
                                                        </div>
                                                        <input type="number" id="montant" name="montant" placeholder="Montant en Fcfa" class="form-control">
                                                        <div class="input-group-addon">Fcfa</div>
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