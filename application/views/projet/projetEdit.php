<div class="content">
		<h3 class="tit"><?php if (isset($title)) echo $title; ?></h3>
		<?php if (isset($message)) echo $message; ?>
		<form method="post" action="<?php echo $action; ?>">
		<div class="data">
		<fieldset>
			<legend>Ajout/Edit projet</legend>
		<table class="nostyle">
			<tr>
				<td valign="top">Libelle du projet<span style="color:red;">*</span></td>
                                <td>
                                    <input type="text" name="libelle_du_projet" class="inp-form" value="<?php echo set_value('libelle_du_projet',$this->form_data->libelle_du_projet); ?>"/>
                                    <?php echo form_error('libelle_du_projet'); ?>
				</td>
			</tr>
			
			<tr>
				<td>&nbsp;</td>
                                <td><input type="submit" name="enregistrer" value="Save"/></td>
			</tr>
		</table>
		</fieldset>
		</div>
		</form>
		<br />
		<?php echo $link_back; ?>
	</div>
