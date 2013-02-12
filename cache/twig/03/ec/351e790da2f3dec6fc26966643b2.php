<?php

/* myaccount/myMoney.twig */
class __TwigTemplate_03ec351e790da2f3dec6fc26966643b2 extends Twig_Template
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
        echo "\t<h1>My Money</h1>
\t<div class=\"ma_top\"></div>
\t<div class=\"ma_content\">
\t\t<div class=\"info-blue\">
\t\t\t<a href=\"";
        // line 19
        if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array("@myAccountMyMoney", ), "method"), "html", null, true);
        echo "\" class=\"g-button g-button-submit ajax-link\" style=\"min-width:10px;\">My Money</a>
\t\t\t<a href=\"";
        // line 20
        if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array("@myAccountWithdraw", ), "method"), "html", null, true);
        echo "\" class=\"g-button ajax-link\" style=\"min-width:10px;\">Withdraw</a>
\t\t\t<a href=\"";
        // line 21
        if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array("@myAccountDeposit", ), "method"), "html", null, true);
        echo "\" class=\"g-button ajax-link\" style=\"min-width:10px;\">Deposit</a>
\t\t\t<br/><br/>
\t\t\t<p style=\"border:1px solid #3079ed\">
\t\t\t\tIn My Money section you may view the deposits you have made to your My Money as well as any credit transfers from WMW Credits to My Money.
\t\t\t</p>
\t\t</div>
\t\t<br />
\t\t<span style=\"font-size:16px;\">Your WMW Credits: ";
        // line 28
        if (isset($context["app"])) { $_app_ = $context["app"]; } else { $_app_ = null; }
        echo twig_escape_filter($this->env, twig_currency($this->getAttribute($this->getAttribute($_app_, "user"), "virtual_wallet")), "html", null, true);
        echo "</span>
\t\t<br /><br />
\t\t<ul class=\"pagination clearfix\">";
        // line 30
        if (isset($context["pagination"])) { $_pagination_ = $context["pagination"]; } else { $_pagination_ = null; }
        echo $_pagination_;
        echo "</ul>
\t\t<div class=\"yui3-g\" style=\"font-weight:bold;font-size:16px;border-bottom:1px solid #3079ed\">
\t\t\t<div class=\"yui3-u\" style=\"width:80px;\">Date</div>
\t\t\t<div class=\"yui3-u\" style=\"width:150px;\">From</div>
\t\t\t<div class=\"yui3-u\" style=\"width:100px;\">To</div>
\t\t\t<div class=\"yui3-u\" style=\"width:80px;\">Type</div>
\t\t\t<div class=\"yui3-u\" style=\"width:120px;\">Amount</div>
\t\t\t<div class=\"yui3-u\" style=\"width:50px;\">Actions</div>
\t\t</div>
\t\t";
        // line 39
        if (isset($context["transactions"])) { $_transactions_ = $context["transactions"]; } else { $_transactions_ = null; }
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($_transactions_);
        foreach ($context['_seq'] as $context["_key"] => $context["transaction"]) {
            // line 40
            echo "\t\t\t<div class=\"yui3-g\" style=\"padding:5px 0;margin-bottom:2px;border-bottom:1px solid #3079ed\">
\t\t\t\t<div class=\"yui3-u\" style=\"width:80px;\">";
            // line 41
            if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_transaction_, "created_at"), "html", null, true);
            echo "</div>
