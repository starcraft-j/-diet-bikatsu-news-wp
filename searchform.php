<link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() ); ?>/form.css?<?php echo time(); ?>">

<section id="searchform">
  <div class="searchform-title">
    <h2>アイテム検索</h2>
    <span class="ds_reset">
      <a href="javascript:void(0);" onclick="formReset();">リセット</a>
    </span>
  </div>

  <form role="search" method="get" name="search_place" class="search-box" action="<?php echo home_url( '/' ); ?>">
    <input type="hidden" name="s" class="s" />
    <input type="hidden" name="search-number" class="ranksort">

    <div class="flex-box">

      <div class="search-item item-01">
        <div class="item-title">
          <label for="">初回価格</label>
        </div>
        <div class="item-select">
          <select name="first-price" class="select-con select-con1">
          <option value="">指定なし</option>
          <option value="2000">～2000円</option>
          <option value="2500">2000～2500円</option>
          <option value="5000">2500～5000円</option>
          <option value="7000">5000～7000円</option>
          </select>
        </div>
      </div>

      <div class="search-item item-02">
        <div class="item-title">
          <label for="">定期価格</label>
        </div>
        <div class="item-select">
          <select name="teiki-price" class="select-con select-con2">
          <option value="">指定なし</option>
          <option value="1500">～1500円</option>
          <option value="3000">1500～3000円</option>
          <option value="9000">3000～9000円</option>
          <option value="12000">9000～12000円</option>
          </select>
        </div>
      </div>

      <div class="search-item item-03">
        <div class="item-title">
          <label for="">返金保証</label>
        </div>
        <div class="item-select">
          <select name="henkkin" class="select-con select-con3">
          <option value="">指定なし</option>
          <option value="初回全額返金保証">初回全額返金保証</option>
          <option value="30日間返金保証付き">30日間返金保証付き</option>
          <option value="なし">なし</option>
          </select>
        </div>
      </div>

      <div class="search-item item-04">
        <div class="item-title">
          <label for="">タイプ</label>
        </div>
        <div class="item-select">
          <select name="type" class="select-con select-con4">
          <option value="">指定なし</option>
          <option value="機能性表示食品">機能性表示食品</option>
          <option value="体内フローラサポートサプリ">体内フローラサポートサプリ</option>
          <option value="酵素サプリ">酵素サプリ</option>
          <option value="酵素ドリンク">酵素ドリンク</option>
          <option value="スムージー">スムージー</option>
          </select>      
        </div>
      </div>

      <div class="search-item item-05">
        <div class="item-title">
          <label for="">性別</label>
        </div>
        <div class="item-select">
          <select name="sex" class="select-con select-con5">
          <option value="">指定なし</option>
          <option value="">女性</option>
          <option value="">男性</option>
          </select>      
        </div>
      </div>

      <div class="search-item item-06">
        <div class="item-title">
          <label for="">おすすめ度</label>
        </div>
        <div class="item-select">
          <select name="osusume" class="select-con select-con6">
          <option value="">指定なし</option>
          <option value="4.0以上">4.0以上</option>
          <option value="3.0~3.9">3.0~3.9</option>
          <option value="2.9以下">2.9以下</option>
          </select>      
        </div>
      </div>
    </div>

    
    <div id="kodawari-box">
      <h2>こだわり条件</h2>
      <div class="kodawari-item search-item">
        <div class="item-title">
          <label>こだわり条件</label>
        </div>
        <div class="item-select">
          <label><input type="checkbox" name="kodawari[]" value="お腹の脂肪を減らす" class="check-con check-con1"><span>お腹の脂肪を減らす</span></label>
          <label><input type="checkbox" name="kodawari[]" value="体重を減らす" class="check-con check-con2"><span>体重を減らす</span></label>
          <label><input type="checkbox" name="kodawari[]" value="ウエスト周囲径を減らす" class="check-con check-con3"><span>ウエスト周囲径を減らす</span></label>
          <label><input type="checkbox" name="kodawari[]" value="糖の吸収を抑える" class="check-con check-con4"><span>糖の吸収を抑える</span></label>
          <label><input type="checkbox" name="kodawari[]" value="脂肪の吸収を抑える" class="check-con check-con5"><span>脂肪の吸収を抑える</span></label>
          <label><input type="checkbox" name="kodawari[]" value="体温を上げる" class="check-con check-con6"><span>体温を上げる</span></label>
          <label><input type="checkbox" name="kodawari[]" value="体内環境を整える" class="check-con check-con7"><span>体内環境を整える</span></label>
          <label><input type="checkbox" name="kodawari[]" value="空腹感を和らげる" class="check-con check-con8"><span>空腹感を和らげる</span></label>
          <label><input type="checkbox" name="kodawari[]" value="ファスティング・置き換えに最適" class="check-con check-con9"><span>ファスティング・置き換えに最適</span></label>
          <label><input type="checkbox" name="kodawari[]" value="葛の花イソフラボン配合" class="check-con check-con10"><span>葛の花イソフラボン配合</span></label>
          <label><input type="checkbox" name="kodawari[]" value="サラシノール配合" class="check-con check-con11"><span>サラシノール配合</span></label>
          <label><input type="checkbox" name="kodawari[]" value="エラグ酸配合" class="check-con check-con12"><span>エラグ酸配合</span></label>
          <label><input type="checkbox" name="kodawari[]" value="ポリメトキシフラボン配合" class="check-con check-con13"><span>ポリメトキシフラボン配合</span></label>
          <label><input type="checkbox" name="kodawari[]" value="ターミナリアベリリカ配合" class="check-con check-con14"><span>ターミナリアベリリカ配合</span></label>
          <label><input type="checkbox" name="kodawari[]" value="難消化性デキストリン配合" class="check-con check-con15"><span>難消化性デキストリン配合</span></label>
          <label><input type="checkbox" name="kodawari[]" value="ナリンジン配合" class="check-con check-con16"><span>ナリンジン配合</span></label>
          <label><input type="checkbox" name="kodawari[]" value="コンブチャ配合" class="check-con check-con17"><span>コンブチャ配合</span></label>
          <label><input type="checkbox" name="kodawari[]" value="グルコマンナン配合" class="check-con check-con18"><span>グルコマンナン配合</span></label>
          <label><input type="checkbox" name="kodawari[]" value="短鎖脂肪酸or酪酸菌配合" class="check-con check-con19"><span>短鎖脂肪酸 or 酪酸菌配合</span></label>
          <label><input type="checkbox" name="kodawari[]" value="SNSで話題" class="check-con check-con20"><span>SNSで話題</span></label>
          <label><input type="checkbox" name="kodawari[]" value="芸能人愛用" class="check-con check-con21"><span>芸能人愛用</span></label>
          <label><input type="checkbox" name="kodawari[]" value="初回限定価格あり" class="check-con check-con22"><span>初回限定価格あり</span></label>
          <label><input type="checkbox" name="kodawari[]" value="定期コース割引あり" class="check-con check-con23"><span>定期コース割引あり</span></label>
          <label><input type="checkbox" name="kodawari[]" value="送料無料" class="check-con check-con24"><span>送料無料</span></label>
        </div>
      </div>
    </div>

    <div id="open-button">
      <span class="open_text"><span class="opne_icon">+ </span>こだわり条件を表示する</span>
    </div>

    <div id="search-button">
      <button type="submit">この条件で検索</button>
    </div>
  </form>
</section>

<script>
  function formReset() {
    document.search_place.reset();
  }

  const openBtn = document.querySelector("#open-button");
  const openTxt = openBtn.querySelector(".open_text");
  const kodaBox = document.querySelector("#kodawari-box");
  function openkoda() {
    console.log("open");
    if(kodaBox.classList.contains('open')) {
      openTxt.innerHTML = `
      <span class="open_text"><span class="opne_icon">+ </span>こだわり条件を表示する</span>
      `;
      kodaBox.classList.remove("open");      
    } else {
      openTxt.innerHTML = `
      <span class="open_text"><span class="opne_icon">- </span>こだわり条件を非表示にする</span>
      `;
      kodaBox.classList.add("open");      
    }
    
  }
  openBtn.addEventListener("click", openkoda);

 
</script>