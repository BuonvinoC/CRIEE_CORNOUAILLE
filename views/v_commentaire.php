<head>
<link href="<?php echo base_url('css/commentaire.css');?>" rel="stylesheet" type="text/css">
</head>



<table>
				<?php
				foreach ($donnees as $row) {?>
	<tr>		
		<td><?php echo $row['mailClient'];?></td>
		<td><?php echo $row['dateCommentaire'];?></td>
		<td id="commentaire"><?php echo $row['textCommentaire'];?></td>
	</tr>
				<?php } ?>
</table>



<?php 
if ($this->session->userdata('logged_in')!=FALSE){

echo "<br/><br/>";
echo form_open('utilisateur/ajout_commentaire/');

$comm= array(
'name'=>'textCommentaire',
'id'=>'comm',
'placeholder'=>'Votre commentaire ...',
'type'=>'textarea',
"value"=>set_value('Commentaire')
);

echo form_input($comm);

echo "<br/><br/>";

echo form_submit('envoi','Ajouter commentaire');

echo form_close();

}
?>