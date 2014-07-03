<div class="content">
	<h3 class="tit"><?php echo $title; ?></h3>
	<?php if(isset($message)){?>
	<h4><p class="msg error"> <?php echo $message; ?></p></h4>
	<?php  } ?>
	<form method="post" action="<?php echo $action; ?>" enctype="multipart/form-data">
		<input type="hidden" name="code_bailleur" value="<?php echo set_value('code_bailleur',$this->form_data->code_bailleur); ?>"/>
		<fieldset>
			<legend>Ajout/Edit bailleur</legend>
			
			<div class="data">
			<table class="nostyle">
				<tr>
					<td valign="top">Type de Bailleur :<span style="color:red;">*</span></td>
					<td><select type="text"  name="type_bailleur" class="input-text">
							<?php 
									foreach($options as $key=>$value){
										if($key == $this->form_data->type_bailleur){
											$selected = 'selected';
										}else{
											$selected = '';
										}
										echo '<option value="'.$key.'"  '.$selected.'>'.$value.'</option>';
									}
							?>
						   </select>
						<?php echo form_error('type_bailleur'); ?>
					</td>
				</tr>				
				<tr>
					<td valign="top">Denomination :<span style="color:red;">*</span></td>
					<td><input type="text" size="40" name="denomination" placeholder="Denomination" class="input-text" value="<?php echo set_value('denomination',$this->form_data->denomination); ?>"/>
						<?php echo form_error('denomination'); ?>
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
