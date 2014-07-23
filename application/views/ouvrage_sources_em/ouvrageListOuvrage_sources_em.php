<?php  $message = $this->session->flashdata('succes'); if(isset($message)&&$message!=''){?>
<h4><p class="msg done"> <?php echo $message; ?></p></h4>
<?php  } ?>

<div id="page-heading">
		<h1>List ouvrages : Sources Amenagées</h1>
</div>
	<div class="data"><?php echo $table; ?></div>
	<div class="paging"><?php echo $pagination; ?></div>
	<br />
	<?php echo anchor('ouvrage_sources_em/add/','Nouvelle Source Amenagee',array('class'=>'add')); ?>

