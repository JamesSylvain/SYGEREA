<h3 class="tit">Groupes</h3>
<p><?php //echo lang('index_subheading');?></p>

<div id="infoMessage"><?php echo $message;?></div>

<table cellpadding=0 cellspacing=10>
	<tr>
		<th>Nom groupe</th>
		<th>Description</th>
		<th>Action</th>

	</tr>
	<?php foreach ($groups as $group):?>
		<tr>
			<td><?php echo $group->name;?></td>
			<td><?php echo $group->description;?></td>
			<td><?php echo anchor('auth/edit_group/'.$group->id,' ',array('class'=>'update', 'title'=>'modifier ce groupe')).' '.
								anchor('auth/delete_group/'.$group->id,' ',array('class'=>'delete','onclick'=>"return confirm('voulez vous supprimer ce groupe?')", 'title'=>'supprimer ce groupe'));
					?>
			</td>
		</tr>
	<?php endforeach;?>
</table>

<p><?php echo anchor('auth/create_user', lang('index_create_user_link'))?> | <?php echo anchor('auth/create_group', lang('index_create_group_link'))?></p>