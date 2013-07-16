<?php if (count($tracks) > 0): ?>
<ol>
	<?php foreach ($tracks[0] as $track): ?>
	<li>
		<?php echo $track['song_title'] ?>
	</li>
	<?php endforeach; ?>
</ol>
<?php endif; ?>
