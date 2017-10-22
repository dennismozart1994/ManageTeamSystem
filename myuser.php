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

if(isset($_POST['save'])&&isset($_REQUEST['update'])&&isset($_FILES['thumbnail']))
{
	$id = $_GET['edit'];
	$name = trim(strip_tags($_POST['username']));
	$email = trim(strip_tags($_POST['email']));
	$tel = trim(strip_tags($_POST['tel']));
	$pass1 = trim(strip_tags($_POST['pass']));
	$pass2 = trim(strip_tags($_POST['pass2']));
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
					
	if($pass1 == $pass2)
	{
		if(isset($_FILES['thumbnail']))
		{
			// IF IMAGE HAS LESS THEN 2MB, NO ERRORS AND HAS THE ACCEPTED FILE TYPE
			if(in_array($ext_thumb, $accepted_thumb) && $error_thumb === 0 && $size_thumb < 2097152)
			{
				$user->UploadImage($id, $cc, $name, $funcao, $tel, $email, $pass1, $new_name_thumb, $tmp_thumb, $path_thumb, 1);
			}
		}
	}
	else
	{
		echo '<script>alert("Senhas informadas não conferem! Por gentileza digite a mesma senha em ambos os campos!"); window.location.href = "myuser.php?edit='.$id.'";</script>';
	}
}

