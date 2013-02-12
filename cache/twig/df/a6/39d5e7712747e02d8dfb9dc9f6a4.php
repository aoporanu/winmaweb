<?php

/* myaccount/myFriends.twig */
class __TwigTemplate_dfa639d5e7712747e02d8dfb9dc9f6a4 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->blocks = array(
            'page_title' => array($this, 'block_page_title'),
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
    public function block_page_title($context, array $blocks = array())
    {
        echo "MyFriends :: DailyDeals";
    }

    // line 6
    public function block_css($context, array $blocks = array())
    {
        // line 7
        echo "\t";
        if (isset($context["app"])) { $_app_ = $context["app"]; } else { $_app_ = null; }
        if ((!$this->getAttribute($_app_, "ajax"))) {
            // line 8
            echo "\t\t";
            $this->env->loadTemplate("myaccount/css.twig")->display($context);
            // line 9
            echo "\t";
        }
    }

    // line 11
    public function block_js($context, array $blocks = array())
    {
        // line 12
        echo "\t";
        if (isset($context["app"])) { $_app_ = $context["app"]; } else { $_app_ = null; }
        if ((!$this->getAttribute($_app_, "ajax"))) {
            // line 13
            echo "\t\t";
            $this->env->loadTemplate("myaccount/js.twig")->display($context);
            // line 14
            echo "\t";
        }
    }

    // line 17
    public function block_content_page($context, array $blocks = array())
    {
        // line 18
        echo "\t<h1>My Friends</h1>
\t<div class=\"ma_top\"></div>
\t<div class=\"ma_content\">
\t\t<a href=\"";
        // line 21
        if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array("@myAccountMyFriends", ), "method"), "html", null, true);
        echo "\" class=\"g-button g-button-submit ajax-link\" style=\"min-width:10px;\">Invite Friends</a>
\t\t<a href=\"";
        // line 22
        if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array("@myAccountListFriendsAction", ), "method"), "html", null, true);
        echo "\" class=\"g-button ajax-link\" style=\"min-width:10px;\">Friends List</a>
\t\t<a href=\"";
        // line 23
        if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array("@myAccountListPendingFriends", ), "method"), "html", null, true);
        echo "\" class=\"g-button ajax-link\" style=\"min-width:10px;\">Pending Friends</a>
\t\t<a href=\"";
        // line 24
        if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array("@myAccountMyFriendshipRequests", ), "method"), "html", null, true);
        echo "\" class=\"g-button ajax-link\" style=\"min-width:10px;\">My Frienship Requests</a>
\t\t<br />
\t\t<br />
\t\t<div class=\"info-blue\">
\t\t\t<p>
\t\t\t\tIn the My Friends section you can invite, view the friendship invites other users sent to you, view your pending requests and view your entire friends list.
\t\t\t</p>
\t\t\t";
        // line 31
        if (isset($context["message"])) { $_message_ = $context["message"]; } else { $_message_ = null; }
        if ($_message_) {
            // line 32
            echo "\t\t\t\t<div class=\"error_box\">
                    ";
            // line 33
            if (isset($context["message"])) { $_message_ = $context["message"]; } else { $_message_ = null; }
            echo twig_escape_filter($this->env, $_message_, "html", null, true);
            echo "
                </div>
\t\t\t";
        }
        // line 36
        echo "\t\t</div>
\t\t<br /><br />
\t\t";
        // line 38
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        if ($this->getAttribute($_form_, "errors")) {
            // line 39
            echo "\t\t    <div class=\"error_box\"><strong>There were errors - please verify all fields for errors</strong></div>
\t\t    ";
            // line 40
            if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute($_form_, "errors"));
            foreach ($context['_seq'] as $context["_key"] => $context["error"]) {
                // line 41
                echo "\t\t    \t<div class=\"error_box\"><strong>";
                if (isset($context["error"])) { $_error_ = $context["error"]; } else { $_error_ = null; }
                echo twig_escape_filter($this->env, $_error_, "html", null, true);
                echo "</strong></div>
\t\t    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['error'], $context['_parent'], $context['loop']);
            $context = array_merge($_parent, array_intersect_key($context, $_parent));
            // line 43
            echo "\t\t";
        }
        // line 44
        echo "\t\t";
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        if ($this->getAttribute($_form_, "success")) {
            // line 45
            echo "\t\t    <div class=\"infotip\"><strong>Your friendship invitation was sent. He will accept or reject from his panel.</strong></div>
\t\t";
        }
        // line 47
        echo "\t\t<form enctype=\"application/x-www-form-urlencoded\" action=\"";
        if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array("@myAccountMyFriends", ), "method"), "html", null, true);
        echo "\" method=\"post\">
\t\t\t<div class=\"form-global clearfix\">
\t\t\t\t<div class=\"label\"><label for=\"users\">Username:</label></div>
\t\t\t\t<div class=\"input input_big\">
\t\t\t\t\t";
        // line 51
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "input", array("users", $this->getAttribute($this->getAttribute($_form_, "values"), "users"), ), "method"), "html", null, true);
        echo "
\t\t\t\t\t";
        // line 52
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "errors", array($this->getAttribute($this->getAttribute($_form_, "errors"), "users"), ), "method"), "html", null, true);
        echo "
\t\t\t\t</div>
\t\t\t\t<div class=\"form-global clearfix\">
\t\t\t\t\t<div class=\"label\"><label>&nbsp;</label></div>
\t\t\t\t\t<div class=\"left\"><input type=\"submit\" class=\"g-button g-button-submit\" value=\"Invite Friend\" /></div>
\t\t\t\t</div>
\t\t\t</div>
\t\t</form>
       <br />
       <br />
       <div class=\"clearfix\"></div>
\t</div>
\t<div class=\"ma_bottom\"></div>
\t<script type=\"text/javascript\">
\t\t\$('#users').autocomplete(\"/my-account/autocomplete-user\");
\t</script>
\t";
    }

    // line 69
    public function block_right_side($context, array $blocks = array())
    {
        // line 70
        echo "\t";
        if (isset($context["app"])) { $_app_ = $context["app"]; } else { $_app_ = null; }
        if ((!$this->getAttribute($_app_, "ajax"))) {
            // line 71
            echo "\t\t";
            $context["ma_menu"] = "myFriends";
            // line 72
            echo "\t\t";
            $this->env->loadTemplate("myaccount/menu.twig")->display($context);
            // line 73
            echo "\t";
        }
    }

    public function getTemplateName()
    {
        return "myaccount/myFriends.twig";
    }

    public function isTraitable()
    {
        return false;
    }
}
