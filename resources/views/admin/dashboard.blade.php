@extends("layouts.app")
@section("content")
    <style>
        body {
            background: #eee;
        }

        .rounded {
            -webkit-border-radius: 4px !important;
            -moz-border-radius: 4px !important;
            border-radius: 4px !important;
        }

        .mini-stat {
            padding: 15px;
            margin-bottom: 20px;
        }

        .mini-stat-icon {
            width: 60px;
            height: 60px;
            display: inline-block;
            line-height: 60px;
            text-align: center;
            font-size: 30px;
            background: none repeat scroll 0% 0% #EEE;
            border-radius: 100%;
            float: left;
            margin-right: 10px;
            color: #FFF;
        }

        .mini-stat-info {
            font-size: 12px;
            padding-top: 2px;
        }

        span,
        p {
            color: white;
        }

        .mini-stat-info span {
            display: block;
            font-size: 30px;
            font-weight: 600;
            margin-bottom: 5px;
            margin-top: 7px;
        }

        /* ================ colors =====================*/
        .bg-facebook {
            background-color: #3b5998 !important;
            border: 1px solid #3b5998;
            color: white;
        }

        .fg-facebook {
            color: #3b5998 !important;
        }

        .bg-twitter {
            background-color: #00a0d1 !important;
            border: 1px solid #00a0d1;
            color: white;
        }

        .fg-twitter {
            color: #00a0d1 !important;
        }

        .bg-googleplus {
            background-color: #db4a39 !important;
            border: 1px solid #db4a39;
            color: white;
        }

        .fg-googleplus {
            color: #db4a39 !important;
        }

        .bg-bitbucket {
            background-color: #205081 !important;
            border: 1px solid #205081;
            color: white;
        }

        .fg-bitbucket {
            color: #205081 !important;
        }

        .footer {
            position: fixed;
            left: 0;
            bottom: 0;
            width: 100%;
            background-color: #3b5998;
            color: white;
            text-align: center;
        }
    </style>
    <div class="container">
        <div class="row mt-4">
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="mini-stat clearfix bg-facebook rounded-4">
                    <div class="mini-stat-info">
                        <span>{{number_format($purchased, 0, '.', ',')}}</span>
                        <b class="bg-white rounded text-dark" style="padding: 4px;">PURCHASED</b>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="mini-stat clearfix bg-info rounded-4">
                    <div class="mini-stat-info">
                        <span>{{number_format($packaging, 0, '.', ',')}}</span>
                        <b class="bg-white rounded text-dark" style="padding: 4px;">PACKAGING</b>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="mini-stat clearfix bg-warning rounded-4">
                    <div class="mini-stat-info">
                        <span>{{number_format($delivering, 0, '.', ',')}}</span>
                        <b class="bg-white rounded text-dark" style="padding: 4px;">DELIVERING</b>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="mini-stat clearfix bg-success rounded-4">
                    <!-- <span class="mini-stat-icon"><i class="fa fa-bitbucket fg-bitbucket"></i></span> -->
                    <div class="mini-stat-info">
                        <span>{{number_format($received, 0, '.', ',')}}</span>
                        <b class="bg-white rounded text-dark" style="padding: 4px;">RECEIVED</b>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
