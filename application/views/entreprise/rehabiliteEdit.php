<div class="content">
	<h3 class="tit"><?php echo $title; ?></h3>
	<?php if(isset($message)){?>
	<h4><p class="msg error"> <?php echo $message; ?></p></h4>
	<?php  } ?>
	<form method="post" action="<?php echo $action; ?>" enctype="multipart/form-data">
		<input type="hidden" name="code_rehabilite" value="<?php echo set_value('code_rehabilite',$this->form_data->code_rehabilite); ?>"/>
		<fieldset>
			<legend>Ajout/edit Rehabilitation</legend>
			
			<div class="data">
			<table class="nostyle">				
				<tr>
					<td valign="top">Nom Entreprise :<span style="color:red;">*</span></td>
					<td><select type="text"  name="code_entreprise" class="input-text">
							<option value="">-- Choisir une Entreprise --</option>
							<?php 
								foreach($entreprises as $entreprise){
									if($entreprise->code_entreprise == $this->form_data->code_entreprise){
										$selected = 'selected';
									}else{
										$selected = '';
									}
									echo '<option value="'.$entreprise->code_entreprise.'"  '.$selected.'>'.$entreprise->nom_de_l_entreprise.'</option>';
								}
							?>
						   </select>
						<?php echo form_error('code_entreprise'); ?>
					</td>
				</tr>					
				<tr>
					<td valign="top">Ouvrage en panne :<span style="color:red;">*</span></td>
					<td><select type="text"  name="code_de_l_ouvrage" class="input-text">
							<option value="">-- Choisir un Ouvrage --</option>
							<?php 
								foreach($ouvrages as $ouvrage){
									if($ouvrage->code_de_l_ouvrage == $this->form_data->code_de_l_ouvrage){
										$selected = 'selected';
									}else{
										$selected = '';
									}
									echo '<option value="'.$ouvrage->code_de_l_ouvrage.'"  '.$selected.'>'.$ouvrage->code_de_l_ouvrage.'</option>';
								}
							?>
						   </select>
						<?php echo form_error('code_de_l_ouvrage'); ?>
					</td>
				</tr>					
				<tr>
					<td valign="top">Cout rehabilitation :<span style="color:red;">*</span></td>
					<td><input type="text" size="40" name="cout_rehabilitation" placeholder="Cout de la rehabilitation" class="input-text" value="<?php echo set_value('cout_rehabilitation',$this->form_data->cout_rehabilitation); ?>"/>
						<?php echo form_error('cout_rehabilitation'); ?>
					</td>
				</tr>						
				<tr>
					<td valign="top">Date debut des travaux :<span style="color:red;">*</span></td>
					<td><input type="text" size="40" name="date_de_rehabilitation" placeholder="Date debut des travaux" class="input-text" id="inputField" value="<?php echo set_value('date_de_rehabilitation',$this->form_data->date_de_rehabilitation); ?>"/>
						<?php echo form_error('date_de_rehabilitation'); ?>
					</td>
				</tr>		
				<tr>
					<td valign="top">Duree de la rehabilitation :<span style="color:red;">*</span></td>
					<td><select type="text"  name="duree_de_rehabilitation" class="input-text">
							<option value="">-- Choisir la duree des travaux--</option>
							<?php 
									$i=2;
									while($i<=30){
										if($i == $this->form_data->duree_de_rehabilitation){
											$selected = 'selected';
										}else{
											$selected = '';
										}
										echo '<option value="'.$i.'"  '.$selected.'>'.$i.' Semaines</option>';
										
										 $i+=2;
									}
							?>
						   </select>
						<?php echo form_error('duree_de_rehabilitation'); ?>
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
