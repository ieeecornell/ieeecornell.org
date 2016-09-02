(function() {
	// Set the height of the image gallery
	var gallery = $(".gallery");
	var sidebar = $(".info-sessions");
	gallery.css("height", 400 + "px");

	// Get the widths of the gallery items
	var galleryContainer = $(".gallery-items");
	var galleryItems = $(".gallery-item");
	
	var itemWidth = gallery.width();
	var numItems = galleryItems.length;

	galleryItems.css("width", itemWidth + "px");
	galleryContainer.css("width", (numItems * itemWidth) + "px");

	// Make the gallery scroll through images
	var currentItem = 0;
	function scrollGallery() {
		// Move the container to the next position
		galleryContainer.css("left", -(currentItem * itemWidth) + "px");

		// Calculate the next position
		currentItem++;
		if (currentItem >= numItems) currentItem = 0;

		// Transition after a delay
		setTimeout(scrollGallery, 4000);
	}
	scrollGallery();
})();