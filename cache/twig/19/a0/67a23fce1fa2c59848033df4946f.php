<?php

/* transaction/deposit.twig */
class __TwigTemplate_19a067a23fce1fa2c59848033df4946f extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->blocks = array(
            'content' => array($this, 'block_content'),
            'left_menu' => array($this, 'block_left_menu'),
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
        echo "<h1>Manage transactions</h1>
    ";
        // line 5
        $context["actionsMenu"] = "deposit";
        // line 6
        echo "    ";
        $this->env->loadTemplate("transaction/menu.twig")->display($context);
        // line 7
        echo "    <br /><br />
    <br /><br />
    <div style=\"text-align:right\">
        <a href=\"";
        // line 10
        if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array("@manageTransactionsMATA", ), "method"), "html", null, true);
        echo "\" class=\"g-button";
        if (isset($context["view"])) { $_view_ = $context["view"]; } else { $_view_ = null; }
        if ((!$_view_)) {
            echo " g-button-submit";
        }
        echo " ajax-link\">Pending</a>
        <a href=\"";
        // line 11
        if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array("@manageTransactionsMATA?view=accepted", ), "method"), "html", null, true);
        echo "\" class=\"g-button ";
        if (isset($context["view"])) { $_view_ = $context["view"]; } else { $_view_ = null; }
        if (($_view_ == "accepted")) {
            echo " g-button-submit";
        }
        echo " ajax-link\">Accepted</a>
        <a href=\"";
        // line 12
        if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array("@manageTransactionsMATA?view=rejected", ), "method"), "html", null, true);
        echo "\" class=\"g-button ";
        if (isset($context["view"])) { $_view_ = $context["view"]; } else { $_view_ = null; }
        if (($_view_ == "rejected")) {
            echo " g-button-submit";
        }
        echo " ajax-link\">Rejected</a></div>
    <br />
    <ul class=\"pagination clearfix\">";
        // line 14
        if (isset($context["pagination"])) { $_pagination_ = $context["pagination"]; } else { $_pagination_ = null; }
        echo $_pagination_;
        echo "</ul>
    <div class=\"yui3-g\" style=\"font-weight:bold;font-size:16px;\">
        <div class=\"yui3-u\" style=\"width:100px;\">Requested</div>
        <div class=\"yui3-u\" style=\"width:100px;\">User</div>
        <div class=\"yui3-u\" style=\"width:150px;\">Amount</div>
        <div class=\"yui3-u\" style=\"width:150px;\">Actions</div>
    </div>
    ";
        // line 21
        if (isset($context["requests"])) { $_requests_ = $context["requests"]; } else { $_requests_ = null; }
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($_requests_);
        foreach ($context['_seq'] as $context["_key"] => $context["request"]) {
            // line 22
            echo "    <div class=\"yui3-g\" style=\"padding:10px;background-color:#C0C0BB ;border-bottom:1px solid #cacaca;\">
        <div class=\"yui3-u\" style=\"width:100px;\">";
            // line 23
            if (isset($context["request"])) { $_request_ = $context["request"]; } else { $_request_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_request_, "created_at"), "html", null, true);
            echo "</div>
        <div class=\"yui3-u\" style=\"width:100px;\"><a href=\"";
            // line 24
            if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
            if (isset($context["request"])) { $_request_ = $context["request"]; } else { $_request_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array(("@manageUsersActions?id=" . $this->getAttribute($this->getAttribute($_request_, "User"), "id")), ), "method"), "html", null, true);
            echo "\" class=\"modal-user\" title=\"";
            if (isset($context["request"])) { $_request_ = $context["request"]; } else { $_request_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($_request_, "User"), "username"), "html", null, true);
            echo "\">";
            if (isset($context["request"])) { $_request_ = $context["request"]; } else { $_request_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($_request_, "User"), "username"), "html", null, true);
            echo "</a></div>
        <div class=\"yui3-u\" style=\"width:150px;\">";
            // line 25
            if (isset($context["request"])) { $_request_ = $context["request"]; } else { $_request_ = null; }
            if ($this->getAttribute($_request_, "amount")) {
                if (isset($context["request"])) { $_request_ = $context["request"]; } else { $_request_ = null; }
                echo twig_escape_filter($this->env, twig_currency($this->getAttribute($_request_, "amount")), "html", null, true);
            }
            echo "</div>
        <div class=\"yui3-u\" style=\"width:150px;\">
            
            ";
            // line 28
            if (isset($context["view"])) { $_view_ = $context["view"]; } else { $_view_ = null; }
            if ((!$_view_)) {
                // line 29
                echo "            <a href=\"";
                if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
                if (isset($context["request"])) { $_request_ = $context["request"]; } else { $_request_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array((("@manageTransactionsMATA?id=" . $this->getAttribute($_request_, "id")) . "&ac=accept"), ), "method"), "html", null, true);
                echo "\" title=\"Details\" class=\"g-button g-button-share modal-user\" style=\"padding:2px;height:15px;line-height:15px;\">Details</a>
            <a href=\"";
                // line 30
                if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
                if (isset($context["request"])) { $_request_ = $context["request"]; } else { $_request_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array((("@manageTransactionsMATA?id=" . $this->getAttribute($_request_, "id")) . "&ac=reject"), ), "method"), "html", null, true);
                echo "\" title=\"Are you sure you want to reject this request?\" class=\"g-button g-button-red ajax-confirm\" style=\"padding:2px;height:15px;line-height:15px;\">Reject</a>
            ";
            } else {
                // line 32
                echo "            <a href=\"";
                if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
                if (isset($context["request"])) { $_request_ = $context["request"]; } else { $_request_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array((("@manageTransactionsMATA?id=" . $this->getAttribute($_request_, "id")) . "&ac=accept&i=1"), ), "method"), "html", null, true);
                echo "\" title=\"Details\" class=\"g-button g-button-share modal-user\" style=\"padding:2px;height:15px;line-height:15px;\">Details</a>
            ";
            }
            // line 34
            echo "        </div>
    </div>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['request'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 37
        echo "    <ul class=\"pagination clearfix\">";
        if (isset($context["pagination"])) { $_pagination_ = $context["pagination"]; } else { $_pagination_ = null; }
        echo $_pagination_;
        echo "</ul>
";
    }

    // line 39
    public function block_left_menu($context, array $blocks = array())
    {
        // line 40
        echo "    ";
        if (isset($context["app"])) { $_app_ = $context["app"]; } else { $_app_ = null; }
        if ((!$this->getAttribute($_app_, "ajax"))) {
            // line 41
            echo "        ";
            $context["adm_menu"] = "transactions";
            // line 42
            echo "        ";
            $this->env->loadTemplate("inc/leftSide.twig")->display($context);
            // line 43
            echo "    ";
        }
    }

    public function getTemplateName()
    {
        return "transaction/deposit.twig";
    }

    public function isTraitable()
    {
        return false;
    }
}
