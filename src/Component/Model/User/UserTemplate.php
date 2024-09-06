<?php if (is_null($values['User'])): ?>
null
<?php else: ?>
{
	"id": <?php echo $values['User']->get('id') ?>,
	"name": "<?php echo urlencode($values['User']->get('name')) ?>",
	"email": "<?php echo urlencode($values['User']->get('email')) ?>",
	"token": <?php echo is_null($values['User']->getToken()) ? 'null' : '"'.$values['User']->getToken().'"' ?>
}
<?php endif ?>
