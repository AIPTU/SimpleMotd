# SimpleMotd

[![Discord](https://img.shields.io/discord/830063409000087612?color=7389D8&label=discord)](https://discord.com/invite/EggNF9hvGv)

A PocketMine-MP plugin to change server motd easily.

# Features

- Supports `&` as formatting codes.
- `{PREFIX}` can be used to display prefix motd message.
- `{SUFFIX}` can be used to display suffix motd message.
- `{TIME}` can be used to display currently date/time.
- `{ONLINE_PLAYERS}` can be used to display currently online players on the server.
- `{MAX_PLAYERS}` can be used to display maximum online players on the server.
- Lightweight and open source ❤️

# Default Config
```yaml
---
# Do not change this (Only for internal use)!
config-version: 1.0

# Available tags for motd messages:
# - {MAX_PLAYERS}: Show the maximum number of players supported by the server.
# - {ONLINE_PLAYERS}: Show the number of all online players.
# - {PREFIX}: Show prefix.
# - {SUFFIX}: Show suffix.
# - {TIME}: Show current time.
# Use "§" or "&" to color the message.

# Prefix
prefix: "&b»"
# Suffix
suffix: "&b«"
# Date\Time format (replaced in {TIME}).
# For format codes read https://php.net/manual/en/datetime.formats.php
datetime-format: "H:i:s".

motd:
  # Enable the motd.
  enabled: true
  # Motd interval (in seconds).
  time: 15
  # Messages used to display motd.
  messages:
    - "&a[{TIME}] {PREFIX} Welcome to my server {SUFFIX}"
    - "&b[{TIME}] Current online: &a{ONLINE_PLAYERS}/{MAX_PLAYERS}"
    - "&b[{TIME}] {PREFIX} Hello World &a{SUFFIX}"
...

```

# How to Install

1. Download the plugin from [here](https://poggit.pmmp.io/ci/AIPTU/SimpleMotd/SimpleMotd).
2. Put the `SimpleMotd.phar` file into the `plugins` folder.
3. Restart the server.
4. Done!

# Upcoming Features

- Currently none planned. You can contribute or suggest for new features.

# Additional Notes

- If you find bugs or want to give suggestions, please visit [here](https://github.com/AIPTU/SimpleMotd/issues).
- We accept any contributions! If you want to contribute please make a pull request in [here](https://github.com/AIPTU/SimpleMotd/pulls).
- Icons made from [www.flaticon.com](https://www.flaticon.com)
