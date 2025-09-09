<?php

global $wp_rewrite;
$wp_rewrite->flush_rules();


//タームの「説明」で並び替え
function taxonomy_orderby_description($orderby, $args)
{

  if ($args['orderby'] == 'description') {
    $orderby = 'tt.description';
  }
  return $orderby;
}
add_filter('get_terms_orderby', 'taxonomy_orderby_description', 10, 2);


//ターム説明文pタグ削除
remove_filter('term_description', 'wpautop');
//ターム説明文pタグ削除

//アイキャッチ画像許可
add_theme_support('post-thumbnails');
//アイキャッチ画像許可

//固定ページビジュアルエディタ不可
// function disable_visual_editor_in_page()
// {
//   global $typenow;
//   if ($typenow == 'page') {
//     add_filter('user_can_richedit', 'disable_visual_editor_filter');
//   }
// }
// function disable_visual_editor_filter()
// {
//   return false;
// }
// add_action('load-post.php', 'disable_visual_editor_in_page');
// add_action('load-post-new.php', 'disable_visual_editor_in_page');
//固定ページビジュアルエディタ不可


//ユーザーが検索したワードをハイライト
function wps_highlight_results($text)
{
  if (is_search()) {
    $sr = get_query_var('s');
    $keys = explode(" ", $sr);
    $text = preg_replace('/(' . implode('|', $keys) . ')/iu', '<span class="searchhighlight">' . $sr . '</span>', $text);
  }
  return $text;
}
add_filter('the_title', 'wps_highlight_results');
add_filter('the_content', 'wps_highlight_results');


//カスタム投稿用post_typeセット
add_filter('template_include', 'custom_search_template');
function custom_search_template($template)
{
  if (is_search()) {
    $post_types = get_query_var('post_type');
    foreach ((array) $post_types as $post_type)
      $templates[] = "{$post_type}-search.php";
    $templates[] = 'search.php';
    $template = get_query_template('search', $templates);
  }
  return $template;
}

//カスタム投稿の投稿画面に作成者変更のメタボックス表示
add_action('admin_menu', 'myplugin_add_custom_box');

function myplugin_add_custom_box()
{
  if (function_exists('add_meta_box')) {
    add_meta_box('myplugin_sectionid', __('作成者', 'myplugin_textdomain'), 'post_author_meta_box', 'type_campus', 'advanced');
  }
}

function theme_name_scripts()
{
  wp_enqueue_style('style-name', get_stylesheet_uri() . '/style.css', array(), '1.0.0', true);
}
add_action('wp_enqueue_scripts', 'theme_name_scripts');


/**
 * LP ASP用
 */
function lpform_after_send($Data)
{
  $form_key = $Data->get_form_key();
  if ($form_key === 'mw-wp-form-5366') {
    $saved_mail_id = $Data->get_saved_mail_id();
    $track_id = get_post_meta($saved_mail_id, 'tracking_number', true);
    wp_redirect('/lp_complete?track=' . $track_id);
    exit;
  }
}
add_action('mwform_after_send_mw-wp-form-5366', 'lpform_after_send');


/**
 * ジョーカツツアー2025用
 */
function tour2025form_after_send($Data)
{
  $form_key = $Data->get_form_key();
  if ($form_key === 'mw-wp-form-5543') {
    wp_redirect('/tour2025fb1_thanks');
    exit;
  }
}
add_action('mwform_after_send_mw-wp-form-5543', 'tour2025form_after_send');


/**
 * スタキャリ ASP用
 */
function stacari_form_after_send($Data)
{
  $form_key = $Data->get_form_key();
  if ($form_key === 'mw-wp-form-5413') {
    wp_redirect('/stacari_complete');
    exit;
  }
}
add_action('mwform_after_send_mw-wp-form-5413', 'stacari_form_after_send');


/**
 * 資料ダウンロード 送信完了後に完了ページへ遷移
 */
