<div class="products form">
<?php echo $this->Form->create('Product', array('type' => 'file'));?>
	<fieldset>
 		<h2><?php __('Modifica scheda prodotto'); ?></h2>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('product_category_id', array('label' => __('Appartiene alla categoria', true)));
		echo $this->Form->input('seller_id', array('label' => __('Produttore', true)));
		echo $this->Form->input('name', array('label' => __('Nome del prodotto', true)));
		echo $this->Form->input('text', array('label' => __('Descrizione', true)));
		echo $this->Form->input('packing', array('label' => __('Descrizione dell\'imballaggio', true)));

        if(!empty($this->data['Product']['image'])) {
            echo '<div class="input">';
            echo $this->Html->tag('label', __('Immagine attuale', true));
            echo $this->Image->resize('/documents/image/product/'.$this->data['Product']['image'], 120, 120);
            echo '</div>';
        }
		echo $this->Form->input('image', array('type' => 'file', 'label' => __('Carica una nuova immagine', true)));
		echo $this->Form->input('weight', array('label' => __('Peso (specifica unità di misura)', true)));
		echo $this->Form->input('number', array('label' => __('Numero di pezzi per collo', true)));
		echo $this->Form->input('value', array('label' => __('Prezzo &euro; per collo', true)));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Salva', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
        <li><?php echo $this->Html->link(__('Torna a prodotti', true), array('action' => 'index'));?></li>
    </ul>
</div>
