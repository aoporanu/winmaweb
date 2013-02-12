<?php

/* requestmembership.twig */
class __TwigTemplate_23290046290ac5cbbde3cb1613e53742 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->blocks = array(
            'css' => array($this, 'block_css'),
            'content_page_register' => array($this, 'block_content_page_register'),
            'right_side' => array($this, 'block_right_side'),
            'js' => array($this, 'block_js'),
            'content_page' => array($this, 'block_content_page'),
        );
    }

    protected function doGetParent(array $context)
    {
        return $this->env->resolveTemplate((($this->getAttribute($this->getContext($context, "app"), "ajax")) ? ("layouts/ajax.twig") : ("layouts/layout_register.twig")));
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 2
        $context["forms"] = $this->env->loadTemplate("/forms/forms.twig");
        // line 4
        if (isset($context["app"])) { $_app_ = $context["app"]; } else { $_app_ = null; }
        if ((!$this->getAttribute($_app_, "ajax"))) {
        } else {
        }
        $this->getParent($context)->display($context, array_merge($this->blocks, $blocks));
    }

    // line 5
    public function block_css($context, array $blocks = array())
    {
        // line 6
        echo "\t\t<link href=\"css/site/subscribe_steps.css\" media=\"screen\" rel=\"stylesheet\" type=\"text/css\" />
\t\t<link rel=\"stylesheet\" type=\"text/css\" href=\"/css/ui-lightness/jquery-ui-1.8.16.custom.css\" />
\t\t<link rel=\"stylesheet\" type=\"text/css\" href=\"/css/prettyPhoto.css\" />
\t";
    }

    // line 11
    public function block_content_page_register($context, array $blocks = array())
    {
        // line 12
        echo "\t\t<div class=\"p-container\">
\t\t\t";
        // line 13
        if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
        if ($_product_) {
            // line 14
            echo "\t\t\t\t<h1>";
            if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_product_, "name"), "html", null, true);
            echo "</h1>
\t\t\t\t<div class=\"p-shortdesc\">";
            // line 15
            if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_product_, "short_description"), "html", null, true);
            echo "</div>
\t\t\t\t<div class=\"yui3-g\">
\t\t\t\t\t<div class=\"yui3-u-3-5\">
\t\t\t\t\t\t<div class=\"p-top_left\">
\t\t\t\t\t\t\t<div id=\"slides_container\">
\t\t\t\t\t\t\t\t<div id=\"slides\">
\t\t\t\t\t\t\t\t\t<div class=\"slides_container\">
\t\t\t\t\t\t\t\t\t\t";
            // line 22
            if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute($_product_, "ProductMedia"));
            foreach ($context['_seq'] as $context["_key"] => $context["image"]) {
                // line 23
                echo "\t\t\t\t\t\t\t\t\t\t\t<a href=\"";
                if (isset($context["image"])) { $_image_ = $context["image"]; } else { $_image_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($_image_, "dir"), "html", null, true);
                echo "/";
                if (isset($context["image"])) { $_image_ = $context["image"]; } else { $_image_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($_image_, "file_name"), "html", null, true);
                echo "_";
                if (isset($context["image"])) { $_image_ = $context["image"]; } else { $_image_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($_image_, "id"), "html", null, true);
                echo ".";
                if (isset($context["image"])) { $_image_ = $context["image"]; } else { $_image_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($_image_, "ext"), "html", null, true);
                echo "\" rel=\"prettyPhoto[]\" title=\"\"><img src=\"";
                if (isset($context["image"])) { $_image_ = $context["image"]; } else { $_image_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($_image_, "dir"), "html", null, true);
                echo "/thumb380x237/";
                if (isset($context["image"])) { $_image_ = $context["image"]; } else { $_image_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($_image_, "file_name"), "html", null, true);
                echo "_";
                if (isset($context["image"])) { $_image_ = $context["image"]; } else { $_image_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($_image_, "id"), "html", null, true);
                echo ".";
                if (isset($context["image"])) { $_image_ = $context["image"]; } else { $_image_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($_image_, "ext"), "html", null, true);
                echo "\" width=\"610\" height=\"290\" /></a>
\t\t\t\t\t\t\t\t\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['image'], $context['_parent'], $context['loop']);
            $context = array_merge($_parent, array_intersect_key($context, $_parent));
            // line 25
            echo "\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t<br />
\t\t\t\t\t\t\t<!-- AddThis Button BEGIN -->
\t\t\t\t\t\t\t<div class=\"addthis_toolbox addthis_default_style \">
\t\t\t\t\t\t\t\t<a class=\"addthis_button_facebook_like\" fb:like:layout=\"button_count\"></a>
\t\t\t\t\t\t\t\t<a class=\"addthis_button_tweet\"></a>
\t\t\t\t\t\t\t\t<a class=\"addthis_button_google_plusone\" g:plusone:size=\"medium\"></a>
\t\t\t\t\t\t\t\t<a class=\"addthis_counter addthis_pill_style\"></a>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t<script type=\"text/javascript\" src=\"https://s7.addthis.com/js/250/addthis_widget.js#pubid=xa-4ec2a51b78f841f4\"></script>
\t\t\t\t\t\t\t<!-- AddThis Button END -->
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<ul class=\"nav nav-tabs\">
\t\t\t\t\t\t\t<li ";
            // line 40
            if (isset($context["tab"])) { $_tab_ = $context["tab"]; } else { $_tab_ = null; }
            if (($_tab_ == "")) {
                echo "class=\"active\"";
            }
            echo ">
\t\t\t\t\t\t\t\t<a href=\"/";
            // line 41
            if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($_product_, "User"), "username"), "html", null, true);
            echo "/";
            if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_product_, "slug"), "html", null, true);
            echo ".html\">Description</a>
\t\t\t\t\t\t\t</li>
\t\t\t\t\t\t\t<li ";
            // line 43
            if (isset($context["tab"])) { $_tab_ = $context["tab"]; } else { $_tab_ = null; }
            if (($_tab_ == "questions")) {
                echo "class=\"active\"";
            }
            echo ">
\t\t\t\t\t\t\t\t<a href=\"/";
            // line 44
            if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($_product_, "User"), "username"), "html", null, true);
            echo "/";
            if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_product_, "slug"), "html", null, true);
            echo ".html?tab=questions\">Questions</a>
