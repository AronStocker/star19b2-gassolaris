<div class="productCategories form">
<?php echo $this->Form->create('ProductCategory');?>
	<fieldset>
 		<h2><?php __('Nuova categoria di prdotti'); ?></h2>
	<?php
		echo $this->Form->input('parent_id', array('label' => __('&Egrave; sottocategoria di', true)));
		echo $this->Form->input('name', array('label' => __('Nome', true)));
		echo $this->Form->input('text', array('label' => __('Descrizione', true)));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Salva', true));?>
</div>
<div class="actions">
	<h3><?php __('Azioni'); ?></h3>
	<ul>
        <li><?php echo $this->Html->link(__('Torna a categorie', true), array('action' => 'index'));?></li>
	</ul>
</div>