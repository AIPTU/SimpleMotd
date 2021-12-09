# SimpleMotd

[![Discord](https://img.shields.io/discord/830063409000087612?color=7389D8&label=discord)](https://discord.com/invite/EggNF9hvGv)
[![GitHub License](https://img.shields.io/github/license/AIPTU/SimpleMotd.svg)](https://github.com/AIPTU/SimpleMotd/blob/master/LICENSE)

A PocketMine-MP plugin to change server motd easily

# Config
```yaml
---
# Do not change this (Only for internal use)!
config-version: 1

# Available tags for motd messages:
# - {MAX_PLAYERS}: Show the maximum number of players supported by the server.
# - {ONLINE_PLAYERS}: Show the number of all online players.
# - {PREFIX}: Show prefix.
# - {SUFFIX}: Show suffix.
# Use "§" or "&" to color the message.

# Prefix
prefix: "&b»"

# Suffix
suffix: "&b«"

motd:
  # Enable the motd.
  enabled: true
  # Motd interval (in seconds).
  time: 15
  # Messages used to display motd.
  messages:
    - "&a{PREFIX} Welcome to my server {SUFFIX}"
    - "&bCurrent online: &a{ONLINE_PLAYERS}/{MAX_PLAYERS}"
...

```

# How to Install

1. Download the plugin from [here](https://poggit.pmmp.io/ci/AIPTU/SimpleMotd/SimpleMotd)
2. Put the `SimpleMotd.phar` file into the `plugins` folder.
3. Restart the server.
4. Done!

# Additional Notes

- If you find bugs or want to give suggestions, please visit [here](https://github.com/AIPTU/SimpleMotd/issues)
- Icons made from [www.flaticon.com](https://www.flaticon.com)

# License

```
MIT License

Copyright (c) 2021 AIPTU

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
```