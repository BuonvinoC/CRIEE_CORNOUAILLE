<head>
<link href="<?php echo base_url('css/form.css');?>" rel="stylesheet" type="text/css">
</head>

<?php
echo form_open('utilisateur/connexion_utilisateur/');
	
	
$mail= array(
'name'=>'mailClient',
'id'=>'mail',
'placeholder'=>'Mail',
"value"=>set_value('Mail')
);

echo form_input($mail);

echo "<br/><br/>";

$mdp= array(
'name'=>'mdpClient',
'id'=>'mdp',
'placeholder'=>'Mot de passe',
"value"=>set_value('Mdp')
);

echo form_password($mdp);

echo "<br/><br/>";
	
echo form_submit('envoi','Connexion');
	
echo form_close();
?>
</form>
