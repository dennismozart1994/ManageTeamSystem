<?php
session_start();

require_once('classes/userf.php');
require_once('classes/project.php');
require_once('classes/notify.php');

$user = new user;
$project = new projects;
$notify = new notify;

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

if(isset($_GET['del']))
{
	$notify->DeleteNotify($_GET['del']);
}

if(isset($_POST['update_project']) && isset($_GET['p']))
{
	$id = $_GET['p'];
	$ltm = $_POST['ltm'];
	$lp = $_POST['lp'];
	$analyst = $_POST['analyst'];
	$phase = $_POST['phase'];
	$status = $_POST['status'];
	$pendency = $_POST['pendency'];
	$doc = $_POST['doc'];
	$meeting = $_POST['meeting'];
	$mrr = $_POST['mrr'];
	$schedule = $_POST['schedule'];
	$approvement = $_POST['approvement'];
	
	$project->UpdateProjectInfo($id, $ltm, $lp, $analyst, $phase, $status, $pendency, $doc, $meeting, $mrr, $schedule, $approvement);
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="teste">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
    <title>InProject - 
      <?php 
        if(isset($_GET['p']))
          {
            echo 'Ticket '.$project->getProjectField($_GET['p'], 'ts_prj').' - '.$project->getProjectField($_GET['p'], 'nmp_prj');
          }
      ?>
    </title>

    <link href="assets/css/bootstrap.css" rel="stylesheet"/>
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
        
    <link href="assets/css/style.css" rel="stylesheet"/>
    <link href="assets/css/style-responsive.css" rel="stylesheet"/>

  </head>

  <body>

  <section id="container" >
    <?php include('includes/header.php'); ?>
		<?php include('includes/menu.php');?>
      <section id="main-content">
          <section class="wrapper">
          	<h3><i class="fa fa-angle-right"></i><?php if(isset($_GET['p'])){echo "Ticket ".$project->getProjectField($_GET['p'], 'ts_prj')." - ".$project->getProjectField($_GET['p'], 'nmp_prj');} ?></h3>
          	<div class="row mt">
          	<div class="col-lg-12">
  					<div class="form-panel">
  						<form class="form-horizontal style-form" method="post" action="">
  						  <?php 
                  $project->getInfo($_GET['p']);
                ?>
  						</form>
  					</div>
          	</div>
          	</div>
		      </section>
      </section>

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
