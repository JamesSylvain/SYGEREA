	<div class="content">
		<h1><?php echo $title; ?></h1>
		<div class="data">
		<table>
			<tr>
				<td valign="top">Code</td>
				<td><?php echo $entreprise->code_entreprise; ?></td>
			</tr>
			<tr>
				<td valign="top">Nom de l'entreprise</td>
				<td><?php echo $entreprise->nom_de_l_entreprise; ?></td>
			</tr>
			<tr>
				<td valign="top">Téléphone</td>
				<td><?php echo $entreprise->tel; ?></td>
			</tr>
			<tr>
				<td valign="top">Code Postal</td>
				<td><?php echo $entreprise->code_potal; ?></td>
			</tr>
			<tr>
				<td valign="top">Ville</td>
				<td><?php echo $entreprise->ville; ?></td>
			</tr>
			<tr>
				<td valign="top">Email</td>
				<td><?php echo $entreprise->email; ?></td>
			</tr>
			<tr>
				<td valign="top"></td>
				<td><?php echo $link_edit; ?></td>
			</tr>
		</table>
		</div>
		<br />
		<?php echo $link_back; ?>
	</div>