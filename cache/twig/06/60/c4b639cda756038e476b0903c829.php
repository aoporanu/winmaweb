<?php

/* myaccount/transactions/show.twig */
class __TwigTemplate_0660c4b639cda756038e476b0903c829 extends Twig_Template
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
        echo "    <h1>Transactions <a title=\"Help\" style=\"font-size: 11px\" class=\"help-link\" href=\"#\">help</a><div class=\"inv help-message\">";
        if (isset($context["helpObj"])) { $_helpObj_ = $context["helpObj"]; } else { $_helpObj_ = null; }
        echo $this->getAttribute($this->getAttribute($_helpObj_, "getHelp", array(2, ), "method"), "content");
        echo "</div></h1>
    <div class=\"ma_top\"></div>
    <div class=\"ma_content\">
        <a href=\"";
        // line 18
        if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array("@myAccountTransactions", ), "method"), "html", null, true);
        echo "\" class=\"g-button";
        if (isset($context["view"])) { $_view_ = $context["view"]; } else { $_view_ = null; }
        if ((!$_view_)) {
            echo " g-button-submit";
        }
        echo " ajax-link\" style=\"min-width:10px;\">Sent</a>
        <a href=\"";
        // line 19
        if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array("@myAccountTransactions?view=received", ), "method"), "html", null, true);
        echo "\" class=\"g-button ";
        if (isset($context["view"])) { $_view_ = $context["view"]; } else { $_view_ = null; }
        if (($_view_ == "received")) {
            echo " g-button-submit";
        }
        echo " ajax-link\" style=\"min-width:10px;\">Received</a>
        <a href=\"";
        // line 20
        if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array("@myAccountTransactions?view=network", ), "method"), "html", null, true);
        echo "\" class=\"g-button ";
        if (isset($context["view"])) { $_view_ = $context["view"]; } else { $_view_ = null; }
        if (($_view_ == "network")) {
            echo " g-button-submit";
        }
        echo " ajax-link\" style=\"min-width:10px;\">Network</a>
        <a href=\"";
        // line 21
        if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array("@myAccountTransactions?view=wallet", ), "method"), "html", null, true);
        echo "\" class=\"g-button ";
        if (isset($context["view"])) { $_view_ = $context["view"]; } else { $_view_ = null; }
        if (($_view_ == "wallet")) {
            echo " g-button-submit";
        }
        echo " ajax-link\" style=\"min-width:10px;\">My Wallet</a>
        <a href=\"";
        // line 22
        if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array("@myAccountTransactions?view=coupons", ), "method"), "html", null, true);
        echo "\" class=\"g-button ";
        if (isset($context["view"])) { $_view_ = $context["view"]; } else { $_view_ = null; }
        if (($_view_ == "coupons")) {
            echo " g-button-submit";
        } else {
            echo " ";
        }
        echo " ajax-link\" style=\"min-width:10px;\">My Vouchers</a>
        
\t\t\t\t";
        // line 24
        if (isset($context["userObj"])) { $_userObj_ = $context["userObj"]; } else { $_userObj_ = null; }
        if (($this->getAttribute($this->getAttribute($_userObj_, "getUser", array(), "method"), "get", array("is_do", ), "method") == 1)) {
            // line 25
            echo "        <a href=\"";
            if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array("@myAccountTransactions?view=all_vouchers", ), "method"), "html", null, true);
            echo "\" class=\"g-button ";
            if (isset($context["view"])) { $_view_ = $context["view"]; } else { $_view_ = null; }
            if (($_view_ == "all_vouchers")) {
                echo " g-button-submit";
            } else {
            }
            echo " ajax-link\" style=\"min-width:10px;\">Sold Vouchers</a>
\t\t\t\t\t<a href=\"";
            // line 26
            if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array("@myAccountTransactions?view=cash_in_vouchers", ), "method"), "html", null, true);
            echo "\" class=\"g-button ";
            if (isset($context["view"])) { $_view_ = $context["view"]; } else { $_view_ = null; }
            if (($_view_ == "cash_in_vouchers")) {
                echo " g-button-submit";
            }
            echo " ajax-link\" style=\"min-width:10px;\">Cash In Vouchers</a>
\t\t\t\t";
        }
        // line 28
        echo "        <br /><br />
\t\t\t\t
\t\t\t\t";
        // line 30
        if (isset($context["view"])) { $_view_ = $context["view"]; } else { $_view_ = null; }
        if (($_view_ == "cash_in_vouchers")) {
            // line 31
            echo "\t\t\t\t\t";
            $context["forms"] = $this->env->loadTemplate("/forms/forms.twig");
            // line 32
            echo "\t\t\t\t\t";
            if (isset($context["userObj"])) { $_userObj_ = $context["userObj"]; } else { $_userObj_ = null; }
            if (($this->getAttribute($this->getAttribute($_userObj_, "getUser", array(), "method"), "get", array("is_do", ), "method") == 1)) {
                // line 33
                echo "\t\t\t\t\t\t<br /><br />
\t\t\t\t\t\t<form enctype=\"application/x-www-form-urlencoded\" action=\"";
                // line 34
                if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array("@myAccountTransactions?view=cash_in_vouchers", ), "method"), "html", null, true);
                echo "\" method=\"post\">
