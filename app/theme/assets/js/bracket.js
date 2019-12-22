'use strict';
$(document).ready(function(){

	// This will collapsed sidebar menu on left into a mini icon menu
	$('#btnLeftMenu').on('click', function(){
		var menuText = $('.menu-item-label');

		if($('body').hasClass('collapsed-menu')) {
			$('body').removeClass('collapsed-menu');

			// show current sub menu when reverting back from collapsed menu
			$('.show-sub + .br-menu-sub').slideDown();

			$('.br-sideleft').one('transitionend', function(e) {
				menuText.removeClass('op-lg-0-force');
				menuText.removeClass('d-lg-none');
			});

		} else {
			$('body').addClass('collapsed-menu');

			// hide toggled sub menu
			$('.show-sub + .br-menu-sub').slideUp();

			menuText.addClass('op-lg-0-force');
			$('.br-sideleft').one('transitionend', function(e) {
				menuText.addClass('d-lg-none');
			});
		}
		return false;
	});

	// This will expand the icon menu when mouse cursor points anywhere
	// inside the sidebar menu on left. This will only trigget to left sidebar
	// when it's in collapsed mode (the icon only menu)
	$(document).on('mouseover', function(e){
		e.stopPropagation();

		if($('body').hasClass('collapsed-menu') && $('#btnLeftMenu').is(':visible')) {
			var targ = $(e.target).closest('.br-sideleft').length;
			if(targ) {
				$('body').addClass('expand-menu');

				// show current shown sub menu that was hidden from collapsed
				$('.show-sub + .br-menu-sub').slideDown();

				var menuText = $('.menu-item-label');
				menuText.removeClass('d-lg-none');
				menuText.removeClass('op-lg-0-force');

			} else {
				$('body').removeClass('expand-menu');

				// hide current shown menu
				$('.show-sub + .br-menu-sub').slideUp();

				var menuText = $('.menu-item-label');
				menuText.addClass('op-lg-0-force');
				menuText.addClass('d-lg-none');
			}
		}
	});

	// This will show sub navigation menu on left sidebar
	// only when that top level menu have a sub menu on it.
	$('.br-menu-link').on('click', function(){
		var nextElem = $(this).next();
		var thisLink = $(this);

		if(nextElem.hasClass('br-menu-sub')) {

			if(nextElem.is(':visible')) {
				thisLink.removeClass('show-sub');
				nextElem.slideUp();
			} else {
				$('.br-menu-link').each(function(){
					$(this).removeClass('show-sub');
				});

				$('.br-menu-sub').each(function(){
					$(this).slideUp();
				});

				thisLink.addClass('show-sub');
				nextElem.slideDown();
			}
			return false;
		}
	});

	// This will trigger only when viewed in small devices
	// #btnLeftMenuMobile element is hidden in desktop but
	// visible in mobile. When clicked the left sidebar menu
	// will appear pushing the main content.
	$('#btnLeftMenuMobile').on('click', function(){
		$('body').addClass('show-left');
		return false;
	});

	// This is the right menu icon when it's clicked, the
	// right sidebar will appear that contains the four tab menu
	$('#btnRightMenu').on('click', function(){
		$('body').addClass('show-right');
		return false;
	});

	// This will hide sidebar when it's clicked outside of it
	$(document).on('click', function(e){
		e.stopPropagation();
		// closing left sidebar
		if($('body').hasClass('show-left')) {
			var targ = $(e.target).closest('.br-sideleft').length;
			if(!targ) {
				$('body').removeClass('show-left');
			}
		}
		// closing right sidebar
		if($('body').hasClass('show-right')) {
			var targ = $(e.target).closest('.br-sideright').length;
			if(!targ) {
				$('body').removeClass('show-right');
			}
		}
	});

	$(".alert").delay(10000).slideUp(500, function() {
		$(this).alert('close');
	});

	// custom scrollbar style
	if($().perfectScrollbar){
		$('.overflow-y-auto').perfectScrollbar();
	}

	if($().switchButton){
		$('.switch-button').switchButton();
	}

	// mask Money
	if($().mask) {
		$('.mask-money').mask("#.##0", {reverse: true});
	}

	// peity charts
	if($().peity){
		$('.peity-bar').peity('bar');
	}

	// highlight syntax highlighter
	if($().highlightBlock){
		$('pre code').each(function(i, block) {
			hljs.highlightBlock(block);
		});
	}
	
	// Initialize tooltip
	if($().tooltip){
		$('[data-toggle="tooltip"]').tooltip({template: '<div class="tooltip" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>'});
	}

	// Initialize popover
	if($().popover){
		$('[data-popover-color="default"]').popover();
	}
	
	// By default, Bootstrap doesn't auto close popover after appearing in the page
	// resulting other popover overlap each other. Doing this will auto dismiss a popover
	// when clicking anywhere outside of it
	$(document).on('click', function (e) {
		$('[data-toggle="popover"],[data-original-title]').each(function () {
			//the 'is' for buttons that trigger popups
			//the 'has' for icons within a button that triggers a popup
			if (!$(this).is(e.target) && $(this).has(e.target).length === 0 && $('.popover').has(e.target).length === 0) {
					(($(this).popover('hide').data('bs.popover')||{}).inState||{}).click = false  // fix for BS 3.3.6
			}
		});
	});

	// Select2 Initialize
	if($().select2) {
		// Select2 without the search
		$('.select-two').select2({
			minimumResultsForSearch: Infinity
		});
		// Select2 by showing the search
		$('.select-two-search').select2({
			minimumResultsForSearch: ''
		});
		// Select2 with tagging support
		$('.select-two-tag').select2({
			tags: true,
			tokenSeparators: [',', ' ']
		});
	}

	// Datepicker
	if($().datepicker) {
		$.datepicker._defaults.onAfterUpdate = null;
		var datepicker__updateDatepicker = $.datepicker._updateDatepicker;
		$.datepicker._updateDatepicker = function (inst) {
			datepicker__updateDatepicker.call(this, inst);
			var onAfterUpdate = this._get(inst, 'onAfterUpdate');
			if (onAfterUpdate) onAfterUpdate.apply((inst.input ? inst.input[0] : null), [(inst.input ? inst.input.val() : ''), inst]);
		}

		$('.form-control-datepicker').datepicker({dateFormat:'dd M yy'});
		if($('.daterange div').length > 0){
			var cur = -1,
			prv = -1;

			$('.daterange div').datepicker({
					//numberOfMonths: 2,
					maxDate: '0',
					dateFormat: 'dd M yy',
					showButtonPanel: true,
					currentText: "A",
					beforeShowDay: function (date) {
							return [true, ((date.getTime() >= Math.min(prv, cur) && date.getTime() <= Math.max(prv, cur)) ? 'date-range-selected' : '')];
					},
					onSelect: function (dateText, inst) {
							var d1, d2;
							prv = cur;
							cur = (new Date(inst.selectedYear, inst.selectedMonth, inst.selectedDay)).getTime();
							if (prv == -1 || prv == cur) {
									prv = cur;
									$('.daterange input').val(dateText);
							} else {
									d1 = $.datepicker.formatDate('dd M yy', new Date(Math.min(prv, cur)), {});
									d2 = $.datepicker.formatDate('dd M yy', new Date(Math.max(prv, cur)), {});
									$('.daterange input').val(d1 + ' - ' + d2);
							}
					},
					onChangeMonthYear: function (year, month, inst) {
							//prv = cur = -1;
					},
					onAfterUpdate: function (inst) {
							$('<button type="button" class="btn btn-primary btn-sm" data-handler="hide" data-event="click">Done</button>')
									.appendTo($('.daterange div .ui-datepicker-buttonpane'))
									.on('click', function () {
									$('.daterange div').hide();
							});
					}
			}).position({
					my: 'left top',
					at: 'left bottom',
					of: $('.daterange input')
			}).hide();

			$('.daterange input').on('focus', function (e) {
					var v = this.value,
							d;
					try {
							if (v.indexOf(' - ') > -1) {
									d = v.split(' - ');
									prv = $.datepicker.parseDate('dd M yy', d[0]).getTime();
									cur = $.datepicker.parseDate('dd M yy', d[1]).getTime();
							} else if (v.length > 0) {
									prv = cur = $.datepicker.parseDate('dd M yy', v).getTime();
							}
					} catch (e) {
							cur = prv = -1;
					}

					if (cur > -1) $('.daterange div').datepicker('setDate', new Date(cur));
					$('.daterange div').datepicker('refresh').show();
			});
		}
	}

	

});