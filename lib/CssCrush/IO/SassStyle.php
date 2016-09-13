<?php
/**
 *
 * IO class for command line file watching.
 *
 */
namespace CssCrush\IO;

use CssCrush\Crush;
use CssCrush\IO;

class SassStyle extends IO
{
    public static $cacheData = array();

    public function getOutputFileName()
    {
        $process = $this->process;
        $options = $process->options;

        $output_basename = basename($process->input->filename, '.crush');
        $before = substr($output_basename, 0 , 2);
        if(isset($before) && $before == '__'){
            $output_basename = substr($output_basename, 2);
        };

        if (! empty($options->output_file)) {
            $output_basename = basename($process->input->filename, '.crush');
        };

        return $output_basename.".css";
    }

    public function getCacheData()
    {
        // Clear results from earlier processes.
        clearstatcache();
        $this->process->cacheData = array();

        return self::$cacheData;
    }

    public function saveCacheData()
    {
        self::$cacheData = $this->process->cacheData;
    }
}
