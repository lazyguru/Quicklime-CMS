<?php

use Quicklime\Navigation;

Blade::directive('navbar', function () {
    return '<?php echo Quicklime\Navigation::get(); ?>';
});

