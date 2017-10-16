<?php
session_start();
require_once('classes/userf.php');

$user = new user;

if(!isset($_SESSION['login'])){
	header('Location: index.php');
}

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

    <title>InProject - Home</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="assets/css/zabuto_calendar.css">
    <link rel="stylesheet" type="text/css" href="assets/js/gritter/css/jquery.gritter.css" />
    <link rel="stylesheet" type="text/css" href="assets/lineicons/style.css">    
    
    <!-- Custom styles for this template -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style-responsive.css" rel="stylesheet">

    <script src="assets/js/chart-master/Chart.js"></script>
    
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

              <div class="row">
                  <div class="col-lg-9 main-chart">
                  
                  	<div class="row mtbox">
                  		<?php 
							if(($_SESSION['funcao'] == "Líder de Testes") || ($_SESSION['funcao'] == "Gerente de Projetos") || ($_SESSION['funcao'] == "Administrador"))
							{
								$user->yourproblems('manager');
							}
							else
							{
								$user->yourproblems('user');
							}
						?>             	
                  	</div><!-- /row mt -->	
					
					<div class="row mt">               	
                      	<div class="col-md-4 col-sm-4 mb">
                      		<div class="white-panel pn">
                      			<div class="white-header">
						  			<h5>Quantidade por Fase</h5>
                      			</div>
								<table class="table table-striped table-advance table-hover">
								  <thead>
								  <tr>
									  <th><i class="fa fa-sort-amount-asc"></i>Fase</th>
									  <th><i class="fa fa-question-circle"></i>Total</th>
									  <th></th>
								  </tr>
								  </thead>
								  <tbody>
									<?php 
										if(($_SESSION['funcao'] == "Líder de Testes") || ($_SESSION['funcao'] == "Gerente de Projetos") || ($_SESSION['funcao'] == "Administrador"))
										{
											$user->getProjects('phase');
										}
										else
										{
											$user->getProjects('phaseuser');
										}
									?>
								  </tbody>
							  </table>
                      		</div>
                      	</div><!-- /col-md-4 -->      

                      	<div class="col-md-4 col-sm-4 mb">
								<?php 
									if(($_SESSION['funcao'] == "Líder de Testes") || ($_SESSION['funcao'] == "Gerente de Projetos") || ($_SESSION['funcao'] == "Administrador"))
										{
											$user->getProjects('finish');
										}
										else
										{
											$user->getProjects('finishuser');
										}
									?>
                      	</div>

                      	<div class="col-md-4 col-sm-4 mb">
                      		<div class="white-panel pn">
                      			<div class="white-header">
						  			<h5>Quantidade por Status</h5>
                      			</div>
								<table class="table table-striped table-advance table-hover">
								  <thead>
								  <tr>
									  <th><i class="fa fa-sort-amount-asc"></i>Status</th>
									  <th><i class="fa fa-question-circle"></i>Total</th>
									  <th></th>
								  </tr>
								  </thead>
								  <tbody>
									<?php 
										if(($_SESSION['funcao'] == "Líder de Testes") || ($_SESSION['funcao'] == "Gerente de Projetos") || ($_SESSION['funcao'] == "Administrador"))
											{
												$user->getProjects('status');
											}
											else
											{
												$user->getProjects('statususer');
											}
									?>
								  </tbody>
							  </table>
                      		</div>
                      	</div><!-- /col-md-4 -->      
                    </div><!-- /row -->
					
					
					
                      <div class="row mt">
                      <!--CUSTOM CHART START -->
                      <div class="border-head">
                          <h3>Relação Analista x Projetos</h3>
                      </div>
                      <div class="custom-bar-chart">
                          <ul class="y-axis">
                              <li><span>10</span></li>
                              <li><span>8</span></li>
                              <li><span>6</span></li>
                              <li><span>4</span></li>
                              <li><span>2</span></li>
                              <li><span>0</span></li>
                          </ul>
                          <?php $user->getProjects('graphic');?>
                      </div>
                      <!--custom chart end-->
					</div><!-- /row -->				
                  </div><!-- /col-lg-9 END SECTION MIDDLE -->
                  
                  
      <!-- **********************************************************************************************************************************************************
      RIGHT SIDEBAR CONTENT
      *********************************************************************************************************************************************************** -->                  
				<?php include('includes/right-bar.php'); ?>
              </div><! --/row -->
          </section>
      </section>

      <!--main content end-->
      <!--footer start-->
      <footer class="site-footer">
          <div class="text-center">
              2014 - Alvarez.is
              <a href="home.php?id=<?php echo $_SESSION['id'];?>#" class="go-top">
                  <i class="fa fa-angle-up"></i>
              </a>
          </div>
      </footer>
      <!--footer end-->
  </section>

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/jquery-1.8.3.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="assets/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="assets/js/jquery.scrollTo.min.js"></script>
    <script src="assets/js/jquery.nicescroll.js" type="text/javascript"></script>
    <script src="assets/js/jquery.sparkline.js"></script>


    <!--common script for all pages-->
    <script src="assets/js/common-scripts.js"></script>
    
    <script type="text/javascript" src="assets/js/gritter/js/jquery.gritter.js"></script>
    <script type="text/javascript" src="assets/js/gritter-conf.js"></script>

    <!--script for this page-->
    <script src="assets/js/sparkline-chart.js"></script>    
	<script src="assets/js/zabuto_calendar.js"></script>	
	
	<script type="text/javascript">
        $(document).ready(function () {
        var unique_id = $.gritter.add({
            // (string | mandatory) the heading of the notification
            title: 'Bem vindo de volta!',
            // (string | mandatory) the text inside the notification
            text: 'Esse sistema está em fase beta e portanto erros poderão ocorrer durante sua utilização. Reporte os erros encontrados <a href="http://testedelink" target="_blank" style="color:#ffd777">clicando aqui</a>.',
            // (string | optional) the image to display on the left
            image: '',
            // (bool | optional) if you want it to fade out on its own or just sit there
            sticky: true,
            // (int | optional) the time you want it to be alive for before fading out
            time: '',
            // (string | optional) the class name you want to apply to that specific message
            class_name: 'my-sticky-class'
        });

        return false;
        });
	</script>
	
	<script type="application/javascript">
        $(document).ready(function () {
            $("#date-popover").popover({html: true, trigger: "manual"});
            $("#date-popover").hide();
            $("#date-popover").click(function (e) {
                $(this).hide();
            });
        
            $("#my-calendar").zabuto_calendar({
                action: function () {
                    return myDateFunction(this.id, false);
                },
                action_nav: function () {
                    return myNavFunction(this.id);
                },
                ajax: {
                    url: "show_data.php?action=1",
                    modal: true
                },
                legend: [
                    {type: "text", label: "Special event", badge: "00"},
                    {type: "block", label: "Regular event", }
                ]
            });
        });
        
        
        function myNavFunction(id) {
            $("#date-popover").hide();
            var nav = $("#" + id).data("navigation");
            var to = $("#" + id).data("to");
            console.log('nav ' + nav + ' to: ' + to.month + '/' + to.year);
        }
    </script>
  

  </body>
</html>
