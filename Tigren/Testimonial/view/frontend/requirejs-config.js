/*
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright Copyright (c) 2024 Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 *
 */
var config = {
    map: {
        '*': {
            customJs: 'Tigren_Testimonial/example1',
            customJs1: 'Tigren_Testimonial/example2',
            'fisheyeAcademy/widget-example': 'Tigren_Testimonial/js/widget-example'
        }
    },
    shim: {
        'Tigren_Testimonial/js/legacy': { // Non-AMD module
            deps: ['jquery'], // Phụ thuộc vào jQuery
            exports: 'legacyFunction'
        }
    }
};
