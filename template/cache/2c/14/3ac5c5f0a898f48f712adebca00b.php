<?php

/* layout.twig */
class __TwigTemplate_2c143ac5c5f0a898f48f712adebca00b extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'head' => array($this, 'block_head'),
            'bodyClass' => array($this, 'block_bodyClass'),
            'header' => array($this, 'block_header'),
            'hero' => array($this, 'block_hero'),
            'content' => array($this, 'block_content'),
            'footer' => array($this, 'block_footer'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE HTML>
<html lang=\"";
        // line 2
        echo twig_escape_filter($this->env, strtr($this->getAttribute((isset($context["language"]) ? $context["language"] : null), "locale"), "_", "-"), "html", null, true);
        echo "\">
<head>
    <meta charset=\"UTF-8\">
    <base href=\"";
        // line 5
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["config"]) ? $context["config"] : null), "baseHref"), "html", null, true);
        echo "\" />
    <title>";
        // line 6
        $this->displayBlock('title', $context, $blocks);
        echo "</title>
    <link rel=\"stylesheet\" href=\"/static/css/style.css?";
        // line 7
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["config"]) ? $context["config"] : null), "randomVar"), "html", null, true);
        echo "\" />
    ";
        // line 8
        $this->displayBlock('head', $context, $blocks);
        // line 9
        echo "    <!--[if lt IE 9]>
    <script type=\"text/javascript\" src=\"//html5shiv.googlecode.com/svn/trunk/html5.js\"></script>
    <link rel=\"stylesheet\" href=\"/static/css/css3-fallback.css\" />
    <![endif]-->
    <script src='http://connect.facebook.net/";
        // line 13
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["language"]) ? $context["language"] : null), "locale"), "html", null, true);
        echo "/all.js'></script>
    <script type=\"text/javascript\">
        var _gaq = _gaq || [];
        _gaq.push(['_setAccount', 'UA-26454384-1']);
        _gaq.push(['_setDomainName', 'projeggt.com']);
        _gaq.push(['_setAllowLinker', true]);
        _gaq.push(['_trackPageview']);
        (function() {
            var ga = document.createElement('script');
            ga.type = 'text/javascript';
            ga.async = true;
            ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
            var s = document.getElementsByTagName('script')[0];
            s.parentNode.insertBefore(ga, s);
        })();
    </script>
</head>
<body class=\"";
        // line 30
        echo twig_escape_filter($this->env, (isset($context["bodyClass"]) ? $context["bodyClass"] : null), "html", null, true);
        echo " ";
        $this->displayBlock('bodyClass', $context, $blocks);
        echo "\" data-spy=\"scroll\">
";
        // line 31
        if (((isset($context["_environment"]) ? $context["_environment"] : null) != "production")) {
            // line 32
            echo "<div class=\"alert alert-warning align-center font-big\">SITE IN [";
            echo twig_escape_filter($this->env, twig_upper_filter($this->env, (isset($context["_environment"]) ? $context["_environment"] : null)), "html", null, true);
            echo "] ENVIRONMENT</div>
";
        }
        // line 34
        echo "<header class=\"width center\">
    <!-- HEADER HAI -->
    ";
        // line 36
        $this->displayBlock('header', $context, $blocks);
        // line 109
        echo "</header>
<!-- HEADER KTXHBYE -->
<div class=\"main-content\">
    <!-- HERO HAI -->
    ";
        // line 113
        $this->displayBlock('hero', $context, $blocks);
        // line 114
        echo "    <!-- HERO KTHXBYE -->
    <div class=\"hero-shadow\"></div>
    <!-- CONTENT HAI -->
    ";
        // line 117
        $this->displayBlock('content', $context, $blocks);
        // line 118
        echo "    <!-- CONTENT KTXHBYE -->
</div>

<!-- FOOTER HAI -->
<footer class=\"contrast text-uppercase margin-3t\">
    ";
        // line 123
        $this->displayBlock('footer', $context, $blocks);
        // line 133
        echo "</footer>
