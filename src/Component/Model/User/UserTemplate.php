<?php if (is_null($user)): ?>
null
<?php else: ?>
{
	"id": {{ user.id }},
	"name": {{ user.name | string }},
	"email": {{ user.email | string }},
	"token": <?php echo is_null($user->getToken()) ? 'null' : '"'.$user->getToken().'"' ?>
}
<?php endif ?>
