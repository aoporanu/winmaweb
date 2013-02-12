<?php

/* myaccount/products/showOnProfile.twig */
class __TwigTemplate_8515cda250bbba0fbdc86d3da0a02c19 extends Twig_Template
{
    protected function doGetParent(array $context)
    {
        return false;
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        if (isset($context["message"])) { $_message_ = $context["message"]; } else { $_message_ = null; }
        echo twig_escape_filter($this->env, $_message_, "html", null, true);
    }

    public function getTemplateName()
    {
        return "myaccount/products/showOnProfile.twig";
    }

    public function isTraitable()
    {
        return false;
    }
}
