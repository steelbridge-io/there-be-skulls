jQuery(window).on('load', function() {
    jQuery(document).ready(function($) {
        console.log('Document ready');

        // Event listener for dynamically loaded gallery images using event delegation
        $(document).on('click', '.flex-control-nav.flex-control-thumbs li img', function(e) {
            e.preventDefault();
            console.log('Thumbnail image clicked');

            // Get index of clicked thumbnail
            var imageIndex = $(this).closest('li').index();
            console.log('Image index:', imageIndex);

            // Attributes to target
            var attributes = ['color', 'size', 'length', 'variation'];

            attributes.forEach(function(attribute) {
                // Target the select element based on the provided HTML structure
                var select = $('select#' + attribute); // Using the id for color, size, length, and variation

                // Check if the select element exists
                if (select.length === 0) {
                    console.log('Select element for ' + attribute + ' not found');
                    return;
                }

                console.log('Select element for ' + attribute + ' found:', select);

                // Find the option that corresponds to the clicked thumbnail
                var options = select.find('option');
                console.log('Options for ' + attribute + ':', options);

                options.prop('selected', false); // Unselect all options

                // Select the correct option based on the index
                if (imageIndex < options.length - 1) {  // Adjust for the "Choose an option" option
                    $(options[imageIndex + 1]).prop('selected', true).change(); // +1 to skip first option
                    console.log('Option selected for ' + attribute + ':', options[imageIndex + 1]);
                } else {
                    console.log('Index out of bounds for ' + attribute);
                }

                // Trigger the WooCommerce variation change events
                select.trigger('change');
            });

            $('.variations_form').trigger('wc_variation_form');
            $('input.variation_id').change();
        });
    });
});