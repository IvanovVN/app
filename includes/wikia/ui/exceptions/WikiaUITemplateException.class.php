<?php

/**
 * Exception thrown by UI Component
 *
 * Class WikiaUITemplateException
 */
class WikiaUITemplateException extends WikiaException {

	const EXCEPTION_MSG_INVALID_TEMPLATE = 'Invalid template';

	public function __construct( $message = self::EXCEPTION_MSG_INVALID_TEMPLATE, $code = 0, Exception $previous = null ) {
		parent::__construct( $message, $code, $previous );
	}
}
