<?php

/* user/actions.twig */
class __TwigTemplate_24aa80c701ab7e0a18af097667a49bae extends Twig_Template
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
        $context["actionsMenu"] = "general";
        // line 5
        $this->env->loadTemplate("user/actionsMenu.twig")->display($context);
        // line 6
        echo "
<div style=\"padding-top:20px;\">
    ";
        // line 8
        if (isset($context["user"])) { $_user_ = $context["user"]; } else { $_user_ = null; }
        if ((!$this->getAttribute($_user_, "is_active"))) {
            // line 9
            echo "        <div class=\"error_box\"><strong>User is not activated!<br /> <a href=\"";
            if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
            if (isset($context["user"])) { $_user_ = $context["user"]; } else { $_user_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array((("@manageUsersActions?id=" . $this->getAttribute($_user_, "id")) . "&ac=activate"), ), "method"), "html", null, true);
            echo "\" class=\"ajax-modal-confirm\" title=\"Are you sure you want to activate this user?\">Click to activate user</a></strong></div>
    ";
        }
        // line 11
        echo "    ";
        if (isset($context["user"])) { $_user_ = $context["user"]; } else { $_user_ = null; }
        if (($this->getAttribute($_user_, "request_step") == "2")) {
            // line 12
            echo "        <div class=\"error_box\"><strong>User requested a merchant account!<br /> <a href=\"";
            if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
            if (isset($context["user"])) { $_user_ = $context["user"]; } else { $_user_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array((("@manageUsersActions?id=" . $this->getAttribute($_user_, "id")) . "&tab=request"), ), "method"), "html", null, true);
            echo "\" class=\"modal-ajax-link\">Click to review request</a></strong></div>
    ";
        }
        // line 14
        echo "    ";
        if (isset($context["user"])) { $_user_ = $context["user"]; } else { $_user_ = null; }
        if (($this->getAttribute($_user_, "request_step") == "3")) {
            // line 15
            echo "        <div class=\"error_box\"><strong>You approved the request, after user will pay the fixed fee his account will become automaticaly a merchant account!<br /> <a href=\"";
            if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
            if (isset($context["user"])) { $_user_ = $context["user"]; } else { $_user_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array((("@manageUsersActions?id=" . $this->getAttribute($_user_, "id")) . "&tab=general&ac=cr_req"), ), "method"), "html", null, true);
            echo "\" class=\"ajax-modal-confirm\" title=\"Are you sure you want to update this account to a merchant account?\">Click to create a merchant account now</a></strong></div>
    ";
        }
        // line 17
        echo "\t\t";
        if (isset($context["user"])) { $_user_ = $context["user"]; } else { $_user_ = null; }
        if (($this->getAttribute($_user_, "agent_request_step") == "2")) {
            // line 18
            echo "        <div class=\"error_box\"><strong>User requested an agent account!<br /> <a href=\"";
            if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
            if (isset($context["user"])) { $_user_ = $context["user"]; } else { $_user_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array((("@manageUsersActions?id=" . $this->getAttribute($_user_, "id")) . "&tab=agent_request"), ), "method"), "html", null, true);
            echo "\" class=\"modal-ajax-link\">Click to review request</a></strong></div>
    ";
        }
        // line 20
        echo "    ";
        if (isset($context["user"])) { $_user_ = $context["user"]; } else { $_user_ = null; }
        if (($this->getAttribute($_user_, "agent_request_step") == "3")) {
            // line 21
            echo "        <div class=\"error_box\"><strong>You approved the request, after user will pay the fixed fee his account will become automaticaly an agent account!<br /> <a href=\"";
            if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
            if (isset($context["user"])) { $_user_ = $context["user"]; } else { $_user_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array((("@manageUsersActions?id=" . $this->getAttribute($_user_, "id")) . "&tab=general&ac=a_req"), ), "method"), "html", null, true);
            echo "\" class=\"ajax-modal-confirm\" title=\"Are you sure you want to update this account to an agent account?\">Click to create an agent account now</a></strong></div>
    ";
        }
        // line 23
        echo "    <dl>
        <dt>Name:</dt>
        <dd>";
        // line 25
        if (isset($context["user"])) { $_user_ = $context["user"]; } else { $_user_ = null; }
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->getAttribute($_user_, "first_name")), "html", null, true);
        echo " ";
        if (isset($context["user"])) { $_user_ = $context["user"]; } else { $_user_ = null; }
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->getAttribute($_user_, "last_name")), "html", null, true);
        echo "</dd>
        <dt>Phone:</dt>
        <dd>";
        // line 27
        if (isset($context["user"])) { $_user_ = $context["user"]; } else { $_user_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_user_, "phone"), "html", null, true);
        echo "</dd>
        <dt>Username:</dt>
        <dd>";
        // line 29
        if (isset($context["user"])) { $_user_ = $context["user"]; } else { $_user_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_user_, "username"), "html", null, true);
        echo "</dd>
