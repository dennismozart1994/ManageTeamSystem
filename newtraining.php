<?php
session_start();

require_once('classes/userf.php');
require_once('classes/parameters.php');
require_once('classes/project.php');

$user = new user;
$param = new parameters;
$project = new projects;

$permissions = array("Líder de Testes", "Gerente de Projetos", "Administrador");

// ACCESS WITHOUT LOGIN
if(!isset($_SESSION['login']))
{
	header('Location: index.php');
}

/*/ PERMISSIONS
if(!(in_array($_SESSION['funcao'], $permissions)))
{
	$user->logout();
}
*/

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
    <title>InProject - Novo Treinamento</title>
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
          <h3><i class="fa fa-angle-right"></i>Novo Treinamento</h3>
            <div class="row mt">
              <div class="col-lg-12">
      					<div class="form-panel">
      						<form class="form-horizontal style-form" method="post"> 
      						  <div class="form-group">
                      <label class="col-lg-1 col-sm-1 control-label">Tema</label>
      							  <div class="col-sm-4">
                        <input type="text" name="tema" <?php if(isset($_GET['v'])){echo 'value="'.$param->GetTrainingInfo($_GET["v"], "tema_treina").'"';}?> class="form-control" placeholder="Tema do treinamento" required>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="col-lg-1 col-sm-1 control-label">Descrição</label>
                      <div class="col-sm-4">
                        <textarea name="description" class="form-control" rows="5" cols="50" required><?php if(isset($_GET['v'])){echo $param->GetTrainingInfo($_GET["v"], "desc_treina");}else{echo 'Resumo sobre o tema do treinamento';} ?></textarea>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="col-lg-1 col-sm-1 control-label">Data</label>
                      <div class="col-sm-4">
                        <input type="date" name="date" <?php if(isset($_GET['v'])){echo 'value="'.$param->GetTrainingInfo($_GET["v"], "date_treina").'"';}?> class="form-control" required>
                      </div>
                    </div>
      						  
                    <div class="form-group">
                      <label class="col-lg-1 col-sm-1 control-label">Horário</label>
                      <div class="col-sm-4">
                        <input type="time" name="time" <?php if(isset($_GET['v'])){echo 'value="'.$param->GetTrainingInfo($_GET["v"], "time_treina").'"';}?> class="form-control">
                      </div>
                    </div>  

                    <div class="form-group">
                      <label class="col-lg-1 col-sm-1 control-label">Local</label>
                      <div class="col-sm-4">
                        <input type="text" name="local" <?php if(isset($_GET['v'])){echo 'value="'.$param->GetTrainingInfo($_GET["v"], "local_treina").'"';}else{echo 'value="Sala Leonardo da Vinci"';} ?> class="form-control" placeholder="Sala em que acontecerá o treinamento">
                      </div>
                    </div>

      						  <div class="form-group">
      							   <div class="col-lg-4">
                          <p class="form-control-static"><b>Responsável Inmetrics:</b></p>
        									  <?php 
                              if(isset($_GET['v']))
                              {
                                $param->GetTrainingAnalyst($param->GetTrainingInfo($_GET["v"], "id_users"));
                              }
                              else
                              {
                                $param->getAnalyst("check", "none");
                              }
        									  ?>
                        </div>
                    </div>
      						  <div class="form-group">
        							<div class="col-sm-4">
                        <?php
                          if(isset($_GET['v']))
                          {
                            echo '<button class="btn btn-success btn-sm pull-left" name="update" type="submit">Salvar</button>';
                          }
                          else
                          {
                            echo '<button class="btn btn-success btn-sm pull-left" name="add" type="submit">Adicionar</button>';
                          }
                        ?>
                      </div>
      						  </div> 
                  </form>

                  <?php
                    if(isset($_POST['add']))
                    {
                      $names = "start";
                        foreach ($param->users as $value) {
                          if(isset($_POST[$value]))
                          {
                            $names = $names."_".$_POST[$value];
                          }
                        }
                      $param->InsertTraining($_POST['tema'], $_POST['description'], $_POST['local'], $_POST['date'], $_POST['time'], $names);
                    }

                    if(isset($_POST['update']) && isset($_GET['v']))
                    {
                      $names = "start";
                        foreach ($param->users as $value) {
                          if(isset($_POST[$value]))
                          {
                            $names = $names."_".$_POST[$value];
                          }
                        }
                      $param->UpdateTraining($_GET['v'], $_POST['tema'], $_POST['description'], $_POST['local'], $_POST['date'], $_POST['time'], $names);
                    }
                  ?>
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
