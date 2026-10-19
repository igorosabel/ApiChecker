<?php if (is_null($checkin)): ?>
null
<?php else: ?>
{
	"id": {{ checkin.id }},
	"idType": {{ checkin.id_type }},
	"message": {{ checkin.message | string }},
	"value": {{ checkin.value | number }},
	"locationLat": {{ checkin.location_lat | number }},
	"locationLon": {{ checkin.location_lon | number }},
	"idPhoto": {{ checkin.id_photo | number }},
	"createdAt": {{ checkin.created_at | date }}
}
<?php endif ?>
