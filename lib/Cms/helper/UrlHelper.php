<?php

class Urlhelper
{
    protected $router;
    
    protected $app;
    
    public function __construct($router, $app = '')
    {
        $this->router = $router;
        if($app !== 'site') {
            $this->app = '/' . $app;
        }
    }
    
    public function url_for2($routeName, $params = array(), $absolute = false)
    {
      $params = array_merge(array('sf_route' => $routeName), is_object($params) ? array('sf_subject' => $params) : $params);

      return url_for1($params, $absolute);
    }

    public function url_for1($internal_uri, $absolute = false)
    {
      return $this->genUrl($internal_uri, $absolute);
    }

    /**
     * Returns a routed URL based on the module/action passed as argument
     * and the routing configuration.
     *
     * <b>Examples:</b>
     * <code>
     *  echo url_for('my_module/my_action');
     *    => /path/to/my/action
     *  echo url_for('@my_rule');
     *    => /path/to/my/action 
     *  echo url_for('@my_rule', true);
     *    => http://myapp.example.com/path/to/my/action
     * </code>
     *
     * @param  string $internal_uri  'module/action' or '@rule' of the action
     * @param  bool   $absolute      return absolute path?
     * @return string routed URL
     */
    public function url_for()
    {
      // for BC with 1.1
      $arguments = func_get_args();
      if (is_array($arguments[0]) || '@' == substr($arguments[0], 0, 1) || false !== strpos($arguments[0], '/'))
      {
        return call_user_func_array(array($this, 'url_for1'), $arguments);
      }
      else
      {
        return call_user_func_array(array($this, 'url_for2'), $arguments);
      }
    }
    
    /**
   * Generates an URL from an array of parameters.
   *
   * @param mixed   $parameters An associative array of URL parameters or an internal URI as a string.
   * @param boolean $absolute   Whether to generate an absolute URL
   *
   * @return string A URL to a symfony resource
   */
  protected function genUrl($parameters = array(), $absolute = false)
  {
    $route = '';
    $fragment = '';

    if (is_string($parameters))
    {
      // absolute URL or symfony URL?
      if (preg_match('#^[a-z][a-z0-9\+.\-]*\://#i', $parameters))
      {
        return $parameters;
      }

      // relative URL?
      if (0 === strpos($parameters, '/'))
      {
        return $parameters;
      }

      if ($parameters == '#')
      {
        return $parameters;
      }
  
      // strip fragment
      if (false !== ($pos = strpos($parameters, '#')))
      {
        $fragment = substr($parameters, $pos + 1);
        $parameters = substr($parameters, 0, $pos);
      }

      list($route, $parameters) = $this->convertUrlStringToParameters($parameters);
    }
    else if (is_array($parameters))
    {
      if (isset($parameters['sf_route']))
      {
        $route = $parameters['sf_route'];
        unset($parameters['sf_route']);
      }
    }

    // routing to generate path
    $url = $this->router->generate($route, $parameters, $absolute);

    if ($fragment)
    {
      $url .= '#'.$fragment;
    }

    return $this->app . $url;
  }

  /**
   * Converts an internal URI string to an array of parameters.
   *
   * @param string $url An internal URI
   *
   * @return array An array of parameters
   */
  protected function convertUrlStringToParameters($url)
  {
    $givenUrl = $url;

    $params = array();
    $queryString = '';
    $route = '';

    // empty url?
    if (!$url)
    {
      $url = '/';
    }

    // we get the query string out of the url
    if ($pos = strpos($url, '?'))
    {
      $queryString = substr($url, $pos + 1);
      $url = substr($url, 0, $pos);
    }

    // 2 url forms
    // @routeName?key1=value1&key2=value2...
    // module/action?key1=value1&key2=value2...

    // first slash optional
    if ($url[0] == '/')
    {
      $url = substr($url, 1);
    }

    // routeName?
    if ($url[0] == '@')
    {
      $route = substr($url, 1);
    }
    else if (false !== strpos($url, '/'))
    {
      list($params['module'], $params['action']) = explode('/', $url);
    }
    else if (!$queryString)
    {
      $route = $givenUrl;
    }
    else
    {
      die(sprintf('An internal URI must contain a module and an action (module/action) ("%s" given).', $givenUrl));
    }

    // split the query string
    if ($queryString)
    {
      $matched = preg_match_all('/
        ([^&=]+)            # key
        =                   # =
        (.*?)               # value
        (?:
          (?=&[^&=]+=) | $  # followed by another key= or the end of the string
        )
      /x', $queryString, $matches, PREG_SET_ORDER | PREG_OFFSET_CAPTURE);
      foreach ($matches as $match)
      {
        $params[urldecode($match[1][0])] = urldecode($match[2][0]);
      }

      // check that all string is matched
      if (!$matched)
      {
        die(sprintf('Unable to parse query string "%s".', $queryString));
      }
    }

    return array($route, $params);
  }
}