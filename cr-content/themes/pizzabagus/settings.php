<?php
    //call necessary settings
    $class_settings     = new Settings($pdo);
    $function_sitename  = $class_settings->view_settings_sitename();
    $function_tagline   = $class_settings->view_settings_tagline();
    $function_metak     = $class_settings->view_settings_metakeywords();
    $function_metad     = $class_settings->view_settings_metadesc();
    $function_email     = $class_settings->view_settings_email();
    $function_phone     = $class_settings->view_settings_phone();
    $function_address   = $class_settings->view_settings_address();
    $function_cs        = $class_settings->view_settings_color_scheme();
    $function_favicon   = $class_settings->view_settings_favicon();
    $function_sitekey   = $class_settings->view_settings_recaptcha_sitekey();
    $function_secret    = $class_settings->view_settings_recaptcha_secret();
    $function_api_map   = $class_settings->view_settings_apimap();
    $function_analytics = $class_settings->view_settings_analytics();
    $function_hpl       = $class_settings->view_settings_homepage_link();
    $function_hp_style  = $class_settings->view_settings_homepage_style();
    $function_qip       = $class_settings->view_settings_quotes_in_page();
    $function_sip       = $class_settings->view_settings_services_in_page();
    $function_cip       = $class_settings->view_settings_clients_partners_in_page();
    $function_service_title = $class_settings->view_settings_services_title();
    $function_quotes_title  = $class_settings->view_settings_quotes_title();
    $function_clients_title = $class_settings->view_settings_clients_title();
    $function_custom_home_content = $class_settings->view_settings_custom_home_content();
    //custom color scheme
    $function_custom_primary   = $class_settings->view_settings_custom_primary();
    $function_custom_secondary = $class_settings->view_settings_custom_secondary();
    //date and time format
    $function_date_format      = $class_settings->view_settings_date_format();
    $function_time_format      = $class_settings->view_settings_time_format();
    //instagram feed
    $function_insta_uid = $class_settings->view_settings_instafeed_user_id();
    $function_insta_at  = $class_settings->view_settings_instafeed_access_token();
    $function_insta_lm  = $class_settings->view_settings_instafeed_limit();
    //open and close order
    $function_open_order     = $class_settings->view_settings_open_order();
    $function_close_order    = $class_settings->view_settings_close_order();
    $function_order_status   = $class_settings->view_settings_order_status();
    $explode_order_status = explode(',', $function_order_status);
    $open_order_time  = (int)$explode_order_status[0];
    $close_order_time = (int)$explode_order_status[1];
    $current_time = str_replace(":", "", $date_for_now->format('H:i'));
    if (($current_time > $open_order_time && $current_time < $close_order_time)) {
        $order_status = true;
    }
    else {
        $order_status = false;
    }

    $class_commerce_settings = new Commerce_Settings($pdo);
    if(!isset($lang)) {
        $function_payment_information = $class_commerce_settings->view_settings_payment_information();
        $function_term_of_service     = $class_commerce_settings->view_settings_term_of_service();
        $function_custom_homepage_content = $class_commerce_settings->view_settings_custom_homepage_content();
    }
    else {
        if($lang == $default_language->cr_languageCode) {
            $function_payment_information = $class_commerce_settings->view_settings_payment_information();
            $function_term_of_service     = $class_commerce_settings->view_settings_term_of_service();
            $function_custom_homepage_content = $class_commerce_settings->view_settings_custom_homepage_content();
        }
        else {
            $function_payment_information = $class_commerce_settings->view_settings_payment_information_id();
            $function_term_of_service     = $class_commerce_settings->view_settings_term_of_service_id();
            $function_custom_homepage_content = $class_commerce_settings->view_settings_custom_homepage_content_id();
        }
    }


?>