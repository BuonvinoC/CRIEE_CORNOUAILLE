<head>
<link href="<?php echo base_url('css/catalogue.css');?>" rel="stylesheet" type="text/css">
</head>


<table>
	<tr>
		<th>Photo</th>
        <th>Espèce</th>
		<th>Référence Lot</th>
        <th>Libellé</th>
		<th>Poids du lot</th>
        <th>Prix</th>
                <th>
                    <?php
                        if ($this->session->userdata('login')=="admin"){                           
                        echo "Lancer enchère";
                        }
                        else {
                        echo "Ce lot m'interesse"; }
                            ?>
                        
                        
                </th>
	</tr>
				<?php
				foreach ($donnees as $row) {?>
	<tr>
<!-- select lot.idLot, lot.libelleLot, lot.PrixActuel, espece.nomEsp, espece.nomSciEsp, espece.image -->
		<td class="tdImg" style="background: no-repeat center url(<?php echo base_url('/images/Poisson/'.$row['image']);?>); background-size:contain " >  <a href="lien.shtm"></td > <!--<img class="imgEsp" src="<?php //echo base_url('/images/Poisson/'.$row['image']);?>"/> -->
		
		<td><?php echo $row['nomEsp'];?></td>
		<td><?php echo $row['idLot'];?></td>
        <td><?php echo $row['libelleLot'];?></td>
        <td><?php echo $row['poids'] ;?> kg</td>
       

        <td><?php echo $row['PrixActuel'];?> €</td>


                <td>
                    <?php
                        if ($this->session->userdata('login')=="admin"){
                            echo form_open('utilisateur/debuter_enchere/');        
                            $data = array(
                                    'name'=> 'enchere[]',
                                    'id'=> 'enchere',
                                    'value'=>$row['idLot']
                            );
                            echo form_checkbox($data);
                                            }
                        else {
                            echo form_open('utilisateur/debuter_enchere/');        
                            $data = array(
                                    'name'=> 'enchere[]',
                                    'id'=> 'enchere',
                                    'value'=>$row['idLot']
                            );
                            echo form_checkbox($data);
                                                    }
                            ?>
                </td>

	</tr>
				<?php  } ?>
</table>

<?php echo form_submit("go","go") ;?>
