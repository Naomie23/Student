


		<html>
<head>
	<title>liste eleve</title>
	<style type="text/css"src=""></style>
	<link rel="stylesheet" type="text/css" href="bootstrap.min.css">
	<script src="jquery.js" type="text/javascript"></script>
</head>
	<body class="navbar-inverse ">												
		<form action="list_eleve.php" method="POST"enctype="multipart/form-data"autocomplete="off">
					<div class="col-md-10 col-md-offset-1 panel panel-info well"style="margin-top:2%;">
			     			<div class="col-md-12 panel panel-danger"> 
											<ul class="list-group-item">
												<li class="list-group-item active"><h2><center>La Liste de tous les ETUDIANTS</center></h2></li>
											</ul>
						<table class="table">
							<th>Id</th><th>Prénom</th><th>Nom</th><th>PostNom</th><th>Sexe</th><th>Promotion</th><th>Photo</th>
							<?php
								$con = new PDO("mysql:host=localhost;dbname=gestion_etudiant", "root", "");
								$re=$con->prepare("select * from etudiant");
								$re->execute([]);
								while ($membre=$re->fetch()):?>
										<tr>
											<td><?php echo $membre['id'];?></td>
											<td><?php echo $membre['prenom'];?></td>
											<td><?php echo $membre['nom'];?></td>
											<td><?php echo $membre['postnom'];?></td>
											<td><?php echo $membre['sexe'];?></td>
											<td><?php echo $membre['promotion'];?></td>
											<td><?php echo "<img src='photo/".$membre['photo']."'style='width:130px;height:100px;/'class='img-thumb'></td>;"?></td>
											<td><a class="btn btn-success" href="modifier.php?idInvite=<?php echo $membre['id'];?>">Modifier</label></td>							 
											<td><a class="btn btn-danger" href="supprimer.php?idInvite=<?php echo $membre['id'];?>">Supprimer</a></td></tr>
								<?php endwhile; ?>
						</table>
					</div>
							<div class="col-md-12">
									<a class="btn btn-danger  pull-right"href="index.php"style="margin-right:10px;">Retour</a>
							</div>
				</div>

		</form>
	</body>
</html>