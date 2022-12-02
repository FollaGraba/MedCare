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
                            <th>Docteur</th>
                            <th>Service</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        include '../Models\Patient.php';
                        $p = new \Medical\Patient();
                        $fiches = $p->list_fiches();
                        foreach ($fiches as $fiche) { ?>
                            <tr>
                                <td><?= 'F'.$fiche[0] ?></td>
                                <td><?= $fiche[1] ?></td>
                                <td><?= $fiche[2] ?></td>
                                <td><?= $fiche[3] ?></td>
                                <td><?=date ('d-m-Y H:i',strtotime($fiche[4]))  ?></td>
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