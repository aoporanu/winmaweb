<?php

/* statistic/index.twig */
class __TwigTemplate_56b624c199c83e0cf168f704cd93bb80 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->blocks = array(
            'content' => array($this, 'block_content'),
            'left_menu' => array($this, 'block_left_menu'),
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
        echo "<h1>Manage Statistic</h1>
<a href=\"";
        // line 5
        if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array("@manageStatistics", ), "method"), "html", null, true);
        echo "\" class=\"g-button ";
        if (isset($context["action"])) { $_action_ = $context["action"]; } else { $_action_ = null; }
        if (($_action_ == "user")) {
            echo "g-button-submit ";
        }
        echo "ajax-link\">User registrations</a>
<a href=\"";
        // line 6
        if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array("@manageStatistics?action=offers", ), "method"), "html", null, true);
        echo "\" class=\"g-button ";
        if (isset($context["action"])) { $_action_ = $context["action"]; } else { $_action_ = null; }
        if (($_action_ == "offers")) {
            echo "g-button-submit ";
        }
        echo "ajax-link\">Offers</a>
<a href=\"";
        // line 7
        if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array("@manageStatistics?action=wallet", ), "method"), "html", null, true);
        echo "\" class=\"g-button ";
        if (isset($context["action"])) { $_action_ = $context["action"]; } else { $_action_ = null; }
        if (($_action_ == "wallet")) {
            echo "g-button-submit ";
        }
        echo "ajax-link\">Users wallet</a>
";
        // line 10
        echo "
";
        // line 11
        if (isset($context["action"])) { $_action_ = $context["action"]; } else { $_action_ = null; }
        if (isset($context["type"])) { $_type_ = $context["type"]; } else { $_type_ = null; }
        $template = $this->env->resolveTemplate((((("statistic/" . $_action_) . "/") . $_type_) . ".twig"));
        $template->display($context);
        // line 12
        echo "

";
    }

    // line 15
    public function block_left_menu($context, array $blocks = array())
    {
        // line 16
        echo "    ";
        if (isset($context["app"])) { $_app_ = $context["app"]; } else { $_app_ = null; }
        if ((!$this->getAttribute($_app_, "ajax"))) {
            // line 17
            echo "        ";
            $context["adm_menu"] = "statistics";
            // line 18
            echo "        ";
            $this->env->loadTemplate("inc/leftSide.twig")->display($context);
            // line 19
            echo "    ";
        }
    }

    public function getTemplateName()
    {
        return "statistic/index.twig";
    }

    public function isTraitable()
    {
        return false;
    }
}
