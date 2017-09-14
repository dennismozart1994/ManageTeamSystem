 <!--sidebar start-->
      <aside>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu" id="nav-accordion">
				<!-- Todo fill User Informations-->
              	  <p class="centered"><a href="profile.html"><img src="assets/img/ui-sam.jpg" class="img-circle" width="60"></a></p>
              	  <h5 class="centered"><?php echo $_SESSION['nome']; ?></h5>
              	<!-- End Todo -->
                  <li class="mt">
                      <a class="active" href="home.php">
                          <i class="fa fa-dashboard"></i>
                          <span>Página Inicial</span>
                      </a>
                  </li>

				  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-list"></i>
                          <span>Projetos</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="projects.php">Gerenciar Projetos</a></li>
                          <li><a  href="newproject.php">Novo Projeto</a></li>
                          <li><a  href="myprojects.php">Meus Projetos</a></li>
                      </ul>
                  </li>
				  
                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-user"></i>
                          <span>Usuários</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="manageusers.php">Gerenciar Usuários</a></li>
                          <li><a  href="newuser.php">Criar novo usuário</a></li>
						  <li><a  href="myuser.php">Meu usuário</a></li>
                      </ul>
                  </li>

                  
                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-plus"></i>
                          <span>Parâmetros de Gerência</span>
                      </a>
                      <ul class="sub">
							
						  <li><a  href="ltm.php">Líder de Testes e Mudanças</a></li>
						  <li><a  href="lp.php">Líder de Projetos</a></li>
                          <li><a  href="fases.php">Fases</a></li>
                          <li><a  href="status.php">Status do Projeto</a></li>
                           <li><a  href="reasons.php">Motivo da pendência</a></li>
                      </ul>
                  </li>
              </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>
      <!--sidebar end-->