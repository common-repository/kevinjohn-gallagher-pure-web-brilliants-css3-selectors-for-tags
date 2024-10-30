<?php
/*
	Plugin Name: 			Kevinjohn Gallagher: Pure Web Brilliant's CSS3 selectors for <p> tags
	Description: 			Adds classes to <p> tags to allow child node selection without CSS3.
	Version: 				2.1
	Author: 				Kevinjohn Gallagher
	Author URI: 			http://kevinjohngallagher.com/
	
	Contributors:			kevinjohngallagher, purewebbrilliant 
	Donate link:			http://kevinjohngallagher.com/
	Tags: 					kevinjohn gallagher, pure web brilliant, framework, cms, simple, multisite, css, styles, css3
	Requires at least:		3.0
	Tested up to: 			3.4
	Stable tag: 			2.1
*/
/**
 *
 *	Kevinjohn Gallagher: Pure Web Brilliant's CSS3 selectors for <p> tags
 * =======================================================================
 *
 *	Adds classes to <p> tags to allow child node selection without CSS3.
 *
 *
 *	This program is free software; you can redistribute it and/or modify it under the terms of the GNU 
 *	General Public License as published by the Free Software Foundation; either version 3 of the License, 
 *	or (at your option) any later version.
 *
 * 	This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; 
 *	without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 *	See the GNU General Public License (http://www.gnu.org/licenses/gpl-3.0.txt) for more details.
 *
 *	You should have received a copy of the GNU General Public License along with this program.  
 * 	If not, see http://www.gnu.org/licenses/ or http://www.gnu.org/licenses/gpl-3.0.txt
 *
 *
 *	Copyright (C) 2008-2012 Kevinjohn Gallagher / http://www.kevinjohngallagher.com
 *
 *
 *	@package				Pure Web Brilliant
 *	@version 				2.1
 *	@author 				Kevinjohn Gallagher <wordpress@kevinjohngallagher.com>
 *	@copyright 				Copyright (c) 2012, Kevinjohn Gallagher
 *	@link 					http://kevinjohngallagher.com
 *	@license 				http://www.gnu.org/licenses/gpl-3.0.txt
 *
 *
 */
 

 	if ( ! defined( 'ABSPATH' ) )
 	{ 
 			die( 'Direct access not permitted.' ); 
 	}
 	
 	
 	


	define( '_KEVINJOHN_GALLAGHER___P_TAG_CSS3_SELECTORS_VIA_PHP', '2.1' );



	if (class_exists('kevinjohn_gallagher')) 
	{
		
		
		class	kevinjohn_gallagher___p_tag_css3_selectors_via_php 
		extends kevinjohn_gallagher
		{
		
				const PM	=	'_kevinjohn_gallagher___p_tag_css3_selectors_via_php';
				var				$instance;
		
		
				public	function	__construct() 
				{
						$this->instance =				&$this;
						$this->uniqueID 				=	self::PM;
						$this->plugin_name				=	"Kevinjohn Gallagher: Pure Web Brilliant's CSS3 selectors ";
						add_action( 'init',				array( $this, 'init' ) );
						add_action( 'init',				array( $this, 'init_child' ) );
				}
				
			
				public function init_child() 
				{
						add_filter( 'the_content',		array( $this, 'p_tag_css3_selectors_in_php' ), 100 );
				}
				
				
				
				/**
				 *		Iterate through the <p> tags to output numberic classes .
				 *
				 *		Iterate through the <p> tags to call out those which occur immediately after a header tag.
				 *		 
				 * 		@content  	content as supplied by the_content filter
				 * 		@return		string
				 */
				public	function	p_tag_css3_selectors_in_php( $content )
				{
				
						//
						//	Paragraphs
						//
						$paragraphs = explode('<p>', $content);
						
					
						if (ctype_space($paragraphs[0]) || $paragraphs[0] == '' ) 
						{
								array_shift($paragraphs);
					//	} else {
					//	
					//		echo "<h3> ERROR </h3>";
						
						}
									
						foreach($paragraphs as $key => $value)
						{	
								if(($key+1) == sizeof($paragraphs))
								{
									$last_paragraph = " paragraph-last";
								}
								
								$paragraphs[$key] = "<p class='paragraph-number-". ($key+1) . $last_paragraph ."'>". $value;
						}		
					
						$content = implode("",$paragraphs);	
				
				
						//
						//	Headings
						//
						$headings = explode('</h', $content);
						
						$keep_safe = array_shift($headings);
						
						foreach($headings as $key => $value)
						{	
						
								$headings[$key] = '</h'. $this->str_insert($value, "<p class='", "first-p-since-a-heading ");
								
						}		
				
						$content = $keep_safe . implode("",$headings);	
					
					    return $content;	    
				}
		
		
		
		}	//	class
		
	
	
		$kevinjohn_gallagher___p_tag_css3_selectors_via_php 	=		new kevinjohn_gallagher___p_tag_css3_selectors_via_php();
	
	} else {
	

			/**
			 *		Outputs WPerror in the admin section
			 *		 
			 */
			function kevinjohn_gallagher___p_tag_css3_selectors_via_php___parent_needed()
			{
					echo	"<div id='message' class='error'>";
					
					echo	"<p>";
					echo	"<strong>Kevinjohn Gallagher: CSS3 selectors for P tags</strong> ";	
					echo	"requires the parent framework to be installed and activated";
					echo	"</p>";
			} 

			add_action('admin_footer', 'kevinjohn_gallagher___p_tag_css3_selectors_via_php___parent_needed');	
	
	}

