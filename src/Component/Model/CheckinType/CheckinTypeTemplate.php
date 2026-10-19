<?php if (is_null($checkintype)): ?>
null
<?php else: ?>
{
	"id": {{ checkintype.id }},
	"name": {{ checkintype.name | string }},
	"icon": {{ checkintype.icon | string }},
	"hasMessage": {{ checkintype.has_message | bool }},
	"hasValue": {{ checkintype.has_value | bool }},
	"num": {{ checkintype.num }},
	"lastUsed": {{ checkintype.last_used | date("d/m/Y H:i") }}
}
<?php endif ?>
