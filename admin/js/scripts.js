$(document).ready(function () {
  var user_href;
  var user_href_splitted;
  var user_id;
  var image_src;
  var image_src_split;
  var image_name;
  var photo_id;
  $(".modal_thumbnails").click(function () {
    $("#set_user_image").prop("disabled", false);
    $(this).addClass("selected");
    //GETTING USER ID
    user_href = $("#user_id").prop("href");
    user_href_splitted = user_href.split("=");
    //This will get the last item after splitting the = so the next will be the id
    user_id = user_href_splitted[user_href_splitted.length - 1];

    // GETTING IMAGE NAME
    image_src = $(this).prop("src");
    image_src_split = image_src.split("/");
    image_name = image_src_split[image_src_split.length - 1];

    photo_id = $(this).attr("data");

    $.ajax({
      url: "includes/ajax_code.php",
      data: { photo_id: photo_id },
      type: "POST",
      success: function (data) {
        if (!data.error) {
          //alert(data);
          //$(".user_image_update a img").prop("src", data);
          $("#modal_sidebar").html(data);
        }
      },
    });

    //alert(image_name);
  });

  $("#set_user_image").click(function () {
    $.ajax({
      url: "includes/ajax_code.php",
      data: { image_name: image_name, user_id: user_id },
      type: "POST",
      success: function (data) {
        if (!data.error) {
          //alert(data);
          $(".user_image_update a img").prop("src", data);
        }
      },
    });
  });

  tinymce.init({ selector: "textarea" });
});
