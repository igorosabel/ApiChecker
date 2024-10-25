<?php if (is_null($user)): ?>
null
<?php else: ?>
{
	"id": <?php echo $user->id ?>,
	"name": "<?php echo urlencode($user->name) ?>",
	"email": "<?php echo urlencode($user->email) ?>",
	"token": <?php echo is_null($user->getToken()) ? 'null' : '"'.$user->getToken().'"' ?>
}
<?php endif ?>
