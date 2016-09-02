(function() {
	function generate() {
		// Save a reference to the table body and current row
		var $calendar = $("#calendar tbody");
		var $row = $calendar.append("<tr />");

		// Get the current month and year
		var month = window.month;
		var year = window.year;

		// Keep track of the day of the week
		var weekday = 0;

		// Need to know how many days are in each month
		var monthLengths = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];

		// Find what day of the week the first day of the month is and pad cells to
		// the left of it to make sure you start on the right day
		var first = new Date(year, month - 1, 1).getDay();
		for (; weekday < first; weekday++) {
			$row.append("<td />");
		}

		// Start to count out the days
		for (var i = 1; i <= monthLengths[month - 1]; i++) {
			// Add a table cell
			var $td = $("<td />");
			$td.append("<span>" + i + "</span>");

			// Look for any events on this day
			for (var j = 0; j < window.events.length; j++) {
				if (i == window.events[j].day) {
					$td.append("<p><a href='" + window.events[j].url + "'>" + window.events[j].title + "</a></p>");
				}
			}

			// Append the table cell to the calendar
			$row.append($td);

			// Increment the weekday counter
			weekday++;

			// Add a new row if need be
			if (weekday % 7 == 0 && i != monthLengths[month - 1]) {
				$row = $calendar.append("<tr />");
			}
		}
	}

	// Do an initial generation
	generate();

	// Load the previous month's calendar when the left arrow is clicked
	$("body").on("click", ".calendar-left, .calendar-right", function(e) {
		e.preventDefault();

		if ($(this).hasClass("calendar-left")) {
			month--;
			if (month == 0) {
				year--;
				month = 12;
			}
		}
		else {
			month++;
			if (month == 13) {
				year++;
				month = 1;
			}
		}

		$.ajax({
			url: "",
			data: {
				event_year: year,
				event_month: month
			},
			type: "get",
			success: function(html) {
				$(".ajax-content").html(html);
				generate();
			},
			error: function(err) {
				alert("Error fetching calendar events.");
			}
		});
	});
})();