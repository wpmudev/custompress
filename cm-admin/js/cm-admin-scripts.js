(function($) {

    $(document).ready(function($) {

        $('.cm-toggle').toggle(
            function() {
                $(this).next().hide(); },
            function() {
                $(this).next().show(); }
        );

        $('.cm-arrow').toggle(
            function() {
                $(this).next().next().hide(); },
            function() {
                $(this).next().next().show(); }
        );

        $(window).bind('load', init_public_checked_post_type);
        $(window).bind('load', init_capability_checked_post_type);
        $('.cm-post-type input[name="public"]').bind('change', init_public_checked_post_type); 
        $('.cm-post-type input[name="rewrite"]').bind('change', init_rewrite_checked_post_type);
        $('.cm-post-type input[name="capability_type_edit"]').bind('change', init_capability_checked_post_type);

        $(window).bind('load', init_public_checked_taxonomy);
        $('.cm-taxonomy input[name="public"]').bind('change', init_public_checked_taxonomy);
        $('.cm-taxonomy input[name="rewrite"]').bind('change', init_rewrite_checked_taxonomy);

        $(window).bind('load', field_type_options);
        $('.cm-custom-fields select[name="field_type"]').bind('change', field_type_options);

        $('.cm-field-add-option').click(function() {
            $('.cm-field-additional-options').append(function() {
                
                var count = parseInt($('input[name="track_number"]').val()) + 1;
                $('input[name="track_number"]').val(count);

                return '<p>Option ' + count + ': ' +
                            '<input type="text" name="field_options[' + count + ']"> ' +
                            '<input type="radio" value="' + count + '" name="field_default_option"> ' +
                            'Default Value ' +
                            '<a href="#" class="cm-field-delete-option">[x]</a>' +
                        '</p>'; 
            });
        });

        $('.cm-field-delete-option').live('click', function() {
            $(this).parent().remove();
        });

    });

    function init_public_checked_post_type() {
        if ( $('.cm-post-type input[name="public"]:checked').val() === '0' ) {
            $('.cm-post-type input[name="show_ui"][value="0"]').attr( 'checked', true );
            $('.cm-post-type input[name="show_in_nav_menus"][value="0"]').attr( 'checked', true );
            $('.cm-post-type input[name="publicly_queryable"][value="0"]').attr( 'checked', true );
            $('.cm-post-type input[name="exclude_from_search"][value="1"]').attr( 'checked', true );
            $('.cm-post-type input[name="show_ui"]').attr( 'disabled', true );
            $('.cm-post-type input[name="show_in_nav_menus"]').attr( 'disabled', true );
            $('.cm-post-type input[name="publicly_queryable"]').attr( 'disabled', true );
            $('.cm-post-type input[name="exclude_from_search"]').attr( 'disabled', true );
        }
        else if ( $('.cm-post-type input[name="public"]:checked').val() === '1' ) {
            $('.cm-post-type input[name="show_ui"][value="1"]').attr( 'checked', true );
            $('.cm-post-type input[name="show_in_nav_menus"][value="1"]').attr( 'checked', true );
            $('.cm-post-type input[name="publicly_queryable"][value="1"]').attr( 'checked', true );
            $('.cm-post-type input[name="exclude_from_search"][value="0"]').attr( 'checked', true );
            $('.cm-post-type input[name="show_ui"]').attr( 'disabled', true );
            $('.cm-post-type input[name="show_in_nav_menus"]').attr( 'disabled', true );
            $('.cm-post-type input[name="publicly_queryable"]').attr('disabled', true );
            $('.cm-post-type input[name="exclude_from_search"]').attr( 'disabled', true );
        }
        else if ( $('.cm-post-type input[name="public"]:checked').val() === 'advanced' ) {
            $('.cm-post-type input[name="show_ui"]').attr( 'disabled', false );
            $('.cm-post-type input[name="show_in_nav_menus"]').attr( 'disabled', false );
            $('.cm-post-type input[name="publicly_queryable"]').attr( 'disabled', false );
            $('.cm-post-type input[name="exclude_from_search"]').attr( 'disabled', false );
        }
    }

    function init_rewrite_checked_post_type() {
        if ( $('.cm-post-type input[name="rewrite"]:checked').val() === '1'
          || $('.cm-post-type input[name="rewrite"]:checked').val() === '0' ) {
            $('.cm-post-type input[name="rewrite_slug"]').attr( 'disabled', true );
        } else if ( $('.cm-post-type input[name="rewrite"]:checked').val() === 'advanced' ) {
            $('.cm-post-type input[name="rewrite_slug"]').attr( 'disabled', false );
        }
    }

    function init_capability_checked_post_type() {
        if ( $('.cm-post-type input[name="capability_type_edit"]:checked').val() === '1' ) {
            $('.cm-post-type input[name="capability_type"]').attr( 'disabled', false );
        } else {
            $('.cm-post-type input[name="capability_type"]').attr( 'disabled', true );
        }
    }

    function init_public_checked_taxonomy() {
        if ( $('.cm-taxonomy input[name="public"]:checked').val() === '0' ) {
            $('.cm-taxonomy input[name="show_ui"][value="0"]').attr( 'checked', true );
            $('.cm-taxonomy input[name="show_in_nav_menus"][value="0"]').attr( 'checked', true );
            $('.cm-taxonomy input[name="show_tagcloud"][value="0"]').attr( 'checked', true );
            $('.cm-taxonomy input[name="show_ui"]').attr( 'disabled', true );
            $('.cm-taxonomy input[name="show_in_nav_menus"]').attr( 'disabled', true );
            $('.cm-taxonomy input[name="show_tagcloud"]').attr( 'disabled', true );
        }
        else if ( $('.cm-taxonomy input[name="public"]:checked').val() === '1' ) {
            $('.cm-taxonomy input[name="show_ui"][value="1"]').attr( 'checked', true );
            $('.cm-taxonomy input[name="show_in_nav_menus"][value="1"]').attr( 'checked', true );
            $('.cm-taxonomy input[name="show_tagcloud"][value="1"]').attr( 'checked', true );
            $('.cm-taxonomy input[name="show_ui"]').attr( 'disabled', true );
            $('.cm-taxonomy input[name="show_in_nav_menus"]').attr( 'disabled', true );
            $('.cm-taxonomy input[name="show_tagcloud"]').attr('disabled', true );
        }
        else if ( $('.cm-taxonomy input[name="public"]:checked').val() === 'advanced' ) {
            $('.cm-taxonomy input[name="show_ui"]').attr( 'disabled', false );
            $('.cm-taxonomy input[name="show_in_nav_menus"]').attr( 'disabled', false );
            $('.cm-taxonomy input[name="show_tagcloud"]').attr( 'disabled', false );
        }
    }

    function init_rewrite_checked_taxonomy() {
        if ( $('.cm-taxonomy input[name="rewrite"]:checked').val() === '1'
          || $('.cm-taxonomy input[name="rewrite"]:checked').val() === '0' ) {
            $('.cm-taxonomy input[name="rewrite_slug"]').attr( 'disabled', true );
        } else if ( $('.cm-taxonomy input[name="rewrite"]:checked').val() === 'advanced' ) {
            $('.cm-taxonomy input[name="rewrite_slug"]').attr( 'disabled', false );
        }
    }

    function field_type_options() {
        if ( $('.cm-custom-fields select option:selected').val() === 'radio'
          || $('.cm-custom-fields select option:selected').val() === 'selectbox'
          || $('.cm-custom-fields select option:selected').val() === 'multiselectbox'
          || $('.cm-custom-fields select option:selected').val() === 'checkbox' ) {
            $('.cm-field-type-options').show();
        }
        else if ( $('.cm-custom-fields select option:selected').val() === 'text'
               || $('.cm-custom-fields select option:selected').val() === 'textarea' ) {
            $('.cm-field-type-options').hide();
        }
    }

})(jQuery);