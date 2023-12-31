 <?php
if (isset($_POST['enregistrer'])) {
 	# code...
 	extract($_POST);
		$photo=$_FILES['photo']['name'];
		$namephoto1=basename($photo);
		$destination="C:/xamppS/htdocs/Gest_Etudiant/photo/".$namephoto1;
		move_uploaded_file($_FILES['photo']['tmp_name'],$destination);
			$con = new PDO("mysql:host=localhost;dbname=gestion_etudiant", "root", "");
		$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$req = $con->prepare("INSERT INTO etudiant(nom,postnom,prenom,sexe,promotion,date_naissance,photo,code_etudiant) VALUES(?,?,?,?,?,?,?,?)");
		$req->execute([$nom, $postnom,$prenom,$sexe,$promotion,$date_naissance,$photo,$code_etudiant]);
	header("location:eleve.php");
	echo "enregistrement effectuer";
 } 

 ?>
<html>
<head>
	<title> etudiant</title>
	<style type="text/css"src=""></style>
		<link rel="stylesheet" type="text/css" href="bootstrap.min.css">
		<script src="jquery.js" type="text/javascript"></script>
		<script src="jquery.min(1).js" type="text/javascript"></script>
	
	</head>
<body style="background-image:url('images/.jpg')">
	<form action="eleve.php"method="POST"enctype="multipart/form-data"autocomplete="off">
			
			<div class="col-md-12">
				<div class="col-md-5 "style="margin-top:10px;background-image:url('images/.jpg');height:80%;">
					
					<img src="K.jpg"style="width:100%;height:100%;">
				</div>
				<div class="col-md-7  panel panel-info"style="margin-top:10px;height:80%;overflow:auto;">
					<div class="col-md-12  list-group-item active panel panel-info"style="margin-top:10px;">
						<center><h1 class"list-group-item active">ENREGISTREMENT DES ETUDIANTS</h1></center>
					</div>
					<div class="form-group">
						<label class="control-label"><span class="fa fa-user"id="dd">Nom:</label>
						<input type="text"class="form-control"name="nom"placeHolder="saisir nom"required="required">
					</div>
					<div class="form-group">
						<label class="control-label"><span class="fa fa-user">Postnom:</label>
						<input type="text"class="form-control"name="postnom"placeHolder="saisir postnom"required="required">
					</div>
					<div class="form-group">
						<label class="control-label"><span class="fa fa-user">Prenom:</label>
						<input type="text"class="form-control"name="prenom"placeHolder="saisir prenom"required="required">
					</div>
			
						<div class="form-group">
								<label>Selectionnez Votre Genre:</label>
										<select name="sexe"class="form-control">
											<option>Masculin</option>
											<option>Féminin</option>
										</select>
						</div>
					<div class="form-group">
						<label class="control-label"><span class="fa fa-user">Promotion:</label>
						<input type="text"class="form-control"name="promotion"placeHolder="saisir promotion"required="required">
					</div>
					
						<div class="form-group">
										<label class="control-label "> Date de Naissance:</label>
										<input class="form-control"type="date" name="date_naissance"placeHolder="saisir matricule"required="required">
						</div>
						<div class="form-group">
										<label class="control-label "> Photo:</label>
										<input class="form-control"type="file" name="photo">
						</div>
						<div class="form-group">
										<label class="control-label "> Code ETUDIANT:</label>
										<input class="form-control"type="text" name="code_etudiant">
						</div>				 
							<div class="form-group ">
									<button class="btn btn-info col-md-4 col-md-offset-4"name="enregistrer">valider</button>
							</div>
							<div class="col-md-12">
									<a class="btn btn-danger  pull-right"href="index.php"style="margin-right:10px;">Retour</a>
							</div>
				</div>
			</div>
		</form>

	</body>
</html>