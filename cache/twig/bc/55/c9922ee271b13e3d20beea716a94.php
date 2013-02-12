<?php

/* user/actionsTransactions.twig */
class __TwigTemplate_bc55c9922ee271b13e3d20beea716a94 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->blocks = array(
            'content' => array($this, 'block_content'),
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
        $context["actionsMenu"] = "transactions";
        // line 5
        $this->env->loadTemplate("user/actionsMenu.twig")->display($context);
        // line 6
        echo "<br /><br />
<a href=\"";
        // line 7
        if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
        if (isset($context["userId"])) { $_userId_ = $context["userId"]; } else { $_userId_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array((("@manageUsersActions?id=" . $_userId_) . "&tab=transactions"), ), "method"), "html", null, true);
        echo "\" class=\"g-button";
        if (isset($context["view"])) { $_view_ = $context["view"]; } else { $_view_ = null; }
        if ((!$_view_)) {
            echo " g-button-submit";
        }
        echo " modal-ajax-link\">Sent transactions</a>
<a href=\"";
        // line 8
        if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
        if (isset($context["userId"])) { $_userId_ = $context["userId"]; } else { $_userId_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array((("@manageUsersActions?id=" . $_userId_) . "&tab=transactions&view=received"), ), "method"), "html", null, true);
        echo "\" class=\"g-button ";
        if (isset($context["view"])) { $_view_ = $context["view"]; } else { $_view_ = null; }
        if (($_view_ == "received")) {
            echo " g-button-submit";
        }
        echo " modal-ajax-link\">Received transactions</a>
<a href=\"";
        // line 9
        if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
        if (isset($context["userId"])) { $_userId_ = $context["userId"]; } else { $_userId_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array((("@manageUsersActions?id=" . $_userId_) . "&tab=transactions&view=network"), ), "method"), "html", null, true);
        echo "\" class=\"g-button ";
        if (isset($context["view"])) { $_view_ = $context["view"]; } else { $_view_ = null; }
        if (($_view_ == "network")) {
            echo " g-button-submit";
        }
        echo " modal-ajax-link\">Network transactions</a>
<a href=\"";
        // line 10
        if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
        if (isset($context["userId"])) { $_userId_ = $context["userId"]; } else { $_userId_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array((("@manageUsersActions?id=" . $_userId_) . "&tab=transactions&view=wallet"), ), "method"), "html", null, true);
        echo "\" class=\"g-button ";
        if (isset($context["view"])) { $_view_ = $context["view"]; } else { $_view_ = null; }
        if (($_view_ == "wallet")) {
            echo " g-button-submit";
        }
        echo " modal-ajax-link\">Wallet</a>
<a href=\"";
        // line 11
        if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
        if (isset($context["userId"])) { $_userId_ = $context["userId"]; } else { $_userId_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array((("@manageUsersActions?id=" . $_userId_) . "&tab=transactions&view=coupons"), ), "method"), "html", null, true);
        echo "\" class=\"g-button ";
        if (isset($context["view"])) { $_view_ = $context["view"]; } else { $_view_ = null; }
        if (($_view_ == "coupons")) {
            echo " g-button-submit";
        }
        echo " modal-ajax-link\">Vouchers</a>
