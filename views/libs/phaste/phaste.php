<?php
class Phaste
{
    private function loadFile($p_classname, $p_default_extension, $p_class_path = null)
    {
        $filename  = strtolower($p_classname) . $p_default_extension;
        $classfile = $p_class_path . DIRECTORY_SEPARATOR . $filename;

        // TODO: clearstatcache() ?
        if (is_file($classfile)) {
            $ret = require ($classfile);
        } else {
            throw new Exception("File not found ($classfile)");
        }

        unset ($filename, $classfile);
        return $ret;
    }

    private function callMethod($p_class, $p_method, $p_args = null, $p_req_data = null)
    {
        if (class_exists($p_class)) {
            $obj = new $p_class;

            if (method_exists($obj, $p_method)) {
                $obj->$p_method($p_args, $p_req_data);
            } else {
                $exc_message = "Method not found ($p_class::$p_method)";
                throw new BadMethodCallException($exc_message);
            }
        } else {
            throw new Exception("Class not found ($p_class)");
        }
    }

    private function getRequestData($p_request_method)
    {
        switch ($p_request_method)
        {
            case 'GET':
                $req_data = $_GET;
                unset($_GET);
                break;
            case 'POST':
                $req_data = $_POST;
                unset($_POST);
                break;
            case 'PUT':
            case 'DELETE':
            default:
                $req_data = null;
        }

        return $req_data;
    }

    static function stick($p_urls, $p_class_path = null, $p_default_extension = '.php')
    {
        $req_method = strtolower($_SERVER['REQUEST_METHOD']);
        $path       = $_SERVER['REQUEST_URI'];
        $req_data   = self::getRequestData($req_method);
        $found      = false;
        krsort($p_urls);

        foreach ($p_urls as $regex => $class_method) {
            list($classname, $methodname_compl) = explode(':', $class_method);
            $regex = str_replace('/', '\/', $regex);
            $regex = '^' . $regex . '\/?$';
            
            if (preg_match("/$regex/i", $path, $matches)) {
                $found      = true;
                $methodname = $req_method . ucfirst(strtolower($methodname_compl));
                self::loadFile($classname, $p_default_extension, $p_class_path);
                self::callMethod($classname, $methodname, $matches, $req_data);
                break;
            }
            
            unset($classname, $methodname_compl);
        }
        
        if ($found != true) {
            throw new Exception("URL not found ($path)");
        }

        unset($req_method, $path, $found, $regex, $methodname);
    }
}

