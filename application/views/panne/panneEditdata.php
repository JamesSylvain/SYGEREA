<div class="content">
	<h3 class="tit"><?php echo $title; ?></h3>
	<?php if(isset($message)){?>
	<h4><p class="msg error"> <?php echo $message; ?></p></h4>
	<?php  } ?>
	<form method="post" action="<?php echo $action; ?>" enctype="multipart/form-data">
		<input type="hidden" name="code_panne" value="<?php echo set_value('code_panne',$this->form_data->code_panne); ?>"/>
		<fieldset>
			<legend>Ajout/Edit panne</legend>
			
			<div class="data">
			<table class="nostyle">									
				<tr>
					<td valign="top">Description de la panne :<span style="color:red;">*</span></td>
					<td><textarea cols="75" rows="7" name="libelle_panne" placeholder="Description de la panne" class="input-text">​<?php echo set_value('libelle_panne',$this->form_data->libelle_panne); ?></textarea>​
						<?php echo form_error('libelle_panne'); ?>
					</td>
				</tr>								
				<tr>
					<td valign="top">Date mise hors usage :<span style="color:red;">*</span></td>
					<td><input type="text" size="40" name="date_mise_hors_usage" placeholder="Date mise hors usage" class="input-text" id="inputField" value="<?php echo set_value('date_mise_hors_usage',$this->form_data->date_mise_hors_usage); ?>"/>
						
						<?php echo form_error('date_mise_hors_usage'); ?>
					</td>
				</tr>				
			</table>
			</div>
		</fieldset>
			<table class="nostyle">			
				<tr>
					<td style="width:200px;"></td><td colspan="2" class="t-right"><input type="submit" class="input-submit" value="Enregistrer" name="enregistrer"/></td><td colspan="2" class="t-right"><input type="reset" class="input-submit" value="annuler" /></td>
				</tr>
			</table>
			<br />
	</form>
</div>
