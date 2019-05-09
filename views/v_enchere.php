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

		<p id="<?php echo $i?>demo"></p>




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

										<script>
										// Set the date we're counting down to
										var countDownDate<?php echo $i?> = new Date("<?php echo $annee?>-<?php if($mois<10) echo ("0")?><?php echo $mois?>-<?php if($jour<10) echo ("0")?><?php echo $jour?>T<?php if($heure<10) echo ("0")?><?php echo $heure?>:<?php if($minute<10) echo ("0")?><?php echo $minute?>:<?php if($seconde<10) echo ("0")?><?php echo $seconde?>").getTime();
										console.log("<?php echo $dateF?>");

										// Update the count down every 1 second
										var x = setInterval(function() {

										  // Get todays date and time
										  var now<?php echo $i?> = new Date().getTime();

										  // Find the distance between now and the count down date
										  var distance<?php echo $i?> = countDownDate<?php echo $i?> - now<?php echo $i?>;
											console.log("<?php echo $i?> "+ distance<?php echo $i?>);

										  // Time calculations for days, hours, minutes and seconds
										  var days<?php echo $i?> = Math.floor(distance<?php echo $i?> / (1000 * 60 * 60 * 24));
										  var hours<?php echo $i?> = Math.floor((distance<?php echo $i?> % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
										  var minutes<?php echo $i?> = Math.floor((distance<?php echo $i?> % (1000 * 60 * 60)) / (1000 * 60));
										  var seconds<?php echo $i?> = Math.floor((distance<?php echo $i?> % (1000 * 60)) / 1000);

										  // Display the result in the element with id="demo"
										  document.getElementById("<?php echo $i?>demo").innerHTML = days<?php echo $i?> + "d " + hours<?php echo $i?> + "h "
										  + minutes<?php echo $i?> + "m " + seconds<?php echo $i?> + "s ";

										  // If the count down is finished, write some text
										  if (distance<?php echo $i?> < 0) {
										    clearInterval(x);
										    document.getElementById("<?php echo $i?>demo").innerHTML = "EXPIRED";
												//ICI LANCER LA FONCTION D'INSERTION !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
										  }
										}, 1000);
										</script>



                               </td>


	</tr>

				<?php $i++; } ?>

</table>
