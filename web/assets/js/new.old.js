(function($) {
	$(document).ready(function() {
		var $site = $(document).find('#appbundle_scenario_site');
		$site.change(function() {
			var $form = $(this).closest('form');
			var data = {};
			data[$site.attr('name')] = $site.val();

			$.ajax({
				url : $form.attr('action'),
				type: $form.attr('method'),
				data : data,
				success: function(html) {
					$('#appbundle_scenario_scenarioInquests').parents('.form-group').remove();
					$('#appbundle_scenario_site').parents('.form-group').after($(html).find('#appbundle_scenario_scenarioInquests').parents('.form-group'));

					$('.scenario-inquests').collection({
						add:		'<a href="#" class="collection-add btn btn-default"><span class="glyphicon glyphicon-plus-sign"></a>',
						remove:		'<a href="#" class="collection-add btn btn-default"><span class="glyphicon glyphicon-trash"></a>',
						up:			'<a href="#" class="collection-add btn btn-default"><span class="glyphicon glyphicon-arrow-up"></a>',
						down:		'<a href="#" class="collection-add btn btn-default"><span class="glyphicon glyphicon-arrow-down"></a>',
						after_add: 	function() {
										$('.scenario-inquest-validators').collection({
											add:		'<a href="#" class="btn btn-default"><span class="glyphicon glyphicon-plus-sign"></a>',
											remove:		'<a href="#" class="collection-add btn btn-default"><span class="glyphicon glyphicon-trash"></a>',
											up:			'<a href="#" class="collection-add btn btn-default"><span class="glyphicon glyphicon-arrow-up"></a>',
											down:		'<a href="#" class="collection-add btn btn-default"><span class="glyphicon glyphicon-arrow-down"></a>'
										});
									}
					});
				}
			});
		});
	});
})(jQuery);