<head>
<link href="<?php echo base_url('css/form.css');?>" rel="stylesheet" type="text/css">
</head>

<?php
	echo form_open('valid_form/ajout_utilisateur');
	?>
	
	<select name="refPdt" size="1">
		<?php foreach ($donnees as $row) {
		echo ("<option>".$row['designationProduit']."<br/>"."</option>");
		}
		?>
		
		
	</select>
	Quantité : 
	<input type="text" name="quantite" size="5" value="1" />
	<?php 
	echo "<br/><br/>";
	echo form_submit('envoi','Ajouter au panier');
	echo form_close();
	?>
</form>
