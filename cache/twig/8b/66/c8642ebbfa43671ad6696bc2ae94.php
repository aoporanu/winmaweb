<?php

/* myaccount/autocompleteUser.twig */
class __TwigTemplate_8b66c8642ebbfa43671ad6696bc2ae94 extends Twig_Template
{
    protected function doGetParent(array $context)
    {
        return false;
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        if (isset($context["user"])) { $_user_ = $context["user"]; } else { $_user_ = null; }
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($_user_);
        foreach ($context['_seq'] as $context["_key"] => $context["username"]) {
            // line 2
            echo "\t<li>";
            if (isset($context["username"])) { $_username_ = $context["username"]; } else { $_username_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_username_, "username"), "html", null, true);
            echo "</li>
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['username'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
    }

    public function getTemplateName()
    {
        return "myaccount/autocompleteUser.twig";
    }

    public function isTraitable()
    {
        return false;
    }
}
