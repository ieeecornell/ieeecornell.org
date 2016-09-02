<?php

// Register the header menu so that it can be edited in the admin menu
function register_header_menu() {
	register_nav_menu("header_menu", __("Header Menu"));
}
add_action("init", "register_header_menu");

// Allow post thumbnails
add_theme_support("post-thumbnails");

// Add a custom post type for events
function add_post_type_event() {
	register_post_type(
		"event",
		array(
			"labels" => array(
				"name" => __("Events"),
				"singular_name" => __("Event")
			),
			"public" => true,
			"show_ui" => true,
			"rewrite" => array("slug" => "events"),
			"has_archive" => true,
			"supports" => array("title", "excerpt", "thumbnail", "custom-fields")
		)
	);
}

function event_meta_boxes() {
	add_meta_box(
		"event_details",
		"Event Details",
		"event_details_content",
		"event",
		"normal",
		"high"
	);
}

function event_details_content($object, $box) {
	// Get current/default meta values
	$year = get_post_meta($object->ID, "event_year", true);
	$month = get_post_meta($object->ID, "event_month", true);
	$day = get_post_meta($object->ID, "event_day", true);
	$hour = get_post_meta($object->ID, "event_hour", true);
	$minute = get_post_meta($object->ID, "event_minute", true);
	$am_pm = get_post_meta($object->ID, "event_am_pm", true);
	$location = get_post_meta($object->ID, "event_location", true);
	$facebook_url = get_post_meta($object->ID, "event_facebook_url", true);

	$year = $year != "" ? intval($year) : intval(date("Y"));
	$month = $month != "" ? intval($month) : intval(date("n"));
	$day = $day != "" ? intval($day) : intval(date("j"));
	$hour = $hour != "" ? intval($hour) : 12;
	$minute = $minute != "" ? intval($minute) : 0;
	$am_pm = $am_pm != "" ? $am_pm : "pm";
	$location = $location != "" ? $location : "";
	$facebook_url = $facebook_url != "" ? $facebook_url : "";

	// Create a dropdown for the year
	echo '<p><label for="event_year"></label>';
	echo '<select name="event_year" id="event_year">';
	for ($i = $year - 2; $i <= $year + 2; $i += 1) {
		echo '<option value="' . $i . '"' . ($i == $year ? ' selected' : '') . '>' . $i . '</option>';
		echo '<!-- ' . $i . ' ' . $year . ' ' . gettype($i) . ' ' . gettype($year) . ' -->';
	}
	echo '</select>';

	// Create a dropdown for the event month
	echo '<label for="event_month"></label>';
	echo '<select name="event_month" id="event_month">';
	$months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
	for ($i = 1; $i <= 12; $i += 1) {
		echo '<option value="' . $i . '"' . ($i == $month ? ' selected' : '') . '>' . $months[$i-1] . '</option>';
	}
	echo '</select>';

	// Create a dropdown for the event day
	echo '<label for="event_day"></label>';
	echo '<select name="event_day" id="event_day">';
	for ($i = 1; $i <= 31; $i += 1) {
		echo '<option value="' . str_pad($i, 2, "0", STR_PAD_LEFT) . '"' . ($i == $day ? ' selected' : '') . '>' . $i . '</option>';
	}
	echo '</select></p>';

	// Create a dropdown for the event hour
	echo '<p><label for="event_hour"></label>';
	echo '<select name="event_hour" id="event_hour">';
	for ($i = 12; $i < 24; $i += 1) {
		$j = $i == 12 ? $i : $i % 12;
		echo '<option value="' . $j . '"' . ($j == $hour ? ' selected' : '') .'>' . str_pad($j, 2, "0", STR_PAD_LEFT) . '</option>';
	}
	echo '</select>';

	// Create a dropdown for the event minute
	echo '<label for="event_minute"></label>';
	echo '<select name="event_minute" id="event_minute">';
	for ($i = 0; $i < 60; $i += 5) {
		echo '<option value="' . $i . '"' . ($i == $minute ? ' selected' : '') . '>' . str_pad($i, 2, "0", STR_PAD_LEFT) . '</option>';
	}
	echo '</select>';

	// Create a dropdown for the event am/pm
	echo '<label for="event_am_pm"></label>';
	echo '<select name="event_am_pm" id="event_am_pm">';
	echo '<option value="am"' . ($am_pm == "am" ? " selected" : "") . '>am</option>';
	echo '<option value="pm"' . ($am_pm == "pm" ? " selected" : "") . '>pm</option>';
	echo '</select></p>';

	// Create an input for the event location
	echo '<p><label for="event_location"></label>';
	echo '<input type="text" id="event_location" name="event_location" placeholder="Location" value="' . $location . '"></p>';
	
	// Create an input for the Facebook URL
	echo '<p><label for="event_facebook_url"></label>';
	echo '<input type="text" id="event_facebook_url" name="event_facebook_url" placeholder="Facebook Event URL" value="' . $facebook_url . '"></p>';
}

