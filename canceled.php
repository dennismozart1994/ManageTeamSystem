<?php
session_start();

require_once('classes/userf.php');
require_once('classes/parameters.php');
require_once('classes/project.php');

	$user = new user;
	$project = new projects;
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

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title>InProject - Gerenciar Projetos</title>

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
     <?php include('includes/header.php'); ?>
     <?php include('includes/menu.php');?>
      <section id="main-content">
          <section class="wrapper site-min-height">
          	<h3><i class="fa fa-angle-right"></i>Lista de Projetos</h3>
          	<div class="row mt">
			  		<div class="col-lg-12">
                      <div class="content-panel">
                      <h4><i class="fa fa-angle-right"></i>Filtros</h4>
						<div class="radio">
						<form class="form-inline" role="form" method="post" action="">
						  <div class="form-group">
							  <input type="text" class="form-control" id="projectname" name="projectname" placeholder="Nome do projeto">
						  </div>
						  <div class="form-group">
							<select class="form-control" name="reason" required>';
								<option value="Nao_Informado">Não Informado</option>
								<?php $param->getCancelReasons('select', '');	?>
								<option value="Outros">Outros</option>
							</select>
						  </div>
						  <button type="submit" class="btn btn-theme fa fa-filter" name="apply_filter"> Filtrar</button>
						</form>
						<br/>
                          <section id="unseen">
                            <table class="table table-bordered table-striped table-condensed">
                              <thead>
                              <tr>
                                  <th>T.S.</th>
                                  <th>Projeto</th>
                                  <th>Líder T.M</th>
                                  <th>Responsável</th>
                                  <th>Fase</th>
                                  <th>Motivo</th>
								  <th></th>
                              </tr>
                              </thead>
                              <tbody>
							  <?php
								if(isset($_POST['apply_filter']))
								{
									$name = strip_tags($_POST['projectname']);
									$filter = $_POST['reason'];
									$project->getCanceledProjects($name, $filter);
								}
								else if(isset($_GET['filter']))
								{
									$filter = $_GET['filter'];
									$project->getCanceledProjects('', $filter);
								}
								else
								{
									$project->getCanceledProjects('', 'all');
								}
							  ?>
                              </tbody>
                          </table>
                          </section>
                  </div>
               </div>		
		  	</div>
		</section>
      </section>
		<?php
			$project->manageAddHistoryModal();
		?>
      <footer class="site-footer">
          <div class="text-center">
              2014 - Alvarez.is
              <a href="blank.html#" class="go-top">
                  <i class="fa fa-angle-up"></i>
              </a>
          </div>
      </footer>
  </section>

    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery-ui-1.9.2.custom.min.js"></script>
    <script src="assets/js/jquery.ui.touch-punch.min.js"></script>
    <script class="include" type="text/javascript" src="assets/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="assets/js/jquery.scrollTo.min.js"></script>
    <script src="assets/js/jquery.nicescroll.js" type="text/javascript"></script>


    <script src="assets/js/common-scripts.js"></script>


  </body>
</html>
