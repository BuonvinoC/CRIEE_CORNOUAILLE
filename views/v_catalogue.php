<head>
<link href="<?php echo base_url('css/catalogue.css');?>" rel="stylesheet" type="text/css">
</head>

<table>
	<tr>
		<th>Photo</th>
		<th>Reference Lot</th>
		<th>Libelle</th>
		<th>Date Peche</th>
		<th>Prix actuel</th>
		<th>Enchérir</th>
	</tr>
				<?php
				foreach ($donnees as $row) {?>
	<tr>
		<td></td>
		<!-- <td> <img src="<?php echo base_url('images/thon1.jpg');?>"/></td> --> <!-- .$row['denominationImageProduit'].'.png' -->
		<td><?php echo $row['idLot'];?></td>
		<td><?php echo $row['libelleLot'];?></td>
		<td><?php echo $row['datePeche'];?></td>
		<td><p><?php echo $row['prixActuel'];?></p></td>
		
		<td>
			<?php
				
				echo form_open('utilisateur/contenu/encherir');
					
					
				$montant= array(
				'name'=>'ajoutMontant',
				'id'=>'ajoutMontant',
				'placeholder'=>'Montant à ajouter',
				"value"=>set_value('ajoutMontant')
				);

				echo form_input($montant);

				echo form_submit('envoi','Ajouter');
					
				echo form_close();
				
				
			?>
		
			<!-- <input type="text" name="ajoutPrix"><br/>
			<input type="button" name="valider" value="Valider" onclick="window.location.reload()"><br/> -->
		</td>
		
	</tr>
				<?php  } ?>
</table>