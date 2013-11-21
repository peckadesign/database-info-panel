# pd/db-info-panel

Panel for Nette Debug bar which quickly tells you which database you use.

## Usage

![Screenshot](doc/infopanel.png)

## Install

The best way to install is using Composer:
`composer require pd/database-info-panel:@dev`

Another way is [download ZIP archive with last master](https://github.com/peckadesign/database-info-panel/archive/master.zip).

## Setup

Standard configuration with predefined DB name key:

```
parameters:
	database:
		host: 192.168.0.5
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

Standard configuration with predefined DB name key:
```
parameters:
	database:
		database: databasename

services:
	databaseInfoPanel:
		class: Pd\Diagnostics\DatabaseInfoPanel(%database%)
```

Configuration with custom DB name key:
```
parameters:
	database:
		myDbNameKey: databasename

services:
	databaseInfoPanel:
		class: Pd\Diagnostics\DatabaseInfoPanel(%database%, 'myDbNameKey')
```

### Change CSS style of DB name label

```php
class MyDatabaseInfoPanelStyleHandler implements Pd\Diagnostics\IDatabaseInfoPanelStyleHandler
{
	private $colors = array('db' => '#F30', 'db_staging' => '#F60', 'db_dev' => '#060', 'db_local' => '#00C');

	public function getStyle($databaseName, $params)
	{
		$style = array();
		if(array_key_exists($databaseName, $this->colors)) {
			$style[] = 'color: '.$this->colors[$databaseName];
		}
		if($databaseName === 'db') $style[] = 'font-weight: bold'; // production mode
		return implode('; ', $style);
	}

}
```

```
nette:
	services:
		databaseInfoPanelStyleHandler: MyDatabaseInfoPanelStyleHandler

	debugger:
		bar:
			- Pd\Diagnostics\DatabaseInfoPanel(%database%)
```

![Screenshot](doc/custom-color-production.png)
