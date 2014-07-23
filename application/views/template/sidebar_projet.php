<ul class="box">
	<li id="<?php if(isset($id_bailleur))echo $id_bailleur; ?>"><a href="<?php echo base_url() . 'bailleur/'; ?>">Bailleur de fonds</a></li>
	<li id="<?php if(isset($id_fin_projet))echo $id_fin_projet; ?>"><a href="<?php echo base_url() . 'bailleur/financement'; ?>">Financement Projet</a></li>
	<li id="<?php if(isset($id_fin_ouv))echo $id_fin_ouv; ?>"><a href="<?php echo base_url() . 'bailleur/financementO'; ?>">Financement Ouvrage</a></li>
	<li id="<?php if(isset($id_projet))echo $id_projet; ?>"><a href="<?php echo base_url() . 'projet/'; ?>">Projets</a></li>
</ul>