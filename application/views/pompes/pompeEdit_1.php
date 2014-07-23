<div class="content">
		<h1><?php if (isset($title)) echo $title; ?></h1>
		<?php if (isset($message)) echo $message; ?>
		<form method="post" action="<?php echo $action; ?>">
		<div class="data">
		<table>
			<tr>
				<td valign="top">Forage ou Puits<span style="color:red;">*</span></td>
                                <td>
                                    <select name="code_de_l_ouvrage" >
                                        <?php if(($this->form_data->code_de_l_ouvrage!=="")){  
                                            echo "<option value='".$this->form_data->code_de_l_ouvrage->code_de_l_ouvrage."' > De ". $this->form_data->code_de_l_ouvrage->date_de_realisation." </option>";
                                            echo "<option >  </option>";
                                        } else { ?>
                                            <option value='' > Choisir </option>
                                        <?php } ?>
                                        <?php         
                                        $i=0;
                                        foreach ($ouvrages as $ouvrage)
                                        {
                                            echo "<option value='".$ouvrage->code_de_l_ouvrage."'>N°".++$id.' De '. $ouvrage->date_de_realisation."</option>";
                                        }
                                            ?>
                                    </select>
				</td>
			</tr>
			<tr>
				<td valign="top">Profondeur<span style="color:red;">*</span></td>
                                <td>
                                    <input type="text" name="profondeur" class="inp-form" value="<?php echo set_value('profondeur',$this->form_data->profondeur); ?>"/>
                                    <?php echo form_error('profondeur'); ?>
				</td>
			</tr>
			<tr>
				<td valign="top">Marque de la pompe<span style="color:red;">*</span></td>
                                <td>
                                    <input type="text" name="marque_de_la_pompe" class="inp-form" value="<?php echo set_value('marque_de_la_pompe',$this->form_data->marque_de_la_pompe); ?>"/>
                                    <?php echo form_error('marque_de_la_pompe'); ?>
				</td>
			</tr>
			<tr>
				<td valign="top">Type de pompe<span style="color:red;">*</span></td>
                                <td>
                                    <input type="text" name="type_de_pompe" class="inp-form" value="<?php echo set_value('type_de_pompe',$this->form_data->type_de_pompe); ?>"/>
                                    <?php echo form_error('type_de_pompe'); ?>
				</td>
			</tr>
			<tr>
				<td valign="top">Diametre<span style="color:red;">*</span></td>
                                <td>
                                    <input type="text" name="diametre" class="inp-form" value="<?php echo set_value('diametre',$this->form_data->diametre); ?>"/>
                                    <?php echo form_error('diametre'); ?>
				</td>
			</tr>
			<tr>
				<td valign="top">date d'installation<span style="color:red;">*</span></td>
                                <td>
                                    <input type="text" name="date_d_installation" class="inp-form" value="<?php echo set_value('date_d_installation',$this->form_data->date_d_installation); ?>"/>
                                    <?php echo form_error('date_d_installation'); ?>
				</td>
			</tr>
			<tr>
				<td valign="top">Debit nominal de la pompe<span style="color:red;">*</span></td>
                                <td>
                                    <input type="text" name="debit_nominal_de_la_pompe" class="inp-form" value="<?php echo set_value('debit_nominal_de_la_pompe',$this->form_data->debit_nominal_de_la_pompe); ?>"/>
                                    <?php echo form_error('debit_nominal_de_la_pompe'); ?>
				</td>
			</tr>
			<tr>
				<td valign="top">Debit maximal de la pompe<span style="color:red;">*</span></td>
                                <td>
                                    <input type="text" name="debit_maximal_de_la_pompe" class="inp-form" value="<?php echo set_value('debit_maximal_de_la_pompe',$this->form_data->debit_maximal_de_la_pompe); ?>"/>
                                    <?php echo form_error('debit_maximal_de_la_pompe'); ?>
				</td>
			</tr>
			<tr>
				<td valign="top">Puissance de la pompe<span style="color:red;">*</span></td>
                                <td>
                                    <input type="text" name="puissance_de_la_pompe" class="inp-form" value="<?php echo set_value('puissance_de_la_pompe',$this->form_data->puissance_de_la_pompe); ?>"/>
                                    <?php echo form_error('puissance_de_la_pompe'); ?>
				</td>
			</tr>
			<tr>
				<td valign="top">Consommation de la pompe<span style="color:red;">*</span></td>
                                <td>
                                    <input type="text" name="consommation_de_la_pompe" class="inp-form" value="<?php echo set_value('consommation_de_la_pompe',$this->form_data->consommation_de_la_pompe); ?>"/>
                                    <?php echo form_error('consommation_de_la_pompe'); ?>
				</td>
			</tr>
			
			<tr>
				<td valign="top">Etat de la pompe<span style="color:red;">*</span></td>
                                <td>
                                    <input type="text" name="etat_de_la_pompe" class="inp-form" value="<?php echo set_value('etat_de_la_pompe',$this->form_data->etat_de_la_pompe); ?>"/>
                                    <?php echo form_error('etat_de_la_pompe'); ?>
				</td>
			</tr>
			
			<tr>
				<td>&nbsp;</td>
                                <td><input type="submit" name="enregistrer" value="Save"/></td>
			</tr>
		</table>
		</div>
		</form>
		<br />
		<?php echo $link_back; ?>
	</div>
