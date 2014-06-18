<?

/*
 * envcore
 * Version 0.3.1 (Junio 2013)
 */

class core
{
    var $path = './';

    var $conn = null;

    var $url_var;
    var $queryString;
    
    var $twig = null;
    var $twigVars = array();

    // Develop
    var $debug = false;
    var $log = array();

    public function __construct()
    {
        global $_config;

        // Checking path
        if (!empty($_config['path'])) $this->path = $_config['path'];

        // Connecting to mysql
        if (empty($_config['ddbb']['username'])
            || empty($_config['ddbb']['password'])
            || empty($_config['ddbb']['database'])
        ) {
            die('Database parameters needed.');
        } else {
            // Config mysql link
            require_once($this->path . "_/core/resources/phmysql.class.php");
            $this->conn = new phmysql;
            $this->conn->setConnection($_config['ddbb']['hostname'],
                $_config['ddbb']['username'],
                $_config['ddbb']['password'],
                $_config['ddbb']['database']);
        }

        // Checking connection
        if (!$this->conn->doQuery("SHOW TABLES")) {
            die('Mysql connection error or no tables');
        }

        require_once($this->path . "_/core/resources/rc4.class.php");

        // Twig Template System Loader
        require_once($this->path . '_/core/resources/Twig/Autoloader.php');
        Twig_Autoloader::register();

        // Getting all directories in /template
        $path = $this->path . 'template';
        $templatesDir = array($path);
        $dirsToScan = array($path);

        $dirKey = 0;
        while (count($dirsToScan) > $dirKey) {
            $results = scandir($dirsToScan[$dirKey]);
            foreach ($results as $result) {
                if ($result === '.' or $result === '..'
                    or $result == 'cache') continue;

                if (is_dir($dirsToScan[$dirKey] . '/' . $result)) {
                    $templatesDir[] = $dirsToScan[$dirKey] . '/' . $result;
                    $dirsToScan[] = $dirsToScan[$dirKey] . '/' . $result;
                }
            }
            $dirKey++;
        }

        $this->getQueryString();

        $loader = new Twig_Loader_Filesystem($templatesDir);
        $twig_options = array();
        if ($_config['template_cache']) $twig_options['cache'] = "./template/cache";
        $this->twig = new Twig_Environment($loader, $twig_options);

        // Clear cache
        if (isset($this->queryString['clearCache'])) {
            $this->twig->clearCacheFiles();
            $url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
            header("Location: $url");
            exit;
        }

		
		
        // Restoring user session
        if (!empty($this->queryString['PHPSESSID'])) {
            $sessionHash = $this->cleanString($this->queryString['PHPSESSID']);
            
            
            $this->loadClass('user')->setCookie($sessionHash);
            $url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
            header("Location: $url");
            exit;
        }

    }

    public function start($_mvc = true)
    {
    
        global $_user, $_lang, $_config;
			
		
		
        // Check user login
        $_user = $this->loadClass('user');
        if (!empty($_COOKIE[$_config['cookie_name'] . "_log"])) {
            $_user->getFromCookie($_COOKIE[$_config['cookie_name'] . "_log"]);
        }
        
        // Check finalize simulation
        $this->loadClass('simulation')->finishSimulations();
        
        // Assoc URL to MVC
        if ($_mvc) $this->loadMVC();
    }

   
    /*
     * Global system
     */

    function fixTrailingSlash($_url)
    {
        //echo $_url . "<br />";
        if ($_url{strlen($_url) - 1} != '/' && strstr($_url, "image/") === false) {
            //echo 'reevniando..';
            header("Location: " . $_url . "/");
            exit;
        }
    }

    function getUrlFromId($_id)
    {
        $_id = (int)$_id;
        $url = $this->conn->getResult("SELECT url FROM url WHERE id = '$_id'");
        $regex = "/(\(.*\))/";
        return preg_replace($regex, "", $url);
    }

    function loadMVC()
    {
        $url = $this->getUrl();
        $this->fixTrailingSlash($url);
        $mvc = $this->getVT($url);
        if ($mvc != false) {
            if (!empty($mvc['template'])) $this->loadTemplate($mvc['template'], $mvc['controller']);
            else $this->loadController($mvc['controller']);
        }
    }

    function getQueryString() {
        $uri = $_SERVER['REQUEST_URI'];
        $qs = parse_url($uri, PHP_URL_QUERY);
        if (!empty($qs)) {
            parse_str($qs, $this->queryString);
        }            
    }

    // get controller template
    function getVT($_url)
    {
        //$mvc = $this->conn->getArray("SELECT * FROM url WHERE url = '$_url'");
        $mvc_items = $this->conn->getArray("SELECT * FROM url WHERE enabled = 'y' ORDER BY queue ASC");

        foreach ($mvc_items as $item) {
            $regexp = "/^" . str_replace(array("/", "\\\\"), array("\/", "\\"), $item['url']) . "$/";
            preg_match($regexp, $_url, $match);

            if (@$match) {
                $this->url_var = $match;
                $mvc = $item;
                break;
            }
        }

        if (@$mvc) {
            $return = $mvc;
        } else {
            $this->loadController('404');
            exit;
            die('error 404');
        }
        return $return;
    }