<br /><br />
";
        // line 13
        if (isset($context["view"])) { $_view_ = $context["view"]; } else { $_view_ = null; }
        if (($_view_ == "coupons")) {
            // line 14
            echo "            <div class=\"info-blue\">
            <p>In this section you can see user vouchers</p>
            </div>
            <br /><br />
            <ul class=\"pagination clearfix\">";
            // line 18
            if (isset($context["pagination"])) { $_pagination_ = $context["pagination"]; } else { $_pagination_ = null; }
            echo $_pagination_;
            echo "</ul>
            <div class=\"yui3-g\" style=\"font-weight:bold;font-size:16px;border-bottom:1px solid #3079ed\">
                <div class=\"yui3-u\" style=\"width:90px;\">Created At</div>
                <div class=\"yui3-u\" style=\"width:90px;\">Expire At</div>
                <div class=\"yui3-u\" style=\"width:100px;\">Product</div>
                <div class=\"yui3-u\" style=\"width:50px;text-align:center\">Qty</div>
                <div class=\"yui3-u\" style=\"width:120px;\">Amount</div>
                <div class=\"yui3-u\" style=\"width:100px;\">Product Price</div>
            </div>
            ";
            // line 27
            if (isset($context["transactions"])) { $_transactions_ = $context["transactions"]; } else { $_transactions_ = null; }
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($_transactions_);
            foreach ($context['_seq'] as $context["_key"] => $context["transaction"]) {
                // line 28
                echo "            <div class=\"yui3-g\" style=\"padding:5px 0;margin-bottom:2px;border-bottom:1px solid #3079ed";
                if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
                if ((!(null === $this->getAttribute($_transaction_, "verifier_id")))) {
                    echo ";color: #cacaca";
                }
                echo "\">
                <div class=\"yui3-u\" style=\"width:90px;\">";
                // line 29
                if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($_transaction_, "created_at"), "html", null, true);
                echo "</div>
                <div class=\"yui3-u\" style=\"width:90px;\">";
                // line 30
                if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($_transaction_, "expire_at"), "html", null, true);
                echo "</div>
                <div class=\"yui3-u\" style=\"width:100px;\">";
                // line 31
                if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
                if ($this->getAttribute($_transaction_, "name")) {
                    if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
                    echo twig_escape_filter($this->env, $this->getAttribute($_transaction_, "name"), "html", null, true);
                } else {
                    echo " - ";
                }
                echo "</div>
                <div class=\"yui3-u\" style=\"width:50px;text-align:center\">";
                // line 32
                if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
                if ($this->getAttribute($_transaction_, "quantity")) {
                    if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
                    echo twig_escape_filter($this->env, $this->getAttribute($_transaction_, "quantity"), "html", null, true);
                } else {
                    echo " - ";
                }
                echo "</div>
                <div class=\"yui3-u\" style=\"width:120px;\">";
                // line 33
                if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
                echo twig_escape_filter($this->env, twig_currency($this->getAttribute($_transaction_, "price")), "html", null, true);
                echo "</div>
                <div class=\"yui3-u\" style=\"width:100px;\">
                    ";
                // line 35
                if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
                if ($this->getAttribute($_transaction_, "price")) {
                    // line 36
                    echo "                        ";
                    if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
                    echo twig_escape_filter($this->env, twig_currency($this->getAttribute($_transaction_, "price")), "html", null, true);
                    echo "
                    ";
                } else {
                    // line 38
                    echo "                        0
                    ";
                }
                // line 39
                echo "    
                </div>
            </div>
            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['transaction'], $context['_parent'], $context['loop']);
            $context = array_merge($_parent, array_intersect_key($context, $_parent));
            // line 43
            echo "            <ul class=\"pagination clearfix\">";
            if (isset($context["pagination"])) { $_pagination_ = $context["pagination"]; } else { $_pagination_ = null; }
            echo $_pagination_;
            echo "</ul>
        ";
        }
        // line 45
        if (isset($context["view"])) { $_view_ = $context["view"]; } else { $_view_ = null; }
        if (($_view_ == "wallet")) {
            // line 46
            echo "    ";
            // line 51
            echo "    
    <span style=\"font-size:16px;\">User Wallet has: ";
            // line 52
            if (isset($context["user"])) { $_user_ = $context["user"]; } else { $_user_ = null; }
            echo twig_escape_filter($this->env, twig_currency($this->getAttribute($_user_, "wallet")), "html", null, true);
            echo "</span>
    <br />
    <span style=\"font-size:16px;\">WMW Account has: ";
            // line 54
            if (isset($context["user"])) { $_user_ = $context["user"]; } else { $_user_ = null; }
            echo twig_escape_filter($this->env, twig_currency($this->getAttribute($_user_, "virtual_wallet")), "html", null, true);
            echo "</span>
    <br /><br />
    <ul class=\"pagination-modal clearfix\">";
            // line 56
            if (isset($context["pagination"])) { $_pagination_ = $context["pagination"]; } else { $_pagination_ = null; }
            echo $_pagination_;
            echo "</ul>
    <div class=\"yui3-g\" style=\"font-weight:bold;font-size:16px;border-bottom:1px solid #3079ed\">
        <div class=\"yui3-u\" style=\"width:80px;\">Date</div>
        <div class=\"yui3-u\" style=\"width:150px;\">From</div>
        <div class=\"yui3-u\" style=\"width:100px;\">To</div>
        <div class=\"yui3-u\" style=\"width:80px;\">Type</div>
        <div class=\"yui3-u\" style=\"width:120px;\">Amount</div>
        <div class=\"yui3-u\" style=\"width:100px;\">Product price</div>
    </div>
    ";
            // line 65
            if (isset($context["transactions"])) { $_transactions_ = $context["transactions"]; } else { $_transactions_ = null; }
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($_transactions_);
            foreach ($context['_seq'] as $context["_key"] => $context["transaction"]) {
                // line 66
                echo "    <div class=\"yui3-g\" style=\"padding:5px 0;margin-bottom:2px;border-bottom:1px solid #3079ed\">
        <div class=\"yui3-u\" style=\"width:80px;\">";
                // line 67
                if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($_transaction_, "created_at"), "html", null, true);
                echo "</div>
        <div class=\"yui3-u\" style=\"width:150px;\">";
                // line 68
                if (isset($context["transactionType"])) { $_transactionType_ = $context["transactionType"]; } else { $_transactionType_ = null; }
                if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
                if (($this->getAttribute($_transactionType_, $this->getAttribute($_transaction_, "transaction_type"), array(), "array") == "deposit")) {
                    echo "Paypal";
                }
                if (isset($context["transactionType"])) { $_transactionType_ = $context["transactionType"]; } else { $_transactionType_ = null; }
                if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
                if (($this->getAttribute($_transactionType_, $this->getAttribute($_transaction_, "transaction_type"), array(), "array") == "transfer-to-wallet")) {
                    echo "Virtual Wallet";
                }
                if (isset($context["transactionType"])) { $_transactionType_ = $context["transactionType"]; } else { $_transactionType_ = null; }
                if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
                if (($this->getAttribute($_transactionType_, $this->getAttribute($_transaction_, "transaction_type"), array(), "array") == "withdraw")) {
                    echo "Wallet";
                }
                echo "</div>
        <div class=\"yui3-u\" style=\"width:100px;\">";
                // line 69
                if (isset($context["transactionType"])) { $_transactionType_ = $context["transactionType"]; } else { $_transactionType_ = null; }
                if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
                if (($this->getAttribute($_transactionType_, $this->getAttribute($_transaction_, "transaction_type"), array(), "array") == "withdraw")) {
                    echo "Paypal";
                } else {
                    echo "Wallet";
                }
                echo "</div>
        <div class=\"yui3-u\" style=\"width:80px;\">";
                // line 70
                if (isset($context["transactionType"])) { $_transactionType_ = $context["transactionType"]; } else { $_transactionType_ = null; }
                if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
                echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->getAttribute($_transactionType_, $this->getAttribute($_transaction_, "transaction_type"), array(), "array")), "html", null, true);
                echo "</div>
        <div class=\"yui3-u\" style=\"width:120px;\">";
                // line 71
                if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
                echo twig_escape_filter($this->env, twig_currency($this->getAttribute($_transaction_, "full_payment")), "html", null, true);
                echo "</div>
        <div class=\"yui3-u\" style=\"width:100px;\">";
                // line 73
                echo "            ";
                if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
                if ($this->getAttribute($_transaction_, "product_price")) {
                    // line 74
                    echo "                ";
                    if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
                    echo twig_escape_filter($this->env, twig_currency($this->getAttribute($_transaction_, "product_price")), "html", null, true);
                    echo "
            ";
                } else {
                    // line 76
                    echo "                0
            ";
                }
                // line 78
                echo "        </div>
    </div>
    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['transaction'], $context['_parent'], $context['loop']);
            $context = array_merge($_parent, array_intersect_key($context, $_parent));
            // line 81
            echo "    <ul class=\"pagination-modal clearfix\">";
            if (isset($context["pagination"])) { $_pagination_ = $context["pagination"]; } else { $_pagination_ = null; }
            echo $_pagination_;
            echo "</ul>