\t\t\t\t\t\t\t</li>
\t\t\t\t\t\t</ul>
\t\t\t\t\t\t<div>
\t\t\t\t\t\t\t<div class=\"descr_raw\">";
            // line 48
            if (isset($context["bbcode"])) { $_bbcode_ = $context["bbcode"]; } else { $_bbcode_ = null; }
            if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
            echo $this->getAttribute($_bbcode_, "p", array($this->getAttribute($_product_, "description"), 1, ), "method");
            echo "</div>
\t\t\t\t\t\t\t<div class=\"p-terms\">";
            // line 49
            if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
            echo twig_nl2br_filter(twig_escape_filter($this->env, $this->getAttribute($_product_, "terms"), "html", null, true));
            echo "</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t";
        }
        // line 54
        echo "\t\t</div>
\t\t<br /><br />
\t\t";
        // line 56
        if (isset($context["similar"])) { $_similar_ = $context["similar"]; } else { $_similar_ = null; }
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($_similar_);
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
        foreach ($context['_seq'] as $context["_key"] => $context["product"]) {
            // line 57
            echo "\t\t\t";
            if (isset($context["loop"])) { $_loop_ = $context["loop"]; } else { $_loop_ = null; }
            if ($this->getAttribute($_loop_, "first")) {
                // line 58
                echo "\t\t\t\t<ul class=\"products_list\">
\t\t\t\t\t<li><h3 class=\"cssfonts--26\">Similar offers</h3></li>
\t\t\t";
            }
            // line 61
            echo "\t\t\t";
            $this->env->loadTemplate("inc/productList.twig")->display($context);
            // line 62
            echo "\t\t\t";
            if (isset($context["loop"])) { $_loop_ = $context["loop"]; } else { $_loop_ = null; }
            if ($this->getAttribute($_loop_, "last")) {
                echo "</ul>";
            }
            // line 63
            echo "\t\t";
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
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['product'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 64
        echo "\t\t<div id=\"register-intro\">
\t\t<form action=\"/request-membership\" class=\"groupon_form alt\" id=\"new_subscription\" name=\"frmRegister\"  method=\"post\">
\t\t\t<div style=\"margin:0;padding:0\"><input name=\"authenticity_token\" type=\"hidden\" value=\"QwekLo4OSqeYPgA1QTlT81S5CmDoiHcwfllghBCDmwA=\" /></div>
\t\t\t";
        // line 67
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        if ($this->getAttribute($_form_, "success")) {
            // line 68
            echo "\t\t\t\t<div class=\"step_zero form_step\" data-bhw=\"video\">
\t\t\t\t\t<div class=\"page_content clearfix\">
\t\t\t\t\t\t<div class=\"step\"></div>
\t\t\t\t\t\t<fieldset>
\t\t\t\t\t\t\t<div class=\"input_three_steps\">
\t\t\t\t\t\t\t\t<div class=\"modal-title p_none\">
\t\t\t\t\t\t\t\t\t<h3 name=\"step0\">Register
\t\t\t\t\t\t\t\t\t\t<div class=\"right\"><a class=\"modal-close\" href=\"#\">X</a></div>
\t\t\t\t\t\t\t\t\t</h3>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t<br/><br/>
\t\t\t\t\t\t\t\t<div class=\"infotip\"><strong>Success</strong>
\t\t\t\t\t\t\t\t\t<br /><br />Please go to your E-mail account and open the WinMaWeb E-mail and then click on the link it contains to activate your account.
\t\t\t\t\t\t\t\t\t<br/>
\t\t\t\t\t\t\t\t\t";
            // line 83
            echo "\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</fieldset>
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t\t<script type=\"text/javascript\">
\t\t\t\t\tsetTimeout(function() {
\t\t\t\t\t\t\$('.page_content').hide();
\t\t\t\t\t}, 7000);
\t\t\t\t</script>
\t\t\t";
        } else {
            // line 94
            echo "\t\t\t\t<div class=\"step_zero form_step\" data-bhw=\"video\">
\t\t\t\t\t<div class=\"page_content clearfix\" id=\"stepumasii1\">
\t\t\t\t\t\t<div class=\"step\"></div>
\t\t\t\t\t\t<fieldset>
\t\t\t\t\t\t\t<div class=\"input_three_steps\">
\t\t\t\t\t\t\t\t<div class=\"modal-title p_none\">
\t\t\t\t\t\t\t\t\t<h3 name=\"step0\">Register
\t\t\t\t\t\t\t\t\t\t<div class=\"right\"><a class=\"modal-close\" href=\"#\">X</a></div>
\t\t\t\t\t\t\t\t\t</h3>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t<div class=\"header_three_steps\">
\t\t\t\t\t\t\t\t\tBefore you register your free account with WinMaWeb, please hit <img src=\"/images/play-icon.png\" width=\"23\" /> and have a quick look at our 3 minute introduction movie.
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t";
            // line 107
            if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
            if (($this->getAttribute($_form_, "errors") || $this->getAttribute($_form_, "globalErrors"))) {
                // line 108
                echo "\t\t\t\t\t\t\t\t\t<div class=\"error_box\">
\t\t\t\t\t\t\t\t\t\t<strong>Please check if the information you provided was enough. Our Web-Site requires that all fields be completed.</strong>
\t\t\t\t\t\t\t\t\t\t";
                // line 110
                if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
                if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "errors", array($this->getAttribute($_form_, "globalErrors"), ), "method"), "html", null, true);
                echo "
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t";
            }
            // line 113
            echo "\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t<div class=\"video\"><iframe width=\"450\" height=\"255\" src=\"https://www.youtube.com/embed/pMCPHVjKQdE?rel=0&autoplay=1\" frameborder=\"0\" allowfullscreen></iframe></div>
\t\t\t\t\t\t</fieldset>
\t\t\t\t\t\t<div class=\"button_container\">
\t\t\t\t\t\t\t<div class=\"button_sub buttons\">
\t\t\t\t\t\t\t\t<div class=\"small-button\">
\t\t\t\t\t\t\t\t\t<a href=\"#step0\" class=\"button continue\" data-bhw=\"videoContinue\" id=\"step_zero\" onclick=\"\$('.video').html('<iframe width=\\'450\\' height=\\'255\\' src=\\'https://www.youtube.com/embed/pMCPHVjKQdE?rel=0&autoplay=0\\' frameborder=\\'0\\' allowfullscreen></iframe>'); return false;\">
\t\t\t\t\t\t\t\t\t\t<div class=\"button_see\">
\t\t\t\t\t\t\t\t\t\t\t<div class=\"small-left\"></div>
\t\t\t\t\t\t\t\t\t\t\t<div class=\"small-center\">Skip</div>
\t\t\t\t\t\t\t\t\t\t\t<div class=\"small-right\"></div>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t<div style=\"clear: both;\"></div>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t";
        }
        // line 133
        echo "\t\t\t<div class=\"step_one form_step\" data-bhw=\"SubscriptionConfirmEmail\">
