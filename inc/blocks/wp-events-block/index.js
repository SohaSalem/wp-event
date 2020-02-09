/**
 * mb Gutemberg block
 *  Copyright (c) 2001-2018. Matteo Bicocchi (Pupunzi)
 */
//
(function (wp) {
    var registerBlockType = wp.blocks.registerBlockType;
    var InspectorControls = wp.editor.InspectorControls;
    var el = wp.element.createElement;
    var SelectControl = wp.components.SelectControl;
    var TextControl = wp.components.TextControl;
    var __ = wp.i18n.__;
    registerBlockType('wp-events-gutenberg/wp-events-block', {
        title: __('Events', 'wp-events'),
        category: 'common',
        attributes: {
            number_events: {
                type: 'string'
            },
            order_by: {
                type: 'string'
            }
        },
        edit: function (props) {
            var number_events = props.attributes.number_events;
            var order_by = props.attributes.order_by;
            function setNumberEvents(value) {
                props.setAttributes({number_events: value});
            }
            function setOrderBy(value) {
                props.setAttributes({order_by: value});
            }
            return el('div', {}, [
                el('p', {}, __('Events', 'wp-events')
                        ),
                el(InspectorControls, null,
                        el(TextControl, {
                            label: __('Number of events', 'wp-events'),
                            help: __('The number of events to show.', 'wp-events'),
                            value: number_events,
                            onChange: setNumberEvents
                        }),
                        el(SelectControl, {
                            label: __('Order By', 'mycred-gutenberg'),
                            value: order_by,
                            options: [
                                {
                                    value: 'ID',
                                    label: __('Event ID', 'wp-events')
                                },
                                {
                                    value: 'title',
                                    label: __('Event Title', 'wp-events')
                                },
                                {
                                    value: 'date',
                                    label: __('Event Date', 'wp-events')
                                },
                                {
                                    value: 'name',
                                    label: __('Event Slug', 'wp-events')
                                }
                            ],
                            onChange: setOrderBy
                        })
                        )
            ]);
        },
        save: function (props) {
            return null;
        }
    });
})(window.wp);