<?php

namespace Pd\Diagnostics;


/**
 * Based on $databaseName and other database parameters determine the CSS style
 * of DB name label in panel
 */
interface IDatabaseInfoPanelStyleHandler
{
	/**
	 * @var string $databaseName Database name
	 * @var string[] $databaseParams All database parameters
	 * @return string Content of DB name label style atribut
	 */
	public function getStyle($databaseName, $databaseParams);
}
