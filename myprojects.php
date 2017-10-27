<?php
session_start();
	require_once('classes/userf.php');
	require_once('classes/project.php');

	$user = new user;
	$project = new projects;
	
	// ACCESS WITHOUT LOGIN
	if(!isset($_SESSION['login']))
	{
		header('Location: index.php');
	}
	
	// LOGOUT
	if(isset($_REQUEST['logout']))
	{
		$user->logout();
	}
	
	if(isset($_POST['add_note']))
	{
		$id = $_POST['id'];
		$date = $_POST['date'];
		$phase = $_POST['phase'];
		$predicted = $_POST['predicted'];
		$accomplished = $_POST['accomplished'];
		$note = strip_tags($_POST['note']);
		
		$project->addHistoryNote($date, $phase, $predicted, $accomplished, $note, $id, $_SESSION['id']);
	}
	
	if(isset($_POST['finish_project']))
	{
		$id = $_POST['id'];
		
		// 5 - Finalizado
		// 8 - Cancelado
		$phase = 5; 
		
		$project->UpdatePhase($phase, 'Projeto finalizado', $id, $_SESSION['id'], 1);
	}
	
	if(isset($_POST['cancel_project']))
	{
		$id = $_POST['id'];
		$note = strip_tags($_POST['note']);
		$reason = $_POST['reason'];
		
		$message = $reason.' - '.$note;
		
		// 5 - Finalizado
		// 8 - Cancelado
		$phase = 8; 
		
		$project->UpdatePhase($phase, $message, $id, $_SESSION['id'], 1);
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
          	<h3><i class="fa fa-angle-right"></i>Lista de Projetos</h3>
          	<div class="row mt">
			  		<div class="col-lg-12">
                      <div class="content-panel">
                      <h4><i class="fa fa-angle-right"></i>Filtros</h4>
						<div class="radio">
						<!-- Todo Apply Filter -->
						<?php include('includes/filter.php') ?>
						<br/>
                          <section id="unseen">
                            <table class="table table-bordered table-striped table-condensed">
                              <thead>
                              <tr>
                                  <th>T.S.</th>
                                  <th>Projeto</th>
                                  <th>Líder T.M</th>
                                  <th>Líder P.</th>
                                  <th>Anl. Inmetrics</th>
                                  <th>Fase</th>
                                  <th>Status</th>
                                  <th>M.P</th>
								  <th></th>
                              </tr>
                              </thead>
                              <tbody>
								<?php 
									if(isset($_POST['apply_filter']))
									{
										$name = strip_tags($_POST['projectname']);
										$phase = $_POST['phase'];
										
										if(strlen($name) > 0)
										{
											$project->ApplyFilter($_SESSION['id'], $phase, $name, 0);
										}
										else
										{
											$project->getFProjects('fase', $phase, 0);
										}
									}
									else if(isset($_REQUEST['filter']) && isset($_GET['type']))
									{
										$project->getFProjects($_GET['type'], $_GET['id'], 0);
									}
									else
									{
										$project->getProjects("normaluser");
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
			$project->MyprojectsAddNote();
		?>
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
