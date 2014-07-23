<h3 class="tit"><?php echo $titre; ?></h3>
<table  cellpadding=0 cellspacing=10>
	<tr>
		<th>N0</th>
		<th>User Name</th>
		<th>E-mail</th>
		<th>Adresse IP</th>
		<th>Client web</th>
		<th>Date connexion</th>
		<th>Derniere activite</th>

	</tr>
	<?php $i = 0;	foreach ($connexions as $connexion): ?>
		<?php $user_data = unserialize($connexion->user_data);
			if(!isset($user_data['username'])){
				continue;
			}
		?>
		<tr>
			<td><?php echo ++$i;?></td>
			<td><?php echo $user_data['username'];?></td>
			<td><?php echo $user_data['email'];?></td>
			<td><?php echo $connexion->ip_address;?></td>
			<td><?php echo $connexion->user_agent;?></td>
			<td><?php echo date("d-m-Y H:i:s", $user_data['old_last_login']);?></td>
			<td><?php echo date("d-m-Y H:i:s", $connexion->last_activity); ?></td>
		</tr>
	<?php endforeach;?>
</table>
<br/>
<br/>
<span><strong> <?php echo $i.'&nbsp;&nbsp;'.'Utilisateur(s) connecte(s)'; ?></strong></span>
