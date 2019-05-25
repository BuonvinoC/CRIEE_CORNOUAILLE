<head>
<link href="<?php echo base_url('css/catalogue.css');?>" rel="stylesheet" type="text/css">
</head>

<head>
<link href="<?php echo base_url('css/catalogue.css');?>" rel="stylesheet" type="text/css">
<script src="<?php echo base_url('js/jquery.js');?>"></script>
</head>

<table>
    <tr>
        <th>Reference Lot</th>
        <th>Libelle Lot</th>
        <th>Prix d'achat</th>
        <th>Noter le Lot</th>
    </tr>
                <?php
                                $i=0;
                foreach ($donnees as $row) {?>
    <tr>

        <td><?php echo $row['idLot'];?></td>
        <td><?php echo $row['libelleLot'];?></td>
        <td><?php echo $row['prixActuel'];?></td>
        <td><?php if($row['noteLot'])
        {
            echo $row['noteLot'] . '/100';
        }
        else
        {
                echo form_open('utilisateur/ajouter_note');
                $note= array(
                'name'=>'ajoutNote',
                'id'=>'ajoutNote',
                'placeholder'=>'Une note sur 100',
                "value"=>set_value('ajoutNote')
                );
                echo form_input($note);
                echo form_hidden('idL',$row['idLot']);
                echo form_submit('envoi','Noter');
                echo form_close();
        }
            ?></td>


 


    </tr>

                <?php $i++; } ?>

</table>
