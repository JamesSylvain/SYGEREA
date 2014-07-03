	<div class="content">
		<h1><?php echo $title; ?></h1>
		<div class="data">
		<fieldset>
		<legend> Detail de la region <?php echo strtoupper($region->libelle_region); ?></legend>
		<table>
			<tr>
				<td width="30%">Code Region</td>
				<td><?php echo $region->code_region; ?></td>
			</tr>
			<tr>
				<td valign="top">Libelle  Region</td>
				<td><?php echo $region->libelle_region; ?></td>
			</tr>			
			<tr>
				<td valign="top">Superficie (km²)</td>
				<td><?php echo $region->superficie; ?></td>
			</tr>			
			<tr>
				<td valign="top">Population</td>
				<td><?php echo $region->population; ?></td>
			</tr>			
			<tr>
				<td valign="top">Taux d'accroissement</td>
				<td><?php echo $region->taux_d_acroissement; ?></td>
			</tr>
		</table>
		</fieldset>
		</div>
		<br />
	</div>