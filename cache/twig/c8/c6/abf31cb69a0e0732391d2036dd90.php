<?php

/* myaccount/getUnreadMessages.twig */
class __TwigTemplate_c8c6abf31cb69a0e0732391d2036dd90 extends Twig_Template
{
    protected function doGetParent(array $context)
    {
        return false;
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        if (isset($context["messages"])) { $_messages_ = $context["messages"]; } else { $_messages_ = null; }
        if ((twig_length_filter($this->env, $_messages_) > 0)) {
            // line 2
            echo "\t<a href=\"/my-account/my-received-messages\"><img src=\"/images/email_icon.png\" width=\"24px\" height=\"24px\" alt=\"";
            if (isset($context["messages"])) { $_messages_ = $context["messages"]; } else { $_messages_ = null; }
            echo twig_escape_filter($this->env, $_messages_, "html", null, true);
            echo "\" /></a>
";
        }
    }

    public function getTemplateName()
    {
        return "myaccount/getUnreadMessages.twig";
    }

    public function isTraitable()
    {
        return false;
    }
}
