
<?php require_once 'header.php' ?>
		
	<div class="base-home">
		<h1 class="titulo">>> SEJA BEM-VINDO</h1>
		<div class="base-colunas">	
			<a href="<?php echo base_url('cadastro')?>" class="col">
				<i class="icone ico1"></i>
				<span>CADASTRAR</span>
			</a>	
			
			<a href="<?php echo base_url('listagem')?>" class="col">
				<i class="icone ico2"></i>
				<span>listar</span>
			</a>
			
			<a href="<?php echo base_url('edicao')?>" class="col">
				<i class="icone ico3"></i>
				<span>Editar</span>
			</a>
			
			<a href="<?php echo base_url('exclusao')?>" class="col">
				<i class="icone ico4"></i>
				<span>Excluir</span>
			</a>
		</div>	
	</div>	

<?php require_once 'footer.php' ?>
