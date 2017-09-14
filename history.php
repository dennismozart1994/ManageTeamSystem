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
          	<h3><i class="fa fa-angle-right"></i><?php echo "Project Name"?></h3>
          	<div class="row mt">
			  	<div class="col-lg-12">
                    <div class="content-panel">
					  <h4><i class="fa fa-history"></i>Histórico do projeto</h4>
						<!-- Todo Add new event -->
						<a data-toggle="modal" class="btn btn-success btn-sm pull-left" href="index.php#myModal">Adicionar nota</a>
						<!-- End Todo -->
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
                                  <td>Teste de layout para projeção de whatever the hell that means</td>
                                  <td>João da Silva</td>
                                  <td>Marcelo Casseb</td>
                                  <td>Marcos Paulo de Azevedo Afonso</td>
                                  <td>Modelagem</td>
                                  <td>Em andamento</td>
                                  <td>Envio de Documentação Rede</td>
								<!-- Todo get id from project -->
								  <td><a href="project.php?p=123456"><button class="btn btn-primary btn-xs" onClick="href=project.php"><i class=" fa fa-search"></i></button></td></a>
								 <!-- End Todo -->
                              </tr>
							  <!-- End Todo -->
                              </tbody>
                          </table>
                        </section>
					</div><!-- /content-panel -->
               </div><!-- /col-lg-4 -->			
		  	</div><!-- /row -->
		</section><!-- /wrapper -->
      </section><!-- /MAIN CONTENT -->
		<!-- Modal Add nota-->
		  <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
			  <div class="modal-dialog">
				  <div class="modal-content">
					  <div class="modal-header">
						  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						  <h4 class="modal-title">Adicionar Nota</h4>
					  </div>
					  <div class="modal-body">
						<p>Data</p>
						<input class="form-control" type="text" data-mask="00/00/0000"/>
						<p><br/>Fase</p>
						<select class="form-control" required>
						  <option><?php echo "Modelagem"?></option>
						  <option><?php echo "Modelagem"?></option>
						  <option><?php echo "Modelagem"?></option>
						  <option><?php echo "Modelagem"?></option>
						  <option><?php echo "Modelagem"?></option>
					    </select>
						<p>Previsto</p>
						<input class="form-control" type="text"/>
						<p>Realizado</p>
						<input class="form-control" type="text"/>
						<p><br/>Nota</p>
						<textarea class="form-control" rows="5" id="comment"></textarea>
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
