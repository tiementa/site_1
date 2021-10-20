jQuery(document).ready(function($) {
    wp.customize.panel( 'pranayama_yoga_home_page_settings', function( section ) {
        section.expanded.bind( function( isExpanded ) {
            if ( isExpanded ) {
                wp.customize.previewer.previewUrl.set( py_customizer_data.frontpage  );
            }
        } );
    } );
    
    // Scroll to Home section starts
    $('body').on('click', '#sub-accordion-panel-pranayama_yoga_home_page_settings .control-subsection .accordion-section-title', function(event) {
        var section_id = $(this).parent('.control-subsection').attr('id');
        scrollToSection( section_id );
    });

    });

    function scrollToSection( section_id ){
        var preview_section_id = "banner_section";

        var $contents = jQuery('#customize-preview iframe').contents();

        switch ( section_id ) {
            
            case 'accordion-section-pranayama_yoga_about_settings':
            preview_section_id = "about_section";
            break;

            case 'accordion-section-pranayama_yoga_information_settings':
            preview_section_id = "info_section";
            break;

            case 'accordion-section-pranayama_yoga_yoga_classes_settings':
            preview_section_id = "yoga_section";
            break;

            case 'accordion-section-pranayama_yoga_promotional_settings':
            preview_section_id = "promotional_section";
            break;

            case 'accordion-section-pranayama_yoga_trainer_settings':
            preview_section_id = "trainer_section";
            break;

            case 'accordion-section-pranayama_yoga_testimonial_settings':
            preview_section_id = "testimonial_section";
            break;

            case 'accordion-section-pranayama_yoga_blog_settings':
            preview_section_id = "blog_section";
            break;

            case 'accordion-section-pranayama_yoga_reason_settings':
            preview_section_id = "reason_section";
            break;

            case 'accordion-section-pranayama_yoga_subscription_settings':
            preview_section_id = "subscription_section";
            break;
            
        }

        if( $contents.find('#'+preview_section_id).length > 0 && $contents.find('.home').length > 0 ){
            $contents.find("html, body").animate({
            scrollTop: $contents.find( "#" + preview_section_id ).offset().top
            }, 1000);
        }
}