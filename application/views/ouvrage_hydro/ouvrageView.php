	<div class="content">
		<h1><?php echo $title; ?></h1>
		<div class="data">
		<table>
			<tr>
				<td valign="top">Entreprise</td>
				<td><?php echo $entreprise->nom_de_l_entreprise; ?></td>
			</tr>
			<tr>
				<td valign="top">Projet</td>
				<td><?php echo $projet->libelle_du_projet; ?></td>
			</tr>
			<tr>
				<td valign="top">Population desservie</td>
				<td><?php echo $ouvrage->population_desservie; ?></td>
			</tr>
			<tr>
				<td valign="top">Date de realisation</td>
				<td><?php echo $ouvrage->date_de_realisation; ?></td>
			</tr>
			<tr>
				<td valign="top">Coordonnees en X</td>
				<td><?php echo $ouvrage->coordonnees_en_x; ?></td>
			</tr>
			<tr>
				<td valign="top">Coordonnees en Y</td>
				<td><?php echo $ouvrage->coordonees_en_y; ?></td>
			</tr>
			<tr>
				<td valign="top">Coordonnees en Z</td>
				<td><?php echo $ouvrage->coordonnees_en_z; ?></td>
			</tr>
			<tr>
				<td valign="top">Etat de l'ouvrage</td>
				<td><?php echo $ouvrage->etat_de_l_ouvrage; ?></td>
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