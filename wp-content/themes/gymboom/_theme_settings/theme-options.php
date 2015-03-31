<?php

add_action('admin_init', 'gymboom_theme_options');
function gymboom_theme_options() {
	
	/**
	 * Get a copy of the saved settings array. 
	 */
	$saved_settings = get_option( ot_settings_id(), array() );
	
	$google_fonts = 'ABeeZee+++Abel+++Abril Fatface+++Aclonica+++Acme+++Actor+++Adamina+++Advent Pro+++Aguafina Script+++Akronim+++Aladin+++Aldrich+++Alef+++Alegreya+++Alegreya SC+++Alegreya Sans+++Alegreya Sans SC+++Alex Brush+++Alfa Slab One+++Alice+++Alike+++Alike Angular+++Allan+++Allerta+++Allerta Stencil+++Allura+++Almendra+++Almendra Display+++Almendra SC+++Amarante+++Amaranth+++Amatic SC+++Amethysta+++Anaheim+++Andada+++Andika+++Angkor+++Annie Use Your Telescope+++Anonymous Pro+++Antic+++Antic Didone+++Antic Slab+++Anton+++Arapey+++Arbutus+++Arbutus Slab+++Architects Daughter+++Archivo Black+++Archivo Narrow+++Arimo+++Arizonia+++Armata+++Artifika+++Arvo+++Asap+++Asset+++Astloch+++Asul+++Atomic Age+++Aubrey+++Audiowide+++Autour One+++Average+++Average Sans+++Averia Gruesa Libre+++Averia Libre+++Averia Sans Libre+++Averia Serif Libre+++Bad Script+++Balthazar+++Bangers+++Basic+++Battambang+++Baumans+++Bayon+++Belgrano+++Belleza+++BenchNine+++Bentham+++Berkshire Swash+++Bevan+++Bigelow Rules+++Bigshot One+++Bilbo+++Bilbo Swash Caps+++Bitter+++Black Ops One+++Bokor+++Bonbon+++Boogaloo+++Bowlby One+++Bowlby One SC+++Brawler+++Bree Serif+++Bubblegum Sans+++Bubbler One+++Buda+++Buenard+++Butcherman+++Butterfly Kids+++Cabin+++Cabin Condensed+++Cabin Sketch+++Caesar Dressing+++Cagliostro+++Calligraffitti+++Cambo+++Candal+++Cantarell+++Cantata One+++Cantora One+++Capriola+++Cardo+++Carme+++Carrois Gothic+++Carrois Gothic SC+++Carter One+++Caudex+++Cedarville Cursive+++Ceviche One+++Changa One+++Chango+++Chau Philomene One+++Chela One+++Chelsea Market+++Chenla+++Cherry Cream Soda+++Cherry Swash+++Chewy+++Chicle+++Chivo+++Cinzel+++Cinzel Decorative+++Clicker Script+++Coda+++Coda Caption+++Codystar+++Combo+++Comfortaa+++Coming Soon+++Concert One+++Condiment+++Content+++Contrail One+++Convergence+++Cookie+++Copse+++Corben+++Courgette+++Cousine+++Coustard+++Covered By Your Grace+++Crafty Girls+++Creepster+++Crete Round+++Crimson Text+++Croissant One+++Crushed+++Cuprum+++Cutive+++Cutive Mono+++Damion+++Dancing Script+++Dangrek+++Dawning of a New Day+++Days One+++Delius+++Delius Swash Caps+++Delius Unicase+++Della Respira+++Denk One+++Devonshire+++Didact Gothic+++Diplomata+++Diplomata SC+++Domine+++Donegal One+++Doppio One+++Dorsa+++Dosis+++Dr Sugiyama+++Droid Sans+++Droid Sans Mono+++Droid Serif+++Duru Sans+++Dynalight+++EB Garamond+++Eagle Lake+++Eater+++Economica+++Electrolize+++Elsie+++Elsie Swash Caps+++Emblema One+++Emilys Candy+++Engagement+++Englebert+++Enriqueta+++Erica One+++Esteban+++Euphoria Script+++Ewert+++Exo+++Exo 2+++Expletus Sans+++Fanwood Text+++Fascinate+++Fascinate Inline+++Faster One+++Fasthand+++Fauna One+++Federant+++Federo+++Felipa+++Fenix+++Finger Paint+++Fjalla One+++Fjord One+++Flamenco+++Flavors+++Fondamento+++Fontdiner Swanky+++Forum+++Francois One+++Freckle Face+++Fredericka the Great+++Fredoka One+++Freehand+++Fresca+++Frijole+++Fruktur+++Fugaz One+++GFS Didot+++GFS Neohellenic+++Gabriela+++Gafata+++Galdeano+++Galindo+++Gentium Basic+++Gentium Book Basic+++Geo+++Geostar+++Geostar Fill+++Germania One+++Gilda Display+++Give You Glory+++Glass Antiqua+++Glegoo+++Gloria Hallelujah+++Goblin One+++Gochi Hand+++Gorditas+++Goudy Bookletter 1911+++Graduate+++Grand Hotel+++Gravitas One+++Great Vibes+++Griffy+++Gruppo+++Gudea+++Habibi+++Hammersmith One+++Hanalei+++Hanalei Fill+++Handlee+++Hanuman+++Happy Monkey+++Headland One+++Henny Penny+++Herr Von Muellerhoff+++Holtwood One SC+++Homemade Apple+++Homenaje+++IM Fell DW Pica+++IM Fell DW Pica SC+++IM Fell Double Pica+++IM Fell Double Pica SC+++IM Fell English+++IM Fell English SC+++IM Fell French Canon+++IM Fell French Canon SC+++IM Fell Great Primer+++IM Fell Great Primer SC+++Iceberg+++Iceland+++Imprima+++Inconsolata+++Inder+++Indie Flower+++Inika+++Irish Grover+++Istok Web+++Italiana+++Italianno+++Jacques Francois+++Jacques Francois Shadow+++Jim Nightshade+++Jockey One+++Jolly Lodger+++Josefin Sans+++Josefin Slab+++Joti One+++Judson+++Julee+++Julius Sans One+++Junge+++Jura+++Just Another Hand+++Just Me Again Down Here+++Kameron+++Kantumruy+++Karla+++Kaushan Script+++Kavoon+++Kdam Thmor+++Keania One+++Kelly Slab+++Kenia+++Khmer+++Kite One+++Knewave+++Kotta One+++Koulen+++Kranky+++Kreon+++Kristi+++Krona One+++La Belle Aurore+++Lancelot+++Lato+++League Script+++Leckerli One+++Ledger+++Lekton+++Lemon+++Libre Baskerville+++Life Savers+++Lilita One+++Lily Script One+++Limelight+++Linden Hill+++Lobster+++Lobster Two+++Londrina Outline+++Londrina Shadow+++Londrina Sketch+++Londrina Solid+++Lora+++Love Ya Like A Sister+++Loved by the King+++Lovers Quarrel+++Luckiest Guy+++Lusitana+++Lustria+++Macondo+++Macondo Swash Caps+++Magra+++Maiden Orange+++Mako+++Marcellus+++Marcellus SC+++Marck Script+++Margarine+++Marko One+++Marmelad+++Marvel+++Mate+++Mate SC+++Maven Pro+++McLaren+++Meddon+++MedievalSharp+++Medula One+++Megrim+++Meie Script+++Merienda+++Merienda One+++Merriweather+++Merriweather Sans+++Metal+++Metal Mania+++Metamorphous+++Metrophobic+++Michroma+++Milonga+++Miltonian+++Miltonian Tattoo+++Miniver+++Miss Fajardose+++Modern Antiqua+++Molengo+++Molle+++Monda+++Monofett+++Monoton+++Monsieur La Doulaise+++Montaga+++Montez+++Montserrat+++Montserrat Alternates+++Montserrat Subrayada+++Moul+++Moulpali+++Mountains of Christmas+++Mouse Memoirs+++Mr Bedfort+++Mr Dafoe+++Mr De Haviland+++Mrs Saint Delafield+++Mrs Sheppards+++Muli+++Mystery Quest+++Neucha+++Neuton+++New Rocker+++News Cycle+++Niconne+++Nixie One+++Nobile+++Nokora+++Norican+++Nosifer+++Nothing You Could Do+++Noticia Text+++Noto Sans+++Noto Serif+++Nova Cut+++Nova Flat+++Nova Mono+++Nova Oval+++Nova Round+++Nova Script+++Nova Slim+++Nova Square+++Numans+++Nunito+++Odor Mean Chey+++Offside+++Old Standard TT+++Oldenburg+++Oleo Script+++Oleo Script Swash Caps+++Open Sans+++Open Sans Condensed+++Oranienbaum+++Orbitron+++Oregano+++Orienta+++Original Surfer+++Oswald+++Over the Rainbow+++Overlock+++Overlock SC+++Ovo+++Oxygen+++Oxygen Mono+++PT Mono+++PT Sans+++PT Sans Caption+++PT Sans Narrow+++PT Serif+++PT Serif Caption+++Pacifico+++Paprika+++Parisienne+++Passero One+++Passion One+++Pathway Gothic One+++Patrick Hand+++Patrick Hand SC+++Patua One+++Paytone One+++Peralta+++Permanent Marker+++Petit Formal Script+++Petrona+++Philosopher+++Piedra+++Pinyon Script+++Pirata One+++Plaster+++Play+++Playball+++Playfair Display+++Playfair Display SC+++Podkova+++Poiret One+++Poller One+++Poly+++Pompiere+++Pontano Sans+++Port Lligat Sans+++Port Lligat Slab+++Prata+++Preahvihear+++Press Start 2P+++Princess Sofia+++Prociono+++Prosto One+++Puritan+++Purple Purse+++Quando+++Quantico+++Quattrocento+++Quattrocento Sans+++Questrial+++Quicksand+++Quintessential+++Qwigley+++Racing Sans One+++Radley+++Raleway+++Raleway Dots+++Rambla+++Rammetto One+++Ranchers+++Rancho+++Rationale+++Redressed+++Reenie Beanie+++Revalia+++Ribeye+++Ribeye Marrow+++Righteous+++Risque+++Roboto+++Roboto Condensed+++Roboto Slab+++Rochester+++Rock Salt+++Rokkitt+++Romanesco+++Ropa Sans+++Rosario+++Rosarivo+++Rouge Script+++Ruda+++Rufina+++Ruge Boogie+++Ruluko+++Rum Raisin+++Ruslan Display+++Russo One+++Ruthie+++Rye+++Sacramento+++Sail+++Salsa+++Sanchez+++Sancreek+++Sansita One+++Sarina+++Satisfy+++Scada+++Schoolbell+++Seaweed Script+++Sevillana+++Seymour One+++Shadows Into Light+++Shadows Into Light Two+++Shanti+++Share+++Share Tech+++Share Tech Mono+++Shojumaru+++Short Stack+++Siemreap+++Sigmar One+++Signika+++Signika Negative+++Simonetta+++Sintony+++Sirin Stencil+++Six Caps+++Skranji+++Slackey+++Smokum+++Smythe+++Sniglet+++Snippet+++Snowburst One+++Sofadi One+++Sofia+++Sonsie One+++Sorts Mill Goudy+++Source Code Pro+++Source Sans Pro+++Special Elite+++Spicy Rice+++Spinnaker+++Spirax+++Squada One+++Stalemate+++Stalinist One+++Stardos Stencil+++Stint Ultra Condensed+++Stint Ultra Expanded+++Stoke+++Strait+++Sue Ellen Francisco+++Sunshiney+++Supermercado One+++Suwannaphum+++Swanky and Moo Moo+++Syncopate+++Tangerine+++Taprom+++Tauri+++Telex+++Tenor Sans+++Text Me One+++The Girl Next Door+++Tienne+++Tinos+++Titan One+++Titillium Web+++Trade Winds+++Trocchi+++Trochut+++Trykker+++Tulpen One+++Ubuntu+++Ubuntu Condensed+++Ubuntu Mono+++Ultra+++Uncial Antiqua+++Underdog+++Unica One+++UnifrakturCook+++UnifrakturMaguntia+++Unkempt+++Unlock+++Unna+++VT323+++Vampiro One+++Varela+++Varela Round+++Vast Shadow+++Vibur+++Vidaloka+++Viga+++Voces+++Volkhov+++Vollkorn+++Voltaire+++Waiting for the Sunrise+++Wallpoet+++Walter Turncoat+++Warnes+++Wellfleet+++Wendy One+++Wire One+++Yanone Kaffeesatz+++Yellowtail+++Yeseva One+++Yesteryear+++Zeyada';
	$google_fonts = explode('+++',$google_fonts);
	foreach($google_fonts as $font_name){  
		$google_font_array[] = array('value' => str_replace(' ','+',$font_name), 'label' => $font_name, 'src' => '');
	}
  
	/**
	 * Custom settings array that will eventually be 
	 * passes to the OptionTree Settings API Class.
	 */
	$theme_options_settings = array(
		'sections' => array(
			array( # General
				'id'    => 'to_general',
				'title' => __('General Styling', 'gymboom'),
			),
			array( # General
				'id'    => 'to_socials',
				'title' => __('Social Links', 'gymboom'),
			),
			array( # Twitter
				'id'    => 'to_twitter',
				'title' => __('Twitter', 'gymboom'),
			),
			array( # Facebook
				'id'    => 'to_facebook',
				'title' => __('Facebook', 'gymboom'),
			),
			array( # General
				'id'    => 'to_footer',
				'title' => __('Footer Settings', 'gymboom'),
			),
			array( # General
				'id'    => 'to_other',
				'title' => __('Other Settings', 'gymboom'),
			),
		),
		'settings' => array(
				
			/**
			 * General
			 */
			array( # Logo
				'id'    => 'js_logo',
				'label' => __('Logo Replacement', 'gymboom'),
				'type'  => 'upload',
				'std'	=> get_template_directory_uri().'/_theme_styles/images/logo.png',
				'class' => '',
				'section' => 'to_general',
			),
			array( # Logo
				'id'    => 'js_favicon',
				'label' => __('Favicon Replacement', 'gymboom'),
				'type'  => 'upload',
				'std'	=> get_template_directory_uri().'/_theme_styles/images/favicon.png',
				'class' => '',
				'desc'	=> 'Upload your own favicon. Be sure it\'s a square (16x16 or 32x32) ICO or PNG file.',
				'section' => 'to_general'
			),
			array( # Logo Width
				'id'        => 'js_logo_width',
				'label'     => __('Logo Width', 'gymboom'),
				'std'		=> 300,
				'type'      => 'text',
				'section'   => 'to_general',
				'desc'		=> 'The default width for logos is "300". You can change this here by entering a new width.'
			),
			array( # Logo Height
				'id'        => 'js_logo_height',
				'label'     => __('Logo Height', 'gymboom'),
				'type'      => 'text',
				'std'		=> 90,
				'section'   => 'to_general',
				'desc'		=> 'The default height for logos is "90". You can change this here by entering a new width.'
			),
			array( # Main Color
				'id'        => 'js_highlight_color',
				'label'     => __('Main Color', 'gymboom'),
				'type'      => 'colorpicker',
				'std'		=> '#e05543',
				'section'   => 'to_general',
				'desc'		=> ''
			),
			array( # Google Font
				'id'          => 'js_custom_font_main',
				'label'       => 'Choose a Google Font for the body text',
				'desc'        => '<a href="http://www.google.com/fonts">Check out all of the Google Fonts here</a>',
				'std'         => 'Lato',
				'type'        => 'select',
				'section'     => 'to_general',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'min_max_step'=> '',
				'class'       => '',
				'choices'     => $google_font_array
			),
			array( # Google Font
				'id'          => 'js_custom_font_headings',
				'label'       => 'Choose a Google Font for headings',
				'desc'        => '<a href="http://www.google.com/fonts">Check out all of the Google Fonts here</a>',
				'std'         => 'Roboto+Condensed',
				'type'        => 'select',
				'section'     => 'to_general',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'min_max_step'=> '',
				'class'       => '',
				'choices'     => $google_font_array
			),
			array( # Google Font
				'id'          => 'js_custom_font_buttons',
				'label'       => 'Choose a Google Font for buttons',
				'desc'        => '<a href="http://www.google.com/fonts">Check out all of the Google Fonts here</a>',
				'std'         => 'Roboto+Condensed',
				'type'        => 'select',
				'section'     => 'to_general',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'min_max_step'=> '',
				'class'       => '',
				'choices'     => $google_font_array
			),
			array( # Mobile Settings
			'id'      => 'js_responsive_disabled',
			'label'   => __('Disable Responsiveness?', 'gymboom'),
			'std'     => '',
			'type'    => 'checkbox',
			'section' => 'to_general',
			'choices' => array(
				array(
					'id'    => 'disable_responsiveness',
					'label' => __('Yes, disable the responsiveness.', 'gymboom'),
					'value' => true,
				),
			)),
			array( # Mobile Settings
			'id'      => 'to_disable_stuff',
			'label'   => __('Disable Comments', 'gymboom'),
			'std'     => '',
			'type'    => 'checkbox',
			'section' => 'to_general',
			'choices' => array(
				array(
					'id'    => 'js_disable_post_comments',
					'label' => __('Disable Post Comments', 'gymboom'),
					'value' => true,
				),
				array(
					'id'    => 'js_disable_page_comments',
					'label' => __('Disable Page Comments', 'gymboom'),
					'value' => true,
				),
				array(
					'id'    => 'js_disable_gallery_comments',
					'label' => __('Disable Gallery Comments', 'gymboom'),
					'value' => true,
				),
				array(
					'id'    => 'js_disable_video_comments',
					'label' => __('Disable Video Comments', 'gymboom'),
					'value' => true,
				),
			)),
			
			# Socials
			array(
				'id'        => 'js_social_icon_facebook',
				'label'     => __('Facebook', 'gymboom'),
				'std'		=> '',
				'type'      => 'text',
				'section'   => 'to_socials',
				'desc'		=> 'Paste your Facebook URL here.'
			),
			array(
				'id'        => 'js_social_icon_twitter',
				'label'     => __('Twitter', 'gymboom'),
				'std'		=> '',
				'type'      => 'text',
				'section'   => 'to_socials',
				'desc'		=> 'Paste your Twitter URL here.'
			),
			array(
				'id'        => 'js_social_icon_linkedin',
				'label'     => __('LinkedIn', 'gymboom'),
				'std'		=> '',
				'type'      => 'text',
				'section'   => 'to_socials',
				'desc'		=> 'Paste your LinkedIn URL here.'
			),
			array(
				'id'        => 'js_social_icon_youtube',
				'label'     => __('Youtube', 'gymboom'),
				'std'		=> '',
				'type'      => 'text',
				'section'   => 'to_socials',
				'desc'		=> 'Paste your Youtube URL here.'
			),
			array(
				'id'        => 'js_social_icon_vimeo',
				'label'     => __('Vimeo', 'gymboom'),
				'std'		=> '',
				'type'      => 'text',
				'section'   => 'to_socials',
				'desc'		=> 'Paste your Vimeo URL here.'
			),
			array(
				'id'        => 'js_social_icon_googleplus',
				'label'     => __('Google Plus', 'gymboom'),
				'std'		=> '',
				'type'      => 'text',
				'section'   => 'to_socials',
				'desc'		=> 'Paste your Google Plus URL here.'
			),
			array(
				'id'        => 'js_social_icon_pinterest',
				'label'     => __('Pinterest', 'gymboom'),
				'std'		=> '',
				'type'      => 'text',
				'section'   => 'to_socials',
				'desc'		=> 'Paste your Pinterest URL here.'
			),
			array(
				'id'        => 'js_social_icon_instagram',
				'label'     => __('Instagram', 'gymboom'),
				'std'		=> '',
				'type'      => 'text',
				'section'   => 'to_socials',
				'desc'		=> 'Paste your Instagram URL here.'
			),
			array(
				'id'        => 'js_social_icon_rss',
				'label'     => __('RSS Feed', 'gymboom'),
				'std'		=> '',
				'type'      => 'text',
				'section'   => 'to_socials',
				'desc'		=> 'Paste your RSS Feed URL here.'
			),

			# Twitter
			array(
				'id'    => 'textblock',
				'label' => __('Twitter Info', 'gymboom'),
				'desc'  => '<div style="position: relative; border: 1px solid #ccc; padding: 10px;">
<p><strong>Twitter API requires a Twitter application for communication with 3rd party sites. Here are the steps for creating and setting up a Twitter application:</strong></p>
<ol>
<li>Go to <a href="https://dev.twitter.com/apps/new" target="_blank">https://dev.twitter.com/apps/new</a> and log in, if necessary</li>
<li>Supply the necessary required fields, accept the Terms of Service, and solve the CAPTCHA. Callback URL field may be left empty</li>
<li>Submit the form</li>
<li>On the next screen scroll down to <strong>Your access token</strong> section and click the <strong>Create my access token</strong> button</li>
<li>Copy the following fields: Access token, Access token secret, Consumer key, Consumer secret to the below fields</li>
</ol>
</div>
				',
				'type' => 'textblock',
				'section' => 'to_twitter',
			),
			array(
				'id'    => 'twitter_oauth_access_token',
				'label' => __('Twitter OAuth Access Token', 'gymboom'),
				'type'  => 'text',
				'section' => 'to_twitter',
			),
			array(
				'id'    => 'twitter_oauth_access_token_secret',
				'label' => __('Twitter OAuth Access Token Secret', 'gymboom'),
				'type'  => 'text',
				'section' => 'to_twitter',
			),
			array(
				'id'    => 'twitter_consumer_key',
				'label' => __('Twitter Consumer Key', 'gymboom'),
				'type'  => 'text',
				'section' => 'to_twitter',
			),
			array(
				'id'    => 'twitter_consumer_secret',
				'label' => __('Twitter Consumer Secret', 'gymboom'),
				'type'  => 'text',
				'section' => 'to_twitter',
			),

			# Facebook
			array(
		        'id'          => 'instructions',
		        'label'       => '',
		        'desc'        => '<p style="font-weight:bold; font-size:20px; line-height:30px; width: 590px; color: #2F9ACC; margin:0 0 5px !important">Instructions</p><p><strong>All of the Facebook functionality in this theme requires a Facebook application for communication with 3rd party sites. Here are the steps for creating and setting up a Facebook application:</strong></p>
<ol>
<li>Go to <a href="https://developers.facebook.com/apps/?action=create">https://developers.facebook.com/apps/?action=create</a> and log in, if necessary.</li>
<li>Supply the necessary required fields, and solve the CAPTCHA.</li>
<li>Submit the form.</li>
<li>On the next screen scroll down to "Your access token" section and click the "Create my access token" button.</li>
<li>Copy the <strong>App ID</strong> and <strong>App Secret Secret</strong> to the fields below.</li>
</ol>',
		        'std'         => '',
		        'type'        => 'textblock-titled',
		        'section'     => 'to_facebook',
		        'rows'        => '',
		        'post_type'   => '',
		        'taxonomy'    => '',
		        'min_max_step'=> '',
		        'class'       => ''
			),
			array(
				'id'          => 'facebook_app_id',
				'label'       => 'Facebook App ID',
				'desc'        => '',
				'std'         => '',
				'type'        => 'text',
				'section'     => 'to_facebook',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'min_max_step'=> '',
				'class'       => ''
			),
			array(
				'id'          => 'facebook_app_secret',
				'label'       => 'Facebook App Secret',
				'desc'        => '',
				'std'         => '',
				'type'        => 'text',
				'section'     => 'to_facebook',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'min_max_step'=> '',
				'class'       => ''
			),
	      
	      	# Footer Settings
		  	array(
				'id'        => 'js_footer_bg',
				'label'     => __('Footer Background Color', 'gymboom'),
				'type'      => 'colorpicker',
				'std'		=> '#333',
				'section'   => 'to_footer',
				'desc'		=> ''
			),
			array(
				'id'        => 'js_bottom_bg',
				'label'     => __('Bottom Bar Background Color', 'gymboom'),
				'type'      => 'colorpicker',
				'std'		=> '#000',
				'section'   => 'to_footer',
				'desc'		=> ''
			),
			array(
				'id'        => 'js_bottom_left_text',
				'label'     => __('Footer Left Text', 'gymboom'),
				'std'		=> 'Copyright &copy; 2004-[year] Boxy Studio. Put whatever you want in this spot!',
				'type'      => 'textarea_simple',
				'rows'        => '4',
				'section'   => 'to_footer',
				'desc'		=> 'You can use [year] to display the year.'
			),
			
			array( # Mobile Settings
			'id'      => 'js_bottom_bar_disabled',
			'label'   => __('Disable Bottom Bar?', 'gymboom'),
			'std'     => '',
			'type'    => 'checkbox',
			'section' => 'to_footer',
			'choices' => array(
				array(
					'label' => __('Yes, disable the bottom bar.', 'gymboom'),
					'value' => true,
				),
			)),
			
			array(
				'id'          => 'js_404_content',
				'label'       => '404 Page Content',
				'desc'        => '',
				'std'         => '',
				'type'        => 'textarea',
				'section'     => 'to_other',
				'rows'        => '4',
				'post_type'   => '',
				'taxonomy'    => '',
				'min_max_step'=> '',
				'class'       => ''
			),
			array(
				'id'          => 'js_google_analytics',
				'label'       => 'Google Analytics Code',
				'desc'        => '',
				'std'         => '',
				'type'        => 'textarea-simple',
				'section'     => 'to_other',
				'rows'        => '4',
				'post_type'   => '',
				'taxonomy'    => '',
				'min_max_step'=> '',
				'class'       => ''
			),
			array(
				'id'          => 'js_custom_css',
				'label'       => 'Custom CSS',
				'desc'        => '',
				'std'         => '',
				'type'        => 'css',
				'section'     => 'to_other',
				'rows'        => '4',
				'post_type'   => '',
				'taxonomy'    => '',
				'min_max_step'=> '',
				'class'       => ''
			),
			
		)
	);
	
	
  
  /* allow settings to be filtered before saving */
  $theme_options_settings = apply_filters( ot_settings_id() . '_args', $theme_options_settings );
  
  /* settings are not the same update the DB */
  if ( $saved_settings !== $theme_options_settings ) {
	update_option( ot_settings_id(), $theme_options_settings ); 
  }
  
}