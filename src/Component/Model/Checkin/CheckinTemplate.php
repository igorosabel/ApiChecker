<?php if (is_null($checkin)): ?>
null
<?php else: ?>
{
	"id": <?php echo $checkin->get('id') ?>,
	"idType": <?php echo $checkin->get('id_type') ?>,
	"message": <?php echo is_null($checkin->get('message')) ? 'null' : '"'.urlencode($checkin->get('message')).'"' ?>,
	"value": <?php echo is_null($checkin->get('value')) ? 'null' : $checkin->get('value') ?>,
	"locationLat": <?php echo is_null($checkin->get('location_lat')) ? 'null' : $checkin->get('location_lat') ?>,
	"locationLon": <?php echo is_null($checkin->get('location_lon')) ? 'null' : $checkin->get('location_lon') ?>,
	"idPhoto": <?php echo is_null($checkin->get('id_photo')) ? 'null' : $checkin->get('id_photo') ?>,
	"createdAt": "<?php echo $checkin->get('created_at', 'd/m/Y H:i') ?>"
}
<?php endif ?>
