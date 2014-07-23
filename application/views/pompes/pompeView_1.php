	<div class="content">
		<h1><?php echo $title; ?></h1>
		<div class="data">
                    <fieldset><legend>Ouvrage</legend> 
                        <table>
                            <fieldset><legend>Projet et Ouvrage</legend>
                                    <tr>
                                            <td valign="top">Projet </td>
                                            <td><?php echo $projet->libelle_du_projet; ?></td>
                                    </tr>
                                    <tr>
                                            <td valign="top">Date de réalisation de l'ouvrage</td>
                                            <td><?php echo $ouvrage->date_de_realisation; ?></td>
                                    </tr>
                        </table>
                    </fieldset>
                    <fieldset><legend>Pompe ou Puits</legend>
                        <table>
                                <tr>
                                        <td valign="top">Marque de la pompe</td>
                                        <td><?php echo $pompe->marque_de_la_pompe; ?></td>
                                </tr>
                                <tr>
                                        <td valign="top">Type de pompe</td>
                                        <td><?php echo $pompe->type_de_pompe; ?></td>
                                </tr>
                                <tr>
                                        <td valign="top">Diametre</td>
                                        <td><?php echo $pompe->diametre; ?></td>
                                </tr>
                                <tr>
                                        <td valign="top">Profondeur</td>
                                        <td><?php echo $pompe->profondeur; ?></td>
                                </tr>
                                <tr>
                                        <td valign="top">Date d'installation</td>
                                        <td><?php echo $pompe->date_d_installation; ?></td>
                                </tr>
                                <tr>
                                        <td valign="top">Debit nominal de la pompe</td>
                                        <td><?php echo $pompe->debit_nominal_de_la_pompe; ?></td>
                                </tr>
                                <tr>
                                        <td valign="top">Debit maximal de la pompe</td>
                                        <td><?php echo $pompe->debit_maximal_de_la_pompe; ?></td>
                                </tr>
                                <tr>
                                        <td valign="top">Puissance de la pompe</td>
                                        <td><?php echo $pompe->puissance_de_la_pompe; ?></td>
                                </tr>
                                <tr>
                                        <td valign="top">Consommation de la pompe</td>
                                        <td><?php echo $pompe->consommation_de_la_pompe; ?></td>
                                </tr>
                                <tr>
                                        <td valign="top">Etat de la pompe</td>
                                        <td><?php echo $pompe->etat_de_la_pompe; ?></td>
                                </tr>
                        </table>
                    </fieldset>
                    
			<tr>
				<td valign="top"></td>
				<td><?php echo $link_edit; ?></td>
			</tr>
		</table>
		</div>
		<br />
		<?php echo $link_back; ?>
	</div>