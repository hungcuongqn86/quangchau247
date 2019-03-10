<?php
/**
 * Accordion - Shortcode Options
 */

add_action( 'init', 'fwzi_accordion_vc_map' );
if ( ! function_exists( 'fwzi_accordion_vc_map' ) ) {
  function fwzi_accordion_vc_map() {

    vc_map( array(
      'name'            => __( 'Fawzi Accordion', 'fawzi-core'),
      'base'            => 'vc_accordion',
      'is_container'    => true,
      'description'     => __( 'Accordion Styles', 'fawzi-core'),
      'icon'            => 'fa fa-bars color-pink',
      'category'        => FawziLib::fwzi_cat_name(),
      'params'          => array(
        
        FawziLib::vt_id_option(),
        FawziLib::vt_class_option(),
        array(
          'type'        => 'textfield',
          'heading'     => __( 'Active tab', 'fawzi-core'),
          'param_name'  => 'active_tab',
          'description' => __( "Which tab you want to be active on load. [Eg. 1 or 2 or 3]", 'fawzi-core'),
        ),
        array(
          'type'        => 'switcher',
          'heading'     => __( 'Only One Tab Active Mode', 'fawzi-core'),
          'param_name'  => 'one_active',
          'description' => __( 'This will enable only one tab active at a time. All other tabs will be in-active mode.', 'fawzi-core'),
        ),

      ),

      'custom_markup'   => '<div class="wpb_accordion_holder wpb_holder clearfix vc_container_for_children">%content%</div><div class="tab_controls"><a class="add_tab" title="Add section"><span class="vc_icon"></span> <span class="tab-label">Add section</span></a></div>',
      'default_content' => '
        [vc_accordion_tab title="Accordion Tab 1"][/vc_accordion_tab]
        [vc_accordion_tab title="Accordion Tab 2"][/vc_accordion_tab]
      ',
      'js_view'         => 'VcAccordionView'
    ) );

    // ==========================================================================================
    // VC ACCORDION TAB
    // ==========================================================================================
    vc_map( array(
      'name'                      => __( 'Accordion Section', 'fawzi-core'),
      'base'                      => 'vc_accordion_tab',
      // 'allowed_container_element' => 'vc_row',
      'is_container'              => true,
      'content_element'           => false,
      'category'                  => FawziLib::fwzi_cat_name(),
      'params'                    => array(
        array(
          'type'        => 'textfield',
          'heading'     => __( 'Title', 'fawzi-core'),
          'param_name'  => 'title',
        ),
      ),
      'js_view'         => 'VcAccordionTabView'
    ) );

  }
}