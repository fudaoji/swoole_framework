<?php
namespace Swoole;
/**
 * JS生成工具，可以生成常用的Javascript代码
 *
 * @author Tianfeng.Han
 * @package SwooleSystem
 * @subpackage JS
 * @link http://www.swoole.com/
 */
class JS
{
    static $head="<script language=\"javascript\">\n";
    static $foot="</script>\n";
    static $charset = 'utf-8';
    static $return = true;

    static function charset($return = false)
    {
        $out = '<meta http-equiv="Content-Type" content="text/html; charset='.self::$charset.'">';
        if(self::$return or $return) return $out;
        else echo $out;
    }

    /**
     * 输出JS
     * @param $js
     * @return unknown_type
     */
    static function echojs($js, $return= false)
    {
    	$out = self::charset();
        $out .= self::$head;
        $out .= $js;
        $out .= self::$foot;
        if(!Swoole\Error::$stop or $return) return $out;
        else echo $out;
    }
    /**
     * 弹出信息框
     * @param $str
     * @return unknown_type
     */
    static function alert($str)
    {
        return self::echojs("alert(\"$str\");");
    }
    /**
     * 重定向URL
     * @param $url
     * @return unknown_type
     */
    static function location($url)
    {
        return self::echojs("location.href='$url';");
    }
    /**
     * 历史记录返回
     * @param $msg
     * @param $go
     * @return unknown_type
     */
    static function js_back($msg,$go=-1)
    {
        if(!is_numeric($go)) $go=-1;
        return self::echojs("alert('$msg');\nhistory.go($go);\n");
    }
    /**
     * 父框架历史记录返回
     * @param $msg
     * @param $go
     * @return unknown_type
     */
    static function parent_js_back($msg,$go=-1)
    {
        if(!is_numeric($go)) $go=-1;
        return self::echojs("alert('$msg');\nparent.history.go($go);\n");
    }
    /**
     * 父框架跳转
     * @param $msg
     * @param $url
     * @return unknown_type
     */
    static function parent_js_goto($msg,$url)
    {
        return self::echojs("alert(\"$msg\");\nwindow.parent.location.href=\"$url\";");
    }
    /**
     * 弹出信息框
     * @param $str
     * @return unknown_type
     */
    static function js_alert($msg)
    {
        return self::echojs("alert('$msg');");
    }
    /**
     * 跳转
     * @param $msg
     * @param $url
     * @return unknown_type
     */
    static function js_goto($msg,$url)
    {
        return self::echojs("alert('$msg');\nwindow.location.href=\"$url\";\n");
    }
    /**
     * 父框架重载入
     * @param $msg
     * @param $url
     * @return unknown_type
     */
    static function js_parent_reload($msg)
    {
        return self::echojs("alert('$msg');\nwindow.parent.location.reload();");
    }
    /**
     * 弹出信息并关闭窗口
     * @param $msg
     * @param $url
     * @return unknown_type
     */
    static function js_alert_close($msg)
    {
        return self::echojs("alert('$msg');\nwindow.self.close();\n");
    }
    /**
     * 弹出确认，确定则进入$true指定的网址，否则转向$false指定的网址
     * @param $msg
     * @param $url
     * @return unknown_type
     */
    static function js_confirm($msg,$true,$false)
    {
        $js = "if(confirm('$msg')) location.href=\"{$true}\";\n";
        $js .= "else location.href=\"$false\";\n";
        return self::echojs($js);
    }
    /**
     * 弹出确认，确定则进入$true指定的网址，否则返回
     * @param $msg
     * @param $url
     * @return unknown_type
     */
    static function js_confirmback($msg,$true)
    {
        $js = "if(confirm('$msg')) location.href=\"{$true}\";\n";
        $js .= "else history.go(-1);\n";
        return self::echojs($js);
    }
}