\t\t\t\t<div class=\"yui3-u\" style=\"width:150px;\">";
            // line 42
            if (isset($context["transactionType"])) { $_transactionType_ = $context["transactionType"]; } else { $_transactionType_ = null; }
            if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
            if (($this->getAttribute($_transactionType_, $this->getAttribute($_transaction_, "transaction_type"), array(), "array") == "deposit")) {
                echo "Paypal";
            }
            if (isset($context["transactionType"])) { $_transactionType_ = $context["transactionType"]; } else { $_transactionType_ = null; }
            if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
            if (($this->getAttribute($_transactionType_, $this->getAttribute($_transaction_, "transaction_type"), array(), "array") == "transfer-to-wallet")) {
                echo "<img src=\"/images/logo_final.png\" width=\"20\"  /> Account";
            }
            if (isset($context["transactionType"])) { $_transactionType_ = $context["transactionType"]; } else { $_transactionType_ = null; }
            if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
            if (($this->getAttribute($_transactionType_, $this->getAttribute($_transaction_, "transaction_type"), array(), "array") == "withdraw")) {
                echo "My Wallet";
            }
            if (isset($context["transactionType"])) { $_transactionType_ = $context["transactionType"]; } else { $_transactionType_ = null; }
            if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
            if (($this->getAttribute($_transactionType_, $this->getAttribute($_transaction_, "transaction_type"), array(), "array") == "withdraw-giro")) {
                echo "My Wallet";
            }
            if (isset($context["transactionType"])) { $_transactionType_ = $context["transactionType"]; } else { $_transactionType_ = null; }
            if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
            if (($this->getAttribute($_transactionType_, $this->getAttribute($_transaction_, "transaction_type"), array(), "array") == "deposit-giro")) {
                echo "GIRO";
            }
            echo "</div>
\t\t\t\t<div class=\"yui3-u\" style=\"width:100px;\">";
            // line 43
            if (isset($context["transactionType"])) { $_transactionType_ = $context["transactionType"]; } else { $_transactionType_ = null; }
            if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
            if (($this->getAttribute($_transactionType_, $this->getAttribute($_transaction_, "transaction_type"), array(), "array") == "withdraw")) {
                echo "Paypal";
            } else {
                if (isset($context["transactionType"])) { $_transactionType_ = $context["transactionType"]; } else { $_transactionType_ = null; }
                if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
                if (($this->getAttribute($_transactionType_, $this->getAttribute($_transaction_, "transaction_type"), array(), "array") == "withdraw-giro")) {
                    echo "GIRO";
                } else {
                    echo "My Wallet";
                }
            }
            echo "</div>
\t\t\t\t<div class=\"yui3-u\" style=\"width:80px;\">";
            // line 44
            if (isset($context["transactionType"])) { $_transactionType_ = $context["transactionType"]; } else { $_transactionType_ = null; }
            if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
            echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->getAttribute($_transactionType_, $this->getAttribute($_transaction_, "transaction_type"), array(), "array")), "html", null, true);
            echo "</div>
\t\t\t\t<div class=\"yui3-u\" style=\"width:120px;\"><strong>";
            // line 45
            if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
            echo twig_escape_filter($this->env, twig_currency($this->getAttribute($_transaction_, "full_payment")), "html", null, true);
            echo "</strong></div>
\t\t\t\t<div class=\"yui3-u\" style=\"width:50px;\"><a href=\"";
            // line 46
            if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
            if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array(("@myAccountTransactionDetails?trans_id=" . $this->getAttribute($_transaction_, "id")), ), "method"), "html", null, true);
            echo "\" class=\"g-button g-button-share modal-normal\" title=\"Transaction Details\"  style=\"padding:2px;height:15px;line-height:15px;\">View</a></div>
\t\t\t</div>
\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['transaction'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 49
        echo "\t\t<ul class=\"pagination clearfix\">";
        if (isset($context["pagination"])) { $_pagination_ = $context["pagination"]; } else { $_pagination_ = null; }
        echo $_pagination_;
        echo "</ul>
\t</div>
\t<div class=\"ma_bottom\"></div>
";
    }

    // line 54
    public function block_right_side($context, array $blocks = array())
    {
        // line 55
        echo "\t";
        if (isset($context["app"])) { $_app_ = $context["app"]; } else { $_app_ = null; }
        if ((!$this->getAttribute($_app_, "ajax"))) {
            // line 56
            echo "\t\t";
            $context["ma_menu"] = "myMoney";
            // line 57
            echo "\t\t";
            $this->env->loadTemplate("myaccount/menu.twig")->display($context);
            // line 58
            echo "\t";
        }
    }

    public function getTemplateName()
    {
        return "myaccount/myMoney.twig";
    }

    public function isTraitable()
    {
        return false;
    }
}
