<?php

class Twig_Extensions_Extension_Booking extends Twig_Extension
{
    /**
     * Returns a list of filters.
     *
     * @return array
     */
    public function getFilters()
    {
        return array(
            'diff_price' => new Twig_Filter_Function('twig_booking_percent_diff', array('needs_environment' => false))            
        );
    }

    /**
     * Name of this extension
     *
     * @return string
     */
    public function getName()
    {
        return 'Booking';
    }
}

function twig_booking_percent_diff($value, $percent)
{
    $percent_diff = $percent - 10;
    
    return round(ceil($value) * $percent_diff/100, 2);
}