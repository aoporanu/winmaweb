<?php

/* myaccount/myFriendshipRequests.twig */
class __TwigTemplate_03464d7375ee2888e257e7ba6da686a9 extends Twig_Template
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
    }

    // line 14
    public function block_content_page($context, array $blocks = array())
    {
        // line 15
        echo "\t<h1>My Friendship Requests</h1>
\t<div class=\"ma_top\"></div>
\t<div class=\"ma_content\">
\t<a href=\"";
        // line 18
        if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array("@myAccountMyFriends", ), "method"), "html", null, true);
        echo "\" class=\"g-button ajax-link\" style=\"min-width:10px;\">Invite Friends</a>
\t<a href=\"";
        // line 19
        if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array("@myAccountListFriendsAction", ), "method"), "html", null, true);
        echo "\" class=\"g-button ajax-link\" style=\"min-width:10px;\">Friends List</a>
\t<a href=\"";
        // line 20
        if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array("@myAccountListPendingFriends", ), "method"), "html", null, true);
        echo "\" class=\"g-button ajax-link\" style=\"min-width:10px;\">Pending Friends</a>
\t<a href=\"";
        // line 21
        if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array("@myAccountMyFriendshipRequests", ), "method"), "html", null, true);
        echo "\" class=\"g-button ajax-link g-button-submit\" style=\"min-width:10px;\">My Frienship Requests</a>
\t<br />
\t<br />
\t<div class=\"info-blue\">
\t\t<p>
\t\t\tIn this tab you can view your friendship requests
\t\t</p>
\t</div>
\t<br />
\t";
        // line 30
        if (isset($context["friends"])) { $_friends_ = $context["friends"]; } else { $_friends_ = null; }
        if ((twig_length_filter($this->env, $_friends_) == 0)) {
            // line 31
            echo "\t\t<div class=\"info-blue\">
\t\t\t<p>
\t\t\t\tYou have no new friendship requests
\t\t\t</p>
\t\t</div>
\t";
        }
        // line 37
        echo "\t
\t<br />
\t";
        // line 39
        if (isset($context["friends"])) { $_friends_ = $context["friends"]; } else { $_friends_ = null; }
        if ($_friends_) {
            // line 40
            echo "\t\t<ul class=\"pagination clearfix\">";
            if (isset($context["pagination"])) { $_pagination_ = $context["pagination"]; } else { $_pagination_ = null; }
            echo $_pagination_;
            echo "</ul>
\t\t<br />
\t\t\t<div class=\"yui3-g\" style=\"font-weight:bold;font-size:16px;border-bottom:1px solid #3079ed\">
\t\t\t\t<div class=\"yui3-u\" style=\"width:130px;\">Friend's Name</div>
\t\t\t\t<div class=\"yui3-u\" style=\"width:100px;\">Friend's Avatar</div>
\t\t\t\t<div class=\"yui3-u\" style=\"width:100px;\">Status</div>
\t\t\t\t<div class=\"yui3-u\" style=\"width:90px;\">Actions</div>
\t\t\t</div>
\t\t\t<div class=\"yui3-g\">
\t\t\t\t";
            // line 49
            if (isset($context["friends"])) { $_friends_ = $context["friends"]; } else { $_friends_ = null; }
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($_friends_);
            foreach ($context['_seq'] as $context["_key"] => $context["friend"]) {
                // line 50
                echo "\t\t\t\t<div class=\"yui3-g\" style=\"line-height:50px;padding:2px 0;\">
\t\t\t\t\t<div class=\"yui3-u\" style=\"width:130px;\">";
                // line 51
                if (isset($context["friend"])) { $_friend_ = $context["friend"]; } else { $_friend_ = null; }
                if (($this->getAttribute($_friend_, "friends_id") == 0)) {
                    echo " Unknown user ";
                } else {
                    echo " <div class=\"my_status_links\"><a href=\"/profile/";
                    if (isset($context["friend"])) { $_friend_ = $context["friend"]; } else { $_friend_ = null; }
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($_friend_, "User"), 0, array(), "array"), "username"), "html", null, true);
                    echo "\" title=\"";
                    if (isset($context["friend"])) { $_friend_ = $context["friend"]; } else { $_friend_ = null; }
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($_friend_, "User"), 0, array(), "array"), "username"), "html", null, true);
                    echo "\">";
                    if (isset($context["friend"])) { $_friend_ = $context["friend"]; } else { $_friend_ = null; }
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($_friend_, "User"), 0, array(), "array"), "username"), "html", null, true);
                    echo "</a></div> ";
                }
                echo "</div>
