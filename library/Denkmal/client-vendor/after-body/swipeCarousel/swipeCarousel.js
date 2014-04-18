/**
 * super simple carousel
 */
function Carousel(element) {
  var self = this;
  element = $(element);

  var $container = $(">ul", element);
  var $panes = $(">ul>li", element);
  if (0 == $panes.length) {
    throw new Error('Cannot find carousel panes');
  }

  var pane_width = 0;
  var pane_count = $panes.length;

  var current_pane = $panes.filter('.active').index();
  if (-1 == current_pane) {
    current_pane = 0;
  }

  this.init = function() {
    setPaneDimensions();
    self.showPane(current_pane, true);
  };

  function handleKeyDown(event) {
    if (event.which === cm.keyCode.LEFT) {
      self.prev(true);
    }
    if (event.which === cm.keyCode.RIGHT) {
      self.next(true);
    }
  }

  $(window).on('load resize orientationchange', this.init);

  $(window).on('keydown', handleKeyDown);

  this.destroy = function() {
    $(window).off('load resize orientationchange', this.init);
    $(window).off('keydown', handleKeyDown);
  };

  function setPaneDimensions() {
    pane_width = element.width();

    $panes.each(function() {
      $(this).outerWidth(pane_width);
    });
    $container.width(pane_width * pane_count);
  }


  /**
   * @param {Number} index
   * @param {Boolean} [triggerChangeEvent]
   */
  this.showPane = function(index, triggerChangeEvent) {
    // between the bounds
    index = Math.max(0, Math.min(index, pane_count - 1));

    var change = current_pane != index;
    current_pane = index;

    var offset = -((100 / pane_count) * current_pane);
    setContainerOffset(offset);
    if (change) {
      onChange(triggerChangeEvent);
    }
  };

  /**
   * @param {Boolean} triggerChangeEvent
   */
  var onChange = function(triggerChangeEvent) {
    var $currentPane = $('>ul>li:eq(' + current_pane + ')', element);
    $panes.removeClass('active');
    $currentPane.addClass('active');
    if (triggerChangeEvent) {
      element.trigger('swipeCarousel-change', {
        index: current_pane,
        element: $currentPane.get(0)
      });
    }
  };

  /**
   *
   * @param {Number} percent
   */
  function setContainerOffset(percent) {
    $container.css("transform", "translate3d(" + percent + "%,0,0) scale3d(1,1,1)");
  }

  /**
   * @param {Boolean} [triggerChangeEvent]
   */
  this.next = function(triggerChangeEvent) {
    this.showPane(current_pane + 1, triggerChangeEvent);
  };

  /**
   * @param {Boolean} [triggerChangeEvent]
   */
  this.prev = function(triggerChangeEvent) {
    this.showPane(current_pane - 1, triggerChangeEvent);
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
        self.next(true);
        ev.gesture.stopDetect();
        break;

      case 'swiperight':
        self.prev(true);
        ev.gesture.stopDetect();
        break;

      case 'release':
        // more then 50% moved, navigate
        if (Math.abs(ev.gesture.deltaX) > pane_width / 2) {
          if (ev.gesture.direction == 'right') {
            self.prev(true);
          } else {
            self.next(true);
          }
        } else {
          self.showPane(current_pane, true);
        }
        break;
    }
  }

  element.hammer({ drag_lock_to_axis: true }).on("release dragleft dragright swipeleft swiperight", handleHammer);
}

