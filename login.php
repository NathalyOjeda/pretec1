<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>INICIO DE SESION</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="vendors/base/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="css/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="images/favicon.png" />
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-stretch auth auth-img-bg">
        <div class="row flex-grow">
          <div class="col-lg-6 d-flex align-items-center justify-content-center">
            <div class="auth-form-transparent text-left p-3">
                <div class="brand-logo" style="background: #0056b3; padding: 10px;">
                  <img src="images/logo.png" alt="logo">
              </div>
              <h4>Bienvenido</h4>
              <h6 class="font-weight-light">Estamos feliz de tenerte devuelta</h6>
              <h6 class="font-weight-light text-danger"><?php echo $error_sesion; ?></h6>
              <form class="pt-3" method="POST">
                <div class="form-group">
                  <label for="exampleInputEmail">Usuario</label>
                  <div class="input-group">
                    <div class="input-group-prepend bg-transparent">
                      <span class="input-group-text bg-transparent border-right-0">
                        <i class="ti-user text-primary"></i>
                      </span>
                    </div>
                      <input type="text" class="form-control form-control-lg border-left-0" 
                             id="usuario" placeholder="usuario" name="usuario" 
                             onblur="dameSucursalPorNombreUsuario(); return false;">
                  </div>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword">Contraseña</label>
                  <div class="input-group">
                    <div class="input-group-prepend bg-transparent">
                      <span class="input-group-text bg-transparent border-right-0">
                        <i class="ti-lock text-primary"></i>
                      </span>
                    </div>
                      <input type="password" class="form-control form-control-lg border-left-0" id="exampleInputPassword" placeholder="Contraseña" name="pass">                        
                  </div>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword">Sucursal</label>
                  <div class="input-group">
                    <div class="input-group-prepend bg-transparent">
                      <span class="input-group-text bg-transparent border-right-0">
                        <i class="ti-home text-primary"></i>
                      </span>
                    </div>
                      <input type="text" class="form-control form-control-lg border-left-0" 
                             id="sucursal" placeholder="Ingresa el usuario" readonly name="sucursal">                        
                  </div>
                </div>
                
                <div class="my-3">
                    <input type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" value="LOGIN" >
                  <!--<a class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" href="../../index.html">LOGIN</a>-->
                </div>
                
                <div class="text-center mt-4 font-weight-light">
                  No recuerdas tu contraseña? <a href="#" class="text-primary">Administrador</a>
                </div>
              </form>
            </div>
          </div>
          <div class="col-lg-6 login-half-bg d-flex flex-row">
            <p class="text-white font-weight-medium text-center flex-grow align-self-end">Copyright &copy; 2020  All rights reserved.</p>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="vendors/base/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- inject:js -->
  <script src="js/off-canvas.js"></script>
  <script src="js/hoverable-collapse.js"></script>
  <script src="js/template.js"></script>
  <script src="js/todolist.js"></script>
  <!-- endinject -->
  <script src="vistas/util.js"></script>
  <script src="vistas/usuario.js"></script>
  
</body>

</html>