\t\t\t\t<div class=\"page_content clearfix\" id=\"stepumasii2\">
\t\t\t\t\t<fieldset>
\t\t\t\t\t\t<div class=\"input_three_steps\">
\t\t\t\t\t\t\t<div class=\"modal-title p_none\">
\t\t\t\t\t\t\t\t<h3 name=\"step1\">Step 1
\t\t\t\t\t\t\t\t\t<div class=\"right\"><a class=\"modal-close\" href=\"#\">X</a></div>
\t\t\t\t\t\t\t\t</h3>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t<div class=\"form-global form-reg clearfix\">
\t\t\t\t\t\t\t\t<div class=\"label\"><label for=\"email\">E-mail:</label></div>
\t\t\t\t\t\t\t\t<div class=\"input f_input_big\">
\t\t\t\t\t\t\t\t\t";
        // line 145
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "input", array("email", $this->getAttribute($this->getAttribute($_form_, "values"), "email"), ), "method"), "html", null, true);
        echo "
\t\t\t\t\t\t\t\t\t<div id=\"email_error\">";
        // line 146
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "errors", array($this->getAttribute($this->getAttribute($_form_, "errors"), "email"), ), "method"), "html", null, true);
        echo "</div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t<div class=\"clear\"></div>
\t\t\t\t\t\t\t\t<div class=\"label\"><label for=\"referral\">Referral id:</label></div>
\t\t\t\t\t\t\t\t<div class=\"input f_input_big\">
\t\t\t\t\t\t\t\t\t";
        // line 151
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "input", array("referral", $this->getAttribute($this->getAttribute($_form_, "values"), "referral"), ), "method"), "html", null, true);
        echo "
\t\t\t\t\t\t\t\t\t";
        // line 152
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "errors", array($this->getAttribute($this->getAttribute($_form_, "errors"), "referral"), ), "method"), "html", null, true);
        echo "
\t\t\t\t\t\t\t\t\t<br /><em style=\"color:#000\">You must provide a Referral ID from an existing member in order to register.</em>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t<div style=\"clear: both;\"></div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t</fieldset>
\t\t\t\t\t<div class=\"button_container\" style=\"width: 320px;\">
\t\t\t\t\t\t<div class='button_sub buttons'>
\t\t\t\t\t\t\t<div class=\"small-button\">
\t\t\t\t\t\t\t\t<a href=\"#step1\" class=\"button continue\" data-bhw=\"SubscriptionConfirmEmailContinue\" id=\"step_one\" onclick=\"return false;\">
\t\t\t\t\t\t\t\t\t<div class=\"button_see\">
\t\t\t\t\t\t\t\t\t\t<div class=\"small-left\"></div>
\t\t\t\t\t\t\t\t\t\t<div class=\"small-center\">Next</div>
\t\t\t\t\t\t\t\t\t\t<div class=\"small-right\"></div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<div style=\"clear: both;\"></div>
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t</div>
\t\t\t<div class=\"step_two form_step\" data-bhw=\"SubscriptionConfirmUser\">
\t\t\t\t<div class=\"page_content clearfix\" id=\"stepumasii3\">
\t\t\t\t\t<fieldset>
\t\t\t\t\t\t<div class=\"input_three_steps\">
\t\t\t\t\t\t\t<div class=\"modal-title p_none\">
\t\t\t\t\t\t\t\t<h3 name=\"step2\">Step 2
\t\t\t\t\t\t\t\t\t<div class=\"right\"><a class=\"modal-close\" href=\"#\">X</a></div>
\t\t\t\t\t\t\t\t</h3>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t<div class=\"form-global form-reg clearfix\">
\t\t\t\t\t\t\t\t<div class=\"label\"><label for=\"reg_username\">Username:</label></div>
\t\t\t\t\t\t\t\t<div class=\"input f_input_big\">
\t\t\t\t\t\t\t\t\t";
        // line 187
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "input", array("reg_username", $this->getAttribute($this->getAttribute($_form_, "values"), "reg_username"), ), "method"), "html", null, true);
        echo "
\t\t\t\t\t\t\t\t\t";
        // line 188
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "errors", array($this->getAttribute($this->getAttribute($_form_, "errors"), "reg_username"), ), "method"), "html", null, true);
        echo "
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t<div class=\"clear\"></div>
\t\t\t\t\t\t\t\t<div class=\"label\"><label for=\"reg_password\">Password:</label></div>
\t\t\t\t\t\t\t\t<div class=\"input f_input_big\">
\t\t\t\t\t\t\t\t\t";
        // line 193
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "input", array("reg_password", "", "password", ), "method"), "html", null, true);
        echo "
