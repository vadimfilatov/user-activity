$(document).ready(function () {
    let $userIds = $("[name='userIds']");
    let $action = $("[name='actions']");
    let $date = $("#datepicker");

    $userIds.select2();
    $action.select2();

    $(".page-link").click(function () {
        let params = getParams();
        params.p = this.dataset.page;
        location.href = "/statistic?" + $.param(params);
    });

    $("#search").click(function () {
        location.href = "/statistic?" + decodeURIComponent($.param(getParams()));
    })

    $date.datepicker({
        format: "yyyy-mm-dd"
    });

    function getParams()
    {
        let params = {};

        if($userIds.val()) {
            params.userIds = $userIds.val();
        }

        if($action.val()) {
            params.actions = $action.val();
        }

        if($date.val()) {
            params.date_from = $date.val();
            params.date_to = $date.val();
        }

        return params;
    }
});