<?php



class Wiki_Premium {

	/**

	 * Bezieht sich auf unsere einzelne Instanz der Klasse

	 *

	 * @since 1.2.5

	 * @access private

	 */

	private static $_instance = null;



	/**

	 * Bezieht sich auf unsere einzelne Instanz der Wiki-Klasse

	 *

	 * @since 1.2.5

	 * @access public

	 */

	public $wiki = null;



	/**

	 * Ruft die einzelne Instanz der Klasse ab

	 *

	 * @since 1.2.5

	 * @access public

	 */

	public static function get_instance() {

		if ( is_null(self::$_instance) ) {

			self::$_instance = new Wiki_Premium();

		}



		return self::$_instance;

	}



	/**

	 * Registriert benutzerdefinierte Taxonomien

	 *

	 * @since 1.2.4

	 * @access public

	 */

		/**

	 * Registriert Plugin-Taxonomien

	 * @since 1.2.4

	 */

	public function register_taxonomies() {

		$slug = $this->wiki->settings['slug'] . '/' . $this->wiki->slug_categories;

		register_taxonomy('psource_wiki_category', 'psource_wiki', array(

			'hierarchical' => true,

			'rewrite' => array(

				'slug' => $slug,

				'with_front' => false

			),

			'capabilities' => array(

				'manage_terms' => 'edit_others_wikis',

				'edit_terms' => 'edit_others_wikis',

				'delete_terms' => 'edit_others_wikis',

				'assign_terms' => 'edit_published_wikis'

			),

			'labels' => array(

				'name' => __( 'Wiki-Kategorien', 'wiki' ),

				'singular_name' => __( 'Wiki-Kategorie', 'wiki' ),

				'search_items' => __( 'Suche in Wiki-Kategorien', 'wiki' ),

				'all_items' => __( 'Alle Wiki-Kategorien', 'wiki' ),

				'parent_item' => __( 'Übergeordnete Wiki-Kategorie', 'wiki' ),

				'parent_item_colon' => __( 'Übergeordnete Wiki-Kategorie:', 'wiki' ),

				'edit_item' => __( 'Wiki-Kategorie bearbeiten', 'wiki' ),

				'update_item' => __( 'Wiki-Kategorie aktualisieren', 'wiki' ),

				'add_new_item' => __( 'Neue Wiki-Kategorie hinzufügen', 'wiki' ),

				'new_item_name' => __( 'Neuer Name der Wiki-Kategorie', 'wiki' ),

			),

			'show_admin_column' => true,

		));



		$slug = $this->wiki->settings['slug'] . '/' . $this->wiki->slug_tags;

		register_taxonomy('psource_wiki_tag', 'psource_wiki', array(

			'rewrite' => array(

				'slug' => $slug,

				'with_front' => false

			),

			'capabilities' => array(

				'manage_terms' => 'edit_others_wikis',

				'edit_terms' => 'edit_others_wikis',

				'delete_terms' => 'edit_others_wikis',

				'assign_terms' => 'edit_published_wikis'

			),

			'labels' => array(

				'name'			=> __( 'Wiki-Tags', 'wiki' ),

				'singular_name'	=> __( 'Wiki-Tag', 'wiki' ),

				'search_items'	=> __( 'Suche Wiki-Tags', 'wiki' ),

				'popular_items'	=> __( 'Beliebte Wiki-Tags', 'wiki' ),

				'all_items'		=> __( 'Alle Wiki-Tags', 'wiki' ),

				'edit_item'		=> __( 'Wiki-Tag bearbeiten', 'wiki' ),

				'update_item'	=> __( 'Wiki-Tag aktualisieren', 'wiki' ),

				'add_new_item'	=> __( 'Neues Wiki-Tag hinzufügen', 'wiki' ),

				'new_item_name'	=> __( 'Neuer Wiki-Tag-Name', 'wiki' ),

				'separate_items_with_commas'	=> __( 'Trenne Wiki-Tags durch Kommas', 'wiki' ),

				'add_or_remove_items'			=> __( 'Hinzufügen oder Entfernen von Wiki-Tags', 'wiki' ),

				'choose_from_most_used'			=> __( 'Wähle häufig verwendete Wiki-Tags', 'wiki' ),

			),

			'show_admin_column' => true,

		));

	}



