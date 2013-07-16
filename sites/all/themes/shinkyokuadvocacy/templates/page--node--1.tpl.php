		<div id="container">
			<div id="masthead" class="centered">
				<header>
					<?php if ($site_name): ?>
					<h1 id="title">
						<a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home">
							<img src="<?php print $logo; ?>" alt="[<?php echo $site_name; ?>]" title="[<?php echo $site_name; ?>]" id="shinkyoku-advocacy-logo" />
						</a>
					</h1>
					<?php endif; ?>
				</header>
			</div>

			<div id="content">
				<div class="full-column">
				<?php if ($page['highlighted']): ?><div id="highlighted"><?php print render($page['highlighted']); ?></div><?php endif; ?>
				<a id="main-content"></a>
				<?php if ($tabs): ?><div class="tabs"><?php print render($tabs); ?></div><?php endif; ?>
				<?php print render($page['help']); ?>
				<?php if ($action_links): ?><ul class="action-links"><?php print render($action_links); ?></ul><?php endif; ?>
				<?php print render($page['content']); ?>
				</div>
			</div>
		</div>
