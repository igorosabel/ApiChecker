<?php if (is_null($user)): ?>
null
<?php else: ?>
{
	"id": <?php echo $user->get('id') ?>,
	"name": "<?php echo urlencode($user->get('name')) ?>",
	"email": "<?php echo urlencode($user->get('email')) ?>",
	"token": <?php echo is_null($user->getToken()) ? 'null' : '"'.$user->getToken().'"' ?>
}
<?php endif ?>
