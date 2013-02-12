<?php

/* myaccount/becomeAnAgent.twig */
class __TwigTemplate_49f60f7ef9bbf2d1ce454001cb022b30 extends Twig_Template
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
        echo "\t";
        if (isset($context["app"])) { $_app_ = $context["app"]; } else { $_app_ = null; }
        if ((!$this->getAttribute($_app_, "ajax"))) {
            // line 6
            echo "\t\t";
            $this->env->loadTemplate("myaccount/css.twig")->display($context);
            // line 7
            echo "\t";
        }
    }

    // line 9
    public function block_js($context, array $blocks = array())
    {
        // line 10
        echo "\t";
        if (isset($context["app"])) { $_app_ = $context["app"]; } else { $_app_ = null; }
        if ((!$this->getAttribute($_app_, "ajax"))) {
            // line 11
            echo "\t\t";
            $this->env->loadTemplate("myaccount/js.twig")->display($context);
            // line 12
            echo "\t";
        }
    }

    // line 15
    public function block_content_page($context, array $blocks = array())
    {
        // line 16
        echo "\t<h1>Become an Agent</h1>
\t<div class=\"ma_top\"></div>
\t<div class=\"ma_content\">
\t\t";
        // line 19
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        if ($this->getAttribute($_form_, "errors")) {
            // line 20
            echo "\t\t\t<br /><div class=\"error_box\"><strong>There were errors - please verify all fields for errors</strong></div>
\t\t";
        }
        // line 22
        echo "\t\t";
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        if ($this->getAttribute($_form_, "success")) {
            // line 23
            echo "\t\t\t<div class=\"infotip\"><strong>Success</strong><br /><br />Details were updated successfully</div>
\t\t";
        }
        // line 25
        echo "\t\t<form enctype=\"application/x-www-form-urlencoded\" action=\"";
        if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array("@myAccountBecomeAnAgent", ), "method"), "html", null, true);
        echo "\" method=\"post\">
\t\t\t<div class=\"form-global clearfix\">
\t\t\t\t<div class=\"label\"><label for=\"first_name\">First Name:</label></div>
\t\t\t\t<div class=\"input input_big\">
\t\t\t\t\t";
        // line 29
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "input", array("first_name", $this->getAttribute($this->getAttribute($_form_, "values"), "first_name"), ), "method"), "html", null, true);
        echo "
\t\t\t\t\t";
        // line 30
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "errors", array($this->getAttribute($this->getAttribute($_form_, "errors"), "first_name"), ), "method"), "html", null, true);
        echo "
\t\t\t\t</div>
\t\t\t\t<div class=\"label\"><label for=\"last_name\">Last Name:</label></div>
\t\t\t\t<div class=\"input input_big\">
\t\t\t\t\t";
        // line 34
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "input", array("last_name", $this->getAttribute($this->getAttribute($_form_, "values"), "last_name"), ), "method"), "html", null, true);
        echo "
\t\t\t\t\t";
        // line 35
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "errors", array($this->getAttribute($this->getAttribute($_form_, "errors"), "last_name"), ), "method"), "html", null, true);
        echo "
\t\t\t\t</div>
\t\t\t\t<div class=\"label\"><label for=\"phone\">Phone:</label></div>
\t\t\t\t<div class=\"input input_big\">
\t\t\t\t\t";
        // line 39
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "input", array("phone", $this->getAttribute($this->getAttribute($_form_, "values"), "phone"), ), "method"), "html", null, true);
        echo "
\t\t\t\t\t";
        // line 40
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "errors", array($this->getAttribute($this->getAttribute($_form_, "errors"), "phone"), ), "method"), "html", null, true);
        echo "
\t\t\t\t</div>
\t\t\t\t<div class=\"label\"><label for=\"email\">E-mail:</label></div>
\t\t\t\t<div class=\"input input_big\">
\t\t\t\t\t";
        // line 44
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "input", array("email", $this->getAttribute($this->getAttribute($_form_, "values"), "email"), ), "method"), "html", null, true);
        echo "
\t\t\t\t\t";
        // line 45
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "errors", array($this->getAttribute($this->getAttribute($_form_, "errors"), "email"), ), "method"), "html", null, true);
        echo "
\t\t\t\t</div>
\t\t\t\t<div class=\"label\"><label for=\"gender\">Gender:</label></div>
\t\t\t\t<div class=\"input input_big\">
\t\t\t\t\t";
        // line 49
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "select", array("gender", $this->getAttribute($this->getAttribute($_form_, "gender"), "options"), $this->getAttribute($this->getAttribute($_form_, "values"), "gender"), ), "method"), "html", null, true);
        echo "
\t\t\t\t\t";
        // line 50
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "errors", array($this->getAttribute($this->getAttribute($_form_, "errors"), "gender"), ), "method"), "html", null, true);
        echo "
\t\t\t\t</div>
\t\t\t\t<div class=\"label\"><label for=\"age\">Age:</label></div>
\t\t\t\t<div class=\"input input_big\">
\t\t\t\t\t";
        // line 55
        echo "\t\t\t\t\t";
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "select", array("age", $this->getAttribute($this->getAttribute($_form_, "age"), "options"), $this->getAttribute($this->getAttribute($_form_, "values"), "age"), ), "method"), "html", null, true);
        echo "
\t\t\t\t\t";
        // line 56
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "errors", array($this->getAttribute($this->getAttribute($_form_, "errors"), "age"), ), "method"), "html", null, true);
        echo "