<!-- FOOTER KTXHBYE -->
</body>
</html>
";
    }

    // line 6
    public function block_title($context, array $blocks = array())
    {
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["language"]) ? $context["language"] : null), "l", array(0 => "site-title"), "method"), "html", null, true);
    }

    // line 8
    public function block_head($context, array $blocks = array())
    {
    }

    // line 30
    public function block_bodyClass($context, array $blocks = array())
    {
    }

    // line 36
    public function block_header($context, array $blocks = array())
    {
        // line 37
        echo "    <div class=\"top-menu align-right row-fluid\">
        <!-- Social links -->
        <div class=\"span2\">
            <ul class=\"list no-margin no-padding padding-1l pull-left\">
                ";
        // line 41
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["social"]) ? $context["social"] : null));
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
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 42
            echo "                <li class=\"vertical-middle ";
            if ((!$this->getAttribute((isset($context["loop"]) ? $context["loop"] : null), "first"))) {
                echo "no-separator";
            }
            echo "\">
                    <a href=\"";
            // line 43
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "url"), "html", null, true);
            echo "\" target=\"_blank\">
                        <img src=\"/static/images/social-";
            // line 44
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "name"), "html", null, true);
            echo ".png\" class=\"size-20\" alt=\"";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "name"), "html", null, true);
            echo "\"/></a>
                </li>
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
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 47
        echo "            </ul>
        </div>
        <!-- User menu -->
        <div class=\"user-menu pull-left width-100 align-center span10\">
            <!-- Language Switcher -->
            <div class=\"pull-right\">
                <ul class=\"language-switcher separator list no-margin no-padding pull-right padding-1l\">
                    ";
        // line 54
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable(twig_sort_filter((isset($context["languages"]) ? $context["languages"] : null)));
        foreach ($context['_seq'] as $context["_key"] => $context["lang"]) {
            // line 55
            echo "                    <li class=\"";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["lang"]) ? $context["lang"] : null), "class"), "html", null, true);
            echo " vertical-middle\"><a href=\"";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["lang"]) ? $context["lang"] : null), "domain"), "html", null, true);
            echo twig_escape_filter($this->env, (isset($context["actual_url"]) ? $context["actual_url"] : null), "html", null, true);
            if ($this->getAttribute((isset($context["user"]) ? $context["user"] : null), "sessionHash")) {
                echo "?PHPSESSID=";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["user"]) ? $context["user"] : null), "sessionHash"), "html", null, true);
            }
            echo "\">";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["lang"]) ? $context["lang"] : null), "name"), "html", null, true);
            echo "</a></li>
                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['lang'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 57
        echo "                </ul>
            </div>
            ";
        // line 59
        if ($this->getAttribute((isset($context["user"]) ? $context["user"] : null), "logged")) {
            // line 60
            echo "            <ul class=\"no-padding no-margin separator list\">
                <li>";
            // line 61
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["language"]) ? $context["language"] : null), "strings"), "hello", array(), "array"), "html", null, true);
            echo " <span class=\"bold\">";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["user"]) ? $context["user"] : null), "name"), "html", null, true);
            echo "</span></li>
                ";
            // line 62
            if ($this->getAttribute((isset($context["user"]) ? $context["user"] : null), "admin")) {
                // line 63
                echo "                <li><a href=\"/admin/\">";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["language"]) ? $context["language"] : null), "strings"), "administration", array(), "array"), "html", null, true);
                echo "</a></li>
                ";
            }
            // line 65
            echo "                <li><a href=\"/my-account/\">";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["language"]) ? $context["language"] : null), "strings"), "my-account", array(), "array"), "html", null, true);
            echo "</a></li>
                <li><a href=\"/logout/\">";
            // line 66
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["language"]) ? $context["language"] : null), "strings"), "logout", array(), "array"), "html", null, true);
            echo "</a></li>
            </ul>
            ";
        } else {
            // line 69
            echo "                ";
            if ((!(isset($context["loginFormHidden"]) ? $context["loginFormHidden"] : null))) {
                // line 70
                echo "                <!-- Login form -->
                <div class=\"login-form padding-1r\">
                    <form class=\"form-inline no-padding no-margin\" action=\"/login/\" method=\"post\">
                        <span class=\"checkbox\">
                            <a class=\"underline\"
                               href=\"/register/\">";
                // line 75
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["language"]) ? $context["language"] : null), "l", array(0 => "register"), "method"), "html", null, true);
                echo "</a> <strong>o</strong> ";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["language"]) ? $context["language"] : null), "strings"), "login"), "html", null, true);
                echo ":
                        </span>
                        <input type=\"email\" class=\"input-small text-darkgray\" name=\"email\"
                               placeholder=\"";
                // line 78
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["language"]) ? $context["language"] : null), "strings"), "email"), "html", null, true);
                echo "\"/>
                        <input type=\"password\" class=\"input-small text-darkgray\" name=\"password\"
                               placeholder=\"";
                // line 80
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["language"]) ? $context["language"] : null), "strings"), "password"), "html", null, true);
                echo "\"/>
                        <button type=\"submit\" class=\"btn\" name=\"doLogin\">";
                // line 81
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["language"]) ? $context["language"] : null), "strings"), "login"), "html", null, true);
                echo "</button>
                    </form>
                </div>
                ";
            }
            // line 85
            echo "            ";
        }
        // line 86
        echo "        </div>
    </div>
    <div class=\"clearfix\"></div>
    <nav class=\"font-small text-uppercase contrast\">
        <ul class=\"no-padding no-margin separator list\">
            <li class=\"logo padding-1l padding-2r\">
                <a href=\"/\"><img src=\"/static/images/mainmenu-logo.png\" /></a>
            </li>
            ";
        // line 94
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["mainMenu"]) ? $context["mainMenu"] : null));
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
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 95
            echo "            <li class=\"menu font-small bold ";
            if ($this->getAttribute((isset($context["loop"]) ? $context["loop"] : null), "first")) {
                echo "no-separator";
            }
            if ($this->getAttribute((isset($context["loop"]) ? $context["loop"] : null), "last")) {
                echo "padding-2r";
            }
            echo "\"><a href=\"";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "url"), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "name"), "html", null, true);
            echo "</a></li>
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
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 97
        echo "            <li class=\"pull-right search no-line-height padding-1r\">
                <form class=\"form-search no-margin\" action=\"/search/\" method=\"post\">
                    <input type=\"text\"
                           class=\"css3-fallback search-query padding-2r\"
                           name=\"searchQuery\"
                           id=\"searchQuery\"
                           placeholder=\"";
        // line 103
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["language"]) ? $context["language"] : null), "l", array(0 => "search"), "method"), "html", null, true);
        echo "\" />
                </form>
            </li>
        </ul>
    </nav>
    ";
    }

    // line 113
    public function block_hero($context, array $blocks = array())
    {
    }

    // line 117
    public function block_content($context, array $blocks = array())
    {
    }

    // line 123
    public function block_footer($context, array $blocks = array())
    {
        // line 124
        echo "    <div class=\"width center padding-1\">
        <ul class=\"no-padding no-margin list separator bold\">
            ";
        // line 126
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["footerMenu"]) ? $context["footerMenu"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 127
            echo "            <li class=\"menu\"><a href=\"";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "url"), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "name"), "html", null, true);
            echo "</a></li>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 129
        echo "            <li class=\"display-block pull-right no-separator\">Let's Projeggt ";
        echo twig_escape_filter($this->env, twig_date_format_filter($this->env, "now", "Y"), "html", null, true);
        echo "</li>
        </ul>
    </div>
    ";
    }

    public function getTemplateName()
    {
        return "layout.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  402 => 129,  391 => 127,  387 => 126,  383 => 124,  375 => 117,  370 => 113,  326 => 95,  299 => 86,  296 => 85,  289 => 81,  285 => 80,  280 => 78,  272 => 75,  265 => 70,  262 => 69,  256 => 66,  251 => 65,  245 => 63,  243 => 62,  237 => 61,  234 => 60,  228 => 57,  210 => 55,  206 => 54,  197 => 47,  178 => 44,  174 => 43,  167 => 42,  150 => 41,  144 => 37,  136 => 30,  131 => 8,  125 => 6,  117 => 133,  115 => 123,  108 => 118,  106 => 117,  101 => 114,  99 => 113,  93 => 109,  91 => 36,  87 => 34,  81 => 32,  79 => 31,  73 => 30,  53 => 13,  47 => 9,  41 => 7,  37 => 6,  27 => 2,  24 => 1,  380 => 123,  377 => 117,  360 => 103,  352 => 97,  341 => 94,  337 => 93,  331 => 90,  324 => 85,  313 => 83,  309 => 94,  305 => 81,  298 => 76,  281 => 74,  264 => 73,  258 => 70,  253 => 68,  249 => 66,  232 => 59,  215 => 63,  209 => 60,  204 => 58,  198 => 55,  194 => 53,  189 => 50,  172 => 48,  155 => 47,  149 => 44,  143 => 42,  141 => 36,  137 => 39,  120 => 37,  103 => 36,  97 => 33,  92 => 31,  86 => 27,  80 => 26,  77 => 25,  71 => 23,  69 => 22,  66 => 21,  63 => 20,  57 => 16,  55 => 15,  48 => 10,  45 => 8,  39 => 7,  33 => 5,  30 => 2,);
    }
}
