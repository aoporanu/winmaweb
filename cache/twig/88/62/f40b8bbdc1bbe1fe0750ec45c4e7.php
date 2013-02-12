<?php

/* statistic/user/daily.twig */
class __TwigTemplate_8862f40b8bbdc1bbe1fe0750ec45c4e7 extends Twig_Template
{
    protected function doGetParent(array $context)
    {
        return false;
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<script type=\"text/javascript\">
var chart;
var chart2;
\$(document).ready(function() {
   chart = new Highcharts.Chart({
      chart: {
         renderTo: 'container',
         defaultSeriesType: 'line'
      },
      title: {
         text: 'Daily user registrations ";
        // line 11
        if (isset($context["month"])) { $_month_ = $context["month"]; } else { $_month_ = null; }
        echo twig_escape_filter($this->env, twig_date_format_filter($_month_, "M Y"), "html", null, true);
        echo "'
      },
      subtitle: {
         text: ''
      },
      xAxis: {
         categories: [";
        // line 17
        if (isset($context["per_day"])) { $_per_day_ = $context["per_day"]; } else { $_per_day_ = null; }
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_array_keys_filter($_per_day_));
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
        foreach ($context['_seq'] as $context["_key"] => $context["key"]) {
            if (isset($context["key"])) { $_key_ = $context["key"]; } else { $_key_ = null; }
            echo twig_escape_filter($this->env, $_key_, "html", null, true);
            if (isset($context["loop"])) { $_loop_ = $context["loop"]; } else { $_loop_ = null; }
            if ((!$this->getAttribute($_loop_, "last"))) {
                echo ",";
            }
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
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['key'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        echo "]
      },
      yAxis: {
         title: {
            text: ''
         }
      },
      tooltip: {
         formatter: function() {
             var a = '';
            if(this.series.name == 'Registered') {
                a = ' user(s) registered this day';
            } else {
                a = ' GBP received';
            }
            return '<b>'+ this.series.name +'</b><br/>Day:'+
               this.x +': '+ this.y + a + '';
         }
      },
      plotOptions: {
         line: {
            dataLabels: {
               enabled: true
            },
            enableMouseTracking: true
         }
      },
      series: [{
         name: 'Registered',
         data: [";
        // line 46
        if (isset($context["per_day"])) { $_per_day_ = $context["per_day"]; } else { $_per_day_ = null; }
        echo twig_escape_filter($this->env, twig_join_filter($_per_day_, ", "), "html", null, true);
        echo "]
      }]
   });
});
</script>
<div class=\"clearfix\" style=\"padding-top:40px;text-align:right\">
<a href=\"";
        // line 52
        if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array("@manageStatistics?type=daily", ), "method"), "html", null, true);
        echo "\" class=\"g-button g-button-share g-button-small ajax-link\">Daily per month</a>
<a href=\"";
        // line 53
        if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array("@manageStatistics?type=monthly", ), "method"), "html", null, true);
        echo "\" class=\"g-button g-button-small ajax-link\">Monthly</a>
</div>
<div class=\"clearfix\" style=\"padding-top:20px;\">
    <div class=\"left\"><a style=\"text-align:right\" class=\"right ajax-link\" href=\"";
        // line 56
        if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
        if (isset($context["page"])) { $_page_ = $context["page"]; } else { $_page_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array(("@manageStatistics?page=" . ($_page_ - 1)), ), "method"), "html", null, true);
        echo "\">« Last month</a></div>
    <div class=\"right\"><a style=\"text-align:right\" class=\"right ajax-link\" href=\"";
        // line 57
        if (isset($context["router"])) { $_router_ = $context["router"]; } else { $_router_ = null; }
        if (isset($context["page"])) { $_page_ = $context["page"]; } else { $_page_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_router_, "url_for", array(("@manageStatistics?page=" . ($_page_ + 1)), ), "method"), "html", null, true);
        echo "\">Next month »</a></div>
</div>
<div id=\"container\" style=\"width: 100%; height: 400px\"></div>";
    }

    public function getTemplateName()
    {
        return "statistic/user/daily.twig";
    }

    public function isTraitable()
    {
        return false;
    }
}
