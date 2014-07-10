<h3 class="tit"><?php echo lang('create_group_heading');?></h3>
<fieldset>
<legend><?php echo lang('create_group_subheading');?></legend>

<div id="infoMessage"><?php echo $message;?></div>

<?php echo form_open("auth/create_group");?>
	<table class="nostyle">
      <tr>
            <td><?php echo lang('create_group_name_label', 'group_name');?></td>
            <td><?php echo form_input($group_name);?></td>
      </tr>

      <tr>
            <td><?php echo lang('create_group_desc_label', 'description');?></td>
            <td><?php echo form_input($description);?><td>
      </tr>

      <p></p>
	  <tr><td style="width:150px;"></td><td><?php echo form_submit(array('name'=>'submit', 'value'=>lang('create_group_submit_btn'), 'class'=>'input-submit'));?></td></tr>

	 </table>
</fieldset>
<?php echo form_close();?>