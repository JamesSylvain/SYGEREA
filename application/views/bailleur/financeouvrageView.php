	<div class="content">
		<h1><?php echo $title; ?></h1>
		<div class="data">
		<fieldset>
		<legend> Details</legend>
		<table>
			<tr>
				<td width="30%">Bailleur de fonds</td>
				<td><?php echo $finance->nom_bailleur; ?></td>
			</tr>			
			<tr>
				<td width="30%">Type bailleur</td>
				<td><?php echo $finance->type_bailleur; ?></td>
			</tr>
			<tr>
				<td valign="top">Projet</td>
				<td><?php echo $finance->nom_projet; ?></td>
			</tr>				
			<tr>
				<td valign="top">Montant Financment</td>
				<td><?php echo $finance->montant_financement; ?></td>
			</tr>				
			<tr>
				<td valign="top">Annee Financment</td>
				<td><?php echo $finance->annee_financement; ?></td>
			</tr>			
		</table>
		</fieldset>
		</div>
		<br />
	</div>