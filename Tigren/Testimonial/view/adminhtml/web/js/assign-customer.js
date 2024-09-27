define([
    'mage/adminhtml/grid'
], function () {
    'use strict';

    return function (config) {
        var selectedCustomers = config.selectedCustomers, // Lưu trữ khách hàng được chọn
            customerData = $H(selectedCustomers), // Dữ liệu khách hàng
            gridJsObject = window[config.gridJsObjectName],
            tabIndex = 1000;

        /**
         * Hiển thị khách hàng được chọn khi chỉnh sửa form
         */
        $('selected_customers').value = Object.toJSON(customerData); // Đổi thành 'selected_customers'

        /**
         * Đăng ký khách hàng đã chọn
         *
         * @param {Object} grid
         * @param {Object} element
         * @param {Boolean} checked
         */
        function registerSelectedCustomer(grid, element, checked) {
            if (checked) {
                if (element.positionElement) {
                    element.positionElement.disabled = false;
                    customerData.set(element.value, element.positionElement.value);
                }
            } else {
                if (element.positionElement) {
                    element.positionElement.disabled = true;
                }
                customerData.unset(element.value);
            }
            $('selected_customers').value = Object.toJSON(customerData);
            grid.reloadParams = {
                'selected_customers[]': customerData.keys() // Thay đổi tham số từ 'selected_products[]' thành 'selected_customers[]'
            };
        }

        /**
         * Click vào dòng khách hàng
         *
         * @param {Object} grid
         * @param {String} event
         */
        function customerRowClick(grid, event) {
            var trElement = Event.findElement(event, 'tr'),
                isInput = Event.element(event).tagName === 'INPUT',
                checked = false,
                checkbox = null;

            if (trElement) {
                checkbox = Element.getElementsBySelector(trElement, 'input');

                if (checkbox[0]) {
                    checked = isInput ? checkbox[0].checked : !checkbox[0].checked;
                    gridJsObject.setCheckboxChecked(checkbox[0], checked);
                }
            }
        }

        /**
         * Thay đổi vị trí của khách hàng (nếu có field vị trí)
         *
         * @param {String} event
         */
        function positionChange(event) {
            var element = Event.element(event);

            if (element && element.checkboxElement && element.checkboxElement.checked) {
                customerData.set(element.checkboxElement.value, element.value);
                $('selected_customers').value = Object.toJSON(customerData);
            }
        }

        /**
         * Khởi tạo dòng khách hàng
         *
         * @param {Object} grid
         * @param {String} row
         */
        function customerRowInit(grid, row) {
            var checkbox = $(row).getElementsByClassName('checkbox')[0],
                position = $(row).getElementsByClassName('input-text')[0];

            if (checkbox && position) {
                checkbox.positionElement = position;
                position.checkboxElement = checkbox;
                position.disabled = !checkbox.checked;
                position.tabIndex = tabIndex++;
                Event.observe(position, 'keyup', positionChange);
            }
        }

        gridJsObject.rowClickCallback = customerRowClick;
        gridJsObject.initRowCallback = customerRowInit;
        gridJsObject.checkboxCheckCallback = registerSelectedCustomer;

        if (gridJsObject.rows) {
            gridJsObject.rows.each(function (row) {
                customerRowInit(gridJsObject, row);
            });
        }
    };
});
