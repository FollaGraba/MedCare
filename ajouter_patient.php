<div class="col-lg-9 mt-2">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Nouveau Patient</h4>
            <h5 class="text-danger text-center"><?php if(isset($_GET['message'])) echo $_GET['message']; ?></h5>
        </div><!--end card-header-->
        <div class="card-body">
            <div class="general-label">
                <form method="post" action="../controller/action.php?query=save_patient">
                    <div class="form-group row">
                        <label for="nomprenom" class="col-sm-2 col-form-label font-weight-bold">Nom & Prénom</label>
                        <div class="col-sm-10">
                            <input type="text" name="nom_prenom" class="form-control" id="nomprenom" placeholder="Nom & Prénom" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="sexe" class="col-sm-2 col-form-label font-weight-bold">Sexe</label>
                        <div class="col-sm-10">
                            <select id="sexe" class="form-control" name="sexe" required>
                                <option value="" selected>Choix</option>
                                <option value="Homme">Homme</option>
                                <option value="Femme">Femme</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="date_naissance" class="col-sm-2 col-form-label font-weight-bold">Date de naissance</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" id="date_naissance" name="date_naissance">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-sm-2 col-form-label font-weight-bold">Adresee mail</label>
                        <div class="col-sm-10">
                            <input type="email" name="email" class="form-control" id="email" placeholder="Adresse mail" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tel" class="col-sm-2 col-form-label font-weight-bold">Tél</label>
                        <div class="col-sm-10">
                            <input type="tel" name="tel" class="form-control" id="tel" placeholder="Numéro de téléphone">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-10 ml-auto">
                            <button type="submit" class="btn btn-primary">Valider</button>
                            <button type="reset" class="btn btn-danger">Anuuler</button>
                        </div>
                    </div>
                </form>
            </div>
        </div><!--end card-body--></div><!--end card--></div>