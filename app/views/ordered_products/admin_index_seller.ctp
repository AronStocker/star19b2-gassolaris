
<div class="export-tools">
    <div class="openclose">
        <?php echo $this->Html->image('oxygen/16x16/actions/tool2.png'); ?>
    </div>
    <ul class="toolslist">
        <li><?php
        echo $this->Html->image('oxygen/16x16/actions/mail_generic.png');
        echo $this->Html->link(__('email al fornitore', true), array('action' => 'mail_orders_to_seller', $seller['Seller']['id'])); ?></li>
    </ul>
</div>

<div class="orderedProducts index">
	<h2>
    <?php
    __('Ordini pendenti per il produttore ');
    echo $seller['Seller']['name'];
    ?>
    </h2>

    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?php __('Prodotto'); ?></th>
            <th><?php __('Quantità'); ?></th>
            <th><?php __('Totale'); ?></th>
        </tr>
    <?php foreach($totals as $product => $values): ?>
        <tr class="total">
            <td class="name"><?php echo $product; ?></td>
            <td class="quantity"><?php echo $values['quantity']; ?></td>
            <td class="value"><?php echo $values['total']; ?> &euro;</td>
        </tr>
    <?php endforeach; ?>
    </table>

    <h2>
    <?php
    __('Dettaglio');
    ?>
    </h2>
    
    <p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
	));
	?>	</p>
    
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort(__('Acquirente', true), 'user_id');?></th>
			<th><?php echo $this->Paginator->sort(__('Prodotto', true), 'product_id');?></th>
			<th><?php echo $this->Paginator->sort(__('Quantità', true), 'quantity');?></th>
			<th><?php echo $this->Paginator->sort(__('Totale', true), 'value');?></th>
			<th class="actions"><?php echo $this->Paginator->sort(__('Pagato', true), 'paid');?></th>
			<th class="actions"><?php echo $this->Paginator->sort(__('Ritirato', true), 'retired');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($orderedProducts as $orderedProduct):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $this->Html->link($orderedProduct['User']['fullname'], array('controller' => 'users', 'action' => 'view', $orderedProduct['User']['id'], 'admin' => false)); ?>
		</td>
		<td>
			<?php echo $this->Html->link($orderedProduct['Product']['name'], array('controller' => 'products', 'action' => 'view', $orderedProduct['Product']['id'], 'admin' => false)); ?>
		</td>
		<td><?php echo $orderedProduct['OrderedProduct']['quantity']; ?>&nbsp;</td>
		<td><?php echo $orderedProduct['OrderedProduct']['value']; ?>&nbsp;&euro;</td>
		<td class="actions"><?php
        if($orderedProduct['OrderedProduct']['paid']) {
            echo $this->Html->image('oxygen/16x16/actions/apply.png', array('url' => array('action' => 'set_not_paid', $orderedProduct['OrderedProduct']['id'])));
        } else {
            echo $this->Html->image('oxygen/16x16/actions/mail_mark_important.png', array('url' => array('action' => 'set_paid', $orderedProduct['OrderedProduct']['id'])));
        }
        ?></td>
		<td class="actions"><?php
        if($orderedProduct['OrderedProduct']['retired']) {
            echo $this->Html->image('oxygen/16x16/actions/apply.png', array('url' => array('action' => 'set_not_retired', $orderedProduct['OrderedProduct']['id'])));
        } else {
            echo $this->Html->image('oxygen/16x16/actions/mail_mark_important.png', array('url' => array('action' => 'set_retired', $orderedProduct['OrderedProduct']['id'])));
        }
        ?></td>
	</tr>
<?php endforeach; ?>
	</table>


	<div class="paging">
		<?php echo $this->Paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('next', true).' >>', array(), null, array('class' => 'disabled'));?>
	</div>

</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
        <li><?php echo $this->Html->link(__('Tutti gli ordini pendenti', true), array('action' => 'index')); ?></li>
        <li class="dropdown"><?php __('Vedi ordini per acquirente'); ?>
            <ul>
                <?php foreach($users as $id => $user): ?>
                <li><?php echo $this->Html->link($user, array('action' => 'index_user', $id)); ?></li>
                <?php endforeach; ?>
            </ul>
        </li>
        <li class="dropdown"><?php __('Vedi ordini per produttore'); ?>
            <ul>
                <?php foreach($sellers as $id => $seller): ?>
                <li><?php echo $this->Html->link($seller, array('action' => 'index_seller', $id)); ?></li>
                <?php endforeach; ?>
            </ul>
        </li>
	</ul>
</div>