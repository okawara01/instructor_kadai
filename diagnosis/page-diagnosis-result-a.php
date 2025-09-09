<?php
/* Template Name: Diagnosis Result – A */
add_filter('body_class', function($classes){
  $classes[] = 'page-template-page-diagnosis-result-a';
  return $classes;
});
get_header();
?>
<script>
(function(){
  function setHeaderH(){
    var h = document.getElementById('header') || document.querySelector('.site-header, .l-header');
    if(!h) return;
    var px = Math.round(h.getBoundingClientRect().height);
    document.documentElement.style.setProperty('--header-h', px + 'px');
  }
  setHeaderH();
  window.addEventListener('load', setHeaderH);
  window.addEventListener('resize', setHeaderH);
  let t; window.addEventListener('scroll', function(){ clearTimeout(t); t=setTimeout(setHeaderH, 50); });
})();
</script>


<div class="page-frame">   
<main class="diag diag--a">
  <div class="diag__inner">

    <!-- 左：結果カード -->
 <aside class="diag__aside">
    <div class="circles">
    <i class="bg bg--lg"></i>   
    <i class="bg bg--sm"></i>   
    <i class="bg bg--md"></i>   
  </div>

  <div class="card result-card">
    <div class="result-hero">
      <p class="result-hero__chip">
        <span>ビジネスマナー診断</span>
        <small>あなたの“信頼感レベル”は〇％？</small>
      </p>
      <p class="result-hero__eyebrow">あなたの信頼感レベルは</p>
      <p class="result-hero__type">Aタイプ</p>
      <p class="result-hero__score"><span class="font-num">信頼度 90〜100%</span></p>
    </div>

    <!-- 目次 -->
    <div class="card__panel">
     <ol class="card__toc">
      <li><a href="#sec1"><span class="n">1</span>タイプの概要</a></li>
      <li><a href="#sec2"><span class="n">2</span>あなたの強み</a></li>
      <li><a href="#sec3"><span class="n">3</span>実はここが惜しい！気づかれにくい盲点</a></li>
      <li><a href="#sec4"><span class="n">4</span>このタイプに合うマナーの活かし方</a></li>
      <li><a href="#sec5"><span class="n">5</span>誤解されないために気をつけたいこと</a></li>
      <li><a href="#sec6"><span class="n">6</span>社会人として“信頼感”をもっと高めるには</a></li>
      <li><a href="#sec7"><span class="n">7</span>まとめ</a></li>
     </ol>

    <!-- カード内ボタン 2つ -->
    <div class="card__actions">
      <a class="btn btn--ghost" href="<?php echo esc_url( home_url('/diagnosis/') ); ?>">診断TOPへもどる</a>
      <a class="btn btn--solid" href="<?php echo esc_url( home_url('/contact/') ); ?>">結果をメールで送る</a>
    </div>
   </div>
  </div>
</aside>

    <!-- 右：本文 -->
