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

		<td><?php ?></td>
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
                <td class="Timer">
                    <script> setInterval(function() { makeTimer($); }, 1000);</script>
                    <script>
// Set the date we're counting down to
var countDownDate = new Date("Jan 5, 2021 15:37:25").getTime();
// Update the count down every 1 second
var x = setInterval(function() {
  // Get todays date and time
  var now = new Date().getTime();
  // Find the distance between now and the count down date
  var distance = countDownDate - now;
  // Time calculations for days, hours, minutes and seconds
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);
  // Display the result in the element with id="demo"
  document.getElementById("demo").innerHTML = days + "d " + hours + "h "
  + minutes + "m " + seconds + "s ";
  // If the count down is finished, write some text
  if (distance < 0) {
    clearInterval(x);
    document.getElementByClassName("Timer").innerHTML = "EXPIRED";
  }
}, 1000);
</script>
                </td>

	</tr>
				<?php  } ?>
</table>

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
				'value'=>set_value('ajoutMontant')
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
        
<script> 
 var start = new Date;
function makeTimer(endDate) {
	//		var endTime = new Date("29 April 2018 9:56:00 GMT+01:00");	
		var endTime = new Date("29 April 2020 9:56:00 GMT+01:00");			
			endTime = (Date.parse(endTime) / 1000);
                        
                        endDate = (Date.parse(endDate) / 1000);
			var now = new Date();
			now = (Date.parse(now) / 1000);
			var timeLeft = endTime - now;
			var days = Math.floor(timeLeft / 86400); 
			var hours = Math.floor((timeLeft - (days * 86400)) / 3600);
			var minutes = Math.floor((timeLeft - (days * 86400) - (hours * 3600 )) / 60);
			var seconds = Math.floor((timeLeft - (days * 86400) - (hours * 3600) - (minutes * 60)));
  
			if (hours < "10") { hours = "0" + hours; }
			if (minutes < "10") { minutes = "0" + minutes; }
			if (seconds < "10") { seconds = "0" + seconds; }
			$("#days").html(days + "<span>Days</span>");
			$("#hours").html(hours + "<span>Hours</span>");
			$("#minutes").html(minutes + "<span>Minutes</span>");
			$("#seconds").html(seconds + "<span>Seconds</span>");		
	}
</script>


</table>
