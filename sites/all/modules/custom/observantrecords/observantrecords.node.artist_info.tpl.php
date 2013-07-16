<?php if (count($artists) > 0): ?>
	<?php foreach ($artists as $artist): ?>
<h4><?php echo $artist['artist_display_name']; ?></h4>
<ul>
	<li><a href="<?php echo $artist['artist_url']; ?>/"><?php echo $artist['artist_url']; ?></a></li>
</ul>
	<?php endforeach; ?>
<?php endif; ?>