<article class="diag__content">
  <header class="diag__hero">
    <h1 class="diag__title">“一緒に働きたい人”として選ばれる<br>マナーの達人</h1>
  </header>

  <!-- 01 -->
  <section id="sec1" class="diag-sec">
    <h2 class="diag-sec__title">
      <span class="num">1</span>
      <div class="sub-title">
      <span class="txt">タイプの概要</span>
      <span class="pill">この%の人はどんな印象を持たれがち？</span>
      </div>
    </h2>
    <p class="diag-sec__lead">
      このレベルのあなたは、まさに“信頼できる人”の代表格。第一印象で「ちゃんとしている」「安心して任せられそう」と思われることが多く、礼儀や配慮が自然にできているため、周囲からの評価も非常に安定しています。相手の立場に立った行動が身についており、ビジネスの場でも空気を読みながら適切な距離感を保てるため、「社会人としての基本がしっかりしている」と見られます。
    </p>
    <ul class="checklist">
      <li>「この人となら一緒に働きたい」と思われやすい</li>
      <li>人に不快感を与える言動が少ない</li>
      <li>きちんとした対応が“デフォルト”になっている</li>
    </ul>
  </section>

  <!-- 02 -->
  <section id="sec2" class="diag-sec">
    <h2 class="diag-sec__title">
      <span class="num">2</span>
      <div class="sub-title">
      <span class="txt">あなたの強み</span>
      <span class="pill">職場で信頼される理由とは</span>
      </div>
    </h2>
    <p class="diag-sec__lead">
      あなたが高い信頼を得られるのは、言動の「安定感」と「安心感」。あいさつ、報連相、言葉遣い、時間感覚、身だしなみ──いずれも水準以上のレベルで安定しており、相手に余計な不安を与えません。「きっと丁寧に対応してくれる」「ちゃんと考えている人だろう」という無言の信用を勝ち取っているのがこのタイプの大きな特徴です。
    </p>
    <ul class="checklist">
      <li>礼儀やマナーが自然にできている</li>
      <li>信頼が「実績」ではなく「態度」で積み上がっている</li>
      <li>周囲を安心させる“静かな信頼力”がある</li>
    </ul>
  </section>

  <!-- 03 -->
  <section id="sec3" class="diag-sec">
    <h2 class="diag-sec__title">
      <span class="num">3</span>
      <div class="sub-title">
      <span class="txt">実はここが惜しい！気づかれにくい盲点</span>
      </div>
    </h2>
    <p class="diag-sec__lead">
      丁寧すぎるがゆえに、必要以上に遠慮してしまったり、「もっと自己主張してもいいのに」と思われる場面もあるかもしれません。高いマナー意識が“距離感のある人”として受け取られてしまうこともあり、時には「本音が見えにくい」「冷たい印象」と映ることも。自分では“相手を尊重している”つもりでも、相手がそれを「壁」と感じることもあるので注意が必要です。
    </p>
    <ul class="checklist">
      <li>丁寧さが「距離」と誤解されやすい</li>
      <li>遠慮が自己主張の弱さと捉えられることも</li>
      <li>本心を見せる場面が少なくなりがち</li>
    </ul>
  </section>

  <!-- 04 -->
  <section id="sec4" class="diag-sec">
    <h2 class="diag-sec__title">
      <span class="num">4</span>
      <div class="sub-title">
      <span class="txt">このタイプに合うマナーの活かし方</span>
      </div>
    </h2>
    <p class="diag-sec__lead">
      あなたの高いマナー力は、職場全体の空気を引き締め、安心感を生み出す重要な資産です。だからこそ、形式にとらわれすぎず「場の雰囲気に合わせた柔軟さ」も意識すると、さらに魅力が高まります。時にはユーモアや雑談を交えて“人間味”を出すことで、親しみやすさが加わり、信頼感と好感度がセットでアップします。
    </p>
    <ul class="checklist">
      <li>丁寧さ＋柔らかさ＝最高の信頼感</li>
      <li>雑談や軽いノリを加えるだけで印象が激変</li>
      <li>「話しやすさ」を意識するだけで周囲がもっと近づく</li>
    </ul>
  </section>

  <!-- 05 -->
  <section id="sec5" class="diag-sec">
    <h2 class="diag-sec__title">
      <span class="num">5</span>
      <div class="sub-title">
      <span class="txt">誤解されないために気をつけたいこと</span>
      </div>
    </h2>
    <p class="diag-sec__lead">
      マナーができている人ほど「完璧な人」「隙がない人」と思われがちです。だからこそ、自分が意図していなくても「冷たい」「よそよそしい」といった印象を与えてしまう危険も。特に年下や後輩には、あえて柔らかい声掛けやリアクションを心がけることで、壁をなくすことができます。「安心＋親しみ」で信頼感が本物になります。
    </p>
    <ul class="checklist">
      <li>完璧さが“近寄りがたさ”につながることもある</li>
      <li>後輩や部下には意識して親しみを持たせる対応を</li>
      <li>少し砕けた言葉や表情も大事なコミュニケーション</li>
    </ul>
  </section>

  <!-- 06 -->
  <section id="sec6" class="diag-sec">
    <h2 class="diag-sec__title">
      <span class="num">6</span>
      <div class="sub-title">
      <span class="txt">社会人として“信頼感”をもっと高めるには</span>
      </div>
    </h2>
    <p class="diag-sec__lead">
      すでに高い信頼感を持つあなたですが、「自分の言葉で語る」ことができると、さらに信頼の質が変わってきます。たとえばプレゼンやミーティングでも、「自分はこう考えています」と意見を述べられると、単なる丁寧な人から「考えも行動も誠実な人」へと印象が進化します。安心感＋思考力が加わることで、“チームに不可欠な存在”として活躍できるようになるでしょう。
    </p>
    <ul class="checklist">
      <li>発言力＝信頼をさらに強化する武器になる</li>
      <li>マナー＋自信＝リーダー候補としての評価へ</li>
      <li>丁寧な人から「信頼される人物像」へステージアップ</li>
    </ul>
  </section>

  <!-- 07 -->
  <section id="sec7" class="diag-sec">
    <h2 class="diag-sec__title">
      <span class="num">7</span>
      <div class="sub-title">
      <span class="txt">まとめ</span>
      <span class="pill">このタイプのあなたが築ける未来像</span>
      </div>
    </h2>
    <p class="diag-sec__lead">
      あなたはすでに、どの職場でも「信頼される人材」として貴重な存在です。丁寧で配慮ある姿勢は、社会人としての信用を何倍にも高めてくれます。今後は、そこに「あなた自身の言葉」「あなたらしい振る舞い」を加えていくことで、組織の中でもリーダー的なポジションを自然と任されていくはずです。“礼儀と安心”を武器に、あなたらしいキャリアを築いていってください。
    </p>
  </section>

  <footer class="diag__footer">
    <a class="btn btn--ghost" href="<?php echo esc_url( home_url('/diagnosis/') ); ?>">診断TOPへもどる</a>
    <a class="btn btn--solid" href="<?php echo esc_url( home_url('/contact/') ); ?>">結果をメールで送る</a>
  </footer>
 </article>

  </div>
</main>
</div>                     <!-- ← 追加：ここで閉じる -->
<?php get_footer(); ?>