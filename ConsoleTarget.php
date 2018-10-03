<?php
/**
 * @link http://www.yiiframework.com/
 * @license http://www.yiiframework.com/license/
 */

namespace pahanini\log;

use Yii;
use yii\helpers\Console;
use yii\log\Logger;
use yii\log\Target;
use yii\helpers\VarDumper;

/**
 * ConsoleTarget writes log to console (useful for debugging console applications)
 *
 * @author pahanini <pahanini@gmail.com>
 */
class ConsoleTarget extends Target
{
    /**
     * @var bool If true context message will be added to the end of output
     */
    public $enableContextMassage = false;

    public $displayCategory = false;

    public $displayDate = false;

    public $dateFormat = 'Y-m-d H:i:s';

    public $padSize = 30;

    /**
     * @var array color scheme for message labels
     */
    public $color = [
        'error' => Console::BG_RED
    ];

    /**
     * @inheritdoc
     * @return string
     */
    protected function getContextMessage()
    {
        return $this->enableContextMassage ? parent::getContextMessage() : '';
    }

    /**
     * @inheritdoc
     */
    public function export()
    {
        foreach ($this->messages as $message) {
            if ($message[1] == Logger::LEVEL_ERROR) {
                Console::error($this->formatMessage($message));
            } else {
                Console::output($this->formatMessage($message));
            }
        }
    }

    /**
     * @param array $message
     * 0 - massage
     * 1 - level
     * 2 - category
     * 3 - timestamp
     * 4 - ???
     *
     * @return string
     */
    public function formatMessage($message)
    {

        $label = $this->generateLabel($message);
        $text = $this->generateText($message);

        return str_pad($label, $this->padSize, ' ') . ' '.$text;
    }

    /**
     * @param $message
     *
     * @return string
     */
    private function generateLabel($message)
    {
        $label = '';

        //Add date to log
        if (true == $this->displayDate) {
            $label.= '['.date($this->dateFormat, $message[3]).']';
        }

        //Add category to label
        if (true == $this->displayCategory) {
            $label.= "[".$message[2]."]";
        }
        $level = Logger::getLevelName($message[1]);

        $tmpLevel= "[$level]";

        if (Console::streamSupportsAnsiColors(\STDOUT)) {
            if (isset($this->color[$level])) {
                $tmpLevel = Console::ansiFormat($tmpLevel, [$this->color[$level]]);
            } else {
                $tmpLevel = Console::ansiFormat($tmpLevel, [Console::BOLD]);
            }
        }
        $label.= $tmpLevel;

        return $label;
    }

    /**
     * @param $message
     *
     * @return string
     */
    private function generateText($message)
    {
        $text = $message[0];
        if (!is_string($text)) {
            // exceptions may not be serializable if in the call stack somewhere is a Closure
            if ($text instanceof \Throwable || $text instanceof \Exception) {
                $text = (string) $text;
            } else {
                $text = VarDumper::export($text);
            }
        }
        return $text;
    }
}
