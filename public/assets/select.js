$(document).ready(function () {
    let csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;
    function fetchYears() {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            url: "/select/fetchYears",
            type: "post",
            data: {
                car_id: $('select[name="cars"]').val(),
                type: "years",
            },
            success: function (e) {
                $('select[name="years"]').empty();
                $('select[name="years"]').append(e);
                fetchModels();
            },
        });
    }

    function fetchModels() {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            url: "/select/fetchModels",
            type: "post",
            data: {
                car_id: $('select[name="cars"]').val(),
                year: $('select[name="years"]').val(),
                type: "model",
            },
            success: function (e) {
                $('select[name="model"]').empty();
                $('select[name="model"]').append(e);
                fetchType();
            },
        });
    }

    function fetchType() {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            url: "/select/fetchType",
            type: "post",
            data: {
                car_id: $('select[name="cars"]').val(),
                year: $('select[name="years"]').val(),
                model: $('select[name="model"]').val(),
                type: "type",
            },
            success: function (e) {
                $('select[name="type"]').empty();
                $('select[name="type"]').append(e);
                fetchPosition();
            },
        });
    }

    function fetchPosition() {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            url: "/select/fetchPositions",
            type: "post",
            data: {
                car_id: $('select[name="cars"]').val(),
                year: $('select[name="years"]').val(),
                model: $('select[name="model"]').val(),
                type: "position",
            },
            success: function (e) {
                $("#position").empty();
                $("#position").append(e);
                fetchTechnologies();
            },
        });
    }

    function fetchTechnologies() {
        $("#position button").on("click", function () {
            let position_id = $(this).attr("data-tech-id");

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                url: "/select/fetchTechnologies",
                type: "post",
                data: {
                    car_id: $('select[name="cars"]').val(),
                    year: $('select[name="years"]').val(),
                    model: $('select[name="model"]').val(),
                    position_id: position_id,
                    type: "technologies",
                },
                success: function (e) {
                    $("#buttonbox").empty();
                    $("#buttonbox").append(e);

                    bindPillarButtonClick();
                },
            });
        });
    }

    function bindPillarButtonClick() {
        $("#buttonbox button").on("click", function () {
            let buttonid = $(this).attr("data-tech-id");

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                url: "/select/fetchPillars",
                type: "post",
                data: {
                    id: buttonid,
                    type: "pillars",
                },
                success: function (e) {
                    $("#result").empty();
                    $("#result").append(e);
                },
            });
        });
    }

    $('select[name="cars"]').on("change", fetchYears);
    $('select[name="years"]').on("change", fetchModels);
    $('select[name="model"]').on("change", fetchType);
    $('select[name="type"]').on("change", fetchTechnologies);

});
