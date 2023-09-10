define(
    [
        'underscore',
        'Magento_Ui/js/grid/columns/column'
    ],
    function (_, Column) {
        'use strict';

        return Column.extend(
            {

                defaults: {
                    bodyTmpl: 'Training_AdminLogs/grid/cells/statusColor',
                    fieldClass: {
                        'data-grid-thumbnail-cell': true
                    }
                },

                getIsActive: function (record) {
                    return (record[this.index] === 1 || record[this.index] === '1');
                },

                /**
                 * Retrieves label associated with a provided value.
                 *
                 * @returns {String}
                 */
                getLabel: function () {

                    var options = this.options || [],
                        values = this._super(),
                        label = [];

                    if (!Array.isArray(values)) {
                        values = [values];
                    }

                    values = values.map(
                        function (value) {
                            return value + '';
                        }
                    );

                    options.forEach(
                        function (item) {
                            if (_.contains(values, item.value + '')) {
                                label.push(item.label);
                            }
                        }
                    );

                    return label.join(', ');
                }
            }
        );
    }
);
