<?php
	require('../classes/config.php');

	$config = new config;
	if($config->truncate_projetos() && $config->truncate_historico())
	{
		$config->alter_table("ALTER TABLE tab_user CHANGE tel_user tel_user VARCHAR(255) NOT NULL;");
	}
?>