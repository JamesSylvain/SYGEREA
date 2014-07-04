<div class="content">
    <h1><?php if (isset($title)) echo $title; ?></h1>
    <?php if (isset($message)) echo $message; ?>
    <form method="post" action="<?php echo $action; ?>">
        <div class="data">
            <table>
                <tr>
                    <td valign="top">Entreprise <span style="color:red;">*</span></td>
                    <td>
                        <select name="code_entreprise" >
                            <?php if(isset($this->form_data->code_entreprise)){  
                                echo "<option value='".$this->form_data->code_entreprise->code_entreprise."' > ".$this->form_data->code_entreprise->nom_de_l_entreprise." </option>";
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
                            <?php if(isset($this->form_data->code_projet)){  
                                echo "<option value='".$this->form_data->code_projet->code_projet."' > ".$this->form_data->code_projet->libelle_du_projet." </option>";
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
                        <input type="text" name="coordonnees_en_x" class="inp-form" value="<?php echo set_value('coordonnees_en_x', $this->form_data->coordonnees_en_x); ?>"/>
                        <?php echo form_error('coordonnees_en_x'); ?>
                    </td>
                </tr>
                <tr>
                    <td valign="top">Coordonnees en Y<span style="color:red;">*</span></td>
                    <td>
                        <input type="text" name="coordonees_en_y" class="inp-form" value="<?php echo set_value('coordonees_en_y', $this->form_data->coordonees_en_y); ?>"/>
                        <?php echo form_error('coordonees_en_y'); ?>
                    </td>
                </tr>
                <tr>
                    <td valign="top">Coordonnees en Z<span style="color:red;">*</span></td>
                    <td>
                        <input type="text"  name="coordonnees_en_z" class="inp-form" value="<?php echo set_value('coordonnees_en_z', $this->form_data->coordonnees_en_z); ?>"/>
                        <?php echo form_error('coordonnees_en_z'); ?>
                    </td>
                </tr>
                <tr>
                    <td valign="top">Etat de l'ouvrage<span style="color:red;">*</span></td>
                    <td>
                        <select name="etat_de_l_ouvrage" >
                            <?php if(isset($this->form_data->etat_de_l_ouvrage)){  
                                echo "<option value='".$this->form_data->etat_de_l_ouvrage."' > ".$this->form_data->etat_de_l_ouvrage." </option>";
                              } else { ?>
                                <option value='' > Choisir </option>
                            <?php } ?>
                            <option value='Début' > Début </option>
                            <option value='Milieu' > Milieu </option>
                            <option value='Fin' > Fin </option>
                        </select>    
                    </td>
                </tr>

                <tr>
                    <td>&nbsp;</td>
                    <td><input type="submit" name="Suivant" value="Save"/></td>
                </tr>
            </table>
        </div>
    </form>
    <br />
    <?php echo $link_back; ?>
</div>
