<?php

/* myaccount/approveFriendRequest.twig */
class __TwigTemplate_9fb3a50b65a4cf3f8a7f5d3ae5092218 extends Twig_Template
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
        return "myaccount/approveFriendRequest.twig";
    }

    public function isTraitable()
    {
        return false;
    }
}
