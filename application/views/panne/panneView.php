	<div class="content">
		<h1><?php echo $title; ?></h1>
		<div class="data">
		<fieldset>
		<legend> Detail du departement <?php echo strtoupper($departements->libelle_departement); ?></legend>
		<table>
			<tr>
				<td width="30%">Code Departement</td>
				<td><?php echo $departements->code_region; ?></td>
			</tr>
			<tr>
				<td valign="top">Nom  Departement</td>
				<td><?php echo $departements->libelle_departement; ?></td>
			</tr>			
			<tr>			
			<tr>
				<td valign="top">Nom  Region</td>
				<td><?php echo $this->Param_model->getregionname($departements->code_region); ?></td>
			</tr>			
			<tr>
				<td valign="top">Superficie (km²)</td>
				<td><?php echo $departements->superficie; ?></td>
			</tr>			
			<tr>
				<td valign="top">Population</td>
				<td><?php echo $departements->population; ?></td>
			</tr>			
			<tr>
				<td valign="top">Taux d'accroissement</td>
				<td><?php echo $departements->taux_d_acroissement_pop; ?></td>
			</tr>
		</table>
		</fieldset>
		</div>
		<br />
	</div>