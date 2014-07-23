	<div class="content">
		<h1><?php echo $title; ?></h1>
		<div class="data" style="display: inline;width: 50%;float: left">
                    <fieldset style="display: inline;width: 50%;float: left"><legend>Ouvrage</legend> 
                        <table>
                                <tr>
                                        <td valign="top">Nom de l'entreprise</td>
                                        <td><?php echo $entreprise->nom_de_l_entreprise; ?></td>
                                </tr>
                                <tr>
                                        <td valign="top">Projet</td>
                                        <td><?php echo $projet->libelle_du_projet ; ?></td>
                                </tr>
                                <tr>
                                        <td valign="top">Localité</td>
                                        <td><?php echo $localite->nom ; ?></td>
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
                                        <td valign="top">Etat de l'ouvrage</td>
                                        <td><?php echo $ouvrage->etat_de_l_ouvrage; ?></td>
                                </tr>
                        </table>
                    </fieldset> 
                </div>
                <div style="display: inline;width: 50%;float: left">
                        <fieldset style="display: inline;width: 50%;float: left"><legend>Ouvrage Assainissement : Station d'épuration</legend>
                        <table>
                            <tr>
                                    <td valign="top">Type Station d'épuration</td>
                                    <td><?php echo $source->type_station; ?></td>
                            </tr>
                            <tr>
                                    <td valign="top">Profondeur</td>
                                    <td><?php echo $source->profondeur; ?></td>
                            </tr>
                            <tr>
                                    <td valign="top">Nombre de basins de decantation</td>
                                    <td><?php echo $source->nombre_de_basins_de_decantation; ?></td>
                            </tr>
                            <tr>
                                    <td valign="top">Longueur</td>
                                    <td><?php echo $source->longueur; ?></td>
                            </tr>
                            <tr>
                                    <td valign="top">Largeur</td>
                                    <td><?php echo $source->largeur; ?></td>
                            </tr>
                            <tr>
                                    <td valign="top">Etat</td>
                                    <td><?php echo $source->etat; ?></td>
                            </tr>
                            <tr>
                                    <td valign="top">Description</td>
                                    <td><?php echo $source->description; ?></td>
                            </tr>
                            <tr>
                                    <td valign="top">Volume</td>
                                    <td><?php echo $source->volume; ?></td>
                            </tr>
                            
                        </table>
                    </fieldset>
                <table>
			<tr>
				<td valign="top"></td>
				<td><?php echo $link_edit; ?></td>
			</tr>
		</table>
		</div>
		<br />
		<?php echo $link_back; ?>
	</div>