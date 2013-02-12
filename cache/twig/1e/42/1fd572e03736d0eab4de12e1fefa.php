<?php

/* myaccount/myNetwork.twig */
class __TwigTemplate_1e421fd572e03736d0eab4de12e1fefa extends Twig_Template
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
\t\t<h1>My Network</h1>
\t</div>
\t<div style=\"float: right; padding-top: 10px;\">
\t\tMy Referral ID: ";
        // line 19
        if (isset($context["app"])) { $_app_ = $context["app"]; } else { $_app_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($_app_, "user"), "ref_id"), "html", null, true);
        echo "
\t</div>
\t<div style=\"clear: both\"></div>
\t<div class=\"ma_top\"></div>
\t<div class=\"ma_content\">
\t\t";
        // line 24
        if (isset($context["descendents"])) { $_descendents_ = $context["descendents"]; } else { $_descendents_ = null; }
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($_descendents_);
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
        foreach ($context['_seq'] as $context["_key"] => $context["d"]) {
            // line 25
            echo "            ";
            if (isset($context["loop"])) { $_loop_ = $context["loop"]; } else { $_loop_ = null; }
            if ($this->getAttribute($_loop_, "first")) {
                // line 26
                echo "            Network Statistics:
            <br /><br />
            <div style=\"border-bottom:2px solid #cacaca;\">
            <div class=\"clearfix\">
                <div class=\"left strong\" style=\"width:100px\"># of Members</div><div class=\"left strong center\" style=\"width:150px\">in Tier</div><div class=\"left strong center\" style=\"width:150px\">Total in Your Network</div>
            </div>
            </div>
            ";
            }
            // line 34
            echo "            ";
            if (isset($context["total"])) { $_total_ = $context["total"]; } else { $_total_ = null; }
            if (isset($context["d"])) { $_d_ = $context["d"]; } else { $_d_ = null; }
            $context["total"] = ($_total_ + $this->getAttribute($_d_, "no"));
            // line 35
            echo "            <div class=\"clearfix\" style=\"padding: 5px 0\">
            <div class=\"left\" style=\"width:100px\">Tier ";
            // line 36
            if (isset($context["d"])) { $_d_ = $context["d"]; } else { $_d_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_d_, "level"), "html", null, true);
            echo "</div> <div class=\"left center\" style=\"width:150px\">";
            if (isset($context["d"])) { $_d_ = $context["d"]; } else { $_d_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_d_, "no"), "html", null, true);
            echo "</div><div class=\"left center\" style=\"width:150px\">";
            if (isset($context["total"])) { $_total_ = $context["total"]; } else { $_total_ = null; }
            echo twig_escape_filter($this->env, $_total_, "html", null, true);
            echo "</div>
            </div>
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
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['d'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 39
        echo "        ";
        // line 54
        echo "        
    </div>
    <div class=\"ma_bottom\"></div>
";
    }

    // line 59
    public function block_right_side($context, array $blocks = array())
    {
        // line 60
        echo "    ";
        if (isset($context["app"])) { $_app_ = $context["app"]; } else { $_app_ = null; }
        if ((!$this->getAttribute($_app_, "ajax"))) {
            // line 61
            echo "\t\t\t\t";
            $context["ma_menu"] = "network";
            // line 62
            echo "        ";
            $this->env->loadTemplate("myaccount/menu.twig")->display($context);
            // line 63
            echo "    ";
        }
    }

    public function getTemplateName()
    {
        return "myaccount/myNetwork.twig";
    }

    public function isTraitable()
    {
        return false;
    }
}
