(function() {
	var $ = function(query) {
		return new Tiny(query);
	};

	var Tiny = function(query) {
		var els = document.querySelectorAll(query);
		for (var i = 0; i < els.length; i++) {
			this[i] = els[i];
		}
		this.length = els.length;
	};

	Tiny.prototype = {
		css: function(attr, value) {
			for (var i = 0; i < this.length; i++) {
				this[i].style[attr] = value;
			}
			return this;
		},

		width: function() {
			return this.length > 0 ? this[0].clientWidth : null;
		},

		height: function() {
			return this.length > 0 ? this[0].clientHeight : null;
		}
	};

	window.$ = $;
})();