\t\t\t\t\t\t\t\t\t";
        // line 194
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "errors", array($this->getAttribute($this->getAttribute($_form_, "errors"), "reg_password"), ), "method"), "html", null, true);
        echo "
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t<div style=\"clear: both;\"></div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t</fieldset>
\t\t\t\t\t<div class=\"button_container\" style=\"width: 320px;\">
\t\t\t\t\t\t<div class=\"button_sub buttons\">
\t\t\t\t\t\t\t<div class=\"small-button\">
\t\t\t\t\t\t\t\t<a href=\"#step2\" class=\"button continue\" data-bhw=\"SubscriptionConfirmUser\" id=\"step_two\" onclick=\"return false;\">
\t\t\t\t\t\t\t\t\t<div class=\"button_see\">
\t\t\t\t\t\t\t\t\t\t<div class=\"small-left\"></div>
\t\t\t\t\t\t\t\t\t\t<div class=\"small-center\">Next</div>
\t\t\t\t\t\t\t\t\t\t<div class=\"small-right\"></div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<div style=\"clear: both;\"></div>
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t</div>
\t\t\t<div class=\"step_three form_step\" data-bhw=\"SubscriptionCity\">
\t\t\t\t<div class=\"page_content clearfix\">
\t\t\t\t\t<fieldset>
\t\t\t\t\t\t<div class=\"input_three_steps\">
\t\t\t\t\t\t\t<div class=\"modal-title p_none\">
\t\t\t\t\t\t\t\t<h3 name=\"step3\">Step 3
\t\t\t\t\t\t\t\t\t<div class=\"right\"><a class=\"modal-close\" href=\"#\">X</a></div>
\t\t\t\t\t\t\t\t</h3>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t<div class=\"form-global form-reg clearfix\">
\t\t\t\t\t\t\t\t<div class=\"label\"><label for=\"first_name\">First Name:</label></div>
\t\t\t\t\t\t\t\t<div class=\"input f_input_big\">
\t\t\t\t\t\t\t\t\t";
        // line 228
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "input", array("first_name", $this->getAttribute($this->getAttribute($_form_, "values"), "first_name"), ), "method"), "html", null, true);
        echo "
\t\t\t\t\t\t\t\t\t";
        // line 229
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "errors", array($this->getAttribute($this->getAttribute($_form_, "errors"), "first_name"), ), "method"), "html", null, true);
        echo "
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t<div class=\"clear\"></div>
\t\t\t\t\t\t\t\t<div class=\"label\"><label for=\"last_name\">Last Name:</label></div>
\t\t\t\t\t\t\t\t<div class=\"input f_input_big\">
\t\t\t\t\t\t\t\t\t";
        // line 234
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "input", array("last_name", $this->getAttribute($this->getAttribute($_form_, "values"), "last_name"), ), "method"), "html", null, true);
        echo "
\t\t\t\t\t\t\t\t\t";
        // line 235
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "errors", array($this->getAttribute($this->getAttribute($_form_, "errors"), "last_name"), ), "method"), "html", null, true);
        echo "
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t<div class=\"clear\"></div>
\t\t\t\t\t\t\t\t<div class=\"label\"><label for=\"country\">Country:</label></div>
\t\t\t\t\t\t\t\t<div class=\"input f_input_big\">
\t\t\t\t\t\t\t\t\t";
        // line 240
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "select", array("country", $this->getAttribute($this->getAttribute($_form_, "countries"), "options"), $this->getAttribute($this->getAttribute($_form_, "values"), "country"), ), "method"), "html", null, true);
        echo "
\t\t\t\t\t\t\t\t\t";
        // line 241
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "errors", array($this->getAttribute($this->getAttribute($_form_, "errors"), "country"), ), "method"), "html", null, true);
        echo "
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t<div style=\"clear: both;\"></div>
\t\t\t\t\t\t\t\t<div class=\"label\"><label for=\"terms\"></label></div>
\t\t\t\t\t\t\t\t<div class=\"input f_input_big\">
\t\t\t\t\t\t\t\t\t<input type=\"checkbox\" name=\"terms\" id=\"terms\" style=\"width: 20px;\" value=\"1\" />
\t\t\t\t\t\t\t\t\t<a href=\"/Terms and Conditions.pdf\" target=\"_blank\">I agree with the Terms and Conditions</a>
\t\t\t\t\t\t\t\t\t";
        // line 248
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "errors", array($this->getAttribute($this->getAttribute($_form_, "errors"), "terms"), ), "method"), "html", null, true);
        echo "
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t<div class=\"clear\"></div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t</fieldset>
\t\t\t\t\t<div class=\"button_container\">
\t\t\t\t\t\t<div class=\"button_sub buttons\">
\t\t\t\t\t\t\t<div class=\"small-button\">
\t\t\t\t\t\t\t\t<a href=\"#step3\" onclick=\"document.forms['frmRegister'].submit();\" onclick=\"return false;\">
\t\t\t\t\t\t\t\t\t<div class=\"button_see\">
\t\t\t\t\t\t\t\t\t\t<div class=\"small-left\"></div>
\t\t\t\t\t\t\t\t\t\t<div class=\"small-center\">Register</div>
\t\t\t\t\t\t\t\t\t\t<div class=\"small-right\"></div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t<input type=\"submit\" style=\"display: none;\"/>
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<div style=\"clear: both;\"></div>
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t</div>
\t\t</form>
\t\t</div>
\t";
    }

    // line 274
    public function block_right_side($context, array $blocks = array())
    {
        // line 275
        echo "\t<div class=\"yui3-u-3-5\">
\t\t<div class=\"p-top\">
\t\t\t";
        // line 277
        if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
        if ($_product_) {
            // line 278
            echo "\t\t\t\t<div class=\"prod-timer clearfix\" style=\"padding:5px;\">
\t\t\t\t\t<div class=\"center strong cssfonts--20\" style=\"color: #7E7E7E\">Deal Ends In</div>
\t\t\t\t\t";
            // line 281
            echo "\t\t\t\t\t<div class=\"p_timer_content\"><span>";
            if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
            echo twig_escape_filter($this->env, twig_date_format_filter($this->getAttribute($_product_, "endtime"), "Y/m/d H:i"), "html", null, true);
            echo "</span><span>";
            if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
            echo twig_escape_filter($this->env, twig_date_format_filter($this->getAttribute($_product_, "starttime"), "Y/m/d H:i"), "html", null, true);
            echo "</span></div>
\t\t\t\t</div>
\t\t\t\t<div class=\"discount\">
\t\t\t\t\t<span>Discount</span> 
\t\t\t\t\t<h5>";
            // line 285
            if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($_product_, "ProductPrice"), 0), "discount"), "html", null, true);
            echo "%</h5>
