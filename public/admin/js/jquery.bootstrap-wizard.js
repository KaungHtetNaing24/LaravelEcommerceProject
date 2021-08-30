/*!
 * jQuery twitter bootstrap wizard plugin
 * Examples and documentation at: http://github.com/VinceG/twitter-bootstrap-wizard
 * version 1.4.2
 * Requires jQuery v1.3.2 or later
 * Supports Bootstrap 2.2.x, 2.3.x, 3.0
 * Dual licensed under the MIT and GPL licenses:
 * http://www.opensource.org/licenses/mit-license.php
 * http://www.gnu.org/licenses/gpl.html
 * Authors: Vadim Vincent Gabriel (http://vadimg.com), Jason Gill (www.gilluminate.com)
 */
;

/*!

 =========================================================
 * Material Dashboard - v2.1.2
 =========================================================

 * Product Page: https://www.creative-tim.com/product/material-dashboard
 * Copyright 2020 Creative Tim (http://www.creative-tim.com)

 * Designed by www.invisionapp.com Coded by www.creative-tim.com

 =========================================================

 * The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

 */

 (function() {
  isWindows = navigator.platform.indexOf('Win') > -1 ? true : false;

  if (isWindows) {
    // if we are on windows OS we activate the perfectScrollbar function
    $('.sidebar .sidebar-wrapper, .main-panel, .main').perfectScrollbar();

    $('html').addClass('perfect-scrollbar-on');
  } else {
    $('html').addClass('perfect-scrollbar-off');
  }
})();


var breakCards = true;

var searchVisible = 0;
var transparent = true;

var transparentDemo = true;
var fixedTop = false;

var mobile_menu_visible = 0,
  mobile_menu_initialized = false,
  toggle_initialized = false,
  bootstrap_nav_initialized = false;

var seq = 0,
  delays = 80,
  durations = 500;
var seq2 = 0,
  delays2 = 80,
  durations2 = 500;

$(document).ready(function() {

  $('body').bootstrapMaterialDesign();

  $sidebar = $('.sidebar');

  md.initSidebarsCheck();

  window_width = $(window).width();

  // check if there is an image set for the sidebar's background
  md.checkSidebarImage();

  //    Activate bootstrap-select
  if ($(".selectpicker").length != 0) {
    $(".selectpicker").selectpicker();
  }

  //  Activate the tooltips
  $('[rel="tooltip"]').tooltip();

  $('.form-control').on("focus", function() {
    $(this).parent('.input-group').addClass("input-group-focus");
  }).on("blur", function() {
    $(this).parent(".input-group").removeClass("input-group-focus");
  });

  // remove class has-error for checkbox validation
  $('input[type="checkbox"][required="true"], input[type="radio"][required="true"]').on('click', function() {
    if ($(this).hasClass('error')) {
      $(this).closest('div').removeClass('has-error');
    }
  });

});

$(document).on('click', '.navbar-toggler', function() {
  $toggle = $(this);

  if (mobile_menu_visible == 1) {
    $('html').removeClass('nav-open');

    $('.close-layer').remove();
    setTimeout(function() {
      $toggle.removeClass('toggled');
    }, 400);

    mobile_menu_visible = 0;
  } else {
    setTimeout(function() {
      $toggle.addClass('toggled');
    }, 430);

    var $layer = $('<div class="close-layer"></div>');

    if ($('body').find('.main-panel').length != 0) {
      $layer.appendTo(".main-panel");

    } else if (($('body').hasClass('off-canvas-sidebar'))) {
      $layer.appendTo(".wrapper-full-page");
    }

    setTimeout(function() {
      $layer.addClass('visible');
    }, 100);

    $layer.click(function() {
      $('html').removeClass('nav-open');
      mobile_menu_visible = 0;

      $layer.removeClass('visible');

      setTimeout(function() {
        $layer.remove();
        $toggle.removeClass('toggled');

      }, 400);
    });

    $('html').addClass('nav-open');
    mobile_menu_visible = 1;

  }

});

