function getCookie(name) {
  var matches = document.cookie.match(new RegExp("(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"));
  return matches
    ? decodeURIComponent(matches[1])
    : undefined;
}

$("#sendparse").click(function() {
  var price = $("input[name='price']").val();
  var motor = $("#motor").val();
  var fuel = $("#fuel").val();
  var age = $("#age").val();
  $("#preloader").css("display", "block");

  $.ajax({
    type: "GET",
    url: "../parse/parse.php?price=" + price + "&power=80&fuel=" + fuel + "&motor=" + motor + "&age=" + age,
    success: function(data) {
      var price1 = $(".price_total b").text().replace("$", "")
      price1 = price1.replace(",", "")
      var price2 = $($.parseHTML(data)).find("ul li:first-child strong").text().replace("$", "")
      price2 = price2.replace(".", "")
      var tax = $($.parseHTML(data)).find("ul li:nth-child(8) strong").text().replace("$", "")
      price2 = price2.replace(".", "")
      var cost = + price1 + + price2 - + price + + tax;
      var miniPrice;
      if (cost < 8000) {
        miniPrice = 500
      } else if (8000 <= cost && cost < 15000) {
        miniPrice = 1000
      } else if (15000 <= cost && cost < 30000) {
        miniPrice = 1500
      } else if (30000 <= cost && cost < 50000) {
        miniPrice = 2000
      } else if (50000 <= cost && cost < 75000) {
        miniPrice = 3000
      } else if (75000 <= cost && cost < 100000) {
        miniPrice = 4000
      } else if (100000 <= cost && cost < 200000) {
        miniPrice = 5000
      } else if (200000 <= cost) {
        miniPrice = 6000
      }
      $("#js-services").text(+ miniPrice);
      $("#js-tax").text(+ tax);
      $("#insurance").text(getCookie("insurance"));
      $("#iaa").text(getCookie("iaa"));
      $("#js-price").text(+ price);
      $("#customs-clearance").text(+price2 - +price);
      $(".total_price div strong").text(+ cost + + miniPrice);
      $("#preloader").css("display", "none");
      $(".list-price").css("display", "block");

      $("#type-auction").text($("#calc_data1_select option:selected").text())
      $("#js-location").text($("#calc_data2_select option:selected").text())
      $("#port").text($(".custom-select.exit_port.form-control option:selected").text())
      $("#type-auto").text($(".form-control.price_selects option:selected").text())
      $("#js-subcountry").text($(".custom-select.subcountry.form-control option:selected").text())
      $("#type-motor").text($("#motor option:selected").text())
        $("#type-fuel").text($("#fuel option:selected").text())
        $("#type-age").text($("#age option:selected").text())
    }
  })
});

$("#print").click(function(){
  window.print();
});