function event_save($post_id) {
	// Do nothing if this is just an autosave
	if (defined("DOING_AUTOSAVE") && DOING_AUTOSAVE) return;

	// Do nothing if the current user isn't allowed to add an event
	if ("page" == $_POST["post_type"]) {
		if (!current_user_can("edit_page", $post_id)) return;
	}
	else {
		if (!current_user_can("edit_post", $post_id)) return;
	}

	// Get the meta fields
	$event_year = $_POST["event_year"];
	$event_month = $_POST["event_month"];
	$event_day = $_POST["event_day"];
	$event_hour = $_POST["event_hour"];
	$event_minute = $_POST["event_minute"];
	$event_am_pm = $_POST["event_am_pm"];
	$event_date = date("Y-m-d H:i:s", strtotime("$event_year-$event_month-$event_day $event_hour:$event_minute:00 $event_am_pm"));
	$event_location = $_POST["event_location"];
	$event_facebook_url = $_POST["event_facebook_url"];

	// Add the meta fields
	update_post_meta($post_id, "event_year", $event_year);
	update_post_meta($post_id, "event_month", $event_month);
	update_post_meta($post_id, "event_day", $event_day);
	update_post_meta($post_id, "event_hour", $event_hour);
	update_post_meta($post_id, "event_minute", $event_minute);
	update_post_meta($post_id, "event_am_pm", $event_am_pm);
	update_post_meta($post_id, "event_date", $event_date);
	update_post_meta($post_id, "event_location", $event_location);
	update_post_meta($post_id, "event_facebook_url", $event_facebook_url);
}

add_action("init", "add_post_type_event");
add_action("add_meta_boxes", "event_meta_boxes");
add_action("save_post", "event_save");

// Shortcodes
// ----------

// Grids
function grid_shortcode($attrs, $content = nil) {
	return '<div class="grid about with-padding">' . do_shortcode($content) . '</div>';
}

function col_shortcode($attrs, $content = nil) {
	$a = shortcode_atts(array(
		"width" => "1-3"
	), $attrs);

	return '<div class="col col-' . $a["width"] . '">' . $content . '</div>';
}

add_shortcode("grid", "grid_shortcode");
add_shortcode("col", "col_shortcode");

// Buttons
function button_shortcode($attrs, $content = nil) {
	return '<a class="button" href="' . $attrs["url"] . '">' . $content . '</a>';
}

function button_secondary_shortcode($attrs, $content = nil) {
	return '<a class="button button-secondary" href="' . $attrs["url"] . '">' . $content . '</a>';
}

add_shortcode("button", "button_shortcode");
add_shortcode("button_secondary", "button_secondary_shortcode");

// Eboard page
function eboard_group_shortcode($attrs, $content = nil) {
	$a = shortcode_atts(array(
		"name" => ""
	), $attrs);

	$title = $a["name"] ? "<h3>" . $a["name"] . "</h3>" : "";

	// Remove newlines and paragraphs from the content
	$content = str_replace("<br />", "", $content);
	$content = str_replace("<p>", "", $content);
	$content = str_replace("</p>", "", $content);

	return "<section class='eboard'>$title<ul>" . do_shortcode($content) . "</ul></section>";
}

function eboard_member_shortcode($attrs, $content = nil) {
	$a = shortcode_atts(array(
		"img" => "",
		"name" => "",
		"title" => ""
	), $attrs);

	$ret = "<li><img src='" . $a["img"] . "' alt='" . $a["name"] .
			" Headshot' height='200' width='200'>" . "<h4>" . $a["name"];
	if ($a["title"]) {
		$ret .= "<br><span style='color: #666; font-weight: normal;'>" . $a["title"] . "</span>";
	}
	return $ret . "</h4></li>";
}

add_shortcode("eboard_group", "eboard_group_shortcode");
add_shortcode("eboard_member", "eboard_member_shortcode");
