<head>
<link href="<?php echo base_url('css/form.css');?>" rel="stylesheet" type="text/css">
</head>


<?php 
echo "<br/><br/>";
echo form_open('utilisateur/ajout_utilisateur/');

$nom= array(
'name'=>'nomClient',
'id'=>'nom',
'placeholder'=>'Nom',
"value"=>set_value('Nom')
);

echo form_input($nom);

echo "<br/><br/>";

$prenom= array(
'name'=>'prenomClient',
'id'=>'prenom',
'placeholder'=>'Prénom',
"value"=>set_value('Prenom')
);

echo form_input($prenom);

echo "<br/><br/>";

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

echo form_submit('envoi','Valider');

echo form_close();


?>