\t\t\t\t\t\t\t\t<div class=\"form-global clearfix\">
\t\t\t\t\t\t\t\t<div class=\"label\"><label for=\"coupon_code\">Voucher Code:</label></div>
\t\t\t\t\t\t\t\t<div class=\"input input_big\">
\t\t\t\t\t\t\t\t";
                // line 38
                if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
                if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "input", array("coupon_code", $this->getAttribute($this->getAttribute($_form_, "values"), "coupon_code"), ), "method"), "html", null, true);
                echo "
\t\t\t\t\t\t\t\t";
                // line 39
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
            // line 48
            echo "                                        <a href=\"";
            if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array("@myAccountTransactions?view=cash_in_vouchers&format=csv", ), "method"), "html", null, true);
            echo "\" class=\"g-button g-button-share\">Download CSV</a>
\t\t\t\t\t<br/><br/>
\t\t\t\t\t<ul class=\"pagination clearfix\">";
            // line 50
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
            // line 60
            if (isset($context["transactions"])) { $_transactions_ = $context["transactions"]; } else { $_transactions_ = null; }
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($_transactions_);
            foreach ($context['_seq'] as $context["_key"] => $context["transaction"]) {
                // line 61
                echo "            <div class=\"yui3-g\" style=\"padding:5px 0;margin-bottom:2px;border-bottom:1px solid #3079ed\">
                <div class=\"yui3-u\" style=\"width:80px;\">";
                // line 62
                if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($_transaction_, "created_at"), "html", null, true);
                echo "</div>
                <div class=\"yui3-u\" style=\"width:80px;\">";
                // line 63
                if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($_transaction_, "expire_at"), "html", null, true);
                echo "</div>
                <div class=\"yui3-u\" style=\"width:100px;\">";
                // line 64
                if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
                if ($this->getAttribute($_transaction_, "name")) {
                    if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
                    echo twig_escape_filter($this->env, $this->getAttribute($_transaction_, "name"), "html", null, true);
                } else {
                    echo " - ";
                }
                echo "</div>
                <div class=\"yui3-u\" style=\"width:80px;text-align:center\">";
                // line 65
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
                // line 66
                if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
                echo twig_escape_filter($this->env, twig_currency($this->getAttribute($_transaction_, "price")), "html", null, true);
                echo "</strong></div>
                <div class=\"yui3-u\" style=\"width:60px;\"><strong>";
                // line 67
                if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
                echo twig_escape_filter($this->env, twig_currency($this->getAttribute($this->getAttribute($_transaction_, "merchant_share"), "full_payment")), "html", null, true);
                echo "</strong></div>
                <div class=\"yui3-u\" style=\"width:140px;\">
                    <a href=\"";
                // line 69
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
                // line 70
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
            // line 74
            echo "            <ul class=\"pagination clearfix\">";
            if (isset($context["pagination"])) { $_pagination_ = $context["pagination"]; } else { $_pagination_ = null; }
            echo $_pagination_;
            echo "</ul>
