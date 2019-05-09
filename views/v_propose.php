<head>
<link href="<?php echo base_url('css/commentaire.css');?>" rel="stylesheet" type="text/css">
<link href="<?php echo base_url('css/form.css');?>" rel="stylesheet" type="text/css">
</head>


<?php
if ($this->session->userdata('logged_in')!=FALSE){
echo "<br/><br/>";
echo form_open('utilisateur/proposer_lot/');
$lbl= array(
'name'=>'lblLot',
'id'=>'lblLot',
'placeholder'=>'Nom du lot',
'type'=>'text',
"value"=>set_value('Commentaire')
);
echo form_input($lbl);
echo "<br/><br/>";
$poi= array(
'name'=>'poissonLot',
'id'=>'poissonLot',
'placeholder'=>'Poisson dans le lot',
'type'=>'text',
"value"=>set_value('Commentaire')
);
echo form_input($poi);
echo "<br/><br/>";
$datePeche= array(
'name'=>'datePeche',
'id'=>'datePeche',
'placeholder'=>'Date de peche',
'type'=>'text',
"value"=>set_value('Commentaire')
);
echo form_input($datePeche);
echo "<br/><br/>";
$poids= array(
'name'=>'poids',
'id'=>'poids',
'placeholder'=>'Poids',
'type'=>'text',
"value"=>set_value('Commentaire')
);
echo form_input($poids);
echo "<br/><br/>";
echo form_submit('envoi','Proposer lot');
echo form_close();
}
?>
