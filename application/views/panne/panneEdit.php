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
					<td valign="top">Departement :<span style="color:red;">*</span></td>
					<td><select type="text"  name="code_departement" class="input-text">
							<option value="">-- Choisir une Departement --</option>
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
					<td valign="top">Arrondissement :<span style="color:red;">*</span></td>
					<td><select type="text"  name="code_arrondissement" class="input-text">
							<option value="">-- Choisir un arrondissement --</option>
							<?php 
								foreach($arrondissements as $arrondissement){
									if($arrondissement->code_arrondissement == $this->form_data->code_arrondissement){
										$selected = 'selected';
									}else{
										$selected = '';
									}
									echo '<option value="'.$arrondissement->code_arrondissement.'"  '.$selected.'>'.$arrondissement->libelle_arrondissement.'</option>';
								}
							?>
						   </select>
						<?php echo form_error('code_arrondissement'); ?>
					</td>
				</tr>										
				<tr>
					<td valign="top">Localite :<span style="color:red;">*</span></td>
					<td><select type="text"  name="code_localite" class="input-text">
							<option value="">-- Choisir une localite --</option>
							<?php 
								foreach($localites as $localite){
									if($localite->code_de_la_localite == $this->form_data->code_localite){
										$selected = 'selected';
									}else{
										$selected = '';
									}
									echo '<option value="'.$localite->code_de_la_localite.'"  '.$selected.'>'.$localite->nom.' - '.$localite->lieudit.'</option>';
								}
							?>
						   </select>
						<?php echo form_error('code_localite'); ?>
					</td>
				</tr>	
				<tr>
					<td valign="top">Ouvrage en panne :<span style="color:red;">*</span></td>
					<td><select type="text"  name="code_de_l_ouvrage" class="input-text">
							<option value="">-- Choisir un ouvrage --</option>
							<?php 
								foreach($ouvrages as $ouvrage){
									if($ouvrage->code_de_l_ouvrage == $this->form_data->code_de_l_ouvrage){
										$selected = 'selected';
									}else{
										$selected = '';
									}
									echo '<option value="'.$ouvrage->code_de_l_ouvrage.'"  '.$selected.'>'.$ouvrage->libelle_region.'</option>';
								}
							?>
						   </select>
						<?php echo form_error('code_ouvrage'); ?>
					</td>
				</tr>						
				<tr>
					<td valign="top">Description de la panne :<span style="color:red;">*</span></td>
					<td><textarea cols="75" rows="7" name="libelle_panne" placeholder="Description de la panne" class="input-text">​<?php echo set_value('libelle_panne',$this->form_data->libelle_panne); ?></textarea>​
						<?php echo form_error('libelle_panne'); ?>
					</td>
				</tr>								
				<tr>
					<td valign="top">Date mise hors usage :<span style="color:red;">*</span></td>
					<td><input type="text" size="40" name="date_mise_hors_usage" placeholder="Date mise hors usage" class="input-text" value="<?php echo set_value('date_mise_hors_usage',$this->form_data->date_mise_hors_usage); ?>"/>
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
