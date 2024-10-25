<?php if (is_null($checkin)): ?>
null
<?php else: ?>
{
	"id": <?php echo $checkin->id ?>,
	"idType": <?php echo $checkin->id_type ?>,
	"message": <?php echo is_null($checkin->message) ? 'null' : '"'.urlencode($checkin->message).'"' ?>,
	"value": <?php echo is_null($checkin->value) ? 'null' : $checkin->value ?>,
	"locationLat": <?php echo is_null($checkin->location_lat) ? 'null' : $checkin->location_lat ?>,
	"locationLon": <?php echo is_null($checkin->location_lon) ? 'null' : $checkin->location_lon ?>,
	"idPhoto": <?php echo is_null($checkin->id_photo) ? 'null' : $checkin->id_photo ?>,
	"createdAt": "<?php echo $checkin->get('created_at', 'd/m/Y H:i') ?>"
}
<?php endif ?>
