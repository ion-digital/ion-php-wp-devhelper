<?php
/*
 * See license information at the package root in LICENSE.md
 */
namespace ion\WordPress\Helper;

/**
 * Description of WordPressTaxonomy
 *
 * @author Justus
 */

class WordPressTaxonomy implements IWordPressTaxonomy
{
    private $slug;
    private $parent;
    public function __construct(string $slug, array &$parent)
    {
        $this->slug = $slug;
        $this->parent = $parent;
    }

}