// activate collapse right menu when the windows is resized
$(window).resize(function() {
  md.initSidebarsCheck();

  // reset the seq for charts drawing animations
  seq = seq2 = 0;

  setTimeout(function() {
    md.initDashboardPageCharts();
  }, 500);
});

md = {
  misc: {
    navbar_menu_visible: 0,
    active_collapse: true,
    disabled_collapse_init: 0,
  },

  checkSidebarImage: function() {
    $sidebar = $('.sidebar');
    image_src = $sidebar.data('image');

    if (image_src !== undefined) {
      sidebar_container = '<div class="sidebar-background" style="background-image: url(' + image_src + ') "/>';
      $sidebar.append(sidebar_container);
    }
  },

  showNotification: function(from, align) {
    type = ['', 'info', 'danger', 'success', 'warning', 'rose', 'primary'];

    color = Math.floor((Math.random() * 6) + 1);

    $.notify({
      icon: "add_alert",
      message: "Welcome to <b>Material Dashboard Pro</b> - a beautiful admin panel for every web developer."

    }, {
      type: type[color],
      timer: 3000,
      placement: {
        from: from,
        align: align
      }
    });
  },

  initDocumentationCharts: function() {
    if ($('#dailySalesChart').length != 0 && $('#websiteViewsChart').length != 0) {
      /* ----------==========     Daily Sales Chart initialization For Documentation    ==========---------- */

      dataDailySalesChart = {
        labels: ['M', 'T', 'W', 'T', 'F', 'S', 'S'],
        series: [
          [12, 17, 7, 17, 23, 18, 38]
        ]
      };

      optionsDailySalesChart = {
        lineSmooth: Chartist.Interpolation.cardinal({
          tension: 0
        }),
        low: 0,
        high: 50, // creative tim: we recommend you to set the high sa the biggest value + something for a better look
        chartPadding: {
          top: 0,
          right: 0,
          bottom: 0,
          left: 0
        },
      }

      var dailySalesChart = new Chartist.Line('#dailySalesChart', dataDailySalesChart, optionsDailySalesChart);

      var animationHeaderChart = new Chartist.Line('#websiteViewsChart', dataDailySalesChart, optionsDailySalesChart);
    }
  },


  initFormExtendedDatetimepickers: function() {
    $('.datetimepicker').datetimepicker({
      icons: {
        time: "fa fa-clock-o",
        date: "fa fa-calendar",
        up: "fa fa-chevron-up",
        down: "fa fa-chevron-down",
        previous: 'fa fa-chevron-left',
        next: 'fa fa-chevron-right',
        today: 'fa fa-screenshot',
        clear: 'fa fa-trash',
        close: 'fa fa-remove'
      }
    });

    $('.datepicker').datetimepicker({
      format: 'MM/DD/YYYY',
      icons: {
        time: "fa fa-clock-o",
        date: "fa fa-calendar",
        up: "fa fa-chevron-up",
        down: "fa fa-chevron-down",
        previous: 'fa fa-chevron-left',
        next: 'fa fa-chevron-right',
        today: 'fa fa-screenshot',
        clear: 'fa fa-trash',
        close: 'fa fa-remove'
      }
    });

    $('.timepicker').datetimepicker({
      //          format: 'H:mm',    // use this format if you want the 24hours timepicker
      format: 'h:mm A', //use this format if you want the 12hours timpiecker with AM/PM toggle
      icons: {
        time: "fa fa-clock-o",
        date: "fa fa-calendar",
        up: "fa fa-chevron-up",
        down: "fa fa-chevron-down",
        previous: 'fa fa-chevron-left',
        next: 'fa fa-chevron-right',
        today: 'fa fa-screenshot',
        clear: 'fa fa-trash',
        close: 'fa fa-remove'

      }
    });
  },


  initSliders: function() {
    // Sliders for demo purpose
    var slider = document.getElementById('sliderRegular');

    noUiSlider.create(slider, {
      start: 40,
      connect: [true, false],
      range: {
        min: 0,
        max: 100
      }
    });

    var slider2 = document.getElementById('sliderDouble');

    noUiSlider.create(slider2, {
      start: [20, 60],
      connect: true,
      range: {
        min: 0,
        max: 100
      }
    });
  },

  initSidebarsCheck: function() {
    if ($(window).width() <= 991) {
      if ($sidebar.length != 0) {
        md.initRightMenu();
      }
    }
  },

  checkFullPageBackgroundImage: function() {
    $page = $('.full-page');
    image_src = $page.data('image');

    if (image_src !== undefined) {
      image_container = '<div class="full-page-background" style="background-image: url(' + image_src + ') "/>'
      $page.append(image_container);
    }
  },

  initDashboardPageCharts: function() {

    if ($('#dailySalesChart').length != 0 || $('#completedTasksChart').length != 0 || $('#websiteViewsChart').length != 0) {
      /* ----------==========     Daily Sales Chart initialization    ==========---------- */

      dataDailySalesChart = {
        labels: ['M', 'T', 'W', 'T', 'F', 'S', 'S'],
        series: [
          [12, 17, 7, 17, 23, 18, 38]
        ]
      };

      optionsDailySalesChart = {
        lineSmooth: Chartist.Interpolation.cardinal({
          tension: 0
        }),
        low: 0,
        high: 50, // creative tim: we recommend you to set the high sa the biggest value + something for a better look
        chartPadding: {
          top: 0,
          right: 0,
          bottom: 0,
          left: 0
        },
      }

      var dailySalesChart = new Chartist.Line('#dailySalesChart', dataDailySalesChart, optionsDailySalesChart);

      md.startAnimationForLineChart(dailySalesChart);



      /* ----------==========     Completed Tasks Chart initialization    ==========---------- */

      dataCompletedTasksChart = {
        labels: ['12p', '3p', '6p', '9p', '12p', '3a', '6a', '9a'],
        series: [
          [230, 750, 450, 300, 280, 240, 200, 190]
        ]
      };

      optionsCompletedTasksChart = {
        lineSmooth: Chartist.Interpolation.cardinal({
          tension: 0
        }),
        low: 0,
        high: 1000, // creative tim: we recommend you to set the high sa the biggest value + something for a better look
        chartPadding: {
          top: 0,
          right: 0,
          bottom: 0,
          left: 0
        }
      }

      var completedTasksChart = new Chartist.Line('#completedTasksChart', dataCompletedTasksChart, optionsCompletedTasksChart);

      // start animation for the Completed Tasks Chart - Line Chart
      md.startAnimationForLineChart(completedTasksChart);


      /* ----------==========     Emails Subscription Chart initialization    ==========---------- */

      var dataWebsiteViewsChart = {
        labels: ['J', 'F', 'M', 'A', 'M', 'J', 'J', 'A', 'S', 'O', 'N', 'D'],
        series: [
          [542, 443, 320, 780, 553, 453, 326, 434, 568, 610, 756, 895]

        ]
      };
      var optionsWebsiteViewsChart = {
        axisX: {
          showGrid: false
        },
        low: 0,
        high: 1000,
        chartPadding: {
          top: 0,
          right: 5,
          bottom: 0,
          left: 0
        }
      };
      var responsiveOptions = [
        ['screen and (max-width: 640px)', {
          seriesBarDistance: 5,
          axisX: {
            labelInterpolationFnc: function(value) {
              return value[0];
            }
          }
        }]
      ];
      var websiteViewsChart = Chartist.Bar('#websiteViewsChart', dataWebsiteViewsChart, optionsWebsiteViewsChart, responsiveOptions);

      //start animation for the Emails Subscription Chart
      md.startAnimationForBarChart(websiteViewsChart);
    }
  },

  initMinimizeSidebar: function() {

    $('#minimizeSidebar').click(function() {
      var $btn = $(this);

      if (md.misc.sidebar_mini_active == true) {
        $('body').removeClass('sidebar-mini');
        md.misc.sidebar_mini_active = false;
      } else {
        $('body').addClass('sidebar-mini');
        md.misc.sidebar_mini_active = true;
      }

      // we simulate the window Resize so the charts will get updated in realtime.
      var simulateWindowResize = setInterval(function() {
        window.dispatchEvent(new Event('resize'));
      }, 180);

      // we stop the simulation of Window Resize after the animations are completed
      setTimeout(function() {
        clearInterval(simulateWindowResize);
      }, 1000);
    });
  },

  checkScrollForTransparentNavbar: debounce(function() {
    if ($(document).scrollTop() > 260) {
      if (transparent) {
        transparent = false;
        $('.navbar-color-on-scroll').removeClass('navbar-transparent');
      }
    } else {
      if (!transparent) {
        transparent = true;
        $('.navbar-color-on-scroll').addClass('navbar-transparent');
      }
    }
  }, 17),


  initRightMenu: debounce(function() {
    $sidebar_wrapper = $('.sidebar-wrapper');

    if (!mobile_menu_initialized) {
      $navbar = $('nav').find('.navbar-collapse').children('.navbar-nav');

      mobile_menu_content = '';

      nav_content = $navbar.html();

      nav_content = '<ul class="nav navbar-nav nav-mobile-menu">' + nav_content + '</ul>';

      navbar_form = $('nav').find('.navbar-form').get(0).outerHTML;

      $sidebar_nav = $sidebar_wrapper.find(' > .nav');

      // insert the navbar form before the sidebar list
      $nav_content = $(nav_content);
      $navbar_form = $(navbar_form);
      $nav_content.insertBefore($sidebar_nav);
      $navbar_form.insertBefore($nav_content);

      $(".sidebar-wrapper .dropdown .dropdown-menu > li > a").click(function(event) {
        event.stopPropagation();

      });

      // simulate resize so all the charts/maps will be redrawn
      window.dispatchEvent(new Event('resize'));

      mobile_menu_initialized = true;
    } else {
      if ($(window).width() > 991) {
        // reset all the additions that we made for the sidebar wrapper only if the screen is bigger than 991px
        $sidebar_wrapper.find('.navbar-form').remove();
        $sidebar_wrapper.find('.nav-mobile-menu').remove();

        mobile_menu_initialized = false;
      }
    }
  }, 200),

  startAnimationForLineChart: function(chart) {

    chart.on('draw', function(data) {
      if (data.type === 'line' || data.type === 'area') {
        data.element.animate({
          d: {
            begin: 600,
            dur: 700,
            from: data.path.clone().scale(1, 0).translate(0, data.chartRect.height()).stringify(),
            to: data.path.clone().stringify(),
            easing: Chartist.Svg.Easing.easeOutQuint
          }
        });
      } else if (data.type === 'point') {
        seq++;
        data.element.animate({
          opacity: {
            begin: seq * delays,
            dur: durations,
            from: 0,
            to: 1,
            easing: 'ease'
          }
        });
      }
    });

    seq = 0;
  },
  startAnimationForBarChart: function(chart) {

    chart.on('draw', function(data) {
      if (data.type === 'bar') {
        seq2++;
        data.element.animate({
          opacity: {
            begin: seq2 * delays2,
            dur: durations2,
            from: 0,
            to: 1,
            easing: 'ease'
          }
        });
      }
    });

    seq2 = 0;
  },


  initFullCalendar: function() {
    $calendar = $('#fullCalendar');

    today = new Date();
    y = today.getFullYear();
    m = today.getMonth();
    d = today.getDate();

    $calendar.fullCalendar({
      viewRender: function(view, element) {
        // We make sure that we activate the perfect scrollbar when the view isn't on Month
        if (view.name != 'month') {
          $(element).find('.fc-scroller').perfectScrollbar();
        }
      },
      header: {
        left: 'title',
        center: 'month,agendaWeek,agendaDay',
        right: 'prev,next,today'
      },
      defaultDate: today,
      selectable: true,
      selectHelper: true,
      views: {
        month: { // name of view
          titleFormat: 'MMMM YYYY'
          // other view-specific options here
        },
        week: {
          titleFormat: " MMMM D YYYY"
        },
        day: {
          titleFormat: 'D MMM, YYYY'
        }
      },

      select: function(start, end) {

        // on select we show the Sweet Alert modal with an input
        swal({
            title: 'Create an Event',
            html: '<div class="form-group">' +
              '<input class="form-control" placeholder="Event Title" id="input-field">' +
              '</div>',
            showCancelButton: true,
            confirmButtonClass: 'btn btn-success',
            cancelButtonClass: 'btn btn-danger',
            buttonsStyling: false
          }).then(function(result) {

            var eventData;
            event_title = $('#input-field').val();

            if (event_title) {
              eventData = {
                title: event_title,
                start: start,
                end: end
              };
              $calendar.fullCalendar('renderEvent', eventData, true); // stick? = true
            }

            $calendar.fullCalendar('unselect');

          })
          .catch(swal.noop);
      },
      editable: true,
      eventLimit: true, // allow "more" link when too many events


      // color classes: [ event-blue | event-azure | event-green | event-orange | event-red ]
      events: [{
          title: 'All Day Event',
          start: new Date(y, m, 1),
          className: 'event-default'
        },
        {
          id: 999,
          title: 'Repeating Event',
          start: new Date(y, m, d - 4, 6, 0),
          allDay: false,
          className: 'event-rose'
        },
        {
          id: 999,
          title: 'Repeating Event',
          start: new Date(y, m, d + 3, 6, 0),
          allDay: false,
          className: 'event-rose'
        },
        {
          title: 'Meeting',
          start: new Date(y, m, d - 1, 10, 30),
          allDay: false,
          className: 'event-green'
        },
        {
          title: 'Lunch',
          start: new Date(y, m, d + 7, 12, 0),
          end: new Date(y, m, d + 7, 14, 0),
          allDay: false,
          className: 'event-red'
        },
        {
          title: 'Md-pro Launch',
          start: new Date(y, m, d - 2, 12, 0),
          allDay: true,
          className: 'event-azure'
        },
        {
          title: 'Birthday Party',
          start: new Date(y, m, d + 1, 19, 0),
          end: new Date(y, m, d + 1, 22, 30),
          allDay: false,
          className: 'event-azure'
        },
        {
          title: 'Click for Creative Tim',
          start: new Date(y, m, 21),
          end: new Date(y, m, 22),
          url: 'http://www.creative-tim.com/',
          className: 'event-orange'
        },
        {
          title: 'Click for Google',
          start: new Date(y, m, 21),
          end: new Date(y, m, 22),
          url: 'http://www.creative-tim.com/',
          className: 'event-orange'
        }
      ]
    });
  },

  initVectorMap: function() {
    var mapData = {
      "AU": 760,
      "BR": 550,
      "CA": 120,
      "DE": 1300,
      "FR": 540,
      "GB": 690,
      "GE": 200,
      "IN": 200,
      "RO": 600,
      "RU": 300,
      "US": 2920,
    };

    $('#worldMap').vectorMap({
      map: 'world_mill_en',
      backgroundColor: "transparent",
      zoomOnScroll: false,
      regionStyle: {
        initial: {
          fill: '#e4e4e4',
          "fill-opacity": 0.9,
          stroke: 'none',
          "stroke-width": 0,
          "stroke-opacity": 0
        }
      },

      series: {
        regions: [{
          values: mapData,
          scale: ["#AAAAAA", "#444444"],
          normalizeFunction: 'polynomial'
        }]
      },
    });
  }
}

