<?php

/* product/edit.twig */
class __TwigTemplate_2d58aed8d3571a1e9a65ec40f98d5abe extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->blocks = array(
            'content' => array($this, 'block_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return $this->env->resolveTemplate((($this->getContext($context, "imgajax")) ? ("layouts/ajax.twig") : ("layouts/layout.twig")));
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 2
        $context["forms"] = $this->env->loadTemplate("/forms/forms.twig");
        $this->getParent($context)->display($context, array_merge($this->blocks, $blocks));
    }

    // line 4
    public function block_content($context, array $blocks = array())
    {
        // line 5
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        if ($this->getAttribute($_form_, "errors")) {
            // line 6
            echo "    <div class=\"error_box\"><strong>There were errors - please verify all fields for errors</strong></div>
";
        }
        // line 8
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        if ($this->getAttribute($_form_, "success")) {
            // line 9
            echo "    <div class=\"infotip\"><strong>Success</strong><br /><br />Product edited successfully</div>
";
        }
        // line 11
        echo "<form enctype=\"application/x-www-form-urlencoded\" action=\"";
        if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
        if (isset($context["product_id"])) { $_product_id_ = $context["product_id"]; } else { $_product_id_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array(("@manageProducts?ac=edit&id=" . $_product_id_), ), "method"), "html", null, true);
        echo "\" method=\"post\">
    <div class=\"form-global clearfix\">
        <div class=\"clearfix\">
        <div class=\" label label_big\"><label for=\"factor\">WMW Share Factor %:</label></div>
        <div class=\"input\">
            ";
        // line 16
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "input", array("factor", $this->getAttribute($this->getAttribute($_form_, "values"), "factor"), ), "method"), "html", null, true);
        echo "
            ";
        // line 17
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "errors", array($this->getAttribute($this->getAttribute($_form_, "errors"), "factor"), ), "method"), "html", null, true);
        echo "
        </div>
        </div>
        <div class=\"clearfix\">
        <div class=\" label label_big\"><label for=\"status\">Status:</label></div>
        <div class=\"input\">
            ";
        // line 23
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "select", array("status", $this->getAttribute($this->getAttribute($_form_, "status"), "options"), $this->getAttribute($this->getAttribute($_form_, "values"), "status"), ), "method"), "html", null, true);
        echo "
            ";
        // line 24
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "errors", array($this->getAttribute($this->getAttribute($_form_, "errors"), "status"), ), "method"), "html", null, true);
        echo "
        </div>
        </div>
        <div class=\"clearfix\">
        <div class=\" label label_big\"><label for=\"name\">Offer name:</label></div>
        <div class=\"input\">
            ";
        // line 30
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "input", array("name", $this->getAttribute($this->getAttribute($_form_, "values"), "name"), ), "method"), "html", null, true);
        echo "
            ";
        // line 31
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "errors", array($this->getAttribute($this->getAttribute($_form_, "errors"), "name"), ), "method"), "html", null, true);
        echo "
        </div>
        </div>
        <div class=\"clearfix\">
        <div class=\" label label_big\"><label for=\"company\">Company:</label></div>
        <div class=\"input\">
            ";
        // line 37
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "select", array("company", $this->getAttribute($this->getAttribute($_form_, "companies"), "options"), $this->getAttribute($this->getAttribute($_form_, "values"), "company"), ), "method"), "html", null, true);
        echo "
            ";
        // line 38
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "errors", array($this->getAttribute($this->getAttribute($_form_, "errors"), "company"), ), "method"), "html", null, true);
        echo "
        </div>
        </div>
        <div class=\"clearfix\">
        <div class=\" label label_big\"><label for=\"min_sold\">Min sold:</label></div>
        <div class=\"input\">
            ";
        // line 44
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "input", array("min_sold", $this->getAttribute($this->getAttribute($_form_, "values"), "min_sold"), ), "method"), "html", null, true);
        echo "
            ";
        // line 45
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "errors", array($this->getAttribute($this->getAttribute($_form_, "errors"), "min_sold"), ), "method"), "html", null, true);
        echo "
        </div>
        </div>
        <div class=\"clearfix\">
            <div class=\" label label_big\"></div>
            <div class=\"input\">
            <div style=\"color:#666\">Minimum sold deals, before deal is active</div>
        </div>
        </div>
        <div class=\"clearfix\">
        <div class=\" label label_big\"><label for=\"max_sold\">Max sold:</label></div>
        <div class=\"input\">
            ";
        // line 57
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "input", array("max_sold", $this->getAttribute($this->getAttribute($_form_, "values"), "max_sold"), ), "method"), "html", null, true);
        echo "
            ";
        // line 58
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "errors", array($this->getAttribute($this->getAttribute($_form_, "errors"), "max_sold"), ), "method"), "html", null, true);
        echo "
        </div>
        </div>
        <div class=\"clearfix\">
            <div class=\" label label_big\"></div>
            <div class=\"input\">
            <div style=\"color:#666\">Maximum deals a user can buy</div>
        </div>
        </div>
        <div class=\"prices-box\">
        ";
        // line 68
        if (isset($context["no"])) { $_no_ = $context["no"]; } else { $_no_ = null; }
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable(range(1, $_no_));
        foreach ($context['_seq'] as $context["_key"] => $context["x"]) {
            // line 69
            echo "        <div class=\"price-box\">
        <input type=\"hidden\" name=\"price[]\" id=\"price\" value=\"1\" />
        <div style=\"border:1px solid #cacaca;padding:5px;margin:10px 0;\">
            <div class=\"clearfix\">
            <div class=\"label label_big\"><label for=\"offer_price_name_";
            // line 73
            if (isset($context["x"])) { $_x_ = $context["x"]; } else { $_x_ = null; }
            echo twig_escape_filter($this->env, $_x_, "html", null, true);
            echo "\">Offer price name #";
            if (isset($context["x"])) { $_x_ = $context["x"]; } else { $_x_ = null; }
            echo twig_escape_filter($this->env, $_x_, "html", null, true);
            echo ":</label></div>
            <div class=\"input\">
                ";
            // line 75
            if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
            if (isset($context["x"])) { $_x_ = $context["x"]; } else { $_x_ = null; }
            if (isset($context["price_form"])) { $_price_form_ = $context["price_form"]; } else { $_price_form_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "input", array(("offer_price_name_" . $_x_), $this->getAttribute($_price_form_, "getValue", array(("offer_price_name_" . $_x_), ), "method"), ), "method"), "html", null, true);
            echo "
                ";
            // line 76
            if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
            if (isset($context["price_form"])) { $_price_form_ = $context["price_form"]; } else { $_price_form_ = null; }
            if (isset($context["x"])) { $_x_ = $context["x"]; } else { $_x_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "errors", array($this->getAttribute($_price_form_, "getMessages", array(("offer_price_name_" . $_x_), ), "method"), ), "method"), "html", null, true);
            echo "
            </div>
            </div>
                
            <div class=\"clearfix\">
            <div class=\" label label_big\"><label for=\"producer_price_";
            // line 81
            if (isset($context["x"])) { $_x_ = $context["x"]; } else { $_x_ = null; }
            echo twig_escape_filter($this->env, $_x_, "html", null, true);
            echo "\">Suplier price \$#";
            if (isset($context["x"])) { $_x_ = $context["x"]; } else { $_x_ = null; }
            echo twig_escape_filter($this->env, $_x_, "html", null, true);
            echo ":</label></div>
            <div class=\"input\">
                ";
            // line 83
            if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
            if (isset($context["x"])) { $_x_ = $context["x"]; } else { $_x_ = null; }
            if (isset($context["price_form"])) { $_price_form_ = $context["price_form"]; } else { $_price_form_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "input", array(("producer_price_" . $_x_), $this->getAttribute($_price_form_, "getValue", array(("producer_price_" . $_x_), ), "method"), ), "method"), "html", null, true);
            echo "
                ";
            // line 84
            if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
            if (isset($context["price_form"])) { $_price_form_ = $context["price_form"]; } else { $_price_form_ = null; }
            if (isset($context["x"])) { $_x_ = $context["x"]; } else { $_x_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "errors", array($this->getAttribute($_price_form_, "getMessages", array(("producer_price_" . $_x_), ), "method"), ), "method"), "html", null, true);
            echo "
            </div>
            </div>
                
            <div class=\"clearfix\">
            <div class=\" label label_big\"><label for=\"discount_";
            // line 89
            if (isset($context["x"])) { $_x_ = $context["x"]; } else { $_x_ = null; }
            echo twig_escape_filter($this->env, $_x_, "html", null, true);
            echo "\">Discount %#";
            if (isset($context["x"])) { $_x_ = $context["x"]; } else { $_x_ = null; }
            echo twig_escape_filter($this->env, $_x_, "html", null, true);
            echo ":</label></div>
            <div class=\"input\">
                ";
            // line 91
            if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
            if (isset($context["x"])) { $_x_ = $context["x"]; } else { $_x_ = null; }
            if (isset($context["price_form"])) { $_price_form_ = $context["price_form"]; } else { $_price_form_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "input", array(("discount_" . $_x_), $this->getAttribute($_price_form_, "getValue", array(("discount_" . $_x_), ), "method"), ), "method"), "html", null, true);
            echo "
                ";
            // line 92
            if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
            if (isset($context["price_form"])) { $_price_form_ = $context["price_form"]; } else { $_price_form_ = null; }
            if (isset($context["x"])) { $_x_ = $context["x"]; } else { $_x_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "errors", array($this->getAttribute($_price_form_, "getMessages", array(("discount_" . $_x_), ), "method"), ), "method"), "html", null, true);
            echo "
            </div>
            </div>
                
            <div class=\"clearfix\">
            <div class=\" label label_big\"><label>Your price #";
            // line 97
            if (isset($context["x"])) { $_x_ = $context["x"]; } else { $_x_ = null; }
            echo twig_escape_filter($this->env, $_x_, "html", null, true);
            echo ":</label></div>
            <div class=\"input\" style=\"padding:4px;\" id=\"product_price_";
            // line 98
            if (isset($context["x"])) { $_x_ = $context["x"]; } else { $_x_ = null; }
            echo twig_escape_filter($this->env, $_x_, "html", null, true);
            echo "\">\$ <span id=\"pr_";
            if (isset($context["x"])) { $_x_ = $context["x"]; } else { $_x_ = null; }
            echo twig_escape_filter($this->env, $_x_, "html", null, true);
            echo "\" class=\"s\">0</span> <a href=\"#\" class=\"calc\" rel=\"";
            if (isset($context["x"])) { $_x_ = $context["x"]; } else { $_x_ = null; }
            echo twig_escape_filter($this->env, $_x_, "html", null, true);
            echo "\">Calculate</a></div>
            </div>
