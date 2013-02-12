<?php

/* myaccount/myReferralsVisual.twig */
class __TwigTemplate_81638d322130245b671078be885e5b5d extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->blocks = array(
            'content_page' => array($this, 'block_content_page'),
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
    public function block_content_page($context, array $blocks = array())
    {
        // line 5
        echo "<script type=\"text/javascript\">
var labelType, useGradients, nativeTextSupport, animate;

var Log = {
  elem: false,
  write: function(text){
    if (!this.elem) 
      this.elem = document.getElementById('log');
    this.elem.innerHTML = text;
    //this.elem.style.left = (500 - this.elem.offsetWidth / 2) + 'px';
  }
};
function dump(arr,level) {
\tvar dumped_text = \"\";
\tif(!level) level = 0;
\t
\t//The padding given at the beginning of the line.
\tvar level_padding = \"\";
\tfor(var j=0;j<level+1;j++) level_padding += \"    \";
\t
\tif(typeof(arr) == 'object') { //Array/Hashes/Objects 
\t\tfor(var item in arr) {
\t\t\tvar value = arr[item];
\t\t\t
\t\t\tif(typeof(value) == 'object') { //If it is an array,
\t\t\t\tdumped_text += level_padding + \"'\" + item + \"' ...\\n\";
\t\t\t\tdumped_text += dump(value,level+1);
\t\t\t} else {
\t\t\t\tdumped_text += level_padding + \"'\" + item + \"' => \\\"\" + value + \"\\\"\\n\";
\t\t\t}
\t\t}
\t} else { //Stings/Chars/Numbers etc.
\t\tdumped_text = \"===>\"+arr+\"<===(\"+typeof(arr)+\")\";
\t}
\treturn dumped_text;
}
function init(){
    //init data
    var json = {
        id: \"node\",
        name: \"You\",
        data: {},
        children: [
            ";
        // line 48
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
        foreach ($context['_seq'] as $context["_key"] => $context["desc"]) {
            // line 49
            echo "            {
            id: \"node_";
            // line 50
            if (isset($context["desc"])) { $_desc_ = $context["desc"]; } else { $_desc_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_desc_, "id"), "html", null, true);
            echo "\",
            name: \"";
            // line 51
            if (isset($context["desc"])) { $_desc_ = $context["desc"]; } else { $_desc_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_desc_, "username"), "html", null, true);
            echo "\",
            data: {},
            children: []
            }";
            // line 54
            if (isset($context["loop"])) { $_loop_ = $context["loop"]; } else { $_loop_ = null; }
            if ((!$this->getAttribute($_loop_, "last"))) {
                echo ",";
            }
            // line 55
            echo "            ";
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
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['desc'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 56
        echo "        ]
    };
    //end
    
    //A client-side tree generator
    var getTree = (function() {
        var i = 0;
        return function(nodeId, level) {
          Log.write('This user doesnt have any new referrals');
          if(i != 0) {
          var subtree = eval('(' + json.replace(/id:\\\"([a-zA-Z0-9]+)\\\"/g, 
          function(all, match) {
            return \"id:\\\"\" + match + \"_\" + i + \"\\\"\"  
          }) + ')');
          \$jit.json.prune(subtree, level); i++;
          return {
              'id': nodeId,
              'children': subtree.children
          };
          }
        };
    })();
    
    //Implement a node rendering function called 'nodeline' that plots a straight line
    //when contracting or expanding a subtree.
    \$jit.ST.Plot.NodeTypes.implement({
        'nodeline': {
          'render': function(node, canvas, animating) {
                if(animating === 'expand' || animating === 'contract') {
                  var pos = node.pos.getc(true), nconfig = this.node, data = node.data;
                  var width  = nconfig.width, height = nconfig.height;
                  var algnPos = this.getAlignedPos(pos, width, height);
                  var ctx = canvas.getCtx(), ort = this.config.orientation;
                  ctx.beginPath();
                  if(ort == 'left' || ort == 'right') {
                      ctx.moveTo(algnPos.x, algnPos.y + height / 2);
                      ctx.lineTo(algnPos.x + width, algnPos.y + height / 2);
                  } else {
                      ctx.moveTo(algnPos.x + width / 2, algnPos.y);
                      ctx.lineTo(algnPos.x + width / 2, algnPos.y + height);
                  }
                  ctx.stroke();
              } 
          }
        }
          
    });

    //init Spacetree
    //Create a new ST instance
    var st = new \$jit.ST({
        'injectInto': 'infovis',
        //set duration for the animation
        duration: 800,
        orientation: 'left',
        //set animation transition type
        transition: \$jit.Trans.Quart.easeInOut,
        //set distance between node and its children
        levelDistance: 50,
        //set max levels to show. Useful when used with
        //the request method for requesting trees of specific depth
        levelsToShow: 1,
        //set node and edge styles
        //set overridable=true for styling individual
        //nodes or edges
        Navigation: {  
            enable: true,  
            panning: 'avoid nodes',  
            //zooming: 20  
        },
        
        /*Tips: {  
            enable: true,  
            type: 'Native',  
            offsetX: 10,  
            offsetY: 10,  
            onShow: function(tip, node) {  
                tip.innerHTML = node.name;  
            }  
        },*/
        
        Node: {
            //height: 20,
            //width: 80,
            autoWidth: true,
            autoHeight: true,
            //use a custom
            //node rendering function
            type: 'nodeline',
            color:'#23A4FF',
            lineWidth: 2,
            align:\"center\",
            overridable: true
        },
        
        Edge: {
            type: 'bezier',
            lineWidth: 2,
            autoWidth: true,
            autoHeight: true,
            color:'#23A4FF',
            overridable: true
        },
        
        //Add a request method for requesting on-demand json trees. 
        //This method gets called when a node
        //is clicked and its subtree has a smaller depth
        //than the one specified by the levelsToShow parameter.
        //In that case a subtree is requested and is added to the dataset.
        //This method is asynchronous, so you can make an Ajax request for that
        //subtree and then handle it to the onComplete callback.
        //Here we just use a client-side tree generator (the getTree function).
        request: function(nodeId, level, onComplete) {
          //var ans = getTree(nodeId, level);
          \$.ajax({
                url: '/my-account/getSubTree?node=' + nodeId,
                dataType: 'json',
                beforeSend: function(){
                    
                },
                success: function(data){
                    
                    /*var ans = {
                    id: nodeId,
                    children: [{
                        id: nodeId+\"1\",
                        name: nodeId+\"name 1\"
                    },{
                        id: nodeId+\"2\",
                        name: nodeId+\"name 2\"
                    },{
                        id: nodeId+\"3\",
                        name: nodeId+\"name 3\"
                    }]
                };*/
                onComplete.onComplete(nodeId,data);  
                }
            });
          
        },
        
        onBeforeCompute: function(node){
            
            Log.write(\"Loading \" + node.name);
        },
        
        onAfterCompute: function(){
            Log.write(\"Done\");
        },
        
        onComplete: function(){
            //Log.write(Log.write(dump(ans)));
        },
        
        //This method is called on DOM label creation.
        //Use this method to add event handlers and styles to
        //your node.
        onCreateLabel: function(label, node){
            label.id = node.id;            
            label.innerHTML = node.name;
            label.onclick = function(){
                st.onClick(node.id);
            };
            label.overridable = true;
            //set label styles
            var style = label.style;
            //style.width = 80 + 'px';
            //style.height = 17 + 'px';            
            style.cursor = 'pointer';
            style.color = '#fff';
            //style.backgroundColor = '#1a1a1a';
            style.fontSize = '0.8em';
            style.textAlign= 'center';
            style.textDecoration = 'underline';
            style.paddingTop = '14px';
            style.paddingLeft = '5px';
        },
        
        //This method is called right before plotting
        //a node. It's useful for changing an individual node
        //style properties before plotting it.
        //The data properties prefixed with a dollar
        //sign will override the global node style properties.
        onBeforePlotNode: function(node){
            //add some color to the nodes in the path between the
            //root node and the selected node.
            if (node.selected) {
                node.data.\$color = \"#ff7\";
            }
            else {
                delete node.data.\$color;
            }
        },
        
        //This method is called right before plotting
        //an edge. It's useful for changing an individual edge
        //style properties before plotting it.
        //Edge data proprties prefixed with a dollar sign will
        //override the Edge global style properties.
        onBeforePlotLine: function(adj){
            if (adj.nodeFrom.selected && adj.nodeTo.selected) {
                adj.data.\$color = \"#eed\";
                adj.data.\$lineWidth = 3;
            }
            else {
                delete adj.data.\$color;
                delete adj.data.\$lineWidth;
            }
        }
    });
    //load json data
    st.loadJSON(json);
    //compute node positions and layout
    st.compute();
    //emulate a click on the root node.
    st.onClick(st.root);
    //end
    //Add event handlers to switch spacetree orientation.
     //end

}
init();
</script>
<div id=\"center-container\">
    <div id=\"infovis\"></div>    
</div>
<div id=\"log\"></div>
";
    }

    public function getTemplateName()
    {
        return "myaccount/myReferralsVisual.twig";
    }

    public function isTraitable()
    {
        return false;
    }
}
