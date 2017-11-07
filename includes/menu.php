 <!--sidebar start-->
      <aside>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu" id="nav-accordion">
				<!-- Todo fill User Informations-->
              	  <p class="centered"><a href="myuser.php?id=<?php if(isset($_SESSION['id'])){echo $_SESSION['id'];}?>"><img src="user_thumb/<?php if(isset($_SESSION['image'])){echo $_SESSION['image'];} ?>" class="img-circle" width="60"></a></p>
              	  <h5 class="centered"><?php if(isset($_SESSION['nome'])){echo $_SESSION['nome'];} ?></h5>
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
						  <?php
							$lvl = array("Líder de Testes", "Gerente de Projetos", "Administrador");
							if(isset($_SESSION['funcao']))
							{
								if(in_array($_SESSION['funcao'], $lvl))
								{
									echo '<li><a  href="projects.php">Gerenciar Projetos</a></li>';
									echo '<li><a  href="newproject.php">Novo Projeto</a></li>';
								}
							}
							
						  ?>
                          <li><a  href="myprojects.php">Meus Projetos</a></li>
                      </ul>
                  </li>
				  
                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-user"></i>
                          <span>Usuários</span>
                      </a>
                      <ul class="sub">
						  <?php
							$lvl = array("Líder de Testes", "Gerente de Projetos", "Administrador");
							if(isset($_SESSION['funcao']))
							{
								if(in_array($_SESSION['funcao'], $lvl))
								{
									echo '<li><a  href="manageusers.php">Gerenciar Usuários</a></li>';
									echo '<li><a  href="newuser.php">Criar novo usuário</a></li>';
								}
							}
						  ?>
						  <li><a  href="myuser.php">Meu usuário</a></li>
                      </ul>
                  </li>

                  <?php
					$lvl = array("Líder de Testes", "Gerente de Projetos", "Administrador");
					if(isset($_SESSION['funcao']))
					{
						if(in_array($_SESSION['funcao'], $lvl))
						{
							echo '<li class="sub-menu">
									  <a href="javascript:;" >
										  <i class="fa fa-plus"></i>
										  <span>Parâmetros de Gerência</span>
									  </a>
									  <ul class="sub">
										  <li><a  href="clr.php">Motivos de Cancelamento</a></li>
										  <li><a  href="ltm.php">Líder de Testes e Mudanças</a></li>
										  <li><a  href="lp.php">Líder de Projetos</a></li>
									  </ul>
								  </li>';
						}
					}
				  ?>
              </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>
      <!--sidebar end-->