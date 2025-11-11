<?php
/**
 * Fixtures - Generate fake posts for development (French version with series)
 *
 * @package altr
 */

if (!defined('ABSPATH')) {
    exit;
}

// check if ACF is active

/**
 * Generate fake posts with series data (CBD and 30?)
 *
 * @param int $count Number of posts to generate
 * @param array $options Optional configuration
 * @return array Array of created post IDs
 */
function altr_generate_fixtures($count = 10, $options = []) {

    // check if ACF is active
    if (!function_exists('update_field')) {
    return new WP_Error(
        'acf_not_active',
        'ACF plugin must be active to generate fixtures with artist fields.'
    );

    }
    $defaults = [
        'post_type' => 'post',
        'post_status' => 'publish',
        'with_images' => true,
        'with_categories' => true,
        'with_tags' => true,
        'date_range_days' => 30,
        'series' => 'mixed', // 'cbd', '30q', or 'mixed'
    ];
    
    $options = wp_parse_args($options, $defaults);
    $created_posts = [];
    
    // CBD Series Data
    $cbd_data = [
        'series_description' => 'Creative by design ; exploration artistique approfondie, transcendant les frontières créatives',
        'artists' => [
            'Odunsi Jr Fabrice-Prince', 'Kémi Telfort', 'Youssef Limoud', 
            'Aminata Konaté', 'Geotheory', 'Fatou Diagne',
            'Reinel Bakole', 'Aïcha Touré', 'Cheikh Mbaye',
        ],
        'subtitles' => [
            'Quand l\'émotion prend une forme universelle',
            'Entre tradition et modernité',
            'L\'art comme langage universel',
            'Réinventer les codes visuels',
            'La couleur comme expression identitaire',
            'Naviguer entre deux mondes',
            'L\'héritage ancestral réinterprété',
            'Défier les conventions établies',
            'Créer au-delà des frontières',
            'L\'innovation à travers la tradition',
        ],
        'content' => [
            'Cette œuvre audacieuse explore les tensions entre identité individuelle et héritage collectif. À travers une palette vibrante et des compositions dynamiques, l\'artiste nous invite à reconsidérer notre rapport à la créativité contemporaine.',
            'Le projet transcende les frontières traditionnelles entre art et design, créant un dialogue visuel qui parle autant au cœur qu\'à l\'esprit. Chaque élément est soigneusement orchestré pour créer une expérience immersive.',
            'En combinant techniques ancestrales et approches contemporaines, cette série questionne les notions de modernité et d\'authenticité. L\'artiste réussit à créer un langage visuel unique qui résonne avec notre époque.',
            'L\'installation transforme l\'espace en un lieu de contemplation et de dialogue. Les jeux de lumière et de matières créent une atmosphère qui invite à la réflexion sur notre place dans le monde contemporain.',
            'Cette exploration visuelle nous confronte aux complexités de l\'identité dans un monde globalisé. Les compositions stratifiées révèlent des histoires multiples, invitant le spectateur à une lecture approfondie.',
            'À travers une utilisation innovante des médias mixtes, l\'artiste construit des narratives visuelles qui défient nos perceptions. Chaque œuvre est une invitation à explorer les nuances de l\'expression créative.',
        ],
    ];
    
    // 30? Series Data
    $thirtyq_data = [
        'series_description' => '30 Questions qui explorent le passé, le présent et le futur des créateurs',
        'artists' => [
            'Irma Odunsi', 'Léa Kouassi', 'Serge Baboua',
            'Mariam Diallo', 'Hannah Habimana', 'Sophie Mensah',
            'Jacques Nkrumah', 'Amina Sall', 'Pierre Kamara',
        ],
        'subtitles' => [
            'Une invitation à la réflexion',
            'Regards croisés sur la création',
            'Parcours d\'un créateur engagé',
            'Entre inspiration et transpiration',
            'Les chemins de la créativité',
            'Réflexions sur le processus créatif',
            'Du rêve à la réalité',
            'L\'art de questionner',
            'Introspection d\'un artiste',
            'Vision et ambition créative',
        ],
        'content' => [
            'Dans cet entretien approfondi, l\'artiste partage son parcours unique et ses réflexions sur l\'évolution de sa pratique. À travers 30 questions, nous explorons les influences qui ont façonné sa vision artistique.',
            'Cette conversation révèle les processus créatifs et les défis rencontrés tout au long d\'une carrière dédiée à l\'innovation. L\'artiste nous offre un regard intime sur son travail et ses aspirations futures.',
            'Les questions abordent des thèmes variés : l\'inspiration, la technique, les défis du marché de l\'art, et la place de l\'artiste dans la société contemporaine. Un témoignage précieux pour comprendre la création actuelle.',
            'Entre anecdotes personnelles et réflexions philosophiques, cet échange nous permet de découvrir la personnalité complexe qui se cache derrière les œuvres. Une plongée fascinante dans l\'univers d\'un créateur passionné.',
            'L\'artiste évoque sans détour les moments de doute, les succès, et les leçons apprises au fil des années. Un récit authentique qui inspire et encourage la nouvelle génération de créateurs.',
        ],
    ];
    
    // Get or create categories
    $category_ids = [];
    if ($options['with_categories']) {
        $categories = ['Art', 'Visual Media', 'Innovation', 'Music', 'Fashion'];
        foreach ($categories as $cat) {
            $term = term_exists($cat, 'category');
            if (!$term) {
                $term = wp_insert_term($cat, 'category');
            }
            if (!is_wp_error($term)) {
                $category_ids[] = $term['term_id'];
            }
        }
    }
    
    // Get or create tags
    $tag_ids = [];
    if ($options['with_tags']) {
        $tags = ['nigeria', 'mixedmedia', 'germany', 'brazil', 'feminism', 'lgbtq', 'heritage', 'rwanda', '3d', 'ai', 'spain', 'botswana','southafrica', 'kenya', 'print', 'award', 'forbes'];
        foreach ($tags as $tag) {
            $term = term_exists($tag, 'post_tag');
            if (!$term) {
                $term = wp_insert_term($tag, 'post_tag');
            }
            if (!is_wp_error($term)) {
                $tag_ids[] = $term['term_id'];
            }
        }
    }
    
    // Generate posts
    for ($i = 0; $i < $count; $i++) {
        // Determine series type
        $series_type = $options['series'];
        if ($series_type === 'mixed') {
            $series_type = (rand(0, 1) === 0) ? 'cbd' : '30q';
        }
        
        // Select appropriate data
        $data = ($series_type === 'cbd') ? $cbd_data : $thirtyq_data;
        
        // Random CBD number (44-99) or 30Q number (1-30)
        $series_number = ($series_type === 'cbd') ? rand(44, 99) : rand(1, 30);
        
        // Build title
        $artist = $data['artists'][array_rand($data['artists'])];
        $subtitle = $data['subtitles'][array_rand($data['subtitles'])];
        
        if ($series_type === 'cbd') {
            $title = sprintf('CBD⁴⁴ /%s /; %s', strtoupper($artist), $subtitle);
        } else {
            $title = sprintf('30?Q /%s/ %s', $artist, $subtitle);
        }
        
        // Random date within range
        $days_ago = rand(0, $options['date_range_days']);
        $post_date = date('Y-m-d H:i:s', strtotime("-{$days_ago} days"));
        
        // Build content
        $num_paragraphs = rand(2, 3);
        $shuffled_content = $data['content'];
        shuffle($shuffled_content);
        $content = implode("\n\n", array_slice($shuffled_content, 0, $num_paragraphs));
        
        // Create post
        $post_data = [
            'post_title' => $title,
            'post_content' => $content,
            'post_excerpt' => wp_trim_words($content, 30),
            'post_status' => $options['post_status'],
            'post_type' => $options['post_type'],
            'post_author' => get_current_user_id(),
            'post_date' => $post_date,
        ];
        
        $post_id = wp_insert_post($post_data);
        
        if (!is_wp_error($post_id)) {
            $created_posts[] = $post_id;
            
            // Add artist (ACF field)
            if (function_exists('update_field')) {
                update_field('artist', $artist, $post_id);
                update_field('series_description', $data['series_description'], $post_id);
            }
            
            // Add categories
            if (!empty($category_ids)) {
                $post_categories = array_rand(array_flip($category_ids), rand(1, min(3, count($category_ids))));
                wp_set_post_categories($post_id, (array) $post_categories);
            }
            
            // Add tags
            if (!empty($tag_ids)) {
                $post_tags = array_rand(array_flip($tag_ids), rand(2, min(4, count($tag_ids))));
                wp_set_post_tags($post_id, (array) $post_tags);
            }
            
            // Add featured image
            if ($options['with_images']) {
                altr_set_placeholder_image($post_id);
            }
        }
    }
    
    return $created_posts;
}

