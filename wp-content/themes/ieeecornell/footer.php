		<?php
			$date = date("Y-m-d H:i:s");
			$args = array(
				"post_type" => "event",
				"posts_per_page" => 3,
				"meta_key" => "event_date",
				"orderby" => "meta_value",
				"order" => "ASC",
				"meta_query" => array(
					"relation" => "AND",
					array(
						"key" => "event_date",
						"value" => $date,
						"compare" => ">="
					)
				)
			);
			$events = new WP_Query($args);
		?>
		<?php if ($events->have_posts()) : ?>
			<div class="grid calendar-upcoming">			
				<?php while ($events->have_posts()) : $events->the_post(); ?>
					<div class="col">
						<a href="<?php echo get_post_meta(get_the_ID(), "event_facebook_url", true); ?>">
							<time><?php
								echo get_post_meta(get_the_ID(), "event_month", true) . "/" .
								get_post_meta(get_the_ID(), "event_day", true) . "<br>" .
								get_post_meta(get_the_ID(), "event_hour", true) . ":" .
								str_pad(get_post_meta(get_the_ID(), "event_minute", true), 2, "0", STR_PAD_LEFT) . " " .
								strtoupper(get_post_meta(get_the_ID(), "event_am_pm", true));
							?></time>
							<aside>
								<h3><?php the_title(); ?></h3>
								<p><?php echo get_post_meta(get_the_ID(), "event_location", true); ?></p>
							</aside>
						</a>
					</div>
				<?php endwhile; ?>
				<div class="col more-link">
					<a href="<?php echo site_url(); ?>/calendar/">More &rarr;</a>
				</div>
			</div>
		<?php endif; ?>
	</div>
	<footer>
		<div class="inside grid">
			<div class="col col-1-2">
				<h2>Contact us</h2>
				<p>For general inquiries, email <a href="mailto:ieee@ece.cornell.edu">ieee@ece.cornell.edu</a>.</p>
				<dl>
					<dt>President</dt>
						<dd>Rohan Patel</dd>
				</dl>
				<p>Meet the rest of the <a href="<?php echo site_url(); ?>/about/executive-board/">executive board</a>!</p>
			</div>
			<div class="col col-1-2">
				<h2>Join our listserv!</h2>
				<p>Want to hear the latest ECE news? Be the first to hear about company info sessions, social events, and more if you join the IEEE listserv!</p>
				<p>To join, send an email to <a href="mailto:ieee-l-request@cornell.edu?subject=join">ieee-l-request@cornell.edu</a> with the subject <strong>join</strong> and a blank message body.</p>
			</div>
		</div>
	</footer>

	<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.js"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/js/site.js"></script>
</body>
</html>