\t\t\t\t</div>
\t\t\t</div>
\t\t\t<div class=\"page_subtitle_wrapper clearfix\">
\t\t\t\t<span class=\"page_subtitle_two\">Address</span>
\t\t\t</div>
\t\t\t<div class=\"form-global clearfix\">
\t\t\t\t<div class=\"label\"><label for=\"address\">Address:</label></div>
\t\t\t\t<div class=\"input input_big\">
\t\t\t\t\t";
        // line 65
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "input", array("address", $this->getAttribute($this->getAttribute($_form_, "values"), "address"), ), "method"), "html", null, true);
        echo "
\t\t\t\t\t";
        // line 66
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "errors", array($this->getAttribute($this->getAttribute($_form_, "errors"), "address"), ), "method"), "html", null, true);
        echo "
\t\t\t\t</div>
\t\t\t\t<div class=\"label\"><label for=\"city\">City:</label></div>
\t\t\t\t<div class=\"input input_big\">
\t\t\t\t\t";
        // line 70
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "input", array("city", $this->getAttribute($this->getAttribute($_form_, "values"), "city"), ), "method"), "html", null, true);
        echo "
\t\t\t\t\t";
        // line 71
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "errors", array($this->getAttribute($this->getAttribute($_form_, "errors"), "city"), ), "method"), "html", null, true);
        echo "
\t\t\t\t</div>
\t\t\t\t<div class=\"label\"><label for=\"county\">Province/County:</label></div>
\t\t\t\t<div class=\"input input_big\">
\t\t\t\t\t";
        // line 75
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "input", array("county", $this->getAttribute($this->getAttribute($_form_, "values"), "county"), ), "method"), "html", null, true);
        echo "
\t\t\t\t\t";
        // line 76
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "errors", array($this->getAttribute($this->getAttribute($_form_, "errors"), "county"), ), "method"), "html", null, true);
        echo "
\t\t\t\t</div>
\t\t\t\t<div class=\"label\"><label for=\"postcode\">Postal Code:</label></div>
\t\t\t\t<div class=\"input input_big\">
\t\t\t\t\t";
        // line 80
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "input", array("postcode", $this->getAttribute($this->getAttribute($_form_, "values"), "postcode"), ), "method"), "html", null, true);
        echo "
\t\t\t\t\t";
        // line 81
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "errors", array($this->getAttribute($this->getAttribute($_form_, "errors"), "postcode"), ), "method"), "html", null, true);
        echo "
\t\t\t\t</div>
\t\t\t\t<div class=\"label\"><label for=\"country\">Country:</label></div>
\t\t\t\t<div class=\"input input_big\">
\t\t\t\t\t";
        // line 85
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "select", array("country", $this->getAttribute($this->getAttribute($_form_, "countries"), "options"), $this->getAttribute($this->getAttribute($_form_, "values"), "country"), ), "method"), "html", null, true);
        echo "
\t\t\t\t\t";
        // line 86
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "errors", array($this->getAttribute($this->getAttribute($_form_, "errors"), "country"), ), "method"), "html", null, true);
        echo "
\t\t\t\t</div>
\t\t\t</div>
\t\t\t<div class=\"page_subtitle_wrapper clearfix\"></div>
\t\t\t<div class=\"form-global clearfix\">
\t\t\t\tAll the fields in the form above has to be filled in, confirm that you have read the Terms and Conditions. Then Click \"Make me an Agent\"
\t\t\t\t<br/><br/>
\t\t\t\t<div style=\"float: left; width: 10%;\">
\t\t\t\t\t<input type=\"checkbox\" name=\"terms\" id=\"terms\" style=\"width: 20px;\" value=\"1\" />
\t\t\t\t</div>
\t\t\t\t<div style=\"float: left; width: 60%;\">
\t\t\t\t\t<a href=\"/Terms and Conditions.pdf\" target=\"_blank\">I have read the Terms and Conditions and hereby certify that my information is correct and truthful.</a>
\t\t\t\t</div>
\t\t\t\t<div style=\"float: left; width: 30%;\">
\t\t\t\t\t";
        // line 101
        echo "\t\t\t\t\t<input type=\"submit\" class=\"g-button g-button-submit ajax-submit\" value=\"Make me an Agent\" />
\t\t\t\t</div>
\t\t\t\t<div style=\"clear: both;\"></div>
\t\t\t\t";
        // line 104
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "errors", array($this->getAttribute($this->getAttribute($_form_, "errors"), "terms"), ), "method"), "html", null, true);
        echo "
\t\t\t\t<br/><br/>
\t\t\t</div>
\t\t</form>
\t</div>
\t<div class=\"ma_bottom\"></div>
";
    }

    // line 112
    public function block_right_side($context, array $blocks = array())
    {
        // line 113
        echo "\t";
        if (isset($context["app"])) { $_app_ = $context["app"]; } else { $_app_ = null; }
        if ((!$this->getAttribute($_app_, "ajax"))) {
            // line 114
            echo "\t\t";
            $context["ma_menu"] = "becomeAnAgent";
            // line 115
            echo "\t\t";
            $this->env->loadTemplate("myaccount/menu.twig")->display($context);
            // line 116
            echo "\t";
        }
    }

    public function getTemplateName()
    {
        return "myaccount/becomeAnAgent.twig";
    }

    public function isTraitable()
    {
        return false;
    }
}
