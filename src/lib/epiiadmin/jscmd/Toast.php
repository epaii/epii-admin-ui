<?php
/**
 * Created by PhpStorm.
 * User: mrren
 * Date: 2018/7/5
 * Time: 上午9:37
 */

namespace epii\admin\ui\lib\epiiadmin\jscmd;


/**
 * @method \epii\admin\ui\lib\epiiadmin\jscmd\Toast make() static
 * @method Array data()
 * @method \epii\admin\ui\lib\epiiadmin\jscmd\Toast msg(string $msg)
 * @method \epii\admin\ui\lib\epiiadmin\jscmd\Toast onFinish(\epii\admin\ui\lib\i\epiiadmin\IJsCmd $cmd)
 */
class Toast  extends JsCmdCommon
{
    public function init()
    {
         $this->msg("成功");// TODO: Change the autogenerated stub
    }
}