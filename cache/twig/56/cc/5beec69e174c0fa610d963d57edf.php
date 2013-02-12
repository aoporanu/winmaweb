<?php

/* myaccount/transactions/deposit.twig */
class __TwigTemplate_56cc5beec69e174c0fa610d963d57edf extends Twig_Template
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
        echo "    <h1>Deposit</h1>
    <div class=\"ma_top\"></div>
    <div class=\"ma_content\">
\t\t\t\t<a href=\"";
        // line 19
        if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array("@myAccountMyMoney", ), "method"), "html", null, true);
        echo "\" class=\"g-button ajax-link\" style=\"min-width:10px;\">My Money</a>
\t\t\t\t<a href=\"";
        // line 20
        if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array("@myAccountWithdraw", ), "method"), "html", null, true);
        echo "\" class=\"g-button ajax-link\" style=\"min-width:10px;\">Withdraw</a>
\t\t\t\t<a href=\"";
        // line 21
        if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array("@myAccountDeposit", ), "method"), "html", null, true);
        echo "\" class=\"g-button g-button-submit ajax-link\" style=\"min-width:10px;\">Deposit</a>
\t\t\t\t<br/><br/>
        <a href=\"";
        // line 23
        if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array("@myAccountDeposit", ), "method"), "html", null, true);
        echo "\" class=\"g-button";
        if (isset($context["view"])) { $_view_ = $context["view"]; } else { $_view_ = null; }
        if ((!$_view_)) {
            echo " g-button-submit";
        }
        echo " ajax-link\">Paypal</a>
        <a href=\"";
        // line 24
        if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array("@myAccountDeposit?view=giro", ), "method"), "html", null, true);
        echo "\" class=\"g-button ";
        if (isset($context["view"])) { $_view_ = $context["view"]; } else { $_view_ = null; }
        if (($_view_ == "giro")) {
            echo " g-button-submit";
        }
        echo " ajax-link\">GIRO</a>
        <br /><br />
        ";
        // line 27
        echo "        <br />
        
        ";
        // line 29
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        if ($this->getAttribute($_form_, "errors")) {
            // line 30
            echo "            <br /><div class=\"error_box\"><strong>There were errors - please verify all fields for errors</strong></div>
        ";
        }
        // line 32
        echo "        ";
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        if ($this->getAttribute($_form_, "success")) {
            // line 33
            echo "            <div class=\"infotip\"><strong>Success</strong><br /><br />Deposit amount added successfully to your wallet</div>
        ";
        }
        // line 35
        echo "        ";
        // line 48
        echo "\t\t\t\t";
        // line 49
        echo "\t\t\t<div style=\"display: none;\">
\t\t\t\t<form action=\"https://www.paypal.com/cgi-bin/webscr\" method=\"post\">
            <div class=\"form-global clearfix\">
                <div class=\"label\"><label for=\"val\">Deposit amount:</label></div>
                <div class=\"input input_big\">
\t\t\t\t\t\t\t\t\t";
        // line 54
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "input", array("amount", $this->getAttribute($this->getAttribute($_form_, "values"), "val"), ), "method"), "html", null, true);
        echo "
                </div>
            </div>
            <div class=\"form-global clearfix\">
                <div class=\"label\"><label>&nbsp;</label></div>
\t\t\t\t\t\t\t\t<div class=\"left\"><input type=\"submit\" class=\"g-button g-button-submit\" value=\"Deposit\" /></div>
            </div>
\t\t\t\t\t\t<input type=\"hidden\" name=\"cmd\" value=\"_xclick\" />
\t\t\t\t\t\t<input type=\"hidden\" name=\"currency_code\" value=\"SGD\" />
\t\t\t\t\t\t";
        // line 64
        echo "\t\t\t\t\t\t<input type=\"hidden\" name=\"business\" value=\"info@winmaweb.com\" />
\t\t\t\t\t\t<input type=\"hidden\" name=\"item_name\" value=\"WinMaWeb Deposit\" />
\t\t\t\t\t\t<input type=\"hidden\" name=\"item_number\" value=\"";
        // line 66
        if (isset($context["user_id"])) { $_user_id_ = $context["user_id"]; } else { $_user_id_ = null; }
        echo twig_escape_filter($this->env, $_user_id_, "html", null, true);
        echo "\" />
\t\t\t\t\t\t";
        // line 68
        echo "\t\t\t\t\t\t";
        // line 69
        echo "\t\t\t\t\t\t";
        // line 70
        echo "\t\t\t\t\t\t<input type=\"hidden\" name=\"notify_url\" value=\"https://winmaweb.com/payment/paypal\" />
\t\t\t\t\t\t";
        // line 72
        echo "\t\t\t\t\t\t";
        // line 73
        echo "\t\t\t\t\t\t";
        // line 74
        echo "\t\t\t\t\t\t";
        // line 75
        echo "\t\t\t\t\t\t<input type=\"hidden\" name=\"return_url\" value=\"https://winmaweb.com/my-account/deposit\" />
        </form>
\t\t\t</div>
    </div>
    <div class=\"ma_bottom\"></div>
";
    }

    // line 82
    public function block_right_side($context, array $blocks = array())
    {
        // line 83
        echo "    ";
        if (isset($context["app"])) { $_app_ = $context["app"]; } else { $_app_ = null; }
        if ((!$this->getAttribute($_app_, "ajax"))) {
            // line 84
            echo "        ";
            $context["ma_menu"] = "myMoney";
            // line 85
            echo "        ";
            $this->env->loadTemplate("myaccount/menu.twig")->display($context);
            // line 86
            echo "    ";
        }
    }

    public function getTemplateName()
    {
        return "myaccount/transactions/deposit.twig";
    }

    public function isTraitable()
    {
        return false;
    }
}
