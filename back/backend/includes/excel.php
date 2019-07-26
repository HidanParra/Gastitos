<?php
  require_once '_db.php';

  global $db;
  
  header('Content-type:application/xls');
  header('Content-Disposition:attachment; filename=responsivas.xls');
  ?>
  <table>
    <thead>
      <tr>
        <th>#</th>
        <th>Asignada a</th>
        <th>Departamento</th>
        <th>Equipo</th>
        <th>Elaborado</th>
        <th>Alta</th>
        <th>Firmas</th>
      </tr>
    </thead>
    <tbody>
      <?php
                        //SELECT tabla1  INNER JOIN tabla2    EN LOS ID'S coincidentes
        $exportar = $db->select("responsivas",["[><]persona" => ["res_per" => "per_id"],
                                                  "[><]departamentos" => ["res_dpto" => "dpto_id"],
                                                  "[><]equipos" => ["res_epo" => "epo_id"],
                                                  "[><]administradores" => ["res_adm" => "adm_id"],
                                                  "[><]avance" => ["res_av" => "av_id"]
                                                  ],
                                           ["responsivas.res_id",
                                            "persona.per_nom",
                                            "departamentos.dpto_nom",
                                            "equipos.epo_nom",
                                            "administradores.adm_nom",
                                            "responsivas.res_fa",
                                            "avance.av_nom"]);

          foreach($exportar as $key => $exp){
      ?>
      <tr>
        <td><?php echo $exp["res_id"];?></td>
        <td><?php echo $exp["per_nom"];?></td>
        <td><?php echo $exp["dpto_nom"];?></td>
        <td><?php echo $exp["epo_nom"];?></td>
        <td><?php echo $exp["adm_nom"];?></td>
        <td><?php echo $exp["res_fa"];?></td>
        <td><?php echo $exp["av_nom"];?></td>
        <?php
            }
         ?>
      </tr>
    </tbody>
  </table>
<?php
?>
