<div class="content">
	<h3 class="tit"><?php echo $title; ?></h3>
	<?php if(isset($message)){?>
	<h4><p class="msg error"> <?php echo $message; ?></p></h4>
	<?php  } ?>
	<form method="post" action="<?php echo $action; ?>" enctype="multipart/form-data">
		<input type="hidden" name="code_caracteristique" value="<?php echo set_value('code_caracteristique',$this->form_data->code_caracteristique); ?>"/>
		<fieldset>
			<legend>Choix de l'ouvrage</legend>
			
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
			</table>
			</div>
		</fieldset>
		<fieldset>
			<legend>Caracteristique e l'eau</legend>
			<div class="data">
			<table class="nostyle">
				<tr>
					<td valign="top">Turbidite :<span style="color:red;">*</span></td>
					<td><input type="text" size="40" name="turbidite" placeholder="Turbidite" class="input-text" value="<?php echo set_value('turbidite',$this->form_data->turbidite); ?>"/>
						<?php echo form_error('turbidite'); ?>
					</td>
					<td valign="top">Temperature :<span style="color:red;">*</span></td>
					<td><input type="text" size="40" name="temperature" placeholder="Temperature" class="input-text" value="<?php echo set_value('temperature',$this->form_data->temperature); ?>"/>
						<?php echo form_error('temperature'); ?>
					</td>
				</tr>								
				<tr>
					<td valign="top">Conductivite  :<span style="color:red;">*</span></td>
					<td><input type="text" size="40" name="conductivite" placeholder="Conductivite" class="input-text" value="<?php echo set_value('conductivite',$this->form_data->conductivite); ?>"/>
						<?php echo form_error('conductivite'); ?>
					</td>
					<td valign="top">matieres_organiques :<span style="color:red;">*</span></td>
					<td><input type="text" size="40" name="matieres_organiques" placeholder="Matieres organiques" class="input-text" value="<?php echo set_value('matieres_organiques',$this->form_data->matieres_organiques); ?>"/>
						<?php echo form_error('matieres_organiques'); ?>
					</td>
				</tr>																										
				<tr>
					<td valign="top">Mineralisation :<span style="color:red;">*</span></td>
					<td><input type="text" size="40" name="mineralisation" placeholder="Mineralisation" class="input-text" value="<?php echo set_value('mineralisation',$this->form_data->mineralisation); ?>"/>
						<?php echo form_error('mineralisation'); ?>
					</td>
					<td valign="top">Potentiel d'hydrogene :<span style="color:red;">*</span></td>
					<td><input type="text" size="40" name="ph" placeholder="Potentiel d'hydrogene" class="input-text" value="<?php echo set_value('ph',$this->form_data->ph); ?>"/>
						<?php echo form_error('ph'); ?>
					</td>
				</tr>											
				<tr>
					<td valign="top">eau_traitee :<span style="color:red;">*</span></td>
					<td><input type="text" size="40" name="eau_traitee" placeholder="Eau traitee" class="input-text" value="<?php echo set_value('eau_traitee',$this->form_data->eau_traitee); ?>"/>
						<?php echo form_error('eau_traitee'); ?>
					</td>
					<td valign="top">Date de prelevement :<span style="color:red;">*</span></td>
					<td><input type="text" size="40" name="date_de_prelevement" placeholder="Date de prelevement" class="input-text" id="inputField" value="<?php echo set_value('date_de_prelevement',$this->form_data->date_de_prelevement); ?>"/>
						<?php echo form_error('date_de_prelevement'); ?>
					</td>
				</tr>					
				<tr>
					<td valign="top">Date d'analyse :<span style="color:red;">*</span></td>
					<td><input type="text" size="40" name="date_d_analyse" placeholder="Date d\'analyse" class="input-text" id="inputField2" value="<?php echo set_value('date_d_analyse',$this->form_data->date_d_analyse); ?>"/>
						<?php echo form_error('date_d_analyse'); ?>
					</td>
					<td valign="top">Saveur :<span style="color:red;">*</span></td>
					<td><select type="text"  name="saveur" class="input-text">
							<option value="">-- Choisir une saveur --</option>
							<option value="Sucre">Sucre</option>
							<option value="Sale">Sale</option>
							<option value="Pimente">Pimente</option>
							<option value="Acide">Acide</option>
							<option value="Amer">Amer </option>
						   </select>
						<?php echo form_error('saveur'); ?>
					</td>
				</tr>									
				<tr>
					<td valign="top">Limpidite :<span style="color:red;">*</span></td>
					<td><input type="text" size="40" name="limpidite" placeholder="Limpidite" class="input-text" value="<?php echo set_value('limpidite',$this->form_data->limpidite); ?>"/>
						<?php echo form_error('limpidite'); ?>
					</td>
					<td valign="top">Constante d'équilibre :<span style="color:red;">*</span></td>
					<td><input type="text" size="40" name="k" placeholder="Constante d'équilibre" class="input-text" value="<?php echo set_value('k',$this->form_data->k); ?>"/>
						<?php echo form_error('k'); ?>
					</td>
				</tr>									
				<tr>
					<td valign="top">Ammonium :<span style="color:red;">*</span></td>
					<td><input type="text" size="40" name="nh4" placeholder="nh4" class="input-text" value="<?php echo set_value('nh4',$this->form_data->nh4); ?>"/>
						<?php echo form_error('nh4'); ?>
					</td>
					<td valign="top">Fer :<span style="color:red;">*</span></td>
					<td><input type="text" size="40" name="fe" placeholder="Fer" class="input-text" value="<?php echo set_value('fe',$this->form_data->fe); ?>"/>
						<?php echo form_error('fe'); ?>
					</td>
				</tr>				
				<tr>
					<td valign="top">Manganèse :<span style="color:red;">*</span></td>
					<td><input type="text" size="40" name="mn" placeholder="Manganèse" class="input-text" value="<?php echo set_value('mn',$this->form_data->mn); ?>"/>
						<?php echo form_error('mn'); ?>
					</td>
					<td valign="top">Carbonate :<span style="color:red;">*</span></td>
					<td><input type="text" size="40" name="co3" placeholder="Carbonate" class="input-text" value="<?php echo set_value('co3',$this->form_data->co3); ?>"/>
						<?php echo form_error('co3'); ?>
					</td>
				</tr>						
				<tr>
					<td valign="top">Sulfate :<span style="color:red;">*</span></td>
					<td><input type="text" size="40" name="so4" placeholder="Sulfate" class="input-text" value="<?php echo set_value('so4',$this->form_data->so4); ?>"/>
						<?php echo form_error('so4'); ?>
					</td>
					<td valign="top">Fluor :<span style="color:red;">*</span></td>
					<td><input type="text" size="40" name="f" placeholder="Fluor" class="input-text" value="<?php echo set_value('f',$this->form_data->f); ?>"/>
						<?php echo form_error('f'); ?>
					</td>
				</tr>						
				<tr>
					<td valign="top">Bicarbonate :<span style="color:red;">*</span></td>
					<td><input type="text" size="40" name="hco3" placeholder="hco3" class="input-text" value="<?php echo set_value('hco3',$this->form_data->hco3); ?>"/>
						<?php echo form_error('hco3'); ?>
					</td>
					<td valign="top">Dioxyde de carbone dissous :<span style="color:red;">*</span></td>
					<td><input type="text" size="40" name="co2_dissous" placeholder="co2 dissous" class="input-text" value="<?php echo set_value('co2_dissous',$this->form_data->co2_dissous); ?>"/>
						<?php echo form_error('co2_dissous'); ?>
					</td>
				</tr>				
				<tr>
					<td valign="top">Dioxyde dissous  :<span style="color:red;">*</span></td>
					<td><input type="text" size="40" name="o2_dissous" placeholder="o2 dissous" class="input-text" value="<?php echo set_value('o2_dissous',$this->form_data->o2_dissous); ?>"/>
						<?php echo form_error('o2_dissous'); ?>
					</td>
					<td valign="top">Silice :<span style="color:red;">*</span></td>
					<td><input type="text" size="40" name="silice" placeholder="Silice" class="input-text" value="<?php echo set_value('silice',$this->form_data->silice); ?>"/>
						<?php echo form_error('silice'); ?>
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
