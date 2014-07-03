	<div class="content">
		<h1><?php echo $title; ?></h1>
		<div class="data">
		<table>
			<tr>
				<td valign="top">Code</td>
				<td><?php echo $projet->code_projet; ?></td>
			</tr>
			<tr>
				<td valign="top">Libelle</td>
				<td><?php echo $projet->libelle_du_projet 	; ?></td>
			</tr>
		</table>
		</div>
		<br />
		<?php echo $link_back; ?>
	</div>