	/**

	 * Zeigt die Einstellungen der Admin-Seite an

	 *

	 * @since 1.2.5

	 * @access public

	 */

	public function admin_page_settings() { ?>

<tr valign="top">

	<th><label for="psource_wiki-breadcrumbs_in_title"><?php _e('Anzahl der Breadcrumbs, die dem Titel hinzugefügt werden sollen', 'wiki'); ?></label> </th>

	<td><input type="text" size="2" id="psource_wiki-breadcrumbs_in_title" name="wiki[breadcrumbs_in_title]" value="<?php echo $this->wiki->get_setting('breadcrumbs_in_title'); ?>" /></td>

</tr>

<tr valign="top">

	<th><label for="psource_wiki-wiki_name"><?php _e('Wie möchtest Du Wikis nennen?', 'wiki'); ?></label> </th>

	<td><input type="text" size="20" id="psource_wiki-wiki_name" name="wiki[wiki_name]" value="<?php echo $this->wiki->get_setting('wiki_name'); ?>" /></td>

</tr>

<tr valign="top">

	<th><label for="psource_wiki-sub_wiki_name"><?php _e('Wie möchtest Du Sub Wikis nennen?', 'wiki'); ?></label> </th>

	<td><input type="text" size="20" id="psource_wiki-sub_wiki_name" name="wiki[sub_wiki_name]" value="<?php echo $this->wiki->get_setting('sub_wiki_name'); ?>" /></td>

</tr>

<tr valign="top">

	<th><label for="psource_wiki-sub_wiki_order_by"><?php _e('Wie sollen Sub-Wikis bestellt werden?', 'wiki'); ?></label> </th>

	<td>

		<select id="psource_wiki-sub_wiki_order_by" name="wiki[sub_wiki_order_by]" >

			<option value="menu_order" <?php selected($this->wiki->get_setting('sub_wiki_order_by'), 'menu_order'); ?>><?php _e('Menüreihenfolge/Reihenfolge erstellt', 'wiki'); ?></option>

			<option value="title" <?php selected($this->wiki->get_setting('sub_wiki_order_by'), 'title'); ?>><?php _e('Titel', 'wiki'); ?></option>

			<option value="rand" <?php selected($this->wiki->get_setting('sub_wiki_order_by'), 'rand'); ?>><?php _e('Zufällig', 'wiki'); ?></option>

		</select>

	</td>

</tr>

<tr valign="top">

	<th><label for="psource_wiki-sub_wiki_order"><?php _e('Welche Reihenfolge sollten Sub Wikis bestellt werden?', 'wiki'); ?></label> </th>

	<td>

		<select id="psource_wiki-sub_wiki_order" name="wiki[sub_wiki_order]" >

			<option value="ASC" <?php selected($this->wiki->get_setting('sub_wiki_order'), 'ASC'); ?>><?php _e('Aufsteigend', 'wiki'); ?></option>

			<option value="DESC" <?php selected($this->wiki->get_setting('sub_wiki_order'), 'DESC'); ?>><?php _e('Absteigend', 'wiki'); ?></option>

		</select>

	</td>

</tr>

<tr valign="top">

	<th><label><?php _e('Wer kann Wiki-Berechtigungen bearbeiten?', 'wiki'); ?></label> </th>

	<td>

		<?php

		$editable_roles = get_editable_roles();

		foreach ($editable_roles as $role_key => $role) {

			$role_obj = get_role($role_key);

			?>

			<label><input type="checkbox" name="edit_wiki_privileges[<?php echo $role_key; ?>]" value="<?php echo $role_key; ?>" <?php echo $role_obj->has_cap('edit_wiki_privileges')?'checked="checked"':''; ?> /> <?php echo $role['name']; ?></label><br/>

			<?php

		}

		?>

	</td>

</tr>

	<?php

	}



	/**

	 * Speichert zusätzliche Einstellungen

	 *

	 * @since 1.2.5

	 * @access public

	 * @param array $settings

	 * @param array $postdata

	 * @return array

	 */