function my_mwform_after_send($Data)
{
  $form_key = $Data->get_form_key();
  if ($form_key === 'mw-wp-form-4297') {
    $doument_id = $Data->get('document');
    wp_redirect('/biz/downloads_thanks?document=' . $doument_id);
    exit;
  }
}
add_action('mwform_after_send_mw-wp-form-4297', 'my_mwform_after_send');

/**
 * 資料ダウンロード 資料のIDをパラメータとして追加
 */
function my_mwform_value($value, $name)
{
  $post_id = get_the_ID();
  if ($name === 'document') {
    return $post_id;
  }
  return $value;
}
add_filter('mwform_value_mw-wp-form-4297', 'my_mwform_value', 10, 2);

function contact_date($value, $key, $insert_contact_data_id)
{
  if ($key === 'contact_date') {
    return date_i18n('Y/m/d l H:i:s');
  }
  return $value;
}
add_filter('mwform_custom_mail_tag_mw-wp-form-5366', 'contact_date', 10, 3);

/**
 *canonicalタグの末尾にスラッシュを追加
 */
function custom_canonical_url($canonical_url)
{
  if ($canonical_url) {
    $canonical_url = trailingslashit($canonical_url);
  }
  return $canonical_url;
}
add_filter('aioseop_canonical_url', 'custom_canonical_url');

/*-----------------------------------------
	ウィジェットの登録
-------------------------------------------*/
function theme_slug_widgets_init()
{
  register_sidebar(array(
    'name' => 'ABテスト', //ウィジェットの名前を入力
    'id' => 'abtest', //ウィジェットに付けるid名を入力
  ));
}
add_action('widgets_init', 'theme_slug_widgets_init');

/*
 * **************************************************************
 * 指定した確率でコンテンツをだし分ける
 * **************************************************************
 */

$probability_sum = array(); //確率の進行管理集計用

function if_random($atts, $content)
{

  /***********************************************
   * 初期設定
   ************************************************/

  global $probability_sum;

  //パラメータ初期化
  extract(shortcode_atts(array(
    "name" => "", //抽選名(同じ名前のものの中で抽選が行われる)
    "probability" => 100, //抽選の確率(指定しないと100%)
  ), $atts));

  //キャッシュ無効にする方法
  // HTTPヘッダ: 
  //     header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
  // HTML meta:
  //     <meta http-equiv="Pragma" content="no-cache">
  //     <meta http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate, max-age=0">

  //エラーが出るのでコメントアウト中header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0"); //HTTPヘッダを利用してキャッシュ無効

  $content = do_shortcode($content); //ショートコードの中のショートコードを展開

  /***********************************************
   * 入力パラメータチェック
   ************************************************/

  $result = null;

  //パラメーター名のチェック
  if ($name == null) { // nameが設定されていなければ終了
    return $result; /* 終了 */
  }

  //probabilityが変な値なら終了
  if ($probability == 0 || $probability > 100 || $probability < 0) {
    return $result; /* 終了 */
  }

  /***********************************************
   * 集計
   ************************************************/

  if (isset($probability_sum[$name]) == false) {
    $probability_sum[$name] = 0; //集計用変数初期化
  }

  if ($probability_sum[$name] >= 100) { //確率の合計がすでに100%に達していたら終了
    return "{$result}";
  }

  $pre_probability_sum = $probability_sum[$name]; //これまでの合計確率保存

  $probability_sum[$name] += floatval($probability); //今回の合計確率を加算

  if ($probability_sum[$name] >= 100) { //今回の分を加算して100%に達したら抽選せず当たりで終了
    return "{$result}{$content}";
  }

  /***********************************************
   * 抽選処理
   ************************************************/

  $decimal_num = 0;
  $ind = strpos($probability, "."); //小数点の位置
  if ($ind !== false) { //小数点がある
    $decimal_num = (strlen($probability) - ($ind + 1)); //小数点の桁数
  }

  $max = (100 - $pre_probability_sum) * pow(10, $decimal_num); //小数点の数だけ桁数をずらして整数にする

  $rand = rand(1, $max);
  $border = $probability * pow(10, $decimal_num);

  // 1～$maxまでの数字と$borderを比較して抽選
  // 1回目 30%設定ならborder=30/max=100でrandが30以下なら当たり
  // 2回目 20%設定ならborder=20/max=100-30でrandが20以下なら当たり
  // 3回目 50%なのでborder=50/50で抽選せずに当たり
  if ($rand <= $border) { //抽選当たり
    $probability_sum[$name] = 100;
    return "{$result}{$content}";
  } else { //抽選外れ
    return "{$result}";
  }
}

