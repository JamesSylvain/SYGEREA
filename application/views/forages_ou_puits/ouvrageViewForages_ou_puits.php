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
                        <fieldset style="display: inline;width: 50%;float: left"><legend>Ouvrage Hydraulique : Source Amenagée</legend>
                        <table>
                            <tr>
                                    <td valign="top">debit</td>
                                    <td><?php echo $source->debit; ?></td>
                            </tr>
                            <tr>
                                    <td valign="top">perimetre de protection</td>
                                    <td><?php echo $source->perimetre_de_protection; ?></td>
                            </tr>
                            <tr>
                                    <td valign="top">Profondeur</td>
                                    <td><?php echo $source->profondeur; ?></td>
                            </tr>
                            <tr>
                                    <td valign="top">Hauteur d'eau</td>
                                    <td><?php echo $source->hauteur_d_eau; ?></td>
                            </tr>
                            <tr>
                                    <td valign="top">Niveau statique de l'eau</td>
                                    <td><?php echo $source->niveau_statique_de_l_eau; ?></td>
                            </tr>
                            <tr>
                                    <td valign="top">Niveau top crepine</td>
                                    <td><?php echo $source->niveau_top_crepine; ?></td>
                            </tr>
                            <tr>
                                    <td valign="top">Transmissivite</td>
                                    <td><?php echo $source->transmissivite; ?></td>
                            </tr>
                            <tr>
                                    <td valign="top">Coefficient d'emmagasinement</td>
                                    <td><?php echo $source->coefficient_d_emmagasinement; ?></td>
                            </tr>
                            <tr>
                                    <td valign="top">Diametre de perforation</td>
                                    <td><?php echo $source->diametre_de_perforation; ?></td>
                            </tr>
                            <tr>
                                    <td valign="top">Debit d'exploitation debit speci</td>
                                    <td><?php echo $source->debit_d_exploitation_debit_speci; ?></td>
                            </tr>
                            <tr>
                                    <td valign="top">Type de nappe</td>
                                    <td><?php echo $source->type_de_nappe; ?></td>
                            </tr>
                            <tr>
                                    <td valign="top">Type de porosite</td>
                                    <td><?php echo $source->type_de_porosite; ?></td>
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