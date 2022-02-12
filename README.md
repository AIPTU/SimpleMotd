# SimpleMotd

[![](https://poggit.pmmp.io/shield.state/SimpleMotd)](https://poggit.pmmp.io/p/SimpleMotd)
[![](https://poggit.pmmp.io/shield.dl.total/SimpleMotd)](https://poggit.pmmp.io/p/SimpleMotd)

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
config-version: 1.1

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
datetime-format: "H:i:s"

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

# Upcoming Features

- Currently none planned. You can contribute or suggest for new features.

# Additional Notes

- If you find bugs or want to give suggestions, please visit [here](https://github.com/AIPTU/SimpleMotd/issues).
- We accept all contributions! If you want to contribute, please make a pull request in [here](https://github.com/AIPTU/SimpleMotd/pulls).
- Icons made from [www.flaticon.com](https://www.flaticon.com)