add_shortcode('if_random', 'if_random'); /* ショートコードを登録 */

//ジョーカツツアー2026エラー表示
function validation_rule($validation, $data, $Data)
{
  $validation->set_rule('daigaku', 'noempty', array('message' => '大学名を入力してください。'));
  $validation->set_rule('gakubu', 'noempty', array('message' => '学部を入力してください。'));
  $validation->set_rule('name', 'noempty', array('message' => 'お名前を入力してください。'));
  $validation->set_rule('email', 'noempty', array('message' => 'メールアドレスを入力してください。'));
  $validation->set_rule('tel', 'noempty', array('message' => '電話番号を入力してください。'));
  return $validation;
}
add_filter('mwform_validation_mw-wp-form-28995', 'validation_rule', 10, 3);

//テンプレートを投稿画面に呼び出す
add_shortcode('add_part', function ($attr) {
  ob_start();
  get_template_part($attr['temp']);
  return ob_get_clean();
});

//自己分析カテゴリのCTA
add_shortcode('cta_self', function ($atts, $content, $tag) {

  return <<<EOF

<p><a href="https://liff.line.me/1656090062-kJKVMPgE/landing?follow=%40564anbbu&lp=gz5nUm&liff_id=1656090062-kJKVMPgE" target="_blank"><img src="https://jo-katsu.com/release/wordpress/wp-content/uploads/2025/07/cta_01.png" alt="性格診断" /></a>
<a href="https://liff.line.me/1656090062-kJKVMPgE/landing?follow=%40564anbbu&lp=CQymkW&liff_id=1656090062-kJKVMPgE" target="_blank"><img src="https://jo-katsu.com/release/wordpress/wp-content/uploads/2025/07/cta_02.png" alt="適職診断" /></a></p>

EOF;
});








// 20250708


// 会員登録画面からユーザー名を取り除く
add_filter( 'wpmem_register_form_rows', function( $rows ) {
    unset( $rows['username'] );
    return $rows;
});

// メールアドレスからユーザー名を作成する
add_filter( 'wpmem_pre_validate_form', function( $fields ) {
    $fields['username'] = $fields['user_email'];
    return $fields;
});

// 管理バーを権限グループ毎に表示・非表示を切り替える
function theme_show_admin_bar( $content ) {
	// 管理者・編集者の権限グループの場合は表示
	if ( current_user_can( 'administrator' ) || current_user_can( 'editor' ) ) {
		return $content;
	// 他の権限グループの場合は非表示
	} else {
		return false;
	}
}
add_filter( 'show_admin_bar' , 'theme_show_admin_bar' );

add_action('template_redirect', function() {
  $request_uri = $_SERVER['REQUEST_URI'];

  if (strpos($request_uri, '/mypage/') !== false &&
      strpos($request_uri, 'a=confirm') !== false &&
      strpos($request_uri, 'key') !== false) {

    // 固定URLでリダイレクト
    wp_redirect('https://xs262245.xsrv.jp/na-tst/mypage/?a=edit', 301);
    exit;
  }
});




add_filter( 'wpmem_register_form_rows', 'customize_wpmem_register_form_rows' );

