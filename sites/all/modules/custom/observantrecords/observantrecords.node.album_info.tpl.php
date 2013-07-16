<?php if (count($albums) > 0): ?>
	<?php foreach ($albums as $album): ?>
<h3><?php echo $album['album_title'] ?></h3>

<?php if (!empty($album['releases'])): ?>
	<?php if (!empty($release_alias)): ?>
<ul>
	<li>
		Release date: <?php echo date('m/d/Y', strtotime($album['releases'][$release_alias]['release_release_date'])); ?>
	</li>
	<li>
		Label: <?php echo $album['releases'][$release_alias]['release_label']; ?>
	</li>
</ul>
	<?php else: ?>
		<?php foreach ($album['releases'] as $release): ?>
<ul>
	<li>
		Release date: <?php echo date('m/d/Y', strtotime($release['release_release_date'])); ?>
	</li>
	<li>
		Label: <?php echo $release['release_label']; ?>
	</li>
</ul>
		<?php endforeach; ?>
	<?php endif; ?>
<?php endif; ?>
	<?php endforeach; ?>
<?php endif; ?>
