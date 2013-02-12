<?php

/* myaccount/newFriendshipRequests.twig */
class __TwigTemplate_a14860d9a3cf81c5e47952a881511543 extends Twig_Template
{
    protected function doGetParent(array $context)
    {
        return false;
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        if (isset($context["friends"])) { $_friends_ = $context["friends"]; } else { $_friends_ = null; }
        if ((twig_length_filter($this->env, $_friends_) > 0)) {
            // line 2
            echo "\t<div style=\"padding:0 3px;background-color:#F20;font-weight600:\"><a href=\"/my-account/my-friendship-requests\">";
            if (isset($context["friends"])) { $_friends_ = $context["friends"]; } else { $_friends_ = null; }
            echo twig_escape_filter($this->env, twig_length_filter($this->env, $_friends_), "html", null, true);
            echo "</a></div>
";
        }
    }

    public function getTemplateName()
    {
        return "myaccount/newFriendshipRequests.twig";
    }

    public function isTraitable()
    {
        return false;
    }
}