function customize_wpmem_register_form_rows( $rows ) {

    $notice = '<div id="kiyaku1"><p class="mb-1 has-text-color has-link-color" style="color:#868686">
        登録すると、以下の規約に同意したものとみなされます
    </p>
    <p class="has-text-color has-link-color" style="color:#db0037">
        <span style="text-decoration: underline;">就活HAND BOOK利用規約</span>、
        <span style="text-decoration: underline;">就活HAND BOOK個人情報の取り扱い</span>、
        <span style="text-decoration: underline;">ジョーカツ利用規約</span>、
        <span style="text-decoration: underline;">ジョーカツ個人情報の取り扱い</span>、
        <span style="text-decoration: underline;">プライバシーポリシー</span>
    </p></div>
    ';

    $block = '<div class="wp-block-group shokai_group"><div class="wp-block-group__inner-container is-layout-constrained wp-block-group-is-layout-constrained">
    <h2 class="wp-block-heading has-text-color has-link-color" style="color:#db0037;font-size:30px">就活HAND BOOK新卒紹介サービスに登録！</h2>
    <figure class="wp-block-image size-full">
    <img decoding="async" src="https://xs262245.xsrv.jp/na-tst/wp-content/uploads/2025/07/image-1.png" alt="">
    </figure>
    <div style="height:2rem" aria-hidden="true" class="wp-block-spacer"></div>
    <p class="lh-n">専任のキャリアアドバイザーが就活HAND BOOKの独自コンテンツを活用した個別面談を実施し、あなたの志向性や適正に応じて企業・求人のご紹介、就活準備/就活を支援するサービスです。</p>
    <div style="height:2rem" aria-hidden="true" class="wp-block-spacer"></div>
    <ul style="color:#db0037" class="wp-block-list">
    <li>就活HAND BOOK新卒紹介利用規約</li>
    <li>プライバシーポリシー</li>
    <li>個人情報の取り扱いについて</li>
    </ul>
    <div style="height:2rem" aria-hidden="true" class="wp-block-spacer"></div>
    <div class="wp-block-group p-4 has-white-background-color has-background">
    <div class="wp-block-group__inner-container is-layout-constrained">
    <p class="lh-n has-small-font-size">※チェックをつけたまま進むと、上記の規約に同意したことになり、登録が完了いたします。<br>※就活HAND BOOKから順次メールや電話にてご連絡をいたします。<br>※情報が不要になった場合は、マイページ（現在WEB版のみ対応）より案内停止の手続きをお願いいたします。<br>※求人や専任アドバイザーの状況により、ご案内をお待ちいただく場合がございます。ご了承ください。</p>
    </div></div>
    <div style="height:2rem" aria-hidden="true" class="wp-block-spacer"></div>
    </div></div>
    <div style="height:1rem" aria-hidden="true" class="wp-block-spacer"></div>
    <div class="wp-block-buttons next_button is-content-justification-center" style="display: flex;">
    <div class="wp-block-button">
    <a class="wp-block-button__link has-background nextb" style="background-color:#db0037; width: 277px;">次へ</a>
    </div>
    </div>
    ';

    $new_rows = [];

    foreach ( $rows as $key => $row ) {
        $new_rows[ $key ] = $row;

        if ( $key === 'user_email' ) {
            $new_rows['terms_notice'] = [ 'label' => '', 'field' => $notice ];
        }

        if ( $key === 'graduation' ) {
            $new_rows['shinsotsu_block'] = [ 'label' => '', 'field' => $block ];
        }
    }

    return $new_rows;
}


// WP-Membersで登録フォーム送信後に特定のURLへリダイレクト
add_filter( 'wpmem_msg', 'custom_wpmem_messages', 10, 2 );

function custom_wpmem_messages( $msg, $msg_id ) {
    // メール確認ありの状態で仮登録が完了した際のメッセージIDは "reg_email"（ID: 38）
    if ( $msg_id == 38 ) {
        // JavaScriptで自動リダイレクトさせる
        return $msg . '<script>window.location.href="https://xs262245.xsrv.jp/na-tst/thankyou/";</script>';
    }
    return $msg;
}


