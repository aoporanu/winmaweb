<?php

/* profile.twig */
class __TwigTemplate_2166a7133cc9af4b70e81f0825efcdd1 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->blocks = array(
            'css' => array($this, 'block_css'),
            'js' => array($this, 'block_js'),
            'content_page' => array($this, 'block_content_page'),
            'right_side' => array($this, 'block_right_side'),
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
    public function block_css($context, array $blocks = array())
    {
        // line 4
        echo "\t";
        if (isset($context["app"])) { $_app_ = $context["app"]; } else { $_app_ = null; }
        if ((!$this->getAttribute($_app_, "ajax"))) {
            // line 5
            echo "\t\t";
            $this->env->loadTemplate("myaccount/css.twig")->display($context);
            // line 6
            echo "\t";
        }
    }

    // line 8
    public function block_js($context, array $blocks = array())
    {
        // line 9
        echo "\t";
        if (isset($context["app"])) { $_app_ = $context["app"]; } else { $_app_ = null; }
        if ((!$this->getAttribute($_app_, "ajax"))) {
            // line 10
            echo "\t\t";
            $this->env->loadTemplate("myaccount/js.twig")->display($context);
            // line 11
            echo "\t";
        }
    }

    // line 14
    public function block_content_page($context, array $blocks = array())
    {
        // line 15
        echo "\t<h1>";
        if (isset($context["user"])) { $_user_ = $context["user"]; } else { $_user_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_user_, "username"), "html", null, true);
        echo "'s Profile</h1>
\t<div class=\"ma_top\"></div>
\t<div class=\"ma_content\">
\t\t";
        // line 18
        $this->env->loadTemplate("profile_box.twig")->display($context);
        // line 19
        echo "\t</div>
\t<div class=\"ma_bottom\"></div>
";
    }

    // line 22
    public function block_right_side($context, array $blocks = array())
    {
        // line 23
        echo "\t";
        if (isset($context["logged"])) { $_logged_ = $context["logged"]; } else { $_logged_ = null; }
        if ($_logged_) {
            // line 24
            echo "\t\t";
            if (isset($context["app"])) { $_app_ = $context["app"]; } else { $_app_ = null; }
            if ((!$this->getAttribute($_app_, "ajax"))) {
                // line 25
                echo "\t\t\t";
                $context["ma_menu"] = "memberSection";
                // line 26
                echo "\t\t\t";
                $this->env->loadTemplate("myaccount/menu.twig")->display($context);
                // line 27
                echo "\t\t";
            }
            // line 28
            echo "\t";
        } else {
            // line 29
            echo "\t\t";
            $context["forms"] = $this->env->loadTemplate("/forms/forms.twig");
            // line 30
            echo "\t\t";
            $this->env->loadTemplate("right_side.twig")->display($context);
            // line 31
            echo "\t";
        }
    }

    public function getTemplateName()
    {
        return "profile.twig";
    }

    public function isTraitable()
    {
        return false;
    }
}
