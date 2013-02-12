<?php

/* myaccount/cashInVouchers.twig */
class __TwigTemplate_a42afb781d71730bc084db91223e5a9d extends Twig_Template
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
        echo "    ";
        if (isset($context["app"])) { $_app_ = $context["app"]; } else { $_app_ = null; }
        if ((!$this->getAttribute($_app_, "ajax"))) {
            // line 5
            echo "        ";
            $this->env->loadTemplate("myaccount/css.twig")->display($context);
            // line 6
            echo "    ";
        }
    }

    // line 8
    public function block_js($context, array $blocks = array())
    {
        // line 9
        echo "    ";
        if (isset($context["app"])) { $_app_ = $context["app"]; } else { $_app_ = null; }
        if ((!$this->getAttribute($_app_, "ajax"))) {
            // line 10
            echo "        ";
            $this->env->loadTemplate("myaccount/js.twig")->display($context);
            // line 11
            echo "    ";
        }
    }

    // line 14
    public function block_content_page($context, array $blocks = array())
    {
        // line 15
        echo "    <h1>Cash in Vouchers</h1>
    <div class=\"ma_top\"></div>
    <div class=\"ma_content\">
\t\t\t";
        // line 18
        $context["forms"] = $this->env->loadTemplate("/forms/forms.twig");
        // line 19
        echo "\t\t\t\t\t";
        if (isset($context["userObj"])) { $_userObj_ = $context["userObj"]; } else { $_userObj_ = null; }
        if (($this->getAttribute($this->getAttribute($_userObj_, "getUser", array(), "method"), "get", array("is_do", ), "method") == 1)) {
            // line 20
            echo "\t\t\t\t\t\t<br /><br />
\t\t\t\t\t\t<form enctype=\"application/x-www-form-urlencoded\" action=\"";
            // line 21
            if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array("@myAccountCashInVouchers", ), "method"), "html", null, true);
            echo "\" method=\"post\">
\t\t\t\t\t\t\t\t<div class=\"form-global clearfix\">
\t\t\t\t\t\t\t\t<div class=\"label\"><label for=\"coupon_code\">Voucher Code:</label></div>
\t\t\t\t\t\t\t\t<div class=\"input input_big\">
\t\t\t\t\t\t\t\t";
            // line 25
            if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
            if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "input", array("coupon_code", $this->getAttribute($this->getAttribute($_form_, "values"), "coupon_code"), ), "method"), "html", null, true);
            echo "
\t\t\t\t\t\t\t\t";
            // line 26
            if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
            if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "errors", array($this->getAttribute($this->getAttribute($_form_, "errors"), "coupon_code"), ), "method"), "html", null, true);
            echo "
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t<div class=\"form-global clearfix\">
\t\t\t\t\t\t\t\t\t\t<div class=\"label\"><label>&nbsp;</label></div>
\t\t\t\t\t\t\t\t\t\t<div class=\"left\"><input type=\"submit\" class=\"g-button g-button-submit\" value=\"Submit\" /></div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</form>
\t\t\t\t\t";
        }
        // line 35
        echo "          <a href=\"";
        if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array("@myAccountCashInVouchers?format=csv", ), "method"), "html", null, true);
        echo "\" class=\"g-button g-button-share\">Download CSV</a>
