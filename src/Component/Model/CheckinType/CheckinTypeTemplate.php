<?php if (is_null($checkintype)): ?>
null
<?php else: ?>
{
	"id": <?php echo $checkintype->get('id') ?>,
	"name": "<?php echo urlencode($checkintype->get('name')) ?>",
	"icon": "<?php echo urlencode($checkintype->get('icon')) ?>",
	"hasMessage": <?php echo $checkintype->get('has_message') ? 'true' : 'false' ?>,
	"hasValue": <?php echo $checkintype->get('has_value') ? 'true' : 'false' ?>,
	"num": <?php echo $checkintype->get('num') ?>,
	"lastUsed": <?php echo is_null($checkintype->get('last_used')) ? 'null' : '"'.$checkintype->get('last_used', 'd/m/Y H:i').'"' ?>
}
<?php endif ?>