\t\t\t\t</div>
\t\t\t\t<div class=\"product-content\">
\t\t\t\t\t<div class=\"blog-right-dwo\"><span>Value</span> <p>";
            // line 288
            if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
            echo twig_escape_filter($this->env, twig_currency($this->getAttribute($this->getAttribute($this->getAttribute($_product_, "ProductPrice"), 0), "suplier_price")), "html", null, true);
            echo "</p></div>
\t\t\t\t\t<div class=\"blog-right-dwo\"><span>Price</span> <p>";
            // line 289
            if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
            echo twig_escape_filter($this->env, twig_currency($this->getAttribute($this->getAttribute($this->getAttribute($_product_, "ProductPrice"), 0), "price")), "html", null, true);
            echo "</p></div>
\t\t\t\t\t<div class=\"clearfix\"></div>
\t\t\t\t</div>
\t\t\t\t";
            // line 292
            if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
            if (($this->getAttribute($this->getAttribute($this->getAttribute($_product_, "ProductPrice"), 0), "sold") == $this->getAttribute($this->getAttribute($this->getAttribute($_product_, "ProductPrice"), 0), "stock"))) {
                // line 293
                echo "\t\t\t\t\t<div class=\"blog-right-button\">
\t\t\t\t\t\t";
                // line 295
                echo "\t\t\t\t\t\t\t<div class=\"button_buy\">
\t\t\t\t\t\t\t\t<div class=\"blog-right-grey-left\"></div>
\t\t\t\t\t\t\t\t<div class=\"blog-right-grey-center\">Buy</div>
\t\t\t\t\t\t\t\t<div class=\"blog-right-grey-right\"></div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t";
                // line 301
                echo "\t\t\t\t\t</div>
\t\t\t\t\t<div style=\"clear: both;\"></div>
\t\t\t\t\t<div style=\"margin: 0px 25px;padding-top:2px;\"><img src=\"/images/site/gift_grey.png\" width=\"59\" height=\"60\" /><div style=\"cursor: default; line-height:60px;display:block;color:#cccccc;font-weight:bold;font-size: 16px;text-decoration: none;padding-right:5px;\" class=\"right\">Buy For A Friend</div></div>
\t\t\t\t";
            } else {
                // line 305
                echo "\t\t\t\t\t<div class=\"blog-right-button\">
\t\t\t\t\t\t<a href=\"";
                // line 306
                if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
                if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array((((("@productProfile?user_slug=" . $this->getAttribute($this->getAttribute($_product_, "User"), "username")) . "&product_slug=") . $this->getAttribute($_product_, "slug")) . "&options=true"), ), "method"), "html", null, true);
                echo "\" class=\"modal-pp\">
\t\t\t\t\t\t\t<div class=\"button_buy\">
\t\t\t\t\t\t\t\t<div class=\"blog-right-left\"></div>
\t\t\t\t\t\t\t\t<div class=\"blog-right-center\">Buy</div>
\t\t\t\t\t\t\t\t<div class=\"blog-right-right\"></div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</a>
\t\t\t\t\t</div>
\t\t\t\t\t<div style=\"clear: both;\"></div>
\t\t\t\t\t<div style=\"margin: 0px 25px;padding-top:2px;\"><a href=\"";
                // line 315
                if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
                if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array((((("@productProfile?user_slug=" . $this->getAttribute($this->getAttribute($_product_, "User"), "username")) . "&product_slug=") . $this->getAttribute($_product_, "slug")) . "&options=true&friend=1"), ), "method"), "html", null, true);
                echo "\" class=\"modal-pp\"><img src=\"/images/site/gift.png\" width=\"59\" height=\"60\" /></a><a style=\"line-height:60px;display:block;color:#368592;font-weight:bold;font-size: 16px;text-decoration: none;padding-right:5px;\" href=\"";
                if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
                if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array((((("@productProfile?user_slug=" . $this->getAttribute($this->getAttribute($_product_, "User"), "username")) . "&product_slug=") . $this->getAttribute($_product_, "slug")) . "&options=true&friend=1"), ), "method"), "html", null, true);
                echo "\" class=\"right modal-pp\">Buy For A Friend</a></div>
\t\t\t\t";
            }
            // line 317
            echo "\t\t\t\t<div style=\"clear: both;\"></div>
