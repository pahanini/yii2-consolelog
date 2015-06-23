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
            echo $this->formatMessage($message) . PHP_EOL;
        }
    }

    /**
     * @inheritdoc
     */
    public function formatMessage($message)
    {
        $text = $message[0];
        $level = Logger::getLevelName($message[1]);
        if (!is_string($text)) {
            $text = '(not string)';
        }
        if (Console::streamSupportsAnsiColors(\STDOUT)) {
			if(isset($this->color[$level])) {
				$level = Console::ansiFormat("[$level]", [$this->color[$level]]);
			} else {
				$level = "[$level]";
			}
            $level = Console::ansiFormat($level, [Console::BOLD]);
        }
        return "$level\t$text";
    }
}
