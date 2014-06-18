<?

$template = $twig->loadTemplate("landing.twig");
echo $template->render($this->twigVars);
