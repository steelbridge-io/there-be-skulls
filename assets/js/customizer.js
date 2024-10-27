(function($) {
    wp.customize.bind('ready', function() {
        $('input[type="text"]').each(function() {
            var $this = $(this);
            var maxLength = 40;
            var $counter = $('<span class="char-counter"></span>').insertAfter($this);

            $this.on('input', function() {
                var length = $this.val().length;
                if (length > maxLength) {
                    $this.val($this.val().substring(0, maxLength));
                    length = maxLength;
                    alert('The text is too long. It has been truncated to 40 characters.');
                }
                $counter.text(length + '/40');
            });

            // Initial counter update
            $counter.text($this.val().length + '/40');
        });
    });
})(jQuery);