
<!DOCTYPE html>
<html lang="fr">
	<head>
		
		<title>recherche</title>
<style type="text/css"src=""></style>
		<link rel="stylesheet" type="text/css" href="bootstrap.min.css">
		 <link rel="stylesheet" type="text/css" href="bootstrap.min.css">
    </head>
	<body class="navbar navbar-inverse">
		
						<!-- article -->
				<div class="col-md-4  col-md-offset-4 panel panel-danger"style="margin-top:60px;">
							<!-- article img -->
								<center><h1 class="widget-title">Recherche Etudiant</h1></center></br>
		<form action="recherche.php" method="POST" enctype="multipart/form-data"autocomplete="off">
		
									<div class="form-group">
										<input type="text" class="form-control"name="code_etudiant" placeholder="Veuillez bien saisir  le code d'Etudiant"class="input"required="required">
									</div>
									
									<div class="form-group">
										<center><input type="submit" value="Connexion" name="rechercher" class="btn btn-success causes-donate">
											<a href="eleve.php"class="btn btn-danger">Annuler</a>
										</center>
									</div>
					<div class="">
						<?php 
		if(isset($_POST['rechercher'])){
					$q=$_POST['code_etudiant'];
					$con=new PDO("mysql:host=localhost;dbname=gestion_etudiant","root","");
					$re=$con->prepare("select * from etudiant  where code_etudiant=? ");
					$re->execute([$q]);
		if($membre=$re->fetch())
			{
				echo "<table>";
				echo "<tr><td><img src='photo/".$membre['photo']."'style='width:130px;height:100px;/'class='img-thumb'></td></tr>";
				echo "<tr><td><h4>PréNom:".$membre['prenom']."</td>";
				echo "<tr><td><h4>Nom:".$membre['nom']."</td>";
				echo "<tr><td><h4>PostNom:".$membre['postnom']."</td>";
				echo "<tr><td><h4>Sexe:".$membre['sexe'].",</td><tr><td><h4>Fonction:".$membre['promotion']."</td>";
				echo "</h3></span></table>";
				

			}
		else
			{
			# code...
			echo "<h2><span class='text-danger'>Aucun etudiant repond à ce Nom</span></h2>";
			}
		}
	?>



					</div>
								</form>
						</div>
				
	</body>
</html>
