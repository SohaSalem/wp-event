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
                            label: __('Number of events', 'mycred-gutenberg'),
                            help: __('The number of events to show.', 'mycred-gutenberg'),
                            value: number_events,
                            onChange: setNumberEvents
                        }),
                        el(SelectControl, {
                            label: __('Order By', 'mycred-gutenberg'),
                            help: __('The URL to attach the current users affiliate ID to. No ID is attached for visitors that are not logged in.', 'mycred-gutenberg'),
                            value: order_by,
                            options: [
                                {
                                    value: 'ID',
                                    label: 'Event ID'
                                },
                                {
                                    value: 'title',
                                    label: 'Event Title'
                                },
                                {
                                    value: 'date',
                                    label: 'Event Date'
                                },
                                {
                                    value: 'name',
                                    label: 'Event Slug'
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