\t\t\t\t";
        }
        // line 76
        echo "\t\t\t\t
        ";
        // line 77
        if (isset($context["view"])) { $_view_ = $context["view"]; } else { $_view_ = null; }
        if (($_view_ == "coupons")) {
            // line 78
            echo "            <div class=\"info-blue\">
            <p>In this Transactions: Vouchers Section you may view all the of the vouchers you have purchased from WinMaWeb.  
                Once a Voucher is redeemed or has expired then it will no longer be available for use.<br /><br />
                Under Actions you may select the Voucher button to download the Pdf file and print it for use, or you may select the Transactions button to view transaction details.</p>
            </div>
            <br /><br />
            <a href=\"";
            // line 84
            if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array("@myAccountTransactions?view=coupons", ), "method"), "html", null, true);
            echo "\" class=\"g-button ";
            if (isset($context["view"])) { $_view_ = $context["view"]; } else { $_view_ = null; }
            if (isset($context["subview"])) { $_subview_ = $context["subview"]; } else { $_subview_ = null; }
            if ((($_view_ == "coupons") && ($_subview_ == ""))) {
                echo " g-button-submit";
            } else {
            }
            echo " ajax-link\" style=\"min-width:10px;\">My Vouchers</a>
            <a href=\"";
            // line 85
            if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array("@myAccountTransactions?view=coupons&subview=send_gift", ), "method"), "html", null, true);
            echo "\" class=\"g-button ";
            if (isset($context["subview"])) { $_subview_ = $context["subview"]; } else { $_subview_ = null; }
            if (($_subview_ == "send_gift")) {
                echo " g-button-submit";
            } else {
            }
            echo " ajax-link\" style=\"min-width:10px;\">Sent Gift Vouchers</a>
            <a href=\"";
            // line 86
            if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array("@myAccountTransactions?view=coupons&subview=received_gift", ), "method"), "html", null, true);
            echo "\" class=\"g-button ";
            if (isset($context["subview"])) { $_subview_ = $context["subview"]; } else { $_subview_ = null; }
            if (($_subview_ == "received_gift")) {
                echo " g-button-submit";
            } else {
            }
            echo " ajax-link\" style=\"min-width:10px;\">Received Gift Vouchers</a>
            <a href=\"";
            // line 87
            if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array("@myAccountTransactions?view=coupons&subview=donation", ), "method"), "html", null, true);
            echo "\" class=\"g-button ";
            if (isset($context["subview"])) { $_subview_ = $context["subview"]; } else { $_subview_ = null; }
            if (($_subview_ == "donation")) {
                echo " g-button-submit";
            } else {
            }
            echo " ajax-link\" style=\"min-width:10px;\">Donation Vouchers</a>
            ";
            // line 88
            if (isset($context["subview"])) { $_subview_ = $context["subview"]; } else { $_subview_ = null; }
            if (($_subview_ == "donation")) {
                echo "<br /><br /><div class=\"info-blue\"><p>Thank you for your donations!</p></div><br />";
            }
            // line 89
            echo "            <ul class=\"pagination clearfix\">";
            if (isset($context["pagination"])) { $_pagination_ = $context["pagination"]; } else { $_pagination_ = null; }
            echo $_pagination_;
            echo "</ul>
            <div class=\"yui3-g\" style=\"font-weight:bold;font-size:16px;border-bottom:1px solid #3079ed\">
                <div class=\"yui3-u\" style=\"width:90px;\">Created</div>
                <div class=\"yui3-u\" style=\"width:90px;\">Expires</div>
                <div class=\"yui3-u\" style=\"width:100px;\">Product</div>
                <div class=\"yui3-u\" style=\"width:50px;text-align:center\">Qty</div>
                <div class=\"yui3-u\" style=\"width:120px;\">Cost</div>
                <div class=\"yui3-u\" style=\"width:150px;\">Actions</div>
            </div>
            ";
            // line 98
            if (isset($context["transactions"])) { $_transactions_ = $context["transactions"]; } else { $_transactions_ = null; }
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($_transactions_);
            foreach ($context['_seq'] as $context["_key"] => $context["transaction"]) {
                // line 99
                echo "            <div class=\"yui3-g\" style=\"padding:5px 0;margin-bottom:2px;border-bottom:1px solid #3079ed;";
                if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
                if ((!(null === $this->getAttribute($_transaction_, "verifier_id")))) {
                    echo "color: #cacaca";
                }
                echo "\">
                <div class=\"yui3-u\" style=\"width:90px;\">";
                // line 100
                if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($_transaction_, "created_at"), "html", null, true);
                echo "</div>
                <div class=\"yui3-u\" style=\"width:90px;\">";
                // line 101
                if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($_transaction_, "expire_at"), "html", null, true);
                echo "</div>
                <div class=\"yui3-u\" style=\"width:100px;\">";
                // line 102
                if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
                if ($this->getAttribute($_transaction_, "name")) {
                    if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
                    echo twig_escape_filter($this->env, $this->getAttribute($_transaction_, "name"), "html", null, true);
                } else {
                    echo " - ";
                }
                echo "</div>
                <div class=\"yui3-u\" style=\"width:50px;text-align:center\">";
                // line 103
                if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
                if ($this->getAttribute($_transaction_, "quantity")) {
                    if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
                    echo twig_escape_filter($this->env, $this->getAttribute($_transaction_, "quantity"), "html", null, true);
                } else {
                    echo " - ";
                }
                echo "</div>
                <div class=\"yui3-u\" style=\"width:120px;\"><strong>";
                // line 104
                if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
                echo twig_escape_filter($this->env, twig_currency($this->getAttribute($_transaction_, "price")), "html", null, true);
                echo "</strong></div>
                <div class=\"yui3-u\" style=\"width:150px;\">
                    
                    ";
                // line 107
                if (isset($context["subview"])) { $_subview_ = $context["subview"]; } else { $_subview_ = null; }
                if ((($_subview_ == "send_gift") || ($_subview_ == ""))) {
                    echo "<a href=\"";
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
                    echo "</a>";
                }
                // line 108
                echo "                    ";
                if (isset($context["subview"])) { $_subview_ = $context["subview"]; } else { $_subview_ = null; }
                if (($_subview_ == "received_gift")) {
                    echo "<a href=\"";
                    if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
                    if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
                    echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array(((("@myAccountCouponDetails?coupon_id=" . $this->getAttribute($_transaction_, "id")) . "&friend=") . $this->getAttribute($_transaction_, "friend")), ), "method"), "html", null, true);
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
                    echo "</a>";
                }
                // line 109
                echo "                    ";
                if (isset($context["subview"])) { $_subview_ = $context["subview"]; } else { $_subview_ = null; }
                if (($_subview_ == "")) {
                    echo "<a href=\"";
                    if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
                    if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
                    echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array(("@myAccountTransactionDetails?trans_id=" . $this->getAttribute($_transaction_, "transaction_id")), ), "method"), "html", null, true);
                    echo "\" class=\"g-button g-button-share modal-normal\" title=\"Transaction Details\"  style=\"padding:2px;height:15px;line-height:15px;\">Transaction</a>";
                }
                // line 110
                echo "                </div>
            </div>
            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['transaction'], $context['_parent'], $context['loop']);
            $context = array_merge($_parent, array_intersect_key($context, $_parent));
            // line 113
            echo "            <ul class=\"pagination clearfix\">";
            if (isset($context["pagination"])) { $_pagination_ = $context["pagination"]; } else { $_pagination_ = null; }
            echo $_pagination_;
            echo "</ul>
        ";
        }
        // line 115
        echo "            
            ";
        // line 116
        if (isset($context["view"])) { $_view_ = $context["view"]; } else { $_view_ = null; }
        if (($_view_ == "all_vouchers")) {
            // line 117
            echo "            <a href=\"";
            if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array("@myAccountTransactions?view=all_vouchers&format=csv", ), "method"), "html", null, true);
            echo "\" class=\"g-button g-button-share\">Download CSV</a>
            <br /><br />
            <ul class=\"pagination clearfix\">";
            // line 119
            if (isset($context["pagination"])) { $_pagination_ = $context["pagination"]; } else { $_pagination_ = null; }
            echo $_pagination_;
            echo "</ul>
            <div class=\"yui3-g\" style=\"font-weight:bold;font-size:16px;border-bottom:1px solid #3079ed\">
                <div class=\"yui3-u\" style=\"width:80px;\">Created</div>
                <div class=\"yui3-u\" style=\"width:80px;\">Expires</div>
                <div class=\"yui3-u\" style=\"width:100px;\">Product</div>
                <div class=\"yui3-u\" style=\"width:80px;text-align:center\">Buyer</div>
                <div class=\"yui3-u\" style=\"width:100px;\">Cost</div>
                <div class=\"yui3-u\" style=\"width:150px;\">Voucher Number</div>
            </div>
            ";
            // line 128
            if (isset($context["transactions"])) { $_transactions_ = $context["transactions"]; } else { $_transactions_ = null; }
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($_transactions_);
            foreach ($context['_seq'] as $context["_key"] => $context["transaction"]) {
                // line 129
                echo "            <div class=\"yui3-g\" style=\"padding:5px 0;margin-bottom:2px;border-bottom:1px solid #3079ed\">
                <div class=\"yui3-u\" style=\"width:80px;\">";
                // line 130
                if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($_transaction_, "created_at"), "html", null, true);
                echo "</div>
                <div class=\"yui3-u\" style=\"width:80px;\">";
                // line 131
                if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($_transaction_, "expire_at"), "html", null, true);
                echo "</div>
                <div class=\"yui3-u\" style=\"width:100px;\">";
                // line 132
                if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
                if ($this->getAttribute($_transaction_, "name")) {
                    if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
                    echo twig_escape_filter($this->env, $this->getAttribute($_transaction_, "name"), "html", null, true);
                } else {
                    echo " - ";
                }
                echo "</div>
                <div class=\"yui3-u\" style=\"width:80px;text-align:center\">";
                // line 133
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
                <div class=\"yui3-u\" style=\"width:100px;\"><strong>";
                // line 134
                if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
                echo twig_escape_filter($this->env, twig_currency($this->getAttribute($_transaction_, "price")), "html", null, true);
                echo "</strong></div>
                <div class=\"yui3-u\" style=\"width:150px;\">
                ";
                // line 136
                if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($_transaction_, "code2"), "html", null, true);
                echo "
                </div>
            </div>
            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['transaction'], $context['_parent'], $context['loop']);
            $context = array_merge($_parent, array_intersect_key($context, $_parent));
            // line 140
            echo "            <ul class=\"pagination clearfix\">";
            if (isset($context["pagination"])) { $_pagination_ = $context["pagination"]; } else { $_pagination_ = null; }
            echo $_pagination_;
            echo "</ul>
        ";
        }
        // line 142
        echo "            
        ";
        // line 143
        if (isset($context["view"])) { $_view_ = $context["view"]; } else { $_view_ = null; }
        if (($_view_ == "wallet")) {
            // line 144
            echo "            <div class=\"info-blue\">
            <p style=\"border:1px solid #3079ed\">
                In Transactions: My Wallet section you may view the deposits you have made to your My Wallet as well as any credit transfers from your <img src=\"/images/logo_final.png\" width=\"20\"  /> Account to your My Wallet.";
            // line 148
            echo "            </p>
            </div>
            <br />
            <span style=\"font-size:16px;\">Your <img src=\"/images/logo_final.png\" width=\"20\"  /> Account balance is: ";
            // line 151
            if (isset($context["app"])) { $_app_ = $context["app"]; } else { $_app_ = null; }
            echo twig_escape_filter($this->env, twig_currency($this->getAttribute($this->getAttribute($_app_, "user"), "virtual_wallet")), "html", null, true);
            echo "</span>
            <br /><br />
            ";
            // line 164
            echo "            <br /><br />
            <ul class=\"pagination clearfix\">";
            // line 165
            if (isset($context["pagination"])) { $_pagination_ = $context["pagination"]; } else { $_pagination_ = null; }
            echo $_pagination_;
            echo "</ul>
            <div class=\"yui3-g\" style=\"font-weight:bold;font-size:16px;border-bottom:1px solid #3079ed\">
                <div class=\"yui3-u\" style=\"width:80px;\">Date</div>
                <div class=\"yui3-u\" style=\"width:150px;\">From</div>
                <div class=\"yui3-u\" style=\"width:100px;\">To</div>
                <div class=\"yui3-u\" style=\"width:80px;\">Type</div>
                <div class=\"yui3-u\" style=\"width:120px;\">Amount</div>
                <div class=\"yui3-u\" style=\"width:50px;\">Actions</div>
            </div>
            ";
            // line 174
            if (isset($context["transactions"])) { $_transactions_ = $context["transactions"]; } else { $_transactions_ = null; }
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($_transactions_);
            foreach ($context['_seq'] as $context["_key"] => $context["transaction"]) {
                // line 175
                echo "            <div class=\"yui3-g\" style=\"padding:5px 0;margin-bottom:2px;border-bottom:1px solid #3079ed\">
                <div class=\"yui3-u\" style=\"width:80px;\">";
                // line 176
                if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($_transaction_, "created_at"), "html", null, true);
                echo "</div>
                <div class=\"yui3-u\" style=\"width:150px;\">";
                // line 177
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
                <div class=\"yui3-u\" style=\"width:100px;\">";
                // line 178
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
                <div class=\"yui3-u\" style=\"width:80px;\">";
                // line 179
                if (isset($context["transactionType"])) { $_transactionType_ = $context["transactionType"]; } else { $_transactionType_ = null; }
                if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
                echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->getAttribute($_transactionType_, $this->getAttribute($_transaction_, "transaction_type"), array(), "array")), "html", null, true);
                echo "</div>
                <div class=\"yui3-u\" style=\"width:120px;\"><strong>";
                // line 180
                if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
                echo twig_escape_filter($this->env, twig_currency($this->getAttribute($_transaction_, "full_payment")), "html", null, true);
                echo "</strong></div>
                <div class=\"yui3-u\" style=\"width:50px;\"><a href=\"";
                // line 181
                if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
                if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array(("@myAccountTransactionDetails?trans_id=" . $this->getAttribute($_transaction_, "id")), ), "method"), "html", null, true);
                echo "\" class=\"g-button g-button-share modal-normal\" title=\"Transaction Details\"  style=\"padding:2px;height:15px;line-height:15px;\">View</a></div>
            </div>
            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['transaction'], $context['_parent'], $context['loop']);
            $context = array_merge($_parent, array_intersect_key($context, $_parent));
            // line 184
            echo "            <ul class=\"pagination clearfix\">";
            if (isset($context["pagination"])) { $_pagination_ = $context["pagination"]; } else { $_pagination_ = null; }
            echo $_pagination_;
            echo "</ul>
        ";
        }
        // line 186
        echo "        ";
        if (isset($context["view"])) { $_view_ = $context["view"]; } else { $_view_ = null; }
        if (($_view_ == "network")) {
            // line 187
            echo "            <div class=\"info-blue\">
            <p>In the Transactions: Network Transactions Section you may view all the purchases made by the members in your 5th Tier.  All the commissions you receive are automatically deposited to your WinMaWeb Account.
            </p>
            </div>
            <br /><br />
            <ul class=\"pagination clearfix\">";
            // line 192
            if (isset($context["pagination"])) { $_pagination_ = $context["pagination"]; } else { $_pagination_ = null; }
            echo $_pagination_;
            echo "</ul>
            <div class=\"yui3-g\" style=\"font-weight:bold;font-size:16px;border-bottom:1px solid #3079ed\">
                <div class=\"yui3-u\" style=\"width:80px;\">Date</div>
                <div class=\"yui3-u\" style=\"width:100px;\">Product</div>
                <div class=\"yui3-u\" style=\"width:50px;text-align:center\">Qty</div>
                ";
            // line 198
            echo "                <div class=\"yui3-u\" style=\"width:80px;\">Type</div>
                <div class=\"yui3-u\" style=\"width:120px;\">Amount</div>
                <div class=\"yui3-u\" style=\"width:50px;\">Actions</div>
            </div>
            ";
            // line 202
            if (isset($context["transactions"])) { $_transactions_ = $context["transactions"]; } else { $_transactions_ = null; }
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($_transactions_);
            foreach ($context['_seq'] as $context["_key"] => $context["transaction"]) {
                // line 203
                echo "            <div class=\"yui3-g\" style=\"padding:5px 0;margin-bottom:2px;border-bottom:1px solid #3079ed\">
                <div class=\"yui3-u\" style=\"width:80px;\">";
                // line 204
                if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($_transaction_, "created_at"), "html", null, true);
                echo "</div>
                <div class=\"yui3-u\" style=\"width:100px;\">";
                // line 205
                if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
                if ($this->getAttribute($_transaction_, "product_name")) {
                    if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
                    echo twig_escape_filter($this->env, $this->getAttribute($_transaction_, "product_name"), "html", null, true);
                } else {
                    echo " - ";
                }
                echo "</div>
                <div class=\"yui3-u\" style=\"width:50px;text-align:center\">";
                // line 206
                if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
                if ($this->getAttribute($_transaction_, "quantity")) {
                    if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
                    echo twig_escape_filter($this->env, $this->getAttribute($_transaction_, "quantity"), "html", null, true);
                } else {
                    echo " - ";
                }
                echo "</div>
                ";
                // line 208
                echo "                <div class=\"yui3-u\" style=\"width:80px;\">";
                if (isset($context["transactionType"])) { $_transactionType_ = $context["transactionType"]; } else { $_transactionType_ = null; }
                if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
                if (($this->getAttribute($_transactionType_, $this->getAttribute($_transaction_, "transaction_type"), array(), "array") == "level-commission")) {
                    echo " 5th Tier Commission ";
                } else {
                    if (isset($context["transactionType"])) { $_transactionType_ = $context["transactionType"]; } else { $_transactionType_ = null; }
                    if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
                    echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->getAttribute($_transactionType_, $this->getAttribute($_transaction_, "transaction_type"), array(), "array")), "html", null, true);
                }
                echo "</div>
                <div class=\"yui3-u\" style=\"width:120px;";
                // line 209
                if (isset($context["transactionType"])) { $_transactionType_ = $context["transactionType"]; } else { $_transactionType_ = null; }
                if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
                if (($this->getAttribute($_transactionType_, $this->getAttribute($_transaction_, "transaction_type"), array(), "array") == "site-fee")) {
                    echo "color:#DD3C10;font-weight: bold";
                }
                echo "\"><strong>";
                if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
                echo twig_escape_filter($this->env, twig_currency($this->getAttribute($_transaction_, "full_payment")), "html", null, true);
                echo "</strong></div>
                <div class=\"yui3-u\" style=\"width:50px;\"><a href=\"";
                // line 210
                if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
                if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array(("@myAccountTransactionDetails?trans_id=" . $this->getAttribute($_transaction_, "id")), ), "method"), "html", null, true);
                echo "\" class=\"g-button g-button-share modal-normal\" title=\"Transaction Details\"  style=\"padding:2px;height:15px;line-height:15px;\">Transaction</a></div>
            </div>
            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['transaction'], $context['_parent'], $context['loop']);
            $context = array_merge($_parent, array_intersect_key($context, $_parent));
            // line 213
            echo "            <ul class=\"pagination clearfix\">";
            if (isset($context["pagination"])) { $_pagination_ = $context["pagination"]; } else { $_pagination_ = null; }
            echo $_pagination_;
            echo "</ul>
        ";
        }
        // line 215
        echo "        ";
        if (isset($context["view"])) { $_view_ = $context["view"]; } else { $_view_ = null; }
        if (($_view_ == "received")) {
            // line 216
            echo "            ";
            // line 217
            echo "            <div class=\"info-blue\">
            <p>In the Transactions: Received Transactions Section you may view all of the commissions on deals which you have received from merchants.  You will receive commissions on deals from merchants you have brought to WinMaWeb.  Merchants you have brought to WinMaWeb will submit your referral ID when posting their deals on the site.
            </p>
            </div>
\t\t\t\t\t\t
            ";
            // line 238
            echo "
            <br /><br />
            <ul class=\"pagination clearfix\">";
            // line 240
            if (isset($context["pagination"])) { $_pagination_ = $context["pagination"]; } else { $_pagination_ = null; }
            echo $_pagination_;
            echo "</ul>
            <div class=\"yui3-g\" style=\"font-weight:bold;font-size:16px;border-bottom:1px solid #3079ed\">
                <div class=\"yui3-u\" style=\"width:80px;\">Date</div>
                <div class=\"yui3-u\" style=\"width:100px;\">Product</div>
                <div class=\"yui3-u\" style=\"width:50px;text-align:center\">Qty</div>
                ";
            // line 246
            echo "                <div class=\"yui3-u\" style=\"width:80px;\">Type</div>
                <div class=\"yui3-u\" style=\"width:120px;\">Commission</div>
                <div class=\"yui3-u\" style=\"width:50px;\">Actions</div>
            </div>
            ";
            // line 250
            if (isset($context["transactions"])) { $_transactions_ = $context["transactions"]; } else { $_transactions_ = null; }
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($_transactions_);
            foreach ($context['_seq'] as $context["_key"] => $context["transaction"]) {
                // line 251
                echo "            <div class=\"yui3-g\" style=\"padding:5px 0;margin-bottom:2px;border-bottom:1px solid #3079ed\">
                <div class=\"yui3-u\" style=\"width:80px;\">";
                // line 252
                if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($_transaction_, "created_at"), "html", null, true);
                echo "</div>
                <div class=\"yui3-u\" style=\"width:100px;\">";
                // line 253
                if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
                if ($this->getAttribute($_transaction_, "product_name")) {
                    if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
                    echo twig_escape_filter($this->env, $this->getAttribute($_transaction_, "product_name"), "html", null, true);
                } else {
                    echo " - ";
                }
                echo "</div>
                <div class=\"yui3-u\" style=\"width:50px;text-align:center\">";
                // line 254
                if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
                if ($this->getAttribute($_transaction_, "quantity")) {
                    if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
                    echo twig_escape_filter($this->env, $this->getAttribute($_transaction_, "quantity"), "html", null, true);
                } else {
                    echo " - ";
                }
                echo "</div>
                ";
                // line 256
                echo "                ";
                // line 257
                echo "\t\t\t\t\t\t\t\t<div class=\"yui3-u\" style=\"width:80px;\">";
                if (isset($context["transactionType"])) { $_transactionType_ = $context["transactionType"]; } else { $_transactionType_ = null; }
                if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
                if (($this->getAttribute($_transactionType_, $this->getAttribute($_transaction_, "transaction_type"), array(), "array") == "do-share-do-receive")) {
                    echo "Coupon money";
                } elseif (($this->getAttribute($_transactionType_, $this->getAttribute($_transaction_, "transaction_type"), array(), "array") == "merchant-commission")) {
                    echo "Agent-Commission";
                } else {
                    if (isset($context["transactionType"])) { $_transactionType_ = $context["transactionType"]; } else { $_transactionType_ = null; }
                    if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
                    echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->getAttribute($_transactionType_, $this->getAttribute($_transaction_, "transaction_type"), array(), "array")), "html", null, true);
                }
                echo "</div>
                <div class=\"yui3-u\" style=\"width:120px;";
                // line 258
                if (isset($context["transactionType"])) { $_transactionType_ = $context["transactionType"]; } else { $_transactionType_ = null; }
                if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
                if (($this->getAttribute($_transactionType_, $this->getAttribute($_transaction_, "transaction_type"), array(), "array") == "site-fee")) {
                    echo "color:#DD3C10;font-weight: bold";
                }
                echo "\"><strong>";
                if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
                echo twig_escape_filter($this->env, twig_currency($this->getAttribute($_transaction_, "full_payment")), "html", null, true);
                echo "</strong></div>
                <div class=\"yui3-u\" style=\"width:50px;\"><a href=\"";
                // line 259
                if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
                if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array(("@myAccountTransactionDetails?trans_id=" . $this->getAttribute($_transaction_, "id")), ), "method"), "html", null, true);
                echo "\" class=\"g-button g-button-share modal-normal\" title=\"Transaction Details\"  style=\"padding:2px;height:15px;line-height:15px;\">Transaction</a></div>
            </div>
            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['transaction'], $context['_parent'], $context['loop']);
            $context = array_merge($_parent, array_intersect_key($context, $_parent));
            // line 262
            echo "            <ul class=\"pagination clearfix\">";
            if (isset($context["pagination"])) { $_pagination_ = $context["pagination"]; } else { $_pagination_ = null; }
            echo $_pagination_;
            echo "</ul>
        ";
        }
        // line 264
        echo "        ";
        if (isset($context["view"])) { $_view_ = $context["view"]; } else { $_view_ = null; }
        if ((!$_view_)) {
            // line 265
            echo "        <div class=\"info-blue\">
            <p>In the Transactions: Sent Transactions Section you may view all of the purchases you have made through WinMaWeb.<br />
            ";
            // line 267
            if (isset($context["userObj"])) { $_userObj_ = $context["userObj"]; } else { $_userObj_ = null; }
            if ($this->getAttribute($_userObj_, "hasRole", array("SHOP", ), "method")) {
                // line 268
                echo "                <br />In addition, Merchants may view their verification and test transaction here.  This small transfer is done to verify that the merchant's financial information is both correct and functional.
            ";
            }
            // line 270
            echo "            </p>
        </div>
            <br />
        <div class=\"info-blue\">
            <p>The blue colored deal you bought means that the deal offer is not yet active. Check the deal offer to see how many more need to be purchased until the deal is on</p>
        </div>
        <br /><br />
        <ul class=\"pagination clearfix\">";
            // line 277
            if (isset($context["pagination"])) { $_pagination_ = $context["pagination"]; } else { $_pagination_ = null; }
            echo $_pagination_;
            echo "</ul>
        <div class=\"yui3-g\" style=\"font-weight:bold;font-size:16px;border-bottom:1px solid #3079ed\">
            <div class=\"yui3-u\" style=\"width:80px;\">Date</div>
            <div class=\"yui3-u\" style=\"width:100px;\">Product</div>
            <div class=\"yui3-u\" style=\"width:50px;text-align:center\">Qty</div>
            <div class=\"yui3-u\" style=\"width:100px;\">From</div>
            <div class=\"yui3-u\" style=\"width:100px;\">Type</div>
            <div class=\"yui3-u\" style=\"width:100px;\">Cost</div>
            <div class=\"yui3-u\" style=\"width:50px;\">Actions</div>
        </div>
        ";
            // line 287
            if (isset($context["transactions"])) { $_transactions_ = $context["transactions"]; } else { $_transactions_ = null; }
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($_transactions_);
            foreach ($context['_seq'] as $context["_key"] => $context["transaction"]) {
                // line 288
                echo "        <div class=\"yui3-g\" style=\"padding:5px 0;margin-bottom:2px;border-bottom:1px solid #3079ed;";
                if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
                if (($this->getAttribute($this->getAttribute($_transaction_, "Product"), "sold") < $this->getAttribute($this->getAttribute($_transaction_, "Product"), "min_sold"))) {
                    echo " color: blue;";
                }
                if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
                if (($this->getAttribute($_transaction_, "status") == (-1))) {
                    echo "color:red";
                }
                echo "\">
            <div class=\"yui3-u\" style=\"width:80px;\">";
                // line 289
                if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($_transaction_, "created_at"), "html", null, true);
                echo "</div>
            <div class=\"yui3-u\" style=\"width:100px;\">";
                // line 290
                if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
                if ($this->getAttribute($_transaction_, "product_name")) {
                    if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
                    echo twig_escape_filter($this->env, $this->getAttribute($_transaction_, "product_name"), "html", null, true);
                } else {
                    echo " - ";
                }
                echo "</div>
            <div class=\"yui3-u\" style=\"width:50px;text-align:center\">";
                // line 291
                if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
                if ($this->getAttribute($_transaction_, "quantity")) {
                    if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
                    echo twig_escape_filter($this->env, $this->getAttribute($_transaction_, "quantity"), "html", null, true);
                } else {
                    echo " - ";
                }
                echo "</div>
            ";
                // line 293
                echo "\t\t\t\t\t\t<div class=\"yui3-u\" style=\"width:100px;\">";
                if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
                if ((($this->getAttribute($this->getAttribute($_transaction_, "Receiver"), "username") && ($this->getAttribute($_transaction_, "transaction_type") != "8")) && ($this->getAttribute($_transaction_, "transaction_type") != "55"))) {
                    if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($_transaction_, "Receiver"), "username"), "html", null, true);
                } else {
                    echo " You ";
                }
                echo "</div>
            <div class=\"yui3-u\" style=\"width:100px;\">
                ";
                // line 295
                if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
                if ((($this->getAttribute($_transaction_, "transaction_type") == "1") || ($this->getAttribute($_transaction_, "transaction_type") == "80"))) {
                    echo "Deal Purchase(from ";
                    if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
                    if (($this->getAttribute($_transaction_, "transaction_type") == "80")) {
                        echo "WMW Credits";
                    }
                    if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
                    if (($this->getAttribute($_transaction_, "transaction_type") == "1")) {
                        echo "wallet";
                    }
                    echo ")";
                    if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
                    if (($this->getAttribute($this->getAttribute($_transaction_, "Product"), "sold") < $this->getAttribute($this->getAttribute($_transaction_, "Product"), "min_sold"))) {
                        echo " (Deal will become active after ";
                        if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
                        echo twig_escape_filter($this->env, ($this->getAttribute($this->getAttribute($_transaction_, "Product"), "min_sold") - $this->getAttribute($this->getAttribute($_transaction_, "Product"), "sold")), "html", null, true);
                        echo " more are purchased)";
                    }
                } else {
                    if (isset($context["transactionType"])) { $_transactionType_ = $context["transactionType"]; } else { $_transactionType_ = null; }
                    if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
                    echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->getAttribute($_transactionType_, $this->getAttribute($_transaction_, "transaction_type"), array(), "array")), "html", null, true);
                }
                if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
                if (($this->getAttribute($_transaction_, "status") == (-1))) {
                    echo " (Refunded)";
                }
                // line 296
                echo "                ";
                echo "</div>
            <div class=\"yui3-u\" style=\"width:100px;";
                // line 297
                if (isset($context["transactionType"])) { $_transactionType_ = $context["transactionType"]; } else { $_transactionType_ = null; }
                if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
                if (($this->getAttribute($_transactionType_, $this->getAttribute($_transaction_, "transaction_type"), array(), "array") == "deposit")) {
                    echo "color:#29691d;font-weight: bold";
                }
                echo "\"><strong>";
                if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
                echo twig_escape_filter($this->env, twig_currency($this->getAttribute($_transaction_, "full_payment")), "html", null, true);
                echo "</strong></div>
            <div class=\"yui3-u\" style=\"width:50px;\"><a href=\"";
                // line 298
                if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
                if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array(("@myAccountTransactionDetails?trans_id=" . $this->getAttribute($_transaction_, "id")), ), "method"), "html", null, true);
                echo "\" class=\"g-button g-button-share modal-normal\" title=\"Transaction Details\"  style=\"padding:2px;height:15px;line-height:15px;\">Transaction</a></div>
        </div>
        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['transaction'], $context['_parent'], $context['loop']);
            $context = array_merge($_parent, array_intersect_key($context, $_parent));
            // line 301
            echo "        <ul class=\"pagination clearfix\">";
            if (isset($context["pagination"])) { $_pagination_ = $context["pagination"]; } else { $_pagination_ = null; }
            echo $_pagination_;
            echo "</ul>
        ";
        }
        // line 303
        echo "    </div>
    <div class=\"ma_bottom\"></div>
";
    }

    // line 307
    public function block_right_side($context, array $blocks = array())
    {
        // line 308
        echo "    ";
        if (isset($context["app"])) { $_app_ = $context["app"]; } else { $_app_ = null; }
        if ((!$this->getAttribute($_app_, "ajax"))) {
            // line 309
            echo "        ";
            $context["ma_menu"] = "transactions";
            // line 310
            echo "        ";
            $this->env->loadTemplate("myaccount/menu.twig")->display($context);
            // line 311
            echo "    ";
        }
    }

    public function getTemplateName()
    {
        return "myaccount/transactions/show.twig";
    }

    public function isTraitable()
    {
        return false;
    }
}
