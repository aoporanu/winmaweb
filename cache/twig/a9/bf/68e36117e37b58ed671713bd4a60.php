<?php

/* myaccount/messenger/received-messages.twig */
class __TwigTemplate_a9bf68e36117e37b58ed671713bd4a60 extends Twig_Template
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
        // line 2
        $context["forms"] = $this->env->loadTemplate("/forms/forms.twig");
        $this->getParent($context)->display($context, array_merge($this->blocks, $blocks));
    }

    // line 4
    public function block_css($context, array $blocks = array())
    {
        // line 5
        echo "\t";
        if (isset($context["app"])) { $_app_ = $context["app"]; } else { $_app_ = null; }
        if ((!$this->getAttribute($_app_, "ajax"))) {
            // line 6
            echo "\t\t";
            $this->env->loadTemplate("myaccount/css.twig")->display($context);
            // line 7
            echo "\t";
        }
    }

    // line 9
    public function block_js($context, array $blocks = array())
    {
        // line 10
        echo "\t";
        if (isset($context["app"])) { $_app_ = $context["app"]; } else { $_app_ = null; }
        if ((!$this->getAttribute($_app_, "ajax"))) {
            // line 11
            echo "\t\t";
            $this->env->loadTemplate("myaccount/js.twig")->display($context);
            // line 12
            echo "\t";
        }
    }

    // line 15
    public function block_content_page($context, array $blocks = array())
    {
        // line 16
        echo "\t<h1>Received Messages</h1>
\t<div class=\"ma_top\"></div>
\t<div class=\"ma_content\">
\t\t<a href=\"";
        // line 19
        if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array("@myAccountReceivedMessages", ), "method"), "html", null, true);
        echo "\" class=\"g-button ajax-link g-button-submit\" style=\"min-width:10px;\">My Received Messages</a>
\t\t<a href=\"";
        // line 20
        if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array("@myAccountSentMessages", ), "method"), "html", null, true);
        echo "\" class=\"g-button ajax-link\" style=\"min-width:10px;\">My Sent Messages</a>
\t\t<a href=\"";
        // line 21
        if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array("@myAccountSendMessage", ), "method"), "html", null, true);
        echo "\" class=\"g-button ajax-link\" style=\"min-width:10px;\">Send Message</a>
\t\t<br />
\t\t<br />
\t\t";
        // line 24
        if (isset($context["messages"])) { $_messages_ = $context["messages"]; } else { $_messages_ = null; }
        if ($_messages_) {
            // line 25
            echo "\t\t\t<ul class=\"pagination clearfix\">";
            if (isset($context["pagination"])) { $_pagination_ = $context["pagination"]; } else { $_pagination_ = null; }
            echo $_pagination_;
            echo "</ul>
\t\t\t<div class=\"yui3-g\" style=\"font-weight:bold;font-size:16px;border-bottom:1px solid #3079ed\">
\t\t\t\t<div class=\"yui3-u\" style=\"width:80px;\">Date</div>
\t\t\t\t<div class=\"yui3-u\" style=\"width:300px;\">Subject</div>
\t\t\t\t<div class=\"yui3-u\" style=\"width:100px;\">From</div>
\t\t\t\t<div class=\"yui3-u\" style=\"width:50px;\">Actions</div>
\t\t\t</div>
\t\t\t";
            // line 32
            if (isset($context["messages"])) { $_messages_ = $context["messages"]; } else { $_messages_ = null; }
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($_messages_);
            foreach ($context['_seq'] as $context["_key"] => $context["message"]) {
                // line 33
                echo "\t\t\t\t<div class=\"yui3-g\" style=\"padding:5px 0;margin-bottom:2px;border-bottom:1px solid #3079ed;\">
\t\t\t\t<div class=\"yui3-u\" style=\"width:80px;\">";
                // line 34
                if (isset($context["message"])) { $_message_ = $context["message"]; } else { $_message_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($_message_, "created"), "html", null, true);
                echo "</div>
\t\t\t\t<div class=\"yui3-u \" style=\"width:300px;";
                // line 35
                if (isset($context["message"])) { $_message_ = $context["message"]; } else { $_message_ = null; }
                if (($this->getAttribute($_message_, "read") == 0)) {
                    echo " font-weight:600; text-decoration: none; ";
                } else {
                    echo " font-weight: 400; text-decoration: none; ";
                }
                echo "\"><a class=\"received-message-link\" href=\"";
                if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
                if (isset($context["message"])) { $_message_ = $context["message"]; } else { $_message_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array(("@myAccountGetMessageById?id=" . $this->getAttribute($_message_, "id")), ), "method"), "html", null, true);
                echo "\">";
                if (isset($context["message"])) { $_message_ = $context["message"]; } else { $_message_ = null; }
                if ($this->getAttribute($_message_, "subject")) {
                    echo " ";
                    if (isset($context["message"])) { $_message_ = $context["message"]; } else { $_message_ = null; }
                    echo twig_escape_filter($this->env, $this->getAttribute($_message_, "subject"), "html", null, true);
                    echo " ";
                } else {
                    echo " - ";
                }
                echo "</a></div>
\t\t\t\t<div class=\"yui3-u\" style=\"width:100px\">";
                // line 36
                if (isset($context["message"])) { $_message_ = $context["message"]; } else { $_message_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($_message_, "User"), 0, array(), "array"), "username"), "html", null, true);
                echo "</div>
\t\t\t\t<div class=\"yui3-u\" style=\"width:90px;\">
\t\t\t\t\t<a href=\"";
                // line 38
                if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
                if (isset($context["message"])) { $_message_ = $context["message"]; } else { $_message_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array(("@myAccountReceiverDeleteMessage?id=" . $this->getAttribute($_message_, "id")), ), "method"), "html", null, true);
                echo "\"  class=\"g-button g-button-share modal-normal\" title=\"Delete Message\"  style=\"padding:2px;height:15px;line-height:15px;\">Delete</a>
\t\t\t\t</div>
\t\t\t</div>
\t\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['message'], $context['_parent'], $context['loop']);
            $context = array_merge($_parent, array_intersect_key($context, $_parent));
            // line 42
            echo "\t\t\t<ul class=\"pagination clearfix\">";
            if (isset($context["pagination"])) { $_pagination_ = $context["pagination"]; } else { $_pagination_ = null; }
            echo $_pagination_;
            echo "</ul>
\t\t";
        } else {
            // line 44
            echo "\t\t\t<div class=\"info-blue\">
\t\t\t\t<p>You have no received messages</p>
\t\t\t</div>
\t\t";
        }
        // line 48
        echo "       <br />
       <br />
\t</div>
\t<div style=\"background: url(/images/site/myaccount_bottom.png) no-repeat scroll 0 0 transparent;height: 9px;width: 623px;\"></div>
";
    }

    // line 54
    public function block_right_side($context, array $blocks = array())
    {
        // line 55
        echo "\t";
        if (isset($context["app"])) { $_app_ = $context["app"]; } else { $_app_ = null; }
        if ((!$this->getAttribute($_app_, "ajax"))) {
            // line 56
            echo "\t\t";
            $context["ma_menu"] = "myMessenger";
            // line 57
            echo "\t\t";
            $this->env->loadTemplate("myaccount/menu.twig")->display($context);
            // line 58
            echo "\t";
        }
    }

    public function getTemplateName()
    {
        return "myaccount/messenger/received-messages.twig";
    }

    public function isTraitable()
    {
        return false;
    }
}
