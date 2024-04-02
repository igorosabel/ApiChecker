<?php if (is_null($values['user'])): ?>
null
<?php else: ?>
{
	"id": <?php echo $values['user']->get('id') ?>,
	"name": "<?php echo urlencode($values['user']->get('name')) ?>",
	"email": "<?php echo urlencode($values['user']->get('email')) ?>",
	"token": <?php echo is_null($values['user']->getToken()) ? 'null' : '"'.$values['user']->getToken().'"' ?>
}
<?php endif ?>
