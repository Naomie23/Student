<?php include_once "traiterEnreg.php" ;?>
	<!DOCTYPE html> 
 <html lang="fr">
  <head>
   <title>enregistrement</title> 
   <meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="bootstrap.min.css">
  <script type="text/javascript"src="photo.js"></script>
  	<script src="jquery.min(1).js" type="text/javascript"></script>
			<script type='text/javascript'>
			$('document').ready(function(){
				$(dd).keypress(function(){
				//$(n1).html($(n1).val("gggg"));
				});
				var mot='KOLWEZI';
							var b ="COM",c,d,g;
								c=mot.substr(0,mot.length-4);
								d=c+b;
								g=Math.floor(Math.random()*1000);
								$(num).val(d+g);

				});

						</script>
 <script>

    function ouvrir_camera() {

     navigator.mediaDevices.getUserMedia({ audio: false, video: { width: 400 } }).then(function(mediaStream) {

      var video = document.getElementById('sourcevid');
      video.srcObject = mediaStream;

      var tracks = mediaStream.getTracks();

      document.getElementById("message").innerHTML="message: "+tracks[0].label+" connecté"

      console.log(tracks[0].label)
      console.log(mediaStream)

      video.onloadedmetadata = function(e) {
       video.play();
      };
       
     }).catch(function(err) { console.log(err.name + ": " + err.message);

     document.getElementById("message").innerHTML="message: connection refusé"});
    }

    function photo(){

     var vivi = document.getElementById('sourcevid');
     //var canvas1 = document.createElement('canvas');
     var canvas1 = document.getElementById('cvs')
     var ctx =canvas1.getContext('2d');
     canvas1.height=vivi.videoHeight
     canvas1.width=vivi.videoWidth
     console.log(vivi.videoWidth)
     ctx.drawImage(vivi, 0,0, vivi.videoWidth, vivi.videoHeight);

     //var base64=canvas1.toDataURL("image/png"); //l'image au format base 64
     //document.getElementById('tar').value='';
     //document.getElementById('tar').value=base64;
    }

    function sauver(){

     if(navigator.msSaveOrOpenBlob){

      var blobObject=document.getElementById("cvs").msToBlob()

      window.navigator.msSaveOrOpenBlob(blobObject, "image.png");
     }

     else{

      var canvas = document.getElementById("cvs");
      var elem = document.createElement('a');
      elem.href = canvas.toDataURL("image/png");
      elem.download = "nom.png";
      var evt = new MouseEvent("click", { bubbles: true,cancelable: true,view: window,});
      elem.dispatchEvent(evt);
     }
    }

    function prepare_envoi(){

     var canvas = document.getElementById('cvs');
     canvas.toBlob(function(blob){envoi(blob)}, 'image/jpeg');
    }
    
    
    function envoi(blob){

     console.log(blob.type)

     var formImage = new FormData();
     formImage.append('image_a', blob, 'image_a.jpg');

     var ajax = new XMLHttpRequest();

     ajax.open("POST","http://scriptevol.free.fr/contenu/reception/upload_camera.php",true);

     ajax.onreadystatechange=function(){

      if (ajax.readyState == 4 && ajax.status==200){

       document.getElementById("jaxa").innerHTML+=(ajax.responseText);
      }
     }

     ajax.onerror=function(){

      alert("la requette a échoué")
     }

     ajax.send(formImage);
     console.log("ok")
    }

    
    function fermer(){

     var video = document.getElementById('sourcevid');
     var mediaStream=video.srcObject;
     console.log(mediaStream)
     var tracks = mediaStream.getTracks();
     console.log(tracks[0])
     tracks.forEach(function(track) {
      track.stop();
      document.getElementById("message").innerHTML="message: "+tracks[0].label+" déconnecté"
     });

     video.srcObject = null;
    }


   </script>
</head>
<body onload="">
	<form action="enregistrer.php" method="POST"enctype="multipart/form-data"autocomplete="off">
	<div class="col-md-12 col-xm-12">
		<img class="img"src="entete.png"style="width:100%;"></div>
			<div class="col-md-12 col-xm-12 btn btn-info">
				<button class="btn btn-success"name="acceuil">Acceuil</button>
				<marquee><span style="color:red;font-style:bold;">Vous pouvez faire l'enregistrement de tous les motards</span></marquee>
			</div>
		</form>
<div class="col-md-6 col-xm-12 right panel panel-info"style=" height:60%;">
		<div class="col-md-6 right">
			<video id="sourcevid" width='300px' autoplay="true"></video>
			<label id="message"class="label">message:</label>
		</div>
		<div class="col-md-6 col-xm-6 left">
			<canvas id="cvs"style="width:300px;"></canvas>
		</div>
		<div class="col-md-12 col-xm-12 left">
	   		<button class="btn btn-success"onclick='ouvrir_camera()' >ouvrir camera</button>
		     <button class="btn btn-danger"onclick='photo()' >prise de photo</button>
		     <button class="btn btn-info"onclick='sauver()' >sauvegarder</button>
			 <button class="btn btn-primary"onclick='fermer()' >fermer camera</button>
    	</div>    
  <img class="img"src="moto.png"style="width:35%;height:180px;">
   <img class="img"src="moto.png"style="width:30%;height:180px;">
    <img class="img"src="moto.png"style="width:30%;height:180px;">
