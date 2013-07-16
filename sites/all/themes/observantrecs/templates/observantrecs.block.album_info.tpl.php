<?php if (count($albums) > 0): ?>
	<?php foreach ($albums as $album): ?>

		<?php if (!empty($album['releases'])): ?>
			<?php if (!empty($release_alias)):
				$cover_url_base = OBSERVANTRECORDS_CDN_BASE_URI . '/artists/' . (!empty($artist_alias) ? $artist_alias : 'eponymous-4') . '/albums/' . $album['album_alias'] . '/' . strtolower($album['releases'][$release_alias]['release_catalog_num']) . '/images';
			?>
<p>
	<a href="<?php echo $cover_url_base . '/cover_front_large.jpg'; ?>" rel="facebox" class="smaller"><img src="<?php echo $cover_url_base . '/cover_front_medium.jpg'; ?>" width="310"  title="[<?php echo $album['album_title']; ?>]" alt="[<?php echo $album['album_title']; ?>]" /></a>
	<a href="<?php echo $cover_url_base . '/cover_front_large.jpg'; ?>" rel="facebox" class="smaller">View larger image</a>
</p>

<ul>
				<?php if (!empty($album['releases'][$release_alias]['release_release_date'])): ?>
	<li>
		Release date: <strong><?php echo date('m/d/Y', strtotime($album['releases'][$release_alias]['release_release_date'])); ?></strong>
	</li>
				<?php endif; ?>
</ul>
				<?php /*if(!empty($album['releases'][$release_alias]['release_store_description'])): ?>
<h3>Buy</h3>
				<?php echo $album['releases'][$release_alias]['release_store_description']; ?>
				<?php endif; ?>
				<?php if(!empty($album['releases'][$release_alias]['release_credits'])): ?>
<h3>Credits</h3>
				<?php echo $album['releases'][$release_alias]['release_credits']; ?>
				<?php endif;*/ ?>
			<?php else: ?>
				<?php foreach ($album['releases'] as $release): ?>
<ul>
					<?php if(!empty($release['release_release_date'])): ?>
	<li>
		Release date: <?php echo date('m/d/Y', strtotime($release['release_release_date'])); ?>
	</li>
					<?php endif; ?>
</ul>
					<?php /* if(!empty($release['release_store_description'])): ?>
<h3>Buy</h3>
					<?php echo $release['release_store_description']; ?>
					<?php endif; ?>
					<?php if(!empty($release['release_credits'])): ?>
<h3>Credits</h3>
					<?php echo $release['release_credits']; ?>
					<?php endif; */?>
				<?php endforeach; ?>
			<?php endif; ?>
		<?php endif; ?>
	<?php endforeach; ?>
<?php endif; ?>
