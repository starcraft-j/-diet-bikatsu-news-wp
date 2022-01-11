<?php get_header(); 
  $s = $_GET['s'];
  $fPrice = $_GET['first-price'];
  $tPrice = $_GET['teiki-price'];
  $henkkin = $_GET['henkkin'];
  $type = $_GET['type'];
  $osusume = $_GET['osusume'];
  if(isset($_GET['kodawari'])){
    $kodawari = $_GET['kodawari'];
  }
?>

<div id="container">
  <main class="result-box">
    <section id="search-result">

      <?php if(isset($_GET['c_key'])) {
              $sort_key = $_GET['c_key'];
              $sort_order = $_GET['c_o'];
          } else {
              $sort_key = 'search-number';
              $sort_order = 'ASC';
          }

          if($fPrice){
            $metaquerysp[] = array(
              'key'=> 'rank-table_first-price',
              'value'=> $fPrice,
              'type'=>'NUMERIC',
              'compare'=>'<='
            );
          }

          if($tPrice){
            $metaquerysp[] = array(
              'key'=>'rank-table_teiki-price',
              'value'=> $tPrice,
              'type'=>'NUMERIC',
              'compare'=>'<='
            );
          }

          if($henkkin){
            $metaquerysp[] = array(
              'key'=>'search-henkkin',
              'value'=> $henkkin,
              'compare'=>'LIKE'
            );
          }

          if($type){
            $metaquerysp[] = array(
              'key'=>'search-type',
              'value'=> $type,
              'compare'=>'LIKE'
            );
          }

          if($osusume){
            $metaquerysp[] = array(
              'key'=>'search-osusume',
              'value'=> $osusume,
              'compare'=>'LIKE'
            );
          }

          if(is_array($kodawari)){
            foreach($kodawari as $koda){
              $metaquerysp[] = array(
                'key'=>'search-kodawari',
                'value'=> $koda,
                'compare'=>'LIKE',
                );
              }
          }else{
            $metaquerysp[] = array(
              'key'=>'search-kodawari',
              'value'=> $koda,
              'compare'=>'LIKE',
              );
          }

          $metaquerysp['relation'] = 'AND';
          
          $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
          $args = array(
            'meta_query' => array($metaquerysp),
            'posts_per_page' => 5,
            'paged' => $paged,
            'category' => 11,
            // 'category__not_in' => array(10),
            'meta_key' => $sort_key,
            'orderby' => 'meta_value_num',
            'order' => $sort_order,
            );

          $query = new WP_Query($args);
          $total = $query->max_num_pages;
          $get_num = $query->found_posts;
      ?>

      <div class="result-head">

        <div id="result-number"><span><?php echo $get_num; ?></span>件が該当しました。</div>

        <div id="result-sortbox">
          <form id="sort-form" name="dropform">
          <?php if(!is_mobile()) : ?>  
            <span>並び替え:</span>
          <?php endif; ?>
            <select id="ds_sortvalue" name="sortlink" onchange="dropLink()">
              <option value="<?php echo add_query_arg([
                  "c_key" => "search-number",
                  "c_o" => "ASC",
              ]); ?>"
              <?php if (isset($_GET['c_key']) && $_GET['c_key'] == 'search-number' && $_GET['c_o'] == 'DESC') { echo 'selected'; } ?>>おすすめ度</option>
              <option value="<?php echo add_query_arg([
                  "c_key" => "rank-osusume",
                  "c_o" => "DESC",
              ]); ?>"
              <?php if (isset($_GET['c_key']) && $_GET['c_key'] == 'rank-osusume' && $_GET['c_o'] == 'DESC') { echo 'selected'; } ?>>おすすめ度が高い順</option>
              <option value="<?php echo add_query_arg([
                  "c_key" => "rank-osusume",
                  "c_o" => "ASC",
              ]); ?>"
              <?php if (isset($_GET['c_key']) && $_GET['c_key'] == 'rank-osusume' && $_GET['c_o'] == 'ASC') { echo 'selected'; } ?>>おすすめ度が低い順</option>
              <option value="<?php echo add_query_arg([
                  "c_key" => "rank-table_first-price",
                  "c_o" => "ASC",
              ]); ?>"<?php if (isset($_GET['c_key']) && $_GET['c_key'] == 'rank-table_first-price' && $_GET['c_o'] == 'ASC') { echo 'selected'; } ?>>初回価格が安い順</option>
              <option value="<?php echo add_query_arg([
                  "c_key" => "rank-table_first-price",
                  "c_o" => "DESC",
              ]); ?>"<?php if (isset($_GET['c_key']) && $_GET['c_key'] == 'rank-table_first-price' && $_GET['c_o'] == 'DESC') { echo 'selected'; } ?>>初回価格が高い順</option>
               <option value="<?php echo add_query_arg([
                  "c_key" => "rank-table_teiki-price",
                  "c_o" => "ASC",
              ]); ?>"<?php if (isset($_GET['c_key']) && $_GET['c_key'] == 'rank-table_teiki-price' && $_GET['c_o'] == 'ASC') { echo 'selected'; } ?>>定期価格が安い順</option>
              <option value="<?php echo add_query_arg([
                  "c_key" => "rank-table_teiki-price",
                  "c_o" => "DESC",
              ]); ?>"<?php if (isset($_GET['c_key']) && $_GET['c_key'] == 'rank-table_teiki-price' && $_GET['c_o'] == 'DESC') { echo 'selected'; } ?>>定期価格が高い順</option>
            </select>
          </form>
        </div>

      </div>
        <p><?php //if($fPrice){ echo $fPrice; } ?><?php //if($tPrice){ echo $tPrice; } ?></p>
        <?php 
          // if(isset($_GET['kodawari'])){
          //   if(is_array($kodawari)){
          //       foreach($kodawari as $koda){
          //       echo $koda."/";
          //       } 
          //   }else{
          //   echo $kodawari;
          //   }
          // } 
        ?>


      <div id="result-wrap">

        <?php 
          $posts = get_posts($args);
          if($posts) : foreach($posts as $post):
          setup_postdata($post);
          $image_id = get_post_thumbnail_id ();
          $image_url = wp_get_attachment_image_src ($image_id, true);
          
          $url = get_field('url');
          $des = get_field('descript');
          $henkin = get_field('search-henkkin');
          $type = get_field('search-type');
          $kodawaris = get_field('search-kodawari');
          $osusume = get_field('rank-osusume');


          $rankTb = get_field('rank-table');
          $firstP = $rankTb['first-price'];
          $teikiP = $rankTb['teiki-price'];
          
          $home = "https://bikatsu-news.com/";
        ?>

        <!-- start loop -->
        <div class="result-item item-wrap">

          <div class="result-item-name">
            <a href="<?php echo $home.$url; ?>" target="_blank"><?php the_title(); ?></a>
          </div>

          <div class="result-item-content">
            <div class="content-thumb">
              <a href="<?php echo $home.$url; ?>" target="_blank">
                <?php the_post_thumbnail(); ?>
              </a>
            </div>
            <div class="content-descript">
              <!--metaex-->
              <?php //if($post->ID == 80) : ?> 

                <!-- <p>日本で初めて<sup>※2</sup>サプリメントで3つの機能を届け出た機能性表示食品です。</p>
                <p>
                <span class="bold red bg-y">サラシノールが糖の吸収を抑える</span><sup>※1</sup>、<span class="bold red bg-y">サラシノールの継続摂取により腸内環境を整える。</span>さらに、<span class="bold red bg-y">BMIが高めの方のおなかの脂肪・体重を減らす</span><sup>※3</sup><span class="bold ">3つの機能</span>があるサプリメントがメタバリアEXです。
                </p>
                <p>
                <span class="bg-y bold">初回お一人様1回1個限り限定で14日分が540円(税込)</span>とお手頃価格で試せるので、まだ使ったことの無い方はぜひこの機会に試してみましょう。
                </p> -->

              <?php //else : ?>
              <?php echo $des; ?>
              <?php //endif; ?>
            </div>
          </div>
          <?php if($post->ID == 80) : ?> 
            <div class="nmlbox">
              <p>
                <span style="font-size:12px" class="lbg">※1
                  糖の吸収を抑える機能性と、継続摂取により腸内環境を整える(おなかの中のビフィズス菌を増やす)機能性は機能性関与成分サラシノールによる研究レビュー</span><br /><span
                  style="font-size:12px" class="lbg">※2 2019年4月 消費者庁届出情報
                  錠剤型サプリメントの剤形で以下の3つの機能性を届出した機能性表示食品は日本初。当社調べ。</span><br /><span style="font-size:12px" class="lbg">①本品の継続摂取により
                  BMI が高めの方のおなかの脂肪(体脂肪・内臓脂肪)・体重を減らすことで高めの BMI を改善する ②機能性関与成分サラシノールが食事から摂取した糖の吸収を抑える
                  ③機能性関与成分サラシノールの継続摂取により腸内環境を整える(おなかの中のビフィズス菌を増やす)</span><br /><span style="font-size:12px" class="lbg">※3 継続摂取により
                  BMIが高めの方のおなかの脂肪(体脂肪・内臓脂肪)・体重を減らすことで高めのBMIを改善する機能は、最終製品を用いた臨床試験</span></p>
          </div>
          <?php elseif($post->ID == 84) : //メタバリアプレミアムEX ?>
          <div class="nmlbox">
            <p><span style="font-size:12px" class="lbg">※1
                糖の吸収を抑える機能性と、継続摂取による腸内環境を整える（おなかの中のビフィズス菌を増やす）機能性は機能性関与成分サラシノールによる研究レビュー</span><br><span style="font-size:12px"
                class="lbg">※2 脂肪の吸収を抑える機能は最終製品を用いた臨床試験</span><br>
              <span style="font-size:12px" class="lbg">※3
                出典：H/Bフーズマーケティング便覧2021　機能志向食品編（2020.11.24発行）p138サラシア2019年（実績）販売高の合計値　(株)富士経済</span><br>
              <span style="font-size:12px" class="lbg">※4
                継続摂取によりBMいが高めの方のおなかの脂肪（体脂肪・内蔵脂肪・皮下脂肪）・体重・ウエスト周囲径を減らすことで高めのBMIを低下させる機能は、最終製品を用いた臨床試験</span><br>
              <span style="font-size:12px" class="lbg">※5 2019年8月時点の消費者庁届出情報より。以下の4つの機能性を届出した機能性表示食品は日本で初めて。当社調べ。<br>
                ①本品の継続摂取によりBMIが高めの方におなかの脂肪（体脂肪・内蔵皮下脂肪）・体重を減らすことで高めのBMIを低下させる ②本品の摂取により食事から摂取した脂肪の吸収を抑える
                ③機能性関与成分サラシノールが食事から摂取した糖の吸収を抑える ④機能性関与成分サラシノールの継続摂取により腸内環境を整える（おなかの中のビフィズス菌を増やす）
              </span>
            </p>
          </div>
          <?php endif; ?>
          <!-- .result-item-content end -->

          <div class="result-table">

            <?php if(!is_mobile()) : ?>
            <table>
              <tr>
                <th>初回価格</th>
                <th>定期価格</th>
                <th>返金保証</th>
                <th>タイプ</th>
              </tr>
              <tr>
                <td><?php echo number_format($firstP)."円(税込)"; ?></td>
                <td>
                <?php if($teikiP == null) : ?>
                - 
                <?php else : ?>
                <?php echo number_format($teikiP)."円(税込)"; ?>
                <?php endif; ?>
                <td><?php echo $henkin; ?></td>
                <td><?php echo $type; ?></td>
              </tr>
              <tr>
                <th colspan="2">おすすめ度</th>
                <th colspan="2">こだわり条件</th>
              </tr>
              <tr>
                <td colspan="2">
                <?php 
                  if($osusume == "3.0") {
                    echo "<img src='".$home."./img/review_3.gif' />";
                  } elseif($osusume == "3.5") {
                    echo "<img src='".$home."./img/review_35.gif' />";
                  } elseif($osusume == "4.0") {
                    echo "<img src='".$home."./img/review_4.gif' />";
                  } elseif($osusume == "4.5") {
                    echo "<img src='".$home."./img/review_45.gif' />";
                  } else {
                    echo "<img src='".$home."./img/review_5.gif' />";
                  }
                ?>
                </td>
                <td colspan="2">
                  <?php 
                    if(is_array($kodawaris)){
                        foreach($kodawaris as $koda){
                        echo $koda."/";
                        } 
                    }else{
                    echo $kodawaris;
                    }
                  ?>
                </td>
              </tr>
            </table>
            <?php else : ?>
            <table>
              <tr>
                <th>初回価格</th>
                <td><?php echo number_format($firstP)."円(税込)"; ?></td>
              </tr>
              <tr>
                <th>定期価格</th>
                <td>
                <?php if($teikiP == null) : ?>
                - 
                <?php else : ?>
                <?php echo number_format($teikiP)."円(税込)"; ?>
                <?php endif; ?>
                </td>
              </tr>
              <tr>
                <th>返金保証</th>
                <td><?php echo $henkin; ?></td>
              </tr>
              <tr>
                <th>タイプ</th>
                <td><?php echo $type; ?></td>
              </tr>
              <tr>
                <th>おすすめ度</th>
                <td>
                <?php 
                  if($osusume == "3.0") {
                    echo "<img src='".$home."./img/review_3.gif' />";
                  } elseif($osusume == "3.5") {
                    echo "<img src='".$home."./img/review_35.gif' />";
                  } elseif($osusume == "4.0") {
                    echo "<img src='".$home."./img/review_4.gif' />";
                  } elseif($osusume == "4.5") {
                    echo "<img src='".$home."./img/review_45.gif' />";
                  } else {
                    echo "<img src='".$home."./img/review_5.gif' />";
                  }
                ?>
                </td>
              </tr>
              <tr>
                <th>こだわり条件</th>
                <td>
                  <?php 
                    if(is_array($kodawaris)){
                        foreach($kodawaris as $koda){
                        echo $koda."/";
                        } 
                    }else{
                    echo $kodawaris;
                    }
                  ?>
                </td>
              </tr>
            </table>
            <?php endif; ?>

          </div>
          <!-- .result-table end -->

          <div class="result-button">
            <div class="detail-btn">
              <a href="<?php echo $home.$url; ?>" class="btn-link" target="_blank">詳細を見る</a>
            </div>
            <div class="re-btn">
              <a href="<?php echo $home.$url; ?>" class="btn-link" target="_blank">公式サイトはこちら</a>
            </div>
          </div>

          <div class="line">
        
        </div>
        <!-- end loop -->


      </div>
      <?php endforeach; endif; wp_reset_query(); ?>

      <!-- #result-wrap end -->


      <?php
      $args = array(
          'base' => get_pagenum_link(1) . '%_%',
          'mid_size' => -1,
          'prev_text' => '<i class="fas fa-chevron-left"></i>',
          'next_text' => '<i class="fas fa-chevron-right"></i>',
          'screen_reader_text' => ' ',
          'total' => $total,
      );
      the_posts_pagination($args);
      ?>

      <?php get_search_form(); ?>

      <div id="result-topbtn">
        <a href="#search-result" class="result-top-link">
          検索結果トップに戻る
        </a>
      </div>

      
    </section>
    <!-- #search-result end -->

  </main>
  <aside id="side-box">
    <nav>
      <h4><span>タイプ別人気ランキング</span></h4>
      <div class="side-list-box">
        <ul class="list">
            <li><a href="<?php echo $home; ?>ninki.php">ダイエタリーライフサポートサプリ人気ランキング</a></li>
            <li><a href="<?php echo $home; ?>nenshou.php">脂肪対策サプリ人気ランキング</a></li>
            <li><a href="<?php echo $home; ?>flora.php">体内フローラサプリ人気ランキング</a></li>
            <li><a href="<?php echo $home; ?>sugarcare.php">糖質ケアサプリ人気ランキング</a></li>
            <li><a href="<?php echo $home; ?>kousodrink.php">酵素ドリンク人気ランキング</a></li>
            <li><a href="<?php echo $home; ?>kousosupp.php">生酵素サプリ人気ランキング</a></li>
            <li><a href="<?php echo $home; ?>smoothie.php">ダイエットスムージー人気ランキング</a></li>
            <li><a href="<?php echo $home; ?>boufutushousan.php">防風通聖散おすすめ３選</a></li>
            <li><a href="<?php echo $home; ?>uneisha.php">運営者情報</a></li>
        </ul>
      </div>
    </nav>
  </aside>
</div>

<?php get_footer(); ?>


<script>
function dropLink() {
  const sortUrl = document.dropform.sortlink.value;
  location.href = sortUrl;
  console.log(sortUrl);

}
</script>

