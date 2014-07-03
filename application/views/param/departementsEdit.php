<div class="content">
	<h3 class="tit"><?php echo $title; ?></h3>
	<?php if(isset($message)){?>
	<h4><p class="msg error"> <?php echo $message; ?></p></h4>
	<?php  } ?>
	<form method="post" action="<?php echo $action; ?>" enctype="multipart/form-data">
		<input type="hidden" name="code_departement" value="<?php echo set_value('code_departement',$this->form_data->code_departement); ?>"/>
		<fieldset>
			<legend>Ajout departement</legend>
			
			<div class="data">
			<table class="nostyle">	
				<tr>
					<td valign="top">Nom departement :<span style="color:red;">*</span></td>
					<td><input type="text" size="40" name="nom_departement" placeholder="Saisir le nom du departement" class="input-text" value="<?php echo set_value('nom_departement',$this->form_data->nom_departement); ?>"/>
						<?php echo form_error('nom_departement'); ?>
					</td>
				</tr>				
				<tr>
					<td valign="top">Region :<span style="color:red;">*</span></td>
					<td><select type="text"  name="code_region" class="input-text">
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
					<td valign="top">Superficie :<span style="color:red;">*</span></td>
					<td><input type="text" size="40" name="superficie" placeholder="Superficie" class="input-text" value="<?php echo set_value('superficie',$this->form_data->superficie); ?>"/>
						<?php echo form_error('superficie'); ?>
					</td>
				</tr>								
				<tr>
					<td valign="top">Population :<span style="color:red;">*</span></td>
					<td><input type="text" size="40" name="population" placeholder="population" class="input-text" value="<?php echo set_value('population',$this->form_data->population); ?>"/>
						<?php echo form_error('population'); ?>
					</td>
				</tr>
				<tr>
					<td valign="top">Taux d'acroissement :<span style="color:red;">*</span></td>
					<td><input type="text" size="40" name="taux_accroissement" placeholder="Taux d'acroissement" class="input-text" value="<?php echo set_value('taux_accroissement',$this->form_data->taux_accroissement); ?>"/>
						<?php echo form_error('taux_accroissement'); ?>
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
