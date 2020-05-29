<?php
/*
 * See license information at the package root in LICENSE.md
 */
namespace ion\WordPress\Helper;

/**
 * Description of WordPressHelperException
 *
 * @author Justus
 */
use Exception;
use WP_Error;

class WordPressHelperException extends Exception implements IWordPressHelperException
{
    /**
     * method
     * 
     * 
     * @return mixed
     */
    
    public function __construct($message = "", $code = null, Exception $previous = null)
    {
        parent::__construct($message, $code === null ? 0 : $code, $previous);
    }

}