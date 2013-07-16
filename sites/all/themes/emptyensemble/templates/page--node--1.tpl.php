		<div id="container" class="container">
			<div id="masthead" class="prepend-top">
				<header>
					<?php if ($site_name): ?>
					<h1 id="title">
						<a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home">
							<?php print $site_name; ?>
						</a>
					</h1>
					<?php endif; ?>
				</header>

				<nav id="main-nav">
					<?php if ($main_menu || $secondary_menu): ?>
					<?php //print theme('links__system_main_menu', array('links' => $main_menu, 'attributes' => array('id' => 'nav-main', 'class' => array('links', 'inline', 'clearfix')))); ?>
					<?php //print theme('links__system_secondary_menu', array('links' => $secondary_menu, 'attributes' => array('id' => 'secondary-menu', 'class' => array('links', 'inline', 'clearfix')))); ?>
					<?php endif; ?>
					<ul class="links inline clearfix">
						<li><a href="http://twitter.com/EmptyEnsemble"><img src="<?php echo emptyensemble_get_vigilante_uri(); ?>/images/icons/twitter.png" alt="[Twitter]" title="[Twitter]" /></a></li>
						<li><a href="http://facebook.com/EmptyEnsemble"><img src="<?php echo emptyensemble_get_vigilante_uri(); ?>/images/icons/facebook.png" alt="[Facebook]" title="[Facebook]" /></a></li>
						<li><a href="http://soundcloud.com/observantrecords"><img src="<?php echo emptyensemble_get_vigilante_uri(); ?>/images/icons/soundcloud.png" alt="[Soundcloud]" title="[Soundcloud]" /></a></li>
						<li><a href="http://youtube.com/user/observantrecords"><img src="<?php echo emptyensemble_get_vigilante_uri(); ?>/images/icons/youtube.png" alt="[YouTube]" title="[YouTube]" /></a></li>
					</ul>
				</nav>
			</div>

			<div id="content">
				<div class="span-24 last centered">
				<?php if ($page['highlighted']): ?><div id="highlighted"><?php print render($page['highlighted']); ?></div><?php endif; ?>
				<a id="main-content"></a>
				<?php if ($tabs): ?><div class="tabs"><?php print render($tabs); ?></div><?php endif; ?>
				<?php print render($page['help']); ?>
				<?php if ($action_links): ?><ul class="action-links"><?php print render($action_links); ?></ul><?php endif; ?>
				<?php print render($page['content']); ?>
				</div>
			</div>
		</div>
