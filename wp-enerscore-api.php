<?php
/**
 * WP Enerscore API (http://map.enerscore.com/#/api)
 *
 * @package WP-Enerscore-API
 */

/* Exit if accessed directly */
if ( ! defined( 'ABSPATH' ) ) { exit; }

/* Check if class exists. */
if ( ! class_exists( 'EnerscoreAPI' ) ) {

	/**
	 * CodeClimateAPI class.
	 */
	class EnerscoreAPI {

		 /**
		 * URL to the API.
		 *
		 * @var string
		 */
		private $base_uri = 'http://api-alpha.enerscore.com/api/address/neighbors/';

		/**
		 * __construct function.
		 *
		 * @access public
		 * @return void
		 */
		public function __construct() {

		}

		 /**
		 * Fetch the request from the API.
		 *
		 * @access private
		 * @param mixed $request Request URL.
		 * @return $body Body.
		 */
		private function fetch( $request ) {

			$response = wp_remote_get( $request );
			$code = wp_remote_retrieve_response_code( $response );

			if ( 200 !== $code ) {
				return new WP_Error( 'response-error', sprintf( __( 'Server response code: %d', 'text-domain' ), $code ) );
			}

			$body = wp_remote_retrieve_body( $response );

			return json_decode( $body );

		}


		/**
		 * get_enerscore function.
		 *
		 * @access public
		 * @param mixed $address Address.
		 * @return void
		 */
		public function get_enerscore( $address ) {

			if ( empty( $address ) ) {
				return new WP_Error( 'required-fields', __( 'Required fields are empty.', 'text-domain' ) );
			}

			$request = $this->base_uri . $address;

			return $this->fetch( $request );

		}

	}

}