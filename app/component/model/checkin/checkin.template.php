<?php if (is_null($values['checkin'])): ?>
null
<?php else: ?>
{
	"id": <?php echo $values['checkin']->get('id') ?>,
	"idType": <?php echo $values['checkin']->get('id_type') ?>,
	"message": <?php echo is_null($values['checkin']->get('message')) ? 'null' : '"'.urlencode($values['checkin']->get('message')).'"' ?>,
	"value": <?php echo is_null($values['checkin']->get('value')) ? 'null' : $values['checkin']->get('value') ?>,
	"locationLat": <?php echo is_null($values['checkin']->get('location_lat')) ? 'null' : $values['checkin']->get('location_lat') ?>,
	"locationLon": <?php echo is_null($values['checkin']->get('location_lon')) ? 'null' : $values['checkin']->get('location_lon') ?>,
	"idPhoto": <?php echo is_null($values['checkin']->get('id_photo')) ? 'null' : $values['checkin']->get('id_photo') ?>,
	"createdAt": "<?php echo $values['checkin']->get('created_at', 'd/m/Y H:i:s') ?>"
}
<?php endif ?>
