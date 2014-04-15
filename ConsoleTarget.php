<?php
/**
 * @link http://www.yiiframework.com/
 * @license http://www.yiiframework.com/license/
 */

namespace pahanini\log;

/**
 * ConsoleTarget writes log to console (useful for debugging console applications)
 *
 * @author pahanini <pahanini@gmail.com>
 */
class ConsoleTarget extends \yii\log\Target
{
	/**
	 * Sends log messages to console.
	 */
	public function export()
	{
		foreach ($this->messages as $message) {
			echo $this->formatMessage($message) . "\n";
		}
	}

	/**
	 * @inheritdoc
	 */
	public function formatMessage($message)
	{
		list($text, $level, $category, $timestamp) = $message;
		$level = \yii\log\Logger::getLevelName($level);
		if (!is_string($text)) {
			$text = var_export($text, true);
		}
		return "[$level][$category] $text";
	}
}
