 // IIFE - Immediately Invoked Function Expression
 (function(dtfj) {
    dtfj(window.jQuery, window, document);
}(function($, window, document) {
    $(function() {
        $('.dropdown ul').each(function() {
            $(this).addClass('dropdown-menu');
        });

        $('#sidebar nav ul').each(function() {
            $(this).addClass('nav');
        });

        $('a.external-link').on('click', function(event) {
            event.preventDefault();
            event.stopPropagation();
            window.open(this.href, '_blank');
        });
    })
}));