	public function save_settings( $settings, $postdata ) {

		$settings['breadcrumbs_in_title'] = intval($_POST['wiki']['breadcrumbs_in_title']);

		$settings['wiki_name'] = $_POST['wiki']['wiki_name'];

		$settings['sub_wiki_name'] = $_POST['wiki']['sub_wiki_name'];

		$settings['sub_wiki_order_by'] = $_POST['wiki']['sub_wiki_order_by'];

		$settings['sub_wiki_order'] = $_POST['wiki']['sub_wiki_order'];

		return $settings;

	}



	/**

	 * Fügt Metaboxen hinzu

	 *

	 * @since 1.2.5

	 * @access public

	 * @param object $post

	 */

	public function add_meta_boxes( $post ) {

		if ( $post->post_author == wp_get_current_user()->ID || current_user_can('edit_posts') ) {

			add_meta_box('psource-wiki-privileges', __('Wiki-Berechtigungen', 'wiki'), array(&$this, 'privileges_meta_box'), 'psource_wiki', 'side');

		}

	}



	/**

	 * Zeigt das Privilegien-Metafeld an

	 *

	 * @since 1.2.5

	 * @access public

	 * @param object $post

	 * @param bool $echo

	 */

	public function privileges_meta_box( $post, $echo = true ) {

		$settings = get_option('wiki_settings');

		$content	= '';

		$current_privileges = (array) get_post_meta($post->ID, 'psource_wiki_privileges', true);

		$privileges = array(

			'anyone' => __('Jeder', 'wiki'),

			'network' => __('Netzwerk Benutzer', 'wiki'),

			'site' => __('Seitenbenutzer', 'wiki'),

			'edit_posts' => __('Benutzer, die Beiträge auf dieser Seite bearbeiten können', 'wiki')

			);



		$content .= '<input type="hidden" name="psource_wiki_privileges_meta" value="1" />';

		$content .= '<div class="alignleft">';

		$content .= '<b>'. __('Bearbeitung zulassen durch', 'wiki').'</b><br/>';



		foreach ( $privileges as $key => $privilege ) {

			$content .= '<label class="psource_wiki_label_roles"><input type="checkbox" name="psource_wiki_privileges[]" value="'.$key.'" '.((in_array($key, $current_privileges))?'checked="checked"':'').' /> '.$privilege.'</label><br class="psource_wiki_br_roles"/>';

		}



		$content .= '</div>';

		$content .= '<div class="clear"></div>';



		if ( $echo ) {

			echo $content;

		}



		return $content;

	}



	/**

	 * Speichert die Metainformationen des Wikis

	 *

	 * @since 1.2.5

	 * @access public

	 * @action wp_insert_post

	 * @param int $post_id

	 * @param object $post

	 */

	public function save_wiki_meta( $post_id, $post = null ) {

		//Schnellbearbeitung überspringen

		if ( defined('DOING_AJAX') && DOING_AJAX ) { return; }



		if ( get_post_type($post_id) == "psource_wiki" && isset($_POST['psource_wiki_tags']) ) {

			$wiki_tags = $_POST['psource_wiki_tags'];



			wp_set_post_terms($post_id, $wiki_tags, 'psource_wiki_tag');



			//für jedes andere Plugin, in das man sich einklinken kann

			do_action( 'psource_wiki_save_taxonomy_tags', $post_id, $wiki_tags );

		}



		if ( get_post_type($post_id) == "psource_wiki" && isset($_POST['psource_wiki_category']) ) {

			$wiki_category = array( (int) $_POST['psource_wiki_category'] );



			wp_set_post_terms( $post_id, $wiki_category, 'psource_wiki_category' );



			//für jedes andere Plugin, in das man sich einklinken kann

			do_action('psource_wiki_save_taxonomy_category', $post_id, $wiki_category);

		}



		if ( get_post_type($post_id) == "psource_wiki" && isset($_POST['psource_wiki_privileges']) ) {

			$meta = get_post_custom($post_id);



			update_post_meta($post_id, 'psource_wiki_privileges', $_POST['psource_wiki_privileges']);



			//für jedes andere Plugin, in das man sich einklinken kann

			do_action( 'psource_wiki_save_privileges_meta', $post_id, $meta );

		}

	}



	/**

	 * Zeigt das Dropdown-Menü Wiki-Taxonomien an

	 *

	 * @since 1.2.5

	 * @access public

	 * @param bool $echo

	 */



