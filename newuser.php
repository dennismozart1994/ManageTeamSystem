<?php
session_start();
require_once('classes/userf.php');
require_once('classes/project.php');
require_once('classes/parameters.php');

$user = new user;
$project = new projects;
$params = new parameters;

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

if(isset($_POST['save'])&&isset($_FILES['thumbnail']))
{
	$id = 0;
	$name = trim(strip_tags($_POST['username']));
	$email = trim(strip_tags($_POST['email']));
	$tel = trim(strip_tags($_POST['tel']));
	$pass1 = trim(strip_tags($_POST['pass']));
	$cc = trim(strip_tags($_POST['cc']));
	$funcao = trim(strip_tags($_POST['funcao']));

	
	$thumb_name = $_FILES['thumbnail']['name']; //THUMBNAIL NAME
	$tmp_thumb = $_FILES['thumbnail']['tmp_name']; // TEMP NAME OF THE FILE
	//GET THUMBNAIL EXTENSION
	$ext_thumb = @end(explode('.', $thumb_name));
	$ext_thumb = strtolower($ext_thumb);
	$new_name_thumb = (md5(uniqid('thumbnail_'.rand(), TRUE))).'.'.$ext_thumb; //NEW THUMBNAIL NAME
	$type_thumb = $_FILES['thumbnail']['type']; // FILE TYPE
	$size_thumb = $_FILES['thumbnail']['size']; // FILE SIZE
	$error_thumb = $_FILES['thumbnail']['error']; //ERROR MESSAGE
	$path_thumb = "user_thumb/".$new_name_thumb; //THUMBNAIL NEW PATH
	$accepted_thumb = array('jpeg', 'jpg', 'png'); // TIPOS DE MINIATURA

	// IF IMAGE HAS LESS THEN 2MB, NO ERRORS AND HAS THE ACCEPTED FILE TYPE
	if(in_array($ext_thumb, $accepted_thumb) && $error_thumb === 0 && $size_thumb < 2097152)
	{
		$user->UploadImage($id, $cc, $name, $funcao, $tel, $email, $pass1, $new_name_thumb, $tmp_thumb, $path_thumb, 0);
	}
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
						<form class="form-horizontal style-form" method="post" action="" enctype="multipart/form-data">
                          <div class="form-group">
                              <label class="col-sm-1 col-sm-1 control-label">Nome</label>
                              <div class="col-sm-4">
                                  <input name="username" class="form-control" id="disabledInput" type="text" required placeholder="Nome do usuário">
                              </div>
                          </div>
						  
						  <div class="form-group">
                              <label class="col-lg-1 col-sm-1 control-label">E-mail</label>
							  <div class="col-sm-4">
                                  <input type="email" name="email" required class="form-control" placeholder="E-mail">
                              </div>
                          </div>
						  
						  <div class="form-group">
                              <label class="col-lg-1 col-sm-1 control-label">Telefone</label>
							  <div class="col-sm-4">
                                  <input type="text" name="tel" required class="form-control" placeholder="(xx) xxxxx - xxxx">
                              </div>
                          </div>
						  
						  <div class="form-group">
                              <label class="col-lg-1 col-sm-1 control-label">Senha</label>
							  <div class="col-sm-4">
                                  <input type="password" name="pass" required class="form-control" placeholder="Senha">
                              </div>
                          </div>
						  
						  <div class="form-group">
							 <label class="col-lg-1 col-sm-1 control-label">Centro de Custo</label>
							   <div class="col-lg-4">
								  <select class="form-control" name="cc" required>
									  <?php
										  $params->GetThisCC($_SESSION['id']);
										  $params->GetCC($_SESSION['id']);
									  ?>
								  </select>
                              </div>
						  </div>
						  
						  <div class="form-group">
                              <label class="col-lg-1 col-sm-1 control-label">Cargo</label>
							   <div class="col-lg-2">
								  <select class="form-control" name="funcao" required>
									  <?php 
										echo '<option value="Auxiliar de Testes">Auxiliar de Testes</option>';
										echo '<option value="Analista de Testes Jr.">Analista de Testes Jr.</option>';
										echo '<option value="Analista de Testes Pl.">Analista de Testes Pl.</option>';
										echo '<option value="Analista de Testes Sr.">Analista de Testes Sr.</option>';
										echo '<option value="Auxiliar de Automação">Auxiliar de Automação</option>';
										echo '<option value="Analista de Automação Jr.">Analista de Automação Jr.</option>';
										echo '<option value="Analista de Automação Pl.">Analista de Automação Pl.</option>';
										echo '<option value="Analista de Automação Sr.">Analista de Automação Sr.</option>';
										echo '<option value="Líder de Testes">Líder de Testes</option>';
										echo '<option value="Gerente de Projetos">Gerente de Projetos</option>';
									  ?>
								  </select>
                              </div>
							  <div class="col-lg-7">
								<input class="btn btn-default btn-file col-lg-3" name="thumbnail" type="file">
							  </div>
                          </div>
						  
						  <div class="form-group">
							<div class="col-sm-4">
                                  <input type="submit" value="Adicionar" class="btn btn-success btn-sm pull-left" name="save" href="manageusers.php">
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
