<head>
<link href="<?php echo base_url('css/catalogue.css');?>" rel="stylesheet" type="text/css">
<script src="<?php echo base_url('js/jquery.js');?>"></script>
</head>

<table>
	<tr>
		<th>Reference Lot</th>
		<th>Prix actuel</th>
		<th>Acheteur Max</th>
		<th>Enchérir</th>
                <th>Temps restant</th>
	</tr>
				<?php
				foreach ($donnees as $row) {?>
	<tr>

		<td><?php echo $row['idLot'];?></td>
    <td><p><?php echo $row['prixActuel'];?></p></td>
		<td><?php echo $row['AcheteurMax'];?></td>


		<td>
			<?php
				echo form_open('utilisateur/encherir');
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
