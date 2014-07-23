	<div class="content">
		<h1><?php echo $title; ?></h1>
		<div class="data">
		<fieldset>
		<legend> Detail de la panne</legend>
		<table>
			<tr>
				<td width="30%">Code Panne</td>
				<td><?php echo $panne->code_panne; ?></td>
			</tr>
			<tr>
				<td valign="top">Ouvrage concerne </td>
				<td><?php echo $panne->code_de_l_ouvrage; ?></td>
			</tr>				
			<tr>
				<td valign="top">Description </td>
				<td><?php echo $panne->libelle_panne; ?></td>
			</tr>			
			<tr>			
			<tr>
				<td valign="top">Date mise hors usage de l'ouvrage</td>
				<td><?php echo $panne->date_mise_hors_usage; ?></td>
			</tr>			
		</table>
		</fieldset>
		</div>
		<br />
	</div>