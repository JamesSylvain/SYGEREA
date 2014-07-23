<div class="content">
<h1><?php if (isset($title)) echo $title; ?></h1>
<?php if (isset($message)) echo $message; ?>
<form method="post" action="<?php echo $action; ?>">
    <div class="data" style="display: inline;width: 50%;float: left">
    <fieldset style="display: inline;width: 50%;float: left"> <legend>Ouvrage</legend>
	<table>
                 <tr>
                    <td valign="top">Localité<span style="color:red;">*</span></td>
                    <td>
                            <?php  
                            $administration = $this->Param_model->get_administrationby_localite($this->form_data->code_de_la_localite->code_arrondissement)->row();
                            echo $administration->nom_region.' -> ';    
                            echo $administration->nom_dept.' -> ';    
                            echo $administration->nom_arrondis.' -> ';    
                            echo $this->form_data->code_de_la_localite->nom;
                           ?>
                    </td>
                </tr> 
                <tr>
                    <td valign="top">Entreprise <span style="color:red;">*</span></td>
                    <td>
                       <?php
                                echo $this->form_data->code_entreprise->nom_de_l_entreprise;
                               ?>
                    </td>
                </tr>
                <tr>
                    <td valign="top">Projet<span style="color:red;">*</span></td>
                    <td><?php
                        echo  $this->form_data->code_projet->libelle_du_projet;
                                ?>
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
                        <input type="text" name="date_de_realisation" class="inp-form" id="inputField" value="<?php echo set_value('date_de_realisation', $this->form_data->date_de_realisation); ?>"/>
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
                    <td valign="top">Etat de l'ouvrage<span style="color:red;">*</span></td>
                    <td>
                        <select name="etat_de_l_ouvrage" >
                            <?php if(($this->form_data->etat_de_l_ouvrage!=="")){  
                                echo "<option value='".$this->form_data->etat_de_l_ouvrage."' > ".$this->form_data->etat_de_l_ouvrage." </option>";
                                echo "<option >  </option>";
                            } else { ?>
                                <option value='' > Choisir </option>
                            <?php } ?>
                            <option value='Fonctionnel' > Fonctionnel </option>
                            <option value='Partiellement Ponctionnel' > Partiellement Fonctionnel </option>
                            <option value='Non Fonctionnel' > Non Fonctionnel </option>
                        </select>    
                    </td>
                </tr>
                
                </table>
        </fieldset>
    </div>
        <div class="data" style="display: inline;width: 50%;float: right">
                <fieldset style="display: inline;width: 50%;float: right"> <legend>Aep</legend>
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
                                    <input type="text" pattern="[-+]?[0-9]+(\.[0-9]+)?" name="diametre" class="inp-form" value="<?php echo set_value('diametre',$this->form_data->diametre); ?>"/>
                                    <?php echo form_error('diametre'); ?>
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
				<td valign="top">Debit<span style="color:red;">*</span></td>
                                <td>
                                    <input type="text" pattern="[-+]?[0-9]+(\.[0-9]+)?" name="debit" class="inp-form" value="<?php echo set_value('debit',$this->form_data->debit); ?>"/>
                                    <?php echo form_error('debit'); ?>
				</td>
			</tr>
			<tr>
				<td valign="top">Perimetre de protection<span style="color:red;">*</span></td>
                                <td>
                                    <input type="text" pattern="[-+]?[0-9]+(\.[0-9]+)?" name="perimetre_de_protection" class="inp-form" value="<?php echo set_value('perimetre_de_protection',$this->form_data->perimetre_de_protection); ?>"/>
                                    <?php echo form_error('perimetre_de_protection'); ?>
				</td>
			</tr>
			<tr>
				<td valign="top">Type d'aep<span style="color:red;">*</span></td>
                                <td>
                                    <input type="text" name="type_d_aep" class="inp-form" value="<?php echo set_value('type_d_aep',$this->form_data->type_d_aep); ?>"/>
                                    <?php echo form_error('type_d_aep'); ?>
				</td>
			</tr>
			
		</table>
                </fieldset>
                 
                <input type="submit" name="enregistrer" value="Enregistrer"/>
		</div>
		</form>
		<br />
		<?php echo $link_back; ?>
	</div>
