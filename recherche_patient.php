<div class="col-lg-12 mt-2">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Trouver Patient</h4>
        </div>
        <div class="card-body">
            <div class="general-label">
                <form name="form_search" method="get" action="personnel.php">
<input type="hidden" value="search_patient" name="page">
                    <div class="form-group row">
                        <label for="sexe" class="col-sm-2 col-form-label font-weight-bold">Rechercher par </label>
                        <div class="col-sm-4">
                            <select id="search" class="form-control" name="skey" required>
                                <option value="nom_prenom">Nom & Prénom</option>
                                <option value="email">Adresse mail</option>
                                <option value="tel">Tél</option>
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <input type="text" name="svalue" class="form-control"
                                   placeholder="Zone de recherche" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-10 ml-auto">
                            <button type="submit" class="btn btn-primary">Valider</button>
                        </div>
                    </div>
                </form>
            </div>
        </div><!--end card-body-->
    </div><!--end card-->
</div>
<?php if(isset($_GET['skey'])){?>
<div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Patients trouvés</h4>
            </div><!--end card-header-->
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped mb-0">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nom & Prénom</th>
                            <th>Sexe</th>
                            <th>Date de naissance</th>
                            <th>Email</th>
                            <th>Tél</th>
                            <th class="text-right">Fiche</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        include '../Models\Patient.php';
                        $p = new \Medical\Patient();
                        $patients = $p->search_patient($_GET['skey'],$_GET['svalue']);
                        foreach ($patients as $patient) { ?>
                            <tr>
                                <td><?= $patient[0] ?></td>
                                <td><?= $patient[1] ?></td>
                                <td><?= $patient[2] ?></td>
                                <td><?= $patient[3] ?></td>
                                <td><?= $patient[4] ?></td>
                                <td><?= $patient[5] ?></td>
                                <td class="text-right">
                                    <a href="personnel.php?page=fiche_patient&patient_id=<?= $patient[0] ?>"><i class="las la-pen text-info font-18"></i></a>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
