		<div id="masthead">
			<div class="container">
				<header id="logo">
						<a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home">
							<img src="<?php print $logo; ?>" alt="[<?php echo $site_name; ?>]" title="[<?php echo $site_name; ?>]" id="observant-records-logo" />
						</a>
				</header>

				<nav id="nav-header">
					<?php if ($main_menu): ?>
					<?php print theme('links__system_main_menu', array('links' => $main_menu)); ?>
					<?php endif; ?>
				</nav>

			</div>
		</div>

		<div class="container">
			<div id="content">
				<div id="content-header">
					
				<?php if ($messages): ?>
					<section id="success">
					<?php print $messages; ?>
					</section>
				<?php endif; ?>
				<?php if ($page['highlighted']): ?><div id="highlighted"><?php print render($page['highlighted']); ?></div><?php endif; ?>
				<a id="main-content"></a>
				<?php print render($title_prefix); ?>
				<?php if ($title): ?><h2 class="title" id="page-title"><?php print $title; ?></h2><?php endif; ?>
				<?php print render($title_suffix); ?>
				</div>
				<div id="column-1">
				<?php if ($tabs): ?><div class="tabs"><?php print render($tabs); ?></div><?php endif; ?>
				<?php print render($page['help']); ?>
				<?php if ($action_links): ?><ul class="action-links"><?php print render($action_links); ?></ul><?php endif; ?>
				<?php print render($page['content']); ?>
				<?php //print $feed_icons; ?>
				</div>

				<div id="column-2">
				<?php if ($page['sidebar_first']): ?>
					<?php print render($page['sidebar_first']); ?>
				<?php endif; ?>

				<?php if ($page['sidebar_second']): ?>
					<?php print render($page['sidebar_second']); ?>
				<?php endif; ?>
				</div>
			</div>

		</div>
		<div id="footer">
			<div class="container">
				<footer>
					<nav id="footer-column-1">
						<?php print theme('ext_link_top_nav'); ?>
						
						<p>
							&copy <?php echo date('Y'); ?> Observant Records
						</p>
					</nav>
					
					<section id="footer-column-2">
						<?php if ($page['footer']): ?>
						<?php print render($page['footer']); ?>
						<?php endif; ?>
						<?php
						print theme('links', array(
							'links' => menu_navigation_links('menu-footer-menu---artists'),
							'heading' => array(
								'text' => 'Artists',
								'level' => 'h3'
							),
							));
						?>
					</section>
					
					<section id="footer-column-3">
						<?php
						print theme('links', array(
							'links' => menu_navigation_links('menu-footer-menu---information'),
							'heading' => array(
								'text' => 'More Information',
								'level' => 'h3'
							),
							));
						?>
					</section>
				</footer>
			</div>
		</div>