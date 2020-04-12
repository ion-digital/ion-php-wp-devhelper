<?php
/*
 * See license information at the package root in LICENSE.md
 */
namespace ion\WordPress\Helper;

/**
 *
 * @author Justus
 */
use ion\IPackage;

interface IContext
{
    /**
     * method
     * 
     * @return IHelperContext
     */
    
    function getHelperContext();
    
    /**
     * method
     * 
     * @return IPackage
     */
    
    function getPackage();

}