\t\t\t\t<div class=\"prod-box-content\">
\t\t\t\t\t";
            // line 319
            if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
            if (($this->getAttribute($_product_, "sold") >= 0)) {
                echo "<div style=\"padding-top:5px;text-align:center;font-weight:bold;font-size: 17px;color:#A7A7A7\">";
                if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($_product_, "sold"), "html", null, true);
                echo " Offer(s) Bought</div>";
            }
            // line 320
            echo "\t\t\t\t\t";
            if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
            if (($this->getAttribute($_product_, "sold") >= $this->getAttribute($_product_, "min_sold"))) {
                // line 321
                echo "\t\t\t\t\t\t";
                if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
                $context["percent"] = intval(floor((($this->getAttribute($this->getAttribute($this->getAttribute($_product_, "ProductPrice"), 0), "sold") * 100) / $this->getAttribute($this->getAttribute($this->getAttribute($_product_, "ProductPrice"), 0), "stock"))));
                // line 322
                echo "\t\t\t\t\t\t";
                if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
                if (((($this->getAttribute($this->getAttribute($this->getAttribute($_product_, "ProductPrice"), 0), "sold") * 100) % $this->getAttribute($this->getAttribute($this->getAttribute($_product_, "ProductPrice"), 0), "stock")) >= 5)) {
                    // line 323
                    echo "\t\t\t\t\t\t";
                    if (isset($context["percent"])) { $_percent_ = $context["percent"]; } else { $_percent_ = null; }
                    $context["percent"] = ($_percent_ + 1);
                    // line 324
                    echo "\t\t\t\t\t\t";
                }
                // line 325
                echo "\t\t\t\t\t\t<div style=\"width: 200px;\">
\t\t\t\t\t\t\t<div id=\"progress1\" class=\"progress\">
\t\t\t\t\t\t\t\t<span style=\"width: ";
                // line 327
                if (isset($context["percent"])) { $_percent_ = $context["percent"]; } else { $_percent_ = null; }
                echo twig_escape_filter($this->env, $_percent_, "html", null, true);
                echo "%;\">
\t\t\t\t\t\t\t\t\t<b>";
                // line 328
                if (isset($context["percent"])) { $_percent_ = $context["percent"]; } else { $_percent_ = null; }
                echo twig_escape_filter($this->env, $_percent_, "html", null, true);
                echo "%</b>
\t\t\t\t\t\t\t\t</span>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t\t";
                // line 332
                if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
                if (($this->getAttribute($this->getAttribute($this->getAttribute($_product_, "ProductPrice"), 0), "sold") == $this->getAttribute($this->getAttribute($this->getAttribute($_product_, "ProductPrice"), 0), "stock"))) {
                    // line 333
                    echo "\t\t\t\t\t\t\t<div style=\"padding-top:5px;text-align:center;font-weight:bold;font-size: 17px;color:#A7A7A7\">Sorry, but that deal offer is already sold out.</div>
\t\t\t\t\t\t";
                } else {
                    // line 335
                    echo "\t\t\t\t\t\t\t<div style=\"padding-top:5px;text-align:center;font-weight:bold;font-size: 17px;color:#A7A7A7\">Deal is active</div>
\t\t\t\t\t\t";
                }
                // line 337
                echo "\t\t\t\t\t";
            } else {
                // line 338
                echo "\t\t\t\t\t\t";
                if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
                $context["percent"] = intval(floor((($this->getAttribute($_product_, "sold") * 100) / $this->getAttribute($_product_, "min_sold"))));
                // line 339
                echo "\t\t\t\t\t\t";
                if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
                if (((($this->getAttribute($_product_, "sold") * 100) % $this->getAttribute($_product_, "min_sold")) >= 5)) {
                    // line 340
                    echo "\t\t\t\t\t\t\t";
                    if (isset($context["percent"])) { $_percent_ = $context["percent"]; } else { $_percent_ = null; }
                    $context["percent"] = ($_percent_ + 1);
                    // line 341
                    echo "\t\t\t\t\t\t";
                }
                // line 342
                echo "\t\t\t\t\t\t";
                // line 343
                echo "\t\t\t\t\t\t<div style=\"width: 200px;\">
\t\t\t\t\t\t\t<div id=\"progress1\" class=\"progress\">
\t\t\t\t\t\t\t\t<span style=\"width: ";
                // line 345
                if (isset($context["percent"])) { $_percent_ = $context["percent"]; } else { $_percent_ = null; }
                echo twig_escape_filter($this->env, $_percent_, "html", null, true);
                echo "%;\">
\t\t\t\t\t\t\t\t\t<b>";
                // line 346
                if (isset($context["percent"])) { $_percent_ = $context["percent"]; } else { $_percent_ = null; }
                echo twig_escape_filter($this->env, $_percent_, "html", null, true);
                echo "%</b>
\t\t\t\t\t\t\t\t</span>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<div style=\"padding-top:5px; width: 230px; margin-left: -15px; text-align:center;font-weight:bold;font-size: 17px;color:#A7A7A7\">";
                // line 350
                if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
                echo twig_escape_filter($this->env, ($this->getAttribute($_product_, "min_sold") - $this->getAttribute($_product_, "sold")), "html", null, true);
                echo " more and the Deal is ON!</div>
\t\t\t\t\t";
            }
            // line 352
            echo "\t\t\t\t</div>
\t\t\t";
        }
        // line 354
        echo "\t\t\t";
        // line 359
        echo "\t\t</div>
\t\t<div class=\"p-tags\">
\t\t\t";
        // line 361
        if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute($_product_, "ProductTags"));
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
        foreach ($context['_seq'] as $context["_key"] => $context["tag"]) {
            // line 362
            echo "\t\t\t\t";
            if (isset($context["loop"])) { $_loop_ = $context["loop"]; } else { $_loop_ = null; }
            if ($this->getAttribute($_loop_, "first")) {
                echo "<h3>Tags</h3>";
            }
            // line 363
            echo "\t\t\t\t";
            if (isset($context["tag"])) { $_tag_ = $context["tag"]; } else { $_tag_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($_tag_, "Tag"), "name"), "html", null, true);
            if (isset($context["loop"])) { $_loop_ = $context["loop"]; } else { $_loop_ = null; }
            if ($this->getAttribute($_loop_, "last")) {
            } else {
                echo ",";
            }
            // line 364
            echo "\t\t\t";
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
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['tag'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 365
        echo "\t\t</div>
\t\t<div style=\"padding-top:10px;padding-left:20px;\">
\t\t\t<div style=\"font-weight:bold;font-size: 16px;\">Deal's Location</div>
\t\t\t<div id=\"map\" align=\"center\" style=\"width: 210px; height: 200px;margin-top:15px; position: relative;overflow: hidden;padding-left:20px;\"></div>
\t\t\t<div>Please use the zoom functions to find the deal location.</div>
\t\t\t<div style=\"padding-top:10px;\">
\t\t\t\t";
        // line 371
        if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($_product_, "ProductAddress"), "address"), "html", null, true);
        echo ", ";
        if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($_product_, "ProductAddress"), "county"), "html", null, true);
        echo ", ";
        if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($_product_, "ProductAddress"), "city"), "html", null, true);
        echo ", ";
        if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($_product_, "ProductAddress"), "postcode"), "html", null, true);
        echo "<br />
\t\t\t\t";
        // line 372
        if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_product_, "phone"), "html", null, true);
        echo "
