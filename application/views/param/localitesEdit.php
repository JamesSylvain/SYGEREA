<div class="content">
	<h3 class="tit"><?php echo $title; ?></h3>
	<?php if(isset($message)){?>
	<h4><p class="msg error"> <?php echo $message; ?></p></h4>
	<?php  } ?>
	<form method="post" action="<?php echo $action; ?>" enctype="multipart/form-data">
		<input type="hidden" name="code_de_la_localite" value="<?php echo set_value('code_de_la_localite',$this->form_data->code_de_la_localite); ?>"/>
		<fieldset>
			<legend>Situation Administrative</legend>
			
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
							<option value="">-- Choisir une Departement --</option>
						   </select>
						<?php echo form_error('code_departement'); ?>
					</td>
				</tr>					
				<tr>
					<td valign="top">Arrondissement :<span style="color:red;">*</span></td>
					<td><select type="text"  name="code_arrondissement" class="input-text" id="arrondissement">
							<option value="">-- Choisir un arrondissement --</option>
						   </select>
						<?php echo form_error('code_arrondissement'); ?>
					</td>
				</tr>		
				<tr>
					<td valign="top">Nom Localite :<span style="color:red;">*</span></td>
					<td><input type="text" size="40" name="nom_localite" placeholder="Saisir le nom de la localite" class="input-text" value="<?php echo set_value('nom_localite',$this->form_data->nom_localite); ?>"/>
						<?php echo form_error('nom_localite'); ?>
					</td>
				</tr>						
				<tr>
					<td valign="top">Lieu Dit :<span style="color:red;">*</span></td>
					<td><input type="text" size="40" name="lieudit" placeholder="Saisir le lieu dit" class="input-text" value="<?php echo set_value('lieudit',$this->form_data->lieudit); ?>"/>
						<?php echo form_error('lieudit'); ?>
					</td>
				</tr>	
			</table>
			</div>
		</fieldset>
		<fieldset>
			<legend>Informations generales</legend>
			
			<div class="data">
			<table class="nostyle">
				<tr>
					<td valign="top">Population recense :<span style="color:red;">*</span></td>
					<td><input type="text" size="40" name="population_recensee" placeholder="Population recensee" class="input-text" value="<?php echo set_value('population_recensee',$this->form_data->population_recensee); ?>"/>
						<?php echo form_error('population_recensee'); ?>
					</td>
				</tr>								
				<tr>
					<td valign="top">Date recensement :<span style="color:red;">*</span></td>
					<td><input type="text" size="40" name="date_recensement" placeholder="Date recensement" class="input-text" value="<?php echo set_value('date_recensement',$this->form_data->date_recensement); ?>"/>
						<?php echo form_error('date_recensement'); ?>
					</td>
				</tr>
				<tr>
					<td valign="top">Taux de croissance de la population  :<span style="color:red;">*</span></td>
					<td><input type="text" size="40" name="taux_croissance" placeholder="Saisir le taux de croissance" class="input-text" value="<?php echo set_value('taux_croissance',$this->form_data->taux_croissance); ?>"/>
						<?php echo form_error('taux_croissance'); ?>
					</td>
				</tr>										
				<tr>
					<td valign="top">Nombres de Menages :<span style="color:red;">*</span></td>
					<td><input type="text" size="40" name="nbre_de_menages" placeholder="Nombre de menages" class="input-text" value="<?php echo set_value('nbre_de_menages',$this->form_data->nbre_de_menages); ?>"/>
						<?php echo form_error('nbre_de_menages'); ?>
					</td>
				</tr>						
			<!--	<tr>
					<td valign="top">Nombres d'ecole :<span style="color:red;">*</span></td>
					<td><input type="text" size="40" name="nbre_d_ecole" placeholder="Nombre d'ecoles" class="input-text" value="<?php echo set_value('nbre_d_ecole',$this->form_data->nbre_d_ecole); ?>"/>
						<?php echo form_error('nbre_d_ecole'); ?>
					</td>
				</tr>	-->
				<tr>
					<td valign="top">Nombres d'ecole :<span style="color:red;">*</span></td>
					<td><select type="text"  name="nbre_d_ecole" class="input-text">
							<?php 
									for($i=0;$i<=15; $i++){
										if($i == $this->form_data->nbre_d_ecole){
											$selected = 'selected';
										}else{
											$selected = '';
										}
										echo '<option value="'.$i.'"  '.$selected.'>'.$i.'</option>';
									}
							?>
						   </select>
						<?php echo form_error('nbre_d_ecole'); ?>
					</td>
				</tr>				
				<tr>
					<td valign="top">Nombres de centre de sante :<span style="color:red;">*</span></td>
					<td><select type="text"  name="nbre_de_centre_de_sante" class="input-text">
							<?php 
									for($i=0;$i<=15; $i++){
										if($i == $this->form_data->nbre_de_centre_de_sante){
											$selected = 'selected';
										}else{
											$selected = '';
										}
										echo '<option value="'.$i.'"  '.$selected.'>'.$i.'</option>';
									}
							?>
						   </select>
						<?php echo form_error('nbre_de_centre_de_sante'); ?>
					</td>
				</tr>					
				<tr>
					<td valign="top">Nombres d'hopitaux :<span style="color:red;">*</span></td>
					<td><select type="text"  name="nbre_d_hopitaux" class="input-text">
							<?php 
									for($i=0;$i<=15; $i++){
										if($i == $this->form_data->nbre_d_hopitaux){
											$selected = 'selected';
										}else{
											$selected = '';
										}
										echo '<option value="'.$i.'"  '.$selected.'>'.$i.'</option>';
									}
							?>
						   </select>
						<?php echo form_error('nbre_d_hopitaux'); ?>
					</td>
				</tr>					
				<tr>
					<td valign="top">Lieux de cultes (Eglise/Mosquée) :<span style="color:red;">*</span></td>
					<td><select type="text"  name="nbre_de_lieux_de_culte" class="input-text" >
							<?php 
									for($i=0;$i<=15; $i++){
										if($i == $this->form_data->nbre_de_lieux_de_culte){
											$selected = 'selected';
										}else{
											$selected = '';
										}
										echo '<option value="'.$i.'"  '.$selected.'>'.$i.'</option>';
									}
							?>
						   </select>
						<?php echo form_error('nbre_de_lieux_de_culte'); ?>
					</td>
				</tr>												
				<tr>
					<td valign="top">Coordonnee en x :<span style="color:red;">*</span></td>
					<td><input type="text" size="40" name="coordonnees_en_x" placeholder="Coordonnee en x" class="input-text" value="<?php echo set_value('coordonnees_en_x',$this->form_data->coordonnees_en_x); ?>"/>
						<?php echo form_error('coordonnees_en_x'); ?>
					</td>
				</tr>						
				<tr>
					<td valign="top">Coordonnee en y :<span style="color:red;">*</span></td>
					<td><input type="text" size="40" name="coordonnees_en_y" placeholder="Coordonnee en y" class="input-text" value="<?php echo set_value('coordonnees_en_y',$this->form_data->coordonnees_en_y); ?>"/>
						<?php echo form_error('coordonnees_en_y'); ?>
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
