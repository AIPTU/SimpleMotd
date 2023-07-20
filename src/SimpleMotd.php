<?php

/*
 * Copyright (c) 2021-2023 AIPTU
 *
 * For the full copyright and license information, please view
 * the LICENSE.md file that was distributed with this source code.
 *
 * @see https://github.com/AIPTU/SimpleMotd
 */

declare(strict_types=1);

namespace aiptu\simplemotd;

use pocketmine\plugin\PluginBase;
use pocketmine\scheduler\ClosureTask;
use pocketmine\utils\TextFormat;
use Symfony\Component\Filesystem\Exception\IOException;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Path;
use function array_rand;
use function count;
use function date;
use function is_array;
use function is_bool;
use function is_int;
use function is_string;
use function str_replace;

class SimpleMotd extends PluginBase {
	private const CONFIG_VERSION = 1.1;

	public function onEnable() : void {
		$this->checkConfig();
		$this->loadMotd();
	}

	/**
	 * Replaces variables in a given string with their corresponding values from the provided associative array.
	 */
	private function replaceVars(string $str, array $vars) : string {
		foreach ($vars as $key => $value) {
			$str = str_replace('{' . $key . '}', (string) $value, $str);
		}
		return $str;
	}

	/**
	 * Checks and manages the configuration for the plugin.
	 * Generates a new configuration if an outdated one is provided and backs up the old config.
	 */
	private function checkConfig() : void {
		$this->saveDefaultConfig();
		$config = $this->getConfig();

		if (!$config->exists('config-version') || $config->get('config-version', self::CONFIG_VERSION) !== self::CONFIG_VERSION) {
			$this->getLogger()->warning('An outdated config was provided; attempting to generate a new one...');

			$oldConfigPath = Path::join($this->getDataFolder(), 'config.old.yml');
			$newConfigPath = Path::join($this->getDataFolder(), 'config.yml');

			$filesystem = new Filesystem();
			try {
				$filesystem->rename($newConfigPath, $oldConfigPath);
			} catch (IOException $e) {
				$this->getLogger()->critical('An error occurred while attempting to generate the new config: ' . $e->getMessage());
				$this->getServer()->getPluginManager()->disablePlugin($this);
				return;
			}

			$this->reloadConfig();
		}
	}

	/**
	 * Loads and schedules the MOTD (Message of the Day) to be displayed periodically.
	 * If MOTD is not enabled in the configuration, it will skip the process.
	 */
	private function loadMotd() : void {
		$config = $this->getConfig();

		$motdEnabled = $config->getNested('motd.enabled', true);
		if (!is_bool($motdEnabled)) {
			$this->getLogger()->warning('Invalid value for "motd.enabled" in the config. Expected a boolean value.');
			return;
		}

		if (!$motdEnabled) {
			return;
		}

		$time = $config->getNested('motd.time', 15);
		if (!is_int($time) || $time <= 0) {
			$this->getLogger()->warning('Invalid value for "motd.time" in the config. Expected a positive integer value.');
			return;
		}

		$time *= 20;

		$messages = $config->getNested('motd.messages', []);
		if (!is_array($messages) || count($messages) === 0) {
			$this->getLogger()->warning('Invalid or empty "motd.messages" in the config. Expected a non-empty array of MOTD messages.');
			return;
		}

		$datetimeFormat = $config->get('datetime-format', 'H:i:s');
		if (!is_string($datetimeFormat)) {
			$this->getLogger()->warning('Invalid value for "datetime-format" in the config. Expected a string value.');
			return;
		}

		$this->getScheduler()->scheduleRepeatingTask(new ClosureTask(function () use ($config, $messages, $datetimeFormat) : void {
			$message = $messages[array_rand($messages)];

			$prefix = $config->get('prefix', '');
			$suffix = $config->get('suffix', '');

			if (!is_string($prefix) || !is_string($suffix)) {
				$this->getLogger()->warning('Invalid value for "prefix" or "suffix" in the config. Expected string values.');
				return;
			}

			$vars = [
				'MAX_PLAYERS' => $this->getServer()->getMaxPlayers(),
				'ONLINE_PLAYERS' => count($this->getServer()->getOnlinePlayers()),
				'PREFIX' => $prefix,
				'SUFFIX' => $suffix,
				'TIME' => date($datetimeFormat),
			];

			$formattedMessage = $this->replaceVars($message, $vars);

			$this->getServer()->getNetwork()->setName(TextFormat::colorize($formattedMessage));
		}), $time);
	}
}
