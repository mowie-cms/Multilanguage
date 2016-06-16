<?php

class lang
{
	private $lang;
	private $langfiles;
	private $default;

	//Determine the user's language
	function __construct($default = 'en')
	{
		$this->default = $default;
		$this->lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
		$this->langfiles = [];
	}

	//Get Langfiles by Folder
	public function setLangFolder($folder)
	{
		//If langfolder exists...
		if (file_exists($folder) && is_dir($folder))
		{
			//Loop through it...
			if ($handle = opendir($folder))
			{
				while (false !== ($langfile = readdir($handle)))
				{
					if (strpos($langfile, 'lang') !== false)
					{
						//and put all langfiles in an array
						$lang = [];
						require $folder . $langfile;
						if (isset($this->langfiles[$lang['__LangCode__']]['langstrings'])) $langstrings = $this->langfiles[$lang['__LangCode__']]['langstrings'];
						foreach ($lang as $langKey => $langString)
						{
							$langstrings[$langKey] = $langString;
						}

						//echo '<pre>'.print_r($langstrings, true).'</pre>';
						$this->langfiles[$lang['__LangCode__']] = ['Lang' => $lang['__Lang__'], 'countrycode' => $lang['__Countrycode__'], 'file' => $folder . $langfile, 'langstrings' => $langstrings];
					}
				}
				closedir($handle);
			}
		}
	}

	//Get Langfiles by direct declaration
	public function setLang($langfile, $langC)
	{
		$lang = [];
		require $langfile;
		if (isset($this->langfiles[$lang['__LangCode__']]['langstrings'])) $langstrings = $this->langfiles[$lang['__LangCode__']]['langstrings'];
		foreach ($lang as $langKey => $langString)
		{
			$langstrings[$langKey] = $langString;
		}

		$this->langfiles[$lang['__LangCode__']] = ['Lang' => $lang['__Lang__'], 'countrycode' => $lang['__Countrycode__'], 'file' => $langfile, 'langstrings' => $langstrings];
	}

	//Get all available languages
	public function getAll()
	{
		return $this->langfiles;
	}

	//Get langstrings
	public function get($identifier)
	{
		//If Langueage exists...
		if (array_key_exists($this->lang, $this->langfiles))
		{
			//...and a value for the corresponding key
			if (array_key_exists($identifier, $this->langfiles[$this->lang]['langstrings']))
			{
				//Outpout it
				return $this->langfiles[$this->lang]['langstrings'][$identifier];
			}
			else
			{
				//If not, fallback to the default language
				if (array_key_exists($identifier, $this->langfiles[$this->default]['langstrings']))
				{
					return $this->langfiles[$this->default]['langstrings'][$identifier];
				}
				else
				{
					//If this doesn't exists, return the identifier
					return $identifier;
				}
			}
		}
		else//Fallback to the default language
		{
			if (array_key_exists($identifier, $this->langfiles[$this->default]['langstrings']))
			{
				return $this->langfiles[$this->default]['langstrings'][$identifier];
			}
			else
			{
				//If this doesn't exists, return the identifier
				return $identifier;
			}
		}
	}
}