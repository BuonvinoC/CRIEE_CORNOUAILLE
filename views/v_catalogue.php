<head>
<link href="<?php echo base_url('css/catalogue.css');?>" rel="stylesheet" type="text/css">
</head>

<table>
	<tr>
		<th>Photo</th>
		<th>Reference Lot</th>
		<th>Nom</th>
		<th>Nom Scientifique</th>

	</tr>
				<?php
				foreach ($donnees as $row) {?>
	<tr>

		<td> <img src=""/></td>
		<td>1</td>
		<td>thon</td>
		<td>athunamatata</td>

	</tr>
				<?php  } ?>
</table>

<table>
	<tr>
		<th>Photo</th>
		<th>Reference Lot</th>
		<th>Nom</th>
		<th>Nom Scientifique</th>
	</tr>
				<?php
				foreach ($donnees as $row) {?>
	<tr>

		<td class="tdImg" style="background: no-repeat center url(<?php echo base_url('/images/Poisson/'.$row['image']);?>); background-size:contain " > </td> <!--<img class="imgEsp" src="<?php //echo base_url('/images/Poisson/'.$row['image']);?>"/> -->
		<td><?php echo $row['idEspece'];?></td>
		<td><?php echo $row['nomEsp'];?></td>
		<td><?php echo $row['nomSciEsp'];?></td>

	</tr>
				<?php  } ?>
</table>
