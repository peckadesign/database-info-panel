<?php

namespace Pd\Diagnostics;


/**
 * Based on $databaseName and other database parameters determine the CSS style
 * of DB name label in panel
 */
interface IDatabaseInfoPanelStyleHandler
{
	/**
	 * @param string $databaseName Database name
	 * @param array<string, string> $databaseParams All database parameters
	 * @return string Content of DB name label style atribut
	 */
	public function getStyle(string $databaseName, array $databaseParams): string;
}