/**
 * Set a placeholder image as featured image
 *
 * @param int $post_id Post ID
 * @return int|false Attachment ID or false on failure
 */
function altr_set_placeholder_image($post_id) {
    // Generate random placeholder
    $width = 400;
    $height = 650;
    $image_url = "https://placehold.co/{$width}x{$height}/6c8ea5/ffffff/png?text=Art+" . rand(1, 100);
    
    // Download image
    $tmp = download_url($image_url);
    if (is_wp_error($tmp)) {
        return false;
    }
    
    // Prepare file array
    $file_array = [
        'name' => 'placeholder-' . $post_id . '.png',
        'tmp_name' => $tmp,
    ];
    
    // Upload to media library
    $attachment_id = media_handle_sideload($file_array, $post_id);
    
    // Clean up temp file
    if (file_exists($tmp)) {
        @unlink($tmp);
    }
    
    if (!is_wp_error($attachment_id)) {
        set_post_thumbnail($post_id, $attachment_id);
        return $attachment_id;
    }
    
    return false;
}

/**
 * Delete all fixture posts (cleanup)
 *
 * @param array $options Optional filters
 * @return int Number of posts deleted
 */
function altr_delete_fixtures($options = []) {
    $defaults = [
        'post_type' => 'post',
        'author' => get_current_user_id(),
        'date_query' => [
            [
                'after' => '1 week ago',
            ],
        ],
    ];
    
    $options = wp_parse_args($options, $defaults);
    
    $posts = get_posts(array_merge([
        'numberposts' => -1,
        'fields' => 'ids',
    ], $options));
    
    $deleted = 0;
    foreach ($posts as $post_id) {
        if (wp_delete_post($post_id, true)) {
            $deleted++;
        }
    }
    
    return $deleted;
}