if(isset($_POST['save'])&&isset($_REQUEST['myuser'])&&isset($_FILES['thumbnail']))
{
	$id = $_SESSION['id'];
	$name = trim(strip_tags($_POST['username']));
	$email = $_SESSION['login'];
	$tel = $_SESSION['tel'];
	$pass1 = trim(strip_tags($_POST['pass']));
	$pass2 = trim(strip_tags($_POST['pass2']));
	$cc = $_SESSION['cc'];
	$funcao = $_SESSION['funcao'];

	
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
					
	if($pass1 == $pass2)
	{
		if(isset($_FILES['thumbnail']))
		{
			// IF IMAGE HAS LESS THEN 2MB, NO ERRORS AND HAS THE ACCEPTED FILE TYPE
			if(in_array($ext_thumb, $accepted_thumb) && $error_thumb === 0 && $size_thumb < 2097152)
			{
				$user->UploadImage($id, $cc, $name, $funcao, $tel, $email, $pass1, $new_name_thumb, $tmp_thumb, $path_thumb, 2);
			}
		}
	}
	else
	{
		echo '<script>alert("Senhas informadas não conferem! Por gentileza digite a mesma senha em ambos os campos!"); window.location.href = "myuser.php";</script>';
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
    <title>InProject - <?php if(isset($_REQUEST['tm'])){echo $user->getUserField($_GET['tm'], 'nome_user');}else if(isset($_REQUEST['edit'])){echo $user->getUserField($_GET['edit'], 'nome_user');}else{echo "Meu usuário";}?></title>
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
			<!-- Todo Fill the fields with the User Information -->
          	<h3><i class="fa fa-angle-right"></i><?php if(isset($_REQUEST['tm'])){echo $user->getUserField($_GET['tm'], 'nome_user');}else if(isset($_REQUEST['edit'])){echo $user->getUserField($_GET['edit'], 'nome_user');}else{echo "Meu usuário";}?></h3>
          	<div class="row mt">
          		<div class="col-lg-12">
					<div class="form-panel">
						<form class="form-horizontal style-form" method="post" action="<?php if(isset($_GET['edit'])){echo '?edit='.$_GET['edit'].'&update';}else{echo '?edit='.$_SESSION['id'].'&myuser';}?>" enctype="multipart/form-data">
                          <?php
							if(!(isset($_GET['tm'])))
							{
						  ?>
						  <div class="form-group">
                              <label class="col-sm-1 col-sm-1 control-label">Nome</label>
                              <div class="col-sm-4">
                                  <input class="form-control" id="disabledInput" type="text" name="username"
								  <?php if(isset($_REQUEST['tm'])){echo ' required value="'.$user->getUserField($_GET['tm'], 'nome_user').'" disabled';}else if(isset($_REQUEST['edit'])){echo ' required value="'.$user->getUserField($_GET['edit'], 'nome_user').'"';}else{echo ' required value="'.$_SESSION['nome'].'"';}?>>
                              </div>
                          </div>
						  <?php
							}
						  ?>
						  
						  <div class="form-group">
                              <label class="col-lg-1 col-sm-1 control-label">E-mail</label>
							  <div class="col-sm-4">
                                  <input type="email" name="email" required class="form-control" 
								  <?php if(isset($_REQUEST['tm'])){echo ' required value="'.$user->getUserField($_GET['tm'], 'email_in_user').'" disabled';}else if(isset($_REQUEST['edit'])){echo ' required value="'.$user->getUserField($_GET['edit'], 'email_in_user').'"';}else{echo ' required value="'.$_SESSION['login'].'" disabled';}?>>
                              </div>
                          </div>
						  
						  <div class="form-group">
                              <label class="col-lg-1 col-sm-1 control-label">Telefone</label>
							  <div class="col-sm-4">
                                  <input type="text" name="tel" required class="form-control" 
								  <?php if(isset($_REQUEST['tm'])){echo ' required value="'.$user->getUserField($_GET['tm'], 'tel_user').'" disabled';}else if(isset($_REQUEST['edit'])){echo ' required value="'.$user->getUserField($_GET['edit'], 'tel_user').'"';}else{echo ' required value="'.$_SESSION['tel'].'" disabled';}?>>
                              </div>
                          </div>
						  
						  <?php
							if(!(isset($_GET['tm'])))
							{
						  ?>
						  <div class="form-group">
                              <label class="col-lg-1 col-sm-1 control-label">Nova Senha</label>
							  <div class="col-sm-4">
                                  <input type="password" name="pass" required class="form-control"
								  <?php if(isset($_REQUEST['tm'])){echo ' required value="'.$user->getUserField($_GET['tm'], 'senha_user').'"';}else if(isset($_REQUEST['edit'])){echo ' required value="'.$user->getUserField($_GET['edit'], 'senha_user').'"';}else{echo ' required value="'.$user->getUserField($_SESSION['id'], 'senha_user').'"';}?>>
                              </div>
                          </div>
						  
						  <div class="form-group">
                              <label class="col-lg-1 col-sm-1 control-label">Confirmar Senha</label>
							  <div class="col-sm-4">
                                  <input type="password" name="pass2" required class="form-control"
								  <?php if(isset($_REQUEST['tm'])){echo ' required value="'.$user->getUserField($_GET['tm'], 'senha_user').'"';}else if(isset($_REQUEST['edit'])){echo ' required value="'.$user->getUserField($_GET['edit'], 'senha_user').'"';}else{echo ' required value="'.$user->getUserField($_SESSION['id'], 'senha_user').'"';}?>>
                              </div>
                          </div>
						  <?php
						  }
						  ?>
						  
						  <div class="form-group">
							 <label class="col-lg-1 col-sm-1 control-label">Centro de Custo</label>
							   <div class="col-lg-4">
								  <select class="form-control" name="cc" <?php if(isset($_REQUEST['tm'])){echo "disabled ";} if(!(isset($_REQUEST['edit']))){echo "disabled ";}?> required>
									  <?php if(isset($_REQUEST['tm']))
										  {
											  $params->GetThisCC($_GET['tm']);
											  $params->GetCC($_GET['tm']);
										  }
										  else if(isset($_REQUEST['edit']))
										  {
											  $params->GetThisCC($_GET['edit']);
											  $params->GetCC($_GET['edit']);
										  }else{
											  $params->GetThisCC($_SESSION['id']);
											  $params->GetCC($_SESSION['id']);
										  }
									  ?>
								  </select>
                              </div>
						  </div>
						  
						  <div class="form-group">
                              <label class="col-lg-1 col-sm-1 control-label">Cargo</label>
							   <div class="col-lg-2">
								  <select class="form-control" name="funcao" <?php if(isset($_REQUEST['tm'])){echo "disabled ";} if(!(isset($_REQUEST['edit']))){echo "disabled ";}?>required>
										<?php 
											if(isset($_REQUEST['tm']))
												{
													$funcao = $user->getUserField($_GET['tm'], 'funcao_user');
													echo '<option value="'.$funcao.'">'.$funcao.'</option>';
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
												}
												else if(isset($_REQUEST['edit']))
												{
													$funcao = $user->getUserField($_GET['edit'], 'funcao_user');
													echo '<option value="'.$funcao.'">'.$funcao.'</option>';
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
												}else{
													$funcao = $user->getUserField($_SESSION['id'], 'funcao_user');
													echo '<option value="'.$funcao.'">'.$funcao.'</option>';
												}
										?>
								  </select>
                              </div>
							  <?php
								if(!(isset($_GET['tm'])))
								{
							  ?>
							  <div class="form-group">
								  <div class="col-lg-7">
									<input class="btn btn-default btn-file col-lg-3" name="thumbnail" id="thumbnail" type="file" required>
								  </div>
							  </div>
							  <?php
								}
							  ?>
                          </div>
						  
						  <?php
							if(!(isset($_GET['tm'])))
							{
						  ?>
						  <div class="form-group">
							<div class="col-sm-4">
                                  <input type="submit" value="Salvar alterações" name="save" class="btn btn-success btn-sm pull-left">
                              </div>
						  </div>
						  <?php
							}
						  ?>
						  
                      </form>
					</div>
          		</div>
          	</div>
			<?php 
				if(!(isset($_REQUEST['edit'])))
				{
					// Only shows if its not at edit mode
			?>
					<div class="row mt">
			  		<div class="col-lg-12">
                      <div class="content-panel">
                      <h4><i class="fa fa-angle-right"></i>Filtros</h4>
						<div class="radio">
						<!-- Todo Apply Filter -->
						<form class="form-inline" role="form" action="?filter">
                          <div class="form-group">
                              <label class="sr-only" for="projectname">Email address</label>
                              <input type="email" class="form-control" id="projectname" placeholder="Nome do projeto">
                          </div>
                          <div class="form-group">
                              <label>
								<input type="radio" name="optionsRadios" id="optionsRadios3" value="andamento" checked>
								Em andamento
							  </label>
							  <label>
								<input type="radio" name="optionsRadios" id="optionsRadios2" value="finalizado">
								Finalizado
							  </label>
							  <label>
								<input type="radio" name="optionsRadios" id="optionsRadios1" value="cancelado">
								Cancelado
							  </label>
                          </div>
                          <button type="submit" class="btn btn-theme fa fa-filter"> Filtrar</button>
						</form>
						<!-- End Todo -->
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
									if(isset($_REQUEST['tm']))
									{
										$project->showtmprojects($_GET['tm']);
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
				<?php
					}
				?>
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
