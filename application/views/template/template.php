<?xml version="1.0"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta http-equiv="content-language" content="en" />
	<meta name="robots" content="noindex,nofollow" />
	<link rel="stylesheet" media="screen,projection" type="text/css" href="<?php echo base_url() . 'assets/css/reset.css'; ?>" /> <!-- RESET -->
	<link rel="stylesheet" media="screen,projection" type="text/css" href="<?php echo base_url() . 'assets/css/main.css'; ?>" /> <!-- MAIN STYLE SHEET -->
	<link rel="stylesheet" media="screen,projection" type="text/css" href="<?php echo base_url() . 'assets/css/2col.css'; ?>" title="2col" /> <!-- DEFAULT: 2 COLUMNS -->
	<link rel="alternate stylesheet" media="screen,projection" type="text/css" href="<?php echo base_url() . 'assets/css/1col.css'; ?>" title="1col" /> <!-- ALTERNATE: 1 COLUMN -->
	<!--[if lte IE 6]><link rel="stylesheet" media="screen,projection" type="text/css" href="css/main-ie6.css" /><![endif]--> <!-- MSIE6 -->
	<link rel="stylesheet" media="screen,projection" type="text/css" href="<?php echo base_url() . 'assets/css/style.css'; ?>" /> <!-- GRAPHIC THEME -->
	<link rel="stylesheet" media="screen,projection" type="text/css" href="<?php echo base_url() . 'assets/css/mystyle.css'; ?>" /> <!-- WRITE YOUR CSS CODE HERE -->
	
	<!--**************************js fro date picker***********************************-->
	
		<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url() . 'assets/css/jsDatePick_ltr.min.css'; ?>" />
		<script type="text/javascript" src="<?php echo base_url() . 'assets/js/jsDatePick.min.1.3.js'; ?>"></script>	
		<script type="text/javascript" src="<?php echo base_url() . 'assets/js/date_heure.js'; ?>"></script>	

	<script type="text/javascript" src="<?php echo base_url() . 'assets/js/jquery.js'; ?>"></script>
	<script type="text/javascript" src="<?php echo base_url() . 'assets/js/switcher.js'; ?>"></script>
	<script type="text/javascript" src="<?php echo base_url() . 'assets/js/toggle.js'; ?>"></script>
	<script type="text/javascript" src="<?php echo base_url() . 'assets/js/ui.core.js'; ?>"></script>
	<script type="text/javascript" src="<?php echo base_url() . 'assets/js/ui.tabs.js'; ?>"></script>
	<script type="text/javascript">
	$(document).ready(function(){
		$(".tabs > ul").tabs();
	});
	</script>
<script type='text/javascript'>
 
		function getXhr(){
                                var xhr = null; 
				if(window.XMLHttpRequest) // Firefox et autres
				   xhr = new XMLHttpRequest(); 
				else if(window.ActiveXObject){ // Internet Explorer 
				   try {
			                xhr = new ActiveXObject("Msxml2.XMLHTTP");
			            } catch (e) {
			                xhr = new ActiveXObject("Microsoft.XMLHTTP");
			            }
				}
				else { // XMLHttpRequest non supporté par le navigateur 
				   alert("Votre navigateur ne supporte pas les objets XMLHTTPRequest..."); 
				   xhr = false; 
				} 
                                return xhr;
		}
		
		function go(){
				var site = "<?php echo site_url();?>";
				var xhr = getXhr();
			
				// On défini ce qu'on va faire quand on aura la réponse
				xhr.onreadystatechange = function(){
					// On ne fait quelque chose que si on a tout reçu et que le serveur est ok
					if(xhr.readyState == 4 && xhr.status == 200){
						leselect = xhr.responseText;
						
					//	alert(xhr.responseText);
						
						// On se sert de innerHTML pour rajouter les options a la liste
						document.getElementById('departement').innerHTML = leselect;
					}
				}
 
				// Ici on va voir comment faire du post
				xhr.open("POST",site+"panne/selectdept",true);
				// ne pas oublier ça pour le post
				xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
				// ne pas oublier de poster les arguments
				// ici, l'id de la categorie
				sel = document.getElementById('region');
				code_region = sel.options[sel.selectedIndex].value;
				xhr.send("code_region="+code_region);
		}		
		
		function go1(){
				var site = "<?php echo site_url();?>";
				var xhr = getXhr();
			
				// On défini ce qu'on va faire quand on aura la réponse
				xhr.onreadystatechange = function(){
					// On ne fait quelque chose que si on a tout reçu et que le serveur est ok
					if(xhr.readyState == 4 && xhr.status == 200){
						leselect = xhr.responseText;
						
					//	alert(xhr.responseText);
						
						// On se sert de innerHTML pour rajouter les options a la liste
						document.getElementById('arrondissement').innerHTML = leselect;
					}
				}
 
				// Ici on va voir comment faire du post
				xhr.open("POST",site+"panne/selectarrondiss",true);
				// ne pas oublier ça pour le post
				xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
				// ne pas oublier de poster les arguments
				// ici, l'id de la categorie
				sel = document.getElementById('departement');
				code_departement = sel.options[sel.selectedIndex].value;
				xhr.send("code_departement="+code_departement);
		}		
	</script>
	<script type="text/javascript">
	window.onload = function(){
		new JsDatePick({
			useMode:2,
			target:"inputField",
			dateFormat:"%d-%M-%Y"
		});
		new JsDatePick({
			useMode:2,
			target:"inputField2",
			dateFormat:"%d-%M-%Y"
		});		
		new JsDatePick({
			useMode:2,
			target:"inputField3",
			dateFormat:"%d-%M-%Y"
		});
	};