\t\t\t\t\t<br/><br/>
\t\t\t\t\t<ul class=\"pagination clearfix\">";
        // line 37
        if (isset($context["pagination"])) { $_pagination_ = $context["pagination"]; } else { $_pagination_ = null; }
        echo $_pagination_;
        echo "</ul>
            <div class=\"yui3-g\" style=\"font-weight:bold;font-size:16px;border-bottom:1px solid #3079ed\">
                <div class=\"yui3-u\" style=\"width:80px;\">Created</div>
                <div class=\"yui3-u\" style=\"width:80px;\">Expires</div>
                <div class=\"yui3-u\" style=\"width:100px;\">Product</div>
                <div class=\"yui3-u\" style=\"width:80px;text-align:center\">Buyer</div>
                <div class=\"yui3-u\" style=\"width:60px;\">Cost</div>
                <div class=\"yui3-u\" style=\"width:60px;\">Your Share</div>
                <div class=\"yui3-u\" style=\"width:140px;\">Actions</div>
            </div>
            ";
        // line 47
        if (isset($context["transactions"])) { $_transactions_ = $context["transactions"]; } else { $_transactions_ = null; }
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($_transactions_);
        foreach ($context['_seq'] as $context["_key"] => $context["transaction"]) {
            // line 48
            echo "            <div class=\"yui3-g\" style=\"padding:5px 0;margin-bottom:2px;border-bottom:1px solid #3079ed\">
                <div class=\"yui3-u\" style=\"width:80px;\">";
            // line 49
            if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_transaction_, "created_at"), "html", null, true);
            echo "</div>
                <div class=\"yui3-u\" style=\"width:80px;\">";
            // line 50
            if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_transaction_, "expire_at"), "html", null, true);
            echo "</div>
                <div class=\"yui3-u\" style=\"width:100px;\">";
            // line 51
            if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
            if ($this->getAttribute($_transaction_, "name")) {
                if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($_transaction_, "name"), "html", null, true);
            } else {
                echo " - ";
            }
            echo "</div>
                <div class=\"yui3-u\" style=\"width:80px;text-align:center\">";
            // line 52
            if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($_transaction_, "Transaction"), "Sender"), "first_name"), "html", null, true);
            echo " ";
            if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($_transaction_, "Transaction"), "Sender"), "last_name"), "html", null, true);
            if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
            if ($this->getAttribute($_transaction_, "Friend")) {
                echo " (<strong>For friend:</strong> ";
                if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($_transaction_, "Friend"), "first_name"), "html", null, true);
                echo " ";
                if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($_transaction_, "Friend"), "last_name"), "html", null, true);
                echo ")";
            }
            echo "</div>
                <div class=\"yui3-u\" style=\"width:60px;\"><strong>";
            // line 53
            if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
            echo twig_escape_filter($this->env, twig_currency($this->getAttribute($_transaction_, "price")), "html", null, true);
            echo "</strong></div>
                <div class=\"yui3-u\" style=\"width:60px;\"><strong>";
            // line 54
            if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
            echo twig_escape_filter($this->env, twig_currency($this->getAttribute($this->getAttribute($_transaction_, "merchant_share"), "full_payment")), "html", null, true);
            echo "</strong></div>
                <div class=\"yui3-u\" style=\"width:140px;\">
                    <a href=\"";
            // line 56
            if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
            if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array(("@myAccountCouponDetails?coupon_id=" . $this->getAttribute($_transaction_, "id")), ), "method"), "html", null, true);
            echo "\" class=\"g-button ";
            if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
            if (($this->getAttribute($_transaction_, "friend") == 0)) {
                echo "g-button-share";
            } else {
                echo "g-button-submit";
            }
            echo " modal-normal\" title=\"Voucher Details\"  style=\"padding:2px;height:15px;line-height:15px;\">";
            if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
            if (($this->getAttribute($_transaction_, "friend") == 0)) {
                echo "Voucher";
            } else {
                echo "Gift Voucher";
            }
            echo "</a>
                    <a href=\"";
            // line 57
            if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
            if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array(("@myAccountCouponTransactionDetails?trans_id=" . $this->getAttribute($_transaction_, "transaction_id")), ), "method"), "html", null, true);
            echo "\" class=\"g-button g-button-share modal-normal\" title=\"Transaction Details\"  style=\"padding:2px;height:15px;line-height:15px;\">Transaction</a>
                </div>
            </div>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['transaction'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 61
        echo "            <ul class=\"pagination clearfix\">";
        if (isset($context["pagination"])) { $_pagination_ = $context["pagination"]; } else { $_pagination_ = null; }
        echo $_pagination_;
        echo "</ul>
\t\t\t\t\t\t</div>
    <div class=\"ma_bottom\"></div>
";
    }

    // line 66
    public function block_right_side($context, array $blocks = array())
    {
        // line 67
        echo "    ";
        if (isset($context["app"])) { $_app_ = $context["app"]; } else { $_app_ = null; }
        if ((!$this->getAttribute($_app_, "ajax"))) {
            // line 68
            echo "        ";
            $context["ma_menu"] = "cashInVouchers";
            // line 69
            echo "        ";
            $this->env->loadTemplate("myaccount/menu.twig")->display($context);
            // line 70
            echo "    ";
        }
    }

    public function getTemplateName()
    {
        return "myaccount/cashInVouchers.twig";
    }

    public function isTraitable()
    {
        return false;
    }
}