// Returns a function, that, as long as it continues to be invoked, will not
// be triggered. The function will be called after it stops being called for
// N milliseconds. If `immediate` is passed, trigger the function on the
// leading edge, instead of the trailing.

function debounce(func, wait, immediate) {
  var timeout;
  return function() {
    var context = this,
      args = arguments;
    clearTimeout(timeout);
    timeout = setTimeout(function() {
      timeout = null;
      if (!immediate) func.apply(context, args);
    }, wait);
    if (immediate && !timeout) func.apply(context, args);
  };
};
(function($) {
  var bootstrapWizardCreate = function(element, options) {
    var element = $(element);
    var obj = this;

    // selector skips any 'li' elements that do not contain a child with a tab data-toggle
    var baseItemSelector = 'li:has([data-toggle="tab"])';
    var historyStack = [];

    // Merge options with defaults
    var $settings = $.extend({}, $.fn.bootstrapWizard.defaults, options);
    var $activeTab = null;
    var $navigation = null;

    this.rebindClick = function(selector, fn) {
      selector.unbind('click', fn).bind('click', fn);
    }

    this.fixNavigationButtons = function() {
      // Get the current active tab
      if (!$activeTab.length) {
        // Select first one
        $navigation.find('a:first').tab('show');
        $activeTab = $navigation.find(baseItemSelector + ':first');
      }

      // See if we're currently in the first/last then disable the previous and last buttons
      $($settings.previousSelector, element).toggleClass('disabled', (obj.firstIndex() >= obj.currentIndex()));
      $($settings.nextSelector, element).toggleClass('disabled', (obj.currentIndex() >= obj.navigationLength()));
      $($settings.nextSelector, element).toggleClass('hidden', (obj.currentIndex() >= obj.navigationLength() && $($settings.finishSelector, element).length > 0));
      $($settings.lastSelector, element).toggleClass('hidden', (obj.currentIndex() >= obj.navigationLength() && $($settings.finishSelector, element).length > 0));
      $($settings.finishSelector, element).toggleClass('hidden', (obj.currentIndex() < obj.navigationLength()));
      $($settings.backSelector, element).toggleClass('disabled', (historyStack.length == 0));
      $($settings.backSelector, element).toggleClass('hidden', (obj.currentIndex() >= obj.navigationLength() && $($settings.finishSelector, element).length > 0));

      // We are unbinding and rebinding to ensure single firing and no double-click errors
      obj.rebindClick($($settings.nextSelector, element), obj.next);
      obj.rebindClick($($settings.previousSelector, element), obj.previous);
      obj.rebindClick($($settings.lastSelector, element), obj.last);
      obj.rebindClick($($settings.firstSelector, element), obj.first);
      obj.rebindClick($($settings.finishSelector, element), obj.finish);
      obj.rebindClick($($settings.backSelector, element), obj.back);

      if ($settings.onTabShow && typeof $settings.onTabShow === 'function' && $settings.onTabShow($activeTab, $navigation, obj.currentIndex()) === false) {
        return false;
      }
    };

    this.next = function(e) {
      // If we clicked the last then dont activate this
      if (element.hasClass('last')) {
        return false;
      }

      if ($settings.onNext && typeof $settings.onNext === 'function' && $settings.onNext($activeTab, $navigation, obj.nextIndex()) === false) {
        return false;
      }

      var formerIndex = obj.currentIndex();
      var $index = obj.nextIndex();

      // Did we click the last button
      if ($index > obj.navigationLength()) {} else {
        historyStack.push(formerIndex);
        $navigation.find(baseItemSelector + ($settings.withVisible ? ':visible' : '') + ':eq(' + $index + ') a').tab('show');
      }
    };

    this.previous = function(e) {
      // If we clicked the first then dont activate this
      if (element.hasClass('first')) {
        return false;
      }

      if ($settings.onPrevious && typeof $settings.onPrevious === 'function' && $settings.onPrevious($activeTab, $navigation, obj.previousIndex()) === false) {
        return false;
      }

      var formerIndex = obj.currentIndex();
      var $index = obj.previousIndex();

      if ($index < 0) {} else {
        historyStack.push(formerIndex);
        $navigation.find(baseItemSelector + ($settings.withVisible ? ':visible' : '') + ':eq(' + $index + ') a').tab('show');
      }
    };

    this.first = function(e) {
      if ($settings.onFirst && typeof $settings.onFirst === 'function' && $settings.onFirst($activeTab, $navigation, obj.firstIndex()) === false) {
        return false;
      }

      // If the element is disabled then we won't do anything
      if (element.hasClass('disabled')) {
        return false;
      }


      historyStack.push(obj.currentIndex());
      $navigation.find(baseItemSelector + ':eq(0) a').tab('show');
    };

    this.last = function(e) {
      if ($settings.onLast && typeof $settings.onLast === 'function' && $settings.onLast($activeTab, $navigation, obj.lastIndex()) === false) {
        return false;
      }

      // If the element is disabled then we won't do anything
      if (element.hasClass('disabled')) {
        return false;
      }

      historyStack.push(obj.currentIndex());
      $navigation.find(baseItemSelector + ':eq(' + obj.navigationLength() + ') a').tab('show');
    };

    this.finish = function(e) {
      if ($settings.onFinish && typeof $settings.onFinish === 'function') {
        $settings.onFinish($activeTab, $navigation, obj.lastIndex());
      }
    };

    this.back = function() {
      if (historyStack.length == 0) {
        return null;
      }

      var formerIndex = historyStack.pop();
      if ($settings.onBack && typeof $settings.onBack === 'function' && $settings.onBack($activeTab, $navigation, formerIndex) === false) {
        historyStack.push(formerIndex);
        return false;
      }

      element.find(baseItemSelector + ':eq(' + formerIndex + ') a').tab('show');
    };

    this.currentIndex = function() {
      return $navigation.find(baseItemSelector + ($settings.withVisible ? ':visible' : '')).index($activeTab);
    };

    this.firstIndex = function() {
      return 0;
    };

    this.lastIndex = function() {
      return obj.navigationLength();
    };

    this.getIndex = function(e) {
      return $navigation.find(baseItemSelector + ($settings.withVisible ? ':visible' : '')).index(e);
    };

    this.nextIndex = function() {
      var nextIndexCandidate = this.currentIndex();
      var nextTabCandidate = null;
      do {
        nextIndexCandidate++;
        nextTabCandidate = $navigation.find(baseItemSelector + ($settings.withVisible ? ':visible' : '') + ":eq(" + nextIndexCandidate + ")");
      } while ((nextTabCandidate) && (nextTabCandidate.hasClass("disabled")));
      return nextIndexCandidate;
    };
    this.previousIndex = function() {
      var prevIndexCandidate = this.currentIndex();
      var prevTabCandidate = null;
      do {
        prevIndexCandidate--;
        prevTabCandidate = $navigation.find(baseItemSelector + ($settings.withVisible ? ':visible' : '') + ":eq(" + prevIndexCandidate + ")");
      } while ((prevTabCandidate) && (prevTabCandidate.hasClass("disabled")));
      return prevIndexCandidate;
    };
    this.navigationLength = function() {
      return $navigation.find(baseItemSelector + ($settings.withVisible ? ':visible' : '')).length - 1;
    };
    this.activeTab = function() {
      return $activeTab;
    };
    this.nextTab = function() {
      return $navigation.find(baseItemSelector + ':eq(' + (obj.currentIndex() + 1) + ')').length ? $navigation.find(baseItemSelector + ':eq(' + (obj.currentIndex() + 1) + ')') : null;
    };
    this.previousTab = function() {
      if (obj.currentIndex() <= 0) {
        return null;
      }
      return $navigation.find(baseItemSelector + ':eq(' + parseInt(obj.currentIndex() - 1) + ')');
    };
    this.show = function(index) {
      var tabToShow = isNaN(index) ?
        element.find(baseItemSelector + ' a[href="#' + index + '"]') :
        element.find(baseItemSelector + ':eq(' + index + ') a');
      if (tabToShow.length > 0) {
        historyStack.push(obj.currentIndex());
        tabToShow.tab('show');
      }
    };
    this.disable = function(index) {
      $navigation.find(baseItemSelector + ':eq(' + index + ')').addClass('disabled');
    };
    this.enable = function(index) {
      $navigation.find(baseItemSelector + ':eq(' + index + ')').removeClass('disabled');
    };
    this.hide = function(index) {
      $navigation.find(baseItemSelector + ':eq(' + index + ')').hide();
    };
    this.display = function(index) {
      $navigation.find(baseItemSelector + ':eq(' + index + ')').show();
    };
    this.remove = function(args) {
      var $index = args[0];
      var $removeTabPane = typeof args[1] != 'undefined' ? args[1] : false;
      var $item = $navigation.find(baseItemSelector + ':eq(' + $index + ')');

      // Remove the tab pane first if needed
      if ($removeTabPane) {
        var $href = $item.find('a').attr('href');
        $($href).remove();
      }

      // Remove menu item
      $item.remove();
    };

    var innerTabClick = function(e) {
      // Get the index of the clicked tab
      var $ul = $navigation.find(baseItemSelector);
      var clickedIndex = $ul.index($(e.currentTarget).parent(baseItemSelector));
      var $clickedTab = $($ul[clickedIndex]);
      if ($settings.onTabClick && typeof $settings.onTabClick === 'function' && $settings.onTabClick($activeTab, $navigation, obj.currentIndex(), clickedIndex, $clickedTab) === false) {
        return false;
      }
    };

    var innerTabShown = function(e) {
      var $element = $(e.target).parent();
      var nextTab = $navigation.find(baseItemSelector).index($element);

      // If it's disabled then do not change
      if ($element.hasClass('disabled')) {
        return false;
      }

      if ($settings.onTabChange && typeof $settings.onTabChange === 'function' && $settings.onTabChange($activeTab, $navigation, obj.currentIndex(), nextTab) === false) {
        return false;
      }

      $activeTab = $element; // activated tab
      obj.fixNavigationButtons();
    };

    this.resetWizard = function() {

      // remove the existing handlers
      $('a[data-toggle="tab"]', $navigation).off('click', innerTabClick);
      $('a[data-toggle="tab"]', $navigation).off('show show.bs.tab', innerTabShown);

      // reset elements based on current state of the DOM
      $navigation = element.find('ul:first', element);
      $activeTab = $navigation.find(baseItemSelector + '.active', element);

      // re-add handlers
      $('a[data-toggle="tab"]', $navigation).on('click', innerTabClick);
      $('a[data-toggle="tab"]', $navigation).on('show show.bs.tab', innerTabShown);

      obj.fixNavigationButtons();
    };

    $navigation = element.find('ul:first', element);
    $activeTab = $navigation.find(baseItemSelector + '.active', element);

    if (!$navigation.hasClass($settings.tabClass)) {
      $navigation.addClass($settings.tabClass);
    }

    // Load onInit
    if ($settings.onInit && typeof $settings.onInit === 'function') {
      $settings.onInit($activeTab, $navigation, 0);
    }

    // Load onShow
    if ($settings.onShow && typeof $settings.onShow === 'function') {
      $settings.onShow($activeTab, $navigation, obj.nextIndex());
    }

    $('a[data-toggle="tab"]', $navigation).on('click', innerTabClick);

    // attach to both show and show.bs.tab to support Bootstrap versions 2.3.2 and 3.0.0
    $('a[data-toggle="tab"]', $navigation).on('show show.bs.tab', innerTabShown);
  };
  $.fn.bootstrapWizard = function(options) {
    //expose methods
    if (typeof options == 'string') {
      var args = Array.prototype.slice.call(arguments, 1)
      if (args.length === 1) {
        args.toString();
      }
      return this.data('bootstrapWizard')[options](args);
    }
    return this.each(function(index) {
      var element = $(this);
      // Return early if this element already has a plugin instance
      if (element.data('bootstrapWizard')) return;
      // pass options to plugin constructor
      var wizard = new bootstrapWizardCreate(element, options);
      // Store plugin object in this element's data
      element.data('bootstrapWizard', wizard);
      // and then trigger initial change
      wizard.fixNavigationButtons();
    });
  };

  // expose options
  $.fn.bootstrapWizard.defaults = {
    withVisible: true,
    tabClass: 'nav nav-pills',
    nextSelector: '.card-wizard .nav-item.next',
    previousSelector: '.card-wizard .nav-item.previous',
    firstSelector: '.card-wizard .nav-item.first',
    lastSelector: '.card-wizard .nav-item.last',
    finishSelector: '.card-wizard .nav-item.finish',
    backSelector: '.card-wizard .nav-item.back',
    onShow: null,
    onInit: null,
    onNext: null,
    onPrevious: null,
    onLast: null,
    onFirst: null,
    onFinish: null,
    onBack: null,
    onTabChange: null,
    onTabClick: null,
    onTabShow: null
  };

})(jQuery);