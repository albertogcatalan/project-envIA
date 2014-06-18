<?php

/* home.twig */
class __TwigTemplate_e4eb0f93ded1824b6d2097ff6f24948b extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("layout.twig");

        $this->blocks = array(
            'head' => array($this, 'block_head'),
            'bodyClass' => array($this, 'block_bodyClass'),
            'hero' => array($this, 'block_hero'),
            'content' => array($this, 'block_content'),
            'footer' => array($this, 'block_footer'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "layout.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 2
    public function block_head($context, array $blocks = array())
    {
        // line 3
        echo "<script type=\"text/javascript\" src=\"/static/js/jquery.js\"></script>
<script type=\"text/javascript\" src=\"/static/js/jquery-phslider.js\"></script>
";
    }

    // line 7
    public function block_bodyClass($context, array $blocks = array())
    {
        echo "home";
    }

    // line 9
    public function block_hero($context, array $blocks = array())
    {
        // line 10
        echo "<div class=\"hero big width center position-relative\">
    <div class=\"slider-info position-absolute white left\">

    </div>
    <div class=\"slider\">
        ";
        // line 15
        $this->env->loadTemplate("./i18n/home-slider.twig")->display($context);
        // line 16
        echo "    </div>
</div>
";
    }

    // line 20
    public function block_content($context, array $blocks = array())
    {
        // line 21
        echo "<div class=\"messages width center\">
    ";
        // line 22
        if ((isset($context["accountDisabled"]) ? $context["accountDisabled"] : null)) {
            // line 23
            echo "    <div class=\"alert alert-warning align-center\">";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["language"]) ? $context["language"] : null), "l", array(0 => "alert-account-disabled"), "method"), "html", null, true);
            echo "</div>
    ";
        }
        // line 25
        echo "    ";
        if ((isset($context["accountDeleted"]) ? $context["accountDeleted"] : null)) {
            // line 26
            echo "    <div class=\"alert alert-warning align-center\">";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["language"]) ? $context["language"] : null), "l", array(0 => "alert-account-deleted"), "method"), "html", null, true);
            echo "</div>
    ";
        }
        // line 27
        echo "    
</div>

<div class=\"project-list width center row margin-2t\">
    <div class=\"span";
        // line 31
        echo twig_escape_filter($this->env, (twig_length_filter($this->env, (isset($context["activeProjects"]) ? $context["activeProjects"] : null)) * 4), "html", null, true);
        echo "\">
        <h3 class=\"title lightblue text-lightblue text-uppercase border-lightblue margin-1b\">
            <span class=\"white padding-1r\">";
        // line 33
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["language"]) ? $context["language"] : null), "l", array(0 => "active-projeggts"), "method"), "html", null, true);
        echo "</span>
        </h3>
        <div class=\"row\">
            ";
        // line 36
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["activeProjects"]) ? $context["activeProjects"] : null));
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
        foreach ($context['_seq'] as $context["_key"] => $context["project"]) {
            // line 37
            echo "            <div class=\"span4\">";
            $this->env->loadTemplate("project-box.twig")->display(array_merge($context, array("project" => (isset($context["project"]) ? $context["project"] : null))));
            echo "</div>
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
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['project'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 39
        echo "        </div>
    </div>
    ";
        // line 41
        if ((!twig_test_empty((isset($context["randomProjects"]) ? $context["randomProjects"] : null)))) {
            // line 42
            echo "    <div class=\"span";
            echo twig_escape_filter($this->env, (twig_length_filter($this->env, (isset($context["randomProjects"]) ? $context["randomProjects"] : null)) * 4), "html", null, true);
            echo "\">
        <h3 class=\"title darkgray text-darkgray text-uppercase border-darkgray margin-1b\">
            <span class=\"white padding-1r\">";
            // line 44
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["language"]) ? $context["language"] : null), "l", array(0 => "our-projeggts"), "method"), "html", null, true);
            echo "</span>
        </h3>
        <div class=\"row\">
            ";
            // line 47
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["randomProjects"]) ? $context["randomProjects"] : null));
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
            foreach ($context['_seq'] as $context["_key"] => $context["project"]) {
                // line 48
                echo "            <div class=\"span4\">";
                $this->env->loadTemplate("project-box.twig")->display(array_merge($context, array("project" => (isset($context["project"]) ? $context["project"] : null))));
                echo "</div>
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
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['project'], $context['_parent'], $context['loop']);
            $context = array_merge($_parent, array_intersect_key($context, $_parent));
            // line 50
            echo "        </div>
    </div>
    ";
        }
        // line 53
        echo "</div>
<div class=\"align-right font-big bold width center padding-1t padding-1r\">
    <a href=\"/category/\" class=\"text-lightblue\">";
        // line 55
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["language"]) ? $context["language"] : null), "l", array(0 => "show-all"), "method"), "html", null, true);
        echo " &raquo;</a>
