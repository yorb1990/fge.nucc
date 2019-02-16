<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<script src="https://cdn.jsdelivr.net/jquery.validation/1.15.1/jquery.validate.min.js"></script>
<link href="https://fonts.googleapis.com/css?family=Kaushan+Script" rel="stylesheet">
<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

<body>
  <div class="container">
    <div class="row">
		    <div class="col-md-5 mx-auto">
			       <div id="first">
      				<div class="myform form ">
      					<div class="logo mb-3">
                           <div class="col-md-12 text-center">
                              <h1>Acceso</h1>
                           </div>
      					</div>
                <form action="{{env('APP_URL')}}fge-tok/acceso_nuc" method="post">
                 <div class="form-group">
                    <label for="emai">Email:</label>
                    <input type="text" id="email" name="email" class="form-control" placeholder="Ingrese correo institucional">
                 </div>
                 <div class="form-group">
                    <label for="password">Contraseña:</label>
                    <input type="password" name="password" id="password"  class="form-control" placeholder="Ingrese contraseña">
                 </div>
                 <div class="col-md-12 text-center ">
                    <button type="submit" class=" btn btn-block mybtn btn-primary tx-tfm">Ingresar</button>
                 </div>
               </form>
				    </div>
			     </div>
			  </div>
		</div>
  </div>
</body>