\t\t\t</div>
\t\t</div>
\t</div>
    
    ";
    }

    // line 407
    public function block_js($context, array $blocks = array())
    {
        // line 408
        echo "\t\t<script type=\"text/javascript\">var Wmw = {};</script>
\t\t<script type=\"text/javascript\" src=\"js/js_steps/i18n-EWne7wWz.js\"></script>
\t\t<script src=\"js/js_steps/i18n_url_helper--owO6hBw.js\" type=\"text/javascript\"></script>
\t\t<script src=\"js/js_steps/en-1RB2ujwY.js\" type=\"text/javascript\"></script>
\t\t<script src=\"js/js_steps/helpers-ytMZAu_N.js\" type=\"text/javascript\"></script>
\t\t<script type='text/javascript'>
\t\t\t//<![CDATA[
\t\t\t\tI18n.defaultLocale = \"en\";
\t\t\t\tI18n.locale = \"en\";
\t\t\t\tI18n.availableLocales = [\"en\"];
\t\t\t//]]>
\t\t</script>
\t\t<script type='text/javascript'>
\t\t\t//<![CDATA[
\t\t\t\$(document).ready(function() {
\t\t\t\t\$(\"body\").addClass(\"landing\");
//                                \$(\".modal-close\").html('');
\t\t\t\t\$(\".modal-close\").click(function() {
\t\t\t\t\t\$('.video').html('<iframe width=\"450\" height=\"255\" src=\"https://www.youtube.com/embed/pMCPHVjKQdE?rel=0&autoplay=0\" frameborder=\"0\" allowfullscreen></iframe>');
\t\t\t\t\t//\$(this).parent().parent().parent().parent().parent().parent().parent().hide();
\t\t\t\t\t\$('.modal-popup').hide();
\t\t\t\t\t\$('#register-intro').hide();
\t\t\t\t\twindow.location = '/';
\t\t\t\t\treturn false;
\t\t\t\t});
                \$('#email').blur(function() {
                    var email = \$(this).val();
                    \$.ajax({
                        type: 'POST',
                        url: '/is-valid-email/',
                        data: {
                            'email': email,
                        },
                        cache: false,
                        success: function(response) {
                          //\$('#email').after('<span class=\"errors clearfix\">'+response+'</span>');
\t\t\t\t\t\t\t\t\t\t\t\t\tif (response != '') {
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\$('#email_error').html('<span class=\"errors clearfix\">'+response+'</span>');
\t\t\t\t\t\t\t\t\t\t\t\t\t}
                        }
                    });
                });
                //\$('#email').focus(function() {
                //    if(\$('#email .errors').length >= 0) {
                //        \$('.errors').remove();
                //    }
                //});
\t\t\t\t\t\t\t\t
\t\t\t});
\t\t\t\tdocument.body.className += \" js_enabled\";
\t\t\t\t
\t\t\t//]]>
\t\t</script>



\t\t";
        // line 466
        echo "\t\t<script src=\"js/js_steps/subscriptions-R85RwRBP.js\" type=\"text/javascript\"></script>
<script>
\t\t\t/*\$(document).ready(function() {
\t\t\t\tvar step = ";
        // line 469
        if (isset($context["step"])) { $_step_ = $context["step"]; } else { $_step_ = null; }
        echo twig_escape_filter($this->env, $_step_, "html", null, true);
        echo ";
\t\t\t\t\t\t\t\tcurrentStepIdx = step;
\t\t\t\tswitch (step) {
\t\t\t\t\tcase 0:
\t\t\t\t\t\tbreak;
\t\t\t\t\tcase 1:
\t\t\t\t\t\t//alert(step);
\t\t\t\t\t\t//\$('#stepumasii1').css('display', 'none');
\t\t\t\t\t\t\$('#stepumasii1').hide();
\t\t\t\t\t\t//alert(\$('#stepumasii1'));
\t\t\t\t\t\t//\$('.js_enabled .step_one').css('display', 'block');
\t\t\t\t\t\t\$('.step_one').show();
\t\t\t\t\t\tbreak;
\t\t\t\t}
\t\t\t\t}*/
\t\t\t</script>
\t\t<script type='text/javascript'>
\t\t\t//<![CDATA[
\t\t\t\tvar \$IE = false
\t\t\t//]]>
\t\t</script>
\t\t<script src=\"js/js_steps/tracker-4k0z9X_b.js\" type=\"text/javascript\"></script>
\t\t<script src=\"js/js_steps/tracker-Mc5g29dd.js\" type=\"text/javascript\"></script>
\t";
    }

    // line 494
    public function block_content_page($context, array $blocks = array())
    {
        // line 495
        echo "\t\t<div class=\"info-blue\"><p>Welcome to WinMaWeb. To Register as a new member please fill out this form.
\t\t\t<br /><br />
\t\t\tNote:  This is the ONLY registration page needed to obtain your membership. (There are no further registration pages beyond this one in order to access the website.)</p>
\t\t</div>
\t\t<br />
\t\t";
        // line 500
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        if (($this->getAttribute($_form_, "errors") || $this->getAttribute($_form_, "globalErrors"))) {
            // line 501
            echo "\t\t\t<div class=\"error_box\">
\t\t\t\t<strong>Please check if the information you provided was enough. Our Web-Site requires that all fields be completed.</strong>
\t\t\t\t";
            // line 503
            if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
            if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "errors", array($this->getAttribute($_form_, "globalErrors"), ), "method"), "html", null, true);
            echo "
\t\t\t</div>
\t\t";
        }
        // line 506
        echo "\t\t";
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        if ($this->getAttribute($_form_, "success")) {
            // line 507
            echo "\t\t\t<div class=\"infotip\"><strong>Success</strong>
\t\t\t\t<br /><br />Please go to your E-mail account and open the WinMaWeb E-mail and then click on the link it contains to activate your account.
\t\t\t\t<br/>
\t\t\t\t";
            // line 511
            echo "\t\t\t</div>
\t\t";
        }
        // line 513
        echo "\t\t<form name=\"frmRegister\" enctype=\"application/x-www-form-urlencoded\" action=\"/request-membership\" method=\"post\">
\t\t\t<div class=\"form-global form-reg clearfix\">
\t\t\t\t<div class=\"label\"><label for=\"reg_username\">Username:</label></div>
\t\t\t\t<div class=\"input input_big\">
\t\t\t\t\t";
        // line 517
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "input", array("reg_username", $this->getAttribute($this->getAttribute($_form_, "values"), "reg_username"), ), "method"), "html", null, true);
        echo "
\t\t\t\t\t";
        // line 518
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "errors", array($this->getAttribute($this->getAttribute($_form_, "errors"), "reg_username"), ), "method"), "html", null, true);
        echo "
\t\t\t\t</div>
\t\t\t\t<div class=\"clear\"></div>
\t\t\t\t<div class=\"label\"><label for=\"reg_password\">Password:</label></div>
\t\t\t\t<div class=\"input input_big\">
\t\t\t\t\t";
        // line 523
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "input", array("reg_password", "", "password", ), "method"), "html", null, true);
        echo "