	public function wiki_taxonomies( $echo = true ) {

		global $post, $edit_post;



		$wiki = isset($post) ? $post : $edit_post;

		$wiki_tags = wp_get_object_terms( $wiki->ID, 'psource_wiki_tag', array( 'fields' => 'names' ) );



		$wiki_cats = wp_get_object_terms( $wiki->ID, 'psource_wiki_category', array( 'fields' => 'ids' ) );

		$wiki_cat = empty( $wiki_cats ) ? false : reset( $wiki_cats );



		$content	= '';

		$content .= '<table id="wiki-taxonomies">';

		$content .= '<tr>';

		$content .= '<td id="wiki-category-td" style="width: 25%">';

		$content .= wp_dropdown_categories( array(

						'orderby' => 'name',

						'order' => 'ASC',

						'taxonomy' => 'psource_wiki_category',

						'selected' => $wiki_cat,

						'hide_empty' => false,

						'hierarchical' => true,

						'name' => 'psource_wiki_category',

						'class' => '',

						'echo' => false,

						'show_option_none' => __( 'Kategorie wählen...', 'wiki')

					) );

		$content .= '</td>';

		$content .= '<td id="wiki-tags-label" style="width: 50px">';

		$content .= '<label for="wiki-tags">'.__('Tags:', 'wiki').'</label>';

		$content .= '</td>';

		$content .= '<td id="wiki-tags-td">';

		$content .= '<input type="text" id="psource_wiki-tags" name="psource_wiki_tags" style="width: 100%;" value="'. implode( ', ', $wiki_tags ).'" />';

		$content .= '</td></tr></table>';



		if ( $echo ) {

			echo $content;

		}



		return $content;

	}



	/**

	 * Initialisiert Widgets

	 *

	 * @since 1.2.5

	 * @access public

	 */

	public function widgets_init() {

		include_once $this->wiki->plugin_dir . 'premium/lib/classes/SearchWikisWidget.php';

		include_once $this->wiki->plugin_dir . 'premium/lib/classes/NewWikisWidget.php';

		include_once $this->wiki->plugin_dir . 'premium/lib/classes/PopularWikisWidget.php';

		include_once $this->wiki->plugin_dir . 'premium/lib/classes/WikiCategoriesWidget.php';

		include_once $this->wiki->plugin_dir . 'premium/lib/classes/WikiTagsWidget.php';

		include_once $this->wiki->plugin_dir . 'premium/lib/classes/WikiTagCloudWidget.php';



		register_widget('SearchWikisWidget');

		register_widget('NewWikisWidget');

		register_widget('PopularWikisWidget');

		register_widget('WikiCategoriesWidget');

		register_widget('WikiTagsWidget');

		register_widget('WikiTagCloudWidget');

	}



	/**

	 * Ändert den Begriff Link

	 *

	 * @since 1.2.5

	 * @access public

	 * @param string $termlink

	 * @param object $term

	 * @param string $taxonomy

	 * @return string

	 */

	public function term_link( $termlink, $term, $taxonomy ) {

		$rewritecode = array(

			'%psource_wiki_category%',

			'%psource_wiki_tag%'

		);



		if ( preg_match('/^psource_wiki_/', $term->taxonomy) > 0 && '' != $termlink ) {

			$rewritereplace = array(

				($term->slug == "") ? (isset($term->term_id) ? $term->term_id : 0) : $term->slug,

				($term->slug == "") ? (isset($term->term_id) ? $term->term_id : 0) : $term->slug

			);

			$termlink = str_replace($rewritecode, $rewritereplace, $termlink);

		}



		return $termlink;

	}





	/**

	 * Konstruktorfunktion

	 *

	 * @since 1.2.5

	 * @access private

	 */

	private function __construct() {

		$this->wiki = Wiki::get_instance();

		add_filter('wiki_save_settings', array(&$this, 'save_settings'), 10, 2);

		add_filter('term_link', array(&$this, 'term_link'), 10, 3);

		add_action('add_meta_boxes_psource_wiki', array(&$this, 'add_meta_boxes'));

		add_action('wp_insert_post', array(&$this, 'save_wiki_meta'), 10, 2);

		add_action('widgets_init', array(&$this, 'widgets_init'));

	}


}



Wiki_Premium::get_instance();