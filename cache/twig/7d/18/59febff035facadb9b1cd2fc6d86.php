<?php

/* myaccount/products/confirmdeal.twig */
class __TwigTemplate_7d1859febff035facadb9b1cd2fc6d86 extends Twig_Template
{
    protected function doGetParent(array $context)
    {
        return false;
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 2
        if (isset($context["message"])) { $_message_ = $context["message"]; } else { $_message_ = null; }
        echo twig_escape_filter($this->env, $_message_, "html", null, true);
    }

    public function getTemplateName()
    {
        return "myaccount/products/confirmdeal.twig";
    }

    public function isTraitable()
    {
        return false;
    }
}
