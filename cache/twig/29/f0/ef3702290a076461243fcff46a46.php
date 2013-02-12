<?php

/* user/show.twig */
class __TwigTemplate_29f0ef3702290a076461243fcff46a46 extends Twig_Template
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
        echo "<h1>Manage users</h1>
<div class=\"clearfix\">
    <form method=\"post\" action=\"";
        // line 6
        if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array("@manageUsers?search=1", ), "method"), "html", null, true);
        echo "\">
    <div class=\"form-global clearfix\">
        <div class=\"input\"><input type=\"text\" name=\"squery\" id=\"squery\" value=\"";
        // line 8
        if (isset($context["sq"])) { $_sq_ = $context["sq"]; } else { $_sq_ = null; }
        echo twig_escape_filter($this->env, $_sq_, "html", null, true);
        echo "\" /></div>
        <input type=\"submit\" class=\"g-button g-button-submit ajax-search-submit\" value=\"Search\" />
    </div>
    </form>
</div>
    <a href=\"";
        // line 13
        if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array("@manageUsers", ), "method"), "html", null, true);
        echo "\" class=\"g-button";
        if (isset($context["activeMenu"])) { $_activeMenu_ = $context["activeMenu"]; } else { $_activeMenu_ = null; }
        if (($_activeMenu_ == "")) {
            echo " g-button-share";
        }
        echo " ajax-link\">All</a>
    <a href=\"";
        // line 14
        if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array("@manageUsers?show=normal", ), "method"), "html", null, true);
        echo "\" class=\"g-button";
        if (isset($context["activeMenu"])) { $_activeMenu_ = $context["activeMenu"]; } else { $_activeMenu_ = null; }
        if (($_activeMenu_ == "normal")) {
            echo " g-button-share";
        }
        echo " ajax-link\">Normal users</a>
    <a href=\"";
        // line 15
        if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array("@manageUsers?show=merchant", ), "method"), "html", null, true);
        echo "\" class=\"g-button";
        if (isset($context["activeMenu"])) { $_activeMenu_ = $context["activeMenu"]; } else { $_activeMenu_ = null; }
        if (($_activeMenu_ == "merchant")) {
            echo " g-button-share";
        }
        echo " ajax-link\">Agents/Merchants</a>
    <a href=\"";
        // line 16
        if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array("@manageUsers?show=do", ), "method"), "html", null, true);
        echo "\" class=\"g-button";
        if (isset($context["activeMenu"])) { $_activeMenu_ = $context["activeMenu"]; } else { $_activeMenu_ = null; }
        if (($_activeMenu_ == "do")) {
            echo " g-button-share";
        }
        echo " ajax-link\">Deal owners</a>
    <a href=\"";
        // line 17
        if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array("@manageUsers?show=admin", ), "method"), "html", null, true);
        echo "\" class=\"g-button";
        if (isset($context["activeMenu"])) { $_activeMenu_ = $context["activeMenu"]; } else { $_activeMenu_ = null; }
        if (($_activeMenu_ == "admin")) {
            echo " g-button-share";
        }
        echo " ajax-link\">Admins</a>
    <a href=\"";
        // line 18
        if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array("@manageUsers?show=notactivated", ), "method"), "html", null, true);
        echo "\" class=\"g-button";
        if (isset($context["activeMenu"])) { $_activeMenu_ = $context["activeMenu"]; } else { $_activeMenu_ = null; }
        if (($_activeMenu_ == "notactivated")) {
            echo " g-button-share";
        } else {
            echo " g-button-red";
        }
        echo " ajax-link\">Not Activated</a>
    <a href=\"";
        // line 19
        if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array("@manageUsers?show=email_list", ), "method"), "html", null, true);
        echo "\" class=\"g-button\">Emails List</a>
    <ul class=\"pagination clearfix\">";
        // line 20
        if (isset($context["pagination"])) { $_pagination_ = $context["pagination"]; } else { $_pagination_ = null; }
        echo $_pagination_;
        echo "</ul>
    <table cellspacing=\"0\" cellpadding=\"0\" border=\"0\" style=\"width: 100%\">
        <tr class=\"th-class alt-row\">
            ";
        // line 24
        echo "            <th style=\"width: 50%;\"><a class=\"href-link \" href=\"#\">username</a></th>
            <th style=\"width: 50%;\"><a class=\"href-link \" href=\"#\">email</a></th>
            <th align=\"center\" style=\"width: 414px;\">action</th>
        </tr>
    ";
        // line 28
        if (isset($context["users"])) { $_users_ = $context["users"]; } else { $_users_ = null; }
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($_users_);
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
        foreach ($context['_seq'] as $context["_key"] => $context["user"]) {
            // line 29
            echo "        <tr";
            if (isset($context["loop"])) { $_loop_ = $context["loop"]; } else { $_loop_ = null; }
            if ((0 == $this->getAttribute($_loop_, "index") % 2)) {
                echo " class=\"tr-even\"";
            } else {
                echo " class=\"tr-odd\"";
            }
            echo ">
\t\t\t\t\t\t<td style=\"margin-bottom:5px;padding: 5px 2px;\" nowrap>";
            // line 30
            if (isset($context["user"])) { $_user_ = $context["user"]; } else { $_user_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_user_, "username"), "html", null, true);
            if (isset($context["user"])) { $_user_ = $context["user"]; } else { $_user_ = null; }
            if ($this->getAttribute($_user_, "is_banned")) {
                echo " <span class=\"label2 label-important\">banned</span>";
            }
            if (isset($context["user"])) { $_user_ = $context["user"]; } else { $_user_ = null; }
            if ($this->getAttribute($_user_, "is_do")) {
                echo " <span class=\"label2 label-info\">deal owner</span>";
            }
            if (isset($context["user"])) { $_user_ = $context["user"]; } else { $_user_ = null; }
            if ((($this->getAttribute($_user_, "rolename") == "AGENT") || ($this->getAttribute($_user_, "agent_request_step") == "100"))) {
                echo " <span class=\"label2 label-info\" style=\"background-color: #888;\">agent</span>";
            }
            echo "</td>
            <td style=\"margin-bottom:5px;padding: 5px 2px;\">";
            // line 31
            if (isset($context["user"])) { $_user_ = $context["user"]; } else { $_user_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_user_, "email"), "html", null, true);
            echo "</td>
            <td style=\"margin-bottom:5px;padding: 5px 0px;\" nowrap>
