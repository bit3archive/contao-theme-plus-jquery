<?php if (!defined('TL_ROOT')) die('You can not access this file directly!');

/**
 * Theme+ jQuery integration
 * Copyright (C) 2010,2011 Tristan Lins
 *
 * Extension for:
 * Contao Open Source CMS
 * Copyright (C) 2005-2010 Leo Feyer
 *
 * Formerly known as TYPOlight Open Source CMS.
 *
 * This program is free software: you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation, either
 * version 3 of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this program. If not, please visit the Free
 * Software Foundation website at <http://www.gnu.org/licenses/>.
 *
 * PHP version 5
 * @copyright  InfinitySoft 2010,2011
 * @author     Tristan Lins <tristan.lins@infinitysoft.de>
 * @package    Theme+
 * @license    LGPL
 * @filesource
 */


/**
 * Class ThemePlusJQuery
 */
class ThemePlusJQuery
{
	/**
	 * Add jquery
	 */
	public function addJQuery($objPage, $objLayout, $objPageRegular)
	{
		$strSrc = $GLOBALS['TL_JQUERY_VERSION'][$objLayout->jqueryVersion][$objLayout->jquerySource];

		/* Fallback */
		if (!$strSrc)
		{
			$strSrc = 'plugins/jquery/js/jquery-1.6.2.min.js';
		}

		if ($objLayout->mooSource)
		{
			// search mootools more script and add jquery after it
			$i = 0;
			foreach ($GLOBALS['TL_JAVASCRIPT'] as $k=>$strJavascript)
			{
				if (strpos($strJavascript, '/mootools-more.js') !== false)
				{
					$i = $k + 1;
					break;
				}
			}

			// implicit add noconflict script
			$strSrc = array
			(
				$strSrc,
				'system/modules/theme_plus_jquery/html/jquery-nc.js'
			);

			// insert script(s)
			array_insert($GLOBALS['TL_JAVASCRIPT'], $i, $strSrc);
		}
		else
		{
			// add noconflict script
			if ($objLayout->jqueryNoConflict)
			{
				array_unshift($GLOBALS['TL_JAVASCRIPT'], 'system/modules/theme_plus_jquery/html/jquery-nc.js');
			}
			// add jquery on top
			array_unshift($GLOBALS['TL_JAVASCRIPT'], 'plugins/mootools/' . MOOTOOLS . '/mootools-more.js');
		}
	}
}
