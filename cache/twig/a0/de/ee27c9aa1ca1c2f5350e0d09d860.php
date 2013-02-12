<?php

/* myaccount/viewmyreferrals.twig */
class __TwigTemplate_a0deee27c9aa1ca1c2f5350e0d09d860 extends Twig_Template
{
    protected function doGetParent(array $context)
    {
        return false;
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 2
        if (isset($context["message"])) { $_message_ = $context["message"]; } else { $_message_ = null; }
        if ($_message_) {
            // line 3
            echo "    ";
            if (isset($context["message"])) { $_message_ = $context["message"]; } else { $_message_ = null; }
            echo twig_escape_filter($this->env, $_message_, "html", null, true);
            echo "
";
        }
    }

    public function getTemplateName()
    {
        return "myaccount/viewmyreferrals.twig";
    }

    public function isTraitable()
    {
        return false;
    }
}
