/*=========================================================================================
  File Name: app.js
  Description: Template related app JS.
  ----------------------------------------------------------------------------------------
  Item Name: Vuexy  - Vuejs, HTML & Laravel Admin Dashboard Template
  Author: Pixinvent
  Author URL: hhttp://www.themeforest.net/user/pixinvent
==========================================================================================*/
window.colors = {
  solid: {
    primary: '#7367F0',
    secondary: '#82868b',
    success: '#28C76F',
    info: '#00cfe8',
    warning: '#FF9F43',
    danger: '#EA5455',
    dark: '#4b4b4b',
    black: '#000',
    white: '#fff',
    body: '#f8f8f8'
  },
  light: {
    primary: '#7367F01a',
    secondary: '#82868b1a',
    success: '#28C76F1a',
    info: '#00cfe81a',
    warning: '#FF9F431a',
    danger: '#EA54551a',
    dark: '#4b4b4b1a'
  }
};
(function (window, document, $) {
  'use strict';
  var $html = $('html');
  var $body = $('body');
  var $textcolor = '#4e5154';
  var assetPath = '../../../app-assets/';

  if ($('body').attr('data-framework') === 'laravel') {
    assetPath = $('body').attr('data-asset-path');
  }

  // to remove sm control classes from datatables
  if ($.fn.dataTable) {
    $.extend($.fn.dataTable.ext.classes, {
      sFilterInput: 'form-control',
      sLengthSelect: 'form-select'
    });
  }

  $(window).on('load', function () {
    var rtl;
    var compactMenu = false;

    if ($body.hasClass('menu-collapsed') || localStorage.getItem('menuCollapsed') === 'true') {
      compactMenu = true;
    }

    if ($('html').data('textdirection') == 'rtl') {
      rtl = true;
    }

    setTimeout(function () {
      $html.removeClass('loading').addClass('loaded');
    }, 1200);

    $.app.menu.init(compactMenu);

    // Navigation configurations
    var config = {
      speed: 300 // set speed to expand / collapse menu
    };
    if ($.app.nav.initialized === false) {
      $.app.nav.init(config);
    }

    Unison.on('change', function (bp) {
      $.app.menu.change(compactMenu);
    });

    // Tooltip Initialization
    // $('[data-bs-toggle="tooltip"]').tooltip({
    //   container: 'body'
    // });
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    // Collapsible Card
    $('a[data-action="collapse"]').on('click', function (e) {
      e.preventDefault();
      $(this).closest('.card').children('.card-content').collapse('toggle');
      $(this).closest('.card').find('[data-action="collapse"]').toggleClass('rotate');
    });

    // Cart dropdown touchspin
    if ($('.touchspin-cart').length > 0) {
      $('.touchspin-cart').TouchSpin({
        buttondown_class: 'btn btn-primary',
        buttonup_class: 'btn btn-primary',
        buttondown_txt: feather.icons['minus'].toSvg(),
        buttonup_txt: feather.icons['plus'].toSvg()
      });
    }

    // Do not close cart or notification dropdown on click of the items
    $('.dropdown-notification .dropdown-menu, .dropdown-cart .dropdown-menu').on('click', function (e) {
      e.stopPropagation();
    });

    //  Notifications & messages scrollable
    $('.scrollable-container').each(function () {
      var scrollable_container = new PerfectScrollbar($(this)[0], {
        wheelPropagation: false
      });
    });

    // Reload Card
    $('a[data-action="reload"]').on('click', function () {
      var block_ele = $(this).closest('.card');
      var reloadActionOverlay;
      if ($html.hasClass('dark-layout')) {
        var reloadActionOverlay = '#10163a';
      } else {
        var reloadActionOverlay = '#fff';
      }
      // Block Element
      block_ele.block({
        message: feather.icons['refresh-cw'].toSvg({ class: 'font-medium-1 spinner text-primary' }),
        timeout: 2000, //unblock after 2 seconds
        overlayCSS: {
          backgroundColor: reloadActionOverlay,
          cursor: 'wait'
        },
        css: {
          border: 0,
          padding: 0,
          backgroundColor: 'none'
        }
      });
    });

    // Close Card
    $('a[data-action="close"]').on('click', function () {
      $(this).closest('.card').removeClass().slideUp('fast');
    });

    $('.card .heading-elements a[data-action="collapse"]').on('click', function () {
      var $this = $(this),
        card = $this.closest('.card');
      var cardHeight;

      if (parseInt(card[0].style.height, 10) > 0) {
        cardHeight = card.css('height');
        card.css('height', '').attr('data-height', cardHeight);
      } else {
        if (card.data('height')) {
          cardHeight = card.data('height');
          card.css('height', cardHeight).attr('data-height', '');
        }
      }
    });

    // Add disabled class to input group when input is disabled
    $('input:disabled, textarea:disabled').closest('.input-group').addClass('disabled');

    // Add sidebar group active class to active menu
    $('.main-menu-content').find('li.active').parents('li').addClass('sidebar-group-active');

    // Add open class to parent list item if subitem is active except compact menu
    var menuType = $body.data('menu');
    if (menuType != 'horizontal-menu' && compactMenu === false) {
      $('.main-menu-content').find('li.active').parents('li').addClass('open');
    }
    if (menuType == 'horizontal-menu') {
      $('.main-menu-content').find('li.active').parents('li:not(.nav-item)').addClass('open');
      $('.main-menu-content').find('li.active').closest('li.nav-item').addClass('sidebar-group-active open');
      // $(".main-menu-content")
      //   .find("li.active")
      //   .parents("li")
      //   .addClass("active");
    }

    //  Dynamic height for the chartjs div for the chart animations to work
    var chartjsDiv = $('.chartjs'),
      canvasHeight = chartjsDiv.children('canvas').attr('height'),
      mainMenu = $('.main-menu');
    chartjsDiv.css('height', canvasHeight);

    if ($body.hasClass('boxed-layout')) {
      if ($body.hasClass('vertical-overlay-menu')) {
        var menuWidth = mainMenu.width();
        var contentPosition = $('.app-content').position().left;
        var menuPositionAdjust = contentPosition - menuWidth;
        if ($body.hasClass('menu-flipped')) {
          mainMenu.css('right', menuPositionAdjust + 'px');
        } else {
          mainMenu.css('left', menuPositionAdjust + 'px');
        }
      }
    }

    /* Text Area Counter Set Start */

    $('.char-textarea').on('keyup', function (event) {
      checkTextAreaMaxLength(this, event);
      // to later change text color in dark layout
      $(this).addClass('active');
    });

    /*
    Checks the MaxLength of the Textarea
    -----------------------------------------------------
    @prerequisite:  textBox = textarea dom element
            e = textarea event
                    length = Max length of characters
    */
    function checkTextAreaMaxLength(textBox, e) {
      var maxLength = parseInt($(textBox).data('length')),
        counterValue = $('.textarea-counter-value'),
        charTextarea = $('.char-textarea');

      if (!checkSpecialKeys(e)) {
        if (textBox.value.length < maxLength - 1) textBox.value = textBox.value.substring(0, maxLength);
      }
      $('.char-count').html(textBox.value.length);

      if (textBox.value.length > maxLength) {
        counterValue.css('background-color', window.colors.solid.danger);
        charTextarea.css('color', window.colors.solid.danger);
        // to change text color after limit is maxedout out
        charTextarea.addClass('max-limit');
      } else {
        counterValue.css('background-color', window.colors.solid.primary);
        charTextarea.css('color', $textcolor);
        charTextarea.removeClass('max-limit');
      }

      return true;
    }
    /*
    Checks if the keyCode pressed is inside special chars
    -------------------------------------------------------
    @prerequisite:  e = e.keyCode object for the key pressed
    */
    function checkSpecialKeys(e) {
      if (e.keyCode != 8 && e.keyCode != 46 && e.keyCode != 37 && e.keyCode != 38 && e.keyCode != 39 && e.keyCode != 40)
        return false;
      else return true;
    }

    $('.content-overlay').on('click', function () {
      $('.search-list').removeClass('show');
      var searchInput = $('.search-input-close').closest('.search-input');
      if (searchInput.hasClass('open')) {
        searchInput.removeClass('open');
        searchInputInputfield.val('');
        searchInputInputfield.blur();
        searchList.removeClass('show');
      }

      $('.app-content').removeClass('show-overlay');
      $('.bookmark-wrapper .bookmark-input').removeClass('show');
    });

    // To show shadow in main menu when menu scrolls
    var container = document.getElementsByClassName('main-menu-content');
    if (container.length > 0) {
      container[0].addEventListener('ps-scroll-y', function () {
        if ($(this).find('.ps__thumb-y').position().top > 0) {
          $('.shadow-bottom').css('display', 'block');
        } else {
          $('.shadow-bottom').css('display', 'none');
        }
      });
    }
  });

  // Hide overlay menu on content overlay click on small screens
  $(document).on('click', '.sidenav-overlay', function (e) {
    // Hide menu
    $.app.menu.hide();
    return false;
  });

  // Execute below code only if we find hammer js for touch swipe feature on small screen
  if (typeof Hammer !== 'undefined') {
    var rtl;
    if ($('html').data('textdirection') == 'rtl') {
      rtl = true;
    }

    // Swipe menu gesture
    var swipeInElement = document.querySelector('.drag-target'),
      swipeInAction = 'panright',
      swipeOutAction = 'panleft';

    if (rtl === true) {
      swipeInAction = 'panleft';
      swipeOutAction = 'panright';
    }

    if ($(swipeInElement).length > 0) {
      var swipeInMenu = new Hammer(swipeInElement);

      swipeInMenu.on(swipeInAction, function (ev) {
        if ($body.hasClass('vertical-overlay-menu')) {
          $.app.menu.open();
          return false;
        }
      });
    }

    // menu swipe out gesture
    setTimeout(function () {
      var swipeOutElement = document.querySelector('.main-menu');
      var swipeOutMenu;

      if ($(swipeOutElement).length > 0) {
        swipeOutMenu = new Hammer(swipeOutElement);

        swipeOutMenu.get('pan').set({
          direction: Hammer.DIRECTION_ALL,
          threshold: 250
        });

        swipeOutMenu.on(swipeOutAction, function (ev) {
          if ($body.hasClass('vertical-overlay-menu')) {
            $.app.menu.hide();
            return false;
          }
        });
      }
    }, 300);

    // menu close on overlay tap
    var swipeOutOverlayElement = document.querySelector('.sidenav-overlay');

    if ($(swipeOutOverlayElement).length > 0) {
      var swipeOutOverlayMenu = new Hammer(swipeOutOverlayElement);

      swipeOutOverlayMenu.on('tap', function (ev) {
        if ($body.hasClass('vertical-overlay-menu')) {
          $.app.menu.hide();
          return false;
        }
      });
    }
  }

  $(document).on('click', '.menu-toggle, .modern-nav-toggle', function (e) {
    e.preventDefault();

    // Toggle menu
    $.app.menu.toggle();

    setTimeout(function () {
      $(window).trigger('resize');
    }, 200);

    if ($('#collapse-sidebar-switch').length > 0) {
      setTimeout(function () {
        if ($body.hasClass('menu-expanded') || $body.hasClass('menu-open')) {
          $('#collapse-sidebar-switch').prop('checked', false);
        } else {
          $('#collapse-sidebar-switch').prop('checked', true);
        }
      }, 50);
    }

    // Save menu collapsed status in localstorage
    if ($body.hasClass('menu-expanded') || $body.hasClass('menu-open')) {
      localStorage.setItem('menuCollapsed', false);
    } else {
      localStorage.setItem('menuCollapsed', true);
    }

    // Hides dropdown on click of menu toggle
    // $('[data-bs-toggle="dropdown"]').dropdown('hide');

    return false;
  });

  // Add Children Class
  $('.navigation').find('li').has('ul').addClass('has-sub');
  // Update manual scroller when window is resized
  $(window).resize(function () {
    $.app.menu.manualScroller.updateHeight();
  });

  $('#sidebar-page-navigation').on('click', 'a.nav-link', function (e) {
    e.preventDefault();
    e.stopPropagation();
    var $this = $(this),
      href = $this.attr('href');
    var offset = $(href).offset();
    var scrollto = offset.top - 80; // minus fixed header height
    $('html, body').animate(
      {
        scrollTop: scrollto
      },
      0
    );
    setTimeout(function () {
      $this.parent('.nav-item').siblings('.nav-item').children('.nav-link').removeClass('active');
      $this.addClass('active');
    }, 100);
  });

  // main menu internationalization

  // init i18n and load language file
  if ($body.attr('data-framework') === 'laravel') {
    // change language according to data-language of dropdown item
    var language = $('html')[0].lang;
    if (language !== null) {
      // get the selected flag class
      var selectedLang = $('.dropdown-language')
        .find('a[data-language=' + language + ']')
        .text();
      var selectedFlag = $('.dropdown-language')
        .find('a[data-language=' + language + '] .flag-icon')
        .attr('class');
      // set the class in button
      $('#dropdown-flag .selected-language').text(selectedLang);
      $('#dropdown-flag .flag-icon').removeClass().addClass(selectedFlag);
    }
  } else {
    i18next.use(window.i18nextXHRBackend).init(
      {
        debug: false,
        fallbackLng: 'en',
        backend: {
          loadPath: assetPath + 'data/locales/{{lng}}.json'
        },
        returnObjects: true
      },
      function (err, t) {
        // resources have been loaded
        jqueryI18next.init(i18next, $);
      }
    );

    // change language according to data-language of dropdown item
    $('.dropdown-language .dropdown-item').on('click', function () {
      var $this = $(this);
      $this.siblings('.selected').removeClass('selected');
      $this.addClass('selected');
      var selectedLang = $this.text();
      var selectedFlag = $this.find('.flag-icon').attr('class');
      $('#dropdown-flag .selected-language').text(selectedLang);
      $('#dropdown-flag .flag-icon').removeClass().addClass(selectedFlag);
      var currentLanguage = $this.data('language');
      i18next.changeLanguage(currentLanguage, function (err, t) {
        $('.main-menu, .horizontal-menu-wrapper').localize();
      });
    });
  }

  /********************* Bookmark & Search ***********************/
  // This variable is used for mouseenter and mouseleave events of search list
  var $filename = $('.search-input input').data('search'),
    bookmarkWrapper = $('.bookmark-wrapper'),
    bookmarkStar = $('.bookmark-wrapper .bookmark-star'),
    bookmarkInput = $('.bookmark-wrapper .bookmark-input'),
    navLinkSearch = $('.nav-link-search'),
    searchInput = $('.search-input'),
    searchInputInputfield = $('.search-input input'),
    searchList = $('.search-input .search-list'),
    appContent = $('.app-content'),
    bookmarkSearchList = $('.bookmark-input .search-list');

  // Bookmark icon click
  bookmarkStar.on('click', function (e) {
    e.stopPropagation();
    bookmarkInput.toggleClass('show');
    bookmarkInput.find('input').val('');
    bookmarkInput.find('input').blur();
    bookmarkInput.find('input').focus();
    bookmarkWrapper.find('.search-list').addClass('show');

    var arrList = $('ul.nav.navbar-nav.bookmark-icons li'),
      $arrList = '',
      $activeItemClass = '';

    $('ul.search-list li').remove();

    for (var i = 0; i < arrList.length; i++) {
      if (i === 0) {
        $activeItemClass = 'current_item';
      } else {
        $activeItemClass = '';
      }

      var iconName = '',
        className = '';
      if ($(arrList[i].firstChild.firstChild).hasClass('feather')) {
        var classString = arrList[i].firstChild.firstChild.getAttribute('class');
        iconName = classString.split('feather-')[1].split(' ')[0];
        className = classString.split('feather-')[1].split(' ')[1];
      }

      $arrList +=
        '<li class="auto-suggestion ' +
        $activeItemClass +
        '">' +
        '<a class="d-flex align-items-center justify-content-between w-100" href=' +
        arrList[i].firstChild.href +
        '>' +
        '<div class="d-flex justify-content-start align-items-center">' +
        feather.icons[iconName].toSvg({ class: 'me-75 ' + className }) +
        '<span>' +
        arrList[i].firstChild.dataset.bsOriginalTitle +
        '</span>' +
        '</div>' +
        feather.icons['star'].toSvg({ class: 'text-warning bookmark-icon float-end' }) +
        '</a>' +
        '</li>';
    }
    $('ul.search-list').append($arrList);
  });

  // Navigation Search area Open
  navLinkSearch.on('click', function () {
    var $this = $(this);
    var searchInput = $(this).parent('.nav-search').find('.search-input');
    searchInput.addClass('open');
    searchInputInputfield.focus();
    searchList.find('li').remove();
    bookmarkInput.removeClass('show');
  });

  // Navigation Search area Close
  $('.search-input-close').on('click', function () {
    var $this = $(this),
      searchInput = $(this).closest('.search-input');
    if (searchInput.hasClass('open')) {
      searchInput.removeClass('open');
      searchInputInputfield.val('');
      searchInputInputfield.blur();
      searchList.removeClass('show');
      appContent.removeClass('show-overlay');
    }
  });

  // Filter
  if ($('.search-list-main').length) {
    var searchListMain = new PerfectScrollbar('.search-list-main', {
      wheelPropagation: false
    });
  }
  if ($('.search-list-bookmark').length) {
    var searchListBookmark = new PerfectScrollbar('.search-list-bookmark', {
      wheelPropagation: false
    });
  }
  // update Perfect Scrollbar on hover
  $('.search-list-main').mouseenter(function () {
    searchListMain.update();
  });

  searchInputInputfield.on('keyup', function (e) {
    $(this).closest('.search-list').addClass('show');
    if (e.keyCode !== 38 && e.keyCode !== 40 && e.keyCode !== 13) {
      if (e.keyCode == 27) {
        appContent.removeClass('show-overlay');
        bookmarkInput.find('input').val('');
        bookmarkInput.find('input').blur();
        searchInputInputfield.val('');
        searchInputInputfield.blur();
        searchInput.removeClass('open');
        if (searchInput.hasClass('show')) {
          $(this).removeClass('show');
          searchInput.removeClass('show');
        }
      }

      // Define variables
      var value = $(this).val().toLowerCase(), //get values of input on keyup
        activeClass = '',
        bookmark = false,
        liList = $('ul.search-list li'); // get all the list items of the search
      liList.remove();
      // To check if current is bookmark input
      if ($(this).parent().hasClass('bookmark-input')) {
        bookmark = true;
      }

      // If input value is blank
      if (value != '') {
        appContent.addClass('show-overlay');

        // condition for bookmark and search input click
        if (bookmarkInput.focus()) {
          bookmarkSearchList.addClass('show');
        } else {
          searchList.addClass('show');
          bookmarkSearchList.removeClass('show');
        }
        if (bookmark === false) {
          searchList.addClass('show');
          bookmarkSearchList.removeClass('show');
        }

        var $startList = '',
          $otherList = '',
          $htmlList = '',
          $bookmarkhtmlList = '',
          $pageList =
            '<li class="d-flex align-items-center">' +
            '<a href="#">' +
            '<h6 class="section-label mt-75 mb-0">Pages</h6>' +
            '</a>' +
            '</li>',
          $activeItemClass = '',
          $bookmarkIcon = '',
          $defaultList = '',
          a = 0;

        // getting json data from file for search results
        $.getJSON(assetPath + 'data/' + $filename + '.json', function (data) {
          for (var i = 0; i < data.listItems.length; i++) {
            // if current is bookmark then give class to star icon
            // for laravel
            if ($('body').attr('data-framework') === 'laravel') {
              data.listItems[i].url = assetPath + data.listItems[i].url;
            }

            if (bookmark === true) {
              activeClass = ''; // resetting active bookmark class
              var arrList = $('ul.nav.navbar-nav.bookmark-icons li'),
                $arrList = '';
              // Loop to check if current seach value match with the bookmarks already there in navbar
              for (var j = 0; j < arrList.length; j++) {
                if (data.listItems[i].name === arrList[j].firstChild.dataset.bsOriginalTitle) {
                  activeClass = ' text-warning';
                  break;
                } else {
                  activeClass = '';
                }
              }

              $bookmarkIcon = feather.icons['star'].toSvg({ class: 'bookmark-icon float-end' + activeClass });
            }
            // Search list item start with entered letters and create list
            if (data.listItems[i].name.toLowerCase().indexOf(value) == 0 && a < 5) {
              if (a === 0) {
                $activeItemClass = 'current_item';
              } else {
                $activeItemClass = '';
              }
              $startList +=
                '<li class="auto-suggestion ' +
                $activeItemClass +
                '">' +
                '<a class="d-flex align-items-center justify-content-between w-100" href=' +
                data.listItems[i].url +
                '>' +
                '<div class="d-flex justify-content-start align-items-center">' +
                feather.icons[data.listItems[i].icon].toSvg({ class: 'me-75 ' }) +
                '<span>' +
                data.listItems[i].name +
                '</span>' +
                '</div>' +
                $bookmarkIcon +
                '</a>' +
                '</li>';
              a++;
            }
          }
          for (var i = 0; i < data.listItems.length; i++) {
            if (bookmark === true) {
              activeClass = ''; // resetting active bookmark class
              var arrList = $('ul.nav.navbar-nav.bookmark-icons li'),
                $arrList = '';
              // Loop to check if current search value match with the bookmarks already there in navbar
              for (var j = 0; j < arrList.length; j++) {
                if (data.listItems[i].name === arrList[j].firstChild.dataset.bsOriginalTitle) {
                  activeClass = ' text-warning';
                } else {
                  activeClass = '';
                }
              }

              $bookmarkIcon = feather.icons['star'].toSvg({ class: 'bookmark-icon float-end' + activeClass });
            }
            // Search list item not start with letters and create list
            if (
              !(data.listItems[i].name.toLowerCase().indexOf(value) == 0) &&
              data.listItems[i].name.toLowerCase().indexOf(value) > -1 &&
              a < 5
            ) {
              if (a === 0) {
                $activeItemClass = 'current_item';
              } else {
                $activeItemClass = '';
              }
              $otherList +=
                '<li class="auto-suggestion ' +
                $activeItemClass +
                '">' +
                '<a class="d-flex align-items-center justify-content-between w-100" href=' +
                data.listItems[i].url +
                '>' +
                '<div class="d-flex justify-content-start align-items-center">' +
                feather.icons[data.listItems[i].icon].toSvg({ class: 'me-75 ' }) +
                '<span>' +
                data.listItems[i].name +
                '</span>' +
                '</div>' +
                $bookmarkIcon +
                '</a>' +
                '</li>';
              a++;
            }
          }
          $defaultList = $('.main-search-list-defaultlist').html();
          if ($startList == '' && $otherList == '') {
            $otherList = $('.main-search-list-defaultlist-other-list').html();
          }
          // concatinating startlist, otherlist, defalutlist with pagelist
          $htmlList = $pageList.concat($startList, $otherList, $defaultList);
          $('ul.search-list').html($htmlList);
          // concatinating otherlist with startlist
          $bookmarkhtmlList = $startList.concat($otherList);
          $('ul.search-list-bookmark').html($bookmarkhtmlList);
          // Feather Icons
          // if (feather) {
          //   featherSVG();
          // }
        });
      } else {
        if (bookmark === true) {
          var arrList = $('ul.nav.navbar-nav.bookmark-icons li'),
            $arrList = '';
          for (var i = 0; i < arrList.length; i++) {
            if (i === 0) {
              $activeItemClass = 'current_item';
            } else {
              $activeItemClass = '';
            }

            var iconName = '',
              className = '';
            if ($(arrList[i].firstChild.firstChild).hasClass('feather')) {
              var classString = arrList[i].firstChild.firstChild.getAttribute('class');
              iconName = classString.split('feather-')[1].split(' ')[0];
              className = classString.split('feather-')[1].split(' ')[1];
            }
            $arrList +=
              '<li class="auto-suggestion">' +
              '<a class="d-flex align-items-center justify-content-between w-100" href=' +
              arrList[i].firstChild.href +
              '>' +
              '<div class="d-flex justify-content-start align-items-center">' +
              feather.icons[iconName].toSvg({ class: 'me-75 ' }) +
              '<span>' +
              arrList[i].firstChild.dataset.bsOriginalTitle +
              '</span>' +
              '</div>' +
              feather.icons['star'].toSvg({ class: 'text-warning bookmark-icon float-end' }) +
              '</a>' +
              '</li>';
          }
          $('ul.search-list').append($arrList);
          // Feather Icons
          // if (feather) {
          //   featherSVG();
          // }
        } else {
          // if search input blank, hide overlay
          if (appContent.hasClass('show-overlay')) {
            appContent.removeClass('show-overlay');
          }
          // If filter box is empty
          if (searchList.hasClass('show')) {
            searchList.removeClass('show');
          }
        }
      }
    }
  });

  // Add class on hover of the list
  $(document).on('mouseenter', '.search-list li', function (e) {
    $(this).siblings().removeClass('current_item');
    $(this).addClass('current_item');
  });
  $(document).on('click', '.search-list li', function (e) {
    e.stopPropagation();
  });

  $('html').on('click', function ($this) {
    if (!$($this.target).hasClass('bookmark-icon')) {
      if (bookmarkSearchList.hasClass('show')) {
        bookmarkSearchList.removeClass('show');
      }
      if (bookmarkInput.hasClass('show')) {
        bookmarkInput.removeClass('show');
        appContent.removeClass('show-overlay');
      }
    }
  });

  // Prevent closing bookmark dropdown on input textbox click
  $(document).on('click', '.bookmark-input input', function (e) {
    bookmarkInput.addClass('show');
    bookmarkSearchList.addClass('show');
  });

  // Favorite star click
  $(document).on('click', '.bookmark-input .search-list .bookmark-icon', function (e) {
    e.stopPropagation();
    if ($(this).hasClass('text-warning')) {
      $(this).removeClass('text-warning');
      var arrList = $('ul.nav.navbar-nav.bookmark-icons li');
      for (var i = 0; i < arrList.length; i++) {
        if (arrList[i].firstChild.dataset.bsOriginalTitle == $(this).parent()[0].innerText) {
          arrList[i].remove();
        }
      }
      e.preventDefault();
    } else {
      var arrList = $('ul.nav.navbar-nav.bookmark-icons li');
      $(this).addClass('text-warning');
      e.preventDefault();
      var $url = $(this).parent()[0].href,
        $name = $(this).parent()[0].innerText,
        $listItem = '',
        $listItemDropdown = '',
        iconName = $(this).parent()[0].firstChild.firstChild.dataset.icon;
      if ($($(this).parent()[0].firstChild.firstChild).hasClass('feather')) {
        var classString = $(this).parent()[0].firstChild.firstChild.getAttribute('class');
        iconName = classString.split('feather-')[1].split(' ')[0];
      }
      $listItem =
        '<li class="nav-item d-none d-lg-block">' +
        '<a class="nav-link" href="' +
        $url +
        '" data-bs-toggle="tooltip" data-bs-placement="bottom" title="' +
        $name +
        '">' +
        feather.icons[iconName].toSvg({ class: 'ficon' }) +
        '</a>' +
        '</li>';
      $('ul.nav.bookmark-icons').append($listItem);
      $('[data-bs-toggle="tooltip"]').tooltip();
    }
  });

  // If we use up key(38) Down key (40) or Enter key(13)
  $(window).on('keydown', function (e) {
    var $current = $('.search-list li.current_item'),
      $next,
      $prev;
    if (e.keyCode === 40) {
      $next = $current.next();
      $current.removeClass('current_item');
      $current = $next.addClass('current_item');
    } else if (e.keyCode === 38) {
      $prev = $current.prev();
      $current.removeClass('current_item');
      $current = $prev.addClass('current_item');
    }

    if (e.keyCode === 13 && $('.search-list li.current_item').length > 0) {
      var selected_item = $('.search-list li.current_item a');
      window.location = selected_item.attr('href');
      $(selected_item).trigger('click');
    }
  });

  // Waves Effect
  Waves.init();
  Waves.attach(
    ".btn:not([class*='btn-relief-']):not([class*='btn-gradient-']):not([class*='btn-outline-']):not([class*='btn-flat-'])",
    ['waves-float', 'waves-light']
  );
  Waves.attach("[class*='btn-outline-']");
  Waves.attach("[class*='btn-flat-']");

  $('.form-password-toggle .input-group-text').on('click', function (e) {
    e.preventDefault();
    var $this = $(this),
      inputGroupText = $this.closest('.form-password-toggle'),
      formPasswordToggleIcon = $this,
      formPasswordToggleInput = inputGroupText.find('input');

    if (formPasswordToggleInput.attr('type') === 'text') {
      formPasswordToggleInput.attr('type', 'password');
      if (feather) {
        formPasswordToggleIcon.find('svg').replaceWith(feather.icons['eye'].toSvg({ class: 'font-small-4' }));
      }
    } else if (formPasswordToggleInput.attr('type') === 'password') {
      formPasswordToggleInput.attr('type', 'text');
      if (feather) {
        formPasswordToggleIcon.find('svg').replaceWith(feather.icons['eye-off'].toSvg({ class: 'font-small-4' }));
      }
    }
  });

  // on window scroll button show/hide
  $(window).on('scroll', function () {
    if ($(this).scrollTop() > 400) {
      $('.scroll-top').fadeIn();
    } else {
      $('.scroll-top').fadeOut();
    }

    // On Scroll navbar color on horizontal menu
    if ($body.hasClass('navbar-static')) {
      var scroll = $(window).scrollTop();

      if (scroll > 65) {
        $('html:not(.dark-layout) .horizontal-menu .header-navbar.navbar-fixed').css({
          background: '#fff',
          'box-shadow': '0 4px 20px 0 rgba(0,0,0,.05)'
        });
        $('.horizontal-menu.dark-layout .header-navbar.navbar-fixed').css({
          background: '#161d31',
          'box-shadow': '0 4px 20px 0 rgba(0,0,0,.05)'
        });
        $('html:not(.dark-layout) .horizontal-menu .horizontal-menu-wrapper.header-navbar').css('background', '#fff');
        $('.dark-layout .horizontal-menu .horizontal-menu-wrapper.header-navbar').css('background', '#161d31');
      } else {
        $('html:not(.dark-layout) .horizontal-menu .header-navbar.navbar-fixed').css({
          background: '#f8f8f8',
          'box-shadow': 'none'
        });
        $('.dark-layout .horizontal-menu .header-navbar.navbar-fixed').css({
          background: '#161d31',
          'box-shadow': 'none'
        });
        $('html:not(.dark-layout) .horizontal-menu .horizontal-menu-wrapper.header-navbar').css('background', '#fff');
        $('.dark-layout .horizontal-menu .horizontal-menu-wrapper.header-navbar').css('background', '#161d31');
      }
    }
  });

  // Click event to scroll to top
  $('.scroll-top').on('click', function () {
    $('html, body').animate({ scrollTop: 0 }, 75);
  });

  function getCurrentLayout() {
    var currentLayout = '';
    if ($html.hasClass('dark-layout')) {
      currentLayout = 'dark-layout';
    } else if ($html.hasClass('bordered-layout')) {
      currentLayout = 'bordered-layout';
    } else if ($html.hasClass('semi-dark-layout')) {
      currentLayout = 'semi-dark-layout';
    } else {
      currentLayout = 'light-layout';
    }
    return currentLayout;
  }

  // Get the data layout, for blank set to light layout
  var dataLayout = $html.attr('data-layout') ? $html.attr('data-layout') : 'light-layout';

  // Navbar Dark / Light Layout Toggle Switch
  $('.nav-link-style').on('click', function () {
    var currentLayout = getCurrentLayout(),
      switchToLayout = '',
      prevLayout = localStorage.getItem(dataLayout + '-prev-skin', currentLayout);

    // If currentLayout is not dark layout
    if (currentLayout !== 'dark-layout') {
      // Switch to dark
      switchToLayout = 'dark-layout';
    } else {
      // Switch to light
      switchToLayout = prevLayout ? prevLayout : 'light-layout';
    }
    // Set Previous skin in local db
    localStorage.setItem(dataLayout + '-prev-skin', currentLayout);
    // Set Current skin in local db
    localStorage.setItem(dataLayout + '-current-skin', switchToLayout);

    // Call set layout
    setLayout(switchToLayout);

    // ToDo: Customizer fix
    $('.horizontal-menu .header-navbar.navbar-fixed').css({
      background: 'inherit',
      'box-shadow': 'inherit'
    });
    $('.horizontal-menu .horizontal-menu-wrapper.header-navbar').css('background', 'inherit');
  });

  // Get current local storage layout
  var currentLocalStorageLayout = localStorage.getItem(dataLayout + '-current-skin');

  // Set layout on screen load
  //? Comment it if you don't want to sync layout with local db
  // setLayout(currentLocalStorageLayout);

  function setLayout(currentLocalStorageLayout) {
    var navLinkStyle = $('.nav-link-style'),
      currentLayout = getCurrentLayout(),
      mainMenu = $('.main-menu'),
      navbar = $('.header-navbar'),
      // Witch to local storage layout if we have else current layout
      switchToLayout = currentLocalStorageLayout ? currentLocalStorageLayout : currentLayout;

    $html.removeClass('semi-dark-layout dark-layout bordered-layout');

    if (switchToLayout === 'dark-layout') {
      $html.addClass('dark-layout');
      mainMenu.removeClass('menu-light').addClass('menu-dark');
      navbar.removeClass('navbar-light').addClass('navbar-dark');
      navLinkStyle.find('.ficon').replaceWith(feather.icons['sun'].toSvg({ class: 'ficon' }));
    } else if (switchToLayout === 'bordered-layout') {
      $html.addClass('bordered-layout');
      mainMenu.removeClass('menu-dark').addClass('menu-light');
      navbar.removeClass('navbar-dark').addClass('navbar-light');
      navLinkStyle.find('.ficon').replaceWith(feather.icons['moon'].toSvg({ class: 'ficon' }));
    } else if (switchToLayout === 'semi-dark-layout') {
      $html.addClass('semi-dark-layout');
      mainMenu.removeClass('menu-dark').addClass('menu-light');
      navbar.removeClass('navbar-dark').addClass('navbar-light');
      navLinkStyle.find('.ficon').replaceWith(feather.icons['moon'].toSvg({ class: 'ficon' }));
    } else {
      $html.addClass('light-layout');
      mainMenu.removeClass('menu-dark').addClass('menu-light');
      navbar.removeClass('navbar-dark').addClass('navbar-light');
      navLinkStyle.find('.ficon').replaceWith(feather.icons['moon'].toSvg({ class: 'ficon' }));
    }
    // Set radio in customizer if we have
    if ($('input:radio[data-layout=' + switchToLayout + ']').length > 0) {
      setTimeout(function () {
        $('input:radio[data-layout=' + switchToLayout + ']').prop('checked', true);
      });
    }
  }
})(window, document, jQuery);

