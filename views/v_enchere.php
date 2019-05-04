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
		<td><?php
		date_default_timezone_set('Europe/Paris');
		$date=$row['dateFinEnchere'];
		$resultat_date = explode('-', $row['dateFinEnchere']);
		$resultat_heure = explode(':', $row['dateFinEnchere']);

		$annee = intval($resultat_date[0]);
		$mois = intval($resultat_date[1]);
		$jour = intval($resultat_date[2]);
		$heure = 10;
		// $heure = intval($resultat_heure[0]);
		$minute = intval($resultat_heure[1]);
		$seconde = intval($resultat_heure[2]);

		// echo $annee .'/' . $mois . '/' . $jour .'    ';
		// echo $heure . '/' . $minute . '/' . $seconde;
		// Heure, minute, seconde, mois, jour
		// $heureFinEnchere = mktime(10, 50, 0, 5, 30, $annee);
		$heureFinEnchere = mktime($heure, $minute, $seconde, $mois, $jour, $annee);
		$tps_restant = $heureFinEnchere - time();
		 if ($heureFinEnchere < time())
		 $heureDebutEnchere = mktime($heure, $minute, $seconde, $mois, $jour, ++$annee);
		 $tps_restant = $heureFinEnchere - time();
		//============ CONVERSIONS
		$i_restantes = $tps_restant / 60;
		$H_restantes = $i_restantes / 60;
		$d_restants = $H_restantes / 24;
		$s_restantes = floor($tps_restant % 60); // Secondes restantes
		$i_restantes = floor($i_restantes % 60); // Minutes restantes
		$H_restantes = floor($H_restantes % 24); // Heures restantes
		$d_restants = floor($d_restants); // Jours restants
		//==================
		setlocale(LC_ALL, 'fr_FR');
		echo
		   '</strong> <strong>' . $d_restants .'J </strong> <strong>'. $H_restantes .'H </strong>'
		   . ' <strong>'. $i_restantes .'MIN </strong> et <strong>'. $s_restantes .'s</strong>';
		?></td>

	</tr>
				<?php   } ?>


</table>
