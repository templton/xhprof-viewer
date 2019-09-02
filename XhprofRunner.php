<?php

class XhprofRunner
{
    public static function start()
    {
        $xhprof_data = xhprof_enable(XHPROF_FLAGS_CPU + XHPROF_FLAGS_MEMORY);
    }


    public static function stop($namespace)
    {
        $namespace=str_replace('/','-',$namespace);
        $namespace=str_replace('\\','-',$namespace);
        $namespace=date('Y-m-d=H:i:s').'_'.$namespace;

        $xhprof_data = xhprof_disable();

        include_once "xhprof/xhprof_lib/utils/xhprof_lib.php";
        include_once "xhprof/xhprof_lib/utils/xhprof_runs.php";
        $xhprof_runs = new \XHProfRuns_Default();

        $run_id = $xhprof_runs->save_run($xhprof_data, $namespace);

        //echo "http://localhost:8000/?run={$run_id}&sort=cpu&source={$namespace}\n";
    }
}