function user_info_box_shortcode() {
    if ( ! is_user_logged_in() ) {
        return '';
    }

    ob_start();
    ?>
    <div style="background:#fff; padding:1.5em; border-bottom: solid 4px #F2F4F6; border-radius:16px 16px 0 0; max-width:500px;">
        <p style="font-size:0.8em; color:#868686; margin:0 0 0.5em 0;">
            [wpmem_field graduation display="raw"]年卒
        </p>
        <div style="display:flex; align-items:center;">
            <img src="http://xs262245.xsrv.jp/na-tst/wp-content/uploads/2025/07/Group.png" alt="icon" style="width:16px; height:20px; margin-right:0.5em;">
            <span style="font-size:1.1em; font-weight:bold;">
                [wpmem_field last_name] [wpmem_field first_name]
            </span>
        </div>
    </div>
    <div style="background:#fff; padding:1.5em; border-bottom: solid 4px #F2F4F6; border-radius:0px; max-width:500px;">
        <p style="font-size:1em; color:#DB0037; margin:0;">
           申し込み済みイベント
        </p>
    </div>
    <div style="background:#fff; padding:1.5em; border-bottom: solid 4px #F2F4F6; border-radius:0px; max-width:500px;">
        <p style="font-size:1em; color:#DB0037; margin:0 0 1.5em 0;">
           重要なお知らせ
        </p>
		        <p style="font-size:1em; color:#DB0037; margin:0;">
           新着情報
        </p>
    </div>
    <div style="background:#fff; padding:1.5em; border-bottom: solid 4px #F2F4F6; border-radius:0px; max-width:500px;">
        <p style="font-size:1em; color:#DB0037; margin:0;">
           活動実績・エピソード
        </p>
    </div>
<div class="profile-toggle" style="background:#E5E9EF; padding:1.5em; border-radius:0px; max-width:500px; display:flex; justify-content:space-between; align-items:center; cursor:pointer;">
  <p class="toggle-label" style="font-size:1em; color:#000; margin:0; font-weight:700;">
    プロフィール
  </p>
  <img class="toggle-icon" src="http://xs262245.xsrv.jp/na-tst/wp-content/uploads/2025/07/Vector.png" alt="矢印" style="width:11px; height:6px;">
</div>


<section class="profiel">
    <div style="background:#fff; padding:1.5em; border-bottom: solid 4px #F2F4F6; border-radius:0px; max-width:500px;">
        <p style="font-size:1em; color:#DB0037; margin:0;">
          履歴書作成
        </p>
    </div>
    <div style="background:#fff; padding:1.5em; border-bottom: solid 4px #F2F4F6; border-radius:0px; max-width:500px;">
        <p style="font-size:1em; color:#DB0037; margin:0;">
           お気に入り企業
        </p>
    </div>
    <div style="background:#fff; padding:1.5em; border-bottom: solid 4px #F2F4F6; border-radius:0px; max-width:500px;">
        <p style="font-size:1em; color:#DB0037; margin:0 0 1.5em 0;">
           募集中の体験談・内定実績
        </p>
		        <p style="font-size:1em; color:#DB0037; margin:0;">
          下書き・投稿済み
        </p>
    </div>
    <div style="background:#fff; padding:1.5em; border-bottom: solid 4px #F2F4F6; border-radius:0px; max-width:500px;">
        <p style="font-size:1em; color:#DB0037; margin:0;">
           受信設定
        </p>
    </div>
    <div style="background:#fff; padding:1.5em; border-bottom: solid 4px #F2F4F6; border-radius:0px; max-width:500px;">
        <p style="font-size:1em; color:#DB0037; margin:0;">
           活動実績・エピソード
        </p>
    </div>
    <div style="background:#fff; padding:1.5em; border-bottom: solid 4px #F2F4F6; border-radius:0px; max-width:500px;">
        <p style="font-size:1em; color:#DB0037; margin:0;">
           サービス利用設定
        </p>
    </div>
    <div style="background:#fff; padding:1.5em; border-bottom: solid 4px #F2F4F6; border-radius:0px; max-width:500px;">
        <p style="font-size:1em; color:#DB0037; margin:0;">
           プライバシー
        </p>
    </div>
    <div style="background:#fff; padding:1.5em; border-bottom: solid 4px #F2F4F6; border-radius:0 0 16px 16px; max-width:500px;">
        <p style="font-size:1em; color:#DB0037; margin:0;">
           ログアウト
        </p>
    </div>
	
	</section>
    <?php
    return do_shortcode( ob_get_clean() );
}
add_shortcode( 'user_info_box', 'user_info_box_shortcode' );




