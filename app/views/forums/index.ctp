<?php
$this->Layout->blockStart('js_on_load');

echo <<<JS

$('.forum')
	.css({cursor: 'pointer'})
	.hover(
		function() { $(this).addClass('hover'); },
		function() { $(this).removeClass('hover'); })
	.click(function(){
		var url = $(this).find('h3.forum-title a').attr('href');
		window.location = url;
	});

JS;

$this->Layout->blockEnd();
?>

<div class="forums index">
	<h2><?php __('Forum');?></h2>

	<?php
	$i = 0;
	foreach ($forums as $forum):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' altrow';
		}
	?>
	<div class="forum <?php echo $class;?>">
		<h3 class="forum-title"><?php echo $this->Html->link($forum['Forum']['name'], array('controller' => 'forums', 'action' => 'view', $forum['Forum']['id'])); ?>&nbsp;</h3>
		<div class="description"><?php echo $forum['Forum']['text']; ?></div>
	</div>
<?php endforeach; ?>
	
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Pagina %page% di %pages%', true)
	));
	?>	</p>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('next', true).' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>

<div class="actions">
	
</div>