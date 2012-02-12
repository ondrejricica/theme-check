<?php
// recommended deprecations checks... After some time, these will move into deprecated.php and become required.
class Deprecated_Recommended implements themecheck {
	protected $error = array();

	function check( $php_files, $css_files, $other_files ) {
		$grep = '';

		$ret = true;

		$checks = array(
			array( 'wp_timezone_supported' => 'No alternatives', '3.2' )
			);

		foreach ( $php_files as $php_key => $phpfile ) {
			foreach ( $checks as $alt => $check ) {
				checkcount();
				$version = $check;
				$key = key( $check );
				$alt = $check[ $key ];
				if ( preg_match( '/[\s?]' . $key . '\(/', $phpfile, $matches ) ) {
					$filename = tc_filename( $php_key );
					$error = ltrim( rtrim( $matches[0], '(' ) );
					$version = $check[0];
					$grep = tc_grep( $error, $php_key );
					$this->error[] = sprintf(__('<span class="tc-lead tc-recommended">RECOMMENDED</span>: <strong>%1$s</strong> found in the file <strong>%2$s</strong>. Deprecated since version <strong>%3$s</strong>. Use <strong>%4$s</strong> instead.%5$s', 'themecheck'), $error, $filename, $version, $alt, $grep) ;
				}
			}
		}
		return $ret;
	}

	function getError() { return $this->error; }
}
$themechecks[] = new Deprecated_Recommended;