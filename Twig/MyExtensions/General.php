<?php

class Twig_MyExtensions_General extends Twig_Extension
{
    /**
     * Returns a list of filters.
     *
     * @return array
     */
    public function getFilters()
    {
        return array(
            'unserialize' => new Twig_Filter_Function('twig_unserialize', array('needs_environment' => false)),
            'strtotime' => new Twig_Filter_Function('twig_strtotime', array('needs_environment' => false)),
            'currency' => new Twig_Filter_Function('twig_currency', array('needs_environment' => false))
        );
    }

    /**
     * Name of this extension
     *
     * @return string
     */
    public function getName()
    {
        return 'Unserialize';
    }
}

function twig_currency($value)
{
    //echo $value;
    $a = new Zend_Currency(array('value' => $value, 'symbol' => 'S$'), 'en_US');
    return $a;
}

function twig_unserialize($value)
{
    return unserialize($value);
}

function twig_strtotime($value)
{
    return strtotime($value);
}