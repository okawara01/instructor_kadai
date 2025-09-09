<!DOCTYPE html>
<html lang="ja">
<head>
<!--エックスサーバー-->
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title></title>
<?php if(is_post_type_archive('faq') || is_tax('faqs')): ?>
<meta name="description" content="ジョーカツに寄せられた、よくある質問についての回答を掲載しています。質問と回答は随時追加・更新されます。" />
	<?php elseif(is_post_type_archive('gallery') || is_tax('gallerys')): ?>
<meta name="description" content="シェアハウスやカフェなど、ジョーカツの各サービスのフォトギャラリーです。実際の利用イメージや、施設について写真で確認することができます。" />
	<?php elseif(is_post_type_archive('story')): ?>
<meta name="description" content="ジョーカツを利用し、上京をあきらめずに東京で夢を叶えた、先輩たちの就活ストーリーをご紹介します。" />
	<?php endif; ?>
<meta name="facebook-domain-verification" content="h2tv8itaw1eihqellzbfu0xuba3t9u" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('template_directory'); ?>/css/slick.css"/>
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('template_directory'); ?>/css/slick-theme.css"/>
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('template_directory'); ?>/css/lightcase.css"/>

<link href="https://fonts.googleapis.com/css?family=Noto+Sans+JP:400,700|Roboto:400,500" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Righteous:400|Noto+Sans+JP:700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>" media="all" />
<script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<?php wp_head(); ?>
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-W4LDR6K');</script>
<!-- End Google Tag Manager -->
</head>
<body <?php body_class();?>>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-W4LDR6K"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
<nav id="sp-menubox">
	<ul>
		<li><a href="<?php echo home_url(); ?>">トップページ</a></li>
		<li><a href="<?php echo home_url(); ?>/news/">お知らせ</a></li>
		<li class="item">
		<div class="txt"><a href="<?php echo home_url(); ?>/about/">ジョーカツとは</a></div>
			<ul class="minbox">
				<li><a href="<?php echo home_url(); ?>/system/">なぜ無料なのか？</a></li>
				<li><a href="<?php echo home_url(); ?>/guide/">ご利用方法</a></li>
				<li><a href="<?php echo home_url(); ?>/faq/">よくある質問</a></li>
				<li><a href="<?php echo home_url(); ?>/message/">代表メッセージ</a></li>
				<li><a href="<?php echo home_url(); ?>/company/">運営会社</a></li>
			</ul>

		</li>

		<li class="item">
			<div class="txt"><a href="<?php echo home_url(); ?>/service/">サービス紹介</a></div>
			<ul class="minbox">
				<li><a href="<?php echo home_url(); ?>/house/">ジョーカツハウス</a></li>
				<li><a href="<?php echo home_url(); ?>/ticket/">ジョーカツ切符</a></li>
				<li><a href="<?php echo home_url(); ?>/event/">ジョーカツイベント</a></li>
				<li><a href="<?php echo home_url(); ?>/online/">ジョーカツオンライン</a></li>
				<li><a href="<?php echo home_url(); ?>/adviser/">キャリアアドバイザー</a></li>
			</ul>
		</li>
		<li>
		<div class="txt"><a href="<?php echo home_url(); ?>/story/">ジョーカツストーリー</a></div></li>
		<!--<li class="item">

			<div class="txt"><a href="<?php echo home_url(); ?>/voice/">利用者の声</a></div>

			<ul class="minbox">
				<li><a href="<?php echo home_url(); ?>/story/">ジョーカツストーリー</a></li>
				<li class="nolink"><a href="<?php echo home_url(); ?>/voices/student/">参加学生の声</a></li>
			</ul>
		</li>-->
		<li><a href="<?php echo home_url(); ?>/campus/">ジョーカツキャンパス</a></li>
		<li><a href="<?php echo home_url(); ?>/gallery/">ジョーカツギャラリー</a></li>
		<li><a href="<?php echo home_url(); ?>/contact/">お問い合わせ</a></li>
		<li><a href="<?php echo home_url(); ?>/business/">企業の方へ</a></li>
		<li><a href="<?php echo home_url(); ?>/videos/">就活動画一覧</a></li>
		<li><a href="<?php echo home_url(); ?>/events/">就活イベント（企業説明会・セミナー）の特集一覧</a></li>
		<li><a href="<?php echo home_url(); ?>/sign_in/">ログイン</a></li>
		<li><a href="<?php echo home_url(); ?>/user_registrations/">新規会員登録</a></li>
		<li><a href="<?php echo home_url(); ?>/profiel/">プロフィール</a></li>
</ul>
<!--
			<form role="search" method="get" id="searchform" class="searchform" action="<?php home_url(); ?>">
				<label class="screen-reader-text" for="s"><?php _x( 'Search for:', 'label' ); ?></label>
				<input type="text" value="<?php echo get_search_query(); ?>" name="s" id="s" placeholder="就活の気になるワードで検索" />
				<button type="submit" id="searchsubmit" value="<?php echo esc_attr_x( 'Search', 'submit button' ); ?>"></button>
			</form>

-->
<a href="<?php echo home_url(); ?>/gallery/" class="text-gallery"><img src="<?php bloginfo('template_directory'); ?>/images/common/bnr-gallery.jpg" alt="ジョーカツハウスを覗いてみよう ジョーカツギャラリー" /></a>

</nav>

<header id="header">
	<div class="inner wrap-box">
	<h1 id="header-logo">
  <a href="<?php echo home_url(); ?>/">
    <img src="http://xs262245.xsrv.jp/na-tst/wp-content/uploads/2025/07/logo.png" alt="就活HAND BOOK トップ">
  </a>
</h1>

	<div id="header-nav">
		<nav class="wrap-box">

			<a id="nav-item-1" href="https://landing.lineml.jp/r/1656090062-kzGv2zOm?lp=KP7Vxb" class="btn pc-only" data-pc-img="http://xs262245.xsrv.jp/na-tst/wp-content/uploads/2025/07/button.png" data-sp-img="http://xs262245.xsrv.jp/na-tst/wp-content/uploads/2025/07/button.png"><img src="http://xs262245.xsrv.jp/na-tst/wp-content/uploads/2025/07/button.png" alt="ENTRY" /></a>
						<a id="nav-item-2" href="https://landing.lineml.jp/r/1656090062-kzGv2zOm?lp=KP7Vxb" class="btn pc-only"><img src="http://xs262245.xsrv.jp/na-tst/wp-content/uploads/2025/07/button2.png" alt="look" /></a>
			<button type="button" id="panel-btn">
				<span id="panel-btn-icon" class=""></span>
			</button>
		</nav>
	</div>
	</div>
</header>