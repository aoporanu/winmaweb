<?php

/* myaccount/memberSection.twig */
class __TwigTemplate_2af470d16c00566546489a70a57dffce extends Twig_Template
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
        echo "\t";
        if (isset($context["app"])) { $_app_ = $context["app"]; } else { $_app_ = null; }
        if ((!$this->getAttribute($_app_, "ajax"))) {
            // line 5
            echo "\t\t";
            $this->env->loadTemplate("myaccount/css.twig")->display($context);
            // line 6
            echo "\t";
        }
    }

    // line 8
    public function block_js($context, array $blocks = array())
    {
        // line 9
        echo "\t";
        if (isset($context["app"])) { $_app_ = $context["app"]; } else { $_app_ = null; }
        if ((!$this->getAttribute($_app_, "ajax"))) {
            // line 10
            echo "\t\t";
            $this->env->loadTemplate("myaccount/js.twig")->display($context);
            // line 11
            echo "\t";
        }
        // line 12
        echo "    \t

\t\t
";
    }

    // line 17
    public function block_content_page($context, array $blocks = array())
    {
        // line 18
        echo "\t<h1>";
        if (isset($context["user"])) { $_user_ = $context["user"]; } else { $_user_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_user_, "username"), "html", null, true);
        echo "'s Profile</h1>
\t<div class=\"ma_top\"></div>
\t<div class=\"ma_content\">
\t\t";
        // line 21
        $this->env->loadTemplate("profile_box.twig")->display($context);
        // line 22
        echo "\t</div>
\t<div class=\"ma_bottom\"></div>
\t<br/>
\t<div class=\"ma_top\"></div>
\t<div class=\"ma_content\">
\t\t<div style=\"padding: 15px;\">
\t\t\t<div class=\"my_status\">MY STATUS</div>
\t\t\t<div style=\"float: left; padding-left: 5px;\">
\t\t\t\t<form action=\"\" method=\"post\">
\t\t\t\t\t<input type=\"text\" name=\"my_status\" value=\"";
        // line 31
        if (isset($context["user"])) { $_user_ = $context["user"]; } else { $_user_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_user_, "my_status"), "html", null, true);
        echo "\" style=\"height: 23px; width: 420px;\" />
\t\t\t\t\t<input type=\"submit\" value=\"Save\" />
\t\t\t\t</form>
\t\t\t</div>
\t\t\t<div style=\"clear: both;\"></div>
\t\t\t<div style=\"padding: 10px;\">
\t\t\t\t<div class=\"my_status_links\">
\t\t\t\t\t<a href=\"";
        // line 38
        if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array("@myAccountEdit", ), "method"), "html", null, true);
        echo "\">Edit profile</a>
\t\t\t\t\t<br/>
\t\t\t\t\t<a href=\"";
        // line 40
        if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array("@myAccountEdit?ac=photo", ), "method"), "html", null, true);
        echo "\">Change profile picture</a>
\t\t\t\t</div>
\t\t\t\t<div class=\"my_status_links\">
\t\t\t\t\t<a href=\"";
        // line 43
        if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array("@myAccountMyFriends", ), "method"), "html", null, true);
        echo "\">Invite friends</a>
\t\t\t\t\t<br />
\t\t\t\t\t<a href=\"";
        // line 45
        if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array("@myAccountListFriendsAction", ), "method"), "html", null, true);
        echo "\">My friends</a>
\t\t\t\t</div>
\t\t\t\t<div class=\"my_status_links\">
\t\t\t\t\t<a href=\"";
        // line 48
        if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array("@myAccountSendMessage", ), "method"), "html", null, true);
        echo "\">Write message</a>
\t\t\t\t\t<br/>
\t\t\t\t\t<a href=\"";
        // line 50
        if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array("@myAccountReceivedMessages", ), "method"), "html", null, true);
        echo "\">View your inbox</a>
\t\t\t\t</div>
\t\t\t\t<div style=\"clear: both;\"></div>
\t\t\t</div>
\t\t</div>
\t</div>
\t<div class=\"ma_bottom\"></div>
\t<br />
\t";
        // line 58
        $this->env->loadTemplate("myaccount/profile_products.twig")->display($context);
    }

    // line 60
    public function block_right_side($context, array $blocks = array())
    {
        // line 61
        echo "\t";
        if (isset($context["app"])) { $_app_ = $context["app"]; } else { $_app_ = null; }
        if ((!$this->getAttribute($_app_, "ajax"))) {
            // line 62
            echo "\t\t";
            $context["ma_menu"] = "memberSection";
            // line 63
            echo "\t\t";
            $this->env->loadTemplate("myaccount/menu.twig")->display($context);
            // line 64
            echo "\t";
        }
    }

    public function getTemplateName()
    {
        return "myaccount/memberSection.twig";
    }

    public function isTraitable()
    {
        return false;
    }
}