";
        }
        // line 83
        if (isset($context["view"])) { $_view_ = $context["view"]; } else { $_view_ = null; }
        if (($_view_ == "network")) {
            // line 84
            echo "    <div class=\"info-blue\">
    <p>In this section you can see all transaction user`s received from your network.<br />
    All money you received here, will get in your virtual wallet
    </p>
    </div>
    <br /><br />
    <ul class=\"pagination-modal clearfix\">";
            // line 90
            if (isset($context["pagination"])) { $_pagination_ = $context["pagination"]; } else { $_pagination_ = null; }
            echo $_pagination_;
            echo "</ul>
    <div class=\"yui3-g\" style=\"font-weight:bold;font-size:16px;border-bottom:1px solid #3079ed\">
        <div class=\"yui3-u\" style=\"width:80px;\">Date</div>
        <div class=\"yui3-u\" style=\"width:100px;\">Product</div>
        <div class=\"yui3-u\" style=\"width:50px;text-align:center\">Qty</div>
        <div class=\"yui3-u\" style=\"width:100px;\">Buyed by</div>
        <div class=\"yui3-u\" style=\"width:80px;\">Type</div>
        <div class=\"yui3-u\" style=\"width:120px;\">Amount</div>
        <div class=\"yui3-u\" style=\"width:100px;\">Product price</div>
    </div>
    ";
            // line 100
            if (isset($context["transactions"])) { $_transactions_ = $context["transactions"]; } else { $_transactions_ = null; }
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($_transactions_);
            foreach ($context['_seq'] as $context["_key"] => $context["transaction"]) {
                // line 101
                echo "    <div class=\"yui3-g\" style=\"padding:5px 0;margin-bottom:2px;border-bottom:1px solid #3079ed\">
        <div class=\"yui3-u\" style=\"width:80px;\">";
                // line 102
                if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($_transaction_, "created_at"), "html", null, true);
                echo "</div>
        <div class=\"yui3-u\" style=\"width:100px;\">";
                // line 103
                if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
                if ($this->getAttribute($_transaction_, "product_name")) {
                    if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
                    echo twig_escape_filter($this->env, $this->getAttribute($_transaction_, "product_name"), "html", null, true);
                } else {
                    echo " - ";
                }
                echo "</div>
        <div class=\"yui3-u\" style=\"width:50px;text-align:center\">";
                // line 104
                if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
                if ($this->getAttribute($_transaction_, "quantity")) {
                    if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
                    echo twig_escape_filter($this->env, $this->getAttribute($_transaction_, "quantity"), "html", null, true);
                } else {
                    echo " - ";
                }
                echo "</div>
        <div class=\"yui3-u\" style=\"width:100px;\">";
                // line 105
                if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
                if (isset($context["transactionType"])) { $_transactionType_ = $context["transactionType"]; } else { $_transactionType_ = null; }
                if (($this->getAttribute($this->getAttribute($_transaction_, "Sender"), "username") && ($this->getAttribute($_transactionType_, $this->getAttribute($_transaction_, "transaction_type"), array(), "array") == "sell"))) {
                    if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($_transaction_, "Sender"), "username"), "html", null, true);
                } else {
                    echo " - ";
                }
                echo "</div>
        <div class=\"yui3-u\" style=\"width:80px;\">";
                // line 106
                if (isset($context["transactionType"])) { $_transactionType_ = $context["transactionType"]; } else { $_transactionType_ = null; }
                if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
                echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->getAttribute($_transactionType_, $this->getAttribute($_transaction_, "transaction_type"), array(), "array")), "html", null, true);
                echo "</div>
        <div class=\"yui3-u\" style=\"width:120px;";
                // line 107
                if (isset($context["transactionType"])) { $_transactionType_ = $context["transactionType"]; } else { $_transactionType_ = null; }
                if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
                if (($this->getAttribute($_transactionType_, $this->getAttribute($_transaction_, "transaction_type"), array(), "array") == "site-fee")) {
                    echo "color:#DD3C10;font-weight: bold";
                }
                echo "\">";
                if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
                echo twig_escape_filter($this->env, twig_currency($this->getAttribute($_transaction_, "full_payment")), "html", null, true);
                echo "</div>
        <div class=\"yui3-u\" style=\"width:50px;\">
         ";
                // line 110
                echo "            ";
                if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
                if ($this->getAttribute($_transaction_, "product_price")) {
                    echo "    
                ";
                    // line 111
                    if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
                    echo twig_escape_filter($this->env, twig_currency($this->getAttribute($_transaction_, "product_price")), "html", null, true);
                    echo "
            ";
                } else {
                    // line 113
                    echo "                0
            ";
                }
                // line 115
                echo "        </div>
    </div>
    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['transaction'], $context['_parent'], $context['loop']);
            $context = array_merge($_parent, array_intersect_key($context, $_parent));
            // line 118
            echo "    <ul class=\"pagination-modal clearfix\">";
            if (isset($context["pagination"])) { $_pagination_ = $context["pagination"]; } else { $_pagination_ = null; }
            echo $_pagination_;
            echo "</ul>
";
        }
        // line 120
        if (isset($context["view"])) { $_view_ = $context["view"]; } else { $_view_ = null; }
        if (($_view_ == "received")) {
            // line 121
            echo "    ";
            // line 127
            echo "    <br /><br />
    <ul class=\"pagination-modal clearfix\">";
            // line 128
            if (isset($context["pagination"])) { $_pagination_ = $context["pagination"]; } else { $_pagination_ = null; }
            echo $_pagination_;
            echo "</ul>
    <div class=\"yui3-g\" style=\"font-weight:bold;font-size:16px;border-bottom:1px solid #3079ed\">
        <div class=\"yui3-u\" style=\"width:80px;\">Date</div>
        <div class=\"yui3-u\" style=\"width:100px;\">Product</div>
        <div class=\"yui3-u\" style=\"width:50px;text-align:center\">Qty</div>
        <div class=\"yui3-u\" style=\"width:100px;\">Buyed by</div>
        <div class=\"yui3-u\" style=\"width:80px;\">Type</div>
        <div class=\"yui3-u\" style=\"width:120px;\">Amount</div>
        <div class=\"yui3-u\" style=\"width:100px;\">Product price</div>
    </div>
    ";
            // line 138
            if (isset($context["transactions"])) { $_transactions_ = $context["transactions"]; } else { $_transactions_ = null; }
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($_transactions_);
            foreach ($context['_seq'] as $context["_key"] => $context["transaction"]) {
                // line 139
                echo "    <div class=\"yui3-g\" style=\"padding:5px 0;margin-bottom:2px;border-bottom:1px solid #3079ed\">
        <div class=\"yui3-u\" style=\"width:80px;\">";
                // line 140
                if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($_transaction_, "created_at"), "html", null, true);
                echo "</div>
        <div class=\"yui3-u\" style=\"width:100px;\">";
                // line 141
                if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
                if ($this->getAttribute($_transaction_, "product_name")) {
                    if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
                    echo twig_escape_filter($this->env, $this->getAttribute($_transaction_, "product_name"), "html", null, true);
                } else {
                    echo " - ";
                }
                echo "</div>
        <div class=\"yui3-u\" style=\"width:50px;text-align:center\">";
                // line 142
                if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
                if ($this->getAttribute($_transaction_, "quantity")) {
                    if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
                    echo twig_escape_filter($this->env, $this->getAttribute($_transaction_, "quantity"), "html", null, true);
                } else {
                    echo " - ";
                }
                echo "</div>
        <div class=\"yui3-u\" style=\"width:100px;\">";
                // line 143
                if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
                if (isset($context["transactionType"])) { $_transactionType_ = $context["transactionType"]; } else { $_transactionType_ = null; }
                if (($this->getAttribute($this->getAttribute($_transaction_, "Sender"), "username") && ($this->getAttribute($_transactionType_, $this->getAttribute($_transaction_, "transaction_type"), array(), "array") == "sell"))) {
                    if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($_transaction_, "Sender"), "username"), "html", null, true);
                } else {
                    echo " - ";
                }
                echo "</div>
        ";
                // line 145
                echo "\t\t\t\t<div class=\"yui3-u\" style=\"width:80px;\">";
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
                // line 146
                if (isset($context["transactionType"])) { $_transactionType_ = $context["transactionType"]; } else { $_transactionType_ = null; }
                if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
                if (($this->getAttribute($_transactionType_, $this->getAttribute($_transaction_, "transaction_type"), array(), "array") == "site-fee")) {
                    echo "color:#DD3C10;font-weight: bold";
                }
                echo "\">";
                if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
                echo twig_escape_filter($this->env, twig_currency($this->getAttribute($_transaction_, "full_payment")), "html", null, true);
                echo "</div>
        <div class=\"yui3-u\" style=\"width:100px;\">
            ";
                // line 149
                echo "            ";
                if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
                if (twig_currency($this->getAttribute($_transaction_, "product_price"))) {
                    // line 150
                    echo "                ";
                    if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
                    echo twig_escape_filter($this->env, twig_currency($this->getAttribute($_transaction_, "product_price")), "html", null, true);
                    echo "
            ";
                } else {
                    // line 152
                    echo "                0
            ";
                }
                // line 154
                echo "        </div>
    </div>
    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['transaction'], $context['_parent'], $context['loop']);
            $context = array_merge($_parent, array_intersect_key($context, $_parent));
            // line 157
            echo "    <ul class=\"pagination-modal clearfix\">";
            if (isset($context["pagination"])) { $_pagination_ = $context["pagination"]; } else { $_pagination_ = null; }
            echo $_pagination_;
            echo "</ul>
";
        }
        // line 159
        if (isset($context["view"])) { $_view_ = $context["view"]; } else { $_view_ = null; }
        if ((!$_view_)) {
            // line 160
            echo "<div class=\"info-blue\">
    <p>In this section you may view all the transactions a user has made when they bought an offer from from WinMaWeb.<br /></p>
</div>
<br /><br />
<ul class=\"pagination-modal clearfix\">";
            // line 164
            if (isset($context["pagination"])) { $_pagination_ = $context["pagination"]; } else { $_pagination_ = null; }
            echo $_pagination_;
            echo "</ul>
<div class=\"yui3-g\" style=\"font-weight:bold;font-size:16px;border-bottom:1px solid #3079ed\">
    <div class=\"yui3-u\" style=\"width:80px;\">Date</div>
    <div class=\"yui3-u\" style=\"width:100px;\">Product</div>
    <div class=\"yui3-u\" style=\"width:50px;text-align:center\">Qty</div>
    <div class=\"yui3-u\" style=\"width:100px;\">From</div>
    <div class=\"yui3-u\" style=\"width:80px;\">Type</div>
    <div class=\"yui3-u\" style=\"width:120px;\">Amount</div>
    <div class=\"yui3-u\" style=\"width:100px;\">Product price</div>
</div>
";
            // line 174
            if (isset($context["transactions"])) { $_transactions_ = $context["transactions"]; } else { $_transactions_ = null; }
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($_transactions_);
            foreach ($context['_seq'] as $context["_key"] => $context["transaction"]) {
                // line 175
                echo "<div class=\"yui3-g\" style=\"padding:5px 0;margin-bottom:2px;border-bottom:1px solid #3079ed\">
    <div class=\"yui3-u\" style=\"width:80px;\">";
                // line 176
                if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($_transaction_, "created_at"), "html", null, true);
                echo "</div>
    <div class=\"yui3-u\" style=\"width:100px;\">";
                // line 177
                if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
                if ($this->getAttribute($_transaction_, "product_name")) {
                    if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
                    echo twig_escape_filter($this->env, $this->getAttribute($_transaction_, "product_name"), "html", null, true);
                } else {
                    echo " - ";
                }
                echo "</div>
    <div class=\"yui3-u\" style=\"width:50px;text-align:center\">";
                // line 178
                if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
                if ($this->getAttribute($_transaction_, "quantity")) {
                    if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
                    echo twig_escape_filter($this->env, $this->getAttribute($_transaction_, "quantity"), "html", null, true);
                } else {
                    echo " - ";
                }
                echo "</div>
    <div class=\"yui3-u\" style=\"width:100px;\">";
                // line 179
                if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
                if (isset($context["transactionType"])) { $_transactionType_ = $context["transactionType"]; } else { $_transactionType_ = null; }
                if (($this->getAttribute($this->getAttribute($_transaction_, "Receiver"), "username") && ($this->getAttribute($_transactionType_, $this->getAttribute($_transaction_, "transaction_type"), array(), "array") != "merchant-fee"))) {
                    if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($_transaction_, "Receiver"), "username"), "html", null, true);
                } else {
                    echo " - ";
                }
                echo "</div>
    <div class=\"yui3-u\" style=\"width:80px;\">";
                // line 180
                if (isset($context["transactionType"])) { $_transactionType_ = $context["transactionType"]; } else { $_transactionType_ = null; }
                if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
                echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->getAttribute($_transactionType_, $this->getAttribute($_transaction_, "transaction_type"), array(), "array")), "html", null, true);
                echo "</div>
    <div class=\"yui3-u\" style=\"width:120px;";
                // line 181
                if (isset($context["transactionType"])) { $_transactionType_ = $context["transactionType"]; } else { $_transactionType_ = null; }
                if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
                if (($this->getAttribute($_transactionType_, $this->getAttribute($_transaction_, "transaction_type"), array(), "array") == "deposit")) {
                    echo "color:#29691d;font-weight: bold";
                }
                echo "\">";
                if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
                echo twig_escape_filter($this->env, twig_currency($this->getAttribute($_transaction_, "full_payment")), "html", null, true);
                echo "</div>
    <div class=\"yui3-u\" style=\"width:50px;\">
        ";
                // line 184
                echo "        ";
                if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
                if ($this->getAttribute($_transaction_, "product_price")) {
                    // line 185
                    echo "        ";
                    if (isset($context["transaction"])) { $_transaction_ = $context["transaction"]; } else { $_transaction_ = null; }
                    echo twig_escape_filter($this->env, twig_currency($this->getAttribute($_transaction_, "product_price")), "html", null, true);
                    echo "
            ";
                } else {
                    // line 187
                    echo "            0
            ";
                }
                // line 189
                echo "    </div>
</div>
";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['transaction'], $context['_parent'], $context['loop']);
            $context = array_merge($_parent, array_intersect_key($context, $_parent));
            // line 192
            echo "<ul class=\"pagination-modal clearfix\">";
            if (isset($context["pagination"])) { $_pagination_ = $context["pagination"]; } else { $_pagination_ = null; }
            echo $_pagination_;
            echo "</ul>
";
        }
    }

    public function getTemplateName()
    {
        return "user/actionsTransactions.twig";
    }

    public function isTraitable()
    {
        return false;
    }
}
