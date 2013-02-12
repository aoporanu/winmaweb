<?php

/* transaction/menu.twig */
class __TwigTemplate_467901ca12b5026b278cee626670a804 extends Twig_Template
{
    protected function doGetParent(array $context)
    {
        return false;
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<a href=\"";
        if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array("@manageTransactions", ), "method"), "html", null, true);
        echo "\" class=\"g-button";
        if (isset($context["actionsMenu"])) { $_actionsMenu_ = $context["actionsMenu"]; } else { $_actionsMenu_ = null; }
        if (($_actionsMenu_ == "withdraw")) {
            echo " g-button-share";
        }
        echo " ajax-link\">Withdraw requests</a>
<a href=\"";
        // line 2
        if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array("@manageTransactionsMATA", ), "method"), "html", null, true);
        echo "\" class=\"g-button";
        if (isset($context["actionsMenu"])) { $_actionsMenu_ = $context["actionsMenu"]; } else { $_actionsMenu_ = null; }
        if (($_actionsMenu_ == "deposit")) {
            echo " g-button-share";
        }
        echo " ajax-link\">Deposit requests</a>
";
    }

    public function getTemplateName()
    {
        return "transaction/menu.twig";
    }

    public function isTraitable()
    {
        return false;
    }
}
