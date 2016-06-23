+function ($) { 'use strict';

    let Treesort = class {

        /**
         * Set up event bindings
         *
         * @param {Object} $el
         */
        constructor($el) {
            this.$el = $el;
            this.$el.unbind().on('click', () => this.showPopup());
        }

        /**
         * Show the popup
         *
         * @return {void}
         */
        showPopup() {
            this.$el.on('show.oc.popup', btn => {
                let $popup = $(btn.relatedTarget),
                    $form = $popup.find('form'),
                    $tree = $popup.find('[data-control="tree"]'),
                    $indicator = $popup.find('[data-control="loading-indicator"]');

                // Prevent the height of the modal from changing during re-ordering
                $tree.css('height', $tree.height());

                // Submit the request
                $form.on('submit', e => {
                    e.preventDefault();

                    $indicator.show();
                    $form.request('treesort::onUpdateTree', {
                        data: {
                            subjects: this.getTreeData($tree),
                        },
                        success(data) {
                            this.success(data).done(function() {
                                $popup.trigger('close.oc.popup');
                                $(document).trigger('render');
                            });
                        },
                        error(data) {
                            this.error(data).done(function() {

                                console.log (data);

                                $.oc.flashMsg({
                                    interval: 5,
                                    class: 'error',
                                    text: data.responseJSON.result,
                                });
                            });
                        },
                        complete() {
                            $indicator.hide();
                        },
                    });
                });
            });

            // Trigger the popup
            this.$el.popup({ handler: 'treesort::onShowPopup' });
        }

        /**
         * Flatten the nested tree data
         *
         * @param  {Object} $tree
         * @return {Array}
         */
        getTreeData($tree) {
            let data = [];

            $tree.find('li').each(function() {
                data.push( $(this).data('id') );
            });

            return data;
        }
    };

    //
    // jQuery binding
    //
    $.fn.Treesort = function() {
        return new Treesort(this);
    };

    $(document).on('render', () =>  {
        $('[data-widget="treesort"]').Treesort();
    });

}(window.jQuery);
