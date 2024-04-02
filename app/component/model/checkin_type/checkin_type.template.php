<?php if (is_null($values['checkintype'])): ?>
null
<?php else: ?>
{
	"id": <?php echo $values['checkintype']->get('id') ?>,
	"name": "<?php echo urlencode($values['checkintype']->get('name')) ?>",
	"icon": "<?php echo urlencode($values['checkintype']->get('icon')) ?>",
	"hasMessage": <?php echo $values['checkintype']->get('has_message') ? 'true' : 'false' ?>,
	"hasValue": <?php echo $values['checkintype']->get('has_value') ? 'true' : 'false' ?>,
	"num": <?php echo $values['checkintype']->get('num') ?>,
	"lastUsed": "<?php echo $values['checkintype']->get('last_used', 'd/m/Y H:i:s') ?>"
}
<?php endif ?>
