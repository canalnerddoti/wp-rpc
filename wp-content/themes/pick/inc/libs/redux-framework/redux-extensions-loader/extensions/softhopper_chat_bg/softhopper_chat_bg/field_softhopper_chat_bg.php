<?php

/**
 * Redux Framework is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * any later version.
 * Redux Framework is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 * You should have received a copy of the GNU General Public License
 * along with Redux Framework. If not, see <http://www.gnu.org/licenses/>.
 *
 * @package     ReduxFramework
 * @subpackage  Field_Color_Gradient
 * @author      Luciano "WebCaos" Ubertini
 * @author      Daniel J Griffiths (Ghost1227)
 * @author      Dovy Paukstys
 * @version     3.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Don't duplicate me!
if ( ! class_exists( 'ReduxFramework_softhopper_chat_bg' ) ) {

    /**
     * Main ReduxFramework_softhopper_chat_bg class
     *
     * @since       1.0.0
     */
    class ReduxFramework_softhopper_chat_bg {

        /**
         * Field Constructor.
         * Required - must call the parent constructor, then assign field and value to vars, and obviously call the render field function
         *
         * @since       1.0.0
         * @access      public
         * @return      void
         */
        function __construct( $field = array(), $value = '', $parent ) {
            $this->parent = $parent;
            $this->field  = $field;
            $this->value  = $value;

            $defaults    = array(
                'speaker_one' => true,
                'speaker_two'   => true,
                'speaker_three' => true,
                'speaker_four'  => true,
                'speaker_five'  => true,
                'speaker_six'  => true
            );
            $this->field = wp_parse_args( $this->field, $defaults );

            $defaults = array(
                'speaker_one' => '',
                'speaker_two'   => '',
                'speaker_three' => '',
                'speaker_four'  => '',
                'speaker_five'  => '',
                'speaker_six'  => ''
            );

            $this->value = wp_parse_args( $this->value, $defaults );

            // In case user passes no default values.
            if ( isset( $this->field['default'] ) ) {
                $this->field['default'] = wp_parse_args( $this->field['default'], $defaults );
            } else {
                $this->field['default'] = $defaults;
            }
        }

        /**
         * Field Render Function.
         * Takes the vars and outputs the HTML for the field in the settings
         *
         * @since       1.0.0
         * @access      public
         * @return      void
         */
        public function render() {

            if ( $this->field['speaker_one'] === true && $this->field['default']['speaker_one'] !== false ) {
                echo '<span class="linkColor"><strong>' . esc_html__( 'Speaker One', 'pick' ) . '</strong>&nbsp;<input id="' . $this->field['id'] . '-speaker_one" name="' . $this->field['name'] . $this->field['name_suffix'] . '[speaker_one]' . '" value="' . $this->value['speaker_one'] . '" class="redux-color redux-color-speaker_one redux-color-init ' . $this->field['class'] . '"  type="text" data-default-color="' . $this->field['default']['speaker_one'] . '" /></span>';
            }

            if ( $this->field['speaker_two'] === true && $this->field['default']['speaker_two'] !== false ) {
                echo '<span class="linkColor"><strong>' . esc_html__( 'Speaker Two', 'pick' ) . '</strong>&nbsp;<input id="' . $this->field['id'] . '-speaker_two" name="' . $this->field['name'] . $this->field['name_suffix'] . '[speaker_two]' . '" value="' . $this->value['speaker_two'] . '" class="redux-color redux-color-speaker_two redux-color-init ' . $this->field['class'] . '"  type="text" data-default-color="' . $this->field['default']['speaker_two'] . '" /></span>';
            }

            if ( $this->field['speaker_three'] === true && $this->field['default']['speaker_three'] !== false ) {
                echo '<span class="linkColor"><strong>' . esc_html__( 'Speaker Three', 'pick' ) . '</strong>&nbsp;<input id="' . $this->field['id'] . '-speaker_two" name="' . $this->field['name'] . $this->field['name_suffix'] . '[speaker_three]' . '" value="' . $this->value['speaker_three'] . '" class="redux-color redux-color-speaker_three redux-color-init ' . $this->field['class'] . '"  type="text" data-default-color="' . $this->field['default']['speaker_three'] . '" /></span>';
            }

            if ( $this->field['speaker_four'] === true && $this->field['default']['speaker_four'] !== false ) {
                echo '<span class="linkColor"><strong>' . esc_html__( 'Speaker Four', 'pick' ) . '</strong>&nbsp;<input id="' . $this->field['id'] . '-speaker_four" name="' . $this->field['name'] . $this->field['name_suffix'] . '[speaker_four]' . '" value="' . $this->value['speaker_four'] . '" class="redux-color redux-color-speaker_four redux-color-init ' . $this->field['class'] . '"  type="text" data-default-color="' . $this->field['default']['speaker_four'] . '" /></span>';
            }

            if ( $this->field['speaker_five'] === true && $this->field['default']['speaker_five'] !== false ) {
                echo '<span class="linkColor"><strong>' . esc_html__( 'Speaker Five', 'pick' ) . '</strong>&nbsp;<input id="' . $this->field['id'] . '-speaker_five" name="' . $this->field['name'] . $this->field['name_suffix'] . '[speaker_five]' . '" value="' . $this->value['speaker_five'] . '" class="redux-color redux-color-speaker_five redux-color-init ' . $this->field['class'] . '"  type="text" data-default-color="' . $this->field['default']['speaker_five'] . '" /></span>';
            }

            if ( $this->field['speaker_six'] === true && $this->field['default']['speaker_six'] !== false ) {
                echo '<span class="linkColor"><strong>' . esc_html__( 'Speaker Six', 'pick' ) . '</strong>&nbsp;<input id="' . $this->field['id'] . '-speaker_six" name="' . $this->field['name'] . $this->field['name_suffix'] . '[speaker_six]' . '" value="' . $this->value['speaker_six'] . '" class="redux-color redux-color-speaker_six redux-color-init ' . $this->field['class'] . '"  type="text" data-default-color="' . $this->field['default']['speaker_six'] . '" /></span>';
            }
        }

        /**
         * Enqueue Function.
         * If this field requires any scripts, or css define this function and register/enqueue the scripts/css
         *
         * @since       1.0.0
         * @access      public
         * @return      void
         */
        public function enqueue() {

            if ( empty( $this->extension_dir ) ) {
                $this->extension_dir = trailingslashit( str_replace( '\\', '/', dirname( __FILE__ ) ) );
                $this->extension_url = site_url( str_replace( trailingslashit( str_replace( '\\', '/', ABSPATH ) ), '', $this->extension_dir ) );
            } 
            wp_enqueue_style( 'wp-color-picker' );
            
            wp_enqueue_script(
                'redux-field-softhopper-chat-bg-js', 
                $this->extension_url . 'field_softhopper_chat_bg.js', 
                array( 'jquery', 'wp-color-picker', 'redux-js' ),
                time(),
                true
            );

            if ($this->parent->args['dev_mode']) {
                wp_enqueue_style( 'redux-color-picker-css' );

                wp_enqueue_style(
                    'redux-field-softhopper_chat_bg-css', 
                    $this->extension_url . 'field_softhopper_chat_bg.css',
                    time(),
                    'all'
                );
            }
        }

        public function output() {

            $style = array();

            if ( ! empty( $this->value['speaker_one'] ) && $this->field['speaker_one'] === true && $this->field['default']['speaker_one'] !== false ) {
                $style[] = 'color:' . $this->value['speaker_one'] . ';';
            }

            if ( ! empty( $this->value['speaker_three'] ) && $this->field['speaker_three'] === true && $this->field['default']['speaker_three'] !== false ) {
                $style['speaker_three'] = 'color:' . $this->value['speaker_three'] . ';';
            }

            if ( ! empty( $this->value['speaker_two'] ) && $this->field['speaker_two'] === true && $this->field['default']['speaker_two'] !== false ) {
                $style['speaker_two'] = 'color:' . $this->value['speaker_two'] . ';';
            }

            if ( ! empty( $this->value['speaker_four'] ) && $this->field['speaker_four'] === true && $this->field['default']['speaker_four'] !== false ) {
                $style['speaker_four'] = 'color:' . $this->value['speaker_four'] . ';';
            }

            if ( ! empty( $this->value['speaker_five'] ) && $this->field['speaker_five'] === true && $this->field['default']['speaker_five'] !== false ) {
                $style['speaker_five'] = 'color:' . $this->value['speaker_five'] . ';';
            }

            if ( ! empty( $this->value['speaker_six'] ) && $this->field['speaker_six'] === true && $this->field['default']['speaker_six'] !== false ) {
                $style['speaker_six'] = 'color:' . $this->value['speaker_six'] . ';';
            }

            if ( ! empty( $style ) ) {
                if ( ! empty( $this->field['output'] ) && is_array( $this->field['output'] ) ) {
                    $styleString = "";

                    foreach ( $style as $key => $value ) {
                        if ( is_numeric( $key ) ) {
                            $styleString .= implode( ",", $this->field['output'] ) . "{" . $value . '}';
                        } else {
                            if ( count( $this->field['output'] ) == 1 ) {
                                $styleString .= $this->field['output'][0] . ":" . $key . "{" . $value . '}';
                            } else {
                                $blah = '';
                                foreach($this->field['output'] as $k => $sel) {
                                    $blah .= $sel . ':' . $key . ',';
                                }

                                $blah = substr($blah, 0, strlen($blah) - 1);
                                $styleString .= $blah . '{' . $value . '}';

                            }
                        }
                    }

                    $this->parent->outputCSS .= $styleString;
                }

                if ( ! empty( $this->field['compiler'] ) && is_array( $this->field['compiler'] ) ) {
                    $styleString = "";

                    foreach ( $style as $key => $value ) {
                        if ( is_numeric( $key ) ) {
                            $styleString .= implode( ",", $this->field['compiler'] ) . "{" . $value . '}';

                        } else {
                            if ( count( $this->field['compiler'] ) == 1 ) {
                                $styleString .= $this->field['compiler'][0] . ":" . $key . "{" . $value . '}';
                            } else {
                                $blah = '';
                                foreach($this->field['compiler'] as $k => $sel) {
                                    $blah .= $sel . ':' . $key . ',';
                                }

                                $blah = substr($blah, 0, strlen($blah) - 1);
                                $styleString .= $blah . '{' . $value . '}';
                            }
                        }
                    }
                    $this->parent->compilerCSS .= $styleString;
                }
            }
        }
    }
}