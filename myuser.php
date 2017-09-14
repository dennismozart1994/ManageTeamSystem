<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
    <title>InProject - Meu usuário</title>
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
          	<h3><i class="fa fa-angle-right"></i>Meu usuário</h3>
          	<div class="row mt">
          		<div class="col-lg-12">
					<div class="form-panel">
						<form class="form-horizontal style-form" method="get">
                          <div class="form-group">
                              <label class="col-sm-1 col-sm-1 control-label">Nome</label>
                              <div class="col-sm-4">
                                  <input class="form-control" id="disabledInput" type="text" required value="Nome do usuário">
                              </div>
                          </div>
						  
						  <div class="form-group">
                              <label class="col-lg-1 col-sm-1 control-label">E-mail</label>
							  <div class="col-sm-4">
                                  <input type="email" required class="form-control" value="meuemail@meudominio.com.br" disabled>
                              </div>
                          </div>
						  
						  <div class="form-group">
                              <label class="col-lg-1 col-sm-1 control-label">Senha</label>
							  <div class="col-sm-4">
                                  <input type="password" required class="form-control" value="Senha">
                              </div>
                          </div>
						  
						  <div class="form-group">
							 <label class="col-lg-1 col-sm-1 control-label">Centro de Custo</label>
							   <div class="col-lg-4">
								  <select class="form-control" required>
									  <option><?php echo "REDE164994"?></option>
									  <option><?php echo "REDE164994"?></option>
									  <option><?php echo "REDE164994"?></option>
									  <option><?php echo "REDE164994"?></option>
									  <option><?php echo "REDE164994"?></option>
								  </select>
                              </div>
						  </div>
						  
						  <div class="form-group">
                              <label class="col-lg-1 col-sm-1 control-label">Cargo</label>
							   <div class="col-lg-2">
								  <select class="form-control" required>
									  <option><?php echo "Job"?></option>
									  <option><?php echo "Job"?></option>
									  <option><?php echo "Job"?></option>
									  <option><?php echo "Job"?></option>
									  <option><?php echo "Job"?></option>
								  </select>
                              </div>
							  <div class="col-lg-7">
								<input class="btn btn-default btn-file col-lg-3" type="file">
							  </div>
                          </div>
						  
						  <div class="form-group">
							<div class="col-sm-4">
                                  <a class="btn btn-success btn-sm pull-left" href="manageusers.php">Adicionar</a>
                              </div>
						  </div>
						  
                      </form>
					</div>
          		</div>
          	</div>
			<!-- End Todo -->
			<h3><i class="fa fa-angle-right"></i>Projetos sob responsabilidade do analista</h3>
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
							  <!-- Todo Fill with Project Information -->
                              <tr>
                                  <td class="numeric">999.999</td>
                                  <td>Teste de layout para projeção</td>
                                  <td>João da Silva</td>
                                  <td>Marcelo Casseb</td>
                                  <td>Marcos Paulo de Azevedo Afonso</td>
                                  <td>Modelagem</td>
                                  <td>Em andamento</td>
                                  <td>Envio de Documentação Rede</td>
								<!-- Todo get id from project -->
								  <td>
									<a href="project.php?p=123456"><button class="btn btn-primary btn-xs" onClick="href=project.php"><i class="fa fa-search"></i></button></a>
								  </td>
								 <!-- End Todo -->
                              </tr>
							  <!-- End Todo -->
                              </tbody>
                          </table>
                          </section>
                  </div><!-- /content-panel -->
               </div><!-- /col-lg-4 -->			
		  	</div><!-- /row -->
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
