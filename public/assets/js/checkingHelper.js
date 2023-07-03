$(".inputFile").change(function (e) {
    var name = e.target.name;
    // console.log(name);
    if ($(this).val() == "tidak") {
        $("#" + name +"File").removeAttr("hidden");
    }
    else $("#" + name +"File").attr("hidden", true);
 });

 $(document).ready(function () {
    var currentPage = 1;
    var totalPage = $(".page").length;
    // console.log(totalPage);

    $("#btnNext").click(function () {
        if (currentPage < totalPage) {
            currentPage++;
            // console.log(currentPage);
            $(".page").attr("hidden", true);
            $("#page" + currentPage).removeAttr("hidden");
            $("#btnPrev").removeAttr("hidden");
            setTimeout(function () { 
                $(document).scrollTop(0);
            }, 100);

            if (currentPage == totalPage) {
                $("#btnNext").attr("hidden", true);
                $("#btnProcess").removeAttr("hidden");
            }
        }
    });

    $("#btnPrev").click(function () {
        if (currentPage > 1) {
            currentPage--;
            $(".page").attr("hidden", true);
            $("#page" + currentPage).removeAttr("hidden");
            $("#btnNext").removeAttr("hidden");
            $("#btnProcess").attr("hidden", true);
            setTimeout(function () { 
                $(document).scrollTop(0);
            }, 100);

            if (currentPage == 1) {
                $("#btnPrev").attr("hidden", true);
            }
        }
    });
 });