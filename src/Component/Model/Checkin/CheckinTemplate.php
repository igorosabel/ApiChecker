<?php if (is_null($values['Checkin'])): ?>
null
<?php else: ?>
{
	"id": <?php echo $values['Checkin']->get('id') ?>,
	"idType": <?php echo $values['Checkin']->get('id_type') ?>,
	"message": <?php echo is_null($values['Checkin']->get('message')) ? 'null' : '"'.urlencode($values['Checkin']->get('message')).'"' ?>,
	"value": <?php echo is_null($values['Checkin']->get('value')) ? 'null' : $values['Checkin']->get('value') ?>,
	"locationLat": <?php echo is_null($values['Checkin']->get('location_lat')) ? 'null' : $values['Checkin']->get('location_lat') ?>,
	"locationLon": <?php echo is_null($values['Checkin']->get('location_lon')) ? 'null' : $values['Checkin']->get('location_lon') ?>,
	"idPhoto": <?php echo is_null($values['Checkin']->get('id_photo')) ? 'null' : $values['Checkin']->get('id_photo') ?>,
	"createdAt": "<?php echo $values['Checkin']->get('created_at', 'd/m/Y H:i') ?>"
}
<?php endif ?>
