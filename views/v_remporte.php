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
    </tr>
                <?php
                                $i=0;
                foreach ($donnees as $row) {?>
    <tr>

        <td><?php echo $row['idLot'];?></td>
        <td><?php echo $row['libelleLot'];?></td>
        <td><?php echo $row['prixActuel'];?></td>


 


    </tr>

                <?php $i++; } ?>

</table>