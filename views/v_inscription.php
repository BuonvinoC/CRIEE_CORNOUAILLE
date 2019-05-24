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
"value"=>set_value('Nom'),
"required"=>"true"
);

echo form_input($nom);

echo "<br/><br/>";

$prenom= array(
'name'=>'prenomClient',
'id'=>'prenom',
'placeholder'=>'Prénom',
"value"=>set_value('Prenom'),
"required"=>"true"
);

echo form_input($prenom);

echo "<br/><br/>";

$mail= array(
'name'=>'mailClient',
'id'=>'mail',
'placeholder'=>'Mail',
"value"=>set_value('Mail'),
"required"=>"true"
);

echo form_input($mail);

echo "<br/><br/>";

$mdp= array(
'name'=>'mdpClient',
'id'=>'mdp',
'placeholder'=>'Mot de passe',
"value"=>set_value('Mdp'),
"required"=>"true"
);

echo form_input($mdp);

echo "<br/><br/>";

$acheteur= array(
'name'=>'typeClient',
'id'=>'acheteur',
"value"=>'acheteur',
"required"=>"true"
);

echo form_radio($acheteur);

echo form_label("acheteur","typeClient");

echo "<br/><br/>";

$vendeur= array(
'name'=>'typeClient',
'id'=>'vendeur',
"value"=>'vendeur',
"required"=>"true"
);

echo form_radio($vendeur);

echo form_label("vendeur","typeClient");

echo "<br/><br/>";

echo form_submit('envoi','Valider');

echo form_close();


?>
