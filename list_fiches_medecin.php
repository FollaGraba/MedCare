<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">List Fiches</h4>
                    <div class="text-right">
                        <a href="personnel.php?page=add_patient"  class="btn btn-primary btn-sm">Ajouter Patient</a>
                    </div>
            </div><!--end card-header-->
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped mb-0">
                        <thead>
                        <tr>
                            <th>ID Fiche</th>
                            <th>Patient</th>
                            <th>Date de naissance</th>
                            <th>Sexe</th>
                            <th>Date d'arrivé</th>
                            <th>Date Consultation</th>
                            <th>Note</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        include '..\Models\Medecin.php';
                        $p = new \Medical\Medecin();
                        $fiches = $p->getPatients();
                        foreach ($fiches as $fiche) { ?>
                            <tr>
                                <td><?= 'F'.$fiche[0] ?></td>
                                <td><?= $fiche[1] ?></td>
                                <td><?= $fiche[2] ?></td>
                                <td><?= $fiche[3] ?></td>
                                <td><?=date ('d-m-Y H:i',strtotime($fiche[4]))  ?></td>
                                <td><?= is_null($fiche[5]) ? '----' : date ('d-m-Y H:i',strtotime($fiche[5]))  ?></td>
                                <td><?= $fiche[6] ?></td>
                                <td class="text-left">
                                    <a href="#" title="Fiche Patient" ><i class="las la-folder text-info font-18"></i></a>
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