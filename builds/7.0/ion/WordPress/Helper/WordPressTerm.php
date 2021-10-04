<?php
/*
 * See license information at the package root in LICENSE.md
 */
namespace ion\WordPress\Helper;

/**
 * Description of WordPressTerm
 *
 * @author Justus
 */
use WP_Term;
class WordPressTerm implements WordPressTermInterface
{
    private $wpTerm;
    private $children;
    /**
     * method
     * 
     * 
     * @return mixed
     */
    public function __construct(WP_Term $wpTerm, array $children = [])
    {
        $this->wpTerm = $wpTerm;
        $this->children = $children;
    }
    /**
     * method
     * 
     * @return WP_Term
     */
    public function getTermObject() : WP_Term
    {
        return $this->wpTerm;
    }
    /**
     * method
     * 
     * @return array
     */
    public function &getChildren() : array
    {
        return $this->children;
    }
}