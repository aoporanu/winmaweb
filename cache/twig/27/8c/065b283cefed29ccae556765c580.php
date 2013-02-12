<?php

/* myaccount/transactions/depositd.twig */
class __TwigTemplate_278c065b283cefed29ccae556765c580 extends Twig_Template
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
        echo "\" class=\"g-button ajax-link\">Paypal</a>
        <a href=\"";
        // line 24
        if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array("@myAccountDeposit?view=giro", ), "method"), "html", null, true);
        echo "\" class=\"g-button g-button-submit ajax-link\">GIRO</a>
        <br /><br />
        ";
        // line 26
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        if ($this->getAttribute($_form_, "errors")) {
            // line 27
            echo "            <br /><div class=\"error_box\"><strong>There were errors - please verify all fields for errors</strong></div>
        ";
        }
        // line 29
        echo "        ";
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        if ($this->getAttribute($_form_, "success")) {
            // line 30
            echo "            <div class=\"infotip\"><strong>Success</strong><br /><br />Details were updated successfully</div>
        ";
        }
        // line 32
        echo "\t\t<br/>
\t\t<div class=\"info-blue\">
\t\t\t<p>Transferring funds to other bank accounts in Singapore is free and takes 2 to 3 business days to process. Transfers made after 9:00 PM will only be processed the next business day.</p>
\t\t\t<br/>
\t\t\t<p>
\t\t\t\tBank: OCBC<br/> 
\t\t\t\tAccount Name: GLOBAL MARKETING 3000 PTE. LTD.<br/>
\t\t\t\tAccount Number [For SGD Deposits]: 641-575626-001<br/>
\t\t\t\tBank Code: 7339<br/>
\t\t\t\tBranch Code: 641
\t\t\t</p>
\t\t</div>
\t\t<br/><br/>
        <form enctype=\"application/x-www-form-urlencoded\" action=\"";
        // line 45
        if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array("@myAccountDeposit?view=giro", ), "method"), "html", null, true);
        echo "\" method=\"post\">
            <div class=\"form-global clearfix\">
                ";
        // line 52
        echo "                
                <div class=\"label\"><label for=\"beneficiary_name\">Beneficiary Name:</label></div>
                <div class=\"input input_big\">
                    ";
        // line 55
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "input", array("beneficiary_name", $this->getAttribute($this->getAttribute($_form_, "values"), "beneficiary_name"), ), "method"), "html", null, true);
        echo "
                    ";
        // line 56
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "errors", array($this->getAttribute($this->getAttribute($_form_, "errors"), "beneficiary_name"), ), "method"), "html", null, true);
        echo "
                </div>
                <div class=\"label\"><label for=\"bank_code\">Bank Code:</label></div>
                <div class=\"input input_big\">
                    ";
        // line 60
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "input", array("bank_code", $this->getAttribute($this->getAttribute($_form_, "values"), "bank_code"), ), "method"), "html", null, true);
        echo "
                    ";
        // line 61
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "errors", array($this->getAttribute($this->getAttribute($_form_, "errors"), "bank_code"), ), "method"), "html", null, true);
        echo "
                </div>
                <div class=\"label\"><label for=\"bank_branch_code\">Bank Branch Code:</label></div>
                <div class=\"input input_big\">
                    ";
        // line 65
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "input", array("bank_branch_code", $this->getAttribute($this->getAttribute($_form_, "values"), "bank_branch_code"), ), "method"), "html", null, true);
        echo "
                    ";
        // line 66
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "errors", array($this->getAttribute($this->getAttribute($_form_, "errors"), "bank_branch_code"), ), "method"), "html", null, true);
        echo "
                </div>
                <div class=\"label\"><label for=\"bank_account_number\">Bank Account Number:</label></div>
                <div class=\"input input_big\">
                    ";
        // line 70
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "input", array("bank_account_number", $this->getAttribute($this->getAttribute($_form_, "values"), "bank_account_number"), ), "method"), "html", null, true);
        echo "
                    ";
        // line 71
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "errors", array($this->getAttribute($this->getAttribute($_form_, "errors"), "bank_account_number"), ), "method"), "html", null, true);
        echo "
                </div>
                <div class=\"label\"><label for=\"bank_name\">Bank Name:</label></div>
                <div class=\"input input_big\">
                    ";
        // line 75
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "select", array("bank_name", $this->getAttribute($this->getAttribute($_form_, "kkt"), "options"), $this->getAttribute($this->getAttribute($_form_, "values"), "bank_name"), ), "method"), "html", null, true);
        echo "
                    ";
        // line 76
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "errors", array($this->getAttribute($this->getAttribute($_form_, "errors"), "bank_name"), ), "method"), "html", null, true);
        echo "
                </div>
                <div class=\"label\"><label for=\"bank_address\">Bank Address:</label></div>
                <div class=\"input input_big\">
                    ";
        // line 80
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "input", array("bank_address", $this->getAttribute($this->getAttribute($_form_, "values"), "bank_address"), ), "method"), "html", null, true);
        echo "
                    ";
        // line 81
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "errors", array($this->getAttribute($this->getAttribute($_form_, "errors"), "bank_address"), ), "method"), "html", null, true);
        echo "
                </div>
            </div>
            <div class=\"form-global clearfix\">
                <div class=\"label\"><label>&nbsp;</label></div>
                <div class=\"left\"><input type=\"submit\" class=\"g-button g-button-submit ajax-submit\" value=\"Request\" /></div>
            </div>
        </form>
                <ul class=\"pagination clearfix\">";
        // line 89
        if (isset($context["pagination"])) { $_pagination_ = $context["pagination"]; } else { $_pagination_ = null; }
        echo $_pagination_;
        echo "</ul>
        <div class=\"yui3-g\" style=\"font-weight:bold;font-size:16px;border-bottom:1px solid #3079ed\">
            <div class=\"yui3-u\" style=\"width:180px;\">Date</div>
            <div class=\"yui3-u\" style=\"width:100px;\">Amount</div>
            <div class=\"yui3-u\" style=\"width:100px;\">Status</div>
            
            <div class=\"yui3-u\" style=\"width:100px;\">Actions</div>
        </div>
        ";
        // line 97
        if (isset($context["requests"])) { $_requests_ = $context["requests"]; } else { $_requests_ = null; }
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($_requests_);
        foreach ($context['_seq'] as $context["_key"] => $context["request"]) {
            // line 98
            echo "        <div class=\"yui3-g\" style=\"padding: 10px 0;border-bottom:1px solid #3079ed\">
            <div class=\"yui3-u\" style=\"width:180px;\">";
            // line 99
            if (isset($context["request"])) { $_request_ = $context["request"]; } else { $_request_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_request_, "created_at"), "html", null, true);
            echo "</div>
            <div class=\"yui3-u\" style=\"width:100px;\">";
            // line 100
            if (isset($context["request"])) { $_request_ = $context["request"]; } else { $_request_ = null; }
            if ($this->getAttribute($_request_, "amount")) {
                if (isset($context["request"])) { $_request_ = $context["request"]; } else { $_request_ = null; }
                echo twig_escape_filter($this->env, twig_currency($this->getAttribute($_request_, "amount")), "html", null, true);
            } else {
                echo " - ";
            }
            echo "</div>
            <div class=\"yui3-u\" style=\"width:100px;\">";
            // line 101
            if (isset($context["requestStatus"])) { $_requestStatus_ = $context["requestStatus"]; } else { $_requestStatus_ = null; }
            if (isset($context["request"])) { $_request_ = $context["request"]; } else { $_request_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_requestStatus_, $this->getAttribute($_request_, "status"), array(), "array"), "html", null, true);
            echo "</div>
            
            <div class=\"yui3-u\" style=\"width:100px;\">";
            // line 103
            echo "</div>
        </div>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['request'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 106
        echo "        <ul class=\"pagination clearfix\">";
        if (isset($context["pagination"])) { $_pagination_ = $context["pagination"]; } else { $_pagination_ = null; }
        echo $_pagination_;
        echo "</ul>
    </div>
    <div class=\"ma_bottom\"></div>
";
    }

    // line 111
    public function block_right_side($context, array $blocks = array())
    {
        // line 112
        echo "    ";
        if (isset($context["app"])) { $_app_ = $context["app"]; } else { $_app_ = null; }
        if ((!$this->getAttribute($_app_, "ajax"))) {
            // line 113
            echo "        ";
            $context["ma_menu"] = "myMoney";
            // line 114
            echo "        ";
            $this->env->loadTemplate("myaccount/menu.twig")->display($context);
            // line 115
            echo "    ";
        }
    }

    public function getTemplateName()
    {
        return "myaccount/transactions/depositd.twig";
    }

    public function isTraitable()
    {
        return false;
    }
}
