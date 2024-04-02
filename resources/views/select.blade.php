<html>

<head>
    <title> test page </title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="{{ asset('assets/jquery3.7.1.js') }}" defer></script>
    <script src="{{ asset('assets/select.js') }}" defer></script>

<body>
    CARS:
    <select name="cars">
        <option value="">Seçim yapın</option><?php
        foreach ($datas as $data) {
            echo '<option value="' . $data->id . '">' . $data->name . '</option>';
        }

        ?>
    </select>
    <hr />
    YEARS:
    <select name="years">
    </select>
    <hr />
    MODEL:
    <select name="model">
    </select>
    <hr />
    TYPE:
    <select name="type">
    </select>
    <hr />
    POSITION :
    <div id="position">
    </div>
    <hr />
    Technologies
    <div id="buttonbox">
    </div>
    <hr />
    RESULT
    <div id="result">
    </div>

</body>

</html>
