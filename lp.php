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

    <title>InProject - Líderes de Projetos</title>

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
          	<h3><i class="fa fa-angle-right"></i>Líderes de Projetos</h3>
          	<div class="row mt">
			  		<div class="col-lg-12">
                      <div class="content-panel">
						<!-- Todo Add new event -->
						<a data-toggle="modal" class="btn btn-success btn-sm pull-left" href="lp.php#addLider">Adicionar Líder</a>
						<!-- End Todo -->
                      <br/><br/><h4><i class="fa fa-angle-right"></i>Filtros</h4>
						<!-- Todo Apply Filter -->
						<form class="form-inline" role="form" action="?filter">
                          <div class="form-group">
                              <label class="sr-only" for="projectname">Nome</label>
                              <input type="email" class="form-control" id="projectname" placeholder="Nome do usuário">
                          </div>
                          <button type="submit" class="btn btn-theme fa fa-filter"> Filtrar</button>
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
									$param->getLP("normal", "none");
								?>
                              </tbody>
                          </table>
                          </section>
                  </div><!-- /content-panel -->
               </div><!-- /col-lg-4 -->			
		  	</div><!-- /row -->
		</section><! --/wrapper -->
      </section><!-- /MAIN CONTENT -->
				 
		 <!-- Modal cancelamento-->
		  <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="cancelamento" class="modal fade">
			  <div class="modal-dialog">
				  <div class="modal-content">
					  <div class="modal-header">
						  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						  <h4 class="modal-title">Tem certeza que deseja excluir o Líder de Projetos?</h4>
					  </div>
					  <div class="modal-footer">
						  <button data-dismiss="modal" class="btn btn-default" type="button">Não</button>
						  <button data-dismiss="modal" data-toggle="modal" href="index.php#cancelado" class="btn btn-theme" type="button">Sim</button>
					  </div>
				  </div>
			  </div>
		  </div>
		 <!-- modal -->
		 
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
		 
		 
		 <!-- Modal Editar Líder-->
		  <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="editar" class="modal fade">
			  <div class="modal-dialog">
				  <div class="modal-content">
					  <div class="modal-header">
						  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						  <h4 class="modal-title">Editar dados do Líder de Projetos?</h4>
					  </div>
					  <div class="modal-body">
						<p>Nome</p>
						<input class="form-control" type="text" value="Marcelo Casseb"/>
						<p><br/>E-mail</p>
						<input class="form-control" type="email" value="mcasseb@redecardsa.com.br"/>
						<p><br/>Projeto</p>
						<select class="form-control" required>
						  <option><?php echo "Rede"?></option>
						  <option><?php echo "Rede"?></option>
						  <option><?php echo "Rede"?></option>
						  <option><?php echo "Rede"?></option>
						  <option><?php echo "Rede"?></option>
					    </select>
					  </div>
					  <div class="modal-footer">
						  <button data-dismiss="modal" class="btn btn-default" type="button">Cancelar</button>
						  <button data-dismiss="modal" data-toggle="modal" href="lp.php#concluido" class="btn btn-theme" type="button">Salvar</button>
					  </div>
				  </div>
			  </div>
		  </div>
		 <!-- modal -->
		 
		 <!-- Modal Concluído-->
		  <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="concluido" class="modal fade">
			  <div class="modal-dialog">
				  <div class="modal-content">
					  <div class="modal-header">
						  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						  <h4 class="modal-title">Concluído</h4>
					  </div>
					  <div class="modal-body">
						  <p>Os dados foram alterados com sucesso!</p>
					  </div>
					  <div class="modal-footer">
						  <button data-dismiss="modal" class="btn btn-theme" type="button">OK</button>
					  </div>
				  </div>
			  </div>
		  </div>
		 <!-- modal -->
		 
		 
		 
		 <!-- Modal Add Líder-->
		  <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="addLider" class="modal fade">
			  <div class="modal-dialog">
				  <div class="modal-content">
					  <div class="modal-header">
						  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						  <h4 class="modal-title">Adicionar Líder</h4>
					  </div>
					  <div class="modal-body">
						<p>Nome</p>
						<input class="form-control" type="text" placeholder="Nome do Líder de Projetos"/>
						<p><br/>E-mail</p>
						<input class="form-control" type="email" placeholder="e-mail para contato"/>
						<p><br/>Projeto</p>
						<select class="form-control" required>
						  <option><?php echo "Rede"?></option>
						  <option><?php echo "Rede"?></option>
						  <option><?php echo "Rede"?></option>
						  <option><?php echo "Rede"?></option>
						  <option><?php echo "Rede"?></option>
					    </select>
					  </div>
					  <div class="modal-footer">
						  <button data-dismiss="modal" class="btn btn-default" type="button">Cancelar</button>
						  <button data-dismiss="modal" data-toggle="modal" href="index.php#confirmation" class="btn btn-theme" type="button">Adicionar</button>
					  </div>
				  </div>
			  </div>
		  </div>
		 <!-- modal -->
		 
		 <!-- Modal nota adicionada-->
		  <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="confirmation" class="modal fade">
			  <div class="modal-dialog">
				  <div class="modal-content">
					  <div class="modal-header">
						  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						  <h4 class="modal-title">Parâmetro adicionado</h4>
					  </div>
					  <div class="modal-body">
						  <p>Parâmetro adicionado com sucesso!</p>
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