</div> 

		<div class="col-md-6 col-xm-12 left panel panel-info"style="height:380px;overflow:auto;">
				<form action="enregistrer.php" method="POST"enctype="multipart/form-data"autocomplete="off">
					<fieldset>
						<legend><h1><center><span class="text-warning glyphicon glyphicon-glass"> Enregistrement</span></center></h1></legend>
							<div class="form-group">
							<label class="control-label">Nom</label>
							<input type="text"class="form-control"name="nom"placeHolder="saisir nom"id="dd"required="required">
							</div>
									<div class="form-group">
									<label class="control-label">PostNom:</label>
									<input type="text"class="form-control"name="postnom"placeHolder="saisir postnom"id="n1"required="required">
									</div>
										<div class="form-group">
										<label class="control-label">PreNom:</label>
										<input type="text"class="form-control"name="prenom"placeHolder="saisir Prenom"required="required">
										</div>
											<div class="group-form">
												<div><label class="control-label">Adresse:</label></div>
												<div class=" col-md-4"><input type="text"class=" form-control"name="commune"placeHolder="saisir Commune"required="required"></div>
												<div class=" col-md-4"><input type="text"class=" form-control"name="avenue"placeHolder="saisir Avenue"required="required"></div>
												<div class=" col-md-4"><input type="text"class=" form-control"name="numero"placeHolder="saisir Numero"required="required"></div>
											</div>
											<div class="group-form">
												<div><label class="control-label">Age:</label></div>
												<div class=" col-md-4">
														<select name="jour"class="form-control">
															<option>01</option>
																<option>02</option>
																	<option>03</option>
																		<option>04</option>
																			<option>05</option>
																				<option>06</option>
																				<option>07</option>
																				<option>08</option>
																				<option>09</option>
																				<option>10</option>
																				<option>11</option>
																				<option>12</option>
																				<option>13</option>
																				<option>14</option>
																				<option>15</option>
																				<option>16</option>
																				<option>17</option>
																				<option>18</option>
																				<option>19</option>
																				<option>20</option>
																				<option>21</option>
																				<option>22</option>
																				<option>23</option>
																				<option>24</option>
																				<option>25</option>
																				<option>26</option>
																				<option>27</option>
																				<option>28</option>
																				<option>29</option>
																				<option>30</option>
																				<option>31</option>

												</select>
												</div>
												<div class=" col-md-4">
												<select name="mois"class="form-control">
																			<option>janvier</option>
																			<option>Fevrier</option>
																			<option>Mars</option>
																			<option>Avril</option>
																			<option>Mai</option>
																			<option>Juin</option>
																			<option>Juillet</option>
																			<option>Aout</option>
																			<option>Septembre</option>
																			<option>Octobre</option>
																			<option>Novembre</option>
																			<option>Decembre</option>
																		</select>
												</div>
												<div class=" col-md-4">
												<select name="annee"class="form-control col-md-4">
													<option>1980</option>
													<option>1981</option>
													<option>1982</option>
													<option>1983</option>
													<option>1984</option>
													<option>1985</option>
													<option>1986</option>
													<option>1987</option>
													<option>1988</option>
													<option>1989</option>
													<option>1990</option>
													<option>1991</option>
													<option>1992</option>
													<option>1993</option>
													<option>1994</option>
													<option>1995</option>
												</select>
												</div>
											</div>
												
													<div class="form-group">
													<label class="control-label">Télephone:</label>
													<input type="text"class="form-control"name="telephone"placeHolder="saisir nom"required="required">
													</div>
													<div class="form-group">
													<label class="control-label">Etat Civil:</label>
													<select name="etatcivil"class="form-control col-md-4">
													<option>Célibataire</option>
													<option>Marié</option>
													<option>Divorsé</option>
													<option>Veuve</option>
												</select>
													</div>
														<div class="form-group">
														<label class="control-label">Photo:</label>
														<input type="file"class="form-control"name="photo"placeHolder="saisir Photo"required="required">
														</div>
																<div class="form-group">
																	<label class="control-label">Numero Plaque:</label>
																	<input type="text"class="form-control"name="numplaque">
																</div>
																<div class="form-group">
																	<label class="control-label">Titeur:</label>
																	<input type="text"class="form-control"name="titeur"placeHolder="saisir Numero Titeur"required="required">
																</div>
																<div class="form-group">
																	<label class="control-label">Numero Titeur:</label>
																	<input type="text"class="form-control"name="numtit"placeHolder="saisir Numero Titeur"required="required">
																</div>
																<div class="form-group">
																	<label class="control-label">Numero Moto:</label>
																	<input type="text"class="form-control"name="numordre"id="num"readonly="readonly">
																</div>
																<div class="form-group">
																	<label class="control-label">Adresse:</label>
																	<input type="text"class="form-control"name="adresset"placeHolder="saisir Adresse Titeur"required="required">
																</div>
																<div class="control-group">
																	<center><button type="submit" class="btn btn-success btn-lg"name="enregistrer">
																	<span class="glyphicon glyphicon-user">Enregistrer</span>
										
																</button></center>
								</div>
																
					</fieldset>
				</form>
		</div>


</body>
</html>