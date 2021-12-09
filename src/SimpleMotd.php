<?php

declare(strict_types=1);

namespace aiptu\simplemotd;

use pocketmine\plugin\PluginBase;
use pocketmine\scheduler\ClosureTask;
use pocketmine\utils\TextFormat;
use function array_rand;
use function count;
use function gettype;
use function rename;
use function str_replace;

final class SimpleMotd extends PluginBase
{
	public function onEnable(): void
	{
		$this->checkConfig();

		$this->loadMotd();
	}

	public function replaceVars(string $str, array $vars): string
	{
		foreach ($vars as $key => $value) {
			$str = str_replace('{' . $key . '}', (string) $value, $str);
		}
		return $str;
	}

	private function checkConfig(): void
	{
		$this->saveDefaultConfig();

		if ($this->getConfig()->get('config-version', 1) !== 1) {
			$this->getLogger()->notice('Your configuration file is outdated, updating the config.yml...');
			$this->getLogger()->notice('The old configuration file can be found at config.old.yml');

			rename($this->getDataFolder() . 'config.yml', $this->getDataFolder() . 'config.old.yml');

			$this->reloadConfig();
		}

		foreach ([
			'prefix' => 'string',
			'suffix' => 'string',
			'motd.enabled' => 'boolean',
			'motd.time' => 'integer',
			'motd.messages' => 'array',
		] as $option => $expectedType) {
			if (($type = gettype($this->getConfig()->getNested($option))) !== $expectedType) {
				throw new \TypeError("Config error: Option ({$option}) must be of type {$expectedType}, {$type} was given");
			}
		}
	}

	private function loadMotd(): void
	{
		$config = $this->getConfig()->getAll();

		if ((bool) $config['motd']['enabled']) {
			$time = (int) ($config['motd']['time']) * 20;

			$this->getScheduler()->scheduleRepeatingTask(new ClosureTask(
				function () use ($config): void {
					$messages = $config['motd']['messages'];
					$message = $messages[array_rand($messages)];

					$this->getServer()->getNetwork()->setName(TextFormat::colorize($this->replaceVars($message, [
						'MAX_PLAYERS' => $this->getServer()->getMaxPlayers(),
						'ONLINE_PLAYERS' => count($this->getServer()->getOnlinePlayers()),
						'PREFIX' => $config['prefix'],
						'SUFFIX' => $config['suffix'],
					])));
				}
			), $time);
		}
	}
}
