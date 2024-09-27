define([
    'Magento_Ui/js/form/element/ui-select',
    'uiRegistry',
], function (Select, uiRegistry) {
    'use strict';
    return Select.extend({
        defaults: {
            mapper: []
        },

        initialize: function () {

            var order_id = uiRegistry.get('index = order_id');
            var order_for = uiRegistry.get('index = order_for');
            order_id.hide();
            order_for.hide();
            return this._super();
            return this.setDependentOptions(this.value());

        },

        setParsed: function (data) {
            var option = this.parseData(data);
            if (data.error) {
                return this;
            }
            this.options([]);
            this.setOption(option);
            this.set('newOption', option);
        },

        onUpdate: function (value) {
            var order_id_1 = uiRegistry.get('index = order_id');
            var order_for_1 = uiRegistry.get('index = order_for');
            order_id_1.show();
            order_for_1.show();
            this.setDependentOptions(value);
            return this._super();
        },

        setDependentOptions: function (value) {
            var options = this.mapper['map'][value];
            var field = uiRegistry.get('index = order_id');
            field.setOptions(options);
            return this;
        },

        parseData: function (data) {
            return {
                value: data.customer.entity_id,
                label: data.customer.name
            };
        }
    });
});
