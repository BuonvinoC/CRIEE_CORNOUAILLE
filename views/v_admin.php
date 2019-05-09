<head>
<link href="<?php echo base_url('css/commentaire.css');?>" rel="stylesheet" type="text/css">
<link href="<?php echo base_url('css/catalogue.css');?>" rel="stylesheet" type="text/css">
</head>



<table>
  <tr>
    <th>Reférence lot</th>
    <th>Nom du lot</th>
    <th>Poisson</th>
    <th>Date de peche</th>
    <th>poids</th>
    <th>Valider le lot</th>
  </tr>
        <?php
        foreach ($donnees as $row) {?>
  <tr>
    <td><?php echo $row['idLot'];?></td>
    <td><?php echo $row['libelleLot'];?></td>
    <td><?php echo $row['poisson'];?></td>
    <td><?php echo $row['datePeche'];?></td>
    <td><?php echo $row['poids'];?></td>
    <td>
      <?php
      if ($this->session->userdata('logged_in')!=FALSE){
      echo "<br/><br/>";
      echo form_open('utilisateur/valider_lot/');
      $prix= array(
      'name'=>'prixLot',
      'id'=>'prixLot',
      'placeholder'=>'Prix du lot',
      'type'=>'text',
      "value"=>set_value('Commentaire')
      );
      echo form_input($prix);
      echo "<br/><br/>";
      $dateFinEnchere= array(
      'name'=>'dateFinEnchere',
      'id'=>'dateFinEnchere',
      'placeholder'=>'Date de fin de lenchère',
      'type'=>'text',
      "value"=>set_value('Commentaire')
      );
      echo form_input($dateFinEnchere);
      echo "<br/><br/>";
      echo form_hidden('lbl',$row['libelleLot']);
      echo form_hidden('poi',$row['poisson']);
      echo form_hidden('datePeche',$row['datePeche']);
      echo form_hidden('poids',$row['poids']);
      echo "<br/><br/>";
      echo form_submit('envoi','Valider lot');
      echo form_close();
      }
      ?>
    </td>
  </tr>
        <?php } ?>
</table>
