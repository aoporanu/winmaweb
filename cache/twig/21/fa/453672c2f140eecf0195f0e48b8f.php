<?php

/* myaccount/messenger/send-message.twig */
class __TwigTemplate_21fa453672c2f140eecf0195f0e48b8f extends Twig_Template
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
        echo "\t<h1>My Messages</h1>
\t<div class=\"ma_top\"></div>
\t<div class=\"ma_content\">
\t\t<a href=\"";
        // line 18
        if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array("@myAccountReceivedMessages", ), "method"), "html", null, true);
        echo "\" class=\"g-button ajax-link\" style=\"min-width:10px;\">My Received Messages</a>
\t\t<a href=\"";
        // line 19
        if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array("@myAccountSentMessages", ), "method"), "html", null, true);
        echo "\" class=\"g-button ajax-link\" style=\"min-width:10px;\">My Sent Messages</a>
\t\t<a href=\"";
        // line 20
        if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array("@myAccountSendMessage", ), "method"), "html", null, true);
        echo "\" class=\"g-button ajax-link g-button-submit\" style=\"min-width:10px;\">Send Message</a>
\t\t<br />
\t\t<br />
\t\t<div class=\"info-blue\">
\t\t\t<p>
\t\t\t\tIn the Message section you can view your sent and received messages and send new messages to other users
\t\t\t</p>
\t\t</div>
        ";
        // line 28
        if (isset($context["message"])) { $_message_ = $context["message"]; } else { $_message_ = null; }
        if ($_message_) {
            // line 29
            echo "            <div class=\"error_box\">
                ";
            // line 30
            if (isset($context["message"])) { $_message_ = $context["message"]; } else { $_message_ = null; }
            echo twig_escape_filter($this->env, $_message_, "html", null, true);
            echo "
            </div>
        ";
        }
        // line 33
        echo "\t\t<br /><br />
\t\t";
        // line 34
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        if ($this->getAttribute($_form_, "errors")) {
            // line 35
            echo "\t\t    <div class=\"error_box\"><strong>There were errors - please verify all fields for errors</strong></div>
\t\t";
        }
        // line 37
        echo "\t\t";
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        if ($this->getAttribute($_form_, "success")) {
            // line 38
            echo "\t\t    <div class=\"infotip\"><strong>Success</strong><br /><br />Sent message to the selected user</div>
\t\t";
        }
        // line 40
        echo "\t\t<form enctype=\"application/x-www-form-urlencoded\" action=\"";
        if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array("@myAccountSendMessage", ), "method"), "html", null, true);
        echo "\" method=\"post\">
\t\t\t<div class=\"form-global clearfix\">
\t\t\t\t<div class=\"label\"><label for=\"users\">Username:</label></div>
\t\t\t\t<div class=\"input input_big\">
\t\t\t\t\t";
        // line 44
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "input", array("users", $this->getAttribute($this->getAttribute($_form_, "values"), "users"), ), "method"), "html", null, true);
        echo "
\t\t\t\t\t";
        // line 45
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "errors", array($this->getAttribute($this->getAttribute($_form_, "errors"), "users"), ), "method"), "html", null, true);
        echo "
\t\t\t\t</div>
\t\t\t\t<div class=\"label\"><label for=\"subject\">Subject:</label></div>
\t\t\t\t<div class=\"input input_big\">
\t\t\t\t\t";
        // line 49
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "input", array("subject", $this->getAttribute($this->getAttribute($_form_, "values"), "subject"), ), "method"), "html", null, true);
        echo "
\t\t\t\t\t";
        // line 50
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "errors", array($this->getAttribute($this->getAttribute($_form_, "errors"), "subject"), ), "method"), "html", null, true);
        echo "
\t\t\t\t</div>
\t\t\t\t<div class=\"label\"><label for=\"body\">Message:</label></div>
\t\t\t\t<div class=\"input input_big\">
\t\t\t\t\t";
        // line 54
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "textarea", array("body", $this->getAttribute($this->getAttribute($_form_, "values"), "body"), ), "method"), "html", null, true);
        echo "
\t\t\t\t\t";
        // line 55
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "errors", array($this->getAttribute($this->getAttribute($_form_, "errors"), "body"), ), "method"), "html", null, true);
        echo "
\t\t\t\t</div>
\t\t\t\t<div class=\"form-global clearfix\">
\t\t\t\t\t<div class=\"label\"><label>&nbsp;</label></div>
\t\t\t\t\t<div class=\"left\"><input type=\"submit\" class=\"g-button g-button-submit\" value=\"Send Message\" /></div>
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
";
    }

    // line 73
    public function block_right_side($context, array $blocks = array())
    {
        // line 74
        echo "\t";
        if (isset($context["app"])) { $_app_ = $context["app"]; } else { $_app_ = null; }
        if ((!$this->getAttribute($_app_, "ajax"))) {
            // line 75
            echo "\t\t";
            $context["ma_menu"] = "myMessenger";
            // line 76
            echo "\t\t";
            $this->env->loadTemplate("myaccount/menu.twig")->display($context);
            // line 77
            echo "\t";
        }
    }

    public function getTemplateName()
    {
        return "myaccount/messenger/send-message.twig";
    }

    public function isTraitable()
    {
        return false;
    }
}
