# pd/db-info-panel

Panel for Nette Debug bar which quickly tells you which database you use.

## Setup

```
	parameters:
		database:
			host: 192.168.0.1
			dbname: databasename
			user: username
			password: abcdef

	services:
		databaseInfoPanel:
			class: Pd\Diagnostics\DatabaseInfoPanel(%database%)

	nette:
		debugger:
			bar:
				- @databaseInfoPanel
```
