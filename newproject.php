<?php
session_start();
require_once('classes/userf.php');
require_once('classes/parameters.php');

$user = new user;
$param = new parameters;
$permissions = array("Líder de Testes", "Gerente de Projetos", "Administrador");

// ACCESS WITHOUT LOGIN
if(!isset($_SESSION['login']))
{
	header('Location: index.php');
}

// PERMISSIONS
if(!(in_array(utf8_encode($_SESSION['funcao']), $permissions)))
{
	$user->logout();
}

// LOGOUT
if(isset($_REQUEST['logout']))
{
	$user->logout();
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
    <title>InProject - Novo projeto</title>
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
          	<h3><i class="fa fa-angle-right"></i>Novo projeto</h3>
          	<div class="row mt">
          		<div class="col-lg-12">
					<div class="form-panel">
						<form class="form-horizontal style-form" method="get">
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Ticket Service</label>
                              <div class="col-sm-2">
                                  <input class="form-control" name="ts" id="disabledInput" type="text" placeholder="Número do TS">
                              </div>
                          </div>
						  
						  <div class="form-group">
                              <label class="col-lg-2 col-sm-2 control-label">Projeto</label>
							  <div class="col-sm-6">
                                  <input type="text" name="nomeprojeto" class="form-control" placeholder="Nome do projeto">
                              </div>
                          </div>
						  
						  <div class="form-group">
                              <label class="col-lg-12 col-sm-12 control-label"><h4>Líderes</h4></label>
                              <div class="col-lg-3">
                                  <p class="form-control-static"><b>Testes e Mudanças:</b></p>
								  <select name="ltm" class="form-control">
									  <?php 
										$param->getLTM("select", "none");
									  ?>
								  </select>
                              </div>
							  <div class="col-lg-3">
                                  <p class="form-control-static"><b>Projeto Rede:</b></p>
								  <select name="lp" class="form-control">
									  <?php 
										$param->getLP("select", "none");
									  ?>
								  </select>
                              </div>
							   <div class="col-lg-4">
                                  <p class="form-control-static"><b>Responsável Inmetrics:</b></p>
								  <select name="analyst" class="form-control">
									  <?php 
										$param->getAnalyst("select", "none");
									  ?>
								  </select>
                              </div>
                          </div>
						  
						  
						  <div class="form-group">
                              <label class="col-lg-12 col-sm-12 control-label"><h4>Andamento</h4></label>
                              <div class="col-lg-3">
                                  <p class="form-control-static"><b>Fase:</b></p>
								  <select name="phases" class="form-control">
									  <?php 
										$param->getPhases("select", "none");
									  ?>
								  </select>
                              </div>
							  <div class="col-lg-3">
                                  <p class="form-control-static"><b>Status:</b></p>
								  <select name="status" class="form-control">
									  <?php 
										$param->getStatus("select", "none");
									  ?>
								  </select>
                              </div>
							   <div class="col-lg-4">
                                  <p class="form-control-static"><b>Motivo da pendência</b></p>
								  <select name="delayreason" class="form-control">
									  <?php 
										$param->getPendencia("select", "none");
									  ?>
								  </select>
                              </div>
                          </div>
						  
						  <div class="form-group">
							<label class="col-lg-12 col-sm-12 control-label"><h4>Checklist Inicial</h4></label>
                              <div class="col-lg-2">
                                  <p class="form-control-static"><b>Análise de doc(s)?</b></p>
								  <select name="doc" class="form-control">
									  <option value='1'>Sim</option>
									  <option value='0'>Não</option>
								  </select>
                              </div>
							  <div class="col-lg-2">
                                  <p class="form-control-static"><b>Reunião?</b></p>
								  <select name="meeting" class="form-control">
									  <option value='1'>Sim</option>
									  <option value='0'>Não</option>
								  </select>
                              </div>
							  <div class="col-lg-2">
                                  <p class="form-control-static"><b>MRR?</b></p>
								  <select name="mrr" class="form-control">
									  <option value='1'>Sim</option>
									  <option value='0'>Não</option>
								  </select>
                              </div>
							  <div class="col-lg-2">
                                  <p class="form-control-static"><b>Cronograma?</b></p>
								  <select  name="schedule" class="form-control">
									  <option value='1'>Sim</option>
									  <option value='0'>Não</option>
								  </select>
                              </div>
							  <div class="col-lg-2">
                                  <p class="form-control-static"><b>Aprovação?</b></p>
								  <select name="aproved" class="form-control">
									  <option value='1'>Sim</option>
									  <option value='0'>Não</option>
								  </select>
                              </div>
						  </div>
						  
						  <div class="form-group">
							<div class="col-sm-4">
                                  <a class="btn btn-success btn-sm pull-left" href="history.php?p=123456">Adicionar</a>
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
