/**
 * selector1に該当するタブを表示する関数
 */
const showTab1 = (selector1) => {

    /* 1. タブの選択状態のリセット */

    // いったん、すべての.tabs-menu > liからactiveクラスを削除する
    $('.tabs-menu > li').removeClass('active');

    // いったん、すべての.tabs-content > sectionを非表示にする
    $('.tabs-content > section').hide();

    /* 2. 選択されたタブの表示 */

    // .tabs-menu liのうち、selectorに該当するものにだけactiveクラスを付ける
    $(`.tabs-menu a[href="${selector1}"]`)
        .parent('li')
        .addClass('active');

    // .tabs-content > sectionのうち、selectorに該当するものだけを表示する
    $(selector1).show();
};

// タブがクリックされたらコンテンツを表示
$('.tabs-menu a').on('click', (e) => {
    // hrefへのページ遷移を止める
    e.preventDefault();

    // hrefの値を受け取った後、showTab()関数に渡す。e.targetはクリックされたタブ（.tabs-menu a）を表す
    const selector1 = $(e.target).attr('href');
    showTab1(selector1);
});

// 初期状態として1番目のタブを表示
showTab1('#followings');



/**
 * selector2に該当するタブを表示する関数
 */
const showTab2 = (hashCut) => {

    /* 1. タブの選択状態のリセット */

    // いったん、すべての.tabs-menu > liからactiveクラスを削除する
    $('.tabs-menu > li').removeClass('active');

    // いったん、すべての.tabs-content > sectionを非表示にする
    $('.tabs-content > section').hide();

    /* 2. 選択されたタブの表示 */

    // .tabs-menu liのうち、hashCutに該当するものにだけactiveクラスを付ける
    $(`.tabs-menu a[href="${hashCut}"]`)
        .parent('li')
        .addClass('active');

    // .tabs-content > sectionのうち、hashCutに該当するものだけを表示する
    $(hashCut).show();
};

// アイコンがクリックされたらコンテンツを表示
$('.followings_followers a').on('click', (e) => {

    const followings_li = document.getElementsByClassName('followings_li');

    if ($('.tabs-menu > li').hasClass('followings_li')) {
        $(followings_li).removeClass('active');

        // hrefの値を受け取った後、showTab()関数に渡す。e.targetはクリックされたアイコン（.followings_followers a）を表す
        const selector2 = $(e.target).attr('href');
        console.log(selector2);
        let cut = selector2.substr(selector2.indexOf('#') + 1);
        let hashCut = '#' + cut;

        showTab2(hashCut);
    }
});

// 初期状態としてhashCutのタブを表示
