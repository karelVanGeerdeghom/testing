(function($) {
	function makeSortable() {
		$('.appbundle_scenario_scenarioInquests_wrapper').sortable();
	}

	$(document).ready(function() {
		var buttonGroup = '<div class="btn-group pull-right">' +
								'<a href="#" class="btn btn-default delete"><span class="glyphicon glyphicon-trash"></a>' +
								'<a href="#" class="btn btn-default minimize"><span class="glyphicon glyphicon-chevron-up"></a>' +
							'</div>';
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
					$('.appbundle_scenario_scenarioInquests_wrapper').remove();

					var $siteFormGroup = $('#appbundle_scenario_site').parent();
					var $scenarioInquestFormGroup = $(html).find('#appbundle_scenario_scenarioInquests').parent();

					$siteFormGroup.after($scenarioInquestFormGroup);
					$scenarioInquestFormGroup
						.append($('<div class="col-md-1"><a href="#" class="btn btn-default add-scenario-inquest" title="Add Scenario Inquest"><span class="glyphicon glyphicon-plus-sign"></span></a></div>'))
						.append($('<div class="col-md-11 appbundle_scenario_scenarioInquests_wrapper"></div>'))
				}
			})
		});

		$(document).on('click', '.add-scenario-inquest', function(event) {
			var now = parseInt(Date.now());
			var scenarioInquest = $(this).parent().prev().data('prototype')
									.replace(/scenarioInquests___name__/g, 'scenarioInquests_' + now)
									.replace(/\[scenarioInquests\]\[__name__\]/g, '[scenarioInquests][' + now + ']');

			var $scenarioInquest = $(scenarioInquest).addClass('scenario-inquest').addClass('well').addClass('row');
			$scenarioInquest.children('label').remove();
			$scenarioInquest.prepend($('<h4>Scenario Inquest</h4>'));
			$scenarioInquest.prepend($(buttonGroup));

			$scenarioInquest
				.find('.scenario-inquest-validators')
				.parent()
				.append($('<div class="col-md-1"><a href="#" class="btn btn-default add-scenario-inquest-validator" title="Add Scenario Inquest Validator"><span class="glyphicon glyphicon-plus-sign"></span></a></div>'))
				.append($('<div class="col-md-11 appbundle_scenario_scenarioInquestValidators_wrapper"></div>'));

			$(this).parent()
					.next()
					.append($scenarioInquest)
					.sortable();

			event.preventDefault();
		});

		$(document).on('click', '.add-scenario-inquest-validator', function(event) {
			var now = parseInt(Date.now());
			var scenarioInquestValidator = $(this).parent().prev().data('prototype')
											.replace(/scenarioInquestValidators___name__/g, 'scenarioInquestValidators_' + now)
											.replace(/\[scenarioInquestValidators\]\[__name__\]/g, '[scenarioInquestValidators][' + now + ']');

			var $scenarioInquestValidator = $(scenarioInquestValidator).addClass('scenario-inquest-validator').addClass('well').addClass('row');
			$scenarioInquestValidator.children('label').remove();
			$scenarioInquestValidator.prepend($('<h4>Scenario Inquest Validator</h4>'));
			$scenarioInquestValidator.prepend($(buttonGroup));

			$(this).parent()
					.next()
					.append($scenarioInquestValidator)
					.sortable();

			event.preventDefault();
		});

		$(document).on('click', '.minimize', function(event) {
			$(this).parent().nextAll('div').slideUp();
			$(this).removeClass('minimize').addClass('maximize');
			$(this).children().removeClass('glyphicon-chevron-up').addClass('glyphicon-chevron-down');

			event.preventDefault();
		});

		$(document).on('click', '.maximize', function(event) {
			$(this).parent().nextAll('div').slideDown();
			$(this).removeClass('maximize').addClass('minimize');
			$(this).children().removeClass('glyphicon-chevron-down').addClass('glyphicon-chevron-up');

			event.preventDefault();
		});

		$(document).on('click', '.delete', function(event) {
			$(this).parent().parent().remove();

			event.preventDefault();
		});
	});
})(jQuery);