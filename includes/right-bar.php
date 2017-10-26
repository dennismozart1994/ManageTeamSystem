<?php 
if (session_status !== PHP_SESSION_ACTIVE) {
	session_start();
}
?>
<div class="col-lg-3 ds">
                    <!--COMPLETED ACTIONS DONUTS CHART-->
						<h3>NOTIFICAÇÕES</h3>
                        <?php $user->ShowNotifies();?>
                       <!-- USERS ONLINE SECTION -->
						<h3>MEMBROS DA EQUIPE</h3>
						<?php	$user->ShowTeam();?>
                  </div><!-- /col-lg-3 -->