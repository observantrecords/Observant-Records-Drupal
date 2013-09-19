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

<ul>
				<?php if (!empty($album['releases'][$release_alias]['release_release_date'])): ?>
	<li>
		Release date: <strong><?php echo date('F d, Y', strtotime($album['releases'][$release_alias]['release_release_date'])); ?></strong>
	</li>
				<?php endif; ?>
				<?php if (!empty($album['releases'][$release_alias]['release_label'])): ?>
	<li>
		Label: <strong><?php echo $album['releases'][$release_alias]['release_label']; ?></strong>
	</li>
				<?php endif; ?>
</ul>
				<?php
				if (!empty($album['releases'][$release_alias]['release_ecommerce'])):
					$ecommerce_links = $album['releases'][$release_alias]['release_ecommerce'];
				?>
<h3>Buy</h3>

<ul>
	<?php foreach ($ecommerce_links as $ecommerce_label => $ecommerce_link): ?>
	<li><a href="<?php echo $ecommerce_link->ecommerce_url; ?>"><?php echo $ecommerce_label; ?></a></li>
	<?php endforeach; ?>
</ul>
				<?php endif; ?>
			<?php else: ?>
				<?php foreach ($album['releases'] as $release): ?>
<ul>
					<?php if(!empty($release['release_release_date'])): ?>
	<li>
		Release date: <strong><?php echo date('m/d/Y', strtotime($release['release_release_date'])); ?></strong>
	</li>
					<?php endif; ?>
					<?php if(!empty($release['release_label'])): ?>
	<li>
		Label: <strong><?php echo $release['release_label']; ?></strong>
	</li>
					<?php endif; ?>
</ul>
				<?php endforeach; ?>
			<?php endif; ?>
		<?php endif; ?>
	<?php endforeach; ?>
<?php endif; ?>
