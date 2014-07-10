<h3 class="tit"><?php echo $titre; ?></h3>
<table  cellpadding=0 cellspacing=10>
	<tr>
		<th>N0</th>
		<th>User Name</th>
		<th>Adresse IP</th>
		<th>Date</th>

	</tr>
	<?php foreach ($connexions as $connexion):?>
		<tr>
			<td><?php echo $connexion->id;?></td>
			<td><?php echo $connexion->login;?></td>
			<td><?php echo $connexion->ip_address;?></td>
			<td><?php echo date("Y-m-d H:i:s", $connexion->time); ?></td>
		</tr>
	<?php endforeach;?>
</table>
