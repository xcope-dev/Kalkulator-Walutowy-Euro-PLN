<?php
/**
 * Plugin Name: Kalkulator Walutowy
 * Description: Prosty kalkulator walutowy Euro (EUR) → Polskie Złote (PLN).
 * Version: 1.2
 * Author: Xcope
 * Text Domain: kalkulator-walutowy
 */

// Dodajemy shortcode [kalkulator_walutowy]
function kalkulator_walutowy_shortcode() {
    ob_start(); ?>
    <div class="container">
        <h2><?php _e('Kalkulator walutowy Euro (EUR) → Polskie Złote (PLN)', 'kalkulator-walutowy'); ?></h2>
        <form id="calcForm" method="post">
            <label for="euroInput"><?php _e('Wprowadź kwotę w Euro:', 'kalkulator-walutowy'); ?></label>
            <input id="euroInput" name="euroInput" min="0" step="0.01" type="number" value="0" required />
            <button type="submit" name="submit"><?php _e('Oblicz', 'kalkulator-walutowy'); ?></button>
        </form>
        <p id="wynik">0 Euro = 0 PLN</p>
        <p id="errorMessage" style="color: red; display: none;"><?php _e('Błąd podczas pobierania kursu', 'kalkulator-walutowy'); ?></p>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('kalkulator_walutowy', 'kalkulator_walutowy_shortcode');

// AJAX obsługa
function kalkulator_walutowy_fetch_rate() {
    $kurs = aktualny_kurs();
    if ($kurs) {
        wp_send_json_success($kurs);
    } else {
        wp_send_json_error(__('Błąd podczas pobierania kursu', 'kalkulator-walutowy'));
    }
}
add_action('wp_ajax_kalkulator_walutowy_fetch_rate', 'kalkulator_walutowy_fetch_rate');
add_action('wp_ajax_nopriv_kalkulator_walutowy_fetch_rate', 'kalkulator_walutowy_fetch_rate');

// Funkcja pobierająca aktualny kurs Euro do PLN z NBP z pamięcią podręczną
function aktualny_kurs() {
    // Sprawdź, czy kurs jest w pamięci podręcznej
    $kurs = get_transient('aktualny_kurs_euro_pln');
    if ($kurs === false) {
        // URL do API NBP
        $url = "https://api.nbp.pl/api/exchangerates/rates/a/eur/";
        // Pobieramy dane z API
        $response = wp_remote_get($url);

        if (is_wp_error($response)) {
            return false;
        }

        // Dekodowanie JSON
        $data = json_decode($response['body']);
        if (isset($data->rates[0]->mid) && is_numeric($data->rates[0]->mid)) {
            $kurs = $data->rates[0]->mid;
            // Przechowuj kurs w pamięci podręcznej przez 1 godzinę
            set_transient('aktualny_kurs_euro_pln', $kurs, HOUR_IN_SECONDS);
        } else {
            return false;
        }
    }
    return $kurs;
}

// Rejestracja plików JS
function kalkulator_walutowy_enqueue_scripts() {
    wp_enqueue_script('kalkulator-walutowy', plugin_dir_url(__FILE__) . 'assets/script.js', array('jquery'), null, true);
    wp_localize_script('kalkulator-walutowy', 'kalkulatorWalutowy', array(
        'ajaxUrl' => admin_url('admin-ajax.php'),
        'errorMessage' => __('Błąd podczas pobierania kursu', 'kalkulator-walutowy')
    ));
}
add_action('wp_enqueue_scripts', 'kalkulator_walutowy_enqueue_scripts');

// Dodanie tłumaczeń
function kalkulator_walutowy_load_textdomain() {
    load_plugin_textdomain('kalkulator-walutowy', false, dirname(plugin_basename(__FILE__)) . '/languages');
}
add_action('plugins_loaded', 'kalkulator_walutowy_load_textdomain');
