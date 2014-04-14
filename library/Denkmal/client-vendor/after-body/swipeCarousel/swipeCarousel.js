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

  $(window).on('load resize orientationchange', this.init);

  this.destroy = function() {
    $(window).off('load resize orientationchange', this.init);
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
   * @param {Boolean} [skipAnimation]
   */
  this.showPane = function(index, skipAnimation) {
    // between the bounds
    index = Math.max(0, Math.min(index, pane_count - 1));

    var change = current_pane != index;
    current_pane = index;

    var offset = -((100 / pane_count) * current_pane);
    setContainerOffset(offset);
    if (change) {
      onChange(skipAnimation);
    }
  };

  /**
   * @param {Boolean} skipAnimation
   */
  var onChange = function(skipAnimation) {
    var $currentPane = $('>ul>li:eq(' + current_pane + ')', element);
    $panes.removeClass('active');
    $currentPane.addClass('active');
    element.trigger('swipeCarousel-change', {
      index: current_pane,
      element: $currentPane.get(0),
      skipAnimation: skipAnimation
    });
  };

  /**
   *
   * @param {Number} percent
   */
  function setContainerOffset(percent) {
    $container.css("transform", "translate3d(" + percent + "%,0,0) scale3d(1,1,1)");
  }

  /**
   * @param {Boolean} [skipAnimation]
   */
  this.next = function(skipAnimation) {
    this.showPane(current_pane + 1, skipAnimation);
  };

  /**
   * @param {Boolean} [skipAnimation]
   */
  this.prev = function(skipAnimation) {
    this.showPane(current_pane - 1, skipAnimation);
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