</script>
	<title>SYGEREA</title>
</head>

<body>

<div id="main">

	<!-- Tray -->
	<div id="tray" class="box">

		<p class="f-left box">
			 <strong style="font-size:13px;">Système de Gestion des Ressources en Eau et Assainissement</strong>

		</p>

		<p class="f-right">User: <strong><a href="#">	<?php $user = $this->ion_auth->user()->row(); echo $user->username;?></a></strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <strong><a href="<?php echo base_url().'auth/logout'?>" id="logout">deconnexion</a></strong></p>

	</div> <!--  /tray -->

	<hr class="noscreen" />

	<!-- Menu -->
	<div id="menu" class="box">

		<ul class="box">
			<li id="menu-active"><a href="#"><span>Accueil</span></a></li> <!-- Active -->
			<li><a href="#"><span>Projets</span></a></li>
			<li><a href="#"><span>Ouvrages</span></a></li>
			<li><a href="<?php echo base_url() . 'search/'; ?>"><span>Recherche</span></a></li>
			<li><a href="#"><span>Imprimer</span></a></li>
			<?php if($this->ion_auth->is_admin()){?>
				<li><a href="<?php echo base_url().'auth/'?>"><span>Utilisateurs</span></a></li>
			<?php } ?>
			<li><a href="#"><span>Parametrages</span></a></li>
			<span style="float:right; font-weight:bold" id="date_heure"></span>
			<script type="text/javascript">window.onload = date_heure('date_heure');</script>
		</ul>

	</div> <!-- /header -->

	<hr class="noscreen" />

	<!-- Columns -->
	<div id="cols" class="box">

		<!-- Aside (Left Column) -->
		<div id="aside" class="box">

			<div class="padding box">

				<!-- Logo (Max. width = 200px) -->
				<p id="logo"><a href="#"><img src="<?php echo base_url() . 'assets/tmp/logo.png'; ?>" alt="yuc logo" title="yuc tennis" /></a></p>

				<!-- Search -->
				<form action="#" method="get" id="search">
					<fieldset>
						<legend>Rechercher ouvrage</legend>

						<p><input type="text" size="17" name="" class="input-text" />&nbsp;<input type="submit" value="OK" class="input-submit-02" /><br />
						<a href="javascript:toggle('search-options');" class="ico-drop">Recherche avance</a></p>

						<!-- Advanced search -->
						<div id="search-options" style="display:none;">

							<p>
								<label><input type="checkbox" name="" checked="checked" /> xxxxxx.</label><br />
								<label><input type="checkbox" name="" /> xxxxxx.</label><br />
								<label><input type="checkbox" name="" /> xxxxxx.</label>
							</p>

						</div> <!-- /search-options -->

					</fieldset>
				</form>

				<!-- Create a new project -->
				<p id="btn-create" class="box"><a href="#"><span>Nouvel Ouvrage</span></a></p>
			</div> <!-- /padding -->
		<?php echo $sidebar; ?>


		</div> <!-- /aside -->

		<hr class="noscreen" />

		<!-- Content (Right Column) -->
		<div id="content" class="box" style="min-height: 455px;">
			<?php echo $content; ?>
			<!-- System Messages -->

		</div> <!-- /content -->

	</div> <!-- /cols -->

	<hr class="noscreen" />

	<!-- Footer -->
	<div id="footer" class="box">

		<p class="f-left">&copy; 2014 <a href="#">james</a>, All Rights Reserved &reg;</p>

		<p class="f-right">Templates by <a href="http://www.adminizio.com/">Adminizio</a></p>

	</div> <!-- /footer -->

</div> <!-- /main -->

</body>
</html>