    function getUrl()
    {
        $url = $_SERVER['REQUEST_URI'];
        if (strstr($url, "?") !== false)
            $url = substr($url, 0, strpos($url, "?")); // Remove GET vars
        //$url = $this->cleanString($url);
        return $url;
    }

    /*
     * Classes
     */

    function loadClass($_className)
    {
        if (!class_exists($_className)) {
            if (!class_exists('base_object'))
                require_once($this->path . "_/core/class/base_object.class.php");

            require_once($this->path . "_/core/class/$_className.class.php");
            return new $_className;
        } elseif (class_exists($_className)) {
            return new $_className;
        } else {
            $this->log("Error loading class: $_className", "error");
        }
    }

    

    /*
     * Security functions
     */

	public static function cleanNumber($s){
		
		$s = str_replace('"','', $s);
		$s = str_replace(':','', $s); 
		$s = str_replace('.','', $s);
		$s = str_replace(',','', $s);
		$s = str_replace(';','', $s); 
		return $s;
	
	}

    public static function cleanString($_str)
    {
        // convert characteres...
        $i = array('À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Æ', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í',
            'Î', 'Ï', 'Ð', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ø', 'Ù', 'Ú', 'Û', 'Ü', 'Ý', 'ß',
            'à', 'á', 'â', 'ã', 'ä', 'å', 'æ', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï',
            'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ø', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ', 'Ā', 'ā', 'Ă',
            'ă', 'Ą', 'ą', 'Ć', 'ć', 'Ĉ', 'ĉ', 'Ċ', 'ċ', 'Č', 'č', 'Ď', 'ď', 'Đ', 'đ', 'Ē',
            'ē', 'Ĕ', 'ĕ', 'Ė', 'ė', 'Ę', 'ę', 'Ě', 'ě', 'Ĝ', 'ĝ', 'Ğ', 'ğ', 'Ġ', 'ġ', 'Ģ',
            'ģ', 'Ĥ', 'ĥ', 'Ħ', 'ħ', 'Ĩ', 'ĩ', 'Ī', 'ī', 'Ĭ', 'ĭ', 'Į', 'į', 'İ', 'ı', 'Ĳ',
            'ĳ', 'Ĵ', 'ĵ', 'Ķ', 'ķ', 'Ĺ', 'ĺ', 'Ļ', 'ļ', 'Ľ', 'ľ', 'Ŀ', 'ŀ', 'Ł', 'ł', 'Ń',
            'ń', 'Ņ', 'ņ', 'Ň', 'ň', 'ŉ', 'Ō', 'ō', 'Ŏ', 'ŏ', 'Ő', 'ő', 'Œ', 'œ', 'Ŕ', 'ŕ',
            'Ŗ', 'ŗ', 'Ř', 'ř', 'Ś', 'ś', 'Ŝ', 'ŝ', 'Ş', 'ş', 'Š', 'š', 'Ţ', 'ţ', 'Ť', 'ť',
            'Ŧ', 'ŧ', 'Ũ', 'ũ', 'Ū', 'ū', 'Ŭ', 'ŭ', 'Ů', 'ů', 'Ű', 'ű', 'Ų', 'ų', 'Ŵ', 'ŵ',
            'Ŷ', 'ŷ', 'Ÿ', 'Ź', 'ź', 'Ż', 'ż', 'Ž', 'ž', 'ſ', 'ƒ', 'Ơ', 'ơ', 'Ư', 'ư', 'Ǎ',
            'ǎ', 'Ǐ', 'ǐ', 'Ǒ', 'ǒ', 'Ǔ', 'ǔ', 'Ǖ', 'ǖ', 'Ǘ', 'ǘ', 'Ǚ', 'ǚ', 'Ǜ', 'ǜ', 'Ǻ',
            'ǻ', 'Ǽ', 'ǽ', 'Ǿ', 'ǿ', '!', '?', '\\');
        // 
        $o = array('A', 'A', 'A', 'A', 'A', 'A', 'AE', 'C', 'E', 'E', 'E', 'E', 'I', 'I',
            'I', 'I', 'D', 'N', 'O', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U', 'U', 'Y', 's',
            'a', 'a', 'a', 'a', 'a', 'a', 'ae', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i',
            'n', 'o', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'y', 'y', 'A', 'a', 'A',
            'a', 'A', 'a', 'C', 'c', 'C', 'c', 'C', 'c', 'C', 'c', 'D', 'd', 'D', 'd', 'E',
            'e', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'G', 'g', 'G', 'g', 'G', 'g', 'G',
            'g', 'H', 'h', 'H', 'h', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'IJ',
            'ij', 'J', 'j', 'K', 'k', 'L', 'l', 'L', 'l', 'L', 'l', 'L', 'l', 'l', 'l', 'N',
            'n', 'N', 'n', 'N', 'n', 'n', 'O', 'o', 'O', 'o', 'O', 'o', 'OE', 'oe', 'R', 'r',
            'R', 'r', 'R', 'r', 'S', 's', 'S', 's', 'S', 's', 'S', 's', 'T', 't', 'T', 't',
            'T', 't', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'W', 'w',
            'Y', 'y', 'Y', 'Z', 'z', 'Z', 'z', 'Z', 'z', 's', 'f', 'O', 'o', 'U', 'u', 'A',
            'a', 'I', 'i', 'O', 'o', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'A',
            'a', 'AE', 'ae', 'O', 'o', '', '', ' ');
        $str = str_replace($i, $o, $_str);
        // replace other characteres
        return strtolower(preg_replace(array('/[^a-zA-Z0-9 -_\/]/', '/[ -]+/', '/[ _]+/', '/[ \/]+/', '/^-|-$/'), array('', '-', '_', '/', ''), $str));
    }


