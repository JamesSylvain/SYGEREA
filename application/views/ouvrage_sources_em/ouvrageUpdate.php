<div class="content">
<h1><?php if (isset($title)) echo $title; ?></h1>
<?php if (isset($message)) echo $message; ?>
<form method="post" action="<?php echo $action; ?>">
<div class="data">
    <fieldset> <legend>Ouvrage</legend>
	<table>
                 <tr>
                    <td valign="top">Entreprise <span style="color:red;">*</span></td>
                    <td>
                        <select name="code_entreprise" >
                            <?php if(($this->form_data->code_entreprise!=="")){  
                                echo "<option value='".$this->form_data->code_entreprise->code_entreprise."' > ".$this->form_data->code_entreprise->nom_de_l_entreprise." </option>";
                                echo "<option >  </option>";
                            } else { ?>
                                <option value='' > Choisir </option>
                            <?php } ?>
                            <?php            
                            foreach ($entreprises as $entreprise)
                            {
                                echo "<option value='".$entreprise->code_entreprise."'>".$entreprise->nom_de_l_entreprise."</option>";
                            }
                                ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td valign="top">Projet<span style="color:red;">*</span></td>
                    <td>
                         <select name="code_projet" >
                            <?php if(($this->form_data->code_projet!=="")){  
                                echo "<option value='".$this->form_data->code_projet->code_projet."' > ".$this->form_data->code_projet->libelle_du_projet." </option>";
                                echo "<option >  </option>";
                            } else { ?>
                                <option value='' > Choisir </option>
                            <?php } ?>
                            <?php            
                            foreach ($projets as $projet)
                            {
                                echo "<option value='".$projet->code_projet."'>".$projet->libelle_du_projet."</option>";
                            }
                                ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td valign="top">Population Desservie <span style="color:red;">*</span></td>
                    <td>
                        <input type="number"  name="population_desservie" class="inp-form" value="<?php echo set_value('population_desservie', $this->form_data->population_desservie); ?>"/>
                        <?php echo form_error('population_desservie'); ?>
                    </td>
                </tr>
                <tr>
                    <td valign="top">Date de realisation<span style="color:red;">*</span></td>
                    <td>
                        <input type="date" name="date_de_realisation" class="inp-form" value="<?php echo set_value('date_de_realisation', $this->form_data->date_de_realisation); ?>"/>
                        <?php echo form_error('date_de_realisation'); ?>
                    </td>
                </tr>
                <tr>
                    <td valign="top">Coordonnees en X<span style="color:red;">*</span></td>
                    <td>
                        <input type="text" pattern="[-+]?[0-9]+(\.[0-9]+)?" name="coordonnees_en_x" class="inp-form" value="<?php echo set_value('coordonnees_en_x', $this->form_data->coordonnees_en_x); ?>"/>
                        <?php echo form_error('coordonnees_en_x'); ?>
                    </td>
                </tr>
                <tr>
                    <td valign="top">Coordonnees en Y<span style="color:red;">*</span></td>
                    <td>
                        <input type="text" pattern="[-+]?[0-9]+(\.[0-9]+)?" name="coordonees_en_y" class="inp-form" value="<?php echo set_value('coordonees_en_y', $this->form_data->coordonees_en_y); ?>"/>
                        <?php echo form_error('coordonees_en_y'); ?>
                    </td>
                </tr>
                <tr>
                    <td valign="top">Coordonnees en Z<span style="color:red;">*</span></td>
                    <td>
                        <input type="text" pattern="[-+]?[0-9]+(\.[0-9]+)?" name="coordonnees_en_z" class="inp-form" value="<?php echo set_value('coordonnees_en_z', $this->form_data->coordonnees_en_z); ?>"/>
                        <?php echo form_error('coordonnees_en_z'); ?>
                    </td>
                </tr>
                <tr>
                    <td valign="top">Etat de l'ouvrage<span style="color:red;">*</span></td>
                    <td>
                        <select name="etat_de_l_ouvrage" >
                            <?php if(($this->form_data->etat_de_l_ouvrage!=="")){  
                                echo "<option value='".$this->form_data->etat_de_l_ouvrage."' > ".$this->form_data->etat_de_l_ouvrage." </option>";
                                echo "<option >  </option>";
                            } else { ?>
                                <option value='' > Choisir </option>
                            <?php } ?>
                            <option value='Début' > Début </option>
                            <option value='Milieu' > Milieu </option>
                            <option value='Fin' > Fin </option>
                        </select>    
                    </td>
                </tr>
                </table>
        </fieldset>
                <fieldset> <legend>Hydraulique</legend>
                    <table>
                        <tr>
                        <td valign="top">Debit <span style="color:red;">*</span></td>
                        <td>
                            <input type="text" pattern="[-+]?[0-9]+(\.[0-9]+)?" name="debit" class="inp-form" value="<?php echo set_value('debit', $this->form_data->debit); ?>"/>
                            <?php echo form_error('debit'); ?>
                        </td>
                    </tr>
                    <tr>
                        <td valign="top">Perimetre de protection<span style="color:red;">*</span></td>
                        <td>
                            <input type="text" pattern="[-+]?[0-9]+(\.[0-9]+)?" name="perimetre_de_protection" class="inp-form" value="<?php echo set_value('perimetre_de_protection', $this->form_data->perimetre_de_protection); ?>"/>
                            <?php echo form_error('perimetre_de_protection'); ?>
                        </td>
                    </tr>
                    </table>    
                </fieldset>
                <fieldset> <legend>Ouvrage</legend>
                    <table>
			<tr>
				<td valign="top">Profondeur<span style="color:red;">*</span></td>
                                <td>
                                    <input type="text"pattern="[-+]?[0-9]+(\.[0-9]+)?" name="profondeur" class="inp-form" value="<?php echo set_value('profondeur',$this->form_data->profondeur); ?>"/>
                                    <?php echo form_error('profondeur'); ?>
				</td>
			</tr>
			<tr>
				<td valign="top">hauteur d'eau<span style="color:red;">*</span></td>
                                <td>
                                    <input type="text" pattern="[-+]?[0-9]+(\.[0-9]+)?" name="hauteur_d_eau" class="inp-form" value="<?php echo set_value('hauteur_d_eau',$this->form_data->hauteur_d_eau); ?>"/>
                                    <?php echo form_error('hauteur_d_eau'); ?>
				</td>
			</tr>
			<tr>
				<td valign="top">Niveau statique de l'eau<span style="color:red;">*</span></td>
                                <td>
                                    <input type="text" pattern="[-+]?[0-9]+(\.[0-9]+)?" name="niveau_statique_de_l_eau" class="inp-form" value="<?php echo set_value('niveau_statique_de_l_eau',$this->form_data->niveau_statique_de_l_eau); ?>"/>
                                    <?php echo form_error('niveau_statique_de_l_eau'); ?>
				</td>
			</tr>
			<tr>
				<td valign="top">Niveau top crepine<span style="color:red;">*</span></td>
                                <td>
                                    <input type="text" pattern="[-+]?[0-9]+(\.[0-9]+)?" name="niveau_top_crepine" class="inp-form" value="<?php echo set_value('niveau_top_crepine',$this->form_data->niveau_top_crepine); ?>"/>
                                    <?php echo form_error('niveau_top_crepine'); ?>
				</td>
			</tr>
			<tr>
				<td valign="top">Transmissivite<span style="color:red;">*</span></td>
                                <td>
                                    <input type="text" pattern="[-+]?[0-9]+(\.[0-9]+)?" name="transmissivite" class="inp-form" value="<?php echo set_value('transmissivite',$this->form_data->transmissivite); ?>"/>
                                    <?php echo form_error('transmissivite'); ?>
				</td>
			</tr>
			<tr>
				<td valign="top">Coefficient d'emmagasinement<span style="color:red;">*</span></td>
                                <td>
                                    <input type="text" pattern="[-+]?[0-9]+(\.[0-9]+)?" name="coefficient_d_emmagasinement" class="inp-form" value="<?php echo set_value('coefficient_d_emmagasinement',$this->form_data->coefficient_d_emmagasinement); ?>"/>
                                    <?php echo form_error('coefficient_d_emmagasinement'); ?>
				</td>
			</tr>
			<tr>
				<td valign="top">Diametre de perforation<span style="color:red;">*</span></td>
                                <td>
                                    <input type="text" pattern="[-+]?[0-9]+(\.[0-9]+)?" name="diametre_de_perforation" class="inp-form" value="<?php echo set_value('diametre_de_perforation',$this->form_data->diametre_de_perforation); ?>"/>
                                    <?php echo form_error('diametre_de_perforation'); ?>
				</td>
			</tr>
			<tr>
				<td valign="top">Debit d'exploitation debit specification<span style="color:red;">*</span></td>
                                <td>
                                    <input type="text" pattern="[-+]?[0-9]+(\.[0-9]+)?" name="debit_d_exploitation_debit_speci" class="inp-form" value="<?php echo set_value('debit_d_exploitation_debit_speci',$this->form_data->debit_d_exploitation_debit_speci); ?>"/>
                                    <?php echo form_error('debit_d_exploitation_debit_speci'); ?>
				</td>
			</tr>
			<tr>
				<td valign="top">Type de nappe<span style="color:red;">*</span></td>
                                <td>
                                    <input type="text" name="type_de_nappe" class="inp-form" value="<?php echo set_value('type_de_nappe',$this->form_data->type_de_nappe); ?>"/>
                                    <?php echo form_error('type_de_nappe'); ?>
				</td>
			</tr>
			<tr>
				<td valign="top">Type de porosite<span style="color:red;">*</span></td>
                                <td>
                                    <input type="text" name="type_de_porosite" class="inp-form" value="<?php echo set_value('type_de_porosite',$this->form_data->type_de_porosite); ?>"/>
                                    <?php echo form_error('type_de_porosite'); ?>
				</td>
			</tr>
			
		</table>
                </fieldset>
                <input type="submit" name="enregistrer" value="Save"/>
		</div>
		</form>
		<br />
		<?php echo $link_back; ?>
	</div>
