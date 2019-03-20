<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns:v="urn:schemas-microsoft-com:vml">
<head>

    <!-- Define Charset -->
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

    <!-- Responsive Meta Tag -->
    <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;" />

    <link href='http://fonts.googleapis.com/css?family=Questrial' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,700,600' rel='stylesheet' type='text/css'>

    <title>Notification 8 - Responsive Email Template</title><!-- Responsive Styles and Valid Styles -->

    <style type="text/css">

        body{
            width: 100%;
            background-color: rgb(46, 62, 78);
            margin:0;
            padding:0;
            -webkit-font-smoothing: antialiased;
            mso-margin-top-alt:0px; mso-margin-bottom-alt:0px; mso-padding-alt: 0px 0px 0px 0px;
        }

        p,h1,h2,h3,h4{
            margin-top:0;
            margin-bottom:0;
            padding-top:0;
            padding-bottom:0;
        }

        span.preheader{display: none; font-size: 1px;}

        html{
            width: 100%;
        }

        table{
            font-size: 14px;
            border: 0;
        }

        /* ----------- responsivity ----------- */
        @media only screen and (max-width: 640px){
            /*------ top header ------ */
            body[yahoo] .show{display: block !important;}
            body[yahoo] .hide{display: none !important;}

            /*----- main image -------*/
            body[yahoo] .main-image img{width: 440px !important; height: auto !important;}

            /* ====== divider ====== */
            body[yahoo] .divider img{width: 440px !important;}

            /*--------- banner ----------*/
            body[yahoo] .banner img{width: 440px !important; height: auto !important;}
            /*-------- container --------*/
            body[yahoo] .container590{width: 440px !important;}
            body[yahoo] .container580{width: 400px !important;}
            body[yahoo] .container1{width: 420px !important;}
            body[yahoo] .container2{width: 400px !important;}
            body[yahoo] .container3{width: 380px !important;}

            /*-------- secions ----------*/
            body[yahoo] .section-item{width: 440px !important;}
            body[yahoo] .section-img img{width: 440px !important; height: auto !important;}
        }

        @media only screen and (max-width: 479px){
            /*------ top header ------ */
            body[yahoo] .main-header{font-size: 24px !important;}
            body[yahoo] .resize-text{font-size: 14px !important;}

            /*----- main image -------*/
            body[yahoo] .main-image img{width: 280px !important; height: auto !important;}

            /* ====== divider ====== */
            body[yahoo] .divider img{width: 280px !important;}
            body[yahoo] .align-center{text-align: center !important;}


            /*-------- container --------*/
            body[yahoo] .container590{width: 280px !important;}
            body[yahoo] .container580{width: 250px !important;}
            body[yahoo] .container1{width: 260px !important;}
            body[yahoo] .container2{width: 240px !important;}
            body[yahoo] .container3{width: 220px !important;}

            /*------- CTA -------------*/
            body[yahoo] .cta-button{width: 200px !important;}
            body[yahoo] .cta-text{font-size: 14px !important;}
        }

    </style>
</head>

<body yahoo="fix" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">



<table border="0" width="100%" cellpadding="0" cellspacing="0" bgcolor="2b2e34" class="body_color" style="background-color: rgb(46, 62, 78);">

    <tbody><tr><td height="120" style="font-size: 120px; line-height: 120px;">&nbsp;</td></tr>

    <tr>
        <td>
            <table border="0" align="center" width="529" cellpadding="0" cellspacing="0" class="container590 bodybg_color" style="background-color: #fff;background-size: 100% 100%; background-position: top center; background-repeat: no-repeat;">
                <tbody><tr>
                    <td>
                        <table border="0" align="center" width="460" cellpadding="0" cellspacing="0" class="container590 bodybg_color">
                            <tbody>

                            <tr><td height="40" style="font-size: 40px; line-height: 40px;">&nbsp;</td></tr>

                            <tr>
                                <td align="center" style="color: #3c3c3c; font-size: 27px; font-family: 'Open Sans', sans-serif; font-weight: 700; mso-line-height-rule: exactly; line-height: 30px;" class="title_color main-header">

                                    <!-- ======= section header ======= -->

                                    <div class="editable_text" style="line-height: 30px;">
											<span class="text_container">
				        					
				        						{!! $title !!}
				        					
											</span>
                                    </div>
                                </td>
                            </tr>

                            <tr><td height="55" style="font-size: 55px; line-height: 55px;">&nbsp;</td></tr>

                            <tr>
                                <td>
                                    <table border="0" align="center" cellpadding="0" cellspacing="0" class="container580">
                                        <tbody><tr>
                                            <td align="center" style="color: #717f8c; font-size: 14px; font-family: 'Open Sans', sans-serif; mso-line-height-rule: exactly; line-height: 24px;" class="resize-text text_color">
                                                <div class="editable_text" style="line-height: 24px">
														<span class="text_container">
														<!-- ======= section text ======= -->
                                                            {!! $details !!}
                                                        </span>
                                                </div>
                                            </td>
                                        </tr>
                                        </tbody></table>
                                </td>
                            </tr>

                            </tbody></table>
                    </td>
                </tr>

                <tr><td height="40" style="font-size: 40px; line-height: 40px;">&nbsp;</td></tr>




                <tr><td height="50" style="font-size: 50px; line-height: 50px;">&nbsp;</td></tr>
                </tbody></table>
        </td>
    </tr>

    <tr><td height="20" style="font-size: 20px; line-height: 20px;">&nbsp;</td></tr>

    <tr>
        <td>
            <table border="0" align="center" width="400" cellpadding="0" cellspacing="0" class="container590 bodybg_color">
                <tbody><tr>
                    <td>
                        <table border="0" align="center" cellpadding="0" cellspacing="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="container590">

                            <tbody><tr>
                                <td align="center" style="color: #ffffff; font-size: 14px; font-family: 'Open Sans', sans-serif; line-height: 22px;">
                                    <div class="editable_text" style=" line-height: 22px;">
			        						<span class="text_container">
			            					<a href="{!! $websiteURL !!}" style="color: #ffffff; text-decoration: none;" class="text2_color">{!! $websiteName !!}</a>
			        						</span>
                                    </div>
                                </td>
                            </tr>

                            </tbody></table>
                    </td>
                </tr>
                </tbody></table>
        </td>
    </tr>

    <tr><td height="50" style="font-size: 50px; line-height: 50px;">&nbsp;</td></tr>
    <tr><td height="50" style="font-size: 50px; line-height: 50px;">&nbsp;</td></tr>

    </tbody></table>


</body>
</html>