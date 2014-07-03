<?php  $message = $this->session->flashdata('succes'); if(isset($message)&&$message!=''){?>
<h4><p class="msg done"> <?php echo $message; ?></p></h4>
<?php  } ?>
<div id="page-heading">
		<h3 class="tit">Liste des regions</h3>
</div>
	<div class="data"><?php echo $table; ?></div>
	<div class="paging"><?php echo $pagination; ?></div>
	<br />
	<?php echo anchor('param/addregion/','Ajouter une region',array('class'=>'add')); ?>