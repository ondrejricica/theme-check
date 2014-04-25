<?php

class SSL_Check implements themecheck {
	protected $error = array();

	function check( $php_files, $css_files, $other_files) {

		// combine all the php files into one string to make it easier to search
		$php = implode( ' ', $php_files );

		checkcount();

		$ret = true;
		if (
			strpos( $php, 'http://fonts.googleapis.com' ) !== false
		) {
			$this->error[] = "<span class='tc-lead tc-warning'>" . __('WARNING', 'theme-check' ). "</span>: " . __( 'Google fonts should be enqueued without the "http:" as this will cause issues for sites running SSL.  Instead use "//fonts.googleapis.com" when enqueuing Google fonts.', 'theme-check' );
			$ret = false;
		}

		return $ret;
	}

	function getError() { return $this->error; }
}
$themechecks[] = new SSL_Check;