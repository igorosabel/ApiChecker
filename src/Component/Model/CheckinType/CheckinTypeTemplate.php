<?php if (is_null($values['CheckinType'])): ?>
null
<?php else: ?>
{
	"id": <?php echo $values['CheckinType']->get('id') ?>,
	"name": "<?php echo urlencode($values['CheckinType']->get('name')) ?>",
	"icon": "<?php echo urlencode($values['CheckinType']->get('icon')) ?>",
	"hasMessage": <?php echo $values['CheckinType']->get('has_message') ? 'true' : 'false' ?>,
	"hasValue": <?php echo $values['CheckinType']->get('has_value') ? 'true' : 'false' ?>,
	"num": <?php echo $values['CheckinType']->get('num') ?>,
	"lastUsed": <?php echo is_null($values['CheckinType']->get('last_used')) ? 'null' : '"'.$values['CheckinType']->get('last_used', 'd/m/Y H:i').'"' ?>
}
<?php endif ?>
