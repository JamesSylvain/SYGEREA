<h3 class="tit"><?php echo lang('create_user_heading');?></h3>
<fieldset>
<legend><?php echo lang('create_user_subheading');?></legend>

<div id="infoMessage"><?php echo $message;?></div>

<?php echo form_open("auth/create_user");?>
	<table class="nostyle">
      <tr>
            <td><?php echo lang('create_user_fname_label', 'first_name');?></td>
            <td><?php echo form_input($first_name);?></td>
      </tr>

      <tr>
            <td><?php echo lang('create_user_lname_label', 'last_name');?></td>
           <td> <?php echo form_input($last_name);?></td>
      </tr>

      <tr>
            <td><?php echo lang('create_user_company_label', 'company');?></td>
            <td><?php echo form_input($company);?></td>
      </tr>

      <tr>
            <td><?php echo lang('create_user_email_label', 'email');?> </td>
            <td><?php echo form_input($email);?></td>
      </tr>

     <tr>
            <td><?php echo lang('create_user_phone_label', 'phone');?> </td>
            <td><?php echo form_input($phone);?></td>
     </tr>

      <tr>
           <td> <?php echo lang('create_user_password_label', 'password');?> </td>
            <td><?php echo form_input($password);?></td>
      </tr>

     <tr>
            <td><?php echo lang('create_user_password_confirm_label', 'password_confirm');?></td>
            <td><?php echo form_input($password_confirm);?></td>
      </tr>


      <tr><td style="width:150px;"></td><td><?php echo form_submit(array('name'=>'submit', 'value'=>lang('create_user_submit_btn'), 'class'=>'input-submit'));?></td></tr>

	 </table>
</fieldset>
<?php echo form_close();?>
