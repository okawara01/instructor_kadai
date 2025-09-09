<?php
/**
 * Footer template
 */
?>

 <style>
       /* WordPress用フッタースタイル - レスポンシブ重視 */
        .foot {
            width: 100%;
            max-width: 1920px;
            margin: 0 auto;
            position: relative;
            overflow: hidden;
        }

        .foot .overlap-group {
            position: relative;
            min-height: 600px;
            padding: 65px 0 0;
            background-position: center;
            background-size: cover;
        }

        .foot .bg {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            z-index: 1;
        }

        .foot .image {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            object-fit: cover;
            z-index: 2;
        }

        /* トップボタン */
        .foot .topbutton {
            position: fixed;
            width: 71px;
            height: 71px;
            bottom: 95px;
            right: 40px;
            background: none;
            border: none;
            padding: 0;
            cursor: pointer;
            transition: transform 0.2s ease;
            z-index: 100;
        }

        .foot .topbutton:hover {
            transform: scale(1.05);
        }

        .foot .topbutton:focus {
            outline: 2px solid #4a90e2;
            outline-offset: 2px;
        }

        .foot .topbutton img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        /* コンテンツエリア - flexboxレイアウト */
        .foot .content-area {
            position: relative;
            z-index: 10;
            padding: 40px;
            display: flex;
            flex-direction: column;
            gap: 60px;
            min-height: 500px;
        }

        /* メイン2カラムエリア */
        .foot .footer-content-wrapper {
            display: flex;
            gap: 80px;
            align-items: flex-start;
            justify-content: center;
            flex-wrap: wrap;
        }

        .foot .logo {
            width: 218px;
            height: 57px;
            flex-shrink: 0;
            background-image: url(https://jo-katsu.com/release/wordpress/wp-content/uploads/2025/09/b77f08f22efa23df136c793c5262d805.png);
            background-size: contain;
            background-repeat: no-repeat;
            background-position: center;
            mix-blend-mode: multiply;
        }

        /* ナビゲーション */
        .foot .g {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 40px 60px;
            max-width: 800px;
            width: 100%;
        }

        .foot .nav-item {
            display: flex;
            flex-direction: column;
            gap: 8px;
            min-height: 88px;
        }

        .foot .nav-group {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .foot .text-wrapper-3,
        .foot .text-wrapper-5 {
            font-family: "Noto Sans JP", Helvetica, Arial, sans-serif;
            font-weight: 700;
            color: #000000;
            font-size: 16px;
            letter-spacing: 0.32px;
            line-height: 1.2;
            margin: 0;
        }

        .foot .text-wrapper-4,
        .foot .text-wrapper-6 {
            font-family: "Righteous", Helvetica, Arial, sans-serif !important;
            font-weight: 400;
            color: #e53754;
            font-size: 30px;
            letter-spacing: 0.60px;
            line-height: 1.1;
            margin: 0;
        }

        .foot .text-wrapper-6 {
            font-size: 26px;
            letter-spacing: -0.26px;
        }

        .foot .nav-line {
            width: 100%;
            height: 1px;
            background-color: #ccc;
            margin-top: auto;
        }

        /* フッターメニュー */
        .foot .foot-menu {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
            margin-top: auto;
            padding-top: 40px;
            flex-wrap: wrap;
        }

        .foot .text {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .foot .text-wrapper {
            font-family: "Righteous", Helvetica, Arial, sans-serif !important;
            font-weight: 400;
            color: #ffffff;
            font-size: 12px;
            letter-spacing: 0.24px;
            line-height: 1.2;
            margin: 0;
        }

        .foot .footer-links {
            display: flex;
            gap: 20px;
            margin: 0;
            padding: 0;
            list-style: none;
            flex-wrap: wrap;
        }

        .foot .footer-links a {
            font-family: "Noto Sans JP", Helvetica, Arial, sans-serif;
            font-weight: 700;
            color: #ffffff;
            font-size: 16px;
            letter-spacing: 0.32px;
            line-height: 1.2;
            text-decoration: underline;
            transition: opacity 0.3s ease;
        }

        .foot .footer-links a:hover,
        .foot .footer-links a:focus {
            opacity: 0.8;
            text-decoration: none;
        }

        .foot .sns {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .foot .sns img {
            width: 30px;
            height: 30px;
            object-fit: contain;
        }

        /* レスポンシブデザイン */
        @media screen and (max-width: 1200px) {
            .foot .content-area {
                padding: 30px;
                gap: 40px;
            }

            .foot .footer-content-wrapper {
                gap: 60px;
            }

            .foot .g {
                grid-template-columns: repeat(2, 1fr);
                gap: 30px 40px;
            }

            .foot .topbutton {
                right: 30px;
            }
        }

        @media screen and (max-width: 900px) {
            .foot .content-area {
                padding: 20px;
                gap: 30px;
            }

            .foot .footer-content-wrapper {
                flex-direction: column;
                align-items: center;
                gap: 40px;
            }

            .foot .g {
                grid-template-columns: repeat(2, 1fr);
                gap: 25px 30px;
                max-width: 500px;
            }
        }

        /* スマホサイズでの大幅調整 */
        @media screen and (max-width: 768px) {
            .foot .overlap-group {
                min-height: auto;
                padding: 30px 0 0;
            }

            /* スマホ用背景画像に変更 */
            .foot .image {
                content: url(https://jo-katsu.com/release/wordpress/wp-content/uploads/2025/09/1-1.png);
            }

            .foot .content-area {
                padding: 20px;
                gap: 30px;
                min-height: auto;
            }

            .foot .footer-content-wrapper {
                gap: 30px;
                align-items: center;
            }

            .foot .logo {
                width: 160px;
                height: 42px;
                margin-bottom: 10px;
            }

            /* ナビゲーションを2カラムレイアウトに */
            .foot .g {
                grid-template-columns: repeat(2, 1fr);
                gap: 20px 15px;
                max-width: 100%;
                width: 100%;
            }

            .foot .nav-item {
                min-height: 60px;
                gap: 6px;
            }

            /* フッターメニューのレイアウト調整 */
            .foot .foot-menu {
                flex-direction: column;
                gap: 15px;
                align-items: center;
                text-align: center;
                padding-top: 25px;
            }

            .foot .text {
/*                 order: 1; */
                gap: 8px;
				flex-direction: row;
				justify-content: space-between;
            }

            .foot .footer-links {
                justify-content: center;
                gap: 15px;
				align-items: flex-end;
				flex-direction: row;
            }

            .foot .sns {
                order: 2;
                justify-content: center;
            }

            .foot .topbutton {
                position: fixed;
                bottom: 20px;
                right: 20px;
                z-index: 1000;
                width: 50px;
                height: 50px;
            }

            .foot .text-wrapper-4,
            .foot .text-wrapper-6 {
                font-size: 18px;
                letter-spacing: 0.36px;
            }

            .foot .text-wrapper-3,
            .foot .text-wrapper-5 {
                font-size: 13px;
                letter-spacing: 0.26px;
            }

            .foot .text-wrapper {
                font-size: 10px;
            }

            .foot .footer-links a {
                font-size: 13px;
            }
        }

        @media screen and (max-width: 480px) {
            .foot .content-area {
                padding: 15px;
                gap: 25px;
            }

            .foot .footer-content-wrapper {
                gap: 25px;
            }

            .foot .logo {
                width: 140px;
                height: 37px;
            }

            .foot .g {
                gap: 18px 12px;
                padding: 0 5px;
            }

            .foot .nav-item {
                min-height: 55px;
                gap: 5px;
            }

            .foot .text-wrapper-4,
            .foot .text-wrapper-6 {
                font-size: 16px;
            }

            .foot .text-wrapper-3,
            .foot .text-wrapper-5 {
                font-size: 12px;
            }

            .foot .footer-links {
/*                 flex-direction: column; */
                gap: 8px;
            }

            .foot .footer-links a {
                font-size: 12px;
            }

            .foot .topbutton {
                width: 45px;
                height: 45px;
                bottom: 15px;
                right: 15px;
            }
        }

        /* WordPress固有のスタイル調整 */
        .foot h3 {
            margin: 0;
            font-weight: inherit;
            font-size: inherit;
            font-family: inherit;
            color: inherit;
            line-height: inherit;
            letter-spacing: inherit;
        }

        /* アクセシビリティ改善 */
        .foot [role="presentation"] {
            pointer-events: none;
        }

        .foot button:focus,
        .foot a:focus {
            outline: 2px solid #4a90e2;
            outline-offset: 2px;
        }

        /* 要素が重ならないための追加保護 */
        .foot .nav-item {
            overflow: hidden;
        }

        .foot .nav-group {
            word-wrap: break-word;
            overflow-wrap: break-word;
        }
	 
	 .foot .sp-foot {
	display: none;
}
.foot .pc-foot {
	display: flex;
}

@media screen and (max-width:768px) {
	.foot .sp-foot {
		display: block;
	}
	.foot .pc-foot {
		display: none;
	}
}
	 
	 
	 
    </style>

    <footer class="foot" data-model-id="1:9970">
        <div class="overlap-group">
            <img class="bg" src="https://jo-katsu.com/release/wordpress/wp-content/uploads/2025/09/bg-1.png" alt="Background decoration" />
            <img class="image" src="https://jo-katsu.com/release/wordpress/wp-content/uploads/2025/09/1.png" alt="Footer background image" />
            
            <button class="topbutton" type="button" aria-label="ページトップに戻る" onclick="scrollToTop()">
                <img src="https://jo-katsu.com/release/wordpress/wp-content/uploads/2025/09/57a4fb7d0de40bbd650f52d58a51d523.png" alt="Top button" />
            </button>

            <div class="content-area">
                <div class="footer-content-wrapper">
                    <div class="logo" role="img" aria-label="就活ハンドブック ロゴ"></div>
                    
                    <nav class="g" role="navigation" aria-label="Footer navigation">
                        <div class="nav-item">
                            <div class="nav-group">
                                <div class="text-wrapper-4">New articles</div>
                                <h3 class="text-wrapper-3">新着記事</h3>
                            </div>
                            <div class="nav-line" role="presentation"></div>
                        </div>
                        
                        <div class="nav-item">
                            <div class="nav-group">
                                <div class="text-wrapper-4">Popular articles</div>
                                <h3 class="text-wrapper-3">人気記事</h3>
                            </div>
                            <div class="nav-line" role="presentation"></div>
                        </div>
                        
                        <div class="nav-item">
                            <div class="nav-group">
                                <div class="text-wrapper-4">ES/Experience</div>
                                <h3 class="text-wrapper-3">ES/体験記</h3>
                            </div>
                            <div class="nav-line" role="presentation"></div>
                        </div>
                        
                        <div class="nav-item">
                            <div class="nav-group">
                                <div class="text-wrapper-4">New movies</div>
                                <h3 class="text-wrapper-3">新着ムービー</h3>
                            </div>
                            <div class="nav-line" role="presentation"></div>
                        </div>
                        
                        <div class="nav-item">
                            <div class="nav-group">
                                <div class="text-wrapper-4">Company analysis</div>
                                <h3 class="text-wrapper-3">企業分析</h3>
                            </div>
                            <div class="nav-line" role="presentation"></div>
                        </div>
                        
                        <div class="nav-item">
                            <div class="nav-group">
                                <div class="text-wrapper-4">Self analysis</div>
                                <h3 class="text-wrapper-3">自己分析</h3>
                            </div>
                            <div class="nav-line" role="presentation"></div>
                        </div>
                        
                        <div class="nav-item">
                            <div class="nav-group">
                                <div class="text-wrapper-6">ES interview preparation</div>
                                <h3 class="text-wrapper-5">ES面接対策</h3>
                            </div>
                            <div class="nav-line" role="presentation"></div>
                        </div>
                        
                        <div class="nav-item">
                            <div class="nav-group">
                                <div class="text-wrapper-4">Money</div>
                                <h3 class="text-wrapper-3">お金</h3>
                            </div>
                            <div class="nav-line" role="presentation"></div>
                        </div>
                        
                        <div class="nav-item">
                            <div class="nav-group">
                                <div class="text-wrapper-4">Serialization</div>
                                <h3 class="text-wrapper-3">連載</h3>
                            </div>
                            <div class="nav-line" role="presentation"></div>
                        </div>
                    </nav>
                </div>
                
                <div class="foot-menu pc-foot">
                    <div class="text">
                        <p class="text-wrapper">©Copyright Syukatsu hand book, All rights reserved.</p>
                        <nav class="footer-links">
                            <a href="https://naimono.co.jp/" class="company-link">運営会社</a>
                            <a href="https://jo-katsu.com/policy/" class="privacy-link">個人情報保護方針</a>
                        </nav>
                    </div>
                    
                    <div class="sns">
                        <a href="https://twitter.com/jokatsuinfo" class="company-link" target="_blank" rel="noopener noreferrer"><img src="https://jo-katsu.com/release/wordpress/wp-content/uploads/2025/09/58c13d390245f6efd3e7d8fb1e0828f7-e1756961283448.png" alt="Social media icons" /></a>
                        <a href="https://www.instagram.com/jokatsu_official/" class="company-link" target="_blank" rel="noopener noreferrer"><img src="https://jo-katsu.com/release/wordpress/wp-content/uploads/2025/09/58c13d390245f6efd3e7d8fb1e0828f7-1-e1756961296489.png" alt="Social media icons" /></a>
                    </div>
                </div>
				
			<div class="foot-menu sp-foot">
                    <div class="text">
                        <nav class="footer-links">
                            <a href="https://naimono.co.jp/" class="company-link">運営会社</a>
                            <a href="https://jo-katsu.com/policy/" class="privacy-link">個人情報保護方針</a>
                        </nav>
												 <div class="sns">
                        <a href="https://twitter.com/jokatsuinfo" class="company-link" target="_blank" rel="noopener noreferrer"><img src="https://jo-katsu.com/release/wordpress/wp-content/uploads/2025/09/58c13d390245f6efd3e7d8fb1e0828f7-e1756961283448.png" alt="Social media icons" /></a>
                        <a href="https://www.instagram.com/jokatsu_official/" class="company-link" target="_blank" rel="noopener noreferrer"><img src="https://jo-katsu.com/release/wordpress/wp-content/uploads/2025/09/58c13d390245f6efd3e7d8fb1e0828f7-1-e1756961296489.png" alt="Social media icons" /></a>
                    </div>
                    </div>
                    

                </div>
				 <p class="text-wrapper">©Copyright Syukatsu hand book, All rights reserved.</p>
				
				
            </div>
        </div>
    </footer>

    <script>
        function scrollToTop() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        }

        // ウィンドウリサイズ時の調整
        window.addEventListener('resize', function() {
            // 必要に応じてレイアウト調整処理
        });
    </script>


<script src="<?php bloginfo('template_directory'); ?>/js/jQuery.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/js/slick.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/js/iscroll.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/js/lightcase.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/js/common.js"></script>
<!-- <script src="<?php bloginfo('template_directory'); ?>/js/fitie.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/object-fit-images/3.2.4/ofi.js"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/object-fit-images/3.2.3/ofi.min.js"></script> -->
<script>objectFitImages();</script>
<?php wp_footer(); ?>
</body>
</html>