\t\t\t\t\t\t<script>
\t\t\t\t\t\t\tfunction roundNumber2(num, dec) {
\t\t\t\t\t\t\t\tvar result = String(Math.round(num*Math.pow(10,dec))/Math.pow(10,dec));
\t\t\t\t\t\t\t\tif(result.indexOf('.')<0) {result+= '.';}
\t\t\t\t\t\t\t\twhile(result.length- result.indexOf('.')<=dec) {result+= '0';}
\t\t\t\t\t\t\t\treturn result;
\t\t\t\t\t\t\t}
\t\t\t\t\t\t\tvar pr = \$('#producer_price_'+";
            // line 107
            if (isset($context["x"])) { $_x_ = $context["x"]; } else { $_x_ = null; }
            echo twig_escape_filter($this->env, $_x_, "html", null, true);
            echo ").val();
\t\t\t\t\t\t\tvar dc = \$('#discount_'+";
            // line 108
            if (isset($context["x"])) { $_x_ = $context["x"]; } else { $_x_ = null; }
            echo twig_escape_filter($this->env, $_x_, "html", null, true);
            echo ").val();
\t\t\t\t\t\t\t\$('#pr_'+";
            // line 109
            if (isset($context["x"])) { $_x_ = $context["x"]; } else { $_x_ = null; }
            echo twig_escape_filter($this->env, $_x_, "html", null, true);
            echo ").html(roundNumber2(pr - roundNumber2(pr*dc/100, 2), 2));
\t\t\t\t\t\t</script>
            <div class=\"clearfix\">
            <div class=\" label label_big\"><label for=\"stock_";
            // line 112
            if (isset($context["x"])) { $_x_ = $context["x"]; } else { $_x_ = null; }
            echo twig_escape_filter($this->env, $_x_, "html", null, true);
            echo "\">Stock #";
            if (isset($context["x"])) { $_x_ = $context["x"]; } else { $_x_ = null; }
            echo twig_escape_filter($this->env, $_x_, "html", null, true);
            echo ":</label></div>
            <div class=\"input\">
                ";
            // line 114
            if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
            if (isset($context["x"])) { $_x_ = $context["x"]; } else { $_x_ = null; }
            if (isset($context["price_form"])) { $_price_form_ = $context["price_form"]; } else { $_price_form_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "input", array(("stock_" . $_x_), $this->getAttribute($_price_form_, "getValue", array(("stock_" . $_x_), ), "method"), ), "method"), "html", null, true);
            echo "
                ";
            // line 115
            if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
            if (isset($context["price_form"])) { $_price_form_ = $context["price_form"]; } else { $_price_form_ = null; }
            if (isset($context["x"])) { $_x_ = $context["x"]; } else { $_x_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "errors", array($this->getAttribute($_price_form_, "getMessages", array(("stock_" . $_x_), ), "method"), ), "method"), "html", null, true);
            echo "
            </div>
            </div>
            <div class=\"clearfix\">
            <div class=\" label label_big\"><label for=\"expire_";
            // line 119
            if (isset($context["x"])) { $_x_ = $context["x"]; } else { $_x_ = null; }
            echo twig_escape_filter($this->env, $_x_, "html", null, true);
            echo "\">Expire #";
            if (isset($context["x"])) { $_x_ = $context["x"]; } else { $_x_ = null; }
            echo twig_escape_filter($this->env, $_x_, "html", null, true);
            echo ":</label></div>
            <div class=\"input\">
                ";
            // line 122
            echo "                <input type=\"text\" name=\"";
            if (isset($context["x"])) { $_x_ = $context["x"]; } else { $_x_ = null; }
            echo twig_escape_filter($this->env, ("expire_" . $_x_), "html", null, true);
            echo "\" id=\"";
            if (isset($context["x"])) { $_x_ = $context["x"]; } else { $_x_ = null; }
            echo twig_escape_filter($this->env, ("expire_" . $_x_), "html", null, true);
            echo "\" value=\"";
            if (isset($context["price_form"])) { $_price_form_ = $context["price_form"]; } else { $_price_form_ = null; }
            if (isset($context["x"])) { $_x_ = $context["x"]; } else { $_x_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_price_form_, "getValue", array(("expire_" . $_x_), ), "method"), "html", null, true);
            echo "\" class=\"exdate\" />
                ";
            // line 123
            if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
            if (isset($context["price_form"])) { $_price_form_ = $context["price_form"]; } else { $_price_form_ = null; }
            if (isset($context["x"])) { $_x_ = $context["x"]; } else { $_x_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "errors", array($this->getAttribute($_price_form_, "getMessages", array(("expire_" . $_x_), ), "method"), ), "method"), "html", null, true);
            echo "
            </div>
            </div>
            <div class=\"remove-button\">
            ";
            // line 127
            if (isset($context["x"])) { $_x_ = $context["x"]; } else { $_x_ = null; }
            if (isset($context["no"])) { $_no_ = $context["no"]; } else { $_no_ = null; }
            if ((($_x_ == $_no_) && ($_x_ > 1))) {
                // line 128
                echo "            <a href=\"#\" class=\"remove-price\">Remove</a>
            ";
            }
            // line 130
            echo "            </div>
        </div>
        </div>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['x'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 134
        echo "        </div>
        <div class=\"clearfix\">
            <a class=\"g-button g-button-share add-price\" href=\"#\">Add price</a>
        </div>
        ";
        // line 145
        echo "        ";
        // line 152
        echo "        <div class=\"clearfix\">
        <div class=\" label label_big\"></div>
        <div class=\"input\">
        <div style=\"color:#666\">Server time is ";
        // line 155
        if (isset($context["now"])) { $_now_ = $context["now"]; } else { $_now_ = null; }
        echo twig_escape_filter($this->env, twig_date_format_filter($_now_), "html", null, true);
        echo " if you want to show your product imediately you need to set the start time as the server time</div>
        </div>
        </div>
        <div class=\"clearfix\">
        <div class=\" label label_big\"><label for=\"start_time\">Start time:</label></div>
        <div class=\"input\">
            ";
        // line 161
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "input", array("start_time", $this->getAttribute($this->getAttribute($_form_, "values"), "start_time"), ), "method"), "html", null, true);
        echo "
            ";
        // line 162
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "errors", array($this->getAttribute($this->getAttribute($_form_, "errors"), "start_time"), ), "method"), "html", null, true);
        echo "
        </div>
        </div>
        <div class=\"clearfix\">
        <div class=\" label label_big\"><label for=\"end_time\">End time:</label></div>
        <div class=\"input\">
            ";
        // line 168
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "input", array("end_time", $this->getAttribute($this->getAttribute($_form_, "values"), "end_time"), ), "method"), "html", null, true);
        echo "
            ";
        // line 169
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "errors", array($this->getAttribute($this->getAttribute($_form_, "errors"), "end_time"), ), "method"), "html", null, true);
        echo "
        </div>
        </div>
        <div class=\"clearfix\">
        <div class=\" label label_big\"><label for=\"tags\">Tags:</label></div>
        <div class=\"input\">
            ";
        // line 175
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "input", array("tags", $this->getAttribute($this->getAttribute($_form_, "values"), "tags"), ), "method"), "html", null, true);
        echo "
            ";
        // line 176
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "errors", array($this->getAttribute($this->getAttribute($_form_, "errors"), "tags"), ), "method"), "html", null, true);
        echo "
        </div>
        </div>
        <div class=\"clearfix\">
        <div class=\" label label_big\"><label for=\"terms\">Offer terms:</label></div>
        <div class=\"input\">
            ";
        // line 182
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "textarea", array("terms", $this->getAttribute($this->getAttribute($_form_, "values"), "terms"), ), "method"), "html", null, true);
        echo "
            ";
        // line 183
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "errors", array($this->getAttribute($this->getAttribute($_form_, "errors"), "terms"), ), "method"), "html", null, true);
        echo "
        </div>
        </div>
        <div class=\"clearfix\">
        <div class=\" label label_big\"><label for=\"short_description\">Short description:</label></div>
        <div class=\"input\">
            ";
        // line 189
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "textarea", array("short_description", $this->getAttribute($this->getAttribute($_form_, "values"), "short_description"), ), "method"), "html", null, true);
        echo "
            ";
        // line 190
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "errors", array($this->getAttribute($this->getAttribute($_form_, "errors"), "short_description"), ), "method"), "html", null, true);
        echo "
        </div>
        </div>
        <div class=\"clearfix\">
        <div class=\" label label_big\"><label for=\"description\">Description:</label></div>
        <div class=\"input\">
            ";
        // line 196
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "textarea_editor", array("description", $this->getAttribute($this->getAttribute($_form_, "values"), "description"), ), "method"), "html", null, true);
        echo "
            ";
        // line 197
        if (isset($context["forms"])) { $_forms_ = $context["forms"]; } else { $_forms_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_forms_, "errors", array($this->getAttribute($this->getAttribute($_form_, "errors"), "description"), ), "method"), "html", null, true);
        echo "
        </div>
        </div>
    </div>
    <div class=\"form-global clearfix\">
        <div class=\" label label_big\"><label>&nbsp;</label></div>
        <div class=\"left\"><input type=\"submit\" class=\"g-button g-button-submit modal-submit-product\" value=\"Edit\" /></div>
    </div>
</form>
";
    }

    public function getTemplateName()
    {
        return "product/edit.twig";
    }

    public function isTraitable()
    {
        return false;
    }
}
