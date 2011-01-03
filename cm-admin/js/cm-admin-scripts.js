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

        // bind functions
        $(window).bind('load', cm_init_public_checked_post_type);
        $('.cm-post-type input[name="public"]').bind('change', cm_init_public_checked_post_type);

        $(window).bind('load', cm_init_rewrite_checked_post_type);
        $('.cm-post-type input[name="rewrite"]').bind('change', cm_init_rewrite_checked_post_type);

        $(window).bind('load', cm_init_capability_checked_post_type);
        $('.cm-post-type input[name="capability_type_edit"]').bind('change', cm_init_capability_checked_post_type);

        $(window).bind('load', cm_init_public_checked_taxonomy);
        $('.cm-taxonomy input[name="public"]').bind('change', cm_init_public_checked_taxonomy);
        
        $(window).bind('load', cm_init_rewrite_checked_taxonomy);
        $('.cm-taxonomy input[name="rewrite"]').bind('change', cm_init_rewrite_checked_taxonomy);

        $(window).bind('load', cm_field_type_options);
        $('.cm-custom-fields select[name="field_type"]').bind('change', cm_field_type_options);

        // custom fields add options
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

        // custom fields remove options
        $('.cm-field-delete-option').live('click', function() {
            $(this).parent().remove();
        });

    });

    // initiate the values associated with the post type public field
    function cm_init_public_checked_post_type() {
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

    // initiate the values for the post type rewrite field
    function cm_init_rewrite_checked_post_type() {
        if ( $('.cm-post-type input[name="rewrite"]:checked').val() === '1'
          || $('.cm-post-type input[name="rewrite"]:checked').val() === '0' ) {
            $('.cm-post-type input[name="rewrite_slug"]').attr( 'disabled', true );
        } else if ( $('.cm-post-type input[name="rewrite"]:checked').val() === 'advanced' ) {
            $('.cm-post-type input[name="rewrite_slug"]').attr( 'disabled', false );
        }
    }

    // initiate the values for the post type capability field
    function cm_init_capability_checked_post_type() {
        if ( $('.cm-post-type input[name="capability_type_edit"]:checked').val() === '1' ) {
            $('.cm-post-type input[name="capability_type"]').attr( 'disabled', false );
        } else {
            $('.cm-post-type input[name="capability_type"]').attr( 'disabled', true );
        }
    }

    // initiate the values for the taxonomy public field
    function cm_init_public_checked_taxonomy() {
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

    // initiate the value of the taxonomy rewrite field
    function cm_init_rewrite_checked_taxonomy() {
        if ( $('.cm-taxonomy input[name="rewrite"]:checked').val() === '1'
          || $('.cm-taxonomy input[name="rewrite"]:checked').val() === '0' ) {
            $('.cm-taxonomy input[name="rewrite_slug"]').attr( 'disabled', true );
        } else if ( $('.cm-taxonomy input[name="rewrite"]:checked').val() === 'advanced' ) {
            $('.cm-taxonomy input[name="rewrite_slug"]').attr( 'disabled', false );
        }
    }

    // public field values initiation
    function cm_field_type_options() {
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