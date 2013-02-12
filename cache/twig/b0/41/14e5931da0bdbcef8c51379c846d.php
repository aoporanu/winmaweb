<?php

/* login.twig */
class __TwigTemplate_b04114e5931da0bdbcef8c51379c846d extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->blocks = array(
            'content_page' => array($this, 'block_content_page'),
        );
    }

    protected function doGetParent(array $context)
    {
        return $this->env->resolveTemplate((($this->getAttribute($this->getContext($context, "app"), "ajax")) ? ("layouts/ajax.twig") : ("layouts/layout_default.twig")));
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 2
        $context["forms"] = $this->env->loadTemplate("/forms/forms.twig");
        $this->getParent($context)->display($context, array_merge($this->blocks, $blocks));
    }

    // line 4
    public function block_content_page($context, array $blocks = array())
    {
        // line 5
        if (isset($context["app"])) { $_app_ = $context["app"]; } else { $_app_ = null; }
        if ($this->getAttribute($_app_, "ajaxRedirectUrl")) {
            // line 6
            echo "<div class=\"inv ajax-redirect\">";
            if (isset($context["app"])) { $_app_ = $context["app"]; } else { $_app_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_app_, "ajaxRedirectUrl"), "html", null, true);
            echo "</div>
";
        }
        // line 8
        echo "<form name=\"frmLogin\" enctype=\"application/x-www-form-urlencoded\" action=\"/login\" method=\"post\">
    <div class=\"form-global form-reg clearfix\">
        <div class=\"clearfix\">
        <div class=\"label\"><label for=\"login_username\">Username:</label></div>
        <div class=\"input\">
            ";
        // line 13
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "input", array("login_username", $this->getAttribute($this->getAttribute($_form_, "values"), "login_username"), ), "method"), "html", null, true);
        echo "
            ";
        // line 14
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "errors", array($this->getAttribute($this->getAttribute($_form_, "errors"), "login_username"), ), "method"), "html", null, true);
        echo "
        </div>
        </div>
        <div class=\"clearfix\">
        <div class=\"label\"><label for=\"login_password\">Password:</label></div>
        <div class=\"input\">
            ";
        // line 20
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "input", array("login_password", "", "password", ), "method"), "html", null, true);
        echo "
            ";
        // line 21
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "errors", array($this->getAttribute($this->getAttribute($_form_, "errors"), "login_password"), ), "method"), "html", null, true);
        echo "
        </div>
        </div>
    </div>
    <div class=\"";
        // line 25
        if (isset($context["app"])) { $_app_ = $context["app"]; } else { $_app_ = null; }
        if ($this->getAttribute($_app_, "ajax")) {
            echo "modal-bottom2";
        }
        echo "\" style=\"";
        if (isset($context["app"])) { $_app_ = $context["app"]; } else { $_app_ = null; }
        if ($this->getAttribute($_app_, "ajax")) {
            echo "background:#DCDCDC;margin-bottom:-10px;text-align:left";
        }
        echo "\">
        <div class=\"clearfix\">
\t\t\t\t\t<div class=\"left\" style=\"";
        // line 27
        if (isset($context["app"])) { $_app_ = $context["app"]; } else { $_app_ = null; }
        if ((!$this->getAttribute($_app_, "ajax"))) {
            echo "margin-left:10px";
        }
        echo "\">
\t\t\t\t\t\t<div class=\"small-button\" style=\"float: none;\">
\t\t\t\t\t\t\t<a href=\"\" ";
        // line 29
        if (isset($context["app"])) { $_app_ = $context["app"]; } else { $_app_ = null; }
        if ($this->getAttribute($_app_, "ajax")) {
        } else {
            echo "onclick=\"document.forms['frmLogin'].submit(); return false;\"";
        }
        echo " class=\"";
        if (isset($context["app"])) { $_app_ = $context["app"]; } else { $_app_ = null; }
        if ($this->getAttribute($_app_, "ajax")) {
            echo "modal-submit";
        }
        echo "\">
\t\t\t\t\t\t\t\t<div class=\"button_see\">
\t\t\t\t\t\t\t\t\t<div class=\"small-left\"></div>
\t\t\t\t\t\t\t\t\t<div class=\"small-center\">Login</div>
\t\t\t\t\t\t\t\t\t<div class=\"small-right\"></div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<input type=\"submit\" name=\"update\" value=\" Apply \" style=\"position: absolute; height: 0px; width: 0px; border: none; padding: 0px;\" hidefocus=\"true\" tabindex=\"-1\"/>
\t\t\t\t\t\t<div class=\"clear\"></div>
\t\t\t\t\t</div>
\t\t\t\t\t<div class=\"right\">
\t\t\t\t\t\t<div class=\"small-button\" style=\"float: none;\">
\t\t\t\t\t\t\t<a href=\"/forgot-password\">
\t\t\t\t\t\t\t\t<div class=\"button_see forgot_pass\">Forgot password</div>
\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<div class=\"clear\"></div>
\t\t\t\t\t</div>
\t\t\t\t\t<div class=\"clear\"></div>
        </div>
    </div>
</form>
";
    }

    public function getTemplateName()
    {
        return "login.twig";
    }

    public function isTraitable()
    {
        return false;
    }
}