\t\t\t\t\t";
        // line 524
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "errors", array($this->getAttribute($this->getAttribute($_form_, "errors"), "reg_password"), ), "method"), "html", null, true);
        echo "
\t\t\t\t</div>
\t\t\t\t<div class=\"clear\"></div>
\t\t\t\t<div class=\"label\"><label for=\"email\">E-mail:</label></div>
\t\t\t\t<div class=\"input input_big\">
\t\t\t\t\t";
        // line 529
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "input", array("email", $this->getAttribute($this->getAttribute($_form_, "values"), "email"), ), "method"), "html", null, true);
        echo "
\t\t\t\t\t";
        // line 530
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "errors", array($this->getAttribute($this->getAttribute($_form_, "errors"), "email"), ), "method"), "html", null, true);
        echo "
\t\t\t\t</div>
\t\t\t\t<div class=\"clear\"></div>
\t\t\t\t<div class=\"label\"><label for=\"first_name\">First Name:</label></div>
\t\t\t\t<div class=\"input input_big\">
\t\t\t\t\t";
        // line 535
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "input", array("first_name", $this->getAttribute($this->getAttribute($_form_, "values"), "first_name"), ), "method"), "html", null, true);
        echo "
\t\t\t\t\t";
        // line 536
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "errors", array($this->getAttribute($this->getAttribute($_form_, "errors"), "first_name"), ), "method"), "html", null, true);
        echo "
\t\t\t\t</div>
\t\t\t\t<div class=\"clear\"></div>
\t\t\t\t<div class=\"label\"><label for=\"last_name\">Last Name:</label></div>
\t\t\t\t<div class=\"input input_big\">
\t\t\t\t\t";
        // line 541
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "input", array("last_name", $this->getAttribute($this->getAttribute($_form_, "values"), "last_name"), ), "method"), "html", null, true);
        echo "
\t\t\t\t\t";
        // line 542
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "errors", array($this->getAttribute($this->getAttribute($_form_, "errors"), "last_name"), ), "method"), "html", null, true);
        echo "
\t\t\t\t</div>
\t\t\t\t<div class=\"clear\"></div>
\t\t\t\t";
        // line 554
        echo "\t\t\t</div>
\t\t\t<div class=\"form-global form-reg clearfix\">
\t\t\t\t";
        // line 564
        echo "\t\t\t\t";
        // line 570
        echo "\t\t\t\t";
        // line 578
        echo "\t\t\t\t";
        // line 584
        echo "\t\t\t\t<div class=\"label\"><label for=\"country\">Country:</label></div>
\t\t\t\t<div class=\"input input_big\">
\t\t\t\t\t";
        // line 586
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "select", array("country", $this->getAttribute($this->getAttribute($_form_, "countries"), "options"), $this->getAttribute($this->getAttribute($_form_, "values"), "country"), ), "method"), "html", null, true);
        echo "
\t\t\t\t\t";
        // line 587
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "errors", array($this->getAttribute($this->getAttribute($_form_, "errors"), "country"), ), "method"), "html", null, true);
        echo "
\t\t\t\t</div>
\t\t\t\t<div class=\"clear\"></div>
\t\t\t\t<div class=\"label\"><label for=\"referral\">Referral id:</label></div>
\t\t\t\t<div class=\"input input_big\">
\t\t\t\t\t";
        // line 592
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "input", array("referral", $this->getAttribute($this->getAttribute($_form_, "values"), "referral"), ), "method"), "html", null, true);
        echo "
\t\t\t\t\t";
        // line 593
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "errors", array($this->getAttribute($this->getAttribute($_form_, "errors"), "referral"), ), "method"), "html", null, true);
        echo "
\t\t\t\t\t<br /><em style=\"color:#000\">You must provide a Referral ID from an existing member in order to register.</em>
\t\t\t\t</div>
\t\t\t\t<div class=\"clear\"></div>
\t\t\t\t<div class=\"label\"><label for=\"terms\"></label></div>
\t\t\t\t<div class=\"input input_big\">
\t\t\t\t\t<input type=\"checkbox\" name=\"terms\" id=\"terms\" style=\"width: 20px;\" value=\"1\" />
\t\t\t\t\t<a href=\"/Terms and Conditions.pdf\" target=\"_blank\">I agree with the Terms and Conditions</a>
\t\t\t\t\t";
        // line 601
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "errors", array($this->getAttribute($this->getAttribute($_form_, "errors"), "terms"), ), "method"), "html", null, true);
        echo "
\t\t\t\t</div>
\t\t\t\t<div class=\"clear\"></div>
\t\t\t</div>
\t\t\t<div class=\"form-global clearfix\">
\t\t\t\t<div class=\"label\"><label>&nbsp;</label></div>
\t\t\t\t<div class=\"left\">
\t\t\t\t\t";
        // line 609
        echo "\t\t\t\t\t<div class=\"small-button\">
\t\t\t\t\t\t<a href=\"\" ";
        // line 610
        if (isset($context["app"])) { $_app_ = $context["app"]; } else { $_app_ = null; }
        if ($this->getAttribute($_app_, "ajax")) {
        } else {
            echo "onclick=\"document.forms['frmRegister'].submit();";
        }
        echo " return false;\" class=\"";
        if (isset($context["app"])) { $_app_ = $context["app"]; } else { $_app_ = null; }
        if ($this->getAttribute($_app_, "ajax")) {
            echo "modal-submit";
        }
        echo "\">
\t\t\t\t\t\t\t<div class=\"button_see\">
\t\t\t\t\t\t\t\t<div class=\"small-left\"></div>
\t\t\t\t\t\t\t\t<div class=\"small-center\">Register</div>
\t\t\t\t\t\t\t\t<div class=\"small-right\"></div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</a>
\t\t\t\t\t</div>
\t\t\t\t\t<input type=\"submit\" style=\"display: none;\" />
\t\t\t\t</div>
\t\t\t</div>
\t\t</form>
\t";
    }

    public function getTemplateName()
    {
        return "requestmembership.twig";
    }

    public function isTraitable()
    {
        return false;
    }
}
