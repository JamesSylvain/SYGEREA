	<div class="content">
		<h1><?php echo $title; ?></h1>
		<div class="data">
		<table>
			<tr>
				<td width="30%">ID</td>
				<td><?php echo $person->id; ?></td>
			</tr>
			<tr>
				<td valign="top">Name</td>
				<td><?php echo $person->name; ?></td>
			</tr>
			<tr>
				<td valign="top">Gender</td>
				<td><?php echo strtoupper($person->gender)=='M'? 'Male':'Female' ; ?></td>
			</tr>
			<tr>
				<td valign="top">Date of birth (dd-mm-yyyy)</td>
				<td><?php echo date('d-m-Y',strtotime($person->dob)); ?></td>
			</tr>
		</table>
		</div>
		<br />
		<?php echo $link_back; ?>
	</div>