\t\t\t\t<dt>refID:</dt>
        <dd>";
        // line 31
        if (isset($context["user"])) { $_user_ = $context["user"]; } else { $_user_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_user_, "ref_id"), "html", null, true);
        echo "</dd>
        <dt>Email:</dt>
        <dd>";
        // line 33
        if (isset($context["user"])) { $_user_ = $context["user"]; } else { $_user_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_user_, "email"), "html", null, true);
        echo "</dd>
        <dt>User type:</dt>
        <dd>";
        // line 35
        if (isset($context["role"])) { $_role_ = $context["role"]; } else { $_role_ = null; }
        echo twig_escape_filter($this->env, twig_capitalize_string_filter($this->env, $_role_), "html", null, true);
        echo "</dd>
        ";
        // line 36
        if (isset($context["role"])) { $_role_ = $context["role"]; } else { $_role_ = null; }
        if (($_role_ == "merchant")) {
            // line 37
            echo "        ";
            // line 41
            echo "        ";
            // line 43
            echo "        <dt>Merchant account requested at:</dt>
        <dd>";
            // line 44
            if (isset($context["user"])) { $_user_ = $context["user"]; } else { $_user_ = null; }
            echo twig_escape_filter($this->env, twig_date_format_filter($this->getAttribute($_user_, "mrequest_at"), "M d Y H:i:s"), "html", null, true);
            echo "</dd>
        <dt>Merchant account approved at:</dt>
        <dd>";
            // line 46
            if (isset($context["user"])) { $_user_ = $context["user"]; } else { $_user_ = null; }
            if ($this->getAttribute($_user_, "mrequest_approved_at")) {
                if (isset($context["user"])) { $_user_ = $context["user"]; } else { $_user_ = null; }
                echo twig_escape_filter($this->env, twig_date_format_filter($this->getAttribute($_user_, "mrequest_approved_at"), "M d Y H:i:s"), "html", null, true);
            } else {
                echo " - ";
            }
            echo "</dd>
        ";
        }
        // line 48
        echo "        <dt>Refferer:</dt>
        <dd>";
        // line 49
        if (isset($context["ref"])) { $_ref_ = $context["ref"]; } else { $_ref_ = null; }
        if ($_ref_) {
            echo "<a href=\"";
            if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
            if (isset($context["ref"])) { $_ref_ = $context["ref"]; } else { $_ref_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array(("@manageUsersActions?id=" . $this->getAttribute($_ref_, "id")), ), "method"), "html", null, true);
            echo "\" class=\"modal-user\" title=\"";
            if (isset($context["ref"])) { $_ref_ = $context["ref"]; } else { $_ref_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_ref_, "username"), "html", null, true);
            echo " actions\">";
            if (isset($context["ref"])) { $_ref_ = $context["ref"]; } else { $_ref_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_ref_, "username"), "html", null, true);
            echo "</a> (";
            if (isset($context["ref"])) { $_ref_ = $context["ref"]; } else { $_ref_ = null; }
            echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->getAttribute($_ref_, "first_name")), "html", null, true);
            echo " ";
            if (isset($context["ref"])) { $_ref_ = $context["ref"]; } else { $_ref_ = null; }
            echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->getAttribute($_ref_, "last_name")), "html", null, true);
            echo ")";
        } else {
            echo "Not reffered by anyone";
        }
        echo "</dd>
        <dt>Created at:</dt>
        <dd>";
        // line 51
        if (isset($context["user"])) { $_user_ = $context["user"]; } else { $_user_ = null; }
        echo twig_escape_filter($this->env, twig_date_format_filter($this->getAttribute($_user_, "created_at"), "M d Y H:i:s"), "html", null, true);
        echo "</dd>
        <dt>Activated at:</dt>
        <dd>";
        // line 53
        if (isset($context["user"])) { $_user_ = $context["user"]; } else { $_user_ = null; }
        if ($this->getAttribute($_user_, "activated_at")) {
            if (isset($context["user"])) { $_user_ = $context["user"]; } else { $_user_ = null; }
            echo twig_escape_filter($this->env, twig_date_format_filter($this->getAttribute($_user_, "activated_at"), "M d Y H:i:s"), "html", null, true);
        } else {
            echo " - ";
        }
        echo "</dd>
        <dt>Last login:</dt>
        <dd>";
        // line 55
        if (isset($context["user"])) { $_user_ = $context["user"]; } else { $_user_ = null; }
        if ($this->getAttribute($_user_, "last_login")) {
            if (isset($context["user"])) { $_user_ = $context["user"]; } else { $_user_ = null; }
            echo twig_escape_filter($this->env, twig_date_format_filter($this->getAttribute($_user_, "last_login"), "M d Y H:i:s"), "html", null, true);
        } else {
            echo " never ";
        }
        echo "</dd>
    </dl>
</div>
";
    }

    public function getTemplateName()
    {
        return "user/actions.twig";
    }

    public function isTraitable()
    {
        return false;
    }
}
