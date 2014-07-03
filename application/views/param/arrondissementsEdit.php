<div class="content">
	<h3 class="tit"><?php echo $title; ?></h3>
	<?php if(isset($message)){?>
	<h4><p class="msg error"> <?php echo $message; ?></p></h4>
	<?php  } ?>
	<form method="post" action="<?php echo $action; ?>" enctype="multipart/form-data">
		<input type="hidden" name="code_arrondissement" value="<?php echo set_value('code_arrondissement',$this->form_data->code_arrondissement); ?>"/>
		<fieldset>
			<legend>Ajout arrondissement</legend>
			
			<div class="data">
			<table class="nostyle">	
				<tr>
					<td valign="top">Nom arrondissement :<span style="color:red;">*</span></td>
					<td><input type="text" size="40" name="nom_arrondissement" placeholder="Saisir le nom de l'arrondissement" class="input-text" value="<?php echo set_value('nom_arrondissement',$this->form_data->nom_arrondissement); ?>"/>
						<?php echo form_error('nom_arrondissement'); ?>
					</td>
				</tr>				
				<tr>
					<td valign="top">Departement :<span style="color:red;">*</span></td>
					<td><select type="text"  name="code_departement" class="input-text">
							<option value="">-- Choisir un departement --</option>
							<?php 
								foreach($departements as $departement){
									if($departement->code_departement == $this->form_data->code_departement){
										$selected = 'selected';
									}else{
										$selected = '';
									}
									echo '<option value="'.$departement->code_departement.'"  '.$selected.'>'.$departement->libelle_departement.'</option>';
								}
							?>
						   </select>
						<?php echo form_error('code_departement'); ?>
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
