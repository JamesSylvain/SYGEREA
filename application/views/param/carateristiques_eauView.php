	<div class="content">
		<h1>Details caracteristique eau</h1>
		<div class="data">
		<fieldset>
		<legend>carateristique de l'eau</legend>
			<table>
				<tr>
					<td valign="top" colspan="2">Ouvrage Hydraulique : </td>
					<td colspan="2"><?php echo $carateristiques_eau->code_de_l_ouvrage; ?></td>
				</tr>					
				<tr>
					<td valign="top">Turbidite : </td>
					<td><?php echo $carateristiques_eau->turbidite; ?></td>
					<td valign="top">Temperature : </td>
					<td><?php echo  $carateristiques_eau->temperature; ?></td>
				</tr>								
				<tr>
					<td valign="top">Conductivite  : </td>
					<td><?php echo  $carateristiques_eau->conductivite; ?></td>
					<td valign="top">matieres_organiques : </td>
					<td><?php echo $carateristiques_eau->matieres_organiques; ?></td>
				</tr>																										
				<tr>
					<td valign="top">Mineralisation : </td>
					<td><?php echo $carateristiques_eau->mineralisation; ?></td>
					<td valign="top">Potentiel d'hydrogene : </td>
					<td><?php echo $carateristiques_eau->ph; ?></td>
				</tr>											
				<tr>
					<td valign="top">eau_traitee : </td>
					<td><?php echo $carateristiques_eau->eau_traitee; ?></td>
					<td valign="top">Date de prelevement : </td>
					<td><?php echo $carateristiques_eau->date_de_prelevement; ?></td>
				</tr>					
				<tr>
					<td valign="top">Date d'analyse : </td>
					<td><?php echo $carateristiques_eau->date_d_analyse; ?></td>					
					<td valign="top">Saveur : </td>
					<td><?php echo $carateristiques_eau->saveur; ?></td>
				</tr>									
				<tr>
					<td valign="top">Limpidite : </td>
					<td><?php echo $carateristiques_eau->limpidite; ?></td>
					<td valign="top">Constante d'équilibre : </td>
					<td><?php echo $carateristiques_eau->k; ?></td>
				</tr>									
				<tr>
					<td valign="top">Ammonium : </td>
					<td><?php echo $carateristiques_eau->nh4; ?></td>
					<td valign="top">Fer : </td>
					<td><?php echo $carateristiques_eau->fe; ?></td>
				</tr>				
				<tr>
					<td valign="top">Manganèse : </td>
					<td><?php echo $carateristiques_eau->mn; ?></td>
					<td valign="top">Carbonate : </td>
					<td><?php echo $carateristiques_eau->co3; ?></td>
				</tr>						
				<tr>
					<td valign="top">Sulfate : </td>
					<td><?php echo $carateristiques_eau->so4; ?></td>
					<td valign="top">Fluor : </td>
					<td><?php echo $carateristiques_eau->f; ?></td>
				</tr>						
				<tr>
					<td valign="top">Bicarbonate : </td>
					<td><?php echo $carateristiques_eau->hco3; ?></td>
					<td valign="top">Dioxyde de carbone dissous : </td>
					<td><?php echo  $carateristiques_eau->co2_dissous; ?></td>
				</tr>				
				<tr>
					<td valign="top">Dioxyde dissous  : </td>
					<td><?php echo $carateristiques_eau->o2_dissous; ?></td>
					<td valign="top">Silice : </td>
					<td><?php echo $carateristiques_eau->silice; ?></td>
				</tr>						
			</table>

		</fieldset>
		</div>
		<br />
	</div>