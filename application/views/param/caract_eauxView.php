	<div class="content">
		<h1><?php echo $title; ?></h1>
		<div class="data">
		<fieldset>
		<legend> Detail de la localite <?php echo strtoupper($localites->nom); echo ' lieu dit : '; echo $localites->lieudit; ?></legend>
		<table>
			<tr>
				<td width="30%">Code Localite</td>
				<td><?php echo $localites->code_de_la_localite; ?></td>
			</tr>
			<tr>
				<td valign="top">Nom  Localite</td>
				<td><?php echo $localites->nom; ?></td>
			</tr>				
			<tr>
				<td valign="top">Lieu Dit</td>
				<td><?php echo $localites->lieudit; ?></td>
			</tr>				
			<tr>
				<td valign="top">Nom  Arrondissement</td>
				<td><?php echo $this->Param_model->getarrondissementname($localites->code_arrondissement); ?></td>
			</tr>			
			<tr>			
			<tr>
				<td valign="top">Population recense</td>
				<td><?php echo $localites->population_recensee; ?></td>
			</tr>				
			<tr>
				<td valign="top">Date recensement</td>
				<td><?php echo $localites->annee_recensement_population; ?></td>
			</tr>			
			<tr>
				<td valign="top">Taux d'acroissement</td>
				<td><?php echo $localites->taux_de_croissance_de_la_populat; ?></td>
			</tr>			
			<tr>
				<td valign="top">Coordonnee en x </td>
				<td><?php echo $localites->coordonnees_en_x; ?></td>
			</tr>			
			<tr>
				<td valign="top">Coordonnee en y </td>
				<td><?php echo $localites->coordonnees_en_y; ?></td>
			</tr>			
			<tr>
				<td valign="top">Coordonnee en z </td>
				<td><?php echo $localites->coordonnees_en_z; ?></td>
			</tr>		
			<tr>
				<td valign="top">Nombres de Menages</td>
				<td><?php echo $localites->nbre_de_menages; ?></td>
			</tr>			
			<tr>
				<td valign="top">Nombres d'ecole</td>
				<td><?php echo $localites->nbre_d_ecole; ?></td>
			</tr>			
			<tr>
				<td valign="top">Nombres de centre de sante</td>
				<td><?php echo $localites->nbre_de_centre_de_sante; ?></td>
			</tr>			
			<tr>
				<td valign="top">Nombres d'hopitaux</td>
				<td><?php echo $localites->nbre_d_hopitaux; ?></td>
			</tr>			
			<tr>
				<td valign="top">Nombres de lieux de cultes</td>
				<td><?php echo $localites->nbre_de_lieux_de_culte; ?></td>
			</tr>

		</table>
		</fieldset>
		</div>
		<br />
	</div>