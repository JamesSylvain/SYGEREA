<div class="content">
	<h3 class="tit"><?php echo $title; ?></h3>
	<?php if(isset($message)){?>
	<h4><p class="msg error"> <?php echo $message; ?></p></h4>
	<?php  } ?>
	<?php  $message = $this->session->flashdata('warning'); if(isset($message)&&$message!=''){?>
<h4><p class="msg warning"> <?php echo $message; ?></p></h4>
<?php  } ?>
	<form method="post" action="<?php echo $action; ?>" enctype="multipart/form-data">
		<fieldset>
			<legend>Ajout/edit financement</legend>
			
			<div class="data">
			<table class="nostyle">	
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
							<option value="">-- Choisir un departement --</option>
						   </select>
						<?php echo form_error('code_departement'); ?>
					</td>
				</tr>					
				<tr>
					<td valign="top">Arrondissement :<span style="color:red;">*</span></td>
					<td><select type="text"  name="code_arrondissement" class="input-text" id="arrondissement" onchange='go5()'>
							<option value="">-- Choisir un arrondissement --</option>
						   </select>
						<?php echo form_error('code_arrondissement'); ?>
					</td>
				</tr>		
				<tr>
					<td valign="top">Localite :<span style="color:red;">*</span></td>
					<td><select type="text"  name="code_localite" class="input-text" id="localite" onchange='go6()'>
							<option value="">-- Choisir une localite --</option>
						   </select>
						<?php echo form_error('code_localite'); ?>
					</td>
				</tr>					
				<tr>
					<td valign="top">Ouvrage :<span style="color:red;">*</span></td>
					<td><select type="text"  name="code_ouvrage" class="input-text" id="ouvrage">
							<option value="">-- Choisir un Ouvrage --</option>
						   </select>
						<?php echo form_error('code_ouvrage'); ?>
					</td>
				</tr>									
				<tr>
					<td valign="top">Nom bailleur :<span style="color:red;">*</span></td>
					<td><select type="text"  name="code_bailleur" class="input-text">
							<option value="">-- Choisir un Bailleur --</option>
							<?php 
								foreach($bailleurs as $bailleur){
									if($bailleur->code_bailleur == $this->form_data->code_bailleur){
										$selected = 'selected';
									}else{
										$selected = '';
									}
									echo '<option value="'.$bailleur->code_bailleur.'"  '.$selected.'>'.$bailleur->denomination.'</option>';
								}
							?>
						   </select>
						<?php echo form_error('code_bailleur'); ?>
					</td>
				</tr>									
				<tr>
					<td valign="top">Montant financement :<span style="color:red;">*</span></td>
					<td><input type="text" size="40" name="montant_financement" placeholder="Montant Financement" class="input-text" value="<?php echo set_value('montant_financement',$this->form_data->montant_financement); ?>"/>
						<?php echo form_error('montant_financement'); ?>
					</td>
				</tr>		
				<tr>
					<td valign="top">Annee Financement :<span style="color:red;">*</span></td>
					<td><select type="text"  name="annee_financement" class="input-text">
							<?php 
									for($i=2014;$i<=2020; $i++){
										if($i == $this->form_data->annee_financement){
											$selected = 'selected';
										}else{
											$selected = '';
										}
										echo '<option value="'.$i.'"  '.$selected.'>'.$i.'</option>';
									}
							?>
						   </select>
						<?php echo form_error('annee_financement'); ?>
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
