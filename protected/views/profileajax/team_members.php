<?php
	echo $development;
?>	

<table>
	<?foreach($data AS $d):?>
		<tr>
			<td><?echo $d['firstname']?></td>
			<td><?echo $d['lastname']?></td>
		</tr>
	<?endforeach;?>
	</table>