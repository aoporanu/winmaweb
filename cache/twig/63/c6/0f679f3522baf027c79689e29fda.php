<?php

/* bank/index.twig */
class __TwigTemplate_63c60f679f3522baf027c79689e29fda extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->blocks = array(
            'content' => array($this, 'block_content'),
            'left_menu' => array($this, 'block_left_menu'),
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
    public function block_content($context, array $blocks = array())
    {
        // line 4
        echo "<h1>Manage Bank</h1>
<div>
<a href=\"";
        // line 6
        if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array("@manageBank", ), "method"), "html", null, true);
        echo "\" class=\"g-button";
        if (isset($context["view"])) { $_view_ = $context["view"]; } else { $_view_ = null; }
        if (($_view_ == "")) {
            echo " g-button-submit";
        }
        echo " ajax-link\">Overall</a>
<a href=\"";
        // line 7
        if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array("@manageBank?view=transactions", ), "method"), "html", null, true);
        echo "\" class=\"g-button";
        if (isset($context["ac"])) { $_ac_ = $context["ac"]; } else { $_ac_ = null; }
        if (($_ac_ == "view")) {
            echo " g-button-submit";
        }
        echo " g-button ajax-link\">Transactions</a>
<a href=\"";
        // line 8
        if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array("@manageBank?view=withdraw", ), "method"), "html", null, true);
        echo "\" class=\"g-button ajax-link\">Withdraw</a>
<a href=\"";
        // line 9
        if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array("@manageBank?view=coupons", ), "method"), "html", null, true);
        echo "\" class=\"g-button ajax-link\">Vouchers</a>
</div>
<br /><br />

Your earnings:<br />
In Wallet: <span style=\"font-weight: bold;color:#29691d;font-size: 14px;\">";
        // line 14
        if (isset($context["wallet"])) { $_wallet_ = $context["wallet"]; } else { $_wallet_ = null; }
        echo twig_escape_filter($this->env, twig_currency($_wallet_), "html", null, true);
        echo "</span><br /><br />
In WMW Account: <span style=\"font-weight: bold;color:#29691d;font-size: 14px;\">";
        // line 15
        if (isset($context["virtual_wallet"])) { $_virtual_wallet_ = $context["virtual_wallet"]; } else { $_virtual_wallet_ = null; }
        echo twig_escape_filter($this->env, twig_currency($_virtual_wallet_), "html", null, true);
        echo "</span>
";
        // line 16
        if (isset($context["virtual_wallet"])) { $_virtual_wallet_ = $context["virtual_wallet"]; } else { $_virtual_wallet_ = null; }
        if (($_virtual_wallet_ > 0)) {
            echo "<a href=\"";
            if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array("@manageBank?ac=twallet", ), "method"), "html", null, true);
            echo "\" class=\"ajax-confirm\" title=\"Are you sure you want to transfer the money from bank virtual wallet to bank wallet?\">Transfer to wallet</a>";
        }
        // line 17
        echo "
<br /><br />
<script type=\"text/javascript\">
function requestData() {
    \$.ajax({
        url: '/admin/live/bank-wallet',
        success: function(point) {
            var series = bank.series[0],
                shift = series.data.length > 20; // shift if the series is longer than 20
            
            point[0] = new Date().getTime();
            
            // add the point
            bank.series[0].addPoint(point, true, shift);

            // call it again after one second
            setTimeout(requestData, 1000);    
        },
        cache: false
    });
}
var bank;
var chart2;
Highcharts.setOptions({
    global: {
        useUTC: false
    }
});
\$(document).ready(function() {
   bank = new Highcharts.Chart({
      chart: {
         renderTo: 'container',
         defaultSeriesType: 'spline',
         events: {
                load: requestData
            }
      },
      credits: {
        enabled: false
    },
      title: {
         text: 'Bank wallet, live'
      },
      subtitle: {
         text: ''
      },
       xAxis: {
            type: 'datetime',
            tickPixelInterval: 150,
            maxZoom: 20 * 1000,
            //dateTimeLabelFormats: '%H:%M:%S'
        },
        yAxis: {
            minPadding: 0.2,
            maxPadding: 0.2,
            title: {
                text: 'Money',
                margin: 10
            },
            allowDecimals: true
        },
      tooltip: {
         formatter: function() {
                   return '<b>'+ this.series.name +'</b><br/>'+
               Highcharts.dateFormat('%Y-%m-%d %H:%M:%S', this.x) +'<br/>'+ 
               Highcharts.numberFormat(this.y, 2)+'\$';
         }
      },
      legend: {
         enabled: false
      },
      exporting: {
         enabled: false
      },
      plotOptions: {
         line: {
            dataLabels: {
               enabled: false
            },
            enableMouseTracking: true
         }
      },
      series: [{
         name: 'Value',
         data: []
      }]
   });
});
</script>
Local time: ";
        // line 106
        echo twig_escape_filter($this->env, twig_date_format_filter("now"), "html", null, true);
        echo "
<br /><br />
<div id=\"container\" style=\"width: 100%; height: 400px\"></div>
";
    }

    // line 110
    public function block_left_menu($context, array $blocks = array())
    {
        // line 111
        echo "    ";
        if (isset($context["app"])) { $_app_ = $context["app"]; } else { $_app_ = null; }
        if ((!$this->getAttribute($_app_, "ajax"))) {
            // line 112
            echo "        ";
            $context["adm_menu"] = "bank";
            // line 113
            echo "        ";
            $this->env->loadTemplate("inc/leftSide.twig")->display($context);
            // line 114
            echo "    ";
        }
    }

    public function getTemplateName()
    {
        return "bank/index.twig";
    }

    public function isTraitable()
    {
        return false;
    }
}
