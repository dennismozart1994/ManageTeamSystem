<form class="form-inline" role="form" method="post" action="">
  <div class="form-group">
	  <input type="text" class="form-control" id="projectname" name="projectname" placeholder="Nome do projeto">
  </div>
  <div class="form-group">
	  <label>
		<input type="radio" name="phase" id="phase1" value="andamento" checked>
		Em andamento
	  </label>
	  <label>
		<input type="radio" name="phase" id="phase2" value="5">
		Finalizado
	  </label>
	  <label>
		<input type="radio" name="phase" id="phase3" value="8">
		Cancelado
	  </label>
  </div>
  <button type="submit" class="btn btn-theme fa fa-filter" name="apply_filter"> Filtrar</button>
</form>