function account_info_box_shortcode() {
    if ( ! is_user_logged_in() ) {
        return '';
    }

    $current_user = wp_get_current_user();
    $email = $current_user->user_email;
    $edit_url = home_url('/na-tst/mypage/?a=edit');

    // カスタムフィールド取得
    $billing_phone   = get_user_meta($current_user->ID, 'billing_phone', true);
    $college         = get_user_meta($current_user->ID, 'college', true);
    $lab             = get_user_meta($current_user->ID, 'lab', true);
    $bunri           = get_user_meta($current_user->ID, 'bunri', true);
    $academic_year   = get_user_meta($current_user->ID, 'academic_year', true);
    $graduation      = get_user_meta($current_user->ID, 'graduation', true);

    ob_start();
    ?>
    <div style="background:#fff; border-radius:16px; padding:0; overflow:hidden; margin:0 auto;">
        <div style="display:flex; justify-content:space-between; align-items:center; padding:2em 1.5em; font-weight:bold; font-size:1.1em; border-bottom:1px solid #ddd;">
            <span style="font-weight: bold;">アカウント情報</span>
            <a href="<?php echo esc_url($edit_url); ?>" style="color:#db0037; font-size:0.9em; text-decoration:none;">編集する &gt;</a>
        </div>
<table style="width:100%; border-collapse:separate; border-spacing:0 0.5em; color:#333;">
  <tr>
    <td style="width:30%; padding:1.5em 0.5em 1.5em 2em; color:#999;">アカウントID<br>（メールアドレス）</td>
    <td style="padding:1em; font-weight:500;"><?php echo esc_html($email); ?></td>
  </tr>
  <tr>
    <td style="width:30%; padding:1.5em 0.5em 1.5em 2em; color:#999;">電話番号</td>
    <td style="padding:1em; font-weight:500;"><?php echo esc_html($billing_phone); ?></td>
  </tr>
  <tr>
    <td style="width:30%; padding:1.5em 0.5em 1.5em 2em; color:#999;">大学</td>
    <td style="padding:1em; font-weight:500;"><?php echo esc_html($college); ?></td>
  </tr>
  <tr>
    <td style="width:30%; padding:1.5em 0.5em 1.5em 2em; color:#999;">ゼミ・研究室</td>
    <td style="padding:1em; font-weight:500;"><?php echo esc_html($lab); ?></td>
  </tr>
  <tr>
    <td style="width:30%; padding:1.5em 0.5em 1.5em 2em; color:#999;">文理区分</td>
    <td style="padding:1em; font-weight:500;"><?php echo esc_html($bunri); ?></td>
  </tr>
  <tr>
    <td style="width:30%; padding:1.5em 0.5em 1.5em 2em; color:#999;">学年</td>
    <td style="padding:1em; font-weight:500;"><?php echo esc_html($academic_year); ?></td>
  </tr>
  <tr>
    <td style="width:30%; padding:1.5em 0.5em 1.5em 2em; color:#999;">卒業年度</td>
    <td style="padding:1em; font-weight:500;"><?php echo esc_html($graduation); ?></td>
  </tr>
</table>


    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('account_info_box', 'account_info_box_shortcode');




function custom_login_box_shortcode() {
    if ( is_user_logged_in() ) {
        return ''; // ログイン済みなら何も表示しない
    }

    ob_start();
    ?>
    <div style="background:#fff; border-radius:16px; padding:2em; max-width:400px; margin:0 auto; box-shadow:0 2px 8px rgba(0,0,0,0.05);" id="login_sec">
        <h2 style="font-size:1.3em; margin-bottom:1em;">ログイン</h2>
        <div style="background:#f8f8f8; padding:2em 1em; border-radius:8px; font-size:0.9em; margin-bottom:1.5em;">
		<p>
            以下のサイトに登録していたら、同じメールアドレス・パスワードでログインできます</p>
            <ul style="margin:0.5em 0 0 1em; padding:0;">
                <li>・ONE CAREER PLUS</li>
                <li>・ONE CAREER for Engineer</li>
            </ul>
        </div>

        <?php echo do_shortcode('[wpmem_form login]'); ?>

        <div style="margin-top:1.5em; text-align:right; font-size: 15px; letter-spacing: normal;" class="pass_forget">
            <a href="#" style="display:block; color:#db0037; font-size:0.8em; margin-bottom:0.3em;">就活HAND BOOKのパスワードを忘れた方 ＞</a>
            <a href="#" style="display:block; color:#db0037; font-size:0.8em;">就活HAND BOOK ID（共通ID）のパスワードを忘れた方 ＞</a>
        </div>

<div style="display:flex; align-items:center; text-align:center; margin:1.5em 0; font-size:0.9em; color:#888;">
  <div style="flex:1; height:1px; background:#ccc;"></div>
  <div style="padding:0 1em;">30万件のクチコミ・就活体験談が読み放題！</div>
  <div style="flex:1; height:1px; background:#ccc;"></div>
</div>


        <div style="text-align:center;">
            <a href="/register" style="display:inline-block; padding:0.75em 1.5em; border:2px solid #db0037; border-radius:999px; color:#db0037; text-decoration:none; font-weight:bold;">新規会員登録（無料）はこちら</a>
        </div>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('custom_login_box', 'custom_login_box_shortcode');

// add_filter( 'wpmem_register_form_rows', function( $rows ) {
//     if ( !isset( $rows['videos'] ) ) {
//         $rows['videos'] = '';
//     }
//     return $rows;
// });






add_action('pre_get_posts', function($query) {
  if (!is_admin() && $query->is_main_query() && is_search() && $query->get('post_type') === 'videos') {
    
    if (!empty($_GET['video_category'])) {
      $term = get_term_by('slug', sanitize_text_field($_GET['video_category']), 'video_category');
      if ($term) {
        $query->set('tax_query', [
          [
            'taxonomy' => 'video_category',
            'field'    => 'slug',
            'terms'    => $term->slug,
          ]
        ]);
      }
    }

    // 空の検索キーワード対策
    if (!isset($_GET['s']) || $_GET['s'] === '') {
      $query->set('suppress_filters', true);
    }
  }
});


// functions.php に追記
function force_events_archive_template($template) {
  if (is_search() && get_query_var('post_type') === 'events') {
    return locate_template('archive-events.php');
  }
  return $template;
}
add_filter('template_include', 'force_events_archive_template');





// パンくずリスト
add_filter('bcn_breadcrumb_trail', function($trail) {
  if (is_singular('events')) {
    $post_id = get_the_ID();
    $terms = get_the_terms($post_id, 'company');

    if ($terms && !is_wp_error($terms)) {
      $company_term = $terms[0]; // 複数ある場合は1つ目だけ使用

      $company_breadcrumb = new bcn_breadcrumb();
      $company_breadcrumb->set_title($company_term->name);
      $company_breadcrumb->set_url(get_term_link($company_term));
      $company_breadcrumb->set_type('taxonomy');
      $company_breadcrumb->set_template('<span property="itemListElement" typeof="ListItem"><a property="item" typeof="WebPage" title="Go to %title%." href="%link%" class="taxonomy company"><span property="name">%title%</span></a><meta property="position" content="%position%" /></span>');

      // 投稿タイトルの直前に追加
      array_splice($trail->breadcrumbs, -1, 0, [$company_breadcrumb]);
    }
  }

  return $trail;
});


// コメントメタ保存のためのフック
add_action('comment_post', function($comment_id) {
  if (isset($_POST['rating'])) {
    update_comment_meta($comment_id, 'rating', intval($_POST['rating']));
  }

  if (isset($_POST['participation'])) {
    update_comment_meta($comment_id, 'participation', sanitize_text_field($_POST['participation']));
  }

  if (!empty($_POST['course']) && is_array($_POST['course'])) {
    update_comment_meta($comment_id, 'course', implode('｜', array_map('sanitize_text_field', $_POST['course'])));
  }
});


/** Diagnosis Result 専用CSS＆フォント（対象テンプレだけ） */
add_action('wp_enqueue_scripts', function () {
  $targets = [
    'page-diagnosis-result-a.php',
    'page-diagnosis-result-b.php',
    'page-diagnosis-result-c.php',
    'page-diagnosis-result-d.php',
    'page-diagnosis-result-e.php',
  ];
  if ( ! is_page_template($targets) ) return;

  // ページ専用CSS（更新時刻でキャッシュバスター）
  $path = get_stylesheet_directory() . '/css/diagnosis.css';
  $uri  = get_stylesheet_directory_uri() . '/css/diagnosis.css';
  $ver  = file_exists($path) ? filemtime($path) : null;
  wp_enqueue_style('diagnosis-result', $uri, [], $ver);

  // フォント：本文 Noto Sans JP（400/500/700/900）
  wp_enqueue_style(
    'googlefonts-notojp',
    'https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;500;700;900&display=swap',
    [],
    null
  );
  // フォント：数字 Righteous
  wp_enqueue_style(
    'googlefonts-righteous',
    'https://fonts.googleapis.com/css2?family=Righteous&display=swap',
    [],
    null
  );
}, 20);


/* 管理画面では検索ハイライトを無効化 */
add_action('admin_init', function () {
  remove_filter('the_title',   'wps_highlight_results', 10);
  remove_filter('the_content', 'wps_highlight_results', 10);
  // もし抜粋にも付けていたら↓も
  // remove_filter('the_excerpt', 'wps_highlight_results', 10);
});

add_action('wp_footer', function () { ?>
<script>
(function () {
  const root = document.documentElement;

  function updateVars(){
    const header = document.querySelector('#header, .site-header, .l-header');
    const h = header ? Math.round(header.getBoundingClientRect().height) : 0;

    const ab = document.getElementById('wpadminbar');
    const abH = ab ? Math.round(ab.getBoundingClientRect().height) : 0;

    const wpVar = getComputedStyle(root).getPropertyValue('--wp-admin--admin-bar--height').trim();
    const wpVarNum = wpVar ? parseFloat(wpVar) : 0;

    root.style.setProperty('--header-h', h + 'px');
    root.style.setProperty('--adminbar', Math.max(abH, wpVarNum) + 'px');
  }

  // 初回 & 変化時
  document.addEventListener('DOMContentLoaded', updateVars);
  window.addEventListener('load', updateVars);
  window.addEventListener('resize', updateVars);

  const ro = new ResizeObserver(updateVars);
  const header = document.querySelector('#header, .site-header, .l-header');
  if (header) ro.observe(header);
  const ab = document.getElementById('wpadminbar');
  if (ab) ro.observe(ab);
})();
</script>
<?php }, 100);
