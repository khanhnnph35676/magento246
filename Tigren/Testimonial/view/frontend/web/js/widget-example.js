/*
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright Copyright (c) 2024 Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 *
 */
define([
    'jquery',
    'jquery/ui'
], function ($) {
    'use strict';

    $.widget('fisheyeAcademy.widgetExample', {
        options: {},

        _create: function () {
            var self = this;

            this._on({
                'click [data-role="showContent"]': function () {
                    self._showContent();
                },
                'click [data-role="hideContent"]': function () {
                    self._hideContent();
                }
            });
        },

        _showContent: function () {
            this.element.find('[data-role="content"]').show();
        },

        _hideContent: function () {
            this.element.find('[data-role="content"]').hide();
        }
    });

    return $.fisheyeAcademy.widgetExample;
});

