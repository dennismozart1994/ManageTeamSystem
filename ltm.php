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
if(!(in_array($_SESSION['funcao'], $permissions)))
{
	$user->logout();
}

// LOGOUT
if(isset($_REQUEST['logout']))
{
	$user->logout();
}

if(isset($_REQUEST['name'])&&isset($_REQUEST['email']))
{
	$param->InsertLTM(1, $_GET['name'],$_GET['email'], $_SESSION['id']);
}

if(isset($_REQUEST['nameuser'])&&isset($_REQUEST['emailuser']))
{
	$param->UpdateLTM(1, $_GET['id'], $_GET['nameuser'],$_GET['emailuser'], $_SESSION['id']);
}

if(isset($_REQUEST['delete']))
{
	$param->DeleteLTM(1, $_GET['delete']);
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

    <title>InProject - Líderes de Testes e Mudanças</title>

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
          <section class="wrapper site-min-height">
          	<h3><i class="fa fa-angle-right"></i>Líderes de Testes e Mudanças</h3>
          	<div class="row mt">
			  		<div class="col-lg-12">
                      <div class="content-panel">
						<!-- Todo Add new event -->
						<a data-toggle="modal" class="btn btn-success btn-sm pull-left" href="ltm.php#addLider">Adicionar Líder</a>
						<!-- End Todo -->
                      <br/><br/><h4><i class="fa fa-angle-right"></i>Filtros</h4>
						<!-- Todo Apply Filter -->
						<form class="form-inline" role="form" method="post" action="?filter">
                          <div class="form-group">
                              <label class="sr-only" for="projectname">Nome</label>
                              <input type="text" class="form-control" required id="name" name="name" placeholder="Nome do usuário">
                          </div>
                          <button type="submit" class="btn btn-theme fa fa-filter" name="apply_filter"> Filtrar</button>
						</form>
						<!-- End Todo -->

						<br/>
                          <section id="unseen">
                            <table class="table table-bordered table-striped table-condensed">
                              <thead>
                              <tr>
                                  <th>Id</th>
                                  <th>Nome</th>
                                  <th>E-mail</th>
                                  <th>Projeto</th>
								  <th></th>
                              </tr>
                              </thead>
                              <tbody>
								<?php
                  if(isset($_POST['apply_filter']))
                  {
                    $param->apply_filterLTM(strip_tags($_POST['name']));
                  }
                  else
                  {
                    $param->getLTM("normal", "none");
                  }
								?>
                              </tbody>
                          </table>
                          </section>
                  </div><!-- /content-panel -->
               </div><!-- /col-lg-4 -->			
		  	</div><!-- /row -->
		</section><! --/wrapper -->
      </section><!-- /MAIN CONTENT -->
	  
		<?php
			$param->getLTM_DeleteModal(1);
			$param->getLTM_Modal(1);
		?>
		 		 
		 <!-- Modal Add Líder-->
		  <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="addLider" class="modal fade">
			<form method="get" action="">
			  <div class="modal-dialog">
				  <div class="modal-content">
					  <div class="modal-header">
						  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						  <h4 class="modal-title">Adicionar Líder</h4>
					  </div>
					  <div class="modal-body">
						<p>Nome</p>
						<input class="form-control" type="text" name="name" required placeholder="Nome do Líder de Testes"/>
						<p><br/>E-mail</p>
						<input class="form-control" name="email" type="email" required placeholder="e-mail para contato"/>
					  </div>
					  <div class="modal-footer">
						  <button data-dismiss="modal" class="btn btn-default" type="button">Cancelar</button>
						  <button href="index.php#confirmation" class="btn btn-theme" type="submit">Adicionar</button>
					  </div>
				  </div>
			  </div>
			</form>
		  </div>
		 <!-- modal -->
		 
		 
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
	<script type="text/javascript" src="jquery/jquery.mask.js"></script>
	<script type="text/javascript" src="jquery/jquery.mask.test.js"></script>

    <!--script for this page-->
    
  <script>
      //custom select box

      $(function(){
          $('select.styled').customSelect();
      });

  </script>

  </body>
</html>
