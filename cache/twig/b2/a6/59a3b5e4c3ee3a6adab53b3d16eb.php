<?php

/* isusedemail.twig */
class __TwigTemplate_b2a659a3b5e4c3ee3a6adab53b3d16eb extends Twig_Template
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
        return "isusedemail.twig";
    }

    public function isTraitable()
    {
        return false;
    }
}
