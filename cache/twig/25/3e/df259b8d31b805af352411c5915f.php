<?php

/* myaccount/buildMyNetwork.twig */
class __TwigTemplate_253edf259b8d31b805af352411c5915f extends Twig_Template
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
        echo "    ";
        if (isset($context["app"])) { $_app_ = $context["app"]; } else { $_app_ = null; }
        if ((!$this->getAttribute($_app_, "ajax"))) {
            // line 5
            echo "        ";
            $this->env->loadTemplate("myaccount/css.twig")->display($context);
            // line 6
            echo "    ";
        }
    }

    // line 8
    public function block_js($context, array $blocks = array())
    {
        // line 9
        echo "    ";
        if (isset($context["app"])) { $_app_ = $context["app"]; } else { $_app_ = null; }
        if ((!$this->getAttribute($_app_, "ajax"))) {
            // line 10
            echo "        ";
            $this->env->loadTemplate("myaccount/js.twig")->display($context);
            // line 11
            echo "    ";
        }
    }

    // line 14
    public function block_content_page($context, array $blocks = array())
    {
        // line 15
        echo "\t<div style=\"float: left\">
\t\t<h1>Build My Network</h1>
\t</div>
\t<div style=\"float: right; padding-top: 10px;\">
\t\tMy Referral ID: ";
        // line 19
        if (isset($context["app"])) { $_app_ = $context["app"]; } else { $_app_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($_app_, "user"), "ref_id"), "html", null, true);
        echo "
\t</div>
\t<div style=\"clear: both\"></div>
    <div class=\"ma_top\"></div>
    <div class=\"ma_content\">
        Your referral id is: <span class=\"strong\">";
        // line 24
        if (isset($context["app"])) { $_app_ = $context["app"]; } else { $_app_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($_app_, "user"), "ref_id"), "html", null, true);
        echo "</span>
        <br /><br />
        You may give your Referral ID to prospective WinMaWeb members (your friends, family, colleagues, neighbors, etc.).  They will need your Referral ID when they register. (new members may not join unless they provide a Referral ID from an existing member!)
        <br /><br />You may also copy and paste the link below.  If a new member follows it then your Referral ID will automatically be embedded in their registration.<br /><br />
        <strong>https://www.winmaweb.com/request-membership?referral_id=";
        // line 28
        if (isset($context["app"])) { $_app_ = $context["app"]; } else { $_app_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($_app_, "user"), "ref_id"), "html", null, true);
        echo "</strong>
        <br /><br />
        You can also share the link: 
        <!-- AddThis Button BEGIN -->
        <a href=\"https://api.addthis.com/oexchange/0.8/forward/facebook/offer?pco=tbxnj-1.0&amp;url=http%3A%2F%2Fwww.winmaweb.com%2Frequest-membership%3Freferral_id%3D";
        // line 32
        if (isset($context["app"])) { $_app_ = $context["app"]; } else { $_app_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($_app_, "user"), "ref_id"), "html", null, true);
        echo "&amp;image=http%3A%2F%2Fwww.winmaweb.com%2images%2site%2header-logo-box2.png&amp;pubid=xa-4f06ba196745fa46\" target=\"_blank\" ><img src=\"https://cache.addthis.com/icons/v1/thumbs/facebook.gif\" border=\"0\" alt=\"Facebook\" /></a>
        <a href=\"https://api.addthis.com/oexchange/0.8/forward/twitter/offer?pco=tbxnj-1.0&amp;url=http%3A%2F%2Fwww.winmaweb.com%2Frequest-membership%3Freferral_id%3D";
        // line 33
        if (isset($context["app"])) { $_app_ = $context["app"]; } else { $_app_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($_app_, "user"), "ref_id"), "html", null, true);
        echo "&amp;pubid=xa-4f06ba196745fa46\" target=\"_blank\" ><img src=\"https://cache.addthis.com/icons/v1/thumbs/twitter.gif\" border=\"0\" alt=\"Twitter\" /></a>
        <a href=\"https://www.addthis.com/bookmark.php?source=tbxnj-1.0&amp;=250&amp;pubid=xa-4f06ba196745fa46&amp;url=http%3A%2F%2Fwww.winmaweb.com%2Frequest-membership%3Freferral_id%3D";
        // line 34
        if (isset($context["app"])) { $_app_ = $context["app"]; } else { $_app_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($_app_, "user"), "ref_id"), "html", null, true);
        echo " \" target=\"_blank\"  ><img src=\"https://cache.addthis.com/icons/v1/thumbs/more.gif\" border=\"0\" alt=\"More...\" /></a>
        <!-- AddThis Button END -->
\t\t\t\t";
        // line 36
        if (isset($context["links"])) { $_links_ = $context["links"]; } else { $_links_ = null; }
        if ($_links_) {
            // line 37
            echo "\t\t\t\t<br/><br/>
\t\t\t\t";
            // line 38
            if (isset($context["links"])) { $_links_ = $context["links"]; } else { $_links_ = null; }
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($_links_);
            foreach ($context['_seq'] as $context["_key"] => $context["link"]) {
                // line 39
                echo "\t\t\t\t<div style=\"width: 95%; border: 1px solid black; padding: 10px;\">
\t\t\t\t\t<div class=\"left\" style=\"width: 80%; font-size: 15px; padding-top: 3px; text-decoration: underline;\">";
                // line 40
                if (isset($context["link"])) { $_link_ = $context["link"]; } else { $_link_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($_link_, "title"), "html", null, true);
                echo "</div>
\t\t\t\t\t<div class=\"left\" style=\"width: 20%;\"><a href=\"/uploads/mynetwork/";
                // line 41
                if (isset($context["link"])) { $_link_ = $context["link"]; } else { $_link_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($_link_, "filename"), "html", null, true);
                echo "\" class=\"g-button g-button-share\" target=\"_blank\">Download</a></div>
\t\t\t\t\t<div class=\"clear\"></div>
\t\t\t\t</div>
\t\t\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['link'], $context['_parent'], $context['loop']);
            $context = array_merge($_parent, array_intersect_key($context, $_parent));
            // line 45
            echo "\t\t\t\t<br/><br/>
\t\t\t\t";
        }
        // line 47
        echo "    </div>
    <div class=\"ma_bottom\"></div>
";
    }

    // line 51
    public function block_right_side($context, array $blocks = array())
    {
        // line 52
        echo "    ";
        if (isset($context["app"])) { $_app_ = $context["app"]; } else { $_app_ = null; }
        if ((!$this->getAttribute($_app_, "ajax"))) {
            // line 53
            echo "        ";
            $context["ma_menu"] = "buildMyNetwork";
            // line 54
            echo "        ";
            $this->env->loadTemplate("myaccount/menu.twig")->display($context);
            // line 55
            echo "    ";
        }
    }

    public function getTemplateName()
    {
        return "myaccount/buildMyNetwork.twig";
    }

    public function isTraitable()
    {
        return false;
    }
}
