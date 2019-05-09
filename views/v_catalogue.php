<head>
<link href="<?php echo base_url('css/catalogue.css');?>" rel="stylesheet" type="text/css">
</head>

<body>
    <table>
    <tr>
        <th>Photo</th>
        <th>Reference Lot</th>
        <th>Nom</th>
        <th>Nom Scientifique</th>
                <th>
                    <?php
                        if ($this->session->userdata('login')=="admin"){                           
                        echo "Lancer enchère";
                        }
                        else {
                        echo "Ce poisson m'interesse"; }
                            ?>
                        
                        
                </th>
    </tr>
                <?php
                foreach ($donnees as $row) {?>
    <tr>

        <td class="tdImg" style="background: no-repeat center url(<?php echo base_url('/images/Poisson/'.$row['image']);?>); background-size:contain " > </td> <!--<img class="imgEsp" src="<?php //echo base_url('/images/Poisson/'.$row['image']);?>"/> -->
        <td><?php echo $row['idEspece'];?></td>
        <td><?php echo $row['nomEsp'];?></td>
        <td><?php echo $row['nomSciEsp'];?></td>
                <td>
                    <?php
                        if ($this->session->userdata('login')=="admin"){
                            echo form_open('utilisateur/debuter_enchere/');        
                            $data = array(
                                    'name'=> 'enchere[]',
                                    'id'=> 'enchere',
                                    'value'=>$row['idEspece']
                            );
                            echo form_checkbox($data);
                                            }
                        else {
                            echo form_open('utilisateur/debuter_enchere/');        
                            $data = array(
                                    'name'=> 'enchere[]',
                                    'id'=> 'enchere',
                                    'value'=>$row['idEspece']
                            );
                            echo form_checkbox($data);
                                                    }
                            ?>
                </td>

    </tr>
                <?php  } ?>
</table>

<?php echo form_submit("go","go") ;?>

</body>
