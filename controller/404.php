<?
$url = $this->cleanString($this->getUrl());

header("HTTP/1.0 404 Not Found");

trigger_error("[404] $url", E_USER_WARNING);

$template = $twig->loadTemplate("404.twig");
echo $template->render($this->twigVars);