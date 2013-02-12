<?php

/* myaccount/withdraw.twig */
class __TwigTemplate_c54bcca4503e59dc44b69b5c2db9b9dc extends Twig_Template
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
        echo "\t<h1>Withdraw</h1>
\t<div class=\"ma_top\"></div>
\t<div class=\"ma_content\">
\t\t<a href=\"";
        // line 19
        if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array("@myAccountMyMoney", ), "method"), "html", null, true);
        echo "\" class=\"g-button ajax-link\" style=\"min-width:10px;\">My Money</a>
\t\t<a href=\"";
        // line 20
        if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array("@myAccountWithdraw", ), "method"), "html", null, true);
        echo "\" class=\"g-button g-button-submit ajax-link\" style=\"min-width:10px;\">Withdraw</a>
\t\t<a href=\"";
        // line 21
        if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array("@myAccountDeposit", ), "method"), "html", null, true);
        echo "\" class=\"g-button ajax-link\" style=\"min-width:10px;\">Deposit</a>
\t\t<br/><br/>
\t\t<a href=\"";
        // line 23
        if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array("@myAccountWithdraw", ), "method"), "html", null, true);
        echo "\" class=\"g-button";
        if (isset($context["view"])) { $_view_ = $context["view"]; } else { $_view_ = null; }
        if ((!$_view_)) {
            echo " g-button-submit";
        }
        echo " ajax-link\">Paypal</a>
\t\t<a href=\"";
        // line 24
        if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array("@myAccountWithdraw?view=giro", ), "method"), "html", null, true);
        echo "\" class=\"g-button ";
        if (isset($context["view"])) { $_view_ = $context["view"]; } else { $_view_ = null; }
        if (($_view_ == "giro")) {
            echo " g-button-submit";
        }
        echo " ajax-link\">GIRO</a>
\t\t<br /><br />
\t\t<div class=\"info-blue\"><p>My Money: ";
        // line 26
        if (isset($context["app"])) { $_app_ = $context["app"]; } else { $_app_ = null; }
        echo twig_escape_filter($this->env, twig_currency($this->getAttribute($this->getAttribute($_app_, "user"), "wallet")), "html", null, true);
        echo "</p></div>
\t\t<br />
\t\t";
        // line 28
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        if ($this->getAttribute($_form_, "errors")) {
            // line 29
            echo "\t\t\t<br />
\t\t\t<div class=\"error_box\"><strong>There were errors - please verify all fields for errors</strong></div>
\t\t";
        }
        // line 32
        echo "\t\t";
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        if ($this->getAttribute($_form_, "success")) {
            // line 33
            echo "\t\t\t<div class=\"infotip\"><strong>Success</strong><br /><br />Withdraw request added successfully</div>
\t\t";
        }
        // line 35
        echo "\t\t<form enctype=\"application/x-www-form-urlencoded\" action=\"";
        if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array("@myAccountWithdraw", ), "method"), "html", null, true);
        echo "\" method=\"post\">
\t\t\t<div class=\"form-global clearfix\">
\t\t\t\t<div class=\"label\"><label for=\"val\">Withdraw amount:</label></div>
\t\t\t\t<div class=\"input input_big\">
\t\t\t\t\t";
        // line 39
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "input", array("val", $this->getAttribute($this->getAttribute($_form_, "values"), "val"), ), "method"), "html", null, true);
        echo "
\t\t\t\t\t";
        // line 40
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "errors", array($this->getAttribute($this->getAttribute($_form_, "errors"), "val"), ), "method"), "html", null, true);
        echo "
\t\t\t\t</div>
\t\t\t\t<div class=\"label\"><label for=\"paypal_email\">PayPal E-Mail:</label></div>
\t\t\t\t<div class=\"input input_big\">
\t\t\t\t\t";
        // line 44
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "input", array("paypal_email", $this->getAttribute($this->getAttribute($_form_, "values"), "paypal_email"), ), "method"), "html", null, true);
        echo "
\t\t\t\t\t";
        // line 45
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "errors", array($this->getAttribute($this->getAttribute($_form_, "errors"), "paypal_email"), ), "method"), "html", null, true);
        echo "
\t\t\t\t</div>
\t\t\t</div>
\t\t\t<div class=\"form-global clearfix\">
\t\t\t\t<div class=\"label\"><label>&nbsp;</label></div>
\t\t\t\t<div class=\"left\"><input type=\"submit\" class=\"g-button g-button-submit ajax-submit\" value=\"Request\" /></div>
\t\t\t</div>
\t\t</form>
\t\t<ul class=\"pagination clearfix\">";
        // line 53
        if (isset($context["pagination"])) { $_pagination_ = $context["pagination"]; } else { $_pagination_ = null; }
        echo $_pagination_;
        echo "</ul>