// To use feather svg icons with different sizes
function featherSVG(iconSize) {
  // Feather Icons
  if (iconSize == undefined) {
    iconSize = '14';
  }
  return feather.replace({ width: iconSize, height: iconSize });
}

// jQuery Validation Global Defaults
if (typeof jQuery.validator === 'function') {
  jQuery.validator.setDefaults({
    errorElement: 'span',
    errorPlacement: function (error, element) {
      if (
        element.parent().hasClass('input-group') ||
        element.hasClass('select2') ||
        element.attr('type') === 'checkbox'
      ) {
        error.insertAfter(element.parent());
      } else if (element.hasClass('form-check-input')) {
        error.insertAfter(element.parent().siblings(':last'));
      } else {
        error.insertAfter(element);
      }

      if (element.parent().hasClass('input-group')) {
        element.parent().addClass('is-invalid');
      }
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass('error');
      if ($(element).parent().hasClass('input-group')) {
        $(element).parent().addClass('is-invalid');
      }
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass('error');
      if ($(element).parent().hasClass('input-group')) {
        $(element).parent().removeClass('is-invalid');
      }
    }
  });
}

// Add validation class to input-group (input group validation fix, currently disabled but will be useful in future)
/* function inputGroupValidation(el) {
  var validEl,
    invalidEl,
    elem = $(el);

  if (elem.hasClass('form-control')) {
    if ($(elem).is('.form-control:valid, .form-control.is-valid')) {
      validEl = elem;
    }
    if ($(elem).is('.form-control:invalid, .form-control.is-invalid')) {
      invalidEl = elem;
    }
  } else {
    validEl = elem.find('.form-control:valid, .form-control.is-valid');
    invalidEl = elem.find('.form-control:invalid, .form-control.is-invalid');
  }
  if (validEl !== undefined) {
    validEl.closest('.input-group').removeClass('.is-valid is-invalid').addClass('is-valid');
  }
  if (invalidEl !== undefined) {
    invalidEl.closest('.input-group').removeClass('.is-valid is-invalid').addClass('is-invalid');
  }
} */






