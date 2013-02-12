<?php

/* commission/commission.twig */
class __TwigTemplate_129edb16ff92a10134705e3ea1afe621 extends Twig_Template
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
        echo "<h1>Manage Commissions</h1>
<div class=\"yui3-g\">
    <div class=\"yui3-u-1-3\">
    <h2 style=\"font-size:14px;font-weight: bold;padding-bottom:10px;\">Manage commission levels</h2>
    <a href=\"";
        // line 8
        if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array("@manageCommissions?ac=add_level", ), "method"), "html", null, true);
        echo "\" class=\"g-button g-button-share g-button-small modal-user\">Add level</a>
    <br /><br /><br />
    <ul>
    ";
        // line 11
        if (isset($context["tree"])) { $_tree_ = $context["tree"]; } else { $_tree_ = null; }
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($_tree_);
        $context['loop'] = array(
          'parent' => $context['_parent'],
          'index0' => 0,
          'index'  => 1,
          'first'  => true,
        );
        if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof Countable)) {
            $length = count($context['_seq']);
            $context['loop']['revindex0'] = $length - 1;
            $context['loop']['revindex'] = $length;
            $context['loop']['length'] = $length;
            $context['loop']['last'] = 1 === $length;
        }
        foreach ($context['_seq'] as $context["_key"] => $context["node"]) {
            // line 12
            echo "        <li style=\"padding:5px;background: #E6E4DF;margin-bottom: 2px;\">
        <div class=\"yui3-g\">
            <div class=\"yui3-u-1-3\"><strong>Level ";
            // line 14
            if (isset($context["loop"])) { $_loop_ = $context["loop"]; } else { $_loop_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_loop_, "index"), "html", null, true);
            echo ":</strong></div>
            <div class=\"yui3-u-1-3\"><span style=\"color: #29691d\">";
            // line 15
            if (isset($context["node"])) { $_node_ = $context["node"]; } else { $_node_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_node_, "commission"), "html", null, true);
            echo "%</span></div>
            <div class=\"yui3-u-1-3\">
                <a href=\"";
            // line 17
            if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
            if (isset($context["node"])) { $_node_ = $context["node"]; } else { $_node_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array(("@manageCommissions?ac=edit_level&id=" . $this->getAttribute($_node_, "id")), ), "method"), "html", null, true);
            echo "\" class=\"modal-user\" title=\"Level ";
            if (isset($context["loop"])) { $_loop_ = $context["loop"]; } else { $_loop_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_loop_, "index"), "html", null, true);
            echo "\" style=\"color: #2B6FB6\">Edit</a> | 
                <a href=\"";
            // line 18
            if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
            if (isset($context["node"])) { $_node_ = $context["node"]; } else { $_node_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array(("@manageCommissions?ac=del_level&id=" . $this->getAttribute($_node_, "id")), ), "method"), "html", null, true);
            echo "\" class=\"ajax-confirm\" title=\"Are you sure you want to delete this level commission?\" style=\"color:#A1040B\">Delete</a>
            </div>
        </div>
        </li>
    ";
            ++$context['loop']['index0'];
            ++$context['loop']['index'];
            $context['loop']['first'] = false;
            if (isset($context['loop']['length'])) {
                --$context['loop']['revindex0'];
                --$context['loop']['revindex'];
                $context['loop']['last'] = 0 === $context['loop']['revindex0'];
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['node'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 23
        echo "    </ul>
    </div>
    
    <div class=\"yui3-u-2-3\" style=\"\">
        <div style=\"margin-left:20px;\">
            <h2 style=\"font-size:14px;font-weight: bold;padding-bottom:10px;\">Manage global commissions</h2>
            <br /><br /><br />
            <ul>
                ";
        // line 40
        echo "                <li style=\"padding:5px;background: #E6E4DF;margin-bottom: 2px;\">
                <div class=\"yui3-g\">
                    <div class=\"yui3-u-1-3\"><strong>Minimum spend fee:</strong></div>
                    <div class=\"yui3-u-1-3\"><span style=\"color: #29691d\">";
        // line 43
        if (isset($context["spend"])) { $_spend_ = $context["spend"]; } else { $_spend_ = null; }
        echo twig_escape_filter($this->env, $_spend_, "html", null, true);
        echo "%</span></div>
                    <div class=\"yui3-u-1-3\" style=\"text-align:right\">
                        <a href=\"";
        // line 45
        if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array("@manageCommissions?ac=edit_sc&m=sfee", ), "method"), "html", null, true);
        echo "\" class=\"modal-user\" title=\"Minimum spend fee\" style=\"color: #2B6FB6\">Edit</a>
                    </div>
                </div>
                </li>
                <li style=\"padding:5px;background: #E6E4DF;margin-bottom: 2px;\">
                <div class=\"yui3-g\">
                    <div class=\"yui3-u-1-3\"><strong>Merchant verify fee:</strong></div>
                    <div class=\"yui3-u-1-3\"><span style=\"color: #29691d\">";
        // line 52
        if (isset($context["merchant"])) { $_merchant_ = $context["merchant"]; } else { $_merchant_ = null; }
        echo twig_escape_filter($this->env, twig_currency($_merchant_), "html", null, true);
        echo "</span></div>
                    <div class=\"yui3-u-1-3\" style=\"text-align:right\">
                        <a href=\"";
        // line 54
        if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array("@manageCommissions?ac=edit_sc&m=mfee", ), "method"), "html", null, true);
        echo "\" class=\"modal-user\" title=\"Merchant fee\" style=\"color: #2B6FB6\">Edit</a>
                    </div>
                </div>
                </li>
                <li style=\"padding:5px;background: #E6E4DF;margin-bottom: 2px;\">
                <div class=\"yui3-g\">
                    <div class=\"yui3-u-1-3\"><strong>Agent commission:</strong></div>
                    <div class=\"yui3-u-1-3\"><span style=\"color: #29691d\">";
        // line 61
        if (isset($context["oc"])) { $_oc_ = $context["oc"]; } else { $_oc_ = null; }
        echo twig_escape_filter($this->env, $_oc_, "html", null, true);
        echo "%</span></div>
                    <div class=\"yui3-u-1-3\" style=\"text-align:right\">
                        <a href=\"";
        // line 63
        if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array("@manageCommissions?ac=edit_sc&m=oc", ), "method"), "html", null, true);
        echo "\" class=\"modal-user\" title=\"Merchant commission\" style=\"color: #2B6FB6\">Edit</a>
                    </div>
                </div>
                </li>
                <li style=\"padding:5px;background: #E6E4DF;margin-bottom: 2px;\">
                <div class=\"yui3-g\">
                    <div class=\"yui3-u-1-3\"><strong>Paypal Fee:</strong></div>
                    <div class=\"yui3-u-1-3\"><span style=\"color: #29691d\">";
        // line 70
        if (isset($context["pf"])) { $_pf_ = $context["pf"]; } else { $_pf_ = null; }
        echo twig_escape_filter($this->env, $_pf_, "html", null, true);
        echo "%</span></div>
                    <div class=\"yui3-u-1-3\" style=\"text-align:right\">
                        <a href=\"";
        // line 72
        if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array("@manageCommissions?ac=edit_sc&m=pf", ), "method"), "html", null, true);
        echo "\" class=\"modal-user\" title=\"Paypal Fee\" style=\"color: #2B6FB6\">Edit</a>
                    </div>
                </div>
                </li>
                <li style=\"padding:5px;background: #E6E4DF;margin-bottom: 2px;\">
                <div class=\"yui3-g\">
                    <div class=\"yui3-u-1-3\"><strong>Payout Delay:</strong></div>
                    <div class=\"yui3-u-1-3\"><span style=\"color: #29691d\">";
        // line 79
        if (isset($context["d"])) { $_d_ = $context["d"]; } else { $_d_ = null; }
        echo twig_escape_filter($this->env, $_d_, "html", null, true);
        echo " days</span></div>
                    <div class=\"yui3-u-1-3\" style=\"text-align:right\">
                        <a href=\"";
        // line 81
        if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array("@manageCommissions?ac=edit_sc&m=d", ), "method"), "html", null, true);
        echo "\" class=\"modal-user\" title=\"Paypal Fee\" style=\"color: #2B6FB6\">Edit</a>
                    </div>
                </div>
                </li>
            </ul>
        </div>
    </div>
</div>

";
    }

    // line 91
    public function block_left_menu($context, array $blocks = array())
    {
        // line 92
        echo "    ";
        if (isset($context["app"])) { $_app_ = $context["app"]; } else { $_app_ = null; }
        if ((!$this->getAttribute($_app_, "ajax"))) {
            // line 93
            echo "        ";
            $context["adm_menu"] = "commission";
            // line 94
            echo "        ";
            $this->env->loadTemplate("inc/leftSide.twig")->display($context);
            // line 95
            echo "    ";
        }
    }

    public function getTemplateName()
    {
        return "commission/commission.twig";
    }

    public function isTraitable()
    {
        return false;
    }
}
