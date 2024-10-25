<?php if (is_null($checkintype)): ?>
null
<?php else: ?>
{
	"id": <?php echo $checkintype->id ?>,
	"name": "<?php echo urlencode($checkintype->name) ?>",
	"icon": "<?php echo urlencode($checkintype->icon) ?>",
	"hasMessage": <?php echo $checkintype->has_message ? 'true' : 'false' ?>,
	"hasValue": <?php echo $checkintype->has_value ? 'true' : 'false' ?>,
	"num": <?php echo $checkintype->num ?>,
	"lastUsed": <?php echo is_null($checkintype->last_used) ? 'null' : '"'.$checkintype->get('last_used', 'd/m/Y H:i').'"' ?>
}
<?php endif ?>