$(function(){

  var piezas = {
    18:{
      'img':'/images/odontograma/images/pieza_tres.png',
      'giro':false,
      'Vestibular':'arriba',
      'Palatino':'abajo',
      'Distal':'izquierda',
      'Mesial':'derecha',
      'OclusalStatus':true,
      'Oclusal':'centro',
      'LingualStatus':false
    },
    17:{
      'img':'/images/odontograma/images/pieza_tres.png',
      'giro':false,
      'Vestibular':'arriba',
      'Palatino':'abajo',
      'Distal':'izquierda',
      'Mesial':'derecha',
      'OclusalStatus':true,
      'Oclusal':'centro',
      'LingualStatus':false
    },
    16:{
      'img':'/images/odontograma/images/pieza_tres.png',
      'giro':false,
      'Vestibular':'arriba',
      'Palatino':'abajo',
      'Distal':'izquierda',
      'Mesial':'derecha',
      'OclusalStatus':true,
      'Oclusal':'centro',
      'LingualStatus':false
    },
    15:{
      'img':'pieza_uno.png',
      'giro':false,
      'Vestibular':'arriba',
      'Palatino':'abajo',
      'Distal':'izquierda',
      'Mesial':'derecha',
      'OclusalStatus':true,
      'Oclusal':'centro',
      'LingualStatus':false
    },
    14:{
      'img':'pieza_dos.png',
      'giro':false,
      'Vestibular':'arriba',
      'Palatino':'abajo',
      'Distal':'izquierda',
      'Mesial':'derecha',
      'OclusalStatus':true,
      'Oclusal':'centro',
      'LingualStatus':false
    },
    13:{
      'img':'pieza_cero.png',
      'giro':false,
      'Vestibular':'arriba',
      'Palatino':'abajo',
      'Distal':'izquierda',
      'Mesial':'derecha',
      'OclusalStatus':false,
      'Oclusal':'centro',
    },
    12:{
      'img':'pieza_cero.png',
      'giro':false,
      'Vestibular':'arriba',
      'Palatino':'abajo',
      'Distal':'izquierda',
      'Mesial':'derecha',
      'OclusalStatus':false,
      'Oclusal':'centro',
    },
    11:{
      'img':'pieza_cero.png',
      'giro':false,
      'Vestibular':'arriba',
      'Palatino':'abajo',
      'Distal':'izquierda',
      'Mesial':'derecha',
      'OclusalStatus':false,
      'Oclusal':'centro',
    },
  
    21:{
      'img':'pieza_cero.png',
      'giro':false,
      'Vestibular':'arriba',
      'Palatino':'abajo',
      'Distal':'derecha',
      'Mesial':'izquierda',
      'OclusalStatus':false,
      'Oclusal':'centro',
    },
    22:{
      'img':'pieza_cero.png',
      'giro':false,
      'Vestibular':'arriba',
      'Palatino':'abajo',
      'Distal':'derecha',
      'Mesial':'izquierda',
      'OclusalStatus':false,
      'Oclusal':'centro',
    },
    23:{
      'img':'pieza_cero.png',
      'giro':false,
      'Vestibular':'arriba',
      'Palatino':'abajo',
      'Distal':'derecha',
      'Mesial':'izquierda',
      'OclusalStatus':false,
      'Oclusal':'centro',
    },
    24:{
      'img':'pieza_dos.png',
      'giro':false,
      'Vestibular':'arriba',
      'Palatino':'abajo',
      'Distal':'derecha',
      'Mesial':'izquierda',
      'OclusalStatus':true,
      'Oclusal':'centro',
      'LingualStatus':false,
    },
    25:{
      'img':'pieza_uno.png',
      'giro':false,
      'Vestibular':'arriba',
      'Palatino':'abajo',
      'Distal':'derecha',
      'Mesial':'izquierda',
      'OclusalStatus':true,
      'Oclusal':'centro',
      'LingualStatus':false
    },
    26:{
      'img':'/images/odontograma/images/pieza_tres.png',
      'giro':false,
      'Vestibular':'arriba',
      'Palatino':'abajo',
      'Distal':'derecha',
      'Mesial':'izquierda',
      'OclusalStatus':true,
      'Oclusal':'centro',
      'LingualStatus':false
    },
    27:{
      'img':'/images/odontograma/images/pieza_tres.png',
      'giro':false,
      'Vestibular':'arriba',
      'Palatino':'abajo',
      'Distal':'derecha',
      'Mesial':'izquierda',
      'OclusalStatus':true,
      'Oclusal':'centro',
      'LingualStatus':false
    },
    28:{
      'img':'/images/odontograma/images/pieza_tres.png',
      'giro':false,
      'Vestibular':'arriba',
      'Palatino':'abajo',
      'Distal':'derecha',
      'Mesial':'izquierda',
      'OclusalStatus':true,
      'Oclusal':'centro',
      'LingualStatus':false
    },
  
    55:{
      'img':'/images/odontograma/images/pieza_tres.png',
      'giro':false,
      'Vestibular':'arriba',
      'Palatino':'abajo',
      'Distal':'izquierda',
      'Mesial':'derecha',
      'OclusalStatus':true,
      'Oclusal':'centro',
      'LingualStatus':false
    },
    54:{
      'img':'/images/odontograma/images/pieza_tres.png',
      'giro':false,
      'Vestibular':'arriba',
      'Palatino':'abajo',
      'Distal':'izquierda',
      'Mesial':'derecha',
      'OclusalStatus':true,
      'Oclusal':'centro',
      'LingualStatus':false
    },
    53:{
      'img':'pieza_cero.png',
      'giro':false,
      'Vestibular':'arriba',
      'Palatino':'abajo',
      'Distal':'izquierda',
      'Mesial':'derecha',
      'OclusalStatus':false,
      'Oclusal':'centro',
    },
    52:{
      'img':'pieza_cero.png',
      'giro':false,
      'Vestibular':'arriba',
      'Palatino':'abajo',
      'Distal':'izquierda',
      'Mesial':'derecha',
      'OclusalStatus':false,
      'Oclusal':'centro',
    },
    51:{
      'img':'pieza_cero.png',
      'giro':false,
      'Vestibular':'arriba',
      'Palatino':'abajo',
      'Distal':'izquierda',
      'Mesial':'derecha',
      'OclusalStatus':false,
      'Oclusal':'centro',
    },
  
    61:{
      'img':'pieza_cero.png',
      'giro':false,
      'Vestibular':'arriba',
      'Palatino':'abajo',
      'Distal':'derecha',
      'Mesial':'izquierda',
      'OclusalStatus':false,
      'Oclusal':'centro',
    },
    62:{
      'img':'pieza_cero.png',
      'giro':false,
      'Vestibular':'arriba',
      'Palatino':'abajo',
      'Distal':'derecha',
      'Mesial':'izquierda',
      'OclusalStatus':false,
      'Oclusal':'centro',
    },
    63:{
      'img':'pieza_cero.png',
      'giro':false,
      'Vestibular':'arriba',
      'Palatino':'abajo',
      'Distal':'derecha',
      'Mesial':'izquierda',
      'OclusalStatus':false,
      'Oclusal':'centro',
    },
    64:{
      'img':'/images/odontograma/images/pieza_tres.png',
      'giro':false,
      'Vestibular':'arriba',
      'Palatino':'abajo',
      'Distal':'derecha',
      'Mesial':'izquierda',
      'OclusalStatus':true,
      'Oclusal':'centro',
      'LingualStatus':false
    },
    65:{
      'img':'/images/odontograma/images/pieza_tres.png',
      'giro':false,
      'Vestibular':'arriba',
      'Palatino':'abajo',
      'Distal':'derecha',
      'Mesial':'izquierda',
      'OclusalStatus':true,
      'Oclusal':'centro',
      'LingualStatus':false
    },
  
  
    85:{
      'img':'pieza_dos.png',
      'giro':true,
      'Vestibular':'abajo',
      'Lingual':'arriba',
      'Distal':'izquierda',
      'Mesial':'derecha',
      'OclusalStatus':true,
      'Oclusal':'centro',
      'LingualStatus':true
    },
    84:{
      'img':'pieza_dos.png',
      'giro':true,
      'Vestibular':'abajo',
      'Lingual':'arriba',
      'Distal':'izquierda',
      'Mesial':'derecha',
      'OclusalStatus':true,
      'Oclusal':'centro',
      'LingualStatus':true
    },
    83:{
      'img':'pieza_cero.png',
      'giro':true,
      'Vestibular':'abajo',
      'Lingual':'arriba',
      'Distal':'izquierda',
      'Mesial':'derecha',
      'OclusalStatus':false,
      'Oclusal':'centro',
      'LingualStatus':true
    },
    82:{
      'img':'pieza_cero.png',
      'giro':true,
      'Vestibular':'abajo',
      'Lingual':'arriba',
      'Distal':'izquierda',
      'Mesial':'derecha',
      'OclusalStatus':false,
      'Oclusal':'centro',
      'LingualStatus':true
    },
    81:{
      'img':'pieza_cero.png',
      'giro':true,
      'Vestibular':'abajo',
      'Lingual':'arriba',
      'Distal':'izquierda',
      'Mesial':'derecha',
      'OclusalStatus':false,
      'Oclusal':'centro',
      'LingualStatus':true
    },
  
    71:{
      'img':'pieza_cero.png',
      'giro':true,
      'Vestibular':'abajo',
      'Lingual':'arriba',
      'Distal':'derecha',
      'Mesial':'izquierda',
      'OclusalStatus':false,
      'Oclusal':'centro',
      'LingualStatus':true
    },
    72:{
      'img':'pieza_cero.png',
      'giro':true,
      'Vestibular':'abajo',
      'Lingual':'arriba',
      'Distal':'derecha',
      'Mesial':'izquierda',
      'OclusalStatus':false,
      'Oclusal':'centro',
      'LingualStatus':true
    },
    73:{
      'img':'pieza_cero.png',
      'giro':true,
      'Vestibular':'abajo',
      'Lingual':'arriba',
      'Distal':'derecha',
      'Mesial':'izquierda',
      'OclusalStatus':false,
      'Oclusal':'centro',
      'LingualStatus':true
    },
    74:{
      'img':'pieza_dos.png',
      'giro':true,
      'Vestibular':'abajo',
      'Lingual':'arriba',
      'Distal':'derecha',
      'Mesial':'izquierda',
      'OclusalStatus':true,
      'Oclusal':'centro',
      'LingualStatus':true
    },
    75:{
      'img':'pieza_dos.png',
      'giro':true,
      'Vestibular':'abajo',
      'Lingual':'arriba',
      'Distal':'derecha',
      'Mesial':'izquierda',
      'OclusalStatus':true,
      'Oclusal':'centro',
      'LingualStatus':true
    },
  
    48:{
      'img':'pieza_dos.png',
      'giro':true,
      'Vestibular':'abajo',
      'Lingual':'arriba',
      'Distal':'izquierda',
      'Mesial':'derecha',
      'OclusalStatus':true,
      'Oclusal':'centro',
      'LingualStatus':true
    },
    47:{
      'img':'pieza_dos.png',
      'giro':true,
      'Vestibular':'abajo',
      'Lingual':'arriba',
      'Distal':'izquierda',
      'Mesial':'derecha',
      'OclusalStatus':true,
      'Oclusal':'centro',
      'LingualStatus':true
    },
    46:{
      'img':'pieza_dos.png',
      'giro':true,
      'Vestibular':'abajo',
      'Lingual':'arriba',
      'Distal':'izquierda',
      'Mesial':'derecha',
      'OclusalStatus':true,
      'Oclusal':'centro',
      'LingualStatus':true
    },
    45:{
      'img':'pieza_uno.png',
      'giro':true,
      'Vestibular':'abajo',
      'Lingual':'arriba',
      'Distal':'izquierda',
      'Mesial':'derecha',
      'OclusalStatus':true,
      'Oclusal':'centro',
      'LingualStatus':true
    },
    44:{
      'img':'pieza_uno.png',
      'giro':true,
      'Vestibular':'abajo',
      'Lingual':'arriba',
      'Distal':'izquierda',
      'Mesial':'derecha',
      'OclusalStatus':true,
      'Oclusal':'centro',
      'LingualStatus':true
    },
    43:{
      'img':'pieza_cero.png',
      'giro':true,
      'Vestibular':'abajo',
      'Lingual':'arriba',
      'Distal':'izquierda',
      'Mesial':'derecha',
      'OclusalStatus':false,
      'Oclusal':'centro',
      'LingualStatus':true
    },
    42:{
      'img':'pieza_cero.png',
      'giro':true,
      'Vestibular':'abajo',
      'Lingual':'arriba',
      'Distal':'izquierda',
      'Mesial':'derecha',
      'OclusalStatus':false,
      'Oclusal':'centro',
      'LingualStatus':true
    },
    41:{
      'img':'pieza_cero.png',
      'giro':true,
      'Vestibular':'abajo',
      'Lingual':'arriba',
      'Distal':'izquierda',
      'Mesial':'derecha',
      'OclusalStatus':false,
      'Oclusal':'centro',
      'LingualStatus':true
    },
  
    31:{
      'img':'pieza_cero.png',
      'giro':true,
      'Vestibular':'abajo',
      'Lingual':'arriba',
      'Distal':'derecha',
      'Mesial':'izquierda',
      'OclusalStatus':false,
      'Oclusal':'centro',
      'LingualStatus':true
    },
    32:{
      'img':'pieza_cero.png',
      'giro':true,
      'Vestibular':'abajo',
      'Lingual':'arriba',
      'Distal':'derecha',
      'Mesial':'izquierda',
      'OclusalStatus':false,
      'Oclusal':'centro',
      'LingualStatus':true
    },
    33:{
      'img':'pieza_cero.png',
      'giro':true,
      'Vestibular':'abajo',
      'Lingual':'arriba',
      'Distal':'derecha',
      'Mesial':'izquierda',
      'OclusalStatus':false,
      'Oclusal':'centro',
      'LingualStatus':true
    },
    34:{
      'img':'pieza_uno.png',
      'giro':true,
      'Vestibular':'abajo',
      'Lingual':'arriba',
      'Distal':'derecha',
      'Mesial':'izquierda',
      'OclusalStatus':true,
      'Oclusal':'centro',
      'LingualStatus':true
    },
    35:{
      'img':'pieza_uno.png',
      'giro':true,
      'Vestibular':'abajo',
      'Lingual':'arriba',
      'Distal':'derecha',
      'Mesial':'izquierda',
      'OclusalStatus':true,
      'Oclusal':'centro',
      'LingualStatus':true
    },
    36:{
      'img':'pieza_dos.png',
      'giro':true,
      'Vestibular':'abajo',
      'Lingual':'arriba',
      'Distal':'derecha',
      'Mesial':'izquierda',
      'OclusalStatus':true,
      'Oclusal':'centro',
      'LingualStatus':true
    },
    37:{
      'img':'pieza_dos.png',
      'giro':true,
      'Vestibular':'abajo',
      'Lingual':'arriba',
      'Distal':'derecha',
      'Mesial':'izquierda',
      'OclusalStatus':true,
      'Oclusal':'centro',
      'LingualStatus':true
    },
    38:{
      'img':'pieza_dos.png',
      'giro':true,
      'Vestibular':'abajo',
      'Lingual':'arriba',
      'Distal':'derecha',
      'Mesial':'izquierda',
      'OclusalStatus':true,
      'Oclusal':'centro',
      'LingualStatus':true
    },
  
  
  };
  
  var seleccionado = '';
  $('.odontograma-navegacion a').click(function(event) {
    event.preventDefault();
  });
  
  /*=================================================
  =            SELECCIONANDO EL HALLAZGO            =
  =================================================*/
  $('.odontograma-item').click(function(event) {    
    var t = $(this);
    if (t.hasClass('nombreHallazgo')) {
      var seleccionado = t[0];
    }else{
      var seleccionado = t.parent().parent().parent().find('a.nombreHallazgo')[0];
      if (t.hasClass('siglas')) {
        var sigla = $(t).data('sigla');
      }else{
        var sigla = $(seleccionado).data('sigla');
      }
    }
    var hallazgo = $(seleccionado).data('hallazgo');
    
    var estado = $(this).data('estado');
    var categoria = $(this).data('categoria');
  
  
    $('#FormHistoriaMovimientoAgregarHallazgo input[name=hallazgo], #FormHistoriaMovimientoAgregarHallazgo input[name=estado], #FormHistoriaMovimientoAgregarHallazgo input[name=sigla], #FormHistoriaMovimientoAgregarHallazgo input[name=diente], #FormHistoriaMovimientoAgregarHallazgo input[name=dienteFinal], #FormHistoriaMovimientoAgregarHallazgo input[name=categoria]').val('');
  
    $('#colDienteFinal').hide();
    $('#FormMarcarPieza').hide();
  
    $('.cursor').removeClass('inicioSelec');
    $('#FormHistoriaMovimientoAgregarHallazgo input[name="marcas"]').val(0);
  
    $('#BotonNombreSeleccionado').show().html(seleccionado.innerText);
  
    $('#odontograma-contenido').removeClass('detalle unico inicio fin MarcarPieza');
    $('#FormMarcarPieza').removeClass('estadoMarcarPieza');
    if ($(seleccionado).hasClass('rango')) {
      $('#odontograma-contenido').addClass('inicio');
    }else{
      $('#odontograma-contenido').addClass('unico');
  
      if ($(seleccionado).hasClass('hallazgoMarcar')) {
        $('#odontograma-contenido').addClass('MarcarPieza');
        $('#odontograma-contenido').data('marcaclass',$(seleccionado).data('marcaclass'));
        $('#FormHistoriaMovimientoAgregarHallazgo input[name="marcas"]').val(1);
        if ($(seleccionado).hasClass('hallazgoMarcarEstado')) {
          $('#FormMarcarPieza').addClass('estadoMarcarPieza');
        }
      }
    }
  
    $('#modalHallazgo').val(seleccionado.innerText);
  
    $('#colEstado').show();
    $('#colSigla').show();
    $('#colCategoria').show();
    $('#dibujar').hide();
    $('#BotonNombreSeleccionado').removeClass('btn-default btn-success btn-danger');
    if (estado=='bueno') {
      $('#modalEstado').val('Buen Estado');
      $('#FormHistoriaMovimientoAgregarHallazgo input[name="estado"]').val('bueno');
      $('#BotonNombreSeleccionado').addClass('btn-success');
    }
    if (estado=='malo') {
      $('#modalEstado').val('Mal Estado');
      $('#FormHistoriaMovimientoAgregarHallazgo input[name="estado"]').val('malo');
      $('#BotonNombreSeleccionado').addClass('btn-danger');	
    }
    if (typeof estado === "undefined") {
      $('#colEstado').hide();
      $('#FormHistoriaMovimientoAgregarHallazgo input[name="estado"]').val('');
      $('#BotonNombreSeleccionado').addClass('btn-default');	
    }
  
    if (typeof sigla === "undefined") {
      $('#colSigla').hide();
      $('#FormHistoriaMovimientoAgregarHallazgo input[name="sigla"]').val('');
    }else{
      $('#FormHistoriaMovimientoAgregarHallazgo input[name="sigla"]').val(sigla);
    }
    $('#BotonSeleccion').removeClass('btn-default').addClass('btn-info').html('Quitar Selección');
  
    if (typeof categoria === "undefined") {
      $('#colCategoria').hide();
      $('#FormHistoriaMovimientoAgregarHallazgo input[name="categoria"]').val('');
      $('#BotonNombreSeleccionado').addClass('btn-default');	
    }else{
      $('#FormHistoriaMovimientoAgregarHallazgo input[name="categoria"]').val(categoria);
    }
    
    $('#FormHistoriaMovimientoAgregarHallazgo input[name=hallazgo]').val(hallazgo);
  
  
  });
  
  
  $('#BotonSeleccion').click(function(event) {
    $(this).html('Seleccione');
    $('#odontograma-contenido').removeClass('unico inicio fin').addClass('detalle');
    $('.cursor').removeClass('inicioSelec');
    $('#BotonNombreSeleccionado').hide();
  });
  /*=====  End of SELECCIONANDO EL HALLAZGO  ======*/
  
  /*===============================================
  =            SELECCIONANDO EL DIENTE            =
  ===============================================*/
  $('#odontograma').on('click', '#odontograma-contenido.unico .cursor', function(event) {    
    event.preventDefault();
    $('#dibujar img').removeClass('rotar');
    $('#pieza').removeClass('categoria-centro categoria-nocentro');
    $('.direccionPieza').hide().removeClass('giro');
    $('#FormMarcarPieza input[type=checkbox], #FormMarcarPieza input[type=radio]').each(function() { 
      this.checked = false;
    });
  
    $('#FormMarcarPieza .radio-inline').hide();
  
    var diente = $(this).data('diente');
    if ($('#odontograma-contenido').hasClass('MarcarPieza')) {
      $('#dibujar').show();
      $('.direccionPieza ').attr('class','direccionPieza ');
      $('#FormMarcarPieza').show();
      var propiedades = piezas[diente];
      if (propiedades.LingualStatus) {
        $('#ContentCheckBoxPalatino').hide();
        $('#CheckBoxPalatino').prop('disabled',true);
        $('#ContentCheckBoxLingual').show();
        $('#CheckBoxLingual').prop('disabled',false);
      }else{
        $('#ContentCheckBoxLingual').hide();
        $('#CheckBoxLingual').prop('disabled',true);
        $('#ContentCheckBoxPalatino').show();
        $('#CheckBoxPalatino').prop('disabled',false);
      }
  
      if (propiedades.OclusalStatus) {
        $('#ContentCheckBoxOclusal').show();
        $('#CheckBoxOclusal').prop('disabled',false);
        $('#pieza').addClass('categoria-centro');
      }else{
        $('#ContentCheckBoxOclusal').hide();
        $('#CheckBoxOclusal').prop('disabled',true);
        $('#pieza').addClass('categoria-nocentro');
      }
  
      if (propiedades.girar) {
        $('#pieza img').addClass('rotar');
      }else{
        $('#pieza img').removeClass('rotar');		
      }
  
      $('#dibujar img').attr('src','/assets/images/odontograma/images/'+propiedades.img);
      if (propiedades.giro) {
        $('#dibujar img').addClass('rotar');
      }
  
  
    }
    $('#ModalAgregarHallazgo').modal('show');
    $('#FormHistoriaMovimientoAgregarHallazgo input[name=diente]').val(diente);
  });
  
  $('#FormMarcarPieza input[type=checkbox]').click(function(event) {
    var num_diente = $('#FormHistoriaMovimientoAgregarHallazgo input[name=diente]').val();
    var propiedades = piezas[num_diente];
    var check = $(this);
    var direcccion = propiedades[check.val()];
    if ($('#FormMarcarPieza').hasClass('estadoMarcarPieza')) {
      if (check.prop("checked")) {
        $('input[name='+check.val()+'Estado]').parent().show();
      }else{
        $('input[name='+check.val()+'Estado]').parent().hide();
        $('#direccionPieza-'+direcccion).hide().removeClass($('#odontograma-contenido').data('marcaclass'));
      }
    }else{
      if (check.prop("checked")) {
        $('#direccionPieza-'+direcccion).show().addClass($('#odontograma-contenido').data('marcaclass'));
        if (propiedades.giro) {
          $('#direccionPieza-'+direcccion).addClass('giro')
        }
      }else{
        $('#direccionPieza-'+direcccion).hide().removeClass($('#odontograma-contenido').data('marcaclass'));
      }
    }
  
  });
  
  $('#FormMarcarPieza input[type=radio]').click(function(event) {
    var estado = $(this).val();
    var num_diente = $('#FormHistoriaMovimientoAgregarHallazgo input[name=diente]').val();
    var propiedades = piezas[num_diente];
    
    var marcador = $(this).parent().siblings('.checkbox-inline').find('input').val();
    var direcccion = propiedades[marcador];
    $('#direccionPieza-'+direcccion).removeClass('bueno malo');
    $('#direccionPieza-'+direcccion).show().addClass($('#odontograma-contenido').data('marcaclass')+' '+estado);
    if (propiedades.giro) {
      $('#direccionPieza-'+direcccion).addClass('giro')
    }
  });
  
  
  $('#odontograma').on('click', '#odontograma-contenido.inicio .cursor', function(event) {
    event.preventDefault();
    $('#odontograma-contenido.inicio').removeClass('inicio').addClass('fin');
    $(this).addClass('inicioSelec');
    var diente = $(this).data('diente');
  
    $('#FormHistoriaMovimientoAgregarHallazgo input[name="diente"]').val(diente);
  });
  
  $('#odontograma').on('click', '#odontograma-contenido.fin .cursor', function(event) {
    event.preventDefault();
    var inicio = parseInt($('#odontograma-contenido .inicioSelec').data('orden'));
    var fin = parseInt($(this).data('orden'));
  
    if (fin<inicio) {
      Swal.fire({
        title: "Error",
        html: "El diente final se debe seleccionar hacia la parte derecha <span class='fa fa-arrow-right'></span>",
        type: "error",
      });
      return;
    }
    var diente = $(this).data('diente');
  
    $('#FormHistoriaMovimientoAgregarHallazgo input[name="dienteFinal"]').val(diente);
    $('#colDienteFinal').show();
    $('#ModalAgregarHallazgo').modal('show');
  });
  /*=====  End of SELECCIONANDO EL DIENTE  ======*/
  
  /*=========================================
  =            DETALLE DE DIENTE            =
  =========================================*/

  $('#odontograma').on('click', '#odontograma-contenido.detalle .cursor', function(event) {
    event.preventDefault();
    $('#ModalOdontogramaDetalle table>tbody').html('');
    var diente = $(this).data('diente');
    var paciente = $('#HistoriaContenido').data('paciente');
    var tipoOdontograma = $('#FormHistoriaMovimientoAgregarHallazgo input[name=tipoOdontograma]').val();
    console.log(tipoOdontograma);
    $('#ModalOdontogramaDetalle').modal('show');
    $.getJSON('/getHallazgosDientePaciente', {paciente,diente,tipoOdontograma}, function(json, textStatus) {
        var hallazgos = '';
        $.each(json, function(index, val) {
          var estado = '';
          if (val['estado']!= null) {
            if (val['estado']=='bueno') {
              estado = 'Buen Estado';
            }else{
              estado = 'Mal Estado';
            }
          }
  
          var marcas = '';
          if (val['marcas']!='') {
            $.each(jQuery.parseJSON(val['marcas']), function(index, val) {
              if (val['Estado']=='malo') {
                var estadoMarca = 'text-danger';
              }else{
                var estadoMarca = 'text-primary';
              }
              marcas += `<span class="${estadoMarca}">${index}</span> `;
            });
          }
  
          hallazgos += `
            <tr>
              <td>${(val['sigla']!=null)?'<b>'+val['sigla']+':</b>':''} ${val['nombre_hal']}</td>
              <td>${ (val['categoria']!=null)?val['categoria']:'' }</td>
              <td>${ val['dienteInicio'] }</td>
              <td>${ (val['dienteFinal']!=null)?val['dienteFinal']:'' }</td>
              <td>${ estado }</td>
              <td>${ marcas }</td>
              <td>${ val['especificaciones'] }</td>
              <td><button data-id='${ val['pacodo_id'] }'' class="eliminar-hallazgo btn btn-xs btn-danger btn-fill"><i class="fa fa-trash"></i></button></td>
            <tr>
          `;
        });
        $('#ModalOdontogramaDetalle table>tbody').html(hallazgos);
    });
  });
  
  $('#ModalOdontogramaDetalle table>tbody').on('click', '.eliminar-hallazgo', function(event) {
    event.preventDefault();
    var fila = $(this).parent().parent();
    var id = $(this).data('id');
    var paciente = $('#HistoriaContenido').data('paciente');
  
    Swal.fire({
      title: "Confirmar Eliminar",
      type: "warning",
      cancelButtonText:'No, Cancelar',
      confirmButtonText:'Si, Eliminar',
      showCancelButton: true,
      confirmButtonColor: "#007AFF",
      cancelButtonColor: "#d43f3a",
      text: '¿Estas seguro de eliminar el hallazgo?'
    }).then((result) => {
      if (result.value) {
        $.getJSON(path+'historia/movimiento/eliminarHallazgo', {id,paciente}, function(json, textStatus) {
            if (json.success) {
              fila.remove();
              $('#odontograma-contenido .hallazgo-'+id).remove();
              Swal.fire({
                title: "Buen trabajo",
                text: "La solicitud ha sido procesada.",
                type: "success"
              });
              $('html, body').animate({scrollTop:1000});
              $('html, body').animate({scrollTop:0});
              setTimeout(function() {
                guardarImagenOdontograma();
              }, 1000);
            }else{
              Swal.fire({
                title: "Error",
                text: "Ha ocurrido un error.",
                type: "error"
              });
            }
        });
        
      }
    })
  
  
  
  });
  /*=====  End of DETALLE DE DIENTE  ======*/
  
  
  /*========================================
  =            AGREGAR HALLAZGO            =
  ========================================*/
  $('#FormHistoriaMovimientoAgregarHallazgo').validate({
    ignore: [],
    rules: {
      diente:{required:true},
    },
    submitHandler:function() {
      $('html, body').animate({scrollTop:1000});
      $('html, body').animate({scrollTop:0});
      $('#ModalAgregarHallazgo').modal('hide');
      var data = $('#FormHistoriaMovimientoAgregarHallazgo').serialize();
      //$('input').iCheck('disable');
      //$('#FormHistoriaMovimientoAgregarHallazgo input, #FormHistoriaMovimientoAgregarHallazgo button').attr('disabled','true');
      $('#ajax-icon').removeClass('fa fa-edit').addClass('fa fa-spin fa-refresh');
      Pace.track(function () {
        $.ajax({
          url: $('#FormHistoriaMovimientoAgregarHallazgo #_url').val(),
          headers: {'X-CSRF-TOKEN': $('#FormHistoriaMovimientoAgregarHallazgo #_token').val()},
          type: 'POST',
          cache: false,
          data: data,
           success: function (response) {
            var json = $.parseJSON(response);
            if(json.success){
              $('#FormHistoriaMovimientoAgregarHallazgo #submit').hide();
              $('#FormHistoriaMovimientoAgregarHallazgo #edit-button').attr('href', $('#FormHistoriaMovimientoAgregarHallazgo #_url').val() + '/' + json.user_id + '/edit');
              $('#FormHistoriaMovimientoAgregarHallazgo #edit-button').removeClass('hide');
              pintarHallazgos(json.data);
              $('body').css('padding-right:0');
              $('#FormHistoriaMovimientoAgregarHallazgo textarea[name=especificaciones]').val('');
              //$('#BotonSeleccion').trigger('click');
              if ($('#odontograma-contenido').hasClass('fin')) {
      
                $('#odontograma-contenido').removeClass('fin');
                $('#odontograma-contenido').addClass('inicio');
                $('.cursor').removeClass('inicioSelec');
              }
              setTimeout(function() {
                guardarImagenOdontograma();
              }, 1000);
              //toastr.success('Datos modificados exitosamente');
              //$('#FormHistoriaMovimientoAgregarHallazgo input, #FormHistoriaMovimientoAgregarHallazgo button').attr('disabled','false');
              _alertGeneric('success','Muy bien! ','Examen Extra Oral Guardado Correctamente',null);
              
            }
          },error: function (data) {
            var errors = data.responseJSON;
            console.log(errors);
            $.each( errors.errors, function( key, value ) {
              toastr.error(value);
              return false;
            });
            $('input').iCheck('enable');
            //$('#FormHistoriaMovimientoAgregarHallazgo input, #FormHistoriaMovimientoAgregarHallazgo button').removeAttr('disabled');
            $('#ajax-icon').removeClass('fa fa-spin fa-refresh').addClass('fa fa-save');
            //$('#FormHistoriaMovimientoAgregarHallazgo input, #FormHistoriaMovimientoAgregarHallazgo button').attr('disabled','false');
          }
       });
    });
      
    
    }
  });
  
  $('#TipoOdontogramaSpan').click(function(event) {
    guardarImagenOdontograma();
  });
  
  function guardarImagenOdontograma()
  {	
    html2canvas(document.querySelector("#OdontogramaImprimir")).then(canvas => {
      var imgData = canvas.toDataURL('image/png');
      
      var imagen = imgData.replace('data:image/png:base64,','');
      var img = `<img src="${imagen}" style="width:100%">`;
      
      var paciente = $('#HistoriaContenido').data('paciente');
      var tipo = $('#FormHistoriaMovimientoAgregarHallazgo input[name=tipoOdontograma]').val();
      $.ajax({
        url: path+'historia/movimiento/guardarImagenOdontograma',
        type: 'POST',
        dataType: 'JSON',
        data: {imgData,paciente,tipo},
      })
      .done(function() {
        console.log("success");
      })
      .fail(function() {
        console.log("error");
      })
      .always(function() {
        console.log("complete");
      });
    });
  }
  
  /*=====  End of AGREGAR HALLAZGO  ======*/
  
  
  /*=================================================
  =            PINTAR ODONTOGRAMA ACTUAL            =
  =================================================*/
  var paciente = $('#HistoriaContenido').data('paciente');
  var tipoOdontograma = $('#FormHistoriaMovimientoAgregarHallazgo input[name=tipoOdontograma]').val();
 
  });
  /*=====  End of PINTAR ODONTOGRAMA ACTUAL  ======*/
  
  /*========================================
  =            PINTAR HALLAZGOS            =
  ========================================*/
  function pintarHallazgos(val){
    if (val['id_hal'] == 1)
      aparatoOrtoFijo(val['id'],val['inicio'],val['fin'],val['estado'])
    if (val['id_hal'] == 2)
      aparatoOrtoRemovible(val['id'],val['inicio'],val['fin'],val['estado'])
    if (val['id_hal'] == 3)
      corona(val['id'],val['inicio'],val['estado'],val['sigla'])
    if (val['id_hal'] == 37)
      coronaTemporal(val['id'],val['inicio'],val['estado'],val['sigla'])
    if (val['id_hal'] == 5)
      defectosDesarrolloEsmalte(val['id'],val['inicio'],val['estado'],val['sigla'])
    if (val['id_hal'] == 17)
      diastema(val['id'],val['inicio'])
    if (val['id_hal'] == 9)
      piezaAusente(val['id'],val['inicio'])
    if (val['id_hal'] == 21)
      piezaEctopica(val['id'],val['inicio'],val['sigla'])
    if (val['id_hal'] == 20)
      piezaClavija(val['id'],val['inicio'])
    if (val['id_hal'] == 10)
      piezaErupcion(val['id'],val['inicio'])
    if (val['id_hal'] == 15)
      piezaExtruida(val['id'],val['inicio'])
    if (val['id_hal'] == 16)
      piezaIntruida(val['id'],val['inicio'])
    if (val['id_hal'] == 14)
      piezaSupernumeraria(val['id'],val['inicio'])
    if (val['id_hal'] == 13)
      edentuloTotal(val['id'],val['inicio'],val['fin'])
    if (val['id_hal'] == 30)
      espigoMunon(val['id'],val['inicio'],val['estado'])
    if (val['id_hal'] == 8)
      fosasFisurasProfundas(val['id'],val['inicio'])
    if (val['id_hal'] == 7)
      fractura(val['id'],val['inicio'],val['categoria'])
    if (val['id_hal'] == 24)
      fusion(val['id'],val['inicio'])
    if (val['id_hal'] == 25)
      geminasion(val['id'],val['inicio'])
    if (val['id_hal'] == 18)
      giroversion(val['id'],val['inicio'],val['categoria'])
    if (val['id_hal'] == 26)
      impactacion(val['id'],val['inicio'])
    if (val['id_hal'] == 31)
      implanteDental(val['id'],val['inicio'],val['estado'])
    if (val['id_hal'] == 22)
      macrodoncia(val['id'],val['inicio'])
    if (val['id_hal'] == 23)
      microdoncia(val['id'],val['inicio'])
    if (val['id_hal'] == 29)
      movilidadPatologica(val['id'],val['inicio'],val['sigla'])
    if (val['id_hal'] == 19)
      posicionDentaria(val['id'],val['inicio'],val['sigla'])
    if (val['id_hal'] == 32)
      protesisFija(val['id'],val['inicio'],val['fin'],val['estado'])
    if (val['id_hal'] == 33)
      protesisRemovible(val['id'],val['inicio'],val['fin'],val['estado'])
    if (val['id_hal'] == 34)
      protesisTotal(val['id'],val['inicio'],val['fin'],val['estado'])
    if (val['id_hal'] == 28)
      remanenteRadicular(val['id'],val['inicio'])
    if (val['id_hal'] == 27)
      superficieDesgastada(val['id'],val['inicio'])
    if (val['id_hal'] == 36)
      transposicion(val['id'],val['inicio'])
    if (val['id_hal'] == 35)
      tratamientoPulpar(val['id'],val['inicio'],val['estado'],val['sigla'])
    if (val['id_hal'] == 4)
      lesionCaries(val['id'],val['inicio'],val['sigla'],val['diente'],val['marcas'])
    if (val['id_hal'] == 12)
      restauracionTemporal(val['id'],val['inicio'],val['diente'],val['marcas'])
    if (val['id_hal'] == 11)
      restauracionDefinitiva(val['id'],val['inicio'],val['diente'],val['marcas'],val['sigla'])
    if (val['id_hal'] == 6)
      sellantes(val['id'],val['inicio'],val['diente'],val['marcas'],'S')
  
    //console.log(val);
    
  }
  /*=====  End of PINTAR HALLAZGOS  ======*/
  
  
  
  /*============================================
  =            PINTAR CADA HALLAZGO            =
  ============================================*/
  function sellantes($id,$inicio,$diente,$marcas,$sigla){
    var sigla = `<span class="hallazgo-${$id}">${$sigla},</span>`;
    $('.recuadro-'+$inicio).append(sigla);
    $.each(jQuery.parseJSON($marcas), function(index, val) {
      if (piezas[$diente]['OclusalStatus']) {
        var tipoPieza = 'centro';
      }else{
        var tipoPieza = 'nocentro';
      }
      var direccion = piezas[$diente][String(index)];
      var hallazgo = ` <div class="hallazgos hallazgo-${$id} sellantes ${val['Estado']}  direccion-${ direccion } ${ tipoPieza } direccion-${ direccion+'-'+$inicio }"></div>`;
      $('#odontograma-contenido').append(hallazgo);
    });
  }
  
  function restauracionDefinitiva($id,$inicio,$diente,$marcas,$sigla){
    var sigla = `<span class="malo hallazgo-${$id}">${$sigla},</span>`;
    $('.recuadro-'+$inicio).append(sigla);
    $.each(jQuery.parseJSON($marcas), function(index, val) {
      if (piezas[$diente]['OclusalStatus']) {
        var tipoPieza = 'centro';
      }else{
        var tipoPieza = 'nocentro';
      }
      var direccion = piezas[$diente][String(index)];
      var hallazgo = ` <div class="hallazgos hallazgo-${$id} restauracionDefinitiva ${val['Estado']} direccion-${ direccion } ${ tipoPieza } direccion-${ direccion+'-'+$inicio }"></div>`;
      $('#odontograma-contenido').append(hallazgo);
    });
  }
  
  function restauracionTemporal($id,$inicio,$diente,$marcas){
    $.each(jQuery.parseJSON($marcas), function(index, val) {
      if (piezas[$diente]['OclusalStatus']) {
        var tipoPieza = 'centro';
      }else{
        var tipoPieza = 'nocentro';
      }
      var direccion = piezas[$diente][String(index)];
      var hallazgo = ` <div class="hallazgos hallazgo-${$id} restauracionTemporal direccion-${ direccion } ${ tipoPieza } direccion-${ direccion+'-'+$inicio }"></div>`;
      $('#odontograma-contenido').append(hallazgo);
    });
  }
  
  function lesionCaries($id,$inicio,$sigla,$diente,$marcas){
    var sigla = `<span class="malo hallazgo-${$id}">${$sigla},</span>`;
    $('.recuadro-'+$inicio).append(sigla);
    $.each(jQuery.parseJSON($marcas), function(index, val) {
      if (piezas[$diente]['OclusalStatus']) {
        var tipoPieza = 'centro';
      }else{
        var tipoPieza = 'nocentro';
      }
      var direccion = piezas[$diente][String(index)];
      var hallazgo = ` <div class="hallazgos hallazgo-${$id} lesionCaries direccion-${ direccion } ${ tipoPieza } direccion-${ direccion+'-'+$inicio }"></div>`;
      $('#odontograma-contenido').append(hallazgo);
    });
  }
  
  function tratamientoPulpar($id,$inicio,$estado,$sigla){
    if ($sigla=='TC' || $sigla=='PC') {
      var hallazgo = `<div class="hallazgos hallazgo-${$id} tratamientoPulparTC-PC ${$estado} tratamientoPulparTC-PC-${$inicio}"></div>`;
    }else if($sigla=='PP'){
      var hallazgo = `<div class="hallazgos hallazgo-${$id} tratamientoPulparPP ${$estado} tratamientoPulparPP-${$inicio}"></div>`;
    }
    $('#odontograma-contenido').append(hallazgo);
    var sigla = `<span class="${$estado} hallazgo-${$id}">${$sigla},</span>`;
    $('.recuadro-'+$inicio).append(sigla);
  }
  
  function transposicion($id,$inicio,){
    var hallazgo = `<div class="hallazgos hallazgo-${$id} transposicion transposicion-${$inicio}"></div>`;
    $('#odontograma-contenido').append(hallazgo);
  }
  
  function superficieDesgastada($id,$inicio){
    var sigla = `<span class="malo hallazgo-${$id}">DES,</span>`;
    $('.recuadro-'+$inicio).append(sigla);
  }
  
  function remanenteRadicular($id,$inicio){
    var sigla = `<span class="malo hallazgo-${$id}">RR,</span>`;
    $('.recuadro-'+$inicio).append(sigla);
  }
  
  function protesisTotal($id,$inicio,$fin,$estado){
    var hallazgo = '';
    for (var i = parseInt($inicio); i <= parseInt($fin); i++) {
      hallazgo += `<div class="hallazgos hallazgo-${$id}  protesisTotal  ${$estado} protesisTotal-${i}"></div>`;
    }
    $('#odontograma-contenido').append(hallazgo);
  }
  
  function protesisRemovible($id,$inicio,$fin,$estado){
    console.log('holaa');
    var hallazgo = '';
    for (var i = parseInt($inicio); i <= parseInt($fin); i++) {
      hallazgo += `<div class="hallazgos hallazgo-${$id}  protesisRemovible  ${$estado} protesisRemovible-${i}"></div>`;
    }
    $('#odontograma-contenido').append(hallazgo);
  }
  
  function protesisFija($id,$inicio,$fin,$estado){
    var inicio = `<div class="hallazgos hallazgo-${$id} protesisFijaInicio ${$estado} protesisFijaInicio-${$inicio}"></div>`;
  
    var lineaInicio = parseInt($inicio)+1;
    var lineaFin = parseInt($fin)-1;
    var linea = '';
    for (var i = lineaInicio; i <= lineaFin; i++) {
      linea += `<div class="hallazgos hallazgo-${$id} linea ${$estado} linea-${i}"></div>`;
    }
  
    var fin = `<div class="hallazgos hallazgo-${$id} protesisFijaFin ${$estado} protesisFijaFin-${$fin}"></div>`;
  
    $('#odontograma-contenido').append(inicio+linea+fin);
  }
  
  function posicionDentaria($id,$inicio,$sigla){
    var sigla = `<span class="bueno hallazgo-${$id}">${$sigla},</span>`;
    $('.recuadro-'+$inicio).append(sigla);
  }
  
  function movilidadPatologica($id,$inicio,$sigla){
    var sigla = `<span class="malo hallazgo-${$id}">${$sigla},</span>`;
    $('.recuadro-'+$inicio).append(sigla);
  }
  
  function microdoncia($id,$inicio){
    var sigla = `<span class="bueno hallazgo-${$id}">MIC,</span>`;
    $('.recuadro-'+$inicio).append(sigla);
  }
  
  function macrodoncia($id,$inicio){
    var sigla = `<span class="bueno hallazgo-${$id}">MAC,</span>`;
    $('.recuadro-'+$inicio).append(sigla);
  }
  
  function implanteDental($id,$inicio,$estado){
    var sigla = `<span class="${ $estado } hallazgo-${$id}">IMP,</span>`;
    $('.recuadro-'+$inicio).append(sigla);
  }
  
  function impactacion($id,$inicio){
    var sigla = `<span class="bueno hallazgo-${$id}">I,</span>`;
    $('.recuadro-'+$inicio).append(sigla);
  }
  
  function giroversion($id,$inicio,$categoria){
    var hallazgo = `<div class="hallazgos hallazgo-${$id} giroversion giroversion${$categoria} giroversion${$categoria+'-'+$inicio}"></div>`;
    $('#odontograma-contenido').append(hallazgo);
  }
  
  function geminasion($id,$inicio,){
    var hallazgo = `<div class="hallazgos hallazgo-${$id} geminasion geminasion-${$inicio}"></div>`;
    $('#odontograma-contenido').append(hallazgo);
  }
  
  function fusion($id,$inicio,){
    var hallazgo = `<div class="hallazgos hallazgo-${$id} fusion fusion-${$inicio}"></div>`;
    $('#odontograma-contenido').append(hallazgo);
  }
  
  function fractura($id,$inicio,$categoria){
    var cate = '';
    if ($categoria=='Coronal') {
      cate = 'fracturaCoronal';
    }else if($categoria=='Incisal'){
      cate = 'fracturaIncisal';
    }else if($categoria=='Raiz y Coronal'){
      cate = 'fracturaRaizCorona';
    }
    var hallazgo = `<div class="hallazgos hallazgo-${$id} ${cate} ${cate+'-'+$inicio}"></div>`;
    $('#odontograma-contenido').append(hallazgo);
  }
  
  function fosasFisurasProfundas($id,$inicio){
    var sigla = `<span class="bueno hallazgo-${$id}">FFP,</span>`;
    $('.recuadro-'+$inicio).append(sigla);
  }
  
  function espigoMunon($id,$inicio,$estado)
  {
    var hallazgo = `<div class="hallazgos hallazgo-${$id} munon ${$estado} munon-${$inicio}"></div>`;
    $('#odontograma-contenido').append(hallazgo);
  }
  
  function edentuloTotal($id,$inicio,$fin){
    var hallazgo = '';
    for (var i = parseInt($inicio); i <= parseInt($fin); i++) {
      hallazgo += `<div class="hallazgos hallazgo-${$id}  edentulo edentulo-${i}"></div>`;
    }
    $('#odontograma-contenido').append(hallazgo);
  }
  
  function piezaSupernumeraria($id,$inicio){
    var hallazgo = `<div class="hallazgos hallazgo-${$id} piezaSupernumeraria piezaSupernumeraria-${$inicio}"></div>`;
    $('#odontograma-contenido').append(hallazgo);
  }
  
  function piezaIntruida($id,$inicio){
    var hallazgo = `<div class="hallazgos hallazgo-${$id} piezaIntruida piezaIntruida-${$inicio}"></div>`;
    $('#odontograma-contenido').append(hallazgo);
  }
  
  function piezaExtruida($id,$inicio){
    var hallazgo = `<div class="hallazgos hallazgo-${$id} piezaExtruida piezaExtruida-${$inicio}"></div>`;
    $('#odontograma-contenido').append(hallazgo);
  }
  
  function piezaErupcion($id,$inicio){
    var hallazgo = `<div class="hallazgos hallazgo-${$id} erupcion erupcion-${$inicio}"></div>`;
    $('#odontograma-contenido').append(hallazgo);
  }
  
  function piezaClavija($id,$inicio){
    var hallazgo = `<div class="hallazgos hallazgo-${$id} piezaClavija piezaClavija-${$inicio}"></div>`;
    $('#odontograma-contenido').append(hallazgo);
  }
  
  function piezaEctopica($id,$inicio,$sigla){
    var sigla = `<span class="hallazgo-${$id}">E,</span>`;
    $('.recuadro-'+$inicio).append(sigla);
  }
  
  function piezaAusente($id,$inicio){
    var hallazgo = `<div class="hallazgos hallazgo-${$id} piezaAusente piezaAusente-${$inicio}"></div>`;
    $('#odontograma-contenido').append(hallazgo);
  }
  
  function diastema($id,$inicio){
    var hallazgo = `<div class="hallazgos hallazgo-${$id} diastema diastema-${$inicio}"></div>`;
    $('#odontograma-contenido').append(hallazgo);
  }
  
  function defectosDesarrolloEsmalte($id,$inicio,$estado,$sigla){
    var sigla = `<span class="${$estado} hallazgo-${$id}">${$sigla},</span>`;
    $('.recuadro-'+$inicio).append(sigla);
  }
  
  function aparatoOrtoFijo($id,$inicio,$fin,$estado){
    var inicio = `<div class="hallazgos hallazgo-${$id} aparatoOrtoFijoInicio ${$estado} aparatoOrtoFijoInicio-${$inicio}"></div>`;
  
    var lineaInicio = parseInt($inicio)+1;
    var lineaFin = parseInt($fin)-1;
    var linea = '';
    for (var i = lineaInicio; i <= lineaFin; i++) {
      linea += `<div class="hallazgos hallazgo-${$id} linea ${$estado} linea-${i}"></div>`;
    }
  
    var fin = `<div class="hallazgos hallazgo-${$id} aparatoOrtoFijoFin ${$estado} aparatoOrtoFijoFin-${$fin}"></div>`;
  
    $('#odontograma-contenido').append(inicio+linea+fin);
  }
  
  function aparatoOrtoRemovible($id,$inicio,$fin,$estado){
    var hallazgo = '';
    for (var i = parseInt($inicio); i <= parseInt($fin); i++) {
      hallazgo += `<div class="hallazgos hallazgo-${$id} ${$estado} aparatoOrtoRemovible aparatoOrtoRemovible-${i}"></div>`;
    }
    $('#odontograma-contenido').append(hallazgo);
  }
  
  function corona($id,$inicio,$estado,$sigla){
    var hallazgo = `<div class="hallazgos hallazgo-${$id} corona ${$estado} corona-${$inicio}"></div>`;
    $('#odontograma-contenido').append(hallazgo);
    var sigla = `<span class="${$estado} hallazgo-${$id}">${$sigla},</span>`;
    $('.recuadro-'+$inicio).append(sigla);
  }
  
  function coronaTemporal($id,$inicio,$estado,$sigla)
  {
    var hallazgo = `<div class="hallazgos hallazgo-${$id} coronaTemporal ${$estado} coronaTemporal-${$inicio}"></div>`;
    $('#odontograma-contenido').append(hallazgo);
    var sigla = `<span class="${$estado} hallazgo-${$id}">${$sigla},</span>`;
    $('.recuadro-'+$inicio).append(sigla);
  }
  /*=====  End of PINTAR CADA HALLAZGO  ======*/
  
  /*======================================================
  =            GUARDAR DETALLE DE ODONTOGRAMA            =
  ======================================================*/
  $('#GuardarDetalle').click(function(event) {
    var paciente = $('#HistoriaContenido').data('paciente');
    var detalle = $('#TextAreaDetalle').val();
    $.ajax({
      url: path+'historia/movimiento/guardarDetalleOdontograma',
      type: 'POST',
      dataType: 'JSON',
      data: {paciente,detalle},
    })
    .done(function(resp) {
      if (resp.success) {
        Swal.fire({
          title: "Buen trabajo",
          text: "La solicitud ha sido procesada.",
          type: "success",
          timer: 2500
        });
      }
    });
    
  });
  /*=====  End of GUARDAR DETALLE DE ODONTOGRAMA  ======*/
  
  /*====================================================
  =            SELECCIONAR TIPO ODONTOGRAMA            =
  ====================================================*/
  $('#tipoOdontograma li').click(function(event) {
    $('#TipoOdontogramaSpan').html($(this).data('tipo'));
    $('#FormHistoriaMovimientoAgregarHallazgo input[name=tipoOdontograma]').val($(this).data('tipo'));
    var paciente = $('#HistoriaContenido').data('paciente');
    var tipoOdontograma = $(this).data('tipo');
    $.ajax({
      url: path+'historia/movimiento/cambiarTipoOdontograma',
      type: 'GET',
      dataType: 'JSON',
      data:{paciente,tipoOdontograma}
    })
    .done(function(resp) {
      $('.hallazgos').remove();
      $('#cursoresRecuadros').empty().html(resp['html']);
      $.each(resp['odontograma'], function(index, val) {
        pintarHallazgos(val);
      });	
    })
    
  });
  /*=====  End of SELECCIONAR TIPO ODONTOGRAMA  ======*/
  
  /*============================================
  =            IMPRIMIR ODONTOGRAMA            =
  ============================================*/
  
  
  /*============================================
  =            CAPTURAR ODONTOGRAMA            =
  ============================================*/
  $('#CapturarOdontograma').click(function(event) {
    $(this).text('Procesando').prop('disabled',true);
    html2canvas(document.querySelector("#OdontogramaImprimir")).then(canvas => {
      var imgData = canvas.toDataURL('image/png');
      
      var imagen = imgData.replace('data:image/png:base64,','');
      var img = `<img src="${imagen}" style="width:100%">`;
  
      var paciente = $('#HistoriaContenido').data('paciente');
      var tipo = $('#FormHistoriaMovimientoAgregarHallazgo input[name=tipoOdontograma]').val();
      $('#FormGuardarCapturaOdontograma input[name=paciente]').val(paciente);
      $('#FormGuardarCapturaOdontograma input[name=tipo]').val(tipo);
      $('#FormGuardarCapturaOdontograma input[name=imgData]').val(imgData);
  
      $('#ImagenOdontogramaCapturado').html(img);
      $('#ModalCapturarOdontograma').modal('show');
      $(this).text('Capturar Odont.').prop('disabled',false);
    });
  });
  
  $('#FormGuardarCapturaOdontograma').validate({
    ignore: [],
    rules: {
      paciente:{required:true},
      tipo:{required:true},
      imgData:{required:true}
    },
    submitHandler:function() {
      enviarFormulario('#FormGuardarCapturaOdontograma',function(resp){
        if (resp.success) {
          $('#ModalCapturarOdontograma').modal('hide');
        }
      })
    }
  });
  /*=====  End of CAPTURAR ODONTOGRAMA  ======*/
  

