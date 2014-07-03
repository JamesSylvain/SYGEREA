	<div class="content">
		<h1><?php echo $title; ?></h1>
		<div class="data">
		<fieldset>
		<legend> Detail de l'arrondissement <?php echo strtoupper($arrondissements->libelle_arrondissement); ?></legend>
		<table>
			<tr>
				<td width="30%">Code Arrondissement</td>
				<td><?php echo $arrondissements->code_arrondissement; ?></td>
			</tr>
			<tr>
				<td valign="top">Nom  Arrondissement</td>
				<td><?php echo $arrondissements->libelle_arrondissement; ?></td>
			</tr>			
			<tr>			
			<tr>
				<td valign="top">Nom  Departement</td>
				<td><?php echo $this->Param_model->getdepartementname($arrondissements->code_departement); ?></td>
			</tr>			
			<tr>
				<td valign="top">Superficie (km²)</td>
				<td><?php echo $arrondissements->superficie; ?></td>
			</tr>			
			<tr>
				<td valign="top">Population</td>
				<td><?php echo $arrondissements->population; ?></td>
			</tr>			
			<tr>
				<td valign="top">Taux d'accroissement</td>
				<td><?php echo $arrondissements->taux_d_acroissement_pop; ?></td>
			</tr>
		</table>
		</fieldset>
		</div>
		<br />
	</div>