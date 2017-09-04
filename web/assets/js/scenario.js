(function($) {
	var buttonGroup = '<div class="btn-group pull-right">' +
							'<a href="#" class="btn btn-default delete"><span class="glyphicon glyphicon-trash"></a>' +
							'<a href="#" class="btn btn-default minimize"><span class="glyphicon glyphicon-chevron-up"></a>' +
						'</div>';

	function makeSortable() {
		$('.sortable-wrapper').each(function() {
			$(this).sortable({
				stop: function(event, ui) {
					setSortorder(ui.item.parent(), ui.item.children().last().children('input').attr('class'));
				}
			});
		});
	}

	function setSortorder($element, className) {
		var i = 0;
		$element.find('.' + className).each(function() {
			i++;
			$(this).val(i);
		});
	}

	function minimizeAll() {
		$('.minimize').each(function() {
			$(this).trigger('click');
		});
	}

	function maximizeAll() {
		$('.maximize').each(function() {
			$(this).trigger('click');
		});
	}

	function setupUI() {
		var $site = $('#appbundle_scenario_site');
		$site.change(function() {
			var $form = $(this).closest('form');
			var data = {};
			data[$site.attr('name')] = $site.val();

			$.ajax({
				'url': $form.attr('action'),
				'type': $form.attr('method'),
				'data': data,
				success: function(html) {
					$('#appbundle_scenario_scenarioInquests').parent().remove();

					var $siteFormGroup = $('#appbundle_scenario_site').parent();
					var $scenarioInquestFormGroup = $(html).find('#appbundle_scenario_scenarioInquests').parent();

					$siteFormGroup.after($scenarioInquestFormGroup);
					if ($('.add-scenario-inquest').length === 0) {
						$scenarioInquestFormGroup
							.append($('<div class="col-md-1"><a href="#" class="btn btn-default add-scenario-inquest" title="Add Scenario Inquest"><span class="glyphicon glyphicon-plus-sign"></span></a></div>'))
							.append($('<div class="col-md-11 appbundle_scenario_scenarioInquests_wrapper sortable-wrapper"></div>'));
					}
				}
			})
		});

		$(document).on('click', '.add-scenario-inquest', function(event) {
			var now = 0;//parseInt(Date.now());
			var scenarioInquest = $(this).parent().prev().data('prototype')
									.replace(/scenarioInquests___name__/g, 'scenarioInquests_' + now)
									.replace(/\[scenarioInquests\]\[__name__\]/g, '[scenarioInquests][' + now + ']');

			var $scenarioInquest = $(scenarioInquest).addClass('scenario-inquest').addClass('well').addClass('row');
			$scenarioInquest.children('label').remove();
			$scenarioInquest.prepend($('<h4><small>Scenario Inquest</small> <span></span></h4>'));
			$scenarioInquest.prepend($(buttonGroup));

			$scenarioInquest
				.find('.scenario-inquest-validators')
				.parent()
				.append($('<div class="col-md-1"><a href="#" class="btn btn-default add-scenario-inquest-validator" title="Add Scenario Inquest Validator"><span class="glyphicon glyphicon-plus-sign"></span></a></div>'))
				.append($('<div class="col-md-11 appbundle_scenario_scenarioInquestValidators_wrapper sortable-wrapper"></div>'));

			$(this).parent()
					.next()
					.append($scenarioInquest);

			makeSortable();
			setSortorder($(this).parent().next(), 'scenario-inquest-sortorder');

			event.preventDefault();
		});

		$(document).on('click', '.add-scenario-inquest-validator', function(event) {
			var now = 0;//parseInt(Date.now());
			var scenarioInquestValidator = $(this).parent().prev().data('prototype')
											.replace(/scenarioInquestValidators___name__/g, 'scenarioInquestValidators_' + now)
											.replace(/\[scenarioInquestValidators\]\[__name__\]/g, '[scenarioInquestValidators][' + now + ']');

			var $scenarioInquestValidator = $(scenarioInquestValidator).addClass('scenario-inquest-validator').addClass('well').addClass('row');
			$scenarioInquestValidator.children('label').remove();
			$scenarioInquestValidator.prepend($('<h4><small>Scenario Inquest Validator</small> <span></span></h4>'));
			$scenarioInquestValidator.prepend($(buttonGroup));

			$(this).parent()
					.next()
					.append($scenarioInquestValidator);

			makeSortable();
			setSortorder($(this).parent().next(), 'scenario-inquest-validator-sortorder');

			event.preventDefault();
		});

		$(document).on('click', '.minimize', function(event) {
			$(this).parent().next('h4').children('span').fadeIn();
			$(this).parent().nextAll('div').slideUp();
			$(this).removeClass('minimize').addClass('maximize');
			$(this).children().removeClass('glyphicon-chevron-up').addClass('glyphicon-chevron-down');

			event.preventDefault();
		});

		$(document).on('click', '.maximize', function(event) {
			$(this).parent().next('h4').children('span').fadeOut();
			$(this).parent().nextAll('div').slideDown();
			$(this).removeClass('maximize').addClass('minimize');
			$(this).children().removeClass('glyphicon-chevron-down').addClass('glyphicon-chevron-up');

			event.preventDefault();
		});

		$(document).on('click', '.delete', function(event) {
			$(this).parent().parent().remove();

			event.preventDefault();
		});

		$(document).on('change', '.scenario-inquest-dropdown, .scenario-inquest-validator-dropdown', function() {
			console.log('ier');
			var choice = $(this).val() ? $(this).find(':selected').html() : '';
			$(this).parent().parent().prev('h4').children('span').css('display', 'none').html(choice);
		});
	}

	$(document).ready(function() {
		setupUI();
		makeSortable();
	});
})(jQuery);