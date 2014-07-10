<h3 class="tit"><?php echo lang('edit_user_heading');?></h3>
<fieldset>
<legend><?php echo lang('edit_user_subheading');?></legend>

<div id="infoMessage"><?php echo $message;?></div>

<?php echo form_open(uri_string());?>
	<table class="nostyle">
      <tr>
            <td><?php echo lang('edit_user_fname_label', 'first_name');?></td>
            <td><?php echo form_input($first_name);?></td>
      </tr>

     <tr>
            <td><?php echo lang('edit_user_lname_label', 'last_name');?></td>
            <td><?php echo form_input($last_name);?></td>
      </tr>

      <tr>
            <td><?php echo lang('edit_user_company_label', 'company');?></td>
            <td><?php echo form_input($company);?></td>
      </tr>

      <tr>
            <td><?php echo lang('edit_user_phone_label', 'phone');?></td>
            <td><?php echo form_input($phone);?></td>
      </tr>

      <tr>
           <td> <?php echo lang('edit_user_password_label', 'password');?></td>
           <td> <?php echo form_input($password);?></td>
      </tr>

     <tr>
            <td><?php echo lang('edit_user_password_confirm_label', 'password_confirm');?></td>
            <td><?php echo form_input($password_confirm);?></td>
      </tr>
	</table>
      <?php if ($this->ion_auth->is_admin()): ?>
          <h2><?php echo lang('edit_user_groups_heading');?></h2>
          <?php foreach ($groups as $group):?>
              <label class="checkbox">
              <?php
                  $gID=$group['id'];
                  $checked = null;
                  $item = null;
                  foreach($currentGroups as $grp) {
                      if ($gID == $grp->id) {
                          $checked= ' checked="checked"';
                      break;
                      }
                  }
              ?>
              <input type="checkbox" name="groups[]" value="<?php echo $group['id'];?>"<?php echo $checked;?>>
              <?php echo $group['name'];?>
              </label>
          <?php endforeach?>

      <?php endif ?>

      <?php echo form_hidden('id', $user->id);?>
      <?php echo form_hidden($csrf); ?>

      <p><?php echo form_submit('submit', lang('edit_user_submit_btn'));?></p>
</fieldset>
<?php echo form_close();?>
