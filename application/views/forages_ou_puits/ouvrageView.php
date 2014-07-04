	<div class="content">
		<h1><?php echo $title; ?></h1>
		<div class="data">
                    <fieldset><legend>Ouvrage</legend> 
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
                        </table>
                    </fieldset>
                    <fieldset><legend>Hydraulique</legend>
                        <table>
                            <tr>
                                    <td valign="top">debit</td>
                                    <td><?php echo $ouvrage->debit; ?></td>
                            </tr>
                            <tr>
                                    <td valign="top">perimetre de protection</td>
                                    <td><?php echo $ouvrage->perimetre_de_protection; ?></td>
                            </tr>
                        </table>
                    </fieldset>
                    <fieldset><legend>Source Amenagée</legend>
                        <table>
                            <tr>
                                    <td valign="top">Profondeur</td>
                                    <td><?php echo $ouvrage->profondeur; ?></td>
                            </tr>
                            <tr>
                                    <td valign="top">Hauteur d'eau</td>
                                    <td><?php echo $ouvrage->hauteur_d_eau; ?></td>
                            </tr>
                            <tr>
                                    <td valign="top">Niveau statique de l'eau</td>
                                    <td><?php echo $ouvrage->niveau_statique_de_l_eau; ?></td>
                            </tr>
                            <tr>
                                    <td valign="top">Niveau top crepine</td>
                                    <td><?php echo $ouvrage->niveau_top_crepine; ?></td>
                            </tr>
                            <tr>
                                    <td valign="top">Transmissivite</td>
                                    <td><?php echo $ouvrage->transmissivite; ?></td>
                            </tr>
                            <tr>
                                    <td valign="top">Coefficient d'emmagasinement</td>
                                    <td><?php echo $ouvrage->coefficient_d_emmagasinement; ?></td>
                            </tr>
                            <tr>
                                    <td valign="top">Diametre de perforation</td>
                                    <td><?php echo $ouvrage->diametre_de_perforation; ?></td>
                            </tr>
                            <tr>
                                    <td valign="top">Debit d'exploitation debit speci</td>
                                    <td><?php echo $ouvrage->debit_d_exploitation_debit_speci; ?></td>
                            </tr>
                            <tr>
                                    <td valign="top">Type de nappe</td>
                                    <td><?php echo $ouvrage->type_de_nappe; ?></td>
                            </tr>
                            <tr>
                                    <td valign="top">Type de porosite</td>
                                    <td><?php echo $ouvrage->type_de_porosite; ?></td>
                            </tr>

                            <tr>
                                    <td valign="top">Projet</td>
                                    <td><?php echo $projet->libelle_du_projet; ?></td>
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