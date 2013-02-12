<?php

/* myaccount/chpass.twig */
class __TwigTemplate_1d944245101733e33942118552b995dd extends Twig_Template
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
        // line 2
        $context["forms"] = $this->env->loadTemplate("/forms/forms.twig");
        $this->getParent($context)->display($context, array_merge($this->blocks, $blocks));
    }

    // line 4
    public function block_css($context, array $blocks = array())
    {
        // line 5
        echo "    ";
        if (isset($context["app"])) { $_app_ = $context["app"]; } else { $_app_ = null; }
        if ((!$this->getAttribute($_app_, "ajax"))) {
            // line 6
            echo "        ";
            $this->env->loadTemplate("myaccount/css.twig")->display($context);
            // line 7
            echo "    ";
        }
    }

    // line 9
    public function block_js($context, array $blocks = array())
    {
        // line 10
        echo "    ";
        if (isset($context["app"])) { $_app_ = $context["app"]; } else { $_app_ = null; }
        if ((!$this->getAttribute($_app_, "ajax"))) {
            // line 11
            echo "        ";
            $this->env->loadTemplate("myaccount/js.twig")->display($context);
            // line 12
            echo "    ";
        }
    }

    // line 15
    public function block_content_page($context, array $blocks = array())
    {
        // line 16
        echo "    <h1>Change Password</h1>
    <div class=\"ma_top\"></div>
    <div class=\"ma_content\">
        ";
        // line 19
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        if ($this->getAttribute($_form_, "errors")) {
            // line 20
            echo "            <br /><div class=\"error_box\"><strong>There were errors - please verify all fields for errors</strong></div>
        ";
        }
        // line 22
        echo "        ";
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        if ($this->getAttribute($_form_, "success")) {
            // line 23
            echo "            <div class=\"infotip\" style=\"margin: 0px;\"><strong>Success</strong><br /><br />Your password has been changed.
\t\t\t\t\t\t&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
\t\t\t\t\t\t<a class=\"g-button g-button-submit ajax-link\" href=\"/my-account\">Exit To Overview</a></div>
\t\t\t\t";
        } else {
            // line 27
            echo "        <form enctype=\"application/x-www-form-urlencoded\" action=\"/my-account/change-password\" method=\"post\">
            <div class=\"form-global clearfix\">
                <div class=\"label_big\"><label for=\"c_pass\">Current password:</label></div>
                <div class=\"input\">
                    ";
            // line 31
            if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "input", array("c_pass", "", "password", ), "method"), "html", null, true);
            echo "
                    ";
            // line 32
            if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
            if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "errors", array($this->getAttribute($this->getAttribute($_form_, "errors"), "c_pass"), ), "method"), "html", null, true);
            echo "
                </div>
                <div class=\"label_big\"><label for=\"new_pass\">New password:</label></div>
                <div class=\"input\">
                    ";
            // line 36
            if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "input", array("new_pass", "", "password", ), "method"), "html", null, true);
            echo "
                    ";
            // line 37
            if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
            if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "errors", array($this->getAttribute($this->getAttribute($_form_, "errors"), "new_pass"), ), "method"), "html", null, true);
            echo "
                </div>
                <div class=\"label_big\"><label for=\"renew_pass\">Retype new password:</label></div>
                <div class=\"input\">
                    ";
            // line 41
            if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "input", array("renew_pass", "", "password", ), "method"), "html", null, true);
            echo "
                    ";
            // line 42
            if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
            if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "errors", array($this->getAttribute($this->getAttribute($_form_, "errors"), "renew_pass"), ), "method"), "html", null, true);
            echo "
                </div>
                <div class=\"label_big\"><label>&nbsp;</label></div>
                <div class=\"left\"><input type=\"submit\" class=\"g-button g-button-submit ajax-submit\" value=\"Change\" /></div>
            </div>
        </form>
\t\t\t\t";
        }
        // line 49
        echo "    </div>
    <div class=\"ma_bottom\"></div>
";
    }

    // line 53
    public function block_right_side($context, array $blocks = array())
    {
        // line 54
        echo "    ";
        if (isset($context["app"])) { $_app_ = $context["app"]; } else { $_app_ = null; }
        if ((!$this->getAttribute($_app_, "ajax"))) {
            // line 55
            echo "        ";
            $context["ma_menu"] = "chpass";
            // line 56
            echo "        ";
            $this->env->loadTemplate("myaccount/menu.twig")->display($context);
            // line 57
            echo "    ";
        }
    }

    public function getTemplateName()
    {
        return "myaccount/chpass.twig";
    }

    public function isTraitable()
    {
        return false;
    }
}
