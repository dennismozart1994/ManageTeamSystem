<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
    <title>InProject - Novo usuário</title>
    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
        
    <!-- Custom styles for this template -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style-responsive.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

  <section id="container" >
      <!-- **********************************************************************************************************************************************************
      TOP BAR CONTENT & NOTIFICATIONS
      *********************************************************************************************************************************************************** -->
      <?php include('includes/header.php'); ?>
      <!-- **********************************************************************************************************************************************************
      MAIN SIDEBAR MENU
      *********************************************************************************************************************************************************** -->
		<?php include('includes/menu.php');?>
      
      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper">
			<!-- Todo Fill the fields with the Project Information -->
          	<h3><i class="fa fa-angle-right"></i>Novo usuário</h3>
          	<div class="row mt">
          		<div class="col-lg-12">
					<div class="form-panel">
						<form class="form-horizontal style-form" method="get">
                          <div class="form-group">
                              <label class="col-sm-1 col-sm-1 control-label">Nome</label>
                              <div class="col-sm-4">
                                  <input class="form-control" id="disabledInput" type="text" required placeholder="Nome do usuário">
                              </div>
                          </div>
						  
						  <div class="form-group">
                              <label class="col-lg-1 col-sm-1 control-label">E-mail</label>
							  <div class="col-sm-4">
                                  <input type="email" required class="form-control" placeholder="E-mail">
                              </div>
                          </div>
						  
						  <div class="form-group">
                              <label class="col-lg-1 col-sm-1 control-label">Senha</label>
							  <div class="col-sm-4">
                                  <input type="password" required class="form-control" placeholder="Senha">
                              </div>
                          </div>
						  
						  <div class="form-group">
							 <label class="col-lg-1 col-sm-1 control-label">Centro de Custo</label>
							   <div class="col-lg-4">
								  <select class="form-control" required>
									  <option><?php echo "REDE164994"?></option>
									  <option><?php echo "REDE164994"?></option>
									  <option><?php echo "REDE164994"?></option>
									  <option><?php echo "REDE164994"?></option>
									  <option><?php echo "REDE164994"?></option>
								  </select>
                              </div>
						  </div>
						  
						  <div class="form-group">
                              <label class="col-lg-1 col-sm-1 control-label">Cargo</label>
							   <div class="col-lg-2">
								  <select class="form-control" required>
									  <option><?php echo "Job"?></option>
									  <option><?php echo "Job"?></option>
									  <option><?php echo "Job"?></option>
									  <option><?php echo "Job"?></option>
									  <option><?php echo "Job"?></option>
								  </select>
                              </div>
							  <div class="col-lg-7">
								<input class="btn btn-default btn-file col-lg-3" type="file">
							  </div>
                          </div>
						  
						  <div class="form-group">
							<div class="col-sm-4">
                                  <a class="btn btn-success btn-sm pull-left" href="manageusers.php">Adicionar</a>
                              </div>
						  </div>
						  
                      </form>
					</div>
          		</div>
          	</div>
			<!-- End Todo
		</section><! --/wrapper -->
      </section><!-- /MAIN CONTENT -->

      <!--main content end-->
      <!--footer start-->
      <footer class="site-footer">
          <div class="text-center">
              2014 - Alvarez.is
              <a href="blank.html#" class="go-top">
                  <i class="fa fa-angle-up"></i>
              </a>
          </div>
      </footer>
      <!--footer end-->
  </section>

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery-ui-1.9.2.custom.min.js"></script>
    <script src="assets/js/jquery.ui.touch-punch.min.js"></script>
    <script class="include" type="text/javascript" src="assets/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="assets/js/jquery.scrollTo.min.js"></script>
    <script src="assets/js/jquery.nicescroll.js" type="text/javascript"></script>


    <!--common script for all pages-->
    <script src="assets/js/common-scripts.js"></script>

    <!--script for this page-->
    
  <script>
      //custom select box

      $(function(){
          $('select.styled').customSelect();
      });

  </script>

  </body>
</html>
