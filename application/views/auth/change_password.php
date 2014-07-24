<h3 class="tit"><?php echo lang('change_password_heading');?></h3>
<div id="infoMessage"><?php echo $message;?></div>
<fieldset>
<legend>modifier votre mot de passe</legend>
<?php echo form_open("auth/change_password");?>
	<table class="nostyle">
      <tr>
            <td> <?php echo lang('change_password_old_password_label', 'old_password');?> </td>
            <td><?php echo form_input($old_password);?></td>
      </tr>

      <tr>
            <td><?php echo sprintf(lang('change_password_new_password_label'), $min_password_length);?></td>
            <td><?php echo form_input($new_password);?><td>
      </tr>      
	  <tr>
            <td> <?php echo lang('change_password_new_password_confirm_label', 'new_password_confirm');?></td>
            <td><?php echo form_input($new_password_confirm);?><td>
      </tr>

      <p></p>
	  <tr><td style="width:150px;"></td><td><?php echo form_submit(array('name'=>'submit', 'value'=>lang('change_password_submit_btn'), 'class'=>'input-submit'));?></td></tr>

	 </table>
      <?php echo form_input($user_id);?>
</fieldset>
<?php echo form_close();?>