</div>
<div class=\"project-list width center row margin-1t padding-2b\">
    <div class=\"span";
        // line 58
        echo twig_escape_filter($this->env, (twig_length_filter($this->env, (isset($context["highlightedProjects"]) ? $context["highlightedProjects"] : null)) * 4), "html", null, true);
        echo "\">
        <h3 class=\"title green text-green text-uppercase border-green margin-1b\">
            <span class=\"white padding-1r\">";
        // line 60
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["language"]) ? $context["language"] : null), "l", array(0 => "highlighted-projeggts"), "method"), "html", null, true);
        echo "</span>
        </h3>
        <div class=\"row\">
            ";
        // line 63
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["highlightedProjects"]) ? $context["highlightedProjects"] : null));
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
        foreach ($context['_seq'] as $context["_key"] => $context["project"]) {
            // line 64
            echo "            <div class=\"span4\">";
            $this->env->loadTemplate("project-box.twig")->display(array_merge($context, array("project" => (isset($context["project"]) ? $context["project"] : null))));
            echo "</div>
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
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['project'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 66
        echo "        </div>
    </div>
    <div class=\"span";
        // line 68
        echo twig_escape_filter($this->env, (twig_length_filter($this->env, (isset($context["lastHatched"]) ? $context["lastHatched"] : null)) * 4), "html", null, true);
        echo "\">
        <h3 class=\"title orange text-orange text-uppercase border-orange margin-1b\">
            <span class=\"white padding-1r\">";
        // line 70
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["language"]) ? $context["language"] : null), "l", array(0 => "last-hatched-projeggt"), "method"), "html", null, true);
        echo "</span>
        </h3>
        <div class=\"row\">
            ";
        // line 73
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["lastHatched"]) ? $context["lastHatched"] : null));
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
        foreach ($context['_seq'] as $context["_key"] => $context["project"]) {
            // line 74
            echo "            <div class=\"span4\">";
            $this->env->loadTemplate("project-box.twig")->display(array_merge($context, array("project" => (isset($context["project"]) ? $context["project"] : null))));
            echo "</div>
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
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['project'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 76
        echo "        </div>
    </div>
</div>
<div class=\"row width center margin-1t\">
    <span class=\"span12 logos align-center lightgray\">
        <p class=\"margin-1t bold font-med\">";
        // line 81
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["language"]) ? $context["language"] : null), "l", array(0 => "brands-collaborating-with-us"), "method"), "html", null, true);
        echo "</p>
        ";
        // line 82
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["sponsors"]) ? $context["sponsors"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["logo"]) {
            // line 83
            echo "        <a href=\"";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["logo"]) ? $context["logo"] : null), "logo_url"), "html", null, true);
            echo "\" target=\"_blank\"><img src=\"/";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["logo"]) ? $context["logo"] : null), "logo"), "html", null, true);
            echo "\"></a>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['logo'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 85
        echo "    </span>
</div>
<div class=\"row width center padding-4t\">
    <span class=\"span12\">
        <h3 class=\"title orange text-orange text-uppercase border-orange margin-1b\">
            <span class=\"white padding-1r\">";
        // line 90
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["language"]) ? $context["language"] : null), "l", array(0 => "hatcher-communities"), "method"), "html", null, true);
        echo "</span>
        </h3>
        <div class=\"padding-2l padding-2r\">
            ";
        // line 93
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["communities"]) ? $context["communities"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["community"]) {
            // line 94
            echo "            <a href=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["community"]) ? $context["community"] : null), "_url"), "url"), "html", null, true);
            echo "\"><img src=\"/image/0/79/0/";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["community"]) ? $context["community"] : null), "logo"), "html", null, true);
            echo "/\"></a>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['community'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 96
        echo "        </div>
    </span>
</div>
<div class=\"row width center padding-4t\">
    <span class=\"span12\">
        <h3 class=\"title darkgray text-darkgray text-uppercase border-darkgray margin-1b\">
            <span class=\"white padding-1r\">";
        // line 102
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["language"]) ? $context["language"] : null), "l", array(0 => "partners"), "method"), "html", null, true);
        echo "</span>
        </h3>
        <div class=\"padding-2l padding-2r\">
            <a href=\"http://www.crowdsourcing.org\" target=\"_blank\">
                <img src=\"/image/0/70/0/files/partners/crowdsourcingorg.jpg/\" alt=\"Crowdsourcing.org\" />
            </a>
            <a href=\"http://www.bytepix.com\" target=\"_blank\">
                <img src=\"/image/0/70/0/files/partners/bytepix.jpg/\" alt=\"Bytepix\" class=\"margin-1l\"/>
            </a>
        </div>
    </span>
</div>
";
    }

    // line 117
    public function block_footer($context, array $blocks = array())
    {
        // line 118
        $this->displayParentBlock("footer", $context, $blocks);
        echo "
<script type=\"text/javascript\">
    \$(function() {
        \$('.hero .slider').phslider({
            duration: 10,
            onInit: function(total) {
                for (var i = 1; i <= total; i++) {
                    \$('.slider-info').append('<div data-phslider=\"slideToButton\" data-slide=\"' + i + '\" class=\"dot dot' + i + ' display-inline\"></div>');
                }
            },
            onSlideChange: function(slide, total) {
                \$('.slider-info .dot.selected').removeClass('selected');
                \$('.slider-info .dot' + slide.slide).addClass('selected');
            }
        })
    })
</script>
";
    }

    public function getTemplateName()
    {
        return "home.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  380 => 118,  377 => 117,  360 => 102,  352 => 96,  341 => 94,  337 => 93,  331 => 90,  324 => 85,  313 => 83,  309 => 82,  305 => 81,  298 => 76,  281 => 74,  264 => 73,  258 => 70,  253 => 68,  249 => 66,  232 => 64,  215 => 63,  209 => 60,  204 => 58,  198 => 55,  194 => 53,  189 => 50,  172 => 48,  155 => 47,  149 => 44,  143 => 42,  141 => 41,  137 => 39,  120 => 37,  103 => 36,  97 => 33,  92 => 31,  86 => 27,  80 => 26,  77 => 25,  71 => 23,  69 => 22,  66 => 21,  63 => 20,  57 => 16,  55 => 15,  48 => 10,  45 => 9,  39 => 7,  33 => 3,  30 => 2,);
    }
}
