# SimpleMotd

[![](https://poggit.pmmp.io/shield.state/SimpleMotd)](https://poggit.pmmp.io/p/SimpleMotd)
[![](https://poggit.pmmp.io/shield.dl.total/SimpleMotd)](https://poggit.pmmp.io/p/SimpleMotd)

A PocketMine-MP plugin to change server motd easily.

# Features

- `Dynamic Message of the Day (MOTD)`: The plugin allows server administrators to set up a dynamic MOTD that changes periodically, showing different messages to players when they join the server.
- `MOTD Configuration`: The plugin provides a configuration file that allows administrators to customize various aspects of the MOTD, including enabling or disabling it, setting the interval for message changes, specifying the messages to display, and configuring prefix and suffix text.
- `Placeholder Support`: The plugin supports placeholders in the MOTD messages, allowing administrators to show dynamic information to players. Available placeholders include the maximum number of players supported by the server, the number of online players, the configured prefix and suffix, and the current time.
- `Color Formatting`: The MOTD messages can be colored using "§" or "&" color codes, providing visual appeal and customization options for the server's welcome messages.
- `MOTD Update Interval`: Administrators can set the interval (in seconds) between each MOTD change. This allows them to control how frequently the MOTD messages cycle through the configured options.
- `Config Version Management`: The plugin ensures that the configuration file is up-to-date. If an outdated config file is provided, it generates a new one and backs up the old config, preventing compatibility issues.
- `Error Handling`: The plugin includes error handling mechanisms to notify administrators in case of any configuration issues or critical errors during the generation of a new config.
- `Date/Time Customization`: Administrators can customize the date and time format displayed in the MOTD to match their desired format, using the standard PHP date format codes.
- `MOTD Enable/Disable`: Administrators have the flexibility to enable or disable the MOTD feature altogether. When disabled, the plugin will not proceed with displaying the MOTD messages.
- `MOTD Scheduler`: The plugin uses the PocketMine scheduler to periodically change the MOTD messages based on the configured interval, ensuring a seamless and automatic rotation of messages.

# Default Config
```yaml
# Do not change this (Only for internal use)!
config-version: 1.2

# Prefix used in MOTD messages. Use "§" or "&" to color the message.
prefix: "&b»"
# Suffix used in MOTD messages. Use "§" or "&" to color the message.
suffix: "&b«"
# Date\Time format (replaced in {TIME}).
# For format codes read https://php.net/manual/en/datetime.formats.php
datetime-format: "H:i:s"

# Message of the Day (MOTD) Configuration
motd:
  # Enable the MOTD.
  enabled: true
  # MOTD interval (in seconds).
  time: 15
  # Messages used to display the MOTD. You can use placeholders to show dynamic information.
  # Available placeholders:
  # - {MAX_PLAYERS}: Show the maximum number of players supported by the server.
  # - {ONLINE_PLAYERS}: Show the number of all online players.
  # - {PREFIX}: Show the configured prefix.
  # - {SUFFIX}: Show the configured suffix.
  # - {TIME}: Show current time based on the 'datetime-format' setting.
  # Use "§" or "&" to color the message.
  messages:
    - "&a[{TIME}] {PREFIX} Welcome to our awesome server {SUFFIX}" # Example: [10:30:45] » Welcome to our awesome server «
    - "&b[{TIME}] Current online: &a{ONLINE_PLAYERS}/{MAX_PLAYERS}" # Example: [10:30:45] Current online: 50/100
    - "&b[{TIME}] {PREFIX} Thanks for joining! Have fun! {SUFFIX}" # Example: [10:30:45] » Thanks for joining! Have fun! «

```

# Upcoming Features

- Currently none planned. You can contribute or suggest for new features.

# Additional Notes

- If you find bugs or want to give suggestions, please visit [here](https://github.com/AIPTU/SimpleMotd/issues).
- We accept all contributions! If you want to contribute, please make a pull request in [here](https://github.com/AIPTU/SimpleMotd/pulls).
- Icons made from [www.flaticon.com](https://www.flaticon.com)
