<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <title>Geografis Sebaran Perumahan</title>
  </head>
  <body>
    <h1 class="text-center">Geografis Sebaran Perumahan</h1>

    <div class="container">
    	<form action="<?= base_url('Welcome/tambah');?>" method="post">
			  <div class="form-group">
			    <label for="exampleInputEmail1">Nama Pemilik</label>
			    <input type="text" class="form-control" name="nama">
			  </div>
			  <div class="form-group">
			    <label for="exampleInputPassword1">Koordinat Latitude</label>
			    <input type="text" class="form-control" name="latitude">
			  </div>
			   <div class="form-group">
			    <label for="exampleInputPassword1">Koordinat Longtitude</label>
			    <input type="text" class="form-control" name="longtitude">
			  </div>

				<div class="form-group">
			    <label for="exampleInputPassword1">Link Google</label>
			    <input type="text" class="form-control" name="link">
			  </div>			  
			  <input type="submit" class="btn btn-primary" value="kirim">
			</form>
    </div>	

     <!-- peta persebaran UKM -->
          <div class="container mt-5">
            <div id="mapid" style="z-index: 2"></div>
          </div>
          <style type="text/css">
    #mapid { height: 480px; }
</style>
 <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
   integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
   crossorigin=""/>
    <!-- Make sure you put this AFTER Leaflet's CSS -->
 <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
   integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
   crossorigin=""></script>

   <script type="text/javascript">
    //setting map koordinat awal
    //level zoom pada map
      <?php $a= 12;?>
      var mymap = L.map('mapid').setView([-3.3848781, 104.8191939], <?= $a;?>);
      
      //setting token
      ACCESS_TOKEN = 'pk.eyJ1IjoiaWtobGFzdWwwNTA3IiwiYSI6ImNrOTY3cDJkNTBoeWYzcGwyeXhzMWR6c2wifQ.c3kroaKoyobXOSngsVKOTw';
      L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token='+ ACCESS_TOKEN, {
      attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
      maxZoom: 20,
      id: 'mapbox/streets-v11',
      tileSize: 512,
      zoomOffset: -1,
      accessToken: 'your.mapbox.access.token'
      }).addTo(mymap);

      //pengulangan marker yang di ambil dari data base
    <?php foreach ($rumah as $rh){?>
        L.marker([<?= $rh['latitude'];?>, <?= $rh['longtitude'];?>])
        .bindPopup("<div><center><h4><?= $rh['nama'];?></h4><br><a href='<?= $rh['link'];?>' class='btn btn-success' style='font-size:20px' target='_blank'><i class='fa fa-mail-forward'> Telusuri...</i></a><a href='<?= base_url('Welcome/QR/'.$rh['id']);?>' class='btn btn-warning ml-4' style='font-size:20px' target='_blank'><i class='fa fa-mail-forward'> Scan</i></a></div>")
        .addTo(mymap);  
    <?php } ?>

    	 //popup ambil koordinat ketika peta diklik
      var popup = L.popup();
      function onMapClick(e) {
          popup
              .setLatLng(e.latlng)
              .setContent("Coordinate This Place is " + e.latlng.toString())
              .openOn(mymap);
      }
      mymap.on('click', onMapClick);
     </script>

     <div class="card text-center">
		  <div class="card-header">
		    Featured
		  </div>
		  <div class="card-body">
		    <h5 class="card-title">Special title treatment</h5>
		    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
		    <a href="#" class="btn btn-primary">Go somewhere</a>
		  </div>
		  <div class="card-footer text-muted">
		    2 days ago
		  </div>
		</div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
  </body>
</html>