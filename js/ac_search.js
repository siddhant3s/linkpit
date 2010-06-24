
// Handles AutoComplete Search Input Box

$(function() {
  $("#search").autocomplete({
    source: "search.php?request=matches",
      minLength: 2,
      select: function(event, ui) {
        $("#tag-name").text(ui.item.value);
        $.ajax({
          type: "GET",
          url: "search.php",
          data: "term=" + ui.item.value + "&request=info",
          dataType: "json",
          success: function(data) {
            $("#tag-url").html('<a href="' + data[0] + '">' + data[0] + "</a>");
            $("#tag-hits").html("Number Of Hits <span style='color:red;font-size:200%;'>" + data[1] + "</span>");
          }
        });  
        $("#search-info").dialog('open');   
      }
    })
      .data("autocomplete")._renderItem = function(ul, item) {
        return $("<li></li>")
          .data("item.autocomplete", item)
            .append( "<a>" + 
            item.value.replace(new RegExp("(?![^&;]+;)(?!<[^<>]*)(" 
                        + $('#search').val()  + ")(?![^<>]*>)(?![^&;]+;)", "gi"), 
                        "<u><b>$1</b></u>") + "</a>")  .   appendTo(ul);
      };

    $("#search-info").dialog({
      modal: true,
      autoOpen: false,
      draggable: false,
      minWidth: 600,
      resizable: false,
      width: 600 
    });
});

