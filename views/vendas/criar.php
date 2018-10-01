		<div class="card">
			<header class="card-header flex-container align-middles space-between">
				<h3>Cliente</h3>		
				<a href="<?=HOME_URI?>/vendas" class="button back small">Voltar</a>
			</header>	
				<form action="" method="post">
				<section class="card-content">
					<div class="form-group">
	            			<select class="form-control" name="cod_cli">
	                    		<option value="-1">Selecione um cliente</option>
	                				<?php foreach($this->model->clientes as $cli) { ?>
	                    			<option value="<?=$cli['cod_cli']?>">
	                        			<?=$cli['nome_cli']?>
	                   				</option>
	               					<?php } ?>
	           				 </select>
	           				 <input type="submit" value="Adicionar" class="button info small">
	           				 <input type="submit" value="Remover" name="removeCli" class="button info small">
	      				</div>
				</section>
			</form>
		</div>

		<div class="card">
			<header class="card-header flex-container align-middles">
				<h3>Produtos</h3>
			</header>
			<form action="<?=HOME_URI?>/vendas/addproduto" method="post">
				<section class="card-content">
					<div class="form-group">
	            			<select class="form-control" name="cod_prod">
	                    		<option value="-1">Selecione um produto</option>
	                				<?php foreach($this->model->produtos as $pro) { ?>
	                    			<option value="<?=$pro['cod_prod']?>">
	                        			<?=$pro['desc_prod']?>
	                   				</option>
	               					<?php } ?>
	           				 </select>
	      					
    						<input type="number" name="qtde"  value="1"  class="form-control" style="width: 50px;">
	      					<input type="submit" value="Adicionar" class="button info small">
	      				</div>
				</section>
			</form>
		</div>

		<form action="<?=HOME_URI?>/vendas/salvar" method="post">
			<input type="hidden" value="<?=$_SESSION['nome_cli']?>" name="nome_cli">
			<div class="card">
					<header class="card-header flex-container align-middles">
						<h3>Compra - <?php if($_SESSION['nome_cli'] == null)
							echo " Sem cliente na compra!";
						else
							echo $_SESSION['nome_cli'];
						?></h3>
					</header>
					<?php if($_SESSION['produtos']):?>
					<table class="table">
				        <thead>
				            <tr>
				                <th>Codigo</th>
				                <th>Descrição</th>
				                <th>QTDE</th>
				                <th>Valor</th>
				                <th>Ações</th>
				            </tr>
				        </thead>
				        	
						        <?php foreach ($_SESSION['produtos'] as $prod) { ?>
						        <tr>
						            <td><?=$prod['cod_prod']?></td>
						            <td><?=$prod['desc_prod']?></td>
						            <td><?=$prod['qtde']?></td>
						            <td>R$ <?=$prod['valor_total']?></td>
						            <td>	
										<a href="<?=HOME_URI?>/vendas/deletar/<?=$prod['cod_prod']?>" class="icon-excluir" onclick="return confirm('Tem certeza que deseja deletar este registro?')">Excluir</a></button> 					            				            
						            </td>
						        </tr>
						        <?php $this->model->total += $prod['valor_total']?>
						        <?php } ?>
						<?php else:?>
						<h3 align="center" style="margin-top: 50px;">Sem produtos na compra!</h3>
					<?php endif;?>
				    </table>
	    		<div class="form-group"align="right" style="margin-right: 30px;">
	    			<a class="button back small">Total: R$ <?=$this->model->total?></a>
	    			<a href="<?=HOME_URI?>/vendas/limpar" class="button back small" onclick="return confirm('Tem certeza que deseja limpar a venda?')">Limpar</a>
					<input type="submit" value="Salvar" class="button new small">
		      	</div>
		    </div>	      
	</form>

				
