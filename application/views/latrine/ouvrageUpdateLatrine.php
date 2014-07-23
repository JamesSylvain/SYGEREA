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
                <fieldset style="display: inline;width: 50%;float: right"> <legend>Latrine</legend>
                    <table>
			<tr>
				<td valign="top">Profondeur<span style="color:red;">*</span></td>
                                <td>
                                    <input type="text"pattern="[-+]?[0-9]+(\.[0-9]+)?" name="profondeur" class="inp-form" value="<?php echo set_value('profondeur',$this->form_data->profondeur); ?>"/>
                                    <?php echo form_error('profondeur'); ?>
				</td>
			</tr>
			<tr>
				<td valign="top">Type latrine<span style="color:red;">*</span></td>
                                <td>
                                    <input type="text" name="type_latrine" class="inp-form" value="<?php echo set_value('type_latrine',$this->form_data->type_latrine); ?>"/>
                                    <?php echo form_error('type_latrine'); ?>
				</td>
			</tr>
			<tr>
				<td valign="top">Nombre de Cabines<span style="color:red;">*</span></td>
                                <td>
                                    <input type="text" pattern="[-+]?[0-9]+(\.[0-9]+)?" name="nombre_de_cabines" class="inp-form" value="<?php echo set_value('nombre_de_cabines',$this->form_data->nombre_de_cabines); ?>"/>
                                    <?php echo form_error('nombre_de_cabines'); ?>
				</td>
			</tr>
			<tr>
				<td valign="top">Etat<span style="color:red;">*</span></td>
                                <td>
                                    <input type="text" name="etat" class="inp-form" value="<?php echo set_value('etat',$this->form_data->etat); ?>"/>
                                    <?php echo form_error('etat'); ?>
				</td>
			</tr>
			<tr>
				<td valign="top">description<span style="color:red;">*</span></td>
                                <td>
                                    <input type="text"  name="description" class="inp-form" value="<?php echo set_value('description',$this->form_data->description); ?>"/>
                                    <?php echo form_error('description'); ?>
				</td>
			</tr>
			<tr>
				<td valign="top">Nombre de fosses<span style="color:red;">*</span></td>
                                <td>
                                    <input type="text" pattern="[-+]?[0-9]+(\.[0-9]+)?" name="nombre_de_fosses" class="inp-form" value="<?php echo set_value('nombre_de_fosses',$this->form_data->nombre_de_fosses); ?>"/>
                                    <?php echo form_error('nombre_de_fosses'); ?>
				</td>
			</tr>
			<tr>
				<td valign="top">Volume<span style="color:red;">*</span></td>
                                <td>
                                    <input type="text" pattern="[-+]?[0-9]+(\.[0-9]+)?" name="volume" class="inp-form" value="<?php echo set_value('volume',$this->form_data->volume); ?>"/>
                                    <?php echo form_error('volume'); ?>
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
