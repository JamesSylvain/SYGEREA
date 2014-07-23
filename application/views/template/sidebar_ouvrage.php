

<ul class="box">
    <li id="<?php if(isset($id_forage))echo $id_forage; ?>"><a href="<?php echo base_url() . 'forages_ou_puits'; ?>">Forages & Puits</a></li>
	<li id="<?php if(isset($id_aep))echo $id_aep; ?>"><a href="<?php echo base_url() . 'aep'; ?>">AEP</a></li>
	<li id="<?php if(isset($id_sourem))echo $id_sourem; ?>"><a href="<?php echo base_url() . 'ouvrage_sources_em'; ?>">Sources Amenagées</a></li>
	<li id="<?php if(isset($id_station))echo $id_station; ?>"><a href="<?php echo base_url() . 'station_d_epuration'; ?>">Stations d'epurations</a></li>
	<li id="<?php if(isset($id_latrine))echo $id_latrine; ?>"><a href="<?php echo base_url() . 'latrine'; ?>">Latrines</a></li>
	<li id="<?php if(isset($id_puisard))echo $id_puisard; ?>"><a href="<?php echo base_url() . 'puisard'; ?>">Puisards</a></li>
</ul>