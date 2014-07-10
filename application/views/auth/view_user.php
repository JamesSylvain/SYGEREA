	<div class="content">
		<h1><?php echo $titre; ?></h1>
		<div class="data">
		<fieldset>
		<legend> Details</legend>
		<table>
			<tr>
				<td width="30%">Nom utilisateur</td>
				<td><?php echo $user->username; ?></td>
			</tr>								
			<tr>
				<td width="30%">Nom</td>
				<td><?php echo $user->first_name; ?></td>
			</tr>					
			<tr>
				<td width="30%">Prenom</td>
				<td><?php echo $user->last_name; ?></td>
			</tr>	
			<tr>
				<td width="30%">E-mail</td>
				<td><?php echo $user->email; ?></td>
			</tr>					
			<tr>
				<td width="30%">Societe</td>
				<td><?php echo $user->company; ?></td>
			</tr>					
			<tr>
				<td width="30%">Telephone</td>
				<td><?php echo $user->phone; ?></td>
			</tr>					
			<tr>
				<td width="30%">Statut</td>
				<td><?php echo ($user->active=1)?'Utilisateur Actif':'Suspendu'; ?></td>
			</tr>					
			<tr>
				<td width="30%">Date de creation</td>
				<td><?php echo date("Y-m-d H:i:s", $user->created_on); ?></td>
			</tr>			
			<tr>
				<td width="30%">Derniere connexion</td>
				<td><?php echo date("Y-m-d H:i:s", $user->last_login); ?></td>
			</tr>		
		</table>
		</fieldset>
		</div>
		<br />
	</div>