( function( $ ) {
    $( document ).ready( function() {

        const registerLink = '#';

        createElementChat();
        ajax_check_status();

        $( '#simyzchat_chat_assistant_submit' ).on( 'click', function() {
            $.ajax( {
                url: ajaxurl,
                type: 'POST',
                dataType: 'json',
                data: {
                    action: 'simyzchat_chat_submit',
                    simyzchat_ajax_nonce_field: simyzchat_ajax.nonce,
                    chat_message : $( '#simyzchat_chat_assistant_message' ).val(),
                },
                beforeSend: function() {
                    $( '#simyzchat_overlay' ).show();
                },
                success: function( data ) {
                    $( '#simyzchat_overlay' ).hide();
                    if ( data.success ) {
                        localStorage["simyzchat_step"] = 0;
                        element_blinking( data.data.user_actions );
                        $( '#simyzchat_chat_buttons, #simyzchat_answer' ).show();
                        $( '#simyzchat_chat_input, #simyzchat_error' ).hide();
                        $( '#simyzchat_chat_assistant_message' ).val( '' );
                        $( '#simyzchat_user_actions' ).val( data.data.user_actions );
                        $( '#simyzchat_question_id' ).val( data.data.question_id );
                        $( '#simyzchat_answer' ).html( data.data.answer );
                        $( '#simyzchat_question' ).text( data.data.question );
                    } else {
                        $( '#simyzchat_error' ).show();
                        $( '#simyzchat_error' ).text( data.data.message );
                    }
                }
            } );
        } )

        $( '#simyzchat_it_helped' ).on( 'click', function() {
            ajax_has_helped( 1 );
        } )
        $( '#simyzchat_it_didnt' ).on( 'click', function() {
            ajax_has_helped( 0 );
        } )

        $( '#simyzchat_register' ).on( 'click', function( e ) {
            e.preventDefault();
            $.ajax( {
                url: ajaxurl,
                type: 'POST',
                dataType: 'json',
                data: {
                    action: 'simyzchat_register',
                    simyzchat_ajax_nonce_field: simyzchat_ajax.nonce,
                },
                beforeSend: function() {
                    $( '#simyzchat_overlay' ).show();
                },
                success: function( data ) {
                    $( '#simyzchat_overlay' ).hide();
                    if ( data.success ) {
                        window.location.href = registerLink;
                    }
                }
            } );
        } )

        $( '#simyzchat_open_chat' ).on( 'click', function() {
            $( '#simyzchat_open_chat' ).hide();
            $( '#simyzchat_chat_assistant' ).show();
        } )

        $( '#simyzchat_span_icon' ).on( 'click', function() {
            $( '#simyzchat_open_chat' ).show();
            $( '#simyzchat_chat_assistant' ).hide();
        } )

        $( '#simyzchat_chat_assistant_message' ).on( 'keydown', function( e ) {
            if ( 'Enter' === e.key ) {
                $( '#simyzchat_chat_assistant_submit' ).trigger('click');
            }
        } );

        function ajax_has_helped( has_helped ) {
            $.ajax( {
                url: ajaxurl,
                type: 'POST',
                dataType: 'json',
                data: {
                    action: 'simyzchat_chat_has_helped',
                    simyzchat_ajax_nonce_field: simyzchat_ajax.nonce,
                    question_id: $( '#simyzchat_question_id' ).val(),
                    has_helped: has_helped
                },
                beforeSend: function() {
                    $( '#simyzchat_overlay' ).show();
                },
                success: function( data ) {
                    $( '#simyzchat_overlay' ).hide();
                    if ( data.success ) {
                        delete localStorage["simyzchat_step"];
                        $( '#simyzchat_chat_input, #simyzchat_open_chat' ).show();
                        $( '#simyzchat_chat_buttons, #simyzchat_answer, #simyzchat_error, #simyzchat_chat_assistant' ).hide();
                        $( '#simyzchat_question' ).text( '...' );
                    } else {
                        $( '#simyzchat_error' ).show();
                        $( '#simyzchat_error' ).text( data.data.message );
                        $( '#simyzchat_chat' ).scrollTop( $( '#simyzchat_answer' ).height() )
                    }
                }
            } );
        }

        function createElementChat() {
            $( 'body' ).append( '<div id="simyzchat_chat_block"></div>' );
            $( '#simyzchat_chat_block' ).append(
                '<div id="simyzchat_chat_assistant" style="display: none;">' +
                    '<div class="simyzchat_flex simyzchat_header">' +
                        '<div class="simyzchat_icon">' +
                            '<span id="simyzchat_span_icon" class="dashicons dashicons-no-alt"></span>' +
                        '</div>' +
                        '<div class="simyzchat_text">' +
                            '<a id="simyzchat_register" href="#">' + simyzchat_ajax.register + '</a>' +
                            '<span id="simyzchat_username" style="display: none;"></span>' +
                        '</div>' +
                    '</div>' +
                    '<div id="simyzchat_chat">' +
                        '<div id="simyzchat_answer" class="simyzchat_chat_elem" style="display: none;"></div>' +
                        '<div id="simyzchat_question" class="simyzchat_chat_elem">...</div>' +
                        '<div id="simyzchat_error" class="simyzchat_chat_elem" style="display: none;"></div>' +
                    '</div>' +
                    '<div id="simyzchat_chat_input" class="simyzchat_flex simyzchat_bottom">' +
                        '<div class="simyzchat_input">' +
                            '<input id="simyzchat_chat_assistant_message" type="text" placeholder="' + simyzchat_ajax.chat_message + '" />' +
                        '</div>' +
                        '<div class="simyzchat_submit">' +
                            '<button id="simyzchat_chat_assistant_submit" type="button">' +
                                '<img id="simyzchat_send_button" src="' + simyzchat_ajax.site_url + '/img/send_button.png" alt="send button" />' +
                            '</button>' +
                        '</div>' +
                    '</div>' +
                    '<div id="simyzchat_chat_buttons" class="simyzchat_flex simyzchat_bottom" style="display: none;">' +
                        '<input id="simyzchat_it_helped" type="button" value="' + simyzchat_ajax.it_helped + '" />' +
                        '<input id="simyzchat_it_didnt" type="button" value="' + simyzchat_ajax.it_didnt + '" />' +
                    '</div>' +
                    '<input id="simyzchat_user_actions" type="button" value="" hidden="hidden" />' +
                    '<input id="simyzchat_question_id" type="button" value="" hidden="hidden" />' +
                    '<div id="simyzchat_overlay" class="" style="display: none;"><div class="simyzchat_spinner"></div></div>' +
                '</div>' +
                '<img id="simyzchat_open_chat" src="' + simyzchat_ajax.site_url + '/img/open_chat.png" alt="open chat" style="display: none;" />'
            );
        }

        function ajax_check_status() {
            $.ajax( {
                url: ajaxurl,
                type: 'POST',
                dataType: 'json',
                data: {
                    action: 'simyzchat_check_status',
                    simyzchat_ajax_nonce_field: simyzchat_ajax.nonce
                },
                success: function( data ) {
                    if ( 'null' !== data.data.user ) {
                        $( '#simyzchat_username' ).text( data.data.user );
                        $( '#simyzchat_username' ).show();
                        $( '#simyzchat_register' ).hide();
                    }

                    if ( null === data.data.questions ) {
                        $( '#simyzchat_open_chat' ).show();
                    } else {
                        $( '#simyzchat_chat_assistant, #simyzchat_chat_buttons, #simyzchat_answer' ).show();
                        $( '#simyzchat_open_chat, #simyzchat_chat_input' ).hide();
                        $( '#simyzchat_answer' ).html( data.data.questions.answer );
                        $( '#simyzchat_question' ).text( data.data.questions.question );
                        $( '#simyzchat_user_actions' ).val( data.data.questions.user_actions );
                        $( '#simyzchat_question_id' ).val( data.data.questions.id );

                        element_blinking( data.data.questions.user_actions );
                    }
                }
            } );
        }

        function element_blinking( user_actions ) {
            user_actions = JSON.parse( user_actions );
            let step = localStorage['simyzchat_step'];
            if ( user_actions.length && !!step ) {
                let elem = find_element( user_actions );

                if ( elem ) {
                    elem.on( 'click', function() {
                        find_element( user_actions );
                    } );
                }
            }
        }

        function find_element( user_actions ) {
            let elem = '',
                selector = '',
                step = localStorage['simyzchat_step'];

            if ( user_actions[ step ].selectors ) {
                selector = user_actions[ step ].selectors;
                elem = $( selector );
            } else if ( user_actions[ step ].text ) {
                selector = user_actions[ step ].text;
                elem = $( '*:contains(' + selector + ')' ).filter( function() {
                    return $( this ).children().length === 0 && $( this ).text() === selector;
                    // return $( this ).children().length === 0 && $( this ).text().replace( /[^a-z0-9а-я]/ig, '' ) === selector.replace( /[^a-z0-9а-я]/ig, '' );
                } );

                if ( 0 === elem.length ) {
                    elem = $( 'body :input[value="' + selector + '"]' );
                }
            }

            if ( elem.length ) {
                elem.addClass( 'simyzchat_transition' );
                elem.toggleClass( 'simyzchat_background_red' );
                let toggleInterval = setInterval( function() {
                    elem.toggleClass( 'simyzchat_background_red' );
                },800 )
                elem.on( 'click', function() {
                    if ( step < user_actions.length-1 ) {
                        localStorage['simyzchat_step'] = ++step;
                    } else {
                        delete localStorage["simyzchat_step"];
                    }
                    clearInterval( toggleInterval );
                    elem.removeClass( 'simyzchat_background_red' );
                } );
                $( '#simyzchat_it_helped, #simyzchat_it_didnt' ).on( 'click', function() {
                    clearInterval( toggleInterval );
                    elem.removeClass( 'simyzchat_background_red' );
                } );

                return elem;
            }
        }

    } );
} )( jQuery );