\t\t<div class=\"yui3-g\" style=\"font-weight:bold;font-size:16px;border-bottom:1px solid #3079ed\">
\t\t\t<div class=\"yui3-u\" style=\"width:180px;\">Date</div>
\t\t\t<div class=\"yui3-u\" style=\"width:100px;\">Amount</div>
\t\t\t<div class=\"yui3-u\" style=\"width:100px;\">Status</div>
\t\t\t<div class=\"yui3-u\" style=\"width:100px;\">Type</div>
\t\t\t<div class=\"yui3-u\" style=\"width:100px;\">Actions</div>
\t\t</div>
\t\t";
        // line 61
        if (isset($context["requests"])) { $_requests_ = $context["requests"]; } else { $_requests_ = null; }
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($_requests_);
        foreach ($context['_seq'] as $context["_key"] => $context["request"]) {
            // line 62
            echo "\t\t\t<div class=\"yui3-g\" style=\"padding: 10px 0;border-bottom:1px solid #3079ed\">
\t\t\t\t<div class=\"yui3-u\" style=\"width:180px;\">";
            // line 63
            if (isset($context["request"])) { $_request_ = $context["request"]; } else { $_request_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_request_, "created_at"), "html", null, true);
            echo "</div>
\t\t\t\t<div class=\"yui3-u\" style=\"width:100px;\">";
            // line 64
            if (isset($context["request"])) { $_request_ = $context["request"]; } else { $_request_ = null; }
            echo twig_escape_filter($this->env, twig_currency($this->getAttribute($_request_, "amount")), "html", null, true);
            echo "</div>
\t\t\t\t<div class=\"yui3-u\" style=\"width:100px;\">";
            // line 65
            if (isset($context["requestStatus"])) { $_requestStatus_ = $context["requestStatus"]; } else { $_requestStatus_ = null; }
            if (isset($context["request"])) { $_request_ = $context["request"]; } else { $_request_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_requestStatus_, $this->getAttribute($_request_, "status"), array(), "array"), "html", null, true);
            echo "</div>
\t\t\t\t<div class=\"yui3-u\" style=\"width:100px;\">";
            // line 66
            if (isset($context["request"])) { $_request_ = $context["request"]; } else { $_request_ = null; }
            if (($this->getAttribute($_request_, "type") == 1)) {
                echo "Paypal";
            }
            if (isset($context["request"])) { $_request_ = $context["request"]; } else { $_request_ = null; }
            if (($this->getAttribute($_request_, "type") == 2)) {
                echo "GIRO";
            }
            echo "</div>
\t\t\t\t<div class=\"yui3-u\" style=\"width:100px;\">";
            // line 67
            if (isset($context["requestStatus"])) { $_requestStatus_ = $context["requestStatus"]; } else { $_requestStatus_ = null; }
            if (isset($context["request"])) { $_request_ = $context["request"]; } else { $_request_ = null; }
            if (($this->getAttribute($_requestStatus_, $this->getAttribute($_request_, "status"), array(), "array") == "pending")) {
                echo "<a href=\"";
                if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
                if (isset($context["request"])) { $_request_ = $context["request"]; } else { $_request_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array(("@myAccountWithdraw?m=del&wid=" . $this->getAttribute($_request_, "id")), ), "method"), "html", null, true);
                echo "\" class=\"ajax-del\">delete</a>";
            }
            echo "</div>
\t\t\t</div>
\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['request'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 70
        echo "\t\t<ul class=\"pagination clearfix\">";
        if (isset($context["pagination"])) { $_pagination_ = $context["pagination"]; } else { $_pagination_ = null; }
        echo $_pagination_;
        echo "</ul>
\t</div>
\t<div class=\"ma_bottom\"></div>
";
    }

    // line 75
    public function block_right_side($context, array $blocks = array())
    {
        // line 76
        echo "\t";
        if (isset($context["app"])) { $_app_ = $context["app"]; } else { $_app_ = null; }
        if ((!$this->getAttribute($_app_, "ajax"))) {
            // line 77
            echo "\t\t";
            $context["ma_menu"] = "myMoney";
            // line 78
            echo "\t\t";
            $this->env->loadTemplate("myaccount/menu.twig")->display($context);
            // line 79
            echo "\t";
        }
    }

    public function getTemplateName()
    {
        return "myaccount/withdraw.twig";
    }

    public function isTraitable()
    {
        return false;
    }
}
