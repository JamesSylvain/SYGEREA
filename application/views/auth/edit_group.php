<h3 class="tit"><?php echo lang('edit_group_heading');?></h3>
<fieldset>
<legend><?php echo lang('edit_group_subheading');?></legend>

<div id="infoMessage"><?php echo $message;?></div>

<?php echo form_open(current_url());?>
	<table class="nostyle">
      <tr>
            <td><?php echo lang('edit_group_name_label', 'group_name');?></td>
            <td><?php echo form_input($group_name);?></td>
      </tr>
      <tr>
           <td> <?php echo lang('edit_group_desc_label', 'description');?></td>
           <td> <?php echo form_input($group_description);?></td>
      </tr>
	  <tr><td style="width:150px;"></td><td><?php echo form_submit(array('name'=>'submit', 'value'=>lang('edit_group_submit_btn')));?></td></tr>
	</table>
</fieldset>
<?php echo form_close();?>