<div class="content">
		<h1><?php if (isset($title)) echo $title; ?></h1>
		<?php if (isset($message)) echo $message; ?>
		<form method="post" action="<?php echo $action; ?>">
		<div class="data">
		<table>
			<tr>
				<td valign="top">Profondeur<span style="color:red;">*</span></td>
                                <td>
                                    <input type="text" name="profondeur" class="inp-form" value="<?php echo set_value('profondeur',$this->form_data->profondeur); ?>"/>
                                    <?php echo form_error('profondeur'); ?>
				</td>
			</tr>
			<tr>
				<td valign="top">hauteur d'eau<span style="color:red;">*</span></td>
                                <td>
                                    <input type="text" name="hauteur_d_eau" class="inp-form" value="<?php echo set_value('hauteur_d_eau',$this->form_data->hauteur_d_eau); ?>"/>
                                    <?php echo form_error('hauteur_d_eau'); ?>
				</td>
			</tr>
			<tr>
				<td valign="top">Niveau statique de l'eau<span style="color:red;">*</span></td>
                                <td>
                                    <input type="text" name="niveau_statique_de_l_eau" class="inp-form" value="<?php echo set_value('niveau_statique_de_l_eau',$this->form_data->niveau_statique_de_l_eau); ?>"/>
                                    <?php echo form_error('niveau_statique_de_l_eau'); ?>
				</td>
			</tr>
			<tr>
				<td valign="top">Niveau top crepine<span style="color:red;">*</span></td>
                                <td>
                                    <input type="text" name="niveau_top_crepine" class="inp-form" value="<?php echo set_value('niveau_top_crepine',$this->form_data->niveau_top_crepine); ?>"/>
                                    <?php echo form_error('niveau_top_crepine'); ?>
				</td>
			</tr>
			<tr>
				<td valign="top">Transmissivite<span style="color:red;">*</span></td>
                                <td>
                                    <input type="text" name="transmissivite" class="inp-form" value="<?php echo set_value('transmissivite',$this->form_data->transmissivite); ?>"/>
                                    <?php echo form_error('transmissivite'); ?>
				</td>
			</tr>
			<tr>
				<td valign="top">Coefficient d'emmagasinement<span style="color:red;">*</span></td>
                                <td>
                                    <input type="text" name="coefficient_d_emmagasinement" class="inp-form" value="<?php echo set_value('coefficient_d_emmagasinement',$this->form_data->coefficient_d_emmagasinement); ?>"/>
                                    <?php echo form_error('coefficient_d_emmagasinement'); ?>
				</td>
			</tr>
			<tr>
				<td valign="top">Diametre de perforation<span style="color:red;">*</span></td>
                                <td>
                                    <input type="text" name="diametre_de_perforation" class="inp-form" value="<?php echo set_value('diametre_de_perforation',$this->form_data->diametre_de_perforation); ?>"/>
                                    <?php echo form_error('diametre_de_perforation'); ?>
				</td>
			</tr>
			<tr>
				<td valign="top">Debit d'exploitation debit specification<span style="color:red;">*</span></td>
                                <td>
                                    <input type="text" name="debit_d_exploitation_debit_speci" class="inp-form" value="<?php echo set_value('debit_d_exploitation_debit_speci',$this->form_data->debit_d_exploitation_debit_speci); ?>"/>
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
