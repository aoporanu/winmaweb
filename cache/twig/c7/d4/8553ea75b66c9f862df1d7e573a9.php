<?php

/* inc/leftSide.twig */
class __TwigTemplate_c7d48553ea75b66c9f862df1d7e573a9 extends Twig_Template
{
    protected function doGetParent(array $context)
    {
        return false;
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<div class=\"acc_info\">
    <ul>
        <li>Welcome, Admin</li>
        <li><a href=\"/\" target=\"_blank\">Go to site</a></li>
        ";
        // line 6
        echo "        <li><a href=\"/logout\">Logout</a></li>
    </ul>
    </div>
    <div id=\"sidebar\" class=\"profile_actions\">
        <ul id=\"main-nav\">  <!-- Accordion Menu -->
            <li>
                <a class=\"nav-top-item no-submenu";
        // line 12
        if (isset($context["adm_menu"])) { $_adm_menu_ = $context["adm_menu"]; } else { $_adm_menu_ = null; }
        if (($_adm_menu_ == "users")) {
            echo " current";
        }
        echo "\" href=\"";
        if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array("@manageUsers", ), "method"), "html", null, true);
        echo "\" style=\"padding-right: 15px;\">Manage Users</a>
            </li>
            <li>
                <a class=\"nav-top-item no-submenu";
        // line 15
        if (isset($context["adm_menu"])) { $_adm_menu_ = $context["adm_menu"]; } else { $_adm_menu_ = null; }
        if (($_adm_menu_ == "merchants")) {
            echo " current";
        }
        echo "\" href=\"";
        if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array("@manageMerchants", ), "method"), "html", null, true);
        echo "\" style=\"padding-right: 15px;\">Agents/Merchants</a>
            </li>
            <li>
                <a class=\"nav-top-item no-submenu";
        // line 18
        if (isset($context["adm_menu"])) { $_adm_menu_ = $context["adm_menu"]; } else { $_adm_menu_ = null; }
        if (($_adm_menu_ == "commission")) {
            echo " current";
        }
        echo "\" href=\"";
        if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array("@manageCommissions", ), "method"), "html", null, true);
        echo "\" style=\"padding-right: 15px;\">Manage Commissions</a>
            </li>
            ";
        // line 23
        echo "            <li>
            <a class=\"nav-top-item";
        // line 24
        if (isset($context["adm_menu"])) { $_adm_menu_ = $context["adm_menu"]; } else { $_adm_menu_ = null; }
        if (($_adm_menu_ == "transactions")) {
            echo " current";
        }
        echo "\" href=\"";
        if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array("@manageTransactions", ), "method"), "html", null, true);
        echo "\" style=\"padding-right: 15px;\">Manage Transactions</a>
            </li>
            ";
        // line 29
        echo "            <li>
                <a class=\"nav-top-item";
        // line 30
        if (isset($context["adm_menu"])) { $_adm_menu_ = $context["adm_menu"]; } else { $_adm_menu_ = null; }
        if (($_adm_menu_ == "bank")) {
            echo " current";
        }
        echo "\" href=\"";
        if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array("@manageBank", ), "method"), "html", null, true);
        echo "\" style=\"padding-right: 15px;\">Manage Bank</a>
            </li>
            ";
        // line 35
        echo "            <li>
                <a class=\"nav-top-item";
        // line 36
        if (isset($context["adm_menu"])) { $_adm_menu_ = $context["adm_menu"]; } else { $_adm_menu_ = null; }
        if (($_adm_menu_ == "products")) {
            echo " current";
        }
        echo "\" href=\"";
        if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array("@manageProducts", ), "method"), "html", null, true);
        echo "\" style=\"padding-right: 15px;\">Deal Offers</a>
            </li>
            ";
        // line 41
        echo "            ";
        // line 44
        echo "            ";
        // line 47
        echo "            ";
        // line 50
        echo "\t\t\t\t\t\t<li>
\t\t\t\t\t\t\t\t<a class=\"nav-top-item";
        // line 51
        if (isset($context["adm_menu"])) { $_adm_menu_ = $context["adm_menu"]; } else { $_adm_menu_ = null; }
        if (($_adm_menu_ == "my_network")) {
            echo " current";
        }
        echo "\" href=\"";
        if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array("@myNetwork", ), "method"), "html", null, true);
        echo "\" style=\"padding-right: 15px;\">My Network Links</a>
\t\t\t\t\t\t</li>
        </ul>
</div>";
    }

    public function getTemplateName()
    {
        return "inc/leftSide.twig";
    }

    public function isTraitable()
    {
        return false;
    }
}