    /*
    * Template functions
    */

    public function loadTemplate($_templateName, $_controllerName = '')
    {
        global $_config, $core, $_view, $_user, $_lang, $_vars;

        if (empty($_controllerName))
            $viewPath = $this->path . "_/template/" . $_templateName . ".controller.php";
        else
            $viewPath = $this->path . "_/controller/" . $_controllerName . ".php";

        // Load view
        if (file_exists($viewPath)) {
            require_once($viewPath);
        } else {
            if (!empty($_controllerName)) $this->log("Error loading controller: $_controllerName", "error");
        }

        $path = $this->path . "_/template/" . $_templateName . ".php";
        if (file_exists($path)) {
            require($path);
        } else {
            $this->log("Error loading template: $_templateName", "error");
        }
    }
	
	public function get_request_method(){
			return $_SERVER['REQUEST_METHOD'];
		}
		
    public function getGlobalTwigVars() {
        global $_user, $_config;

        // Environment
        if (isset($_config['environment']))
            $this->addTwigVars("_environment", $_config['environment']);

        $this->addTwigVars('actual_url', strip_tags($this->url_var[0]));

        // User
        $userVars = array(
            "name" => $_user->name,
            "email" => $_user->email,
            "admin" => $_user->isAdmin(),
            "isNewInstall" => $_user->isNewInstall(),
            "logged" => $_user->logged,
            "sessionHash" => $_user->cookie
        );
        $this->addTwigVars("user", $userVars);
        $this->addTwigVars("_user", $_user);

        // Login
        if (@isset($this->queryString['login-error']))
            $this->addTwigVars('loginError', true);

        if (@isset($this->queryString['user-disabled']))
            $this->addTwigVars('userDisabled', true);

        // Discharge
        if (@isset($this->queryString['account-disabled']))
            $this->addTwigVars('accountDisabled', true);

        if (@isset($this->queryString['account-deleted']))
            $this->addTwigVars('accountDeleted', true);

        // Config
        $config = array(
            "baseHref" => $_config['http_mode'] . $_config['domain'],
            "thisHref" => $_config['http_mode'] . $_config['domain'] . $this->getUrl()
        );
        $this->addTwigVars("config", $config);

    }

    public function addTwigVars($_key, $_array) {
        $this->twigVars[$_key] = $_array;
    }

    public function loadController($_controllerName)
    {
        global $_user, $_lang, $_config;

        $twig = &$this->twig;

        $controllerPath = $this->path . "controller/" . $_controllerName . ".php";

        $this->getGlobalTwigVars();

        // Load view
        if (file_exists($controllerPath)) {
            require_once($controllerPath);
        } else {
            if (!empty($_controllerName))
                $this->log("Error loading controller: $_controllerName", "error");
        }
    }



    /*
     * Encoding function
     */

    function isUTF8($_string) {
        #return (mb_detect_encoding($_string, 'UTF-8', true) == "UTF-8");
        #return (preg_match('!\S!u', $_string));
        return (strlen($string) != strlen(utf8_decode($string)));
    }

    function encode($_string) {
        $return = $_string;
        #if (!$this->isUTF8($_string) && !$this->oldTemplate) {
        #$return = utf8_encode($_string);
        #}
        return $return;
    }

    function decode($_string) {
        $return = $_string;
        return $return;
    }

    /*
    * Testing
    */

    public function enableDebug()
    {
        $this->debug = true;
        $this->conn->debug = true;
        $this->log("Debug enabled!");
    }

    private function insertLogItem($_item)
    {
        $this->log[] = $_item;
    }

    public function log($_msg, $_type = "message", $_warn = 0)
    {
        /*
         * type, message, warning
         */
        if ($this->debug) {
            $item = array();
            $item['type'] = $_type;
            $item['message'] = $_msg;
            $item['warning'] = $_warn;
            $this->insertLogItem($item);
        }
    }

    public function showLog()
    {
        if ($this->debug) {
            echo '<pre>';
            print_r($this->log);
        }
    }



}
