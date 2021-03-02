<?php 
    error_reporting(0);
    include('global/config.php');
    $id = $_GET['id'];
    $sql = mysqli_fetch_assoc(mysqli_query($con,"select u.*,h.* from hotel_booking h inner join user_details u on h.userid = u.user_id where h.id = '$id'"));    
    // exit("select u.*,h.* from hotel_booking h inner join user_details u on h.userid = u.id where h.id = '$id'");

    $pax_details = json_decode($sql['pax_details'],true);
?>
<!DOCTYPE HTML>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="images/favicon.png" rel="icon" />
    <title>Darwin Trip - Flight Invoice</title>
    <meta name="author" content="harnishdesign.net">
    <!-- Web Fonts============================================= -->
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900' type='text/css'>
    <!--Genrate PDF Script ============================================= -->
    <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.5/jspdf.min.js"></script>
    <!-- Bootstrap ============================================= -->    
    <style>
        :root {
            --blue: #007bff;
            --indigo: #6610f2;
            --purple: #6f42c1;
            --pink: #e83e8c;
            --red: #dc3545;
            --orange: #fd7e14;
            --yellow: #ffc107;
            --green: #28a745;
            --teal: #20c997;
            --cyan: #17a2b8;
            --white: #fff;
            --gray: #6c757d;
            --gray-dark: #343a40;
            --primary: #007bff;
            --secondary: #6c757d;
            --success: #28a745;
            --info: #17a2b8;
            --warning: #ffc107;
            --danger: #dc3545;
            --light: #f8f9fa;
            --dark: #343a40;
            --breakpoint-xs: 0;
            --breakpoint-sm: 576px;
            --breakpoint-md: 768px;
            --breakpoint-lg: 992px;
            --breakpoint-xl: 1200px;
            --font-family-sans-serif: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
            --font-family-monospace: SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace
        }

        *,
        ::after,
        ::before {
            box-sizing: border-box
        }

        html {
            font-family: sans-serif;
            line-height: 1.15;
            -webkit-text-size-adjust: 100%;
            -webkit-tap-highlight-color: transparent
        }

        article,
        aside,
        figcaption,
        figure,
        footer,
        header,
        hgroup,
        main,
        nav,
        section {
            display: block
        }

        body {
            margin: 0;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: #212529;
            text-align: left;
            background-color: #fff
        }

        [tabindex="-1"]:focus {
            outline: 0 !important
        }

        hr {
            box-sizing: content-box;
            height: 0;
            overflow: visible
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            margin-top: 0;
            margin-bottom: .5rem
        }

        p {
            margin-top: 0;
            margin-bottom: 1rem
        }

        abbr[data-original-title],
        abbr[title] {
            text-decoration: underline;
            -webkit-text-decoration: underline dotted;
            text-decoration: underline dotted;
            cursor: help;
            border-bottom: 0;
            -webkit-text-decoration-skip-ink: none;
            text-decoration-skip-ink: none
        }

        address {
            margin-bottom: 1rem;
            font-style: normal;
            line-height: inherit
        }

        dl,
        ol,
        ul {
            margin-top: 0;
            margin-bottom: 1rem
        }

        ol ol,
        ol ul,
        ul ol,
        ul ul {
            margin-bottom: 0
        }

        dt {
            font-weight: 700
        }

        dd {
            margin-bottom: .5rem;
            margin-left: 0
        }

        blockquote {
            margin: 0 0 1rem
        }

        b,
        strong {
            font-weight: bolder
        }

        small {
            font-size: 80%
        }

        sub,
        sup {
            position: relative;
            font-size: 75%;
            line-height: 0;
            vertical-align: baseline
        }

        sub {
            bottom: -.25em
        }

        sup {
            top: -.5em
        }

        a {
            color: #007bff;
            text-decoration: none;
            background-color: transparent
        }

        a:hover {
            color: #0056b3;
            text-decoration: underline
        }

        a:not([href]):not([tabindex]) {
            color: inherit;
            text-decoration: none
        }

        a:not([href]):not([tabindex]):focus,
        a:not([href]):not([tabindex]):hover {
            color: inherit;
            text-decoration: none
        }

        a:not([href]):not([tabindex]):focus {
            outline: 0
        }

        code,
        kbd,
        pre,
        samp {
            font-family: SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;
            font-size: 1em
        }

        pre {
            margin-top: 0;
            margin-bottom: 1rem;
            overflow: auto
        }

        figure {
            margin: 0 0 1rem
        }

        img {
            vertical-align: middle;
            border-style: none
        }

        svg {
            overflow: hidden;
            vertical-align: middle
        }

        table {
            border-collapse: collapse
        }

        caption {
            padding-top: .75rem;
            padding-bottom: .75rem;
            color: #6c757d;
            text-align: left;
            caption-side: bottom
        }

        th {
            text-align: inherit
        }

        label {
            display: inline-block;
            margin-bottom: .5rem
        }

        button {
            border-radius: 0
        }

        button:focus {
            outline: 1px dotted;
            outline: 5px auto -webkit-focus-ring-color
        }

        button,
        input,
        optgroup,
        select,
        textarea {
            margin: 0;
            font-family: inherit;
            font-size: inherit;
            line-height: inherit
        }

        button,
        input {
            overflow: visible
        }

        button,
        select {
            text-transform: none
        }

        select {
            word-wrap: normal
        }

        [type=button],
        [type=reset],
        [type=submit],
        button {
            -webkit-appearance: button
        }

        [type=button]:not(:disabled),
        [type=reset]:not(:disabled),
        [type=submit]:not(:disabled),
        button:not(:disabled) {
            cursor: pointer
        }

        [type=button]::-moz-focus-inner,
        [type=reset]::-moz-focus-inner,
        [type=submit]::-moz-focus-inner,
        button::-moz-focus-inner {
            padding: 0;
            border-style: none
        }

        input[type=checkbox],
        input[type=radio] {
            box-sizing: border-box;
            padding: 0
        }

        input[type=date],
        input[type=datetime-local],
        input[type=month],
        input[type=time] {
            -webkit-appearance: listbox
        }

        textarea {
            overflow: auto;
            resize: vertical
        }

        fieldset {
            min-width: 0;
            padding: 0;
            margin: 0;
            border: 0
        }

        legend {
            display: block;
            width: 100%;
            max-width: 100%;
            padding: 0;
            margin-bottom: .5rem;
            font-size: 1.5rem;
            line-height: inherit;
            color: inherit;
            white-space: normal
        }

        progress {
            vertical-align: baseline
        }

        [type=number]::-webkit-inner-spin-button,
        [type=number]::-webkit-outer-spin-button {
            height: auto
        }

        [type=search] {
            outline-offset: -2px;
            -webkit-appearance: none
        }

        [type=search]::-webkit-search-decoration {
            -webkit-appearance: none
        }

        ::-webkit-file-upload-button {
            font: inherit;
            -webkit-appearance: button
        }

        output {
            display: inline-block
        }

        summary {
            display: list-item;
            cursor: pointer
        }

        template {
            display: none
        }

        [hidden] {
            display: none !important
        }

        .h1,
        .h2,
        .h3,
        .h4,
        .h5,
        .h6,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            margin-bottom: .5rem;
            font-weight: 500;
            line-height: 1.2
        }

        .h1,
        h1 {
            font-size: 2.5rem
        }

        .h2,
        h2 {
            font-size: 2rem
        }

        .h3,
        h3 {
            font-size: 1.75rem
        }

        .h4,
        h4 {
            font-size: 1.5rem
        }

        .h5,
        h5 {
            font-size: 1.25rem
        }

        .h6,
        h6 {
            font-size: 1rem
        }

        .lead {
            font-size: 1.25rem;
            font-weight: 300
        }

        .display-1 {
            font-size: 6rem;
            font-weight: 300;
            line-height: 1.2
        }

        .display-2 {
            font-size: 5.5rem;
            font-weight: 300;
            line-height: 1.2
        }

        .display-3 {
            font-size: 4.5rem;
            font-weight: 300;
            line-height: 1.2
        }

        .display-4 {
            font-size: 3.5rem;
            font-weight: 300;
            line-height: 1.2
        }

        hr {
            margin-top: 1rem;
            margin-bottom: 1rem;
            border: 0;
            border-top: 1px solid rgba(0, 0, 0, .1)
        }

        .small,
        small {
            font-size: 80%;
            font-weight: 400
        }

        .mark,
        mark {
            padding: .2em;
            background-color: #fcf8e3
        }

        .list-unstyled {
            padding-left: 0;
            list-style: none
        }

        .list-inline {
            padding-left: 0;
            list-style: none
        }

        .list-inline-item {
            display: inline-block
        }

        .list-inline-item:not(:last-child) {
            margin-right: .5rem
        }

        .initialism {
            font-size: 90%;
            text-transform: uppercase
        }

        .blockquote {
            margin-bottom: 1rem;
            font-size: 1.25rem
        }

        .blockquote-footer {
            display: block;
            font-size: 80%;
            color: #6c757d
        }

        .blockquote-footer::before {
            content: "\2014\00A0"
        }

        .img-fluid {
            max-width: 100%;
            height: auto
        }

        .img-thumbnail {
            padding: .25rem;
            background-color: #fff;
            border: 1px solid #dee2e6;
            border-radius: .25rem;
            max-width: 100%;
            height: auto
        }

        .figure {
            display: inline-block
        }

        .figure-img {
            margin-bottom: .5rem;
            line-height: 1
        }

        .figure-caption {
            font-size: 90%;
            color: #6c757d
        }

        code {
            font-size: 87.5%;
            color: #e83e8c;
            word-break: break-word
        }

        a>code {
            color: inherit
        }

        kbd {
            padding: .2rem .4rem;
            font-size: 87.5%;
            color: #fff;
            background-color: #212529;
            border-radius: .2rem
        }

        kbd kbd {
            padding: 0;
            font-size: 100%;
            font-weight: 700
        }

        pre {
            display: block;
            font-size: 87.5%;
            color: #212529
        }

        pre code {
            font-size: inherit;
            color: inherit;
            word-break: normal
        }

        .pre-scrollable {
            max-height: 340px;
            overflow-y: scroll
        }

        .container {
            width: 100%;
            padding-right: 15px;
            padding-left: 15px;
            margin-right: auto;
            margin-left: auto
        }

        @media (min-width:576px) {
            .container {
                max-width: 540px
            }
        }

        @media (min-width:768px) {
            .container {
                max-width: 720px
            }
        }

        @media (min-width:992px) {
            .container {
                max-width: 960px
            }
        }

        @media (min-width:1200px) {
            .container {
                max-width: 1140px
            }
        }

        .container-fluid {
            width: 100%;
            padding-right: 15px;
            padding-left: 15px;
            margin-right: auto;
            margin-left: auto
        }

        .row {
            display: -ms-flexbox;
            display: flex;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
            margin-right: -15px;
            margin-left: -15px
        }

        .no-gutters {
            margin-right: 0;
            margin-left: 0
        }

        .no-gutters>.col,
        .no-gutters>[class*=col-] {
            padding-right: 0;
            padding-left: 0
        }

        .col,
        .col-1,
        .col-10,
        .col-11,
        .col-12,
        .col-2,
        .col-3,
        .col-4,
        .col-5,
        .col-6,
        .col-7,
        .col-8,
        .col-9,
        .col-auto,
        .col-lg,
        .col-lg-1,
        .col-lg-10,
        .col-lg-11,
        .col-lg-12,
        .col-lg-2,
        .col-lg-3,
        .col-lg-4,
        .col-lg-5,
        .col-lg-6,
        .col-lg-7,
        .col-lg-8,
        .col-lg-9,
        .col-lg-auto,
        .col-md,
        .col-md-1,
        .col-md-10,
        .col-md-11,
        .col-md-12,
        .col-md-2,
        .col-md-3,
        .col-md-4,
        .col-md-5,
        .col-md-6,
        .col-md-7,
        .col-md-8,
        .col-md-9,
        .col-md-auto,
        .col-sm,
        .col-sm-1,
        .col-sm-10,
        .col-sm-11,
        .col-sm-12,
        .col-sm-2,
        .col-sm-3,
        .col-sm-4,
        .col-sm-5,
        .col-sm-6,
        .col-sm-7,
        .col-sm-8,
        .col-sm-9,
        .col-sm-auto,
        .col-xl,
        .col-xl-1,
        .col-xl-10,
        .col-xl-11,
        .col-xl-12,
        .col-xl-2,
        .col-xl-3,
        .col-xl-4,
        .col-xl-5,
        .col-xl-6,
        .col-xl-7,
        .col-xl-8,
        .col-xl-9,
        .col-xl-auto {
            position: relative;
            width: 100%;
            padding-right: 15px;
            padding-left: 15px
        }

        .col {
            -ms-flex-preferred-size: 0;
            flex-basis: 0;
            -ms-flex-positive: 1;
            flex-grow: 1;
            max-width: 100%
        }

        .col-auto {
            -ms-flex: 0 0 auto;
            flex: 0 0 auto;
            width: auto;
            max-width: 100%
        }

        .col-1 {
            -ms-flex: 0 0 8.333333%;
            flex: 0 0 8.333333%;
            max-width: 8.333333%
        }

        .col-2 {
            -ms-flex: 0 0 16.666667%;
            flex: 0 0 16.666667%;
            max-width: 16.666667%
        }

        .col-3 {
            -ms-flex: 0 0 25%;
            flex: 0 0 25%;
            max-width: 25%
        }

        .col-4 {
            -ms-flex: 0 0 33.333333%;
            flex: 0 0 33.333333%;
            max-width: 33.333333%
        }

        .col-5 {
            -ms-flex: 0 0 41.666667%;
            flex: 0 0 41.666667%;
            max-width: 41.666667%
        }

        .col-6 {
            -ms-flex: 0 0 50%;
            flex: 0 0 50%;
            max-width: 50%
        }

        .col-7 {
            -ms-flex: 0 0 58.333333%;
            flex: 0 0 58.333333%;
            max-width: 58.333333%
        }

        .col-8 {
            -ms-flex: 0 0 66.666667%;
            flex: 0 0 66.666667%;
            max-width: 66.666667%
        }

        .col-9 {
            -ms-flex: 0 0 75%;
            flex: 0 0 75%;
            max-width: 75%
        }

        .col-10 {
            -ms-flex: 0 0 83.333333%;
            flex: 0 0 83.333333%;
            max-width: 83.333333%
        }

        .col-11 {
            -ms-flex: 0 0 91.666667%;
            flex: 0 0 91.666667%;
            max-width: 91.666667%
        }

        .col-12 {
            -ms-flex: 0 0 100%;
            flex: 0 0 100%;
            max-width: 100%
        }

        .order-first {
            -ms-flex-order: -1;
            order: -1
        }

        .order-last {
            -ms-flex-order: 13;
            order: 13
        }

        .order-0 {
            -ms-flex-order: 0;
            order: 0
        }

        .order-1 {
            -ms-flex-order: 1;
            order: 1
        }

        .order-2 {
            -ms-flex-order: 2;
            order: 2
        }

        .order-3 {
            -ms-flex-order: 3;
            order: 3
        }

        .order-4 {
            -ms-flex-order: 4;
            order: 4
        }

        .order-5 {
            -ms-flex-order: 5;
            order: 5
        }

        .order-6 {
            -ms-flex-order: 6;
            order: 6
        }

        .order-7 {
            -ms-flex-order: 7;
            order: 7
        }

        .order-8 {
            -ms-flex-order: 8;
            order: 8
        }

        .order-9 {
            -ms-flex-order: 9;
            order: 9
        }

        .order-10 {
            -ms-flex-order: 10;
            order: 10
        }

        .order-11 {
            -ms-flex-order: 11;
            order: 11
        }

        .order-12 {
            -ms-flex-order: 12;
            order: 12
        }

        .offset-1 {
            margin-left: 8.333333%
        }

        .offset-2 {
            margin-left: 16.666667%
        }

        .offset-3 {
            margin-left: 25%
        }

        .offset-4 {
            margin-left: 33.333333%
        }

        .offset-5 {
            margin-left: 41.666667%
        }

        .offset-6 {
            margin-left: 50%
        }

        .offset-7 {
            margin-left: 58.333333%
        }

        .offset-8 {
            margin-left: 66.666667%
        }

        .offset-9 {
            margin-left: 75%
        }

        .offset-10 {
            margin-left: 83.333333%
        }

        .offset-11 {
            margin-left: 91.666667%
        }

        @media (min-width:576px) {
            .col-sm {
                -ms-flex-preferred-size: 0;
                flex-basis: 0;
                -ms-flex-positive: 1;
                flex-grow: 1;
                max-width: 100%
            }

            .col-sm-auto {
                -ms-flex: 0 0 auto;
                flex: 0 0 auto;
                width: auto;
                max-width: 100%
            }

            .col-sm-1 {
                -ms-flex: 0 0 8.333333%;
                flex: 0 0 8.333333%;
                max-width: 8.333333%
            }

            .col-sm-2 {
                -ms-flex: 0 0 16.666667%;
                flex: 0 0 16.666667%;
                max-width: 16.666667%
            }

            .col-sm-3 {
                -ms-flex: 0 0 25%;
                flex: 0 0 25%;
                max-width: 25%
            }

            .col-sm-4 {
                -ms-flex: 0 0 33.333333%;
                flex: 0 0 33.333333%;
                max-width: 33.333333%
            }

            .col-sm-5 {
                -ms-flex: 0 0 41.666667%;
                flex: 0 0 41.666667%;
                max-width: 41.666667%
            }

            .col-sm-6 {
                -ms-flex: 0 0 50%;
                flex: 0 0 50%;
                max-width: 50%
            }

            .col-sm-7 {
                -ms-flex: 0 0 58.333333%;
                flex: 0 0 58.333333%;
                max-width: 58.333333%
            }

            .col-sm-8 {
                -ms-flex: 0 0 66.666667%;
                flex: 0 0 66.666667%;
                max-width: 66.666667%
            }

            .col-sm-9 {
                -ms-flex: 0 0 75%;
                flex: 0 0 75%;
                max-width: 75%
            }

            .col-sm-10 {
                -ms-flex: 0 0 83.333333%;
                flex: 0 0 83.333333%;
                max-width: 83.333333%
            }

            .col-sm-11 {
                -ms-flex: 0 0 91.666667%;
                flex: 0 0 91.666667%;
                max-width: 91.666667%
            }

            .col-sm-12 {
                -ms-flex: 0 0 100%;
                flex: 0 0 100%;
                max-width: 100%
            }

            .order-sm-first {
                -ms-flex-order: -1;
                order: -1
            }

            .order-sm-last {
                -ms-flex-order: 13;
                order: 13
            }

            .order-sm-0 {
                -ms-flex-order: 0;
                order: 0
            }

            .order-sm-1 {
                -ms-flex-order: 1;
                order: 1
            }

            .order-sm-2 {
                -ms-flex-order: 2;
                order: 2
            }

            .order-sm-3 {
                -ms-flex-order: 3;
                order: 3
            }

            .order-sm-4 {
                -ms-flex-order: 4;
                order: 4
            }

            .order-sm-5 {
                -ms-flex-order: 5;
                order: 5
            }

            .order-sm-6 {
                -ms-flex-order: 6;
                order: 6
            }

            .order-sm-7 {
                -ms-flex-order: 7;
                order: 7
            }

            .order-sm-8 {
                -ms-flex-order: 8;
                order: 8
            }

            .order-sm-9 {
                -ms-flex-order: 9;
                order: 9
            }

            .order-sm-10 {
                -ms-flex-order: 10;
                order: 10
            }

            .order-sm-11 {
                -ms-flex-order: 11;
                order: 11
            }

            .order-sm-12 {
                -ms-flex-order: 12;
                order: 12
            }

            .offset-sm-0 {
                margin-left: 0
            }

            .offset-sm-1 {
                margin-left: 8.333333%
            }

            .offset-sm-2 {
                margin-left: 16.666667%
            }

            .offset-sm-3 {
                margin-left: 25%
            }

            .offset-sm-4 {
                margin-left: 33.333333%
            }

            .offset-sm-5 {
                margin-left: 41.666667%
            }

            .offset-sm-6 {
                margin-left: 50%
            }

            .offset-sm-7 {
                margin-left: 58.333333%
            }

            .offset-sm-8 {
                margin-left: 66.666667%
            }

            .offset-sm-9 {
                margin-left: 75%
            }

            .offset-sm-10 {
                margin-left: 83.333333%
            }

            .offset-sm-11 {
                margin-left: 91.666667%
            }
        }

        @media (min-width:768px) {
            .col-md {
                -ms-flex-preferred-size: 0;
                flex-basis: 0;
                -ms-flex-positive: 1;
                flex-grow: 1;
                max-width: 100%
            }

            .col-md-auto {
                -ms-flex: 0 0 auto;
                flex: 0 0 auto;
                width: auto;
                max-width: 100%
            }

            .col-md-1 {
                -ms-flex: 0 0 8.333333%;
                flex: 0 0 8.333333%;
                max-width: 8.333333%
            }

            .col-md-2 {
                -ms-flex: 0 0 16.666667%;
                flex: 0 0 16.666667%;
                max-width: 16.666667%
            }

            .col-md-3 {
                -ms-flex: 0 0 25%;
                flex: 0 0 25%;
                max-width: 25%
            }

            .col-md-4 {
                -ms-flex: 0 0 33.333333%;
                flex: 0 0 33.333333%;
                max-width: 33.333333%
            }

            .col-md-5 {
                -ms-flex: 0 0 41.666667%;
                flex: 0 0 41.666667%;
                max-width: 41.666667%
            }

            .col-md-6 {
                -ms-flex: 0 0 50%;
                flex: 0 0 50%;
                max-width: 50%
            }

            .col-md-7 {
                -ms-flex: 0 0 58.333333%;
                flex: 0 0 58.333333%;
                max-width: 58.333333%
            }

            .col-md-8 {
                -ms-flex: 0 0 66.666667%;
                flex: 0 0 66.666667%;
                max-width: 66.666667%
            }

            .col-md-9 {
                -ms-flex: 0 0 75%;
                flex: 0 0 75%;
                max-width: 75%
            }

            .col-md-10 {
                -ms-flex: 0 0 83.333333%;
                flex: 0 0 83.333333%;
                max-width: 83.333333%
            }

            .col-md-11 {
                -ms-flex: 0 0 91.666667%;
                flex: 0 0 91.666667%;
                max-width: 91.666667%
            }

            .col-md-12 {
                -ms-flex: 0 0 100%;
                flex: 0 0 100%;
                max-width: 100%
            }

            .order-md-first {
                -ms-flex-order: -1;
                order: -1
            }

            .order-md-last {
                -ms-flex-order: 13;
                order: 13
            }

            .order-md-0 {
                -ms-flex-order: 0;
                order: 0
            }

            .order-md-1 {
                -ms-flex-order: 1;
                order: 1
            }

            .order-md-2 {
                -ms-flex-order: 2;
                order: 2
            }

            .order-md-3 {
                -ms-flex-order: 3;
                order: 3
            }

            .order-md-4 {
                -ms-flex-order: 4;
                order: 4
            }

            .order-md-5 {
                -ms-flex-order: 5;
                order: 5
            }

            .order-md-6 {
                -ms-flex-order: 6;
                order: 6
            }

            .order-md-7 {
                -ms-flex-order: 7;
                order: 7
            }

            .order-md-8 {
                -ms-flex-order: 8;
                order: 8
            }

            .order-md-9 {
                -ms-flex-order: 9;
                order: 9
            }

            .order-md-10 {
                -ms-flex-order: 10;
                order: 10
            }

            .order-md-11 {
                -ms-flex-order: 11;
                order: 11
            }

            .order-md-12 {
                -ms-flex-order: 12;
                order: 12
            }

            .offset-md-0 {
                margin-left: 0
            }

            .offset-md-1 {
                margin-left: 8.333333%
            }

            .offset-md-2 {
                margin-left: 16.666667%
            }

            .offset-md-3 {
                margin-left: 25%
            }

            .offset-md-4 {
                margin-left: 33.333333%
            }

            .offset-md-5 {
                margin-left: 41.666667%
            }

            .offset-md-6 {
                margin-left: 50%
            }

            .offset-md-7 {
                margin-left: 58.333333%
            }

            .offset-md-8 {
                margin-left: 66.666667%
            }

            .offset-md-9 {
                margin-left: 75%
            }

            .offset-md-10 {
                margin-left: 83.333333%
            }

            .offset-md-11 {
                margin-left: 91.666667%
            }
        }

        @media (min-width:992px) {
            .col-lg {
                -ms-flex-preferred-size: 0;
                flex-basis: 0;
                -ms-flex-positive: 1;
                flex-grow: 1;
                max-width: 100%
            }

            .col-lg-auto {
                -ms-flex: 0 0 auto;
                flex: 0 0 auto;
                width: auto;
                max-width: 100%
            }

            .col-lg-1 {
                -ms-flex: 0 0 8.333333%;
                flex: 0 0 8.333333%;
                max-width: 8.333333%
            }

            .col-lg-2 {
                -ms-flex: 0 0 16.666667%;
                flex: 0 0 16.666667%;
                max-width: 16.666667%
            }

            .col-lg-3 {
                -ms-flex: 0 0 25%;
                flex: 0 0 25%;
                max-width: 25%
            }

            .col-lg-4 {
                -ms-flex: 0 0 33.333333%;
                flex: 0 0 33.333333%;
                max-width: 33.333333%
            }

            .col-lg-5 {
                -ms-flex: 0 0 41.666667%;
                flex: 0 0 41.666667%;
                max-width: 41.666667%
            }

            .col-lg-6 {
                -ms-flex: 0 0 50%;
                flex: 0 0 50%;
                max-width: 50%
            }

            .col-lg-7 {
                -ms-flex: 0 0 58.333333%;
                flex: 0 0 58.333333%;
                max-width: 58.333333%
            }

            .col-lg-8 {
                -ms-flex: 0 0 66.666667%;
                flex: 0 0 66.666667%;
                max-width: 66.666667%
            }

            .col-lg-9 {
                -ms-flex: 0 0 75%;
                flex: 0 0 75%;
                max-width: 75%
            }

            .col-lg-10 {
                -ms-flex: 0 0 83.333333%;
                flex: 0 0 83.333333%;
                max-width: 83.333333%
            }

            .col-lg-11 {
                -ms-flex: 0 0 91.666667%;
                flex: 0 0 91.666667%;
                max-width: 91.666667%
            }

            .col-lg-12 {
                -ms-flex: 0 0 100%;
                flex: 0 0 100%;
                max-width: 100%
            }

            .order-lg-first {
                -ms-flex-order: -1;
                order: -1
            }

            .order-lg-last {
                -ms-flex-order: 13;
                order: 13
            }

            .order-lg-0 {
                -ms-flex-order: 0;
                order: 0
            }

            .order-lg-1 {
                -ms-flex-order: 1;
                order: 1
            }

            .order-lg-2 {
                -ms-flex-order: 2;
                order: 2
            }

            .order-lg-3 {
                -ms-flex-order: 3;
                order: 3
            }

            .order-lg-4 {
                -ms-flex-order: 4;
                order: 4
            }

            .order-lg-5 {
                -ms-flex-order: 5;
                order: 5
            }

            .order-lg-6 {
                -ms-flex-order: 6;
                order: 6
            }

            .order-lg-7 {
                -ms-flex-order: 7;
                order: 7
            }

            .order-lg-8 {
                -ms-flex-order: 8;
                order: 8
            }

            .order-lg-9 {
                -ms-flex-order: 9;
                order: 9
            }

            .order-lg-10 {
                -ms-flex-order: 10;
                order: 10
            }

            .order-lg-11 {
                -ms-flex-order: 11;
                order: 11
            }

            .order-lg-12 {
                -ms-flex-order: 12;
                order: 12
            }

            .offset-lg-0 {
                margin-left: 0
            }

            .offset-lg-1 {
                margin-left: 8.333333%
            }

            .offset-lg-2 {
                margin-left: 16.666667%
            }

            .offset-lg-3 {
                margin-left: 25%
            }

            .offset-lg-4 {
                margin-left: 33.333333%
            }

            .offset-lg-5 {
                margin-left: 41.666667%
            }

            .offset-lg-6 {
                margin-left: 50%
            }

            .offset-lg-7 {
                margin-left: 58.333333%
            }

            .offset-lg-8 {
                margin-left: 66.666667%
            }

            .offset-lg-9 {
                margin-left: 75%
            }

            .offset-lg-10 {
                margin-left: 83.333333%
            }

            .offset-lg-11 {
                margin-left: 91.666667%
            }
        }

        @media (min-width:1200px) {
            .col-xl {
                -ms-flex-preferred-size: 0;
                flex-basis: 0;
                -ms-flex-positive: 1;
                flex-grow: 1;
                max-width: 100%
            }

            .col-xl-auto {
                -ms-flex: 0 0 auto;
                flex: 0 0 auto;
                width: auto;
                max-width: 100%
            }

            .col-xl-1 {
                -ms-flex: 0 0 8.333333%;
                flex: 0 0 8.333333%;
                max-width: 8.333333%
            }

            .col-xl-2 {
                -ms-flex: 0 0 16.666667%;
                flex: 0 0 16.666667%;
                max-width: 16.666667%
            }

            .col-xl-3 {
                -ms-flex: 0 0 25%;
                flex: 0 0 25%;
                max-width: 25%
            }

            .col-xl-4 {
                -ms-flex: 0 0 33.333333%;
                flex: 0 0 33.333333%;
                max-width: 33.333333%
            }

            .col-xl-5 {
                -ms-flex: 0 0 41.666667%;
                flex: 0 0 41.666667%;
                max-width: 41.666667%
            }

            .col-xl-6 {
                -ms-flex: 0 0 50%;
                flex: 0 0 50%;
                max-width: 50%
            }

            .col-xl-7 {
                -ms-flex: 0 0 58.333333%;
                flex: 0 0 58.333333%;
                max-width: 58.333333%
            }

            .col-xl-8 {
                -ms-flex: 0 0 66.666667%;
                flex: 0 0 66.666667%;
                max-width: 66.666667%
            }

            .col-xl-9 {
                -ms-flex: 0 0 75%;
                flex: 0 0 75%;
                max-width: 75%
            }

            .col-xl-10 {
                -ms-flex: 0 0 83.333333%;
                flex: 0 0 83.333333%;
                max-width: 83.333333%
            }

            .col-xl-11 {
                -ms-flex: 0 0 91.666667%;
                flex: 0 0 91.666667%;
                max-width: 91.666667%
            }

            .col-xl-12 {
                -ms-flex: 0 0 100%;
                flex: 0 0 100%;
                max-width: 100%
            }

            .order-xl-first {
                -ms-flex-order: -1;
                order: -1
            }

            .order-xl-last {
                -ms-flex-order: 13;
                order: 13
            }

            .order-xl-0 {
                -ms-flex-order: 0;
                order: 0
            }

            .order-xl-1 {
                -ms-flex-order: 1;
                order: 1
            }

            .order-xl-2 {
                -ms-flex-order: 2;
                order: 2
            }

            .order-xl-3 {
                -ms-flex-order: 3;
                order: 3
            }

            .order-xl-4 {
                -ms-flex-order: 4;
                order: 4
            }

            .order-xl-5 {
                -ms-flex-order: 5;
                order: 5
            }

            .order-xl-6 {
                -ms-flex-order: 6;
                order: 6
            }

            .order-xl-7 {
                -ms-flex-order: 7;
                order: 7
            }

            .order-xl-8 {
                -ms-flex-order: 8;
                order: 8
            }

            .order-xl-9 {
                -ms-flex-order: 9;
                order: 9
            }

            .order-xl-10 {
                -ms-flex-order: 10;
                order: 10
            }

            .order-xl-11 {
                -ms-flex-order: 11;
                order: 11
            }

            .order-xl-12 {
                -ms-flex-order: 12;
                order: 12
            }

            .offset-xl-0 {
                margin-left: 0
            }

            .offset-xl-1 {
                margin-left: 8.333333%
            }

            .offset-xl-2 {
                margin-left: 16.666667%
            }

            .offset-xl-3 {
                margin-left: 25%
            }

            .offset-xl-4 {
                margin-left: 33.333333%
            }

            .offset-xl-5 {
                margin-left: 41.666667%
            }

            .offset-xl-6 {
                margin-left: 50%
            }

            .offset-xl-7 {
                margin-left: 58.333333%
            }

            .offset-xl-8 {
                margin-left: 66.666667%
            }

            .offset-xl-9 {
                margin-left: 75%
            }

            .offset-xl-10 {
                margin-left: 83.333333%
            }

            .offset-xl-11 {
                margin-left: 91.666667%
            }
        }

        .table {
            width: 100%;
            margin-bottom: 1rem;
            color: #212529
        }

        .table td,
        .table th {
            padding: .75rem;
            vertical-align: top;
            border-top: 1px solid #dee2e6
        }

        .table thead th {
            vertical-align: bottom;
            border-bottom: 2px solid #dee2e6
        }

        .table tbody+tbody {
            border-top: 2px solid #dee2e6
        }

        .table-sm td,
        .table-sm th {
            padding: .3rem
        }

        .table-bordered {
            border: 1px solid #dee2e6
        }

        .table-bordered td,
        .table-bordered th {
            border: 1px solid #dee2e6
        }

        .table-bordered thead td,
        .table-bordered thead th {
            border-bottom-width: 2px
        }

        .table-borderless tbody+tbody,
        .table-borderless td,
        .table-borderless th,
        .table-borderless thead th {
            border: 0
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(0, 0, 0, .05)
        }

        .table-hover tbody tr:hover {
            color: #212529;
            background-color: rgba(0, 0, 0, .075)
        }

        .table-primary,
        .table-primary>td,
        .table-primary>th {
            background-color: #b8daff
        }

        .table-primary tbody+tbody,
        .table-primary td,
        .table-primary th,
        .table-primary thead th {
            border-color: #7abaff
        }

        .table-hover .table-primary:hover {
            background-color: #9fcdff
        }

        .table-hover .table-primary:hover>td,
        .table-hover .table-primary:hover>th {
            background-color: #9fcdff
        }

        .table-secondary,
        .table-secondary>td,
        .table-secondary>th {
            background-color: #d6d8db
        }

        .table-secondary tbody+tbody,
        .table-secondary td,
        .table-secondary th,
        .table-secondary thead th {
            border-color: #b3b7bb
        }

        .table-hover .table-secondary:hover {
            background-color: #c8cbcf
        }

        .table-hover .table-secondary:hover>td,
        .table-hover .table-secondary:hover>th {
            background-color: #c8cbcf
        }

        .table-success,
        .table-success>td,
        .table-success>th {
            background-color: #c3e6cb
        }

        .table-success tbody+tbody,
        .table-success td,
        .table-success th,
        .table-success thead th {
            border-color: #8fd19e
        }

        .table-hover .table-success:hover {
            background-color: #b1dfbb
        }

        .table-hover .table-success:hover>td,
        .table-hover .table-success:hover>th {
            background-color: #b1dfbb
        }

        .table-info,
        .table-info>td,
        .table-info>th {
            background-color: #bee5eb
        }

        .table-info tbody+tbody,
        .table-info td,
        .table-info th,
        .table-info thead th {
            border-color: #86cfda
        }

        .table-hover .table-info:hover {
            background-color: #abdde5
        }

        .table-hover .table-info:hover>td,
        .table-hover .table-info:hover>th {
            background-color: #abdde5
        }

        .table-warning,
        .table-warning>td,
        .table-warning>th {
            background-color: #ffeeba
        }

        .table-warning tbody+tbody,
        .table-warning td,
        .table-warning th,
        .table-warning thead th {
            border-color: #ffdf7e
        }

        .table-hover .table-warning:hover {
            background-color: #ffe8a1
        }

        .table-hover .table-warning:hover>td,
        .table-hover .table-warning:hover>th {
            background-color: #ffe8a1
        }

        .table-danger,
        .table-danger>td,
        .table-danger>th {
            background-color: #f5c6cb
        }

        .table-danger tbody+tbody,
        .table-danger td,
        .table-danger th,
        .table-danger thead th {
            border-color: #ed969e
        }

        .table-hover .table-danger:hover {
            background-color: #f1b0b7
        }

        .table-hover .table-danger:hover>td,
        .table-hover .table-danger:hover>th {
            background-color: #f1b0b7
        }

        .table-light,
        .table-light>td,
        .table-light>th {
            background-color: #fdfdfe
        }

        .table-light tbody+tbody,
        .table-light td,
        .table-light th,
        .table-light thead th {
            border-color: #fbfcfc
        }

        .table-hover .table-light:hover {
            background-color: #ececf6
        }

        .table-hover .table-light:hover>td,
        .table-hover .table-light:hover>th {
            background-color: #ececf6
        }

        .table-dark,
        .table-dark>td,
        .table-dark>th {
            background-color: #c6c8ca
        }

        .table-dark tbody+tbody,
        .table-dark td,
        .table-dark th,
        .table-dark thead th {
            border-color: #95999c
        }

        .table-hover .table-dark:hover {
            background-color: #b9bbbe
        }

        .table-hover .table-dark:hover>td,
        .table-hover .table-dark:hover>th {
            background-color: #b9bbbe
        }

        .table-active,
        .table-active>td,
        .table-active>th {
            background-color: rgba(0, 0, 0, .075)
        }

        .table-hover .table-active:hover {
            background-color: rgba(0, 0, 0, .075)
        }

        .table-hover .table-active:hover>td,
        .table-hover .table-active:hover>th {
            background-color: rgba(0, 0, 0, .075)
        }

        .table .thead-dark th {
            color: #fff;
            background-color: #343a40;
            border-color: #454d55
        }

        .table .thead-light th {
            color: #495057;
            background-color: #e9ecef;
            border-color: #dee2e6
        }

        .table-dark {
            color: #fff;
            background-color: #343a40
        }

        .table-dark td,
        .table-dark th,
        .table-dark thead th {
            border-color: #454d55
        }

        .table-dark.table-bordered {
            border: 0
        }

        .table-dark.table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(255, 255, 255, .05)
        }

        .table-dark.table-hover tbody tr:hover {
            color: #fff;
            background-color: rgba(255, 255, 255, .075)
        }

        @media (max-width:575.98px) {
            .table-responsive-sm {
                display: block;
                width: 100%;
                overflow-x: auto;
                -webkit-overflow-scrolling: touch
            }

            .table-responsive-sm>.table-bordered {
                border: 0
            }
        }

        @media (max-width:767.98px) {
            .table-responsive-md {
                display: block;
                width: 100%;
                overflow-x: auto;
                -webkit-overflow-scrolling: touch
            }

            .table-responsive-md>.table-bordered {
                border: 0
            }
        }

        @media (max-width:991.98px) {
            .table-responsive-lg {
                display: block;
                width: 100%;
                overflow-x: auto;
                -webkit-overflow-scrolling: touch
            }

            .table-responsive-lg>.table-bordered {
                border: 0
            }
        }

        @media (max-width:1199.98px) {
            .table-responsive-xl {
                display: block;
                width: 100%;
                overflow-x: auto;
                -webkit-overflow-scrolling: touch
            }

            .table-responsive-xl>.table-bordered {
                border: 0
            }
        }

        .table-responsive {
            display: block;
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch
        }

        .table-responsive>.table-bordered {
            border: 0
        }

        .form-control {
            display: block;
            width: 100%;
            height: calc(1.5em + .75rem + 2px);
            padding: .375rem .75rem;
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: #495057;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            border-radius: .25rem;
            transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out
        }

        @media (prefers-reduced-motion:reduce) {
            .form-control {
                transition: none
            }
        }

        .form-control::-ms-expand {
            background-color: transparent;
            border: 0
        }

        .form-control:focus {
            color: #495057;
            background-color: #fff;
            border-color: #80bdff;
            outline: 0;
            box-shadow: 0 0 0 .2rem rgba(0, 123, 255, .25)
        }

        .form-control::-webkit-input-placeholder {
            color: #6c757d;
            opacity: 1
        }

        .form-control::-moz-placeholder {
            color: #6c757d;
            opacity: 1
        }

        .form-control:-ms-input-placeholder {
            color: #6c757d;
            opacity: 1
        }

        .form-control::-ms-input-placeholder {
            color: #6c757d;
            opacity: 1
        }

        .form-control::placeholder {
            color: #6c757d;
            opacity: 1
        }

        .form-control:disabled,
        .form-control[readonly] {
            background-color: #e9ecef;
            opacity: 1
        }

        select.form-control:focus::-ms-value {
            color: #495057;
            background-color: #fff
        }

        .form-control-file,
        .form-control-range {
            display: block;
            width: 100%
        }

        .col-form-label {
            padding-top: calc(.375rem + 1px);
            padding-bottom: calc(.375rem + 1px);
            margin-bottom: 0;
            font-size: inherit;
            line-height: 1.5
        }

        .col-form-label-lg {
            padding-top: calc(.5rem + 1px);
            padding-bottom: calc(.5rem + 1px);
            font-size: 1.25rem;
            line-height: 1.5
        }

        .col-form-label-sm {
            padding-top: calc(.25rem + 1px);
            padding-bottom: calc(.25rem + 1px);
            font-size: .875rem;
            line-height: 1.5
        }

        .form-control-plaintext {
            display: block;
            width: 100%;
            padding-top: .375rem;
            padding-bottom: .375rem;
            margin-bottom: 0;
            line-height: 1.5;
            color: #212529;
            background-color: transparent;
            border: solid transparent;
            border-width: 1px 0
        }

        .form-control-plaintext.form-control-lg,
        .form-control-plaintext.form-control-sm {
            padding-right: 0;
            padding-left: 0
        }

        .form-control-sm {
            height: calc(1.5em + .5rem + 2px);
            padding: .25rem .5rem;
            font-size: .875rem;
            line-height: 1.5;
            border-radius: .2rem
        }

        .form-control-lg {
            height: calc(1.5em + 1rem + 2px);
            padding: .5rem 1rem;
            font-size: 1.25rem;
            line-height: 1.5;
            border-radius: .3rem
        }

        select.form-control[multiple],
        select.form-control[size] {
            height: auto
        }

        textarea.form-control {
            height: auto
        }

        .form-group {
            margin-bottom: 1rem
        }

        .form-text {
            display: block;
            margin-top: .25rem
        }

        .form-row {
            display: -ms-flexbox;
            display: flex;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
            margin-right: -5px;
            margin-left: -5px
        }

        .form-row>.col,
        .form-row>[class*=col-] {
            padding-right: 5px;
            padding-left: 5px
        }

        .form-check {
            position: relative;
            display: block;
            padding-left: 1.25rem
        }

        .form-check-input {
            position: absolute;
            margin-top: .3rem;
            margin-left: -1.25rem
        }

        .form-check-input:disabled~.form-check-label {
            color: #6c757d
        }

        .form-check-label {
            margin-bottom: 0
        }

        .form-check-inline {
            display: -ms-inline-flexbox;
            display: inline-flex;
            -ms-flex-align: center;
            align-items: center;
            padding-left: 0;
            margin-right: .75rem
        }

        .form-check-inline .form-check-input {
            position: static;
            margin-top: 0;
            margin-right: .3125rem;
            margin-left: 0
        }

        .valid-feedback {
            display: none;
            width: 100%;
            margin-top: .25rem;
            font-size: 80%;
            color: #28a745
        }

        .valid-tooltip {
            position: absolute;
            top: 100%;
            z-index: 5;
            display: none;
            max-width: 100%;
            padding: .25rem .5rem;
            margin-top: .1rem;
            font-size: .875rem;
            line-height: 1.5;
            color: #fff;
            background-color: rgba(40, 167, 69, .9);
            border-radius: .25rem
        }

        .form-control.is-valid,
        .was-validated .form-control:valid {
            border-color: #28a745;
            padding-right: calc(1.5em + .75rem);
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 8 8'%3e%3cpath fill='%2328a745' d='M2.3 6.73L.6 4.53c-.4-1.04.46-1.4 1.1-.8l1.1 1.4 3.4-3.8c.6-.63 1.6-.27 1.2.7l-4 4.6c-.43.5-.8.4-1.1.1z'/%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: center right calc(.375em + .1875rem);
            background-size: calc(.75em + .375rem) calc(.75em + .375rem)
        }

        .form-control.is-valid:focus,
        .was-validated .form-control:valid:focus {
            border-color: #28a745;
            box-shadow: 0 0 0 .2rem rgba(40, 167, 69, .25)
        }

        .form-control.is-valid~.valid-feedback,
        .form-control.is-valid~.valid-tooltip,
        .was-validated .form-control:valid~.valid-feedback,
        .was-validated .form-control:valid~.valid-tooltip {
            display: block
        }

        .was-validated textarea.form-control:valid,
        textarea.form-control.is-valid {
            padding-right: calc(1.5em + .75rem);
            background-position: top calc(.375em + .1875rem) right calc(.375em + .1875rem)
        }

        .custom-select.is-valid,
        .was-validated .custom-select:valid {
            border-color: #28a745;
            padding-right: calc((1em + .75rem) * 3 / 4 + 1.75rem);
            background: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 4 5'%3e%3cpath fill='%23343a40' d='M2 0L0 2h4zm0 5L0 3h4z'/%3e%3c/svg%3e") no-repeat right .75rem center/8px 10px, url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 8 8'%3e%3cpath fill='%2328a745' d='M2.3 6.73L.6 4.53c-.4-1.04.46-1.4 1.1-.8l1.1 1.4 3.4-3.8c.6-.63 1.6-.27 1.2.7l-4 4.6c-.43.5-.8.4-1.1.1z'/%3e%3c/svg%3e") #fff no-repeat center right 1.75rem/calc(.75em + .375rem) calc(.75em + .375rem)
        }

        .custom-select.is-valid:focus,
        .was-validated .custom-select:valid:focus {
            border-color: #28a745;
            box-shadow: 0 0 0 .2rem rgba(40, 167, 69, .25)
        }

        .custom-select.is-valid~.valid-feedback,
        .custom-select.is-valid~.valid-tooltip,
        .was-validated .custom-select:valid~.valid-feedback,
        .was-validated .custom-select:valid~.valid-tooltip {
            display: block
        }

        .form-control-file.is-valid~.valid-feedback,
        .form-control-file.is-valid~.valid-tooltip,
        .was-validated .form-control-file:valid~.valid-feedback,
        .was-validated .form-control-file:valid~.valid-tooltip {
            display: block
        }

        .form-check-input.is-valid~.form-check-label,
        .was-validated .form-check-input:valid~.form-check-label {
            color: #28a745
        }

        .form-check-input.is-valid~.valid-feedback,
        .form-check-input.is-valid~.valid-tooltip,
        .was-validated .form-check-input:valid~.valid-feedback,
        .was-validated .form-check-input:valid~.valid-tooltip {
            display: block
        }

        .custom-control-input.is-valid~.custom-control-label,
        .was-validated .custom-control-input:valid~.custom-control-label {
            color: #28a745
        }

        .custom-control-input.is-valid~.custom-control-label::before,
        .was-validated .custom-control-input:valid~.custom-control-label::before {
            border-color: #28a745
        }

        .custom-control-input.is-valid~.valid-feedback,
        .custom-control-input.is-valid~.valid-tooltip,
        .was-validated .custom-control-input:valid~.valid-feedback,
        .was-validated .custom-control-input:valid~.valid-tooltip {
            display: block
        }

        .custom-control-input.is-valid:checked~.custom-control-label::before,
        .was-validated .custom-control-input:valid:checked~.custom-control-label::before {
            border-color: #34ce57;
            background-color: #34ce57
        }

        .custom-control-input.is-valid:focus~.custom-control-label::before,
        .was-validated .custom-control-input:valid:focus~.custom-control-label::before {
            box-shadow: 0 0 0 .2rem rgba(40, 167, 69, .25)
        }

        .custom-control-input.is-valid:focus:not(:checked)~.custom-control-label::before,
        .was-validated .custom-control-input:valid:focus:not(:checked)~.custom-control-label::before {
            border-color: #28a745
        }

        .custom-file-input.is-valid~.custom-file-label,
        .was-validated .custom-file-input:valid~.custom-file-label {
            border-color: #28a745
        }

        .custom-file-input.is-valid~.valid-feedback,
        .custom-file-input.is-valid~.valid-tooltip,
        .was-validated .custom-file-input:valid~.valid-feedback,
        .was-validated .custom-file-input:valid~.valid-tooltip {
            display: block
        }

        .custom-file-input.is-valid:focus~.custom-file-label,
        .was-validated .custom-file-input:valid:focus~.custom-file-label {
            border-color: #28a745;
            box-shadow: 0 0 0 .2rem rgba(40, 167, 69, .25)
        }

        .invalid-feedback {
            display: none;
            width: 100%;
            margin-top: .25rem;
            font-size: 80%;
            color: #dc3545
        }

        .invalid-tooltip {
            position: absolute;
            top: 100%;
            z-index: 5;
            display: none;
            max-width: 100%;
            padding: .25rem .5rem;
            margin-top: .1rem;
            font-size: .875rem;
            line-height: 1.5;
            color: #fff;
            background-color: rgba(220, 53, 69, .9);
            border-radius: .25rem
        }

        .form-control.is-invalid,
        .was-validated .form-control:invalid {
            border-color: #dc3545;
            padding-right: calc(1.5em + .75rem);
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='%23dc3545' viewBox='-2 -2 7 7'%3e%3cpath stroke='%23dc3545' d='M0 0l3 3m0-3L0 3'/%3e%3ccircle r='.5'/%3e%3ccircle cx='3' r='.5'/%3e%3ccircle cy='3' r='.5'/%3e%3ccircle cx='3' cy='3' r='.5'/%3e%3c/svg%3E");
            background-repeat: no-repeat;
            background-position: center right calc(.375em + .1875rem);
            background-size: calc(.75em + .375rem) calc(.75em + .375rem)
        }

        .form-control.is-invalid:focus,
        .was-validated .form-control:invalid:focus {
            border-color: #dc3545;
            box-shadow: 0 0 0 .2rem rgba(220, 53, 69, .25)
        }

        .form-control.is-invalid~.invalid-feedback,
        .form-control.is-invalid~.invalid-tooltip,
        .was-validated .form-control:invalid~.invalid-feedback,
        .was-validated .form-control:invalid~.invalid-tooltip {
            display: block
        }

        .was-validated textarea.form-control:invalid,
        textarea.form-control.is-invalid {
            padding-right: calc(1.5em + .75rem);
            background-position: top calc(.375em + .1875rem) right calc(.375em + .1875rem)
        }

        .custom-select.is-invalid,
        .was-validated .custom-select:invalid {
            border-color: #dc3545;
            padding-right: calc((1em + .75rem) * 3 / 4 + 1.75rem);
            background: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 4 5'%3e%3cpath fill='%23343a40' d='M2 0L0 2h4zm0 5L0 3h4z'/%3e%3c/svg%3e") no-repeat right .75rem center/8px 10px, url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='%23dc3545' viewBox='-2 -2 7 7'%3e%3cpath stroke='%23dc3545' d='M0 0l3 3m0-3L0 3'/%3e%3ccircle r='.5'/%3e%3ccircle cx='3' r='.5'/%3e%3ccircle cy='3' r='.5'/%3e%3ccircle cx='3' cy='3' r='.5'/%3e%3c/svg%3E") #fff no-repeat center right 1.75rem/calc(.75em + .375rem) calc(.75em + .375rem)
        }

        .custom-select.is-invalid:focus,
        .was-validated .custom-select:invalid:focus {
            border-color: #dc3545;
            box-shadow: 0 0 0 .2rem rgba(220, 53, 69, .25)
        }

        .custom-select.is-invalid~.invalid-feedback,
        .custom-select.is-invalid~.invalid-tooltip,
        .was-validated .custom-select:invalid~.invalid-feedback,
        .was-validated .custom-select:invalid~.invalid-tooltip {
            display: block
        }

        .form-control-file.is-invalid~.invalid-feedback,
        .form-control-file.is-invalid~.invalid-tooltip,
        .was-validated .form-control-file:invalid~.invalid-feedback,
        .was-validated .form-control-file:invalid~.invalid-tooltip {
            display: block
        }

        .form-check-input.is-invalid~.form-check-label,
        .was-validated .form-check-input:invalid~.form-check-label {
            color: #dc3545
        }

        .form-check-input.is-invalid~.invalid-feedback,
        .form-check-input.is-invalid~.invalid-tooltip,
        .was-validated .form-check-input:invalid~.invalid-feedback,
        .was-validated .form-check-input:invalid~.invalid-tooltip {
            display: block
        }

        .custom-control-input.is-invalid~.custom-control-label,
        .was-validated .custom-control-input:invalid~.custom-control-label {
            color: #dc3545
        }

        .custom-control-input.is-invalid~.custom-control-label::before,
        .was-validated .custom-control-input:invalid~.custom-control-label::before {
            border-color: #dc3545
        }

        .custom-control-input.is-invalid~.invalid-feedback,
        .custom-control-input.is-invalid~.invalid-tooltip,
        .was-validated .custom-control-input:invalid~.invalid-feedback,
        .was-validated .custom-control-input:invalid~.invalid-tooltip {
            display: block
        }

        .custom-control-input.is-invalid:checked~.custom-control-label::before,
        .was-validated .custom-control-input:invalid:checked~.custom-control-label::before {
            border-color: #e4606d;
            background-color: #e4606d
        }

        .custom-control-input.is-invalid:focus~.custom-control-label::before,
        .was-validated .custom-control-input:invalid:focus~.custom-control-label::before {
            box-shadow: 0 0 0 .2rem rgba(220, 53, 69, .25)
        }

        .custom-control-input.is-invalid:focus:not(:checked)~.custom-control-label::before,
        .was-validated .custom-control-input:invalid:focus:not(:checked)~.custom-control-label::before {
            border-color: #dc3545
        }

        .custom-file-input.is-invalid~.custom-file-label,
        .was-validated .custom-file-input:invalid~.custom-file-label {
            border-color: #dc3545
        }

        .custom-file-input.is-invalid~.invalid-feedback,
        .custom-file-input.is-invalid~.invalid-tooltip,
        .was-validated .custom-file-input:invalid~.invalid-feedback,
        .was-validated .custom-file-input:invalid~.invalid-tooltip {
            display: block
        }

        .custom-file-input.is-invalid:focus~.custom-file-label,
        .was-validated .custom-file-input:invalid:focus~.custom-file-label {
            border-color: #dc3545;
            box-shadow: 0 0 0 .2rem rgba(220, 53, 69, .25)
        }

        .form-inline {
            display: -ms-flexbox;
            display: flex;
            -ms-flex-flow: row wrap;
            flex-flow: row wrap;
            -ms-flex-align: center;
            align-items: center
        }

        .form-inline .form-check {
            width: 100%
        }

        @media (min-width:576px) {
            .form-inline label {
                display: -ms-flexbox;
                display: flex;
                -ms-flex-align: center;
                align-items: center;
                -ms-flex-pack: center;
                justify-content: center;
                margin-bottom: 0
            }

            .form-inline .form-group {
                display: -ms-flexbox;
                display: flex;
                -ms-flex: 0 0 auto;
                flex: 0 0 auto;
                -ms-flex-flow: row wrap;
                flex-flow: row wrap;
                -ms-flex-align: center;
                align-items: center;
                margin-bottom: 0
            }

            .form-inline .form-control {
                display: inline-block;
                width: auto;
                vertical-align: middle
            }

            .form-inline .form-control-plaintext {
                display: inline-block
            }

            .form-inline .custom-select,
            .form-inline .input-group {
                width: auto
            }

            .form-inline .form-check {
                display: -ms-flexbox;
                display: flex;
                -ms-flex-align: center;
                align-items: center;
                -ms-flex-pack: center;
                justify-content: center;
                width: auto;
                padding-left: 0
            }

            .form-inline .form-check-input {
                position: relative;
                -ms-flex-negative: 0;
                flex-shrink: 0;
                margin-top: 0;
                margin-right: .25rem;
                margin-left: 0
            }

            .form-inline .custom-control {
                -ms-flex-align: center;
                align-items: center;
                -ms-flex-pack: center;
                justify-content: center
            }

            .form-inline .custom-control-label {
                margin-bottom: 0
            }
        }

        .btn {
            display: inline-block;
            font-weight: 400;
            color: #212529;
            text-align: center;
            vertical-align: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            background-color: transparent;
            border: 1px solid transparent;
            padding: .375rem .75rem;
            font-size: 1rem;
            line-height: 1.5;
            border-radius: .25rem;
            transition: color .15s ease-in-out, background-color .15s ease-in-out, border-color .15s ease-in-out, box-shadow .15s ease-in-out
        }

        @media (prefers-reduced-motion:reduce) {
            .btn {
                transition: none
            }
        }

        .btn:hover {
            color: #212529;
            text-decoration: none
        }

        .btn.focus,
        .btn:focus {
            outline: 0;
            box-shadow: 0 0 0 .2rem rgba(0, 123, 255, .25)
        }

        .btn.disabled,
        .btn:disabled {
            opacity: .65
        }

        a.btn.disabled,
        fieldset:disabled a.btn {
            pointer-events: none
        }

        .btn-primary {
            color: #fff;
            background-color: #007bff;
            border-color: #007bff
        }

        .btn-primary:hover {
            color: #fff;
            background-color: #0069d9;
            border-color: #0062cc
        }

        .btn-primary.focus,
        .btn-primary:focus {
            box-shadow: 0 0 0 .2rem rgba(38, 143, 255, .5)
        }

        .btn-primary.disabled,
        .btn-primary:disabled {
            color: #fff;
            background-color: #007bff;
            border-color: #007bff
        }

        .btn-primary:not(:disabled):not(.disabled).active,
        .btn-primary:not(:disabled):not(.disabled):active,
        .show>.btn-primary.dropdown-toggle {
            color: #fff;
            background-color: #0062cc;
            border-color: #005cbf
        }

        .btn-primary:not(:disabled):not(.disabled).active:focus,
        .btn-primary:not(:disabled):not(.disabled):active:focus,
        .show>.btn-primary.dropdown-toggle:focus {
            box-shadow: 0 0 0 .2rem rgba(38, 143, 255, .5)
        }

        .btn-secondary {
            color: #fff;
            background-color: #6c757d;
            border-color: #6c757d
        }

        .btn-secondary:hover {
            color: #fff;
            background-color: #5a6268;
            border-color: #545b62
        }

        .btn-secondary.focus,
        .btn-secondary:focus {
            box-shadow: 0 0 0 .2rem rgba(130, 138, 145, .5)
        }

        .btn-secondary.disabled,
        .btn-secondary:disabled {
            color: #fff;
            background-color: #6c757d;
            border-color: #6c757d
        }

        .btn-secondary:not(:disabled):not(.disabled).active,
        .btn-secondary:not(:disabled):not(.disabled):active,
        .show>.btn-secondary.dropdown-toggle {
            color: #fff;
            background-color: #545b62;
            border-color: #4e555b
        }

        .btn-secondary:not(:disabled):not(.disabled).active:focus,
        .btn-secondary:not(:disabled):not(.disabled):active:focus,
        .show>.btn-secondary.dropdown-toggle:focus {
            box-shadow: 0 0 0 .2rem rgba(130, 138, 145, .5)
        }

        .btn-success {
            color: #fff;
            background-color: #28a745;
            border-color: #28a745
        }

        .btn-success:hover {
            color: #fff;
            background-color: #218838;
            border-color: #1e7e34
        }

        .btn-success.focus,
        .btn-success:focus {
            box-shadow: 0 0 0 .2rem rgba(72, 180, 97, .5)
        }

        .btn-success.disabled,
        .btn-success:disabled {
            color: #fff;
            background-color: #28a745;
            border-color: #28a745
        }

        .btn-success:not(:disabled):not(.disabled).active,
        .btn-success:not(:disabled):not(.disabled):active,
        .show>.btn-success.dropdown-toggle {
            color: #fff;
            background-color: #1e7e34;
            border-color: #1c7430
        }

        .btn-success:not(:disabled):not(.disabled).active:focus,
        .btn-success:not(:disabled):not(.disabled):active:focus,
        .show>.btn-success.dropdown-toggle:focus {
            box-shadow: 0 0 0 .2rem rgba(72, 180, 97, .5)
        }

        .btn-info {
            color: #fff;
            background-color: #17a2b8;
            border-color: #17a2b8
        }

        .btn-info:hover {
            color: #fff;
            background-color: #138496;
            border-color: #117a8b
        }

        .btn-info.focus,
        .btn-info:focus {
            box-shadow: 0 0 0 .2rem rgba(58, 176, 195, .5)
        }

        .btn-info.disabled,
        .btn-info:disabled {
            color: #fff;
            background-color: #17a2b8;
            border-color: #17a2b8
        }

        .btn-info:not(:disabled):not(.disabled).active,
        .btn-info:not(:disabled):not(.disabled):active,
        .show>.btn-info.dropdown-toggle {
            color: #fff;
            background-color: #117a8b;
            border-color: #10707f
        }

        .btn-info:not(:disabled):not(.disabled).active:focus,
        .btn-info:not(:disabled):not(.disabled):active:focus,
        .show>.btn-info.dropdown-toggle:focus {
            box-shadow: 0 0 0 .2rem rgba(58, 176, 195, .5)
        }

        .btn-warning {
            color: #212529;
            background-color: #ffc107;
            border-color: #ffc107
        }

        .btn-warning:hover {
            color: #212529;
            background-color: #e0a800;
            border-color: #d39e00
        }

        .btn-warning.focus,
        .btn-warning:focus {
            box-shadow: 0 0 0 .2rem rgba(222, 170, 12, .5)
        }

        .btn-warning.disabled,
        .btn-warning:disabled {
            color: #212529;
            background-color: #ffc107;
            border-color: #ffc107
        }

        .btn-warning:not(:disabled):not(.disabled).active,
        .btn-warning:not(:disabled):not(.disabled):active,
        .show>.btn-warning.dropdown-toggle {
            color: #212529;
            background-color: #d39e00;
            border-color: #c69500
        }

        .btn-warning:not(:disabled):not(.disabled).active:focus,
        .btn-warning:not(:disabled):not(.disabled):active:focus,
        .show>.btn-warning.dropdown-toggle:focus {
            box-shadow: 0 0 0 .2rem rgba(222, 170, 12, .5)
        }

        .btn-danger {
            color: #fff;
            background-color: #dc3545;
            border-color: #dc3545
        }

        .btn-danger:hover {
            color: #fff;
            background-color: #c82333;
            border-color: #bd2130
        }

        .btn-danger.focus,
        .btn-danger:focus {
            box-shadow: 0 0 0 .2rem rgba(225, 83, 97, .5)
        }

        .btn-danger.disabled,
        .btn-danger:disabled {
            color: #fff;
            background-color: #dc3545;
            border-color: #dc3545
        }

        .btn-danger:not(:disabled):not(.disabled).active,
        .btn-danger:not(:disabled):not(.disabled):active,
        .show>.btn-danger.dropdown-toggle {
            color: #fff;
            background-color: #bd2130;
            border-color: #b21f2d
        }

        .btn-danger:not(:disabled):not(.disabled).active:focus,
        .btn-danger:not(:disabled):not(.disabled):active:focus,
        .show>.btn-danger.dropdown-toggle:focus {
            box-shadow: 0 0 0 .2rem rgba(225, 83, 97, .5)
        }

        .btn-light {
            color: #212529;
            background-color: #f8f9fa;
            border-color: #f8f9fa
        }

        .btn-light:hover {
            color: #212529;
            background-color: #e2e6ea;
            border-color: #dae0e5
        }

        .btn-light.focus,
        .btn-light:focus {
            box-shadow: 0 0 0 .2rem rgba(216, 217, 219, .5)
        }

        .btn-light.disabled,
        .btn-light:disabled {
            color: #212529;
            background-color: #f8f9fa;
            border-color: #f8f9fa
        }

        .btn-light:not(:disabled):not(.disabled).active,
        .btn-light:not(:disabled):not(.disabled):active,
        .show>.btn-light.dropdown-toggle {
            color: #212529;
            background-color: #dae0e5;
            border-color: #d3d9df
        }

        .btn-light:not(:disabled):not(.disabled).active:focus,
        .btn-light:not(:disabled):not(.disabled):active:focus,
        .show>.btn-light.dropdown-toggle:focus {
            box-shadow: 0 0 0 .2rem rgba(216, 217, 219, .5)
        }

        .btn-dark {
            color: #fff;
            background-color: #343a40;
            border-color: #343a40
        }

        .btn-dark:hover {
            color: #fff;
            background-color: #23272b;
            border-color: #1d2124
        }

        .btn-dark.focus,
        .btn-dark:focus {
            box-shadow: 0 0 0 .2rem rgba(82, 88, 93, .5)
        }

        .btn-dark.disabled,
        .btn-dark:disabled {
            color: #fff;
            background-color: #343a40;
            border-color: #343a40
        }

        .btn-dark:not(:disabled):not(.disabled).active,
        .btn-dark:not(:disabled):not(.disabled):active,
        .show>.btn-dark.dropdown-toggle {
            color: #fff;
            background-color: #1d2124;
            border-color: #171a1d
        }

        .btn-dark:not(:disabled):not(.disabled).active:focus,
        .btn-dark:not(:disabled):not(.disabled):active:focus,
        .show>.btn-dark.dropdown-toggle:focus {
            box-shadow: 0 0 0 .2rem rgba(82, 88, 93, .5)
        }

        .btn-outline-primary {
            color: #007bff;
            border-color: #007bff
        }

        .btn-outline-primary:hover {
            color: #fff;
            background-color: #007bff;
            border-color: #007bff
        }

        .btn-outline-primary.focus,
        .btn-outline-primary:focus {
            box-shadow: 0 0 0 .2rem rgba(0, 123, 255, .5)
        }

        .btn-outline-primary.disabled,
        .btn-outline-primary:disabled {
            color: #007bff;
            background-color: transparent
        }

        .btn-outline-primary:not(:disabled):not(.disabled).active,
        .btn-outline-primary:not(:disabled):not(.disabled):active,
        .show>.btn-outline-primary.dropdown-toggle {
            color: #fff;
            background-color: #007bff;
            border-color: #007bff
        }

        .btn-outline-primary:not(:disabled):not(.disabled).active:focus,
        .btn-outline-primary:not(:disabled):not(.disabled):active:focus,
        .show>.btn-outline-primary.dropdown-toggle:focus {
            box-shadow: 0 0 0 .2rem rgba(0, 123, 255, .5)
        }

        .btn-outline-secondary {
            color: #6c757d;
            border-color: #6c757d
        }

        .btn-outline-secondary:hover {
            color: #fff;
            background-color: #6c757d;
            border-color: #6c757d
        }

        .btn-outline-secondary.focus,
        .btn-outline-secondary:focus {
            box-shadow: 0 0 0 .2rem rgba(108, 117, 125, .5)
        }

        .btn-outline-secondary.disabled,
        .btn-outline-secondary:disabled {
            color: #6c757d;
            background-color: transparent
        }

        .btn-outline-secondary:not(:disabled):not(.disabled).active,
        .btn-outline-secondary:not(:disabled):not(.disabled):active,
        .show>.btn-outline-secondary.dropdown-toggle {
            color: #fff;
            background-color: #6c757d;
            border-color: #6c757d
        }

        .btn-outline-secondary:not(:disabled):not(.disabled).active:focus,
        .btn-outline-secondary:not(:disabled):not(.disabled):active:focus,
        .show>.btn-outline-secondary.dropdown-toggle:focus {
            box-shadow: 0 0 0 .2rem rgba(108, 117, 125, .5)
        }

        .btn-outline-success {
            color: #28a745;
            border-color: #28a745
        }

        .btn-outline-success:hover {
            color: #fff;
            background-color: #28a745;
            border-color: #28a745
        }

        .btn-outline-success.focus,
        .btn-outline-success:focus {
            box-shadow: 0 0 0 .2rem rgba(40, 167, 69, .5)
        }

        .btn-outline-success.disabled,
        .btn-outline-success:disabled {
            color: #28a745;
            background-color: transparent
        }

        .btn-outline-success:not(:disabled):not(.disabled).active,
        .btn-outline-success:not(:disabled):not(.disabled):active,
        .show>.btn-outline-success.dropdown-toggle {
            color: #fff;
            background-color: #28a745;
            border-color: #28a745
        }

        .btn-outline-success:not(:disabled):not(.disabled).active:focus,
        .btn-outline-success:not(:disabled):not(.disabled):active:focus,
        .show>.btn-outline-success.dropdown-toggle:focus {
            box-shadow: 0 0 0 .2rem rgba(40, 167, 69, .5)
        }

        .btn-outline-info {
            color: #17a2b8;
            border-color: #17a2b8
        }

        .btn-outline-info:hover {
            color: #fff;
            background-color: #17a2b8;
            border-color: #17a2b8
        }

        .btn-outline-info.focus,
        .btn-outline-info:focus {
            box-shadow: 0 0 0 .2rem rgba(23, 162, 184, .5)
        }

        .btn-outline-info.disabled,
        .btn-outline-info:disabled {
            color: #17a2b8;
            background-color: transparent
        }

        .btn-outline-info:not(:disabled):not(.disabled).active,
        .btn-outline-info:not(:disabled):not(.disabled):active,
        .show>.btn-outline-info.dropdown-toggle {
            color: #fff;
            background-color: #17a2b8;
            border-color: #17a2b8
        }

        .btn-outline-info:not(:disabled):not(.disabled).active:focus,
        .btn-outline-info:not(:disabled):not(.disabled):active:focus,
        .show>.btn-outline-info.dropdown-toggle:focus {
            box-shadow: 0 0 0 .2rem rgba(23, 162, 184, .5)
        }

        .btn-outline-warning {
            color: #ffc107;
            border-color: #ffc107
        }

        .btn-outline-warning:hover {
            color: #212529;
            background-color: #ffc107;
            border-color: #ffc107
        }

        .btn-outline-warning.focus,
        .btn-outline-warning:focus {
            box-shadow: 0 0 0 .2rem rgba(255, 193, 7, .5)
        }

        .btn-outline-warning.disabled,
        .btn-outline-warning:disabled {
            color: #ffc107;
            background-color: transparent
        }

        .btn-outline-warning:not(:disabled):not(.disabled).active,
        .btn-outline-warning:not(:disabled):not(.disabled):active,
        .show>.btn-outline-warning.dropdown-toggle {
            color: #212529;
            background-color: #ffc107;
            border-color: #ffc107
        }

        .btn-outline-warning:not(:disabled):not(.disabled).active:focus,
        .btn-outline-warning:not(:disabled):not(.disabled):active:focus,
        .show>.btn-outline-warning.dropdown-toggle:focus {
            box-shadow: 0 0 0 .2rem rgba(255, 193, 7, .5)
        }

        .btn-outline-danger {
            color: #dc3545;
            border-color: #dc3545
        }

        .btn-outline-danger:hover {
            color: #fff;
            background-color: #dc3545;
            border-color: #dc3545
        }

        .btn-outline-danger.focus,
        .btn-outline-danger:focus {
            box-shadow: 0 0 0 .2rem rgba(220, 53, 69, .5)
        }

        .btn-outline-danger.disabled,
        .btn-outline-danger:disabled {
            color: #dc3545;
            background-color: transparent
        }

        .btn-outline-danger:not(:disabled):not(.disabled).active,
        .btn-outline-danger:not(:disabled):not(.disabled):active,
        .show>.btn-outline-danger.dropdown-toggle {
            color: #fff;
            background-color: #dc3545;
            border-color: #dc3545
        }

        .btn-outline-danger:not(:disabled):not(.disabled).active:focus,
        .btn-outline-danger:not(:disabled):not(.disabled):active:focus,
        .show>.btn-outline-danger.dropdown-toggle:focus {
            box-shadow: 0 0 0 .2rem rgba(220, 53, 69, .5)
        }

        .btn-outline-light {
            color: #f8f9fa;
            border-color: #f8f9fa
        }

        .btn-outline-light:hover {
            color: #212529;
            background-color: #f8f9fa;
            border-color: #f8f9fa
        }

        .btn-outline-light.focus,
        .btn-outline-light:focus {
            box-shadow: 0 0 0 .2rem rgba(248, 249, 250, .5)
        }

        .btn-outline-light.disabled,
        .btn-outline-light:disabled {
            color: #f8f9fa;
            background-color: transparent
        }

        .btn-outline-light:not(:disabled):not(.disabled).active,
        .btn-outline-light:not(:disabled):not(.disabled):active,
        .show>.btn-outline-light.dropdown-toggle {
            color: #212529;
            background-color: #f8f9fa;
            border-color: #f8f9fa
        }

        .btn-outline-light:not(:disabled):not(.disabled).active:focus,
        .btn-outline-light:not(:disabled):not(.disabled):active:focus,
        .show>.btn-outline-light.dropdown-toggle:focus {
            box-shadow: 0 0 0 .2rem rgba(248, 249, 250, .5)
        }

        .btn-outline-dark {
            color: #343a40;
            border-color: #343a40
        }

        .btn-outline-dark:hover {
            color: #fff;
            background-color: #343a40;
            border-color: #343a40
        }

        .btn-outline-dark.focus,
        .btn-outline-dark:focus {
            box-shadow: 0 0 0 .2rem rgba(52, 58, 64, .5)
        }

        .btn-outline-dark.disabled,
        .btn-outline-dark:disabled {
            color: #343a40;
            background-color: transparent
        }

        .btn-outline-dark:not(:disabled):not(.disabled).active,
        .btn-outline-dark:not(:disabled):not(.disabled):active,
        .show>.btn-outline-dark.dropdown-toggle {
            color: #fff;
            background-color: #343a40;
            border-color: #343a40
        }

        .btn-outline-dark:not(:disabled):not(.disabled).active:focus,
        .btn-outline-dark:not(:disabled):not(.disabled):active:focus,
        .show>.btn-outline-dark.dropdown-toggle:focus {
            box-shadow: 0 0 0 .2rem rgba(52, 58, 64, .5)
        }

        .btn-link {
            font-weight: 400;
            color: #007bff;
            text-decoration: none
        }

        .btn-link:hover {
            color: #0056b3;
            text-decoration: underline
        }

        .btn-link.focus,
        .btn-link:focus {
            text-decoration: underline;
            box-shadow: none
        }

        .btn-link.disabled,
        .btn-link:disabled {
            color: #6c757d;
            pointer-events: none
        }

        .btn-group-lg>.btn,
        .btn-lg {
            padding: .5rem 1rem;
            font-size: 1.25rem;
            line-height: 1.5;
            border-radius: .3rem
        }

        .btn-group-sm>.btn,
        .btn-sm {
            padding: .25rem .5rem;
            font-size: .875rem;
            line-height: 1.5;
            border-radius: .2rem
        }

        .btn-block {
            display: block;
            width: 100%
        }

        .btn-block+.btn-block {
            margin-top: .5rem
        }

        input[type=button].btn-block,
        input[type=reset].btn-block,
        input[type=submit].btn-block {
            width: 100%
        }

        .fade {
            transition: opacity .15s linear
        }

        @media (prefers-reduced-motion:reduce) {
            .fade {
                transition: none
            }
        }

        .fade:not(.show) {
            opacity: 0
        }

        .collapse:not(.show) {
            display: none
        }

        .collapsing {
            position: relative;
            height: 0;
            overflow: hidden;
            transition: height .35s ease
        }

        @media (prefers-reduced-motion:reduce) {
            .collapsing {
                transition: none
            }
        }

        .dropdown,
        .dropleft,
        .dropright,
        .dropup {
            position: relative
        }

        .dropdown-toggle {
            white-space: nowrap
        }

        .dropdown-toggle::after {
            display: inline-block;
            margin-left: .255em;
            vertical-align: .255em;
            content: "";
            border-top: .3em solid;
            border-right: .3em solid transparent;
            border-bottom: 0;
            border-left: .3em solid transparent
        }

        .dropdown-toggle:empty::after {
            margin-left: 0
        }

        .dropdown-menu {
            position: absolute;
            top: 100%;
            left: 0;
            z-index: 1000;
            display: none;
            float: left;
            min-width: 10rem;
            padding: .5rem 0;
            margin: .125rem 0 0;
            font-size: 1rem;
            color: #212529;
            text-align: left;
            list-style: none;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid rgba(0, 0, 0, .15);
            border-radius: .25rem
        }

        .dropdown-menu-left {
            right: auto;
            left: 0
        }

        .dropdown-menu-right {
            right: 0;
            left: auto
        }

        @media (min-width:576px) {
            .dropdown-menu-sm-left {
                right: auto;
                left: 0
            }

            .dropdown-menu-sm-right {
                right: 0;
                left: auto
            }
        }

        @media (min-width:768px) {
            .dropdown-menu-md-left {
                right: auto;
                left: 0
            }

            .dropdown-menu-md-right {
                right: 0;
                left: auto
            }
        }

        @media (min-width:992px) {
            .dropdown-menu-lg-left {
                right: auto;
                left: 0
            }

            .dropdown-menu-lg-right {
                right: 0;
                left: auto
            }
        }

        @media (min-width:1200px) {
            .dropdown-menu-xl-left {
                right: auto;
                left: 0
            }

            .dropdown-menu-xl-right {
                right: 0;
                left: auto
            }
        }

        .dropup .dropdown-menu {
            top: auto;
            bottom: 100%;
            margin-top: 0;
            margin-bottom: .125rem
        }

        .dropup .dropdown-toggle::after {
            display: inline-block;
            margin-left: .255em;
            vertical-align: .255em;
            content: "";
            border-top: 0;
            border-right: .3em solid transparent;
            border-bottom: .3em solid;
            border-left: .3em solid transparent
        }

        .dropup .dropdown-toggle:empty::after {
            margin-left: 0
        }

        .dropright .dropdown-menu {
            top: 0;
            right: auto;
            left: 100%;
            margin-top: 0;
            margin-left: .125rem
        }

        .dropright .dropdown-toggle::after {
            display: inline-block;
            margin-left: .255em;
            vertical-align: .255em;
            content: "";
            border-top: .3em solid transparent;
            border-right: 0;
            border-bottom: .3em solid transparent;
            border-left: .3em solid
        }

        .dropright .dropdown-toggle:empty::after {
            margin-left: 0
        }

        .dropright .dropdown-toggle::after {
            vertical-align: 0
        }

        .dropleft .dropdown-menu {
            top: 0;
            right: 100%;
            left: auto;
            margin-top: 0;
            margin-right: .125rem
        }

        .dropleft .dropdown-toggle::after {
            display: inline-block;
            margin-left: .255em;
            vertical-align: .255em;
            content: ""
        }

        .dropleft .dropdown-toggle::after {
            display: none
        }

        .dropleft .dropdown-toggle::before {
            display: inline-block;
            margin-right: .255em;
            vertical-align: .255em;
            content: "";
            border-top: .3em solid transparent;
            border-right: .3em solid;
            border-bottom: .3em solid transparent
        }

        .dropleft .dropdown-toggle:empty::after {
            margin-left: 0
        }

        .dropleft .dropdown-toggle::before {
            vertical-align: 0
        }

        .dropdown-menu[x-placement^=bottom],
        .dropdown-menu[x-placement^=left],
        .dropdown-menu[x-placement^=right],
        .dropdown-menu[x-placement^=top] {
            right: auto;
            bottom: auto
        }

        .dropdown-divider {
            height: 0;
            margin: .5rem 0;
            overflow: hidden;
            border-top: 1px solid #e9ecef
        }

        .dropdown-item {
            display: block;
            width: 100%;
            padding: .25rem 1.5rem;
            clear: both;
            font-weight: 400;
            color: #212529;
            text-align: inherit;
            white-space: nowrap;
            background-color: transparent;
            border: 0
        }

        .dropdown-item:focus,
        .dropdown-item:hover {
            color: #16181b;
            text-decoration: none;
            background-color: #f8f9fa
        }

        .dropdown-item.active,
        .dropdown-item:active {
            color: #fff;
            text-decoration: none;
            background-color: #007bff
        }

        .dropdown-item.disabled,
        .dropdown-item:disabled {
            color: #6c757d;
            pointer-events: none;
            background-color: transparent
        }

        .dropdown-menu.show {
            display: block
        }

        .dropdown-header {
            display: block;
            padding: .5rem 1.5rem;
            margin-bottom: 0;
            font-size: .875rem;
            color: #6c757d;
            white-space: nowrap
        }

        .dropdown-item-text {
            display: block;
            padding: .25rem 1.5rem;
            color: #212529
        }

        .btn-group,
        .btn-group-vertical {
            position: relative;
            display: -ms-inline-flexbox;
            display: inline-flex;
            vertical-align: middle
        }

        .btn-group-vertical>.btn,
        .btn-group>.btn {
            position: relative;
            -ms-flex: 1 1 auto;
            flex: 1 1 auto
        }

        .btn-group-vertical>.btn:hover,
        .btn-group>.btn:hover {
            z-index: 1
        }

        .btn-group-vertical>.btn.active,
        .btn-group-vertical>.btn:active,
        .btn-group-vertical>.btn:focus,
        .btn-group>.btn.active,
        .btn-group>.btn:active,
        .btn-group>.btn:focus {
            z-index: 1
        }

        .btn-toolbar {
            display: -ms-flexbox;
            display: flex;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
            -ms-flex-pack: start;
            justify-content: flex-start
        }

        .btn-toolbar .input-group {
            width: auto
        }

        .btn-group>.btn-group:not(:first-child),
        .btn-group>.btn:not(:first-child) {
            margin-left: -1px
        }

        .btn-group>.btn-group:not(:last-child)>.btn,
        .btn-group>.btn:not(:last-child):not(.dropdown-toggle) {
            border-top-right-radius: 0;
            border-bottom-right-radius: 0
        }

        .btn-group>.btn-group:not(:first-child)>.btn,
        .btn-group>.btn:not(:first-child) {
            border-top-left-radius: 0;
            border-bottom-left-radius: 0
        }

        .dropdown-toggle-split {
            padding-right: .5625rem;
            padding-left: .5625rem
        }

        .dropdown-toggle-split::after,
        .dropright .dropdown-toggle-split::after,
        .dropup .dropdown-toggle-split::after {
            margin-left: 0
        }

        .dropleft .dropdown-toggle-split::before {
            margin-right: 0
        }

        .btn-group-sm>.btn+.dropdown-toggle-split,
        .btn-sm+.dropdown-toggle-split {
            padding-right: .375rem;
            padding-left: .375rem
        }

        .btn-group-lg>.btn+.dropdown-toggle-split,
        .btn-lg+.dropdown-toggle-split {
            padding-right: .75rem;
            padding-left: .75rem
        }

        .btn-group-vertical {
            -ms-flex-direction: column;
            flex-direction: column;
            -ms-flex-align: start;
            align-items: flex-start;
            -ms-flex-pack: center;
            justify-content: center
        }

        .btn-group-vertical>.btn,
        .btn-group-vertical>.btn-group {
            width: 100%
        }

        .btn-group-vertical>.btn-group:not(:first-child),
        .btn-group-vertical>.btn:not(:first-child) {
            margin-top: -1px
        }

        .btn-group-vertical>.btn-group:not(:last-child)>.btn,
        .btn-group-vertical>.btn:not(:last-child):not(.dropdown-toggle) {
            border-bottom-right-radius: 0;
            border-bottom-left-radius: 0
        }

        .btn-group-vertical>.btn-group:not(:first-child)>.btn,
        .btn-group-vertical>.btn:not(:first-child) {
            border-top-left-radius: 0;
            border-top-right-radius: 0
        }

        .btn-group-toggle>.btn,
        .btn-group-toggle>.btn-group>.btn {
            margin-bottom: 0
        }

        .btn-group-toggle>.btn input[type=checkbox],
        .btn-group-toggle>.btn input[type=radio],
        .btn-group-toggle>.btn-group>.btn input[type=checkbox],
        .btn-group-toggle>.btn-group>.btn input[type=radio] {
            position: absolute;
            clip: rect(0, 0, 0, 0);
            pointer-events: none
        }

        .input-group {
            position: relative;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
            -ms-flex-align: stretch;
            align-items: stretch;
            width: 100%
        }

        .input-group>.custom-file,
        .input-group>.custom-select,
        .input-group>.form-control,
        .input-group>.form-control-plaintext {
            position: relative;
            -ms-flex: 1 1 auto;
            flex: 1 1 auto;
            width: 1%;
            margin-bottom: 0
        }

        .input-group>.custom-file+.custom-file,
        .input-group>.custom-file+.custom-select,
        .input-group>.custom-file+.form-control,
        .input-group>.custom-select+.custom-file,
        .input-group>.custom-select+.custom-select,
        .input-group>.custom-select+.form-control,
        .input-group>.form-control+.custom-file,
        .input-group>.form-control+.custom-select,
        .input-group>.form-control+.form-control,
        .input-group>.form-control-plaintext+.custom-file,
        .input-group>.form-control-plaintext+.custom-select,
        .input-group>.form-control-plaintext+.form-control {
            margin-left: -1px
        }

        .input-group>.custom-file .custom-file-input:focus~.custom-file-label,
        .input-group>.custom-select:focus,
        .input-group>.form-control:focus {
            z-index: 3
        }

        .input-group>.custom-file .custom-file-input:focus {
            z-index: 4
        }

        .input-group>.custom-select:not(:last-child),
        .input-group>.form-control:not(:last-child) {
            border-top-right-radius: 0;
            border-bottom-right-radius: 0
        }

        .input-group>.custom-select:not(:first-child),
        .input-group>.form-control:not(:first-child) {
            border-top-left-radius: 0;
            border-bottom-left-radius: 0
        }

        .input-group>.custom-file {
            display: -ms-flexbox;
            display: flex;
            -ms-flex-align: center;
            align-items: center
        }

        .input-group>.custom-file:not(:last-child) .custom-file-label,
        .input-group>.custom-file:not(:last-child) .custom-file-label::after {
            border-top-right-radius: 0;
            border-bottom-right-radius: 0
        }

        .input-group>.custom-file:not(:first-child) .custom-file-label {
            border-top-left-radius: 0;
            border-bottom-left-radius: 0
        }

        .input-group-append,
        .input-group-prepend {
            display: -ms-flexbox;
            display: flex
        }

        .input-group-append .btn,
        .input-group-prepend .btn {
            position: relative;
            z-index: 2
        }

        .input-group-append .btn:focus,
        .input-group-prepend .btn:focus {
            z-index: 3
        }

        .input-group-append .btn+.btn,
        .input-group-append .btn+.input-group-text,
        .input-group-append .input-group-text+.btn,
        .input-group-append .input-group-text+.input-group-text,
        .input-group-prepend .btn+.btn,
        .input-group-prepend .btn+.input-group-text,
        .input-group-prepend .input-group-text+.btn,
        .input-group-prepend .input-group-text+.input-group-text {
            margin-left: -1px
        }

        .input-group-prepend {
            margin-right: -1px
        }

        .input-group-append {
            margin-left: -1px
        }

        .input-group-text {
            display: -ms-flexbox;
            display: flex;
            -ms-flex-align: center;
            align-items: center;
            padding: .375rem .75rem;
            margin-bottom: 0;
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: #495057;
            text-align: center;
            white-space: nowrap;
            background-color: #e9ecef;
            border: 1px solid #ced4da;
            border-radius: .25rem
        }

        .input-group-text input[type=checkbox],
        .input-group-text input[type=radio] {
            margin-top: 0
        }

        .input-group-lg>.custom-select,
        .input-group-lg>.form-control:not(textarea) {
            height: calc(1.5em + 1rem + 2px)
        }

        .input-group-lg>.custom-select,
        .input-group-lg>.form-control,
        .input-group-lg>.input-group-append>.btn,
        .input-group-lg>.input-group-append>.input-group-text,
        .input-group-lg>.input-group-prepend>.btn,
        .input-group-lg>.input-group-prepend>.input-group-text {
            padding: .5rem 1rem;
            font-size: 1.25rem;
            line-height: 1.5;
            border-radius: .3rem
        }

        .input-group-sm>.custom-select,
        .input-group-sm>.form-control:not(textarea) {
            height: calc(1.5em + .5rem + 2px)
        }

        .input-group-sm>.custom-select,
        .input-group-sm>.form-control,
        .input-group-sm>.input-group-append>.btn,
        .input-group-sm>.input-group-append>.input-group-text,
        .input-group-sm>.input-group-prepend>.btn,
        .input-group-sm>.input-group-prepend>.input-group-text {
            padding: .25rem .5rem;
            font-size: .875rem;
            line-height: 1.5;
            border-radius: .2rem
        }

        .input-group-lg>.custom-select,
        .input-group-sm>.custom-select {
            padding-right: 1.75rem
        }

        .input-group>.input-group-append:last-child>.btn:not(:last-child):not(.dropdown-toggle),
        .input-group>.input-group-append:last-child>.input-group-text:not(:last-child),
        .input-group>.input-group-append:not(:last-child)>.btn,
        .input-group>.input-group-append:not(:last-child)>.input-group-text,
        .input-group>.input-group-prepend>.btn,
        .input-group>.input-group-prepend>.input-group-text {
            border-top-right-radius: 0;
            border-bottom-right-radius: 0
        }

        .input-group>.input-group-append>.btn,
        .input-group>.input-group-append>.input-group-text,
        .input-group>.input-group-prepend:first-child>.btn:not(:first-child),
        .input-group>.input-group-prepend:first-child>.input-group-text:not(:first-child),
        .input-group>.input-group-prepend:not(:first-child)>.btn,
        .input-group>.input-group-prepend:not(:first-child)>.input-group-text {
            border-top-left-radius: 0;
            border-bottom-left-radius: 0
        }

        .custom-control {
            position: relative;
            display: block;
            min-height: 1.5rem;
            padding-left: 1.5rem
        }

        .custom-control-inline {
            display: -ms-inline-flexbox;
            display: inline-flex;
            margin-right: 1rem
        }

        .custom-control-input {
            position: absolute;
            z-index: -1;
            opacity: 0
        }

        .custom-control-input:checked~.custom-control-label::before {
            color: #fff;
            border-color: #007bff;
            background-color: #007bff
        }

        .custom-control-input:focus~.custom-control-label::before {
            box-shadow: 0 0 0 .2rem rgba(0, 123, 255, .25)
        }

        .custom-control-input:focus:not(:checked)~.custom-control-label::before {
            border-color: #80bdff
        }

        .custom-control-input:not(:disabled):active~.custom-control-label::before {
            color: #fff;
            background-color: #b3d7ff;
            border-color: #b3d7ff
        }

        .custom-control-input:disabled~.custom-control-label {
            color: #6c757d
        }

        .custom-control-input:disabled~.custom-control-label::before {
            background-color: #e9ecef
        }

        .custom-control-label {
            position: relative;
            margin-bottom: 0;
            vertical-align: top
        }

        .custom-control-label::before {
            position: absolute;
            top: .25rem;
            left: -1.5rem;
            display: block;
            width: 1rem;
            height: 1rem;
            pointer-events: none;
            content: "";
            background-color: #fff;
            border: #adb5bd solid 1px
        }

        .custom-control-label::after {
            position: absolute;
            top: .25rem;
            left: -1.5rem;
            display: block;
            width: 1rem;
            height: 1rem;
            content: "";
            background: no-repeat 50%/50% 50%
        }

        .custom-checkbox .custom-control-label::before {
            border-radius: .25rem
        }

        .custom-checkbox .custom-control-input:checked~.custom-control-label::after {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 8 8'%3e%3cpath fill='%23fff' d='M6.564.75l-3.59 3.612-1.538-1.55L0 4.26 2.974 7.25 8 2.193z'/%3e%3c/svg%3e")
        }

        .custom-checkbox .custom-control-input:indeterminate~.custom-control-label::before {
            border-color: #007bff;
            background-color: #007bff
        }

        .custom-checkbox .custom-control-input:indeterminate~.custom-control-label::after {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 4 4'%3e%3cpath stroke='%23fff' d='M0 2h4'/%3e%3c/svg%3e")
        }

        .custom-checkbox .custom-control-input:disabled:checked~.custom-control-label::before {
            background-color: rgba(0, 123, 255, .5)
        }

        .custom-checkbox .custom-control-input:disabled:indeterminate~.custom-control-label::before {
            background-color: rgba(0, 123, 255, .5)
        }

        .custom-radio .custom-control-label::before {
            border-radius: 50%
        }

        .custom-radio .custom-control-input:checked~.custom-control-label::after {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='-4 -4 8 8'%3e%3ccircle r='3' fill='%23fff'/%3e%3c/svg%3e")
        }

        .custom-radio .custom-control-input:disabled:checked~.custom-control-label::before {
            background-color: rgba(0, 123, 255, .5)
        }

        .custom-switch {
            padding-left: 2.25rem
        }

        .custom-switch .custom-control-label::before {
            left: -2.25rem;
            width: 1.75rem;
            pointer-events: all;
            border-radius: .5rem
        }

        .custom-switch .custom-control-label::after {
            top: calc(.25rem + 2px);
            left: calc(-2.25rem + 2px);
            width: calc(1rem - 4px);
            height: calc(1rem - 4px);
            background-color: #adb5bd;
            border-radius: .5rem;
            transition: background-color .15s ease-in-out, border-color .15s ease-in-out, box-shadow .15s ease-in-out, -webkit-transform .15s ease-in-out;
            transition: transform .15s ease-in-out, background-color .15s ease-in-out, border-color .15s ease-in-out, box-shadow .15s ease-in-out;
            transition: transform .15s ease-in-out, background-color .15s ease-in-out, border-color .15s ease-in-out, box-shadow .15s ease-in-out, -webkit-transform .15s ease-in-out
        }

        @media (prefers-reduced-motion:reduce) {
            .custom-switch .custom-control-label::after {
                transition: none
            }
        }

        .custom-switch .custom-control-input:checked~.custom-control-label::after {
            background-color: #fff;
            -webkit-transform: translateX(.75rem);
            transform: translateX(.75rem)
        }

        .custom-switch .custom-control-input:disabled:checked~.custom-control-label::before {
            background-color: rgba(0, 123, 255, .5)
        }

        .custom-select {
            display: inline-block;
            width: 100%;
            height: calc(1.5em + .75rem + 2px);
            padding: .375rem 1.75rem .375rem .75rem;
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: #495057;
            vertical-align: middle;
            background: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 4 5'%3e%3cpath fill='%23343a40' d='M2 0L0 2h4zm0 5L0 3h4z'/%3e%3c/svg%3e") no-repeat right .75rem center/8px 10px;
            background-color: #fff;
            border: 1px solid #ced4da;
            border-radius: .25rem;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none
        }

        .custom-select:focus {
            border-color: #80bdff;
            outline: 0;
            box-shadow: 0 0 0 .2rem rgba(0, 123, 255, .25)
        }

        .custom-select:focus::-ms-value {
            color: #495057;
            background-color: #fff
        }

        .custom-select[multiple],
        .custom-select[size]:not([size="1"]) {
            height: auto;
            padding-right: .75rem;
            background-image: none
        }

        .custom-select:disabled {
            color: #6c757d;
            background-color: #e9ecef
        }

        .custom-select::-ms-expand {
            display: none
        }

        .custom-select-sm {
            height: calc(1.5em + .5rem + 2px);
            padding-top: .25rem;
            padding-bottom: .25rem;
            padding-left: .5rem;
            font-size: .875rem
        }

        .custom-select-lg {
            height: calc(1.5em + 1rem + 2px);
            padding-top: .5rem;
            padding-bottom: .5rem;
            padding-left: 1rem;
            font-size: 1.25rem
        }

        .custom-file {
            position: relative;
            display: inline-block;
            width: 100%;
            height: calc(1.5em + .75rem + 2px);
            margin-bottom: 0
        }

        .custom-file-input {
            position: relative;
            z-index: 2;
            width: 100%;
            height: calc(1.5em + .75rem + 2px);
            margin: 0;
            opacity: 0
        }

        .custom-file-input:focus~.custom-file-label {
            border-color: #80bdff;
            box-shadow: 0 0 0 .2rem rgba(0, 123, 255, .25)
        }

        .custom-file-input:disabled~.custom-file-label {
            background-color: #e9ecef
        }

        .custom-file-input:lang(en)~.custom-file-label::after {
            content: "Browse"
        }

        .custom-file-input~.custom-file-label[data-browse]::after {
            content: attr(data-browse)
        }

        .custom-file-label {
            position: absolute;
            top: 0;
            right: 0;
            left: 0;
            z-index: 1;
            height: calc(1.5em + .75rem + 2px);
            padding: .375rem .75rem;
            font-weight: 400;
            line-height: 1.5;
            color: #495057;
            background-color: #fff;
            border: 1px solid #ced4da;
            border-radius: .25rem
        }

        .custom-file-label::after {
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            z-index: 3;
            display: block;
            height: calc(1.5em + .75rem);
            padding: .375rem .75rem;
            line-height: 1.5;
            color: #495057;
            content: "Browse";
            background-color: #e9ecef;
            border-left: inherit;
            border-radius: 0 .25rem .25rem 0
        }

        .custom-range {
            width: 100%;
            height: calc(1rem + .4rem);
            padding: 0;
            background-color: transparent;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none
        }

        .custom-range:focus {
            outline: 0
        }

        .custom-range:focus::-webkit-slider-thumb {
            box-shadow: 0 0 0 1px #fff, 0 0 0 .2rem rgba(0, 123, 255, .25)
        }

        .custom-range:focus::-moz-range-thumb {
            box-shadow: 0 0 0 1px #fff, 0 0 0 .2rem rgba(0, 123, 255, .25)
        }

        .custom-range:focus::-ms-thumb {
            box-shadow: 0 0 0 1px #fff, 0 0 0 .2rem rgba(0, 123, 255, .25)
        }

        .custom-range::-moz-focus-outer {
            border: 0
        }

        .custom-range::-webkit-slider-thumb {
            width: 1rem;
            height: 1rem;
            margin-top: -.25rem;
            background-color: #007bff;
            border: 0;
            border-radius: 1rem;
            transition: background-color .15s ease-in-out, border-color .15s ease-in-out, box-shadow .15s ease-in-out;
            -webkit-appearance: none;
            appearance: none
        }

        @media (prefers-reduced-motion:reduce) {
            .custom-range::-webkit-slider-thumb {
                transition: none
            }
        }

        .custom-range::-webkit-slider-thumb:active {
            background-color: #b3d7ff
        }

        .custom-range::-webkit-slider-runnable-track {
            width: 100%;
            height: .5rem;
            color: transparent;
            cursor: pointer;
            background-color: #dee2e6;
            border-color: transparent;
            border-radius: 1rem
        }

        .custom-range::-moz-range-thumb {
            width: 1rem;
            height: 1rem;
            background-color: #007bff;
            border: 0;
            border-radius: 1rem;
            transition: background-color .15s ease-in-out, border-color .15s ease-in-out, box-shadow .15s ease-in-out;
            -moz-appearance: none;
            appearance: none
        }

        @media (prefers-reduced-motion:reduce) {
            .custom-range::-moz-range-thumb {
                transition: none
            }
        }

        .custom-range::-moz-range-thumb:active {
            background-color: #b3d7ff
        }

        .custom-range::-moz-range-track {
            width: 100%;
            height: .5rem;
            color: transparent;
            cursor: pointer;
            background-color: #dee2e6;
            border-color: transparent;
            border-radius: 1rem
        }

        .custom-range::-ms-thumb {
            width: 1rem;
            height: 1rem;
            margin-top: 0;
            margin-right: .2rem;
            margin-left: .2rem;
            background-color: #007bff;
            border: 0;
            border-radius: 1rem;
            transition: background-color .15s ease-in-out, border-color .15s ease-in-out, box-shadow .15s ease-in-out;
            appearance: none
        }

        @media (prefers-reduced-motion:reduce) {
            .custom-range::-ms-thumb {
                transition: none
            }
        }

        .custom-range::-ms-thumb:active {
            background-color: #b3d7ff
        }

        .custom-range::-ms-track {
            width: 100%;
            height: .5rem;
            color: transparent;
            cursor: pointer;
            background-color: transparent;
            border-color: transparent;
            border-width: .5rem
        }

        .custom-range::-ms-fill-lower {
            background-color: #dee2e6;
            border-radius: 1rem
        }

        .custom-range::-ms-fill-upper {
            margin-right: 15px;
            background-color: #dee2e6;
            border-radius: 1rem
        }

        .custom-range:disabled::-webkit-slider-thumb {
            background-color: #adb5bd
        }

        .custom-range:disabled::-webkit-slider-runnable-track {
            cursor: default
        }

        .custom-range:disabled::-moz-range-thumb {
            background-color: #adb5bd
        }

        .custom-range:disabled::-moz-range-track {
            cursor: default
        }

        .custom-range:disabled::-ms-thumb {
            background-color: #adb5bd
        }

        .custom-control-label::before,
        .custom-file-label,
        .custom-select {
            transition: background-color .15s ease-in-out, border-color .15s ease-in-out, box-shadow .15s ease-in-out
        }

        @media (prefers-reduced-motion:reduce) {

            .custom-control-label::before,
            .custom-file-label,
            .custom-select {
                transition: none
            }
        }

        .nav {
            display: -ms-flexbox;
            display: flex;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
            padding-left: 0;
            margin-bottom: 0;
            list-style: none
        }

        .nav-link {
            display: block;
            padding: .5rem 1rem
        }

        .nav-link:focus,
        .nav-link:hover {
            text-decoration: none
        }

        .nav-link.disabled {
            color: #6c757d;
            pointer-events: none;
            cursor: default
        }

        .nav-tabs {
            border-bottom: 1px solid #dee2e6
        }

        .nav-tabs .nav-item {
            margin-bottom: -1px
        }

        .nav-tabs .nav-link {
            border: 1px solid transparent;
            border-top-left-radius: .25rem;
            border-top-right-radius: .25rem
        }

        .nav-tabs .nav-link:focus,
        .nav-tabs .nav-link:hover {
            border-color: #e9ecef #e9ecef #dee2e6
        }

        .nav-tabs .nav-link.disabled {
            color: #6c757d;
            background-color: transparent;
            border-color: transparent
        }

        .nav-tabs .nav-item.show .nav-link,
        .nav-tabs .nav-link.active {
            color: #495057;
            background-color: #fff;
            border-color: #dee2e6 #dee2e6 #fff
        }

        .nav-tabs .dropdown-menu {
            margin-top: -1px;
            border-top-left-radius: 0;
            border-top-right-radius: 0
        }

        .nav-pills .nav-link {
            border-radius: .25rem
        }

        .nav-pills .nav-link.active,
        .nav-pills .show>.nav-link {
            color: #fff;
            background-color: #007bff
        }

        .nav-fill .nav-item {
            -ms-flex: 1 1 auto;
            flex: 1 1 auto;
            text-align: center
        }

        .nav-justified .nav-item {
            -ms-flex-preferred-size: 0;
            flex-basis: 0;
            -ms-flex-positive: 1;
            flex-grow: 1;
            text-align: center
        }

        .tab-content>.tab-pane {
            display: none
        }

        .tab-content>.active {
            display: block
        }

        .navbar {
            position: relative;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
            -ms-flex-align: center;
            align-items: center;
            -ms-flex-pack: justify;
            justify-content: space-between;
            padding: .5rem 1rem
        }

        .navbar>.container,
        .navbar>.container-fluid {
            display: -ms-flexbox;
            display: flex;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
            -ms-flex-align: center;
            align-items: center;
            -ms-flex-pack: justify;
            justify-content: space-between
        }

        .navbar-brand {
            display: inline-block;
            padding-top: .3125rem;
            padding-bottom: .3125rem;
            margin-right: 1rem;
            font-size: 1.25rem;
            line-height: inherit;
            white-space: nowrap
        }

        .navbar-brand:focus,
        .navbar-brand:hover {
            text-decoration: none
        }

        .navbar-nav {
            display: -ms-flexbox;
            display: flex;
            -ms-flex-direction: column;
            flex-direction: column;
            padding-left: 0;
            margin-bottom: 0;
            list-style: none
        }

        .navbar-nav .nav-link {
            padding-right: 0;
            padding-left: 0
        }

        .navbar-nav .dropdown-menu {
            position: static;
            float: none
        }

        .navbar-text {
            display: inline-block;
            padding-top: .5rem;
            padding-bottom: .5rem
        }

        .navbar-collapse {
            -ms-flex-preferred-size: 100%;
            flex-basis: 100%;
            -ms-flex-positive: 1;
            flex-grow: 1;
            -ms-flex-align: center;
            align-items: center
        }

        .navbar-toggler {
            padding: .25rem .75rem;
            font-size: 1.25rem;
            line-height: 1;
            background-color: transparent;
            border: 1px solid transparent;
            border-radius: .25rem
        }

        .navbar-toggler:focus,
        .navbar-toggler:hover {
            text-decoration: none
        }

        .navbar-toggler-icon {
            display: inline-block;
            width: 1.5em;
            height: 1.5em;
            vertical-align: middle;
            content: "";
            background: no-repeat center center;
            background-size: 100% 100%
        }

        @media (max-width:575.98px) {

            .navbar-expand-sm>.container,
            .navbar-expand-sm>.container-fluid {
                padding-right: 0;
                padding-left: 0
            }
        }

        @media (min-width:576px) {
            .navbar-expand-sm {
                -ms-flex-flow: row nowrap;
                flex-flow: row nowrap;
                -ms-flex-pack: start;
                justify-content: flex-start
            }

            .navbar-expand-sm .navbar-nav {
                -ms-flex-direction: row;
                flex-direction: row
            }

            .navbar-expand-sm .navbar-nav .dropdown-menu {
                position: absolute
            }

            .navbar-expand-sm .navbar-nav .nav-link {
                padding-right: .5rem;
                padding-left: .5rem
            }

            .navbar-expand-sm>.container,
            .navbar-expand-sm>.container-fluid {
                -ms-flex-wrap: nowrap;
                flex-wrap: nowrap
            }

            .navbar-expand-sm .navbar-collapse {
                display: -ms-flexbox !important;
                display: flex !important;
                -ms-flex-preferred-size: auto;
                flex-basis: auto
            }

            .navbar-expand-sm .navbar-toggler {
                display: none
            }
        }

        @media (max-width:767.98px) {

            .navbar-expand-md>.container,
            .navbar-expand-md>.container-fluid {
                padding-right: 0;
                padding-left: 0
            }
        }

        @media (min-width:768px) {
            .navbar-expand-md {
                -ms-flex-flow: row nowrap;
                flex-flow: row nowrap;
                -ms-flex-pack: start;
                justify-content: flex-start
            }

            .navbar-expand-md .navbar-nav {
                -ms-flex-direction: row;
                flex-direction: row
            }

            .navbar-expand-md .navbar-nav .dropdown-menu {
                position: absolute
            }

            .navbar-expand-md .navbar-nav .nav-link {
                padding-right: .5rem;
                padding-left: .5rem
            }

            .navbar-expand-md>.container,
            .navbar-expand-md>.container-fluid {
                -ms-flex-wrap: nowrap;
                flex-wrap: nowrap
            }

            .navbar-expand-md .navbar-collapse {
                display: -ms-flexbox !important;
                display: flex !important;
                -ms-flex-preferred-size: auto;
                flex-basis: auto
            }

            .navbar-expand-md .navbar-toggler {
                display: none
            }
        }

        @media (max-width:991.98px) {

            .navbar-expand-lg>.container,
            .navbar-expand-lg>.container-fluid {
                padding-right: 0;
                padding-left: 0
            }
        }

        @media (min-width:992px) {
            .navbar-expand-lg {
                -ms-flex-flow: row nowrap;
                flex-flow: row nowrap;
                -ms-flex-pack: start;
                justify-content: flex-start
            }

            .navbar-expand-lg .navbar-nav {
                -ms-flex-direction: row;
                flex-direction: row
            }

            .navbar-expand-lg .navbar-nav .dropdown-menu {
                position: absolute
            }

            .navbar-expand-lg .navbar-nav .nav-link {
                padding-right: .5rem;
                padding-left: .5rem
            }

            .navbar-expand-lg>.container,
            .navbar-expand-lg>.container-fluid {
                -ms-flex-wrap: nowrap;
                flex-wrap: nowrap
            }

            .navbar-expand-lg .navbar-collapse {
                display: -ms-flexbox !important;
                display: flex !important;
                -ms-flex-preferred-size: auto;
                flex-basis: auto
            }

            .navbar-expand-lg .navbar-toggler {
                display: none
            }
        }

        @media (max-width:1199.98px) {

            .navbar-expand-xl>.container,
            .navbar-expand-xl>.container-fluid {
                padding-right: 0;
                padding-left: 0
            }
        }

        @media (min-width:1200px) {
            .navbar-expand-xl {
                -ms-flex-flow: row nowrap;
                flex-flow: row nowrap;
                -ms-flex-pack: start;
                justify-content: flex-start
            }

            .navbar-expand-xl .navbar-nav {
                -ms-flex-direction: row;
                flex-direction: row
            }

            .navbar-expand-xl .navbar-nav .dropdown-menu {
                position: absolute
            }

            .navbar-expand-xl .navbar-nav .nav-link {
                padding-right: .5rem;
                padding-left: .5rem
            }

            .navbar-expand-xl>.container,
            .navbar-expand-xl>.container-fluid {
                -ms-flex-wrap: nowrap;
                flex-wrap: nowrap
            }

            .navbar-expand-xl .navbar-collapse {
                display: -ms-flexbox !important;
                display: flex !important;
                -ms-flex-preferred-size: auto;
                flex-basis: auto
            }

            .navbar-expand-xl .navbar-toggler {
                display: none
            }
        }

        .navbar-expand {
            -ms-flex-flow: row nowrap;
            flex-flow: row nowrap;
            -ms-flex-pack: start;
            justify-content: flex-start
        }

        .navbar-expand>.container,
        .navbar-expand>.container-fluid {
            padding-right: 0;
            padding-left: 0
        }

        .navbar-expand .navbar-nav {
            -ms-flex-direction: row;
            flex-direction: row
        }

        .navbar-expand .navbar-nav .dropdown-menu {
            position: absolute
        }

        .navbar-expand .navbar-nav .nav-link {
            padding-right: .5rem;
            padding-left: .5rem
        }

        .navbar-expand>.container,
        .navbar-expand>.container-fluid {
            -ms-flex-wrap: nowrap;
            flex-wrap: nowrap
        }

        .navbar-expand .navbar-collapse {
            display: -ms-flexbox !important;
            display: flex !important;
            -ms-flex-preferred-size: auto;
            flex-basis: auto
        }

        .navbar-expand .navbar-toggler {
            display: none
        }

        .navbar-light .navbar-brand {
            color: rgba(0, 0, 0, .9)
        }

        .navbar-light .navbar-brand:focus,
        .navbar-light .navbar-brand:hover {
            color: rgba(0, 0, 0, .9)
        }

        .navbar-light .navbar-nav .nav-link {
            color: rgba(0, 0, 0, .5)
        }

        .navbar-light .navbar-nav .nav-link:focus,
        .navbar-light .navbar-nav .nav-link:hover {
            color: rgba(0, 0, 0, .7)
        }

        .navbar-light .navbar-nav .nav-link.disabled {
            color: rgba(0, 0, 0, .3)
        }

        .navbar-light .navbar-nav .active>.nav-link,
        .navbar-light .navbar-nav .nav-link.active,
        .navbar-light .navbar-nav .nav-link.show,
        .navbar-light .navbar-nav .show>.nav-link {
            color: rgba(0, 0, 0, .9)
        }

        .navbar-light .navbar-toggler {
            color: rgba(0, 0, 0, .5);
            border-color: rgba(0, 0, 0, .1)
        }

        .navbar-light .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg viewBox='0 0 30 30' xmlns='http://www.w3.org/2000/svg'%3e%3cpath stroke='rgba(0, 0, 0, 0.5)' stroke-width='2' stroke-linecap='round' stroke-miterlimit='10' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e")
        }

        .navbar-light .navbar-text {
            color: rgba(0, 0, 0, .5)
        }

        .navbar-light .navbar-text a {
            color: rgba(0, 0, 0, .9)
        }

        .navbar-light .navbar-text a:focus,
        .navbar-light .navbar-text a:hover {
            color: rgba(0, 0, 0, .9)
        }

        .navbar-dark .navbar-brand {
            color: #fff
        }

        .navbar-dark .navbar-brand:focus,
        .navbar-dark .navbar-brand:hover {
            color: #fff
        }

        .navbar-dark .navbar-nav .nav-link {
            color: rgba(255, 255, 255, .5)
        }

        .navbar-dark .navbar-nav .nav-link:focus,
        .navbar-dark .navbar-nav .nav-link:hover {
            color: rgba(255, 255, 255, .75)
        }

        .navbar-dark .navbar-nav .nav-link.disabled {
            color: rgba(255, 255, 255, .25)
        }

        .navbar-dark .navbar-nav .active>.nav-link,
        .navbar-dark .navbar-nav .nav-link.active,
        .navbar-dark .navbar-nav .nav-link.show,
        .navbar-dark .navbar-nav .show>.nav-link {
            color: #fff
        }

        .navbar-dark .navbar-toggler {
            color: rgba(255, 255, 255, .5);
            border-color: rgba(255, 255, 255, .1)
        }

        .navbar-dark .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg viewBox='0 0 30 30' xmlns='http://www.w3.org/2000/svg'%3e%3cpath stroke='rgba(255, 255, 255, 0.5)' stroke-width='2' stroke-linecap='round' stroke-miterlimit='10' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e")
        }

        .navbar-dark .navbar-text {
            color: rgba(255, 255, 255, .5)
        }

        .navbar-dark .navbar-text a {
            color: #fff
        }

        .navbar-dark .navbar-text a:focus,
        .navbar-dark .navbar-text a:hover {
            color: #fff
        }

        .card {
            position: relative;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-direction: column;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 1px solid rgba(0, 0, 0, .125);
            border-radius: .25rem
        }

        .card>hr {
            margin-right: 0;
            margin-left: 0
        }

        .card>.list-group:first-child .list-group-item:first-child {
            border-top-left-radius: .25rem;
            border-top-right-radius: .25rem
        }

        .card>.list-group:last-child .list-group-item:last-child {
            border-bottom-right-radius: .25rem;
            border-bottom-left-radius: .25rem
        }

        .card-body {
            -ms-flex: 1 1 auto;
            flex: 1 1 auto;
            padding: 1.25rem
        }

        .card-title {
            margin-bottom: .75rem
        }

        .card-subtitle {
            margin-top: -.375rem;
            margin-bottom: 0
        }

        .card-text:last-child {
            margin-bottom: 0
        }

        .card-link:hover {
            text-decoration: none
        }

        .card-link+.card-link {
            margin-left: 1.25rem
        }

        .card-header {
            padding: .75rem 1.25rem;
            margin-bottom: 0;
            background-color: rgba(0, 0, 0, .03);
            border-bottom: 1px solid rgba(0, 0, 0, .125)
        }

        .card-header:first-child {
            border-radius: calc(.25rem - 1px) calc(.25rem - 1px) 0 0
        }

        .card-header+.list-group .list-group-item:first-child {
            border-top: 0
        }

        .card-footer {
            padding: .75rem 1.25rem;
            background-color: rgba(0, 0, 0, .03);
            border-top: 1px solid rgba(0, 0, 0, .125)
        }

        .card-footer:last-child {
            border-radius: 0 0 calc(.25rem - 1px) calc(.25rem - 1px)
        }

        .card-header-tabs {
            margin-right: -.625rem;
            margin-bottom: -.75rem;
            margin-left: -.625rem;
            border-bottom: 0
        }

        .card-header-pills {
            margin-right: -.625rem;
            margin-left: -.625rem
        }

        .card-img-overlay {
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            padding: 1.25rem
        }

        .card-img {
            width: 100%;
            border-radius: calc(.25rem - 1px)
        }

        .card-img-top {
            width: 100%;
            border-top-left-radius: calc(.25rem - 1px);
            border-top-right-radius: calc(.25rem - 1px)
        }

        .card-img-bottom {
            width: 100%;
            border-bottom-right-radius: calc(.25rem - 1px);
            border-bottom-left-radius: calc(.25rem - 1px)
        }

        .card-deck {
            display: -ms-flexbox;
            display: flex;
            -ms-flex-direction: column;
            flex-direction: column
        }

        .card-deck .card {
            margin-bottom: 15px
        }

        @media (min-width:576px) {
            .card-deck {
                -ms-flex-flow: row wrap;
                flex-flow: row wrap;
                margin-right: -15px;
                margin-left: -15px
            }

            .card-deck .card {
                display: -ms-flexbox;
                display: flex;
                -ms-flex: 1 0 0%;
                flex: 1 0 0%;
                -ms-flex-direction: column;
                flex-direction: column;
                margin-right: 15px;
                margin-bottom: 0;
                margin-left: 15px
            }
        }

        .card-group {
            display: -ms-flexbox;
            display: flex;
            -ms-flex-direction: column;
            flex-direction: column
        }

        .card-group>.card {
            margin-bottom: 15px
        }

        @media (min-width:576px) {
            .card-group {
                -ms-flex-flow: row wrap;
                flex-flow: row wrap
            }

            .card-group>.card {
                -ms-flex: 1 0 0%;
                flex: 1 0 0%;
                margin-bottom: 0
            }

            .card-group>.card+.card {
                margin-left: 0;
                border-left: 0
            }

            .card-group>.card:not(:last-child) {
                border-top-right-radius: 0;
                border-bottom-right-radius: 0
            }

            .card-group>.card:not(:last-child) .card-header,
            .card-group>.card:not(:last-child) .card-img-top {
                border-top-right-radius: 0
            }

            .card-group>.card:not(:last-child) .card-footer,
            .card-group>.card:not(:last-child) .card-img-bottom {
                border-bottom-right-radius: 0
            }

            .card-group>.card:not(:first-child) {
                border-top-left-radius: 0;
                border-bottom-left-radius: 0
            }

            .card-group>.card:not(:first-child) .card-header,
            .card-group>.card:not(:first-child) .card-img-top {
                border-top-left-radius: 0
            }

            .card-group>.card:not(:first-child) .card-footer,
            .card-group>.card:not(:first-child) .card-img-bottom {
                border-bottom-left-radius: 0
            }
        }

        .card-columns .card {
            margin-bottom: .75rem
        }

        @media (min-width:576px) {
            .card-columns {
                -webkit-column-count: 3;
                -moz-column-count: 3;
                column-count: 3;
                -webkit-column-gap: 1.25rem;
                -moz-column-gap: 1.25rem;
                column-gap: 1.25rem;
                orphans: 1;
                widows: 1
            }

            .card-columns .card {
                display: inline-block;
                width: 100%
            }
        }

        .accordion>.card {
            overflow: hidden
        }

        .accordion>.card:not(:first-of-type) .card-header:first-child {
            border-radius: 0
        }

        .accordion>.card:not(:first-of-type):not(:last-of-type) {
            border-bottom: 0;
            border-radius: 0
        }

        .accordion>.card:first-of-type {
            border-bottom: 0;
            border-bottom-right-radius: 0;
            border-bottom-left-radius: 0
        }

        .accordion>.card:last-of-type {
            border-top-left-radius: 0;
            border-top-right-radius: 0
        }

        .accordion>.card .card-header {
            margin-bottom: -1px
        }

        .breadcrumb {
            display: -ms-flexbox;
            display: flex;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
            padding: .75rem 1rem;
            margin-bottom: 1rem;
            list-style: none;
            background-color: #e9ecef;
            border-radius: .25rem
        }

        .breadcrumb-item+.breadcrumb-item {
            padding-left: .5rem
        }

        .breadcrumb-item+.breadcrumb-item::before {
            display: inline-block;
            padding-right: .5rem;
            color: #6c757d;
            content: "/"
        }

        .breadcrumb-item+.breadcrumb-item:hover::before {
            text-decoration: underline
        }

        .breadcrumb-item+.breadcrumb-item:hover::before {
            text-decoration: none
        }

        .breadcrumb-item.active {
            color: #6c757d
        }

        .pagination {
            display: -ms-flexbox;
            display: flex;
            padding-left: 0;
            list-style: none;
            border-radius: .25rem
        }

        .page-link {
            position: relative;
            display: block;
            padding: .5rem .75rem;
            margin-left: -1px;
            line-height: 1.25;
            color: #007bff;
            background-color: #fff;
            border: 1px solid #dee2e6
        }

        .page-link:hover {
            z-index: 2;
            color: #0056b3;
            text-decoration: none;
            background-color: #e9ecef;
            border-color: #dee2e6
        }

        .page-link:focus {
            z-index: 2;
            outline: 0;
            box-shadow: 0 0 0 .2rem rgba(0, 123, 255, .25)
        }

        .page-item:first-child .page-link {
            margin-left: 0;
            border-top-left-radius: .25rem;
            border-bottom-left-radius: .25rem
        }

        .page-item:last-child .page-link {
            border-top-right-radius: .25rem;
            border-bottom-right-radius: .25rem
        }

        .page-item.active .page-link {
            z-index: 1;
            color: #fff;
            background-color: #007bff;
            border-color: #007bff
        }

        .page-item.disabled .page-link {
            color: #6c757d;
            pointer-events: none;
            cursor: auto;
            background-color: #fff;
            border-color: #dee2e6
        }

        .pagination-lg .page-link {
            padding: .75rem 1.5rem;
            font-size: 1.25rem;
            line-height: 1.5
        }

        .pagination-lg .page-item:first-child .page-link {
            border-top-left-radius: .3rem;
            border-bottom-left-radius: .3rem
        }

        .pagination-lg .page-item:last-child .page-link {
            border-top-right-radius: .3rem;
            border-bottom-right-radius: .3rem
        }

        .pagination-sm .page-link {
            padding: .25rem .5rem;
            font-size: .875rem;
            line-height: 1.5
        }

        .pagination-sm .page-item:first-child .page-link {
            border-top-left-radius: .2rem;
            border-bottom-left-radius: .2rem
        }

        .pagination-sm .page-item:last-child .page-link {
            border-top-right-radius: .2rem;
            border-bottom-right-radius: .2rem
        }

        .badge {
            display: inline-block;
            padding: .25em .4em;
            font-size: 75%;
            font-weight: 700;
            line-height: 1;
            text-align: center;
            white-space: nowrap;
            vertical-align: baseline;
            border-radius: .25rem;
            transition: color .15s ease-in-out, background-color .15s ease-in-out, border-color .15s ease-in-out, box-shadow .15s ease-in-out
        }

        @media (prefers-reduced-motion:reduce) {
            .badge {
                transition: none
            }
        }

        a.badge:focus,
        a.badge:hover {
            text-decoration: none
        }

        .badge:empty {
            display: none
        }

        .btn .badge {
            position: relative;
            top: -1px
        }

        .badge-pill {
            padding-right: .6em;
            padding-left: .6em;
            border-radius: 10rem
        }

        .badge-primary {
            color: #fff;
            background-color: #007bff
        }

        a.badge-primary:focus,
        a.badge-primary:hover {
            color: #fff;
            background-color: #0062cc
        }

        a.badge-primary.focus,
        a.badge-primary:focus {
            outline: 0;
            box-shadow: 0 0 0 .2rem rgba(0, 123, 255, .5)
        }

        .badge-secondary {
            color: #fff;
            background-color: #6c757d
        }

        a.badge-secondary:focus,
        a.badge-secondary:hover {
            color: #fff;
            background-color: #545b62
        }

        a.badge-secondary.focus,
        a.badge-secondary:focus {
            outline: 0;
            box-shadow: 0 0 0 .2rem rgba(108, 117, 125, .5)
        }

        .badge-success {
            color: #fff;
            background-color: #28a745
        }

        a.badge-success:focus,
        a.badge-success:hover {
            color: #fff;
            background-color: #1e7e34
        }

        a.badge-success.focus,
        a.badge-success:focus {
            outline: 0;
            box-shadow: 0 0 0 .2rem rgba(40, 167, 69, .5)
        }

        .badge-info {
            color: #fff;
            background-color: #17a2b8
        }

        a.badge-info:focus,
        a.badge-info:hover {
            color: #fff;
            background-color: #117a8b
        }

        a.badge-info.focus,
        a.badge-info:focus {
            outline: 0;
            box-shadow: 0 0 0 .2rem rgba(23, 162, 184, .5)
        }

        .badge-warning {
            color: #212529;
            background-color: #ffc107
        }

        a.badge-warning:focus,
        a.badge-warning:hover {
            color: #212529;
            background-color: #d39e00
        }

        a.badge-warning.focus,
        a.badge-warning:focus {
            outline: 0;
            box-shadow: 0 0 0 .2rem rgba(255, 193, 7, .5)
        }

        .badge-danger {
            color: #fff;
            background-color: #dc3545
        }

        a.badge-danger:focus,
        a.badge-danger:hover {
            color: #fff;
            background-color: #bd2130
        }

        a.badge-danger.focus,
        a.badge-danger:focus {
            outline: 0;
            box-shadow: 0 0 0 .2rem rgba(220, 53, 69, .5)
        }

        .badge-light {
            color: #212529;
            background-color: #f8f9fa
        }

        a.badge-light:focus,
        a.badge-light:hover {
            color: #212529;
            background-color: #dae0e5
        }

        a.badge-light.focus,
        a.badge-light:focus {
            outline: 0;
            box-shadow: 0 0 0 .2rem rgba(248, 249, 250, .5)
        }

        .badge-dark {
            color: #fff;
            background-color: #343a40
        }

        a.badge-dark:focus,
        a.badge-dark:hover {
            color: #fff;
            background-color: #1d2124
        }

        a.badge-dark.focus,
        a.badge-dark:focus {
            outline: 0;
            box-shadow: 0 0 0 .2rem rgba(52, 58, 64, .5)
        }

        .jumbotron {
            padding: 2rem 1rem;
            margin-bottom: 2rem;
            background-color: #e9ecef;
            border-radius: .3rem
        }

        @media (min-width:576px) {
            .jumbotron {
                padding: 4rem 2rem
            }
        }

        .jumbotron-fluid {
            padding-right: 0;
            padding-left: 0;
            border-radius: 0
        }

        .alert {
            position: relative;
            padding: .75rem 1.25rem;
            margin-bottom: 1rem;
            border: 1px solid transparent;
            border-radius: .25rem
        }

        .alert-heading {
            color: inherit
        }

        .alert-link {
            font-weight: 700
        }

        .alert-dismissible {
            padding-right: 4rem
        }

        .alert-dismissible .close {
            position: absolute;
            top: 0;
            right: 0;
            padding: .75rem 1.25rem;
            color: inherit
        }

        .alert-primary {
            color: #004085;
            background-color: #cce5ff;
            border-color: #b8daff
        }

        .alert-primary hr {
            border-top-color: #9fcdff
        }

        .alert-primary .alert-link {
            color: #002752
        }

        .alert-secondary {
            color: #383d41;
            background-color: #e2e3e5;
            border-color: #d6d8db
        }

        .alert-secondary hr {
            border-top-color: #c8cbcf
        }

        .alert-secondary .alert-link {
            color: #202326
        }

        .alert-success {
            color: #155724;
            background-color: #d4edda;
            border-color: #c3e6cb
        }

        .alert-success hr {
            border-top-color: #b1dfbb
        }

        .alert-success .alert-link {
            color: #0b2e13
        }

        .alert-info {
            color: #0c5460;
            background-color: #d1ecf1;
            border-color: #bee5eb
        }

        .alert-info hr {
            border-top-color: #abdde5
        }

        .alert-info .alert-link {
            color: #062c33
        }

        .alert-warning {
            color: #856404;
            background-color: #fff3cd;
            border-color: #ffeeba
        }

        .alert-warning hr {
            border-top-color: #ffe8a1
        }

        .alert-warning .alert-link {
            color: #533f03
        }

        .alert-danger {
            color: #721c24;
            background-color: #f8d7da;
            border-color: #f5c6cb
        }

        .alert-danger hr {
            border-top-color: #f1b0b7
        }

        .alert-danger .alert-link {
            color: #491217
        }

        .alert-light {
            color: #818182;
            background-color: #fefefe;
            border-color: #fdfdfe
        }

        .alert-light hr {
            border-top-color: #ececf6
        }

        .alert-light .alert-link {
            color: #686868
        }

        .alert-dark {
            color: #1b1e21;
            background-color: #d6d8d9;
            border-color: #c6c8ca
        }

        .alert-dark hr {
            border-top-color: #b9bbbe
        }

        .alert-dark .alert-link {
            color: #040505
        }

        @-webkit-keyframes progress-bar-stripes {
            from {
                background-position: 1rem 0
            }

            to {
                background-position: 0 0
            }
        }

        @keyframes progress-bar-stripes {
            from {
                background-position: 1rem 0
            }

            to {
                background-position: 0 0
            }
        }

        .progress {
            display: -ms-flexbox;
            display: flex;
            height: 1rem;
            overflow: hidden;
            font-size: .75rem;
            background-color: #e9ecef;
            border-radius: .25rem
        }

        .progress-bar {
            display: -ms-flexbox;
            display: flex;
            -ms-flex-direction: column;
            flex-direction: column;
            -ms-flex-pack: center;
            justify-content: center;
            color: #fff;
            text-align: center;
            white-space: nowrap;
            background-color: #007bff;
            transition: width .6s ease
        }

        @media (prefers-reduced-motion:reduce) {
            .progress-bar {
                transition: none
            }
        }

        .progress-bar-striped {
            background-image: linear-gradient(45deg, rgba(255, 255, 255, .15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, .15) 50%, rgba(255, 255, 255, .15) 75%, transparent 75%, transparent);
            background-size: 1rem 1rem
        }

        .progress-bar-animated {
            -webkit-animation: progress-bar-stripes 1s linear infinite;
            animation: progress-bar-stripes 1s linear infinite
        }

        @media (prefers-reduced-motion:reduce) {
            .progress-bar-animated {
                -webkit-animation: none;
                animation: none
            }
        }

        .media {
            display: -ms-flexbox;
            display: flex;
            -ms-flex-align: start;
            align-items: flex-start
        }

        .media-body {
            -ms-flex: 1;
            flex: 1
        }

        .list-group {
            display: -ms-flexbox;
            display: flex;
            -ms-flex-direction: column;
            flex-direction: column;
            padding-left: 0;
            margin-bottom: 0
        }

        .list-group-item-action {
            width: 100%;
            color: #495057;
            text-align: inherit
        }

        .list-group-item-action:focus,
        .list-group-item-action:hover {
            z-index: 1;
            color: #495057;
            text-decoration: none;
            background-color: #f8f9fa
        }

        .list-group-item-action:active {
            color: #212529;
            background-color: #e9ecef
        }

        .list-group-item {
            position: relative;
            display: block;
            padding: .75rem 1.25rem;
            margin-bottom: -1px;
            background-color: #fff;
            border: 1px solid rgba(0, 0, 0, .125)
        }

        .list-group-item:first-child {
            border-top-left-radius: .25rem;
            border-top-right-radius: .25rem
        }

        .list-group-item:last-child {
            margin-bottom: 0;
            border-bottom-right-radius: .25rem;
            border-bottom-left-radius: .25rem
        }

        .list-group-item.disabled,
        .list-group-item:disabled {
            color: #6c757d;
            pointer-events: none;
            background-color: #fff
        }

        .list-group-item.active {
            z-index: 2;
            color: #fff;
            background-color: #007bff;
            border-color: #007bff
        }

        .list-group-horizontal {
            -ms-flex-direction: row;
            flex-direction: row
        }

        .list-group-horizontal .list-group-item {
            margin-right: -1px;
            margin-bottom: 0
        }

        .list-group-horizontal .list-group-item:first-child {
            border-top-left-radius: .25rem;
            border-bottom-left-radius: .25rem;
            border-top-right-radius: 0
        }

        .list-group-horizontal .list-group-item:last-child {
            margin-right: 0;
            border-top-right-radius: .25rem;
            border-bottom-right-radius: .25rem;
            border-bottom-left-radius: 0
        }

        @media (min-width:576px) {
            .list-group-horizontal-sm {
                -ms-flex-direction: row;
                flex-direction: row
            }

            .list-group-horizontal-sm .list-group-item {
                margin-right: -1px;
                margin-bottom: 0
            }

            .list-group-horizontal-sm .list-group-item:first-child {
                border-top-left-radius: .25rem;
                border-bottom-left-radius: .25rem;
                border-top-right-radius: 0
            }

            .list-group-horizontal-sm .list-group-item:last-child {
                margin-right: 0;
                border-top-right-radius: .25rem;
                border-bottom-right-radius: .25rem;
                border-bottom-left-radius: 0
            }
        }

        @media (min-width:768px) {
            .list-group-horizontal-md {
                -ms-flex-direction: row;
                flex-direction: row
            }

            .list-group-horizontal-md .list-group-item {
                margin-right: -1px;
                margin-bottom: 0
            }

            .list-group-horizontal-md .list-group-item:first-child {
                border-top-left-radius: .25rem;
                border-bottom-left-radius: .25rem;
                border-top-right-radius: 0
            }

            .list-group-horizontal-md .list-group-item:last-child {
                margin-right: 0;
                border-top-right-radius: .25rem;
                border-bottom-right-radius: .25rem;
                border-bottom-left-radius: 0
            }
        }

        @media (min-width:992px) {
            .list-group-horizontal-lg {
                -ms-flex-direction: row;
                flex-direction: row
            }

            .list-group-horizontal-lg .list-group-item {
                margin-right: -1px;
                margin-bottom: 0
            }

            .list-group-horizontal-lg .list-group-item:first-child {
                border-top-left-radius: .25rem;
                border-bottom-left-radius: .25rem;
                border-top-right-radius: 0
            }

            .list-group-horizontal-lg .list-group-item:last-child {
                margin-right: 0;
                border-top-right-radius: .25rem;
                border-bottom-right-radius: .25rem;
                border-bottom-left-radius: 0
            }
        }

        @media (min-width:1200px) {
            .list-group-horizontal-xl {
                -ms-flex-direction: row;
                flex-direction: row
            }

            .list-group-horizontal-xl .list-group-item {
                margin-right: -1px;
                margin-bottom: 0
            }

            .list-group-horizontal-xl .list-group-item:first-child {
                border-top-left-radius: .25rem;
                border-bottom-left-radius: .25rem;
                border-top-right-radius: 0
            }

            .list-group-horizontal-xl .list-group-item:last-child {
                margin-right: 0;
                border-top-right-radius: .25rem;
                border-bottom-right-radius: .25rem;
                border-bottom-left-radius: 0
            }
        }

        .list-group-flush .list-group-item {
            border-right: 0;
            border-left: 0;
            border-radius: 0
        }

        .list-group-flush .list-group-item:last-child {
            margin-bottom: -1px
        }

        .list-group-flush:first-child .list-group-item:first-child {
            border-top: 0
        }

        .list-group-flush:last-child .list-group-item:last-child {
            margin-bottom: 0;
            border-bottom: 0
        }

        .list-group-item-primary {
            color: #004085;
            background-color: #b8daff
        }

        .list-group-item-primary.list-group-item-action:focus,
        .list-group-item-primary.list-group-item-action:hover {
            color: #004085;
            background-color: #9fcdff
        }

        .list-group-item-primary.list-group-item-action.active {
            color: #fff;
            background-color: #004085;
            border-color: #004085
        }

        .list-group-item-secondary {
            color: #383d41;
            background-color: #d6d8db
        }

        .list-group-item-secondary.list-group-item-action:focus,
        .list-group-item-secondary.list-group-item-action:hover {
            color: #383d41;
            background-color: #c8cbcf
        }

        .list-group-item-secondary.list-group-item-action.active {
            color: #fff;
            background-color: #383d41;
            border-color: #383d41
        }

        .list-group-item-success {
            color: #155724;
            background-color: #c3e6cb
        }

        .list-group-item-success.list-group-item-action:focus,
        .list-group-item-success.list-group-item-action:hover {
            color: #155724;
            background-color: #b1dfbb
        }

        .list-group-item-success.list-group-item-action.active {
            color: #fff;
            background-color: #155724;
            border-color: #155724
        }

        .list-group-item-info {
            color: #0c5460;
            background-color: #bee5eb
        }

        .list-group-item-info.list-group-item-action:focus,
        .list-group-item-info.list-group-item-action:hover {
            color: #0c5460;
            background-color: #abdde5
        }

        .list-group-item-info.list-group-item-action.active {
            color: #fff;
            background-color: #0c5460;
            border-color: #0c5460
        }

        .list-group-item-warning {
            color: #856404;
            background-color: #ffeeba
        }

        .list-group-item-warning.list-group-item-action:focus,
        .list-group-item-warning.list-group-item-action:hover {
            color: #856404;
            background-color: #ffe8a1
        }

        .list-group-item-warning.list-group-item-action.active {
            color: #fff;
            background-color: #856404;
            border-color: #856404
        }

        .list-group-item-danger {
            color: #721c24;
            background-color: #f5c6cb
        }

        .list-group-item-danger.list-group-item-action:focus,
        .list-group-item-danger.list-group-item-action:hover {
            color: #721c24;
            background-color: #f1b0b7
        }

        .list-group-item-danger.list-group-item-action.active {
            color: #fff;
            background-color: #721c24;
            border-color: #721c24
        }

        .list-group-item-light {
            color: #818182;
            background-color: #fdfdfe
        }

        .list-group-item-light.list-group-item-action:focus,
        .list-group-item-light.list-group-item-action:hover {
            color: #818182;
            background-color: #ececf6
        }

        .list-group-item-light.list-group-item-action.active {
            color: #fff;
            background-color: #818182;
            border-color: #818182
        }

        .list-group-item-dark {
            color: #1b1e21;
            background-color: #c6c8ca
        }

        .list-group-item-dark.list-group-item-action:focus,
        .list-group-item-dark.list-group-item-action:hover {
            color: #1b1e21;
            background-color: #b9bbbe
        }

        .list-group-item-dark.list-group-item-action.active {
            color: #fff;
            background-color: #1b1e21;
            border-color: #1b1e21
        }

        .close {
            float: right;
            font-size: 1.5rem;
            font-weight: 700;
            line-height: 1;
            color: #000;
            text-shadow: 0 1px 0 #fff;
            opacity: .5
        }

        .close:hover {
            color: #000;
            text-decoration: none
        }

        .close:not(:disabled):not(.disabled):focus,
        .close:not(:disabled):not(.disabled):hover {
            opacity: .75
        }

        button.close {
            padding: 0;
            background-color: transparent;
            border: 0;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none
        }

        a.close.disabled {
            pointer-events: none
        }

        .toast {
            max-width: 350px;
            overflow: hidden;
            font-size: .875rem;
            background-color: rgba(255, 255, 255, .85);
            background-clip: padding-box;
            border: 1px solid rgba(0, 0, 0, .1);
            box-shadow: 0 .25rem .75rem rgba(0, 0, 0, .1);
            -webkit-backdrop-filter: blur(10px);
            backdrop-filter: blur(10px);
            opacity: 0;
            border-radius: .25rem
        }

        .toast:not(:last-child) {
            margin-bottom: .75rem
        }

        .toast.showing {
            opacity: 1
        }

        .toast.show {
            display: block;
            opacity: 1
        }

        .toast.hide {
            display: none
        }

        .toast-header {
            display: -ms-flexbox;
            display: flex;
            -ms-flex-align: center;
            align-items: center;
            padding: .25rem .75rem;
            color: #6c757d;
            background-color: rgba(255, 255, 255, .85);
            background-clip: padding-box;
            border-bottom: 1px solid rgba(0, 0, 0, .05)
        }

        .toast-body {
            padding: .75rem
        }

        .modal-open {
            overflow: hidden
        }

        .modal-open .modal {
            overflow-x: hidden;
            overflow-y: auto
        }

        .modal {
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1050;
            display: none;
            width: 100%;
            height: 100%;
            overflow: hidden;
            outline: 0
        }

        .modal-dialog {
            position: relative;
            width: auto;
            margin: .5rem;
            pointer-events: none
        }

        .modal.fade .modal-dialog {
            transition: -webkit-transform .3s ease-out;
            transition: transform .3s ease-out;
            transition: transform .3s ease-out, -webkit-transform .3s ease-out;
            -webkit-transform: translate(0, -50px);
            transform: translate(0, -50px)
        }

        @media (prefers-reduced-motion:reduce) {
            .modal.fade .modal-dialog {
                transition: none
            }
        }

        .modal.show .modal-dialog {
            -webkit-transform: none;
            transform: none
        }

        .modal-dialog-scrollable {
            display: -ms-flexbox;
            display: flex;
            max-height: calc(100% - 1rem)
        }

        .modal-dialog-scrollable .modal-content {
            max-height: calc(100vh - 1rem);
            overflow: hidden
        }

        .modal-dialog-scrollable .modal-footer,
        .modal-dialog-scrollable .modal-header {
            -ms-flex-negative: 0;
            flex-shrink: 0
        }

        .modal-dialog-scrollable .modal-body {
            overflow-y: auto
        }

        .modal-dialog-centered {
            display: -ms-flexbox;
            display: flex;
            -ms-flex-align: center;
            align-items: center;
            min-height: calc(100% - 1rem)
        }

        .modal-dialog-centered::before {
            display: block;
            height: calc(100vh - 1rem);
            content: ""
        }

        .modal-dialog-centered.modal-dialog-scrollable {
            -ms-flex-direction: column;
            flex-direction: column;
            -ms-flex-pack: center;
            justify-content: center;
            height: 100%
        }

        .modal-dialog-centered.modal-dialog-scrollable .modal-content {
            max-height: none
        }

        .modal-dialog-centered.modal-dialog-scrollable::before {
            content: none
        }

        .modal-content {
            position: relative;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-direction: column;
            flex-direction: column;
            width: 100%;
            pointer-events: auto;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid rgba(0, 0, 0, .2);
            border-radius: .3rem;
            outline: 0
        }

        .modal-backdrop {
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1040;
            width: 100vw;
            height: 100vh;
            background-color: #000
        }

        .modal-backdrop.fade {
            opacity: 0
        }

        .modal-backdrop.show {
            opacity: .5
        }

        .modal-header {
            display: -ms-flexbox;
            display: flex;
            -ms-flex-align: start;
            align-items: flex-start;
            -ms-flex-pack: justify;
            justify-content: space-between;
            padding: 1rem 1rem;
            border-bottom: 1px solid #dee2e6;
            border-top-left-radius: .3rem;
            border-top-right-radius: .3rem
        }

        .modal-header .close {
            padding: 1rem 1rem;
            margin: -1rem -1rem -1rem auto
        }

        .modal-title {
            margin-bottom: 0;
            line-height: 1.5
        }

        .modal-body {
            position: relative;
            -ms-flex: 1 1 auto;
            flex: 1 1 auto;
            padding: 1rem
        }

        .modal-footer {
            display: -ms-flexbox;
            display: flex;
            -ms-flex-align: center;
            align-items: center;
            -ms-flex-pack: end;
            justify-content: flex-end;
            padding: 1rem;
            border-top: 1px solid #dee2e6;
            border-bottom-right-radius: .3rem;
            border-bottom-left-radius: .3rem
        }

        .modal-footer>:not(:first-child) {
            margin-left: .25rem
        }

        .modal-footer>:not(:last-child) {
            margin-right: .25rem
        }

        .modal-scrollbar-measure {
            position: absolute;
            top: -9999px;
            width: 50px;
            height: 50px;
            overflow: scroll
        }

        @media (min-width:576px) {
            .modal-dialog {
                max-width: 500px;
                margin: 1.75rem auto
            }

            .modal-dialog-scrollable {
                max-height: calc(100% - 3.5rem)
            }

            .modal-dialog-scrollable .modal-content {
                max-height: calc(100vh - 3.5rem)
            }

            .modal-dialog-centered {
                min-height: calc(100% - 3.5rem)
            }

            .modal-dialog-centered::before {
                height: calc(100vh - 3.5rem)
            }

            .modal-sm {
                max-width: 300px
            }
        }

        @media (min-width:992px) {

            .modal-lg,
            .modal-xl {
                max-width: 800px
            }
        }

        @media (min-width:1200px) {
            .modal-xl {
                max-width: 1140px
            }
        }

        .tooltip {
            position: absolute;
            z-index: 1070;
            display: block;
            margin: 0;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
            font-style: normal;
            font-weight: 400;
            line-height: 1.5;
            text-align: left;
            text-align: start;
            text-decoration: none;
            text-shadow: none;
            text-transform: none;
            letter-spacing: normal;
            word-break: normal;
            word-spacing: normal;
            white-space: normal;
            line-break: auto;
            font-size: .875rem;
            word-wrap: break-word;
            opacity: 0
        }

        .tooltip.show {
            opacity: .9
        }

        .tooltip .arrow {
            position: absolute;
            display: block;
            width: .8rem;
            height: .4rem
        }

        .tooltip .arrow::before {
            position: absolute;
            content: "";
            border-color: transparent;
            border-style: solid
        }

        .bs-tooltip-auto[x-placement^=top],
        .bs-tooltip-top {
            padding: .4rem 0
        }

        .bs-tooltip-auto[x-placement^=top] .arrow,
        .bs-tooltip-top .arrow {
            bottom: 0
        }

        .bs-tooltip-auto[x-placement^=top] .arrow::before,
        .bs-tooltip-top .arrow::before {
            top: 0;
            border-width: .4rem .4rem 0;
            border-top-color: #000
        }

        .bs-tooltip-auto[x-placement^=right],
        .bs-tooltip-right {
            padding: 0 .4rem
        }

        .bs-tooltip-auto[x-placement^=right] .arrow,
        .bs-tooltip-right .arrow {
            left: 0;
            width: .4rem;
            height: .8rem
        }

        .bs-tooltip-auto[x-placement^=right] .arrow::before,
        .bs-tooltip-right .arrow::before {
            right: 0;
            border-width: .4rem .4rem .4rem 0;
            border-right-color: #000
        }

        .bs-tooltip-auto[x-placement^=bottom],
        .bs-tooltip-bottom {
            padding: .4rem 0
        }

        .bs-tooltip-auto[x-placement^=bottom] .arrow,
        .bs-tooltip-bottom .arrow {
            top: 0
        }

        .bs-tooltip-auto[x-placement^=bottom] .arrow::before,
        .bs-tooltip-bottom .arrow::before {
            bottom: 0;
            border-width: 0 .4rem .4rem;
            border-bottom-color: #000
        }

        .bs-tooltip-auto[x-placement^=left],
        .bs-tooltip-left {
            padding: 0 .4rem
        }

        .bs-tooltip-auto[x-placement^=left] .arrow,
        .bs-tooltip-left .arrow {
            right: 0;
            width: .4rem;
            height: .8rem
        }

        .bs-tooltip-auto[x-placement^=left] .arrow::before,
        .bs-tooltip-left .arrow::before {
            left: 0;
            border-width: .4rem 0 .4rem .4rem;
            border-left-color: #000
        }

        .tooltip-inner {
            max-width: 200px;
            padding: .25rem .5rem;
            color: #fff;
            text-align: center;
            background-color: #000;
            border-radius: .25rem
        }

        .popover {
            position: absolute;
            top: 0;
            left: 0;
            z-index: 1060;
            display: block;
            max-width: 276px;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
            font-style: normal;
            font-weight: 400;
            line-height: 1.5;
            text-align: left;
            text-align: start;
            text-decoration: none;
            text-shadow: none;
            text-transform: none;
            letter-spacing: normal;
            word-break: normal;
            word-spacing: normal;
            white-space: normal;
            line-break: auto;
            font-size: .875rem;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid rgba(0, 0, 0, .2);
            border-radius: .3rem
        }

        .popover .arrow {
            position: absolute;
            display: block;
            width: 1rem;
            height: .5rem;
            margin: 0 .3rem
        }

        .popover .arrow::after,
        .popover .arrow::before {
            position: absolute;
            display: block;
            content: "";
            border-color: transparent;
            border-style: solid
        }

        .bs-popover-auto[x-placement^=top],
        .bs-popover-top {
            margin-bottom: .5rem
        }

        .bs-popover-auto[x-placement^=top]>.arrow,
        .bs-popover-top>.arrow {
            bottom: calc((.5rem + 1px) * -1)
        }

        .bs-popover-auto[x-placement^=top]>.arrow::before,
        .bs-popover-top>.arrow::before {
            bottom: 0;
            border-width: .5rem .5rem 0;
            border-top-color: rgba(0, 0, 0, .25)
        }

        .bs-popover-auto[x-placement^=top]>.arrow::after,
        .bs-popover-top>.arrow::after {
            bottom: 1px;
            border-width: .5rem .5rem 0;
            border-top-color: #fff
        }

        .bs-popover-auto[x-placement^=right],
        .bs-popover-right {
            margin-left: .5rem
        }

        .bs-popover-auto[x-placement^=right]>.arrow,
        .bs-popover-right>.arrow {
            left: calc((.5rem + 1px) * -1);
            width: .5rem;
            height: 1rem;
            margin: .3rem 0
        }

        .bs-popover-auto[x-placement^=right]>.arrow::before,
        .bs-popover-right>.arrow::before {
            left: 0;
            border-width: .5rem .5rem .5rem 0;
            border-right-color: rgba(0, 0, 0, .25)
        }

        .bs-popover-auto[x-placement^=right]>.arrow::after,
        .bs-popover-right>.arrow::after {
            left: 1px;
            border-width: .5rem .5rem .5rem 0;
            border-right-color: #fff
        }

        .bs-popover-auto[x-placement^=bottom],
        .bs-popover-bottom {
            margin-top: .5rem
        }

        .bs-popover-auto[x-placement^=bottom]>.arrow,
        .bs-popover-bottom>.arrow {
            top: calc((.5rem + 1px) * -1)
        }

        .bs-popover-auto[x-placement^=bottom]>.arrow::before,
        .bs-popover-bottom>.arrow::before {
            top: 0;
            border-width: 0 .5rem .5rem .5rem;
            border-bottom-color: rgba(0, 0, 0, .25)
        }

        .bs-popover-auto[x-placement^=bottom]>.arrow::after,
        .bs-popover-bottom>.arrow::after {
            top: 1px;
            border-width: 0 .5rem .5rem .5rem;
            border-bottom-color: #fff
        }

        .bs-popover-auto[x-placement^=bottom] .popover-header::before,
        .bs-popover-bottom .popover-header::before {
            position: absolute;
            top: 0;
            left: 50%;
            display: block;
            width: 1rem;
            margin-left: -.5rem;
            content: "";
            border-bottom: 1px solid #f7f7f7
        }

        .bs-popover-auto[x-placement^=left],
        .bs-popover-left {
            margin-right: .5rem
        }

        .bs-popover-auto[x-placement^=left]>.arrow,
        .bs-popover-left>.arrow {
            right: calc((.5rem + 1px) * -1);
            width: .5rem;
            height: 1rem;
            margin: .3rem 0
        }

        .bs-popover-auto[x-placement^=left]>.arrow::before,
        .bs-popover-left>.arrow::before {
            right: 0;
            border-width: .5rem 0 .5rem .5rem;
            border-left-color: rgba(0, 0, 0, .25)
        }

        .bs-popover-auto[x-placement^=left]>.arrow::after,
        .bs-popover-left>.arrow::after {
            right: 1px;
            border-width: .5rem 0 .5rem .5rem;
            border-left-color: #fff
        }

        .popover-header {
            padding: .5rem .75rem;
            margin-bottom: 0;
            font-size: 1rem;
            background-color: #f7f7f7;
            border-bottom: 1px solid #ebebeb;
            border-top-left-radius: calc(.3rem - 1px);
            border-top-right-radius: calc(.3rem - 1px)
        }

        .popover-header:empty {
            display: none
        }

        .popover-body {
            padding: .5rem .75rem;
            color: #212529
        }

        .carousel {
            position: relative
        }

        .carousel.pointer-event {
            -ms-touch-action: pan-y;
            touch-action: pan-y
        }

        .carousel-inner {
            position: relative;
            width: 100%;
            overflow: hidden
        }

        .carousel-inner::after {
            display: block;
            clear: both;
            content: ""
        }

        .carousel-item {
            position: relative;
            display: none;
            float: left;
            width: 100%;
            margin-right: -100%;
            -webkit-backface-visibility: hidden;
            backface-visibility: hidden;
            transition: -webkit-transform .6s ease-in-out;
            transition: transform .6s ease-in-out;
            transition: transform .6s ease-in-out, -webkit-transform .6s ease-in-out
        }

        @media (prefers-reduced-motion:reduce) {
            .carousel-item {
                transition: none
            }
        }

        .carousel-item-next,
        .carousel-item-prev,
        .carousel-item.active {
            display: block
        }

        .active.carousel-item-right,
        .carousel-item-next:not(.carousel-item-left) {
            -webkit-transform: translateX(100%);
            transform: translateX(100%)
        }

        .active.carousel-item-left,
        .carousel-item-prev:not(.carousel-item-right) {
            -webkit-transform: translateX(-100%);
            transform: translateX(-100%)
        }

        .carousel-fade .carousel-item {
            opacity: 0;
            transition-property: opacity;
            -webkit-transform: none;
            transform: none
        }

        .carousel-fade .carousel-item-next.carousel-item-left,
        .carousel-fade .carousel-item-prev.carousel-item-right,
        .carousel-fade .carousel-item.active {
            z-index: 1;
            opacity: 1
        }

        .carousel-fade .active.carousel-item-left,
        .carousel-fade .active.carousel-item-right {
            z-index: 0;
            opacity: 0;
            transition: 0s .6s opacity
        }

        @media (prefers-reduced-motion:reduce) {

            .carousel-fade .active.carousel-item-left,
            .carousel-fade .active.carousel-item-right {
                transition: none
            }
        }

        .carousel-control-next,
        .carousel-control-prev {
            position: absolute;
            top: 0;
            bottom: 0;
            z-index: 1;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-align: center;
            align-items: center;
            -ms-flex-pack: center;
            justify-content: center;
            width: 15%;
            color: #fff;
            text-align: center;
            opacity: .5;
            transition: opacity .15s ease
        }

        @media (prefers-reduced-motion:reduce) {

            .carousel-control-next,
            .carousel-control-prev {
                transition: none
            }
        }

        .carousel-control-next:focus,
        .carousel-control-next:hover,
        .carousel-control-prev:focus,
        .carousel-control-prev:hover {
            color: #fff;
            text-decoration: none;
            outline: 0;
            opacity: .9
        }

        .carousel-control-prev {
            left: 0
        }

        .carousel-control-next {
            right: 0
        }

        .carousel-control-next-icon,
        .carousel-control-prev-icon {
            display: inline-block;
            width: 20px;
            height: 20px;
            background: no-repeat 50%/100% 100%
        }

        .carousel-control-prev-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='%23fff' viewBox='0 0 8 8'%3e%3cpath d='M5.25 0l-4 4 4 4 1.5-1.5-2.5-2.5 2.5-2.5-1.5-1.5z'/%3e%3c/svg%3e")
        }

        .carousel-control-next-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='%23fff' viewBox='0 0 8 8'%3e%3cpath d='M2.75 0l-1.5 1.5 2.5 2.5-2.5 2.5 1.5 1.5 4-4-4-4z'/%3e%3c/svg%3e")
        }

        .carousel-indicators {
            position: absolute;
            right: 0;
            bottom: 0;
            left: 0;
            z-index: 15;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-pack: center;
            justify-content: center;
            padding-left: 0;
            margin-right: 15%;
            margin-left: 15%;
            list-style: none
        }

        .carousel-indicators li {
            box-sizing: content-box;
            -ms-flex: 0 1 auto;
            flex: 0 1 auto;
            width: 30px;
            height: 3px;
            margin-right: 3px;
            margin-left: 3px;
            text-indent: -999px;
            cursor: pointer;
            background-color: #fff;
            background-clip: padding-box;
            border-top: 10px solid transparent;
            border-bottom: 10px solid transparent;
            opacity: .5;
            transition: opacity .6s ease
        }

        @media (prefers-reduced-motion:reduce) {
            .carousel-indicators li {
                transition: none
            }
        }

        .carousel-indicators .active {
            opacity: 1
        }

        .carousel-caption {
            position: absolute;
            right: 15%;
            bottom: 20px;
            left: 15%;
            z-index: 10;
            padding-top: 20px;
            padding-bottom: 20px;
            color: #fff;
            text-align: center
        }

        @-webkit-keyframes spinner-border {
            to {
                -webkit-transform: rotate(360deg);
                transform: rotate(360deg)
            }
        }

        @keyframes spinner-border {
            to {
                -webkit-transform: rotate(360deg);
                transform: rotate(360deg)
            }
        }

        .spinner-border {
            display: inline-block;
            width: 2rem;
            height: 2rem;
            vertical-align: text-bottom;
            border: .25em solid currentColor;
            border-right-color: transparent;
            border-radius: 50%;
            -webkit-animation: spinner-border .75s linear infinite;
            animation: spinner-border .75s linear infinite
        }

        .spinner-border-sm {
            width: 1rem;
            height: 1rem;
            border-width: .2em
        }

        @-webkit-keyframes spinner-grow {
            0% {
                -webkit-transform: scale(0);
                transform: scale(0)
            }

            50% {
                opacity: 1
            }
        }

        @keyframes spinner-grow {
            0% {
                -webkit-transform: scale(0);
                transform: scale(0)
            }

            50% {
                opacity: 1
            }
        }

        .spinner-grow {
            display: inline-block;
            width: 2rem;
            height: 2rem;
            vertical-align: text-bottom;
            background-color: currentColor;
            border-radius: 50%;
            opacity: 0;
            -webkit-animation: spinner-grow .75s linear infinite;
            animation: spinner-grow .75s linear infinite
        }

        .spinner-grow-sm {
            width: 1rem;
            height: 1rem
        }

        .align-baseline {
            vertical-align: baseline !important
        }

        .align-top {
            vertical-align: top !important
        }

        .align-middle {
            vertical-align: middle !important
        }

        .align-bottom {
            vertical-align: bottom !important
        }

        .align-text-bottom {
            vertical-align: text-bottom !important
        }

        .align-text-top {
            vertical-align: text-top !important
        }

        .bg-primary {
            background-color: #007bff !important
        }

        a.bg-primary:focus,
        a.bg-primary:hover,
        button.bg-primary:focus,
        button.bg-primary:hover {
            background-color: #0062cc !important
        }

        .bg-secondary {
            background-color: #6c757d !important
        }

        a.bg-secondary:focus,
        a.bg-secondary:hover,
        button.bg-secondary:focus,
        button.bg-secondary:hover {
            background-color: #545b62 !important
        }

        .bg-success {
            background-color: #28a745 !important
        }

        a.bg-success:focus,
        a.bg-success:hover,
        button.bg-success:focus,
        button.bg-success:hover {
            background-color: #1e7e34 !important
        }

        .bg-info {
            background-color: #17a2b8 !important
        }

        a.bg-info:focus,
        a.bg-info:hover,
        button.bg-info:focus,
        button.bg-info:hover {
            background-color: #117a8b !important
        }

        .bg-warning {
            background-color: #ffc107 !important
        }

        a.bg-warning:focus,
        a.bg-warning:hover,
        button.bg-warning:focus,
        button.bg-warning:hover {
            background-color: #d39e00 !important
        }

        .bg-danger {
            background-color: #dc3545 !important
        }

        a.bg-danger:focus,
        a.bg-danger:hover,
        button.bg-danger:focus,
        button.bg-danger:hover {
            background-color: #bd2130 !important
        }

        .bg-light {
            background-color: #f8f9fa !important
        }

        a.bg-light:focus,
        a.bg-light:hover,
        button.bg-light:focus,
        button.bg-light:hover {
            background-color: #dae0e5 !important
        }

        .bg-dark {
            background-color: #343a40 !important
        }

        a.bg-dark:focus,
        a.bg-dark:hover,
        button.bg-dark:focus,
        button.bg-dark:hover {
            background-color: #1d2124 !important
        }

        .bg-white {
            background-color: #fff !important
        }

        .bg-transparent {
            background-color: transparent !important
        }

        .border {
            border: 1px solid #dee2e6 !important
        }

        .border-top {
            border-top: 1px solid #dee2e6 !important
        }

        .border-right {
            border-right: 1px solid #dee2e6 !important
        }

        .border-bottom {
            border-bottom: 1px solid #dee2e6 !important
        }

        .border-left {
            border-left: 1px solid #dee2e6 !important
        }

        .border-0 {
            border: 0 !important
        }

        .border-top-0 {
            border-top: 0 !important
        }

        .border-right-0 {
            border-right: 0 !important
        }

        .border-bottom-0 {
            border-bottom: 0 !important
        }

        .border-left-0 {
            border-left: 0 !important
        }

        .border-primary {
            border-color: #007bff !important
        }

        .border-secondary {
            border-color: #6c757d !important
        }

        .border-success {
            border-color: #28a745 !important
        }

        .border-info {
            border-color: #17a2b8 !important
        }

        .border-warning {
            border-color: #ffc107 !important
        }

        .border-danger {
            border-color: #dc3545 !important
        }

        .border-light {
            border-color: #f8f9fa !important
        }

        .border-dark {
            border-color: #343a40 !important
        }

        .border-white {
            border-color: #fff !important
        }

        .rounded-sm {
            border-radius: .2rem !important
        }

        .rounded {
            border-radius: .25rem !important
        }

        .rounded-top {
            border-top-left-radius: .25rem !important;
            border-top-right-radius: .25rem !important
        }

        .rounded-right {
            border-top-right-radius: .25rem !important;
            border-bottom-right-radius: .25rem !important
        }

        .rounded-bottom {
            border-bottom-right-radius: .25rem !important;
            border-bottom-left-radius: .25rem !important
        }

        .rounded-left {
            border-top-left-radius: .25rem !important;
            border-bottom-left-radius: .25rem !important
        }

        .rounded-lg {
            border-radius: .3rem !important
        }

        .rounded-circle {
            border-radius: 50% !important
        }

        .rounded-pill {
            border-radius: 50rem !important
        }

        .rounded-0 {
            border-radius: 0 !important
        }

        .clearfix::after {
            display: block;
            clear: both;
            content: ""
        }

        .d-none {
            display: none !important
        }

        .d-inline {
            display: inline !important
        }

        .d-inline-block {
            display: inline-block !important
        }

        .d-block {
            display: block !important
        }

        .d-table {
            display: table !important
        }

        .d-table-row {
            display: table-row !important
        }

        .d-table-cell {
            display: table-cell !important
        }

        .d-flex {
            display: -ms-flexbox !important;
            display: flex !important
        }

        .d-inline-flex {
            display: -ms-inline-flexbox !important;
            display: inline-flex !important
        }

        @media (min-width:576px) {
            .d-sm-none {
                display: none !important
            }

            .d-sm-inline {
                display: inline !important
            }

            .d-sm-inline-block {
                display: inline-block !important
            }

            .d-sm-block {
                display: block !important
            }

            .d-sm-table {
                display: table !important
            }

            .d-sm-table-row {
                display: table-row !important
            }

            .d-sm-table-cell {
                display: table-cell !important
            }

            .d-sm-flex {
                display: -ms-flexbox !important;
                display: flex !important
            }

            .d-sm-inline-flex {
                display: -ms-inline-flexbox !important;
                display: inline-flex !important
            }
        }

        @media (min-width:768px) {
            .d-md-none {
                display: none !important
            }

            .d-md-inline {
                display: inline !important
            }

            .d-md-inline-block {
                display: inline-block !important
            }

            .d-md-block {
                display: block !important
            }

            .d-md-table {
                display: table !important
            }

            .d-md-table-row {
                display: table-row !important
            }

            .d-md-table-cell {
                display: table-cell !important
            }

            .d-md-flex {
                display: -ms-flexbox !important;
                display: flex !important
            }

            .d-md-inline-flex {
                display: -ms-inline-flexbox !important;
                display: inline-flex !important
            }
        }

        @media (min-width:992px) {
            .d-lg-none {
                display: none !important
            }

            .d-lg-inline {
                display: inline !important
            }

            .d-lg-inline-block {
                display: inline-block !important
            }

            .d-lg-block {
                display: block !important
            }

            .d-lg-table {
                display: table !important
            }

            .d-lg-table-row {
                display: table-row !important
            }

            .d-lg-table-cell {
                display: table-cell !important
            }

            .d-lg-flex {
                display: -ms-flexbox !important;
                display: flex !important
            }

            .d-lg-inline-flex {
                display: -ms-inline-flexbox !important;
                display: inline-flex !important
            }
        }

        @media (min-width:1200px) {
            .d-xl-none {
                display: none !important
            }

            .d-xl-inline {
                display: inline !important
            }

            .d-xl-inline-block {
                display: inline-block !important
            }

            .d-xl-block {
                display: block !important
            }

            .d-xl-table {
                display: table !important
            }

            .d-xl-table-row {
                display: table-row !important
            }

            .d-xl-table-cell {
                display: table-cell !important
            }

            .d-xl-flex {
                display: -ms-flexbox !important;
                display: flex !important
            }

            .d-xl-inline-flex {
                display: -ms-inline-flexbox !important;
                display: inline-flex !important
            }
        }

        @media print {
            .d-print-none {
                display: none !important
            }

            .d-print-inline {
                display: inline !important
            }

            .d-print-inline-block {
                display: inline-block !important
            }

            .d-print-block {
                display: block !important
            }

            .d-print-table {
                display: table !important
            }

            .d-print-table-row {
                display: table-row !important
            }

            .d-print-table-cell {
                display: table-cell !important
            }

            .d-print-flex {
                display: -ms-flexbox !important;
                display: flex !important
            }

            .d-print-inline-flex {
                display: -ms-inline-flexbox !important;
                display: inline-flex !important
            }
        }

        .embed-responsive {
            position: relative;
            display: block;
            width: 100%;
            padding: 0;
            overflow: hidden
        }

        .embed-responsive::before {
            display: block;
            content: ""
        }

        .embed-responsive .embed-responsive-item,
        .embed-responsive embed,
        .embed-responsive iframe,
        .embed-responsive object,
        .embed-responsive video {
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: 0
        }

        .embed-responsive-21by9::before {
            padding-top: 42.857143%
        }

        .embed-responsive-16by9::before {
            padding-top: 56.25%
        }

        .embed-responsive-4by3::before {
            padding-top: 75%
        }

        .embed-responsive-1by1::before {
            padding-top: 100%
        }

        .flex-row {
            -ms-flex-direction: row !important;
            flex-direction: row !important
        }

        .flex-column {
            -ms-flex-direction: column !important;
            flex-direction: column !important
        }

        .flex-row-reverse {
            -ms-flex-direction: row-reverse !important;
            flex-direction: row-reverse !important
        }

        .flex-column-reverse {
            -ms-flex-direction: column-reverse !important;
            flex-direction: column-reverse !important
        }

        .flex-wrap {
            -ms-flex-wrap: wrap !important;
            flex-wrap: wrap !important
        }

        .flex-nowrap {
            -ms-flex-wrap: nowrap !important;
            flex-wrap: nowrap !important
        }

        .flex-wrap-reverse {
            -ms-flex-wrap: wrap-reverse !important;
            flex-wrap: wrap-reverse !important
        }

        .flex-fill {
            -ms-flex: 1 1 auto !important;
            flex: 1 1 auto !important
        }

        .flex-grow-0 {
            -ms-flex-positive: 0 !important;
            flex-grow: 0 !important
        }

        .flex-grow-1 {
            -ms-flex-positive: 1 !important;
            flex-grow: 1 !important
        }

        .flex-shrink-0 {
            -ms-flex-negative: 0 !important;
            flex-shrink: 0 !important
        }

        .flex-shrink-1 {
            -ms-flex-negative: 1 !important;
            flex-shrink: 1 !important
        }

        .justify-content-start {
            -ms-flex-pack: start !important;
            justify-content: flex-start !important
        }

        .justify-content-end {
            -ms-flex-pack: end !important;
            justify-content: flex-end !important
        }

        .justify-content-center {
            -ms-flex-pack: center !important;
            justify-content: center !important
        }

        .justify-content-between {
            -ms-flex-pack: justify !important;
            justify-content: space-between !important
        }

        .justify-content-around {
            -ms-flex-pack: distribute !important;
            justify-content: space-around !important
        }

        .align-items-start {
            -ms-flex-align: start !important;
            align-items: flex-start !important
        }

        .align-items-end {
            -ms-flex-align: end !important;
            align-items: flex-end !important
        }

        .align-items-center {
            -ms-flex-align: center !important;
            align-items: center !important
        }

        .align-items-baseline {
            -ms-flex-align: baseline !important;
            align-items: baseline !important
        }

        .align-items-stretch {
            -ms-flex-align: stretch !important;
            align-items: stretch !important
        }

        .align-content-start {
            -ms-flex-line-pack: start !important;
            align-content: flex-start !important
        }

        .align-content-end {
            -ms-flex-line-pack: end !important;
            align-content: flex-end !important
        }

        .align-content-center {
            -ms-flex-line-pack: center !important;
            align-content: center !important
        }

        .align-content-between {
            -ms-flex-line-pack: justify !important;
            align-content: space-between !important
        }

        .align-content-around {
            -ms-flex-line-pack: distribute !important;
            align-content: space-around !important
        }

        .align-content-stretch {
            -ms-flex-line-pack: stretch !important;
            align-content: stretch !important
        }

        .align-self-auto {
            -ms-flex-item-align: auto !important;
            align-self: auto !important
        }

        .align-self-start {
            -ms-flex-item-align: start !important;
            align-self: flex-start !important
        }

        .align-self-end {
            -ms-flex-item-align: end !important;
            align-self: flex-end !important
        }

        .align-self-center {
            -ms-flex-item-align: center !important;
            align-self: center !important
        }

        .align-self-baseline {
            -ms-flex-item-align: baseline !important;
            align-self: baseline !important
        }

        .align-self-stretch {
            -ms-flex-item-align: stretch !important;
            align-self: stretch !important
        }

        @media (min-width:576px) {
            .flex-sm-row {
                -ms-flex-direction: row !important;
                flex-direction: row !important
            }

            .flex-sm-column {
                -ms-flex-direction: column !important;
                flex-direction: column !important
            }

            .flex-sm-row-reverse {
                -ms-flex-direction: row-reverse !important;
                flex-direction: row-reverse !important
            }

            .flex-sm-column-reverse {
                -ms-flex-direction: column-reverse !important;
                flex-direction: column-reverse !important
            }

            .flex-sm-wrap {
                -ms-flex-wrap: wrap !important;
                flex-wrap: wrap !important
            }

            .flex-sm-nowrap {
                -ms-flex-wrap: nowrap !important;
                flex-wrap: nowrap !important
            }

            .flex-sm-wrap-reverse {
                -ms-flex-wrap: wrap-reverse !important;
                flex-wrap: wrap-reverse !important
            }

            .flex-sm-fill {
                -ms-flex: 1 1 auto !important;
                flex: 1 1 auto !important
            }

            .flex-sm-grow-0 {
                -ms-flex-positive: 0 !important;
                flex-grow: 0 !important
            }

            .flex-sm-grow-1 {
                -ms-flex-positive: 1 !important;
                flex-grow: 1 !important
            }

            .flex-sm-shrink-0 {
                -ms-flex-negative: 0 !important;
                flex-shrink: 0 !important
            }

            .flex-sm-shrink-1 {
                -ms-flex-negative: 1 !important;
                flex-shrink: 1 !important
            }

            .justify-content-sm-start {
                -ms-flex-pack: start !important;
                justify-content: flex-start !important
            }

            .justify-content-sm-end {
                -ms-flex-pack: end !important;
                justify-content: flex-end !important
            }

            .justify-content-sm-center {
                -ms-flex-pack: center !important;
                justify-content: center !important
            }

            .justify-content-sm-between {
                -ms-flex-pack: justify !important;
                justify-content: space-between !important
            }

            .justify-content-sm-around {
                -ms-flex-pack: distribute !important;
                justify-content: space-around !important
            }

            .align-items-sm-start {
                -ms-flex-align: start !important;
                align-items: flex-start !important
            }

            .align-items-sm-end {
                -ms-flex-align: end !important;
                align-items: flex-end !important
            }

            .align-items-sm-center {
                -ms-flex-align: center !important;
                align-items: center !important
            }

            .align-items-sm-baseline {
                -ms-flex-align: baseline !important;
                align-items: baseline !important
            }

            .align-items-sm-stretch {
                -ms-flex-align: stretch !important;
                align-items: stretch !important
            }

            .align-content-sm-start {
                -ms-flex-line-pack: start !important;
                align-content: flex-start !important
            }

            .align-content-sm-end {
                -ms-flex-line-pack: end !important;
                align-content: flex-end !important
            }

            .align-content-sm-center {
                -ms-flex-line-pack: center !important;
                align-content: center !important
            }

            .align-content-sm-between {
                -ms-flex-line-pack: justify !important;
                align-content: space-between !important
            }

            .align-content-sm-around {
                -ms-flex-line-pack: distribute !important;
                align-content: space-around !important
            }

            .align-content-sm-stretch {
                -ms-flex-line-pack: stretch !important;
                align-content: stretch !important
            }

            .align-self-sm-auto {
                -ms-flex-item-align: auto !important;
                align-self: auto !important
            }

            .align-self-sm-start {
                -ms-flex-item-align: start !important;
                align-self: flex-start !important
            }

            .align-self-sm-end {
                -ms-flex-item-align: end !important;
                align-self: flex-end !important
            }

            .align-self-sm-center {
                -ms-flex-item-align: center !important;
                align-self: center !important
            }

            .align-self-sm-baseline {
                -ms-flex-item-align: baseline !important;
                align-self: baseline !important
            }

            .align-self-sm-stretch {
                -ms-flex-item-align: stretch !important;
                align-self: stretch !important
            }
        }

        @media (min-width:768px) {
            .flex-md-row {
                -ms-flex-direction: row !important;
                flex-direction: row !important
            }

            .flex-md-column {
                -ms-flex-direction: column !important;
                flex-direction: column !important
            }

            .flex-md-row-reverse {
                -ms-flex-direction: row-reverse !important;
                flex-direction: row-reverse !important
            }

            .flex-md-column-reverse {
                -ms-flex-direction: column-reverse !important;
                flex-direction: column-reverse !important
            }

            .flex-md-wrap {
                -ms-flex-wrap: wrap !important;
                flex-wrap: wrap !important
            }

            .flex-md-nowrap {
                -ms-flex-wrap: nowrap !important;
                flex-wrap: nowrap !important
            }

            .flex-md-wrap-reverse {
                -ms-flex-wrap: wrap-reverse !important;
                flex-wrap: wrap-reverse !important
            }

            .flex-md-fill {
                -ms-flex: 1 1 auto !important;
                flex: 1 1 auto !important
            }

            .flex-md-grow-0 {
                -ms-flex-positive: 0 !important;
                flex-grow: 0 !important
            }

            .flex-md-grow-1 {
                -ms-flex-positive: 1 !important;
                flex-grow: 1 !important
            }

            .flex-md-shrink-0 {
                -ms-flex-negative: 0 !important;
                flex-shrink: 0 !important
            }

            .flex-md-shrink-1 {
                -ms-flex-negative: 1 !important;
                flex-shrink: 1 !important
            }

            .justify-content-md-start {
                -ms-flex-pack: start !important;
                justify-content: flex-start !important
            }

            .justify-content-md-end {
                -ms-flex-pack: end !important;
                justify-content: flex-end !important
            }

            .justify-content-md-center {
                -ms-flex-pack: center !important;
                justify-content: center !important
            }

            .justify-content-md-between {
                -ms-flex-pack: justify !important;
                justify-content: space-between !important
            }

            .justify-content-md-around {
                -ms-flex-pack: distribute !important;
                justify-content: space-around !important
            }

            .align-items-md-start {
                -ms-flex-align: start !important;
                align-items: flex-start !important
            }

            .align-items-md-end {
                -ms-flex-align: end !important;
                align-items: flex-end !important
            }

            .align-items-md-center {
                -ms-flex-align: center !important;
                align-items: center !important
            }

            .align-items-md-baseline {
                -ms-flex-align: baseline !important;
                align-items: baseline !important
            }

            .align-items-md-stretch {
                -ms-flex-align: stretch !important;
                align-items: stretch !important
            }

            .align-content-md-start {
                -ms-flex-line-pack: start !important;
                align-content: flex-start !important
            }

            .align-content-md-end {
                -ms-flex-line-pack: end !important;
                align-content: flex-end !important
            }

            .align-content-md-center {
                -ms-flex-line-pack: center !important;
                align-content: center !important
            }

            .align-content-md-between {
                -ms-flex-line-pack: justify !important;
                align-content: space-between !important
            }

            .align-content-md-around {
                -ms-flex-line-pack: distribute !important;
                align-content: space-around !important
            }

            .align-content-md-stretch {
                -ms-flex-line-pack: stretch !important;
                align-content: stretch !important
            }

            .align-self-md-auto {
                -ms-flex-item-align: auto !important;
                align-self: auto !important
            }

            .align-self-md-start {
                -ms-flex-item-align: start !important;
                align-self: flex-start !important
            }

            .align-self-md-end {
                -ms-flex-item-align: end !important;
                align-self: flex-end !important
            }

            .align-self-md-center {
                -ms-flex-item-align: center !important;
                align-self: center !important
            }

            .align-self-md-baseline {
                -ms-flex-item-align: baseline !important;
                align-self: baseline !important
            }

            .align-self-md-stretch {
                -ms-flex-item-align: stretch !important;
                align-self: stretch !important
            }
        }

        @media (min-width:992px) {
            .flex-lg-row {
                -ms-flex-direction: row !important;
                flex-direction: row !important
            }

            .flex-lg-column {
                -ms-flex-direction: column !important;
                flex-direction: column !important
            }

            .flex-lg-row-reverse {
                -ms-flex-direction: row-reverse !important;
                flex-direction: row-reverse !important
            }

            .flex-lg-column-reverse {
                -ms-flex-direction: column-reverse !important;
                flex-direction: column-reverse !important
            }

            .flex-lg-wrap {
                -ms-flex-wrap: wrap !important;
                flex-wrap: wrap !important
            }

            .flex-lg-nowrap {
                -ms-flex-wrap: nowrap !important;
                flex-wrap: nowrap !important
            }

            .flex-lg-wrap-reverse {
                -ms-flex-wrap: wrap-reverse !important;
                flex-wrap: wrap-reverse !important
            }

            .flex-lg-fill {
                -ms-flex: 1 1 auto !important;
                flex: 1 1 auto !important
            }

            .flex-lg-grow-0 {
                -ms-flex-positive: 0 !important;
                flex-grow: 0 !important
            }

            .flex-lg-grow-1 {
                -ms-flex-positive: 1 !important;
                flex-grow: 1 !important
            }

            .flex-lg-shrink-0 {
                -ms-flex-negative: 0 !important;
                flex-shrink: 0 !important
            }

            .flex-lg-shrink-1 {
                -ms-flex-negative: 1 !important;
                flex-shrink: 1 !important
            }

            .justify-content-lg-start {
                -ms-flex-pack: start !important;
                justify-content: flex-start !important
            }

            .justify-content-lg-end {
                -ms-flex-pack: end !important;
                justify-content: flex-end !important
            }

            .justify-content-lg-center {
                -ms-flex-pack: center !important;
                justify-content: center !important
            }

            .justify-content-lg-between {
                -ms-flex-pack: justify !important;
                justify-content: space-between !important
            }

            .justify-content-lg-around {
                -ms-flex-pack: distribute !important;
                justify-content: space-around !important
            }

            .align-items-lg-start {
                -ms-flex-align: start !important;
                align-items: flex-start !important
            }

            .align-items-lg-end {
                -ms-flex-align: end !important;
                align-items: flex-end !important
            }

            .align-items-lg-center {
                -ms-flex-align: center !important;
                align-items: center !important
            }

            .align-items-lg-baseline {
                -ms-flex-align: baseline !important;
                align-items: baseline !important
            }

            .align-items-lg-stretch {
                -ms-flex-align: stretch !important;
                align-items: stretch !important
            }

            .align-content-lg-start {
                -ms-flex-line-pack: start !important;
                align-content: flex-start !important
            }

            .align-content-lg-end {
                -ms-flex-line-pack: end !important;
                align-content: flex-end !important
            }

            .align-content-lg-center {
                -ms-flex-line-pack: center !important;
                align-content: center !important
            }

            .align-content-lg-between {
                -ms-flex-line-pack: justify !important;
                align-content: space-between !important
            }

            .align-content-lg-around {
                -ms-flex-line-pack: distribute !important;
                align-content: space-around !important
            }

            .align-content-lg-stretch {
                -ms-flex-line-pack: stretch !important;
                align-content: stretch !important
            }

            .align-self-lg-auto {
                -ms-flex-item-align: auto !important;
                align-self: auto !important
            }

            .align-self-lg-start {
                -ms-flex-item-align: start !important;
                align-self: flex-start !important
            }

            .align-self-lg-end {
                -ms-flex-item-align: end !important;
                align-self: flex-end !important
            }

            .align-self-lg-center {
                -ms-flex-item-align: center !important;
                align-self: center !important
            }

            .align-self-lg-baseline {
                -ms-flex-item-align: baseline !important;
                align-self: baseline !important
            }

            .align-self-lg-stretch {
                -ms-flex-item-align: stretch !important;
                align-self: stretch !important
            }
        }

        @media (min-width:1200px) {
            .flex-xl-row {
                -ms-flex-direction: row !important;
                flex-direction: row !important
            }

            .flex-xl-column {
                -ms-flex-direction: column !important;
                flex-direction: column !important
            }

            .flex-xl-row-reverse {
                -ms-flex-direction: row-reverse !important;
                flex-direction: row-reverse !important
            }

            .flex-xl-column-reverse {
                -ms-flex-direction: column-reverse !important;
                flex-direction: column-reverse !important
            }

            .flex-xl-wrap {
                -ms-flex-wrap: wrap !important;
                flex-wrap: wrap !important
            }

            .flex-xl-nowrap {
                -ms-flex-wrap: nowrap !important;
                flex-wrap: nowrap !important
            }

            .flex-xl-wrap-reverse {
                -ms-flex-wrap: wrap-reverse !important;
                flex-wrap: wrap-reverse !important
            }

            .flex-xl-fill {
                -ms-flex: 1 1 auto !important;
                flex: 1 1 auto !important
            }

            .flex-xl-grow-0 {
                -ms-flex-positive: 0 !important;
                flex-grow: 0 !important
            }

            .flex-xl-grow-1 {
                -ms-flex-positive: 1 !important;
                flex-grow: 1 !important
            }

            .flex-xl-shrink-0 {
                -ms-flex-negative: 0 !important;
                flex-shrink: 0 !important
            }

            .flex-xl-shrink-1 {
                -ms-flex-negative: 1 !important;
                flex-shrink: 1 !important
            }

            .justify-content-xl-start {
                -ms-flex-pack: start !important;
                justify-content: flex-start !important
            }

            .justify-content-xl-end {
                -ms-flex-pack: end !important;
                justify-content: flex-end !important
            }

            .justify-content-xl-center {
                -ms-flex-pack: center !important;
                justify-content: center !important
            }

            .justify-content-xl-between {
                -ms-flex-pack: justify !important;
                justify-content: space-between !important
            }

            .justify-content-xl-around {
                -ms-flex-pack: distribute !important;
                justify-content: space-around !important
            }

            .align-items-xl-start {
                -ms-flex-align: start !important;
                align-items: flex-start !important
            }

            .align-items-xl-end {
                -ms-flex-align: end !important;
                align-items: flex-end !important
            }

            .align-items-xl-center {
                -ms-flex-align: center !important;
                align-items: center !important
            }

            .align-items-xl-baseline {
                -ms-flex-align: baseline !important;
                align-items: baseline !important
            }

            .align-items-xl-stretch {
                -ms-flex-align: stretch !important;
                align-items: stretch !important
            }

            .align-content-xl-start {
                -ms-flex-line-pack: start !important;
                align-content: flex-start !important
            }

            .align-content-xl-end {
                -ms-flex-line-pack: end !important;
                align-content: flex-end !important
            }

            .align-content-xl-center {
                -ms-flex-line-pack: center !important;
                align-content: center !important
            }

            .align-content-xl-between {
                -ms-flex-line-pack: justify !important;
                align-content: space-between !important
            }

            .align-content-xl-around {
                -ms-flex-line-pack: distribute !important;
                align-content: space-around !important
            }

            .align-content-xl-stretch {
                -ms-flex-line-pack: stretch !important;
                align-content: stretch !important
            }

            .align-self-xl-auto {
                -ms-flex-item-align: auto !important;
                align-self: auto !important
            }

            .align-self-xl-start {
                -ms-flex-item-align: start !important;
                align-self: flex-start !important
            }

            .align-self-xl-end {
                -ms-flex-item-align: end !important;
                align-self: flex-end !important
            }

            .align-self-xl-center {
                -ms-flex-item-align: center !important;
                align-self: center !important
            }

            .align-self-xl-baseline {
                -ms-flex-item-align: baseline !important;
                align-self: baseline !important
            }

            .align-self-xl-stretch {
                -ms-flex-item-align: stretch !important;
                align-self: stretch !important
            }
        }

        .float-left {
            float: left !important
        }

        .float-right {
            float: right !important
        }

        .float-none {
            float: none !important
        }

        @media (min-width:576px) {
            .float-sm-left {
                float: left !important
            }

            .float-sm-right {
                float: right !important
            }

            .float-sm-none {
                float: none !important
            }
        }

        @media (min-width:768px) {
            .float-md-left {
                float: left !important
            }

            .float-md-right {
                float: right !important
            }

            .float-md-none {
                float: none !important
            }
        }

        @media (min-width:992px) {
            .float-lg-left {
                float: left !important
            }

            .float-lg-right {
                float: right !important
            }

            .float-lg-none {
                float: none !important
            }
        }

        @media (min-width:1200px) {
            .float-xl-left {
                float: left !important
            }

            .float-xl-right {
                float: right !important
            }

            .float-xl-none {
                float: none !important
            }
        }

        .overflow-auto {
            overflow: auto !important
        }

        .overflow-hidden {
            overflow: hidden !important
        }

        .position-static {
            position: static !important
        }

        .position-relative {
            position: relative !important
        }

        .position-absolute {
            position: absolute !important
        }

        .position-fixed {
            position: fixed !important
        }

        .position-sticky {
            position: -webkit-sticky !important;
            position: sticky !important
        }

        .fixed-top {
            position: fixed;
            top: 0;
            right: 0;
            left: 0;
            z-index: 1030
        }

        .fixed-bottom {
            position: fixed;
            right: 0;
            bottom: 0;
            left: 0;
            z-index: 1030
        }

        @supports ((position:-webkit-sticky) or (position:sticky)) {
            .sticky-top {
                position: -webkit-sticky;
                position: sticky;
                top: 0;
                z-index: 1020
            }
        }

        .sr-only {
            position: absolute;
            width: 1px;
            height: 1px;
            padding: 0;
            overflow: hidden;
            clip: rect(0, 0, 0, 0);
            white-space: nowrap;
            border: 0
        }

        .sr-only-focusable:active,
        .sr-only-focusable:focus {
            position: static;
            width: auto;
            height: auto;
            overflow: visible;
            clip: auto;
            white-space: normal
        }

        .shadow-sm {
            box-shadow: 0 .125rem .25rem rgba(0, 0, 0, .075) !important
        }

        .shadow {
            box-shadow: 0 .5rem 1rem rgba(0, 0, 0, .15) !important
        }

        .shadow-lg {
            box-shadow: 0 1rem 3rem rgba(0, 0, 0, .175) !important
        }

        .shadow-none {
            box-shadow: none !important
        }

        .w-25 {
            width: 25% !important
        }

        .w-50 {
            width: 50% !important
        }

        .w-75 {
            width: 75% !important
        }

        .w-100 {
            width: 100% !important
        }

        .w-auto {
            width: auto !important
        }

        .h-25 {
            height: 25% !important
        }

        .h-50 {
            height: 50% !important
        }

        .h-75 {
            height: 75% !important
        }

        .h-100 {
            height: 100% !important
        }

        .h-auto {
            height: auto !important
        }

        .mw-100 {
            max-width: 100% !important
        }

        .mh-100 {
            max-height: 100% !important
        }

        .min-vw-100 {
            min-width: 100vw !important
        }

        .min-vh-100 {
            min-height: 100vh !important
        }

        .vw-100 {
            width: 100vw !important
        }

        .vh-100 {
            height: 100vh !important
        }

        .stretched-link::after {
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            z-index: 1;
            pointer-events: auto;
            content: "";
            background-color: rgba(0, 0, 0, 0)
        }

        .m-0 {
            margin: 0 !important
        }

        .mt-0,
        .my-0 {
            margin-top: 0 !important
        }

        .mr-0,
        .mx-0 {
            margin-right: 0 !important
        }

        .mb-0,
        .my-0 {
            margin-bottom: 0 !important
        }

        .ml-0,
        .mx-0 {
            margin-left: 0 !important
        }

        .m-1 {
            margin: .25rem !important
        }

        .mt-1,
        .my-1 {
            margin-top: .25rem !important
        }

        .mr-1,
        .mx-1 {
            margin-right: .25rem !important
        }

        .mb-1,
        .my-1 {
            margin-bottom: .25rem !important
        }

        .ml-1,
        .mx-1 {
            margin-left: .25rem !important
        }

        .m-2 {
            margin: .5rem !important
        }

        .mt-2,
        .my-2 {
            margin-top: .5rem !important
        }

        .mr-2,
        .mx-2 {
            margin-right: .5rem !important
        }

        .mb-2,
        .my-2 {
            margin-bottom: .5rem !important
        }

        .ml-2,
        .mx-2 {
            margin-left: .5rem !important
        }

        .m-3 {
            margin: 1rem !important
        }

        .mt-3,
        .my-3 {
            margin-top: 1rem !important
        }

        .mr-3,
        .mx-3 {
            margin-right: 1rem !important
        }

        .mb-3,
        .my-3 {
            margin-bottom: 1rem !important
        }

        .ml-3,
        .mx-3 {
            margin-left: 1rem !important
        }

        .m-4 {
            margin: 1.5rem !important
        }

        .mt-4,
        .my-4 {
            margin-top: 1.5rem !important
        }

        .mr-4,
        .mx-4 {
            margin-right: 1.5rem !important
        }

        .mb-4,
        .my-4 {
            margin-bottom: 1.5rem !important
        }

        .ml-4,
        .mx-4 {
            margin-left: 1.5rem !important
        }

        .m-5 {
            margin: 3rem !important
        }

        .mt-5,
        .my-5 {
            margin-top: 3rem !important
        }

        .mr-5,
        .mx-5 {
            margin-right: 3rem !important
        }

        .mb-5,
        .my-5 {
            margin-bottom: 3rem !important
        }

        .ml-5,
        .mx-5 {
            margin-left: 3rem !important
        }

        .p-0 {
            padding: 0 !important
        }

        .pt-0,
        .py-0 {
            padding-top: 0 !important
        }

        .pr-0,
        .px-0 {
            padding-right: 0 !important
        }

        .pb-0,
        .py-0 {
            padding-bottom: 0 !important
        }

        .pl-0,
        .px-0 {
            padding-left: 0 !important
        }

        .p-1 {
            padding: .25rem !important
        }

        .pt-1,
        .py-1 {
            padding-top: .25rem !important
        }

        .pr-1,
        .px-1 {
            padding-right: .25rem !important
        }

        .pb-1,
        .py-1 {
            padding-bottom: .25rem !important
        }

        .pl-1,
        .px-1 {
            padding-left: .25rem !important
        }

        .p-2 {
            padding: .5rem !important
        }

        .pt-2,
        .py-2 {
            padding-top: .5rem !important
        }

        .pr-2,
        .px-2 {
            padding-right: .5rem !important
        }

        .pb-2,
        .py-2 {
            padding-bottom: .5rem !important
        }

        .pl-2,
        .px-2 {
            padding-left: .5rem !important
        }

        .p-3 {
            padding: 1rem !important
        }

        .pt-3,
        .py-3 {
            padding-top: 1rem !important
        }

        .pr-3,
        .px-3 {
            padding-right: 1rem !important
        }

        .pb-3,
        .py-3 {
            padding-bottom: 1rem !important
        }

        .pl-3,
        .px-3 {
            padding-left: 1rem !important
        }

        .p-4 {
            padding: 1.5rem !important
        }

        .pt-4,
        .py-4 {
            padding-top: 1.5rem !important
        }

        .pr-4,
        .px-4 {
            padding-right: 1.5rem !important
        }

        .pb-4,
        .py-4 {
            padding-bottom: 1.5rem !important
        }

        .pl-4,
        .px-4 {
            padding-left: 1.5rem !important
        }

        .p-5 {
            padding: 3rem !important
        }

        .pt-5,
        .py-5 {
            padding-top: 3rem !important
        }

        .pr-5,
        .px-5 {
            padding-right: 3rem !important
        }

        .pb-5,
        .py-5 {
            padding-bottom: 3rem !important
        }

        .pl-5,
        .px-5 {
            padding-left: 3rem !important
        }

        .m-n1 {
            margin: -.25rem !important
        }

        .mt-n1,
        .my-n1 {
            margin-top: -.25rem !important
        }

        .mr-n1,
        .mx-n1 {
            margin-right: -.25rem !important
        }

        .mb-n1,
        .my-n1 {
            margin-bottom: -.25rem !important
        }

        .ml-n1,
        .mx-n1 {
            margin-left: -.25rem !important
        }

        .m-n2 {
            margin: -.5rem !important
        }

        .mt-n2,
        .my-n2 {
            margin-top: -.5rem !important
        }

        .mr-n2,
        .mx-n2 {
            margin-right: -.5rem !important
        }

        .mb-n2,
        .my-n2 {
            margin-bottom: -.5rem !important
        }

        .ml-n2,
        .mx-n2 {
            margin-left: -.5rem !important
        }

        .m-n3 {
            margin: -1rem !important
        }

        .mt-n3,
        .my-n3 {
            margin-top: -1rem !important
        }

        .mr-n3,
        .mx-n3 {
            margin-right: -1rem !important
        }

        .mb-n3,
        .my-n3 {
            margin-bottom: -1rem !important
        }

        .ml-n3,
        .mx-n3 {
            margin-left: -1rem !important
        }

        .m-n4 {
            margin: -1.5rem !important
        }

        .mt-n4,
        .my-n4 {
            margin-top: -1.5rem !important
        }

        .mr-n4,
        .mx-n4 {
            margin-right: -1.5rem !important
        }

        .mb-n4,
        .my-n4 {
            margin-bottom: -1.5rem !important
        }

        .ml-n4,
        .mx-n4 {
            margin-left: -1.5rem !important
        }

        .m-n5 {
            margin: -3rem !important
        }

        .mt-n5,
        .my-n5 {
            margin-top: -3rem !important
        }

        .mr-n5,
        .mx-n5 {
            margin-right: -3rem !important
        }

        .mb-n5,
        .my-n5 {
            margin-bottom: -3rem !important
        }

        .ml-n5,
        .mx-n5 {
            margin-left: -3rem !important
        }

        .m-auto {
            margin: auto !important
        }

        .mt-auto,
        .my-auto {
            margin-top: auto !important
        }

        .mr-auto,
        .mx-auto {
            margin-right: auto !important
        }

        .mb-auto,
        .my-auto {
            margin-bottom: auto !important
        }

        .ml-auto,
        .mx-auto {
            margin-left: auto !important
        }

        @media (min-width:576px) {
            .m-sm-0 {
                margin: 0 !important
            }

            .mt-sm-0,
            .my-sm-0 {
                margin-top: 0 !important
            }

            .mr-sm-0,
            .mx-sm-0 {
                margin-right: 0 !important
            }

            .mb-sm-0,
            .my-sm-0 {
                margin-bottom: 0 !important
            }

            .ml-sm-0,
            .mx-sm-0 {
                margin-left: 0 !important
            }

            .m-sm-1 {
                margin: .25rem !important
            }

            .mt-sm-1,
            .my-sm-1 {
                margin-top: .25rem !important
            }

            .mr-sm-1,
            .mx-sm-1 {
                margin-right: .25rem !important
            }

            .mb-sm-1,
            .my-sm-1 {
                margin-bottom: .25rem !important
            }

            .ml-sm-1,
            .mx-sm-1 {
                margin-left: .25rem !important
            }

            .m-sm-2 {
                margin: .5rem !important
            }

            .mt-sm-2,
            .my-sm-2 {
                margin-top: .5rem !important
            }

            .mr-sm-2,
            .mx-sm-2 {
                margin-right: .5rem !important
            }

            .mb-sm-2,
            .my-sm-2 {
                margin-bottom: .5rem !important
            }

            .ml-sm-2,
            .mx-sm-2 {
                margin-left: .5rem !important
            }

            .m-sm-3 {
                margin: 1rem !important
            }

            .mt-sm-3,
            .my-sm-3 {
                margin-top: 1rem !important
            }

            .mr-sm-3,
            .mx-sm-3 {
                margin-right: 1rem !important
            }

            .mb-sm-3,
            .my-sm-3 {
                margin-bottom: 1rem !important
            }

            .ml-sm-3,
            .mx-sm-3 {
                margin-left: 1rem !important
            }

            .m-sm-4 {
                margin: 1.5rem !important
            }

            .mt-sm-4,
            .my-sm-4 {
                margin-top: 1.5rem !important
            }

            .mr-sm-4,
            .mx-sm-4 {
                margin-right: 1.5rem !important
            }

            .mb-sm-4,
            .my-sm-4 {
                margin-bottom: 1.5rem !important
            }

            .ml-sm-4,
            .mx-sm-4 {
                margin-left: 1.5rem !important
            }

            .m-sm-5 {
                margin: 3rem !important
            }

            .mt-sm-5,
            .my-sm-5 {
                margin-top: 3rem !important
            }

            .mr-sm-5,
            .mx-sm-5 {
                margin-right: 3rem !important
            }

            .mb-sm-5,
            .my-sm-5 {
                margin-bottom: 3rem !important
            }

            .ml-sm-5,
            .mx-sm-5 {
                margin-left: 3rem !important
            }

            .p-sm-0 {
                padding: 0 !important
            }

            .pt-sm-0,
            .py-sm-0 {
                padding-top: 0 !important
            }

            .pr-sm-0,
            .px-sm-0 {
                padding-right: 0 !important
            }

            .pb-sm-0,
            .py-sm-0 {
                padding-bottom: 0 !important
            }

            .pl-sm-0,
            .px-sm-0 {
                padding-left: 0 !important
            }

            .p-sm-1 {
                padding: .25rem !important
            }

            .pt-sm-1,
            .py-sm-1 {
                padding-top: .25rem !important
            }

            .pr-sm-1,
            .px-sm-1 {
                padding-right: .25rem !important
            }

            .pb-sm-1,
            .py-sm-1 {
                padding-bottom: .25rem !important
            }

            .pl-sm-1,
            .px-sm-1 {
                padding-left: .25rem !important
            }

            .p-sm-2 {
                padding: .5rem !important
            }

            .pt-sm-2,
            .py-sm-2 {
                padding-top: .5rem !important
            }

            .pr-sm-2,
            .px-sm-2 {
                padding-right: .5rem !important
            }

            .pb-sm-2,
            .py-sm-2 {
                padding-bottom: .5rem !important
            }

            .pl-sm-2,
            .px-sm-2 {
                padding-left: .5rem !important
            }

            .p-sm-3 {
                padding: 1rem !important
            }

            .pt-sm-3,
            .py-sm-3 {
                padding-top: 1rem !important
            }

            .pr-sm-3,
            .px-sm-3 {
                padding-right: 1rem !important
            }

            .pb-sm-3,
            .py-sm-3 {
                padding-bottom: 1rem !important
            }

            .pl-sm-3,
            .px-sm-3 {
                padding-left: 1rem !important
            }

            .p-sm-4 {
                padding: 1.5rem !important
            }

            .pt-sm-4,
            .py-sm-4 {
                padding-top: 1.5rem !important
            }

            .pr-sm-4,
            .px-sm-4 {
                padding-right: 1.5rem !important
            }

            .pb-sm-4,
            .py-sm-4 {
                padding-bottom: 1.5rem !important
            }

            .pl-sm-4,
            .px-sm-4 {
                padding-left: 1.5rem !important
            }

            .p-sm-5 {
                padding: 3rem !important
            }

            .pt-sm-5,
            .py-sm-5 {
                padding-top: 3rem !important
            }

            .pr-sm-5,
            .px-sm-5 {
                padding-right: 3rem !important
            }

            .pb-sm-5,
            .py-sm-5 {
                padding-bottom: 3rem !important
            }

            .pl-sm-5,
            .px-sm-5 {
                padding-left: 3rem !important
            }

            .m-sm-n1 {
                margin: -.25rem !important
            }

            .mt-sm-n1,
            .my-sm-n1 {
                margin-top: -.25rem !important
            }

            .mr-sm-n1,
            .mx-sm-n1 {
                margin-right: -.25rem !important
            }

            .mb-sm-n1,
            .my-sm-n1 {
                margin-bottom: -.25rem !important
            }

            .ml-sm-n1,
            .mx-sm-n1 {
                margin-left: -.25rem !important
            }

            .m-sm-n2 {
                margin: -.5rem !important
            }

            .mt-sm-n2,
            .my-sm-n2 {
                margin-top: -.5rem !important
            }

            .mr-sm-n2,
            .mx-sm-n2 {
                margin-right: -.5rem !important
            }

            .mb-sm-n2,
            .my-sm-n2 {
                margin-bottom: -.5rem !important
            }

            .ml-sm-n2,
            .mx-sm-n2 {
                margin-left: -.5rem !important
            }

            .m-sm-n3 {
                margin: -1rem !important
            }

            .mt-sm-n3,
            .my-sm-n3 {
                margin-top: -1rem !important
            }

            .mr-sm-n3,
            .mx-sm-n3 {
                margin-right: -1rem !important
            }

            .mb-sm-n3,
            .my-sm-n3 {
                margin-bottom: -1rem !important
            }

            .ml-sm-n3,
            .mx-sm-n3 {
                margin-left: -1rem !important
            }

            .m-sm-n4 {
                margin: -1.5rem !important
            }

            .mt-sm-n4,
            .my-sm-n4 {
                margin-top: -1.5rem !important
            }

            .mr-sm-n4,
            .mx-sm-n4 {
                margin-right: -1.5rem !important
            }

            .mb-sm-n4,
            .my-sm-n4 {
                margin-bottom: -1.5rem !important
            }

            .ml-sm-n4,
            .mx-sm-n4 {
                margin-left: -1.5rem !important
            }

            .m-sm-n5 {
                margin: -3rem !important
            }

            .mt-sm-n5,
            .my-sm-n5 {
                margin-top: -3rem !important
            }

            .mr-sm-n5,
            .mx-sm-n5 {
                margin-right: -3rem !important
            }

            .mb-sm-n5,
            .my-sm-n5 {
                margin-bottom: -3rem !important
            }

            .ml-sm-n5,
            .mx-sm-n5 {
                margin-left: -3rem !important
            }

            .m-sm-auto {
                margin: auto !important
            }

            .mt-sm-auto,
            .my-sm-auto {
                margin-top: auto !important
            }

            .mr-sm-auto,
            .mx-sm-auto {
                margin-right: auto !important
            }

            .mb-sm-auto,
            .my-sm-auto {
                margin-bottom: auto !important
            }

            .ml-sm-auto,
            .mx-sm-auto {
                margin-left: auto !important
            }
        }

        @media (min-width:768px) {
            .m-md-0 {
                margin: 0 !important
            }

            .mt-md-0,
            .my-md-0 {
                margin-top: 0 !important
            }

            .mr-md-0,
            .mx-md-0 {
                margin-right: 0 !important
            }

            .mb-md-0,
            .my-md-0 {
                margin-bottom: 0 !important
            }

            .ml-md-0,
            .mx-md-0 {
                margin-left: 0 !important
            }

            .m-md-1 {
                margin: .25rem !important
            }

            .mt-md-1,
            .my-md-1 {
                margin-top: .25rem !important
            }

            .mr-md-1,
            .mx-md-1 {
                margin-right: .25rem !important
            }

            .mb-md-1,
            .my-md-1 {
                margin-bottom: .25rem !important
            }

            .ml-md-1,
            .mx-md-1 {
                margin-left: .25rem !important
            }

            .m-md-2 {
                margin: .5rem !important
            }

            .mt-md-2,
            .my-md-2 {
                margin-top: .5rem !important
            }

            .mr-md-2,
            .mx-md-2 {
                margin-right: .5rem !important
            }

            .mb-md-2,
            .my-md-2 {
                margin-bottom: .5rem !important
            }

            .ml-md-2,
            .mx-md-2 {
                margin-left: .5rem !important
            }

            .m-md-3 {
                margin: 1rem !important
            }

            .mt-md-3,
            .my-md-3 {
                margin-top: 1rem !important
            }

            .mr-md-3,
            .mx-md-3 {
                margin-right: 1rem !important
            }

            .mb-md-3,
            .my-md-3 {
                margin-bottom: 1rem !important
            }

            .ml-md-3,
            .mx-md-3 {
                margin-left: 1rem !important
            }

            .m-md-4 {
                margin: 1.5rem !important
            }

            .mt-md-4,
            .my-md-4 {
                margin-top: 1.5rem !important
            }

            .mr-md-4,
            .mx-md-4 {
                margin-right: 1.5rem !important
            }

            .mb-md-4,
            .my-md-4 {
                margin-bottom: 1.5rem !important
            }

            .ml-md-4,
            .mx-md-4 {
                margin-left: 1.5rem !important
            }

            .m-md-5 {
                margin: 3rem !important
            }

            .mt-md-5,
            .my-md-5 {
                margin-top: 3rem !important
            }

            .mr-md-5,
            .mx-md-5 {
                margin-right: 3rem !important
            }

            .mb-md-5,
            .my-md-5 {
                margin-bottom: 3rem !important
            }

            .ml-md-5,
            .mx-md-5 {
                margin-left: 3rem !important
            }

            .p-md-0 {
                padding: 0 !important
            }

            .pt-md-0,
            .py-md-0 {
                padding-top: 0 !important
            }

            .pr-md-0,
            .px-md-0 {
                padding-right: 0 !important
            }

            .pb-md-0,
            .py-md-0 {
                padding-bottom: 0 !important
            }

            .pl-md-0,
            .px-md-0 {
                padding-left: 0 !important
            }

            .p-md-1 {
                padding: .25rem !important
            }

            .pt-md-1,
            .py-md-1 {
                padding-top: .25rem !important
            }

            .pr-md-1,
            .px-md-1 {
                padding-right: .25rem !important
            }

            .pb-md-1,
            .py-md-1 {
                padding-bottom: .25rem !important
            }

            .pl-md-1,
            .px-md-1 {
                padding-left: .25rem !important
            }

            .p-md-2 {
                padding: .5rem !important
            }

            .pt-md-2,
            .py-md-2 {
                padding-top: .5rem !important
            }

            .pr-md-2,
            .px-md-2 {
                padding-right: .5rem !important
            }

            .pb-md-2,
            .py-md-2 {
                padding-bottom: .5rem !important
            }

            .pl-md-2,
            .px-md-2 {
                padding-left: .5rem !important
            }

            .p-md-3 {
                padding: 1rem !important
            }

            .pt-md-3,
            .py-md-3 {
                padding-top: 1rem !important
            }

            .pr-md-3,
            .px-md-3 {
                padding-right: 1rem !important
            }

            .pb-md-3,
            .py-md-3 {
                padding-bottom: 1rem !important
            }

            .pl-md-3,
            .px-md-3 {
                padding-left: 1rem !important
            }

            .p-md-4 {
                padding: 1.5rem !important
            }

            .pt-md-4,
            .py-md-4 {
                padding-top: 1.5rem !important
            }

            .pr-md-4,
            .px-md-4 {
                padding-right: 1.5rem !important
            }

            .pb-md-4,
            .py-md-4 {
                padding-bottom: 1.5rem !important
            }

            .pl-md-4,
            .px-md-4 {
                padding-left: 1.5rem !important
            }

            .p-md-5 {
                padding: 3rem !important
            }

            .pt-md-5,
            .py-md-5 {
                padding-top: 3rem !important
            }

            .pr-md-5,
            .px-md-5 {
                padding-right: 3rem !important
            }

            .pb-md-5,
            .py-md-5 {
                padding-bottom: 3rem !important
            }

            .pl-md-5,
            .px-md-5 {
                padding-left: 3rem !important
            }

            .m-md-n1 {
                margin: -.25rem !important
            }

            .mt-md-n1,
            .my-md-n1 {
                margin-top: -.25rem !important
            }

            .mr-md-n1,
            .mx-md-n1 {
                margin-right: -.25rem !important
            }

            .mb-md-n1,
            .my-md-n1 {
                margin-bottom: -.25rem !important
            }

            .ml-md-n1,
            .mx-md-n1 {
                margin-left: -.25rem !important
            }

            .m-md-n2 {
                margin: -.5rem !important
            }

            .mt-md-n2,
            .my-md-n2 {
                margin-top: -.5rem !important
            }

            .mr-md-n2,
            .mx-md-n2 {
                margin-right: -.5rem !important
            }

            .mb-md-n2,
            .my-md-n2 {
                margin-bottom: -.5rem !important
            }

            .ml-md-n2,
            .mx-md-n2 {
                margin-left: -.5rem !important
            }

            .m-md-n3 {
                margin: -1rem !important
            }

            .mt-md-n3,
            .my-md-n3 {
                margin-top: -1rem !important
            }

            .mr-md-n3,
            .mx-md-n3 {
                margin-right: -1rem !important
            }

            .mb-md-n3,
            .my-md-n3 {
                margin-bottom: -1rem !important
            }

            .ml-md-n3,
            .mx-md-n3 {
                margin-left: -1rem !important
            }

            .m-md-n4 {
                margin: -1.5rem !important
            }

            .mt-md-n4,
            .my-md-n4 {
                margin-top: -1.5rem !important
            }

            .mr-md-n4,
            .mx-md-n4 {
                margin-right: -1.5rem !important
            }

            .mb-md-n4,
            .my-md-n4 {
                margin-bottom: -1.5rem !important
            }

            .ml-md-n4,
            .mx-md-n4 {
                margin-left: -1.5rem !important
            }

            .m-md-n5 {
                margin: -3rem !important
            }

            .mt-md-n5,
            .my-md-n5 {
                margin-top: -3rem !important
            }

            .mr-md-n5,
            .mx-md-n5 {
                margin-right: -3rem !important
            }

            .mb-md-n5,
            .my-md-n5 {
                margin-bottom: -3rem !important
            }

            .ml-md-n5,
            .mx-md-n5 {
                margin-left: -3rem !important
            }

            .m-md-auto {
                margin: auto !important
            }

            .mt-md-auto,
            .my-md-auto {
                margin-top: auto !important
            }

            .mr-md-auto,
            .mx-md-auto {
                margin-right: auto !important
            }

            .mb-md-auto,
            .my-md-auto {
                margin-bottom: auto !important
            }

            .ml-md-auto,
            .mx-md-auto {
                margin-left: auto !important
            }
        }

        @media (min-width:992px) {
            .m-lg-0 {
                margin: 0 !important
            }

            .mt-lg-0,
            .my-lg-0 {
                margin-top: 0 !important
            }

            .mr-lg-0,
            .mx-lg-0 {
                margin-right: 0 !important
            }

            .mb-lg-0,
            .my-lg-0 {
                margin-bottom: 0 !important
            }

            .ml-lg-0,
            .mx-lg-0 {
                margin-left: 0 !important
            }

            .m-lg-1 {
                margin: .25rem !important
            }

            .mt-lg-1,
            .my-lg-1 {
                margin-top: .25rem !important
            }

            .mr-lg-1,
            .mx-lg-1 {
                margin-right: .25rem !important
            }

            .mb-lg-1,
            .my-lg-1 {
                margin-bottom: .25rem !important
            }

            .ml-lg-1,
            .mx-lg-1 {
                margin-left: .25rem !important
            }

            .m-lg-2 {
                margin: .5rem !important
            }

            .mt-lg-2,
            .my-lg-2 {
                margin-top: .5rem !important
            }

            .mr-lg-2,
            .mx-lg-2 {
                margin-right: .5rem !important
            }

            .mb-lg-2,
            .my-lg-2 {
                margin-bottom: .5rem !important
            }

            .ml-lg-2,
            .mx-lg-2 {
                margin-left: .5rem !important
            }

            .m-lg-3 {
                margin: 1rem !important
            }

            .mt-lg-3,
            .my-lg-3 {
                margin-top: 1rem !important
            }

            .mr-lg-3,
            .mx-lg-3 {
                margin-right: 1rem !important
            }

            .mb-lg-3,
            .my-lg-3 {
                margin-bottom: 1rem !important
            }

            .ml-lg-3,
            .mx-lg-3 {
                margin-left: 1rem !important
            }

            .m-lg-4 {
                margin: 1.5rem !important
            }

            .mt-lg-4,
            .my-lg-4 {
                margin-top: 1.5rem !important
            }

            .mr-lg-4,
            .mx-lg-4 {
                margin-right: 1.5rem !important
            }

            .mb-lg-4,
            .my-lg-4 {
                margin-bottom: 1.5rem !important
            }

            .ml-lg-4,
            .mx-lg-4 {
                margin-left: 1.5rem !important
            }

            .m-lg-5 {
                margin: 3rem !important
            }

            .mt-lg-5,
            .my-lg-5 {
                margin-top: 3rem !important
            }

            .mr-lg-5,
            .mx-lg-5 {
                margin-right: 3rem !important
            }

            .mb-lg-5,
            .my-lg-5 {
                margin-bottom: 3rem !important
            }

            .ml-lg-5,
            .mx-lg-5 {
                margin-left: 3rem !important
            }

            .p-lg-0 {
                padding: 0 !important
            }

            .pt-lg-0,
            .py-lg-0 {
                padding-top: 0 !important
            }

            .pr-lg-0,
            .px-lg-0 {
                padding-right: 0 !important
            }

            .pb-lg-0,
            .py-lg-0 {
                padding-bottom: 0 !important
            }

            .pl-lg-0,
            .px-lg-0 {
                padding-left: 0 !important
            }

            .p-lg-1 {
                padding: .25rem !important
            }

            .pt-lg-1,
            .py-lg-1 {
                padding-top: .25rem !important
            }

            .pr-lg-1,
            .px-lg-1 {
                padding-right: .25rem !important
            }

            .pb-lg-1,
            .py-lg-1 {
                padding-bottom: .25rem !important
            }

            .pl-lg-1,
            .px-lg-1 {
                padding-left: .25rem !important
            }

            .p-lg-2 {
                padding: .5rem !important
            }

            .pt-lg-2,
            .py-lg-2 {
                padding-top: .5rem !important
            }

            .pr-lg-2,
            .px-lg-2 {
                padding-right: .5rem !important
            }

            .pb-lg-2,
            .py-lg-2 {
                padding-bottom: .5rem !important
            }

            .pl-lg-2,
            .px-lg-2 {
                padding-left: .5rem !important
            }

            .p-lg-3 {
                padding: 1rem !important
            }

            .pt-lg-3,
            .py-lg-3 {
                padding-top: 1rem !important
            }

            .pr-lg-3,
            .px-lg-3 {
                padding-right: 1rem !important
            }

            .pb-lg-3,
            .py-lg-3 {
                padding-bottom: 1rem !important
            }

            .pl-lg-3,
            .px-lg-3 {
                padding-left: 1rem !important
            }

            .p-lg-4 {
                padding: 1.5rem !important
            }

            .pt-lg-4,
            .py-lg-4 {
                padding-top: 1.5rem !important
            }

            .pr-lg-4,
            .px-lg-4 {
                padding-right: 1.5rem !important
            }

            .pb-lg-4,
            .py-lg-4 {
                padding-bottom: 1.5rem !important
            }

            .pl-lg-4,
            .px-lg-4 {
                padding-left: 1.5rem !important
            }

            .p-lg-5 {
                padding: 3rem !important
            }

            .pt-lg-5,
            .py-lg-5 {
                padding-top: 3rem !important
            }

            .pr-lg-5,
            .px-lg-5 {
                padding-right: 3rem !important
            }

            .pb-lg-5,
            .py-lg-5 {
                padding-bottom: 3rem !important
            }

            .pl-lg-5,
            .px-lg-5 {
                padding-left: 3rem !important
            }

            .m-lg-n1 {
                margin: -.25rem !important
            }

            .mt-lg-n1,
            .my-lg-n1 {
                margin-top: -.25rem !important
            }

            .mr-lg-n1,
            .mx-lg-n1 {
                margin-right: -.25rem !important
            }

            .mb-lg-n1,
            .my-lg-n1 {
                margin-bottom: -.25rem !important
            }

            .ml-lg-n1,
            .mx-lg-n1 {
                margin-left: -.25rem !important
            }

            .m-lg-n2 {
                margin: -.5rem !important
            }

            .mt-lg-n2,
            .my-lg-n2 {
                margin-top: -.5rem !important
            }

            .mr-lg-n2,
            .mx-lg-n2 {
                margin-right: -.5rem !important
            }

            .mb-lg-n2,
            .my-lg-n2 {
                margin-bottom: -.5rem !important
            }

            .ml-lg-n2,
            .mx-lg-n2 {
                margin-left: -.5rem !important
            }

            .m-lg-n3 {
                margin: -1rem !important
            }

            .mt-lg-n3,
            .my-lg-n3 {
                margin-top: -1rem !important
            }

            .mr-lg-n3,
            .mx-lg-n3 {
                margin-right: -1rem !important
            }

            .mb-lg-n3,
            .my-lg-n3 {
                margin-bottom: -1rem !important
            }

            .ml-lg-n3,
            .mx-lg-n3 {
                margin-left: -1rem !important
            }

            .m-lg-n4 {
                margin: -1.5rem !important
            }

            .mt-lg-n4,
            .my-lg-n4 {
                margin-top: -1.5rem !important
            }

            .mr-lg-n4,
            .mx-lg-n4 {
                margin-right: -1.5rem !important
            }

            .mb-lg-n4,
            .my-lg-n4 {
                margin-bottom: -1.5rem !important
            }

            .ml-lg-n4,
            .mx-lg-n4 {
                margin-left: -1.5rem !important
            }

            .m-lg-n5 {
                margin: -3rem !important
            }

            .mt-lg-n5,
            .my-lg-n5 {
                margin-top: -3rem !important
            }

            .mr-lg-n5,
            .mx-lg-n5 {
                margin-right: -3rem !important
            }

            .mb-lg-n5,
            .my-lg-n5 {
                margin-bottom: -3rem !important
            }

            .ml-lg-n5,
            .mx-lg-n5 {
                margin-left: -3rem !important
            }

            .m-lg-auto {
                margin: auto !important
            }

            .mt-lg-auto,
            .my-lg-auto {
                margin-top: auto !important
            }

            .mr-lg-auto,
            .mx-lg-auto {
                margin-right: auto !important
            }

            .mb-lg-auto,
            .my-lg-auto {
                margin-bottom: auto !important
            }

            .ml-lg-auto,
            .mx-lg-auto {
                margin-left: auto !important
            }
        }

        @media (min-width:1200px) {
            .m-xl-0 {
                margin: 0 !important
            }

            .mt-xl-0,
            .my-xl-0 {
                margin-top: 0 !important
            }

            .mr-xl-0,
            .mx-xl-0 {
                margin-right: 0 !important
            }

            .mb-xl-0,
            .my-xl-0 {
                margin-bottom: 0 !important
            }

            .ml-xl-0,
            .mx-xl-0 {
                margin-left: 0 !important
            }

            .m-xl-1 {
                margin: .25rem !important
            }

            .mt-xl-1,
            .my-xl-1 {
                margin-top: .25rem !important
            }

            .mr-xl-1,
            .mx-xl-1 {
                margin-right: .25rem !important
            }

            .mb-xl-1,
            .my-xl-1 {
                margin-bottom: .25rem !important
            }

            .ml-xl-1,
            .mx-xl-1 {
                margin-left: .25rem !important
            }

            .m-xl-2 {
                margin: .5rem !important
            }

            .mt-xl-2,
            .my-xl-2 {
                margin-top: .5rem !important
            }

            .mr-xl-2,
            .mx-xl-2 {
                margin-right: .5rem !important
            }

            .mb-xl-2,
            .my-xl-2 {
                margin-bottom: .5rem !important
            }

            .ml-xl-2,
            .mx-xl-2 {
                margin-left: .5rem !important
            }

            .m-xl-3 {
                margin: 1rem !important
            }

            .mt-xl-3,
            .my-xl-3 {
                margin-top: 1rem !important
            }

            .mr-xl-3,
            .mx-xl-3 {
                margin-right: 1rem !important
            }

            .mb-xl-3,
            .my-xl-3 {
                margin-bottom: 1rem !important
            }

            .ml-xl-3,
            .mx-xl-3 {
                margin-left: 1rem !important
            }

            .m-xl-4 {
                margin: 1.5rem !important
            }

            .mt-xl-4,
            .my-xl-4 {
                margin-top: 1.5rem !important
            }

            .mr-xl-4,
            .mx-xl-4 {
                margin-right: 1.5rem !important
            }

            .mb-xl-4,
            .my-xl-4 {
                margin-bottom: 1.5rem !important
            }

            .ml-xl-4,
            .mx-xl-4 {
                margin-left: 1.5rem !important
            }

            .m-xl-5 {
                margin: 3rem !important
            }

            .mt-xl-5,
            .my-xl-5 {
                margin-top: 3rem !important
            }

            .mr-xl-5,
            .mx-xl-5 {
                margin-right: 3rem !important
            }

            .mb-xl-5,
            .my-xl-5 {
                margin-bottom: 3rem !important
            }

            .ml-xl-5,
            .mx-xl-5 {
                margin-left: 3rem !important
            }

            .p-xl-0 {
                padding: 0 !important
            }

            .pt-xl-0,
            .py-xl-0 {
                padding-top: 0 !important
            }

            .pr-xl-0,
            .px-xl-0 {
                padding-right: 0 !important
            }

            .pb-xl-0,
            .py-xl-0 {
                padding-bottom: 0 !important
            }

            .pl-xl-0,
            .px-xl-0 {
                padding-left: 0 !important
            }

            .p-xl-1 {
                padding: .25rem !important
            }

            .pt-xl-1,
            .py-xl-1 {
                padding-top: .25rem !important
            }

            .pr-xl-1,
            .px-xl-1 {
                padding-right: .25rem !important
            }

            .pb-xl-1,
            .py-xl-1 {
                padding-bottom: .25rem !important
            }

            .pl-xl-1,
            .px-xl-1 {
                padding-left: .25rem !important
            }

            .p-xl-2 {
                padding: .5rem !important
            }

            .pt-xl-2,
            .py-xl-2 {
                padding-top: .5rem !important
            }

            .pr-xl-2,
            .px-xl-2 {
                padding-right: .5rem !important
            }

            .pb-xl-2,
            .py-xl-2 {
                padding-bottom: .5rem !important
            }

            .pl-xl-2,
            .px-xl-2 {
                padding-left: .5rem !important
            }

            .p-xl-3 {
                padding: 1rem !important
            }

            .pt-xl-3,
            .py-xl-3 {
                padding-top: 1rem !important
            }

            .pr-xl-3,
            .px-xl-3 {
                padding-right: 1rem !important
            }

            .pb-xl-3,
            .py-xl-3 {
                padding-bottom: 1rem !important
            }

            .pl-xl-3,
            .px-xl-3 {
                padding-left: 1rem !important
            }

            .p-xl-4 {
                padding: 1.5rem !important
            }

            .pt-xl-4,
            .py-xl-4 {
                padding-top: 1.5rem !important
            }

            .pr-xl-4,
            .px-xl-4 {
                padding-right: 1.5rem !important
            }

            .pb-xl-4,
            .py-xl-4 {
                padding-bottom: 1.5rem !important
            }

            .pl-xl-4,
            .px-xl-4 {
                padding-left: 1.5rem !important
            }

            .p-xl-5 {
                padding: 3rem !important
            }

            .pt-xl-5,
            .py-xl-5 {
                padding-top: 3rem !important
            }

            .pr-xl-5,
            .px-xl-5 {
                padding-right: 3rem !important
            }

            .pb-xl-5,
            .py-xl-5 {
                padding-bottom: 3rem !important
            }

            .pl-xl-5,
            .px-xl-5 {
                padding-left: 3rem !important
            }

            .m-xl-n1 {
                margin: -.25rem !important
            }

            .mt-xl-n1,
            .my-xl-n1 {
                margin-top: -.25rem !important
            }

            .mr-xl-n1,
            .mx-xl-n1 {
                margin-right: -.25rem !important
            }

            .mb-xl-n1,
            .my-xl-n1 {
                margin-bottom: -.25rem !important
            }

            .ml-xl-n1,
            .mx-xl-n1 {
                margin-left: -.25rem !important
            }

            .m-xl-n2 {
                margin: -.5rem !important
            }

            .mt-xl-n2,
            .my-xl-n2 {
                margin-top: -.5rem !important
            }

            .mr-xl-n2,
            .mx-xl-n2 {
                margin-right: -.5rem !important
            }

            .mb-xl-n2,
            .my-xl-n2 {
                margin-bottom: -.5rem !important
            }

            .ml-xl-n2,
            .mx-xl-n2 {
                margin-left: -.5rem !important
            }

            .m-xl-n3 {
                margin: -1rem !important
            }

            .mt-xl-n3,
            .my-xl-n3 {
                margin-top: -1rem !important
            }

            .mr-xl-n3,
            .mx-xl-n3 {
                margin-right: -1rem !important
            }

            .mb-xl-n3,
            .my-xl-n3 {
                margin-bottom: -1rem !important
            }

            .ml-xl-n3,
            .mx-xl-n3 {
                margin-left: -1rem !important
            }

            .m-xl-n4 {
                margin: -1.5rem !important
            }

            .mt-xl-n4,
            .my-xl-n4 {
                margin-top: -1.5rem !important
            }

            .mr-xl-n4,
            .mx-xl-n4 {
                margin-right: -1.5rem !important
            }

            .mb-xl-n4,
            .my-xl-n4 {
                margin-bottom: -1.5rem !important
            }

            .ml-xl-n4,
            .mx-xl-n4 {
                margin-left: -1.5rem !important
            }

            .m-xl-n5 {
                margin: -3rem !important
            }

            .mt-xl-n5,
            .my-xl-n5 {
                margin-top: -3rem !important
            }

            .mr-xl-n5,
            .mx-xl-n5 {
                margin-right: -3rem !important
            }

            .mb-xl-n5,
            .my-xl-n5 {
                margin-bottom: -3rem !important
            }

            .ml-xl-n5,
            .mx-xl-n5 {
                margin-left: -3rem !important
            }

            .m-xl-auto {
                margin: auto !important
            }

            .mt-xl-auto,
            .my-xl-auto {
                margin-top: auto !important
            }

            .mr-xl-auto,
            .mx-xl-auto {
                margin-right: auto !important
            }

            .mb-xl-auto,
            .my-xl-auto {
                margin-bottom: auto !important
            }

            .ml-xl-auto,
            .mx-xl-auto {
                margin-left: auto !important
            }
        }

        .text-monospace {
            font-family: SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace !important
        }

        .text-justify {
            text-align: justify !important
        }

        .text-wrap {
            white-space: normal !important
        }

        .text-nowrap {
            white-space: nowrap !important
        }

        .text-truncate {
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap
        }

        .text-left {
            text-align: left !important
        }

        .text-right {
            text-align: right !important
        }

        .text-center {
            text-align: center !important
        }

        @media (min-width:576px) {
            .text-sm-left {
                text-align: left !important
            }

            .text-sm-right {
                text-align: right !important
            }

            .text-sm-center {
                text-align: center !important
            }
        }

        @media (min-width:768px) {
            .text-md-left {
                text-align: left !important
            }

            .text-md-right {
                text-align: right !important
            }

            .text-md-center {
                text-align: center !important
            }
        }

        @media (min-width:992px) {
            .text-lg-left {
                text-align: left !important
            }

            .text-lg-right {
                text-align: right !important
            }

            .text-lg-center {
                text-align: center !important
            }
        }

        @media (min-width:1200px) {
            .text-xl-left {
                text-align: left !important
            }

            .text-xl-right {
                text-align: right !important
            }

            .text-xl-center {
                text-align: center !important
            }
        }

        .text-lowercase {
            text-transform: lowercase !important
        }

        .text-uppercase {
            text-transform: uppercase !important
        }

        .text-capitalize {
            text-transform: capitalize !important
        }

        .font-weight-light {
            font-weight: 300 !important
        }

        .font-weight-lighter {
            font-weight: lighter !important
        }

        .font-weight-normal {
            font-weight: 400 !important
        }

        .font-weight-bold {
            font-weight: 700 !important
        }

        .font-weight-bolder {
            font-weight: bolder !important
        }

        .font-italic {
            font-style: italic !important
        }

        .text-white {
            color: #fff !important
        }

        .text-primary {
            color: #007bff !important
        }

        a.text-primary:focus,
        a.text-primary:hover {
            color: #0056b3 !important
        }

        .text-secondary {
            color: #6c757d !important
        }

        a.text-secondary:focus,
        a.text-secondary:hover {
            color: #494f54 !important
        }

        .text-success {
            color: #28a745 !important
        }

        a.text-success:focus,
        a.text-success:hover {
            color: #19692c !important
        }

        .text-info {
            color: #17a2b8 !important
        }

        a.text-info:focus,
        a.text-info:hover {
            color: #0f6674 !important
        }

        .text-warning {
            color: #ffc107 !important
        }

        a.text-warning:focus,
        a.text-warning:hover {
            color: #ba8b00 !important
        }

        .text-danger {
            color: #dc3545 !important
        }

        a.text-danger:focus,
        a.text-danger:hover {
            color: #a71d2a !important
        }

        .text-light {
            color: #f8f9fa !important
        }

        a.text-light:focus,
        a.text-light:hover {
            color: #cbd3da !important
        }

        .text-dark {
            color: #343a40 !important
        }

        a.text-dark:focus,
        a.text-dark:hover {
            color: #121416 !important
        }

        .text-body {
            color: #212529 !important
        }

        .text-muted {
            color: #6c757d !important
        }

        .text-black-50 {
            color: rgba(0, 0, 0, .5) !important
        }

        .text-white-50 {
            color: rgba(255, 255, 255, .5) !important
        }

        .text-hide {
            font: 0/0 a;
            color: transparent;
            text-shadow: none;
            background-color: transparent;
            border: 0
        }

        .text-decoration-none {
            text-decoration: none !important
        }

        .text-break {
            word-break: break-word !important;
            overflow-wrap: break-word !important
        }

        .text-reset {
            color: inherit !important
        }

        .visible {
            visibility: visible !important
        }

        .invisible {
            visibility: hidden !important
        }

        @media print {

            *,
            ::after,
            ::before {
                text-shadow: none !important;
                box-shadow: none !important
            }

            a:not(.btn) {
                text-decoration: underline
            }

            abbr[title]::after {
                content: " ("attr(title) ")"
            }

            pre {
                white-space: pre-wrap !important
            }

            blockquote,
            pre {
                border: 1px solid #adb5bd;
                page-break-inside: avoid
            }

            thead {
                display: table-header-group
            }

            img,
            tr {
                page-break-inside: avoid
            }

            h2,
            h3,
            p {
                orphans: 3;
                widows: 3
            }

            h2,
            h3 {
                page-break-after: avoid
            }

            @page {
                size: a3
            }

            body {
                min-width: 992px !important
            }

            .container {
                min-width: 992px !important
            }

            .navbar {
                display: none
            }

            .badge {
                border: 1px solid #000
            }

            .table {
                border-collapse: collapse !important
            }

            .table td,
            .table th {
                background-color: #fff !important
            }

            .table-bordered td,
            .table-bordered th {
                border: 1px solid #dee2e6 !important
            }

            .table-dark {
                color: inherit
            }

            .table-dark tbody+tbody,
            .table-dark td,
            .table-dark th,
            .table-dark thead th {
                border-color: #dee2e6
            }

            .table .thead-dark th {
                color: inherit;
                border-color: #dee2e6
            }
        }
    </style>
    <style>
        .fa,
        .fab,
        .fad,
        .fal,
        .far,
        .fas {
            -moz-osx-font-smoothing: grayscale;
            -webkit-font-smoothing: antialiased;
            display: inline-block;
            font-style: normal;
            font-variant: normal;
            text-rendering: auto;
            line-height: 1
        }

        .fa-lg {
            font-size: 1.33333em;
            line-height: .75em;
            vertical-align: -.0667em
        }

        .fa-xs {
            font-size: .75em
        }

        .fa-sm {
            font-size: .875em
        }

        .fa-1x {
            font-size: 1em
        }

        .fa-2x {
            font-size: 2em
        }

        .fa-3x {
            font-size: 3em
        }

        .fa-4x {
            font-size: 4em
        }

        .fa-5x {
            font-size: 5em
        }

        .fa-6x {
            font-size: 6em
        }

        .fa-7x {
            font-size: 7em
        }

        .fa-8x {
            font-size: 8em
        }

        .fa-9x {
            font-size: 9em
        }

        .fa-10x {
            font-size: 10em
        }

        .fa-fw {
            text-align: center;
            width: 1.25em
        }

        .fa-ul {
            list-style-type: none;
            margin-left: 2.5em;
            padding-left: 0
        }

        .fa-ul>li {
            position: relative
        }

        .fa-li {
            left: -2em;
            position: absolute;
            text-align: center;
            width: 2em;
            line-height: inherit
        }

        .fa-border {
            border: .08em solid #eee;
            border-radius: .1em;
            padding: .2em .25em .15em
        }

        .fa-pull-left {
            float: left
        }

        .fa-pull-right {
            float: right
        }

        .fa.fa-pull-left,
        .fab.fa-pull-left,
        .fal.fa-pull-left,
        .far.fa-pull-left,
        .fas.fa-pull-left {
            margin-right: .3em
        }

        .fa.fa-pull-right,
        .fab.fa-pull-right,
        .fal.fa-pull-right,
        .far.fa-pull-right,
        .fas.fa-pull-right {
            margin-left: .3em
        }

        .fa-spin {
            -webkit-animation: fa-spin 2s linear infinite;
            animation: fa-spin 2s linear infinite
        }

        .fa-pulse {
            -webkit-animation: fa-spin 1s steps(8) infinite;
            animation: fa-spin 1s steps(8) infinite
        }

        @-webkit-keyframes fa-spin {
            0% {
                -webkit-transform: rotate(0deg);
                transform: rotate(0deg)
            }

            to {
                -webkit-transform: rotate(1turn);
                transform: rotate(1turn)
            }
        }

        @keyframes fa-spin {
            0% {
                -webkit-transform: rotate(0deg);
                transform: rotate(0deg)
            }

            to {
                -webkit-transform: rotate(1turn);
                transform: rotate(1turn)
            }
        }

        .fa-rotate-90 {
            -ms-filter: "progid:DXImageTransform.Microsoft.BasicImage(rotation=1)";
            -webkit-transform: rotate(90deg);
            transform: rotate(90deg)
        }

        .fa-rotate-180 {
            -ms-filter: "progid:DXImageTransform.Microsoft.BasicImage(rotation=2)";
            -webkit-transform: rotate(180deg);
            transform: rotate(180deg)
        }

        .fa-rotate-270 {
            -ms-filter: "progid:DXImageTransform.Microsoft.BasicImage(rotation=3)";
            -webkit-transform: rotate(270deg);
            transform: rotate(270deg)
        }

        .fa-flip-horizontal {
            -ms-filter: "progid:DXImageTransform.Microsoft.BasicImage(rotation=0, mirror=1)";
            -webkit-transform: scaleX(-1);
            transform: scaleX(-1)
        }

        .fa-flip-vertical {
            -webkit-transform: scaleY(-1);
            transform: scaleY(-1)
        }

        .fa-flip-both,
        .fa-flip-horizontal.fa-flip-vertical,
        .fa-flip-vertical {
            -ms-filter: "progid:DXImageTransform.Microsoft.BasicImage(rotation=2, mirror=1)"
        }

        .fa-flip-both,
        .fa-flip-horizontal.fa-flip-vertical {
            -webkit-transform: scale(-1);
            transform: scale(-1)
        }

        :root .fa-flip-both,
        :root .fa-flip-horizontal,
        :root .fa-flip-vertical,
        :root .fa-rotate-90,
        :root .fa-rotate-180,
        :root .fa-rotate-270 {
            -webkit-filter: none;
            filter: none
        }

        .fa-stack {
            display: inline-block;
            height: 2em;
            line-height: 2em;
            position: relative;
            vertical-align: middle;
            width: 2.5em
        }

        .fa-stack-1x,
        .fa-stack-2x {
            left: 0;
            position: absolute;
            text-align: center;
            width: 100%
        }

        .fa-stack-1x {
            line-height: inherit
        }

        .fa-stack-2x {
            font-size: 2em
        }

        .fa-inverse {
            color: #fff
        }

        .fa-500px:before {
            content: "\f26e"
        }

        .fa-accessible-icon:before {
            content: "\f368"
        }

        .fa-accusoft:before {
            content: "\f369"
        }

        .fa-acquisitions-incorporated:before {
            content: "\f6af"
        }

        .fa-ad:before {
            content: "\f641"
        }

        .fa-address-book:before {
            content: "\f2b9"
        }

        .fa-address-card:before {
            content: "\f2bb"
        }

        .fa-adjust:before {
            content: "\f042"
        }

        .fa-adn:before {
            content: "\f170"
        }

        .fa-adobe:before {
            content: "\f778"
        }

        .fa-adversal:before {
            content: "\f36a"
        }

        .fa-affiliatetheme:before {
            content: "\f36b"
        }

        .fa-air-freshener:before {
            content: "\f5d0"
        }

        .fa-airbnb:before {
            content: "\f834"
        }

        .fa-algolia:before {
            content: "\f36c"
        }

        .fa-align-center:before {
            content: "\f037"
        }

        .fa-align-justify:before {
            content: "\f039"
        }

        .fa-align-left:before {
            content: "\f036"
        }

        .fa-align-right:before {
            content: "\f038"
        }

        .fa-alipay:before {
            content: "\f642"
        }

        .fa-allergies:before {
            content: "\f461"
        }

        .fa-amazon:before {
            content: "\f270"
        }

        .fa-amazon-pay:before {
            content: "\f42c"
        }

        .fa-ambulance:before {
            content: "\f0f9"
        }

        .fa-american-sign-language-interpreting:before {
            content: "\f2a3"
        }

        .fa-amilia:before {
            content: "\f36d"
        }

        .fa-anchor:before {
            content: "\f13d"
        }

        .fa-android:before {
            content: "\f17b"
        }

        .fa-angellist:before {
            content: "\f209"
        }

        .fa-angle-double-down:before {
            content: "\f103"
        }

        .fa-angle-double-left:before {
            content: "\f100"
        }

        .fa-angle-double-right:before {
            content: "\f101"
        }

        .fa-angle-double-up:before {
            content: "\f102"
        }

        .fa-angle-down:before {
            content: "\f107"
        }

        .fa-angle-left:before {
            content: "\f104"
        }

        .fa-angle-right:before {
            content: "\f105"
        }

        .fa-angle-up:before {
            content: "\f106"
        }

        .fa-angry:before {
            content: "\f556"
        }

        .fa-angrycreative:before {
            content: "\f36e"
        }

        .fa-angular:before {
            content: "\f420"
        }

        .fa-ankh:before {
            content: "\f644"
        }

        .fa-app-store:before {
            content: "\f36f"
        }

        .fa-app-store-ios:before {
            content: "\f370"
        }

        .fa-apper:before {
            content: "\f371"
        }

        .fa-apple:before {
            content: "\f179"
        }

        .fa-apple-alt:before {
            content: "\f5d1"
        }

        .fa-apple-pay:before {
            content: "\f415"
        }

        .fa-archive:before {
            content: "\f187"
        }

        .fa-archway:before {
            content: "\f557"
        }

        .fa-arrow-alt-circle-down:before {
            content: "\f358"
        }

        .fa-arrow-alt-circle-left:before {
            content: "\f359"
        }

        .fa-arrow-alt-circle-right:before {
            content: "\f35a"
        }

        .fa-arrow-alt-circle-up:before {
            content: "\f35b"
        }

        .fa-arrow-circle-down:before {
            content: "\f0ab"
        }

        .fa-arrow-circle-left:before {
            content: "\f0a8"
        }

        .fa-arrow-circle-right:before {
            content: "\f0a9"
        }

        .fa-arrow-circle-up:before {
            content: "\f0aa"
        }

        .fa-arrow-down:before {
            content: "\f063"
        }

        .fa-arrow-left:before {
            content: "\f060"
        }

        .fa-arrow-right:before {
            content: "\f061"
        }

        .fa-arrow-up:before {
            content: "\f062"
        }

        .fa-arrows-alt:before {
            content: "\f0b2"
        }

        .fa-arrows-alt-h:before {
            content: "\f337"
        }

        .fa-arrows-alt-v:before {
            content: "\f338"
        }

        .fa-artstation:before {
            content: "\f77a"
        }

        .fa-assistive-listening-systems:before {
            content: "\f2a2"
        }

        .fa-asterisk:before {
            content: "\f069"
        }

        .fa-asymmetrik:before {
            content: "\f372"
        }

        .fa-at:before {
            content: "\f1fa"
        }

        .fa-atlas:before {
            content: "\f558"
        }

        .fa-atlassian:before {
            content: "\f77b"
        }

        .fa-atom:before {
            content: "\f5d2"
        }

        .fa-audible:before {
            content: "\f373"
        }

        .fa-audio-description:before {
            content: "\f29e"
        }

        .fa-autoprefixer:before {
            content: "\f41c"
        }

        .fa-avianex:before {
            content: "\f374"
        }

        .fa-aviato:before {
            content: "\f421"
        }

        .fa-award:before {
            content: "\f559"
        }

        .fa-aws:before {
            content: "\f375"
        }

        .fa-baby:before {
            content: "\f77c"
        }

        .fa-baby-carriage:before {
            content: "\f77d"
        }

        .fa-backspace:before {
            content: "\f55a"
        }

        .fa-backward:before {
            content: "\f04a"
        }

        .fa-bacon:before {
            content: "\f7e5"
        }

        .fa-balance-scale:before {
            content: "\f24e"
        }

        .fa-balance-scale-left:before {
            content: "\f515"
        }

        .fa-balance-scale-right:before {
            content: "\f516"
        }

        .fa-ban:before {
            content: "\f05e"
        }

        .fa-band-aid:before {
            content: "\f462"
        }

        .fa-bandcamp:before {
            content: "\f2d5"
        }

        .fa-barcode:before {
            content: "\f02a"
        }

        .fa-bars:before {
            content: "\f0c9"
        }

        .fa-baseball-ball:before {
            content: "\f433"
        }

        .fa-basketball-ball:before {
            content: "\f434"
        }

        .fa-bath:before {
            content: "\f2cd"
        }

        .fa-battery-empty:before {
            content: "\f244"
        }

        .fa-battery-full:before {
            content: "\f240"
        }

        .fa-battery-half:before {
            content: "\f242"
        }

        .fa-battery-quarter:before {
            content: "\f243"
        }

        .fa-battery-three-quarters:before {
            content: "\f241"
        }

        .fa-battle-net:before {
            content: "\f835"
        }

        .fa-bed:before {
            content: "\f236"
        }

        .fa-beer:before {
            content: "\f0fc"
        }

        .fa-behance:before {
            content: "\f1b4"
        }

        .fa-behance-square:before {
            content: "\f1b5"
        }

        .fa-bell:before {
            content: "\f0f3"
        }

        .fa-bell-slash:before {
            content: "\f1f6"
        }

        .fa-bezier-curve:before {
            content: "\f55b"
        }

        .fa-bible:before {
            content: "\f647"
        }

        .fa-bicycle:before {
            content: "\f206"
        }

        .fa-biking:before {
            content: "\f84a"
        }

        .fa-bimobject:before {
            content: "\f378"
        }

        .fa-binoculars:before {
            content: "\f1e5"
        }

        .fa-biohazard:before {
            content: "\f780"
        }

        .fa-birthday-cake:before {
            content: "\f1fd"
        }

        .fa-bitbucket:before {
            content: "\f171"
        }

        .fa-bitcoin:before {
            content: "\f379"
        }

        .fa-bity:before {
            content: "\f37a"
        }

        .fa-black-tie:before {
            content: "\f27e"
        }

        .fa-blackberry:before {
            content: "\f37b"
        }

        .fa-blender:before {
            content: "\f517"
        }

        .fa-blender-phone:before {
            content: "\f6b6"
        }

        .fa-blind:before {
            content: "\f29d"
        }

        .fa-blog:before {
            content: "\f781"
        }

        .fa-blogger:before {
            content: "\f37c"
        }

        .fa-blogger-b:before {
            content: "\f37d"
        }

        .fa-bluetooth:before {
            content: "\f293"
        }

        .fa-bluetooth-b:before {
            content: "\f294"
        }

        .fa-bold:before {
            content: "\f032"
        }

        .fa-bolt:before {
            content: "\f0e7"
        }

        .fa-bomb:before {
            content: "\f1e2"
        }

        .fa-bone:before {
            content: "\f5d7"
        }

        .fa-bong:before {
            content: "\f55c"
        }

        .fa-book:before {
            content: "\f02d"
        }

        .fa-book-dead:before {
            content: "\f6b7"
        }

        .fa-book-medical:before {
            content: "\f7e6"
        }

        .fa-book-open:before {
            content: "\f518"
        }

        .fa-book-reader:before {
            content: "\f5da"
        }

        .fa-bookmark:before {
            content: "\f02e"
        }

        .fa-bootstrap:before {
            content: "\f836"
        }

        .fa-border-all:before {
            content: "\f84c"
        }

        .fa-border-none:before {
            content: "\f850"
        }

        .fa-border-style:before {
            content: "\f853"
        }

        .fa-bowling-ball:before {
            content: "\f436"
        }

        .fa-box:before {
            content: "\f466"
        }

        .fa-box-open:before {
            content: "\f49e"
        }

        .fa-boxes:before {
            content: "\f468"
        }

        .fa-braille:before {
            content: "\f2a1"
        }

        .fa-brain:before {
            content: "\f5dc"
        }

        .fa-bread-slice:before {
            content: "\f7ec"
        }

        .fa-briefcase:before {
            content: "\f0b1"
        }

        .fa-briefcase-medical:before {
            content: "\f469"
        }

        .fa-broadcast-tower:before {
            content: "\f519"
        }

        .fa-broom:before {
            content: "\f51a"
        }

        .fa-brush:before {
            content: "\f55d"
        }

        .fa-btc:before {
            content: "\f15a"
        }

        .fa-buffer:before {
            content: "\f837"
        }

        .fa-bug:before {
            content: "\f188"
        }

        .fa-building:before {
            content: "\f1ad"
        }

        .fa-bullhorn:before {
            content: "\f0a1"
        }

        .fa-bullseye:before {
            content: "\f140"
        }

        .fa-burn:before {
            content: "\f46a"
        }

        .fa-buromobelexperte:before {
            content: "\f37f"
        }

        .fa-bus:before {
            content: "\f207"
        }

        .fa-bus-alt:before {
            content: "\f55e"
        }

        .fa-business-time:before {
            content: "\f64a"
        }

        .fa-buysellads:before {
            content: "\f20d"
        }

        .fa-calculator:before {
            content: "\f1ec"
        }

        .fa-calendar:before {
            content: "\f133"
        }

        .fa-calendar-alt:before {
            content: "\f073"
        }

        .fa-calendar-check:before {
            content: "\f274"
        }

        .fa-calendar-day:before {
            content: "\f783"
        }

        .fa-calendar-minus:before {
            content: "\f272"
        }

        .fa-calendar-plus:before {
            content: "\f271"
        }

        .fa-calendar-times:before {
            content: "\f273"
        }

        .fa-calendar-week:before {
            content: "\f784"
        }

        .fa-camera:before {
            content: "\f030"
        }

        .fa-camera-retro:before {
            content: "\f083"
        }

        .fa-campground:before {
            content: "\f6bb"
        }

        .fa-canadian-maple-leaf:before {
            content: "\f785"
        }

        .fa-candy-cane:before {
            content: "\f786"
        }

        .fa-cannabis:before {
            content: "\f55f"
        }

        .fa-capsules:before {
            content: "\f46b"
        }

        .fa-car:before {
            content: "\f1b9"
        }

        .fa-car-alt:before {
            content: "\f5de"
        }

        .fa-car-battery:before {
            content: "\f5df"
        }

        .fa-car-crash:before {
            content: "\f5e1"
        }

        .fa-car-side:before {
            content: "\f5e4"
        }

        .fa-caret-down:before {
            content: "\f0d7"
        }

        .fa-caret-left:before {
            content: "\f0d9"
        }

        .fa-caret-right:before {
            content: "\f0da"
        }

        .fa-caret-square-down:before {
            content: "\f150"
        }

        .fa-caret-square-left:before {
            content: "\f191"
        }

        .fa-caret-square-right:before {
            content: "\f152"
        }

        .fa-caret-square-up:before {
            content: "\f151"
        }

        .fa-caret-up:before {
            content: "\f0d8"
        }

        .fa-carrot:before {
            content: "\f787"
        }

        .fa-cart-arrow-down:before {
            content: "\f218"
        }

        .fa-cart-plus:before {
            content: "\f217"
        }

        .fa-cash-register:before {
            content: "\f788"
        }

        .fa-cat:before {
            content: "\f6be"
        }

        .fa-cc-amazon-pay:before {
            content: "\f42d"
        }

        .fa-cc-amex:before {
            content: "\f1f3"
        }

        .fa-cc-apple-pay:before {
            content: "\f416"
        }

        .fa-cc-diners-club:before {
            content: "\f24c"
        }

        .fa-cc-discover:before {
            content: "\f1f2"
        }

        .fa-cc-jcb:before {
            content: "\f24b"
        }

        .fa-cc-mastercard:before {
            content: "\f1f1"
        }

        .fa-cc-paypal:before {
            content: "\f1f4"
        }

        .fa-cc-stripe:before {
            content: "\f1f5"
        }

        .fa-cc-visa:before {
            content: "\f1f0"
        }

        .fa-centercode:before {
            content: "\f380"
        }

        .fa-centos:before {
            content: "\f789"
        }

        .fa-certificate:before {
            content: "\f0a3"
        }

        .fa-chair:before {
            content: "\f6c0"
        }

        .fa-chalkboard:before {
            content: "\f51b"
        }

        .fa-chalkboard-teacher:before {
            content: "\f51c"
        }

        .fa-charging-station:before {
            content: "\f5e7"
        }

        .fa-chart-area:before {
            content: "\f1fe"
        }

        .fa-chart-bar:before {
            content: "\f080"
        }

        .fa-chart-line:before {
            content: "\f201"
        }

        .fa-chart-pie:before {
            content: "\f200"
        }

        .fa-check:before {
            content: "\f00c"
        }

        .fa-check-circle:before {
            content: "\f058"
        }

        .fa-check-double:before {
            content: "\f560"
        }

        .fa-check-square:before {
            content: "\f14a"
        }

        .fa-cheese:before {
            content: "\f7ef"
        }

        .fa-chess:before {
            content: "\f439"
        }

        .fa-chess-bishop:before {
            content: "\f43a"
        }

        .fa-chess-board:before {
            content: "\f43c"
        }

        .fa-chess-king:before {
            content: "\f43f"
        }

        .fa-chess-knight:before {
            content: "\f441"
        }

        .fa-chess-pawn:before {
            content: "\f443"
        }

        .fa-chess-queen:before {
            content: "\f445"
        }

        .fa-chess-rook:before {
            content: "\f447"
        }

        .fa-chevron-circle-down:before {
            content: "\f13a"
        }

        .fa-chevron-circle-left:before {
            content: "\f137"
        }

        .fa-chevron-circle-right:before {
            content: "\f138"
        }

        .fa-chevron-circle-up:before {
            content: "\f139"
        }

        .fa-chevron-down:before {
            content: "\f078"
        }

        .fa-chevron-left:before {
            content: "\f053"
        }

        .fa-chevron-right:before {
            content: "\f054"
        }

        .fa-chevron-up:before {
            content: "\f077"
        }

        .fa-child:before {
            content: "\f1ae"
        }

        .fa-chrome:before {
            content: "\f268"
        }

        .fa-chromecast:before {
            content: "\f838"
        }

        .fa-church:before {
            content: "\f51d"
        }

        .fa-circle:before {
            content: "\f111"
        }

        .fa-circle-notch:before {
            content: "\f1ce"
        }

        .fa-city:before {
            content: "\f64f"
        }

        .fa-clinic-medical:before {
            content: "\f7f2"
        }

        .fa-clipboard:before {
            content: "\f328"
        }

        .fa-clipboard-check:before {
            content: "\f46c"
        }

        .fa-clipboard-list:before {
            content: "\f46d"
        }

        .fa-clock:before {
            content: "\f017"
        }

        .fa-clone:before {
            content: "\f24d"
        }

        .fa-closed-captioning:before {
            content: "\f20a"
        }

        .fa-cloud:before {
            content: "\f0c2"
        }

        .fa-cloud-download-alt:before {
            content: "\f381"
        }

        .fa-cloud-meatball:before {
            content: "\f73b"
        }

        .fa-cloud-moon:before {
            content: "\f6c3"
        }

        .fa-cloud-moon-rain:before {
            content: "\f73c"
        }

        .fa-cloud-rain:before {
            content: "\f73d"
        }

        .fa-cloud-showers-heavy:before {
            content: "\f740"
        }

        .fa-cloud-sun:before {
            content: "\f6c4"
        }

        .fa-cloud-sun-rain:before {
            content: "\f743"
        }

        .fa-cloud-upload-alt:before {
            content: "\f382"
        }

        .fa-cloudscale:before {
            content: "\f383"
        }

        .fa-cloudsmith:before {
            content: "\f384"
        }

        .fa-cloudversify:before {
            content: "\f385"
        }

        .fa-cocktail:before {
            content: "\f561"
        }

        .fa-code:before {
            content: "\f121"
        }

        .fa-code-branch:before {
            content: "\f126"
        }

        .fa-codepen:before {
            content: "\f1cb"
        }

        .fa-codiepie:before {
            content: "\f284"
        }

        .fa-coffee:before {
            content: "\f0f4"
        }

        .fa-cog:before {
            content: "\f013"
        }

        .fa-cogs:before {
            content: "\f085"
        }

        .fa-coins:before {
            content: "\f51e"
        }

        .fa-columns:before {
            content: "\f0db"
        }

        .fa-comment:before {
            content: "\f075"
        }

        .fa-comment-alt:before {
            content: "\f27a"
        }

        .fa-comment-dollar:before {
            content: "\f651"
        }

        .fa-comment-dots:before {
            content: "\f4ad"
        }

        .fa-comment-medical:before {
            content: "\f7f5"
        }

        .fa-comment-slash:before {
            content: "\f4b3"
        }

        .fa-comments:before {
            content: "\f086"
        }

        .fa-comments-dollar:before {
            content: "\f653"
        }

        .fa-compact-disc:before {
            content: "\f51f"
        }

        .fa-compass:before {
            content: "\f14e"
        }

        .fa-compress:before {
            content: "\f066"
        }

        .fa-compress-arrows-alt:before {
            content: "\f78c"
        }

        .fa-concierge-bell:before {
            content: "\f562"
        }

        .fa-confluence:before {
            content: "\f78d"
        }

        .fa-connectdevelop:before {
            content: "\f20e"
        }

        .fa-contao:before {
            content: "\f26d"
        }

        .fa-cookie:before {
            content: "\f563"
        }

        .fa-cookie-bite:before {
            content: "\f564"
        }

        .fa-copy:before {
            content: "\f0c5"
        }

        .fa-copyright:before {
            content: "\f1f9"
        }

        .fa-cotton-bureau:before {
            content: "\f89e"
        }

        .fa-couch:before {
            content: "\f4b8"
        }

        .fa-cpanel:before {
            content: "\f388"
        }

        .fa-creative-commons:before {
            content: "\f25e"
        }

        .fa-creative-commons-by:before {
            content: "\f4e7"
        }

        .fa-creative-commons-nc:before {
            content: "\f4e8"
        }

        .fa-creative-commons-nc-eu:before {
            content: "\f4e9"
        }

        .fa-creative-commons-nc-jp:before {
            content: "\f4ea"
        }

        .fa-creative-commons-nd:before {
            content: "\f4eb"
        }

        .fa-creative-commons-pd:before {
            content: "\f4ec"
        }

        .fa-creative-commons-pd-alt:before {
            content: "\f4ed"
        }

        .fa-creative-commons-remix:before {
            content: "\f4ee"
        }

        .fa-creative-commons-sa:before {
            content: "\f4ef"
        }

        .fa-creative-commons-sampling:before {
            content: "\f4f0"
        }

        .fa-creative-commons-sampling-plus:before {
            content: "\f4f1"
        }

        .fa-creative-commons-share:before {
            content: "\f4f2"
        }

        .fa-creative-commons-zero:before {
            content: "\f4f3"
        }

        .fa-credit-card:before {
            content: "\f09d"
        }

        .fa-critical-role:before {
            content: "\f6c9"
        }

        .fa-crop:before {
            content: "\f125"
        }

        .fa-crop-alt:before {
            content: "\f565"
        }

        .fa-cross:before {
            content: "\f654"
        }

        .fa-crosshairs:before {
            content: "\f05b"
        }

        .fa-crow:before {
            content: "\f520"
        }

        .fa-crown:before {
            content: "\f521"
        }

        .fa-crutch:before {
            content: "\f7f7"
        }

        .fa-css3:before {
            content: "\f13c"
        }

        .fa-css3-alt:before {
            content: "\f38b"
        }

        .fa-cube:before {
            content: "\f1b2"
        }

        .fa-cubes:before {
            content: "\f1b3"
        }

        .fa-cut:before {
            content: "\f0c4"
        }

        .fa-cuttlefish:before {
            content: "\f38c"
        }

        .fa-d-and-d:before {
            content: "\f38d"
        }

        .fa-d-and-d-beyond:before {
            content: "\f6ca"
        }

        .fa-dashcube:before {
            content: "\f210"
        }

        .fa-database:before {
            content: "\f1c0"
        }

        .fa-deaf:before {
            content: "\f2a4"
        }

        .fa-delicious:before {
            content: "\f1a5"
        }

        .fa-democrat:before {
            content: "\f747"
        }

        .fa-deploydog:before {
            content: "\f38e"
        }

        .fa-deskpro:before {
            content: "\f38f"
        }

        .fa-desktop:before {
            content: "\f108"
        }

        .fa-dev:before {
            content: "\f6cc"
        }

        .fa-deviantart:before {
            content: "\f1bd"
        }

        .fa-dharmachakra:before {
            content: "\f655"
        }

        .fa-dhl:before {
            content: "\f790"
        }

        .fa-diagnoses:before {
            content: "\f470"
        }

        .fa-diaspora:before {
            content: "\f791"
        }

        .fa-dice:before {
            content: "\f522"
        }

        .fa-dice-d20:before {
            content: "\f6cf"
        }

        .fa-dice-d6:before {
            content: "\f6d1"
        }

        .fa-dice-five:before {
            content: "\f523"
        }

        .fa-dice-four:before {
            content: "\f524"
        }

        .fa-dice-one:before {
            content: "\f525"
        }

        .fa-dice-six:before {
            content: "\f526"
        }

        .fa-dice-three:before {
            content: "\f527"
        }

        .fa-dice-two:before {
            content: "\f528"
        }

        .fa-digg:before {
            content: "\f1a6"
        }

        .fa-digital-ocean:before {
            content: "\f391"
        }

        .fa-digital-tachograph:before {
            content: "\f566"
        }

        .fa-directions:before {
            content: "\f5eb"
        }

        .fa-discord:before {
            content: "\f392"
        }

        .fa-discourse:before {
            content: "\f393"
        }

        .fa-divide:before {
            content: "\f529"
        }

        .fa-dizzy:before {
            content: "\f567"
        }

        .fa-dna:before {
            content: "\f471"
        }

        .fa-dochub:before {
            content: "\f394"
        }

        .fa-docker:before {
            content: "\f395"
        }

        .fa-dog:before {
            content: "\f6d3"
        }

        .fa-dollar-sign:before {
            content: "\f155"
        }

        .fa-dolly:before {
            content: "\f472"
        }

        .fa-dolly-flatbed:before {
            content: "\f474"
        }

        .fa-donate:before {
            content: "\f4b9"
        }

        .fa-door-closed:before {
            content: "\f52a"
        }

        .fa-door-open:before {
            content: "\f52b"
        }

        .fa-dot-circle:before {
            content: "\f192"
        }

        .fa-dove:before {
            content: "\f4ba"
        }

        .fa-download:before {
            content: "\f019"
        }

        .fa-draft2digital:before {
            content: "\f396"
        }

        .fa-drafting-compass:before {
            content: "\f568"
        }

        .fa-dragon:before {
            content: "\f6d5"
        }

        .fa-draw-polygon:before {
            content: "\f5ee"
        }

        .fa-dribbble:before {
            content: "\f17d"
        }

        .fa-dribbble-square:before {
            content: "\f397"
        }

        .fa-dropbox:before {
            content: "\f16b"
        }

        .fa-drum:before {
            content: "\f569"
        }

        .fa-drum-steelpan:before {
            content: "\f56a"
        }

        .fa-drumstick-bite:before {
            content: "\f6d7"
        }

        .fa-drupal:before {
            content: "\f1a9"
        }

        .fa-dumbbell:before {
            content: "\f44b"
        }

        .fa-dumpster:before {
            content: "\f793"
        }

        .fa-dumpster-fire:before {
            content: "\f794"
        }

        .fa-dungeon:before {
            content: "\f6d9"
        }

        .fa-dyalog:before {
            content: "\f399"
        }

        .fa-earlybirds:before {
            content: "\f39a"
        }

        .fa-ebay:before {
            content: "\f4f4"
        }

        .fa-edge:before {
            content: "\f282"
        }

        .fa-edit:before {
            content: "\f044"
        }

        .fa-egg:before {
            content: "\f7fb"
        }

        .fa-eject:before {
            content: "\f052"
        }

        .fa-elementor:before {
            content: "\f430"
        }

        .fa-ellipsis-h:before {
            content: "\f141"
        }

        .fa-ellipsis-v:before {
            content: "\f142"
        }

        .fa-ello:before {
            content: "\f5f1"
        }

        .fa-ember:before {
            content: "\f423"
        }

        .fa-empire:before {
            content: "\f1d1"
        }

        .fa-envelope:before {
            content: "\f0e0"
        }

        .fa-envelope-open:before {
            content: "\f2b6"
        }

        .fa-envelope-open-text:before {
            content: "\f658"
        }

        .fa-envelope-square:before {
            content: "\f199"
        }

        .fa-envira:before {
            content: "\f299"
        }

        .fa-equals:before {
            content: "\f52c"
        }

        .fa-eraser:before {
            content: "\f12d"
        }

        .fa-erlang:before {
            content: "\f39d"
        }

        .fa-ethereum:before {
            content: "\f42e"
        }

        .fa-ethernet:before {
            content: "\f796"
        }

        .fa-etsy:before {
            content: "\f2d7"
        }

        .fa-euro-sign:before {
            content: "\f153"
        }

        .fa-evernote:before {
            content: "\f839"
        }

        .fa-exchange-alt:before {
            content: "\f362"
        }

        .fa-exclamation:before {
            content: "\f12a"
        }

        .fa-exclamation-circle:before {
            content: "\f06a"
        }

        .fa-exclamation-triangle:before {
            content: "\f071"
        }

        .fa-expand:before {
            content: "\f065"
        }

        .fa-expand-arrows-alt:before {
            content: "\f31e"
        }

        .fa-expeditedssl:before {
            content: "\f23e"
        }

        .fa-external-link-alt:before {
            content: "\f35d"
        }

        .fa-external-link-square-alt:before {
            content: "\f360"
        }

        .fa-eye:before {
            content: "\f06e"
        }

        .fa-eye-dropper:before {
            content: "\f1fb"
        }

        .fa-eye-slash:before {
            content: "\f070"
        }

        .fa-facebook:before {
            content: "\f09a"
        }

        .fa-facebook-f:before {
            content: "\f39e"
        }

        .fa-facebook-messenger:before {
            content: "\f39f"
        }

        .fa-facebook-square:before {
            content: "\f082"
        }

        .fa-fan:before {
            content: "\f863"
        }

        .fa-fantasy-flight-games:before {
            content: "\f6dc"
        }

        .fa-fast-backward:before {
            content: "\f049"
        }

        .fa-fast-forward:before {
            content: "\f050"
        }

        .fa-fax:before {
            content: "\f1ac"
        }

        .fa-feather:before {
            content: "\f52d"
        }

        .fa-feather-alt:before {
            content: "\f56b"
        }

        .fa-fedex:before {
            content: "\f797"
        }

        .fa-fedora:before {
            content: "\f798"
        }

        .fa-female:before {
            content: "\f182"
        }

        .fa-fighter-jet:before {
            content: "\f0fb"
        }

        .fa-figma:before {
            content: "\f799"
        }

        .fa-file:before {
            content: "\f15b"
        }

        .fa-file-alt:before {
            content: "\f15c"
        }

        .fa-file-archive:before {
            content: "\f1c6"
        }

        .fa-file-audio:before {
            content: "\f1c7"
        }

        .fa-file-code:before {
            content: "\f1c9"
        }

        .fa-file-contract:before {
            content: "\f56c"
        }

        .fa-file-csv:before {
            content: "\f6dd"
        }

        .fa-file-download:before {
            content: "\f56d"
        }

        .fa-file-excel:before {
            content: "\f1c3"
        }

        .fa-file-export:before {
            content: "\f56e"
        }

        .fa-file-image:before {
            content: "\f1c5"
        }

        .fa-file-import:before {
            content: "\f56f"
        }

        .fa-file-invoice:before {
            content: "\f570"
        }

        .fa-file-invoice-dollar:before {
            content: "\f571"
        }

        .fa-file-medical:before {
            content: "\f477"
        }

        .fa-file-medical-alt:before {
            content: "\f478"
        }

        .fa-file-pdf:before {
            content: "\f1c1"
        }

        .fa-file-powerpoint:before {
            content: "\f1c4"
        }

        .fa-file-prescription:before {
            content: "\f572"
        }

        .fa-file-signature:before {
            content: "\f573"
        }

        .fa-file-upload:before {
            content: "\f574"
        }

        .fa-file-video:before {
            content: "\f1c8"
        }

        .fa-file-word:before {
            content: "\f1c2"
        }

        .fa-fill:before {
            content: "\f575"
        }

        .fa-fill-drip:before {
            content: "\f576"
        }

        .fa-film:before {
            content: "\f008"
        }

        .fa-filter:before {
            content: "\f0b0"
        }

        .fa-fingerprint:before {
            content: "\f577"
        }

        .fa-fire:before {
            content: "\f06d"
        }

        .fa-fire-alt:before {
            content: "\f7e4"
        }

        .fa-fire-extinguisher:before {
            content: "\f134"
        }

        .fa-firefox:before {
            content: "\f269"
        }

        .fa-first-aid:before {
            content: "\f479"
        }

        .fa-first-order:before {
            content: "\f2b0"
        }

        .fa-first-order-alt:before {
            content: "\f50a"
        }

        .fa-firstdraft:before {
            content: "\f3a1"
        }

        .fa-fish:before {
            content: "\f578"
        }

        .fa-fist-raised:before {
            content: "\f6de"
        }

        .fa-flag:before {
            content: "\f024"
        }

        .fa-flag-checkered:before {
            content: "\f11e"
        }

        .fa-flag-usa:before {
            content: "\f74d"
        }

        .fa-flask:before {
            content: "\f0c3"
        }

        .fa-flickr:before {
            content: "\f16e"
        }

        .fa-flipboard:before {
            content: "\f44d"
        }

        .fa-flushed:before {
            content: "\f579"
        }

        .fa-fly:before {
            content: "\f417"
        }

        .fa-folder:before {
            content: "\f07b"
        }

        .fa-folder-minus:before {
            content: "\f65d"
        }

        .fa-folder-open:before {
            content: "\f07c"
        }

        .fa-folder-plus:before {
            content: "\f65e"
        }

        .fa-font:before {
            content: "\f031"
        }

        .fa-font-awesome:before {
            content: "\f2b4"
        }

        .fa-font-awesome-alt:before {
            content: "\f35c"
        }

        .fa-font-awesome-flag:before {
            content: "\f425"
        }

        .fa-font-awesome-logo-full:before {
            content: "\f4e6"
        }

        .fa-fonticons:before {
            content: "\f280"
        }

        .fa-fonticons-fi:before {
            content: "\f3a2"
        }

        .fa-football-ball:before {
            content: "\f44e"
        }

        .fa-fort-awesome:before {
            content: "\f286"
        }

        .fa-fort-awesome-alt:before {
            content: "\f3a3"
        }

        .fa-forumbee:before {
            content: "\f211"
        }

        .fa-forward:before {
            content: "\f04e"
        }

        .fa-foursquare:before {
            content: "\f180"
        }

        .fa-free-code-camp:before {
            content: "\f2c5"
        }

        .fa-freebsd:before {
            content: "\f3a4"
        }

        .fa-frog:before {
            content: "\f52e"
        }

        .fa-frown:before {
            content: "\f119"
        }

        .fa-frown-open:before {
            content: "\f57a"
        }

        .fa-fulcrum:before {
            content: "\f50b"
        }

        .fa-funnel-dollar:before {
            content: "\f662"
        }

        .fa-futbol:before {
            content: "\f1e3"
        }

        .fa-galactic-republic:before {
            content: "\f50c"
        }

        .fa-galactic-senate:before {
            content: "\f50d"
        }

        .fa-gamepad:before {
            content: "\f11b"
        }

        .fa-gas-pump:before {
            content: "\f52f"
        }

        .fa-gavel:before {
            content: "\f0e3"
        }

        .fa-gem:before {
            content: "\f3a5"
        }

        .fa-genderless:before {
            content: "\f22d"
        }

        .fa-get-pocket:before {
            content: "\f265"
        }

        .fa-gg:before {
            content: "\f260"
        }

        .fa-gg-circle:before {
            content: "\f261"
        }

        .fa-ghost:before {
            content: "\f6e2"
        }

        .fa-gift:before {
            content: "\f06b"
        }

        .fa-gifts:before {
            content: "\f79c"
        }

        .fa-git:before {
            content: "\f1d3"
        }

        .fa-git-alt:before {
            content: "\f841"
        }

        .fa-git-square:before {
            content: "\f1d2"
        }

        .fa-github:before {
            content: "\f09b"
        }

        .fa-github-alt:before {
            content: "\f113"
        }

        .fa-github-square:before {
            content: "\f092"
        }

        .fa-gitkraken:before {
            content: "\f3a6"
        }

        .fa-gitlab:before {
            content: "\f296"
        }

        .fa-gitter:before {
            content: "\f426"
        }

        .fa-glass-cheers:before {
            content: "\f79f"
        }

        .fa-glass-martini:before {
            content: "\f000"
        }

        .fa-glass-martini-alt:before {
            content: "\f57b"
        }

        .fa-glass-whiskey:before {
            content: "\f7a0"
        }

        .fa-glasses:before {
            content: "\f530"
        }

        .fa-glide:before {
            content: "\f2a5"
        }

        .fa-glide-g:before {
            content: "\f2a6"
        }

        .fa-globe:before {
            content: "\f0ac"
        }

        .fa-globe-africa:before {
            content: "\f57c"
        }

        .fa-globe-americas:before {
            content: "\f57d"
        }

        .fa-globe-asia:before {
            content: "\f57e"
        }

        .fa-globe-europe:before {
            content: "\f7a2"
        }

        .fa-gofore:before {
            content: "\f3a7"
        }

        .fa-golf-ball:before {
            content: "\f450"
        }

        .fa-goodreads:before {
            content: "\f3a8"
        }

        .fa-goodreads-g:before {
            content: "\f3a9"
        }

        .fa-google:before {
            content: "\f1a0"
        }

        .fa-google-drive:before {
            content: "\f3aa"
        }

        .fa-google-play:before {
            content: "\f3ab"
        }

        .fa-google-plus:before {
            content: "\f2b3"
        }

        .fa-google-plus-g:before {
            content: "\f0d5"
        }

        .fa-google-plus-square:before {
            content: "\f0d4"
        }

        .fa-google-wallet:before {
            content: "\f1ee"
        }

        .fa-gopuram:before {
            content: "\f664"
        }

        .fa-graduation-cap:before {
            content: "\f19d"
        }

        .fa-gratipay:before {
            content: "\f184"
        }

        .fa-grav:before {
            content: "\f2d6"
        }

        .fa-greater-than:before {
            content: "\f531"
        }

        .fa-greater-than-equal:before {
            content: "\f532"
        }

        .fa-grimace:before {
            content: "\f57f"
        }

        .fa-grin:before {
            content: "\f580"
        }

        .fa-grin-alt:before {
            content: "\f581"
        }

        .fa-grin-beam:before {
            content: "\f582"
        }

        .fa-grin-beam-sweat:before {
            content: "\f583"
        }

        .fa-grin-hearts:before {
            content: "\f584"
        }

        .fa-grin-squint:before {
            content: "\f585"
        }

        .fa-grin-squint-tears:before {
            content: "\f586"
        }

        .fa-grin-stars:before {
            content: "\f587"
        }

        .fa-grin-tears:before {
            content: "\f588"
        }

        .fa-grin-tongue:before {
            content: "\f589"
        }

        .fa-grin-tongue-squint:before {
            content: "\f58a"
        }

        .fa-grin-tongue-wink:before {
            content: "\f58b"
        }

        .fa-grin-wink:before {
            content: "\f58c"
        }

        .fa-grip-horizontal:before {
            content: "\f58d"
        }

        .fa-grip-lines:before {
            content: "\f7a4"
        }

        .fa-grip-lines-vertical:before {
            content: "\f7a5"
        }

        .fa-grip-vertical:before {
            content: "\f58e"
        }

        .fa-gripfire:before {
            content: "\f3ac"
        }

        .fa-grunt:before {
            content: "\f3ad"
        }

        .fa-guitar:before {
            content: "\f7a6"
        }

        .fa-gulp:before {
            content: "\f3ae"
        }

        .fa-h-square:before {
            content: "\f0fd"
        }

        .fa-hacker-news:before {
            content: "\f1d4"
        }

        .fa-hacker-news-square:before {
            content: "\f3af"
        }

        .fa-hackerrank:before {
            content: "\f5f7"
        }

        .fa-hamburger:before {
            content: "\f805"
        }

        .fa-hammer:before {
            content: "\f6e3"
        }

        .fa-hamsa:before {
            content: "\f665"
        }

        .fa-hand-holding:before {
            content: "\f4bd"
        }

        .fa-hand-holding-heart:before {
            content: "\f4be"
        }

        .fa-hand-holding-usd:before {
            content: "\f4c0"
        }

        .fa-hand-lizard:before {
            content: "\f258"
        }

        .fa-hand-middle-finger:before {
            content: "\f806"
        }

        .fa-hand-paper:before {
            content: "\f256"
        }

        .fa-hand-peace:before {
            content: "\f25b"
        }

        .fa-hand-point-down:before {
            content: "\f0a7"
        }

        .fa-hand-point-left:before {
            content: "\f0a5"
        }

        .fa-hand-point-right:before {
            content: "\f0a4"
        }

        .fa-hand-point-up:before {
            content: "\f0a6"
        }

        .fa-hand-pointer:before {
            content: "\f25a"
        }

        .fa-hand-rock:before {
            content: "\f255"
        }

        .fa-hand-scissors:before {
            content: "\f257"
        }

        .fa-hand-spock:before {
            content: "\f259"
        }

        .fa-hands:before {
            content: "\f4c2"
        }

        .fa-hands-helping:before {
            content: "\f4c4"
        }

        .fa-handshake:before {
            content: "\f2b5"
        }

        .fa-hanukiah:before {
            content: "\f6e6"
        }

        .fa-hard-hat:before {
            content: "\f807"
        }

        .fa-hashtag:before {
            content: "\f292"
        }

        .fa-hat-wizard:before {
            content: "\f6e8"
        }

        .fa-haykal:before {
            content: "\f666"
        }

        .fa-hdd:before {
            content: "\f0a0"
        }

        .fa-heading:before {
            content: "\f1dc"
        }

        .fa-headphones:before {
            content: "\f025"
        }

        .fa-headphones-alt:before {
            content: "\f58f"
        }

        .fa-headset:before {
            content: "\f590"
        }

        .fa-heart:before {
            content: "\f004"
        }

        .fa-heart-broken:before {
            content: "\f7a9"
        }

        .fa-heartbeat:before {
            content: "\f21e"
        }

        .fa-helicopter:before {
            content: "\f533"
        }

        .fa-highlighter:before {
            content: "\f591"
        }

        .fa-hiking:before {
            content: "\f6ec"
        }

        .fa-hippo:before {
            content: "\f6ed"
        }

        .fa-hips:before {
            content: "\f452"
        }

        .fa-hire-a-helper:before {
            content: "\f3b0"
        }

        .fa-history:before {
            content: "\f1da"
        }

        .fa-hockey-puck:before {
            content: "\f453"
        }

        .fa-holly-berry:before {
            content: "\f7aa"
        }

        .fa-home:before {
            content: "\f015"
        }

        .fa-hooli:before {
            content: "\f427"
        }

        .fa-hornbill:before {
            content: "\f592"
        }

        .fa-horse:before {
            content: "\f6f0"
        }

        .fa-horse-head:before {
            content: "\f7ab"
        }

        .fa-hospital:before {
            content: "\f0f8"
        }

        .fa-hospital-alt:before {
            content: "\f47d"
        }

        .fa-hospital-symbol:before {
            content: "\f47e"
        }

        .fa-hot-tub:before {
            content: "\f593"
        }

        .fa-hotdog:before {
            content: "\f80f"
        }

        .fa-hotel:before {
            content: "\f594"
        }

        .fa-hotjar:before {
            content: "\f3b1"
        }

        .fa-hourglass:before {
            content: "\f254"
        }

        .fa-hourglass-end:before {
            content: "\f253"
        }

        .fa-hourglass-half:before {
            content: "\f252"
        }

        .fa-hourglass-start:before {
            content: "\f251"
        }

        .fa-house-damage:before {
            content: "\f6f1"
        }

        .fa-houzz:before {
            content: "\f27c"
        }

        .fa-hryvnia:before {
            content: "\f6f2"
        }

        .fa-html5:before {
            content: "\f13b"
        }

        .fa-hubspot:before {
            content: "\f3b2"
        }

        .fa-i-cursor:before {
            content: "\f246"
        }

        .fa-ice-cream:before {
            content: "\f810"
        }

        .fa-icicles:before {
            content: "\f7ad"
        }

        .fa-icons:before {
            content: "\f86d"
        }

        .fa-id-badge:before {
            content: "\f2c1"
        }

        .fa-id-card:before {
            content: "\f2c2"
        }

        .fa-id-card-alt:before {
            content: "\f47f"
        }

        .fa-igloo:before {
            content: "\f7ae"
        }

        .fa-image:before {
            content: "\f03e"
        }

        .fa-images:before {
            content: "\f302"
        }

        .fa-imdb:before {
            content: "\f2d8"
        }

        .fa-inbox:before {
            content: "\f01c"
        }

        .fa-indent:before {
            content: "\f03c"
        }

        .fa-industry:before {
            content: "\f275"
        }

        .fa-infinity:before {
            content: "\f534"
        }

        .fa-info:before {
            content: "\f129"
        }

        .fa-info-circle:before {
            content: "\f05a"
        }

        .fa-instagram:before {
            content: "\f16d"
        }

        .fa-intercom:before {
            content: "\f7af"
        }

        .fa-internet-explorer:before {
            content: "\f26b"
        }

        .fa-invision:before {
            content: "\f7b0"
        }

        .fa-ioxhost:before {
            content: "\f208"
        }

        .fa-italic:before {
            content: "\f033"
        }

        .fa-itch-io:before {
            content: "\f83a"
        }

        .fa-itunes:before {
            content: "\f3b4"
        }

        .fa-itunes-note:before {
            content: "\f3b5"
        }

        .fa-java:before {
            content: "\f4e4"
        }

        .fa-jedi:before {
            content: "\f669"
        }

        .fa-jedi-order:before {
            content: "\f50e"
        }

        .fa-jenkins:before {
            content: "\f3b6"
        }

        .fa-jira:before {
            content: "\f7b1"
        }

        .fa-joget:before {
            content: "\f3b7"
        }

        .fa-joint:before {
            content: "\f595"
        }

        .fa-joomla:before {
            content: "\f1aa"
        }

        .fa-journal-whills:before {
            content: "\f66a"
        }

        .fa-js:before {
            content: "\f3b8"
        }

        .fa-js-square:before {
            content: "\f3b9"
        }

        .fa-jsfiddle:before {
            content: "\f1cc"
        }

        .fa-kaaba:before {
            content: "\f66b"
        }

        .fa-kaggle:before {
            content: "\f5fa"
        }

        .fa-key:before {
            content: "\f084"
        }

        .fa-keybase:before {
            content: "\f4f5"
        }

        .fa-keyboard:before {
            content: "\f11c"
        }

        .fa-keycdn:before {
            content: "\f3ba"
        }

        .fa-khanda:before {
            content: "\f66d"
        }

        .fa-kickstarter:before {
            content: "\f3bb"
        }

        .fa-kickstarter-k:before {
            content: "\f3bc"
        }

        .fa-kiss:before {
            content: "\f596"
        }

        .fa-kiss-beam:before {
            content: "\f597"
        }

        .fa-kiss-wink-heart:before {
            content: "\f598"
        }

        .fa-kiwi-bird:before {
            content: "\f535"
        }

        .fa-korvue:before {
            content: "\f42f"
        }

        .fa-landmark:before {
            content: "\f66f"
        }

        .fa-language:before {
            content: "\f1ab"
        }

        .fa-laptop:before {
            content: "\f109"
        }

        .fa-laptop-code:before {
            content: "\f5fc"
        }

        .fa-laptop-medical:before {
            content: "\f812"
        }

        .fa-laravel:before {
            content: "\f3bd"
        }

        .fa-lastfm:before {
            content: "\f202"
        }

        .fa-lastfm-square:before {
            content: "\f203"
        }

        .fa-laugh:before {
            content: "\f599"
        }

        .fa-laugh-beam:before {
            content: "\f59a"
        }

        .fa-laugh-squint:before {
            content: "\f59b"
        }

        .fa-laugh-wink:before {
            content: "\f59c"
        }

        .fa-layer-group:before {
            content: "\f5fd"
        }

        .fa-leaf:before {
            content: "\f06c"
        }

        .fa-leanpub:before {
            content: "\f212"
        }

        .fa-lemon:before {
            content: "\f094"
        }

        .fa-less:before {
            content: "\f41d"
        }

        .fa-less-than:before {
            content: "\f536"
        }

        .fa-less-than-equal:before {
            content: "\f537"
        }

        .fa-level-down-alt:before {
            content: "\f3be"
        }

        .fa-level-up-alt:before {
            content: "\f3bf"
        }

        .fa-life-ring:before {
            content: "\f1cd"
        }

        .fa-lightbulb:before {
            content: "\f0eb"
        }

        .fa-line:before {
            content: "\f3c0"
        }

        .fa-link:before {
            content: "\f0c1"
        }

        .fa-linkedin:before {
            content: "\f08c"
        }

        .fa-linkedin-in:before {
            content: "\f0e1"
        }

        .fa-linode:before {
            content: "\f2b8"
        }

        .fa-linux:before {
            content: "\f17c"
        }

        .fa-lira-sign:before {
            content: "\f195"
        }

        .fa-list:before {
            content: "\f03a"
        }

        .fa-list-alt:before {
            content: "\f022"
        }

        .fa-list-ol:before {
            content: "\f0cb"
        }

        .fa-list-ul:before {
            content: "\f0ca"
        }

        .fa-location-arrow:before {
            content: "\f124"
        }

        .fa-lock:before {
            content: "\f023"
        }

        .fa-lock-open:before {
            content: "\f3c1"
        }

        .fa-long-arrow-alt-down:before {
            content: "\f309"
        }

        .fa-long-arrow-alt-left:before {
            content: "\f30a"
        }

        .fa-long-arrow-alt-right:before {
            content: "\f30b"
        }

        .fa-long-arrow-alt-up:before {
            content: "\f30c"
        }

        .fa-low-vision:before {
            content: "\f2a8"
        }

        .fa-luggage-cart:before {
            content: "\f59d"
        }

        .fa-lyft:before {
            content: "\f3c3"
        }

        .fa-magento:before {
            content: "\f3c4"
        }

        .fa-magic:before {
            content: "\f0d0"
        }

        .fa-magnet:before {
            content: "\f076"
        }

        .fa-mail-bulk:before {
            content: "\f674"
        }

        .fa-mailchimp:before {
            content: "\f59e"
        }

        .fa-male:before {
            content: "\f183"
        }

        .fa-mandalorian:before {
            content: "\f50f"
        }

        .fa-map:before {
            content: "\f279"
        }

        .fa-map-marked:before {
            content: "\f59f"
        }

        .fa-map-marked-alt:before {
            content: "\f5a0"
        }

        .fa-map-marker:before {
            content: "\f041"
        }

        .fa-map-marker-alt:before {
            content: "\f3c5"
        }

        .fa-map-pin:before {
            content: "\f276"
        }

        .fa-map-signs:before {
            content: "\f277"
        }

        .fa-markdown:before {
            content: "\f60f"
        }

        .fa-marker:before {
            content: "\f5a1"
        }

        .fa-mars:before {
            content: "\f222"
        }

        .fa-mars-double:before {
            content: "\f227"
        }

        .fa-mars-stroke:before {
            content: "\f229"
        }

        .fa-mars-stroke-h:before {
            content: "\f22b"
        }

        .fa-mars-stroke-v:before {
            content: "\f22a"
        }

        .fa-mask:before {
            content: "\f6fa"
        }

        .fa-mastodon:before {
            content: "\f4f6"
        }

        .fa-maxcdn:before {
            content: "\f136"
        }

        .fa-medal:before {
            content: "\f5a2"
        }

        .fa-medapps:before {
            content: "\f3c6"
        }

        .fa-medium:before {
            content: "\f23a"
        }

        .fa-medium-m:before {
            content: "\f3c7"
        }

        .fa-medkit:before {
            content: "\f0fa"
        }

        .fa-medrt:before {
            content: "\f3c8"
        }

        .fa-meetup:before {
            content: "\f2e0"
        }

        .fa-megaport:before {
            content: "\f5a3"
        }

        .fa-meh:before {
            content: "\f11a"
        }

        .fa-meh-blank:before {
            content: "\f5a4"
        }

        .fa-meh-rolling-eyes:before {
            content: "\f5a5"
        }

        .fa-memory:before {
            content: "\f538"
        }

        .fa-mendeley:before {
            content: "\f7b3"
        }

        .fa-menorah:before {
            content: "\f676"
        }

        .fa-mercury:before {
            content: "\f223"
        }

        .fa-meteor:before {
            content: "\f753"
        }

        .fa-microchip:before {
            content: "\f2db"
        }

        .fa-microphone:before {
            content: "\f130"
        }

        .fa-microphone-alt:before {
            content: "\f3c9"
        }

        .fa-microphone-alt-slash:before {
            content: "\f539"
        }

        .fa-microphone-slash:before {
            content: "\f131"
        }

        .fa-microscope:before {
            content: "\f610"
        }

        .fa-microsoft:before {
            content: "\f3ca"
        }

        .fa-minus:before {
            content: "\f068"
        }

        .fa-minus-circle:before {
            content: "\f056"
        }

        .fa-minus-square:before {
            content: "\f146"
        }

        .fa-mitten:before {
            content: "\f7b5"
        }

        .fa-mix:before {
            content: "\f3cb"
        }

        .fa-mixcloud:before {
            content: "\f289"
        }

        .fa-mizuni:before {
            content: "\f3cc"
        }

        .fa-mobile:before {
            content: "\f10b"
        }

        .fa-mobile-alt:before {
            content: "\f3cd"
        }

        .fa-modx:before {
            content: "\f285"
        }

        .fa-monero:before {
            content: "\f3d0"
        }

        .fa-money-bill:before {
            content: "\f0d6"
        }

        .fa-money-bill-alt:before {
            content: "\f3d1"
        }

        .fa-money-bill-wave:before {
            content: "\f53a"
        }

        .fa-money-bill-wave-alt:before {
            content: "\f53b"
        }

        .fa-money-check:before {
            content: "\f53c"
        }

        .fa-money-check-alt:before {
            content: "\f53d"
        }

        .fa-monument:before {
            content: "\f5a6"
        }

        .fa-moon:before {
            content: "\f186"
        }

        .fa-mortar-pestle:before {
            content: "\f5a7"
        }

        .fa-mosque:before {
            content: "\f678"
        }

        .fa-motorcycle:before {
            content: "\f21c"
        }

        .fa-mountain:before {
            content: "\f6fc"
        }

        .fa-mouse-pointer:before {
            content: "\f245"
        }

        .fa-mug-hot:before {
            content: "\f7b6"
        }

        .fa-music:before {
            content: "\f001"
        }

        .fa-napster:before {
            content: "\f3d2"
        }

        .fa-neos:before {
            content: "\f612"
        }

        .fa-network-wired:before {
            content: "\f6ff"
        }

        .fa-neuter:before {
            content: "\f22c"
        }

        .fa-newspaper:before {
            content: "\f1ea"
        }

        .fa-nimblr:before {
            content: "\f5a8"
        }

        .fa-node:before {
            content: "\f419"
        }

        .fa-node-js:before {
            content: "\f3d3"
        }

        .fa-not-equal:before {
            content: "\f53e"
        }

        .fa-notes-medical:before {
            content: "\f481"
        }

        .fa-npm:before {
            content: "\f3d4"
        }

        .fa-ns8:before {
            content: "\f3d5"
        }

        .fa-nutritionix:before {
            content: "\f3d6"
        }

        .fa-object-group:before {
            content: "\f247"
        }

        .fa-object-ungroup:before {
            content: "\f248"
        }

        .fa-odnoklassniki:before {
            content: "\f263"
        }

        .fa-odnoklassniki-square:before {
            content: "\f264"
        }

        .fa-oil-can:before {
            content: "\f613"
        }

        .fa-old-republic:before {
            content: "\f510"
        }

        .fa-om:before {
            content: "\f679"
        }

        .fa-opencart:before {
            content: "\f23d"
        }

        .fa-openid:before {
            content: "\f19b"
        }

        .fa-opera:before {
            content: "\f26a"
        }

        .fa-optin-monster:before {
            content: "\f23c"
        }

        .fa-osi:before {
            content: "\f41a"
        }

        .fa-otter:before {
            content: "\f700"
        }

        .fa-outdent:before {
            content: "\f03b"
        }

        .fa-page4:before {
            content: "\f3d7"
        }

        .fa-pagelines:before {
            content: "\f18c"
        }

        .fa-pager:before {
            content: "\f815"
        }

        .fa-paint-brush:before {
            content: "\f1fc"
        }

        .fa-paint-roller:before {
            content: "\f5aa"
        }

        .fa-palette:before {
            content: "\f53f"
        }

        .fa-palfed:before {
            content: "\f3d8"
        }

        .fa-pallet:before {
            content: "\f482"
        }

        .fa-paper-plane:before {
            content: "\f1d8"
        }

        .fa-paperclip:before {
            content: "\f0c6"
        }

        .fa-parachute-box:before {
            content: "\f4cd"
        }

        .fa-paragraph:before {
            content: "\f1dd"
        }

        .fa-parking:before {
            content: "\f540"
        }

        .fa-passport:before {
            content: "\f5ab"
        }

        .fa-pastafarianism:before {
            content: "\f67b"
        }

        .fa-paste:before {
            content: "\f0ea"
        }

        .fa-patreon:before {
            content: "\f3d9"
        }

        .fa-pause:before {
            content: "\f04c"
        }

        .fa-pause-circle:before {
            content: "\f28b"
        }

        .fa-paw:before {
            content: "\f1b0"
        }

        .fa-paypal:before {
            content: "\f1ed"
        }

        .fa-peace:before {
            content: "\f67c"
        }

        .fa-pen:before {
            content: "\f304"
        }

        .fa-pen-alt:before {
            content: "\f305"
        }

        .fa-pen-fancy:before {
            content: "\f5ac"
        }

        .fa-pen-nib:before {
            content: "\f5ad"
        }

        .fa-pen-square:before {
            content: "\f14b"
        }

        .fa-pencil-alt:before {
            content: "\f303"
        }

        .fa-pencil-ruler:before {
            content: "\f5ae"
        }

        .fa-penny-arcade:before {
            content: "\f704"
        }

        .fa-people-carry:before {
            content: "\f4ce"
        }

        .fa-pepper-hot:before {
            content: "\f816"
        }

        .fa-percent:before {
            content: "\f295"
        }

        .fa-percentage:before {
            content: "\f541"
        }

        .fa-periscope:before {
            content: "\f3da"
        }

        .fa-person-booth:before {
            content: "\f756"
        }

        .fa-phabricator:before {
            content: "\f3db"
        }

        .fa-phoenix-framework:before {
            content: "\f3dc"
        }

        .fa-phoenix-squadron:before {
            content: "\f511"
        }

        .fa-phone:before {
            content: "\f095"
        }

        .fa-phone-alt:before {
            content: "\f879"
        }

        .fa-phone-slash:before {
            content: "\f3dd"
        }

        .fa-phone-square:before {
            content: "\f098"
        }

        .fa-phone-square-alt:before {
            content: "\f87b"
        }

        .fa-phone-volume:before {
            content: "\f2a0"
        }

        .fa-photo-video:before {
            content: "\f87c"
        }

        .fa-php:before {
            content: "\f457"
        }

        .fa-pied-piper:before {
            content: "\f2ae"
        }

        .fa-pied-piper-alt:before {
            content: "\f1a8"
        }

        .fa-pied-piper-hat:before {
            content: "\f4e5"
        }

        .fa-pied-piper-pp:before {
            content: "\f1a7"
        }

        .fa-piggy-bank:before {
            content: "\f4d3"
        }

        .fa-pills:before {
            content: "\f484"
        }

        .fa-pinterest:before {
            content: "\f0d2"
        }

        .fa-pinterest-p:before {
            content: "\f231"
        }

        .fa-pinterest-square:before {
            content: "\f0d3"
        }

        .fa-pizza-slice:before {
            content: "\f818"
        }

        .fa-place-of-worship:before {
            content: "\f67f"
        }

        .fa-plane:before {
            content: "\f072"
        }

        .fa-plane-arrival:before {
            content: "\f5af"
        }

        .fa-plane-departure:before {
            content: "\f5b0"
        }

        .fa-play:before {
            content: "\f04b"
        }

        .fa-play-circle:before {
            content: "\f144"
        }

        .fa-playstation:before {
            content: "\f3df"
        }

        .fa-plug:before {
            content: "\f1e6"
        }

        .fa-plus:before {
            content: "\f067"
        }

        .fa-plus-circle:before {
            content: "\f055"
        }

        .fa-plus-square:before {
            content: "\f0fe"
        }

        .fa-podcast:before {
            content: "\f2ce"
        }

        .fa-poll:before {
            content: "\f681"
        }

        .fa-poll-h:before {
            content: "\f682"
        }

        .fa-poo:before {
            content: "\f2fe"
        }

        .fa-poo-storm:before {
            content: "\f75a"
        }

        .fa-poop:before {
            content: "\f619"
        }

        .fa-portrait:before {
            content: "\f3e0"
        }

        .fa-pound-sign:before {
            content: "\f154"
        }

        .fa-power-off:before {
            content: "\f011"
        }

        .fa-pray:before {
            content: "\f683"
        }

        .fa-praying-hands:before {
            content: "\f684"
        }

        .fa-prescription:before {
            content: "\f5b1"
        }

        .fa-prescription-bottle:before {
            content: "\f485"
        }

        .fa-prescription-bottle-alt:before {
            content: "\f486"
        }

        .fa-print:before {
            content: "\f02f"
        }

        .fa-procedures:before {
            content: "\f487"
        }

        .fa-product-hunt:before {
            content: "\f288"
        }

        .fa-project-diagram:before {
            content: "\f542"
        }

        .fa-pushed:before {
            content: "\f3e1"
        }

        .fa-puzzle-piece:before {
            content: "\f12e"
        }

        .fa-python:before {
            content: "\f3e2"
        }

        .fa-qq:before {
            content: "\f1d6"
        }

        .fa-qrcode:before {
            content: "\f029"
        }

        .fa-question:before {
            content: "\f128"
        }

        .fa-question-circle:before {
            content: "\f059"
        }

        .fa-quidditch:before {
            content: "\f458"
        }

        .fa-quinscape:before {
            content: "\f459"
        }

        .fa-quora:before {
            content: "\f2c4"
        }

        .fa-quote-left:before {
            content: "\f10d"
        }

        .fa-quote-right:before {
            content: "\f10e"
        }

        .fa-quran:before {
            content: "\f687"
        }

        .fa-r-project:before {
            content: "\f4f7"
        }

        .fa-radiation:before {
            content: "\f7b9"
        }

        .fa-radiation-alt:before {
            content: "\f7ba"
        }

        .fa-rainbow:before {
            content: "\f75b"
        }

        .fa-random:before {
            content: "\f074"
        }

        .fa-raspberry-pi:before {
            content: "\f7bb"
        }

        .fa-ravelry:before {
            content: "\f2d9"
        }

        .fa-react:before {
            content: "\f41b"
        }

        .fa-reacteurope:before {
            content: "\f75d"
        }

        .fa-readme:before {
            content: "\f4d5"
        }

        .fa-rebel:before {
            content: "\f1d0"
        }

        .fa-receipt:before {
            content: "\f543"
        }

        .fa-recycle:before {
            content: "\f1b8"
        }

        .fa-red-river:before {
            content: "\f3e3"
        }

        .fa-reddit:before {
            content: "\f1a1"
        }

        .fa-reddit-alien:before {
            content: "\f281"
        }

        .fa-reddit-square:before {
            content: "\f1a2"
        }

        .fa-redhat:before {
            content: "\f7bc"
        }

        .fa-redo:before {
            content: "\f01e"
        }

        .fa-redo-alt:before {
            content: "\f2f9"
        }

        .fa-registered:before {
            content: "\f25d"
        }

        .fa-remove-format:before {
            content: "\f87d"
        }

        .fa-renren:before {
            content: "\f18b"
        }

        .fa-reply:before {
            content: "\f3e5"
        }

        .fa-reply-all:before {
            content: "\f122"
        }

        .fa-replyd:before {
            content: "\f3e6"
        }

        .fa-republican:before {
            content: "\f75e"
        }

        .fa-researchgate:before {
            content: "\f4f8"
        }

        .fa-resolving:before {
            content: "\f3e7"
        }

        .fa-restroom:before {
            content: "\f7bd"
        }

        .fa-retweet:before {
            content: "\f079"
        }

        .fa-rev:before {
            content: "\f5b2"
        }

        .fa-ribbon:before {
            content: "\f4d6"
        }

        .fa-ring:before {
            content: "\f70b"
        }

        .fa-road:before {
            content: "\f018"
        }

        .fa-robot:before {
            content: "\f544"
        }

        .fa-rocket:before {
            content: "\f135"
        }

        .fa-rocketchat:before {
            content: "\f3e8"
        }

        .fa-rockrms:before {
            content: "\f3e9"
        }

        .fa-route:before {
            content: "\f4d7"
        }

        .fa-rss:before {
            content: "\f09e"
        }

        .fa-rss-square:before {
            content: "\f143"
        }

        .fa-ruble-sign:before {
            content: "\f158"
        }

        .fa-ruler:before {
            content: "\f545"
        }

        .fa-ruler-combined:before {
            content: "\f546"
        }

        .fa-ruler-horizontal:before {
            content: "\f547"
        }

        .fa-ruler-vertical:before {
            content: "\f548"
        }

        .fa-running:before {
            content: "\f70c"
        }

        .fa-rupee-sign:before {
            content: "\f156"
        }

        .fa-sad-cry:before {
            content: "\f5b3"
        }

        .fa-sad-tear:before {
            content: "\f5b4"
        }

        .fa-safari:before {
            content: "\f267"
        }

        .fa-salesforce:before {
            content: "\f83b"
        }

        .fa-sass:before {
            content: "\f41e"
        }

        .fa-satellite:before {
            content: "\f7bf"
        }

        .fa-satellite-dish:before {
            content: "\f7c0"
        }

        .fa-save:before {
            content: "\f0c7"
        }

        .fa-schlix:before {
            content: "\f3ea"
        }

        .fa-school:before {
            content: "\f549"
        }

        .fa-screwdriver:before {
            content: "\f54a"
        }

        .fa-scribd:before {
            content: "\f28a"
        }

        .fa-scroll:before {
            content: "\f70e"
        }

        .fa-sd-card:before {
            content: "\f7c2"
        }

        .fa-search:before {
            content: "\f002"
        }

        .fa-search-dollar:before {
            content: "\f688"
        }

        .fa-search-location:before {
            content: "\f689"
        }

        .fa-search-minus:before {
            content: "\f010"
        }

        .fa-search-plus:before {
            content: "\f00e"
        }

        .fa-searchengin:before {
            content: "\f3eb"
        }

        .fa-seedling:before {
            content: "\f4d8"
        }

        .fa-sellcast:before {
            content: "\f2da"
        }

        .fa-sellsy:before {
            content: "\f213"
        }

        .fa-server:before {
            content: "\f233"
        }

        .fa-servicestack:before {
            content: "\f3ec"
        }

        .fa-shapes:before {
            content: "\f61f"
        }

        .fa-share:before {
            content: "\f064"
        }

        .fa-share-alt:before {
            content: "\f1e0"
        }

        .fa-share-alt-square:before {
            content: "\f1e1"
        }

        .fa-share-square:before {
            content: "\f14d"
        }

        .fa-shekel-sign:before {
            content: "\f20b"
        }

        .fa-shield-alt:before {
            content: "\f3ed"
        }

        .fa-ship:before {
            content: "\f21a"
        }

        .fa-shipping-fast:before {
            content: "\f48b"
        }

        .fa-shirtsinbulk:before {
            content: "\f214"
        }

        .fa-shoe-prints:before {
            content: "\f54b"
        }

        .fa-shopping-bag:before {
            content: "\f290"
        }

        .fa-shopping-basket:before {
            content: "\f291"
        }

        .fa-shopping-cart:before {
            content: "\f07a"
        }

        .fa-shopware:before {
            content: "\f5b5"
        }

        .fa-shower:before {
            content: "\f2cc"
        }

        .fa-shuttle-van:before {
            content: "\f5b6"
        }

        .fa-sign:before {
            content: "\f4d9"
        }

        .fa-sign-in-alt:before {
            content: "\f2f6"
        }

        .fa-sign-language:before {
            content: "\f2a7"
        }

        .fa-sign-out-alt:before {
            content: "\f2f5"
        }

        .fa-signal:before {
            content: "\f012"
        }

        .fa-signature:before {
            content: "\f5b7"
        }

        .fa-sim-card:before {
            content: "\f7c4"
        }

        .fa-simplybuilt:before {
            content: "\f215"
        }

        .fa-sistrix:before {
            content: "\f3ee"
        }

        .fa-sitemap:before {
            content: "\f0e8"
        }

        .fa-sith:before {
            content: "\f512"
        }

        .fa-skating:before {
            content: "\f7c5"
        }

        .fa-sketch:before {
            content: "\f7c6"
        }

        .fa-skiing:before {
            content: "\f7c9"
        }

        .fa-skiing-nordic:before {
            content: "\f7ca"
        }

        .fa-skull:before {
            content: "\f54c"
        }

        .fa-skull-crossbones:before {
            content: "\f714"
        }

        .fa-skyatlas:before {
            content: "\f216"
        }

        .fa-skype:before {
            content: "\f17e"
        }

        .fa-slack:before {
            content: "\f198"
        }

        .fa-slack-hash:before {
            content: "\f3ef"
        }

        .fa-slash:before {
            content: "\f715"
        }

        .fa-sleigh:before {
            content: "\f7cc"
        }

        .fa-sliders-h:before {
            content: "\f1de"
        }

        .fa-slideshare:before {
            content: "\f1e7"
        }

        .fa-smile:before {
            content: "\f118"
        }

        .fa-smile-beam:before {
            content: "\f5b8"
        }

        .fa-smile-wink:before {
            content: "\f4da"
        }

        .fa-smog:before {
            content: "\f75f"
        }

        .fa-smoking:before {
            content: "\f48d"
        }

        .fa-smoking-ban:before {
            content: "\f54d"
        }

        .fa-sms:before {
            content: "\f7cd"
        }

        .fa-snapchat:before {
            content: "\f2ab"
        }

        .fa-snapchat-ghost:before {
            content: "\f2ac"
        }

        .fa-snapchat-square:before {
            content: "\f2ad"
        }

        .fa-snowboarding:before {
            content: "\f7ce"
        }

        .fa-snowflake:before {
            content: "\f2dc"
        }

        .fa-snowman:before {
            content: "\f7d0"
        }

        .fa-snowplow:before {
            content: "\f7d2"
        }

        .fa-socks:before {
            content: "\f696"
        }

        .fa-solar-panel:before {
            content: "\f5ba"
        }

        .fa-sort:before {
            content: "\f0dc"
        }

        .fa-sort-alpha-down:before {
            content: "\f15d"
        }

        .fa-sort-alpha-down-alt:before {
            content: "\f881"
        }

        .fa-sort-alpha-up:before {
            content: "\f15e"
        }

        .fa-sort-alpha-up-alt:before {
            content: "\f882"
        }

        .fa-sort-amount-down:before {
            content: "\f160"
        }

        .fa-sort-amount-down-alt:before {
            content: "\f884"
        }

        .fa-sort-amount-up:before {
            content: "\f161"
        }

        .fa-sort-amount-up-alt:before {
            content: "\f885"
        }

        .fa-sort-down:before {
            content: "\f0dd"
        }

        .fa-sort-numeric-down:before {
            content: "\f162"
        }

        .fa-sort-numeric-down-alt:before {
            content: "\f886"
        }

        .fa-sort-numeric-up:before {
            content: "\f163"
        }

        .fa-sort-numeric-up-alt:before {
            content: "\f887"
        }

        .fa-sort-up:before {
            content: "\f0de"
        }

        .fa-soundcloud:before {
            content: "\f1be"
        }

        .fa-sourcetree:before {
            content: "\f7d3"
        }

        .fa-spa:before {
            content: "\f5bb"
        }

        .fa-space-shuttle:before {
            content: "\f197"
        }

        .fa-speakap:before {
            content: "\f3f3"
        }

        .fa-speaker-deck:before {
            content: "\f83c"
        }

        .fa-spell-check:before {
            content: "\f891"
        }

        .fa-spider:before {
            content: "\f717"
        }

        .fa-spinner:before {
            content: "\f110"
        }

        .fa-splotch:before {
            content: "\f5bc"
        }

        .fa-spotify:before {
            content: "\f1bc"
        }

        .fa-spray-can:before {
            content: "\f5bd"
        }

        .fa-square:before {
            content: "\f0c8"
        }

        .fa-square-full:before {
            content: "\f45c"
        }

        .fa-square-root-alt:before {
            content: "\f698"
        }

        .fa-squarespace:before {
            content: "\f5be"
        }

        .fa-stack-exchange:before {
            content: "\f18d"
        }

        .fa-stack-overflow:before {
            content: "\f16c"
        }

        .fa-stackpath:before {
            content: "\f842"
        }

        .fa-stamp:before {
            content: "\f5bf"
        }

        .fa-star:before {
            content: "\f005"
        }

        .fa-star-and-crescent:before {
            content: "\f699"
        }

        .fa-star-half:before {
            content: "\f089"
        }

        .fa-star-half-alt:before {
            content: "\f5c0"
        }

        .fa-star-of-david:before {
            content: "\f69a"
        }

        .fa-star-of-life:before {
            content: "\f621"
        }

        .fa-staylinked:before {
            content: "\f3f5"
        }

        .fa-steam:before {
            content: "\f1b6"
        }

        .fa-steam-square:before {
            content: "\f1b7"
        }

        .fa-steam-symbol:before {
            content: "\f3f6"
        }

        .fa-step-backward:before {
            content: "\f048"
        }

        .fa-step-forward:before {
            content: "\f051"
        }

        .fa-stethoscope:before {
            content: "\f0f1"
        }

        .fa-sticker-mule:before {
            content: "\f3f7"
        }

        .fa-sticky-note:before {
            content: "\f249"
        }

        .fa-stop:before {
            content: "\f04d"
        }

        .fa-stop-circle:before {
            content: "\f28d"
        }

        .fa-stopwatch:before {
            content: "\f2f2"
        }

        .fa-store:before {
            content: "\f54e"
        }

        .fa-store-alt:before {
            content: "\f54f"
        }

        .fa-strava:before {
            content: "\f428"
        }

        .fa-stream:before {
            content: "\f550"
        }

        .fa-street-view:before {
            content: "\f21d"
        }

        .fa-strikethrough:before {
            content: "\f0cc"
        }

        .fa-stripe:before {
            content: "\f429"
        }

        .fa-stripe-s:before {
            content: "\f42a"
        }

        .fa-stroopwafel:before {
            content: "\f551"
        }

        .fa-studiovinari:before {
            content: "\f3f8"
        }

        .fa-stumbleupon:before {
            content: "\f1a4"
        }

        .fa-stumbleupon-circle:before {
            content: "\f1a3"
        }

        .fa-subscript:before {
            content: "\f12c"
        }

        .fa-subway:before {
            content: "\f239"
        }

        .fa-suitcase:before {
            content: "\f0f2"
        }

        .fa-suitcase-rolling:before {
            content: "\f5c1"
        }

        .fa-sun:before {
            content: "\f185"
        }

        .fa-superpowers:before {
            content: "\f2dd"
        }

        .fa-superscript:before {
            content: "\f12b"
        }

        .fa-supple:before {
            content: "\f3f9"
        }

        .fa-surprise:before {
            content: "\f5c2"
        }

        .fa-suse:before {
            content: "\f7d6"
        }

        .fa-swatchbook:before {
            content: "\f5c3"
        }

        .fa-swimmer:before {
            content: "\f5c4"
        }

        .fa-swimming-pool:before {
            content: "\f5c5"
        }

        .fa-symfony:before {
            content: "\f83d"
        }

        .fa-synagogue:before {
            content: "\f69b"
        }

        .fa-sync:before {
            content: "\f021"
        }

        .fa-sync-alt:before {
            content: "\f2f1"
        }

        .fa-syringe:before {
            content: "\f48e"
        }

        .fa-table:before {
            content: "\f0ce"
        }

        .fa-table-tennis:before {
            content: "\f45d"
        }

        .fa-tablet:before {
            content: "\f10a"
        }

        .fa-tablet-alt:before {
            content: "\f3fa"
        }

        .fa-tablets:before {
            content: "\f490"
        }

        .fa-tachometer-alt:before {
            content: "\f3fd"
        }

        .fa-tag:before {
            content: "\f02b"
        }

        .fa-tags:before {
            content: "\f02c"
        }

        .fa-tape:before {
            content: "\f4db"
        }

        .fa-tasks:before {
            content: "\f0ae"
        }

        .fa-taxi:before {
            content: "\f1ba"
        }

        .fa-teamspeak:before {
            content: "\f4f9"
        }

        .fa-teeth:before {
            content: "\f62e"
        }

        .fa-teeth-open:before {
            content: "\f62f"
        }

        .fa-telegram:before {
            content: "\f2c6"
        }

        .fa-telegram-plane:before {
            content: "\f3fe"
        }

        .fa-temperature-high:before {
            content: "\f769"
        }

        .fa-temperature-low:before {
            content: "\f76b"
        }

        .fa-tencent-weibo:before {
            content: "\f1d5"
        }

        .fa-tenge:before {
            content: "\f7d7"
        }

        .fa-terminal:before {
            content: "\f120"
        }

        .fa-text-height:before {
            content: "\f034"
        }

        .fa-text-width:before {
            content: "\f035"
        }

        .fa-th:before {
            content: "\f00a"
        }

        .fa-th-large:before {
            content: "\f009"
        }

        .fa-th-list:before {
            content: "\f00b"
        }

        .fa-the-red-yeti:before {
            content: "\f69d"
        }

        .fa-theater-masks:before {
            content: "\f630"
        }

        .fa-themeco:before {
            content: "\f5c6"
        }

        .fa-themeisle:before {
            content: "\f2b2"
        }

        .fa-thermometer:before {
            content: "\f491"
        }

        .fa-thermometer-empty:before {
            content: "\f2cb"
        }

        .fa-thermometer-full:before {
            content: "\f2c7"
        }

        .fa-thermometer-half:before {
            content: "\f2c9"
        }

        .fa-thermometer-quarter:before {
            content: "\f2ca"
        }

        .fa-thermometer-three-quarters:before {
            content: "\f2c8"
        }

        .fa-think-peaks:before {
            content: "\f731"
        }

        .fa-thumbs-down:before {
            content: "\f165"
        }

        .fa-thumbs-up:before {
            content: "\f164"
        }

        .fa-thumbtack:before {
            content: "\f08d"
        }

        .fa-ticket-alt:before {
            content: "\f3ff"
        }

        .fa-times:before {
            content: "\f00d"
        }

        .fa-times-circle:before {
            content: "\f057"
        }

        .fa-tint:before {
            content: "\f043"
        }

        .fa-tint-slash:before {
            content: "\f5c7"
        }

        .fa-tired:before {
            content: "\f5c8"
        }

        .fa-toggle-off:before {
            content: "\f204"
        }

        .fa-toggle-on:before {
            content: "\f205"
        }

        .fa-toilet:before {
            content: "\f7d8"
        }

        .fa-toilet-paper:before {
            content: "\f71e"
        }

        .fa-toolbox:before {
            content: "\f552"
        }

        .fa-tools:before {
            content: "\f7d9"
        }

        .fa-tooth:before {
            content: "\f5c9"
        }

        .fa-torah:before {
            content: "\f6a0"
        }

        .fa-torii-gate:before {
            content: "\f6a1"
        }

        .fa-tractor:before {
            content: "\f722"
        }

        .fa-trade-federation:before {
            content: "\f513"
        }

        .fa-trademark:before {
            content: "\f25c"
        }

        .fa-traffic-light:before {
            content: "\f637"
        }

        .fa-train:before {
            content: "\f238"
        }

        .fa-tram:before {
            content: "\f7da"
        }

        .fa-transgender:before {
            content: "\f224"
        }

        .fa-transgender-alt:before {
            content: "\f225"
        }

        .fa-trash:before {
            content: "\f1f8"
        }

        .fa-trash-alt:before {
            content: "\f2ed"
        }

        .fa-trash-restore:before {
            content: "\f829"
        }

        .fa-trash-restore-alt:before {
            content: "\f82a"
        }

        .fa-tree:before {
            content: "\f1bb"
        }

        .fa-trello:before {
            content: "\f181"
        }

        .fa-tripadvisor:before {
            content: "\f262"
        }

        .fa-trophy:before {
            content: "\f091"
        }

        .fa-truck:before {
            content: "\f0d1"
        }

        .fa-truck-loading:before {
            content: "\f4de"
        }

        .fa-truck-monster:before {
            content: "\f63b"
        }

        .fa-truck-moving:before {
            content: "\f4df"
        }

        .fa-truck-pickup:before {
            content: "\f63c"
        }

        .fa-tshirt:before {
            content: "\f553"
        }

        .fa-tty:before {
            content: "\f1e4"
        }

        .fa-tumblr:before {
            content: "\f173"
        }

        .fa-tumblr-square:before {
            content: "\f174"
        }

        .fa-tv:before {
            content: "\f26c"
        }

        .fa-twitch:before {
            content: "\f1e8"
        }

        .fa-twitter:before {
            content: "\f099"
        }

        .fa-twitter-square:before {
            content: "\f081"
        }

        .fa-typo3:before {
            content: "\f42b"
        }

        .fa-uber:before {
            content: "\f402"
        }

        .fa-ubuntu:before {
            content: "\f7df"
        }

        .fa-uikit:before {
            content: "\f403"
        }

        .fa-umbrella:before {
            content: "\f0e9"
        }

        .fa-umbrella-beach:before {
            content: "\f5ca"
        }

        .fa-underline:before {
            content: "\f0cd"
        }

        .fa-undo:before {
            content: "\f0e2"
        }

        .fa-undo-alt:before {
            content: "\f2ea"
        }

        .fa-uniregistry:before {
            content: "\f404"
        }

        .fa-universal-access:before {
            content: "\f29a"
        }

        .fa-university:before {
            content: "\f19c"
        }

        .fa-unlink:before {
            content: "\f127"
        }

        .fa-unlock:before {
            content: "\f09c"
        }

        .fa-unlock-alt:before {
            content: "\f13e"
        }

        .fa-untappd:before {
            content: "\f405"
        }

        .fa-upload:before {
            content: "\f093"
        }

        .fa-ups:before {
            content: "\f7e0"
        }

        .fa-usb:before {
            content: "\f287"
        }

        .fa-user:before {
            content: "\f007"
        }

        .fa-user-alt:before {
            content: "\f406"
        }

        .fa-user-alt-slash:before {
            content: "\f4fa"
        }

        .fa-user-astronaut:before {
            content: "\f4fb"
        }

        .fa-user-check:before {
            content: "\f4fc"
        }

        .fa-user-circle:before {
            content: "\f2bd"
        }

        .fa-user-clock:before {
            content: "\f4fd"
        }

        .fa-user-cog:before {
            content: "\f4fe"
        }

        .fa-user-edit:before {
            content: "\f4ff"
        }

        .fa-user-friends:before {
            content: "\f500"
        }

        .fa-user-graduate:before {
            content: "\f501"
        }

        .fa-user-injured:before {
            content: "\f728"
        }

        .fa-user-lock:before {
            content: "\f502"
        }

        .fa-user-md:before {
            content: "\f0f0"
        }

        .fa-user-minus:before {
            content: "\f503"
        }

        .fa-user-ninja:before {
            content: "\f504"
        }

        .fa-user-nurse:before {
            content: "\f82f"
        }

        .fa-user-plus:before {
            content: "\f234"
        }

        .fa-user-secret:before {
            content: "\f21b"
        }

        .fa-user-shield:before {
            content: "\f505"
        }

        .fa-user-slash:before {
            content: "\f506"
        }

        .fa-user-tag:before {
            content: "\f507"
        }

        .fa-user-tie:before {
            content: "\f508"
        }

        .fa-user-times:before {
            content: "\f235"
        }

        .fa-users:before {
            content: "\f0c0"
        }

        .fa-users-cog:before {
            content: "\f509"
        }

        .fa-usps:before {
            content: "\f7e1"
        }

        .fa-ussunnah:before {
            content: "\f407"
        }

        .fa-utensil-spoon:before {
            content: "\f2e5"
        }

        .fa-utensils:before {
            content: "\f2e7"
        }

        .fa-vaadin:before {
            content: "\f408"
        }

        .fa-vector-square:before {
            content: "\f5cb"
        }

        .fa-venus:before {
            content: "\f221"
        }

        .fa-venus-double:before {
            content: "\f226"
        }

        .fa-venus-mars:before {
            content: "\f228"
        }

        .fa-viacoin:before {
            content: "\f237"
        }

        .fa-viadeo:before {
            content: "\f2a9"
        }

        .fa-viadeo-square:before {
            content: "\f2aa"
        }

        .fa-vial:before {
            content: "\f492"
        }

        .fa-vials:before {
            content: "\f493"
        }

        .fa-viber:before {
            content: "\f409"
        }

        .fa-video:before {
            content: "\f03d"
        }

        .fa-video-slash:before {
            content: "\f4e2"
        }

        .fa-vihara:before {
            content: "\f6a7"
        }

        .fa-vimeo:before {
            content: "\f40a"
        }

        .fa-vimeo-square:before {
            content: "\f194"
        }

        .fa-vimeo-v:before {
            content: "\f27d"
        }

        .fa-vine:before {
            content: "\f1ca"
        }

        .fa-vk:before {
            content: "\f189"
        }

        .fa-vnv:before {
            content: "\f40b"
        }

        .fa-voicemail:before {
            content: "\f897"
        }

        .fa-volleyball-ball:before {
            content: "\f45f"
        }

        .fa-volume-down:before {
            content: "\f027"
        }

        .fa-volume-mute:before {
            content: "\f6a9"
        }

        .fa-volume-off:before {
            content: "\f026"
        }

        .fa-volume-up:before {
            content: "\f028"
        }

        .fa-vote-yea:before {
            content: "\f772"
        }

        .fa-vr-cardboard:before {
            content: "\f729"
        }

        .fa-vuejs:before {
            content: "\f41f"
        }

        .fa-walking:before {
            content: "\f554"
        }

        .fa-wallet:before {
            content: "\f555"
        }

        .fa-warehouse:before {
            content: "\f494"
        }

        .fa-water:before {
            content: "\f773"
        }

        .fa-wave-square:before {
            content: "\f83e"
        }

        .fa-waze:before {
            content: "\f83f"
        }

        .fa-weebly:before {
            content: "\f5cc"
        }

        .fa-weibo:before {
            content: "\f18a"
        }

        .fa-weight:before {
            content: "\f496"
        }

        .fa-weight-hanging:before {
            content: "\f5cd"
        }

        .fa-weixin:before {
            content: "\f1d7"
        }

        .fa-whatsapp:before {
            content: "\f232"
        }

        .fa-whatsapp-square:before {
            content: "\f40c"
        }

        .fa-wheelchair:before {
            content: "\f193"
        }

        .fa-whmcs:before {
            content: "\f40d"
        }

        .fa-wifi:before {
            content: "\f1eb"
        }

        .fa-wikipedia-w:before {
            content: "\f266"
        }

        .fa-wind:before {
            content: "\f72e"
        }

        .fa-window-close:before {
            content: "\f410"
        }

        .fa-window-maximize:before {
            content: "\f2d0"
        }

        .fa-window-minimize:before {
            content: "\f2d1"
        }

        .fa-window-restore:before {
            content: "\f2d2"
        }

        .fa-windows:before {
            content: "\f17a"
        }

        .fa-wine-bottle:before {
            content: "\f72f"
        }

        .fa-wine-glass:before {
            content: "\f4e3"
        }

        .fa-wine-glass-alt:before {
            content: "\f5ce"
        }

        .fa-wix:before {
            content: "\f5cf"
        }

        .fa-wizards-of-the-coast:before {
            content: "\f730"
        }

        .fa-wolf-pack-battalion:before {
            content: "\f514"
        }

        .fa-won-sign:before {
            content: "\f159"
        }

        .fa-wordpress:before {
            content: "\f19a"
        }

        .fa-wordpress-simple:before {
            content: "\f411"
        }

        .fa-wpbeginner:before {
            content: "\f297"
        }

        .fa-wpexplorer:before {
            content: "\f2de"
        }

        .fa-wpforms:before {
            content: "\f298"
        }

        .fa-wpressr:before {
            content: "\f3e4"
        }

        .fa-wrench:before {
            content: "\f0ad"
        }

        .fa-x-ray:before {
            content: "\f497"
        }

        .fa-xbox:before {
            content: "\f412"
        }

        .fa-xing:before {
            content: "\f168"
        }

        .fa-xing-square:before {
            content: "\f169"
        }

        .fa-y-combinator:before {
            content: "\f23b"
        }

        .fa-yahoo:before {
            content: "\f19e"
        }

        .fa-yammer:before {
            content: "\f840"
        }

        .fa-yandex:before {
            content: "\f413"
        }

        .fa-yandex-international:before {
            content: "\f414"
        }

        .fa-yarn:before {
            content: "\f7e3"
        }

        .fa-yelp:before {
            content: "\f1e9"
        }

        .fa-yen-sign:before {
            content: "\f157"
        }

        .fa-yin-yang:before {
            content: "\f6ad"
        }

        .fa-yoast:before {
            content: "\f2b1"
        }

        .fa-youtube:before {
            content: "\f167"
        }

        .fa-youtube-square:before {
            content: "\f431"
        }

        .fa-zhihu:before {
            content: "\f63f"
        }

        .sr-only {
            border: 0;
            clip: rect(0, 0, 0, 0);
            height: 1px;
            margin: -1px;
            overflow: hidden;
            padding: 0;
            position: absolute;
            width: 1px
        }

        .sr-only-focusable:active,
        .sr-only-focusable:focus {
            clip: auto;
            height: auto;
            margin: 0;
            overflow: visible;
            position: static;
            width: auto
        }

        @font-face {
            font-family: "Font Awesome 5 Brands";
            font-style: normal;
            font-weight: normal;
            font-display: auto;
            src: url(../webfonts/fa-brands-400.eot);
            src: url(../webfonts/fa-brands-400d41d.eot?#iefix) format("embedded-opentype"), url(../webfonts/fa-brands-400.woff2) format("woff2"), url(../webfonts/fa-brands-400.woff) format("woff"), url(../webfonts/fa-brands-400.ttf) format("truetype"), url(../webfonts/fa-brands-400.svg#fontawesome) format("svg")
        }

        .fab {
            font-family: "Font Awesome 5 Brands"
        }

        @font-face {
            font-family: "Font Awesome 5 Free";
            font-style: normal;
            font-weight: 400;
            font-display: auto;
            src: url(../webfonts/fa-regular-400.eot);
            src: url(../webfonts/fa-regular-400d41d.eot?#iefix) format("embedded-opentype"), url(../webfonts/fa-regular-400.woff2) format("woff2"), url(../webfonts/fa-regular-400.woff) format("woff"), url(../webfonts/fa-regular-400.ttf) format("truetype"), url(../webfonts/fa-regular-400.svg#fontawesome) format("svg")
        }

        .far {
            font-weight: 400
        }

        @font-face {
            font-family: "Font Awesome 5 Free";
            font-style: normal;
            font-weight: 900;
            font-display: auto;
            src: url(../webfonts/fa-solid-900.eot);
            src: url(../webfonts/fa-solid-900d41d.eot?#iefix) format("embedded-opentype"), url(../webfonts/fa-solid-900.woff2) format("woff2"), url(../webfonts/fa-solid-900.woff) format("woff"), url(../webfonts/fa-solid-900.ttf) format("truetype"), url(../webfonts/fa-solid-900.svg#fontawesome) format("svg")
        }

        .fa,
        .far,
        .fas {
            font-family: "Font Awesome 5 Free"
        }

        .fa,
        .fas {
            font-weight: 900
        }
    </style>
    <!-- Styling ============================================= -->
    <style>
        body {
            background: #e7e9ed;
            color: #000;
            font-family: "Poppins", sans-serif;
            font-size: 14px;
            line-height: 22px;
        }

        .table thead {
            background-color: #eee;
        }

        .card-header {
            background-image: linear-gradient(96deg, #53b2fe, #065af3);
            color: #fff;
        }

        form {
            padding: 0;
            margin: 0;
            display: inline;
        }

        img {
            vertical-align: inherit;
        }

        a,
        a:focus {
            color: #0071cc;
            -webkit-transition: all 0.2s ease;
            transition: all 0.2s ease;
        }

        a:hover,
        a:active {
            color: #0c2f55;
            text-decoration: none;
            -webkit-transition: all 0.2s ease;
            transition: all 0.2s ease;
        }

        a:focus,
        a:active,
        .btn.active.focus,
        .btn.active:focus,
        .btn.focus,
        .btn:active.focus,
        .btn:active:focus,
        .btn:focus,
        button:focus,
        button:active {
            outline: none;
        }

        p {
            line-height: 1.9;
        }

        blockquote {
            border-left: 5px solid #eee;
            padding: 10px 20px;
        }

        iframe {
            border: 0 !important;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            color: #0c2f54;
            font-family: "Poppins", sans-serif;
        }

        .lead {
            font-size: 1.3em;
            line-height: 1.8;
        }

        .table {
            color: #535b61;
        }

        .table-hover tbody tr:hover {
            background-color: #f6f7f8;
        }


        #preloader {
            position: fixed;
            z-index: 999999999 !important;
            background-color: #fff;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            width: 100%;
            height: 100%;
        }

        #preloader [data-loader="dual-ring"] {
            position: absolute;
            top: 50%;
            left: 50%;
            width: 50px;
            height: 50px;
            margin-left: -25px;
            margin-top: -25px;
            display: inline-block;
            content: " ";
            display: block;
            margin: 1px;
            border-radius: 50%;
            border: 5px solid #0071cc;
            border-color: #0071cc transparent #0071cc transparent;
            animation: dual-ring 1.2s linear infinite;
        }

        @keyframes dual-ring {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }



        .shadow-md {
            -webkit-box-shadow: 0px 0px 50px -35px rgba(0, 0, 0, 0.4);
            box-shadow: 0px 0px 50px -35px rgba(0, 0, 0, 0.4);
        }


        .rounded-top-0 {
            border-top-left-radius: 0px !important;
            border-top-right-radius: 0px !important;
        }

        .rounded-bottom-0 {
            border-bottom-left-radius: 0px !important;
            border-bottom-right-radius: 0px !important;
        }

        .rounded-left-0 {
            border-top-left-radius: 0px !important;
            border-bottom-left-radius: 0px !important;
        }

        .rounded-right-0 {
            border-top-right-radius: 0px !important;
            border-bottom-right-radius: 0px !important;
        }


        .text-0 {
            font-size: 11px !important;
            font-size: 0.6875rem !important;
        }

        .text-1 {
            font-size: 12px !important;
            font-size: 0.75rem !important;
        }

        .text-2 {
            font-size: 14px !important;
            font-size: 0.875rem !important;
        }

        .text-3 {
            font-size: 16px !important;
            font-size: 1rem !important;
        }

        .text-4 {
            font-size: 18px !important;
            font-size: 1.125rem !important;
        }

        .text-5 {
            font-size: 21px !important;
            font-size: 1.3125rem !important;
        }

        .text-6 {
            font-size: 24px !important;
            font-size: 1.50rem !important;
        }

        .text-7 {
            font-size: 28px !important;
            font-size: 1.75rem !important;
        }

        .text-8 {
            font-size: 32px !important;
            font-size: 2rem !important;
        }

        .text-9 {
            font-size: 36px !important;
            font-size: 2.25rem !important;
        }

        .text-10 {
            font-size: 40px !important;
            font-size: 2.50rem !important;
        }

        .text-11 {
            font-size: 44px !important;
            font-size: 2.75rem !important;
        }

        .text-12 {
            font-size: 48px !important;
            font-size: 3rem !important;
        }

        .text-13 {
            font-size: 52px !important;
            font-size: 3.25rem !important;
        }

        .text-14 {
            font-size: 56px !important;
            font-size: 3.50rem !important;
        }

        .text-15 {
            font-size: 60px !important;
            font-size: 3.75rem !important;
        }

        .text-16 {
            font-size: 64px !important;
            font-size: 4rem !important;
        }

        .text-17 {
            font-size: 72px !important;
            font-size: 4.5rem !important;
        }

        .text-18 {
            font-size: 80px !important;
            font-size: 5rem !important;
        }

        .text-19 {
            font-size: 84px !important;
            font-size: 5.25rem !important;
        }

        .text-20 {
            font-size: 92px !important;
            font-size: 5.75rem !important;
        }


        .line-height-07 {
            line-height: 0.7 !important;
        }

        .line-height-1 {
            line-height: 1 !important;
        }

        .line-height-2 {
            line-height: 1.2 !important;
        }

        .line-height-3 {
            line-height: 1.4 !important;
        }

        .line-height-4 {
            line-height: 1.6 !important;
        }

        .line-height-5 {
            line-height: 1.8 !important;
        }


        .font-weight-100 {
            font-weight: 100 !important;
        }

        .font-weight-200 {
            font-weight: 200 !important;
        }

        .font-weight-300 {
            font-weight: 300 !important;
        }

        .font-weight-400 {
            font-weight: 400 !important;
        }

        .font-weight-500 {
            font-weight: 500 !important;
        }

        .font-weight-600 {
            font-weight: 600 !important;
        }

        .font-weight-700 {
            font-weight: 700 !important;
        }

        .font-weight-800 {
            font-weight: 800 !important;
        }

        .font-weight-900 {
            font-weight: 900 !important;
        }


        .opacity-0 {
            opacity: 0;
        }

        .opacity-1 {
            opacity: 0.1;
        }

        .opacity-2 {
            opacity: 0.2;
        }

        .opacity-3 {
            opacity: 0.3;
        }

        .opacity-4 {
            opacity: 0.4;
        }

        .opacity-5 {
            opacity: 0.5;
        }

        .opacity-6 {
            opacity: 0.6;
        }

        .opacity-7 {
            opacity: 0.7;
        }

        .opacity-8 {
            opacity: 0.8;
        }

        .opacity-9 {
            opacity: 0.9;
        }

        .opacity-10 {
            opacity: 1;
        }


        .bg-light {
            background-color: #FFF !important;
        }

        .bg-light-1 {
            background-color: #f9f9fb !important;
        }

        .bg-light-2 {
            background-color: #f8f8fa !important;
        }

        .bg-light-3 {
            background-color: #f5f5f5 !important;
        }

        .bg-light-4 {
            background-color: #eff0f2 !important;
        }

        .bg-light-5 {
            background-color: #ececec !important;
        }


        .bg-dark {
            background-color: #111418 !important;
        }

        .bg-dark-1 {
            background-color: #191f24 !important;
        }

        .bg-dark-2 {
            background-color: #232a31 !important;
        }

        .bg-dark-3 {
            background-color: #2b343c !important;
        }

        .bg-dark-4 {
            background-color: #38434f !important;
        }

        .bg-dark-5 {
            background-color: #435161 !important;
        }



        #main-wrapper {
            background: #f6f7f8;
        }

        #main-wrapper.boxed {
            max-width: 1200px;
            margin: 0 auto;
            -webkit-box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        .section {
            position: relative;
            padding: 50px 0;
            padding: 3.125rem 0;
        }

        @media only screen and (min-width: 1200px) {
            .container {
                max-width: 1170px !important;
            }
        }


        #header {
            background: #fff;
            -webkit-box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.05);
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.05);
        }

        #header .navbar {
            padding: 0px;
        }

        #header.bg-transparent {
            position: absolute;
            z-index: 999;
            top: 0;
            left: 0;
            width: 100%;
            box-shadow: none;
        }

        #header.header-border .header-row {
            border-bottom: 1px solid rgba(250, 250, 250, 0.3);
        }

        #header .logo {
            position: relative;
            float: left;
            margin-right: 15px;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-item-align: stretch;
            align-self: stretch;
        }

        #header .header-row {
            position: relative;
            display: -webkit-box;
            display: -ms-flexbox;
            max-height: 100%;
            display: flex;
            -webkit-box-flex: 1;
            -ms-flex-positive: 1;
            flex-grow: 1;
            -ms-flex-preferred-size: 100%;
            flex-basis: 100%;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            -ms-flex-item-align: stretch;
            align-self: stretch;
        }

        #header .header-column {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-item-align: stretch;
            align-self: stretch;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            -webkit-box-flex: 1;
            -ms-flex-positive: 1;
            flex-grow: 1;
        }

        #header .header-column .header-row {
            -webkit-box-pack: inherit;
            -ms-flex-pack: inherit;
            justify-content: inherit;
        }

        .navbar-light .navbar-nav .active>.nav-link {
            color: #0c2f55;
        }

        .navbar-light .navbar-nav .nav-link.active,
        .navbar-light .navbar-nav .nav-link.show {
            color: #0c2f55;
        }

        .navbar-light .navbar-nav .show>.nav-link {
            color: #0c2f55;
        }

        .primary-menu {
            display: -webkit-box !important;
            display: -ms-flexbox !important;
            display: flex !important;
            height: auto !important;
            -webkit-box-ordinal-group: 0;
            -ms-flex-item-align: stretch;
            align-self: stretch;
        }

        .primary-menu.navbar {
            position: inherit;
        }

        .primary-menu ul.navbar-nav>li {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            height: 100%;
        }

        .primary-menu ul.navbar-nav>li a {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
        }

        .primary-menu ul.navbar-nav>li>a {
            height: 70px;
            padding-left: 0.85em;
            padding-right: 0.85em;
            color: #0c2e53;
            -webkit-transition: all 0.2s ease;
            transition: all 0.2s ease;
            position: relative;
        }

        .primary-menu ul.navbar-nav>li:hover>a,
        .primary-menu ul.navbar-nav>li.active>a {
            color: #0071cc;
            -webkit-transition: all 0.2s ease;
            transition: all 0.2s ease;
        }

        .primary-menu ul.navbar-nav>li.dropdown .dropdown-menu li>a:not(.btn) {
            padding: 5px 0px;
            background-color: transparent;
            color: #777;
            -webkit-transition: all 0.2s ease;
            transition: all 0.2s ease;
        }

        .primary-menu ul.navbar-nav>li.dropdown .dropdown-menu li:hover>a:not(.btn) {
            color: #0071cc;
            -webkit-transition: all 0.2s ease;
            transition: all 0.2s ease;
        }

        .primary-menu ul.navbar-nav>li.dropdown:hover>a:after {
            clear: both;
            content: ' ';
            display: block;
            width: 0;
            height: 0;
            border-style: solid;
            border-color: transparent transparent #ccc transparent;
            position: absolute;
            border-width: 0px 7px 6px 7px;
            bottom: 0px;
            left: 50%;
            margin: 0 0 0 -5px;
            z-index: 1022;
        }

        .primary-menu ul.navbar-nav>li.dropdown .dropdown-menu {
            -webkit-box-shadow: 0px 0px 12px rgba(0, 0, 0, 0.176);
            box-shadow: 0px 0px 12px rgba(0, 0, 0, 0.176);
            border: 0px none;
            border-top: 3px solid #ccc;
            padding: 10px 10px 10px 18px;
            min-width: 230px;
            margin: 0;
            font-size: 13px;
            font-size: 0.8125rem;
            z-index: 1021;
        }

        .primary-menu ul.navbar-nav>li.dropdown-mega {
            position: static;
        }

        .primary-menu ul.navbar-nav>li.dropdown-mega>.dropdown-menu {
            width: 100%;
            padding: 20px 20px;
            margin-left: 0px !important;
        }

        .primary-menu .dropdown-menu-right {
            left: auto !important;
            right: 100% !important;
        }

        .primary-menu ul.navbar-nav>li>.dropdown-menu .row>div {
            border-right: 1px solid #eee;
            padding: 5px 10px 5px 20px;
        }

        .primary-menu ul.navbar-nav>li>.dropdown-menu .row>div:last-child {
            border-right: 0;
        }

        .primary-menu ul.navbar-nav>li .sub-title {
            display: block;
            font-size: 15px;
            margin-top: 1rem;
            padding-bottom: 5px;
        }

        .primary-menu ul.navbar-nav>li .dropdown-mega-submenu {
            list-style-type: none;
            padding-left: 0px;
        }

        .primary-menu ul.navbar-nav>li.dropdown .dropdown-menu .dropdown-menu {
            left: 100%;
            margin-top: -40px;
        }

        .primary-menu ul.navbar-nav>li.dropdown .dropdown-menu .dropdown-toggle:after {
            border-top: .4em solid transparent;
            border-right: 0;
            border-bottom: 0.4em solid transparent;
            border-left: 0.4em solid;
        }

        .primary-menu ul.navbar-nav>li.dropdown .dropdown-toggle .arrow {
            position: absolute;
            min-width: 30px;
            height: 100%;
            right: 0px;
            top: 0;
            -webkit-transition: all 0.2s ease;
            transition: all 0.2s ease;
        }

        .primary-menu ul.navbar-nav>li.dropdown .dropdown-toggle .arrow:after {
            content: " ";
            position: absolute;
            top: 50%;
            left: 50%;
            border-color: #000;
            border-top: 1px solid;
            border-right: 1px solid;
            width: 6px;
            height: 6px;
            -webkit-transform: translate(-50%, -50%) rotate(45deg);
            transform: translate(-50%, -50%) rotate(45deg);
        }

        .primary-menu .dropdown-toggle:after {
            content: none;
        }

        .primary-menu ul.navbar-nav>li.login-signup>a {
            position: relative;
        }

        .primary-menu ul.navbar-nav>li.login-signup>a:before {
            content: '';
            position: absolute;
            display: block;
            border-left: 1px solid #d6dde4;
            height: 24px;
            left: 0;
            top: 50%;
            -webkit-transform: translate3d(0, -50%, 0);
            transform: translate3d(0, -50%, 0);
        }

        .primary-menu ul.navbar-nav>li.login-signup>a span {
            background: #8f9dac;
            color: #fff;
            border-radius: 100%;
            width: 34px;
            height: 34px;
            vertical-align: middle;
            line-height: 34px;
            font-size: 14px;
            text-align: center;
            display: inline-block;
            -webkit-box-shadow: 0px 0px 6px rgba(0, 0, 0, 0.15);
            box-shadow: 0px 0px 6px rgba(0, 0, 0, 0.15);
            margin-left: 0.4rem;
        }

        .header-text-light .navbar-toggler span {
            background: #fff;
        }

        @media (min-width: 992px) {
            .header-text-light .primary-menu ul.navbar-nav>li>a {
                color: rgba(250, 250, 250, 0.8);
            }

            .header-text-light .primary-menu ul.navbar-nav>li.login-signup>a span {
                background: rgba(250, 250, 250, 0.4);
            }

            .header-text-light .primary-menu ul.navbar-nav>li.login-signup>a:before {
                border-color: rgba(250, 250, 250, 0.35);
            }

            .header-text-light .primary-menu ul.navbar-nav>li:hover>a,
            .header-text-light .primary-menu ul.navbar-nav>li.active>a {
                color: #fff;
            }
        }

        .primary-menu.nav-dark-dropdown ul.navbar-nav>li.dropdown .dropdown-menu {
            background-color: #252A2C;
            color: #fff;
            border-color: #252A2C;
        }

        .primary-menu.nav-dark-dropdown ul.navbar-nav>li.dropdown .dropdown-menu .dropdown-menu {
            background-color: #272c2e;
        }

        .primary-menu.nav-dark-dropdown ul.navbar-nav>li.dropdown:hover>a:after {
            border-color: transparent transparent #252A2C transparent;
        }

        .primary-menu.nav-dark-dropdown ul.navbar-nav>li.dropdown .dropdown-menu li>a:not(.btn) {
            color: #a3a2a2;
        }

        .primary-menu.nav-dark-dropdown ul.navbar-nav>li.dropdown .dropdown-menu li:hover>a:not(.btn) {
            color: #fff;
        }

        .primary-menu.nav-dark-dropdown ul.navbar-nav>li .row>div {
            border-color: #3a3a3a;
        }

        .primary-menu.nav-primary-dropdown ul.navbar-nav>li.dropdown .dropdown-menu {
            background-color: #0071cc;
            color: #fff;
            border-color: #0071cc;
        }

        .primary-menu.nav-primary-dropdown ul.navbar-nav>li.dropdown .dropdown-menu .dropdown-menu {
            background-color: #0071cc;
        }

        .primary-menu.nav-primary-dropdown ul.navbar-nav>li.dropdown:hover>a:after {
            border-color: transparent transparent #0071cc transparent;
        }

        .primary-menu.nav-primary-dropdown ul.navbar-nav>li.dropdown .dropdown-menu li>a:not(.btn) {
            color: rgba(250, 250, 250, 0.8);
        }

        .primary-menu.nav-primary-dropdown ul.navbar-nav>li.dropdown .dropdown-menu li:hover>a:not(.btn) {
            color: #fff;
        }

        .primary-menu.nav-primary-dropdown ul.navbar-nav>li .row>div {
            border-color: rgba(250, 250, 250, 0.2);
        }

        @media (max-width: 991px) {

            #header .nav-dark-dropdown.primary-menu:before,
            .primary-menu.nav-dark-dropdown ul.navbar-nav>li.dropdown .dropdown-menu .dropdown-menu {
                background-color: #252A2C;
            }

            #header .nav-primary-dropdown.primary-menu:before {
                background-color: #0071cc;
            }

            .primary-menu.nav-primary-dropdown ul.navbar-nav>li.dropdown .dropdown-menu .dropdown-menu {
                background-color: #0071cc;
            }

            .primary-menu.nav-dark-dropdown ul.navbar-nav li {
                border-color: #444;
            }

            .primary-menu.nav-dark-dropdown ul.navbar-nav>li>a {
                color: #a3a2a2;
            }

            .primary-menu.nav-dark-dropdown ul.navbar-nav>li:hover>a {
                color: #fff;
            }

            .primary-menu.nav-primary-dropdown ul.navbar-nav li {
                border-color: rgba(250, 250, 250, 0.2);
            }

            .primary-menu.nav-primary-dropdown ul.navbar-nav>li>a {
                color: rgba(250, 250, 250, 0.8);
            }

            .primary-menu.nav-primary-dropdown ul.navbar-nav>li:hover>a {
                color: #fff;
            }
        }

        @media (min-width: 992px) {
            .navbar-toggler {
                display: none;
            }

            .primary-menu ul.navbar-nav>li+li {
                margin-left: 2px;
            }

            .primary-menu ul.navbar-nav>li.dropdown .dropdown-menu li:hover>a:not(.btn) {
                margin-left: 5px;
            }

            .primary-menu ul.navbar-nav>li.dropdown .dropdown-menu li:hover>a .arrow {
                right: -3px;
                -webkit-transition: all 0.2s ease;
                transition: all 0.2s ease;
            }

            .primary-menu ul.navbar-nav>li.dropdown>.dropdown-toggle .arrow {
                display: none;
            }

            .primary-menu ul.navbar-nav>li.dropdown-mega .sub-title:first-child {
                margin-top: 0px;
            }

            .primary-menu ul.navbar-nav>li.dropdown .dropdown-menu.dropdown-menu-sm {
                width: 465px;
                padding-right: 18px;
            }

            .primary-menu ul.navbar-nav>li.dropdown .dropdown-menu.dropdown-menu-md {
                width: 700px;
                padding-right: 18px;
            }

            .primary-menu ul.navbar-nav>li.dropdown .dropdown-menu.dropdown-menu-lg {
                width: 920px;
                padding-right: 18px;
            }
        }

        @media (max-width: 991px) {

            .navbar-toggler {
                width: 25px;
                height: 30px;
                padding: 10px;
                margin: 18px 10px;
                position: relative;
                -webkit-transform: rotate(0deg);
                transform: rotate(0deg);
                -webkit-transition: 0.5s ease-in-out;
                transition: 0.5s ease-in-out;
                cursor: pointer;
                display: block;
            }

            .navbar-toggler span {
                display: block;
                position: absolute;
                height: 2px;
                width: 100%;
                background: #3c3636;
                border-radius: 2px;
                opacity: 1;
                left: 0;
                -webkit-transform: rotate(0deg);
                transform: rotate(0deg);
                -webkit-transition: 0.25s ease-in-out;
                transition: 0.25s ease-in-out;
            }

            .navbar-toggler span:nth-child(1) {
                top: 6px;
                -webkit-transform-origin: left center;
                -moz-transform-origin: left center;
                -o-transform-origin: left center;
                transform-origin: left center;
            }

            .navbar-toggler span:nth-child(2) {
                top: 12px;
                -webkit-transform-origin: left center;
                -moz-transform-origin: left center;
                -o-transform-origin: left center;
                transform-origin: left center;
            }

            .navbar-toggler span:nth-child(3) {
                top: 18px;
                -webkit-transform-origin: left center;
                -moz-transform-origin: left center;
                -o-transform-origin: left center;
                transform-origin: left center;
            }

            .navbar-toggler.open span:nth-child(1) {
                top: 5px;
                left: 4px;
                -webkit-transform: rotate(45deg);
                transform: rotate(45deg);
            }

            .navbar-toggler.open span:nth-child(2) {
                width: 0%;
                opacity: 0;
            }

            .navbar-toggler.open span:nth-child(3) {
                top: 21px;
                left: 4px;
                -webkit-transform: rotate(-45deg);
                transform: rotate(-45deg);
            }

            #header .primary-menu {
                position: absolute;
                top: 99%;
                right: 0;
                left: 0;
                background: transparent;
                margin-top: 0px;
                z-index: 1000;
            }

            #header .primary-menu:before {
                content: '';
                display: block;
                position: absolute;
                top: 0;
                left: 50%;
                width: 100vw;
                height: 100%;
                background: #fff;
                z-index: -1;
                -webkit-transform: translateX(-50%);
                transform: translateX(-50%);
                -webkit-box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
                box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
            }

            #header .primary-menu>div {
                overflow: hidden;
                overflow-y: auto;
                max-height: 65vh;
                margin: 18px 0;
            }

            .primary-menu ul.navbar-nav li {
                display: block;
                border-bottom: 1px solid #eee;
                margin: 0;
                padding: 0;
            }

            .primary-menu ul.navbar-nav li:last-child {
                border: none;
            }

            .primary-menu ul.navbar-nav li.dropdown>.dropdown-toggle>.arrow.open:after {
                -webkit-transform: translate(-50%, -50%) rotate(-45deg);
                transform: translate(-50%, -50%) rotate(-45deg);
                -webkit-transition: all 0.2s ease;
                transition: all 0.2s ease;
            }

            .primary-menu ul.navbar-nav>li>a {
                height: auto;
                padding: 8px 0;
                position: relative;
            }

            .primary-menu ul.navbar-nav>li.dropdown .dropdown-menu li>a:not(.btn) {
                padding: 8px 0;
                position: relative;
            }

            .primary-menu ul.navbar-nav>li.dropdown:hover>a:after {
                content: none;
            }

            .primary-menu ul.navbar-nav>li.dropdown .dropdown-toggle .arrow:after {
                -webkit-transform: translate(-50%, -50%) rotate(134deg);
                transform: translate(-50%, -50%) rotate(134deg);
                -webkit-transition: all 0.2s ease;
                transition: all 0.2s ease;
            }

            .primary-menu ul.navbar-nav>li.dropdown .dropdown-menu {
                margin: 0;
                -webkit-box-shadow: none;
                box-shadow: none;
                border: none;
                padding: 0px 15px 0px 15px;
            }

            .primary-menu ul.navbar-nav>li.dropdown .dropdown-menu .dropdown-menu {
                margin: 0;
            }

            .primary-menu ul.navbar-nav>li.dropdown .dropdown-menu .row>div {
                padding: 0px 15px;
                border: none;
            }

            .primary-menu ul.navbar-nav>li.dropdown .dropdown-menu .sub-title {
                margin-top: 10px;
                display: block;
                padding: 0;
            }

            .primary-menu ul.navbar-nav>li.login-signup>a:before {
                content: none;
            }
        }

        .secondary-nav.nav {
            padding-top: 12px;
            padding-bottom: 0px;
            padding-left: 8px;
        }

        .secondary-nav.nav .nav-link {
            text-align: center;
            font-size: 13px;
            font-size: 0.8125rem;
            margin: 0 10px;
            padding: .6rem 15px;
            color: #8298af;
            -webkit-transition: all 0.2s ease;
            transition: all 0.2s ease;
        }

        .secondary-nav.nav .nav-link:hover {
            color: #a6bcd3;
            -webkit-transition: all 0.2s ease;
            transition: all 0.2s ease;
        }

        .secondary-nav.nav .nav-item:first-child .nav-link {
            margin-left: 0px;
        }

        .secondary-nav.nav .nav-link span {
            display: block;
            font-size: 30px;
            margin-bottom: 5px;
        }

        .secondary-nav.nav .nav-item .nav-link.active {
            background: #fff;
            color: #0071cc;
            border-radius: 4px 4px 0px 0px;
        }

        .secondary-nav.nav.alternate {
            margin-bottom: 10px;
        }

        .secondary-nav.nav.alternate .nav-link {
            padding: .3rem 15px;
        }

        .secondary-nav.nav.alternate .nav-item .nav-link.active {
            background-color: transparent;
            color: #fff;
            border-bottom: 3px solid #0071cc;
        }

        @media (max-width: 1199px) {
            .secondary-nav.nav {
                flex-wrap: nowrap;
                overflow: hidden;
                overflow-x: auto;
                -ms-overflow-style: -ms-autohiding-scrollbar;
                -webkit-overflow-scrolling: touch;
            }
        }

        .page-header {
            margin: 0 0 30px 0;
            padding: 25px 0;
        }

        .page-header h1 {
            font-weight: normal;
            font-size: 25px;
            margin: 0;
            padding: 5px 0;
        }

        .page-header .breadcrumb {
            background: none;
            margin: 0 0 8px 2px;
            padding: 0;
            position: relative;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            justify-content: center;
        }

        .page-header .breadcrumb>li {
            display: inline-block;
            font-size: 0.85em;
            text-shadow: none;
            -webkit-transition: all 0.2s ease;
            transition: all 0.2s ease;
        }

        .page-header .breadcrumb>li+li:before {
            color: inherit;
            opacity: 0.7;
            font-family: 'Font Awesome 5 Free';
            content: "\f105";
            padding: 0 7px 0 5px;
            font-weight: 900;
        }

        .page-header .breadcrumb>li a {
            -webkit-transition: all 0.2s ease;
            transition: all 0.2s ease;
        }

        .page-header .breadcrumb>li a:hover {
            -webkit-transition: all 0.2s ease;
            transition: all 0.2s ease;
        }

        .page-header.page-header-text-light {
            color: #fff;
        }

        .page-header.page-header-text-light h1 {
            color: #fff;
        }

        .page-header.page-header-text-light .breadcrumb>li {
            color: rgba(250, 250, 250, 0.8);
        }

        .page-header.page-header-text-light .breadcrumb>li a {
            color: rgba(250, 250, 250, 0.8);
        }

        .page-header.page-header-text-light .breadcrumb>li a:hover {
            color: #fff;
        }

        .page-header.page-header-text-dark h1 {
            color: #0c2f54;
        }

        .page-header.page-header-text-dark .breadcrumb>li {
            color: #707070;
        }

        .page-header.page-header-text-dark .breadcrumb>li a {
            color: #707070;
        }

        .page-header.page-header-text-dark .breadcrumb>li a:hover {
            color: #0071cc;
        }

        .view-plans-link {
            position: absolute;
            right: 0px;
            z-index: 4;
            line-height: 50px;
            padding: 0 15px;
            font-size: 13px;
            text-decoration: underline;
        }

        .plans {
            max-height: 380px;
            overflow: hidden;
            overflow-y: auto;
        }

        .plans.page {
            max-height: 617px;
        }

        @media (min-width: 768px) {

            .plans .table.table-lg td,
            .plans .table.table-lg th {
                padding: 1.8rem;
            }
        }

        .operator-selection .custom-control-label {
            padding-bottom: 1.5rem;
        }

        .operator-selection .custom-control-label:after,
        .operator-selection .custom-control-label:before {
            top: auto;
            bottom: 0rem;
            left: calc(50% - 0.5rem);
        }




        .travellers-class {
            position: relative;
        }

        .travellers-class-input {
            cursor: pointer;
        }

        .travellers-class-input[readonly] {
            background: #fff;
        }

        .travellers-dropdown {
            position: absolute;
            display: none;
            -webkit-box-shadow: 0px 2px 12px rgba(0, 0, 0, 0.176);
            box-shadow: 0px 2px 12px rgba(0, 0, 0, 0.176);
            z-index: 11;
            background: #fff;
            padding: 20px;
            border-radius: 4px;
            min-width: 300px;
            width: 100%;
        }

        .travellers-dropdown .qty .qty-spinner {
            background: none;
            border: none;
            pointer-events: none;
            text-align: center;
            padding: .2rem .2rem;
        }

        .travellers-dropdown .qty .btn {
            padding-top: .2rem;
            padding-bottom: .2rem;
            border-radius: 0.25rem !important;
        }

        @media (max-width: 991px) {
            .travellers-dropdown {
                min-width: inherit;
            }
        }

        .icon-inside {
            position: absolute;
            right: 15px;
            top: calc(50% - 11px);
            pointer-events: none;
            font-size: 18px;
            font-size: 1.125rem;
            color: #c4c3c3;
            z-index: 3;
        }

        .form-control-sm+.icon-inside {
            font-size: 0.875rem !important;
            font-size: 14px;
            top: calc(50% - 13px);
        }

        .flight-list .flight-item,
        .train-list .train-item,
        .bus-list .bus-item {
            position: relative;
            border-bottom: 1px solid #e9e9e9;
        }

        .flight-list .flight-item .flight-details .time-info small {
            line-height: 15px;
        }

        .flight-list.round-trip .flight-item .company-info span,
        .flight-list.round-trip .flight-item .time-info small {
            line-height: 15px;
        }

        .round-trip-fare small {
            line-height: 14px;
        }

        .round-trip-fare .company-info img {
            min-width: 26px;
        }

        .confirm-details .company-info {
            line-height: 15px;
        }

        .confirm-details .company-info img {
            min-width: 26px;
        }

        .confirm-details .time-info small {
            line-height: 15px;
        }

        .promo-code {
            max-height: 150px;
            padding-left: 30px;
        }

        .promo-code li {
            margin-bottom: 10px;
        }

        .train-list .train-item .time-info small,
        .bus-list .bus-item .time-info small {
            line-height: 15px;
        }

        .date-available {
            border: 1px solid #dee2e6;
            list-style-type: none;
            margin: 0;
            padding: 0;
            flex-wrap: nowrap;
            overflow: hidden;
            overflow-x: auto;
            -ms-overflow-style: -ms-autohiding-scrollbar;
            -webkit-overflow-scrolling: touch;
        }

        .date-available li {
            flex: 1 1 auto !important;
            -ms-flex: 1 1 auto !important;
        }

        .date-available li+li {
            border-left: 1px solid #dee2e6;
        }

        body {
            position: relative;
        }

        .location-brief-line {
            position: absolute;
            top: 7px;
            bottom: -31px;
            left: 1px;
            width: 5px;
            border-right: 2px solid #cbd7e0;
        }

        .location-brief-pickup {
            background: #cbd7e0;
            border-radius: 50%;
            width: 8px;
            height: 8px;
            display: inline-block;
            position: absolute;
            left: 0px;
        }

        .location-brief-dropoff {
            background: #cbd7e0;
            border-radius: 50%;
            width: 8px;
            height: 8px;
            display: inline-block;
            position: absolute;
            left: 0px;
            bottom: 0px;
        }


        .hotels-list .hotels-item,
        .car-list .car-item {
            position: relative;
            margin-bottom: 1rem;
        }

        .hotels-amenities span,
        .car-features span {
            margin-right: .7rem;
            color: rgba(0, 0, 0, 0.4) !important;
        }

        .hotels-amenities span.cf {
            color: rgba(0, 0, 0, 0.5) !important;
            border-color: rgba(0, 0, 0, 0.3) !important;
            line-height: normal;
        }

        .hotels-amenities span.disabled {
            color: rgba(0, 0, 0, 0.1) !important;
            cursor: not-allowed;
        }

        .hotels-amenities-detail {
            display: -ms-flexbox;
            display: flex;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
        }

        .hotels-amenities-detail span {
            width: 50px;
            height: 50px;
            line-height: 50px;
            text-align: center;
            margin-right: 10px;
            margin-bottom: 10px;
            color: #888;
        }

        .reviews .reviews-score {
            background: #3FC299;
        }

        .review-tumb {
            width: 60px;
            height: 60px;
            line-height: 60px;
        }

        @media (max-width: 991px) {
            .flight-list .flight-item .flight-details .nav-tabs .nav-item .nav-link {
                font-size: 0.875rem;
                padding: .5rem 0.5rem;
            }

            .round-trip-fare .price {
                font-size: 18px !important;
            }

            .round-trip-fare .time-info span {
                font-size: 15px !important;
            }

            .confirm-details .date {
                font-size: 14px !important;
            }

            .confirm-details .trip-title .trip-arrow {
                font-size: 31px !important;
            }

            .confirm-details .trip-title .trip-place {
                font-size: 15px !important;
            }

            .train-list .train-item .time-info .duration,
            .bus-list .bus-item .time-info .duration {
                font-size: 13px !important;
            }

            .train-list .train-item .train-name,
            .bus-list .bus-item .operator-name {
                font-size: 15px !important;
            }
        }

        @media (max-width: 575px) {
            .flight-list:not(.round-trip) .flight-item .company-info span {
                line-height: 15px;
            }

            .flight-list:not(.round-trip) .flight-item .time-info span {
                font-size: 12px !important;
            }

            .flight-list:not(.round-trip) .flight-item .price {
                font-size: 13px !important;
            }

            .flight-list:not(.round-trip) .flight-item .btn-book .btn {
                width: 100%;
                margin-top: 5px;
            }

            .flight-list:not(.round-trip) .flight-item .flight-details .time-info span {
                font-size: 22px !important;
            }

            .flight-list .flight-item .flight-details .trip-title .trip-place {
                font-size: 15px !important;
            }

            .flight-list .flight-item .flight-details .trip-title .trip-arrow {
                font-size: 31px !important;
            }

            .round-trip-fare .price {
                font-size: 16px !important;
            }

            .round-trip-fare .time-info span {
                font-size: 13px !important;
            }

            .confirm-details .trip-title .trip-arrow {
                font-size: 22px !important;
            }

            .confirm-details .date {
                font-size: 13px !important;
            }
        }

        .invoice-container {
            margin: 15px auto;
            padding: 20px;
            max-width: 850px;
            background-color: #fff;
            border: 1px solid #ccc;
            -moz-border-radius: 6px;
            -webkit-border-radius: 6px;
            -o-border-radius: 6px;
            border-radius: 6px;
        }

        @media (max-width: 767px) {
            .invoice-container {
                padding: 35px 20px 70px 20px;
                margin-top: 0px;
                border: none;
                border-radius: 0px;
            }
        }



        .featured-box {
            box-sizing: border-box;
            margin-left: auto;
            margin-right: auto;
            position: relative;
        }

        .featured-box h3,
        .featured-box h4 {
            font-size: 1.25rem;
            margin-bottom: 10px;
            font-weight: 500;
        }

        .featured-box .featured-box-icon {
            display: inline-block;
            font-size: 35px;
            height: 45px;
            line-height: 45px;
            padding: 0;
            width: 45px;
            margin-top: 0;
            margin-bottom: 12px;
            color: #546d89;
            border-radius: 0;
        }

        .featured-box.style-1,
        .featured-box.style-2,
        .featured-box.style-3 {
            padding-left: 50px;
            padding-top: 8px;
        }

        .featured-box.style-1 .featured-box-icon,
        .featured-box.style-2 .featured-box-icon,
        .featured-box.style-3 .featured-box-icon {
            position: absolute;
            top: 0;
            left: 0;
            margin-bottom: 0;
            font-size: 30px;
            -ms-flex-pack: center !important;
            justify-content: center !important;
            text-align: center;
        }

        .featured-box.style-2 p {
            margin-left: -50px;
        }

        .featured-box.style-3 {
            padding-left: 90px;
            padding-top: 0px;
        }

        .featured-box.style-3 .featured-box-icon {
            width: 70px;
            height: 70px;
            -ms-flex-negative: 0;
            flex-shrink: 0;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
        }

        .featured-box.style-4 {
            text-align: center;
        }

        .featured-box.style-4 .featured-box-icon {
            margin: 0 auto 24px;
            margin: 0 auto 1.5rem;
            width: 110px;
            height: 110px;
            text-align: center;
            -ms-flex-negative: 0;
            flex-shrink: 0;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            -webkit-box-shadow: 0px 0px 50px rgba(0, 0, 0, 0.03);
            box-shadow: 0px 0px 50px rgba(0, 0, 0, 0.03);
        }

        .featured-box.style-4 .featured-box-icon i.fa,
        .featured-box.style-4 .featured-box-icon i.fas,
        .featured-box.style-4 .featured-box-icon i.far,
        .featured-box.style-4 .featured-box-icon i.fal,
        .featured-box.style-4 .featured-box-icon i.fab {
            font-size: 46.4px;
            font-size: 2.9rem;
            margin: 0 auto;
        }


        .team {
            text-align: center;
            margin-bottom: 15px;
            padding: 15px;
            -webkit-transition: all 0.2s ease;
            transition: all 0.2s ease;
        }

        .team:hover {
            -webkit-box-shadow: 0px 0px 60px 0px rgba(0, 0, 0, 0.15);
            box-shadow: 0px 0px 60px 0px rgba(0, 0, 0, 0.15);
            -webkit-transition: all 0.2s ease;
            transition: all 0.2s ease;
        }

        .team img {
            margin-bottom: 20px;
        }

        .team h3 {
            font-size: 18px;
            margin-bottom: 0px;
        }

        .team p {
            margin-bottom: 0.5rem;
        }


        .accordion .card {
            border: none;
            margin-bottom: 8px;
            margin-bottom: 0.5rem;
            background-color: transparent;
        }

        .accordion .card-header {
            padding: 0;
            border: none;
            background: none;
        }

        .accordion .card-header a {
            font-size: 14px;
            padding: 1rem 1.25rem 1rem 2.25rem;
            display: block;
            border-radius: 4px;
            position: relative;
        }

        .accordion:not(.accordion-alternate) .card-header a {
            background-color: #0071cc;
            color: #fff;
        }

        .accordion:not(.accordion-alternate) .card-header a.collapsed {
            background-color: #f1f2f4;
            color: #535b61;
        }

        .accordion .card-header a:before {
            position: absolute;
            content: " ";
            left: 20px;
            top: calc(50% + 2px);
            width: 8px;
            height: 8px;
            border-color: #CCC;
            border-top: 2px solid;
            border-right: 2px solid;
            -webkit-transform: translate(-50%, -50%) rotate(-45deg);
            transform: translate(-50%, -50%) rotate(-45deg);
            -webkit-transition: all 0.2s ease;
            transition: all 0.2s ease;
            -webkit-backface-visibility: hidden;
            backface-visibility: hidden;
        }

        .accordion .card-header a.collapsed:before {
            top: calc(50% - 2px);
            -webkit-transform: translate(-50%, -50%) rotate(135deg);
            transform: translate(-50%, -50%) rotate(135deg);
        }

        .accordion .card-body {
            line-height: 26px;
            padding: 1rem 0 1rem 2.25rem;
        }

        .accordion.accordion-alternate .card {
            margin: 0;
        }

        .accordion.accordion-alternate .card-header a {
            padding-left: 1.25rem;
            border-top: 1px solid #e4e9ec;
            border-radius: 0px;
        }

        .accordion.accordion-alternate .card:first-of-type .card-header a {
            border-top: 0px;
        }

        .accordion.accordion-alternate .card-header a:before {
            left: 5px;
        }

        .accordion.accordion-alternate .card-header a.collapsed {
            color: #535b61;
        }

        .accordion.accordion-alternate .card-body {
            padding: 0rem 0 1rem 1.25rem;
        }

        .accordion.toggle .card-header a:before {
            content: "-";
            border: none;
            font-size: 20px;
            height: auto;
            top: 50%;
            width: auto;
            -webkit-transform: translate(-50%, -50%) rotate(180deg);
            transform: translate(-50%, -50%) rotate(180deg);
        }

        .accordion.toggle .card-header a.collapsed:before {
            content: "+";
            -webkit-transform: translate(-50%, -50%) rotate(0deg);
            transform: translate(-50%, -50%) rotate(0deg);
        }

        .accordion.accordion-alternate.style-2 .card-header a {
            padding-left: 0px;
        }

        .accordion.accordion-alternate.style-2 .card-header a:before {
            right: 2px;
            left: auto;
            -webkit-transform: translate(-50%, -50%) rotate(135deg);
            transform: translate(-50%, -50%) rotate(135deg);
            top: 50%;
        }

        .accordion.accordion-alternate.style-2 .card-header a.collapsed:before {
            -webkit-transform: translate(-50%, -50%) rotate(45deg);
            transform: translate(-50%, -50%) rotate(45deg);
        }

        .accordion.accordion-alternate.style-2 .card-body {
            padding-left: 0px;
        }

        .accordion.accordion-alternate.popularRoutes .card-header .nav {
            margin-top: 3px;
        }

        .accordion.accordion-alternate.popularRoutes .card-header .nav a {
            font-size: 14px;
        }

        .accordion.accordion-alternate.popularRoutes .card-header a {
            padding: 0px 8px 0px 0px;
            border: none;
            font-size: inherit;
        }

        .accordion.accordion-alternate.popularRoutes .card-header a:before {
            content: none;
        }

        .accordion.accordion-alternate.popularRoutes .card-header h5 {
            cursor: pointer;
        }

        .accordion.accordion-alternate.popularRoutes .card-header h5:before {
            position: absolute;
            content: " ";
            right: 0px;
            top: 24px;
            width: 10px;
            height: 10px;
            opacity: 0.6;
            border-top: 2px solid;
            border-right: 2px solid;
            -webkit-transform: translate(-50%, -50%) rotate(-45deg);
            transform: translate(-50%, -50%) rotate(-45deg);
            -webkit-transition: all 0.2s ease;
            transition: all 0.2s ease;
            -webkit-backface-visibility: hidden;
            backface-visibility: hidden;
        }

        .accordion.accordion-alternate.popularRoutes .card-header h5.collapsed:before {
            top: 24px;
            -webkit-transform: translate(-50%, -50%) rotate(135deg);
            transform: translate(-50%, -50%) rotate(135deg);
        }

        .accordion.accordion-alternate.popularRoutes .card-body {
            padding: 0;
        }

        .accordion.accordion-alternate.popularRoutes .card {
            border-bottom: 2px solid #e4e9ec;
            padding: 15px 0px;
        }

        .accordion.accordion-alternate.popularRoutes .routes-list {
            margin: 1rem 0px 0px 0px;
            padding: 0px;
            list-style: none;
        }

        .accordion.accordion-alternate.popularRoutes .routes-list a {
            color: inherit;
            display: -ms-flexbox !important;
            display: flex !important;
            -ms-flex-align: center !important;
            align-items: center !important;
        }

        .accordion.accordion-alternate.popularRoutes .routes-list a:hover {
            color: #0071cc;
            text-decoration: underline;
        }


        .nav-pills .nav-link i {
            margin-right: 8px;
        }

        .nav-pills.alternate .nav-link {
            color: #535b61;
        }

        .nav-pills.alternate .nav-link.active {
            color: #fff;
        }

        .nav-pills.alternate .nav-link:not(.active):hover {
            color: #0071cc;
        }

        .nav-pills.flex-column.alternate .nav-link {
            position: relative;
        }

        .nav-pills.flex-column.alternate .nav-link:before {
            position: absolute;
            content: " ";
            right: 10px;
            top: 18px;
            width: 8px;
            height: 8px;
            border-color: #CCC;
            border-top: 2px solid;
            border-right: 2px solid;
            -webkit-transform: translate(-50%, -50%) rotate(45deg);
            transform: translate(-50%, -50%) rotate(45deg);
            -webkit-transition: all 0.2s ease;
            transition: all 0.2s ease;
            -webkit-backface-visibility: hidden;
            backface-visibility: hidden;
            opacity: 0.6;
        }

        .nav-pills.flex-column.alternate .nav-link.active:before {
            opacity: 1;
        }


        .nav-tabs {
            border-bottom: 1px solid #d7dee3;
        }

        .nav-tabs .nav-item .nav-link {
            border: 0;
            background: transparent;
            font-size: 1rem;
            position: relative;
            border-radius: 0;
            color: #7b8084;
            white-space: nowrap !important;
        }

        .nav-tabs .nav-item .nav-link i {
            margin-right: 8px;
        }

        .nav-tabs .nav-item .nav-link.active {
            color: #0c2f55;
        }

        .nav-tabs .nav-item .nav-link.active:after {
            height: 3px;
            width: 100%;
            content: ' ';
            background-color: #0071cc;
            display: block;
            position: absolute;
            bottom: -3px;
            left: 0;
            -webkit-transform: translateY(-3px);
            transform: translateY(-3px);
        }

        .nav-tabs.flex-column {
            border-right: 1px solid #d7dee3;
            border-bottom: 0px;
            padding: 1.5rem 0;
        }

        .nav-tabs.flex-column .nav-item .nav-link {
            border: 1px solid #d7dee3;
            border-right: 0px;
            background-color: #f6f7f8;
            font-size: 14px;
            padding: 0.75rem 1rem;
            color: #535b61;
        }

        .nav-tabs.flex-column .nav-item:first-of-type .nav-link {
            border-top-left-radius: 4px;
        }

        .nav-tabs.flex-column .nav-item:last-of-type .nav-link {
            border-bottom-left-radius: 4px;
        }

        .nav-tabs.flex-column .nav-item .nav-link.active {
            background-color: transparent;
            color: #0071cc;
        }

        .nav-tabs.flex-column .nav-item .nav-link.active:after {
            height: 100%;
            width: 2px;
            background: #fff;
            right: -1px;
            left: auto;
        }

        .nav-tabs.style-2 {
            background: rgba(0, 0, 0, 0.4);
            border-radius: 4px 4px 0px 0px;
            border: 0px;
        }

        .nav-tabs.style-2 .nav-item {
            margin-bottom: 0px;
        }

        .nav-tabs.style-2 .nav-item .nav-link {
            color: #fff;
            font-size: 13px;
            padding: 0.7rem 1rem;
            text-transform: uppercase;
        }

        .nav-tabs.style-2 .nav-item .nav-link:hover {
            background: rgba(250, 250, 250, 0.2);
        }

        .nav-tabs.style-2 .nav-item .nav-link.active,
        .nav-tabs.style-2 .nav-item .nav-link:hover.active {
            background: #0071cc;
        }

        .nav-tabs.style-2 .nav-item .nav-link.active:after {
            content: none;
        }

        .nav-tabs.style-3 {
            border: none;
            margin-bottom: 8px;
        }

        .nav-tabs.style-3.border-bottom {
            border-bottom: 1px solid rgba(250, 250, 250, 0.3) !important;
        }

        .nav-tabs.style-4.border-bottom {
            border-bottom: 1px solid rgba(250, 250, 250, 0.3) !important;
        }

        .nav-tabs.style-3 .nav-item .nav-link {
            color: #8298af;
            margin: 0 10px;
            padding: 0.6rem 0.9375rem;
            text-align: center;
            font-size: 13px;
            font-size: 0.8125rem;
        }

        .nav-tabs.style-3 .nav-item:first-child .nav-link {
            margin-left: 0px;
        }

        .nav-tabs.style-3 .nav-item .nav-link.active {
            color: #fff;
        }

        .nav-tabs.style-2 .nav-item .nav-link:hover.active {
            color: #fff;
        }

        .nav-tabs.style-3 .nav-item .nav-link:hover {
            color: #a6bcd3;
        }

        .nav-tabs.style-3 .nav-item .nav-link.active:after {
            height: 3px;
        }

        .nav-tabs.style-3 .nav-item .nav-link span {
            display: block;
            font-size: 30px;
            margin-bottom: 5px;
        }

        .nav-tabs.style-4 {
            border: none;
        }

        .nav-tabs.style-4 .nav-item {
            margin-right: 20px;
        }

        .nav-tabs.style-4 .nav-item .nav-link {
            color: #fff;
            opacity: 0.65;
            filter: alpha(opacity=65);
            text-align: center;
            font-size: 20px;
            padding-left: 0px;
            padding-right: 0px;
            padding-bottom: .7rem;
            font-weight: 500;
        }

        .nav-tabs.style-4 .nav-item .nav-link.active,
        .nav-tabs.style-4 .nav-item .nav-link:hover.active {
            color: #fff;
            opacity: 1;
            filter: alpha(opacity=100);
        }

        .nav-tabs.style-4 .nav-item .nav-link.active::after {
            content: none;
        }

        .nav-tabs:not(.flex-column) {
            margin-bottom: 0px;
        }

        .nav-tabs:not(.flex-column) {
            border-bottom: 1px solid #d7dee3;
            flex-wrap: nowrap;
            overflow: hidden;
            overflow-x: auto;
            -ms-overflow-style: -ms-autohiding-scrollbar;
            -webkit-overflow-scrolling: touch;
        }

        @media (min-width: 576px) {
            .nav-pills.flex-sm-column.alternate .nav-link {
                position: relative;
            }

            .nav-pills.flex-sm-column.alternate .nav-link:before {
                position: absolute;
                content: " ";
                right: 10px;
                top: 18px;
                width: 8px;
                height: 8px;
                border-color: #CCC;
                border-top: 2px solid;
                border-right: 2px solid;
                -webkit-transform: translate(-50%, -50%) rotate(45deg);
                transform: translate(-50%, -50%) rotate(45deg);
                -webkit-transition: all 0.2s ease;
                transition: all 0.2s ease;
                -webkit-backface-visibility: hidden;
                backface-visibility: hidden;
                opacity: 0.6;
            }

            .nav-pills.flex-sm-column.alternate .nav-link.active:before {
                opacity: 1;
            }

            .nav-tabs.flex-sm-column {
                border-right: 1px solid #d7dee3;
                border-bottom: 0px;
                padding: 1.5rem 0;
                flex-wrap: inherit;
                overflow: inherit;
                overflow-x: inherit;
            }

            .nav-tabs.flex-sm-column .nav-item .nav-link {
                border: 1px solid #d7dee3;
                border-right: 0px;
                background-color: #f6f7f8;
                font-size: 14px;
                padding: 0.75rem 1rem;
                color: #535b61;
            }

            .nav-tabs.flex-sm-column .nav-item:first-of-type .nav-link {
                border-top-left-radius: 4px;
            }

            .nav-tabs.flex-sm-column .nav-item:last-of-type .nav-link {
                border-bottom-left-radius: 4px;
            }

            .nav-tabs.flex-sm-column .nav-item .nav-link.active {
                background-color: transparent;
                color: #0071cc;
            }

            .nav-tabs.flex-sm-column .nav-item .nav-link.active:after {
                height: 100%;
                width: 2px;
                background: #fff;
                right: -1px;
                left: auto;
            }
        }

        @media (min-width: 768px) {
            .nav-pills.flex-md-column.alternate .nav-link {
                position: relative;
            }

            .nav-pills.flex-md-column.alternate .nav-link:before {
                position: absolute;
                content: " ";
                right: 10px;
                top: 18px;
                width: 8px;
                height: 8px;
                border-color: #CCC;
                border-top: 2px solid;
                border-right: 2px solid;
                -webkit-transform: translate(-50%, -50%) rotate(45deg);
                transform: translate(-50%, -50%) rotate(45deg);
                -webkit-transition: all 0.2s ease;
                transition: all 0.2s ease;
                -webkit-backface-visibility: hidden;
                backface-visibility: hidden;
                opacity: 0.6;
            }

            .nav-pills.flex-md-column.alternate .nav-link.active:before {
                opacity: 1;
            }

            .nav-tabs.flex-md-column {
                border-right: 1px solid #d7dee3;
                border-bottom: 0px;
                padding: 1.5rem 0;
                flex-wrap: inherit;
                overflow: inherit;
                overflow-x: inherit;
            }

            .nav-tabs.flex-md-column .nav-item .nav-link {
                border: 1px solid #d7dee3;
                border-right: 0px;
                background-color: #f6f7f8;
                font-size: 14px;
                padding: 0.75rem 1rem;
                color: #535b61;
            }

            .nav-tabs.flex-md-column .nav-item:first-of-type .nav-link {
                border-top-left-radius: 4px;
            }

            .nav-tabs.flex-md-column .nav-item:last-of-type .nav-link {
                border-bottom-left-radius: 4px;
            }

            .nav-tabs.flex-md-column .nav-item .nav-link.active {
                background-color: transparent;
                color: #0071cc;
            }

            .nav-tabs.flex-md-column .nav-item .nav-link.active:after {
                height: 100%;
                width: 2px;
                background: #fff;
                right: -1px;
                left: auto;
            }
        }

        @media (min-width: 992px) {
            .nav-pills.flex-lg-column.alternate .nav-link {
                position: relative;
            }

            .nav-pills.flex-lg-column.alternate .nav-link:before {
                position: absolute;
                content: " ";
                right: 10px;
                top: 18px;
                width: 8px;
                height: 8px;
                border-color: #CCC;
                border-top: 2px solid;
                border-right: 2px solid;
                -webkit-transform: translate(-50%, -50%) rotate(45deg);
                transform: translate(-50%, -50%) rotate(45deg);
                -webkit-transition: all 0.2s ease;
                transition: all 0.2s ease;
                -webkit-backface-visibility: hidden;
                backface-visibility: hidden;
                opacity: 0.6;
            }

            .nav-pills.flex-lg-column.alternate .nav-link.active:before {
                opacity: 1;
            }

            .nav-tabs.flex-lg-column {
                border-right: 1px solid #d7dee3;
                border-bottom: 0px;
                padding: 1.5rem 0;
                flex-wrap: inherit;
                overflow: inherit;
                overflow-x: inherit;
            }

            .nav-tabs.flex-lg-column .nav-item .nav-link {
                border: 1px solid #d7dee3;
                border-right: 0px;
                background-color: #f6f7f8;
                font-size: 14px;
                padding: 0.75rem 1rem;
                color: #535b61;
            }

            .nav-tabs.flex-lg-column .nav-item:first-of-type .nav-link {
                border-top-left-radius: 4px;
            }

            .nav-tabs.flex-lg-column .nav-item:last-of-type .nav-link {
                border-bottom-left-radius: 4px;
            }

            .nav-tabs.flex-lg-column .nav-item .nav-link.active {
                background-color: transparent;
                color: #0071cc;
            }

            .nav-tabs.flex-lg-column .nav-item .nav-link.active:after {
                height: 100%;
                width: 2px;
                background: #fff;
                right: -1px;
                left: auto;
            }
        }

        @media (max-width: 575px) {
            .nav-tabs .nav-item .nav-link {
                padding-left: 0px;
                padding-right: 0px;
                margin-right: 10px;
                font-size: 0.875rem;
            }
        }

        @media (min-width: 992px) {
            .search-input-2 .form-control {
                border-radius: 0px;
            }

            .search-input-2 .custom-select:not(.custom-select-sm) {
                border-radius: 0px;
                height: calc(3.05rem);
            }

            .search-input-2 .btn {
                border-radius: 0px;
            }

            .search-input-2 .form-group:first-child .form-control,
            .search-input-2 .form-group:first-child .custom-select {
                border-top-left-radius: 4px;
                border-bottom-left-radius: 4px;
            }

            .search-input-2 .form-group:last-child .btn {
                border-top-right-radius: 4px;
                border-bottom-right-radius: 4px;
            }

            .search-input-2 .form-control:focus,
            .search-input-2 .custom-select:focus {
                box-shadow: none;
                -webkit-box-shadow: none;
            }

            .search-input-2 .form-group .form-control,
            .search-input-2 .custom-select {
                border-left: none;
                border-top: none;
                border-bottom: none;
            }

        }

        @media all and (min-width: 992px) and (-webkit-min-device-pixel-ratio: 0) and (min-resolution: 0.001dpcm) {

            .search-input-2 .selector:not(*:root),
            .search-input-2 .custom-select:not(.custom-select-sm) {
                height: calc(3.00rem);
            }

            .search-input-2 .selector:not(*:root),
            .search-input-2 .btn:not(.btn-sm) {
                line-height: inherit;
            }
        }

        @media (min-width: 992px) {
            @-moz-document url-prefix() {
                .search-input-2 .custom-select:not(.custom-select-sm) {
                    height: calc(3.05rem);
                }

                .search-input-2 .btn {
                    line-height: 1.4;
                }
            }
        }

        .search-input-line .form-control {
            background-color: transparent;
            border: none;
            border-bottom: 2px solid rgba(250, 250, 250, 0.5);
            border-radius: 0px;
            padding-left: 0px !important;
            color: #ccc;
        }

        .search-input-line .form-control::-webkit-input-placeholder {
            color: #ccc;
        }

        .search-input-line .form-control:-moz-placeholder {
            color: #ccc;
        }

        .search-input-line .form-control::-moz-placeholder {
            color: #ccc;
        }

        .search-input-line .form-control:-ms-input-placeholder,
        .search-input-line .form-control::-ms-input-placeholder {
            color: #ccc;
        }

        .search-input-line .custom-select {
            background-color: transparent;
            border: none;
            border-bottom: 2px solid rgba(250, 250, 250, 0.5);
            border-radius: 0px;
            padding-left: 0px;
            color: #ccc;
            background: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 4 5'%3E%3Cpath fill='rgba(250,250,250,0.6)' d='M2 0L0 2h4zm0 5L0 3h4z'/%3E%3C/svg%3E") no-repeat right 0.75rem center;
            background-size: 13px 15px;
        }

        .search-input-line .form-control:focus,
        .search-input-line .custom-select:focus {
            box-shadow: none;
            -webkit-box-shadow: none;
        }

        .search-input-line .form-control:not(output):-moz-ui-invalid:not(:focus),
        .search-input-line .form-control:not(output):-moz-ui-invalid:-moz-focusring:not(:focus) {
            border-bottom: 2px solid #b00708;
            box-shadow: none;
            -webkit-box-shadow: none;
        }

        .search-input-line .icon-inside {
            color: #999;
        }

        .search-input-line select option {
            color: #333;
        }

        .search-input-line .travellers-dropdown input {
            color: #666;
        }

        .resp-htabs ul.resp-tabs-list {
            margin: 0px;
            padding: 0px;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
            list-style: none;
            border-bottom: 1px solid #d7dee3;
        }

        .resp-tabs-list li {
            padding: .5rem 1rem !important;
            margin: 0;
            list-style: none;
            cursor: pointer;
        }

        h2.resp-accordion {
            cursor: pointer;
            padding: 5px;
            display: none;
        }

        .resp-tab-content {
            display: none;
            padding: 15px;
        }

        .resp-tab-active {
            margin-bottom: -1px !important;
            border-bottom: 2px solid #0071cc;
        }

        .resp-content-active,
        .resp-accordion-active {
            display: block;
        }

        h2.resp-accordion {
            font-size: 16px;
            color: #777;
            border: 1px solid #e4e9ec;
            border-top: 0px solid #e4e9ec;
            margin: 0px;
            padding: 1rem 1.25rem;
        }

        h2.resp-tab-active {
            border-bottom: 0px solid #e4e9ec !important;
            margin-bottom: 0px !important;
            padding: 1rem 1.25rem !important;
        }

        h2.resp-tab-title:last-child {
            border-bottom: 12px solid #e4e9ec !important;
            background: blue;
        }

        .resp-vtabs ul.resp-tabs-list {
            margin: 0;
            padding: 0;
        }

        .resp-vtabs .resp-tabs-list li {
            display: block;
            padding: 15px 15px !important;
            margin: 0;
            cursor: pointer;
            font-size: 16px;
            color: #999;
            border: none;
            -webkit-transition: all 0.2s ease;
            transition: all 0.2s ease;
        }

        .resp-vtabs .resp-tabs-list li:hover {
            color: #555;
            -webkit-transition: all 0.2s ease;
            transition: all 0.2s ease;
        }

        .resp-vtabs .resp-tabs-list li span {
            font-size: 20px;
            text-align: center;
            width: 30px;
            display: inline-block;
            float: left;
            margin-right: 15px;
        }

        h2.resp-accordion span {
            font-size: 20px;
            text-align: center;
            width: 30px;
            display: inline-block;
            float: left;
            margin-right: 15px;
        }

        .resp-vtabs .resp-tabs-container {
            padding: 0px;
        }

        .resp-vtabs .resp-tab-content {
            border: none;
        }

        .resp-vtabs li.resp-tab-active,
        .resp-vtabs li.resp-tab-active:hover {
            color: #0071cc;
            -webkit-box-shadow: -5px 0px 24px -18px rgba(0, 0, 0, 0.4);
            box-shadow: -5px 0px 24px -18px rgba(0, 0, 0, 0.4);
            border-radius: 4px 0px 0px 4px;
            background-color: #fff;
            position: relative;
            z-index: 1;
            margin-right: -1px !important;
            margin-bottom: 0px !important;
        }

        .resp-arrow {
            width: 0;
            height: 0;
            float: right;
            margin-top: 6px;
            border-color: #000;
            border-top: 1px solid;
            border-right: 1px solid;
            width: 9px;
            height: 9px;
            -webkit-transform: translate(-50%, -50%) rotate(135deg);
            transform: translate(-50%, -50%) rotate(135deg);
            -webkit-transition: all 0.2s ease;
            transition: all 0.2s ease;
        }

        h2.resp-tab-active {
            background: #f1f2f4 !important;
            color: #535b61;
        }

        h2.resp-tab-active i.resp-arrow {
            margin-top: 10px;
            transform: translate(-50%, -50%) rotate(-45deg);
            -webkit-transform: translate(-50%, -50%) rotate(-45deg);
            -webkit-transition: all 0.2s ease;
            transition: all 0.2s ease;
        }

        .resp-easy-accordion h2.resp-accordion {
            display: block;
        }

        .resp-easy-accordion .resp-tab-content {
            border: 1px solid #e4e9ec;
        }

        .resp-easy-accordion .resp-tab-content:last-child {
            border-bottom: 1px solid #e4e9ec !important;
        }

        .resp-jfit {
            width: 100%;
            margin: 0px;
        }

        .resp-tab-content-active {
            display: block;
        }

        h2.resp-accordion:first-child {
            border-top: 1px solid #e4e9ec !important;
        }

        @media only screen and (max-width: 768px) {
            ul.resp-tabs-list {
                display: none !important;
            }

            h2.resp-accordion {
                display: block;
            }

            .resp-vtabs .resp-tab-content,
            .resp-htabs .resp-tab-content {
                border: 1px solid #e4e9ec;
            }

            .resp-vtabs .resp-tabs-container {
                border: none;
                float: none;
                width: 100%;
                min-height: initial;
                clear: none;
            }

            .resp-accordion-closed {
                display: none !important;
            }

            .resp-vtabs .resp-tab-content:last-child {
                border-bottom: 1px solid #e4e9ec !important;
            }
        }

        .hero-wrap {
            position: relative;
        }

        .hero-wrap .hero-mask,
        .hero-wrap .hero-bg,
        .hero-wrap .hero-bg-slideshow {
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            width: 100%;
        }

        .hero-wrap .hero-mask {
            z-index: 1;
        }

        .hero-wrap .hero-content {
            position: relative;
            z-index: 2;
        }

        .hero-wrap .hero-bg-slideshow {
            z-index: 0;
        }

        .hero-wrap .hero-bg {
            z-index: 0;
            background-attachment: fixed;
            background-position: center center;
            background-repeat: no-repeat;
            background-size: cover;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            transition: background-image 300ms ease-in 200ms;
        }

        .hero-wrap .hero-bg.hero-bg-scroll {
            background-attachment: scroll;
        }

        .hero-wrap .hero-bg-slideshow .hero-bg {
            background-attachment: inherit;
        }

        .hero-wrap .hero-bg-slideshow.owl-carousel .owl-stage-outer,
        .hero-wrap .hero-bg-slideshow.owl-carousel .owl-stage,
        .hero-wrap .hero-bg-slideshow.owl-carousel .owl-item {
            height: 100%;
        }

        .brands-grid {
            overflow: hidden;
        }

        .brands-grid>.row>div {
            padding-top: 20px;
            padding-bottom: 20px;
        }

        .brands-grid.separator-border>.row>div:after,
        .brands-grid.separator-border>.row>div:before {
            content: '';
            position: absolute;
        }

        .brands-grid.separator-border>.row>div:after {
            width: 100%;
            height: 0;
            top: auto;
            left: 0;
            bottom: -1px;
            border-bottom: 1px dotted #e0dede;
        }

        .brands-grid.separator-border>.row>div:before {
            height: 100%;
            top: 0;
            left: -1px;
            border-left: 1px dotted #e0dede;
        }

        .brands-grid>.row>div a {
            opacity: 0.7;
            color: #444;
        }

        .brands-grid>.row>div a:hover {
            opacity: 1;
            color: #0071cc;
        }

        .banner .item {
            position: relative;
        }

        .banner .item img {
            vertical-align: middle;
        }

        .banner .caption {
            position: absolute;
            z-index: 2;
            bottom: 0;
            width: 100%;
            padding: 15px 20px;
        }

        .banner .caption h2 {
            font-size: 19px;
            color: #fff;
        }

        .banner .caption p {
            color: rgba(250, 250, 250, 0.8);
            margin-bottom: 0px;
        }

        .banner .rounded .banner-mask,
        .banner .rounded img {
            border-radius: .25rem;
        }

        .banner .banner-mask {
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            width: 100%;
            z-index: 1;
            backface-visibility: hidden;
            background: -webkit-linear-gradient(top, rgba(0, 0, 0, 0.01), rgba(0, 0, 0, 0.6));
            background: -moz-linear-gradient(top, rgba(0, 0, 0, 0.01), rgba(0, 0, 0, 0.6));
            background: -o-linear-gradient(top, rgba(0, 0, 0, 0.01), black);
            background: -ms-linear-gradient(top, rgba(0, 0, 0, 0.01), black);
            background: linear-gradient(to bottom, rgba(0, 0, 0, 0.01), black);
            opacity: 0.7;
            -webkit-transition: all 0.5s ease;
            transition: all 0.5s ease;
        }

        .banner .item:hover .banner-mask {
            opacity: 0.95;
            filter: alpha(opacity=99);
            -webkit-transition: all 0.5s ease;
            transition: all 0.5s ease;
        }

        .simple-ul>li {
            position: relative;
            list-style-type: none;
            line-height: 24px;
        }

        .simple-ul>li:after {
            content: " ";
            position: absolute;
            top: 12px;
            left: -15px;
            border-color: #000;
            border-top: 1px solid;
            border-right: 1px solid;
            width: 6px;
            height: 6px;
            -webkit-transform: translate(-50%, -50%) rotate(45deg);
            transform: translate(-50%, -50%) rotate(45deg);
        }

        .account-card {
            position: relative;
            background: -webkit-linear-gradient(135deg, #6c6c6b, #9e9e9c);
            background: -moz-linear-gradient(135deg, #6c6c6b, #9e9e9c);
            background: -o-linear-gradient(135deg, #6c6c6b, #9e9e9c);
            background: -ms-linear-gradient(135deg, #6c6c6b, #9e9e9c);
            background: linear-gradient(-45deg, #6c6c6b, #9e9e9c);
        }

        .account-card.account-card-primary {
            background: -webkit-linear-gradient(135deg, #0f5e9d, #418fce);
            background: -moz-linear-gradient(135deg, #0f5e9d, #418fce);
            background: -o-linear-gradient(135deg, #0f5e9d, #418fce);
            background: -ms-linear-gradient(135deg, #0f5e9d, #418fce);
            background: linear-gradient(-45deg, #0f5e9d, #418fce);
        }

        .account-card .account-card-expire {
            font-size: 8px;
            line-height: 10px;
        }

        .account-card .account-card-overlay {
            position: absolute;
            background: rgba(0, 0, 0, 0.8);
            top: 0px;
            left: 0px;
            height: 100%;
            width: 100%;
            -ms-flex-align: center;
            align-items: center;
            -ms-flex-pack: center;
            justify-content: center;
            display: -ms-flexbox;
            display: flex;
            opacity: 0;
            -webkit-transition: all 0.3s ease;
            transition: all 0.3s ease;
        }

        .account-card:hover .account-card-overlay {
            opacity: 1;
            -webkit-transition: all 0.3s ease;
            transition: all 0.3s ease;
        }

        .account-card-new {
            background: #f1f5f6;
            border: 1px solid #ebebeb;
        }

        .account-card .border-left,
        .account-card .border-right {
            border-color: rgba(250, 250, 250, 0.1) !important;
        }

        .widget-steps>.step {
            padding: 0;
            position: relative;
        }

        .widget-steps>.step .step-name {
            font-size: 16px;
            margin-bottom: 5px;
            text-align: center;
        }

        .widget-steps>.step>.step-dot {
            position: absolute;
            width: 30px;
            height: 30px;
            display: block;
            background: #fff;
            border: 1px solid #28a745;
            top: 45px;
            left: 50%;
            margin-top: -15px;
            margin-left: -15px;
            border-radius: 50%;
        }

        .widget-steps>.step>.step-dot:after {
            width: 10px;
            height: 10px;
            border-radius: 50px;
            position: absolute;
            top: 9px;
            left: 9px;
        }

        .widget-steps>.step.complete>.step-dot:after {
            content: '\f00c';
            font-weight: 900;
            color: #28a745;
            font-family: "Font Awesome 5 Free";
            top: 3px;
            left: 7px;
        }

        .widget-steps>.step.active>.step-dot:after {
            background: #28a745;
            content: '';
        }

        .widget-steps>.step>.progress {
            position: relative;
            background: #bbb;
            border-radius: 0px;
            height: 1px;
            box-shadow: none;
            margin: 22px 0;
        }

        .widget-steps>.step>.progress>.progress-bar {
            width: 0px;
            box-shadow: none;
            background: #28a745;
        }

        .widget-steps>.step.complete>.progress>.progress-bar {
            width: 100%;
        }

        .widget-steps>.step.active>.progress>.progress-bar {
            width: 50%;
        }

        .widget-steps>.step:first-child.active>.progress>.progress-bar {
            width: 0%;
        }

        .widget-steps>.step:last-child.active>.progress>.progress-bar {
            width: 100%;
        }

        .widget-steps>.step.disabled>.step-dot {
            border-color: #bbb;
        }

        .widget-steps>.step:first-child>.progress {
            left: 50%;
            width: 50%;
        }

        .widget-steps>.step:last-child>.progress {
            width: 50%;
        }

        .widget-steps>.step.disabled a.step-dot {
            pointer-events: none;
        }

        @media (max-width: 576px) {
            .widget-steps>.step .step-name {
                font-size: 14px;
            }
        }

        #footer {
            color: #252b33;
            padding: 0px 0px 35px 0px;
            padding: 0 0 2rem 0;
            margin-top: 1.5rem;
        }

        #footer .nav .nav-item {
            display: inline-block;
            line-height: 12px;
            margin: 0;
            padding: 0 10px;
        }

        #footer .nav .nav-item:first-child {
            padding-left: 0px;
        }

        #footer .nav .nav-item:last-child {
            padding-right: 0px;
        }

        #footer .nav .nav-item .nav-link {
            padding-left: 0;
            padding-right: 0;
            color: #252b33;
            -webkit-transition: all 0.2s ease;
            transition: all 0.2s ease;
        }

        #footer .nav .nav-item .nav-link:focus {
            color: #0071cc;
            -webkit-transition: all 0.2s ease;
            transition: all 0.2s ease;
        }

        #footer .nav .nav-link:hover {
            color: #0071cc;
            -webkit-transition: all 0.2s ease;
            transition: all 0.2s ease;
        }

        #footer .footer-copyright {
            border-top: 1px solid #e6e9ec;
            padding: 32px 0px 0px;
            margin-top: 2rem;
            margin-top: 32px;
            text-align: center;
        }

        #footer .footer-copyright .copyright-text {
            color: #67727c;
            margin: 12px 0 0 0;
            padding: 0;
        }

        #footer .nav.flex-column .nav-item {
            padding: 0px;
        }

        #footer .nav.flex-column .nav-item .nav-link {
            margin: 0.8rem 0px;
            padding: 0px;
            color: #67727c;
        }

        #footer .nav.flex-column .nav-item .nav-link:hover {
            color: #0071cc;
            -webkit-transition: all 0.2s ease;
            transition: all 0.2s ease;
        }

        #footer.footer-text-light {
            color: rgba(250, 250, 250, 0.8);
        }

        #footer.footer-text-light .nav .nav-item .nav-link {
            color: rgba(250, 250, 250, 0.8);
        }

        #footer.footer-text-light .nav .nav-item .nav-link:hover {
            color: #fafafa;
        }

        #footer.footer-text-light .footer-copyright {
            border-color: rgba(250, 250, 250, 0.15);
            color: rgba(250, 250, 250, 0.5);
        }

        #footer.footer-text-light.bg-primary {
            color: #fff;
        }

        #footer.footer-text-light.bg-primary .nav .nav-item .nav-link {
            color: #fff;
        }

        #footer.footer-text-light.bg-primary .nav .nav-item .nav-link:hover {
            color: rgba(250, 250, 250, 0.7);
        }

        #footer.footer-text-light.bg-primary .footer-copyright {
            border-color: rgba(250, 250, 250, 0.15);
            color: rgba(250, 250, 250, 0.9);
        }

        #footer.footer-text-light.bg-primary .footer-copyright .copyright-text {
            color: rgba(250, 250, 250, 0.9);
        }

        #footer.footer-text-light.bg-primary a {
            color: #fff;
        }

        #footer.footer-text-light.bg-primary a:hover {
            color: rgba(250, 250, 250, 0.7);
        }

        .payments-types {
            margin: 0;
            padding: 0;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
            list-style: none;
        }

        .payments-types li {
            margin: 0px 10px 8px 0px;
        }

        .payments-types li a {
            -webkit-transition: all 0.2s ease;
            transition: all 0.2s ease;
            opacity: 1;
        }

        .payments-types li img {
            display: flex;
        }

        .payments-types li:hover a {
            opacity: 0.8;
        }


        .newsletter .form-control {
            height: 38px !important;
            font-size: 14px;
        }

        .newsletter .btn {
            height: 38px;
            padding-top: 0;
            padding-bottom: 0px;
            font-size: 14px;
            background: #546d89;
            border-color: #546d89;
        }

        .newsletter .btn:hover {
            background: #415b78;
        }


        .social-icons {
            margin: 0;
            padding: 0;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
            list-style: none;
        }

        .social-icons li {
            margin: 0px 2px 4px;
            padding: 0;
            border-radius: 100%;
            overflow: visible;
        }

        .social-icons li:last-child {
            margin-right: 0px;
        }

        .social-icons li a {
            background: #d4d4d4;
            border-radius: 100%;
            display: block;
            height: 34px;
            line-height: 34px;
            width: 34px;
            font-size: 16px;
            text-align: center;
            color: #fff;
            text-decoration: none;
            -webkit-transition: all 0.2s ease;
            transition: all 0.2s ease;
        }

        .social-icons li i {
            line-height: inherit;
        }

        .social-icons.social-icons-sm li a {
            width: 30px;
            height: 30px;
            line-height: 30px;
            font-size: 14px;
        }

        .social-icons.social-icons-lg li a {
            width: 40px;
            height: 40px;
            line-height: 40px;
            font-size: 20px;
        }

        .social-icons.social-icons-dark li a {
            background: #555;
        }

        .social-icons li:hover a {
            background: #171717;
            color: #333;
            -webkit-transition: all 0.2s ease;
            transition: all 0.2s ease;
        }

        .social-icons li:hover.social-icons-twitter a,
        .social-icons.social-icons-colored li.social-icons-twitter a {
            background: #00ACEE;
            color: #fff;
        }

        .social-icons li:hover.social-icons-facebook a,
        .social-icons.social-icons-colored li.social-icons-facebook a {
            background: #3B5998;
            color: #fff;
        }

        .social-icons li:hover.social-icons-linkedin a,
        .social-icons.social-icons-colored li.social-icons-linkedin a {
            background: #0E76A8;
            color: #fff;
        }

        .social-icons li:hover.social-icons-rss a,
        .social-icons.social-icons-colored li.social-icons-rss a {
            background: #EE802F;
            color: #fff;
        }

        .social-icons li:hover.social-icons-google a,
        .social-icons.social-icons-colored li.social-icons-google a {
            background: #DD4B39;
            color: #fff;
        }

        .social-icons li:hover.social-icons-pinterest a,
        .social-icons.social-icons-colored li.social-icons-pinterest a {
            background: #cc2127;
            color: #fff;
        }

        .social-icons li:hover.social-icons-youtube a,
        .social-icons.social-icons-colored li.social-icons-youtube a {
            background: #C4302B;
            color: #fff;
        }

        .social-icons li:hover.social-icons-instagram a,
        .social-icons.social-icons-colored li.social-icons-instagram a {
            background: #3F729B;
            color: #fff;
        }

        .social-icons li:hover.social-icons-skype a,
        .social-icons.social-icons-colored li.social-icons-skype a {
            background: #00AFF0;
            color: #fff;
        }

        .social-icons li:hover.social-icons-email a,
        .social-icons.social-icons-colored li.social-icons-email a {
            background: #6567A5;
            color: #fff;
        }

        .social-icons li:hover.social-icons-vk a,
        .social-icons.social-icons-colored li.social-icons-vk a {
            background: #2B587A;
            color: #fff;
        }

        .social-icons li:hover.social-icons-xing a,
        .social-icons.social-icons-colored li.social-icons-xing a {
            background: #126567;
            color: #fff;
        }

        .social-icons li:hover.social-icons-tumblr a,
        .social-icons.social-icons-colored li.social-icons-tumblr a {
            background: #34526F;
            color: #fff;
        }

        .social-icons li:hover.social-icons-reddit a,
        .social-icons.social-icons-colored li.social-icons-reddit a {
            background: #C6C6C6;
            color: #fff;
        }

        .social-icons li:hover.social-icons-delicious a,
        .social-icons.social-icons-colored li.social-icons-delicious a {
            background: #205CC0;
            color: #fff;
        }

        .social-icons li:hover.social-icons-stumbleupon a,
        .social-icons.social-icons-colored li.social-icons-stumbleupon a {
            background: #F74425;
            color: #fff;
        }

        .social-icons li:hover.social-icons-digg a,
        .social-icons.social-icons-colored li.social-icons-digg a {
            background: #191919;
            color: #fff;
        }

        .social-icons li:hover.social-icons-blogger a,
        .social-icons.social-icons-colored li.social-icons-blogger a {
            background: #FC4F08;
            color: #fff;
        }

        .social-icons li:hover.social-icons-flickr a,
        .social-icons.social-icons-colored li.social-icons-flickr a {
            background: #FF0084;
            color: #fff;
        }

        .social-icons li:hover.social-icons-vimeo a,
        .social-icons.social-icons-colored li.social-icons-vimeo a {
            background: #86C9EF;
            color: #fff;
        }

        .social-icons li:hover.social-icons-yahoo a,
        .social-icons.social-icons-colored li.social-icons-yahoo a {
            background: #720E9E;
            color: #fff;
        }

        .social-icons li:hover.social-icons-googleplay a,
        .social-icons.social-icons-colored li.social-icons-googleplay a {
            background: #DD4B39;
            color: #fff;
        }

        .social-icons li:hover.social-icons-apple a,
        .social-icons.social-icons-colored li.social-icons-apple a {
            background: #000;
            color: #fff;
        }

        .social-icons.social-icons-colored li:hover a {
            background: #d4d4d4;
            color: #333;
        }

        #login-signup .modal-dialog,
        #login-signup-page {
            max-width: 430px;
        }

        #back-to-top {
            display: none;
            position: fixed;
            z-index: 1030;
            bottom: 8px;
            right: 10px;
            background-color: rgba(0, 0, 0, 0.2);
            text-align: center;
            color: #fff;
            font-size: 18px;
            width: 36px;
            height: 36px;
            line-height: 36px;
            border-radius: 100%;
            -webkit-transition: all 0.3s ease-in-out;
            transition: all 0.3s ease-in-out;
            -webkit-box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.15);
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.15);
        }

        #back-to-top:hover {
            background-color: #0071cc;
            -webkit-box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.25);
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.25);
            -webkit-transition: all 0.3s ease-in-out;
            transition: all 0.3s ease-in-out;
        }

        @media (max-width: 575px) {
            #back-to-top {
                z-index: 1029;
            }
        }

        .form-control:not(.form-control-lg),
        .custom-select:not(.form-control-lg) {
            font-size: 15px;
        }

        .form-control,
        .custom-select {
            border-color: #d5d3d3;
            color: #777;
        }

        .custom-select option {
            color: #777;
        }

        .custom-select:invalid {
            color: #b1b4b6;
        }

        .form-control:not(.form-control-sm) {
            padding: .810rem .96rem;
            height: inherit;
        }

        .form-control-sm {
            font-size: 14px;
        }

        .form-control-lg {
            height: calc(2.4em + 1rem + 2px);
        }

        select.form-control:not([size]):not([multiple]):not(.form-control-sm) {
            height: auto;
            padding-top: .700rem;
            padding-bottom: .700rem;
        }

        .custom-select:not(.custom-select-sm) {
            height: calc(3.05rem + 2px);
            padding-top: .700rem;
            padding-bottom: .700rem;
        }

        .col-form-label-sm {
            font-size: 13px;
        }

        .custom-select-sm {
            padding-left: 5px !important;
            font-size: 14px;
        }

        .custom-select:not(.custom-select-sm).border-0 {
            height: 3.00rem;
        }

        .form-control:focus,
        .custom-select:focus {
            -webkit-box-shadow: 0 0 5px rgba(128, 189, 255, 0.5);
            box-shadow: 0 0 5px rgba(128, 189, 255, 0.5);
        }

        .form-control:focus[readonly] {
            box-shadow: none;
        }

        .input-group-text {
            border-color: #d5d3d3;
            color: #777;
        }

        .form-control::-webkit-input-placeholder,
        .custom-select::-webkit-input-placeholder {
            color: #b1b4b6;
        }

        .form-control:-moz-placeholder,
        .custom-select:-moz-placeholder {

            color: #b1b4b6;
        }

        .form-control::-moz-placeholder,
        .custom-select::-moz-placeholder {

            color: #b1b4b6;
        }

        .form-control:-ms-input-placeholder,
        .form-control::-ms-input-placeholder,
        .custom-select:-ms-input-placeholder,
        .custom-select::-ms-input-placeholder {

            color: #b1b4b6;
        }

        .btn {
            padding: .750rem 2.5rem;
            -webkit-transition: all 0.5s ease;
            transition: all 0.5s ease;
        }

        .btn-sm {
            padding: 0.5rem 1rem;
        }

        .btn:not(.btn-link) {
            -webkit-box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.15);
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.15);
        }

        .btn:not(.btn-link):hover {
            -webkit-box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.3);
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.3);
            -webkit-transition: all 0.5s ease;
            transition: all 0.5s ease;
        }

        .input-group-append .btn,
        .input-group-prepend .btn {
            -webkit-box-shadow: none;
            box-shadow: none;
            padding-left: 0.75rem;
            padding-right: 0.75rem;
        }

        .input-group-append .btn:hover,
        .input-group-prepend .btn:hover {
            -webkit-box-shadow: none;
            box-shadow: none;
        }

        @media (max-width: 575px) {
            .btn:not(.btn-sm) {
                padding: .810rem 1rem;
            }

            .input-group>.input-group-append>.btn,
            .input-group>.input-group-prepend>.btn {
                padding: 0 0.75rem;
            }
        }

        .bg-primary,
        .badge-primary {
            background-color: #0071cc !important;
        }

        .bg-secondary {
            background-color: #0c2f55 !important;
        }

        .text-secondary {
            color: #0c2f55 !important;
        }

        .text-primary {
            color: #0071cc !important;
        }

        .btn-link {
            color: #0071cc;
        }

        .btn-link:hover {
            color: #0e7fd9 !important;
        }

        .border-primary {
            border-color: #0071cc !important;
        }

        .border-secondary {
            border-color: #0c2f55 !important;
        }

        .btn-primary {
            background-color: #0071cc;
            border-color: #0071cc;
        }

        .btn-primary:hover {
            background-color: #0e7fd9;
            border-color: #0e7fd9;
        }

        .btn-secondary {
            background-color: #0c2f55;
            border-color: #0c2f55;
        }

        .btn-outline-primary {
            color: #0071cc;
            border-color: #0071cc;
        }

        .btn-outline-primary:hover {
            background-color: #0071cc;
            border-color: #0071cc;
            color: #fff;
        }

        .btn-outline-secondary {
            color: #0c2f55;
            border-color: #0c2f55;
        }

        .btn-outline-secondary:hover {
            background-color: #0c2f55;
            border-color: #0c2f55;
            color: #fff;
        }

        .progress-bar,
        .nav-pills .nav-link.active,
        .nav-pills .show>.nav-link {
            background-color: #0071cc;
        }

        .page-item.active .page-link,
        .custom-radio .custom-control-input:checked~.custom-control-label:before,
        .custom-control-input:checked~.custom-control-label::before,
        .custom-checkbox .custom-control-input:checked~.custom-control-label:before,
        .custom-control-input:checked~.custom-control-label:before {
            background-color: #0071cc;
            border-color: #0071cc;
        }

        .list-group-item.active {
            background-color: #0071cc;
            border-color: #0071cc;
        }

        .page-link {
            color: #0071cc;
        }

        .page-link:hover {
            color: #0e7fd9;
        }

        .page-link {
            border-color: #f4f4f4;
            border-radius: 0.25rem;
            margin: 0 0.3rem;
        }

        .page-item.disabled .page-link {
            border-color: #f4f4f4;
        }

        .ui-slider-horizontal {
            height: .2em;
            margin-left: 11px;
            margin-right: 11px;
        }

        .ui-slider-horizontal .ui-slider-handle {
            top: -0.7em;
            margin-left: -.7em;
            border-radius: 100%;
            background: #fff;
            width: 1.5em;
            height: 1.5em;
        }

        .ui-slider.ui-widget.ui-widget-content {
            border: none;
            background: #eee;
            margin-bottom: 15px;
        }

        .ui-slider .ui-widget-header {
            background: #0071cc;
        }

        .ui-menu.ui-widget.ui-widget-content {
            -webkit-box-shadow: 0px 0px 12px rgba(0, 0, 0, 0.176);
            box-shadow: 0px 0px 12px rgba(0, 0, 0, 0.176);
            border: none;
            overflow: hidden;
            overflow-y: auto;
            max-height: 50vh;
            border-radius: 4px;
        }

        .ui-menu .ui-menu-item-wrapper {
            padding: 6px .75rem 6px .9rem;
        }

        .ui-menu.ui-widget-content .ui-state-active {
            background: #0071cc;
            border-color: #0071cc;
        }

        .img_center {
            margin: 0 auto;
            display: block;
        }

        .ui-menu .ui-menu-divider {
            display: none;
        }
    </style>
    <style>
        .table td,
        .table th {
            padding: 6px;
        }

        .card-body {
            -ms-flex: 1 1 auto;
            flex: 1 1 auto;
            padding: 7px;
        }

        .table {
            margin-bottom: 0rem;
        }
    </style>

    <!--print css ============================================= -->
    <style>
        @page {
            size: A4;
            margin: 0;
        }

        @media print {

            html,
            body {
                width: 210mm;
                height: 297mm;
            }

            body * {
                visibility: hidden;
            }

            .print-container,
            .print-container * {
                visibility: visible;
            }

            * {
                color: #fff;
                background: transparent;
                -webkit-print-color-adjust: exact !important;
                color-adjust: exact !important;
            }

            .invoice-container {
                margin: 15px auto;
                padding: 20px;
                max-width: 1200px;
                background-color: #fff;
                border: 1px solid #ccc;
                -moz-border-radius: 6px;
                -webkit-border-radius: 6px;
                -o-border-radius: 6px;
                border-radius: 6px;
            }
        }
    </style>
</head>

<body>
    <br>
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <!--Genrate PDF Script-->
                <input type="button" id="create_pdf" class="btn btn-primary btn-sm" value="Generate PDF">
                <button type="button" class="btn btn-primary btn-sm" onclick="window.print();">Print now</button>
                <a href="https://www.darwintrip.com/">Home</a>
            </div>
        </div>
    </div>
    <div class="main">
        <div class="container-fluid invoice-container print-container">
            <div class="row align-items-center">
                <div class="col-sm-7 text-center text-sm-left"><img src="http://www.darwintrip.com/img/darwintriplogo.png" title="Darwintrip" /></div>
                <div class="col-sm-5 text-center text-sm-right">
                    <p class="mb-0">Booking ID: <?= $sql['booking_id']; ?></p>
                    <p class="mb-0">Booked on: <?= date('d F, y',strtotime($sql['created_date']));  ?></p>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-sm-6">
                    <p class="mb-0">DarwinTrip GST : 27AAECD3441P1ZD</p>
                    <p class="mb-0">Customer GST : <?= $sql['gst'] == '' ? '---' : '' ?></p>
                </div>
                <div style=" margin-top:15px;   text-align: right;" class="col-lg-6">
                    <h6>Status: <span style="padding: 3px 15px;color: white; background: #1c6544; font-size: 18px;"><?= $sql['status'] == '0' ? 'Confirmed' : '' ?></span></h6>
                </div>
            </div>
            <hr>
            <div class="row">
                <div style="margin-top:5px;" class="col-lg-2 order-sm-0">
                    <h5 class="text-center">Company Email</h5>
                    <p><b>info@darwintrip.com</b></p>
                </div>
                <div class="col-lg-6 text-center">

                    <h5 class="text-center">Customer Care</h5>
                    <p><b>1800 266 2901</b></p>
                </div>
                <div class="col-lg-4 text-sm-right order-sm-1">
                    <table style="border: 2px solid #000;" class="table table-bordered">
                        <tbody>
                            <tr>
                                <td class="text-center">
                                    <b> App Reference no.</b> <br>
                                    <h4 style="font-size: 18px;"><?= $sql['apprefernce_no'] ?></h4>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <br />
            <div class="card">
                <div class="card-header"> <span class="font-weight-600 text-4">Booking Details</span> </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <td class="text-center"><strong>Check In</strong></td>
                                    <td class="text-center"><strong>Check Out</strong></td>
                                    <td class="text-center"><strong>No of Room</strong></td>
                                    <td class="text-center"><strong>Total Guest</strong></td>
                                </tr>
                            </thead>
                            <tbody>
                                <td class="text-center"><strong><?= date('d F, y', strtotime($sql['checkin'])); ?></strong></td>
                                <td class="text-center"><strong><?= date('d F, y', strtotime($sql['checkout'])); ?></strong></td>
                                <td class="text-center"><strong><?= $sql['noofroom']; ?></strong></td>
                                <td class="text-center"><strong><?= $sql['totalguest'] ?></strong></td>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <br>
            <div class="card">
                <div class="card-header"> <span class="font-weight-600 text-4">Passenger(s) Details</span> </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <td class="text-center"><strong>Sr No.</strong></td>
                                    <td class="text-center"><strong>Passenger(s) Name</strong></td>
                                    <td class="text-center"><strong>Pax Type</strong></td>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $i = 1; foreach($pax_details as $key=>$value){?>
                                <tr>
                                    <td class="text-center"><?=  $i; ?></td>
                                    <td class="text-center"><?= $value['pax_name'] ?></td>
                                    <td class="text-center"><?= $value['pax_type'] ?></td>
                                </tr>
                            <?php $i++; } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-lg-6">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <td class="text-center"><strong>Sr No.</strong></td>
                                    <td class="text-center"><strong>Hotel Details</strong></td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><span class="text-3"><span class="font-weight-500">Hotel Name</span></span><br> </td>
                                    <td class="text-center"><?= $sql['room_name']; ?></td>
                                </tr>
                                <tr>
                                    <td><span class="text-3"><span class="font-weight-500">Address</span></span><br> </td>
                                    <td class="text-center"><?= $sql['hotel_add']; ?></td>
                                </tr>
                                <tr>
                                    <td><span class="text-3"><span class="font-weight-500">Contact Number</span></span> </td>
                                    <td class="text-center"><?= $sql['hotel_phone']; ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <td class="text-center"><strong>Payment Details</strong></td>
                                    <td class="text-center"><strong>Amount (INR)</strong></td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><span class="text-3"><span class="font-weight-500"><strong>Grand Total</strong></span></span><br> </td>
                                    <td class="text-center"><strong><?= ₹ . ' ' . $sql['booking_amt'] ?></strong></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
            <br>
            <h6 style="color:#000;"><strong>Important Information</strong></h6>
            <ul class="text-1">
                <li> All Guests, including children and infants, must present valid identification at check-in.</li>
                <li> Check-in begins 2 hours prior to the flight for seat assignment and closes 45 minutes prior to the scheduled departure.</li>
                <li> Carriage and other services provided by the carrier are subject to conditions of carriage, which are hereby incorporated by reference. These conditions may be obtained from the issuing carrier. </li>
                <li> In case of cancellations less than 6 hours before departure please cancel with the airlines directly. We are not responsible for any losses if the request is received less than 6 hours before departure. </li>
                <li> Please contact airlines for Terminal Queries.</li>
                <li> Free Baggage Allowance: Checked-in Baggage for Domestic = 15kgs in Economy class.</li>
                <li> Changes to the reservation will result in the above fee plus any difference in the fare between the original fare paid and the fare for the revised booking. </li>
                <li> The No Show refund should be collected within 15 days from departure date.</li>
                <li> If the basic fare is less than cancellation charges then only statutory taxes would be refunded.</li>
                <li> We are not be responsible for any Flight delay/Cancellation from airline's end.</li>
                <li> Kindly contact the airline at least 24 hrs before to reconfirm your flight detail giving reference of Airline PNR Number.</li>
                <li> We are a travel agent and all reservations made through our website are as per the terms and conditions of the concerned airlines.</li>
                <li> All modifications,cancellations and refunds of the airline tickets shall be strictly in accordance with the policy of the concerned airlines and we disclaim all liability in connection thereof.</li>
            </ul>
        </div>
    </div>
    <!--Genrate PDF Script-->
    <script>
        (function() {
            $('#create_pdf').on('click', function() {
                $('body').scrollTop(0);
                createPDF();
            });
            //create pdf
            function createPDF() {
                var form = $('.main'),
                    cache_width = form.width(),
                    a4 = [595, 842]; // for a4 size paper width and height
                getCanvas().then(function(canvas) {
                    var imgWidth = 210;
                    var pageHeight = 300;
                    var imgHeight = canvas.height * imgWidth / canvas.width;
                    var heightLeft = imgHeight;
                    var doc = new jsPDF('p', 'mm');
                    var position = 0;

                    var img = canvas.toDataURL("image/jpeg");
                    doc.addImage(img, 'JPEG', 0, position, imgWidth, imgHeight);
                    heightLeft -= pageHeight;


                    while (heightLeft >= 0) {
                        position = heightLeft - imgHeight;
                        doc.addPage();
                        doc.addImage(img, 'JPEG', 0, position, imgWidth, imgHeight);
                        heightLeft -= pageHeight;
                    }

                    doc.save('DarwinTrip-FlightInvoice.pdf');
                    form.width(cache_width);
                    location.reload();
                });
            }

            // create canvas object
            function getCanvas() {
                var form = $('.main'),
                    cache_width = form.width(),
                    a4 = [595, 842]; // for a4 size paper width and height
                form.width((a4[0] * 1.33333) - 80).css('max-width', 'none');
                return html2canvas(form, {
                    imageTimeout: 2000,
                    removeContainer: true
                });
            }

        }());
    </script>
    <script>
        (function($) {
            $.fn.html2canvas = function(options) {
                var date = new Date(),
                    $message = null,
                    timeoutTimer = false,
                    timer = date.getTime();
                html2canvas.logging = options && options.logging;
                html2canvas.Preload(this[0], $.extend({
                    complete: function(images) {
                        var queue = html2canvas.Parse(this[0], images, options),
                            $canvas = $(html2canvas.Renderer(queue, options)),
                            finishTime = new Date();
                        $canvas.css({
                            position: 'absolute',
                            left: 0,
                            top: 0
                        }).appendTo(document.body);
                        $canvas.siblings().toggle();

                        $(window).click(function() {
                            if (!$canvas.is(':visible')) {
                                $canvas.toggle().siblings().toggle();
                                throwMessage("Canvas Render visible");
                            } else {
                                $canvas.siblings().toggle();
                                $canvas.toggle();
                                throwMessage("Canvas Render hidden");
                            }
                        });
                        throwMessage('Screenshot created in ' + ((finishTime.getTime() - timer) / 1000) + " seconds<br />", 4000);
                    }
                }, options));

                function throwMessage(msg, duration) {
                    window.clearTimeout(timeoutTimer);
                    timeoutTimer = window.setTimeout(function() {
                        $message.fadeOut(function() {
                            $message.remove();
                        });
                    }, duration || 2000);
                    if ($message)
                        $message.remove();
                    $message = $('<div ></div>').html(msg).css({
                        margin: 0,
                        padding: 10,
                        background: "#000",
                        opacity: 0.7,
                        position: "fixed",
                        top: 10,
                        right: 10,
                        fontFamily: 'Tahoma',
                        color: '#fff',
                        fontSize: 12,
                        borderRadius: 12,
                        width: 'auto',
                        height: 'auto',
                        textAlign: 'center',
                        textDecoration: 'none'
                    }).hide().fadeIn().appendTo('body');
                }
            };
        })(jQuery);
    </script>
    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
    <!--Genrate PDF Script-->
</body>

</html>