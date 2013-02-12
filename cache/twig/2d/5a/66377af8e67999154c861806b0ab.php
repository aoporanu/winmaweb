<?php

/* myaccount/profile_products.twig */
class __TwigTemplate_2d5a66377af8e67999154c861806b0ab extends Twig_Template
{
    protected function doGetParent(array $context)
    {
        return false;
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        if (isset($context["products"])) { $_products_ = $context["products"]; } else { $_products_ = null; }
        if ($_products_) {
            // line 2
            echo "<div class=\"ma_top\"></div>
<div class=\"ma_content\">
    ";
            // line 4
            if (isset($context["products"])) { $_products_ = $context["products"]; } else { $_products_ = null; }
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($_products_);
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
                // line 5
                echo "\t\t<div class=\"blog-small\">
            <div class=\"title-blog-small\">
                <a href=\"/";
                // line 7
                if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($_product_, "User"), 0, array(), "array"), "username"), "html", null, true);
                echo "/";
                if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($_product_, "Product"), 0, array(), "array"), "slug"), "html", null, true);
                echo ".html\">";
                if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($_product_, "Product"), 0, array(), "array"), "name"), "html", null, true);
                echo "</a>
            </div><!--/title-blog-small-->
            <div class=\"images-small\">
                <a rel=\"single\" title=\"\" class=\"pirobox \" href=\"/";
                // line 10
                if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($_product_, "User"), 0, array(), "array"), "username"), "html", null, true);
                echo "/";
                if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($_product_, "Product"), 0, array(), "array"), "slug"), "html", null, true);
                echo ".html\">
                    <img width=\"240\" height=\"156\" src=\"";
                // line 11
                if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($_product_, "Product"), 0, array(), "array"), "ProductMedia"), 0, array(), "array"), "dir"), "html", null, true);
                echo "/thumb250x156/";
                if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($_product_, "Product"), 0, array(), "array"), "ProductMedia"), 0, array(), "array"), "file_name"), "html", null, true);
                echo "_";
                if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($_product_, "Product"), 0, array(), "array"), "ProductMedia"), 0, array(), "array"), "id"), "html", null, true);
                echo ".";
                if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($_product_, "Product"), 0, array(), "array"), "ProductMedia"), 0, array(), "array"), "ext"), "html", null, true);
                echo "\" ";
                echo ">
                </a>
                    <div class=\"statistic\">
                        <ul>
                                <li>Deal Value<p>";
                // line 15
                if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
                echo twig_escape_filter($this->env, twig_currency($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($_product_, "Product"), 0, array(), "array"), "ProductPrice"), 0, array(), "array"), "suplier_price")), "html", null, true);
                echo "</p></li>
                                <li class=\"statistic-border\"></li>
                                <li>Discount<p>";
                // line 17
                if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($_product_, "Product"), 0, array(), "array"), "ProductPrice"), 0, array(), "array"), "discount"), "html", null, true);
                echo "%</p></li>
                                <li class=\"statistic-border\"></li>
                                <li>Price<p>";
                // line 19
                if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
                echo twig_escape_filter($this->env, twig_currency($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($_product_, "Product"), 0, array(), "array"), "ProductPrice"), 0, array(), "array"), "price")), "html", null, true);
                echo "</p></li>
                        </ul>
                </div><!--statistic-->
            </div><!--/images-small-->
            <div style=\"width:285px;padding-left:5px;\" class=\"blog-small-button\">
                <div style=\"width:25px;\" class=\"left\">Deal Ends In</div>
                <div class=\"timer_content";
                // line 25
                if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($_product_, "Product"), 0, array(), "array"), "id"), "html", null, true);
                echo " left timer_content_original\">
                    ";
                // line 26
                if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
                echo twig_escape_filter($this->env, twig_date_format_filter($this->getAttribute($this->getAttribute($this->getAttribute($_product_, "Product"), 0, array(), "array"), "endtime"), "d H:i:s"), "html", null, true);
                echo "
                </div>
                <script type=\"text/javascript\">
                    // javascriptul trebuie tinut in pagina, ca sa citeasca id-ul la produs, altfel nu va merge
                    // nici un contor.
                    var t = \"";
                // line 31
                if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($_product_, "Product"), 0, array(), "array"), "endtime"), "html", null, true);
                echo "\".split(/[- :]/);
                    var d = new Date(t[0], t[1]-1, t[2], t[3], t[4], t[5]);
                    \$('.timer_content";
                // line 33
                if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($_product_, "Product"), 0, array(), "array"), "id"), "html", null, true);
                echo "').countdown({ until: d, format: 'ODHMS', onExpiry: \$(this).parent().parent().remove() });
                    \$('.border-vertical').css('margin', '7px 16px -290px');
                </script>
                <div class=\"small-button\">
                    <a href=\"/";
                // line 37
                if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($_product_, "User"), 0, array(), "array"), "username"), "html", null, true);
                echo "/";
                if (isset($context["product"])) { $_product_ = $context["product"]; } else { $_product_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($_product_, "Product"), 0, array(), "array"), "slug"), "html", null, true);
                echo ".html\">
                        <div class=\"button_see\">
                            <div class=\"small-left\"></div>
                            <div class=\"small-center\">SEE DEAL</div>
                            <div class=\"small-right\"></div>
                        </div>
                    </a><!--/button-->
                </div><!--/small-button-->
            </div><!--/blog-small-button-->
\t</div><!--/blog-small-->
    <div class=\"";
                // line 47
                if (isset($context["loop"])) { $_loop_ = $context["loop"]; } else { $_loop_ = null; }
                echo twig_escape_filter($this->env, twig_cycle(array(0 => "", 1 => "border-vertical"), $this->getAttribute($_loop_, "index")), "html", null, true);
                echo "\"></div>
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
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['product'], $context['_parent'], $context['loop']);
            $context = array_merge($_parent, array_intersect_key($context, $_parent));
            // line 49
            echo "    <div class=\"clearfix\"></div>
    </div>
<!--</div> -->
<div class=\"ma_bottom\"></div>
";
        }
    }

    public function getTemplateName()
    {
        return "myaccount/profile_products.twig";
    }

    public function isTraitable()
    {
        return false;
    }
}