/**
 * WP-CLI Commands
 */
if (defined('WP_CLI') && WP_CLI) {
    WP_CLI::add_command('fixtures generate', function($args, $assoc_args) {
        $count = isset($args[0]) ? intval($args[0]) : 10;
        $series = isset($assoc_args['series']) ? $assoc_args['series'] : 'mixed';
        
        WP_CLI::line("Génération de {$count} articles...");
        
        $created = altr_generate_fixtures($count, ['series' => $series]);
        
        WP_CLI::success(count($created) . " articles créés!");
        WP_CLI::line("IDs: " . implode(', ', $created));
    });
    
    WP_CLI::add_command('fixtures delete', function($args, $assoc_args) {
        WP_CLI::line("Suppression des fixtures...");
        
        $deleted = altr_delete_fixtures();
        
        WP_CLI::success("{$deleted} articles supprimés!");
    });
}

/**
 * Admin page for generating fixtures
 */
function altr_fixtures_admin_page() {

    // Add warning if ACF is not active
    if (!function_exists('update_field')) {
        echo '<div class="notice notice-warning"><p>';
        _e('⚠️ Le plugin ACF doit être activé pour sauvegarder les champs artiste et série.', ALTR_TEXT_DOMAIN);
        echo '</p></div>';
    }

    add_management_page(
        __('Générer des Fixtures', ALTR_TEXT_DOMAIN),
        __('Fixtures', ALTR_TEXT_DOMAIN),
        'manage_options',
        'altr-fixtures',
        'altr_fixtures_admin_page_content'
    );
}
add_action('admin_menu', 'altr_fixtures_admin_page');

/**
 * Render fixtures admin page
 */
