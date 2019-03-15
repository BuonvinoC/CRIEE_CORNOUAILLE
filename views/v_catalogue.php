<head>
<link href="<?php echo base_url('css/catalogue.css');?>" rel="stylesheet" type="text/css">
</head>

<table>
	<tr>
		<th>Photo</th>
		<th>Reference Lot</th>
		<th>Nom</th>
		<th>Nom Scientifique</th>
		<th>Prix actuel</th>
		<th>Acheteur Max</th>
		<th>Enchérir</th>
	</tr>
				<?php
				foreach ($donnees as $row) {?>
	<tr>

		<td> <img src="<?php echo base_url('/images/Poisson/'.$row['image']);?>"/></td>
		<td><?php echo $row['idEspece'];?></td>
		<td><?php echo $row['nomEsp'];?></td>
		<td><?php echo $row['nomSciEsp'];?></td>
                <td><p><?php echo $row['prixActuel'];?></p></td>
		<td><?php echo $row['acheteurMax'];?></td>


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

<table>
	<tr>
		<th>Photo</th>
		<th>Reference Lot</th>
		<th>Nom</th>
		<th>Nom Scientifique</th>
		<th>Prix actuel</th>
		<th>Acheteur Max</th>
		<th>Enchérir</th>
	</tr>
				<?php
				foreach ($donnees as $row) {?>
	<tr>

		<td> <img src=""/></td>
		<td>1</td>
		<td>thon</td>
		<td>athunamatata</td>
    <td><p>120</p></td>
		<td>100</td>


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
