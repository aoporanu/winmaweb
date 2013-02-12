<?php

/* myaccount/senderDeleteMessage.twig */
class __TwigTemplate_e20f37ce374e7abbf1c50ccb6802d815 extends Twig_Template
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
        return "myaccount/senderDeleteMessage.twig";
    }

    public function isTraitable()
    {
        return false;
    }
}
