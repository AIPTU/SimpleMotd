<?php

/*
 *
 * Copyright (c) 2021 AIPTU
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 *
 */

declare(strict_types=1);

namespace aiptu\simplemotd;

use pocketmine\plugin\PluginBase;
use pocketmine\scheduler\ClosureTask;
use pocketmine\utils\TextFormat;
use function array_rand;
use function count;
use function date;
use function rename;
use function str_replace;

final class SimpleMotd extends PluginBase
{
	private const CONFIG_VERSION = 1.1;

	private TypedConfig $typedConfig;

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

	public function getTypedConfig(): TypedConfig
	{
		return $this->typedConfig;
	}

	private function checkConfig(): void
	{
		$this->saveDefaultConfig();

		if (!$this->getConfig()->exists('config-version') || ($this->getConfig()->get('config-version', self::CONFIG_VERSION) !== self::CONFIG_VERSION)) {
			$this->getLogger()->warning('An outdated config was provided attempting to generate a new one...');
			if (!rename($this->getDataFolder() . 'config.yml', $this->getDataFolder() . 'config.old.yml')) {
				$this->getLogger()->critical('An unknown error occurred while attempting to generate the new config');
				$this->getServer()->getPluginManager()->disablePlugin($this);
			}
			$this->reloadConfig();
		}

		$this->typedConfig = new TypedConfig($this->getConfig());
	}

	private function loadMotd(): void
	{
		$typedConfig = $this->getTypedConfig();

		if ($typedConfig->getBool('motd.enabled', true)) {
			$time = $typedConfig->getInt('motd.time', 15) * 20;

			$this->getScheduler()->scheduleRepeatingTask(new ClosureTask(
				function () use ($typedConfig): void {
					$messages = $typedConfig->getStringList('motd.messages');
					$message = $messages[array_rand($messages)];

					$this->getServer()->getNetwork()->setName(TextFormat::colorize($this->replaceVars($message, [
						'MAX_PLAYERS' => $this->getServer()->getMaxPlayers(),
						'ONLINE_PLAYERS' => count($this->getServer()->getOnlinePlayers()),
						'PREFIX' => $typedConfig->getString('prefix'),
						'SUFFIX' => $typedConfig->getString('suffix'),
						'TIME' => date($typedConfig->getString('datetime-format', 'H:i:s')),
					])));
				}
			), $time);
		}
	}
}
