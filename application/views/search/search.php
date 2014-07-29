<div class="content">
	<h3 class="tit"><?php echo $title; ?></h3>
<?php  $message = $this->session->flashdata('message'); if(isset($message)&&$message!=''){?>
<h4><p class="msg warning"> <?php echo $message; ?></p></h4>
<?php  } ?>
	<form method="post" action="<?php echo $action; ?>" enctype="multipart/form-data">
		<fieldset>
			<legend>Rechercher ouvrages</legend>
			
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
					<td valign="top">Departement :</td>
					<td><select type="text"  name="code_departement" class="input-text" id="departement" onchange='go1()'>
							<option value="">-- Choisir un departement --</option>
						   </select>
						<?php echo form_error('code_departement'); ?>
					</td>
				</tr>										
				<tr>
					<td valign="top">Arrondissement :</td>
					<td><select type="text"  name="code_arrondissement" class="input-text" id="arrondissement" onchange='go5()'>
							<option value="">-- Choisir un arrondissement --</option>
						   </select>
						<?php echo form_error('code_arrondissement'); ?>
					</td>
					<td valign="top">Localite :</td>
					<td><select type="text"  name="code_localite" class="input-text" id="localite" onchange='go6()'>
							<option value="">-- Choisir une localite --</option>
						   </select>
						<?php echo form_error('code_localite'); ?>
					</td>
				</tr>								
				<tr>
					<td valign="top">Type d'ouvrage :<span style="color:red;">*</span></td>
					<td><select type="text"  name="type_ouvrage" class="input-text">
							<option value="">-- Choisir un type d'ouvrage --</option>
							<option value="hydrau" disabled>OUVRAGE HYROLIQUE</option>
							<option value="1">Sources amenagees </option>
							<option value="2">Forages ou puits</option>
						<!--	<option value="3">Bornes fontaines </option>-->
							<option value="4">Adductions en eau potable</option>
							<option value="assain" disabled>OUVRAGE D'ASSAINISSEMENT</option>
							<option value="5">Stations d'epurations</option>
							<option value="6">Puisards</option>
							<option value="7">Latrines</option>
						   </select>
					</td>
					<td valign="top">Etat de l'ouvrage :<span style="color:red;">*</span></td>
					<td><select type="text"  name="etat_ouvrage" class="input-text">
							<option value="">-- Choisir un etat --</option>
							<option value="Fonctionnel">Fonctionnel</option>
							<option value="Partiellement Fonctionnel">Partiellement Fonctionnel</option>
							<option value="Non fonctionnel">Non fonctionnel</option>
						   </select>
					</td>
				</tr>						
			</table>
			</div>
		</fieldset>
			<table class="nostyle">			
				<tr>
					<td style="width:200px;"></td><td colspan="2" class="t-right"><input type="submit" class="input-submit" value="Rechercher" name="enregistrer"/></td><td colspan="2" class="t-right"><input type="reset" class="input-submit" value="annuler" /></td>
				</tr>
			</table>
			<br />
	</form>
</div>
