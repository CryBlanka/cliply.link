<?php

include_once 'Config/CUFunction.php';

$CUF_OBJ = New CUFunction();
$counter = 1;
$Select_URL = $CUF_OBJ->select('shorturl', 'id', 'Desc');

?>
<table class="table text-center">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">New Link</th>
            <th scope="col">Original Link</th>
        </tr>
    </thead>
<tbody>
<?php if($Select_URL){ foreach($Select_URL as $Select_Data){ ?> 
<tr>
    <th scope="row"><?php echo $Select_Data['id']; ?></td>
    <td><?php echo $Select_Data['s_new_link']; ?></td>
    <td><?php echo (strlen($Select_Data['s_original_link']) > 50) ? substr($Select_Data['s_original_link'],0,50).'....' : $Select_Data['s_original_link']; ?></td>
    </td>
</tr>
<?php }}else{ echo "<tr><td colspan='4' class='text-center'><h3>Links Not Found</h3></td></tr>"; } ?>
</tbody>
</table>
