$(document).ready(function () {
    // $("p").hide(1000);
    // $("img").fadeOut(1000);
    $("header").click(function () {
        $("img").fadeIn(1000);
        $("p").fadeIn(1000);
    });
    $("img").click(function () {
        // $(this).fadeOut(1000);
        // $(this).animate({ marginLeft: '500px' });
        // $(this).animate({ marginLeft: '0px' });
        // // "img" 대신 this를 넣으면 해당 개체만 적용


        // $(this).animate({ marginLeft: '500px' }).animate({ marginLeft: '0px' });
        // // 위와 같이 연결도 가능
    });
    // $("img").hover(function () {
    //     $(this).animate({ height: '+=100px', width: '+=50px', opacity: 0.5 }, 100); // 마지막의 100은 100ms를 의미. 100ms의 속도로 처리함
    // },
    //     function () {
    //         $(this).animate({ height: '-=100px', width: '-=50px', opacity: 1.0 }, 100);
    //     });
    // hover를 사용할 때에는 마우스가 들어갈때의 함수와 마우스가 나올때의 함수를 따로 지정한다.

    $("p").click(function () {
        // $(this).fadeOut(1000);
        // $(this).empty();     // 내용만 제거
        // $(this).remove();       // 전체 제거

    });
    $("#btn_grade_desc").click(function () {
        $(".grade_desc").slideToggle(1000);
        if ($(this).text() == "표시 안함") {
            $(this).text("표시");
        }
        else {
            $(this).text("표시 안함");
        }
        // $("p").css({ "background-color": "yellow", "padding": "16px" });
        // -> css를 js에서 지정가능
    });
    // $(".grade_desc table").append("<tr><td>PG</td><td>Perfect Grade</td><td>1/60</td></tr>");
    // $(".grade_desc table tr").first().after("<tr><td>PG</td><td>Perfect Grade</td><td>1/60</td></tr>");
    $(".grade_desc table tr").first().after("<tr><td>PG</td><td>Perfect Grade</td><td>1/60</td></tr>");       // 테스트중

    $("h3").click(function () {
        // $(this).parent().empty();
        $(this).siblings().slideToggle();
    });

    // // 15강 추가 내용 : ajax 사용
    // $("#refresh").click(function () {
    //     //$(".model").empty();
    //     $.ajax({
    //         url: "list_review.php",
    //         cache: false,
    //         dataType: "xml",
    //         success: function (xml) {
    //             $(xml).find("review").each(function () {
    //                 var review = '<article class="review">\
    //                 <div class="img_frame">\
    //                 <img class="user_image" src="' +
    //                     $(this).find("user_image").text() + '" alt="Gundam Picture" />';
    //                 review += '<div class="user_memo"><p>' +
    //                     $(this).find("user_memo").text() + '</p></div>';
    //                 review += '<div class="user_info">';
    //                 review += '<img class="user_thumbnail" src="' +
    //                     $(this).children("user_info").find("user_thumbnail").text() + '"alt=User Image"/>';
    //                 review += '<div class="user_email">' +
    //                     $(this).children("user_info").find("user_email").text() + '</div>';
    //                 review += '<div class="user_date">' +
    //                     $(this).children("user_date").text() + '</div>';
    //                 review += '</div></div>';
    //                 review += '<section class="review_reply">';
    //                 review += '</section>';
    //                 review += '</article>';
    //                 $(".model").append(review);
    //             });
    //         },
    //         error: function (xhr, ahaxOptions, thrownError) {
    //             alert(xhr.status);
    //             alert(thrownError)
    //         }
    //     });
    // });

    // 16강 추가 내용 : JSON 사용
    // $("#refresh").click(function () {
    //     alert("test");
    // })
    refresh_review();

    $("#refresh").click(refresh_review);

    function refresh_review() {
        $.getJSON("list_review_json.php", function (json) {
            //alert(json.review.length);
            $(".review").remove();
            $.each(json.review, function () {
                var review = '<article class="review">\
                    <div class="img_frame">\
                        <img class="user_image" src="getpicture.php?reviewid='+
                    this["reviewid"] + '" alt="Gundam Picture" />';
                review += '<div class="user_memo"><p>' + this['memo'] + '</p></div>';
                review += '<div class="user_info">';
                review += '<img class="user_thumbnail" src="userimage.php?email=' +
                    this["email"] + '" alt=User Image"/>';
                review += '<div class="user_email">' + this["email"] + '</div>';
                review += '<div class="user_date">' + this["time"] + '</div>';
                review += '</div></div>';

                review += '<section class="review_reply">';
                review += '<div id="write_reply"><a href="write_reply_form.php?reviewid=' +
                    this["reviewid"] + '">댓글 등록</a></div>';

                if (this.reply) {
                    $.each(this.reply, function () {
                        var reply = '<article class="reply">';
                        reply += '<div class="user_reply"><p>' + this['memo'] + '</p></div>';
                        reply += '<div class="user_info">';
                        reply += '<img class="user_thumbnail" src="userimage.php?email=' +
                            this["email"] + '" alt="User Image"/>';
                        reply += '<div class="user_email">' + this["email"] + '</div>';
                        reply += '<div class="user_date">' + this["time"] + '</div>';
                        reply += '</div></article>';

                        review += reply;
                    });
                }

                review += '</section>';
                review += '</article>';
                $(".model").append(review);
            });
        });
    };
});