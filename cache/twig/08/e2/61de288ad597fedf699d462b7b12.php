<?php

/* default/my_network.twig */
class __TwigTemplate_08e261de288ad597fedf699d462b7b12 extends Twig_Template
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
        echo "
<h1>My Network Links</h1>
    <div>
        <a href=\"";
        // line 7
        if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array("@myNetwork?ac=add", ), "method"), "html", null, true);
        echo "\" class=\"g-button g-button-share ajax-link\">Add Media</a>
    </div>
    <br />
    <ul class=\"pagination clearfix\">";
        // line 10
        if (isset($context["pagination"])) { $_pagination_ = $context["pagination"]; } else { $_pagination_ = null; }
        echo $_pagination_;
        echo "</ul>
    <div class=\"yui3-g\" style=\"font-weight:bold;font-size:16px;border-bottom:1px solid #3079ed; width: 400px;\">
            <div class=\"yui3-u\" style=\"width: 50px;\">
                ID
            </div>
            <div class=\"yui3-u\" style=\"width: 120px;\">
                Title
            </div>
            <div class=\"yui3-u\" style=\"width: 120px;\">
                File name
            </div>
            <div class=\"yui3-u\" style=\"width: 110px;\">
                Actions
            </div>
    </div>
    ";
        // line 25
        if (isset($context["links"])) { $_links_ = $context["links"]; } else { $_links_ = null; }
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($_links_);
        foreach ($context['_seq'] as $context["_key"] => $context["link"]) {
            // line 26
            echo "        <div class=\"yui3-g\">
            <div class=\"yui3-u\" style=\"width: 50px;\">
                ";
            // line 28
            if (isset($context["link"])) { $_link_ = $context["link"]; } else { $_link_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_link_, "id"), "html", null, true);
            echo "
            </div>
            <div class=\"yui3-u\" style=\"width: 120px;\">
                ";
            // line 31
            if (isset($context["link"])) { $_link_ = $context["link"]; } else { $_link_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_link_, "title"), "html", null, true);
            echo "
            </div>
            <div class=\"yui3-u\" style=\"width: 120px;\">
                ";
            // line 34
            if (isset($context["link"])) { $_link_ = $context["link"]; } else { $_link_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_link_, "filename"), "html", null, true);
            echo "
            </div>
            <div class=\"yui3-u\" style=\"width: 110px;\">
\t\t\t\t\t\t\t <a href=\"";
            // line 37
            if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
            if (isset($context["link"])) { $_link_ = $context["link"]; } else { $_link_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array(("@myNetwork?ac=delete&id=" . $this->getAttribute($_link_, "id")), ), "method"), "html", null, true);
            echo "\" class=\"g-button g-button-share ajax-link\">Delete</a>
            </div>
        </div>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['link'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 41
        echo "        <ul class=\"pagination clearfix\" id=\"pagination\">";
        if (isset($context["pagination"])) { $_pagination_ = $context["pagination"]; } else { $_pagination_ = null; }
        echo $_pagination_;
        echo "</ul>
";
    }

    // line 43
    public function block_left_menu($context, array $blocks = array())
    {
        // line 44
        echo "    ";
        if (isset($context["app"])) { $_app_ = $context["app"]; } else { $_app_ = null; }
        if ((!$this->getAttribute($_app_, "ajax"))) {
            // line 45
            echo "        ";
            $context["adm_menu"] = "my_network";
            // line 46
            echo "        ";
            $this->env->loadTemplate("inc/leftSide.twig")->display($context);
            // line 47
            echo "    ";
        }
    }

    public function getTemplateName()
    {
        return "default/my_network.twig";
    }

    public function isTraitable()
    {
        return false;
    }
}