\t\t\t\t\t<div class=\"yui3-u\" style=\"width:100px;\">";
                // line 52
                if (isset($context["friend"])) { $_friend_ = $context["friend"]; } else { $_friend_ = null; }
                if ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($_friend_, "User"), 0, array(), "array"), "UserMedia"), 0, array(), "array"), "file_name")) {
                    echo " <a href=\"/profile/";
                    if (isset($context["friend"])) { $_friend_ = $context["friend"]; } else { $_friend_ = null; }
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($_friend_, "User"), 0, array(), "array"), "username"), "html", null, true);
                    echo "\" title=\"";
                    if (isset($context["friend"])) { $_friend_ = $context["friend"]; } else { $_friend_ = null; }
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($_friend_, "User"), 0, array(), "array"), "username"), "html", null, true);
                    echo "\"><img src=\"";
                    if (isset($context["friend"])) { $_friend_ = $context["friend"]; } else { $_friend_ = null; }
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($_friend_, "User"), 0, array(), "array"), "UserMedia"), 0, array(), "array"), "dir"), "html", null, true);
                    echo "/thumb120x67/";
                    if (isset($context["friend"])) { $_friend_ = $context["friend"]; } else { $_friend_ = null; }
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($_friend_, "User"), 0, array(), "array"), "UserMedia"), 0, array(), "array"), "file_name"), "html", null, true);
                    echo "_";
                    if (isset($context["friend"])) { $_friend_ = $context["friend"]; } else { $_friend_ = null; }
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($_friend_, "User"), 0, array(), "array"), "UserMedia"), 0, array(), "array"), "id"), "html", null, true);
                    echo ".";
                    if (isset($context["friend"])) { $_friend_ = $context["friend"]; } else { $_friend_ = null; }
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($_friend_, "User"), 0, array(), "array"), "UserMedia"), 0, array(), "array"), "ext"), "html", null, true);
                    echo "\" width=\"50\" /></a> ";
                } else {
                    echo " <a href=\"/profile/";
                    if (isset($context["friend"])) { $_friend_ = $context["friend"]; } else { $_friend_ = null; }
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($_friend_, "User"), 0, array(), "array"), "username"), "html", null, true);
                    echo "\" title=\"";
                    if (isset($context["friend"])) { $_friend_ = $context["friend"]; } else { $_friend_ = null; }
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($_friend_, "User"), 0, array(), "array"), "username"), "html", null, true);
                    echo "\"><img src=\"/uploads/users/images/no_avatar.jpg\" width=\"50\" /></a> ";
                }
                echo "</div>
\t\t\t\t\t<div class=\"yui3-u\" style=\"width:80px;\">";
                // line 53
                if (isset($context["friend"])) { $_friend_ = $context["friend"]; } else { $_friend_ = null; }
                if (($this->getAttribute($_friend_, "pending") == 0)) {
                    echo " Approved ";
                } else {
                    echo "  Pending  ";
                }
                echo "</div>
\t\t\t\t\t<div class=\"yui3-u\">
\t\t\t\t\t\t<a href=\"";
                // line 55
                if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
                if (isset($context["friend"])) { $_friend_ = $context["friend"]; } else { $_friend_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array(("@myAccountApproveFriendRequest?id=" . $this->getAttribute($_friend_, "id")), ), "method"), "html", null, true);
                echo "\" class=\"g-button g-button-share modal-normal-with-close\" title=\"Approve Friend Request\">Accept</a>&nbsp;or&nbsp;
\t\t\t\t\t\t<a href=\"";
                // line 56
                if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
                if (isset($context["friend"])) { $_friend_ = $context["friend"]; } else { $_friend_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array(("@myAccountRemovePendingRequest?id=" . $this->getAttribute($_friend_, "id")), ), "method"), "html", null, true);
                echo "\" class=\"g-button g-button-share modal-normal-with-close\" title=\"Remove Pending Request\">Decline</a>
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['friend'], $context['_parent'], $context['loop']);
            $context = array_merge($_parent, array_intersect_key($context, $_parent));
            // line 60
            echo "\t\t\t</div>
\t\t\t<ul class=\"pagination clearfix\">";
            // line 61
            if (isset($context["pagination"])) { $_pagination_ = $context["pagination"]; } else { $_pagination_ = null; }
            echo $_pagination_;
            echo "</ul>
\t\t\t<br />
\t";
        }
        // line 64
        echo "\t</div>
\t<div class=\"ma_bottom\"></div>
";
    }

    // line 67
    public function block_right_side($context, array $blocks = array())
    {
        // line 68
        echo "\t";
        if (isset($context["app"])) { $_app_ = $context["app"]; } else { $_app_ = null; }
        if ((!$this->getAttribute($_app_, "ajax"))) {
            // line 69
            echo "\t\t";
            $context["ma_menu"] = "myFriends";
            // line 70
            echo "\t\t";
            $this->env->loadTemplate("myaccount/menu.twig")->display($context);
            // line 71
            echo "\t";
        }
    }

    public function getTemplateName()
    {
        return "myaccount/myFriendshipRequests.twig";
    }

    public function isTraitable()
    {
        return false;
    }
}
