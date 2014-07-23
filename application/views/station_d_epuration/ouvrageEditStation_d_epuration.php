<div class="content">
<h1><?php if (isset($title)) echo $title; ?></h1>
<?php if (isset($message)) echo $message; ?>
<form method="post" action="<?php echo $action; ?>">
    <div class="data" style="display: inline;width: 50%;float: left">
    <fieldset style="display: inline;width: 50%;float: left"> <legend>Ouvrage</legend>
	<table>
            <tr>
                        <td valign="top">Region :<span style="color:red;">*</span></td>
                        <td><select type="text"  name="code_region" class="input-text" id="region" onchange='go()'>
                                        <option value="">-- Choisir une region --</option>
                                        <?php 
                                                foreach($regions as $region){
                                                        if($region->code_region == $this->form_data->code_region){
                                                                $selected = 'selected';
                                                        }else{
                                                                $selected = '';
                                                        }
                                                        echo '<option value="'.$region->code_region.'"  '.$selected.'>'.$region->libelle_region.'</option>';
                                                }
                                        ?>
                                   </select>
                                <?php echo form_error('code_region'); ?>
                        </td>
                </tr>						
                <tr>
                        <td valign="top">Departement :<span style="color:red;">*</span></td>
                        <td><select type="text"  name="code_departement" class="input-text" id="departement" onchange='go1()'>
                                        <option value="">-- Choisir une Departement --</option>
                                   </select>
                                <?php echo form_error('code_departement'); ?>
                        </td>
                </tr>					
                <tr>
                        <td valign="top">Arrondissement :<span style="color:red;">*</span></td>
                        <td><select type="text"  name="code_arrondissement" class="input-text" id="arrondissement" onchange='go2()'>
                                        <option value="">-- Choisir un arrondissement --</option>
                                   </select>
                                <?php echo form_error('code_arrondissement'); ?>
                        </td>
                </tr>
                <tr>
                    <td valign="top">Localité<span style="color:red;">*</span></td>
                    <td>
                         <select name="code_de_la_localite" id="localite">
                            <?php if(($this->form_data->code_de_la_localite!=="")){  
                                echo "<option value='".$this->form_data->code_de_la_localite->code_de_la_localite."' > ".$this->form_data->code_de_la_localite->nom." </option>";
                                echo "<option >  </option>";
                            } else { ?>
                                <option value='' >-- Choisir la localité --</option>
                            <?php } ?>
                            <?php            
                            foreach ($localites as $projet)
                            {
                                echo "<option value='".$projet->code_de_la_localite."'>".$projet->nom."</option>";
                            }
                                ?>
                        </select>
                    </td>
                </tr> 
                <tr>
                    <td valign="top">Entreprise <span style="color:red;">*</span></td>
                    <td>
                        <select name="code_entreprise" >
                            <?php if(($this->form_data->code_entreprise!=="")){  
                                echo "<option value='".$this->form_data->code_entreprise->code_entreprise."' > ".$this->form_data->code_entreprise->nom_de_l_entreprise." </option>";
                                echo "<option >  </option>";
                            } else { ?>
                                <option value='' > Choisir une entreprise ... </option>
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
                                <option value='' > Choisir un projet </option>
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
                <fieldset style="display: inline;width: 50%;float: right"> <legend>Station d'épuration</legend>
                    <table>
			<tr>
				<td valign="top">Profondeur<span style="color:red;">*</span></td>
                                <td>
                                    <input type="text"pattern="[-+]?[0-9]+(\.[0-9]+)?" name="profondeur" class="inp-form" value="<?php echo set_value('profondeur',$this->form_data->profondeur); ?>"/>
                                    <?php echo form_error('profondeur'); ?>
				</td>
			</tr>
			<tr>
				<td valign="top">Type de Station<span style="color:red;">*</span></td>
                                <td>
                                    <input type="text" name="type_station" class="inp-form" value="<?php echo set_value('type_station',$this->form_data->type_station); ?>"/>
                                    <?php echo form_error('type_station'); ?>
				</td>
			</tr>
			<tr>
				<td valign="top">Longueur<span style="color:red;">*</span></td>
                                <td>
                                    <input type="text" pattern="[-+]?[0-9]+(\.[0-9]+)?" name="longueur" class="inp-form" value="<?php echo set_value('longueur',$this->form_data->longueur); ?>"/>
                                    <?php echo form_error('longueur'); ?>
				</td>
			</tr>
			<tr>
				<td valign="top">Largeur<span style="color:red;">*</span></td>
                                <td>
                                    <input type="text" pattern="[-+]?[0-9]+(\.[0-9]+)?" name="largeur" class="inp-form" value="<?php echo set_value('largeur',$this->form_data->largeur); ?>"/>
                                    <?php echo form_error('largeur'); ?>
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
				<td valign="top">Nombre de basins de decantation<span style="color:red;">*</span></td>
                                <td>
                                    <input type="text" pattern="[-+]?[0-9]+(\.[0-9]+)?" name="nombre_de_basins_de_decantation" class="inp-form" value="<?php echo set_value('nombre_de_basins_de_decantation',$this->form_data->nombre_de_basins_de_decantation); ?>"/>
                                    <?php echo form_error('nombre_de_basins_de_decantation'); ?>
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
