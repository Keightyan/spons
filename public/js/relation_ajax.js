// フォローボタンがクリックされたら
function toggleRelation(followed_id) {
    // 押されたボタンを特定
    let user = $(".user-" + followed_id)

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    let path;
    let data;
    if ($(user).data('is-follow') === true) {
        // アンフォロー
        path = "/unfollow"
        data = {
            _method: "delete"
        }
    } else {
        // フォロー
        path = "/follow"
    }
    $.ajax({
        url: "/user/" + followed_id + path,
        type: "POST",
        data: data,
        dataType: 'json',
        complete: function (res) {
            console.log(res)
            if (res.status === 200) {
                // フォローの背景色を入れ替える
                $(user).find('button').attr('class', res.responseText === "followed" ? "absolute right-0 border border-solid border-spons_blue p-2 mb-10 rounded font-bold text-xl bg-spons_blue text-white" : "absolute right-0 border border-solid border-spons_blue p-2 mb-10 rounded font-bold text-xl bg-white text-spons_blue");
                // フォロー／フォロー中の切り替え
                if(res.responseText === "followed") {
                    $(user).find('span').text('フォロー中');
                } else {
                    $(user).find('span').text('フォロー');
                }
                // data-is_followを入れ替える
                $(user).data('is-follow', res.responseText === "followed" ? true : false);
            }
        }
    })
}