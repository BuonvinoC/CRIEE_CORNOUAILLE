<head>
<link href="<?php echo base_url('css/catalogue.css');?>" rel="stylesheet" type="text/css">
<script src="<?php echo base_url('js/jquery.js');?>"></script>
</head>

<table>
	<tr>
		<th>Reference Lot</th>
                <th>Libelle Lot</th>
		<th>Prix actuel</th>
		<th>Acheteur Max</th>
		<th>Enchérir</th>
        <th>Temps restant</th>
	</tr>
				<?php
                                $i=0;
				foreach ($donnees as $row) {?>
	<tr>

		<td><?php echo $row['idLot'];?></td>
                <td><?php echo $row['libelleLot'];?></td>
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
                                
                                echo form_hidden('idL',$row['idLot']);
				echo form_submit('envoi','Ajouter');
				echo form_close();
			?>

			<!-- <input type="text" name="ajoutPrix"><br/>
			<input type="button" name="valider" value="Valider" onclick="window.location.reload()"><br/> -->
		</td>
		<td id="time <?php echo $i?>"><?php
		date_default_timezone_set('Europe/Paris');
		$dateF=$row['dateFinEnchere'];
                $datetime = new DateTime($dateF);
                
                $date = $datetime->format('Y-m-d');
                $time = $datetime->format('H:i:s');
                
		$resultat_date = explode('-', $date);
		$resultat_heure = explode(':', $time);

		$annee = intval($resultat_date[0]);
		$mois = intval($resultat_date[1]);
		$jour = intval($resultat_date[2]);
		//$heure = 10;
		$heure = intval($resultat_heure[0]);
		$minute = intval($resultat_heure[1]);
		$seconde = intval($resultat_heure[2]);

		// echo $annee .'/' . $mois . '/' . $jour .'    ';
		// echo $heure . '/' . $minute . '/' . $seconde;
		// Heure, minute, seconde, mois, jour
		// $heureFinEnchere = mktime(10, 50, 0, 5, 30, $annee);
		$heureFinEnchere = mktime($heure, $minute, $seconde, $mois, $jour, $annee);
		$tps_restant = $heureFinEnchere - time();
		
                                
                
			// echo form_close();
		
                
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
                
                $CI =& get_instance();
                $CI->finEnchere($row['idLot'], $row['libelleLot'], $row['prixActuel'], $row['AcheteurMax']);
                if ($tps_restant == 0)
                {
                echo "L enchere est terminée";}
                
                else {
                ?>
                    
                    
                    <script type="text/javascript">
                        var txt=<?php echo $d_restants ?> + 'J ' + <?php echo $H_restantes ?> +'H '
		   + <?php echo $i_restantes ?> +'MIN et '+ <?php echo $s_restantes ?> +'s ';
                   
                   function myFunction() {
                        setInterval(function(){ document.getElementById("time <?php echo $i?>").innerHTML = txt}, 1000);
                    }
                    </script>
                    
                    <?php  } ?>
                               </td>
                    

	</tr>

				<?php $i++; } ?>

</table>
