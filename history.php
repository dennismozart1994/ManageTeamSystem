<?php
if (session_status !== PHP_SESSION_ACTIVE) {
	session_start();
}
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
          	<h3><i class="fa fa-angle-right"></i><?php if(isset($_GET['p'])){echo $project->getProjectField($_GET['p'], 'nmp_prj');} ?></h3>
          	<div class="row mt">
			  	<div class="col-lg-12">
                    <div class="content-panel">
					  <h4><i class="fa fa-history"></i>Histórico do projeto</h4>
						<form class="form-inline" role="form" method="post" action="">
                          <div class="form-group">
							  <span>&nbsp&nbspDe:&nbsp </span>
                              <label class="sr-only" for="from">De</label>
                              <input type="date" max="<?php echo date('Y-m-d', time());?>" class="form-control" id="from" name="from">
                          </div>
						  <div class="form-group">
							  <span>&nbspAté:&nbsp </span>
                              <label class="sr-only" for="to">Até</label>
                              <input type="date" max="<?php echo date('Y-m-d', time());?>" class="form-control" id="to" name="to">
                          </div>
                          <button type="submit" class="btn btn-theme fa fa-filter" name="Filter"> Filtrar</button>
						</form>
						
						<?php
							if(($project->getProjectField($_GET['p'], 'id_f') != 5)&&($project->getProjectField($_GET['p'], 'id_f') != 8))
							{
								echo "<div style='padding:5px;'>";
								echo "<a data-toggle='modal' class='btn btn-success btn-sm pull-left' href='history.php?p=".$_GET['p']."#myModal".$_GET['p']."'>Adicionar nota</a>";
								echo "</div><br/><br/>";
							}
						?>
						
                        <section id="unseen">
                            <table class="table table-bordered table-striped table-condensed">
                              <thead>
                              <tr>
                                  <th>Fase</th>
								  <th>Data</th>
                                  <th>Previsto</th>
                                  <th>Realizado</th>
                                  <th>Anl. Inmetrics</th>
                                  <th>Nota</th>
                              </tr>
                              </thead>
                              <tbody>
							  <?php
								if(isset($_POST['Filter']))
								{
									$from = date('Y-m-d', strtotime($_POST['from']));
									$to = date('Y-m-d', strtotime($_POST['to']));
									echo "<script>alert('".$from." - ".$to."');</script>";
									$project->FilterHistory($_GET['p'], $from, $to);
								}
								else
								{
									$project->getHistory($_GET['p']);
								}
							  ?>
                              </tbody>
                          </table>
                        </section>
					</div><!-- /content-panel -->
               </div><!-- /col-lg-4 -->			
		  	</div><!-- /row -->
		</section><!-- /wrapper -->
      </section><!-- /MAIN CONTENT -->
		<?php
			$project->AddHistoryModal($_GET['p']);
		?>
		 
		 <!-- Modal nota adicionada-->
		  <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="confirmation" class="modal fade">
			  <div class="modal-dialog">
				  <div class="modal-content">
					  <div class="modal-header">
						  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						  <h4 class="modal-title">Nota adicionada</h4>
					  </div>
					  <div class="modal-body">
						  <p>Nota adicionada com sucesso!</p>
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
