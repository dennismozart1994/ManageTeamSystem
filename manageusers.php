<?php
session_start();
require_once('classes/userf.php');

$user = new user;
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

if(isset($_GET['id']) && isset($_REQUEST['delete']))
{
	$id = $_GET['id'];
	$email = $_GET['email'];
	$name = $_GET['name'];
	
	$user->DeleteUser($id, $email, $name);
}

if(isset($_GET['reactivate']))
{
	$id = $_GET['reactivate'];
	$name = $_GET['name'];
	$email = $_GET['email'];
	
	$user->ReactivateUser($id, $email, $name);
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

    <title>InProject - Listar Usuários</title>

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
          	<h3><i class="fa fa-angle-right"></i>Lista de Usuários</h3>
          	<div class="row mt">
			  		<div class="col-lg-12">
                      <div class="content-panel">
                      <h4><i class="fa fa-angle-right"></i>Filtros</h4>
						<div class="radio">
						<form class="form-inline" role="form" method="post" action="">
                          <div class="form-group">
                              <label class="sr-only" for="username">Nome</label>
                              <input type="text" class="form-control" id="username" name="username" placeholder="Nome do usuário">
                          </div>
                          <button type="submit" class="btn btn-theme fa fa-filter" name="Filter"> Filtrar</button>
						</form>
						<br/>
                          <section id="unseen">
                            <table class="table table-bordered table-striped table-condensed">
                              <thead>
                              <tr>
                                  <th>Id</th>
                                  <th>Nome</th>
                                  <th>E-mail</th>
                                  <th>Centro de Custo</th>
                                  <th>Função</th>
								  <th></th>
                              </tr>
                              </thead>
                              <tbody>
								<?php
									if(isset($_POST['Filter']) && strlen(strip_tags($_POST['username'])) > 0)
									{
										$user->ApplyFilter(strip_tags($_POST['username']));
									}
									else
									{
										$user->getUsers();
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
			$user->getUsersDeleteModal();
		?>
		 
		 <!-- Modal cancelado-->
		  <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="cancelado" class="modal fade">
			  <div class="modal-dialog">
				  <div class="modal-content">
					  <div class="modal-header">
						  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						  <h4 class="modal-title">Excluído</h4>
					  </div>
					  <div class="modal-body">
						  <p>O usuário foi excluído com sucesso!</p>
					  </div>
					  <div class="modal-footer">
						  <button data-dismiss="modal" class="btn btn-theme" type="button">OK</button>
					  </div>
				  </div>
			  </div>
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