\t\t\t\t\t\t\t\t";
            // line 36
            echo "                <a href=\"";
            if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
            if (isset($context["activeMenu"])) { $_activeMenu_ = $context["activeMenu"]; } else { $_activeMenu_ = null; }
            if (isset($context["user"])) { $_user_ = $context["user"]; } else { $_user_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array(((("@manageUsers?show=" . $_activeMenu_) . "&ac=ban&uid=") . $this->getAttribute($_user_, "id")), ), "method"), "html", null, true);
            echo "\" class=\"g-button g-button-red ajax-confirm g-button-small\" title=\"Are you sure?\">";
            if (isset($context["user"])) { $_user_ = $context["user"]; } else { $_user_ = null; }
            if ($this->getAttribute($_user_, "is_banned")) {
                echo "unban";
            } else {
                echo "ban";
            }
            echo "</a>
                <a href=\"";
            // line 37
            if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
            if (isset($context["user"])) { $_user_ = $context["user"]; } else { $_user_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array(("@manageUsersActions?id=" . $this->getAttribute($_user_, "id")), ), "method"), "html", null, true);
            echo "\" class=\"g-button g-button-share modal-user g-button-small\" title=\"";
            if (isset($context["user"])) { $_user_ = $context["user"]; } else { $_user_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_user_, "username"), "html", null, true);
            echo " actions\">actions</a>
            </td>
        </tr>
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
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['user'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 41
        echo "    </table>
    <ul class=\"pagination clearfix\">";
        // line 42
        if (isset($context["pagination"])) { $_pagination_ = $context["pagination"]; } else { $_pagination_ = null; }
        echo $_pagination_;
        echo "</ul>
";
    }

    // line 44
    public function block_left_menu($context, array $blocks = array())
    {
        // line 45
        echo "    ";
        if (isset($context["app"])) { $_app_ = $context["app"]; } else { $_app_ = null; }
        if ((!$this->getAttribute($_app_, "ajax"))) {
            // line 46
            echo "        ";
            $context["adm_menu"] = "users";
            // line 47
            echo "        ";
            $this->env->loadTemplate("inc/leftSide.twig")->display($context);
            // line 48
            echo "    ";
        }
    }

    public function getTemplateName()
    {
        return "user/show.twig";
    }

    public function isTraitable()
    {
        return false;
    }
}