function altr_fixtures_admin_page_content() {
    // Handle form submission
    if (isset($_POST['altr_generate_fixtures']) && check_admin_referer('altr_fixtures_generate')) {
        $count = isset($_POST['fixture_count']) ? intval($_POST['fixture_count']) : 10;
        $series = isset($_POST['fixture_series']) ? sanitize_text_field($_POST['fixture_series']) : 'mixed';
        
        $created = altr_generate_fixtures($count, ['series' => $series]);
        
        echo '<div class="notice notice-success"><p>';
        printf(
            __('%d articles créés avec succès! IDs: %s', ALTR_TEXT_DOMAIN),
            count($created),
            implode(', ', $created)
        );
        echo '</p></div>';
    }
    
    if (isset($_POST['altr_delete_fixtures']) && check_admin_referer('altr_fixtures_delete')) {
        $deleted = altr_delete_fixtures();
        
        echo '<div class="notice notice-success"><p>';
        printf(__('%d articles supprimés!', ALTR_TEXT_DOMAIN), $deleted);
        echo '</p></div>';
    }
    
    ?>
    <div class="wrap">
        <h1><?php _e('Générer des Fixtures', ALTR_TEXT_DOMAIN); ?></h1>
        <p><?php _e('Créer des articles factices pour le développement et les tests.', ALTR_TEXT_DOMAIN); ?></p>
        
        <div class="card" style="max-width: 600px; margin-top: 20px;">
            <h2><?php _e('Générer des Articles', ALTR_TEXT_DOMAIN); ?></h2>
            <form method="post">
                <?php wp_nonce_field('altr_fixtures_generate'); ?>
                <table class="form-table">
                    <tr>
                        <th scope="row">
                            <label for="fixture_count"><?php _e('Nombre d\'articles', ALTR_TEXT_DOMAIN); ?></label>
                        </th>
                        <td>
                            <input type="number" name="fixture_count" id="fixture_count" value="10" min="1" max="100" class="small-text">
                            <p class="description"><?php _e('Combien d\'articles générer (1-100)', ALTR_TEXT_DOMAIN); ?></p>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <label for="fixture_series"><?php _e('Type de série', ALTR_TEXT_DOMAIN); ?></label>
                        </th>
                        <td>
                            <select name="fixture_series" id="fixture_series">
                                <option value="mixed">Mixte (CBD + 30?)</option>
                                <option value="cbd">CBD uniquement</option>
                                <option value="30q">30? uniquement</option>
                            </select>
                            <p class="description"><?php _e('Quel type d\'articles générer', ALTR_TEXT_DOMAIN); ?></p>
                        </td>
                    </tr>
                </table>
                <p class="submit">
                    <input type="submit" name="altr_generate_fixtures" class="button button-primary" value="<?php _e('Générer les Articles', ALTR_TEXT_DOMAIN); ?>">
                </p>
            </form>
        </div>
        
        <div class="card" style="max-width: 600px; margin-top: 20px;">
            <h2><?php _e('Supprimer les Fixtures Récents', ALTR_TEXT_DOMAIN); ?></h2>
            <p><?php _e('Supprimer les articles créés par vous dans la dernière semaine.', ALTR_TEXT_DOMAIN); ?></p>
            <form method="post" onsubmit="return confirm('<?php _e('Êtes-vous sûr de vouloir supprimer ces articles?', ALTR_TEXT_DOMAIN); ?>');">
                <?php wp_nonce_field('altr_fixtures_delete'); ?>
                <p class="submit">
                    <input type="submit" name="altr_delete_fixtures" class="button button-secondary" value="<?php _e('Supprimer les Articles Récents', ALTR_TEXT_DOMAIN); ?>">
                </p>
            </form>
        </div>
        
        <div class="card" style="max-width: 800px; margin-top: 20px;">
            <h2>Exemples de titres générés</h2>
            <ul style="list-style: disc; margin-left: 20px;">
                <li><strong>CBD:</strong> CBD⁴⁴ /ODUNSI JR FABRICE-PRINCE /; Quand l'émotion prend une forme universelle</li>
                <li><strong>30?:</strong> 30?Q /Irma Odunsi/ Une invitation à la réflexion</li>
            </ul>
        </div>
    </div>
    <?php
}