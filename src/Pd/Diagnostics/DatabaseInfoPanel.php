<?php

namespace Pd\Diagnostics;

use Tracy;


/**
 * Provides info about current database
 */
class DatabaseInfoPanel implements Tracy\IBarPanel
{
	/** @var array<string, string> */
	private array $databaseParams;

	/** @var array<string> */
	private array $possibleDbNameKeys = ['dbname', 'database'];

	private ?IDatabaseInfoPanelStyleHandler$styleCallback;

	/**
	 * @param array<string, string> $databaseParams All database parameters in [{key => val}] format
	 * @param string|null $customDbNameKey Custom key of DB name value
	 * @param IDatabaseInfoPanelStyleHandler|null $styleCallback Handler with formating of DB name label in panel
	 */
	public function __construct(array $databaseParams, ?string $customDbNameKey = NULL, ?IDatabaseInfoPanelStyleHandler $styleCallback = NULL)
	{
		$this->setDatabaseParams($databaseParams);

		if ($customDbNameKey) array_unshift($this->possibleDbNameKeys, $customDbNameKey);

		$this->styleCallback = $styleCallback;
	}


	/**
	 * @param array<string, string> $databaseParams
	 */
	private function setDatabaseParams(array $databaseParams): void
	{
		if (array_key_exists('password', $databaseParams)) unset($databaseParams['password']);
		$this->databaseParams = $databaseParams;
	}


	private function getDatabaseName(): string
	{
		foreach ($this->possibleDbNameKeys as $key) {
			if (array_key_exists($key, $this->databaseParams)) return $this->databaseParams[$key];
		}
		return 'db name not set';
	}


	public function getTab(): string
	{
		if ($this->styleCallback) $style = ' style="' . $this->styleCallback->getStyle($this->getDatabaseName(), $this->databaseParams) . '"';
		else $style = '';

		return '<span title="Database connection info">'
			. '<img width=16 height=16 src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAQAAAC1+jfqAAAABGdBTUEAAK/INwWK6QAAABl0RVh0U29mdHdhcmUAQWRvYmUgSW1hZ2VSZWFkeXHJZTwAAAEYSURBVBgZBcHPio5hGAfg6/2+R980k6wmJgsJ5U/ZOAqbSc2GnXOwUg7BESgLUeIQ1GSjLFnMwsKGGg1qxJRmPM97/1zXFAAAAEADdlfZzr26miup2svnelq7d2aYgt3rebl585wN6+K3I1/9fJe7O/uIePP2SypJkiRJ0vMhr55FLCA3zgIAOK9uQ4MS361ZOSX+OrTvkgINSjS/HIvhjxNNFGgQsbSmabohKDNoUGLohsls6BaiQIMSs2FYmnXdUsygQYmumy3Nhi6igwalDEOJEjPKP7CA2aFNK8Bkyy3fdNCg7r9/fW3jgpVJbDmy5+PB2IYp4MXFelQ7izPrhkPHB+P5/PjhD5gCgCenx+VR/dODEwD+A3T7nqbxwf1HAAAAAElFTkSuQmCC" />'
			. "<span title=\"Database name\"$style>{$this->getDatabaseName()}</span>"
			. '</span>';
	}


	public function getPanel(): string
	{
		ob_start();
		include __DIR__ . '/DatabaseInfoPanel.phtml';
		return (string) ob_get_clean();
	}

}
