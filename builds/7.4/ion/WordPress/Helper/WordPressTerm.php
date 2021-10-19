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
    public function __construct(WP_Term $wpTerm, array $children = [])
    {
        $this->wpTerm = $wpTerm;
        $this->children = $children;
    }
    public function getTermObject() : WP_Term
    {
        return $this->wpTerm;
    }
    public function &getChildren() : array
    {
        return $this->children;
    }
}