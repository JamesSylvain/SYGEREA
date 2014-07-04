<div class="content">
	<h3 class="tit"><?php echo $title; ?></h3>
	<?php if(isset($message)){?>
	<h4><p class="msg error"> <?php echo $message; ?></p></h4>
	<?php  } ?>
		<form method="post" action="<?php echo $action; ?>">
		<div class="data">
		<table>
			<tr>
				<td valign="top">Nom<span style="color:red;">*</span></td>
                                <td>
                                    <input type="text" name="nom_de_l_entreprise" class="inp-form" value="<?php echo set_value('nom_de_l_entreprise',$this->form_data->nom_de_l_entreprise); ?>"/>
                                    <?php echo form_error('nom_de_l_entreprise'); ?>
				</td>
			</tr>
			<tr>
				<td valign="top">Téléphone<span style="color:red;">*</span></td>
                                <td>
                                    <input type="tel" pattern="[0-9]{8}" name="tel" class="inp-form" value="<?php echo set_value('tel',$this->form_data->tel); ?>"/>
                                    <?php echo form_error('tel'); ?>
				</td>
			</tr>
			<tr>
				<td valign="top">Code Postal<span style="color:red;">*</span></td>
                                <td>
                                    <input type="text" name="code_potal" class="inp-form" value="<?php echo set_value('code_potal',$this->form_data->code_potal); ?>"/>
                                    <?php echo form_error('code_potal'); ?>
				</td>
			</tr>
			<tr>
				<td valign="top">Ville<span style="color:red;">*</span></td>
                                <td>
                                    <input type="text" name="ville" class="inp-form" value="<?php echo set_value('ville',$this->form_data->ville); ?>"/>
                                    <?php echo form_error('ville'); ?>
				</td>
			</tr>
			<tr>
				<td valign="top">Email<span style="color:red;">*</span></td>
                                <td>
                                    <input type="email" name="email" class="inp-form" value="<?php echo set_value('email',$this->form_data->email); ?>"/>
                                    <?php echo form_error('email'); ?>
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
