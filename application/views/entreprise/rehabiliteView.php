	<div class="content">
		<h1><?php echo $title; ?></h1>
		<div class="data">
		<fieldset>
		<legend> Details</legend>
		<table>
			<tr>
				<td width="30%">Nom Entreprise :</td>
				<td><?php echo $this->Param_model->get_entreprisename($rehabilite->code_entreprise); ?></td>
			</tr>			
			<tr>
				<td width="30%">Ouvrage en panne :</td>
				<td><?php echo $rehabilite->code_de_l_ouvrage; ?></td>
			</tr>
			<tr>
				<td valign="top">Cout rehabilitation :</td>
				<td><?php echo $rehabilite->cout_rehabilitation; ?></td>
			</tr>				
			<tr>
				<td valign="top">Date debut des travaux :</td>
				<td><?php echo $rehabilite->date_de_rehabilitation; ?></td>
			</tr>				
			<tr>
				<td valign="top">Duree de la rehabilitation :</td>
				<td><?php echo $rehabilite->duree_de_rehabilitation; echo ' Semaines';?></td>
			</tr>			
		</table>
		</fieldset>
		</div>
		<br />
	</div>