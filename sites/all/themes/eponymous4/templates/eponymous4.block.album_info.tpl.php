<?php if (count($albums) > 0): ?>
	<?php foreach ($albums as $album): ?>

		<?php if (!empty($album['releases'])): ?>
			<?php if (!empty($release_alias)):
				$cover_url_base = OBSERVANTRECORDS_CDN_BASE_URI . '/artists/' . (!empty($artist_alias) ? $artist_alias : 'eponymous-4') . '/albums/' . $album['album_alias'] . '/' . strtolower($album['releases'][$release_alias]['release_catalog_num']) . '/images';
			?>
<p>
	<a href="<?php echo $cover_url_base . '/cover_front_large.jpg'; ?>" rel="facebox" class="smaller"><img src="<?php echo $cover_url_base . '/cover_front_medium.jpg'; ?>" width="230"  title="[<?php echo $album['album_title']; ?>]" alt="[<?php echo $album['album_title']; ?>]" /></a>
	<a href="<?php echo $cover_url_base . '/cover_front_large.jpg'; ?>" rel="facebox" class="smaller">View larger image</a>
</p>

<?php
/*
 * 
<ul>
				<?php if (!empty($album['releases'][$release_alias]['release_release_date'])): ?>
	<li>
		Release date: <?php echo date('m/d/Y', strtotime($album['releases'][$release_alias]['release_release_date'])); ?>
	</li>
				<?php endif; ?>
				<?php if (!empty($album['releases'][$release_alias]['release_label'])): ?>
	<li>
		Label: <?php echo $album['releases'][$release_alias]['release_label']; ?>
	</li>
				<?php endif; ?>
</ul>
 */
?>
			<?php else: ?>
<?php
/*
 * 
				<?php foreach ($album['releases'] as $release): ?>
<ul>
					<?php if(!empty($release['release_release_date'])): ?>
	<li>
		Release date: <?php echo date('m/d/Y', strtotime($release['release_release_date'])); ?>
	</li>
					<?php endif; ?>
					<?php if(!empty($release['release_label'])): ?>
	<li>
		Label: <?php echo $release['release_label']; ?>
	</li>
					<?php endif; ?>
</ul>
				<?php endforeach; ?>
 */
?>
			<?php endif; ?>
		<?php endif; ?>
	<?php endforeach; ?>
<?php endif; ?>
