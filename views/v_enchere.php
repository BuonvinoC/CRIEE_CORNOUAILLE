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


                //$Utilisateur->finEnchere($row['libelleLot'], $row['prixActuel'], $row['AcheteurMax']);
							//	$this->method_call->finEnchere($row['libelleLot'], $row['prixActuel'], $row['AcheteurMax']);


                ?>


                    <?php
                        //echo ($d_restants. 'J ' . $H_restantes .'H '. $i_restantes. 'MIN et '. $s_restantes .'s ');?>
												<div id="time">
		    <span id="jour">jj</span>:<span id="hour">hh</span>:<span id="min">mm</span>:<span id="sec">ss</span>
		</div>
<script>
		setInterval(update, 1000);
		function update() {
		  var date = new Date()

			var jours = <?php echo $d_restants ?>;
		  if (hours < 10) jours = '0'+jours
		  document.getElementById('hour').innerHTML = jours

		  var hours = <?php echo $H_restantes ?>;
		  if (hours < 10) hours = '0'+hours
		  document.getElementById('hour').innerHTML = hours

		  var minutes = <?php echo $i_restantes ?>;
		  if (minutes < 10) minutes = '0'+minutes
		  document.getElementById('min').innerHTML = minutes

		  var seconds = <?php echo $s_restantes ?>;
		  if (seconds < 10) seconds = '0'+seconds
		  document.getElementById('sec').innerHTML = seconds
		}
</script>


										<?php
							      if ($this->session->userdata('logged_in')!=FALSE){
							      echo "<br/><br/>";
							      echo form_open('utilisateur/finEnchere/');

							      echo form_hidden('idLot',$row['idLot']);
							      //echo form_hidden('prx',$row['prixActuel']);
							      //echo form_hidden('acht',$row['AcheteurMax']);
							      echo "<br/><br/>";
							      echo form_submit('envoi','Valider lot',['onclick'=>'this.form.submit()','id'=>$i.'valider']);
							      echo form_close();
							      }
							      ?>


										<script type="text/javascript">

										function eventFire(el, etype){
											  if (el.fireEvent) {
											    el.fireEvent('on' + etype);
											  } else {
											    var evObj = document.createEvent('Events');
											    evObj.initEvent(etype, true, false);
											    el.dispatchEvent(evObj);
											  }
											}

										var date1 = new Date("<?php echo $annee?>-<?php if($mois<10) echo ("0")?><?php echo $mois?>-<?php if($jour<10) echo ("0")?><?php echo $jour?>T<?php if($heure<10) echo ("0")?><?php echo $heure?>:<?php if($minute<10) echo ("0")?><?php echo $minute?>:<?php if($seconde<10) echo ("0")?><?php echo $seconde?>");

										var date = new Date();

										if (date1 <= date)
										{
												var submit = document.getElementById("<?php echo $i?>valider");
												console.log(submit);
												eventFire(submit, 'click');
												event.preventDefault();

										}


												// expected output: "NOT positive"
										</script>



                               </td>


	</tr>

				<?php $i++; } ?>

</table>
