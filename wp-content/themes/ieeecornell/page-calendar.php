<?php
	$ajax = isset($_SERVER["HTTP_X_REQUESTED_WITH"]) && $_SERVER["HTTP_X_REQUESTED_WITH"] == "XMLHttpRequest";
?>

<?php if (!$ajax) get_header(); ?>

<?php
	$year = isset($_GET["event_year"]) ? $_GET["event_year"] : date("Y");
	$month = isset($_GET["event_month"]) ? $_GET["event_month"] : date("n");

	$args = array(
		"post_type" => "event",
		"meta_query" => array(
			"relation" => "AND",
			array(
				"key" => "event_year",
				"value" => $year,
				"compare" => "="
			),
			array(
				"key" => "event_month",
				"value" => $month,
				"compare" => "="
			)
		)
	);
	$events = new WP_Query($args);
?>

<?php if (!$ajax) : ?>
<script>
	window.year = <?php echo $year; ?>;
	window.month = <?php echo $month; ?>;
</script>
<?php endif; ?>

<?php if (!$ajax) : ?><div class="ajax-content"><?php endif; ?>

<h2>Calendar</h2>

<table class="calendar" id="calendar">
	<thead>
		<tr class="heading">
			<th class="calendar-left"><a href="#">&larr; Previous Month</a></th>
			<th colspan="5"><?php echo date("F Y", strtotime("$year-$month-01 00:00:00")); ?></th>
			<th class="calendar-right"><a href="#">Next Month &rarr;</a></th>
		</tr>
		<tr>
			<th>Sunday</th>
			<th>Monday</th>
			<th>Tuesday</th>
			<th>Wednesday</th>
			<th>Thursday</th>
			<th>Friday</th>
			<th>Saturday</th>
		</tr>
	</thead>
	<tbody>
	</tbody>
</table>

<script>
window.events = [
<?php if ($events->have_posts()) : ?>
	<?php while ($events->have_posts()) : $events->the_post(); ?>
		{
			title: "<?php the_title(); ?>",
			year: <?php echo get_post_meta(get_the_ID(), "event_year", true); ?>,
			month: <?php echo get_post_meta(get_the_ID(), "event_month", true); ?>,
			day: <?php echo get_post_meta(get_the_ID(), "event_day", true); ?>,
			hour: <?php echo get_post_meta(get_the_ID(), "event_hour", true); ?>,
			minute: <?php echo get_post_meta(get_the_ID(), "event_minute", true); ?>,
			am_pm: "<?php echo get_post_meta(get_the_ID(), "event_am_pm", true); ?>",
			url: "<?php echo get_post_meta(get_the_ID(), "event_facebook_url", true); ?>"
		},
	<?php endwhile; ?>
<?php endif; ?>
];
</script>

<?php if (!$ajax) : ?></div><?php endif; ?>

<?php if (!$ajax) get_footer(); ?>
<?php if (!$ajax) : ?>
	<script src="<?php echo get_template_directory_uri(); ?>/js/calendar.js"></script>
<?php endif; ?>