<?php

/* user/actionsMenu.twig */
class __TwigTemplate_33a91134683214df53af6cc3b8b3e95c extends Twig_Template
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
        if (isset($context["userId"])) { $_userId_ = $context["userId"]; } else { $_userId_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array((("@manageUsersActions?id=" . $_userId_) . "&tab=general"), ), "method"), "html", null, true);
        echo "\" class=\"g-button";
        if (isset($context["actionsMenu"])) { $_actionsMenu_ = $context["actionsMenu"]; } else { $_actionsMenu_ = null; }
        if (($_actionsMenu_ == "general")) {
            echo " g-button-share";
        }
        echo " modal-ajax-link\">General</a>
<a href=\"";
        // line 2
        if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
        if (isset($context["userId"])) { $_userId_ = $context["userId"]; } else { $_userId_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array((("@manageUsersActions?id=" . $_userId_) . "&tab=edit"), ), "method"), "html", null, true);
        echo "\" class=\"g-button";
        if (isset($context["actionsMenu"])) { $_actionsMenu_ = $context["actionsMenu"]; } else { $_actionsMenu_ = null; }
        if (($_actionsMenu_ == "edit")) {
            echo " g-button-share";
        }
        echo " modal-ajax-link\">Edit</a>
";
        // line 5
        if (isset($context["user"])) { $_user_ = $context["user"]; } else { $_user_ = null; }
        if ((($this->getAttribute($_user_, "request_step") == "2") || ($this->getAttribute($_user_, "request_step") == "3"))) {
            echo "<a href=\"";
            if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
            if (isset($context["userId"])) { $_userId_ = $context["userId"]; } else { $_userId_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array((("@manageUsersActions?id=" . $_userId_) . "&tab=request"), ), "method"), "html", null, true);
            echo "\" class=\"g-button g-button-red modal-ajax-link\">Review request merchant account</a>";
        }
        // line 6
        if (isset($context["user"])) { $_user_ = $context["user"]; } else { $_user_ = null; }
        if ((($this->getAttribute($_user_, "agent_request_step") == "2") || ($this->getAttribute($_user_, "agent_request_step") == "3"))) {
            echo "<a href=\"";
            if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
            if (isset($context["userId"])) { $_userId_ = $context["userId"]; } else { $_userId_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array((("@manageUsersActions?id=" . $_userId_) . "&tab=agent_request"), ), "method"), "html", null, true);
            echo "\" class=\"g-button g-button-red modal-ajax-link\">Review agent account request</a>";
        }
        // line 7
        echo "<a href=\"";
        if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
        if (isset($context["userId"])) { $_userId_ = $context["userId"]; } else { $_userId_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array((("@manageUsersActions?id=" . $_userId_) . "&tab=transactions"), ), "method"), "html", null, true);
        echo "\" class=\"g-button";
        if (isset($context["actionsMenu"])) { $_actionsMenu_ = $context["actionsMenu"]; } else { $_actionsMenu_ = null; }
        if (($_actionsMenu_ == "transactions")) {
            echo " g-button-share";
        }
        echo " modal-ajax-link\">Transactions</a>
<a href=\"";
        // line 8
        if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
        if (isset($context["userId"])) { $_userId_ = $context["userId"]; } else { $_userId_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array((("@manageUsersActions?id=" . $_userId_) . "&tab=statistics"), ), "method"), "html", null, true);
        echo "\" class=\"g-button";
        if (isset($context["actionsMenu"])) { $_actionsMenu_ = $context["actionsMenu"]; } else { $_actionsMenu_ = null; }
        if (($_actionsMenu_ == "statistics")) {
            echo " g-button-share";
        }
        echo " modal-ajax-link\">Statistics</a>
";
        // line 9
        if (isset($context["role"])) { $_role_ = $context["role"]; } else { $_role_ = null; }
        if (($_role_ == "merchant")) {
            echo "<a href=\"";
            if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
            if (isset($context["userId"])) { $_userId_ = $context["userId"]; } else { $_userId_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array((("@manageUsersActions?id=" . $_userId_) . "&tab=company"), ), "method"), "html", null, true);
            echo "\" class=\"g-button";
            if (isset($context["actionsMenu"])) { $_actionsMenu_ = $context["actionsMenu"]; } else { $_actionsMenu_ = null; }
            if (($_actionsMenu_ == "company")) {
                echo " g-button-share";
            }
            echo " modal-ajax-link\">Company</a>";
        }
    }

    public function getTemplateName()
    {
        return "user/actionsMenu.twig";
    }

    public function isTraitable()
    {
        return false;
    }
}
