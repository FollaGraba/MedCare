<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">List Patients</h4>
                    <div class="text-right">
                        <a href="personnel.php?page=add_patient"  class="btn btn-primary btn-sm">Ajouter Patient</a>
                    </div>
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
                            <th class="text-right">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        include '../Models\Patient.php';
                        $p = new \Medical\Patient();
                        $patients = $p->list_patient();
                        foreach ($patients as $patient) { ?>
                            <tr>
                                <td><?= $patient[0] ?></td>
                                <td><?= $patient[1] ?></td>
                                <td><?= $patient[2] ?></td>
                                <td><?= $patient[3] ?></td>
                                <td><?= $patient[4] ?></td>
                                <td><?= $patient[5] ?></td>
                                <td class="text-right">
                                    <a href="personnel.php?page=fiche_patient&patient_id=<?= $patient[0] ?>" title="Fiche Patient"><i class="las la-folder text-info font-18"></i></a>
                                    <a href="#" title="Modifier Patient"><i class="las la-pen text-info font-18"></i></a>
                                    <a href="#" title="Supprimer Patient"><i class="las la-trash-alt text-danger font-18"></i></a>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>