<?php

/* myaccount/products/buy.twig */
class __TwigTemplate_c559815364aa6fcab3dc7ae9cab8e33c extends Twig_Template
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
        return "myaccount/products/buy.twig";
    }

    public function isTraitable()
    {
        return false;
    }
}
