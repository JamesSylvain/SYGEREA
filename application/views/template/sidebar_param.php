<?php 
	$menuactive = $this->uri->segment(2);
?>
<ul class="box">
<?php if($menuactive=='region'){$current = 'submenu-active';}else{ $current ='';}?>
	<li class="biggest" id="<?php echo $current; ?>"><a href="<?php echo base_url() . 'param/region'; ?>">Regions</a></li>
<?php if($menuactive=='departements'){$current = 'submenu-active';}else{ $current ='';}?>
	<li id="<?php echo $current; ?>"><a href="<?php echo base_url() . 'param/departements'; ?>">Departements</a></li>
<?php if($menuactive=='arrondissements'){$current = 'submenu-active';}else{ $current ='';}?>
	<li class="biggest" id="<?php echo $current; ?>"><a href="<?php echo base_url() . 'param/arrondissements'; ?>">Arrondissements</a></li>
<?php if($menuactive=='localites'){$current = 'submenu-active';}else{ $current ='';}?>
	<li class="biggest" id="<?php echo $current; ?>"><a href="<?php echo base_url() . 'param/localites'; ?>">Localites</a></li>
<?php if($menuactive=='entreprise'){$current = 'submenu-active';}else{ $current ='';}?>
	<li class="biggest" id="<?php echo $current; ?>"><a href="<?php echo base_url() . 'param/entreprise'; ?>">Entreprises</a></li>
<?php if($menuactive=='caract_eaux'){$current = 'submenu-active';}else{ $current ='';}?>
	<li class="biggest" id="<?php echo $current; ?>"><a href="<?php echo base_url() . 'param/caract_eaux'; ?>">Caracteristiques Eaux</a></li>
</ul>