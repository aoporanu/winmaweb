<?php

class Twig_Extensions_Extension_Math extends Twig_Extension
{
    /**
     * Returns a list of filters.
     *
     * @return array
     */
    public function getFilters()
    {
        return array(
            'round' => new Twig_Filter_Function('twig_math_round', array('needs_environment' => false))            
        );
    }

    /**
     * Name of this extension
     *
     * @return string
     */
    public function getName()
    {
        return 'Math';
    }
}

function twig_math_round($value, $v = 2)
{
    return round($value, $v);
}