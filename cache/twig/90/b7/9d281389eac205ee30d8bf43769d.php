<?php

/* user/actionsStatistics.twig */
class __TwigTemplate_90b79d281389eac205ee30d8bf43769d extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->blocks = array(
            'content' => array($this, 'block_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return $this->env->resolveTemplate((($this->getAttribute($this->getContext($context, "app"), "ajax")) ? ("layouts/ajax.twig") : ("layouts/layout.twig")));
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->getParent($context)->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_content($context, array $blocks = array())
    {
        // line 4
        $context["actionsMenu"] = "statistics";
        // line 5
        $this->env->loadTemplate("user/actionsMenu.twig")->display($context);
        // line 6
        echo "<br /><br />
<a href=\"";
        // line 7
        if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
        if (isset($context["userId"])) { $_userId_ = $context["userId"]; } else { $_userId_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array((("@manageUsersActions?id=" . $_userId_) . "&tab=statistics"), ), "method"), "html", null, true);
        echo "\" class=\"g-button";
        if (isset($context["type"])) { $_type_ = $context["type"]; } else { $_type_ = null; }
        if ((($_type_ == "bDaily") || ($_type_ == "bMonthly"))) {
            echo " g-button-submit";
        }
        echo " modal-ajax-link\">Bought offers</a>
<a href=\"";
        // line 8
        if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
        if (isset($context["userId"])) { $_userId_ = $context["userId"]; } else { $_userId_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array((("@manageUsersActions?id=" . $_userId_) . "&tab=statistics&type=sDaily"), ), "method"), "html", null, true);
        echo "\" class=\"g-button";
        if (isset($context["type"])) { $_type_ = $context["type"]; } else { $_type_ = null; }
        if ((($_type_ == "sDaily") || ($_type_ == "sMonthly"))) {
            echo " g-button-submit";
        }
        echo " modal-ajax-link\">Sold offers</a>
<br /><br />
";
        // line 12
        echo "
";
        // line 13
        if (isset($context["for"])) { $_for_ = $context["for"]; } else { $_for_ = null; }
        if (isset($context["type"])) { $_type_ = $context["type"]; } else { $_type_ = null; }
        $template = $this->env->resolveTemplate((((("user/statistics/" . $_for_) . "/") . $_type_) . ".twig"));
        $template->display($context);
        // line 14
        echo "
";
    }

    public function getTemplateName()
    {
        return "user/actionsStatistics.twig";
    }

    public function isTraitable()
    {
        return false;
    }
}
