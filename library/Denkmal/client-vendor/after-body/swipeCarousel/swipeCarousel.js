/**
 * requestAnimationFrame and cancel polyfill
 */
(function() {
	var lastTime = 0;
	var vendors = ['ms', 'moz', 'webkit', 'o'];
	for (var x = 0; x < vendors.length && !window.requestAnimationFrame; ++x) {
		window.requestAnimationFrame = window[vendors[x] + 'RequestAnimationFrame'];
		window.cancelAnimationFrame = window[vendors[x] + 'CancelAnimationFrame'] || window[vendors[x] + 'CancelRequestAnimationFrame'];
	}

	if (!window.requestAnimationFrame) {
		window.requestAnimationFrame = function(callback, element) {
			var currTime = new Date().getTime();
			var timeToCall = Math.max(0, 16 - (currTime - lastTime));
			var id = window.setTimeout(function() {
				callback(currTime + timeToCall);
			}, timeToCall);
			lastTime = currTime + timeToCall;
			return id;
		};
	}

	if (!window.cancelAnimationFrame) {
		window.cancelAnimationFrame = function(id) {
			clearTimeout(id);
		};
	}
}());


/**
 * super simple carousel
 * animation between panes happens with css transitions
 */
function Carousel(element) {
	var self = this;
	element = $(element);

	var $container = $(">ul", element);
	var $panes = $(">ul>li", element);

	var pane_width = 0;
	var pane_count = $panes.length;

	var current_pane = $panes.filter('.active').index();

	$(window).on("load resize orientationchange", function() {
		self.init();
	});

	this.init = function() {
		setPaneDimensions();
		self.showPane(current_pane, true);
	};

	function setPaneDimensions() {
		pane_width = element.width();

		$panes.each(function() {
			$(this).outerWidth(pane_width);
		});
		$container.width(pane_width * pane_count);
	};


	/**
	 * @param {Number} index
	 * @param {Boolean} [skipAnimation]
	 */
	this.showPane = function(index, skipAnimation) {
		// between the bounds
		index = Math.max(0, Math.min(index, pane_count - 1));
		current_pane = index;

		var offset = -((100 / pane_count) * current_pane);
		setContainerOffset(offset, !skipAnimation);

		var $currentPane = $('>ul>li:eq(' + current_pane + ')', element);
		var change = !$currentPane.hasClass('active');
		$panes.removeClass('active');
		$currentPane.addClass("active");

		if (change) {
			element.trigger('swipeCarousel-change', {
				index: current_pane,
				element: $currentPane.get(0)
			});
		}
	};

	/**
	 *
	 * @param {Number} percent
	 * @param {Boolean }animate
	 */
	function setContainerOffset(percent, animate) {
		$container.removeClass("animate");

		if (animate) {
			$container.addClass("animate");
		}

		if (Modernizr.csstransforms3d) {
			$container.css("transform", "translate3d(" + percent + "%,0,0) scale3d(1,1,1)");
		} else if (Modernizr.csstransforms) {
			$container.css("transform", "translate(" + percent + "%,0)");
		} else {
			var px = ((pane_width * pane_count) / 100) * percent;
			$container.css("left", px + "px");
		}
	}

	this.next = function() {
		return this.showPane(current_pane + 1);
	};
	this.prev = function() {
		return this.showPane(current_pane - 1);
	};


	function handleHammer(ev) {
		// disable browser scrolling
		ev.gesture.preventDefault();

		switch (ev.type) {
			case 'dragright':
			case 'dragleft':
				// stick to the finger
				var pane_offset = -(100 / pane_count) * current_pane;
				var drag_offset = ((100 / pane_width) * ev.gesture.deltaX) / pane_count;

				// slow down at the first and last pane
				if ((current_pane == 0 && ev.gesture.direction == Hammer.DIRECTION_RIGHT) || (current_pane == pane_count - 1 && ev.gesture.direction == Hammer.DIRECTION_LEFT)) {
					drag_offset *= .4;
				}

				setContainerOffset(drag_offset + pane_offset);
				break;

			case 'swipeleft':
				self.next();
				ev.gesture.stopDetect();
				break;

			case 'swiperight':
				self.prev();
				ev.gesture.stopDetect();
				break;

			case 'release':
				// more then 50% moved, navigate
				if (Math.abs(ev.gesture.deltaX) > pane_width / 2) {
					if (ev.gesture.direction == 'right') {
						self.prev();
					} else {
						self.next();
					}
				} else {
					self.showPane(current_pane);
				}
				break;
		}
	}

	element.hammer({ drag_lock_to_axis: true }).on("release dragleft dragright swipeleft swiperight", handleHammer);
}

